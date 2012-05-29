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
        $mapColors = $user->getMapColors();

        $image = new \Imagick();
        $image->newimage(60, 360, new \ImagickPixel("transparent"));
        $draw = new \ImagickDraw();

        for ($i = 0; $i < count($mapColors); $i++) {
            // y-value of the top-left corner
            $y = $i * 60;

            $draw->setFillColor("#" . $mapColors[$i]);
            // TODO: incl. the last line of pixels?
            $draw->rectangle(0, $y, 56, $y + 56);
        }

        $image->drawimage($draw);
        $image->setImageFormat("png");

        return $image->writeImage("./images/map/users/" . $user->getId() . ".png");
    }
}
