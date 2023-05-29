<?php
	require_once ("controleur/controleur.class.php");
	require_once ("modele/config_bdd.php");

	if (isset($_REQUEST['id_entreprise']))
	{


	Controleur::connexion($host, $bdd, $user, $mdp);
	print(Controleur::selectCatProd($_REQUEST['id_entreprise']));

	}
?>
