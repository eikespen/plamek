<?php get_header(); ?>

<div class="min-h-screen bg-white">
    <?php while (have_posts()) : the_post(); ?>
        <article>
            <section class="relative bg-[#041024] py-20 pt-32 sm:pt-40">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="absolute inset-0 opacity-30">
                        <?php the_post_thumbnail('large', ['class' => 'w-full h-full object-cover']); ?>
                    </div>
                <?php endif; ?>
                <div class="absolute inset-0 bg-[#041024]/70"></div>
                <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <p class="text-white/70 text-sm uppercase tracking-wide mb-4">Referanse</p>
                    <h1 class="text-3xl sm:text-4xl md:text-5xl font-light text-white"><?php the_title(); ?></h1>
                </div>
            </section>

            <section class="py-16">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="prose prose-lg max-w-none">
                        <?php the_content(); ?>
                    </div>

                    <div class="mt-12 pt-8 border-t border-gray-200 text-center">
                        <a href="<?php echo esc_url(home_url('/referanser')); ?>" class="text-[#003a76] font-medium hover:underline">← Tilbake til alle referanser</a>
                    </div>
                </div>
            </section>
        </article>
    <?php endwhile; ?>
</div>

<?php get_footer(); ?>
