<?php

namespace Controller;

use Model\Router;
use Model\Session;
use Manager\UserManager;

class ConnexionController
{
    public function __construct()
    {
        $this->connexion();
    }

    public function connexion()
    {
        $router = new Router();
        $postClean = $router->cleanArray($_POST);

        $userManager = new UserManager();
        $session = new Session();

        if ($userManager->getUserByName($postClean['name'])) {
            $user = $userManager->getUserByName($postClean['name']);

            if (password_verify($postClean['password'], $user->getPassword())) {
                $session->addSession('name', $postClean['name']);
                $session->addSession('id', $user->getId());

                return header('Location: profil');
            }
            $session->addSession('errorPassword', 'Mot de passe incorrect');
        } else {
            $session->addSession('errorName', 'Nom incorrect');
        }
        header('Location: connexion');
    }
}






