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
<main role="main">
    <link rel="stylesheet" href="../styles/stylesPages/vfiches.css">




    <!-- Marketing messaging and featurettes
      ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">
        <br>
        <!-- Three columns of text below the carousel -->
        <div class="row">
            <div class="col-lg-3">
                <img class="rounded-circle" src="../images/team/Untitled_design_3.png" alt="Generic placeholder image" width="140" height="140">
                <h2>Léo Chastagnac</h2>
                <p>
                <ul>
                    <li>
                        Chef de projet
                    </li>
                    <li>
                        Développeur Back End & Front
                    </li>
                </ul>
                </p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-3">
                <img class="rounded-circle" src="../images/team/Untitled_design_2.png" alt="Generic placeholder image" width="140" height="140">
                <h2>Razine Beldjilali </h2>
                <p>
                <ul>
                    <li>
                        Développeur Back End & Front
                    </li>
                </ul>
                </p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-3">
                <img class="rounded-circle" src="../images/team/Untitled_design_4.png" alt="Generic placeholder image" width="140" height="140">
                <h2>Van Hai Le </h2>
                <p>
                <ul>
                    <li>
                        Développeur Front & Planning
                    </li>
                </ul>
                </p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-3">
                <img class="rounded-circle" src="../images/team/Untitled_design_5.png" alt="Generic placeholder image" width="140" height="140">
                <h2>Lucas Pezone </h2>
                <p>
                <ul>
                    <li>
                        Développeur Front End
                    </li>
                    <li>Designer UX</li>
                </ul>
                </p>
            </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->


        <!-- START THE FEATURETTES -->

        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7">
                <h2 class="featurette-heading">L'objectif ?</h2>
                <p class="lead">L’objectif stipulé dans le livret de projet informatique était de réaliser un site web de base de connaissance que nous avons intitulé “Wiki Fiche” où nous y répertorions les bonnes pratiques et les solutions rencontrées tout au long de nos périodes d’alternance.</p>
            </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7 order-md-2">
                <h2 class="featurette-heading">Contraintes ?</h2>
                <p class="lead">En ce qui concerne la partie contraintes on peut en citer 3 imposées par le client :
                <ul>
                    <li>From Scratch : réalisation du projet à partir de zéro en utilisant uniquement nos compétences acquises dans le domaine.</li>
                    <li>L’utilisation d’un CMS ou tout autre outil tout prêt n’est pas autorisé.</li>
                    <li>Utilisation d’un design et d’une charte graphique libre.Périmètre.</li>
                </ul>
                </p>
            </div>
        </div>



        <br>

        <hr class="featurette-divider">
        <h2 class="featurette-heading">Description fonctionnelle des besoins</h2>

        <!-- DivTable.com -->



        <table>
            <tbody>
                <tr style="height: 50px; ">
                    <td style="height: 50px;"><strong>Mission</strong></td>
                    <td style="height: 50px;">&nbsp;<strong>Objectif</strong></td>
                </tr>
                <tr style="height: 50px;">
                    <td style="height: 50px;">&nbsp;<span style="font-weight: 400;">Authentification</span></td>
                    <td style="height: 50px;">&nbsp;<span style="font-weight: 400;">S&rsquo;inscrire et se connecter avec un compte</span></td>
                </tr>
                <tr style="height: 50px;">
                    <td style="height: 50px;">&nbsp;<span style="font-weight: 400;">Recherche des fiches</span></td>
                    <td style="height: 50px;">&nbsp;<span style="font-weight: 400;">Pouvoir choisir parmis les diff&eacute;rents th&egrave;mes via une barre de recherche</span></td>
                </tr>
                <tr style="height: 50px;">
                    <td style="height: 50px;">&nbsp;<span style="font-weight: 400;">Insertion des fiches</span></td>
                    <td style="height: 50px;">&nbsp;<span style="font-weight: 400;">Pouvoir cr&eacute;er un article</span></td>
                </tr>
                <tr style="height: 50px;">
                    <td style="height: 50px;">&nbsp;<span style="font-weight: 400;">Consultation des fiches</span></td>
                    <td style="height: 50px;">&nbsp;<span style="font-weight: 400;">Pouvoir consulter un article</span></td>
                </tr>
                <tr style="height: 50px;">
                    <td style="height: 50px;">&nbsp;<span style="font-weight: 400;">Soumettre une modification sur la fiche actuelle</span></td>
                    <td style="height: 50px;">&nbsp;<span style="font-weight: 400;">Proposer une modification sur une fiche</span></td>
                </tr>
                <tr style="height: 50px;">
                    <td style="height: 50px;">&nbsp;<span style="font-weight: 400;">Commenter une fiche</span></td>
                    <td style="height: 50px;">&nbsp;<span style="font-weight: 400;">Mettre des commentaires pour une fiche</span></td>
                </tr>
                <tr style="height: 50px;">
                    <td style="height: 50px;">&nbsp;<span style="font-weight: 400;">Gestion des r&ocirc;les</span></td>
                    <td style="height: 50px;">&nbsp;<span style="font-weight: 400;">Se connecter sous Administrateur, Utilisateur ou Visiteur</span></td>
                </tr>
                <tr style="height: 50px;">
                    <td style="height: 50px;">&nbsp;<span style="font-weight: 400;">Gestion des cat&eacute;gories</span></td>
                    <td style="height: 50px;">&nbsp;<span style="font-weight: 400;">Classer les fiches par cat&eacute;gorie</span></td>
                </tr>
                <tr style="height: 50px;">
                    <td style="height: 50px;">&nbsp;<span style="font-weight: 400;">Mod&eacute;ration des commentaires</span></td>
                    <td style="height: 50px;">&nbsp;<span style="font-weight: 400;">G&eacute;rer les commentaires (suppression)</span></td>
                </tr>
                <tr style="height: 50px;">
                    <td style="height: 50px;">&nbsp;</td>
                    <td style="height: 50px;">&nbsp;</td>
                </tr>
                <tr style="height: 50px;">
                    <td style="height: 50px;"><strong>Fonctionnalit&eacute;s suppl&eacute;mentaire </strong></td>
                    <td style="height: 50px;">&nbsp;</td>
                </tr>
                <tr style="height: 50px;">
                    <td style="height: 50px;"><strong><span style="font-weight: 400;">Syst&egrave;me de like</span></strong></td>
                    <td style="height: 50px;"><span style="font-weight: 400;">Pouvoir liker une fiche afin qu&rsquo;elle soit classer par popularit&eacute;</span></td>
                </tr>
                <tr style="height: 50px;">
                    <td style="height: 50px;"><span style="font-weight: 400;">Visibilit&eacute; du compte</span></td>
                    <td style="height: 50px;"><span style="font-weight: 400;">Avoir une partie compte ou l&rsquo;on peut voir nos propre fiches</span></td>
                </tr>
                <tr style="height: 50px;">
                    <td style="height: 50px;"><span style="font-weight: 400;">Sytème de rang</span></td>
                    <td style="height: 50px;"><span style="font-weight: 400;">Pour chaque ajout de fiche ou de commentaires .. le niveau d'expérience augmente</span></td>
                </tr>
            </tbody>
        </table>
        <!-- /END THE FEATURETTES -->
    </div><!-- /.container -->
</main>