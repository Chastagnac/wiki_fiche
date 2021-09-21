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
 * @category  PPE
 * @package   Wiki Fiche
 * @link      http://www.php.net/manual/fr/book.pdo.php PHP Data Objects sur php.net
 */
class PdoWiki {

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
    private function __construct() {
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
    public function __destruct() {
        PdoWiki::$monPdo = null;
    }

    /**
     * Fonction statique qui crée l'unique instance de la classe
     * Appel : $instancePdoWiki = PdoWiki::getPdoWiki();
     *
     * @return l'unique objet de la classe PdoWiki
     */
    public static function getPdoWiki() {
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
    public function getInfosCompte($login, $mdp) {
        $requetePrepare = PdoWiki::$monPdo->prepare(
                'SELECT compte.id AS id, compte.nom AS nom, '
                . 'compte.prenom AS prenom '
                . 'FROM compte '
                . 'WHERE compte.login = :unLogin AND compte.mdp = :unMdp'
        );
        $requetePrepare->bindParam(':unLogin', $login, PDO::PARAM_STR);
        $requetePrepare->bindParam(':unMdp', $mdp, PDO::PARAM_STR);
        $requetePrepare->execute();
        return $requetePrepare->fetch();
    }

    public function getNomPrenomCompte($id) {
        $requetePrepare = PdoWiki::$monPdo->prepare(
                'SELECT compte.prenom, compte.nom '
                . 'FROM compte '
                . 'WHERE compte.id = :unId '
        );
        $requetePrepare->bindParam(':unId', $id, PDO::PARAM_STR);
        $requetePrepare->execute();
        return $requetePrepare->fetch();
    }


    /**
     * Recupère le nom par l'id
     * @param type $id
     * @return retourne le nom par l'id
     */
    public function getNomById($id) {
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