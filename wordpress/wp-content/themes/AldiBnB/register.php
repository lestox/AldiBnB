<?php
/*
 * Template Name: Register Page
 */

?>

<?php get_header(); ?>

<h1>Inscription</h1>

<form action='registercheck.php' method="post">
    <label id="icon" for="name"><i class="icon-envelope "></i></label>
    <input type="text" name="name" id="name" placeholder="Email" required/>
    <label id="icon" for="name"><i class="icon-user"></i></label>
    <input type="text" name="name" id="name" placeholder="Nom d'utilisateur" required/>
    <label id="icon" for="name"><i class="icon-shield"></i></label>
    <input type="password" name="name" id="name" placeholder="Mot de passe" required/>
    <div class="gender">
        <input type="radio" value="None" id="male" name="gender" checked/>
        <label for="male" class="radio" chec>Male</label>
        <input type="radio" value="None" id="female" name="gender" />
        <label for="female" class="radio">Female</label>
    </div>
    <p>By clicking Register, you agree on our <a href="#">terms and condition</a>.</p>
    <button name="wp-submit" type="submit" class="btn btn-primary">Connection</button>
</form>
</div>






<?php get_footer(); ?>
