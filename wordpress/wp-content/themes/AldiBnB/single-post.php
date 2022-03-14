<?php /*get_header(); */?>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>

        <div>
            <img src="<?php the_post_thumbnail_url(); ?>" alt="Image">
            <div>
                <h5><?php the_title(); ?></h5>
                <p><?php the_content()?></p>
                <p><small>Ecrit le : <?php the_date(); ?></small></p>

            </div>
        </div>

    <?php endwhile; ?>
<?php else : ?>
    <h2>Pas de posts</h2>
<?php endif; ?>

<?php get_footer(); ?>

