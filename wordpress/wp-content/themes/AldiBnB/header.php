<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>AldiBnB</title>
    <?php wp_head(); ?>
</head>

<header>
    <div id="flex-top-header">
        <a id="logo" href="/">AldiBnb</a>
        <?php /*wp_nav_menu([
            'theme_location' => 'header',
            'container' => false,
            'menu_class' => "navbar-nav me-auto mb-2 mb-lg-0"
        ]);
        */?>
        <span><a id="annonces" href="/toutes-les-annonces"><b>Nos annonces</b></a></span>
        <?php
            if ( is_user_logged_in() ) { ?>
                <span><a id="post-annonce" href="/poster-une-annonce"><b>Poster votre annonce</b></a></span>
                <button class="button-log disconnect" type="button" onclick="window.location.href = '<?php echo wp_logout_url(get_permalink()); ?>';">Deconnexion</button>
                <?php }
            else { ?>
                <div id="buttons">
                    <button class="button-log register" type="button" onclick="window.location.href = '/register';">Inscription</button>
                    <button class="button-log connect" type="button" onclick="window.location.href = '/login';">Connexion</button>
                </div>
            <?php } ?>
    </div>
    <?php get_search_form(); ?>
</header>

