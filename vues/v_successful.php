<?php
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
switch ($action) {
    case 'insert':
        $word = 'inséré.' ;
        break;
    case 'likerFiche':
        $word = 'likée.';
        break;
}
?>

<div class="alert alert-success" role="alert">
    <?php
    echo 'La fiche à bien été ' . $word;
    ?>
</div>