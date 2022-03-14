<?php /*get_header(); */?>

<?php
$price = get_post_meta(get_the_ID(), 'price', true);
$city = get_post_meta(get_the_ID(), 'city', true);
$capacity = get_post_meta(get_the_ID(), 'capacity', true);
$room = get_post_meta(get_the_ID(), 'room', true);
$image_upload = get_attached_file(get_the_ID());
$attachments = get_attached_media("images", $post->ID );
var_dump($attachments);
?>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>

        <div>
            <img src="<?php $image_upload ?>" alt="Image">
            <div>
                <h5><?php the_title(); ?></h5>
                <p><?php the_content()?></p>
                <p>Prix : <?php echo($price) ?></p>
                <p>Ville : <?php echo($city) ?></p>
                <p>Nombre de personnes : <?php echo($capacity) ?></p>
                <p>Nombre de chambres : <?php echo($room) ?></p>
                <p><small>Ecrit le : <?php the_date(); ?></small></p>

            </div>
        </div>

    <?php endwhile; ?>
<?php else : ?>
    <h2>Pas de posts</h2>
<?php endif; ?>

<?php //get_footer(); ?>

