<?php

namespace lelycan\indexBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * upload
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="lelycan\indexBundle\Entity\uploadRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class upload
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     *@ORM\JoinColumn(nullable=true)
     */
    private $nom;
    
    /**
     *@ORM\ManyToOne(targetEntity="lelycan\indexBundle\Entity\fichier")
     *@ORM\JoinColumn(nullable=false)
     */
    private $fichier;
    
    private $file;

    public function __construct() {
        $date = new \DateTime;
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
     * Set date
     *
     * @param \DateTime $date
     * @return upload
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
     * @return upload
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
     * Set nom
     *
     * @param string $nom
     * @return upload
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
     * Set fichier
     *
     * @param \lelycan\indexBundle\Entity\fichier $fichier
     * @return upload
     */
    public function setFichier(\lelycan\indexBundle\Entity\fichier $fichier)
    {
        $this->fichier = $fichier;
    
        return $this;
    }

    /**
     * Get fichier
     *
     * @return \lelycan\indexBundle\Entity\fichier 
     */
    public function getFichier()
    {
        return $this->fichier;
    }
    
        public function setFile($file)
    {
        $this->file = $file;
    
        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getFile()
    {
        return $this->file;
    }
    
    /**
     * @ORM\PrePersist
     */
    public function upload()
    {
        $originalName = $this->file->getClientOriginalName();
        date_default_timezone_set('Europe/Paris');
        $date = date("d-m-Y-H-i-s");
        $name = $date."-".$originalName;
        $this->file->move($this->getUploadRootDir(),$name);
        $this->nom = $name;
    }
    
    public function getUploadDir()
    {
        return'uploads';
    }
    
    public function getUploadRootDir()
    {
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }
}