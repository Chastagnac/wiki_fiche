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

<head>
    <link rel="stylesheet" href="../styles/stylesPages/vmesfiches.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
</head>

<div class="col-xl-5 col-lg-12 col-md-6 mb-10">
    <div class="border">
        <div class="padding">
            <h4 class="text-center">
                <?php echo $theFiche['libelle']; ?>
                </a></h4>
            <p class="text-left">
                <?php echo $theFiche['description']; ?>
            </p>
            <p class="text-left">
                <?php echo $theFiche['contenu']; ?>
            </p>
            <p class="text-right">
                <?php echo $theFiche['datecreation']; ?>
            </p>
            <div class="text-right">
                <?php if ($_SESSION['role'] == '1') { ?>
                    <a href="index.php?uc=gererFiche&action=modifierFiche&id=<?php echo $theFiche['id']; ?>" class="glyphicon glyphicon-pencil" style="text-decoration : none;"></a>
                    <a href="index.php?uc=gererFiche&action=suppression&id=<?php echo $theFiche['id']; ?>" class="glyphicon glyphicon-trash" style="text-decoration : none;"></a>
                <?php } ?>
                <div class="badge badge-danger px-3 rounded-pill font-weight-normal">Like <?php echo $theFiche['nblike'] ?></div>
            </div>
        </div>
    </div>
</div>
<form role="form" method="post" action="index.php?uc=gererFiche&action=insererCommentaire&id=<?php echo $theFiche['id']; ?>">
    <div class="p-2">
        <div class="form-group">
            <input type="text" class="form-control" name="commentaire" id="transparent-input" aria-describedby="emailHelp" placeholder="Ecrivez un commentaire ...">
        </div>
        <button type="submit" style="margin-left: 22px;" class="btn btn-primary">Poster</button>
    </div>
</form>
<?php
foreach ($commentaires as $commentaire => $com) {
    $id = $com['id'];
    $commentaire = $com['commentaire'];
    $idAuteur = $com['idcompte'];
    $date = $com['date'];
    $auteur = $pdo->getInfosCompteById($idAuteur);
?>
    <div class="card">

        <p class="text-muted">
            <?php echo htmlspecialchars($auteur['prenom'] . ' ' . $auteur['nom']); ?>
            <span class="comment">
                <i class="fa fa-comment-o" aria-hidden="true"><br></i>
            </span>
        <div class="text-right text-muted">
            <?php echo htmlspecialchars($date);
            if ($_SESSION['role'] == '1' || $idAuteur == $_SESSION['idCompte']) { ?>
                <a href="index.php?uc=gererFiche&action=suppressioncomm&id=<?php echo $id; ?>&idfiche=<?php echo $theFiche['id']; ?>" class="glyphicon glyphicon-trash" style="text-decoration : none;"></a>
            <?php } ?>
        </div>
        </p>
        <div class="card-body">
            <p><?php echo htmlspecialchars($commentaire); ?></p>
            <br>
            <?php if (count($commentaires) != 1) { ?>
                <hr>
            <?php } ?>
        </div>
    </div>
<?php }
?>