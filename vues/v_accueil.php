<?php
/**
 * Vue Accueil
 *
 * PHP Version 7
 * @category  PPE
 * @package   Wiki Fiche
 * @link      http://www.php.net/manual/fr/book.pdo.php PHP Data Objects sur php.net
 */

?>
<div id="accueil">
    <h2>
        Gestion des frais<small> - Visiteur : 
            <?php 
            echo $_SESSION['prenom'] . ' ' . $_SESSION['nom']
            ?></small>
    </h2>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <span class="glyphicon glyphicon-bookmark comptable"></span>
                    Navigation
                </h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <a href="index.php?uc=gererFiche&action=saisirFrais"
                           class="btn btn-danger btn-lg" role="button">
                            <span class="glyphicon glyphicon-pencil"></span>
                            <br>Fiche1</a>
                        <a href="index.php?uc=gererFiche&action=selectionnerMois"
                           class="btn btn-danger btn-lg" role="button">
                            <span class="glyphicon glyphicon-list-alt"></span>
                            <br>Fiche2</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>