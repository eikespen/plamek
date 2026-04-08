<?php
/**
 * Template Name: Seksjonsside (fleksibel)
 *
 * A flexible "build your own page" template. Each section is rendered
 * only when its meta box checkbox is enabled. Sections appear in the
 * order they are listed below — drag/drop reordering is intentionally
 * not supported (keeps the meta box dependency-free).
 *
 * Section types (each can be enabled independently):
 *  - Hero
 *  - Two-column with image
 *  - Card grid (3 cards)
 *  - Stats row (4 numbers)
 *  - Gallery (2 images)
 *  - CTA banner
 *  - Text block
 */
get_header();
$pid = get_the_ID();

// Determine the rendering order from per-section "order" inputs (default 1..7).
$pl_sections = array('hero', 'twocol', 'cards', 'stats', 'gallery', 'cta', 'text');
$pl_ordered  = array();
foreach ($pl_sections as $pl_idx => $pl_s) {
    $pl_on = get_post_meta($pid, 'pl_sec_' . $pl_s . '_on', true);
    if ($pl_on !== '1') {
        continue;
    }
    $pl_order = (int) get_post_meta($pid, 'pl_sec_' . $pl_s . '_order', true);
    if ($pl_order <= 0) {
        $pl_order = $pl_idx + 1;
    }
    $pl_ordered[] = array('key' => $pl_s, 'order' => $pl_order);
}
if (!function_exists('pl_sort_sections_by_order')) {
    function pl_sort_sections_by_order($a, $b) {
        if ($a['order'] === $b['order']) return 0;
        return ($a['order'] < $b['order']) ? -1 : 1;
    }
}
usort($pl_ordered, 'pl_sort_sections_by_order');
?>

<div class="min-h-screen bg-white">
<?php foreach ($pl_ordered as $i => $entry) :
    $s         = $entry['key'];
    $alternate = ($i % 2 === 1);
    $bg        = $alternate ? 'bg-gray-50' : 'bg-white';
    ?>

    <?php if ($s === 'hero') :
        $h_t1   = pl_meta('pl_sec_hero_title1', '');
        $h_t2   = pl_meta('pl_sec_hero_title2', '');
        $h_desc = pl_meta('pl_sec_hero_desc',   '');
        $h_img  = pl_meta('pl_sec_hero_image',  '');
    ?>
        <section class="relative bg-gray-50 py-16 sm:py-20 lg:py-24 pt-32 sm:pt-40 lg:pt-48">
            <?php if ($h_img) : ?>
                <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('<?php echo esc_url($h_img); ?>');"></div>
            <?php endif; ?>
            <div class="absolute inset-0 bg-[#041024]/70"></div>
            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-light text-white mb-6">
                    <?php echo esc_html($h_t1); ?>
                    <?php if ($h_t2) : ?><span class="font-medium"> <?php echo esc_html($h_t2); ?></span><?php endif; ?>
                </h1>
                <?php if ($h_desc) : ?>
                    <p class="text-base sm:text-lg lg:text-xl text-white/90 leading-relaxed max-w-3xl mx-auto px-4"><?php echo esc_html($h_desc); ?></p>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>

    <?php if ($s === 'twocol') :
        $tc_title = pl_meta('pl_sec_twocol_title', '');
        $tc_body  = pl_meta('pl_sec_twocol_body',  '');
        $tc_img   = pl_meta('pl_sec_twocol_image', '');
        $tc_pos   = pl_meta('pl_sec_twocol_pos',   'right');
    ?>
        <section class="py-16 sm:py-20 <?php echo esc_attr($bg); ?>">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div class="<?php echo $tc_pos === 'left' ? 'order-2' : ''; ?>">
                        <h2 class="text-2xl sm:text-3xl md:text-4xl font-light text-[#003a76] mb-6"><?php echo esc_html($tc_title); ?></h2>
                        <div class="prose prose-lg max-w-none text-gray-700 whitespace-pre-line"><?php echo esc_html($tc_body); ?></div>
                    </div>
                    <?php if ($tc_img) : ?>
                        <div class="<?php echo $tc_pos === 'left' ? 'order-1' : ''; ?>">
                            <img src="<?php echo esc_url($tc_img); ?>" alt="<?php echo esc_attr($tc_title); ?>" class="w-full h-auto rounded-lg shadow-lg">
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if ($s === 'cards') :
        $c_title = pl_meta('pl_sec_cards_title', '');
        $c_intro = pl_meta('pl_sec_cards_intro', '');
        $cards = [];
        for ($n = 1; $n <= 3; $n++) {
            $cards[] = [
                'title' => pl_meta("pl_sec_card{$n}_title", ''),
                'desc'  => pl_meta("pl_sec_card{$n}_desc",  ''),
                'link'  => pl_meta("pl_sec_card{$n}_link",  ''),
                'image' => pl_meta("pl_sec_card{$n}_image", ''),
            ];
        }
    ?>
        <section class="py-16 sm:py-20 <?php echo esc_attr($bg); ?>">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <?php if ($c_title || $c_intro) : ?>
                    <div class="text-center mb-12">
                        <?php if ($c_title) : ?><h2 class="text-2xl sm:text-3xl md:text-4xl font-light text-[#003a76] mb-4"><?php echo esc_html($c_title); ?></h2><?php endif; ?>
                        <?php if ($c_intro) : ?><p class="text-base sm:text-lg text-gray-600 max-w-3xl mx-auto"><?php echo esc_html($c_intro); ?></p><?php endif; ?>
                    </div>
                <?php endif; ?>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
                    <?php foreach ($cards as $c) : if (!$c['title']) continue; ?>
                        <div class="bg-white p-6 sm:p-8 rounded-lg shadow-lg border border-gray-100 hover:shadow-xl transition-shadow">
                            <?php if ($c['image']) : ?>
                                <img src="<?php echo esc_url($c['image']); ?>" alt="<?php echo esc_attr($c['title']); ?>" class="w-full h-48 object-cover rounded mb-4">
                            <?php endif; ?>
                            <h3 class="text-xl font-medium text-[#003a76] mb-3"><?php echo esc_html($c['title']); ?></h3>
                            <p class="text-gray-600 leading-relaxed mb-4"><?php echo esc_html($c['desc']); ?></p>
                            <?php if ($c['link']) : ?>
                                <a href="<?php echo esc_url($c['link']); ?>" class="text-[#003a76] font-medium hover:underline">Les mer →</a>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if ($s === 'stats') :
        $stats = [];
        for ($n = 1; $n <= 4; $n++) {
            $stats[] = [
                'num'   => pl_meta("pl_sec_stat{$n}_num", ''),
                'label' => pl_meta("pl_sec_stat{$n}_label", ''),
            ];
        }
    ?>
        <section class="py-12 sm:py-16 lg:py-20 <?php echo esc_attr($bg); ?>">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-6 sm:gap-8 lg:gap-12 text-center">
                    <?php foreach ($stats as $stat) : if (!$stat['num']) continue; ?>
                        <div>
                            <div class="text-3xl sm:text-4xl lg:text-5xl font-light text-[#003a76] mb-2"><?php echo esc_html($stat['num']); ?></div>
                            <div class="text-xs sm:text-sm md:text-base text-slate-700 uppercase tracking-wide font-medium"><?php echo esc_html($stat['label']); ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if ($s === 'gallery') :
        $g_title = pl_meta('pl_sec_gallery_title', '');
        $g_intro = pl_meta('pl_sec_gallery_intro', '');
        $items = [];
        for ($n = 1; $n <= 2; $n++) {
            $items[] = [
                'image' => pl_meta("pl_sec_gallery{$n}_img",   ''),
                'title' => pl_meta("pl_sec_gallery{$n}_title", ''),
                'desc'  => pl_meta("pl_sec_gallery{$n}_desc",  ''),
            ];
        }
    ?>
        <section class="py-16 sm:py-20 <?php echo esc_attr($bg); ?>">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <?php if ($g_title || $g_intro) : ?>
                    <div class="text-center mb-12">
                        <?php if ($g_title) : ?><h2 class="text-2xl sm:text-3xl md:text-4xl font-light text-[#003a76] mb-4"><?php echo esc_html($g_title); ?></h2><?php endif; ?>
                        <?php if ($g_intro) : ?><p class="text-base sm:text-lg text-gray-600 max-w-3xl mx-auto"><?php echo esc_html($g_intro); ?></p><?php endif; ?>
                    </div>
                <?php endif; ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <?php foreach ($items as $g) : if (!$g['image']) continue; ?>
                        <div class="bg-white rounded-lg overflow-hidden shadow-lg">
                            <img src="<?php echo esc_url($g['image']); ?>" alt="<?php echo esc_attr($g['title']); ?>" class="w-full h-64 object-cover">
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

    <?php if ($s === 'cta') :
        $cta_title = pl_meta('pl_sec_cta_title', '');
        $cta_intro = pl_meta('pl_sec_cta_intro', '');
        $cta_btn   = pl_meta('pl_sec_cta_btn',   'Kontakt oss');
        $cta_link  = pl_meta('pl_sec_cta_link',  '/kontakt');
    ?>
        <section class="py-16 sm:py-20 lg:py-24 bg-[#003a76]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <?php if ($cta_title) : ?><h2 class="text-3xl sm:text-4xl font-light text-white mb-6"><?php echo esc_html($cta_title); ?></h2><?php endif; ?>
                <?php if ($cta_intro) : ?><p class="text-lg sm:text-xl text-white/90 mb-8 max-w-2xl mx-auto"><?php echo esc_html($cta_intro); ?></p><?php endif; ?>
                <?php if ($cta_btn) : ?>
                    <a href="<?php echo esc_url(home_url($cta_link)); ?>" class="inline-block bg-white text-[#003a76] hover:bg-gray-100 px-8 py-4 text-lg font-medium rounded-lg transition-colors"><?php echo esc_html($cta_btn); ?> →</a>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>

    <?php if ($s === 'text') :
        $t_title = pl_meta('pl_sec_text_title', '');
        $t_body  = pl_meta('pl_sec_text_body',  '');
    ?>
        <section class="py-16 sm:py-20 <?php echo esc_attr($bg); ?>">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <?php if ($t_title) : ?><h2 class="text-2xl sm:text-3xl md:text-4xl font-light text-[#003a76] mb-8 text-center"><?php echo esc_html($t_title); ?></h2><?php endif; ?>
                <?php if ($t_body) : ?><div class="prose prose-lg max-w-none text-gray-700 whitespace-pre-line"><?php echo esc_html($t_body); ?></div><?php endif; ?>
            </div>
        </section>
    <?php endif; ?>

<?php endforeach; ?>
</div>

<?php get_footer(); ?>
