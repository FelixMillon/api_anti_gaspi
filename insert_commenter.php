<?php
	
	require_once ("controleur/controleur.class.php");
	require_once ("modele/config_bdd.php");

	if (isset($_REQUEST['id_commande']) && isset($_REQUEST['note']) && isset($_REQUEST['commentaire']) )
	{

		$where=array("id_commande"=> $_REQUEST['id_commande']);
		$tab=array(
		"note"=>$_REQUEST['note'],
		"commentaire"=>$_REQUEST['commentaire']);

		Controleur::connexion($host, $bdd, $user, $mdp);
		print(Controleur::Insert_commenter ($tab, $where));
	}
?>
