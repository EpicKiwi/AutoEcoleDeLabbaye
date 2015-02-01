<?php

namespace Abbaye\IndexBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tarifs
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Abbaye\IndexBundle\Entity\TarifsRepository")
 */
class Tarifs
{  
	/**
	* @ORM\ManyToOne(targetEntity="Abbaye\IndexBundle\Entity\Agences",cascade={"persist"})
	* @ORM\JoinColumn(nullable=false)
	*/
	 private $agences;
	   
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="Contenu", type="text")
     */
    private $contenu;

    /**
     * @var float
     *
     * @ORM\Column(name="Prix", type="decimal")
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="text")
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date", type="date")
     */
    private $date;
	
	 /**
     * @var string
     *
     * @ORM\Column(name="Permalien", type="string", length=255)
     */
    private $permalien;

	public function __construct()
{
	$this->date = new \Datetime();
}

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Tarifs
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    
        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     * @return Tarifs
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    
        return $this;
    }

    /**
     * Get contenu
     *
     * @return string 
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set prix
     *
     * @param float $prix
     * @return Tarifs
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    
        return $this;
    }

    /**
     * Get prix
     *
     * @return float 
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Tarifs
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Tarifs
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set agence
     *
     * @param \Abbaye\IndexBundle\Entity\Agences $agence
     * @return Tarifs
     */
    public function setAgence(\Abbaye\IndexBundle\Entity\Agences $agence)
    {
        $this->agence = $agence;
    
        return $this;
    }

    /**
     * Get agence
     *
     * @return \Abbaye\IndexBundle\Entity\Agences 
     */
    public function getAgence()
    {
        return $this->agence;
    }

    /**
     * Set permalien
     *
     * @param string $permalien
     * @return Tarifs
     */
    public function setPermalien($permalien)
    {
        $this->permalien = $permalien;
    
        return $this;
    }

    /**
     * Get permalien
     *
     * @return string 
     */
    public function getPermalien()
    {
        return $this->permalien;
    }

    /**
     * Set agences
     *
     * @param \Abbaye\IndexBundle\Entity\Agences $agences
     * @return Tarifs
     */
    public function setAgences(\Abbaye\IndexBundle\Entity\Agences $agences)
    {
        $this->agences = $agences;
    
        return $this;
    }

    /**
     * Get agences
     *
     * @return \Abbaye\IndexBundle\Entity\Agences 
     */
    public function getAgences()
    {
        return $this->agences;
    }
	
	public function translateContenu()
	{
		$rendu = $this->contenu;
		while(preg_match('#(.+)\n(.+)#i', $rendu))
		{
			$rendu = preg_replace('#(.+)\n(.+)#i', '$1</li><li>$2', $rendu);
		}
		
		$rendu = "<li>".$rendu."</li>";
		
		$this->contenu = $rendu;
	
	}
	
	public function unTranslateContenu()
	{
		$rendu = $this->contenu;
		while(preg_match('#(.+)<li></li>(.+)#i', $rendu))
		{
			$rendu = preg_replace('#(.+)<li></li>(.+)#i', '$1\n$2', $rendu);
		}
		
		$rendu = preg_replace('#<li>(.+)</li>#i', '$1', $rendu);
		
		$this->contenu = $rendu;
	
	}
	
		public function translatePermalien()
	{
		$rendu = $this->nom;
		
		while(preg_match('#(.+) (.+)#i', $rendu))
		{
			$rendu = preg_replace('#(.+) (.+)#i', '$1-$2', $rendu);
		}
		
		while(preg_match('#(.+)[ÈÉÊËèéêë](.+)#i', $rendu))
		{
			$rendu = preg_replace('#(.+)[ÈÉÊËèéêë](.+)#i', '$1e$2', $rendu);
		}

		while(preg_match('#(.+)[ÀÁÂÃÄÅàáâãäå](.+)#i', $rendu))
		{
			$rendu = preg_replace('#(.+)[ÀÁÂÃÄÅàáâãäå](.+)#i', '$1a$2', $rendu);
		}
		
		while(preg_match('#(.+)[ÒÓÔÕÖØòóôõöø](.+)#i', $rendu))
		{
			$rendu = preg_replace('#(.+)[ÒÓÔÕÖØòóôõöø](.+)#i', '$1o$2', $rendu);
		}
		
		while(preg_match('#(.+)[Çç](.+)#i', $rendu))
		{
			$rendu = preg_replace('#(.+)[Çç](.+)#i', '$1c$2', $rendu);
		}
		
		while(preg_match('#(.+)[ÌÍÎÏìíîï](.+)#i', $rendu))
		{
			$rendu = preg_replace('#(.+)[ÌÍÎÏìíîï](.+)#i', '$1i$2', $rendu);
		}
		
		while(preg_match('#(.+)[ÙÚÛÜùúûü](.+)#i', $rendu))
		{
			$rendu = preg_replace('#(.+)[ÙÚÛÜùúûü](.+)#i', '$1u$2', $rendu);
		}
		
		while(preg_match('#(.+)[ÿ](.+)#i', $rendu))
		{
			$rendu = preg_replace('#(.+)[ÿ](.+)#i', '$1y$2', $rendu);
		}

		while(preg_match('#(.+)[Ññ](.+)#i', $rendu))
		{
			$rendu = preg_replace('#(.+)[Ññ](.+)#i', '$1n$2', $rendu);
		}
		
		while(preg_match('#(.+)\'(.+)#i', $rendu))
		{
			$rendu = preg_replace('#(.+)\'(.+)#i', '$1-$2', $rendu);
		}
		
		while(preg_match('#(.+)°(.+)#i', $rendu))
		{
			$rendu = preg_replace('#(.+)°(.+)#i', '$1-$2', $rendu);
		}
		
		$this->permalien = $rendu;
	
	}
}