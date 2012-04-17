<?php

namespace MoodMap\MapBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction($name)
    {
        return $this->render('MoodMapMapBundle:Default:index.html.twig', array('name' => $name));
    }
}
