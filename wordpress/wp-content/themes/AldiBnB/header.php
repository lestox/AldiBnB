<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <?php wp_head(); ?>
</head>

<body>
    <?php wp_nav_menu([
        'theme_location' => 'header',
        'container' => false,
        'menu_class' => "navbar-nav me-auto mb-2 mb-lg-0"
    ]); ?>

        <?php if ( is_user_logged_in() ) { ?>
        <button type="button" onclick="window.location.href = '<?php echo wp_logout_url(get_permalink()); ?>';">Déconnexion
            <?php } else { ?>
            <button type="button" onclick="window.location.href = '/login';">Connexion
                <?php } ?>
            </button>


