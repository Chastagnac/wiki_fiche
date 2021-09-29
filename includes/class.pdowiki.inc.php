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
 * $monPdoWiki qui contiendra l'unique instance de la classe
 *
 * PHP Version 7
 *
 * @category  Projet
 * @package   Wiki Fiche
 * @link      http://www.php.net/manual/fr/book.pdo.php PHP Data Objects sur php.net
 */
class PdoWiki
{

    private static $serveur = 'mysql:host=localhost';
    private static $bdd = 'dbname=wiki_fiche';
    private static $user = 'root';
    private static $mdp = '';
    private static $monPdo;
    private static $monPdoWiki = null;


    /**
     * Constructeur privé, crée l'instance de PDO qui sera sollicitée
     * pour toutes les méthodes de la classe
     */
    private function __construct()
    {
        PdoWiki::$monPdo = new PDO(
            PdoWiki::$serveur . ';' . PdoWiki::$bdd,
            PdoWiki::$user,
            PdoWiki::$mdp
        );
        PdoWiki::$monPdo->query('SET CHARACTER SET utf8');
    }

    /**
     * Méthode destructeur appelée dès qu'il n'y a plus de référence sur un
     * objet donné, ou dans n'importe quel ordre pendant la séquence d'arrêt.
     */
    public function __destruct()
    {
        PdoWiki::$monPdo = null;
    }

    /**
     * Fonction statique qui crée l'unique instance de la classe
     * Appel : $instancePdoWiki = PdoWiki::getPdoWiki();
     *
     * @return l'unique objet de la classe PdoWiki
     */
    public static function getPdoWiki()
    {
        if (PdoWiki::$monPdoWiki == null) {
            PdoWiki::$monPdoWiki = new PdoWiki();
        }
        return PdoWiki::$monPdoWiki;
    }

    /**
     * Retourne les informations d'un compte
     *
     * @param String $login Login du compte
     * @param String $mdp   Mot de passe du compte
     *
     * @return l'id, le nom et le prénom sous la forme d'un tableau associatif
     */
    public function getInfosCompte($login, $mdp)
    {
        $requetePrepare = PdoWiki::$monPdo->prepare(
            'SELECT compte.id AS id, compte.nom AS nom, '
                . 'compte.prenom AS prenom, compte.mail AS mail '
                . 'FROM compte '
                . 'WHERE compte.login = :unLogin AND compte.mdp = :unMdp'
        );
        $requetePrepare->bindParam(':unLogin', $login, PDO::PARAM_STR);
        $requetePrepare->bindParam(':unMdp', $mdp, PDO::PARAM_STR);
        $requetePrepare->execute();
        return $requetePrepare->fetch();
    }



    /**
     * Retourne les informations d'un compte
     *
     * @param String $id   id du compte
     *
     * @return l'id, le nom, le prénom, le mail, le mdp et la date de création sous la forme d'un tableau associatif
     */
    public function getInfosCompteById($idCompte)
    {
        $requetePrepare = PdoWiki::$monPdo->prepare(
            'SELECT compte.id AS id, compte.nom AS nom, '
                . 'compte.prenom AS prenom, compte.mail AS mail, '
                . 'compte.mdp AS mdp, compte.datecreation, '
                . 'compte.datemodif AS datemodif '
                . 'FROM compte '
                . 'WHERE compte.id = :unId'
        );
        $requetePrepare->bindParam(':unId', $idCompte, PDO::PARAM_STR);
        $requetePrepare->execute();
        return $requetePrepare->fetch();
    }


    /**
     * Retourne chaque fiche dans un tableau associative
     *
     *
     * @return null
     */
    public function getFiches()
    {
        $requetePrepare = PdoWiki::$monPdo->prepare(
            'SELECT fiche.id AS id, fiche.idcategorie AS idcategorie, fiche.idcompte AS idcompte, '
                . 'fiche.libelle AS libelle, '
                . 'fiche.description AS description, '
                . 'fiche.contenu AS contenu, '
                . 'fiche.datemodif AS datemodif, '
                . 'fiche.datecreation AS datecreation, '
                . 'fiche.nblike AS nblike '
                . 'FROM fiche '
                . 'ORDER BY fiche.datecreation'
        );
        $requetePrepare->execute();
        return $requetePrepare->fetchAll();
        $fiches = array();
        while ($laLigne = $requetePrepare->fetch()) {
            $id = $laLigne['id'];
            $idcategorie = $laLigne['idcategorie'];
            $idcompte = $laLigne['idcompte'];
            $libelle = $laLigne['libelle'];
            $description = $laLigne['description'];
            $contenu = $laLigne['contenu'];
            $datemodif = $laLigne['datemodif'];
            $datecreation = $laLigne['datecreation'];
            $nblike = $laLigne['nblike'];
            $fiches[] = array(
                'id'            => $id,
                'idcategorie'   => $idcategorie,
                'idcompte'      => $idcompte,
                'libelle'       => $libelle,
                'description'   => $description,
                'contenu    '   => $contenu,
                'datemodif'     => $datemodif,
                'datecreation'  => $datecreation,
                'nblike'        => $nblike
            );
        }
        return $fiches;
    }

    /**
     * Retourne chaque fiche dans un tableau associative
     *
     *
     * @return null
     */
    public function getFicheByCategorie($idcategorie)
    {
        $requetePrepare = PdoWiki::$monPdo->prepare(
            'SELECT fiche.id AS id, fiche.idcategorie AS idcategorie, fiche.idcompte AS idcompte, '
                . 'fiche.libelle AS libelle, '
                . 'fiche.description AS description, '
                . 'fiche.contenu AS contenu, '
                . 'fiche.datemodif AS datemodif, '
                . 'fiche.datecreation AS datecreation, '
                . 'fiche.nblike AS nblike '
                . 'FROM fiche '
                . 'WHERE fiche.idcategorie = :idcategorie '
                . 'ORDER BY fiche.datecreation'
        );
        $requetePrepare->bindParam(':idcategorie', $idcategorie, PDO::PARAM_STR);
        $requetePrepare->execute();
        return $requetePrepare->fetchAll();
        $fiches = array();
        while ($laLigne = $requetePrepare->fetch()) {
            $id = $laLigne['id'];
            $idcategorie = $laLigne['idcategorie'];
            $idcompte = $laLigne['idcompte'];
            $libelle = $laLigne['libelle'];
            $description = $laLigne['description'];
            $contenu = $laLigne['contenu'];
            $datemodif = $laLigne['datemodif'];
            $datecreation = $laLigne['datecreation'];
            $nblike = $laLigne['nblike'];
            $fiches[] = array(
                'id'            => $id,
                'idcategorie'   => $idcategorie,
                'idcompte'      => $idcompte,
                'libelle'       => $libelle,
                'description'   => $description,
                'contenu    '   => $contenu,
                'datemodif'     => $datemodif,
                'datecreation'  => $datecreation,
                'nblike'        => $nblike
            );
        }
        return $fiches;
    }

    /**
     * Retourne chaque fiche dans un tableau associative
     *
     *
     * @return null
     */
    public function getFichesByCompte($idCompte)
    {
        $requetePrepare = PdoWiki::$monPdo->prepare(
            'SELECT fiche.id AS id, fiche.idcategorie AS idcategorie, fiche.idcompte AS idcompte, '
                . 'fiche.libelle AS libelle, '
                . 'fiche.description AS description, '
                . 'fiche.contenu AS contenu, '
                . 'fiche.datemodif AS datemodif, '
                . 'fiche.datecreation AS datecreation, '
                . 'fiche.nblike AS nblike '
                . 'FROM fiche '
                . 'WHERE fiche.idcompte = :idCompte '
                . 'ORDER BY fiche.datecreation'
        );
        $requetePrepare->bindParam(':idCompte', $idCompte, PDO::PARAM_STR);
        $requetePrepare->execute();
        return $requetePrepare->fetchAll();
        $fiches = array();
        while ($laLigne = $requetePrepare->fetch()) {
            $id = $laLigne['id'];
            $idcategorie = $laLigne['idcategorie'];
            $idcompte = $laLigne['idcompte'];
            $libelle = $laLigne['libelle'];
            $description = $laLigne['description'];
            $contenu = $laLigne['contenu'];
            $datemodif = $laLigne['datemodif'];
            $datecreation = $laLigne['datecreation'];
            $nblike = $laLigne['nblike'];
            $fiches[] = array(
                'id'            => $id,
                'idcategorie'   => $idcategorie,
                'idcompte'      => $idcompte,
                'libelle'       => $libelle,
                'description'   => $description,
                'contenu    '   => $contenu,
                'datemodif'     => $datemodif,
                'datecreation'  => $datecreation,
                'nblike'        => $nblike
            );
        }
        return $fiches;
    }

    /**
     * Retourne 1 fiche dans un tableau associative
     *
     * @return null
     */
    public function getTheFiche($idFiche)
    {
        $requetePrepare = PdoWiki::$monPdo->prepare(
            'SELECT * FROM fiche '
                . 'WHERE fiche.id = :idFiche '
                . 'ORDER BY fiche.datecreation'
        );
        $requetePrepare->bindParam(':idFiche', $idFiche, PDO::PARAM_INT);
        $requetePrepare->execute();
        return $requetePrepare->fetch();
    }

    /**
     * Permets de créer une fiche par un utilisateur
     *
     * @return null
     */
    function insertFiches($idcategorie, $idCompte, $libelle, $description, $contenu)
    {
        $idCompte = $_SESSION['idCompte'];
        $requetePrepare = PdoWiki::$monPdo->prepare(
            'INSERT INTO `fiche`(`id`, `idcategorie`, `idcompte`, `libelle`, `description`, `contenu`, `datemodif`, `datecreation`, `nblike`) '
                . 'VALUES (DEFAULT, :idcategorie, :idCompte, :libelle, :description, :contenu, DEFAULT, NOW(), DEFAULT)'
        );
        $requetePrepare->bindParam(':idcategorie', $idcategorie, PDO::PARAM_INT);
        $requetePrepare->bindParam(':idCompte', $idCompte, PDO::PARAM_INT);
        $requetePrepare->bindParam(':libelle', $libelle, PDO::PARAM_STR);
        $requetePrepare->bindParam(':description', $description);
        $requetePrepare->bindParam(':contenu', $contenu, PDO::PARAM_STR);
        $requetePrepare->execute();
    }

    /**
     * Enregistre le compte dans la base de donnée
     *
     * @param String $nom        Nom du compte
     * @param String $prenom     Prénom du compte
     * @param String $login        Login pour la connexion au compte
     * @param String $mdp        Mdp du compte
     * @param String $mail        mail du compte
     * @param String $dateCreation        Mdp du compte
     *
     * @return null
     */
    function register($prenom, $nom, $login, $mdp, $mail)
    {
        $requetePrepare = PdoWiki::$monPdo->prepare(
            'INSERT INTO `compte`(`id`, `prenom`, `nom`, `login`, `mdp`, `mail`, `datecreation`) '
                . 'VALUES (DEFAULT, :unPrenom, :unNom, :unLogin, :unMdp, :unMail, DATE(NOW()))'
        );
        $requetePrepare->bindParam(':unPrenom', $prenom, PDO::PARAM_STR);
        $requetePrepare->bindParam(':unNom', $nom, PDO::PARAM_STR);
        $requetePrepare->bindParam(':unLogin', $login, PDO::PARAM_STR);
        $requetePrepare->bindParam(':unMdp', $mdp, PDO::PARAM_STR);
        $requetePrepare->bindParam(':unMail', $mail, PDO::PARAM_STR);
        $requetePrepare->execute();
    }

    /**
     * Enregistre le compte dans la base de donnée
     *
     * @param String $nom        Nom du compte
     * @param String $prenom     Prénom du compte
     * @param String $login        Login pour la connexion au compte
     * @param String $mdp        Mdp du compte
     * @param String $mail        mail du compte
     * @param String $dateCreation        Mdp du compte
     *
     * @return null
     */
    function updateInfosCompte($idCompte, $mail, $nom, $prenom)
    {
        $requetePrepare = PdoWiki::$monPdo->prepare(
            'UPDATE `compte` SET compte.prenom = :unPrenom, '
                . 'compte.nom = :unNom, compte.mail = :unMail, '
                . 'compte.datemodif = DATE(NOW())'
                . 'WHERE id = :idCompte'
        );
        $requetePrepare->bindParam(':unPrenom', $prenom, PDO::PARAM_STR);
        $requetePrepare->bindParam(':unNom', $nom, PDO::PARAM_STR);
        $requetePrepare->bindParam(':unMail', $mail, PDO::PARAM_STR);
        $requetePrepare->bindParam(':idCompte', $idCompte, PDO::PARAM_STR);
        $requetePrepare->execute();
    }

    /**
     * Like la fiche dans la base de donnée
     *
     * @param String $idFiche       id de la fiche
     *
     * @return null
     */
    function likerFiche($idFiche)
    {
        $requetePrepare = PdoWiki::$monPdo->prepare(
            'UPDATE `fiche` set fiche.nblike = fiche.nblike + 1 where fiche.id = :ficheId '
        );
        $requetePrepare->bindParam(':ficheId', $idFiche, PDO::PARAM_STR);
        $requetePrepare->execute();
    }

    /**
     * Enleve le like de la fiche
     *
     * @param String $idFiche       id de la fiche
     *
     * @return null
     */
    function unLike($idFiche)
    {
        $requetePrepare = PdoWiki::$monPdo->prepare(
            'UPDATE `fiche` set fiche.nblike = fiche.nblike - 1 where fiche.id = :ficheId '
        );
        $requetePrepare->bindParam(':ficheId', $idFiche, PDO::PARAM_STR);
        $requetePrepare->execute();
    }

    /**
     * Insert a like on db
     *
     * @param String $idCompte      id du compte
     * @param String $idFiche       id de la fiche
     *
     * @return null
     */
    function insertLike($idCompte, $idFiche)
    {
        $requetePrepare = PdoWiki::$monPdo->prepare(
            'INSERT INTO `jaime`(`id`, `idcompte`, `idfiche`) '
                . 'VALUES (DEFAULT, :idCompte, :idFiche) '
        );
        $requetePrepare->bindParam(':idCompte', $idCompte, PDO::PARAM_STR);
        $requetePrepare->bindParam(':idFiche', $idFiche, PDO::PARAM_STR);
        $requetePrepare->execute();
    }


    /**
     * Delete le like de la table jaime
     *
     * @param String $idCompte      id du compte
     * @param String $idFiche       id de la fiche
     *
     * @return null
     */
    function deleteLike($idCompte, $idFiche)
    {
        $requetePrepare = PdoWiki::$monPdo->prepare(
            'DELETE FROM `jaime` WHERE jaime.idcompte = :idCompte AND jaime.idfiche = :idFiche'
        );
        $requetePrepare->bindParam(':idCompte', $idCompte, PDO::PARAM_STR);
        $requetePrepare->bindParam(':idFiche', $idFiche, PDO::PARAM_STR);
        $requetePrepare->execute();
    }

    /**
     * Retourne le nombre de lignes
     *
     * @param String $idCompte      id du compte
     * @param String $idFiche       id de la fiche
     *
     * @return nbLignes
     */
    function checkLike($idCompte, $idFiche)
    {
        $requetePrepare = PdoWiki::$monPdo->prepare(
            'SELECT count(*) AS nb from jaime WHERE jaime.idcompte = :idCompte and jaime.idfiche = :idFiche'
        );
        $requetePrepare->bindParam(':idCompte', $idCompte, PDO::PARAM_STR);
        $requetePrepare->bindParam(':idFiche', $idFiche, PDO::PARAM_STR);
        $requetePrepare->execute();
        $laLigne = $requetePrepare->fetch();
        return $laLigne;
    }





    /**
     * Recupère le nom par l'id
     * @param type $id
     * @return retourne le nom par l'id
     */
    public function getNomById($id)
    {
        $requetePrepare = PdoWiki::$monPdo->prepare(
            'SELECT compte.nom as nom from compte '
                . 'WHERE id = :IdCompte'
        );
        $requetePrepare->bindParam(':IdCompte', $id, PDO::PARAM_INT);
        $requetePrepare->execute();
        $laLigne = $requetePrepare->fetch();
        return $laLigne;
    }



    /**
     * Hash les mots de passe non hashé des comptes en bdd
     */
    public static function hashPasswordsCompte()
    {
        if (PdoWiki::$monPdoWiki == null) {
            PdoWiki::$monPdoWiki = new PdoWiki();
        }

        $sql = "SELECT * FROM `compte`";
        $requetePrepare = PdoWiki::$monPdo->prepare($sql);
        $requetePrepare->execute();
        $tableauResult = $requetePrepare->fetchALL(PDO::FETCH_ASSOC);
        foreach ($tableauResult as $ligne) {
            if (strlen($ligne["mdp"]) !== 64) {
                $pwdHashed = hash("sha256", $ligne["mdp"]);
                $sql = "update compte set mdp = '" . $pwdHashed
                    . "' where id = '" . $ligne["id"] . "'";
                $requetePrepare = PdoWiki::$monPdo->prepare($sql);
                $requetePrepare->execute();
                echo "Compte hashé <br>";
            }
        }

        echo "Compte c'est hashé <br>";
    }
}
