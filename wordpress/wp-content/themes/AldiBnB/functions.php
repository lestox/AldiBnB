<?php
add_action('after_setup_theme', 'aldibnbSetupTheme');
function aldibnbSetupTheme()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    register_nav_menu('header', 'Menu du header');
}

add_action('init', 'update_anyone_can_register');
function update_anyone_can_register() {
    update_option('users_can_register', true);
}

// Restriction de l'admin aux admins et moderator
add_action( 'admin_init', 'restrict_admin', 1 );
function restrict_admin()
{
    if ( ! current_user_can( 'delete_published_pages' ) && '/wp-admin/admin-ajax.php' != $_SERVER['PHP_SELF'] ) {
        wp_redirect( site_url() );
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

add_action( 'wp_enqueue_scripts', 'aldibnb_styles' );
function aldibnb_styles(){
    wp_enqueue_style('aldibnb-style',get_stylesheet_uri());
    wp_enqueue_style('landing', get_template_directory_uri() . '/assets/styles/front-page.css', array(), 'all');
    wp_enqueue_style('register', get_template_directory_uri() . '/assets/styles/register.css', array(), 'all');
    wp_enqueue_style('log', get_template_directory_uri() . '/assets/styles/login.css', array(), 'all');
    wp_enqueue_style('all-annonces', get_template_directory_uri() . '/assets/styles/toutes-les-annonces.css', array(), 'all');
    wp_enqueue_style( 'font-awesome-free', 'https://use.fontawesome.com/releases/v6.0.0/css/all.css' );
}


add_action( 'wp_enqueue_scripts', 'mytheme_enqueue_style' );


add_action('admin_post_aldibnb_form', function () {
    if (!wp_verify_nonce($_POST['post_nonce_field'], 'post_nonce')) {
        die('Nonce invalide');
    }

    // Traitement de l'image
    $attachment_id = media_handle_upload('image_upload', $_POST['post_id']);

    // Ajout de l'image
    if (is_wp_error($attachment_id)) {
        wp_redirect($_POST['_wp_http_referer'] . '?status=error');
    }

    // Create post object
    $my_post = array(
        'post_title'    => wp_strip_all_tags( $_POST['post_title'] ),
        'post_content'  => $_POST['post_content'],
        'post_status'   => 'draft',
        'post_author'   => get_current_user_id(),
        'meta_input'    => array(
            'price' => $_POST['price'],
            'city' => $_POST['city'],
            'capacity' => $_POST['capacity'],
            'room' => $_POST['room'],
            'image' => wp_get_attachment_url($attachment_id)
        ));

    // Insert the post into the database
    wp_insert_post( $my_post );
    wp_redirect( "/moderation");
    exit();
});

add_action( 'wp_enqueue_scripts', 'aldibnb_styles' );

// Modif droits contributeur
function author_remove_rights() {
    // Retrieve the  Author role.
    $role = get_role(  'author' );
    // Let's add a set  of new capabilities we want Authors to have.
    $role->remove_cap('publish_posts');
}
add_action( 'admin_init', 'author_remove_rights');

// Création d'un rôle modérateur
add_role(
    'Moderator', //  System name of the role.
    __( 'Moderator'  ), // Display name of the role.
    array(
        'read'  => true,
        'delete_posts'  => true,
        'delete_published_posts' => true,
        'edit_posts'   => true,
        'publish_posts' => true,
        'upload_files'  => false,
        'edit_pages'  => true,
        'edit_published_pages'  =>  true,
        'publish_pages'  => true,
        'delete_published_pages' => true
    )
);


