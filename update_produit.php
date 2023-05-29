<?php
	
	require_once ("controleur/controleur.class.php");
	require_once ("modele/config_bdd.php");

	if (isset($_REQUEST['libelle']) && isset($_REQUEST['description']) && isset($_REQUEST['regim_alim']) && isset($_REQUEST['numrue_depot']) && isset($_REQUEST['rue_depot']) && isset($_REQUEST['ville_depot'])
		&& isset($_REQUEST['cp_depot']) && isset($_REQUEST['prix_base']) && isset($_REQUEST['reduction']) && isset($_REQUEST['poids_unite']) && isset($_REQUEST['note']) && isset($_REQUEST['quantite']) 
		&& isset($_REQUEST['date_peremption']) && isset($_REQUEST['id_categorie']) && isset($_REQUEST['id_entreprise']))
	{

		$where=array("id_produit"=> $_REQUEST['id_produit']);

		$tab=array(
			"libelle"=>$_REQUEST['libelle'],
			"description"=>$_REQUEST['description'],
			"regim_alim"=>$_REQUEST['regim_alim'],
			"numrue_depot"=>$_REQUEST['numrue_depot'],
			"rue_depot"=>$_REQUEST['rue_depot'],
			"ville_depot"=>$_REQUEST['ville_depot'],
			"cp_depot"=>$_REQUEST['cp_depot'],
			"prix_base"=>$_REQUEST['prix_base'],
			"reduction"=>$_REQUEST['reduction'],
			"poids_unite"=>$_REQUEST['poids_unite'],
			"note"=>$_REQUEST['note'],
			"quantite"=>$_REQUEST['quantite'],
			"date_peremption"=>$_REQUEST['date_peremption'],
			"id_categorie"=>$_REQUEST['id_categorie'],
			"id_entreprise"=>$_REQUEST['id_entreprise']
			);

		Controleur::connexion($host, $bdd, $user, $mdp);
		print(Controleur::Update_produit ($tab, $where));
	}
?>
