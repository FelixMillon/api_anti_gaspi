<?php
	
	require_once ("controleur/controleur.class.php");
	require_once ("modele/config_bdd.php");

	if (isset($_REQUEST['id_client']))
	{

		$tabcom=array("id_client"=>$_REQUEST['id_client']);

		Controleur::connexion($host, $bdd, $user, $mdp);
		print(Controleur::CreateCommande($tabcom));
		$id_commande = Controleur::RecupIdCommande($tabcom);

			$json_produit = $_REQUEST['json_produit'];
			
			$Tab = json_decode($json_produit, true);
			
		foreach($Tab as $uneLigne){

			$tab=array(
				"id_client"=>$_REQUEST['id_client'], 
				"id_produit"=>$uneLigne['id_produit'],
				"id_commande"=>$id_commande, 
				"quantite"=>$uneLigne['quantite']);
				
				Controleur::InsertLigneCommande($tab);
			}


			$tab=array("id_commande"=>$id_commande);
		
			Controleur::connexion($host, $bdd, $user, $mdp);
			Controleur::AvisCommande($tab);
			
	
		}

?>
