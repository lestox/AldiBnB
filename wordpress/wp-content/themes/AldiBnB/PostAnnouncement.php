<?php
/**
 * Template Name: Post announcement
 * Template Post Type: page
 */
?>

<?php get_header(); ?>

<form action="<?= admin_url('admin-post.php'); ?>" method="post">
    <!-- Titre de l'article -->
    <label for="post_title">Titre de mon article</label><br/>
    <input type="text" name="post_title" id="post_title"/><br/>


    <label for="post_content">La description</label><br/>
    <textarea name="post_content" id="post_content"></textarea><br/>



    <!-- Le champs d'action -->
    <input type="hidden" name="action" value="aldibnb_form"/>

    <!-- Crée les champs de nonce et de referer -->
    <?php wp_nonce_field( 'post_nonce', 'post_nonce_field' ); ?>

    <input type="submit" name="submit_post" id="submit_post" value="Publier mon article" />

</form>

<?php get_footer(); ?>