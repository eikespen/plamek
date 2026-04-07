<?php
/**
 * Template Name: Om Plamek
 */
get_header();
$pid = get_the_ID();

$h_t1   = pl_meta('pl_om_hero_title1', 'Om');
$h_t2   = pl_meta('pl_om_hero_title2', 'Plamek AS');
$h_desc = pl_meta('pl_om_hero_desc',   'Bygg, service, vedlikehold og ettermarkedsløsninger');
$h_img  = pl_meta('pl_om_hero_image',  get_template_directory_uri() . '/assets/images/hero-default.jpg');

$ab_title = pl_meta('pl_om_about_title',  'Om Plamek AS');
$ab_b1    = pl_meta('pl_om_about_body_1', '');
$ab_b2    = pl_meta('pl_om_about_body_2', '');
$ab_b3    = pl_meta('pl_om_about_body_3', '');

$values = [];
for ($i = 1; $i <= 4; $i++) {
    $values[] = [
        'title' => pl_meta("pl_om_value{$i}_title", ''),
        'desc'  => pl_meta("pl_om_value{$i}_desc",  ''),
    ];
}

$cta_title    = pl_meta('pl_om_cta_title',    'Vil du vite mer?');
$cta_text     = pl_meta('pl_om_cta_text',     'Ta kontakt for en uforpliktende prat.');
$cta_btn_text = pl_meta('pl_om_cta_btn_text', 'Kontakt oss');
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

    <!-- About content -->
    <section class="py-16 sm:py-20 lg:py-24">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-light text-[#003a76] mb-8 text-center"><?php echo esc_html($ab_title); ?></h2>
            <div class="space-y-6 text-base sm:text-lg text-gray-700 leading-relaxed">
                <?php if ($ab_b1) : ?><p><?php echo esc_html($ab_b1); ?></p><?php endif; ?>
                <?php if ($ab_b2) : ?><p><?php echo esc_html($ab_b2); ?></p><?php endif; ?>
                <?php if ($ab_b3) : ?><p><?php echo esc_html($ab_b3); ?></p><?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Values -->
    <?php if (array_filter(array_column($values, 'title'))) : ?>
    <section class="py-16 sm:py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <?php foreach ($values as $v) : if (!$v['title']) continue; ?>
                    <div class="text-center">
                        <div class="w-16 h-16 bg-white rounded-full shadow-lg flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-[#003a76]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-medium text-[#041024] mb-3"><?php echo esc_html($v['title']); ?></h3>
                        <p class="text-gray-600"><?php echo esc_html($v['desc']); ?></p>
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

<?php get_footer(); ?>
