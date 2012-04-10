<?php

namespace MoodMap\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('MoodMapMainBundle:Default:index.html.twig', array('name' => "Test"));
    }
}
