<?php

namespace Controller;

use Systeme\Router;
use Manager\LikeManager;
use Manager\UserManager;

class LikeController
{
    public function __construct()
    {
        return $this->like();
    }

    public function like()
    {

    $router = new Router();
    $postClean = $router->cleanArray($_POST);

    $sucess = 0;
    $likeStatus = 0;
    $likeNumber = 0;
    $data = [];
    $msg = "Une erreur est survenue ...";

    $likeManager = new LikeManager();

    $userManager =  new UserManager();

    $likes = $likeManager->getLikesbyElementId($postClean['elementId']);



    foreach ($likes as $like) {

        if ($like->getUser()->getId() == $postClean['userId']) {
            $sucess = 1;
            $likeManager->delete($like->getId());
            $likeStatus = 1;
            $likeNumber = $likeManager->getLikesNumberByElementId($postClean['elementId']);
            $data = ["likeStatus" => $likeStatus, "element" => $postClean['element'], "elementId" => $postClean['elementId'], "likeNumber" => $likeNumber];
            $msg = 'Like effacer';
        }

    }


    if ($likeStatus === 0) {
        $sucess = 1;
        $likeStatus = 0;

        $likeManager->add($postClean['element'], $postClean['elementId'], $postClean['userId']);
        $likeNumber = $likeManager->getLikesNumberByElementId($postClean['elementId']);

        $user = $userManager->getUserById($postClean['userId']);

        $data = ["element" => $postClean['element'], "elementId" => $postClean['elementId'], "userId" => $postClean['userId'], "userName" => $user->getName(), "likeStatus" => $likeStatus, "likeNumber" => $likeNumber];
        $msg = 'Like ajouter';
    }


    $res = ["sucess" => 1, "msg" => $msg, "data" => $data];


    echo json_encode($res);


    }
}
