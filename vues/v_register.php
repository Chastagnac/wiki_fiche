<?php

/**
 * Vue Connexion
 *
 * PHP Version 7
 * @category  Projet
 * @package   Wiki Fiche
 * @link      http://www.php.net/manual/fr/book.pdo.php PHP Data Objects sur php.net
 */
?>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">S'enregistrer</h3>
            </div>
            <div class="panel-body">
                <form role="form" method="post" action="index.php?uc=connexion&action=register">
                    <fieldset>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-user"></i>
                                </span>
                                <input class="form-control" placeholder="Nom" name="nom" type="text" maxlength="45">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-user"></i>
                                </span>
                                <input class="form-control" placeholder="Prénom" name="prenom" type="text" maxlength="45">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-user"></i>
                                </span>
                                <input class="form-control" placeholder="Login" name="login" type="text" maxlength="45">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-lock"></i>
                                </span>
                                <input class="form-control" placeholder="Mot de passe" name="mdp" type="password" maxlength="45">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-lock"></i>
                                </span>
                                <input class="form-control" placeholder="Confimer mot de passe" name="mdp2" type="password" maxlength="45">
                            </div>
                        </div>
                        <input class="btn btn-lg btn-success btn-block" type="submit" value="S'enregistrer">
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>