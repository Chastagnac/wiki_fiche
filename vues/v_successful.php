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
        break;
    case 'changerMdp':
        $word = 'Le mot de passe à bien était modifé.';
        break;
    case 'validation':
        $word = 'La fiche à bien été validée !';
        break;
    case 'validerModification':
        $word = 'La fiche à bien été modifiée !';
        break;
    case 'suppression':
        $word = 'La fiche à bien été supprimée ! ';
        break;
    case 'insererCommentaire':
        $word = 'Le commentaire à bien été inséré !';
        break;
}
?>

<div class="alert alert-success" role="alert">
    <?php
    echo '<p style="color : black !important;">' . $word . '</p>';
    ?>
</div>