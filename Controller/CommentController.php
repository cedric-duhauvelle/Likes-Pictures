<?php

namespace Controller;

use Systeme\Router;
use Manager\CommentManager;

class CommentController
{
    public function __construct()
    {
        $this->comment();
    }

    public function comment()
    {
        $router = new Router();
        $postClean = $router->cleanArray($_POST);
        $commentManager = new CommentManager();
        $commentManager->add($_SESSION['id'], $postClean['pictureId'], $postClean['comment']);
    }
}