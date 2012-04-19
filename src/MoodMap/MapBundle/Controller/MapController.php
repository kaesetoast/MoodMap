<?php

namespace MoodMap\MapBundle\Controller;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MapController extends Controller {

	public function indexAction() {
		return $this->render('MoodMapMapBundle:Map:index.html.twig');
	}

	public function searchAction($color, $keyword) {
		$response = new Response(json_encode($this));

		$response->headers
				->set("Content-Type", "application/json", "charset=utf-8");

		return $response;
	}
	
	public function createMapAction () {
		$response = new Response(json_encode($this));
		
		$response->headers
		->set("Content-Type", "application/json", "charset=utf-8");
		
		return $response;
	}
}
