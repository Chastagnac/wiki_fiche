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
    case 'gererFiche':
        include 'controleurs/c_gererFiche.php';
        break;
    case 'gererCompte':
        include 'controleurs/c_gererCompte.php';
        break;
    case 'etatFiche':
        include 'controleurs/c_etatFiche.php';
        break;
    case 'controlerFiche':
        include 'controleurs/c_controlerFiche.php';
        break;
    case 'deconnexion':
        include 'controleurs/c_deconnexion.php';
        break;
}
require 'vues/v_pied.php';
