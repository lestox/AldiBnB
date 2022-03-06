<?php
/*
Template Name: Login
*/
?>

<?php get_header(); ?>

<?php if(is_user_logged_in()){
    echo 'fuck';
    wp_safe_redirect(home_url());
};?>
    <form action="<?= home_url('wp-login.php'); ?>" method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Email or Username</label>
            <input name="log" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input name="pwd" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div class="form-check">
            <input name="rememberme" type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button name="wp-submit" type="submit" class="btn btn-primary">Submit</button>
        <input type="hidden" name="redirect_to" value="/"/>
    </form>
