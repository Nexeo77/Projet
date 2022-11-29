<?php

// Classe qui gère la fabrication d'un objet Pilote
// Et donne les caractéristiques de cet objet (attributs, méthodes)
class Pilote
{
	// Atrributs d'un pilote
	private $_NumP;
	private $_NameP;
	private $_Address;
	private $_Salary;

	public function __construct(array $donnees)
	{
		// Le constructeur appelle la méthode hydrate
		// Celle ci sera utile pour la construction des objets 
		$this->hydrate($donnees);
	}


	public function hydrate(array $donnees)
	{
		foreach ($donnees as $key => $value) {
			$method = 'set'.$key;
			if (method_exists($this, $method))
			{
				$this->$method($value);
			}
			else
			{
				trigger_error('Je trouve pas la méthode !', E_USER_WARNING);
			}
		}
	}

	// Méthode magique
	public function __toString()
	{
		return "Pilote ".$this->getNameP()." qui habite ".$this->getAddress()." et dont le salaire est ".$this->getSalary();
	}

	// Les getters

	public function getNumP()
	{
		return $this->_NumP;
	}
	public function getNameP()
	{
		return $this->_NameP;
	}
	public function getAddress()
	{
		return $this->_Address;
	}
	public function getSalary()
	{
		return $this->_Salary;
	}

	// Les setters

	public function setNumP($NumP)
	{
		$NumP = (int) $NumP;
		// Si c'est pas un entier la convertion donne 0.
		// On suppose que l'Id d'un pilote ne peut pas être 0
		if ($NumP > 0)
		{
			$this->_NumP = $NumP;
		}
	}

	public function setNameP($NameP)
	{
		if (is_string($NameP))
		{
			$this->_NameP = $NameP;
		}
	}

	public function setAddress($Address)
	{
		if (is_string($Address))
		{
			$this->_Address = $Address;
		}
	}

	public function setSalary($Salary)
	{
		$Salary = (float) $Salary;
		if ($Salary >=1 && $Salary < 50000)
		{
			$this->_Salary = $Salary;
		}
	}

}

// Classe qui va gérer la manipulation des objets Pilotes et faire le lien avec la BDD

class PiloteManager
{
	// Objet type PDO
	private $_db;

	public function __construct($db)
	{
		$this->setDB($db);
	}

	// CRUD

	// Ajout d'un pilote
	public function add(Pilote $pilote)
	{
		$q = $this->_db->prepare('INSERT INTO PILOT(NumP, NameP, Address, Salary) VALUES(:NumP, :NameP, :Address, :Salary)');	
		$q->bindValue(':NumP', $pilote->getNumP());
		$q->bindValue(':NameP', $pilote->getNameP());
		$q->bindValue(':Address', $pilote->getAddress());
		$q->bindValue(':Salary', $pilote->getSalary());
		$q->execute();

	}

	// Supression d'un pilote
	public function delete(Pilote $pilote)
	{
		$this->_db->exec('DELETE FROM PILOT WHERE NumP = '.$pilote->getNumP());
	}

	// Modification d'un pilote
	public function update(Pilote $pilote)
	{
		$q = $this->_db->prepare('UPDATE PILOT 
			SET NameP = :NameP,
			Address = :Address,
			Salary = :Salary
			WHERE NumP = :NumP');
		$q->bindValue(':NameP', $pilote->getNameP(), PDO::PARAM_STR);
		$q->bindValue(':Address', $pilote->getAddress(), PDO::PARAM_STR);
		$q->bindValue(':Salary', $pilote->getSalary(), PDO::PARAM_STR);
		$q->bindValue(':NumP', $pilote->getNumP(), PDO::PARAM_INT);
		$q->execute();
	}

	// Retourn un objet de type pilote en fonction de l'identifiant passé en paramètre
	public function get($NumP)
	{
		$NumP = (int) $NumP;
		$q = $this->_db->query('SELECT NumP, NameP, Address, Salary FROM PILOT Where NumP = '.$NumP);
		$donnees = $q->fetch(PDO::FETCH_ASSOC);
		// On retourne un objet de type Pilote
		return new Pilote($donnees);
	}	

	// Autres méthodes 

	// Liste de pilotes
	public function getList()
	{
		// Retourne tous les pilotes 
		$pilotes = [];
		$q = $this->_db->query('SELECT NumP, NameP, Address, Salary FROM PILOT ORDER BY NameP');
		while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			$pilotes[] = new Pilote($donnees);
		}
		return $pilotes;
	}

	// On fixe la BDD
	public function setDb(PDO $db)
	{
		$this->_db = $db;
	}

}

// Programme principal

// On va créer un objet de type Pilote en passant un tableau en paramètre
$piloteSuper = new Pilote([
	'NumP' => 1900000,
	'NameP' => 'Nathan Zoless',
	'Address' => 'Rue az Hillay TREFFORT 11000 Carcassonne',
	'Salary' => 4299.50]);


//echo $piloteSuper;
try {
	$db = new PDO('mysql:host=127.0.0.1:3306;dbname=AirBase','root','root');
} 
catch (PDOException $e) {
	echo "Erreur : ".$e->getMessage();
	die();
}

// On va créer un objet de type manager pour gérer les pilotes avec la BDD
$manager = new PiloteManager($db);


$piloteBob = new Pilote([
	'NumP' => 2000,
	'NameP' => 'Bobnonnononno t Dead',
	'Address' => 'cc cv cvv',
	'Salary' => 2010.20]);

//$manager->add($piloteBob);
$objPilot = $manager->get(1298);

//echo $objPilot->getNameP();

// On récupère la liste des pilotes et on met les résultats dans un tableau
$listePilotes = $manager->getList();

// On affiche en parcourant le tableau
foreach ($listePilotes as $unPilote) {
	echo $unPilote->getSalary();
	echo "<br/>";
}

public function piloteVille($Address)
	{
		$Address = (string) $Address;
		$data[];
		$q = $this->_db->query('SELECT Address FROM PILOT Where Address Like '.$Address);
		while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			$Address[] = new Pilote($donnees);
		}
		return $Address;
	}	

$manager->piloteVille();
?>