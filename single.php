<?php get_header(); ?>

<div class="min-h-screen bg-white">
    <?php while (have_posts()) : the_post(); ?>
        <article>
            <section class="relative bg-gradient-to-br from-[#003a76] to-[#002a5c] py-20 pt-32 sm:pt-40">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                    <p class="text-white/80 text-sm uppercase tracking-wide mb-4"><?php echo esc_html(pl_format_date_norwegian(get_the_date('Y-m-d'))); ?></p>
                    <h1 class="text-3xl sm:text-4xl md:text-5xl font-light text-white mb-6"><?php the_title(); ?></h1>
                    <div class="flex items-center text-white/90 text-sm space-x-6">
                        <span><?php the_author(); ?></span>
                    </div>
                </div>
            </section>

            <?php if (has_post_thumbnail()) : ?>
                <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 -mt-12 relative z-10">
                    <?php the_post_thumbnail('large', ['class' => 'w-full h-auto rounded-lg shadow-2xl']); ?>
                </div>
            <?php endif; ?>

            <section class="py-16">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="prose prose-lg max-w-none">
                        <?php the_content(); ?>
                    </div>
                </div>
            </section>
        </article>
    <?php endwhile; ?>
</div>

<?php get_footer(); ?>
