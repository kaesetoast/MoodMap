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
     * returns if $c1 and $c2 matches or not.
     */
    public function colorMatch($c1, $c2)
    {
        // << and >> cast their operands to integer (when possible) before shifting and will always return an integer result.
        $c1dec = hexdec($c1);
        $c2dec = hexdec($c2);
        $bitMask = hexdec("0000FF");

        $b1 = $c1dec & $bitMask;
        $b2 = $c2dec & $bitMask;

        $g1 = ($c1dec >> 8) & $bitMask;
        $g2 = ($c2dec >> 8) & $bitMask;

        $r1 = ($c1dec >> 16) & $bitMask;
        $r2 = ($c2dec >> 16) & $bitMask;

        $varianceR = abs($r1 - $r2) / 255;
        $varianceG = abs($g1 - $g2) / 255;
        $varianceB = abs($b1 - $b2) / 255;

        // variance must be smaller than 20%
        return $varianceR < 0.2 && $varianceG < 0.2 && $varianceB < 0.2;
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

        $resColor /= $sentenceCount;
        // convert to hex, and left fill in "0"
        $hexValue = str_pad(dechex($resColor), 6, "0", STR_PAD_LEFT);

        return $hexValue;

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
            $color = $this->getWordColor(trim($word));

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
            if (preg_match("/(\w*" . $entity->getWord() . "\w*)/", $word)) {

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