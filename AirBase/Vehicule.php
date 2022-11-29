<?php
abstract class Vehicule 
{
	protected $demarrer=FALSE;
	protected $vitesse=0;
	protected $vitesseMax;
    protected $freinaMain=FALSE;

	// On oblige les classes filles à définir les méthodes abstracts
	abstract function demarrer();
	abstract function eteindre();
	abstract function decelerer($vitesse);
	abstract function accelerer($vitesse);

	// On définit la méthode magique afin de pouvoir afficher les Véhicules
	// Ce toString sera à compléter dans les classes filles
	public function __toString()
	{
		$chaine = "Ceci est un véhicule <br/>";
		$chaine .= "---------------------- <br/>";
		return $chaine;
	}
}

class Voiture extends Vehicule 
{
	const VITESSE_MAX = 360;
	private static $_compteur = 0;

	public static function getNombreVoiture()
	{
		return self::$_compteur;
	}

	public function __construct($vMax) 
	{
		$this->setVitesseMax($vMax);
		self::$_compteur++;
	}

	public function demarrer() 
	{
		$this->demarrer=TRUE;
	}

	public function eteindre() 
	{
		if ($this->demarrer=FALSE)
        {
            $this->estStationner();
        }
        else
        {
            $chaine .= "La voiture continue de rouler ! <br/>";
        }
	}

	public function estDemarre() 
	{
		return $this->demarrer;
	}


	public function accelerer($vitesse) 
	{
		if ( $this->estDemarre() ) 
		{
			$this->setVitesse($this->getVitesse() + $vitesse);
		}
		else 
		{
			trigger_error('On ne peut accelerer ! Le moteur est à l\'arret !', E_USER_WARNING);
		}
	}

	public function decelerer($vitesse) 
	{
		if ( $this->estDemarre() ) 
		{
			$this->setVitesse($this->getVitesse()-$vitesse);
		}
	}

	public function setVitesseMax($vMax) 
	{

		if ( $vMax > self::VITESSE_MAX) 
		{
			$this->vitesseMax = self::VITESSE_MAX;
		}
		elseif ( $vMax > 0 )
		{
			$this->vitesseMax = $vMax;
		}	
		else
		{
			$this->vitesseMax = 0;
		}	
	}

	public function setVitesse($vitesse) 
	{

		if ( $vitesse > $this->getVitesseMax()) 
		{
			$this->vitesse = $this->getVitesseMax();
		}
		elseif ( $vitesse > 0 )
		{
			$this->vitesse = $vitesse;
		}	
		else
		{
			$this->vitesse = 0;
		}	
	}

	public function getVitesse() 
	{
		return $this->vitesse;
	}

	public function getVitesseMax() 
	{
		return $this->vitesseMax;
	}

	public function __toString()
	{
		$chaine = parent::__toString();
		$chaine .= "La voiture a une vitesse maximale de ".$this->vitesseMax." km/h <br/>";
		if ( $this->demarrer )
		{
			$chaine .= "Elle est démarrée <br/>";
			$chaine .= "Sa vitesse est actuellement de ".$this->getVitesse(). "km/h <br/>";
		}
		else
		{
			$chaine .= "Elle est arretée <br/>";
		}
		return $chaine;
	}

    public function estStationner()
    {
        $freinaMain=TRUE
        $this->accelerer($vitesse) = FALSE;
        $chaine .= "Le frein a main est enclenché ! La voiture est à l'arret !<br/>!";
    }
}

$veh1 = new Voiture(110);
$veh1->demarrer();
$veh1->accelerer(40);
$veh1->estStationner();
echo $veh1;
$veh1->accelerer(40);
echo $veh1;
$veh1->accelerer(12);
$veh1->accelerer(40);
echo $veh1;
$veh1->accelerer(40);
$veh1->decelerer(120);
echo $veh1;
$veh2 = new Voiture(180);
echo $veh2;

echo "########################### <br/>";
echo "Nombre de voiture instancier :".Voiture::getNombreVoiture()."<br/>";

?>