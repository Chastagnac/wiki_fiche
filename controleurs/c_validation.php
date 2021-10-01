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
    case 'validerFiches':
        $fiches = $pdo->getFiches('AT');
        include 'vues/v_validerFiche.php';
        break;
    case 'validation':
        // $fiches = $pdo->getFiches('VA');
        // include 'vues/v_validerFiche.php';
        break;
}
