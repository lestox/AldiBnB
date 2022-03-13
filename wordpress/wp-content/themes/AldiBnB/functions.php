<?php
add_action('after_setup_theme', 'aldibnbSetupTheme');
function aldibnbSetupTheme()
{
    add_theme_support('title-tag');
    //add_theme_support('post-thumbnails');
    add_theme_support('menus');
    register_nav_menu('header', 'Menu du header');
}

add_action('init', 'update_anyone_can_register');
function update_anyone_can_register() {
    update_option('users_can_register', true);
}

add_action( 'admin_init', 'restrict_admin', 1 );
function restrict_admin()
{
    if ( ! current_user_can( 'manage_options' ) && '/wp-admin/admin-ajax.php' != $_SERVER['PHP_SELF'] ) {
        wp_redirect( site_url() );
    }
}

add_action('wp_logout','auto_redirect_after_logout');
function auto_redirect_after_logout(){
    wp_safe_redirect( home_url() );
    exit;
}

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

add_filter('nav_menu_css_class', function ($classes) {
    $classes[] = "nav-item";
    return $classes;
});

add_filter('nav_menu_link_attributes', function ($attr) {
    $attr['class'] = 'nav-link';
    return $attr;
});

function aldibnbPaginate()
{
    $pages = paginate_links(['type' => 'array']);
    if (!$pages) {
        return null;
    }

    ob_start();
    echo '<nav aria-label="Page navigation example">';
    echo '<ul class="pagination">';

    foreach ($pages as $page) {
        $active = strpos($page, 'current');
        $liClass = $active ? 'page-item active' : 'page-item';
        $page = str_replace('page-numbers', 'page-link', $page);

        echo sprintf('<li class="%s">%s</li>', $liClass, $page);
    }
    echo '</ul></nav>';

    return ob_get_clean();
}

add_action( 'wp_enqueue_scripts', 'safely_add_stylesheet' );

// load css into the website's front-end
function mytheme_enqueue_style() {
    wp_enqueue_style( 'style', get_stylesheet_uri());
}
add_action( 'wp_enqueue_scripts', 'mytheme_enqueue_style' );

// Redirection page WP login vers custom
function redirect_login() {
    $login_page  = home_url('/login/');
    $page_viewed = basename($_SERVER['REQUEST_URI']);

    if($page_viewed == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
        wp_redirect($login_page);
        exit;
    }
}
add_action('init','redirect_login');

// Gestion des erreurs de connexion
function custom_login_failed() {
    $login_page  = home_url('/login/');
    wp_redirect($login_page . '?login=failed');
    exit;
}
add_action('wp_login_failed', 'custom_login_failed');

// Si un des deux champ est vide
function verify_user_pass($user, $username, $password) {
    $login_page  = home_url('/login/');
    if($username == "" || $password == "") {
        wp_redirect($login_page . "?login=empty");
        exit;
    }
}
add_filter('authenticate', 'verify_user_pass', 1, 3);

