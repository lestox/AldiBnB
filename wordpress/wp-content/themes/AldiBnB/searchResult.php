<?php
/*
Template Name: Search Result Page
*/
?>

<?php get_header(); ?>

<section id="presentation">
    <div class="text">
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
            $picture = get_post_meta(get_the_ID(), 'image', true);
            echo '<h5 class="card-title">' . get_the_title() . '</h5>'; ?>
            <img src="<?php echo $picture; ?>" alt="Image">
            <?php echo '<a href="' . get_the_permalink() . '">Lien annonce </a>';
            echo "<br>";
        }

        wp_reset_query();?>
    </div>
</section>

<?php get_footer(); ?>
