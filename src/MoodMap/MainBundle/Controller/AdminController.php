<?php

namespace MoodMap\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class AdminController extends Controller
{
    
    public function dashboardAction()
    {
        return $this->render('MoodMapMainBundle:Admin:dashboard.html.twig');
    }
}
