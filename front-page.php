<?php
get_header();
$pid = get_the_ID();

$site_phone = pl_opt('phone', '70 00 86 04');
$site_email = pl_opt('email', 'post@plamek.no');

// Hero
$hero_title1 = pl_meta('pl_home_hero_title1', 'Norges største');
$hero_title2 = pl_meta('pl_home_hero_title2', 'på montering og vedlikehold');
$hero_desc   = pl_meta('pl_home_hero_desc',   'Montering, service og vedlikehold av stålhaller og dukhaller.');
$btn1_text   = pl_meta('pl_home_hero_btn1_text', 'VÅRE TJENESTER');
$btn1_link   = pl_meta('pl_home_hero_btn1_link', '/tjenester');
$btn2_text   = pl_meta('pl_home_hero_btn2_text', 'RING ' . $site_phone);
$btn2_link   = pl_meta('pl_home_hero_btn2_link', 'tel:' . preg_replace('/\s+/', '', $site_phone));

// Hero slider images
$hero_images = [];
for ($i = 1; $i <= 5; $i++) {
    $img = pl_meta("pl_home_hero_image_{$i}", '');
    if ($img !== '') $hero_images[] = $img;
}
if (empty($hero_images)) {
    $hero_images = [get_template_directory_uri() . '/assets/images/hero-default.jpg'];
}

// Service cards
$cards = [];
for ($i = 1; $i <= 3; $i++) {
    $cards[] = [
        'title' => pl_meta("pl_home_card{$i}_title", ''),
        'desc'  => pl_meta("pl_home_card{$i}_desc",  ''),
        'link'  => pl_meta("pl_home_card{$i}_link",  ''),
        'image' => pl_meta("pl_home_card{$i}_image", ''),
    ];
}
$services_title = pl_meta('pl_home_services_title', 'Vi tilbyr');
$services_intro = pl_meta('pl_home_services_intro', 'Montering, demontering, flytting og vedlikehold av duk- og stålhaller');

// Stats
$stats = [];
for ($i = 1; $i <= 4; $i++) {
    $stats[] = [
        'num'   => pl_meta("pl_home_stat{$i}_num", ''),
        'label' => pl_meta("pl_home_stat{$i}_label", ''),
    ];
}

// CTA
$cta_title = pl_meta('pl_home_cta_title', 'Klar for å starte ditt prosjekt?');
$cta_intro = pl_meta('pl_home_cta_intro', 'Kontakt oss i dag for en uforpliktende samtale om dine behov');
?>

<!-- Hero Section -->
<section class="relative h-[70vh] sm:h-[80vh] lg:h-screen min-h-[500px] sm:min-h-[600px] lg:min-h-[100vh] flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 z-0" id="pl-hero-slider" data-interval="6000">
        <?php foreach ($hero_images as $i => $img) : ?>
            <div class="pl-hero-slide absolute inset-0 bg-cover bg-center transition-opacity duration-1000 <?php echo $i === 0 ? 'opacity-100' : 'opacity-0'; ?>"
                 style="background-image: url('<?php echo esc_url($img); ?>');"></div>
        <?php endforeach; ?>
    </div>

    <div class="absolute inset-0 bg-gradient-to-r from-[#003a76]/90 via-[#003a76]/70 to-[#003a76]/50 z-10"></div>

    <div class="relative z-20 max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 text-center">
        <h1 class="text-3xl sm:text-4xl md:text-6xl lg:text-7xl xl:text-8xl font-light text-white mb-4 sm:mb-6 md:mb-8 tracking-tight leading-[1.1] drop-shadow-xl">
            <?php echo esc_html($hero_title1); ?>
            <span class="block font-medium text-[#bfcedd] mt-1 sm:mt-2 md:mt-4"><?php echo esc_html($hero_title2); ?></span>
        </h1>
        <p class="text-sm sm:text-base md:text-lg lg:text-xl text-white/95 mb-6 sm:mb-8 md:mb-12 max-w-3xl mx-auto leading-relaxed drop-shadow-lg">
            <?php echo esc_html($hero_desc); ?>
        </p>
        <div class="flex flex-col gap-3 sm:flex-row sm:gap-4 md:gap-6 justify-center items-center max-w-md sm:max-w-none mx-auto">
            <a href="<?php echo esc_url($btn1_link); ?>"
               class="bg-white text-[#003a76] hover:bg-gray-100 px-6 py-4 text-sm sm:text-base font-semibold w-full sm:w-auto min-w-[200px] rounded-lg inline-block text-center transition-colors">
                <?php echo esc_html($btn1_text); ?>
            </a>
            <a href="<?php echo esc_url($btn2_link); ?>"
               class="border-2 border-white text-white hover:bg-white hover:text-[#003a76] px-6 py-4 text-sm sm:text-base font-semibold w-full sm:w-auto min-w-[200px] bg-transparent transition-all duration-300 rounded-lg inline-block text-center">
                <?php echo esc_html($btn2_text); ?>
            </a>
        </div>
    </div>

    <!-- Dots indicator -->
    <?php if (count($hero_images) > 1) : ?>
    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-30 flex space-x-3" id="pl-hero-dots">
        <?php foreach ($hero_images as $i => $img) : ?>
            <button data-index="<?php echo $i; ?>" class="w-3 h-3 sm:w-4 sm:h-4 rounded-full transition-all duration-300 <?php echo $i === 0 ? 'bg-white scale-125' : 'bg-white/60 hover:bg-white/80'; ?>"></button>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</section>

<!-- Services Section -->
<section id="tjenester" class="py-12 sm:py-16 lg:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8 sm:mb-12 lg:mb-16">
            <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-light text-[#003a76] mb-3 sm:mb-4 md:mb-6">
                <?php echo esc_html($services_title); ?>
            </h2>
            <p class="text-base sm:text-lg md:text-xl text-slate-700 max-w-3xl mx-auto px-4">
                <?php echo esc_html($services_intro); ?>
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8 lg:gap-12">
            <?php foreach ($cards as $card) : if (!$card['title']) continue; ?>
                <div class="group bg-[#f5f5f5] rounded-lg overflow-hidden">
                    <?php if ($card['image']) : ?>
                    <div class="relative overflow-hidden">
                        <img src="<?php echo esc_url($card['image']); ?>" alt="<?php echo esc_attr($card['title']); ?>"
                             class="w-full h-48 sm:h-56 md:h-64 object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">
                        <div class="absolute inset-0 bg-[#003a76]/20 group-hover:bg-[#003a76]/70 transition-all duration-300"></div>
                    </div>
                    <?php endif; ?>
                    <div class="px-6 sm:px-8 pb-6 sm:pb-8 pt-4 sm:pt-6">
                        <h3 class="text-xl sm:text-2xl font-medium text-[#003a76] mb-3 sm:mb-4"><?php echo esc_html($card['title']); ?></h3>
                        <p class="text-sm sm:text-base text-gray-600 mb-4 sm:mb-6 leading-relaxed"><?php echo esc_html($card['desc']); ?></p>
                        <a href="<?php echo esc_url(home_url($card['link'])); ?>"
                           class="bg-[#003a76] text-white px-4 sm:px-6 py-2 sm:py-3 rounded-lg hover:bg-[#002855] transition-colors duration-300 font-medium text-sm sm:text-base inline-block">
                            Les mer
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-12 sm:py-16 lg:py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-6 sm:gap-8 lg:gap-12 text-center">
            <?php foreach ($stats as $stat) : ?>
                <div>
                    <div class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-light text-[#003a76] mb-1 sm:mb-2"><?php echo esc_html($stat['num']); ?></div>
                    <div class="text-xs sm:text-sm md:text-base text-slate-700 uppercase tracking-wide font-medium px-1"><?php echo esc_html($stat['label']); ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Contact CTA -->
<section id="kontakt" class="py-12 sm:py-16 lg:py-20 bg-gradient-to-br from-[#003a76] to-[#002855]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8 sm:mb-12 lg:mb-16">
            <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-light text-white mb-3 sm:mb-4 md:mb-6">
                <?php echo esc_html($cta_title); ?>
            </h2>
            <p class="text-base sm:text-lg md:text-xl text-white/90 max-w-3xl mx-auto px-4">
                <?php echo esc_html($cta_intro); ?>
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8 lg:gap-12 items-start">
            <div class="space-y-6 sm:space-y-8">
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 sm:p-6 border border-white/20">
                    <h3 class="text-lg sm:text-xl font-semibold text-white mb-3 sm:mb-4">Ring oss direkte</h3>
                    <p class="text-white/90 mb-3 sm:mb-4 text-sm sm:text-base">Snakk med våre eksperter</p>
                    <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $site_phone)); ?>"
                       class="text-xl sm:text-2xl font-light text-white hover:text-white/80 transition-colors">
                        <?php echo esc_html($site_phone); ?>
                    </a>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 sm:p-6 border border-white/20">
                    <h3 class="text-lg sm:text-xl font-semibold text-white mb-3 sm:mb-4">Send e-post</h3>
                    <p class="text-white/90 mb-3 sm:mb-4 text-sm sm:text-base">Vi svarer innen 24 timer</p>
                    <a href="mailto:<?php echo esc_attr($site_email); ?>"
                       class="text-lg sm:text-xl text-white hover:text-white/80 transition-colors">
                        <?php echo esc_html($site_email); ?>
                    </a>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-2xl">
                    <h3 class="text-xl sm:text-2xl font-semibold text-[#003a76] mb-4 sm:mb-6">Send oss en forespørsel</h3>
                    <?php get_template_part('template-parts/contact-form'); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
