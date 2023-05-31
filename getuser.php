<?php
	require_once ("controleur/controleur.class.php");
	require_once ("modele/config_bdd.php");


		
		Controleur::connexion($host, $bdd, $user, $mdp);


		if($_REQUEST['role'] == "client" ){
			print(Controleur::getClient ($id));
		}else if($_REQUEST['role'] == "entreprise" ){
			print(Controleur::getEntreprise ($id));
		}
	
?>