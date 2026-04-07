<?php
/**
 * Template Name: Kontakt
 */
get_header();
$pid = get_the_ID();

$h_t1   = pl_meta('pl_kt_hero_title1', 'Kontakt');
$h_t2   = pl_meta('pl_kt_hero_title2', 'oss');
$h_desc = pl_meta('pl_kt_hero_desc',   'Ta kontakt med oss for spørsmål, tilbud eller en uforpliktende prat.');

$addr_title  = pl_meta('pl_kt_addr_title',  'Besøksadresse');
$addr_text   = pl_meta('pl_kt_addr_text',   "Sundvollhovet\nN-3535 Krøderen");
$phone_title = pl_meta('pl_kt_phone_title', 'Telefon');
$phone_text  = pl_meta('pl_kt_phone_text',  '+47 70 00 86 04');
$email_title = pl_meta('pl_kt_email_title', 'E-post');
$email_text  = pl_meta('pl_kt_email_text',  'post@plamek.no');
$hours_title = pl_meta('pl_kt_hours_title', 'Åpningstider');
$hours_text  = pl_meta('pl_kt_hours_text',  "Mandag–fredag: 08:00–16:00\nLørdag–søndag: stengt");

$form_title = pl_meta('pl_kt_form_title', 'Send oss en melding');
$form_intro = pl_meta('pl_kt_form_intro', 'Vi svarer normalt innen 24 timer.');
?>

<div class="min-h-screen bg-white">
    <!-- Hero -->
    <section class="relative bg-[#041024] py-16 sm:py-20 lg:py-24 pt-32 sm:pt-40 lg:pt-48">
        <div class="absolute inset-0 bg-[#041024]/70"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-light text-white mb-6">
                <?php echo esc_html($h_t1); ?> <span class="font-medium"><?php echo esc_html($h_t2); ?></span>
            </h1>
            <p class="text-base sm:text-lg lg:text-xl text-white/90 leading-relaxed px-4"><?php echo esc_html($h_desc); ?></p>
        </div>
    </section>

    <!-- Contact info + form -->
    <section class="py-16 sm:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Info column -->
                <div class="space-y-8 lg:col-span-1">
                    <div>
                        <h3 class="text-lg font-semibold text-[#003a76] mb-2"><?php echo esc_html($addr_title); ?></h3>
                        <p class="text-gray-700 whitespace-pre-line"><?php echo esc_html($addr_text); ?></p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-[#003a76] mb-2"><?php echo esc_html($phone_title); ?></h3>
                        <p class="text-gray-700"><a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $phone_text)); ?>" class="hover:text-[#003a76]"><?php echo esc_html($phone_text); ?></a></p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-[#003a76] mb-2"><?php echo esc_html($email_title); ?></h3>
                        <p class="text-gray-700"><a href="mailto:<?php echo esc_attr($email_text); ?>" class="hover:text-[#003a76]"><?php echo esc_html($email_text); ?></a></p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-[#003a76] mb-2"><?php echo esc_html($hours_title); ?></h3>
                        <p class="text-gray-700 whitespace-pre-line"><?php echo esc_html($hours_text); ?></p>
                    </div>
                </div>

                <!-- Form column -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-xl border border-gray-100">
                        <h2 class="text-2xl font-medium text-[#003a76] mb-2"><?php echo esc_html($form_title); ?></h2>
                        <p class="text-gray-600 mb-6"><?php echo esc_html($form_intro); ?></p>
                        <?php get_template_part('template-parts/contact-form'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php get_footer(); ?>
