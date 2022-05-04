<?php

include_once "bd.inc.php";

function getPrefererByMailU($mailU) {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from preferer where mailU=:mailU");
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
        $req->execute();

        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getPrefererByIdTC($idTC) {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from preferer where idTC=:idTC");
        $req->bindValue(':idTC', $idTC, PDO::PARAM_INT);

        $req->execute();

        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function addPreferer($mailU, $idTC) {
    $resultat = -1;
    try {
        $cnx = connexionPDO();

        $req = $cnx->prepare("insert into preferer (mailU, idTC) values(:mailU,:idTC)");
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
        $req->bindValue(':idTC', $idTC, PDO::PARAM_INT);
        $resultat = $req->execute();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function delPreferer($mailU, $idTC) {
    $resultat = -1;
    try {
        $cnx = connexionPDO();

        $req = $cnx->prepare("delete from preferer where idTC=:idTC and mailU=:mailU");
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
        $req->bindValue(':idTC', $idTC, PDO::PARAM_INT);
        $resultat = $req->execute();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}


if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    // prog principal de test
    header('Content-Type:text/plain');

    echo "\n addPreferer(\"mathieu.capliez@gmail.com\",2) : \n";
    print_r(addPreferer("mathieu.capliez@gmail.com", 2));

    echo "\n getPrefererByMailU(\"mathieu.capliez@gmail.com\") : \n";
    print_r(getPrefererByMailU("mathieu.capliez@gmail.com"));


    echo "\n getPrefererByIdTC(1) : \n";
    print_r(getPrefererByIdTC(1));
}
?>