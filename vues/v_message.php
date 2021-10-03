<?php
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
switch ($action) {
    case 'likerFiche':
        $word = 'La fiche n\'est plus likée.';
        break;
    case 'refuserFiche':
        $word = 'La fiche à bien été refusée !';
        break;
}
?>

<div class="alert alert-warning" role="alert">
    <?php
    echo $word;
    ?>
</div>