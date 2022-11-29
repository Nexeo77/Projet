<?php
abstract class Avion
{
	protected $demarrer=FALSE;
	protected $vitesse=0;
	protected $vitesseMax;
    protected $altitude=0;
    protected $altitudeMax;
    protected $trainAtterrissage=TRUE;

	// On oblige les classes filles à définir les méthodes abstracts
    abstract function demarrer();
    abstract function eteindre();
	abstract function decelerer($vitesse);
	abstract function accelerer($vitesse);
    abstract function perdreAltitude($altitude);
	abstract function monterAltitude($altitude);

    const VITESSE_MAX = 2000;
    const ALTITUDE_MAX = 40000

    public function __construct($vMax) 
	{
		$this->setVitesseMax($vMax);
	}

    // Les Méthodes 

    // Méthode de démarrage et d'arret de l'avion

	public function demarrer() 
	{
		$this->demarrer=TRUE;
	}

	public function eteindre() 
	{
		$this->demarrer=FALSE;
	}

	public function estDemarre() 
	{
		return $this->demarrer;
	}

	public function estEteint() 
	{
		return $this->$this->demarrer;
	}
	
    // Méthode de décollage et d'atterrissage de l'avion

    public function decoller()
    {
        if($this->demarrer=TRUE) && ($vitesse = 120);
        {
            $this->altitude=100;
        }
    }
    public function atterir()
    {
        if($this->demarrer=TRUE && $this->trainAtterrissage=TRUE);
        {
            $this->altitude=0;
            $this->vitesse=0;
        }
    }

    // Méthode de vitesse de l'avion
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
		if ($this->decoller() && $this->estDemarre()) 
		{
			$this->setVitesse($this->getVitesse()-$vitesse);
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

	public function getVitesseMax() 
	{
		return $this->vitesseMax;
	}


    // Méthode d'altitude de l'avion

    public function monterAltitude($altitude) 
	{
		if ( $this->estDemarre() ) 
		{
			$this->setAltitude($this->getAltitude() + $altitude);
		}
		else 
		{
			trigger_error('On ne peut monter ! Le moteur est à l\'arret !', E_USER_WARNING);
		}
	}

    public function perdreAltitude($altitude) 
	{
		if ($this->decoller() && $this->estDemarre()) 
		{
			$this->setAltitude($this->getAltitude()-$altitude);
		}
	}

    public function setAltitude($altitude)
    {
        if($this->decoller() && $altitude > $this->getAltitudeMax());
        {
            elseif ( $altitude > 0 )
		{
			$this->altitude = $altitude;
		}	
		else
		{
			$this->altitude = 0;
		}

        }
    }

    public function getAltitude()
    {
        return $this->altitude;
    }

    public function getAltitudeMax() 
	{
		return $this->altitudeMax;
	}

    // Méthode du Train d'atterrissage de l'avion

    public function sortirTrainAtterrissage()
    {
        $this->trainAtterisage = FALSE;
    }

    public function rentrerTrainAtterrissage()
    {
        if ($this->altitude > 300)
        $this->trainAtterisage = TRUE;
    }

	// On définit la méthode magique afin de pouvoir afficher les Véhicules
	// Ce toString sera à compléter dans les classes filles
	public function __toString()
	{
		$chaine = "Ceci est un véhicule <br/>";
		$chaine .= "---------------------- <br/>";
		return $chaine;
	}
}
$veh1 = new Avion(110);
$veh1->demarrer();
$veh1->accelerer(70);
$veh1->altitude(120);
echo $veh1;
?>