<?php
/**
 * Template Name: Dukskift og isolering
 */
get_header();
$pid = get_the_ID();

$h_t1   = pl_meta('pl_duk_hero_title1', 'Dukskift og');
$h_t2   = pl_meta('pl_duk_hero_title2', 'isolering av hall');
$h_desc = pl_meta('pl_duk_hero_desc',   'Har bygningen behov for skift av duk? Eller ønsker du å etterisolere din eksisterende hall? Vi hjelper deg med å fornye og oppgradere hallen din.');
$h_img  = pl_meta('pl_duk_hero_image',  get_template_directory_uri() . '/assets/images/dukskift.webp');

$off_title = pl_meta('pl_duk_off_title', 'Vi utfører følgende tjenester');
$off_intro = pl_meta('pl_duk_off_intro', 'Profesjonell oppgradering og vedlikehold av din hall.');

$offerings_defaults = [
    1 => ['Dukskift',                'Hele eller oppussing av eksisterende duk'],
    2 => ['Isolerte løsninger',      'Profesjonell isolering av eksisterende haller'],
    3 => ['Lysoppgraderinger',       'LED og grønnere belysningsløsninger'],
    4 => ['Dør- og inngangssystemer','Avanserte dør- og inngangssystemer'],
    5 => ['Skilting på bygning',     'Profesjonell skilting og merking'],
    6 => ['VVS / klimakontroll',     'Ventilasjon, varme og avfukting'],
];
$offerings = [];
for ($i = 1; $i <= 6; $i++) {
    $offerings[] = [
        'title' => pl_meta("pl_duk_off{$i}_title", $offerings_defaults[$i][0]),
        'desc'  => pl_meta("pl_duk_off{$i}_desc",  $offerings_defaults[$i][1]),
    ];
}

$ben_title = pl_meta('pl_duk_ben_title', 'Hvorfor oppgradere hallen?');
$benefits_defaults = [
    1 => ['Rask utførelse',  'Jobben utføres raskt og effektivt'],
    2 => ['Fleksible løsninger', 'Hele eller deler av duken - akkurat det du trenger'],
    3 => ['Landsdekkende',   'Vi kommer der hallen er, uansett hvor i landet'],
    4 => ['Komplett service','Fra dukskift til isolering og oppgraderinger'],
];
$benefits = [];
for ($i = 1; $i <= 4; $i++) {
    $benefits[] = [
        'title' => pl_meta("pl_duk_ben{$i}_title", $benefits_defaults[$i][0]),
        'desc'  => pl_meta("pl_duk_ben{$i}_desc",  $benefits_defaults[$i][1]),
    ];
}

$g1_title = pl_meta('pl_duk_g1_title', 'Hall før dukskift');
$g1_desc  = pl_meta('pl_duk_g1_desc',  'Gammel og slitt duk som trenger utskifting');
$g1_img   = pl_meta('pl_duk_g1_img',   '');
$g2_title = pl_meta('pl_duk_g2_title', 'Hall med ny duk');
$g2_desc  = pl_meta('pl_duk_g2_desc',  'Ferdig oppgradert hall med ny duk fra Plamek');
$g2_img   = pl_meta('pl_duk_g2_img',   '');

$cta_btn = pl_meta('pl_duk_cta_btn', 'Be om befaring');
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
            <p class="text-base sm:text-lg lg:text-xl text-white/90 leading-relaxed max-w-3xl mx-auto px-4"><?php echo esc_html($h_desc); ?></p>
        </div>
    </section>

    <!-- Offerings -->
    <section class="py-16 sm:py-20 lg:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 sm:mb-16">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-light text-[#003a76] mb-4"><?php echo esc_html($off_title); ?></h2>
                <p class="text-base sm:text-lg text-gray-600 max-w-3xl mx-auto"><?php echo esc_html($off_intro); ?></p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                <?php foreach ($offerings as $o) : if (!$o['title']) continue; ?>
                    <div class="bg-white p-6 sm:p-8 rounded-lg shadow-lg border border-gray-100 hover:shadow-xl transition-shadow">
                        <div class="w-12 h-12 bg-blue-50 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-[#003a76]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <h3 class="text-lg sm:text-xl font-medium text-[#041024] mb-3"><?php echo esc_html($o['title']); ?></h3>
                        <p class="text-sm sm:text-base text-gray-600 leading-relaxed"><?php echo esc_html($o['desc']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Benefits -->
    <section class="py-16 sm:py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-light text-[#003a76]"><?php echo esc_html($ben_title); ?></h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <?php foreach ($benefits as $b) : if (!$b['title']) continue; ?>
                    <div class="text-center">
                        <div class="w-16 h-16 bg-white rounded-full shadow-lg flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-[#003a76]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <h3 class="text-xl font-medium text-[#041024] mb-3"><?php echo esc_html($b['title']); ?></h3>
                        <p class="text-gray-600 text-sm leading-relaxed"><?php echo esc_html($b['desc']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Gallery -->
    <?php if ($g1_img || $g2_img) : ?>
    <section class="py-16 sm:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <?php foreach ([['title'=>$g1_title,'desc'=>$g1_desc,'img'=>$g1_img], ['title'=>$g2_title,'desc'=>$g2_desc,'img'=>$g2_img]] as $g) : if (!$g['img']) continue; ?>
                    <div class="bg-white rounded-lg overflow-hidden shadow-lg">
                        <img src="<?php echo esc_url($g['img']); ?>" alt="<?php echo esc_attr($g['title']); ?>" class="w-full h-64 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-medium text-[#003a76] mb-2"><?php echo esc_html($g['title']); ?></h3>
                            <p class="text-gray-600 text-sm"><?php echo esc_html($g['desc']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- CTA -->
    <section class="py-16 sm:py-20 bg-[#003a76]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl sm:text-4xl font-light text-white mb-6">Klar for å fornye hallen?</h2>
            <a href="<?php echo esc_url(home_url('/kontakt')); ?>" class="inline-block bg-white text-[#003a76] hover:bg-gray-100 px-8 py-4 text-lg font-medium rounded-lg transition-colors"><?php echo esc_html($cta_btn); ?> →</a>
        </div>
    </section>
</div>

<?php get_footer(); ?>
