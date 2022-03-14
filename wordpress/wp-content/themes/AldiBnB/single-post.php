<?php get_header(); ?>

<?php
$price = get_post_meta(get_the_ID(), 'price', true);
$city = get_post_meta(get_the_ID(), 'city', true);
$capacity = get_post_meta(get_the_ID(), 'capacity', true);
$room = get_post_meta(get_the_ID(), 'room', true);
$picture = get_post_meta(get_the_ID(), 'image', true);

?>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>

        <div>
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
                <p><small>Ecrit le : <?php the_date(); ?></small></p>
            </div>
        </div>

    <?php endwhile; ?>
<?php else : ?>
    <h2>Pas de posts</h2>
<?php endif; ?>






