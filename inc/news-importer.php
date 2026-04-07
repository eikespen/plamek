<?php
/**
 * One-time importer for news posts and references from the live Plamek API.
 *
 * Trigger by visiting /wp-admin/?pl_import_news=1 as an admin.
 *
 * - Fetches https://plamek.no/api/news/posts
 * - Posts with category="Referanser" become 'reference' CPT entries
 * - All other categories become standard 'post' entries
 * - Featured images are sideloaded from https://plamek.no/api/media/...
 *   into the WP media library and set as the post thumbnail
 * - Idempotent: re-running skips posts whose slug already exists
 */
defined('ABSPATH') || exit;

const PL_NEWS_API     = 'https://plamek.no/api/news/posts';
const PL_MEDIA_PREFIX = 'https://plamek.no';

/* ── Manual trigger ── */
add_action('admin_init', function () {
    if (!isset($_GET['pl_import_news']) || !current_user_can('manage_options')) return;

    $log = pl_run_news_import();

    wp_die(
        '<h2 style="font-family:sans-serif;">Plamek — Nyhets-importør</h2>' .
        '<ul style="font-family:monospace;font-size:13px;line-height:1.7;max-width:900px;">' .
        '<li>' . implode('</li><li>', array_map('esc_html', $log)) . '</li>' .
        '</ul>' .
        '<p><a href="' . esc_url(admin_url('edit.php')) . '">→ Nyheter</a> &nbsp; ' .
        '<a href="' . esc_url(admin_url('edit.php?post_type=reference')) . '">→ Referanser</a></p>',
        'Plamek News Importer'
    );
});

/* ── Core import routine ── */
function pl_run_news_import(): array {
    $log = [];

    // 1. Fetch the live news endpoint
    $response = wp_remote_get(PL_NEWS_API, ['timeout' => 30]);
    if (is_wp_error($response)) {
        return ['ERROR fetching API: ' . $response->get_error_message()];
    }
    if (wp_remote_retrieve_response_code($response) !== 200) {
        return ['ERROR: API returned HTTP ' . wp_remote_retrieve_response_code($response)];
    }

    $body = json_decode(wp_remote_retrieve_body($response), true);
    if (!is_array($body)) {
        return ['ERROR: Could not decode JSON response'];
    }

    $log[] = 'Fetched ' . count($body) . ' posts from ' . PL_NEWS_API;

    // 2. Need media sideload helpers
    require_once ABSPATH . 'wp-admin/includes/media.php';
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/image.php';

    foreach ($body as $item) {
        $slug = sanitize_title($item['slug'] ?? '');
        if (!$slug) {
            $log[] = '⚠ Skipped: missing slug';
            continue;
        }

        $is_reference = isset($item['category']) && strtolower($item['category']) === 'referanser';
        $post_type    = $is_reference ? 'reference' : 'post';
        $type_label   = $is_reference ? 'reference' : 'post';

        // Skip if a post/reference with this slug already exists
        $existing = get_posts([
            'post_type'      => $post_type,
            'name'           => $slug,
            'post_status'    => 'any',
            'posts_per_page' => 1,
            'fields'         => 'ids',
        ]);
        if (!empty($existing)) {
            $log[] = "OK (exists, skipped): [$type_label] $slug";
            continue;
        }

        // Build post content — keep the HTML from the API
        $title   = wp_strip_all_tags($item['title']   ?? 'Untitled');
        $content = $item['content'] ?? '';
        $excerpt = wp_strip_all_tags($item['excerpt'] ?? '');
        $date    = !empty($item['published_date']) ? date('Y-m-d H:i:s', strtotime($item['published_date'])) : current_time('mysql');

        $post_id = wp_insert_post([
            'post_type'    => $post_type,
            'post_title'   => $title,
            'post_name'    => $slug,
            'post_content' => wp_kses_post($content),
            'post_excerpt' => $excerpt,
            'post_status'  => 'publish',
            'post_date'    => $date,
            'post_author'  => 1,
        ], true);

        if (is_wp_error($post_id)) {
            $log[] = "ERROR creating [$type_label] $slug: " . $post_id->get_error_message();
            continue;
        }

        // Sideload featured image
        if (!empty($item['featured_image'])) {
            $img_url = PL_MEDIA_PREFIX . $item['featured_image'];
            $att_id  = pl_sideload_image_to_post($img_url, $post_id, $title);
            if ($att_id && !is_wp_error($att_id)) {
                set_post_thumbnail($post_id, $att_id);
                $log[] = "Created [$type_label] $slug (id $post_id) + image";
            } else {
                $err = is_wp_error($att_id) ? $att_id->get_error_message() : 'unknown';
                $log[] = "Created [$type_label] $slug (id $post_id) — image failed: $err";
            }
        } else {
            $log[] = "Created [$type_label] $slug (id $post_id) — no image";
        }
    }

    flush_rewrite_rules();
    return $log;
}

/* ── Helper: download an external image and attach it to a post ── */
function pl_sideload_image_to_post(string $url, int $post_id, string $desc) {
    // Fetch the file to a temp location
    $tmp = download_url($url, 60);
    if (is_wp_error($tmp)) return $tmp;

    // Build a filename — strip query strings, ensure extension
    $filename = basename(parse_url($url, PHP_URL_PATH));
    if (!preg_match('/\.(jpe?g|png|gif|webp)$/i', $filename)) {
        $filename .= '.jpg';
    }

    $file_array = [
        'name'     => $filename,
        'tmp_name' => $tmp,
    ];

    $att_id = media_handle_sideload($file_array, $post_id, $desc);

    if (is_wp_error($att_id)) {
        @unlink($tmp);
        return $att_id;
    }
    return $att_id;
}
