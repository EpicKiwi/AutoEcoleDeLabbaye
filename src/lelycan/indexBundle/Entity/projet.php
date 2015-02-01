<?php

namespace lelycan\indexBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * projet
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="lelycan\indexBundle\Entity\projetRepository")
 */
class projet
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
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;
    
  /**
   * @ORM\OneToMany(targetEntity="lelycan\indexBundle\Entity\fichier", mappedBy="projet")
   */
  private $fichiers;
  
   /**
   * @ORM\OneToMany(targetEntity="lelycan\indexBundle\Entity\commentaire", mappedBy="projet")
   * @ORM\OrderBy({"date" = "DESC"})
   */
  private $commentaires;


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
     * @return projet
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
     * Set description
     *
     * @param string $description
     * @return projet
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
     * @return projet
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
     * Constructor
     */
    public function __construct()
    {
        $this->fichiers = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add fichiers
     *
     * @param \lelycan\indexBundle\Entity\fichier $fichiers
     * @return projet
     */
    public function addFichier(\lelycan\indexBundle\Entity\fichier $fichiers)
    {
        $this->fichiers[] = $fichiers;
    
        return $this;
    }

    /**
     * Remove fichiers
     *
     * @param \lelycan\indexBundle\Entity\fichier $fichiers
     */
    public function removeFichier(\lelycan\indexBundle\Entity\fichier $fichiers)
    {
        $this->fichiers->removeElement($fichiers);
    }

    /**
     * Get fichiers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFichiers()
    {
        return $this->fichiers;
    }

    /**
     * Add commentaires
     *
     * @param \lelycan\indexBundle\Entity\commentaire $commentaires
     * @return projet
     */
    public function addCommentaire(\lelycan\indexBundle\Entity\commentaire $commentaires)
    {
        $this->commentaires[] = $commentaires;
    
        return $this;
    }

    /**
     * Remove commentaires
     *
     * @param \lelycan\indexBundle\Entity\commentaire $commentaires
     */
    public function removeCommentaire(\lelycan\indexBundle\Entity\commentaire $commentaires)
    {
        $this->commentaires->removeElement($commentaires);
    }

    /**
     * Get commentaires
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }
}