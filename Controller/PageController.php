<?php

namespace Controller;

use Systeme\Helper;
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

	/**
	 * Assemble les templates
	 */
	public function page($page)
	{
		require_once '../View/Template/header.php';
		$this->callClass($page);
		require_once '../View/Template/footer.php';
	}

	/**
	 * Instancie les managers pour la redirection des pages
	 */
	public function callClass($page)
	{
		//Profil
		if ('profil' === $page) {
			$userManager = new UserManager();
			$pictureManager = new PictureManager();
			$user = $userManager->getUserById($_SESSION['id']);
			$pictures = $pictureManager->getPicturesByUser($_SESSION['id']);
		//accueil
		} elseif ('accueil' === $page) {
			$pictureManager = new PictureManager();

			$commentManager = new CommentManager();
			$pictureLikeManager = new PictureLikeManager();
			$pictureReportManager = new PictureReportManager();
			$commentLikeManager = new CommentLikeManager();
			$commentReportManager = new CommentReportManager();

			$getClean = Helper::cleanArray($_GET);
			$NumberPostPage = 5;
			$numberPost = $pictureManager->getPicturesNumber();
			$pageTotal = ceil($numberPost/$NumberPostPage);
			if (array_key_exists('page', $getClean) && $getClean['page'] > 0) {
				$currentPage = intval($getClean['page']);
			} else {
				$currentPage = 1;
			}
			$start = ($currentPage-1)*$NumberPostPage;

			$pictures = $pictureManager->getLastPictures($start, $NumberPostPage);
		//administrateur
		} elseif ('administrateur' === $page) {
			$pictureReportManager = new PictureReportManager();
			$commentReportManager = new CommentReportManager();
			$userManager = new UserManager();
		}

		require_once '../View/' . $page . '.php';
	}
}