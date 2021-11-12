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
$idFiche = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);

include 'vues/v_monCompte.php';
switch ($action) {
    case 'validerFiches':
        $fiches = $pdo->getFiches('AT');
        include 'vues/v_validerFiche.php';
        break;
    case 'validation':
        $idAuteur = $pdo->getIdCompteByFiche($idFiche);
        $pdo->updateXp($idAuteur['idcompte'], 35);
        $pdo->updateEtatFiche($idFiche, 'VA');
        $fiches = $pdo->getFiches('AT');
        include 'vues/v_successful.php';
        include 'vues/v_validerFiche.php';
        break;
    case 'refuserFiche':
        $pdo->updateEtatFiche($idFiche, 'RE');
        $fiches = $pdo->getFiches('AT');
        include 'vues/v_message.php';
        include 'vues/v_validerFiche.php';
        break;
}
