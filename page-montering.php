<?php
/**
 * Template Name: Montering
 */
get_header();
$pid = get_the_ID();

$site_phone = pl_opt('phone', '70 00 86 04');
$site_email = pl_opt('email', 'post@plamek.no');

// Hero
$h_t1   = pl_meta('pl_mont_hero_title1', 'Montering og');
$h_t2   = pl_meta('pl_mont_hero_title2', 'demontering');
$h_desc = pl_meta('pl_mont_hero_desc',   'Trenger du å montere eller demontere en hall? Vi utfører montering og demontering på alle typer dukhaller og stålhaller over hele landet.');
$h_tag  = pl_meta('pl_mont_hero_tag',    'Ledende spesialist innen design, produksjon og konstruksjon.');
$h_img  = pl_meta('pl_mont_hero_image',  get_template_directory_uri() . '/assets/images/montering.webp');

// Intro
$intro_title = pl_meta('pl_mont_intro_title', 'Rask montering og demontering av plasthaller og stålbygg');
$intro_p1    = pl_meta('pl_mont_intro_p1',    'Vi hjelper deg med montering av ditt bygg raskt og effektivt. Vi jobber med både plasthaller og stålbygg. Plamek har over 30 års erfaring i bransjen, og med dyktige og erfarne fagfolk håndterer vi alle typer byggeprosjekter, fra enkle konstruksjoner til de mest komplekse prosjektene.');
$intro_p2    = pl_meta('pl_mont_intro_p2',    'Vi setter opp hallen din der du måtte ønske, uavhengig om det er en dukhall eller stålhall.');

// Card 1 — Montering plasthall
$c1_title = pl_meta('pl_mont_card1_title', 'Montering plasthall');
$c1_sub   = pl_meta('pl_mont_card1_sub',   'Vi monterer din hall – trygt og effektivt');
$c1_desc  = pl_meta('pl_mont_card1_desc',  'Hos oss kan du være trygg på at monteringsjobben utføres på en sikker og god måte.');
$c1_ext   = pl_meta('pl_mont_card1_ext',   'Alle våre ansatte har sertifikater og kurs som ivaretar kvalitet og sikkerhet på byggeplassen. Trygge og faglig dyktige medarbeider er viktig for å ivareta kvaliteten du som kunde fortjener. Slik at du slipper å tenke på bygget, og heller fokusere på bedriftens kjernevirksomhet.');
$c1_b1    = pl_meta('pl_mont_card1_b1',    'Sertifiserte og erfarne fagfolk');
$c1_b2    = pl_meta('pl_mont_card1_b2',    'Fokus på sikkerhet og kvalitet');
$c1_b3    = pl_meta('pl_mont_card1_b3',    'Trygg og effektiv utførelse');

// Card 2 — Demontering
$c2_title = pl_meta('pl_mont_card2_title', 'Demontering av hall');
$c2_desc  = pl_meta('pl_mont_card2_desc',  'Har du behov for å demontere en hall? Vi tar oppdrag for demontering av haller over hele landet. Vi tilbyr også flytting av hall.');
$c2_ext   = pl_meta('pl_mont_card2_ext',   'Kontakt oss i dag for et uforpliktende tilbud for montering eller demontering av din hall!');
$c2_b1    = pl_meta('pl_mont_card2_b1',    'Demontering over hele landet');
$c2_b2    = pl_meta('pl_mont_card2_b2',    'Flytting av eksisterende haller');
$c2_b3    = pl_meta('pl_mont_card2_b3',    'Uforpliktende tilbud');

// Stålbygg section
$st_title = pl_meta('pl_mont_st_title', 'Montering stålbygg');
$st_desc  = pl_meta('pl_mont_st_desc',  'Vi har omfattende erfaring med montering av stålbygg og stålkonstruksjoner. Fra enkle konstruksjoner til komplekse industriprosjekter.');

// Contact section
$ct_title = pl_meta('pl_mont_ct_title', 'Kontakt oss for et uforpliktende tilbud');
$ct_desc  = pl_meta('pl_mont_ct_desc',  'Trenger du montering eller demontering av hall? Vi gir deg et konkurransedyktig tilbud basert på dine behov.');
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
            <p class="text-base sm:text-lg lg:text-xl text-white/90 leading-relaxed max-w-3xl mx-auto px-4 mb-4"><?php echo esc_html($h_desc); ?></p>
            <p class="text-sm sm:text-base text-white/70 italic"><?php echo esc_html($h_tag); ?></p>
        </div>
    </section>

    <!-- Intro -->
    <section class="py-16 sm:py-20 lg:py-24">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-light text-[#003a76] mb-8"><?php echo esc_html($intro_title); ?></h2>
            <div class="space-y-6 text-base sm:text-lg text-gray-700 leading-relaxed text-left">
                <p><?php echo esc_html($intro_p1); ?></p>
                <p><?php echo esc_html($intro_p2); ?></p>
            </div>
        </div>
    </section>

    <!-- Service Cards (2 large) -->
    <section class="py-16 sm:py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Card 1 -->
                <div class="bg-white p-8 rounded-lg shadow-lg border border-gray-100">
                    <h3 class="text-2xl font-medium text-[#003a76] mb-2"><?php echo esc_html($c1_title); ?></h3>
                    <p class="text-lg text-gray-700 italic mb-4"><?php echo esc_html($c1_sub); ?></p>
                    <p class="text-gray-700 leading-relaxed mb-4"><?php echo esc_html($c1_desc); ?></p>
                    <p class="text-gray-700 leading-relaxed mb-6"><?php echo esc_html($c1_ext); ?></p>
                    <ul class="space-y-2 text-gray-700">
                        <?php foreach ([$c1_b1, $c1_b2, $c1_b3] as $b) : if (!$b) continue; ?>
                            <li class="flex items-start"><span class="text-[#003a76] mr-2 mt-1">✓</span><?php echo esc_html($b); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Card 2 -->
                <div class="bg-white p-8 rounded-lg shadow-lg border border-gray-100">
                    <h3 class="text-2xl font-medium text-[#003a76] mb-4"><?php echo esc_html($c2_title); ?></h3>
                    <p class="text-gray-700 leading-relaxed mb-4"><?php echo esc_html($c2_desc); ?></p>
                    <p class="text-gray-700 leading-relaxed mb-6"><?php echo esc_html($c2_ext); ?></p>
                    <ul class="space-y-2 text-gray-700">
                        <?php foreach ([$c2_b1, $c2_b2, $c2_b3] as $b) : if (!$b) continue; ?>
                            <li class="flex items-start"><span class="text-[#003a76] mr-2 mt-1">✓</span><?php echo esc_html($b); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Stålbygg section -->
    <section class="py-16 sm:py-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-light text-[#003a76] mb-6"><?php echo esc_html($st_title); ?></h2>
            <p class="text-base sm:text-lg text-gray-700 leading-relaxed"><?php echo esc_html($st_desc); ?></p>
        </div>
    </section>

    <!-- Contact CTA -->
    <section class="py-16 sm:py-20 bg-gradient-to-br from-[#003a76] to-[#002855]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl font-light text-white mb-6"><?php echo esc_html($ct_title); ?></h2>
                <p class="text-lg text-white/90 max-w-3xl mx-auto"><?php echo esc_html($ct_desc); ?></p>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="space-y-6">
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-white/20">
                        <h3 class="text-lg font-semibold text-white mb-2">Ring oss direkte</h3>
                        <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $site_phone)); ?>" class="text-2xl font-light text-white"><?php echo esc_html($site_phone); ?></a>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-white/20">
                        <h3 class="text-lg font-semibold text-white mb-2">Send e-post</h3>
                        <a href="mailto:<?php echo esc_attr($site_email); ?>" class="text-xl text-white"><?php echo esc_html($site_email); ?></a>
                    </div>
                </div>
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-2xl">
                        <h3 class="text-2xl font-semibold text-[#003a76] mb-6">Send oss en forespørsel</h3>
                        <?php get_template_part('template-parts/contact-form'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php get_footer(); ?>
