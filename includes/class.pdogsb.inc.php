<?php

/**
 * Classe d'accès aux données.
 *
 * PHP Version 7
 *
 * @category  G4
 * @package   WIKI_FICHE
 * @author    leochastagnac@gmail.com
 * @link      http://www.php.net/manual/fr/book.pdo.php PHP Data Objects sur php.net
 */

/**
 * Classe d'accès aux données.
 *
 * Utilise les services de la classe PDO
 * pour l'application wiki_fiche
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion
 * $monPdo de type PDO
 * $monPdoGsb qui contiendra l'unique instance de la classe
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   Wiki Fiche
 * @link      http://www.php.net/manual/fr/book.pdo.php PHP Data Objects sur php.net
 */
class PdoGsb {

    private static $serveur = 'mysql:host=localhost';
    private static $bdd = 'dbname=wiki_fiche';
    private static $user = 'root';
    private static $mdp = '';
    private static $monPdo;
    private static $monPdoGsb = null;

    /**
     * Constructeur privé, crée l'instance de PDO qui sera sollicitée
     * pour toutes les méthodes de la classe
     */
    private function __construct() {
        PdoGsb::$monPdo = new PDO(
                PdoGsb::$serveur . ';' . PdoGsb::$bdd,
                PdoGsb::$user,
                PdoGsb::$mdp
        );
        PdoGsb::$monPdo->query('SET CHARACTER SET utf8');
    }

    /**
     * Méthode destructeur appelée dès qu'il n'y a plus de référence sur un
     * objet donné, ou dans n'importe quel ordre pendant la séquence d'arrêt.
     */
    public function __destruct() {
        PdoGsb::$monPdo = null;
    }

    /**
     * Fonction statique qui crée l'unique instance de la classe
     * Appel : $instancePdoGsb = PdoGsb::getPdoGsb();
     *
     * @return l'unique objet de la classe PdoGsb
     */
    public static function getPdoGsb() {
        if (PdoGsb::$monPdoGsb == null) {
            PdoGsb::$monPdoGsb = new PdoGsb();
        }
        return PdoGsb::$monPdoGsb;
    }

    /**
     * Retourne les informations d'un visiteur
     *
     * @param String $login Login du visiteur
     * @param String $mdp   Mot de passe du visiteur
     *
     * @return l'id, le nom et le prénom sous la forme d'un tableau associatif
     */
    public function getInfosVisiteur($login, $mdp) {
        $requetePrepare = PdoGsb::$monPdo->prepare(
                'SELECT compte.id AS id, compte.nom AS nom, '
                . 'compte.prenom AS prenom '
                . 'FROM compte '
                . 'WHERE visiteur.login = :unLogin AND visiteur.mdp = :unMdp'
        );
        $requetePrepare->bindParam(':unLogin', $login, PDO::PARAM_STR);
        $requetePrepare->bindParam(':unMdp', $mdp, PDO::PARAM_STR);
        $requetePrepare->execute();
        return $requetePrepare->fetch();
    }

    public function getNomPrenomVisiteur($id) {
        $requetePrepare = PdoGsb::$monPdo->prepare(
                'SELECT visiteur.prenom, visiteur.nom '
                . 'FROM visiteur '
                . 'WHERE visiteur.id = :unId '
        );
        $requetePrepare->bindParam(':unId', $id, PDO::PARAM_STR);
        $requetePrepare->execute();
        return $requetePrepare->fetch();
    }

    /**
     * Retourne les informations d'un comptable
     *
     * @param String $login Login du comptable
     * @param String $mdp   Mot de passe du comptable
     *
     * @return l'id, le nom et le prénom sous la forme d'un tableau associatif
     */
    public function getInfosComptable($login, $mdp) {
        $requetePrepare = PdoGsb::$monPdo->prepare(
                'SELECT comptable.id AS id, comptable.nom AS nom, '
                . 'comptable.prenom AS prenom '
                . 'FROM comptable '
                . 'WHERE comptable.login = :unLogin AND comptable.mdp = :unMdp'
        );
        $requetePrepare->bindParam(':unLogin', $login, PDO::PARAM_STR);
        $requetePrepare->bindParam(':unMdp', $mdp, PDO::PARAM_STR);
        $requetePrepare->execute();
        return $requetePrepare->fetch();
    }



    public function getFraisHorsForfait($idFraisHF) {
        $requetePrepare = PdoGsb::$monPdo->prepare(
                'SELECT * from lignefraishorsforfait'
                . ' WHERE lignefraishorsforfait.id = :unId '
        );
        $requetePrepare->bindParam(':unId', $idFraisHF, PDO::PARAM_STR);
        $requetePrepare->execute();
        return $requetePrepare->fetch();
    }

    /**
     * Retourne le nombre de justificatif d'un visiteur pour un mois donné
     *
     * @param String $idVisiteur ID du visiteur
     * @param String $mois       Mois sous la forme aaaamm
     *
     * @return le nombre entier de justificatifs
     */
    public function getNbjustificatifs($idVisiteur, $mois) {
        $requetePrepare = PdoGsb::$monPdo->prepare(
                'SELECT fichefrais.nbjustificatifs as nb FROM fichefrais '
                . 'WHERE fichefrais.idvisiteur = :unIdVisiteur '
                . 'AND fichefrais.mois = :unMois'
        );
        $requetePrepare->bindParam(':unIdVisiteur', $idVisiteur, PDO::PARAM_STR);
        $requetePrepare->bindParam(':unMois', $mois, PDO::PARAM_STR);
        $requetePrepare->execute();
        $laLigne = $requetePrepare->fetch();
        return $laLigne['nb'];
    }

    /**
     * Retourne sous forme d'un tableau associatif toutes les lignes de frais
     * au forfait concernées par les deux arguments
     *
     * @param String $idVisiteur ID du visiteur
     * @param String $mois       Mois sous la forme aaaamm
     *
     * @return l'id, le libelle et la quantité sous la forme d'un tableau
     * associatif
     */
    public function getLesFraisForfait($idVisiteur, $mois) {
        $requetePrepare = PdoGSB::$monPdo->prepare(
                'SELECT fraisforfait.id as idfrais, '
                . 'fraisforfait.libelle as libelle, '
                . 'lignefraisforfait.quantite as quantite '
                . 'FROM lignefraisforfait '
                . 'INNER JOIN fraisforfait '
                . 'ON fraisforfait.id = lignefraisforfait.idfraisforfait '
                . 'WHERE lignefraisforfait.idvisiteur = :unIdVisiteur '
                . 'AND lignefraisforfait.mois = :unMois '
                . 'ORDER BY lignefraisforfait.idfraisforfait'
        );
        $requetePrepare->bindParam(':unIdVisiteur', $idVisiteur, PDO::PARAM_STR);
        $requetePrepare->bindParam(':unMois', $mois, PDO::PARAM_STR);
        $requetePrepare->execute();
        return $requetePrepare->fetchAll();
    }

    /**
     * Retourne tous les id de la table FraisForfait
     *
     * @return un tableau associatif
     */
    public function getLesIdFrais() {
        $requetePrepare = PdoGsb::$monPdo->prepare(
                'SELECT fraisforfait.id as idfrais '
                . 'FROM fraisforfait ORDER BY fraisforfait.id'
        );
        $requetePrepare->execute();
        return $requetePrepare->fetchAll();
    }

    public function getEtatFrais($idVisiteur, $unMois) {
        $requetePrepare = PdoGsb::$monPdo->prepare(
                'SELECT fichefrais.idetat as etat '
                . 'FROM fichefrais '
                . 'WHERE idvisiteur = :idVisiteur and mois = :unMois'
        );
        $requetePrepare->bindParam(':idVisiteur', $idVisiteur, PDO::PARAM_INT);
        $requetePrepare->bindParam(':unMois', $unMois, PDO::PARAM_STR);
    }

    /**
     * Met à jour la table ligneFraisForfait
     * Met à jour la table ligneFraisForfait pour un visiteur et
     * un mois donné en enregistrant les nouveaux montants
     *
     * @param String $idVisiteur ID du visiteur
     * @param String $mois       Mois sous la forme aaaamm
     * @param Array  $lesFrais   tableau associatif de clé idFrais et
     *                           de valeur la quantité pour ce frais
     *
     * @return null
     */
    public function majFraisForfait($idVisiteur, $mois, $lesFrais, $vehicule) {
        $lesCles = array_keys($lesFrais);
        foreach ($lesCles as $unIdFrais) {
            $qte = $lesFrais[$unIdFrais];
            $requetePrepare = PdoGSB::$monPdo->prepare(
                    'UPDATE lignefraisforfait '
                    . 'SET lignefraisforfait.quantite = :uneQte '
                    . ', lignefraisforfait.vehicule = :unVehicule '
                    . 'WHERE lignefraisforfait.idvisiteur = :unIdVisiteur '
                    . 'AND lignefraisforfait.mois = :unMois '
                    . 'AND lignefraisforfait.idfraisforfait = :idFrais '
            );
            $requetePrepare->bindParam(':uneQte', $qte, PDO::PARAM_INT);
            $requetePrepare->bindParam(':unIdVisiteur', $idVisiteur, PDO::PARAM_STR);
            $requetePrepare->bindParam(':unMois', $mois, PDO::PARAM_STR);
            $requetePrepare->bindParam(':idFrais', $unIdFrais, PDO::PARAM_STR);
            $requetePrepare->bindParam(':unVehicule', $vehicule, PDO::PARAM_STR);
            $requetePrepare->execute();
        }
    }

    public function majFraisHorsForfait($idFrais, $libelle, $date, $montant) {
        $requetePrepare = PdoGSB::$monPdo->prepare(
                'UPDATE lignefraishorsforfait '
                . ' SET lignefraishorsforfait.libelle = :unLibelle '
                . ',lignefraishorsforfait.date = :uneDate '
                . ',lignefraishorsforfait.montant = :unMontant '
                . 'WHERE lignefraishorsforfait.id = :unId'
        );
        $requetePrepare->bindParam(':unId', $idFrais, PDO::PARAM_INT);
        $requetePrepare->bindParam(':unLibelle', $libelle, PDO::PARAM_STR);
        $requetePrepare->bindParam(':uneDate', $date, PDO::PARAM_STR);
        $requetePrepare->bindParam(':unMontant', $montant, PDO::PARAM_INT);
        $requetePrepare->execute();
    }

    /**
     * Met à jour le nombre de justificatifs de la table ficheFrais
     * pour le mois et le visiteur concerné
     *
     * @param String  $idVisiteur      ID du visiteur
     * @param String  $mois            Mois sous la forme aaaamm
     * @param Integer $nbJustificatifs Nombre de justificatifs
     *
     * @return null
     */
    public function majNbJustificatifs($idVisiteur, $mois, $nbJustificatifs) {
        $requetePrepare = PdoGSB::$monPdo->prepare(
                'UPDATE fichefrais '
                . 'SET nbjustificatifs = :unNbJustificatifs '
                . 'WHERE fichefrais.idvisiteur = :unIdVisiteur '
                . 'AND fichefrais.mois = :unMois'
        );
        $requetePrepare->bindParam(
                ':unNbJustificatifs',
                $nbJustificatifs,
                PDO::PARAM_INT
        );
        $requetePrepare->bindParam(':unIdVisiteur', $idVisiteur, PDO::PARAM_STR);
        $requetePrepare->bindParam(':unMois', $mois, PDO::PARAM_STR);
        $requetePrepare->execute();
    }

    /**
     * Teste si un visiteur possède une fiche de frais pour le mois passé en argument
     *
     * @param String $idVisiteur ID du visiteur
     * @param String $mois       Mois sous la forme aaaamm
     *
     * @return vrai ou faux
     */
    public function estPremierFraisMois($idVisiteur, $mois) {
        $boolReturn = false;
        $requetePrepare = PdoGsb::$monPdo->prepare(
                'SELECT fichefrais.mois FROM fichefrais '
                . 'WHERE fichefrais.mois = :unMois '
                . 'AND fichefrais.idvisiteur = :unIdVisiteur'
        );
        $requetePrepare->bindParam(':unMois', $mois, PDO::PARAM_STR);
        $requetePrepare->bindParam(':unIdVisiteur', $idVisiteur, PDO::PARAM_STR);
        $requetePrepare->execute();
        if (!$requetePrepare->fetch()) {
            $boolReturn = true;
        }
        return $boolReturn;
    }

    /**
     * Retourne le dernier mois en cours d'un visiteur
     *
     * @param String $idVisiteur ID du visiteur
     *
     * @return le mois sous la forme aaaamm
     */
    public function dernierMoisSaisi($idVisiteur) {
        $requetePrepare = PdoGsb::$monPdo->prepare(
                'SELECT MAX(mois) as dernierMois '
                . 'FROM fichefrais '
                . 'WHERE fichefrais.idvisiteur = :unIdVisiteur'
        );
        $requetePrepare->bindParam(':unIdVisiteur', $idVisiteur, PDO::PARAM_STR);
        $requetePrepare->execute();
        $laLigne = $requetePrepare->fetch();
        $dernierMois = $laLigne['dernierMois'];
        return $dernierMois;
    }

    /**
     * Crée une nouvelle fiche de frais et les lignes de frais au forfait
     * pour un visiteur et un mois donnés
     *
     * Récupère le dernier mois en cours de traitement, met à 'CL' son champs
     * idEtat, crée une nouvelle fiche de frais avec un idEtat à 'CR' et crée
     * les lignes de frais forfait de quantités nulles
     *
     * @param String $idVisiteur ID du visiteur
     * @param String $mois       Mois sous la forme aaaamm
     *
     * @return null
     */
    public function creeNouvellesLignesFrais($idVisiteur, $mois) {
        $dernierMois = $this->dernierMoisSaisi($idVisiteur);
        $laDerniereFiche = $this->getLesInfosFicheFrais($idVisiteur, $dernierMois);
        if ($laDerniereFiche['idEtat'] == 'CR') {
            $this->majEtatFicheFrais($idVisiteur, $dernierMois, 'CL');
        }
        $requetePrepare = PdoGsb::$monPdo->prepare(
                'INSERT INTO fichefrais (idvisiteur,mois,nbjustificatifs,'
                . 'montantvalide,datemodif,idetat) '
                . "VALUES (:unIdVisiteur,:unMois,0,0,now(),'CR')"
        );
        $requetePrepare->bindParam(':unIdVisiteur', $idVisiteur, PDO::PARAM_STR);
        $requetePrepare->bindParam(':unMois', $mois, PDO::PARAM_STR);
        $requetePrepare->execute();
        $lesIdFrais = $this->getLesIdFrais();
        foreach ($lesIdFrais as $unIdFrais) {
            $requetePrepare = PdoGsb::$monPdo->prepare(
                    'INSERT INTO lignefraisforfait (idvisiteur,mois,'
                    . 'idfraisforfait,quantite) '
                    . 'VALUES(:unIdVisiteur, :unMois, :idFrais, 0)'
            );
            $requetePrepare->bindParam(':unIdVisiteur', $idVisiteur, PDO::PARAM_STR);
            $requetePrepare->bindParam(':unMois', $mois, PDO::PARAM_STR);
            $requetePrepare->bindParam(
                    ':idFrais',
                    $unIdFrais['idfrais'],
                    PDO::PARAM_STR
            );
            $requetePrepare->execute();
        }
    }

    

    /**
     * Supprime le frais hors forfait dont l'id est passé en argument
     *
     * @param String $idFrais ID du frais
     *
     * @return null
     */
    public function supprimerFraisHorsForfait($idFrais) {
        $requetePrepare = PdoGSB::$monPdo->prepare(
                'DELETE FROM lignefraishorsforfait '
                . 'WHERE lignefraishorsforfait.id = :unIdFrais'
        );
        $requetePrepare->bindParam(':unIdFrais', $idFrais, PDO::PARAM_STR);
        $requetePrepare->execute();
    }

    /**
     * Retourne les mois pour lesquel un visiteur a une fiche de frais et 
     * dont l'état est cloturé 
     *
     * @param String $idVisiteur ID du visiteur
     *
     * @return un tableau associatif de clé un mois -aaaamm- et de valeurs
     *         l'année et le mois correspondant
     */
    public function getLesMoisDisponibles($idVisiteur) {
        $requetePrepare = PdoGSB::$monPdo->prepare(
                'SELECT fichefrais.mois AS mois FROM fichefrais '
                . 'WHERE fichefrais.idvisiteur = :unIdVisiteur '
                . 'AND fichefrais.idetat = \'CL\' '
                . 'ORDER BY fichefrais.mois desc'
        );
        $requetePrepare->bindParam(':unIdVisiteur', $idVisiteur, PDO::PARAM_STR);
        $requetePrepare->execute();
        $lesMois = array();
        while ($laLigne = $requetePrepare->fetch()) {
            $mois = $laLigne['mois'];
            $numAnnee = substr($mois, 0, 4);
            $numMois = substr($mois, 4, 2);
            $lesMois[] = array(
                'mois' => $mois,
                'numAnnee' => $numAnnee,
                'numMois' => $numMois
            );
        }
        return $lesMois;
    }

    /**
     * Retourne les mois pour lesquel un visiteur a une fiche de frais
     *
     * @param String $idVisiteur ID du visiteur
     *
     * @return un tableau associatif de clé un mois -aaaamm- et de valeurs
     *         l'année et le mois correspondant
     */
    public function getLesMoisDisponiblesAll($idVisiteur) {
        $requetePrepare = PdoGSB::$monPdo->prepare(
                'SELECT fichefrais.mois AS mois FROM fichefrais '
                . 'WHERE fichefrais.idvisiteur = :unIdVisiteur '
                . 'ORDER BY fichefrais.mois desc'
        );
        $requetePrepare->bindParam(':unIdVisiteur', $idVisiteur, PDO::PARAM_STR);
        $requetePrepare->execute();
        $lesMois = array();
        while ($laLigne = $requetePrepare->fetch()) {
            $mois = $laLigne['mois'];
            $numAnnee = substr($mois, 0, 4);
            $numMois = substr($mois, 4, 2);
            $lesMois[] = array(
                'mois' => $mois,
                'numAnnee' => $numAnnee,
                'numMois' => $numMois
            );
        }
        return $lesMois;
    }

    /**
     * Retourne la liste de mois pour lesquels unVIsiteur à une fiche
     * de frais validé
     * @param type $idVisiteur
     * @return type
     */
    public function getLesMoisDisponiblesVA($idVisiteur) {
        $requetePrepare = PdoGSB::$monPdo->prepare(
                'SELECT fichefrais.mois AS mois FROM fichefrais '
                . 'WHERE fichefrais.idvisiteur = :unIdVisiteur '
                . 'and fichefrais.idetat = \'VA\''
                . 'ORDER BY fichefrais.mois desc'
        );
        $requetePrepare->bindParam(':unIdVisiteur', $idVisiteur, PDO::PARAM_STR);
        $requetePrepare->execute();
        $lesMois = array();
        while ($laLigne = $requetePrepare->fetch()) {
            $mois = $laLigne['mois'];
            $numAnnee = substr($mois, 0, 4);
            $numMois = substr($mois, 4, 2);
            $lesMois[] = array(
                'mois' => $mois,
                'numAnnee' => $numAnnee,
                'numMois' => $numMois
            );
        }
        return $lesMois;
    }

    /**
     * 
     * @return la list des utilisateurs disponibles
     */
    public function getUtilisateursDisponibles() {
        $requetePrepare = PdoGSB::$monPdo->prepare(
                'SELECT DISTINCT visiteur.id as idVisiteur, visiteur.nom as nom, visiteur.prenom as prenom FROM visiteur INNER JOIN fichefrais '
                . 'ON visiteur.id = fichefrais.idvisiteur '
                . 'WHERE fichefrais.idetat = \'CL\' '
                . 'ORDER BY visiteur.nom , visiteur.prenom desc '
        );
        $requetePrepare->execute();
        $laLigne = $requetePrepare->fetchAll();
        return $laLigne;
    }

    /**
     * 
     * @return un tableau avec tous les utilisateur en attente de valider frais
     */
    public function getUtilisateursVA() {
        $requetePrepare = PdoGsb::$monPdo->prepare(
                'SELECT DISTINCT visiteur.id as idVisiteurVA, visiteur.nom as nom, visiteur.prenom'
                . ' as prenom from visiteur inner join fichefrais ON visiteur.id = fichefrais.idvisiteur'
                . ' WHERE fichefrais.idetat = \'VA\' '
                . ' ORDER by nom '
        );
        $requetePrepare->bindParam(':unId', $id, PDO::PARAM_INT);
        $requetePrepare->execute();
        $laLigne = $requetePrepare->fetchAll();
        return $laLigne;
    }

    /**
     * Recupère le nom par l'id
     * @param type $id
     * @return retourne le nom par l'id
     */
    public function getNomById($id) {
        $requetePrepare = PdoGSB::$monPdo->prepare(
                'SELECT visiteur.nom as nom from VISITEUR '
                . 'WHERE id = :IdVisiteur'
        );
        $requetePrepare->bindParam(':IdVisiteur', $id, PDO::PARAM_INT);
        $requetePrepare->execute();
        $laLigne = $requetePrepare->fetch();
        return $laLigne;
    }

    /**
     * Retourne le prix total de la fiche de frais d'un utilisateur
     * @param type $idVisiteur
     * @param type $mois
     * @param type $prixKLM
     * @return le prix total
     */
    public function getPrixFicheFrais($idVisiteur, $mois, $prixKLM) {
        $requetePrepare = PdoGSB::$monPdo->prepare(
                ' SELECT SUM(prix) from ( SELECT quantite*110 as prix '
                . 'FROM lignefraisforfait WHERE idvisiteur = :unIdVisiteur '
                . 'AND mois = :unMois AND idfraisforfait = \'ETP\' '
                . 'UNION '
                . 'SELECT quantite* :unPrixKLM as prix FROM lignefraisforfait '
                . 'WHERE idvisiteur = :unIdVisiteur AND mois = :unMois '
                . 'AND idfraisforfait = \'KM\' '
                . 'UNION '
                . 'SELECT quantite*80 as prix FROM lignefraisforfait '
                . 'WHERE idvisiteur = :unIdVisiteur AND mois = :unMois '
                . 'AND idfraisforfait = \'NUI\' '
                . 'UNION '
                . 'SELECT quantite*25 as prix FROM lignefraisforfait '
                . 'WHERE idvisiteur = :unIdVisiteur AND mois = :unMois '
                . 'AND idfraisforfait = \'REP\' '
                . 'UNION '
                . 'SELECT montant from lignefraishorsforfait '
                . 'WHERE idvisiteur= :unIdVisiteur and mois = :unMois '
                . 'AND etatFraisHf = \'VA\' ) as maTable '
        );
        $requetePrepare->bindParam(':unPrixKLM', $prixKLM, PDO::PARAM_STR);
        $requetePrepare->bindParam(':unIdVisiteur', $idVisiteur, PDO::PARAM_STR);
        $requetePrepare->bindParam(':unMois', $mois, PDO::PARAM_STR);
        $requetePrepare->execute();
        $laLigne = $requetePrepare->fetch();
        return $laLigne;
    }

    /**
     * Permet de récupèrer le prix du KLM en fonction du véhicule du visiteur
     * @param type $id
     * @return le prix klm en fonction du vehicule
     */
    public function getPrixKLM($id, $mois) {
        $requetePrepare = PdoGSB::$monPdo->prepare(
                'SELECT DISTINCT lignefraisforfait.vehicule from lignefraisforfait '
                . 'WHERE idvisiteur = :IdVisiteur '
                . 'AND mois = :unMois'
        );
        $requetePrepare->bindParam(':IdVisiteur', $id, PDO::PARAM_STR);
        $requetePrepare->bindParam(':unMois', $mois, PDO::PARAM_STR);
        $requetePrepare->execute();
        $laLigne = $requetePrepare->fetch();
        switch ($laLigne[0]) {
            case '4CV Diesel':
                return 0.52;
                break;
            case '5/6CV Diesel':
                return 0.58;
                break;
            case '4CV Essence':
                return 0.62;
                break;
            case '5/6CV Essence':
                return 0.67;
                break;
        }
        return $laLigne;
    }

    /**
     * Permet de récupérer le véhicule du visiteur pour une fiche d'un mois
     * @param type $id
     * @param type $mois
     * @return Le vehicule du visiteur
     */
    public function getVehiculeVisiteur($id, $mois) {
        $requetePrepare = PdoGSB::$monPdo->prepare(
                'SELECT DISTINCT lignefraisforfait.vehicule from lignefraisforfait '
                . 'WHERE idvisiteur = :IdVisiteur '
                . 'AND mois = :unMois'
        );
        $requetePrepare->bindParam(':IdVisiteur', $id, PDO::PARAM_STR);
        $requetePrepare->bindParam(':unMois', $mois, PDO::PARAM_STR);
        $requetePrepare->execute();
        $laLigne = $requetePrepare->fetch();
        return $laLigne;
    }

    /**
     * Retourne les informations d'une fiche de frais d'un visiteur pour un
     * mois donné
     *
     * @param String $idVisiteur ID du visiteur
     * @param String $mois       Mois sous la forme aaaamm
     *
     * @return un tableau avec des champs de jointure entre une fiche de frais
     *         et la ligne d'état
     */
    public function getLesInfosFicheFrais($idVisiteur, $mois) {
        $requetePrepare = PdoGSB::$monPdo->prepare(
                'SELECT fichefrais.idetat as idEtat, '
                . 'fichefrais.datemodif as dateModif,'
                . 'fichefrais.nbjustificatifs as nbJustificatifs, '
                . 'fichefrais.montantvalide as montantValide, '
                . 'etat.libelle as libEtat '
                . 'FROM fichefrais '
                . 'INNER JOIN etat ON fichefrais.idetat = etat.id '
                . 'WHERE fichefrais.idvisiteur = :unIdVisiteur '
                . 'AND fichefrais.mois = :unMois'
        );
        $requetePrepare->bindParam(':unIdVisiteur', $idVisiteur, PDO::PARAM_STR);
        $requetePrepare->bindParam(':unMois', $mois, PDO::PARAM_STR);
        $requetePrepare->execute();
        $laLigne = $requetePrepare->fetch();
        return $laLigne;
    }

    /**
     * Modifie l'état et la date de modification d'une fiche de frais.
     * Modifie le champ idEtat et met la date de modif à aujourd'hui.
     *
     * @param String $idVisiteur ID du visiteur
     * @param String $mois       Mois sous la forme aaaamm
     * @param String $etat       Nouvel état de la fiche de frais
     *
     * @return null
     */
    public function majEtatFicheFrais($idVisiteur, $mois, $etat) {
        $requetePrepare = PdoGSB::$monPdo->prepare(
                'UPDATE ficheFrais '
                . 'SET idetat = :unEtat, datemodif = now() '
                . 'WHERE fichefrais.idvisiteur = :unIdVisiteur '
                . 'AND fichefrais.mois = :unMois'
        );
        $requetePrepare->bindParam(':unEtat', $etat, PDO::PARAM_STR);
        $requetePrepare->bindParam(':unIdVisiteur', $idVisiteur, PDO::PARAM_STR);
        $requetePrepare->bindParam(':unMois', $mois, PDO::PARAM_STR);
        $requetePrepare->execute();
    }

    /**
     * Met à jour la colonne montantvalide de la table fichefrais 
     * en fonction du visiteur
     * @param type $idVisiteur
     * @param type $mois
     * @param type $prixTotalm
     */
    public function majPrixFicheFrais($idVisiteur, $mois, $prixTotal) {
        $requetePrepare = PdoGSB::$monPdo->prepare(
                'UPDATE ficheFrais '
                . 'SET montantvalide = :unMontant '
                . 'WHERE fichefrais.idvisiteur = :unIdVisiteur '
                . 'AND fichefrais.mois = :unMois'
        );
        $requetePrepare->bindParam(':unMontant', $prixTotal, PDO::PARAM_STR);
        $requetePrepare->bindParam(':unIdVisiteur', $idVisiteur, PDO::PARAM_STR);
        $requetePrepare->bindParam(':unMois', $mois, PDO::PARAM_STR);
        $requetePrepare->execute();
    }

    /**
     * Modifier l'état en refuser d'un frais hors forfait.
     * @param type $idFraisHf
     */
    public function refuserFraisHorsForfait($idFraisHf) {
        $requetePrepare = PdoGSB::$monPdo->prepare(
                'UPDATE lignefraishorsforfait '
                . 'SET etatFraisHf = \'RE\' '
                . 'WHERE lignefraishorsforfait.id = :unIdFraisHf '
        );
        $requetePrepare->bindParam(':unIdFraisHf', $idFraisHf, PDO::PARAM_STR);
        $requetePrepare->execute();
    }
    
    public function accepterFraisHorsForfait($idFraisHf) {
        $requetePrepare = PdoGSB::$monPdo->prepare(
                'UPDATE lignefraishorsforfait '
                . 'SET etatFraisHf = \'VA\' '
                . 'WHERE lignefraishorsforfait.id = :unIdFraisHf '
        );
        $requetePrepare->bindParam(':unIdFraisHf', $idFraisHf, PDO::PARAM_STR);
        $requetePrepare->execute();
    }

    /**
     * Permet de retourner l'état du frais hf en cours
     * @param type $idFraisHf
     * @return deux carractères pour montrer son etat
     */
    public function estRefuse($idFraisHf) {
        $requetePrepare = PdoGSB::$monPdo->prepare(
                'select etatFraisHf '
                . 'from lignefraishorsforfait '
                . 'WHERE lignefraishorsforfait.id = :unIdFraisHf '
        );
        $requetePrepare->bindParam(':unIdFraisHf', $idFraisHf, PDO::PARAM_STR);
        $requetePrepare->execute();
        $laLigne = $requetePrepare->fetch();
        return $laLigne;
    }

    /**
     * Hash les mots de passe non hashé des visiteurs en bdd
     */
    public static function hashPasswordsVisiteurs()
    {
        if (PdoGsb::$monPdoGsb == null) {
            PdoGsb::$monPdoGsb = new PdoGsb();
        }

        $sql = "SELECT * FROM `visiteur`";
        $requetePrepare = PdoGSB::$monPdo->prepare($sql);
        $requetePrepare->execute();
        $tableauResult = $requetePrepare->fetchALL(PDO::FETCH_ASSOC);
        foreach ($tableauResult as $ligne) {
            if (strlen($ligne["mdp"]) !== 64) {
                $pwdHashed = hash("sha256", $ligne["mdp"]);
                $sql = "update visiteur set mdp = '" . $pwdHashed
                    . "' where id = '" . $ligne["id"] . "'";
                $requetePrepare = PdoGSB::$monPdo->prepare($sql);
                $requetePrepare->execute();
                echo "Visiteur hashé <br>";
            }
        }

        echo "Visiteurs c'est hashé <br>";
    }

    /**
     * Hash les mots de passe non hashé des comptables en bdd 
     */
    public static function hashPasswordsComptables()
    {
        if (PdoGsb::$monPdoGsb == null) {
            PdoGsb::$monPdoGsb = new PdoGsb();
        }

        $sql = "SELECT * FROM `comptable`";
        $requetePrepare = PdoGSB::$monPdo->prepare($sql);
        $requetePrepare->execute();
        $tableauResult = $requetePrepare->fetchALL(PDO::FETCH_ASSOC);

        foreach ($tableauResult as $ligne) {
            if (strlen($ligne["mdp"]) !== 64) {
                $pwdHashed = hash("sha256", $ligne["mdp"]);
                $sql = "update comptable set mdp = '" . $pwdHashed
                    . "' where id = '" . $ligne["id"] . "'";
                $requetePrepare = PdoGSB::$monPdo->prepare($sql);
                $requetePrepare->execute();
                echo "Comptable hashé <br>";
            }
        }

        echo "Comptables c'est hashé <br>";
    }
}
