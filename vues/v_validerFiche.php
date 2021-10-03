<?php

/**
 * Vue Accueil
 *
 * PHP Version 7
 * @category  G4
 * @package   Wiki Fiche
 * @link      http://www.php.net/manual/fr/book.pdo.php PHP Data Objects sur php.net
 */

?>

<head>
    <link rel="stylesheet" href="../styles/stylesPages/vfiches.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
</head>

<div class="container1">
    <div class="px-lg-1">
        <div class="row">
            <!-- Gallery item -->
            <?php
            $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
            if ($action !== 'getFicheByCategorie') {
                foreach ($fiches as $fiche) {
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
                    <div class="card">
                        <div class="card-header">
                            <p><?php echo htmlspecialchars($datecreation) ?></p>
                            <?php if ($_SESSION['role'] != '-1') { ?>
                                <h4> <a href="index.php?uc=gererFiche&action=visiterFiche&id=<?php echo $id; ?>" class="text-dark">
                                        <?php echo htmlspecialchars($libelle) ?></a></h4> <?php
                                                                                        } else { ?> <h1><?php echo htmlspecialchars($libelle) ?></h1><?php } ?>
                        </div>
                        <div class="card-body">
                            <?php echo htmlspecialchars($description) ?>
                        </div>
                        <div class="card-footer">
                            <div class="buttons">
                                <span class="comment">
                                    <i class="fa fa-comment-o" aria-hidden="true"></i>
                                    nbcommentaire
                                </span>
                                <span class="like">
                                    <a class="fa fa-heart"></a> <?= $likes ?>
                                </span>
                            </div>
                        </div>
                        <a href="index.php?uc=validation&action=validation&id=<?php echo $id; ?>" class="btn btn-success">Valider la fiche</a></h4>
                            <a href="index.php?uc=validation&action=refuserFiche&id=<?php echo $id; ?>" class="btn btn-danger">Refuser la fiche</a></h4>
                    </div>
            <?php
                }
            }
