<?php
/*

Plugin Name: Login/Logout Cusom
Version: 1.0

*/

// Redirection après logout
add_action('wp_logout','auto_redirect_after_logout');
function auto_redirect_after_logout(){
    wp_safe_redirect( home_url() );
    exit;
}

// Redirection si l'utilisateur est déjà connecté
add_action('wp', 'add_login_check');
function add_login_check()
{
    if (is_user_logged_in()) {
        if (is_page(28)){
            wp_redirect('/');
            exit;
        }
    }
}

// Redirection page login WP de base vers notre page custom
add_action('init','redirect_login');
function redirect_login() {
    $login_page  = home_url('/login');
    $page_viewed = basename($_SERVER['REQUEST_URI']);

    if($page_viewed == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET' && (get_page_by_title('login'))) {
        wp_redirect($login_page);
        exit;
    }
}

// Gestion des erreurs de connexion
add_action('wp_login_failed', 'custom_login_failed');
function custom_login_failed() {
    $login_page  = home_url('/login/');
    wp_redirect($login_page . '?login=failed');
    exit;
}

// Si un des deux champ est vide
add_filter('authenticate', 'verify_user_pass', 1, 3);
function verify_user_pass($user, $username, $password) {
    $login_page  = home_url('/login/');
    if($username == "" || $password == "") {
        wp_redirect($login_page . "?login=empty");
        exit;
    }
}
