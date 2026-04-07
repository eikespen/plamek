<?php
/**
 * Plamek Theme — functions.php
 *
 * Custom WordPress theme for Plamek AS.
 * All page content is managed via native WordPress meta boxes (see inc/meta-boxes.php).
 *
 * © 2025 Espen T. Eik. All rights reserved.
 */
defined('ABSPATH') || exit;

require_once get_template_directory() . '/inc/defaults.php';
require_once get_template_directory() . '/inc/meta-boxes.php';
require_once get_template_directory() . '/inc/options.php';
require_once get_template_directory() . '/inc/page-seeder.php';
require_once get_template_directory() . '/inc/news-importer.php';

/* ── Disable Gutenberg block editor for pages ── */
add_filter('use_block_editor_for_post_type', function (bool $use, string $post_type): bool {
    return $post_type === 'page' ? false : $use;
}, 10, 2);

add_action('init', function () {
    remove_post_type_support('page', 'editor');
});

/* ── Theme setup ── */
function pl_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);
    add_theme_support('responsive-embeds');
    add_theme_support('custom-logo', [
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ]);

    register_nav_menus([
        'primary' => __('Primary Menu', 'plamek'),
        'footer'  => __('Footer Menu', 'plamek'),
    ]);
}
add_action('after_setup_theme', 'pl_setup');

/* ── Enqueue assets ── */
function pl_enqueue() {
    // Theme override CSS layered on top of Tailwind (which is loaded via CDN in header.php)
    $main_css = get_template_directory() . '/assets/css/main.css';
    if (file_exists($main_css)) {
        wp_enqueue_style(
            'pl-main',
            get_template_directory_uri() . '/assets/css/main.css',
            [],
            filemtime($main_css)
        );
    }

    // Theme JS
    $main_js = get_template_directory() . '/assets/js/main.js';
    if (file_exists($main_js)) {
        wp_enqueue_script(
            'pl-main',
            get_template_directory_uri() . '/assets/js/main.js',
            [],
            filemtime($main_js),
            true
        );
        wp_localize_script('pl-main', 'plData', [
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce('pl_nonce'),
        ]);
    }
}
add_action('wp_enqueue_scripts', 'pl_enqueue');

/* ── Custom post type: Reference (referanser) ── */
function pl_register_reference_post_type() {
    register_post_type('reference', [
        'labels' => [
            'name'               => __('Referanser', 'plamek'),
            'singular_name'      => __('Referanse', 'plamek'),
            'add_new'            => __('Legg til ny', 'plamek'),
            'add_new_item'       => __('Legg til ny referanse', 'plamek'),
            'edit_item'          => __('Rediger referanse', 'plamek'),
            'new_item'           => __('Ny referanse', 'plamek'),
            'view_item'          => __('Vis referanse', 'plamek'),
            'search_items'       => __('Søk i referanser', 'plamek'),
            'not_found'          => __('Ingen referanser funnet', 'plamek'),
        ],
        'public'      => true,
        'has_archive' => false,
        'rewrite'     => ['slug' => 'referanser'],
        'supports'    => ['title', 'editor', 'thumbnail', 'excerpt'],
        'menu_icon'   => 'dashicons-portfolio',
        'show_in_rest'=> true,
    ]);
}
add_action('init', 'pl_register_reference_post_type');

/* ── Helper: Norwegian month names for date formatting ── */
function pl_format_date_norwegian($date_string) {
    $months = ['januar','februar','mars','april','mai','juni','juli','august','september','oktober','november','desember'];
    $ts = strtotime($date_string);
    if (!$ts) return $date_string;
    return date('j', $ts) . '. ' . $months[(int)date('n', $ts) - 1] . ' ' . date('Y', $ts);
}

/* ── Helper: get a meta value with fallback through inc/defaults.php ──
   Resolution order:
     1. Saved post_meta value (if non-empty)
     2. Centralised default from inc/defaults.php
     3. Explicit $default arg (last resort, e.g. an image URL passed inline)
*/
function pl_meta($key, $default = '', $post_id = null) {
    $post_id = $post_id ?: get_the_ID();
    $val = get_post_meta($post_id, $key, true);
    if ($val !== '') return $val;
    $map_default = pl_default($key, '');
    if ($map_default !== '') return $map_default;
    return $default;
}

/* ── Helper: get a global Plamek option with default fallback ── */
function pl_opt($key, $default = '') {
    $val = get_option('pl_' . $key, '');
    return $val !== '' ? $val : $default;
}

/* ── Contact form handler ──
   Sends an email to the site admin with the form contents.
   Hooks: admin-post.php?action=pl_contact (logged-in)
          admin-post.php?action=pl_contact (anon via nopriv)
*/
function pl_handle_contact() {
    $redirect = isset($_POST['redirect_to']) ? esc_url_raw($_POST['redirect_to']) : home_url('/');

    // Nonce + honeypot
    if (!isset($_POST['pl_contact_nonce']) || !wp_verify_nonce($_POST['pl_contact_nonce'], 'pl_contact')) {
        wp_safe_redirect(add_query_arg('pl_contact', 'error', $redirect)); exit;
    }
    if (!empty($_POST['pl_hp'])) {
        wp_safe_redirect(add_query_arg('pl_contact', 'sent', $redirect)); exit; // silently drop bots
    }

    $name    = sanitize_text_field($_POST['pl_name']    ?? '');
    $phone   = sanitize_text_field($_POST['pl_phone']   ?? '');
    $email   = sanitize_email($_POST['pl_email']        ?? '');
    $company = sanitize_text_field($_POST['pl_company'] ?? '');
    $type    = sanitize_text_field($_POST['pl_project_type'] ?? '');
    $message = sanitize_textarea_field($_POST['pl_message'] ?? '');

    if (!$name || !$phone || !$email || !$type) {
        wp_safe_redirect(add_query_arg('pl_contact', 'error', $redirect)); exit;
    }

    $to      = pl_opt('email', get_option('admin_email'));
    $subject = sprintf('[plamek.no] Ny henvendelse fra %s', $name);
    $body    = "Navn: $name\nTelefon: $phone\nE-post: $email\nBedrift: $company\nTjeneste: $type\n\nMelding:\n$message\n";
    $headers = ['Reply-To: ' . $name . ' <' . $email . '>'];

    $sent = wp_mail($to, $subject, $body, $headers);
    wp_safe_redirect(add_query_arg('pl_contact', $sent ? 'sent' : 'error', $redirect));
    exit;
}
add_action('admin_post_pl_contact',        'pl_handle_contact');
add_action('admin_post_nopriv_pl_contact', 'pl_handle_contact');

/* ── Excerpt tweaks ── */
add_filter('excerpt_length', function () { return 30; });
add_filter('excerpt_more', function () { return '…'; });
