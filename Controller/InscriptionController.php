<?php
/**
 *
 *
 */
namespace Controller;

use Model\Session;
use Model\Router;
use Manager\UserManager;

class InscriptionController
{
    public function __construct()
    {
        $this->inscription();
    }

    public function inscription()
    {
        $router = new Router();
        $session = new Session();
        $postClean = $router->cleanArray($_POST);
        $userManager = new UserManager();

        if ($userManager->getUserByName($postClean['name']) !== false) {
            $session->addSession('errorName', 'Nom déjà utilisé!!');

            return header('Location: inscription');
        }
        if ($userManager->getUserByEmail($postClean['email']) !== false) {
            $session->addSession('errorEmail', 'Email déjà utilisé!!');

            return header('Location: inscription');
        }
        if ($postClean['password'] !== $postClean['confirm_password']) {
            $session->addSession('errorPassword', 'Les mots de passe ne sont pas identiques');

            return header('Location: inscription');
        }
        $userManager->add($postClean['name'], $postClean['email'], password_hash($postClean['password'], PASSWORD_DEFAULT));
        $user = $userManager->getUserByName($postClean['name']);
        $session->addSession('id', $user->getId());
        $session->addSession('name', $user->getName());
        header('Location: profil');
    }
}