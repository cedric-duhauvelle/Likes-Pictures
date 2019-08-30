<?php

namespace Controller;

use Model\Router;
use Manager\UserManager;

class PageController
{
	public function __construct($db, $page)
	{
		$this->page($db, $page);
	}

	public function page($db, $page)
	{
		require_once '../View/Template/header.php';

		$this->callClass($db, $page);

		require_once '../View/Template/footer.php';
	}

	public function callClass($db, $page)
	{
		if ('profil' === $page) {
			$userManager = new UserManager($db);

		} elseif ('accueil' === $page) {

		} elseif ('galerie' === $page) {

		}

		require_once '../View/' . $page . '.php';
	}
}