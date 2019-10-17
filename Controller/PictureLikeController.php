<?php

namespace Controller;

use Systeme\Helper;
use Manager\PictureLikeManager;
use Manager\UserManager;

/**
 * Gere l ajout et la suppression des likes sur les photos
 */
class PictureLikeController
{
    public function __construct()
    {
        return $this->like();
    }

    /**
     * Gere l ajout et la supression des likes sur les photos
     */
    public function like()
    {
        $sucess = 0;
        $likeStatus = 0;
        $likeNumber = 0;
        $data = [];
        $message = "Une erreur est survenue ...";
        $postClean = Helper::cleanArray($_POST);

        $pictureLikeManager = new PictureLikeManager();
        $likes = $pictureLikeManager->getPicturesLikesbyPictureId($postClean['elementId']);
        foreach ($likes as $like) {
            //Verifie si utilisateur a like photo efface photo
            if ($like->getUserId()->getUserId() == $postClean['userId']) {
                $sucess = 1;
                $likeStatus = 1;
                //Efface like
                $pictureLikeManager->delete($like->getPictureLikeId());
                //nombre like photo
                $likeNumber = $pictureLikeManager->getPicturesLikesNumberByPictureId($postClean['elementId']);
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
            //ajout like a la base de donnees
            $pictureLikeManager->add($postClean['elementId'], $postClean['userId']);
            //Nombre like photo
            $likeNumber = $pictureLikeManager->getPicturesLikesNumberByPictureId($postClean['elementId']);

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