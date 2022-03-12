<?php get_header(); ?>
<h1>AldiBnB</h1>

<?php if (have_posts()) : ?>
        <?php while (have_posts()) : ?>

            <?php the_post(); ?>
                <?php the_post_thumbnail_url(); ?>

                    <?php if (get_post_meta(get_the_ID(), 'wpheticSponso', true)) : ?>
                    <?php endif; ?>
                    <?php the_title(); ?>
                    <?= the_terms(get_the_ID(), 'style'); ?>
                    <?php the_content(); ?>
                    <?php the_permalink(); ?>
        <?php endwhile; ?>

    <?= aldibnbPaginate() ?>

<?php endif; ?>

<?php get_footer(); ?>
