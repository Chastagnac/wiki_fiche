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

<form role="form" method="post" action="index.php?uc=gererFiche&action=insererFiche">
    <fieldset>
        <div class="form-group">
            <div class="input-group">
                <input class="form-control" placeholder="libelle" name="libelle" type="text" maxlength="45">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <input class="form-control" placeholder="description" name="description" type="text" maxlength="45">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <textarea class="form-control" name="contenu" type="text"></textarea>
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
            <input class="btn btn-lg btn-success btn-block" type="submit" value="Publier">
    </fieldset>
</form>