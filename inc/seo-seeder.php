<?php
/**
 * Yoast SEO seeder.
 *
 * Pre-populates Yoast SEO meta (title, meta description, focus keyword,
 * Open Graph, Twitter) for every Plamek page so SEO is good out of the box.
 *
 * - Auto-runs once when the theme is activated (after Yoast is also active)
 * - Manual re-run: /wp-admin/?pl_seed_seo=1 (admin only)
 * - Idempotent: only writes Yoast keys that are currently empty, so manual
 *   edits in the Yoast UI are never overwritten.
 *
 * Stores values directly in WP postmeta — no Yoast API dependency.
 */
defined('ABSPATH') || exit;

/* ── Per-page SEO defaults ── */
function pl_seo_defaults(): array {
    return [
        // slug => [title, meta description, focus keyword]
        'home' => [
            'title'    => 'Plamek — Norges største på montering og vedlikehold av haller',
            'metadesc' => 'Plamek monterer, demonterer, flytter og vedlikeholder duk- og stålhaller over hele Norge. Over 40 års erfaring. Be om et uforpliktende tilbud i dag.',
            'focuskw'  => 'montering av haller',
        ],
        'tjenester' => [
            'title'    => 'Våre tjenester — montering, vedlikehold og flytting av haller | Plamek',
            'metadesc' => 'Komplett service for montering, vedlikehold og flytting av duk- og stålhaller. Plamek leverer profesjonelle løsninger over hele Norge.',
            'focuskw'  => 'tjenester for haller',
        ],
        'montering' => [
            'title'    => 'Montering og demontering av haller | Plamek',
            'metadesc' => 'Plamek monterer og demonterer alle typer dukhaller, plasthaller og stålhaller over hele Norge. Sertifiserte fagfolk og 40+ års erfaring.',
            'focuskw'  => 'montering av hall',
        ],
        'vedlikehold' => [
            'title'    => 'Serviceavtale og vedlikehold av haller | Plamek',
            'metadesc' => 'Skreddersydd serviceavtale fra Plamek reduserer risikoen for uforutsette kostnader og driftsstans. Vedlikehold av duk- og stålhaller i hele Norge.',
            'focuskw'  => 'vedlikehold av hall',
        ],
        'dukskift-isolering' => [
            'title'    => 'Dukskift og isolering av hall | Plamek',
            'metadesc' => 'Vi bytter hele eller deler av duken på din hall, og tilbyr profesjonell isolering. Lengre levetid og bedre energiøkonomi.',
            'focuskw'  => 'dukskift på hall',
        ],
        'flytting-av-hall' => [
            'title'    => 'Flytting av hall — sikker demontering, transport og montering | Plamek',
            'metadesc' => 'Plamek flytter alle typer haller i hele Norge. Profesjonell demontering, transport og ny montering. Be om et uforpliktende tilbud.',
            'focuskw'  => 'flytting av hall',
        ],
        'reparering-av-skader' => [
            'title'    => 'Reparering av skader på hall | Plamek',
            'metadesc' => 'Vi reparerer alle typer skader på dukhaller og stålhaller — rifter, hull, værskader og konstruksjonsskader. Rask respons over hele Norge.',
            'focuskw'  => 'reparering av hall',
        ],
        'om-plamek' => [
            'title'    => 'Om Plamek — 40+ års erfaring med haller',
            'metadesc' => 'Plamek har over 40 års erfaring med montering, vedlikehold og flytting av haller. Vi bistår kunder i mange ulike bransjer over hele Norge.',
            'focuskw'  => 'om Plamek',
        ],
        'kontakt' => [
            'title'    => 'Kontakt Plamek — be om et uforpliktende tilbud',
            'metadesc' => 'Ta kontakt med Plamek for et uforpliktende tilbud på montering, vedlikehold, dukskift, reparasjon eller flytting av hall. Vi svarer innen 24 timer.',
            'focuskw'  => 'kontakt Plamek',
        ],
        'referanser' => [
            'title'    => 'Referanser — våre prosjekter | Plamek',
            'metadesc' => 'Se et utvalg av våre prosjekter med montering, vedlikehold og reparasjon av haller for kunder over hele Norge.',
            'focuskw'  => 'referanser haller',
        ],
        'nyheter' => [
            'title'    => 'Nyheter fra Plamek — siste prosjekter og bransjenytt',
            'metadesc' => 'Siste nytt fra Plamek — prosjekter, milepæler og bransjenyheter innen montering og vedlikehold av duk- og stålhaller.',
            'focuskw'  => 'nyheter Plamek',
        ],
    ];
}

/* ── Core seeder ── */
function pl_seed_yoast_seo(): array {
    $log = [];

    if (!defined('WPSEO_VERSION') && !class_exists('WPSEO_Options')) {
        $log[] = '⚠ Yoast SEO is not active. Activate the plugin first, then re-run.';
        return $log;
    }

    foreach (pl_seo_defaults() as $slug => $seo) {
        $page = get_page_by_path($slug);
        if (!$page) {
            $log[] = "SKIP (page not found): $slug";
            continue;
        }

        $pid     = $page->ID;
        $changes = [];

        // Only set values that are currently empty — never overwrite manual edits
        $fields = [
            '_yoast_wpseo_title'                  => $seo['title'],
            '_yoast_wpseo_metadesc'               => $seo['metadesc'],
            '_yoast_wpseo_focuskw'                => $seo['focuskw'],
            '_yoast_wpseo_opengraph-title'        => $seo['title'],
            '_yoast_wpseo_opengraph-description'  => $seo['metadesc'],
            '_yoast_wpseo_twitter-title'          => $seo['title'],
            '_yoast_wpseo_twitter-description'    => $seo['metadesc'],
        ];

        foreach ($fields as $key => $value) {
            $current = get_post_meta($pid, $key, true);
            if ($current === '' || $current === null) {
                update_post_meta($pid, $key, $value);
                $changes[] = str_replace('_yoast_wpseo_', '', $key);
            }
        }

        if (!empty($changes)) {
            $log[] = "Seeded [$slug] (id $pid): " . implode(', ', $changes);
        } else {
            $log[] = "OK (already filled): $slug (id $pid)";
        }
    }

    update_option('pl_yoast_seo_seeded', 1);
    return $log;
}

/* ── Auto-run once on theme activation (after Yoast becomes available) ── */
add_action('after_switch_theme', function () {
    if (get_option('pl_yoast_seo_seeded')) return;
    // Defer until plugins are loaded so we can detect Yoast
    add_action('admin_init', function () {
        if (get_option('pl_yoast_seo_seeded')) return;
        if (!defined('WPSEO_VERSION') && !class_exists('WPSEO_Options')) return;
        pl_seed_yoast_seo();
    });
});

/* ── Manual trigger ── */
add_action('admin_init', function () {
    if (!isset($_GET['pl_seed_seo']) || !current_user_can('manage_options')) return;

    $log = pl_seed_yoast_seo();
    wp_die(
        '<h2 style="font-family:sans-serif;">Plamek — Yoast SEO Seeder</h2>' .
        '<ul style="font-family:monospace;font-size:13px;line-height:1.7;max-width:900px;">' .
        '<li>' . implode('</li><li>', array_map('esc_html', $log)) . '</li>' .
        '</ul>' .
        '<p><a href="' . esc_url(admin_url('edit.php?post_type=page')) . '">→ Pages</a></p>',
        'Plamek SEO Seeder'
    );
});
