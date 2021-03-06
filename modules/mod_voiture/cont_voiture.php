<?php

if (!defined('CONST_INCLUDE'))
    die('Accès non-autorisé.');

require_once 'cont_generique.php';
include 'vue_voiture.php';
include 'modele_voiture.php';
include 'mod_commentaires/mod_commentaire.php';

// Appeler les méthodes du controleur dans le constructeur ou dans le module, c'est pareil, pas d'importance.
class ContVoiture extends ContGenerique {

    public function __construct () {
        $this->vue = new VueVoiture();
        $this->modele = new ModeleVoiture();
        $this->modComm = new ModCommentaire();

        if(isset($_GET['action'])){
            switch ($_GET['action']) {
                case "followVoiture":
                    $this->modele->followVoiture();
                    break;
                case "followMarque":
                    $this->modele->followMarque();
                    break;
            }
        }

        if (isset($_POST['message']))
            $this->vue->bandeauConfirmationPublicCom();

        // Récupération des données dans la BD
        $donneesPrincipaleVoiture = $this->modele->getDonneesVoiturePrincipale();
        if (!$donneesPrincipaleVoiture) {       // $donneesPrincipaleVoiture vide = booléen à faux
            $this->vue->msgAucuneVoiture();
            return;
        }
        $hashtagVoiture = $this->modele->getHashtagVoit();
        $photoDetailsVoiture = $this->modele->getPhotoDetails();

        // Affichage des infos
        $this->vue->sectionOverview($donneesPrincipaleVoiture);
        if (isset($_SESSION['login']))
            $this->vue->sectionFollow();

        if (count($hashtagVoiture)>0)
            $this->vue->sectionHashtag($hashtagVoiture);
        $this->vue->sectionDescr($donneesPrincipaleVoiture);
        $this->vue->sectionCaracteristiques($donneesPrincipaleVoiture);
        if (count($photoDetailsVoiture)>0)
            $this->vue->sectionPhotoDetails($photoDetailsVoiture);
        $this->vue->espace();
        if(isset($_SESSION['login'])) {
            $this->modComm->getControleur()->ajout_commentaire($_SESSION['login']);
            $this->modComm->getControleur()->liste_commentaire($_SESSION['login'], $_SESSION['role']);
        }
        else {
            $this->modComm->getControleur()->liste_commentaire(null, null);
        }
    }

    public function lienFeuilleCSS() {
        $this->vue->lienFeuilleCSS();
    }
}
?>