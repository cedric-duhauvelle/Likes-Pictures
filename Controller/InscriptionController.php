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
        echo '</br> sa marche';
    }

    public function inscription($db)
    {
        $router = new Router($db);
        $postClean = $router->cleanArray($_POST);
        var_dump($postClean);
        $userManager = new UserManager($db);
        $users = $userManager->getUsers();
        var_dump($users);
        foreach ($users as $user) {
            if ($user->getName() === $postClean['name']) {
                echo $postClean['name'];
                echo $user->getName();
                if ($user->getEmail() !== $postClean['email']) {
                    echo '</br>';
                    echo $postClean['email'];
                    echo '</br>';
                    if ($postClean['password'] === $postClean['confirm_password']) {
                        echo $postClean['password'];
                        echo '</br>';
                        echo $postClean['confirm_password'];
                        echo '</br>';
                        echo '</br>';
                        echo '</br>';
                    }
                }
            }
        }
    }
}