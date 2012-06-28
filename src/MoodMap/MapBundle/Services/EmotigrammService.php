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

        $testString = "Mit regulären Ausdrücken werden explizite Eingaben von Benutzern in Formularen auf ihre Korrektheit überprüft. Damit wird überprüft, ob die eingegebene Zeichenkette dem definierten Muster entspricht. Es wird nun ersichtlich, dass einzugebenden Felder innerhalb eines Formulares mit diesen Mustern versehen werden können. Somit wird nicht nur gewährleistet, dass die gewollten Informationen erhalten werden, es entspricht auch dem Sicherheitsaspekt, sich vor diversen Attacken zu schützen.";

        $sentences = preg_split("/\./", $testString);
        foreach($sentences as $sentence) {

            $words = preg_split("/\s/", $sentence);
            foreach($words as $word) {

                echo $word . "\n";
            }
        }

        return "EmotigrammService";
    }
}