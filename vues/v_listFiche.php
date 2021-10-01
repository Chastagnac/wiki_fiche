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
<script src="../js/app.js"></script>

<div class="container-fluid">
    <div class="px-lg-2">
        <div class="row">
            <ul>
                <form id="form" method="post" action="index.php?uc=gererFiche&action=getFicheByCategorie">
                    <input type="checkbox" name="idcateg[]" class="checkbox" value="1" id="dev"> Développement<br>
                    <input type="checkbox" name="idcateg[]" class="checkbox" value="2" id="idactuweb"> Actus Web<br>
                    <input type="checkbox" name="idcateg[]" class="checkbox" value="3" id="mobile"> Mobile<br>
                    <input type="checkbox" name="idcateg[]" class="checkbox" value="4" id="jeux"> Jeux<br>
                    <button type="submit" class="text-dark" class="btn btn-lg btn-primary btn-block">Valider categorie</button>
                </form>
            </ul>
            <form id="myForm" role="form" method="post" action="index.php?uc=gererFiche&action=Rechercher">
                <label for="terme"> Entrez le titre d'une fiche</label>
                <input type="text" name="terme" id="terme">
                <br>
                <span id="error"></span>
                <br>
                <button type="submit" alt="Lancer la recherche!">Rechercher</button>
            </form>

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
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                        <div class="shadow-sm">
                            <div class="p-4">
                                <h4> <a href="index.php?uc=gererFiche&action=visiterFiche&id=<?php echo $id; ?>" class="text-dark">
                                        <?php echo htmlspecialchars($libelle) ?></a></h4>
                                <p class="text-muted mb-0">
                                    <?php echo htmlspecialchars($description) ?>
                                </p>
                                <a class="glyphicon glyphicon-heart" href="index.php?uc=gererFiche&action=likerFiche&id=<?= $id ?>"></a> <?= $likes ?>
                            </div>
                        </div>
                    </div>
                    <!-- End -->
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
                        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                            <div class="shadow-sm">
                                <div class="p-4">
                                    <h4> <a href="index.php?uc=gererFiche&action=visiterFiche&id=<?php echo $id; ?>" class="text-dark">
                                            <?php echo htmlspecialchars($libelle) ?></a></h4>
                                    <p class="text-muted mb-0">
                                        <?php echo htmlspecialchars($description) ?>
                                    </p>
                                    <a class="btn btn-info" href="index.php?uc=gererFiche&action=likerFiche&id=<?= $id ?>"></a> <?= $likes ?>
                                </div>
                            </div>
                        </div>
                        <!-- End -->
            <?php
                    }
                }
            }
            ?>
        </div>
    </div>
</div>