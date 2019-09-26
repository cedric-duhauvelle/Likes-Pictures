<?php

namespace Controller;

use Systeme\Router;
use Manager\ReportManager;
use Manager\PictureManager;

class AdminController
{
    public function __construct()
    {
        return $this->admin();
    }

    public function admin()
    {
        $router = new Router();
        $sucess = 0;
        $msg = 'Une erreur est survenue...';
        $data = ["POST" => $_POST];

        $postClean = $router->cleanArray($_POST);

        if (array_key_exists('picture_id_admin', $postClean)) {
            $sucess = 1;
            $reportManager = new ReportManager();
            $reportManager->delete($postClean['report_id_admin']);
            $pictureManager = new PictureManager();
            $pictureManager->delete($postClean['picture_id_admin']);
            $data = ["POST" => $postClean];
            unlink('img/upload/picture/' . $postClean['picture_title_admin'] . $postClean['picture_id_admin'] . '.jpg');
        } elseif (array_key_exists('report_id_admin', $postClean)) {
            $sucess = 1;
            $reportManager = new ReportManager();
            $reportManager->delete($postClean['report_id_admin']);

        }

        $res = ["sucess" => $sucess, "msg" => $msg, "data" => $data];

        echo json_encode($res);
    }
}