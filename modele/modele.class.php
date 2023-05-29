<?php
require_once ("singleton.class.php");
class Modele 
{
	private $pdo ; 
	public function __construct ($host, $bdd, $user, $mdp)
	{
		$this->pdo = Singleton :: getConnexion ($host, $bdd, $user, $mdp);//toujours une connexion unique 
	}
	public function verifConnexionClient ($email, $mdp)
	{
		if ($this->pdo != null)
		{
			$requete = "select * from client where email =:email and mdp = :mdp ;";
			$select = $this->pdo->prepare($requete); 
			$donnees = array(":email"=>$email, ":mdp"=>$mdp); 
			$select->execute ($donnees);
			return  $select->fetch (); 

		}
	}
	public function verifConnexionEntreprise ($email, $mdp)
	{
		if ($this->pdo != null)
		{
			$requete = "select * from entreprise where email =:email and mdp = :mdp ;";
			$select = $this->pdo->prepare($requete); 
			$donnees = array(":email"=>$email, ":mdp"=>$mdp); 
			$select->execute ($donnees);
			return  $select->fetch (); 

		}
	}

	public function RecupIdCommande($where)
	{
		$donnees = array();
		$champs=array();
		foreach($where as $cle => $valeur)
		{
			$champs[] = $cle." = :".$cle;
			$donnees[":".$cle] = $valeur;
		}
		$chaineWhere = implode(" and ", $champs);
		$requete="select * from commande where ".$chaineWhere." and dateheure_debut = (select max(dateheure_debut) from commande);";
		$select=$this->pdo->prepare($requete);
		$select->execute($donnees);

		return $select->fetch();
	}



	public function selectAllVehicules()
	{
		if ($this->pdo != null)
		{
			$requete = "select * from vehicule; ";
			$select = $this->pdo->prepare($requete); 
			$select->execute ();
			return  $select->fetchAll(); 

		}
	}

	public function AllEntreprise()
	{
		if ($this->pdo != null)
		{
			$requete = "select * from entreprise; ";
			$select = $this->pdo->prepare($requete); 
			$select->execute ();
			return  $select->fetchAll(); 

		}
	}

	public function selectAllCommandes()
	{
		if ($this->pdo != null)
		{
			$requete = "select * from commande where id_livreur is null;"; 
			$select = $this->pdo->prepare($requete); 
			$select->execute ();
			return  $select->fetchAll(); 

		}
	}

	public function selectTypeVehicule()
	{
		if ($this->pdo != null)
		{
			$requete = "select * from type_vehicule;"; 
			$select = $this->pdo->prepare($requete); 
			$select->execute ();
			return  $select->fetchAll(); 

		}
	}

	public function selectAllVehiculesWhere($where)
	{
		$donnees = array();
		$champs=array();
		foreach($where as $cle => $valeur)
		{
			$champs[] = $cle." = :".$cle;
			$donnees[":".$cle] = $valeur;
		}
		$chaineWhere = implode(" and ", $champs);
		$requete="select * from vehicule where ".$chaineWhere;
		$select=$this->pdo->prepare($requete);
		$select->execute($donnees);
		return $select->fetchAll();
	}

	public function selectAllProduitsWhere($where)
	{
		$donnees = array();
		$champs=array();
		foreach($where as $cle => $valeur)
		{
			$champs[] = $cle." = :".$cle;
			$donnees[":".$cle] = $valeur;
		}
		$chaineWhere = implode(" and ", $champs);
		
		$requete="select p.*, c.libelle as lib from produit p, categorie_produit c where c.id_categorie = p.id_categorie and ".$chaineWhere;
		$select=$this->pdo->prepare($requete);
		$select->execute($donnees);
		return $select->fetchAll();
	}


	

	

	public function selectCatProd($id_entreprise)
	{
		if ($this->pdo != null)
		{
			$requete = "select distinct(c.id_categorie), c.libelle, c.description from categorie_produit c, produit p where c.id_categorie = p.id_categorie and p.id_entreprise = :id_entreprise ;"; 
			$select = $this->pdo->prepare($requete);
			$donnees = array(":id_entreprise"=>$id_entreprise); 
			$select->execute($donnees);
			return  $select->fetchAll();
		}
	}	

	

	public function selectHistoCommandes($id_livreur)
	{
		if ($this->pdo != null)
		{
			$requete = "select * from commande where dateheure_fin_estimee is not null and id_livreur = :id_livreur ;"; 
			$select = $this->pdo->prepare($requete);
			$donnees = array(":id_livreur"=>$id_livreur); 
			$select->execute($donnees);
			return  $select->fetchAll(); 

		}
	}	

	public function lesAvisCommandes($id_client)
	{
		if ($this->pdo != null)
		{
			$requete = "select id_commande, l.nom, l.prenom, dateheure_debut, c.id_livreur from commande c, livreur l where c.id_livreur = l.id_livreur and dateheure_fin_reel is not null and id_client = :id_client ;"; 
			$select = $this->pdo->prepare($requete);
			$donnees = array(":id_client"=>$id_client); 
			$select->execute($donnees);
			return  $select->fetchAll(); 

		}
	}

	public function Commenter($id_commande)
	{
		if ($this->pdo != null)
		{
			$requete = "select * from commenter where id_commande = :id_commande;"; 
			$select = $this->pdo->prepare($requete);
			$donnees = array(":id_commande"=>$id_commande); 
			$select->execute($donnees);
			return  $select->fetchAll(); 

		}
	}


	public function inscription ($tab)
	{
		if ($this->pdo != null)
		{
			$requete ="insert into client values (null, :email, :mdp, :nom, :prenom, sysdate(), 2.5, :tel, :rue, :numrue, :ville, :cp, :siren, :libelle, :role_representant, :type_cli, null);";
			$donnees=array(":email"=>$tab["email"], ":mdp"=>$tab["mdp"], ":nom"=>$tab["nom"], ":prenom"=>$tab["prenom"], ":tel"=>$tab["tel"], 
			":rue"=>$tab["rue"], ":numrue"=>$tab["numrue"], ":ville"=>$tab["ville"], ":cp"=>$tab["cp"], ":siren"=>$tab["siren"], ":libelle"=>$tab["libelle"], 
			":role_representant"=>$tab["role_representant"], ":type_cli"=>$tab["type_cli"]);
			$insert = $this->pdo->prepare($requete); 
			$insert->execute ($donnees);
			 
		}
	}

	public function insert_vehicule ($tab)
	{
		if ($this->pdo != null)
		{
			$requete ="insert into vehicule values (2, :immatriculation, :poids_max, :annee_fabrication, :volume, :energie, :cons_100_km, :id_type_vehicule);";
			$donnees=array(":immatriculation"=>$tab["immatriculation"], ":poids_max"=>$tab["poids_max"], ":annee_fabrication"=>$tab["annee_fabrication"], ":volume"=>$tab["volume"], ":energie"=>$tab["energie"], 
			":cons_100_km"=>$tab["cons_100_km"], ":id_type_vehicule"=>$tab["id_type_vehicule"]);
			$insert = $this->pdo->prepare($requete); 
			$insert->execute ($donnees);
			 
		}
	}
	
	public function CreateCommande ($tabcom)
	{
		if ($this->pdo != null)
		{
			$requete ="insert into commande values (null, null, :id_client, sysdate(), null,null);";
			$donnees=array(":id_client"=>$tabcom["id_client"]);
			$insert = $this->pdo->prepare($requete); 
			$insert->execute ($donnees);
			 
		}
	}

	public function InsertLigneCommande($tab)
	{
		if ($this->pdo != null)
		{
			$requete ="insert into ligne_commande values (null, :id_client, :id_produit, :id_commande, :quantite);";
			$donnees=array(":id_client"=>$tab["id_client"], ":id_produit"=>$tab["id_produit"] ,":id_commande"=>$tab["id_commande"] ,":quantite"=>$tab["quantite"]);
			$insert = $this->pdo->prepare($requete); 
			$insert->execute ($donnees);
			 
		}
	}

	public function AvisCommande ($tab)
	{
		if ($this->pdo != null)
		{
			$requete ="insert into commenter values (:id_commande, sysdate(), null, null);";
			$donnees=array(":id_commande"=>$tab["id_commande"]);
			$insert = $this->pdo->prepare($requete); 
			$insert->execute ($donnees);
			 
		}
	}


	public function Insert_commenter($tab, $where)
	{
		if ($this->pdo != null)
		{
			$donnees=array();
			$champs2=array();
			foreach ($tab as $cle => $valeur)
			{
				if($valeur != "" or $valeur=="0000-00-00"){
					$champs2[] = $cle." = :".$cle;
					$donnees[":".$cle] = $valeur;
				}        
			}
			$chaineChamps = implode(",",$champs2);
			$champs=array();
			foreach($where as $cle => $valeur)
			{
				$champs[] = $cle." = :".$cle;
				$donnees[":".$cle] = $valeur;
			}
			$chaineWhere = implode(" and ", $champs);
			$requete ="update commenter set ".$chaineChamps."  where ".$chaineWhere;

			$update = $this->pdo->prepare($requete);
			$update->execute($donnees);

		}
	}
	
	public function Terminer_livraison($where)
	{
		if ($this->pdo != null)
		{
			$donnees=array();
			$champs2=array();

			$chaineChamps = implode(",",$champs2);
			$champs=array();
			foreach($where as $cle => $valeur)
			{
				$champs[] = $cle." = :".$cle;
				$donnees[":".$cle] = $valeur;
			}
			$chaineWhere = implode(" and ", $champs);
			$requete ="update commande set  dateheure_fin_estimee = sysdate() where ".$chaineWhere;

			$update = $this->pdo->prepare($requete);
			$update->execute($donnees);

		}
	}
	
	public function delete_livreur($where)
	{
		$donnees=array();
		$champs=array();
		foreach($where as $cle => $valeur)
		{
			$champs[] = $cle." = :".$cle;
			$donnees[":".$cle] = $valeur;
		}
		$chaineWhere = implode(" and ", $champs);
		$requete ="delete from livreur where ".$chaineWhere;
		$delete = $this->pdo->prepare($requete);
		$delete->execute($donnees);
	}


	public function delete_vehicule($where)
	{
		$donnees=array();
		$champs=array();
		foreach($where as $cle => $valeur)
		{
			$champs[] = $cle." = :".$cle;
			$donnees[":".$cle] = $valeur;
		}
		$chaineWhere = implode(" and ", $champs);
		$requete ="delete from vehicule where ".$chaineWhere;
		$delete = $this->pdo->prepare($requete);
		$delete->execute($donnees);
	}

	


}
?>



