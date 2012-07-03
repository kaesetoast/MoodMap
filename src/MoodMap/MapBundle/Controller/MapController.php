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

        $em = $this->getDoctrine()->getEntityManager();
        $tag = $em->getRepository('MoodMapMapBundle:Tag')->findByName($keyword);
        $recommendations = $tag[0]->getRecommendations();

        $colorMatchTrue = array();
        $colorMatchFalse = array();

        $emotigramm_service = $this->get('emotigramm_service');

        foreach ($recommendations as $recommendation) {
            if ($emotigramm_service->colorMatch($color, $recommendation->getColor())) {
                $colorMatchTrue[] = $recommendation;
            } else {
                $colorMatchFalse[] = $recommendation;
            }
        }

        $recommendations = array_merge($colorMatchTrue, $colorMatchFalse);

        return $this->render('MoodMapMapBundle:Map:searchResultList.html.twig', array(
            'color' => $color,
            'keyword' => $keyword,
            'recommendations' => $recommendations,
        ));
    }

    public function showItemAction()
    {
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

    public function createEmotigrammAction()
    {
        // TODO: Debug
        $text = "Der Frühling ist Liebe. Das ist toll.";

        $emotigrammService = $this->get("emotigramm_service");

        $response = new Response(json_encode(array('color' => $emotigrammService->createEmotigramm($text))));
        $response->headers
            ->set("Content-Type", "application/json", "charset=utf-8");
        return $response;
    }
}
