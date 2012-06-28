<?php

namespace MoodMap\MapBundle\Controller;
use MoodMap\MapBundle\Services\MapService;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MapController extends Controller
{

    public function indexAction()
    {
        return $this->render('MoodMapMapBundle:Map:index.html.twig');
    }

    public function searchAction($color, $keyword)
    {
        $testString = "Mit regulären Ausdrücken werden explizite Eingaben von Benutzern in Formularen auf ihre Korrektheit überprüft. Damit wird überprüft, ob die eingegebene Zeichenkette dem definierten Muster entspricht. Es wird nun ersichtlich, dass einzugebenden Felder innerhalb eines Formulares mit diesen Mustern versehen werden können. Somit wird nicht nur gewährleistet, dass die gewollten Informationen erhalten werden, es entspricht auch dem Sicherheitsaspekt, sich vor diversen Attacken zu schützen.";
        $emotigrammService = $this->get("emotigramm_service");
        $emotigrammColor = $emotigrammService->createEmotigramm($testString);

        return $this->render('MoodMapMapBundle:Map:searchResultList.html.twig', array(
            'color' => $color,
            'keyword' => $keyword,
            'emotigramm_color' => $emotigrammColor
        ));
    }

    public function showItemAction() {
        return $this->render('MoodMapMapBundle:Map:showItem.html.twig');
    }

    public function createMapAction()
    {
        $mapService = $this->get("map_service");

        $response = new Response(json_encode(array('success' => $mapService->createImage())));
        $response->headers
            ->set("Content-Type", "application/json", "charset=utf-8");
        return $response;
    }
}
