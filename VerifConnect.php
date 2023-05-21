<?php
	require_once ("controleur/controleur.class.php");
	require_once ("modele/config_bdd.php");


	if (isset($_REQUEST['email']) && isset($_REQUEST['token']))
	{


		
		Controleur::connexion($host, $bdd, $user, $mdp);
		print(Controleur::VerifConnect($_REQUEST['email'], $_REQUEST['token']));
	
	}
?>