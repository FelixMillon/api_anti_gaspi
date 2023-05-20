<?php
	
	require_once ("controleur/controleur.class.php");
	require_once ("modele/config_bdd.php");

	if (isset($_REQUEST['email']) && isset($_REQUEST['mdp']) && isset($_REQUEST['nom'])  && isset($_REQUEST['prenom'])  && isset($_REQUEST['tel']) )
	{


		$tab=array(
		"email"=>$_REQUEST['email'],
		"mdp"=>$_REQUEST['mdp'], 
		"nom"=>$_REQUEST['nom'], 
		"prenom"=>$_REQUEST['prenom'], 
		"date_inscription"=>null, 
		"noteconfemp"=>null, 
		"tel"=>$_REQUEST['tel'], 
		"numrue"=>$_REQUEST['numrue'],
		"rue"=>$_REQUEST['rue'],
		"ville"=>$_REQUEST['ville'],
		"cp"=>$_REQUEST['cp'],
		"siret"=>$_REQUEST['siret'],
		"libelle"=>$_REQUEST['libelle'],
		"notepublic"=>$_REQUEST['notepublic'],
		"role_represenant"=>$_REQUEST['role_represenant'],
		"type_ent"=>$_REQUEST['type_ent'],
		"valide"=>'en attente');

		Controleur::connexion($host, $bdd, $user, $mdp);
		print(Controleur::inscription ($tab));
	}
?>
