<?php

namespace Controller;

use Systeme\Helper;
use Manager\CommentLikeManager;
use Manager\UserManager;

class CommentLikeController
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
        $commentLikeManager = new CommentLikeManager();
        $likes = $commentLikeManager->getCommentsLikesbyCommentId($postClean['elementId']);
        foreach ($likes as $like) {
            if ($like->getUserId()->getUserId() == $postClean['userId']) {
                $sucess = 1;
                $likeStatus = 1;

                $commentLikeManager->delete($like->getCommentLikeId());
                $likeNumber = $commentLikeManager->getCommentsLikesNumberByCommentId($postClean['elementId']);

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

            $commentLikeManager->add($postClean['elementId'], $postClean['userId']);
            $likeNumber = $commentLikeManager->getCommentsLikesNumberByCommentId($postClean['elementId']);

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