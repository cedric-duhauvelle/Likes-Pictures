<?php

namespace Controller;

use Model\Router;
use Manager\UserManager;
use Manager\PictureManager;

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
			$user = $userManager->getUser($_SESSION['id']);
		} elseif ('accueil' === $page) {

		} elseif ('galerie' === $page) {
			$pictureManager = new PictureManager($db);
			$pictures = $pictureManager->getPictures();
		}

		require_once '../View/' . $page . '.php';
	}
}