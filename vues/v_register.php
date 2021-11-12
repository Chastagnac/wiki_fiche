<?php

/**
 * Vue Déconnexion
 * *
 * PHP Version 7
 * @category  PPE
 * @package   Wiki Fiche
 * @link      http://www.php.net/manual/fr/book.pdo.php PHP Data Objects sur php.net
 */


deconnecter();
?>

<head>
    <link rel="stylesheet" href="../styles/stylesPages/vmoncompte.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
</head>
<div class="text-center">
    <p>Vous allez être redirigé vers la page d'enregistrement <br>
</div>


<?php
header("Refresh: 3;URL=index.php");
