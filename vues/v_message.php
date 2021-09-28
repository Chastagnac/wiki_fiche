<?php
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
switch ($action) {
    case 'likerFiche':
        $word = 'likée.';
        break;
}
?>

<div class="alert alert-warning" role="alert">
    <?php
    echo 'La fiche n\'est plus ' . $word;
    ?>
</div>