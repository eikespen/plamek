<?php
/**
 * Native WordPress meta boxes for editable page content.
 * No plugin required — uses add_meta_box() + get/update_post_meta().
 *
 * Conventions:
 *  - All meta keys are prefixed with pl_<page>_<field>
 *  - Templates read with pl_meta('pl_…', 'default')
 */
defined('ABSPATH') || exit;

/* ── Admin CSS for the meta boxes ── */
add_action('admin_head', function () {
    $screen = get_current_screen();
    if (!$screen || $screen->base !== 'post' || $screen->post_type !== 'page') return;
    ?>
    <style>
    .pl-section {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-left: 4px solid #003a76;
        border-radius: 6px;
        padding: 16px 18px;
        margin-bottom: 14px;
    }
    .pl-section-title {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: #003a76;
        margin: 0 0 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .pl-section-title .pl-badge {
        display: inline-block;
        width: 22px; height: 22px;
        background: #003a76; color: #fff;
        border-radius: 4px;
        font-size: 12px; line-height: 22px;
        text-align: center;
    }
    .pl-grid   { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
    .pl-grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 12px; }
    .pl-grid-4 { display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; gap: 12px; }
    .pl-field  { margin: 0; }
    .pl-field label {
        display: block;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #646970;
        margin-bottom: 5px;
    }
    .pl-field input[type="text"],
    .pl-field input[type="url"],
    .pl-field textarea {
        width: 100%;
        border: 1px solid #dcdcde;
        border-radius: 4px;
        padding: 8px 10px;
        font-size: 13px;
        line-height: 1.5;
        color: #1d2327;
        background: #fff;
        box-sizing: border-box;
        transition: border-color .15s, box-shadow .15s;
    }
    .pl-field input:focus, .pl-field textarea:focus {
        border-color: #003a76;
        outline: none;
        box-shadow: 0 0 0 1px #003a76;
    }
    .pl-field textarea { resize: vertical; min-height: 72px; }
    .pl-divider {
        border: none;
        border-top: 1px solid #e2e8f0;
        margin: 14px 0;
    }
    </style>
    <?php
});

/* ════════════════════════════════════════════
   RENDER HELPERS
════════════════════════════════════════════ */
function pl_section_start($icon, $title) {
    echo '<div class="pl-section"><p class="pl-section-title"><span class="pl-badge">' . esc_html($icon) . '</span>' . esc_html($title) . '</p>';
}
function pl_section_end()  { echo '</div>'; }
function pl_grid_start($cols = 2) {
    $class = $cols === 4 ? 'pl-grid-4' : ($cols === 3 ? 'pl-grid-3' : 'pl-grid');
    echo '<div class="' . $class . '">';
}
function pl_grid_end() { echo '</div>'; }
function pl_divider()  { echo '<hr class="pl-divider">'; }

function pl_field($post, $key, $label, $type = 'text', $default = '') {
    $val = get_post_meta($post->ID, $key, true);
    if ($val === '') $val = $default;
    echo '<p class="pl-field"><label for="' . esc_attr($key) . '">' . esc_html($label) . '</label>';
    if ($type === 'textarea') {
        echo '<textarea id="' . esc_attr($key) . '" name="' . esc_attr($key) . '" rows="3">' . esc_textarea($val) . '</textarea>';
    } elseif ($type === 'url') {
        echo '<input type="url" id="' . esc_attr($key) . '" name="' . esc_attr($key) . '" value="' . esc_attr($val) . '">';
    } else {
        echo '<input type="text" id="' . esc_attr($key) . '" name="' . esc_attr($key) . '" value="' . esc_attr($val) . '">';
    }
    echo '</p>';
}

/* ════════════════════════════════════════════
   REGISTER META BOXES
════════════════════════════════════════════ */
add_action('add_meta_boxes_page', function ($post) {
    $slug     = $post->post_name;
    $front_id = (int) get_option('page_on_front');

    $map = [
        'home'                  => ['pl_mb_frontpage',  'Forside — Innhold'],
        'tjenester'             => ['pl_mb_tjenester',  'Tjenester — Innhold'],
        'montering'             => ['pl_mb_service',    'Montering — Innhold'],
        'vedlikehold'           => ['pl_mb_service',    'Vedlikehold — Innhold'],
        'dukskift-isolering'    => ['pl_mb_service',    'Dukskift og isolering — Innhold'],
        'flytting-av-hall'      => ['pl_mb_service',    'Flytting av hall — Innhold'],
        'reparering-av-skader'  => ['pl_mb_service',    'Reparering av skader — Innhold'],
        'om-plamek'             => ['pl_mb_om',         'Om Plamek — Innhold'],
        'kontakt'               => ['pl_mb_kontakt',    'Kontakt — Innhold'],
        'referanser'            => ['pl_mb_simple_hero','Referanser — Hero'],
        'nyheter'               => ['pl_mb_simple_hero','Nyheter — Hero'],
    ];

    if ($post->ID === $front_id) {
        add_meta_box('pl_mb_front', 'Forside — Innhold', 'pl_mb_frontpage', 'page', 'normal', 'high');
        return;
    }

    if (isset($map[$slug])) {
        list($cb, $title) = $map[$slug];
        add_meta_box('pl_mb_' . $slug, $title, $cb, 'page', 'normal', 'high');
    }
});

/* ════════════════════════════════════════════
   FRONT PAGE
════════════════════════════════════════════ */
function pl_mb_frontpage($post) {
    wp_nonce_field('pl_page_meta', 'pl_page_nonce');

    pl_section_start('✦', 'Hero');
        pl_grid_start();
            pl_field($post, 'pl_home_hero_title1',  'Tittel — linje 1',  'text',     'Norges største');
            pl_field($post, 'pl_home_hero_title2',  'Tittel — linje 2',  'text',     'på montering og vedlikehold');
        pl_grid_end();
        pl_field($post, 'pl_home_hero_desc', 'Beskrivelse', 'textarea', 'Montering, service og vedlikehold av stålhaller og dukhaller.');
        pl_grid_start();
            pl_field($post, 'pl_home_hero_btn1_text', 'Knapp 1 — tekst', 'text', 'VÅRE TJENESTER');
            pl_field($post, 'pl_home_hero_btn1_link', 'Knapp 1 — lenke', 'text', '/tjenester');
        pl_grid_end();
        pl_grid_start();
            pl_field($post, 'pl_home_hero_btn2_text', 'Knapp 2 — tekst', 'text', 'RING 70 00 86 04');
            pl_field($post, 'pl_home_hero_btn2_link', 'Knapp 2 — lenke', 'text', 'tel:+4770008604');
        pl_grid_end();
        pl_divider();
        echo '<p class="description">Bilder i hero-slideren — bruk fulle URL-er. La stå tom for å bruke standardbildene.</p>';
        for ($i = 1; $i <= 5; $i++) {
            pl_field($post, "pl_home_hero_image_{$i}", "Slide $i — bilde-URL", 'url', '');
        }
    pl_section_end();

    pl_section_start('◈', 'Tjenester (3 kort)');
        pl_grid_start();
            pl_field($post, 'pl_home_services_title', 'Seksjonstittel', 'text',     'Vi tilbyr');
            pl_field($post, 'pl_home_services_intro', 'Ingress',        'textarea', 'Montering, demontering, flytting og vedlikehold av duk- og stålhaller');
        pl_grid_end();
        pl_divider();

        $defaults = [
            1 => ['Montering',           'Trenger du å montere eller demontere en hall? Vi utfører montering og demontering på alle typer dukhaller og stålhaller over hele landet.', '/montering'],
            2 => ['Vedlikehold',         'Vi tilbyr service og vedlikehold av alle typer duk- og stålhaller. Med våre serviceavtaler sikrer du at hallen din holder seg i topp stand.', '/vedlikehold'],
            3 => ['Dukskift og isolering','Vi bytter hele eller deler av duken på haller. Vi tilbyr også mange løsninger på isolerte haller.',                                          '/dukskift-isolering'],
        ];
        for ($i = 1; $i <= 3; $i++) {
            if ($i > 1) pl_divider();
            pl_grid_start();
                pl_field($post, "pl_home_card{$i}_title", "Kort $i — tittel", 'text',     $defaults[$i][0]);
                pl_field($post, "pl_home_card{$i}_link",  "Kort $i — lenke",  'text',     $defaults[$i][2]);
            pl_grid_end();
            pl_field($post, "pl_home_card{$i}_desc",  "Kort $i — beskrivelse", 'textarea', $defaults[$i][1]);
            pl_field($post, "pl_home_card{$i}_image", "Kort $i — bilde-URL",   'url',      '');
        }
    pl_section_end();

    pl_section_start('#', 'Statistikk (4 tall)');
        pl_grid_start(4);
            pl_field($post, 'pl_home_stat1_num', 'Tall 1', 'text', '1681');
            pl_field($post, 'pl_home_stat2_num', 'Tall 2', 'text', '200');
            pl_field($post, 'pl_home_stat3_num', 'Tall 3', 'text', '20796');
            pl_field($post, 'pl_home_stat4_num', 'Tall 4', 'text', '375');
        pl_grid_end();
        pl_grid_start(4);
            pl_field($post, 'pl_home_stat1_label', 'Etikett 1', 'text', 'Monterte dukhaller');
            pl_field($post, 'pl_home_stat2_label', 'Etikett 2', 'text', 'Stålbygg montert');
            pl_field($post, 'pl_home_stat3_label', 'Etikett 3', 'text', 'Servicer utført');
            pl_field($post, 'pl_home_stat4_label', 'Etikett 4', 'text', 'Dukhaller flyttet');
        pl_grid_end();
    pl_section_end();

    pl_section_start('✉', 'Kontakt-CTA');
        pl_grid_start();
            pl_field($post, 'pl_home_cta_title', 'Tittel', 'text',     'Klar for å starte ditt prosjekt?');
            pl_field($post, 'pl_home_cta_intro', 'Ingress', 'textarea', 'Kontakt oss i dag for en uforpliktende samtale om dine behov');
        pl_grid_end();
    pl_section_end();
}

/* ════════════════════════════════════════════
   TJENESTER (services overview)
════════════════════════════════════════════ */
function pl_mb_tjenester($post) {
    wp_nonce_field('pl_page_meta', 'pl_page_nonce');

    pl_section_start('✦', 'Hero');
        pl_grid_start();
            pl_field($post, 'pl_tj_hero_title1',  'Tittel del 1',  'text', 'Våre');
            pl_field($post, 'pl_tj_hero_title2',  'Tittel del 2',  'text', 'tjenester');
        pl_grid_end();
        pl_field($post, 'pl_tj_hero_desc',  'Beskrivelse',     'textarea', 'Vi leverer komplette løsninger for duk- og stålhaller i hele Norge.');
        pl_field($post, 'pl_tj_hero_image', 'Hero-bilde URL',  'url', '');
    pl_section_end();

    pl_section_start('◈', 'Tjenestekort (6 stk)');
        $defaults = [
            1 => ['Montering og demontering',     'Plamek monterer, demonterer og flytter alle typer duk- og stålhaller.',                                  '/montering'],
            2 => ['Flytting av hall',             'Vi flytter alle typer haller i hele landet!',                                                              '/flytting-av-hall'],
            3 => ['Serviceavtale / vedlikehold',  'En serviceavtale med Plamek AS reduserer risikoen for uforutsette kostnader og driftsstans i bygget.',     '/vedlikehold'],
            4 => ['Dukskift og isolering av hall','Har bygningen behov for skift av duk?',                                                                    '/dukskift-isolering'],
            5 => ['Reparering av skader på hall', 'Har hallen din fått en skade? Vi reparerer alle slags skader på dukhaller.',                               '/reparering-av-skader'],
            6 => ['Kontakt!',                     'Har du spørsmål om våre tjenester eller ønsker et tilbud?',                                                '/kontakt'],
        ];
        for ($i = 1; $i <= 6; $i++) {
            if ($i > 1) pl_divider();
            pl_grid_start();
                pl_field($post, "pl_tj_card{$i}_title", "Kort $i — tittel", 'text', $defaults[$i][0]);
                pl_field($post, "pl_tj_card{$i}_link",  "Kort $i — lenke",  'text', $defaults[$i][2]);
            pl_grid_end();
            pl_field($post, "pl_tj_card{$i}_desc",  "Kort $i — beskrivelse", 'textarea', $defaults[$i][1]);
        }
    pl_section_end();

    pl_section_start('★', 'Hvorfor velge Plamek (4 fordeler)');
        pl_grid_start();
            pl_field($post, 'pl_tj_benefits_title', 'Seksjonstittel', 'text',     'Hvorfor velge Plamek?');
            pl_field($post, 'pl_tj_benefits_intro', 'Ingress',        'textarea', 'Vi er din trygge partner på alt som omhandler duk- og stålhaller.');
        pl_grid_end();
        pl_divider();

        $bdef = [
            1 => ['30+ års erfaring',     'Lang erfaring med alle typer monteringsprosjekter gir oss kompetanse til å løse de mest utfordrende oppdragene.'],
            2 => ['Høy kvalitet',         'Vi setter kvalitet i høysetet og bruker kun materialer og metoder som sikrer lang levetid og pålitelighet.'],
            3 => ['HMS-fokus',            'Sikkerhet kommer først. All vårt personell er HMS-sertifisert og følger strenge sikkerhetsprosedyrer.'],
            4 => ['Pålitelige leveranser','Vi holder avtaler og frister. Våre kunder kan stole på at prosjektet blir ferdig til avtalt tid.'],
        ];
        for ($i = 1; $i <= 4; $i++) {
            if ($i > 1) pl_divider();
            pl_field($post, "pl_tj_benefit{$i}_title", "Fordel $i — tittel", 'text',     $bdef[$i][0]);
            pl_field($post, "pl_tj_benefit{$i}_desc",  "Fordel $i — tekst",  'textarea', $bdef[$i][1]);
        }
    pl_section_end();

    pl_section_start('→', 'CTA');
        pl_grid_start();
            pl_field($post, 'pl_tj_cta_title',    'Tittel',       'text', 'Klar for å starte prosjektet?');
            pl_field($post, 'pl_tj_cta_btn_text', 'Knapptekst',   'text', 'Kontakt oss');
        pl_grid_end();
        pl_field($post, 'pl_tj_cta_text', 'Beskrivelse', 'textarea', 'Ta kontakt for en uforpliktende prat om dine behov.');
    pl_section_end();
}

/* ════════════════════════════════════════════
   GENERIC SERVICE PAGE (montering, vedlikehold, dukskift, flytting, reparering)
   All five share the same structure: hero + intro + 4 feature cards + CTA
════════════════════════════════════════════ */
function pl_mb_service($post) {
    wp_nonce_field('pl_page_meta', 'pl_page_nonce');

    pl_section_start('✦', 'Hero');
        pl_grid_start();
            pl_field($post, 'pl_sv_hero_title1', 'Tittel del 1', 'text', '');
            pl_field($post, 'pl_sv_hero_title2', 'Tittel del 2 (uthevet)', 'text', '');
        pl_grid_end();
        pl_field($post, 'pl_sv_hero_desc',  'Beskrivelse',    'textarea', '');
        pl_field($post, 'pl_sv_hero_image', 'Hero-bilde URL', 'url',      '');
    pl_section_end();

    pl_section_start('¶', 'Introtekst');
        pl_field($post, 'pl_sv_intro_title', 'Overskrift',  'text',     '');
        pl_field($post, 'pl_sv_intro_body',  'Brødtekst',   'textarea', '');
    pl_section_end();

    pl_section_start('◈', 'Funksjoner / fordeler (4 kort)');
        for ($i = 1; $i <= 4; $i++) {
            if ($i > 1) pl_divider();
            pl_field($post, "pl_sv_feat{$i}_title", "Kort $i — tittel", 'text',     '');
            pl_field($post, "pl_sv_feat{$i}_desc",  "Kort $i — tekst",  'textarea', '');
        }
    pl_section_end();

    pl_section_start('→', 'CTA');
        pl_grid_start();
            pl_field($post, 'pl_sv_cta_title',    'Tittel',     'text', 'Klar for å starte prosjektet?');
            pl_field($post, 'pl_sv_cta_btn_text', 'Knapptekst', 'text', 'Kontakt oss');
        pl_grid_end();
        pl_field($post, 'pl_sv_cta_text', 'Beskrivelse', 'textarea', 'Ta kontakt for en uforpliktende prat om dine behov.');
    pl_section_end();
}

/* ════════════════════════════════════════════
   OM PLAMEK
════════════════════════════════════════════ */
function pl_mb_om($post) {
    wp_nonce_field('pl_page_meta', 'pl_page_nonce');

    pl_section_start('✦', 'Hero');
        pl_grid_start();
            pl_field($post, 'pl_om_hero_title1', 'Tittel del 1', 'text', 'Om');
            pl_field($post, 'pl_om_hero_title2', 'Tittel del 2 (uthevet)', 'text', 'Plamek AS');
        pl_grid_end();
        pl_field($post, 'pl_om_hero_desc',  'Beskrivelse', 'textarea', 'Bygg, service, vedlikehold og ettermarkedsløsninger');
        pl_field($post, 'pl_om_hero_image', 'Hero-bilde URL', 'url', '');
    pl_section_end();

    pl_section_start('¶', 'Om oss — innhold');
        pl_field($post, 'pl_om_about_title',  'Overskrift',   'text',     'Om Plamek AS');
        pl_field($post, 'pl_om_about_body_1', 'Avsnitt 1',    'textarea', '');
        pl_field($post, 'pl_om_about_body_2', 'Avsnitt 2',    'textarea', '');
        pl_field($post, 'pl_om_about_body_3', 'Avsnitt 3',    'textarea', '');
    pl_section_end();

    pl_section_start('★', 'Verdier (4 kort)');
        $vdef = [
            1 => ['Erfaring',  '30+ års erfaring med duk- og stålhaller'],
            2 => ['Kvalitet',  'Vi leverer alltid arbeid av høy kvalitet'],
            3 => ['Sikkerhet', 'HMS er en grunnpilar i alt vi gjør'],
            4 => ['Service',   'Vi er der for våre kunder, før, under og etter prosjektet'],
        ];
        for ($i = 1; $i <= 4; $i++) {
            if ($i > 1) pl_divider();
            pl_field($post, "pl_om_value{$i}_title", "Verdi $i — tittel", 'text',     $vdef[$i][0]);
            pl_field($post, "pl_om_value{$i}_desc",  "Verdi $i — tekst",  'textarea', $vdef[$i][1]);
        }
    pl_section_end();

    pl_section_start('→', 'CTA');
        pl_grid_start();
            pl_field($post, 'pl_om_cta_title',    'Tittel',     'text', 'Vil du vite mer?');
            pl_field($post, 'pl_om_cta_btn_text', 'Knapptekst', 'text', 'Kontakt oss');
        pl_grid_end();
        pl_field($post, 'pl_om_cta_text', 'Beskrivelse', 'textarea', 'Ta kontakt for en uforpliktende prat.');
    pl_section_end();
}

/* ════════════════════════════════════════════
   KONTAKT
════════════════════════════════════════════ */
function pl_mb_kontakt($post) {
    wp_nonce_field('pl_page_meta', 'pl_page_nonce');

    pl_section_start('✦', 'Hero');
        pl_grid_start();
            pl_field($post, 'pl_kt_hero_title1', 'Tittel del 1', 'text', 'Kontakt');
            pl_field($post, 'pl_kt_hero_title2', 'Tittel del 2 (uthevet)', 'text', 'oss');
        pl_grid_end();
        pl_field($post, 'pl_kt_hero_desc', 'Beskrivelse', 'textarea', 'Ta kontakt med oss for spørsmål, tilbud eller en uforpliktende prat.');
    pl_section_end();

    pl_section_start('☎', 'Kontaktinformasjon');
        pl_grid_start();
            pl_field($post, 'pl_kt_addr_title', 'Adresse — tittel', 'text', 'Besøksadresse');
            pl_field($post, 'pl_kt_addr_text',  'Adresse — tekst',  'textarea', "Sundvollhovet\nN-3535 Krøderen");
        pl_grid_end();
        pl_grid_start();
            pl_field($post, 'pl_kt_phone_title', 'Telefon — tittel', 'text', 'Telefon');
            pl_field($post, 'pl_kt_phone_text',  'Telefon — nummer', 'text', '+47 70 00 86 04');
        pl_grid_end();
        pl_grid_start();
            pl_field($post, 'pl_kt_email_title', 'E-post — tittel', 'text', 'E-post');
            pl_field($post, 'pl_kt_email_text',  'E-post — adresse', 'text', 'post@plamek.no');
        pl_grid_end();
        pl_grid_start();
            pl_field($post, 'pl_kt_hours_title', 'Åpningstider — tittel', 'text', 'Åpningstider');
            pl_field($post, 'pl_kt_hours_text',  'Åpningstider — tekst',  'textarea', "Mandag–fredag: 08:00–16:00\nLørdag–søndag: stengt");
        pl_grid_end();
    pl_section_end();

    pl_section_start('✉', 'Kontaktskjema');
        pl_field($post, 'pl_kt_form_title', 'Skjema — overskrift', 'text', 'Send oss en melding');
        pl_field($post, 'pl_kt_form_intro', 'Skjema — ingress',    'textarea', 'Vi svarer normalt innen 24 timer.');
    pl_section_end();
}

/* ════════════════════════════════════════════
   SIMPLE HERO (referanser, nyheter)
════════════════════════════════════════════ */
function pl_mb_simple_hero($post) {
    wp_nonce_field('pl_page_meta', 'pl_page_nonce');

    pl_section_start('✦', 'Hero');
        pl_grid_start();
            pl_field($post, 'pl_simple_hero_title1', 'Tittel del 1', 'text', '');
            pl_field($post, 'pl_simple_hero_title2', 'Tittel del 2 (uthevet)', 'text', '');
        pl_grid_end();
        pl_field($post, 'pl_simple_hero_desc',  'Beskrivelse',    'textarea', '');
        pl_field($post, 'pl_simple_hero_image', 'Hero-bilde URL', 'url',      '');
    pl_section_end();
}

/* ════════════════════════════════════════════
   SAVE HANDLER
════════════════════════════════════════════ */
add_action('save_post_page', function ($post_id) {
    if (!isset($_POST['pl_page_nonce']) || !wp_verify_nonce($_POST['pl_page_nonce'], 'pl_page_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    // Save every $_POST field that starts with pl_ (these are all our meta box fields)
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'pl_') !== 0) continue;
        if ($key === 'pl_page_nonce')   continue;
        if (is_array($value)) continue;
        update_post_meta($post_id, $key, sanitize_textarea_field(wp_unslash($value)));
    }
});
