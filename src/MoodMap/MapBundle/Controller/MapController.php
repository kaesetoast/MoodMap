<?php

namespace MoodMap\MapBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MapController extends Controller {

	public function indexAction() {
		return $this->render('MoodMapMapBundle:Map:index.html.twig');
	}
	
}
