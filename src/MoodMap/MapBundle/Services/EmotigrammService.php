<?php
/**
 * Created by JetBrains PhpStorm.
 * User: nielsgarve
 * Date: 21.06.12
 * Time: 13:35
 * To change this template use File | Settings | File Templates.
 */

namespace MoodMap\MapBundle\Services;

use Doctrine\ORM\EntityManager;

class EmotigrammService
{

    private $em;
    private $entities;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /*
     * returns the color (as hex) for $text. Else null
     */
    public function createEmotigramm($text)
    {
        $this->entities = $this->em->getRepository('MoodMapMapBundle:MoodWord')->findAll();

        $resColor = 0;
        $sentences = preg_split("/\.|\?|\!|;/", $text);
        $sentenceCount = 0;
        foreach ($sentences as $sentence) {
            $color = $this->getSentenceColor(trim($sentence));

            if ($color != null) {
                // colors are 24-bit numbers, so check for overflow
                if ($resColor + $color >= PHP_INT_MAX)
                    break;

                // no overflow, so
                $resColor += $color;
                $sentenceCount++;
            }
        }

        // no color found
        if ($sentenceCount == 0)
            return null;

        return dechex($resColor / $sentenceCount);

    }

    /*
     * returns the color (as dec) for $sentence. Else: null
     */
    private function getSentenceColor($sentence)
    {
        $resColor = 0;
        $words = preg_split("/\s/", $sentence);
        $wordCount = 0;
        foreach ($words as $word) {
            $color = $this->getWordColor($word);

            if ($color != null) {
                // colors are 24-bit numbers, so check for overflow
                if ($resColor + $color >= PHP_INT_MAX)
                    break;

                // no overflow, so
                $resColor += $color;
                $wordCount++;
            }
        }

        // no color found
        if ($wordCount == 0)
            return null;

        return $resColor / $wordCount;
    }

    /*
     * returns the color (as dec) for $word found in MoodWord-DB. Else: null
     */
    private function getWordColor($word)
    {
        $resColor = 0;

        foreach ($this->entities as $entity) {
            if ($entity->getWord() == $word) {

                // TODO: Does an entity have colors when there is a word? yes?
                $colors = $entity->getColors();

                foreach ($colors as $color) {
                    // colors are 24-bit numbers, so check for overflow
                    if ($resColor + hexdec($color) >= PHP_INT_MAX)
                        break;

                    // no overflow, so
                    $resColor += hexdec($color);
                }

                // TODO: if consistent, count($colors) is never 0
                return $resColor / count($colors);
            }
        }

        // no word found
        return null;
    }
}