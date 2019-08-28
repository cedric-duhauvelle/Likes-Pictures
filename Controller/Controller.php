<?php

namespace Controller;

use Controller\ConnexionController;
use Controller\DeconnexionController;
use Controller\InscriptionController;
use Controller\PictureController;

class Controller
{
    public function __construct($page, $db)
	{
		$this->callController($page, $db);
	}

	//Appel controller
	public function callController($page, $db)
	{
        $class = 'Controller\\' . $page;
        if ('DeconnexionController' === $page) {
			return new $class();
		}
        var_dump($class);
        new $class($db);



	}
}