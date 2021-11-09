<head>
    <link rel="stylesheet" href="../styles/stylesPages/vmoncompte.css">
</head>
<div class="container">
    <?php
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    if ($estConnecte) {
    ?>
        <div class="header">
            <div class="row vertical-align">
                <div class="col-md-8">
                    <ul class="nav nav-pills pull-right" role="tablist">
                        <li <?php if ($action == 'mesInformations') { ?>class="active" <?php } ?>>
                            <a href="index.php?uc=gererCompte&action=mesInformations" class="act">
                                <span class="glyphicon glyphicon-list"></span>
                                Mes Informations
                            </a>
                        </li>
                        <li <?php if ($action == 'mesFiches') { ?>class="active" <?php } ?>>
                            <a href="index.php?uc=gererCompte&action=mesFiches" class="act">
                                <span class="glyphicon glyphicon-th"></span>
                                Mes Fiches
                            </a>
                        </li>
                        <?php if ($_SESSION['role'] == '1') { ?>
                            <li <?php if ($action == 'validerFiches') { ?>class="active" <?php } ?>>
                                <a href="index.php?uc=validation&action=validerFiches" class="act">
                                    <span class="glyphicon glyphicon-user"></span>
                                    Valider les fiches
                                </a>
                            </li>
                        <?php
                        } ?>
                    </ul>
                </div>
            </div>
        </div>
    <?php
    } else {
        include('vues/v_connexion.php');
    ?>

    <?php
    } ?>
</div>