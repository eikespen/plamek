<?php get_header(); ?>

<div class="min-h-screen bg-white">
    <?php while (have_posts()) : the_post(); ?>
        <section class="py-32 sm:py-40">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <h1 class="text-4xl font-light text-[#003a76] mb-8"><?php the_title(); ?></h1>
                <div class="prose prose-lg max-w-none">
                    <?php the_content(); ?>
                </div>
            </div>
        </section>
    <?php endwhile; ?>
</div>

<?php get_footer(); ?>
