<?php

/**
 * Gestion de l'accueil
 *
 * PHP Version 7
 * @category  PPE
 * @package   Wiki Fiche
 * @link      http://www.php.net/manual/fr/book.pdo.php PHP Data Objects sur php.net
 */

if ($estConnecte) {
    include 'vues/v_accueil.php';
} else {
    include 'vues/v_connexion.php';
}