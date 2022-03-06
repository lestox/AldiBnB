<?php
/*
Template Name: Toutes les annonces
*/
?>
<?php get_header(); ?>
<?php
    $query = new WP_Query(array(
    'post_status' => 'publish'
    ));


    while ($query->have_posts()) {
    $query->the_post();
    $post_id = get_the_ID();
    echo '<h5 class="card-title">' . the_title() . '</h5>';
    echo '<a href="' . the_permalink() . '">Lien annonce';
    echo $post_id;
    echo "<br>";
    }

    wp_reset_query();?>



<?php get_footer(); ?>