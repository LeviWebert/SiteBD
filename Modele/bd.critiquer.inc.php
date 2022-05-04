<?php

include_once "bd.inc.php";

function getCritiquerByIdR($idR) {
    $resultat = array();
    
    // completer le code manquant
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("Select * from critiquer where idR=:idR");
        $req->bindValue(':idR', $idR, PDO::PARAM_INT);

        $req->execute();
        
        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
        
}

function getNoteMoyenneByIdR($idR) {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select avg(note) from critiquer where idR=:idR");
        $req->bindValue(':idR', $idR, PDO::PARAM_INT);

        $req->execute();

        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    if ($resultat["avg(note)"] != NULL) {
        return $resultat["avg(note)"];
    } else {
        return 0;
    }
}