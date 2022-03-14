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
        <?php wp_nav_menu([
            'theme_location' => 'header',
            'container' => false,
            'menu_class' => "navbar-nav me-auto mb-2 mb-lg-0"
        ]);
        ?>
        <?php
            if ( is_user_logged_in() ) { ?>
                <button class="button-log disconnect" type="button" onclick="window.location.href = '<?php echo wp_logout_url(get_permalink()); ?>';">Déconnexion</button>
                <?php }
            else { ?>
                <button class="button-log connect" type="button" onclick="window.location.href = '/login';">Connexion</button>
            <?php } ?>
    </div>
    <?php get_search_form(); ?>
</header>

