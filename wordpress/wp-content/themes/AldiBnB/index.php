<?php
/**
 * Template Name: Toutes les annonces
 * Template Post Type: page
 */
?>

<?php get_header(); ?>

<?php if (have_posts()) : ?>
    <div>
        <?php while (have_posts()) : ?>

            <?php the_post();
            $picture = get_post_meta(get_the_ID(), 'image', true);?>

            <div>
                <img src="<?php echo($picture); ?>" alt="...">
                <div>
                    <h5><?php the_title(); ?></h5>
                    <p><?php the_content(); ?></p>
                    <a href="<?php the_permalink(); ?>">Lire plus</a>
                </div>
            </div>

        <?php endwhile; ?>

    </div>

    <?= aldibnbPaginate() ?>

<?php endif; ?>

<?php get_footer(); ?>