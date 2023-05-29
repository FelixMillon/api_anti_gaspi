<?php
	
	require_once ("controleur/controleur.class.php");
	require_once ("modele/config_bdd.php");

	if (isset($_REQUEST['id_categorie']))
	{
		Controleur::connexion($host, $bdd, $user, $mdp);
		print(Controleur::Delete_Cat($_REQUEST['id_categorie']));
	}
?>
