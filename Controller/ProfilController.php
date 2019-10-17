<?php

namespace Controller;

use Manager\CommentManager;
use Manager\PictureManager;
use Manager\PictureLikeManager;
use Manager\PictureReportManager;
use Manager\UserManager;
use Systeme\Helper;

/**
 * Gere le profil utilisateur
 */
class ProfilController
{
    public function __construct()
    {
        return $this->profil();
    }

    /**
     * Gere supression des photos et modification de profil
     */
    public function profil()
    {
        $sucess = 0;
        $message = 'Une erreur est survenue..';

        $postClean = Helper::cleanArray($_POST);

        if (array_key_exists('element', $postClean)) {
            //Gere la supression des photos
            if('picture' === $postClean['element']) {
                $sucess = 1;
                $message = 'Photo effacée';

                $pictureManager = new PictureManager();
                //Efface une photo
                $pictureManager->delete($postClean['pictureId']);
                unlink('img/upload/picture/' . $postClean['pictureName'] . $postClean['pictureId'] . '.jpg');

            } elseif ('update' === $postClean['element']) {
                $userManager = new UserManager();
                //Modifie le nom utilsateur
                if ('name' === $postClean['element_update']) {
                    //Verifie si nom est non utilise
                    if ($userManager->getUserByName($postClean['new_name']) === false) {
                        $sucess = 1;
                        $message = 'Nom modifié';

                        $userManager->updateName($postClean['user_id'], $postClean['new_name']);
                    } else {
                        $message = 'Nom déjà utilisé';
                    }
                //Modifie l email utilisateur
                } elseif ('email' === $postClean['element_update']) {
                    //Verifie si email est non utilise
                    if ($userManager->getUserByEmail($postClean['new_email']) === false) {
                        $sucess = 1;
                        $message = 'Email modifié';

                        $userManager->updateEmail($postClean['user_id'], $postClean['new_email']);
                    } else {
                        $message = 'Email déjà utilisé';
                    }
                //Modifie le mot de passe utilisateur
                } elseif ('password' === $postClean['element_update']) {
                    //Verifie si mots de passe sont identiques
                    if ($postClean['new_password'] === $postClean['password_confirm']) {
                        $sucess = 1;
                        $message = 'Mot de passe modifié';

                        $userManager->updatePassword($postClean['user_id'], $postClean['new_password']);
                    } else {
                        $message = 'Les mots de passe ne sont pas identiques';
                    }
                }
            }
        }
        echo json_encode([
            "sucess" => $sucess,
            "message" => $message,
            "postClean" => $postClean,
        ]);
    }
}
