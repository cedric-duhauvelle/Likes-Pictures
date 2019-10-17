<?php

namespace Controller;

use Manager\UserManager;
use Manager\PictureManager;
use Manager\CommentManager;
use Manager\PictureLikeManager;
use Manager\PictureReportManager;
use Manager\CommentLikeManager;
use Manager\CommentReportManager;

/**
 * Gere la redirection des pages
 */
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

	public function callClass($page)
	{
		if ('profil' === $page) {
			$userManager = new UserManager();
			$pictureManager = new PictureManager();
			$user = $userManager->getUserById($_SESSION['id']);
			$pictures = $pictureManager->getPicturesByUser($_SESSION['id']);
		} elseif ('accueil' === $page) {
			$pictureManager = new PictureManager();
			$pictures = $pictureManager->getLastPictures();
			$commentManager = new CommentManager();
			$pictureLikeManager = new PictureLikeManager();
			$pictureReportManager = new PictureReportManager();
			$commentLikeManager = new CommentLikeManager();
			$commentReportManager = new CommentReportManager();
		} elseif ('administrateur' === $page) {
			$pictureReportManager = new PictureReportManager();
			$commentReportManager = new CommentReportManager();
			$userManager = new UserManager();
		}

		require_once '../View/' . $page . '.php';
	}
}