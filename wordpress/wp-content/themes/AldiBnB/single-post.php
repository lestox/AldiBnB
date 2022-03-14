<?php get_header(); ?>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>

        <div>
<<<<<<< Updated upstream
            <img src="<?php the_post_thumbnail_url(); ?>" alt="Image">
            <div>
                <h5><?php the_title(); ?></h5>
                <p><?php the_content()?></p>
=======
            <div class="single_post">
                <h2><?php the_title(); ?></h2>
                <div class="infos">
                <p><?php echo($price) ?> €/nuit</p>
                <p><?php echo($city) ?></p>
                <p><?php echo($capacity) ?> personnes</p>
                <p><?php echo($room) ?> chambres</p>
                </div>
                <img src="<?php echo $picture; ?>" alt="Image">
                <p class="content"><?php the_content()?></p>
>>>>>>> Stashed changes
                <p><small>Ecrit le : <?php the_date(); ?></small></p>

            </div>
        </div>

    <?php endwhile; ?>
<?php else : ?>
    <h2>Pas de posts</h2>
<?php endif; ?>

<<<<<<< Updated upstream
<?php get_footer(); ?>
=======


>>>>>>> Stashed changes

