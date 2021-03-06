<?php

namespace lelycan\indexBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * fichier
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="lelycan\indexBundle\Entity\fichierRepository")
 */
class fichier
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;
    
    /**
     *@ORM\ManyToOne(targetEntity="lelycan\indexBundle\Entity\projet")
     *@ORM\JoinColumn(nullable=false)
     */
    private $projet;
    
      /**
   * @ORM\OneToMany(targetEntity="lelycan\indexBundle\Entity\upload", mappedBy="fichier")
   * @ORM\OrderBy({"date" = "DESC"})
   */
  private $uploads;


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
     * @return fichier
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
     * Set type
     *
     * @param string $type
     * @return fichier
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return fichier
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
     * Set projet
     *
     * @param \lelycan\indexBundle\Entity\projet $projet
     * @return fichier
     */
    public function setProjet(\lelycan\indexBundle\Entity\projet $projet)
    {
        $this->projet = $projet;
    
        return $this;
    }

    /**
     * Get projet
     *
     * @return \lelycan\indexBundle\Entity\projet 
     */
    public function getProjet()
    {
        return $this->projet;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->uploads = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add uploads
     *
     * @param \lelycan\indexBundle\Entity\upload $uploads
     * @return fichier
     */
    public function addUpload(\lelycan\indexBundle\Entity\upload $uploads)
    {
        $this->uploads[] = $uploads;
    
        return $this;
    }

    /**
     * Remove uploads
     *
     * @param \lelycan\indexBundle\Entity\upload $uploads
     */
    public function removeUpload(\lelycan\indexBundle\Entity\upload $uploads)
    {
        $this->uploads->removeElement($uploads);
    }

    /**
     * Get uploads
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUploads()
    {
        return $this->uploads;
    }
}