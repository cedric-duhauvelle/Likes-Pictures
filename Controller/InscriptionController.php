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
    public function __construct($db)
    {
        $this->inscription($db);
    }

    public function inscription($db)
    {
        $router = new Router($db);
        $session = new Session();
        $postClean = $router->cleanArray($_POST);
        $userManager = new UserManager($db);
        if ($userManager->returnData('name',$postClean['name'], 'id') === null) {
            if ($userManager->returnData('email', $postClean['email'], 'email') === null) {
                if ($postClean['password'] === $postClean['confirm_password']) {
                    $userManager->add($postClean['name'], $postClean['email'], password_hash($postClean['password'], PASSWORD_DEFAULT));
                    $session->addSession('id', $userManager->returnData('name',$postClean['name'], 'id'));
                    $session->addSession('name', $postClean['name']);
                    return header('Location: profil');
                } else {
                    $session->addSession('errorPassword', 'Les mots de passe ne sont pas identiques');
                }
            } else {
                $session->addSession('errorEmail', 'Email déjà utilisé!!');
            }
        } else {
            $session->addSession('errorName', 'Nom déjà utilisé!!');
        }
        header('Location: inscription');
    }
}