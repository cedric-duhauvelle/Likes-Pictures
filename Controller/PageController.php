<?php

namespace Controller;

use Systeme\Router;
use Manager\UserManager;
use Manager\PictureManager;
use Manager\CommentManager;
use Manager\LikeManager;

class PageController
{
	public function __construct($page)
	{
		$this->page($page);
	}

	public function page($page)
	{
		require_once '../View/Template/header.php';

		$this->callClass($page);

		require_once '../View/Template/footer.php';
	}

	public function callClass( $page)
	{
		if ('profil' === $page) {
			$userManager = new UserManager();
			$pictureManager = new PictureManager();
			$user = $userManager->getUserById($_SESSION['id']);
			$pictures = $pictureManager->getPicturesUser($_SESSION['id']);

		} elseif ('accueil' === $page) {
			$pictureManager = new PictureManager();
			$pictures = $pictureManager->getLastPictures();
			$commentManager = new CommentManager();
			$likeManager = new LikeManager();

		} elseif ('galerie' === $page) {
			$pictureManager = new PictureManager();
			$pictures = $pictureManager->getPictures();
		}

		require_once '../View/' . $page . '.php';
	}
}