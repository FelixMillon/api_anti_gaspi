<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: *");
	require_once ("modele/modele.class.php");


	class Controleur 
	{
		private static $unModele = null; 

		public static function connexion ($host, $bdd, $user, $mdp)
		{
			Controleur::$unModele = new Modele ($host, $bdd, $user, $mdp); 
		}

		public static function verifConnexionClient ($email, $mdp)
		{
			$unClient = null;
			$unClient = Controleur::$unModele->verifConnexionClient ($email, $mdp);

			//on va le parser JSon
				if($unClient == false){
					return '[{"connect":"denied"}]';					
				}else{
					$tab=array(
						"id_client"=>$unClient['id_client'], 
						"email"=>$unClient['email'],
						"mdp"=>$unClient['mdp'],
						"nom"=>$unClient['nom'],
						"prenom"=>$unClient['prenom'],
						"date_inscription"=>$unClient['date_inscription'],
						"noteconfemp"=>$unClient['noteconfemp'],
						"tel"=>$unClient['tel'],
						"rue"=>$unClient['rue'],
						"numrue"=>$unClient['numrue'],
						"ville"=>$unClient['ville'],
						"cp"=>$unClient['cp'],
						"siren"=>$unClient['siren'],
						"libelle"=>$unClient['libelle'],
						"role_representant"=>$unClient['role_representant'],
						"type_cli"=>$unClient['type_cli'],
						"valide"=>$unClient['valide'],
						"role"=>"client"
						);

						$redis = new Redis();
	
						$redis->connect('127.0.0.1', 6379);

						print("emailclie".$unClient['email']);

						$cle = $unClient['email']."_data";
						print($cle);
						$cle2 = sha256($unClient['email']);

						$token = bin2hex(random_bytes(16));
						$redis->set($cle2, $token, 900);
				
						$redis->hMSet($cle, $tab);

						$tab = $redis->hGetAll($cle);
				
						$redis->close();

				return "[".json_encode($tab).",{token: ".$token."}]";	
				}
			
		}
		public static function generateToken ($email)
		{
			$token = bin2hex(random_bytes(16));
	
			$redis = new Redis();
	
			$redis->connect('127.0.0.1', 6379);
	
			$redis->set($email, $token, 900);
	
			$redis->close();
	
			return '{token: "'+$token+'"}';	
			
		}

		public static function verifConnexionEntreprise ($email, $mdp)
		{
			
			$uneEntreprise = Controleur::$unModele->verifConnexionEntreprise ($email, $mdp) ;
			//on va le parser JSon
			if($uneEntreprise  == false){
				return '[{"connect":"denied"}]';					
			}else{
				$tab=array(
					"id_entreprise"=>$uneEntreprise['id_entreprise'], 
					"email"=>$uneEntreprise['email'],
					"mdp"=>$uneEntreprise['mdp'],
					"nom"=>$uneEntreprise['nom'],
					"prenom"=>$uneEntreprise['prenom'],
					"date_inscription"=>$uneEntreprise['date_inscription'],
					"noteconfemp"=>$uneEntreprise['noteconfemp'],
					"tel"=>$uneEntreprise['tel'],
					"rue"=>$uneEntreprise['rue'],
					"numrue"=>$uneEntreprise['numrue'],
					"ville"=>$uneEntreprise['ville'],
					"cp"=>$uneEntreprise['cp'],
					"siret"=>$uneEntreprise['siret'],
					"libelle"=>$uneEntreprise['libelle'],
					"notepublic"=>$uneEntreprise['notepublic'],
					"role_represenant"=>$uneEntreprise['role_represenant'],
					"type_ent"=>$uneEntreprise['type_ent'],
					"valide"=>$uneEntreprise['valide'],
					"role"=>"client"
					);
			return "[".json_encode($tab)."]";
				}
		}


		public static function RecupIdCommande($where)
		{
			$uneCommande = Controleur::$unModele->RecupIdCommande ($where); 
			//parser les resultats en Json 
				$id_commande = $uneCommande['id_commande'];
			return $id_commande;
		}

		public static function AllEntreprise()
		{
			$lesEntreprises = Controleur::$unModele->AllEntreprise (); 
			//parser les resultats en Json 
			$tab= array(); 
			foreach ($lesEntreprises as $uneEntreprise) {
				$ligne = array(
					"id_entreprise"=>$uneEntreprise['id_entreprise'], 
					"email"=>$uneEntreprise['email'],
					"mdp"=>$uneEntreprise['mdp'],
					"nom"=>$uneEntreprise['nom'],
					"prenom"=>$uneEntreprise['prenom'],
					"date_inscription"=>$uneEntreprise['date_inscription'],
					"noteconfemp"=>$uneEntreprise['noteconfemp'],
					"rue"=>$uneEntreprise['rue'],
					"numrue"=>$uneEntreprise['numrue'],
					"ville"=>$uneEntreprise['ville'],
					"cp"=>$uneEntreprise['cp'],
					"siret"=>$uneEntreprise['siret'],
					"libelle"=>$uneEntreprise['libelle'],
					"notepublic"=>$uneEntreprise['notepublic'],
					"role_represenant"=>$uneEntreprise['role_represenant'],
					"type_ent"=>$uneEntreprise['type_ent'],
					"valide"=>$uneEntreprise['valide']
				);
				$tab[] = $ligne ;
			}
			return json_encode($tab);
		}


		public static function selectAllProduitsWhere($where)
		{
			
			$lesVehicules = Controleur::$unModele->selectAllProduitsWhere ($where); 
			//parser les resultats en Json 
			
			$tab= array(); 
			foreach ($lesVehicules as $unVehicule) {
				$ligne = array(
					"id_produit"=>$unVehicule['id_produit'],
					"libelle"=>$unVehicule['libelle'],
					"lib"=>$unVehicule['lib'],
					"description"=>$unVehicule['description'],
					"regime_alim"=>$unVehicule['regime_alim'],
					"numrue_depot"=>$unVehicule['numrue_depot'],
					"rue_depot"=>$unVehicule['rue_depot'],
					"ville_depot"=>$unVehicule['ville_depot'],
					"cp_depot"=>$unVehicule['cp_depot'],
					"prix_base"=>$unVehicule['prix_base'],
					"reduction"=>$unVehicule['reduction'],
					"poids_unite"=>$unVehicule['poids_unite'],
					"note"=>$unVehicule['note'],
					"quantite"=>$unVehicule['quantite'],
					"id_categorie"=>$unVehicule['id_categorie'],
					"id_entreprise"=>$unVehicule['id_entreprise']
				);
				
				
				$tab[] = $ligne ;
			}
			return json_encode($tab);
		}



		public static function selectAllCommandes()
		{
			$lesVehicules = Controleur::$unModele->selectAllCommandes(); 
			//parser les resultats en Json 
			$tab= array(); 
			foreach ($lesVehicules as $unVehicule) {
					$ligne = array(
						"id_commande"=>$unVehicule['id_commande'],
						"id_livreur"=>$unVehicule['id_livreur'],
						"dateheure_debut"=>$unVehicule['dateheure_debut'],
						"dateheure_fin_reel"=>$unVehicule['dateheure_fin_reel'],
						"dateheure_fin_estimee"=>$unVehicule['dateheure_fin_estimee']
					);
				$tab[] = $ligne ;
			}
			return json_encode($tab);
		}

		public static function selectHistoCommandes($id_livreur)
		{
			$lesVehicules = Controleur::$unModele->selectHistoCommandes($id_livreur);
			//parser les resultats en Json 
			$tab= array(); 
			foreach ($lesVehicules as $unVehicule) {
					$ligne = array(
						"id_commande"=>$unVehicule['id_commande'],
						"id_livreur"=>$unVehicule['id_livreur'],
						"dateheure_debut"=>$unVehicule['dateheure_debut'],
						"dateheure_fin_reel"=>$unVehicule['dateheure_fin_reel'],
						"dateheure_fin_estimee"=>$unVehicule['dateheure_fin_estimee']
					);
				$tab[] = $ligne ;
			}
			return json_encode($tab);
		}

		public static function lesAvisCommandes($id_client)
		{
			$lesAvis = Controleur::$unModele->lesAvisCommandes($id_client);
			//parser les resultats en Json 
			$tab= array(); 
			foreach ($lesAvis as $unAvis) {
					$ligne = array(
						"id_commande"=>$unAvis['id_commande'],
						"nom"=>$unAvis['nom'],
						"prenom"=>$unAvis['prenom'],
						"dateheure_debut"=>$unAvis['dateheure_debut'],
						"id_livreur"=>$unAvis['id_livreur']
					);
				$tab[] = $ligne ;
			}
			return json_encode($tab);
		}

		public static function Commenter($id_commande)
		{
			$lesAvis = Controleur::$unModele->Commenter($id_commande);
			//parser les resultats en Json 
			$tab= array(); 
			foreach ($lesAvis as $unAvis) {
					$ligne = array(
						"id_commande"=>$unAvis['id_commande'],
						"date_heure"=>$unAvis['date_heure'],
						"note"=>$unAvis['note'],
						"commentaire"=>$unAvis['commentaire']
					);
				$tab[] = $ligne ;
			}
			return json_encode($tab);
		}
		

		public static function inscription ($tab)
		{
			Controleur::$unModele->inscription($tab); 
			return '["ok":"1"]';
		}

		
		public static function CreateCommande ($tabcom)
		{
			Controleur::$unModele->CreateCommande($tabcom); 
			return '["ok":"1"]';
		}

		public static function insert_vehicule ($tab)
		{
			Controleur::$unModele->insert_vehicule($tab); 
			return '["ok":"1"]';
		}

		public static function Insert_commenter($tab, $where)
		{
			Controleur::$unModele->Insert_commenter ($tab, $where); 
			return '["ok":"1"]';
		}


		public static function InsertLigneCommande ($tab)
		{
			Controleur::$unModele->InsertLigneCommande($tab); 
			return '["ok":"1"]';
		}


		public static function AvisCommande ($tab)
		{
			Controleur::$unModele->AvisCommande($tab); 
			return '["ok":"1"]';
		}

		public static function update_livreur ($tab, $where)
		{
			Controleur::$unModele->update_livreur($tab, $where); 
			return '["ok":"1"]';
		}

		public static function update_vehicule ($tab, $where)
		{
			Controleur::$unModele->update_vehicule($tab, $where); 
			return '["ok":"1"]';
		}
		
		public static function Affectation_livraison ($tab, $where)
		{
			Controleur::$unModele->Affectation_livraison($tab, $where); 
			return '["ok":"1"]';
		}

		public static function Abandonner_livraison ($where)
		{
			Controleur::$unModele->Abandonner_livraison($where); 
			return '["ok":"1"]';
		}

		public static function Terminer_livraison ($where)
		{
			Controleur::$unModele->Terminer_livraison($where); 
			return '["ok":"1"]';
		}

		public static function delete_livreur ( $where)
		{
			Controleur::$unModele->delete_livreur($where); 
			return '["ok":"1"]';
		}

		public static function delete_vehicule ( $where)
		{
			Controleur::$unModele->delete_vehicule($where); 
			return '["ok":"1"]';
		}

	}
?>











