<?php

/**
 * Fonctions pour l'application GSB
 *
 * PHP Version 7
 * PHP Version 7
 * @category  PPE
 * @package   Wiki Fiche
 * @link      http://www.php.net/manual/fr/book.pdo.php PHP Data Objects sur php.net
 */

/**
 * Teste si un quelconque compte est connecté
 *
 * @return vrai ou faux
 */
function estConnecte()
{
    return isset($_SESSION['idCompte']);
}


/**
 * Enregistre dans une variable session les infos d'un compte
 *
 * @param String $idVisiteur ID du compte
 * @param String $nom        Nom du compte
 * @param String $prenom     Prénom du compte
 *
 * @return null
 */
function connecter($idCompte, $nom, $prenom, $role, $xp)
{
    $_SESSION['idCompte'] = $idCompte;
    $_SESSION['nom'] = $nom;
    $_SESSION['prenom'] = $prenom;
    $_SESSION['role'] = $role;
    $_SESSION['rank'] = $xp;
}

/**
 * Détruit la session active
 *
 * @return null
 */
function deconnecter()
{
    session_destroy();
}

/**
 * Transforme une date au format français jj/mm/aaaa vers le format anglais
 * aaaa-mm-jj
 *
 * @param String $maDate au format  jj/mm/aaaa
 *
 * @return Date au format anglais aaaa-mm-jj
 */
function dateFrancaisVersAnglais($maDate)
{
    @list($jour, $mois, $annee) = explode('/', $maDate);
    return date('Y-m-d', mktime(0, 0, 0, $mois, $jour, $annee));
}

/**
 * Transforme une date au format format anglais aaaa-mm-jj vers le format
 * français jj/mm/aaaa
 *
 * @param String $maDate au format  aaaa-mm-jj
 *
 * @return Date au format format français jj/mm/aaaa
 */
function dateAnglaisVersFrancais($maDate)
{
    @list($annee, $mois, $jour) = explode('-', $maDate);
    $date = $jour . '/' . $mois . '/' . $annee;
    return $date;
}

/**
 * Retourne le mois au format aaaamm selon le jour dans le mois
 *
 * @param String $date au format  jj/mm/aaaa
 *
 * @return String Mois au format aaaamm
 */
function getMois($date)
{
    @list($jour, $mois, $annee) = explode('/', $date);
    unset($jour);
    if (strlen($mois) == 1) {
        $mois = '0' . $mois;
    }
    return $annee . $mois;
}

/**
 * Retourne la date actuelle
 * 
 *  @return String Date au format AAAA-JJ-MM
 */
function getDateToday()
{
    $today = getDate();
    return ($today['year'] . "-" . $today['mday'] . "-" . $today["mon"]);
}

function getRank($xp)
{
    if ($xp < 30) {
        $array["lvl"] = "Bronze";
        $array["value"] = "1";
        $array["nextlvl"] = "30";
        return $array;
    } elseif ($xp >= 30 && $xp < 100) {
        $array["lvl"] = "Silver";
        $array["value"] = "2";
        $array["nextlvl"] = "100";
        return $array;
    } elseif ($xp >= 100 && $xp < 200) {
        $array["lvl"] = "Gold";
        $array["value"] = "3";
        $array["nextlvl"] = "200";
        return $array;
    } elseif ($xp >= 200 && $xp < 500) {
        $array["lvl"] = "Diamand";
        $array["value"] = "4";
        $array["nextlvl"] = "500";
        return $array;
    } elseif ($xp >= 500 && $xp < 800) {
        $array["lvl"] = "Champion";
        $array["value"] = "5";
        $array["nextlvl"] = "800";
        return $array;
    } elseif ($xp >= 800) {
        $array["lvl"] = "Master";
        $array["value"] = "6";
        $array["nextlvl"] = "1500";
        return $array;
    }
}

function getProgressBar($xp, $lvl)
{
    switch ($lvl) {
        case 1:
?>
            <progress max="30" value="<?php echo ($xp) ?>"></progress>
            <img src="../images/bronze-1.png" alt="" height="40px">
        <?php
            break;
        case 2:
        ?>
            <progress max="100" value="<?php echo ($xp) ?>"></progress>
            <img src="../images/Silver1_rank_icon.png" alt="" height="40px">
        <?php
            break;
        case 3:
        ?>
            <progress max="200" value="<?php echo ($xp) ?>"></progress>
            <img src="../images/Gold1_rank_icon.png" alt="" height="40px">
        <?php
            break;
        case 4:
        ?>
            <progress max="500" value="<?php echo ($xp) ?>"></progress>
            <img src="../images/s4-15.png" alt="" height="40px">
        <?php
            break;
        case 5:
        ?>
            <progress max="800" value="<?php echo ($xp) ?>"></progress>
            <img src="../images/champion.png" alt="" height="40px">
        <?php
            break;
        case 6:
        ?>
            <progress max="1500" value="<?php echo ($xp) ?>"></progress>
            <img src="../images/am4sfiv1f1f11.png" alt="" height="40px">
    <?php
            break;
    }
    ?>
    <style>
        progress {
            display: flex;
            height: 25px;
            margin-top: 10px;
        }
    </style>
<?php

}

/**
 * Vérifie la validité des cinqs arguments : le nom, le prenom, le mdp et son doublon
 *
 * Des message d'erreurs sont ajoutés au tableau des erreurs
 *
 * @param String $nom       nom du compte
 * @param String $prenom    prenom du compte
 * @param String $mail      mail du compte
 * @param String $mdp       mdp du compte
 * @param String $mdp2      doublon du mdp pour vérifié celui du compte
 *
 * @return null
 */
function valideEnregistrement($nom, $prenom, $mail, $mdp, $mdp2)
{
    if (($nom || $prenom || $mdp || $mdp2) == '') {
        ajouterErreur('Les champs ne peuvent pas être vide');
    } else {
        if ($mdp !== $mdp2) {
            ajouterErreur('Les mots de passe ne peuvent pas être différents');
        } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            ajouterErreur('L\'email n\'est pas valide');
        }
    }
}

/**
 * Vérifie la validité des trois arguments : le mail, le mdp et le nouveau mdp
 *
 * Des message d'erreurs sont ajoutés au tableau des erreurs
 *
 * 
 * @param String $mail      mail du compte
 * @param String $mdp       ancien mdp du compte
 * @param String $new_pass      nouveau mdp
 *
 * @return null
 */
function forgotPass($mail, $mdp, $new_pass)
{
    if (($mail || $mdp || $new_pass) == '') {
        ajouterErreur('Les champs ne peuvent pas être vide');
    } else {
        if ($mdp == $new_pass) {
            ajouterErreur('Les mots de passe ne doit pas correspondre à lancien mot de passe');
        } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            ajouterErreur('L\'email n\'est pas valide');
        }
    }
}


/**
 * Vérifie si une date est inférieure d'un an à la date actuelle
 *
 * @param String $dateTestee Date à tester
 *
 * @return Boolean vrai ou faux
 */
function estDateDepassee($dateTestee)
{
    $dateActuelle = date('d/m/Y');
    @list($jour, $mois, $annee) = explode('/', $dateActuelle);
    $annee--;
    $anPasse = $annee . $mois . $jour;
    @list($jourTeste, $moisTeste, $anneeTeste) = explode('/', $dateTestee);
    return ($anneeTeste . $moisTeste . $jourTeste < $anPasse);
}


/**
 * Ajoute le libellé d'une erreur au tableau des erreurs
 *
 * @param String $msg Libellé de l'erreur
 *
 * @return null
 */
function ajouterErreur($msg)
{
    if (!isset($_REQUEST['erreurs'])) {
        $_REQUEST['erreurs'] = array();
    }
    $_REQUEST['erreurs'][] = $msg;
}

/**
 * Retoune le nombre de lignes du tableau des erreurs
 *
 * @return Integer le nombre d'erreurs
 */
function nbErreurs()
{
    if (!isset($_REQUEST['erreurs'])) {
        return 0;
    } else {
        return count($_REQUEST['erreurs']);
    }
}

/**
 * Vérifie la validité des trois arguments : le libelle, la description et le contenu
 * Des message d'erreurs sont ajoutés au tableau des erreurs
 *
 * @param String $libelle       titre de la fiche
 * @param String $description   description de la fiche
 * @param String $contenu       Contenu de la fiche
 *
 */
function checkFiche($libelle, $description, $contenu)
{
    if ($libelle == "" || $description == "" || $contenu == "") {
        ajouterErreur('Les champs ne peuvent pas être vide');
    }
}

/**
 * Vérifie la validité des trois arguments : le libelle, la description et le contenu
 * Des message d'erreurs sont ajoutés au tableau des erreurs
 *
 * @param String $nom        nom du compte
 * @param String $prenom     prenom du compte
 * @param String $mail       mail du compte
 *
 */
function checkModifCompte($nom, $prenom, $mail)
{
    if ($nom == "" || $prenom == "" || $mail == "") {
        ajouterErreur('Les champs ne peuvent pas être vide');
    }
}

/**
 * Vérifie la validité des trois arguments : le libelle, la description et le contenu
 * Des message d'erreurs sont ajoutés au tableau des erreurs
 *
 * @param String $nom        nom du compte
 * @param String $prenom     prenom du compte
 * @param String $mail       mail du compte
 *
 */
function checkNewPassword($pswd, $lastpswd, $newpswd, $confirmpswd)
{
    if ($lastpswd == "" || $newpswd == "" || $confirmpswd == "" || $pswd == "") {
        ajouterErreur('Les champs ne peuvent pas être vide');
    } elseif ($pswd != $lastpswd) {
        ajouterErreur('Veuillez renseigner le bon mot de passe');
    } elseif ($newpswd != $confirmpswd) {
        ajouterErreur('Les mots de passes ne sont pas identiques');
    }
}

/**
 * Retourne le libelle de l'état du compte
 * @param type $id
 * @return retourne role du compte
 */
function getLibelleRole($id)
{
    switch ($id) {
        case '1':
            return "Admin";
            break;
        case '0':
            return "Membre";
            break;
        case '-1':
            return "Visiteur";
            break;
    }
}

/**
 * Retourne le libelle d'une possible fiche
 * @param type $id
 * @return retourne role du compte
 */
function getEtatCompte($id)
{
    switch ($id) {
        case '1':
            return "VA";
            break;
        case '0':
            return "AT";
            break;
        case '-1':
            return "RE";
            break;
    }
}

/**
 * Retourne le libelle de l'état d'une compte
 * @param type $id
 * @return retourne etat de la fiche
 */
function getLibelleEtat($etat)
{
    switch ($etat) {
        case 'VA':
            return "Validée";
            break;
        case 'AT':
            return "En attente";
            break;
        case 'RE':
            return "Refusée";
            break;
    }
}
