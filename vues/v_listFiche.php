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
        Retrouver toutes les fiches !
    </h2>
    <button onclick="location.href='index.php?uc=gererFiche&action=insererFiche'" class="btn btn-lg btn-primary btn-block">Créer une fiche</button>
</div>
<div class="container-fluid">
    <div class="px-lg-5">
        <div class="row">
            <!-- Gallery item -->
            <?php
            foreach ($fiches as $fiche) {
                $id = $fiche['id'];
                $idcompte = $fiche['idcompte'];
                $libelle = $fiche['libelle'];
                $description = $fiche['description'];
                $datemodif = $fiche['datemodif'];
                $datecreation = $fiche['datecreation'];
            ?>
                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                    <div class="shadow-sm">
                        <div class="p-4">
                            <h4> <a href="#" class="text-dark">
                                    <?php echo htmlspecialchars($libelle) ?></a></h4>
                            <p class="text-muted mb-0">
                                <?php echo htmlspecialchars($description) ?>
                            </p>
                            <div class="d-flex align-items-center justify-content-between rounded-pill bg-light px-3 py-2 mt-4">
                                <div class="badge badge-danger px-3 rounded-pill font-weight-normal">Like</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End -->
            <?php
            }
            ?>
        </div>
    </div>
</div>
<!DOCTYPE html>
<html>
<script type="text/javascript" src="js/checkbox.js"></script>
<link type="styles/css" rel="stylesheet" href="styles/style.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.js"></script>
<div class="dropdown">
    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
        <i class="glyphicon glyphicon-cog"></i>
        <span class="caret"></span>
    </button>
    <ul class="dropdown-menu checkbox-menu allow-focus" aria-labelledby="dropdownMenu1">

        <li>
            <label>
                <input type="checkbox"> Developpement
            </label>
        </li>

        <li>
            <label>
                <input type="checkbox"> ActuWeb
            </label>
        </li>

        <li>
            <label>
                <input type="checkbox"> Mobile
            </label>
        </li>

        <li>
            <label>
                <input type="checkbox"> Jeux
            </label>
        </li>

    </ul>
</div>

</html>