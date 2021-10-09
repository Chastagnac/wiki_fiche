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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carte de blog - Frenchcoder</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../styles/stylesPages/vfiches.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<div id="accueil" class="white">
    <h2>Wiki Fiche</h2>
</div>

<div class="container">
    <div class="row">
        <div class="col-12 col-lg-3 col-xl-3">
            <div class="col align-self-center">
                <div class="contenuTopic">
                    <div class="center">
                        <h2>Topic</h2>
                    </div>
                    <ul>
                        <form class="white" id="form" method="post" action="index.php?uc=gererFiche&action=getFicheByCategorie">
                            <div>
                                <input type="checkbox" name="idcateg[]" value="1" id="1">
                                <label for="dev">Développement</label>
                            </div>
                            <div>
                                <input type="checkbox" name="idcateg[]" value="2" id="2">
                                <label for="idactuweb">Actus Web</label>
                            </div>
                            <div>
                                <input type="checkbox" name="idcateg[]" value="3" id="3">
                                <label for="mobile">Mobile</label>
                            </div>
                            <div>
                                <input type="checkbox" name="idcateg[]" value="4" id="4">
                                <label for="jeux">Jeux</label>
                            </div>
                            <div class="bouton">
                                <button type="submit" class="blue">Valider categorie</button>
                            </div>
                        </form>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-9 col-xl-9">
            <div class="bouton">
                <?php if ($_SESSION['role'] != '-1') { ?>
                    <button class="blue" onclick="location.href='index.php?uc=gererFiche&action=insererFiche'">
                        Créer une fiche
                    </button>
                <?php } ?>
                <label for="terme">
                    <script src="../js/app.js"></script>
                    <form id="myForm" role="form" method="post" action="index.php?uc=gererFiche&action=Rechercher">
                        <input class="recherche" type="text" name="terme" id="terme" placeholder="Recherche d'article ...">
                        <button class="buttonRecherche" type="submit" alt="Lancer la recherche!">
                            <i class="fa">&#xf002;</i>
                        </button>
                        <span id="error"></span>
                    </form>
                </label>
            </div>
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
                    <!--<div class="contenuArticle">-->
                    <div class="card white">
                        <div class="card-header white">
                            <p><?php echo htmlspecialchars($datecreation) ?></p>
                            <?php
                            if ($_SESSION['role'] != '-1') { ?>
                                <h4><a href="index.php?uc=gererFiche&action=visiterFiche&id=<?php echo $id; ?>" style="text-decoration : none;" class="text-dark">
                                        <?php echo htmlspecialchars($libelle) ?></a>
                                </h4>
                            <?php
                            } else { ?>
                                <h1><?php echo htmlspecialchars($libelle) ?></h1>
                            <?php
                            } ?>
                            <p><?php echo htmlspecialchars($description) ?> </p>
                        </div>
                        <div class="card-footer">
                            <div class="buttons">
                                <span class="comment white">
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
                };
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
                                    <h4><a href="index.php?uc=gererFiche&action=visiterFiche&id=<?php echo $id; ?>" class="text-dark"><?php echo htmlspecialchars($libelle) ?></a>
                                    </h4>
                                <?php
                                } else { ?>
                                    <h1><?php echo htmlspecialchars($libelle) ?></h1>
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
                                        <a class="fa fa-heart" style="text-decoration : none;" href="index.php?uc=gererFiche&action=likerFiche&id=<?= $id ?>"></a> <?= $likes ?>
                                    </span>
                                </div>
                            </div>
                        </div>
            <?php
                    }
                }
            } ?>
        </div>
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