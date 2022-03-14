<?php
/*
 * Template Name: Search Page
 */
?>
<form id="search_field" method="get" action="<?php echo esc_url( home_url( '/search-results' ) ); ?>">
    <div>
        <input type="text" placeholder="Destination" name="destination" id="destination" />
    </div>
    <div>
        <input type="date" placeholder="Date" name="date" id="date" />
    </div>
    <div>
        <input type="number" placeholder="Nb personnes" name="nbPersonnes" id="nb_personnes" />
    </div>
    <div>
        <input type="submit" value="Rechercher" id="search_button" />
    </div>
</form>