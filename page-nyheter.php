<?php
/**
 * Template Name: Nyheter
 */
get_header();

$h_t1   = pl_meta('pl_simple_hero_title1', 'Nyheter og');
$h_t2   = pl_meta('pl_simple_hero_title2', 'oppdateringer');
$h_desc = pl_meta('pl_simple_hero_desc',   'Siste nytt fra Plamek AS — prosjekter, milepæler og bransjenyheter.');
$h_img  = pl_meta('pl_simple_hero_image',  get_template_directory_uri() . '/assets/images/hero-default.jpg');
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

    <!-- Posts grid -->
    <section class="py-16 sm:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <?php
            $q = new WP_Query([
                'post_type'      => 'post',
                'posts_per_page' => 9,
                'paged'          => max(1, get_query_var('paged')),
            ]);
            if ($q->have_posts()) : ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php while ($q->have_posts()) : $q->the_post(); ?>
                        <article class="bg-white rounded-lg overflow-hidden shadow-lg border border-gray-100 hover:shadow-xl transition-shadow">
                            <a href="<?php the_permalink(); ?>" class="block">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('medium_large', ['class' => 'w-full h-56 object-cover']); ?>
                                <?php endif; ?>
                            </a>
                            <div class="p-6">
                                <p class="text-xs text-gray-500 mb-2 uppercase tracking-wide"><?php echo esc_html(pl_format_date_norwegian(get_the_date('Y-m-d'))); ?></p>
                                <h3 class="text-xl font-medium text-[#003a76] mb-3">
                                    <a href="<?php the_permalink(); ?>" class="hover:underline"><?php the_title(); ?></a>
                                </h3>
                                <p class="text-gray-600 text-sm mb-4 leading-relaxed"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 25)); ?></p>
                                <a href="<?php the_permalink(); ?>" class="text-[#003a76] font-medium hover:underline text-sm">Les mer →</a>
                            </div>
                        </article>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>

                <?php
                $total = $q->max_num_pages;
                if ($total > 1) :
                    echo '<div class="mt-12 flex justify-center">';
                    echo paginate_links([
                        'total'   => $total,
                        'current' => max(1, get_query_var('paged')),
                    ]);
                    echo '</div>';
                endif;
                ?>
            <?php else : ?>
                <p class="text-center text-gray-500">Ingen nyheter publisert ennå.</p>
            <?php endif; ?>
        </div>
    </section>
</div>

<?php get_footer(); ?>
