<?php

namespace Controller;

use Systeme\Helper;
use Systeme\Session;
use Manager\UserManager;

class ConnexionController
{
    public function __construct()
    {
        $this->connexion();
    }

    public function connexion()
    {
        $postClean = Helper::cleanArray($_POST);

        $userManager = new UserManager();
        $session = new Session();

        if ($userManager->getUserByName($postClean['name'])) {
            $user = $userManager->getUserByName($postClean['name']);

            if (password_verify($postClean['password'], $user->getPassword())) {
                $session->addSession('name', $postClean['name']);
                $session->addSession('id', $user->getUserId());
                if ($postClean['name'] === 'admin') {
                    $session->addSession('admin', 'admin');
                }

                return header('Location: profil');
            }
            $session->addSession('errorPassword', 'Mot de passe incorrect');
        } else {
            $session->addSession('errorName', 'Nom incorrect');
        }
        header('Location: connexion');
    }
}






