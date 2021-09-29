<form>
    <div class="shadow-sm">
        <!-- Informations du Compte -->
        <div class="p-4 text-center">
            <img src="images/mr.png" class="logomr"><br><br>
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
        </div>
        <!-- Modification du Compte -->
    </div>
</form>
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
</script>