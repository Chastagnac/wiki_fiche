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
<div id="accueil">
    <h2>Wiki Fiche</h2>
    <?php if ($_SESSION['role'] != '-1') { ?>
        <button onclick="location.href='index.php?uc=gererFiche&action=insererFiche'" class="btn">Créer une fiche</button>
    <?php
    } ?>
</div>
<script src="../js/app.js"></script>
<form id="myForm" role="form" method="post" action="index.php?uc=gererFiche&action=Rechercher">
    <label for="terme" class="input-group"> Entrez le titre d'une fiche</label>
    <input type="text" name="terme" id="terme">
    <br>
    <span id="error"></span>
    <br>
    <button type="submit" alt="Lancer la recherche!">Rechercher</button>
</form>

<div class="container1">
    <div class="px-lg-2">
        <div class="row">
            <div class="container2">
                <div class="colone">
                    <h2>Topic</h2>
                    <ul>
                        <form id="form" method="post" action="index.php?uc=gererFiche&action=getFicheByCategorie">
                            <input type="checkbox" name="idcateg[]" class="checkbox" value="1" id="1">Développement<br>
                            <input type="checkbox" name="idcateg[]" class="checkbox" value="2" id="2">Actus Web<br>
                            <input type="checkbox" name="idcateg[]" class="checkbox" value="3" id="3">Mobile<br>
                            <input type="checkbox" name="idcateg[]" class="checkbox" value="4" id="4">Jeux<br>
                            <button type="submit" class="text-dark" class="btn btn-lg btn-primary btn-block">Valider categorie</button>
                        </form>
                    </ul>
                </div>
            </div>
            <script type="text/javascript">
                let myForm = document.getElementById('myForm');

                myForm.addEventListener('submit', function(e) {
                    let myInput = document.getElementById('terme');

                    if (myInput.value.trim() == "") {
                        let myError = document.getElementById('error');
                        myError.innerHTML = "Le champ recherche d'article doit être rempli.";
                        myError.style.color = 'red';
                        e.preventDefault();
                    }
                });
            </script>
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
                                    <a class="fa fa-heart" style="text-decoration : none;" href="index.php?uc=gererFiche&action=likerFiche&id=<?= $id ?>"></a> <?= $likes ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                foreach ($fiches as $fiche) {
                    foreach ($fiche as $uneFiche) {
                        $id = $uneFiche['id'];
                        $idcategorie = $uneFiche['idcategorie'];
                        $idcompte = $uneFiche['idcompte'];
                        $libelle = $uneFiche['libelle'];
                        $description = $uneFiche['description'];
                        $contenu = $uneFiche['contenu'];
                        $datemodif = $uneFiche['datemodif'];
                        $datecreation = $uneFiche['datecreation'];
                        $likes = $uneFiche['nblike']
                    ?>
                        <div class="card">
                            <div class="card-header">
                                <p><?php echo htmlspecialchars($datecreation) ?></p>
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
                                <?php echo htmlspecialchars($description) ?>
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
                        </div>
            <?php
                    }
                }
            }
