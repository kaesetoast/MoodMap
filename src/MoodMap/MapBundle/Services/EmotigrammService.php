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

class EmotigrammService {

    private $em;
    private $entities;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function createEmotigramm() {
        $this->entities = $this->em->getRepository('MoodMapMapBundle:MoodWord')->findAll();

        $text = "Hallo Niels. Wie Gehts? Muh";

        $sentences = preg_split("/\.|\?|\!|;/", $text);
        foreach($sentences as $sentence) {

            $words = preg_split("/\s/", $sentence);
            foreach($words as $word) {

                echo $word . "\n";
            }
        }

        return true;
    }

    private function getColors($word) {
        foreach($this->entities as $entity) {
            if($entity->getWord() == $word) {
                return $entity->getColors();
            }
        }
    }
}