<?php

function controleurPrincipal($action){
    $lesActions = array();
    $lesActions["defaut"] = "listeBD.php";
    $lesActions["liste"] = "listeBD.php";
    $lesActions["detail"] = "detailBD.php";
    $lesActions["new"] = "nouveaute.php";
    $lesActions["tendance"] = "tendance.php";
    $lesActions["sous_cote"] = "sous-cote.php";
    $lesActions["recherche"] = "recherche.php";
    $lesActions["connexion"] = "connexion.php";
    $lesActions["deconnexion"] = "deconnexion.php";
    $lesActions["inscription"] = "inscription.php";
    $lesActions["deconnexion"] = "deconnexion.php";
    $lesActions["profil"] = "profil.php";
    
    if (array_key_exists ( $action , $lesActions )){
        return $lesActions[$action];
    }
    else{
        return $lesActions["defaut"];
    }

}

?>