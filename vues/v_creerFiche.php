<?php

/**
 * Vue Creation Fiche
 *
 * PHP Version 7
 * @category  PPE
 * @package   Wiki Fiche
 * @link      http://www.php.net/manual/fr/book.pdo.php PHP Data Objects sur php.net
 */

?>

<head>
    <link rel="stylesheet" href="../styles/stylesPages/vfiches.css">
</head>

<form role="form" method="post" action="index.php?uc=gererFiche&action=insert">
    <fieldset>
        <div class="p-4">
            <div class="form-group">
                <input type="text" class="form-control" name="libelle" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Titre">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="description" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Description">
            </div>
            <div class="form-group">
                <textarea type="text"  rows="10" class="form-control" name="contenu" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="..."></textarea>
            </div>
            <div class="form-group">
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
            <input class="btn btn-lg btn-success" type="submit" value="Publier">
        </div>
    </fieldset>
</form>
