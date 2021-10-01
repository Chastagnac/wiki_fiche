<?php

/**
 * Gestion de la connexion
 *
 * PHP Version 7
 * @category  Projet
 * @package   Wiki Fiche
 * @link      http://www.php.net/manual/fr/book.pdo.php PHP Data Objects sur php.net
 */

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
if (!$uc) {
    $uc = 'demandeconnexion';
}

switch ($action) {
    case 'demandeConnexion':
        include 'vues/v_connexion.php';
        break;
    case 'valideConnexion':
        $mail = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_STRING);
        $mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_STRING);
        $compte = $pdo->getInfosCompte($mail, $mdp);
        if (is_array($compte)) {
            $id = $compte['id'];
            $nom = $compte['nom'];
            $prenom = $compte['prenom'];
            connecter($id, $nom, $prenom);
            header('Location: index.php');
        } else {
            ajouterErreur('Email ou mot de passe incorrect');
            include 'vues/v_erreurs.php';
            include 'vues/v_connexion.php';
        }
        break;
    case 'register':
        $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
        $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING);
        $mail = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_STRING);
        $mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_STRING);
        $mdp2 = filter_input(INPUT_POST, 'mdp2', FILTER_SANITIZE_STRING);
        valideEnregistrement($nom, $prenom, $mail, $mdp, $mdp2);
        if (nbErreurs() != 0) {
            include 'vues/v_erreurs.php';
            include 'vues/v_connexion.php';
        } else {
            
            $pdo->register(
                $prenom,
                $nom,
                $mdp,
                $mail
            );
            include 'vues/v_connexion.php';
        }
        break;
    default:
        include 'vues/v_connexion.php';
        break;
}