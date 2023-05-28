<?php
	
	require_once ("controleur/controleur.class.php");
	require_once ("modele/config_bdd.php");

	if (isset($_REQUEST['email']) && isset($_REQUEST['mdp']) && isset($_REQUEST['nom'])  && isset($_REQUEST['prenom'])  && isset($_REQUEST['tel']) )
	{


		$tab=array(
		"email"=>$_REQUEST['email'],
		"mdp"=>hash('sha256',$_REQUEST['mdp']), 
		"nom"=>$_REQUEST['nom'], 
		"prenom"=>$_REQUEST['prenom'], 
		"noteconfemp"=>null, 
		"tel"=>$_REQUEST['tel'], 
		"numrue"=>$_REQUEST['numrue'],
		"rue"=>$_REQUEST['rue'],
		"ville"=>$_REQUEST['ville'],
		"cp"=>$_REQUEST['cp'],
		"siren"=>$_REQUEST['siren'],
		"libelle"=>$_REQUEST['libelle'],
		"role_representant"=>$_REQUEST['role_representant'],
		"type_cli"=>$_REQUEST['type_cli']);

		Controleur::connexion($host, $bdd, $user, $mdp);
		print(Controleur::inscription ($tab));
	}
?>
