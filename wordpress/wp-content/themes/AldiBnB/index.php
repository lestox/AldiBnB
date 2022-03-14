<?php
/**
 * Template Name: Toutes les annonces
 * Template Post Type: page
 */
?>

<?php get_header(); ?>

<?php if (have_posts()) : ?>
    <div id="all_posts">
        <?php while (have_posts()) : ?>

            <?php the_post();
            $price = get_post_meta(get_the_ID(), 'price', true);
            $picture = get_post_meta(get_the_ID(), 'image', true);
            ?>
            <div id="unique_post">
                <img src="<?php echo $picture?>" alt="pics">
                <div>
                    <div id="head-title">
                        <h5><?php the_title(); ?></h5>
                        <span><?php echo $price?>€</span>
                    </div>
                    <p><?php the_content(); ?></p>
                    <a href="<?php the_permalink(); ?>">Lire plus</a>
                </div>
            </div>

        <?php endwhile; ?>

    </div>

    <?= aldibnbPaginate() ?>

<?php endif; ?>

<?php get_footer(); ?>