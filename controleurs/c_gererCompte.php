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
        if (nbErreurs() != 0) {
            include 'vues/v_erreurs.php';
            include('vues/v_mesInformations.php');
        } else {
            $pdo->updateInfosCompte($idCompte, $mail, $nom, $prenom, $infosCompte['role']);
            include('vues/v_successful.php');
            include('vues/v_mesInformations.php');
        }
        break;
    case 'changerMdp':
        $lastpswd = filter_input(INPUT_POST, 'lastpswd', FILTER_SANITIZE_STRING);
        $newpswd = filter_input(INPUT_POST, 'newpswd', FILTER_SANITIZE_STRING);
        $confirmpswd = filter_input(INPUT_POST, 'confirmpswd', FILTER_SANITIZE_STRING);
        checkNewPassword($infosCompte['mdp'], $lastpswd, $newpswd, $confirmpswd);
        if (nbErreurs() != 0) {
            include 'vues/v_erreurs.php';
            include('vues/v_mesInformations.php');
        } else {
            $pdo->updateMdpCompte($idCompte, $newpswd);
            include('vues/v_successful.php');
            include('vues/v_mesInformations.php');
        }
        break;
    case 'mesFiches':
        $mesFiches = $pdo->getFichesByCompte($idCompte);
        include('vues/v_mesFiches.php');
        break;
    case 'demandeEnregistrement':
        if (estConnecte()) {
            include 'vues/v_deconnexion.php';
        } else {
            ajouterErreur("Vous n'êtes pas connecté");
            include 'vues/v_erreurs.php';
            include 'vues/v_connexion.php';
        }
        break;
    default:
        include 'vues/v_connexion.php';
        break;
}
