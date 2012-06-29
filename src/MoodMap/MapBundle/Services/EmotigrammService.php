<?php
/**
 * Created by JetBrains PhpStorm.
 * User: nielsgarve
 * Date: 21.06.12
 * Time: 13:35
 * To change this template use File | Settings | File Templates.
 */

namespace MoodMap\MapBundle\Services;

class EmotigrammService {
    public function createEmotigramm() {
        $emotigramm = array();
        $text = "Hallo Niels. Wie Gehts?";

        $sentences = preg_split("/\./", $text);
        foreach($sentences as $sentence) {

            $words = preg_split("/\s/", $sentence);
            foreach($words as $word) {

                echo $word . "\n";
            }
        }

        return true;
    }
}