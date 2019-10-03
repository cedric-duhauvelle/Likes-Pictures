<?php

namespace Controller;

use Manager\PictureManager;
use Manager\UserManager;
use Systeme\Helper;

class ProfilController
{
    public function __construct()
    {
        return $this->profil();
    }

    public function profil()
    {
        $sucess = 0;
        $message = 'Une erreur est survenue..';

        $postClean = Helper::cleanArray($_POST);

        if (array_key_exists('element', $postClean)) {
            if('picture' === $postClean['element']) {
                $sucess = 1;
                $message = 'Photo effacée';

                $pictureManager = new PictureManager();
                $pictureManager->delete($postClean['pictureId']);
                unlink('img/upload/picture/' . $postClean['pictureName'] . $postClean['pictureId'] . '.jpg');

            } elseif ('update' === $postClean['element']) {


                $userManager = new UserManager;
                if ('name' === $postClean['element_update']) {
                    if ($userManager->getUserByName($postClean['new_name']) === false) {
                        $sucess = 1;
                        $message = 'Nom modifié';

                        $userManager->updateName($postClean['user_id'], $postClean['new_name']);
                    } else {
                        $message = 'Nom déjà utilisé';
                    }
                } elseif ('email' === $postClean['element_update']) {
                    if ($userManager->getUserByEmail($postClean['new_email']) === false) {
                        $sucess = 1;
                        $message = 'Email modifié';

                        $userManager->updateEmail($postClean['user_id'], $postClean['new_email']);
                    } else {
                        $message = 'Email déjà utilé';
                    }
                } elseif ('password' === $postClean['element_update']) {
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
        ]);
    }
}
