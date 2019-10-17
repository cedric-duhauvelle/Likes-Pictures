<?php

namespace Controller;

use Systeme\Helper;
use Manager\CommentLikeManager;
use Manager\UserManager;

/**
 * Gere l ajout et la suppression des likes sur les commentaires
 */
class CommentLikeController
{
    public function __construct()
    {
        return $this->like();
    }

    /**
     * Gere les likes des commentaires
     */
    public function like()
    {
        $sucess = 0;
        $likeStatus = 0;
        $likeNumber = 0;
        $data = [];
        $message = "Une erreur est survenue ...";
        $postClean = Helper::cleanArray($_POST);

        $commentLikeManager = new CommentLikeManager();
        $likes = $commentLikeManager->getCommentsLikesbyCommentId($postClean['elementId']);
        foreach ($likes as $like) {
            //Verifie si l utilisateur a deja liker le commentaire si like efface like
            if ($like->getUserId()->getUserId() == $postClean['userId']) {
                $sucess = 1;
                $likeStatus = 1;
                //Efface like commentaire
                $commentLikeManager->delete($like->getCommentLikeId());
                //Nombre de like commentaire
                $likeNumber = $commentLikeManager->getCommentsLikesNumberByCommentId($postClean['elementId']);
                $data = [
                    "likeStatus" => $likeStatus,
                    "element" => $postClean['element'],
                    "elementId" => $postClean['elementId'],
                    "likeNumber" => $likeNumber,
                ];
                $message = 'Like effacé';
            }
        }

        //Ajout un like
        if (0 === $likeStatus) {
            $sucess = 1;
            $likeStatus = 0;
            //Ajout like a la base de donnees
            $commentLikeManager->add($postClean['elementId'], $postClean['userId']);
            //Nombre de like commentaire
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
            $message = 'Like ajouté';
        }
        echo json_encode([
            "sucess" => $sucess,
            "message" => $message,
            "data" => $data,
        ]);
    }
}