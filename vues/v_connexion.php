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
<div class="login-wrap">
    <div class="login-html">
        <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">S'identifier</label>
        <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Inscription</label>
        <div class="login-form">
            <form role="form" method="post" action="index.php?uc=connexion&action=valideConnexion">
                <fieldset>
                    <!-- connexion -->
                    <div class="sign-in-htm">
                        <div class="group"><br>
                            <input id="user" placeholder="Login" name="login" type="text" maxlength="45" class="input">
                        </div>
                        <div class="group">
                            <input id="pass" placeholder="Mot de passe" name="mdp" class="input" data-type="password" maxlength="45">
                        </div>
                        <div class="group">
                            <input type="submit" class="button" value="Connexion">
                        </div>
                        <div class="hr"></div>
                        <div class="foot-lnk">
                            <a href="#forgot">Mot de passe oublié ?</a>
                        </div>
                    </div>
                </fieldset>
            </form>
            <!-- Inscription -->
            <form role="form" method="post" action="index.php?uc=connexion&action=register">
                <fieldset>
                    <div class="sign-up-htm">
                        <div class="group"><br>
                            <input id="surname" type="text" class="input" placeholder="Nom" name="nom" maxlength="45">
                        </div>
                        <div class="group">
                            <input id="name" type="text" class="input" placeholder="Prénom" name="prenom" maxlength="45">
                        </div>
                        <div class="group">
                            <input id="user" type="text" class="input" placeholder="Login" name="login" maxlength="45">
                        </div>
                        <div class="group">
                            <input id="pass" type="password" class="input" data-type="Password" placeholder="Mot de passe" name="mdp" maxlength="45">
                        </div>
                        <div class="group">
                            <input id="pass" type="password" class="input" data-type="Password"  placeholder="Répeter le mot de passe" name="mdp2" maxlength="45">
                        </div>
                        <div class="group">
                            <input id="pass" type="text" class="input" placeholder="Email" name="mail" maxlength="45">
                        </div>
                        <div class="group">
                            <input type="submit" class="button" value="S'inscrire">
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>