<?php

namespace MoodMap\MapBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MoodMap\MapBundle\Entity\MoodWord
 *
 * @ORM\Table()
 * @ORM\Entity
 *
 * @author Philipp Nowinski <pn@mood-map.com>
 */
class MoodWord
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
     * @var string $word
     *
     * @ORM\Column(name="word", type="string", length=255)
     */
    private $word;

    /**
     * @var array $colors
     *
     * @ORM\Column(name="colors", type="array")
     */
    private $colors;


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
     * Set word
     *
     * @param string $word
     */
    public function setWord($word)
    {
        $this->word = $word;
    }

    /**
     * Get word
     *
     * @return string 
     */
    public function getWord()
    {
        return $this->word;
    }

    /**
     * Set colors
     *
     * @param array $colors
     */
    public function setColors($colors)
    {
        $this->colors = $colors;
    }

    /**
     * Get colors
     *
     * @return array 
     */
    public function getColors()
    {
        return $this->colors;
    }
}