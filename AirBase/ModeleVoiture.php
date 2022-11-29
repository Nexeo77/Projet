<?php

// Classe qui gère la fabrication d'un objet Modele Voiture
class ModeleVoiture
{
	// Atrributs d'un Modele de Voiture
	private $_idMod;
	private $_nameMod;
	private $_carrosserie;
	private $_volumeCoffre;

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
		return "ID voiture ".$this->getidMod()." Nom du modele ".$this->getnameMod()." et dont le volume du coffre est ".$this->getvolumeCoffre();
	}

	// Les getters

	public function getidMod()
	{
		return $this->_idMod;
	}
	public function getnameMod()
	{
		return $this->_nameMod;
	}
	public function getcarrosserie()
	{
		return $this->_carrosserie;
	}
	public function getvolumeCoffre()
	{
		return $this->_volumeCoffre;
	}

	// Les setters

	public function setidMod($idMod)
	{
		$idMod = (int) $idMod;
		if ($idMod > 0)
		{
			$this->_idMod = $idMod;
		}
	}

	public function setnameMod($nameMod)
	{
		if (is_string($nameMod))
		{
			$this->_nameMod = $nameMod;
		}
	}

	public function setcarrosserie($carrosserie)
	{
		if (is_string($carrosserie))
		{
			$this->_carrosserie = $carrosserie;
		}
	}
// Les dimensions du coffre de la voiture sont en litres
	public function setvolumeCoffre($volumeCoffre)
	{
		$volumeCoffre = (float) $volumeCoffre;
		if ($volumeCoffre >=211 && $volumeCoffre < 355)
		{
			$this->volumeCoffre = $volumeCoffre;
		}
	}

}

// Classe qui va gérer la manipulation des objets Modele Voiture et faire le lien avec la BDD

class ManagerModeleVoiture
{
	// Objet type PDO
	private $_db;

	public function __construct($db)
	{
		$this->setDB($db);
	}

	// CRUD

	// Ajout d'un Modele de voiture
	public function add(ModeleVoiture $modVoiture)
	{
		$q = $this->_db->prepare('INSERT INTO MODVOITURE(idMod, nameMod, carrosserie, volumeCoffre) VALUES(:idMod, :nameMod, :carrosserie, :volumeCoffre)');	
		$q->bindValue(':idMod', $modVoiture->getidMod());
		$q->bindValue(':nameMod', $modVoiture->getnameMod());
		$q->bindValue(':carrosserie', $modVoiture->getcarrosserie());
		$q->bindValue(':volumeCoffre', $modVoiture->getvolumeCoffre());
		$q->execute();

	}

	// Supression d'un Modele de Voiture
	public function delete(ModeleVoiture $modVoiture)
	{
		$this->_db->exec('DELETE FROM MODVOITURE WHERE idMod = '.$modVoiture->getidMod());
	}

	// Modification d'un Modele de Voiture
	public function update(ModeleVoiture $modVoiture)
	{
		$q = $this->_db->prepare('UPDATE MODVOITURE 
			SET nameMod = :nameMod,
			carrosserie = :carrosserie,
			volumeCoffre = :volumeCoffre
			WHERE idMod = :idMod');
		$q->bindValue(':nameMod', $modVoiture->getnameMod(), PDO::PARAM_STR);
		$q->bindValue(':carrosserie', $modVoiture->getcarrosserie(), PDO::PARAM_STR);
		$q->bindValue(':volumeCoffre', $modVoiture->getvolumeCoffre(), PDO::PARAM_STR);
		$q->bindValue(':idMod', $modVoiture->getidMod(), PDO::PARAM_INT);
		$q->execute();
	}
}
?>