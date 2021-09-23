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


switch ($action) {
    case 'selectionnerFiche':
        $fiches = $pdo->getFiches();
        include('vues/v_listFiche.php');
        break;

    case 'insererFiche':
        $idCategorie = filter_input(INPUT_POST, 'categorie', FILTER_SANITIZE_NUMBER_INT);
        $libelle = filter_input(INPUT_POST, 'libelle', FILTER_SANITIZE_STRING);
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
        $contenu = filter_input(INPUT_POST, 'contenu', FILTER_SANITIZE_STRING);
        $fiches = $pdo->insertFiches($idCategorie, $idCompte, $libelle, $description, $contenu);
        include('vues/v_creerFiche.php');
        break;
    
}
