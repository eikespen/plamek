<?php
/**
 * Shared service page layout (montering, vedlikehold, dukskift, flytting, reparering).
 * Reads pl_sv_* meta keys.
 *
 * Optional args (passed via get_template_part('template-parts/service-page', null, $args) on PHP 8+
 * or set as $template_args before include for older PHP):
 *   $default_title1 / $default_title2 / $default_desc / $default_image — fallbacks shown when the
 *   page hasn't been edited yet.
 */
$pid           = get_the_ID();
$default_title1 = $template_args['default_title1'] ?? '';
$default_title2 = $template_args['default_title2'] ?? '';
$default_desc   = $template_args['default_desc']   ?? '';
$default_image  = $template_args['default_image']  ?? get_template_directory_uri() . '/assets/images/hero-default.jpg';

$h_t1   = pl_meta('pl_sv_hero_title1', $default_title1);
$h_t2   = pl_meta('pl_sv_hero_title2', $default_title2);
$h_desc = pl_meta('pl_sv_hero_desc',   $default_desc);
$h_img  = pl_meta('pl_sv_hero_image',  $default_image);

$intro_title = pl_meta('pl_sv_intro_title', '');
$intro_body  = pl_meta('pl_sv_intro_body',  '');

$features = [];
for ($i = 1; $i <= 4; $i++) {
    $features[] = [
        'title' => pl_meta("pl_sv_feat{$i}_title", ''),
        'desc'  => pl_meta("pl_sv_feat{$i}_desc",  ''),
    ];
}

$cta_title    = pl_meta('pl_sv_cta_title',    'Klar for å starte prosjektet?');
$cta_text     = pl_meta('pl_sv_cta_text',     'Ta kontakt for en uforpliktende prat om dine behov.');
$cta_btn_text = pl_meta('pl_sv_cta_btn_text', 'Kontakt oss');
?>

<div class="min-h-screen bg-white">
    <!-- Hero -->
    <section class="relative bg-gray-50 py-16 sm:py-20 lg:py-24 pt-32 sm:pt-40 lg:pt-48">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('<?php echo esc_url($h_img); ?>');"></div>
        <div class="absolute inset-0 bg-[#041024]/70"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-light text-white mb-6">
                <?php echo esc_html($h_t1); ?> <span class="font-medium"><?php echo esc_html($h_t2); ?></span>
            </h1>
            <p class="text-base sm:text-lg lg:text-xl text-white/90 leading-relaxed max-w-3xl mx-auto px-4">
                <?php echo esc_html($h_desc); ?>
            </p>
        </div>
    </section>

    <!-- Intro -->
    <?php if ($intro_title || $intro_body) : ?>
    <section class="py-16 sm:py-20 lg:py-24">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <?php if ($intro_title) : ?>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-light text-[#003a76] mb-6"><?php echo esc_html($intro_title); ?></h2>
            <?php endif; ?>
            <?php if ($intro_body) : ?>
                <div class="text-base sm:text-lg text-gray-700 leading-relaxed whitespace-pre-line"><?php echo esc_html($intro_body); ?></div>
            <?php endif; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- Feature cards -->
    <?php if (array_filter(array_column($features, 'title'))) : ?>
    <section class="py-16 sm:py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
                <?php foreach ($features as $f) : if (!$f['title']) continue; ?>
                    <div class="bg-white p-6 sm:p-8 rounded-lg shadow-lg border border-gray-100">
                        <div class="w-12 h-12 bg-blue-50 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-[#003a76]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <h3 class="text-lg sm:text-xl font-medium text-[#041024] mb-3"><?php echo esc_html($f['title']); ?></h3>
                        <p class="text-sm sm:text-base text-gray-600 leading-relaxed"><?php echo esc_html($f['desc']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- CTA -->
    <section class="py-16 sm:py-20 lg:py-24 bg-[#003a76]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl sm:text-4xl font-light text-white mb-6 sm:mb-8"><?php echo esc_html($cta_title); ?></h2>
            <p class="text-xl text-white/90 mb-8 sm:mb-10 max-w-2xl mx-auto"><?php echo esc_html($cta_text); ?></p>
            <a href="<?php echo esc_url(home_url('/kontakt')); ?>"
               class="inline-block bg-white text-[#003a76] hover:bg-gray-100 px-8 py-4 text-lg font-medium rounded-lg transition-colors">
                <?php echo esc_html($cta_btn_text); ?> →
            </a>
        </div>
    </section>
</div>
