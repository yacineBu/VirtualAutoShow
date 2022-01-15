<?php

if (!defined('CONST_INCLUDE'))
    die('Accès non-autorisé.');

require_once "modele_generique.php";

class ModeleListeMarque extends ModeleGenerique {
    public function __construct() {

    }

    public function recupererConstructeursBD() {
        $objRequete = self::$bdd->prepare("SELECT idConstructeur, logoMarque FROM constructeur ORDER BY marque");
        $objRequete->execute();
        $tuples = $objRequete->fetchAll();
        return $tuples;
    }

/*    public function nbTuplesDernierPrepare() {
        $objRequete = self::$bdd->prepare("SELECT logoMarque FROM Constructeur");
        $objRequete->execute();
        return $objRequete->rowCount();
    }*/
}
