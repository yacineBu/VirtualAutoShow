<?php
	/*if (!defined('CONST_INCLUDE'))
		die('Accès non-autorisé.');

	if (!defined($_SESSION['role']))
		die('Accès non-autorisé.');	

	if ($_SESSION['role']!=2) {
		die("Accès non-autorisé.");
	}*/

	require_once "mod_generique.php";

	class ModAdministration extends ModGenerique {
		public $affichage;
		/*
			require_once 'connexion.php';
			Connexion::initConnexion();
		*/
		public function __construct (){
			include 'cont_administration.php';
			$this->controleur = new ContAdministration();
			//$this->affichage = $this->controleur->getVue()->getAffichage();
		}	
	}
?>