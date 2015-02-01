<?php

namespace Abbaye\IndexBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Agences
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Abbaye\IndexBundle\Entity\AgencesRepository")
 */
class Agences
{
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
     * @var \DateTime
     *
     * @ORM\Column(name="Date", type="date")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="Tel", type="string", length=255)
     */
    private $tel;

    /**
     * @var string
     *
     * @ORM\Column(name="Fax", type="string", length=255)
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="Adresse", type="text", nullable=true)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="Email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="Permalien", type="string", length=255, unique=true)
     */
    private $permalien;

    /**
     * @var string
     *
     * @ORM\Column(name="Logo", type="string", length=255)
	 * @ORM\JoinColumn(nullable=false)
     */
    private $logo;    
	
	/**
     * @ORM\Column(name="Defaut", type="boolean")
     */
    private $defaut;
	
	/**
	* @ORM\OneToMany(targetEntity="Abbaye\IndexBundle\Entity\Tarifs", mappedBy="agences",cascade={"persist"})
	*/
	private $tarifs;
	
	private $file;
	
	public function __construct()
	{
		$this->date = new \Datetime();
		$this->defaut = false;
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
     * @return Agences
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
     * Set date
     *
     * @param \DateTime $date
     * @return Agences
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
     * Set description
     *
     * @param string $description
     * @return Agences
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
     * Set tel
     *
     * @param string $tel
     * @return Agences
     */
    public function setTel($tel)
    {
        $this->tel = $tel;
    
        return $this;
    }

    /**
     * Get tel
     *
     * @return string 
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set fax
     *
     * @param string $fax
     * @return Agences
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
    
        return $this;
    }

    /**
     * Get fax
     *
     * @return string 
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     * @return Agences
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    
        return $this;
    }

    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Agences
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set permalien
     *
     * @param string $permalien
     * @return Agences
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
     * Set logo
     *
     * @param string $logo
     * @return Agences
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    
        return $this;
    }

    /**
     * Get logo
     *
     * @return string 
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set defaut
     *
     * @param boolean $defaut
     * @return Agences
     */
    public function setDefaut($defaut)
    {
        $this->defaut = $defaut;
    
        return $this;
    }

    /**
     * Get defaut
     *
     * @return boolean 
     */
    public function getDefaut()
    {
        return $this->defaut;
    }

    /**
     * Add tarifs
     *
     * @param \Abbaye\IndexBundle\Entity\Tarifs $tarifs
     * @return Agences
     */
    public function addTarif(\Abbaye\IndexBundle\Entity\Tarifs $tarifs)
    {
        $this->tarifs[] = $tarifs;
    
        return $this;
    }

    /**
     * Remove tarifs
     *
     * @param \Abbaye\IndexBundle\Entity\Tarifs $tarifs
     */
    public function removeTarif(\Abbaye\IndexBundle\Entity\Tarifs $tarifs)
    {
        $this->tarifs->removeElement($tarifs);
    }

    /**
     * Get tarifs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTarifs()
    {
        return $this->tarifs;
    }
	
    public function setFile($file)
    {
        $this->file = $file;
    
        return $this;
    }

    public function getFile()
    {
        return $this->file;
    }
	
	  public function upload()
  {
    // Si jamais il n'y a pas de fichier (champ facultatif)
    if (null === $this->file) {
      return;
    }
 
    // On garde le nom original du fichier de l'internaute
    $name = $this->file->getClientOriginalName();
 
    // On déplace le fichier envoyé dans le répertoire de notre choix
    $this->file->move($this->getUploadRootDir(), $name);
 
    // On sauvegarde le nom de fichier dans notre attribut $url
    $this->logo = $this->getUploadDir().'/'.$name;
  }
 
  public function getUploadDir()
  {
    // On retourne le chemin relatif vers l'image pour un navigateur
    return 'uploads/img';
  }
 
  protected function getUploadRootDir()
  {
    // On retourne le chemin relatif vers l'image pour notre code PHP
    return __DIR__.'/../../../../web/'.$this->getUploadDir();
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