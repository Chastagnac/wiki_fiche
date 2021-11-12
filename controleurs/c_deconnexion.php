<?php

/**
 * Gestion de la déconnexion
 *
 * PHP Version 7
 * @category  PPE
 * @package   Wiki Fiche
 * @link      http://www.php.net/manual/fr/book.pdo.php PHP Data Objects sur php.net
 */


$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
if (!$uc) {
    $uc = 'demandeconnexion';
}

switch ($action) {
    case 'demandeDeconnexion':
        include 'vues/v_deconnexion.php';
        break;
    case 'demandeEnregistrement':
        include 'vues/v_register.php';
        break;
}
