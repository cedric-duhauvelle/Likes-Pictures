<?php

namespace Controller;

use Systeme\Helper;
use Manager\UserManager;
use Manager\CommentManager;

class CommentController
{
    public function __construct()
    {
        return $this->comment();
    }

    public function comment()
    {
        $postClean = Helper::cleanArray($_POST);
        $sucess = 0;
        $data = [];
        $message = 'Une erreur est survenue ... (php)';


        if ($postClean['comment'] !== "") {
            $sucess = 1;

            $userManager = new UserManager();
            $commentManager = new CommentManager();

            $user = $userManager->getUserById($postClean['userId']);
            $commentManager->add($postClean['userId'], $postClean['pictureId'], $postClean['comment']);
            $comment = $commentManager->getCommentLast();

            $data = [
                "comment" => $postClean['comment'],
                "pictureId" => $postClean['pictureId'],
                "userName" => $user->getName(),
                "userId" => $user->getId(),
                "published" => $comment->getPublished(),
                "commentId" => $comment->getId(),
            ];
            $message = "Commentaire ajouté";

        } else {
            $message = "Veuillez écrire un commentaire";
        }

        echo json_encode([
            "sucess" => $sucess,
            "message" => $message,
            "data" => $data,
        ]);
    }
}