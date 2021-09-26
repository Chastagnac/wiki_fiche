<?php

/**
 * Vue Accueil
 *
 * PHP Version 7
 * @category  PPE
 * @package   Wiki Fiche
 * @link      http://www.php.net/manual/fr/book.pdo.php PHP Data Objects sur php.net
 */

?>


<div class="col-xl-5 col-lg-12 col-md-6 mb-10">
    <div class="shadow-sm">
        <div>
            <h4 class="text-center">
                <?php echo $theFiche['libelle']; ?></a></h4>
            <p class="text-left">
                <?php echo $theFiche['description']; ?>
            </p>
            <p class="text-left">
                <?php echo $theFiche['contenu']; ?>
            </p>
            <p class="text-right">
                <?php echo $theFiche['datecreation']; ?>
            </p>
            <div class="text-right">
                <div class="badge badge-danger px-3 rounded-pill font-weight-normal">Like <?php echo $theFiche['nblike'] ?></div>
            </div>
        </div>
    </div>
</div>
<!-- End -->