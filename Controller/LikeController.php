<?php

namespace Controller;

use Systeme\Router;
use Manager\LikeManager;

class LikeController
{
    public function __construct()
    {
        $this->like();
    }

    public function like()
    {
        echo 'sa marche';
        $router = new Router();
        $postClean = $router->cleanArray($_POST);
var_dump($postClean);
var_dump($_SESSION);
        $likeManager = new LikeManager();
        $likeManager->add($postClean['element'], $postClean['elementId'], $_SESSION['id']);

    }
}
