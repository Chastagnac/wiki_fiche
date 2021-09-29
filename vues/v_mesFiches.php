<?php

/**
 * Vue Accueil
 *
 * PHP Version 7
 * @category  Projet G4
 * @package   Wiki Fiche
 * @link      http://www.php.net/manual/fr/book.pdo.php PHP Data Objects sur php.net
 */

?>

<div class="container-fluid">
    <div class="px-lg-2">
        <div class="row">
            <!-- Gallery item -->
            <?php
            $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
            if ($action !== 'getFicheByCategorie') {
                foreach ($mesFiches as $fiche) {
                    $id = $fiche['id'];
                    $idcategorie = $fiche['idcategorie'];
                    $idcompte = $fiche['idcompte'];
                    $libelle = $fiche['libelle'];
                    $description = $fiche['description'];
                    $contenu = $fiche['contenu'];
                    $datemodif = $fiche['datemodif'];
                    $datecreation = $fiche['datecreation'];
                    $likes = $fiche['nblike']
            ?>
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                        <div class="shadow-sm">
                            <div class="p-4">
                                <h4> <a href="index.php?uc=gererFiche&action=visiterFiche&id=<?php echo $id; ?>" class="text-dark">
                                        <?php echo htmlspecialchars($libelle) ?></a></h4>
                                <p class="text-muted mb-0">
                                    <?php echo htmlspecialchars($description) ?>
                                </p>
                                <a class="glyphicon glyphicon-heart"></a> <?= $likes ?>
                            </div>
                        </div>
                    </div>
                    <!-- End -->
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>