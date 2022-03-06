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
    echo '<h5 class="card-title">' . get_the_title() . '</h5>';
    echo '<a href="' . get_the_permalink() . '">Lien annonce </a>';
    echo "<br>";
    }

    wp_reset_query();?>



<?php get_footer(); ?>