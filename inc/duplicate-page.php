<?php
/**
 * Duplicate page action
 *
 * Adds a "Dupliser" link in the row actions of the Pages list.
 * Clicking it copies the page (title + " — kopi"), all pl_* postmeta,
 * the assigned page template and the featured image. The new page is
 * saved as a draft so the editor can rename it before publishing.
 */
defined('ABSPATH') || exit;

/* ── Add the "Dupliser" link to the Pages row actions ── */
function pl_add_duplicate_row_action($actions, $post) {
    if ($post->post_type !== 'page') {
        return $actions;
    }
    if (!current_user_can('edit_pages')) {
        return $actions;
    }

    $url = wp_nonce_url(
        admin_url('admin-post.php?action=pl_duplicate_page&post=' . $post->ID),
        'pl_duplicate_page_' . $post->ID
    );
    $actions['pl_duplicate'] = '<a href="' . esc_url($url) . '" title="Lag en kopi av denne siden">Dupliser</a>';
    return $actions;
}
add_filter('page_row_actions', 'pl_add_duplicate_row_action', 10, 2);

/* ── Handler ── */
function pl_handle_duplicate_page() {
    $source_id = 0;
    if (isset($_GET['post'])) {
        $source_id = absint($_GET['post']);
    }
    if (!$source_id) {
        wp_die('Missing post id');
    }

    check_admin_referer('pl_duplicate_page_' . $source_id);

    if (!current_user_can('edit_pages')) {
        wp_die('Insufficient permissions');
    }

    $source = get_post($source_id);
    if (!$source || $source->post_type !== 'page') {
        wp_die('Source page not found');
    }

    $new_args = array(
        'post_title'   => $source->post_title . ' — kopi',
        'post_content' => $source->post_content,
        'post_excerpt' => $source->post_excerpt,
        'post_status'  => 'draft',
        'post_type'    => 'page',
        'post_author'  => get_current_user_id() ? get_current_user_id() : $source->post_author,
        'post_parent'  => $source->post_parent,
        'menu_order'   => $source->menu_order,
    );

    $new_id = wp_insert_post($new_args, true);

    if (is_wp_error($new_id)) {
        wp_die('Error creating duplicate: ' . $new_id->get_error_message());
    }

    // Copy all post meta. WP returns each value pre-serialised; pass it
    // through update_post_meta which handles the format on its own.
    $meta = get_post_meta($source_id);
    $skip_keys = array('_edit_lock', '_edit_last');
    foreach ($meta as $key => $values) {
        if (in_array($key, $skip_keys, true)) {
            continue;
        }
        foreach ($values as $value) {
            add_post_meta($new_id, $key, wp_slash($value));
        }
    }

    // Copy the featured image
    $thumb_id = get_post_thumbnail_id($source_id);
    if ($thumb_id) {
        set_post_thumbnail($new_id, $thumb_id);
    }

    wp_safe_redirect(admin_url('post.php?action=edit&post=' . $new_id));
    exit;
}
add_action('admin_post_pl_duplicate_page', 'pl_handle_duplicate_page');
