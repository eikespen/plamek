<?php
/**
 * Template Name: Reparering av skader
 */
get_header();
$pid = get_the_ID();

$h_t1   = pl_meta('pl_rep_hero_title1', 'Reparering av');
$h_t2   = pl_meta('pl_rep_hero_title2', 'skader på hall');
$h_desc = pl_meta('pl_rep_hero_desc',   'Har hallen din fått en skade? Vi reparerer alle slags skader på dukhaller, enten det er rifter i duken, skader på stålkonstruksjonen eller andre problemer.');
$h_img  = pl_meta('pl_rep_hero_image',  get_template_directory_uri() . '/assets/images/hero-default.jpg');

$ov_title = pl_meta('pl_rep_overview_title', '');
$ov_desc  = pl_meta('pl_rep_overview_desc',  '');

$dt_title = pl_meta('pl_rep_dt_title', 'Vi reparerer alle typer skader');
$dt_intro = pl_meta('pl_rep_dt_intro', 'Uansett skadeomfang har vi kompetansen til å utbedre det.');

$proc_title = pl_meta('pl_rep_proc_title', '');
$proc_p1    = pl_meta('pl_rep_proc_p1',    '');
$proc_p2    = pl_meta('pl_rep_proc_p2',    '');

$damage_defaults = [
    1 => ['Dukskader',           'Rifter, hull og slitasje på hallduken'],
    2 => ['Konstruksjonsskader', 'Skader på rammeverk og bærende konstruksjoner'],
    3 => ['Dør- og portskader',  'Reparasjon av innganger og portløsninger'],
    4 => ['Værskader',           'Utbedring etter storm, snølast og haglskader'],
    5 => ['Isolasjonsskader',    'Reparasjon og utskifting av isolasjonsmaterialer'],
    6 => ['Ventilasjonsskader',  'Reparasjon av ventilasjons- og klimasystemer'],
];
$damages = [];
for ($i = 1; $i <= 6; $i++) {
    $damages[] = [
        'title' => pl_meta("pl_rep_dt{$i}_title", $damage_defaults[$i][0]),
        'desc'  => pl_meta("pl_rep_dt{$i}_desc",  $damage_defaults[$i][1]),
    ];
}

$ben_title = pl_meta('pl_rep_ben_title', 'Hvorfor velge oss?');
$benefits_defaults = [
    1 => ['Rask respons',     'Hurtig utrykning ved akutte skader'],
    2 => ['Ekspertise',       'Spesialisert kunnskap om alle halltyper'],
    3 => ['Kvalitetsgaranti', 'Garanti på alle reparasjoner vi utfører'],
    4 => ['Originale deler',  'Bruker originale eller likeverdige komponenter'],
];
$benefits = [];
for ($i = 1; $i <= 4; $i++) {
    $benefits[] = [
        'title' => pl_meta("pl_rep_ben{$i}_title", $benefits_defaults[$i][0]),
        'desc'  => pl_meta("pl_rep_ben{$i}_desc",  $benefits_defaults[$i][1]),
    ];
}

$g1_title = pl_meta('pl_rep_g1_title', 'Før reparasjon');
$g1_desc  = pl_meta('pl_rep_g1_desc',  'Hall med skader som må utbedres');
$g1_img   = pl_meta('pl_rep_g1_img',   '');
$g2_title = pl_meta('pl_rep_g2_title', 'Etter reparasjon');
$g2_desc  = pl_meta('pl_rep_g2_desc',  'Hall i perfekt stand etter profesjonell reparasjon');
$g2_img   = pl_meta('pl_rep_g2_img',   '');

$cta_btn = pl_meta('pl_rep_cta_btn', 'Meld skade');
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

    <!-- Overview -->
    <?php if ($ov_title || $ov_desc) : ?>
    <section class="py-16 sm:py-20 lg:py-24">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <?php if ($ov_title) : ?>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-light text-[#003a76] mb-6"><?php echo esc_html($ov_title); ?></h2>
            <?php endif; ?>
            <?php if ($ov_desc) : ?>
                <p class="text-base sm:text-lg text-gray-700 leading-relaxed"><?php echo esc_html($ov_desc); ?></p>
            <?php endif; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- Damage types -->
    <section class="py-16 sm:py-20 lg:py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 sm:mb-16">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-light text-[#003a76] mb-4"><?php echo esc_html($dt_title); ?></h2>
                <p class="text-base sm:text-lg text-gray-600 max-w-3xl mx-auto"><?php echo esc_html($dt_intro); ?></p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                <?php foreach ($damages as $d) : if (!$d['title']) continue; ?>
                    <div class="bg-white p-6 sm:p-8 rounded-lg shadow-lg border border-gray-100 hover:shadow-xl transition-shadow">
                        <div class="w-12 h-12 bg-red-50 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-[#003a76]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        </div>
                        <h3 class="text-lg sm:text-xl font-medium text-[#041024] mb-3"><?php echo esc_html($d['title']); ?></h3>
                        <p class="text-sm sm:text-base text-gray-600 leading-relaxed"><?php echo esc_html($d['desc']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Process -->
    <?php if ($proc_title || $proc_p1 || $proc_p2) : ?>
    <section class="py-16 sm:py-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <?php if ($proc_title) : ?>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-light text-[#003a76] mb-8 text-center"><?php echo esc_html($proc_title); ?></h2>
            <?php endif; ?>
            <div class="space-y-6 text-base sm:text-lg text-gray-700 leading-relaxed">
                <?php if ($proc_p1) : ?><p><?php echo esc_html($proc_p1); ?></p><?php endif; ?>
                <?php if ($proc_p2) : ?><p><?php echo esc_html($proc_p2); ?></p><?php endif; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

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
            <h2 class="text-3xl sm:text-4xl font-light text-white mb-6">Trenger du rask hjelp?</h2>
            <a href="<?php echo esc_url(home_url('/kontakt')); ?>" class="inline-block bg-white text-[#003a76] hover:bg-gray-100 px-8 py-4 text-lg font-medium rounded-lg transition-colors"><?php echo esc_html($cta_btn); ?> →</a>
        </div>
    </section>
</div>

<?php get_footer(); ?>
