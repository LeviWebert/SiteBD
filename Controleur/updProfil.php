<?php

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/authentification.inc.php";
include_once "$racine/modele/bd.utilisateur.inc.php";


// init messages 
$messageMdp = "";

// recuperation des donnees GET, POST, et SESSION
if (isLoggedOn()) {
    $mailU = getMailULoggedOn();
    $util = getUtilisateurByMailU($mailU);

        // traitement si necessaire des donnees recuperees

    if (isset($_POST["pseudoU"])){
        $pseudoU = $_POST["pseudoU"];
        if ($pseudoU!=""){
            updtPseudoUtilisateur($mailU, $pseudoU);
        }
    }
    
    if (isset($_POST["mdpU"]) && isset($_POST["mdpU2"])) {
        if ($_POST["mdpU"] != "") {
            if (($_POST["mdpU"] == $_POST["mdpU2"])) {
                updtMdpUtilisateur($mailU, $_POST["mdpU"]);
            } else {
                $messageMdp = "erreur de saisie du mot de passe";
            }
        }
    }

    if (isset($_POST["lstidR"])) {
        $lstidR = $_POST["lstidR"];
        for ($i = 0; $i < count($lstidR); $i++) {
            delAimer($mailU, $lstidR[$i]);
        }
    }
    
    //addLstidTC
    if (isset($_POST["addLstidTC"])) {
        $addLstidTC = $_POST["addLstidTC"];
        for ($i = 0; $i < count($addLstidTC); $i++) {
            addPreferer($mailU, $addLstidTC[$i]);
        }
    }
    
    //delLstidTC
    if (isset($_POST["delLstidTC"])) {
        $delLstidTC = $_POST["delLstidTC"];
        for ($i = 0; $i < count($delLstidTC); $i++) {
            delPreferer($mailU, $delLstidTC[$i]);
        }
    }

    
    // appel des fonctions permettant de recuperer les donnees utiles a l'affichage 
    $mesRestosAimes = getBDAimesByMailU($mailU);
    $mesTypeCuisineAimes = getGenrePrefByMailU($mailU);
    $lesAutresTypesCuisine = getGenreNonPreferesByMailU($mailU);
    
    // appel du script de vue qui permet de gerer l'affichage des donnees
    $titre = "Mon profil";
    include "$racine/vue/entete.html.php";
    include "$racine/vue/vueUpdProfil.php";
    include "$racine/vue/pied.html.php";
}
else{
    $titre = "Mon profil";
    include "$racine/vue/entete.html.php";
    include "$racine/vue/pied.html.php";
}
?>