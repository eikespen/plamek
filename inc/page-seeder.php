<?php
/**
 * Page seeder
 *
 * - Runs automatically on first theme activation (creates all pages with the right templates)
 * - Sets the home page as the front page in Settings → Reading
 * - Can be re-run manually by visiting /wp-admin/?pl_seed_pages=1
 *
 * Idempotent: existing pages are left alone, only their template is fixed if missing.
 */
defined('ABSPATH') || exit;

/* ── List of pages to create ── */
function pl_seed_pages_list(): array {
    return [
        ['title' => 'Forsiden',              'slug' => 'home',                 'template' => '',                              'is_front' => true],
        ['title' => 'Tjenester',             'slug' => 'tjenester',            'template' => 'page-tjenester.php'],
        ['title' => 'Montering',             'slug' => 'montering',            'template' => 'page-montering.php'],
        ['title' => 'Vedlikehold',           'slug' => 'vedlikehold',          'template' => 'page-vedlikehold.php'],
        ['title' => 'Dukskift og isolering', 'slug' => 'dukskift-isolering',   'template' => 'page-dukskift-isolering.php'],
        ['title' => 'Flytting av hall',      'slug' => 'flytting-av-hall',     'template' => 'page-flytting-av-hall.php'],
        ['title' => 'Reparering av skader',  'slug' => 'reparering-av-skader', 'template' => 'page-reparering-av-skader.php'],
        ['title' => 'Referanser',            'slug' => 'referanser',           'template' => 'page-referanser.php'],
        ['title' => 'Nyheter',               'slug' => 'nyheter',              'template' => 'page-nyheter.php'],
        ['title' => 'Om Plamek',             'slug' => 'om-plamek',            'template' => 'page-om-plamek.php'],
        ['title' => 'Kontakt',               'slug' => 'kontakt',              'template' => 'page-kontakt.php'],
    ];
}

/* ── Core seeder — returns a log array ── */
function pl_seed_pages(): array {
    $log = [];

    foreach (pl_seed_pages_list() as $p) {
        $existing = get_page_by_path($p['slug']);

        if ($existing) {
            // Make sure the template is set correctly
            if (!empty($p['template'])) {
                $current_tpl = get_page_template_slug($existing->ID);
                if ($current_tpl !== $p['template']) {
                    update_post_meta($existing->ID, '_wp_page_template', $p['template']);
                    $log[] = "Updated template for: {$p['title']} (ID {$existing->ID})";
                } else {
                    $log[] = "OK (already exists): {$p['title']} (ID {$existing->ID})";
                }
            } else {
                $log[] = "OK (already exists): {$p['title']} (ID {$existing->ID})";
            }

            if (!empty($p['is_front'])) {
                update_option('show_on_front', 'page');
                update_option('page_on_front', $existing->ID);
                $log[] = "→ Set as front page: {$p['title']} (ID {$existing->ID})";
            }
            continue;
        }

        $post_id = wp_insert_post([
            'post_title'  => $p['title'],
            'post_name'   => $p['slug'],
            'post_status' => 'publish',
            'post_type'   => 'page',
            'post_author' => get_current_user_id() ?: 1,
        ]);

        if (is_wp_error($post_id)) {
            $log[] = "ERROR creating {$p['title']}: " . $post_id->get_error_message();
            continue;
        }

        if (!empty($p['template'])) {
            update_post_meta($post_id, '_wp_page_template', $p['template']);
        }

        if (!empty($p['is_front'])) {
            update_option('show_on_front', 'page');
            update_option('page_on_front', $post_id);
            $log[] = "Created + set as front page: {$p['title']} (ID {$post_id})";
        } else {
            $log[] = "Created: {$p['title']} (ID {$post_id}, template: {$p['template']})";
        }
    }

    // Flush rewrite rules so new slugs work immediately
    flush_rewrite_rules();

    // Mark seeder as having run so the auto-trigger doesn't fire again
    update_option('pl_pages_seeded', 1);

    return $log;
}

/* ── Auto-run on first theme activation ── */
add_action('after_switch_theme', function () {
    if (get_option('pl_pages_seeded')) return; // already done
    pl_seed_pages();
});

/* ── Manual trigger: /wp-admin/?pl_seed_pages=1 ── */
add_action('admin_init', function () {
    if (!isset($_GET['pl_seed_pages']) || !current_user_can('manage_options')) return;

    $log = pl_seed_pages();
    wp_die(
        '<h2 style="font-family:sans-serif;">Plamek — Page Seeder</h2>' .
        '<ul style="font-family:monospace;font-size:13px;line-height:1.7;">' .
        '<li>' . implode('</li><li>', array_map('esc_html', $log)) . '</li>' .
        '</ul>' .
        '<p><a href="' . esc_url(admin_url('edit.php?post_type=page')) . '">→ Go to Pages</a></p>',
        'Plamek Page Seeder'
    );
});
