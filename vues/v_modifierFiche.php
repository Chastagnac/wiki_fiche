<?php

/**
 * Vue Modification de Fiche
 *
 * PHP Version 7
 * @category  G4
 * @package   Wiki Fiche
 * @link      http://www.php.net/manual/fr/book.pdo.php PHP Data Objects sur php.net
 */

?>
<head>
    <link rel="stylesheet" href="../styles/stylesPages/vmesfiches.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
</head>
<form role="form" method="post" action="index.php?uc=gererFiche&action=validerModification&id=<?php echo $fiche['id']; ?>">
    <fieldset>
        <div class="form-group">
            <label for="exampleFormControlInput1">Libelle</label>
            <input type="text" class="form-control" name="libelle" value="<?php echo $fiche['libelle']; ?>">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Description</label>
            <input type="text" class="form-control" name="description" value="<?php echo $fiche['description']; ?>">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Contenu</label>
            <div class="input-group" style="width : 100%;" value="<?php echo $fiche['contenu']; ?>">
                <textarea class="form-control" name="contenu" type="text"><?php echo $fiche['contenu']; ?>"</textarea>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <label for="categorie">Choisir la categorie de la fiche</label>
                    <br>
                    <select name="categorie">
                        <option value="1">Developpement</option>
                        <option value="2">ActuWeb</option>
                        <option value="3">Mobile</option>
                        <option value="4">Jeux</option>
                    </select>
                </div>
            </div>
        </div>
        <input class="btn btn-lg btn-success btn-block" type="submit" value="Modifier la fiche">
    </fieldset>
</form>