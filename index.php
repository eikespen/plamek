<?php
/**
 * Fallback index template.
 * Plamek uses dedicated page templates — this file exists only because WordPress requires it.
 */
get_header();
?>

<main class="min-h-screen pt-32 pb-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <article class="mb-12">
                    <h1 class="text-4xl font-light text-[#003a76] mb-6"><?php the_title(); ?></h1>
                    <div class="prose prose-lg max-w-none">
                        <?php the_content(); ?>
                    </div>
                </article>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
