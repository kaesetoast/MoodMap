<?php
namespace MoodMap\MapBundle\Services;

use Symfony\Component\DependencyInjection\ContainerInterface;

class MapService
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function createImage()
    {
        $user = $this->container->get("security.context")->getToken()->getUser();
        $res = "";

        foreach ($user->getMapColors() as $color) {
            $res .= $color . " ";
        }

        return $res;
    }
}
