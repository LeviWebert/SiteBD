<?php

include_once "bd.inc.php";

function getBdByIdBD($idBD) {

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from bandedessinee where id=:idBD");
        $req->bindValue(':idBD', $idBD, PDO::PARAM_INT);
        $req->execute();
        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getBD() {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from bandedessinee");
        $req->execute();

        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $resultat[] = $ligne;
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}



function getBDByNomBD($nomBD) {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from bandedessinee where libelle like :nomBD");
        $req->bindValue(':nomBD', "%".$nomBD."%", PDO::PARAM_STR);

        $req->execute();

        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $resultat[] = $ligne;
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getBDbyAuteur($idAuteur) {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT bandedessinee.* FROM bandedessinee JOIN auteurbd ON bandedessinee.id = auteurbd.idBD WHERE idAuteur = :idAuteur");
        $req->bindValue(':idAuteur', $idAuteur, PDO::PARAM_INT);
        $req->execute();

        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $resultat[] = $ligne;
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}


function getBDAimesByMailU($mailU) {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT bandedessinee.* FROM bandedessinee JOIN aimer ON bandedessinee.id = aimer.idBD JOIN utilisateur ON aimer.idUtil = utilisateur.id WHERE utilisateur.mail = :mailU");
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
        $req->execute();

        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $resultat[] = $ligne;
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    // prog principal de test
    header('Content-Type:text/plain');

    echo "getBdByIdBD() : \n";
    print_r(getBdByIdBD(2));

    echo "getBD(1) : \n";
    print_r(getBD(1));

    echo "getBDByNomBD('Tintin') : \n";
    print_r(getBDByNomBD("tintin"));

    echo "getBDbyAuteur('Hergé') : \n";
    print_r(getBDbyAuteur("Hergé"));
    
    echo "getBDAimesByMailU(mailU) : \n";
    print_r(getBDAimesByMailU("test@bts.sio"));
    
    
}
?>