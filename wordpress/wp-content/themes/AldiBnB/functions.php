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

add_action( 'wp_enqueue_scripts', 'aldibnb_styles' );
function aldibnb_styles(){
    wp_enqueue_style('aldibnb-style',get_stylesheet_uri());
    wp_enqueue_style('landing', get_template_directory_uri() . '/assets/styles/front-page.css', array(), 'all');
    wp_enqueue_style( 'font-awesome-free', 'https://use.fontawesome.com/releases/v6.0.0/css/all.css' );
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
        'post_author'   => get_current_user_id(),
        'meta_input'    => array(
            'price' => $_POST['price'],
            'city' => $_POST['city'],
            'capacity' => $_POST['capacity']
            )
    );

    // Insert the post into the database
    wp_insert_post( $my_post );

    // Traitement de l'image
    $target_dir = "/assets/images/";
    $file = $_FILES["image_upload"]["name"];
    $path = pathinfo($file);
    $filename = $path['filename'];
    $ext = $path['extension'];
    $temp_name = $_FILES["image_upload"]["tmp_name"];
    $path_filename_ext = $target_dir.$filename.".".$ext;

    if (file_exists($path_filename_ext)) {
        echo "Sorry, file already exists.";
    }else{
        move_uploaded_file($temp_name,$path_filename_ext);
        echo "Congratulations! File Uploaded Successfully.";
    }

    //$attachment_id = media_handle_upload('image_upload', $_POST['post_id']);

    // Ajout de l'image
    //if (is_wp_error($attachment_id)) {
       // wp_redirect($_POST['_wp_http_referer'] . '?status=error');
    //} else {
      //  set_post_thumbnail($_POST['post_id'], $attachment_id);
    //}

    //wp_redirect( "/".wp_strip_all_tags( $_POST['post_title'] ));
    //exit();
});

