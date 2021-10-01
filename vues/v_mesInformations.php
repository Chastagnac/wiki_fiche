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
    <link rel="stylesheet" href="../styles/stylesPages/infoscompte.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
</head>

<div class="shadow-sm">
    <!-- Informations du Compte -->
    <div class="imgrole">
        <img src="images/mr.png" class="logomr"><br><br>
        <label for="exampleInputPassword1"></label>
        <p class="roles"><?php echo (getLibelleRole($infosCompte['role'])) ?></p>
    </div>
    <div class="p-4 text-left">
        <div class="form-group">
            <label for="exampleInputPassword1">Email : </label>
            <p><?php echo $infosCompte['mail'] ?></p>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Nom : </label>
            <p><?php echo $infosCompte['nom'] ?></p>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Prénom :</label>
            <p><?php echo $infosCompte['prenom'] ?></p>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Création du compte :</label>
            <p><?php echo $infosCompte['datecreation'] ?></p>
        </div>
        <?php if ($infosCompte['datemodif'] != null) { ?>
            <div class="form-group">
                <label for="exampleInputPassword1">Dernière modification datant du :</label>
                <p><?php echo $infosCompte['datemodif'] ?></p>
            </div>
        <?php
        } ?>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="checkchange" onclick="checkbox()">
            <label class="form-check-label" for="exampleCheck1">Modifier les informations</label>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="checkchange2" onclick="checkbox2()">
            <label class="form-check-label" for="exampleCheck1">Modifier le mot de passe</label>
        </div>
        <!-- Modification données compte -->
        <form id="formulaire" style="display : none;" role="form" method="post" action="index.php?uc=gererCompte&action=validerModifications">
            <div class="p-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email :</label>
                    <input type="email" class="form-control" name="mail" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Entrez le nouvel email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Nom :</label>
                    <input type="text" class="form-control" name="nom" id="exampleInputPassword1" placeholder="Entrez le nom">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Prénom :</label>
                    <input type="text" class="form-control" name="prenom" id="exampleInputPassword1" placeholder="Entrez le prénom">
                </div>
                <button type="text" class="btn btn-primary">Valider</button>
            </div>
        </form>
        <form id="formulaire2" style="display : none;" role="form" method="post" action="index.php?uc=gererCompte&action=changerMdp">
            <div class="p-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Ancien mot de passe :</label>
                    <input type="password" class="form-control" name="lastpswd" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Entrez l'ancien mot de passe">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Nouveau mot de passe</label>
                    <input type="password" class="form-control" name="newpswd" id="exampleInputPassword1" placeholder="Entrez le nouveaux mot de passe">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Confirmer le mot de passe :</label>
                    <input type="password" class="form-control" name="confirmpswd" id="exampleInputPassword1" placeholder="Confirmer le nouveau mot de passe">
                </div>
                <button type="text" class="btn btn-success">Valider</button>
            </div>
        </form>
    </div>
    <!-- Modification du Compte -->
</div>

<script>
    var checkBox = document.getElementById("checkchange");
    var form = document.getElementById("formulaire");

    function checkbox() {
        if (checkBox.checked == true) {
            form.style.display = "block";
        } else {
            form.style.display = "none";
        }
    }
    var checkBox2 = document.getElementById("checkchange2");
    var form2 = document.getElementById("formulaire2");

    function checkbox2() {
        if (checkBox2.checked == true) {
            form2.style.display = "block";
        } else {
            form2.style.display = "none";
        }
    }
</script>