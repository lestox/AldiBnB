<?php
/**
 * Template Name: Post announcement
 * Template Post Type: page
 */
?>

<?php get_header(); ?>
    <section id="presentation">
        <div class="text">
            <h1>Poster une annonce</h1>
            <form action="<?= admin_url('admin-post.php'); ?>" method="post" enctype="multipart/form-data">
                <!-- Titre de l'article -->
                <label for="post_title">Titre de mon article</label><br/>
                <input type="text" name="post_title" id="post_title"/><br/>
              
                <label for="post_content">La description</label><br/>
                <textarea name="post_content" id="post_content"></textarea><br/>

                <label for="price">Prix par nuit</label><br/>
                <input type="number" name="price" id="price"/><br/>

                <label for="city">Ville</label><br/>
                <input type="text" name="city" id="city"/><br/>

                <label for="capacity">Nombre de voyageurs</label><br/>
                <input type="number" name="capacity" id="capacity"/><br/>

                <label for="room">Nombre de chambres</label><br/>
                <input type="number" name="room" id="room"/><br/>

                <label for="image_upload">Choisis une image</label><br/>
                <input type="file" name="image_upload" id="image_upload" multiple="false"/><br/>


                <!-- Le champs d'action -->
                <input type="hidden" name="action" value="aldibnb_form"/>

                <!-- Crée les champs de nonce et de referer -->
                <?php wp_nonce_field( 'post_nonce', 'post_nonce_field' ); ?>

                <input type="submit" name="submit_post" id="submit_post" value="Publier mon article" />
            </form>
        </div>
    </section>
<?php get_footer(); ?>