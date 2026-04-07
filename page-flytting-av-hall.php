<?php
/**
 * Template Name: Flytting av hall
 */
get_header();
$pid = get_the_ID();

$h_t1   = pl_meta('pl_fly_hero_title1', 'Flytting av');
$h_t2   = pl_meta('pl_fly_hero_title2', 'hall');
$h_desc = pl_meta('pl_fly_hero_desc',   'Vi flytter alle typer haller i hele landet! En flytteprosess krever nøyaktighet og erfaring for å sikre at hallen ivaretas på best mulig måte.');
$h_img  = pl_meta('pl_fly_hero_image',  get_template_directory_uri() . '/assets/images/hero-default.jpg');

$intro_title = pl_meta('pl_fly_intro_title', 'Flytting av hall – raskt, sikkert og effektivt');
$intro_p1    = pl_meta('pl_fly_intro_p1', 'Å flytte en hall behøver verken være komplisert eller tidkrevende. Med riktig kompetanse og utstyr kan en eksisterende plasthall få nytt liv på en annen lokasjon – uten at du trenger å investere i en helt ny løsning.');
$intro_p2    = pl_meta('pl_fly_intro_p2', 'Hos oss gjennomføres hallflytting enten ved hel-løft eller demontering og remontering. Uansett metode er sikkerhet alltid førsteprioritet. Alle våre montører har relevante sertifikater og kurs som sikrer trygg gjennomføring på byggeplassen.');
$intro_p3    = pl_meta('pl_fly_intro_p3', 'Med et erfarent og spesialisert team sørger vi for at hele prosessen går sømløst – fra planlegging og logistikk til montering på ny plassering. Det gir deg som kunde trygghet for at hallen din blir flyttet på en profesjonell, effektiv og skadefri måte.');
$intro_p4    = pl_meta('pl_fly_intro_p4', 'Flytting av hall er et bærekraftig og kostnadseffektivt alternativ, enten du skal utvide, omstrukturere eller tilpasse arealbruken. Vi hjelper deg gjerne med råd og befaring.');
$intro_cta   = pl_meta('pl_fly_intro_cta','Ta kontakt for mer informasjon om hvordan vi kan flytte hallen din – sikkert og smidig!');

$proc_title = pl_meta('pl_fly_proc_title', 'Slik foregår prosessen');
$proc_intro = pl_meta('pl_fly_proc_intro', 'Vi tar oss av hele prosessen fra demontering til ferdig montert hall på ny lokasjon.');

$process_defaults = [
    1 => ['Stedsinspeksjon',         'Grundig inspeksjon av både gammelt og nytt sted'],
    2 => ['Profesjonell demontering','Systematisk nedtaking med merking av alle komponenter'],
    3 => ['Sikker transport',        'Transportløsninger tilpasset hallens størrelse og komponenter'],
    4 => ['Grunnarbeid',             'Klargjøring av fundament på ny lokasjon'],
    5 => ['Gjenmontering',           'Komplett montering på nytt sted med kvalitetskontroll'],
    6 => ['Garanti og oppfølging',   'Garanti på arbeidet og oppfølging etter ferdigstillelse'],
];
$process = [];
for ($i = 1; $i <= 6; $i++) {
    $process[] = [
        'title' => pl_meta("pl_fly_proc{$i}_title", $process_defaults[$i][0]),
        'desc'  => pl_meta("pl_fly_proc{$i}_desc",  $process_defaults[$i][1]),
    ];
}

$ben_title = pl_meta('pl_fly_ben_title', 'Hvorfor velge oss til flytting?');
$benefits_defaults = [
    1 => ['Effektiv prosess',  'Planlagt og strukturert tilnærming for rask gjennomføring'],
    2 => ['Trygg håndtering',  'Erfarne teknikere som ivaretar hallens kvalitet'],
    3 => ['Komplett service',  'Alt fra demontering til ferdig montering på nytt sted'],
    4 => ['Kvalitetsgaranti',  'Garanti på arbeidet og oppfølging etter ferdigstillelse'],
];
$benefits = [];
for ($i = 1; $i <= 4; $i++) {
    $benefits[] = [
        'title' => pl_meta("pl_fly_ben{$i}_title", $benefits_defaults[$i][0]),
        'desc'  => pl_meta("pl_fly_ben{$i}_desc",  $benefits_defaults[$i][1]),
    ];
}

$g1_title = pl_meta('pl_fly_g1_title', 'Før flytting');
$g1_desc  = pl_meta('pl_fly_g1_desc',  'Hall klar for demontering på opprinnelig lokasjon');
$g1_img   = pl_meta('pl_fly_g1_img',   '');
$g2_title = pl_meta('pl_fly_g2_title', 'Etter flytting');
$g2_desc  = pl_meta('pl_fly_g2_desc',  'Hall ferdig montert på ny lokasjon');
$g2_img   = pl_meta('pl_fly_g2_img',   '');

$cta_btn = pl_meta('pl_fly_cta_btn', 'Be om tilbud');
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

    <!-- Intro -->
    <section class="py-16 sm:py-20 lg:py-24">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-light text-[#003a76] mb-8 text-center"><?php echo esc_html($intro_title); ?></h2>
            <div class="space-y-6 text-base sm:text-lg text-gray-700 leading-relaxed">
                <p><?php echo esc_html($intro_p1); ?></p>
                <p><?php echo esc_html($intro_p2); ?></p>
                <p><?php echo esc_html($intro_p3); ?></p>
                <p><?php echo esc_html($intro_p4); ?></p>
                <p class="font-medium text-[#003a76] text-center pt-4"><?php echo esc_html($intro_cta); ?></p>
            </div>
        </div>
    </section>

    <!-- Process (6 steps) -->
    <section class="py-16 sm:py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 sm:mb-16">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-light text-[#003a76] mb-4"><?php echo esc_html($proc_title); ?></h2>
                <p class="text-base sm:text-lg text-gray-600 max-w-3xl mx-auto"><?php echo esc_html($proc_intro); ?></p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                <?php foreach ($process as $i => $p) : if (!$p['title']) continue; ?>
                    <div class="bg-white p-6 sm:p-8 rounded-lg shadow-lg border border-gray-100 relative">
                        <div class="absolute top-4 right-4 w-8 h-8 bg-[#003a76] text-white rounded-full flex items-center justify-center text-sm font-bold"><?php echo $i + 1; ?></div>
                        <div class="w-12 h-12 bg-blue-50 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-[#003a76]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <h3 class="text-lg sm:text-xl font-medium text-[#041024] mb-3"><?php echo esc_html($p['title']); ?></h3>
                        <p class="text-sm sm:text-base text-gray-600 leading-relaxed"><?php echo esc_html($p['desc']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Benefits -->
    <section class="py-16 sm:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-light text-[#003a76]"><?php echo esc_html($ben_title); ?></h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <?php foreach ($benefits as $b) : if (!$b['title']) continue; ?>
                    <div class="text-center">
                        <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-6">
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
    <section class="py-16 sm:py-20 bg-gray-50">
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
            <h2 class="text-3xl sm:text-4xl font-light text-white mb-6">Klar for å flytte hallen?</h2>
            <a href="<?php echo esc_url(home_url('/kontakt')); ?>" class="inline-block bg-white text-[#003a76] hover:bg-gray-100 px-8 py-4 text-lg font-medium rounded-lg transition-colors"><?php echo esc_html($cta_btn); ?> →</a>
        </div>
    </section>
</div>

<?php get_footer(); ?>
