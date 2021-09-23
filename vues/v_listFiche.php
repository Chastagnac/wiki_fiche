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
</div>
<div class="container-fluid">
    <div class="px-lg-5">
        <div class="row">
            <!-- Gallery item -->
            <?php
            foreach ($fiches as $fiche) {
                $id = $fiche['id'];
                $idcompte= $fiche['idcompte'];
                $libelle= $fiche['libelle'];
                $description= $fiche['description'];
                $datemodif= $fiche['datemodif'];
                $datecreation= $fiche['datecreation'];
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