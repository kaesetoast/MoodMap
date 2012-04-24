<?php

namespace MoodMap\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as FOSUser;

/**
 * MoodMap\UserBundle\Entity\User
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class User extends FOSUser
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var array $mapColors
     *
     * @ORM\Column(name="mapColors", type="array")
     */
    private $mapColors;


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
     * Set mapColors
     *
     * @param array $mapColors
     */
    public function setMapColors($mapColors)
    {
        $this->mapColors = $mapColors;
    }

    /**
     * Get mapColors
     *
     * @return array 
     */
    public function getMapColors()
    {
        return $this->mapColors;
    }
}