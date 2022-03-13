<?php
add_action('after_setup_theme', 'aldibnbSetupTheme');
function aldibnbSetupTheme()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    register_nav_menu('header', 'Menu du header');
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


add_action('admin_post_aldibnb_form', function () {
    if (!wp_verify_nonce($_POST['post_nonce_field'], 'post_nonce')) {
        die('Nonce invalide');
    }

    // Create post object
    $my_post = array(
        'post_title'    => wp_strip_all_tags( $_POST['post_title'] ),
        'post_content'  => $_POST['post_content'],
        'post_status'   => 'publish',
        'post_author'   => get_current_user_id()
    );

    // Insert the post into the database
    wp_insert_post( $my_post );

    // Traitement de l'image
    $attachment_id = media_handle_upload('image_upload', $_POST['post_id']);

    if (is_wp_error($attachment_id)) {
        wp_redirect($_POST['_wp_http_referer'] . '?status=error');
    } else {
        set_post_thumbnail($_POST['post_id'], $attachment_id);
    }

    // Puis je reviens sur mes pas en passant le message en URL
    // pour vérifier que tout a bien fonctionner
    wp_redirect( "/".wp_strip_all_tags( $_POST['post_title'] ));
    exit();
});

add_action( 'admin_post_upload_demo', function () {
    if ( wp_verify_nonce( $_POST['my_image_upload_nonce'], 'my_image_upload' ) ) {
        $attachment_id = media_handle_upload( 'my_image_upload', 0 );

        if ( is_wp_error( $attachment_id ) ) {
            wp_redirect( "/".wp_strip_all_tags( $_POST['post_title']));
        } else {
            wp_redirect( "/".wp_strip_all_tags( '/'));
        }
    } else {
        wp_redirect( "/".wp_strip_all_tags( '/les-biens-a-louer/'));
    }
});
