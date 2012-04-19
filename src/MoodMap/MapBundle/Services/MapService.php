<?php
namespace MoodMap\MapBundle\Services;
class MapService {

	public $name;

	public function __construct() {
		$this->name = "Hello";
	}

	public function createImage() {
		return $this->name;
	}
}
