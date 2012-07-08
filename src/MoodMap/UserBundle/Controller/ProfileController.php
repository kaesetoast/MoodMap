<?php

namespace MoodMap\UserBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\HttpFoundation\Response;

use FOS\UserBundle\Controller\ProfileController as BaseController;

/**
 * Controller managing the user profile
 *
 * @author Niels Garve <ng@mood-map.com>
 */
class ProfileController extends BaseController
{
    public function updateMapColorsAction()
    {
        $request = $this->container->get('request')->request;
        $em = $this->container->get('doctrine')->getEntityManager();
        $user = $this->container->get('security.context')->getToken()->getUser();
        $user->setMapColors($request->get("mapcolors"));
        $em->persist($user);
        $em->flush();

        $mapService = $this->container->get("map_service");

        $response = new Response(json_encode(array('success' => $mapService->createImage())));
        $response->headers
            ->set("Content-Type", "application/json", "charset=utf-8");
        return $response;
    }

    public function getMapColorsAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        $response = new Response(json_encode($user->getMapColors()));
        $response->headers
            ->set("Content-Type", "application/json", "charset=utf-8");
        return $response;
    }
}
