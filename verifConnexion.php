<?php
	require_once ("controleur/controleur.class.php");
	require_once ("modele/config_bdd.php");


	if (isset($_REQUEST['email']) && isset($_REQUEST['mdp']))
	{
		
		Controleur::connexion($host, $bdd, $user, $mdp);
		$email = $_REQUEST['email']; 
		$mdp = hash('sha256',$_REQUEST['mdp']); 
		if($_REQUEST['role'] == "client" ){
			print(Controleur::verifConnexionClient ($email, $mdp));
		}else if($_REQUEST['role'] == "entreprise" ){
			print(Controleur::verifConnexionEntreprise ($email, $mdp));
		}
	
	}
?>