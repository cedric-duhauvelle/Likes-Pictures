<?php

namespace Controller;

use Systeme\Helper;
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
        $sucess = 0;
        $likeStatus = 0;
        $likeNumber = 0;
        $data = [];
        $message = "Une erreur est survenue ...";
        $postClean = Helper::cleanArray($_POST);

        //Recherche si l'element est like si deja like efface le like
        $likeManager = new LikeManager();
        $likes = $likeManager->getLikesbyElementId($postClean['elementId'], $postClean['element']);
        foreach ($likes as $like) {
            if ($like->getUser()->getId() == $postClean['userId']) {
                $sucess = 1;
                $likeStatus = 1;

                $likeManager->delete($like->getId());
                $likeNumber = $likeManager->getLikesNumberByElementId($postClean['elementId'], $postClean['element']);

                $data = [
                    "likeStatus" => $likeStatus,
                    "element" => $postClean['element'],
                    "elementId" => $postClean['elementId'],
                    "likeNumber" => $likeNumber,
                ];
                $message = 'Like effacer';
            }
        }

        //Ajout un like
        if (0 === $likeStatus) {
            $sucess = 1;
            $likeStatus = 0;

            $likeManager->add($postClean['element'], $postClean['elementId'], $postClean['userId']);
            $likeNumber = $likeManager->getLikesNumberByElementId($postClean['elementId'], $postClean['element']);

            $userManager =  new UserManager();
            $user = $userManager->getUserById($postClean['userId']);

            $data = [
                "element" => $postClean['element'],
                "elementId" => $postClean['elementId'],
                "userId" => $postClean['userId'],
                "userName" => $user->getName(),
                "likeStatus" => $likeStatus,
                "likeNumber" => $likeNumber,
            ];
            $message = 'Like ajouter';
        }

        echo json_encode([
            "sucess" => $sucess,
            "message" => $message,
            "data" => $data,
        ]);
    }
}