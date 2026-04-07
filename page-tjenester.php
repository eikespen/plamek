<?php
/**
 * Template Name: Tjenester
 */
get_header();
$pid = get_the_ID();

$h_t1   = pl_meta('pl_tj_hero_title1',  'Våre');
$h_t2   = pl_meta('pl_tj_hero_title2',  'tjenester');
$h_desc = pl_meta('pl_tj_hero_desc',    'Vi leverer komplette løsninger for duk- og stålhaller i hele Norge.');
$h_img  = pl_meta('pl_tj_hero_image',   get_template_directory_uri() . '/assets/images/tjenester.webp');

$cards = [];
for ($i = 1; $i <= 6; $i++) {
    $cards[] = [
        'title' => pl_meta("pl_tj_card{$i}_title", ''),
        'desc'  => pl_meta("pl_tj_card{$i}_desc",  ''),
        'link'  => pl_meta("pl_tj_card{$i}_link",  ''),
    ];
}

$ben_title = pl_meta('pl_tj_benefits_title', 'Hvorfor velge Plamek?');
$ben_intro = pl_meta('pl_tj_benefits_intro', 'Vi er din trygge partner på alt som omhandler duk- og stålhaller.');
$benefits = [];
for ($i = 1; $i <= 6; $i++) {
    $benefits[] = [
        'title' => pl_meta("pl_tj_benefit{$i}_title", ''),
        'desc'  => pl_meta("pl_tj_benefit{$i}_desc",  ''),
    ];
}

$cta_title    = pl_meta('pl_tj_cta_title',    'Klar for å starte prosjektet?');
$cta_text     = pl_meta('pl_tj_cta_text',     'Ta kontakt for en uforpliktende prat om dine behov.');
$cta_btn_text = pl_meta('pl_tj_cta_btn_text', 'Kontakt oss');
?>

<div class="min-h-screen bg-white">
    <!-- Hero -->
    <section class="relative bg-gray-50 py-16 sm:py-20 lg:py-24 pt-32 sm:pt-40 lg:pt-48">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('<?php echo esc_url($h_img); ?>');"></div>
        <div class="absolute inset-0 bg-[#041024]/70"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-4xl mx-auto">
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-light text-white mb-6 sm:mb-8 leading-tight">
                    <?php echo esc_html($h_t1); ?> <span class="font-medium"><?php echo esc_html($h_t2); ?></span>
                </h1>
                <p class="text-base sm:text-lg lg:text-xl text-white/90 leading-relaxed mb-6 sm:mb-8 px-4 sm:px-0">
                    <?php echo esc_html($h_desc); ?>
                </p>
            </div>
        </div>
    </section>

    <!-- Service cards -->
    <section class="py-12 sm:py-16 lg:py-20 -mt-16 sm:-mt-24 relative z-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                <?php foreach ($cards as $card) : if (!$card['title']) continue; ?>
                    <a href="<?php echo esc_url(home_url($card['link'])); ?>"
                       class="group block bg-white p-6 sm:p-8 rounded-lg shadow-xl hover:shadow-2xl transition-all duration-300 border border-gray-100 transform hover:-translate-y-1">
                        <div class="flex items-start justify-between mb-4 sm:mb-6">
                            <div class="w-12 h-12 sm:w-14 sm:h-14 bg-blue-50 rounded-full flex items-center justify-center group-hover:bg-[#003a76] transition-colors duration-300">
                                <svg class="w-6 h-6 sm:w-7 sm:h-7 text-[#003a76] group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </div>
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-gray-300 group-hover:text-[#003a76] transition-colors transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </div>
                        <h3 class="text-lg sm:text-xl font-medium text-[#041024] mb-2 sm:mb-3 group-hover:text-[#003a76] transition-colors"><?php echo esc_html($card['title']); ?></h3>
                        <p class="text-sm sm:text-base text-gray-600 leading-relaxed"><?php echo esc_html($card['desc']); ?></p>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Benefits -->
    <section class="py-16 sm:py-20 lg:py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 sm:mb-16">
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-light text-[#041024] mb-4 sm:mb-6">
                    <?php echo esc_html($ben_title); ?>
                </h2>
                <p class="text-lg sm:text-xl text-gray-600 max-w-3xl mx-auto px-4">
                    <?php echo esc_html($ben_intro); ?>
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-12">
                <?php foreach ($benefits as $b) : if (!$b['title']) continue; ?>
                    <div class="text-center group">
                        <div class="w-16 h-16 bg-white rounded-full shadow-lg flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-[#003a76]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-medium text-[#041024] mb-3"><?php echo esc_html($b['title']); ?></h3>
                        <p class="text-gray-600"><?php echo esc_html($b['desc']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

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
