<head>
    <link rel="stylesheet" href="../styles/stylesPages/vmoncompte.css">
</head>
<div class="container">
    <?php
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    if ($estConnecte) {
    ?>
        <div class="header">
            <ul class="classcenter" role="tablist">
                <li <?php if ($action == 'mesInformations') { ?>class="active2" <?php } ?>>
                    <a href="index.php?uc=gererCompte&action=mesInformations">
                        <span class="glyphicon glyphicon-list"></span>
                        Mes Informations
                    </a>
                </li>
                <li <?php if ($action == 'mesFiches') { ?>class="active2" <?php } ?>>
                    <a href="index.php?uc=gererCompte&action=mesFiches">
                        <span class="glyphicon glyphicon-th"></span>
                        Mes Fiches
                    </a>
                </li>
                <?php if ($_SESSION['role'] == '1') { ?>
                    <li <?php if ($action == 'validerFiches') { ?>class="active2" <?php } ?>>
                        <a href="index.php?uc=validation&action=validerFiches">
                            <span class="glyphicon glyphicon-user"></span>
                            Valider les fiches
                        </a>
                    </li>
                <?php
                } ?>
            </ul>
        </div>
</div>
<?php
    } else {
        include('vues/v_connexion.php');
?>

<?php
    }
