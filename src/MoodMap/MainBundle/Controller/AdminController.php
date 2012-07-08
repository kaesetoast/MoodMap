<?php

namespace MoodMap\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * AdminController
 *
 * This controller is the entry-point for the admin area.
 * 
 * @author Philipp Nowinski <pn@mood-map.com>
 */
class AdminController extends Controller
{
    
    public function dashboardAction()
    {
        return $this->render('MoodMapMainBundle:Admin:dashboard.html.twig');
    }
}
