<?php

if (!defined('CONST_INCLUDE'))
    die('Accès non-autorisé.');

require_once 'cont_generique.php';
include 'vue_listeVoiture.php';
include 'modele_listeVoiture.php';

class ContListeVoiture extends ContGenerique {

    public function __construct (){
        $this->vue = new VueListeVoiture();
        $this->modele = new ModeleListeVoiture();
    }

    public function lienFeuilleCSS() {
        $this->vue->lienFeuilleCSS();
    }

    public function genererListeDeVoiture($idConstr) {
        $voituresBD = $this->modele->recupererVoituresBD($idConstr);

        // Si il y a 0 voitures, on arrete la fonction
        if(count($voituresBD) == 0)
            return;

        $nomMarque = $this->modele->recupererNomConstr($idConstr);
        $this->vue->ouvertureListe($nomMarque[0]["marque"]);

        foreach ($voituresBD as $cle => $val) {
            $this->vue->genererUneVoiture($val["idVoiture"], $val["photo"], $val["nomVoiture"], $val["description"]);
        }

        $this->vue->fermetureListe();
    }
}
?>