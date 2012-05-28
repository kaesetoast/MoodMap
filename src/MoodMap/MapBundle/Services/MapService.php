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

        $image = new \Imagick();
        $image->newimage(60, 360, new \ImagickPixel("transparent"));
        $draw = new \ImagickDraw();

        $draw->setFillColor("#FF0000");
        $draw->rectangle(10, 10, 50, 50);

        foreach ($user->getMapColors() as $color) {
            // TODO
        }

        $image->drawimage($draw);
        $image->setImageFormat("png");

        return $image->writeImage("./images/map/map-background.png");
    }
}
