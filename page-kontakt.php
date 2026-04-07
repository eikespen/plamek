<?php
/**
 * Template Name: Kontakt
 */
get_header();
$pid = get_the_ID();

$h_t1   = pl_meta('pl_kt_hero_title1', 'Kontakt');
$h_t2   = pl_meta('pl_kt_hero_title2', 'oss');
$h_desc = pl_meta('pl_kt_hero_desc',   'Ta kontakt for et uforpliktende tilbud på ditt neste monteringsprosjekt. Vi er klare til å hjelpe deg med profesjonelle løsninger.');

// 4 contact info cards
$ci1_label = pl_meta('pl_kt_ci1_label', 'Telefon');
$ci1_value = pl_meta('pl_kt_ci1_value', '+47 70 00 86 04');
$ci1_note  = pl_meta('pl_kt_ci1_note',  'Hverdager 07:00-16:00');

$ci2_label = pl_meta('pl_kt_ci2_label', 'E-post');
$ci2_value = pl_meta('pl_kt_ci2_value', 'post@plamek.no');
$ci2_note  = pl_meta('pl_kt_ci2_note',  'Svar innen 24 timer');

$ci3_label = pl_meta('pl_kt_ci3_label', 'Adresse');
$ci3_value = pl_meta('pl_kt_ci3_value', "Sundvollhovet\nN-3535 Krøderen");
$ci3_note  = pl_meta('pl_kt_ci3_note',  '');

$ci4_label = pl_meta('pl_kt_ci4_label', 'Åpningstider');
$ci4_value = pl_meta('pl_kt_ci4_value', "Man-Fre: 07:00-16:00\nLør-Søn: Stengt");
$ci4_note  = pl_meta('pl_kt_ci4_note',  '');

// CEO contact
$ceo_title = pl_meta('pl_kt_ceo_title', 'Snakk direkte med CEO');
$ceo_name  = pl_meta('pl_kt_ceo_name',  'Lars Erik Hoff');
$ceo_role  = pl_meta('pl_kt_ceo_role',  'CEO');
$ceo_email = pl_meta('pl_kt_ceo_email', 'leh@plamek.no');
$ceo_phone = pl_meta('pl_kt_ceo_phone', '(+47) 40 41 15 44');

// Form section
$form_title = pl_meta('pl_kt_form_title', 'Send oss en forespørsel');

// What happens next
$wh_title = pl_meta('pl_kt_wh_title', 'Hva skjer videre?');
$wh_l1    = pl_meta('pl_kt_wh_l1',    'Vi tar kontakt innen 24 timer');
$wh_l2    = pl_meta('pl_kt_wh_l2',    'Gratis befaring og tilbud');
$wh_l3    = pl_meta('pl_kt_wh_l3',    'Detaljert prosjektplan');

// Location
$loc_title  = pl_meta('pl_kt_loc_title',  'Finn oss');
$loc_label  = pl_meta('pl_kt_loc_label',  'Besøksadresse');
$loc_name   = pl_meta('pl_kt_loc_name',   'Plamek AS');
$loc_street = pl_meta('pl_kt_loc_street', 'Sundvollhovet');
$loc_postal = pl_meta('pl_kt_loc_postal', 'N-3535 Krøderen');
$loc_note   = pl_meta('pl_kt_loc_note',   'Vi anbefaler å avtale besøk på forhånd for å sikre at vi er tilgjengelige.');
?>

<div class="min-h-screen bg-white">
    <!-- Hero -->
    <section class="relative bg-[#041024] py-16 sm:py-20 lg:py-24 pt-32 sm:pt-40 lg:pt-48">
        <div class="absolute inset-0 bg-[#041024]/70"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-light text-white mb-6">
                <?php echo esc_html($h_t1); ?> <span class="font-medium"><?php echo esc_html($h_t2); ?></span>
            </h1>
            <p class="text-base sm:text-lg lg:text-xl text-white/90 leading-relaxed max-w-3xl mx-auto px-4"><?php echo esc_html($h_desc); ?></p>
        </div>
    </section>

    <!-- Contact info cards (4) -->
    <section class="py-16 sm:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php
                $info_cards = [
                    ['label' => $ci1_label, 'value' => $ci1_value, 'note' => $ci1_note],
                    ['label' => $ci2_label, 'value' => $ci2_value, 'note' => $ci2_note],
                    ['label' => $ci3_label, 'value' => $ci3_value, 'note' => $ci3_note],
                    ['label' => $ci4_label, 'value' => $ci4_value, 'note' => $ci4_note],
                ];
                foreach ($info_cards as $c) :
                ?>
                    <div class="bg-blue-50 rounded-xl p-6 text-center border border-blue-100">
                        <div class="w-12 h-12 bg-[#003a76] rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <h3 class="text-sm uppercase tracking-wide font-semibold text-[#003a76] mb-2"><?php echo esc_html($c['label']); ?></h3>
                        <p class="text-base font-medium text-[#041024] whitespace-pre-line"><?php echo esc_html($c['value']); ?></p>
                        <?php if ($c['note']) : ?>
                            <p class="text-xs text-gray-500 mt-2 whitespace-pre-line"><?php echo esc_html($c['note']); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- CEO contact -->
    <section class="py-16 bg-gradient-to-br from-[#003a76] to-[#002855]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20 text-center">
                <h2 class="text-2xl sm:text-3xl font-light text-white mb-6"><?php echo esc_html($ceo_title); ?></h2>
                <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
                <p class="text-xl font-medium text-white mb-1"><?php echo esc_html($ceo_name); ?></p>
                <p class="text-sm text-white/70 uppercase tracking-wide mb-6"><?php echo esc_html($ceo_role); ?></p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="mailto:<?php echo esc_attr($ceo_email); ?>" class="inline-flex items-center justify-center gap-2 bg-white text-[#003a76] px-6 py-3 rounded-lg font-medium hover:bg-gray-100 transition-colors"><?php echo esc_html($ceo_email); ?></a>
                    <a href="tel:<?php echo esc_attr(preg_replace('/[\s\(\)]/', '', $ceo_phone)); ?>" class="inline-flex items-center justify-center gap-2 border-2 border-white text-white px-6 py-3 rounded-lg font-medium hover:bg-white hover:text-[#003a76] transition-colors"><?php echo esc_html($ceo_phone); ?></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Form + What happens next -->
    <section class="py-16 sm:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-xl border border-gray-100">
                        <h2 class="text-2xl font-medium text-[#003a76] mb-6"><?php echo esc_html($form_title); ?></h2>
                        <?php get_template_part('template-parts/contact-form'); ?>
                    </div>
                </div>
                <div>
                    <div class="bg-blue-50 rounded-xl p-6 border border-blue-100 sticky top-32">
                        <h3 class="text-lg font-semibold text-[#003a76] mb-4"><?php echo esc_html($wh_title); ?></h3>
                        <ul class="space-y-3 text-sm text-gray-700">
                            <?php foreach ([$wh_l1, $wh_l2, $wh_l3] as $i => $line) : if (!$line) continue; ?>
                                <li class="flex items-start">
                                    <span class="flex-shrink-0 w-6 h-6 bg-[#003a76] text-white rounded-full flex items-center justify-center text-xs font-bold mr-3 mt-0.5"><?php echo $i + 1; ?></span>
                                    <span><?php echo esc_html($line); ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Location -->
    <section class="py-16 sm:py-20 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-light text-[#003a76] mb-12"><?php echo esc_html($loc_title); ?></h2>
            <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100 max-w-md mx-auto">
                <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-[#003a76]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <h3 class="text-sm uppercase tracking-wide font-semibold text-[#003a76] mb-3"><?php echo esc_html($loc_label); ?></h3>
                <p class="text-lg font-medium text-[#041024]"><?php echo esc_html($loc_name); ?></p>
                <p class="text-base text-gray-700"><?php echo esc_html($loc_street); ?></p>
                <p class="text-base text-gray-700 mb-4"><?php echo esc_html($loc_postal); ?></p>
                <p class="text-sm text-gray-500 italic"><?php echo esc_html($loc_note); ?></p>
            </div>
        </div>
    </section>
</div>

<?php get_footer(); ?>
