<?php
if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}
include_once "$racine/modele/bd.BandeDessine.inc.php";

include "$racine/vue/entete.html.php";
include "$racine/vue/VueListeBDRandom.php";
include "$racine/vue/pied.html.php";


?>