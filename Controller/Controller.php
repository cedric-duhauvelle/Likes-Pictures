<?php

namespace Controller;

use Controller\ConnexionController;
use Controller\DeconnexionController;
use Controller\InscriptionController;
use Controller\PictureController;

/**
 * Gere les controllers
 */
class Controller
{
    public function __construct($page)
	{
		$this->callController($page);
	}

	//Appel controller
	public function callController($page)
	{
        $class = 'Controller\\' . $page;
        new $class();
	}
}