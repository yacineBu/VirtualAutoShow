<?php

if (!defined('CONST_INCLUDE'))
    die('Accès non-autorisé.');

require_once "cont_generique.php";
require_once "modules/mod_accueil/vue_accueil.php";
require_once 'composants/comp_recommandation/comp_recommandation.php';

class ContAccueil extends ContGenerique {
    protected $compRecommandation;

    public function __construct() {
        $this->vue = new VueAccueil();

        $this->vue->affichagePage();
        $this->compRecommandation = new CompRecommandation();       // Création ici du composant recommandation
    }

    public function lienFeuilleCSS() {
        $this->vue->lienFeuilleCSS();
        $this->compRecommandation->getControleur()->lienFeuilleCSS();
    }
}

?>