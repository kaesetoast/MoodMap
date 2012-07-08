<?php

namespace MoodMap\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as FOSUser;

/**
 * MoodMap\UserBundle\Entity\User
 *
 * @ORM\Table()
 * @ORM\Entity
 *
 * @author Niels Garve <ng@mood-map.com>
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
    private $mapColors = array("990033", "FF0033", "FF6600", "FFCC33", "99CC33", "0066FF");


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