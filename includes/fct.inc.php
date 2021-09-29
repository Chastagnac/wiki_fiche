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
function connecter($idCompte, $nom, $prenom)
{
    $_SESSION['idCompte'] = $idCompte;
    $_SESSION['nom'] = $nom;
    $_SESSION['prenom'] = $prenom;
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

/**
 * Vérifie la validité des cinqs arguments : le nom, le prenom, le login, le mdp et son doublon
 *
 * Des message d'erreurs sont ajoutés au tableau des erreurs
 *
 * @param String $nom       nom du compte
 * @param String $prenom    prenom du compte
 * @param String $login     login du compte
 * @param String $mail      mail du compte
 * @param String $mdp       mdp du compte
 * @param String $mdp2      doublon du mdp pour vérifié celui du compte
 *
 * @return null
 */
function valideEnregistrement($nom, $prenom, $login, $mail, $mdp, $mdp2)
{
    if (($nom || $prenom || $login || $mdp || $mdp2) == '') {
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
    if ($libelle == "" || $description == "" || $contenu == "")
    {
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
    if ($nom == "" || $prenom == "" || $mail == "")
    {
        ajouterErreur('Les champs ne peuvent pas être vide');
    }
}