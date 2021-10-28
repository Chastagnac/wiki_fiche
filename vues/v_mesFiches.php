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

<head>
    <link rel="stylesheet" href="../styles/stylesPages/vfiches.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
</head>
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
                    $likes = $fiche['nblike'];
                    $etat = $fiche['etat']
            ?>
                    <div class="card">
                        <div class="text-right">
                            <?php echo htmlspecialchars($datecreation) ?>
                        </div>
                        <div>
                            <p><?php echo "Satut Fiche : " . getLibelleEtat($etat) ?></p>
                            <?php
                            if ($_SESSION['role'] != '-1') { ?>
                                <h4>
                                    <a href="index.php?uc=gererFiche&action=visiterFiche&id=<?php echo $id; ?>" class="text-dark"><?php echo htmlspecialchars($libelle) ?></a>
                                </h4>
                            <?php
                            } else { ?>
                                <h1>
                                    <?php echo htmlspecialchars($libelle) ?>
                                </h1>
                            <?php
                            } ?>
                        </div>
                        <div class="card-body">
                            <mall><?php echo htmlspecialchars($description) ?></mall>
                        </div>
                        <div class="card-footer">
                            <div class="buttons">
                                <span class="comment">
                                    <i class="fa fa-comment-o" aria-hidden="true"></i>
                                    nbcommentaire
                                </span>
                                <span class="like">
                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                    <?php echo htmlspecialchars($likes) ?>
                                </span>
                            </div>
                        </div>
                        <div class="text-right">
                            <a href="index.php?uc=gererFiche&action=modifierFiche&id=<?php echo $id; ?>" class="glyphicon glyphicon-pencil" style="text-decoration : none;"></a>
                            <a href="index.php?uc=gererFiche&action=suppression&id=<?php echo $id; ?>" class="glyphicon glyphicon-trash" style="text-decoration : none;"></a>
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