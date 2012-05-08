<?php
namespace MoodMap\MainBundle\Services;

use Symfony\Component\DependencyInjection\ContainerInterface;

class ModalService {
	const PATH = "/MoodMap/src/MoodMap/MainBundle/Resources/views/Util/ModalContents";
	const LOGIN_MODAL_CONTENT = "login_modal_content.html.twig";
	
	private $container;
	
	public function __construct(ContainerInterface $container) {
		$this->container = $container;
	}
	
	public function getModalContent($key) {
		$twigService = $this->container->get("twig");

		print_r($twigService);
	}
}