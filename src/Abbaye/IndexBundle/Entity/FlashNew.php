<?php

namespace Abbaye\IndexBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FlashNew
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Abbaye\IndexBundle\Entity\FlashNewRepository")
 */
class FlashNew
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
     * @ORM\Column(name="Contenu", type="text")
     */
    private $contenu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date", type="datetime")
     */
    private $date;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Important", type="boolean")
     */
    private $important;


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
     * Set contenu
     *
     * @param string $contenu
     * @return FlashNew
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
     * Set date
     *
     * @param \DateTime $date
     * @return FlashNew
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
     * Set important
     *
     * @param boolean $important
     * @return FlashNew
     */
    public function setImportant($important)
    {
        $this->important = $important;
    
        return $this;
    }

    /**
     * Get important
     *
     * @return boolean 
     */
    public function getImportant()
    {
        return $this->important;
    }
}
