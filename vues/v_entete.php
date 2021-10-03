<?php

/**
 * Vue Entête
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Réseau CERTA <contact@reseaucerta.org>
 * @author    José GIL <jgil@ac-nice.fr>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */
?>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="UTF-8">
    <title>Intranet du Laboratoire Galaxy-Swiss Bourdin</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./styles/bootstrap/bootstrap.css" rel="stylesheet">
    <link href="./styles/style.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <?php
        $uc = filter_input(INPUT_GET, 'uc', FILTER_SANITIZE_STRING);
        if ($estConnecte) {
        ?>
            <div class="header">
                <div class="row vertical-align">
                    <div class="col-md-4">
                        <h1>
                            <img src="./images/logo.png" class="img-responsive" alt="Wiki fiche" title="wifi fiche">
                        </h1>
                    </div>
                    <div class="col-md-8">
                        <ul class="nav nav-pills pull-right" role="tablist">
                            <li <?php if (!$uc || $uc == 'accueil') { ?>class="active" <?php } ?>>
                                <a href="index.php">
                                    <span class="glyphicon glyphicon-home"></span>
                                    Accueil
                                </a>
                            </li>
                            <li <?php if ($uc == 'gererFiche') { ?>class="active" <?php } ?>>
                                <a href="index.php?uc=gererFiche&action=selectionnerFiche">
                                    <span class="glyphicon glyphicon-list-alt"></span>
                                    Les Fiches
                                </a>
                            </li>
                            <?php if ($_SESSION['role'] !== '-1') { ?>
                                <li <?php if ($uc == 'gererCompte') { ?>class="active" <?php } ?>>
                                    <a href="index.php?uc=gererCompte&action=mesInformations">
                                        <span class="glyphicon glyphicon-user"></span>
                                        Mon compte
                                    </a>
                                </li>
                            <?php
                            } ?>
                            <?php if ($_SESSION['role'] !== '-1') { ?>
                                <li <?php if ($uc == 'deconnexion') { ?>class="active" <?php } ?>>
                                    <a href="index.php?uc=deconnexion&action=demandeDeconnexion">
                                        <span class="glyphicon glyphicon-log-out"></span>
                                        Déconnexion
                                    </a>
                                </li>
                            <?php
                            } else { ?>
                                <li <?php if ($uc == 'deconnexion') { ?>class="active" <?php } ?>>
                                    <a href="index.php?uc=deconnexion&action=demandeEnregistrement">
                                        <span class="glyphicon glyphicon-user"></span>
                                        S'enregistrer
                                    </a>
                                </li>
                            <?php }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php
        }
