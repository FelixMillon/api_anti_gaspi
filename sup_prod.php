<?php
	
	require_once ("controleur/controleur.class.php");
	require_once ("modele/config_bdd.php");

	if (isset($_REQUEST['id_produit']))
	{
		Controleur::connexion($host, $bdd, $user, $mdp);
		print(Controleur::Delete_Produit($_REQUEST['id_produit']));
	}
?>
