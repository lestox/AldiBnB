<?php
/*

Plugin Name: Formulaire d'inscription
Version: 1.0

*/
ob_start();
// Formulaire d'inscription
function registrationForm() {
    // On retourne le formulaire seulement si l'utilisateur n'est pas déjà connecté
    if(!is_user_logged_in()) {
        $output = registrationFormFront();
        return $output;
    }
}
add_shortcode('register_form', 'registrationForm');

// registration form fields
function registrationFormFront(){

     ?>

    <h3>Formulaire d'inscription</h3>

    <?php

    // show any error messages after form submission
    errorMessages(); ?>

    <form action="" method="POST">
        <fieldset>
            <p>
                <label for="userLogin">Nom d'utilisateur</label>
                <input name="userLogin" id="userLogin" class="userLogin" type="text"/>
            </p>
            <p>
                <label for="userEmail">Email</label>
                <input name="userEmail" id="userEmail" class="userEmail" type="email"/>
            </p>

            <p>
                <label for="password">Mot de passe</label>
                <input name="password" id="password" class="password" type="password"/>
            </p>

            <p>
                <input type="hidden" name="registerForm" value="registerForm">
                <?php echo wp_nonce_field('random_action', 'registerNonce'); ?>
                <input type="submit" value="Inscription"/>
            </p>
        </fieldset>
    </form>
    <?php } ?>

<?php
// Checks + ajout de l'utilisateur
function addUser() {
    if (isset( $_POST["userLogin"] ) && wp_verify_nonce($_POST['registerNonce'], 'random_action')) {
        $user_login	= $_POST["userLogin"];
        $user_email	= $_POST["userEmail"];
        $user_pass	= $_POST["password"];


        if(username_exists($user_login)) {
            // Si le nom d'utilisateur existe déjà
            errors()->add('username_unavailable', __('Username already taken'));
        }
        if(!validate_username($user_login)) {
            // Si le nom d'utilisateur est invalide
            errors()->add('username_invalid', __('Invalid username'));
        }
        if($user_login == '') {
            // Si le nom d'utilisateur est vide
            errors()->add('username_empty', __('Please enter a username'));
        }
        if(!is_email($user_email)) {
            // Si l'email est invalide
            errors()->add('email_invalid', __('Invalid email'));
        }
        if(email_exists($user_email)) {
            // Si l'email existe déjà
            errors()->add('email_used', __('Email already registered'));
        }
        if($user_pass == '') {
            // Si le mdp est vide
            errors()->add('password_empty', __('Please enter a password'));
        }


        $errors = errors()->get_error_messages();

        // Si pas d'erreurs, création de l'utilisateur
        if(empty($errors)) {
            $new_user_id = wp_insert_user(array(
                    'user_login'		=> $user_login,
                    'user_pass'	 		=> $user_pass,
                    'user_email'		=> $user_email,
                    'user_registered'	=> date('Y-m-d H:i:s'),
                    'role'				=> 'subscriber'
                )
            );

            //Si tout est ok, on le redirige sur la page login
            if($new_user_id == true) {
                wp_redirect('/login');
                exit;
            }
        }
    }
}
add_action('init', 'addUser');

// Gestion des messages d'erreurs
function errors(){
    static $wp_error;
    return isset($wp_error) ? $wp_error : ($wp_error = new WP_Error(null, null, null));
}

// displays error messages from form submissions
function errorMessages() {
    if($codes = errors()->get_error_codes()) {
        echo '<div class="errors">';
        // Loop error codes and display errors
        foreach($codes as $code){
            $message = errors()->get_error_message($code);
            echo '<span class="error"><strong>' . __('Error') . '</strong>: ' . $message . '</span><br/>';
        }
        echo '</div>';
    }
}

