<div class="container">
    <?php
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    if ($estConnecte) {
    ?>
        <div class="header">
            <div class="row vertical-align">
                <div class="col-md-5">
                    <ul class="nav nav-pills pull-right" role="tablist">
                        <li <?php if ($action == 'mesInformations') { ?>class="active" <?php } ?>>
                            <a href="index.php?uc=gererCompte&action=mesInformations">
                                <span class="glyphicon glyphicon-list"></span>
                                Mes Informations
                            </a>
                        </li>
                        <li <?php if ($action == 'mesFiches') { ?>class="active" <?php } ?>>
                            <a href="index.php?uc=gererCompte&action=mesFiches">
                                <span class="glyphicon glyphicon-th"></span>
                                Mes Fiches
                            </a>
                        </li>
                        <li <?php if ($action == 'mesFichesLiker') { ?>class="active" <?php } ?>>
                            <a href="index.php?uc=gererCompte&action=mesFichesLiker">
                                <span class="glyphicon glyphicon-heart"></span>
                                Mes Fiches liker
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    <?php
    } else {
        include('vues/v_connexion.php');
    ?>

    <?php
    }
