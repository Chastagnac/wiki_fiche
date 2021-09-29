<?php

/**
 * Gestion des frais
 *
 * PHP Version 7
 * 
 * @category  PPE
 * @package   Wiki Fiche
 * @link      http://www.php.net/manual/fr/book.pdo.php PHP Data Objects sur php.net
 */

$idCompte = $_SESSION['idCompte'];
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
$infosCompte = $pdo->getInfosCompteById($idCompte);

include('vues/v_monCompte.php');
switch ($action) {
    case 'mesInformations':
        include('vues/v_mesInformations.php');
        break;
    case 'validerModifications':
        $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
        $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING);
        $mail = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_STRING);
        checkModifCompte($nom, $prenom, $mail);
        if(nbErreurs() != 0) {
            include 'vues/v_erreurs.php';
            include('vues/v_mesInformations.php');
        } else {
            $pdo->updateInfosCompte($idCompte, $mail, $nom, $prenom);
            include('vues/v_successful.php');
            include('vues/v_mesInformations.php');
        }
        break;
    case 'mesFiches':
        $mesFiches = $pdo->getFichesByCompte($idCompte);
        include('vues/v_mesFiches.php');
        break;
}