<?php
/**
 * Duplicate page action
 *
 * Adds a "Duplicate" link in the row actions of the Pages list.
 * Clicking it copies the page (title + " — kopi"), all pl_* postmeta,
 * the assigned page template and the featured image. The new page is
 * saved as a draft so the editor can rename it before publishing.
 */
defined('ABSPATH') || exit;

/* ── Add the "Duplicate" link to the Pages row actions ── */
add_filter('page_row_actions', function ($actions, $post) {
    if ($post->post_type !== 'page' || !current_user_can('edit_pages')) return $actions;

    $url = wp_nonce_url(
        admin_url('admin-post.php?action=pl_duplicate_page&post=' . $post->ID),
        'pl_duplicate_page_' . $post->ID
    );
    $actions['pl_duplicate'] = '<a href="' . esc_url($url) . '" title="Lag en kopi av denne siden">Dupliser</a>';
    return $actions;
}, 10, 2);

/* ── Handler ── */
add_action('admin_post_pl_duplicate_page', function () {
    $source_id = isset($_GET['post']) ? (int) $_GET['post'] : 0;
    if (!$source_id) wp_die('Missing post id');

    check_admin_referer('pl_duplicate_page_' . $source_id);
    if (!current_user_can('edit_pages')) wp_die('Insufficient permissions');

    $source = get_post($source_id);
    if (!$source || $source->post_type !== 'page') wp_die('Source page not found');

    // Create the new page as a draft
    $new_id = wp_insert_post([
        'post_title'   => $source->post_title . ' — kopi',
        'post_content' => $source->post_content,
        'post_excerpt' => $source->post_excerpt,
        'post_status'  => 'draft',
        'post_type'    => 'page',
        'post_author'  => get_current_user_id() ?: $source->post_author,
        'post_parent'  => $source->post_parent,
        'menu_order'   => $source->menu_order,
    ], true);

    if (is_wp_error($new_id)) {
        wp_die('Error creating duplicate: ' . $new_id->get_error_message());
    }

    // Copy all post meta (template, Plamek meta box fields, Yoast SEO etc.)
    $meta = get_post_meta($source_id);
    foreach ($meta as $key => $values) {
        // Skip internal keys that should not be copied
        if (in_array($key, ['_edit_lock', '_edit_last'], true)) continue;
        foreach ($values as $value) {
            // Each value is a maybe_serialized string
            add_post_meta($new_id, $key, maybe_unserialize($value));
        }
    }

    // Copy the featured image
    $thumb_id = get_post_thumbnail_id($source_id);
    if ($thumb_id) set_post_thumbnail($new_id, $thumb_id);

    // Redirect to the editor for the new draft
    wp_safe_redirect(admin_url('post.php?action=edit&post=' . $new_id));
    exit;
});
