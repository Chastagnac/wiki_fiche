<?php
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
switch ($action) {
    case 'insert':
        $word = 'inséré.' ;
        break;
    case 'ValiderFrais':
        $word = 'validée.';
        break;
}
?>

<div class="alert alert-success" role="alert">
    <?php
    echo 'La fiche sur ' . $_POST['libelle'] . ' à bien été ' . $word;
    ?>
</div>