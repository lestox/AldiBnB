<?php
/*
Template Name: Search Result Page
*/
?>

<?php get_header(); ?>

<?php $query = new WP_Query(array('post_status' => 'publish')); ?>


<?php
$destination = '';
$nbPersonnes = '';

 if (isset($_GET['destination'])) {
     $destination .= $_GET['destination'];
 }

  if (isset($_GET['nb_personnes'])) {
     $nbPersonnes .= $_GET['$nb_personnes'];
 }

$args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
);

$query = new WP_Query( $args );
while ($query->have_posts()) { $query->the_post();
    echo '<h5 class="card-title">' . get_the_title() . '</h5>';
    echo '<a href="' . get_the_permalink() . '">Lien annonce </a>';
    echo "<br>";
}

wp_reset_query();?>




<?php get_footer(); ?>
