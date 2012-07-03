<?php

namespace MoodMap\MapBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MoodMap\MapBundle\Entity\Tag
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Tag
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="Recommendation", mappedBy="tags")
     */
    private $recommendations;


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
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    public function __construct()
    {
        $this->recommendations = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add recommendations
     *
     * @param MoodMap\MapBundle\Entity\Recommendation $recommendations
     */
    public function addRecommendation(\MoodMap\MapBundle\Entity\Recommendation $recommendations)
    {
        $this->recommendations[] = $recommendations;
    }

    /**
     * Get recommendations
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getRecommendations()
    {
        return $this->recommendations;
    }

    public function __toString() {
        return $this->getName();
    }
}