<?php
/*
Template Name: Login
*/
?>

<?php get_header(); ?>


<?php // Si l'utilisateur est déja connecté
if(is_user_logged_in()){
    wp_redirect(home_url()); exit;
}?>

<?php // Si l'authentification échoue
if (isset($_GET['login']) && $_GET['login'] == 'failed'){
    echo '<div class="errorlogin">' . "Mot de passe et/ou nom d'utilisateur invalide. Réessayez" . '</div>';
} ?>

<?php // Si un champ est vide
if (isset($_GET['login']) && $_GET['login'] == 'empty'){
    echo '<div class="errorlogin">' . "Un des champ est vide. Veuillez réessayer" . '</div>';
} ?>

    <form class="loginForm" action="<?= home_url('wp-login.php'); ?>" method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Email ou Nom d'utilisateur</label>
            <input name="log" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Mot de passe</label>
            <input name="pwd" type="password" class="form-control" id="exampleInputPassword1" placeholder="Mot de passe">
        </div>
        <div class="form-check">
            <input name="rememberme" type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Se souvenir de moi</label>
        </div>
        <button name="wp-submit" type="submit" class="btn btn-primary">Connection</button>
        <input type="hidden" name="redirect_to" value="/"/>
    </form>

<?php get_footer(); ?>

