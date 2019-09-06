<?php

namespace Controller;

use Model\Router;
use Model\Session;
use Manager\UserManager;

class ConnexionController
{
    public function __construct($db)
    {
        $this->connexion($db);
    }

    public function connexion($db)
    {
        $router = new Router($db);

        $postClean = $router->cleanArray($_POST);

        var_dump($postClean);
        $userManager = new UserManager($db);
        $session = new Session();
        var_dump($userManager->returnData('name', $postClean['name'], 'id'));
        if ($userManager->returnData('name', $postClean['name'], 'id')) {
            $checkPassword = $userManager->returnData('name', $postClean['name'], 'password');
            if (password_verify($postClean['password'], $checkPassword)) {
                $session->addSession('name', $postClean['name']);
                $session->addSession('id', $userManager->returnData('name', $postClean['name'], 'id'));
                return header('Location: profil');
            } else {
                $session->addSession('errorPassword', 'Mot de passe incorrect');
            }
        } else {
            $session->addSession('errorName', 'Nom incorrect');}
        header('Location: connexion');
    }
}






