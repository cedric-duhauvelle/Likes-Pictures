<?php

namespace Systeme;

use Controller\Controller;
use Controller\PageController;
use Controller\LikeController;
use Controller\ReportController;
use Controller\CommentController;
use Systeme\CustomException;

class Router
{
    //Nettoyeur de tableau
    public function cleanArray($array)
    {
        return isset($array) ? filter_var_array($array, FILTER_SANITIZE_STRING) : null;
    }

    //Recupere url
    public function setUrl($url)
    {
        $this->route($url);
    }

    //Redection vers la page souhaitee
    private function route($page)
    {
        //Redirection vers les controllers
        if ($page == 'Like') {
            new LikeController();
        } elseif($page == 'Report') {
            new ReportController();
        } elseif($page == 'Comment') {
            new CommentController();
        } elseif (strpos($page, 'Controller') && is_file('../Controller/' . $page . '.php')) {
            new Controller($page);
        //Redirection vers les templates
        } elseif (is_file('../View/' . $page . '.php')) {
            new PageController($page);
        } else {
            new CustomException("Page introuvable", 404);
        }
    }
}