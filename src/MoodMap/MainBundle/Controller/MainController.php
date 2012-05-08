<?php

namespace MoodMap\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class MainController extends Controller {

    public function getModalContentAction($key) {
        $response = $this->get("modal_service")->getModalContent($key);
        return $response;
    }

}
