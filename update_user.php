<?php
	
	require_once ("controleur/controleur.class.php");
	require_once ("modele/config_bdd.php");

	if (isset($_REQUEST['id']) && isset($_REQUEST['nom']) && isset($_REQUEST['prenom']) && isset($_REQUEST['tel']) && isset($_REQUEST['numrue']) && isset($_REQUEST['rue']) 
		&& isset($_REQUEST['ville'])  && isset($_REQUEST['cp']) )
	{

		$where=array("id"=> $_REQUEST['id']);

		$tab=array(
			"nom"=>$_REQUEST['nom'],
			"prenom"=>$_REQUEST['prenom'],
			"tel"=>$_REQUEST['tel'],
			"numrue"=>$_REQUEST['numrue'],
			"rue"=>$_REQUEST['rue'],
			"ville"=>$_REQUEST['ville'],
			"cp"=>$_REQUEST['cp']
			);

		Controleur::connexion($host, $bdd, $user, $mdp);
		print(Controleur::Update_user ($tab, $where));
	}
?>
