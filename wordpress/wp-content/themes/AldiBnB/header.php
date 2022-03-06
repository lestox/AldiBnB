<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php wp_head(); ?>
</head>
<body>
<a href="/">AldiBnB</a>
<?php wp_nav_menu ([
        'theme_location'  => 'header',
    'menu_class' => '',
    'container' => false
]); ?>
