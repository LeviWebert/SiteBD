<?php
include "getRacine.php";
include "$racine/Controleur/controleurPrincipale.php";
include_once "$racine/Modele/bd.authentification.inc.php";



if (isset($_GET["action"])){
    $action = $_GET["action"];
}
else{
    
    $action = "defaut";
}

$fichier = controleurPrincipal($action);
include "$racine/Controleur/$fichier";


?>