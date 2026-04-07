<?php
/**
 * Template Name: Om Plamek
 */
get_header();
$pid = get_the_ID();

$h_t1   = pl_meta('pl_om_hero_title1', 'Om');
$h_t2   = pl_meta('pl_om_hero_title2', 'Plamek AS');
$h_desc = pl_meta('pl_om_hero_desc',   'Bygg, service, vedlikehold og ettermarkedsløsninger for en lang rekke markedssektorer.');
$h_img  = pl_meta('pl_om_hero_image',  get_template_directory_uri() . '/assets/images/hero-default.jpg');

$ab_title = pl_meta('pl_om_about_title',  'Montering, demontering og vedlikehold av stål - og dukhaller');
$ab_p1    = pl_meta('pl_om_about_p1',     'Plamek AS er en ledende aktør innen montering, vedlikehold og service av duk- og stålhaller. Med over 30 års erfaring i bransjen har vi opparbeidet oss unik kompetanse og et solid rykte.');
$ab_p2    = pl_meta('pl_om_about_p2',     'Vi tar oppdrag over hele landet og er kjent for vår pålitelighet, kvalitet og evne til å løse komplekse utfordringer. Vårt team består av sertifiserte montører med lang erfaring.');

$q1_title = pl_meta('pl_om_q1_title', 'Kvalitet');
$q1_desc  = pl_meta('pl_om_q1_desc',  'Topp utførelse');
$q2_title = pl_meta('pl_om_q2_title', 'Erfaring');
$q2_desc  = pl_meta('pl_om_q2_desc',  '40+ år i bransjen');

$ind_title = pl_meta('pl_om_ind_title', 'Bransjer vi betjener');
$ind_intro = pl_meta('pl_om_ind_intro', 'Vi leverer løsninger til en rekke ulike sektorer og industrier.');
$industries_defaults = [
    1 => 'Lager og logistikk',
    2 => 'Sport og fritid',
    3 => 'Luftfart',
    4 => 'Havn og marine',
    5 => 'Fiskeindustri',
    6 => 'Gjenvinning og miljø',
];
$industries = [];
for ($i = 1; $i <= 6; $i++) {
    $industries[] = pl_meta("pl_om_ind{$i}", $industries_defaults[$i]);
}

$val_title = pl_meta('pl_om_val_title', 'Våre kjerneverdier');
$val_intro = pl_meta('pl_om_val_intro', 'Fundamentet for alt vi gjør og hvordan vi jobber.');
$values_defaults = [
    1 => ['Kvalitet',     'Vi leverer alltid arbeid av høyeste kvalitet og bruker kun de beste materialene.'],
    2 => ['Samarbeid',    'Vi jobber tett med våre kunder for å finne de beste løsningene for deres behov.'],
    3 => ['Pålitelighet', 'Vi holder det vi lover og leverer til avtalt tid og pris.'],
];
$values = [];
for ($i = 1; $i <= 3; $i++) {
    $values[] = [
        'title' => pl_meta("pl_om_val{$i}_title", $values_defaults[$i][0]),
        'desc'  => pl_meta("pl_om_val{$i}_desc",  $values_defaults[$i][1]),
    ];
}

$cert_title = pl_meta('pl_om_cert_title', 'Miljøsertifisert bedrift');
$cert_text  = pl_meta('pl_om_cert_text',  'Plamek er stolt Miljøfyrtårn-sertifisert, som bekrefter vårt engasjement for bærekraftig drift og miljøansvar.');

$cta_btn = pl_meta('pl_om_cta_btn', 'Kontakt oss');
?>

<div class="min-h-screen bg-white">
    <!-- Hero -->
    <section class="relative bg-[#041024] py-16 sm:py-20 lg:py-24 pt-32 sm:pt-40 lg:pt-48">
        <div class="absolute inset-0 bg-cover bg-center opacity-30" style="background-image: url('<?php echo esc_url($h_img); ?>');"></div>
        <div class="absolute inset-0 bg-[#041024]/70"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-light text-white mb-6">
                <?php echo esc_html($h_t1); ?> <span class="font-medium"><?php echo esc_html($h_t2); ?></span>
            </h1>
            <p class="text-base sm:text-lg lg:text-xl text-white/90 leading-relaxed px-4"><?php echo esc_html($h_desc); ?></p>
        </div>
    </section>

    <!-- About content + quality badges -->
    <section class="py-16 sm:py-20 lg:py-24">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start">
                <div class="lg:col-span-2">
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-light text-[#003a76] mb-8"><?php echo esc_html($ab_title); ?></h2>
                    <div class="space-y-6 text-base sm:text-lg text-gray-700 leading-relaxed">
                        <p><?php echo esc_html($ab_p1); ?></p>
                        <p><?php echo esc_html($ab_p2); ?></p>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="bg-blue-50 rounded-lg p-6 border border-blue-100 text-center">
                        <div class="w-12 h-12 bg-[#003a76] rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        </div>
                        <h3 class="text-lg font-semibold text-[#003a76] mb-1"><?php echo esc_html($q1_title); ?></h3>
                        <p class="text-sm text-gray-600"><?php echo esc_html($q1_desc); ?></p>
                    </div>
                    <div class="bg-blue-50 rounded-lg p-6 border border-blue-100 text-center">
                        <div class="w-12 h-12 bg-[#003a76] rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                        </div>
                        <h3 class="text-lg font-semibold text-[#003a76] mb-1"><?php echo esc_html($q2_title); ?></h3>
                        <p class="text-sm text-gray-600"><?php echo esc_html($q2_desc); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Industries -->
    <section class="py-16 sm:py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 sm:mb-16">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-light text-[#003a76] mb-4"><?php echo esc_html($ind_title); ?></h2>
                <p class="text-base sm:text-lg text-gray-600 max-w-3xl mx-auto"><?php echo esc_html($ind_intro); ?></p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 sm:gap-6">
                <?php foreach ($industries as $name) : if (!$name) continue; ?>
                    <div class="bg-white rounded-lg p-6 text-center shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-[#003a76]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                        <p class="text-sm font-medium text-[#041024]"><?php echo esc_html($name); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Values -->
    <section class="py-16 sm:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 sm:mb-16">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-light text-[#003a76] mb-4"><?php echo esc_html($val_title); ?></h2>
                <p class="text-base sm:text-lg text-gray-600 max-w-3xl mx-auto"><?php echo esc_html($val_intro); ?></p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <?php foreach ($values as $v) : if (!$v['title']) continue; ?>
                    <div class="text-center">
                        <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-[#003a76]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        </div>
                        <h3 class="text-xl font-medium text-[#041024] mb-3"><?php echo esc_html($v['title']); ?></h3>
                        <p class="text-gray-600 text-sm leading-relaxed"><?php echo esc_html($v['desc']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Certification -->
    <section class="py-16 sm:py-20 bg-green-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="w-16 h-16 bg-green-600 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h2 class="text-2xl sm:text-3xl font-light text-[#003a76] mb-4"><?php echo esc_html($cert_title); ?></h2>
            <p class="text-base sm:text-lg text-gray-700 leading-relaxed max-w-2xl mx-auto"><?php echo esc_html($cert_text); ?></p>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-16 sm:py-20 bg-[#003a76]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl sm:text-4xl font-light text-white mb-6">Ta gjerne kontakt med oss</h2>
            <a href="<?php echo esc_url(home_url('/kontakt')); ?>" class="inline-block bg-white text-[#003a76] hover:bg-gray-100 px-8 py-4 text-lg font-medium rounded-lg transition-colors"><?php echo esc_html($cta_btn); ?> →</a>
        </div>
    </section>
</div>

<?php get_footer(); ?>
