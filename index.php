<?php

/**
 *  Index
 *
 * PHP Version 7
 * @category  PPE
 * @package   Wiki Fiche
 * @link      http://www.php.net/manual/fr/book.pdo.php PHP Data Objects sur php.net
 */


require_once 'includes/fct.inc.php';
require_once 'includes/class.pdowiki.inc.php';
session_start();
$pdo = PdoWiki::getPdoWiki();
$estConnecte = estConnecte();
require 'vues/v_entete.php';
$uc = filter_input(INPUT_GET, 'uc', FILTER_SANITIZE_STRING);
if ($uc && !$estConnecte) {
    $uc = 'connexion';
} elseif (empty($uc)) {
    $uc = 'accueil';
}
switch ($uc) {
    case 'connexion':
        include 'controleurs/c_connexion.php';
        break;
    case 'accueil':
        include 'controleurs/c_accueil.php';
        break;
    case 'gererFrais':
        include 'controleurs/c_gererFrais.php';
        break;
    case 'etatFrais':
        include 'controleurs/c_etatFrais.php';
        break;
    case 'controlerFrais':
        include 'controleurs/c_validerFrais.php';
        break;
    case 'suivreFrais':
        include 'controleurs/c_suivreFrais.php';
        break;
    case 'deconnexion':
        include 'controleurs/c_deconnexion.php';
        break;    
}
require 'vues/v_pied.php';
