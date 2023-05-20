<?php
	require_once ("controleur/controleur.class.php");
	require_once ("modele/config_bdd.php");

	if (isset($_REQUEST['id_client']))
	{
	Controleur::connexion($host, $bdd, $user, $mdp);
	print(Controleur::lesAvisCommandes($_REQUEST['id_client']));
	}
?>
