<?php
/**
 * Template Name: Om Plamek
 */
get_header();
$pid = get_the_ID();

// Hero
$h_t1   = pl_meta('pl_om_hero_title1', 'Om');
$h_t2   = pl_meta('pl_om_hero_title2', 'Plamek AS');
$h_desc = pl_meta('pl_om_hero_desc',   'Bygg, service, vedlikehold og ettermarkedsløsninger for en lang rekke markedssektorer.');
$h_img  = pl_meta('pl_om_hero_image',  get_template_directory_uri() . '/assets/images/tjenester.webp');

// About ("Hvem er vi?")
$ab_title    = pl_meta('pl_om_about_title',    'Hvem er');
$ab_subtitle = pl_meta('pl_om_about_subtitle', 'vi?');
$ab_p1 = pl_meta('pl_om_about_p1', '');
$ab_p2 = pl_meta('pl_om_about_p2', '');
$ab_p3 = pl_meta('pl_om_about_p3', '');

// Services
$sv_title    = pl_meta('pl_om_serv_title',    'Montering, demontering og');
$sv_subtitle = pl_meta('pl_om_serv_subtitle', 'flytting av haller');
$sv_p1 = pl_meta('pl_om_serv_p1', '');
$sv_p2 = pl_meta('pl_om_serv_p2', '');

// Quality / Safety / Workplace
$q_title    = pl_meta('pl_om_quality_title',    'Kvalitet og');
$q_subtitle = pl_meta('pl_om_quality_subtitle', 'sikkerhet');
$safety_title = pl_meta('pl_om_safety_title', 'Sikkerhet i fokus');
$safety_p1    = pl_meta('pl_om_safety_p1',    '');
$safety_p2    = pl_meta('pl_om_safety_p2',    '');
$wp_title = pl_meta('pl_om_workplace_title', 'Gode arbeidsplasser');
$wp_p1    = pl_meta('pl_om_workplace_p1',    '');
$wp_p2    = pl_meta('pl_om_workplace_p2',    '');

// Industries
$ind_title    = pl_meta('pl_om_ind_title',    'Varierte');
$ind_subtitle = pl_meta('pl_om_ind_subtitle', 'bransjer');
$ind_intro    = pl_meta('pl_om_ind_intro',    'Vi jobber i mange ulike bransjer, blant annet:');
$industries = [];
for ($i = 1; $i <= 6; $i++) {
    $name = pl_meta("pl_om_ind{$i}", '');
    if ($name !== '') $industries[] = $name;
}

// Cert
$cert_title = pl_meta('pl_om_cert_title', 'Miljøsertifisert bedrift');
$cert_text  = pl_meta('pl_om_cert_text',  '');
$cta_btn    = pl_meta('pl_om_cta_btn',    'Kontakt oss');
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

    <!-- Hvem er vi? -->
    <section class="py-16 sm:py-20 lg:py-24">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-light text-[#003a76] mb-8 text-center">
                <?php echo esc_html($ab_title); ?> <span class="font-medium"><?php echo esc_html($ab_subtitle); ?></span>
            </h2>
            <div class="space-y-6 text-base sm:text-lg text-gray-700 leading-relaxed">
                <?php if ($ab_p1) : ?><p><?php echo esc_html($ab_p1); ?></p><?php endif; ?>
                <?php if ($ab_p2) : ?><p><?php echo esc_html($ab_p2); ?></p><?php endif; ?>
                <?php if ($ab_p3) : ?><p><?php echo esc_html($ab_p3); ?></p><?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Services -->
    <section class="py-16 sm:py-20 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-light text-[#003a76] mb-8 text-center">
                <?php echo esc_html($sv_title); ?> <span class="font-medium"><?php echo esc_html($sv_subtitle); ?></span>
            </h2>
            <div class="space-y-6 text-base sm:text-lg text-gray-700 leading-relaxed">
                <?php if ($sv_p1) : ?><p><?php echo esc_html($sv_p1); ?></p><?php endif; ?>
                <?php if ($sv_p2) : ?><p><?php echo esc_html($sv_p2); ?></p><?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Kvalitet og sikkerhet (split into Sikkerhet i fokus + Gode arbeidsplasser) -->
    <section class="py-16 sm:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-light text-[#003a76] mb-12 text-center">
                <?php echo esc_html($q_title); ?> <span class="font-medium"><?php echo esc_html($q_subtitle); ?></span>
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div class="bg-white rounded-lg shadow-lg p-8 border border-gray-100">
                    <div class="w-12 h-12 bg-blue-50 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-[#003a76]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <h3 class="text-xl font-medium text-[#041024] mb-4"><?php echo esc_html($safety_title); ?></h3>
                    <div class="space-y-4 text-gray-700 leading-relaxed">
                        <?php if ($safety_p1) : ?><p><?php echo esc_html($safety_p1); ?></p><?php endif; ?>
                        <?php if ($safety_p2) : ?><p><?php echo esc_html($safety_p2); ?></p><?php endif; ?>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-lg p-8 border border-gray-100">
                    <div class="w-12 h-12 bg-blue-50 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-[#003a76]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-medium text-[#041024] mb-4"><?php echo esc_html($wp_title); ?></h3>
                    <div class="space-y-4 text-gray-700 leading-relaxed">
                        <?php if ($wp_p1) : ?><p><?php echo esc_html($wp_p1); ?></p><?php endif; ?>
                        <?php if ($wp_p2) : ?><p><?php echo esc_html($wp_p2); ?></p><?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Industries -->
    <section class="py-16 sm:py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-light text-[#003a76] mb-4">
                    <?php echo esc_html($ind_title); ?> <span class="font-medium"><?php echo esc_html($ind_subtitle); ?></span>
                </h2>
                <p class="text-base sm:text-lg text-gray-600 max-w-3xl mx-auto"><?php echo esc_html($ind_intro); ?></p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 sm:gap-6">
                <?php foreach ($industries as $name) : ?>
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

    <!-- Certification -->
    <section class="py-16 sm:py-20 bg-green-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/miljofyrtarn.webp'); ?>" alt="Miljøfyrtårn" class="h-24 mx-auto mb-6">
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
