<?php
	
	require_once ("controleur/controleur.class.php");
	require_once ("modele/config_bdd.php");

	if (isset($_REQUEST['libelle']) && isset($_REQUEST['description']))
	{

		$tab=array(
			"libelle"=>$_REQUEST['libelle'],
			"description"=>$_REQUEST['description']
			);

		Controleur::connexion($host, $bdd, $user, $mdp);
		print(Controleur::Insert_Cat($tab));
	}
?>
