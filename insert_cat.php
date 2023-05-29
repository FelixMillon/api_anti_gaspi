<?php
	
	require_once ("controleur/controleur.class.php");
	require_once ("modele/config_bdd.php");

	if (isset($_REQUEST['libelle']) && isset($_REQUEST['description'])&& isset($_REQUEST['id_entreprise']))
	{

		$tab=array(
			"libelle"=>$_REQUEST['libelle'],
			"description"=>$_REQUEST['description'],
			"id_entreprise"=>$_REQUEST['id_entreprise']
			);

		Controleur::connexion($host, $bdd, $user, $mdp);
		print(Controleur::Insert_Cat($tab));
	}
?>
