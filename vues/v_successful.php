<?php
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
switch ($action) {
    case 'insert':
        $word = 'La fiche à bien été insérée.';
        break;
    case 'likerFiche':
        $word = 'La fiche à bien été liker.';
        break;
    case 'validerModifications':
        $word = 'Les informations ont bien étaient enregistrés.';
}
?>

<div class="alert alert-success" role="alert">
    <?php
    echo $word;
    ?>
</div>