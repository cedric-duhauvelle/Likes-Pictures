<?php

namespace Controller;

use Systeme\Router;
use Manager\PictureManager;

class PictureController
{
    public function __construct()
    {
        $this->pictureAdd();
    }

    public function pictureAdd()
    {
        $router = new Router();
        $postClean = $router->cleanArray($_POST);
        $pictureManager = new PictureManager();

        if (isset($_FILES['file']['tmp_name']) && ($_FILES['file']['error'] == UPLOAD_ERR_OK) || isset($_FILES['upload_picture']['tmp_name']) && ($_FILES['upload_picture']['error'] == UPLOAD_ERR_OK)) {
            if (array_key_exists('file', $_FILES)) {
                $route = '../Public/img/upload/avatar/';
                $pictureManager->add('file', $route, 'avatar', $_SESSION['id']);
            } elseif (array_key_exists('upload_picture', $_FILES)) {
                $route = '../Public/img/upload/picture/';
                $title = str_replace(" ", '-', $postClean['title']);
                $pictureManager->add('upload_picture', $route, $title, $_SESSION['id']);
            }
        } elseif ($_FILES['file']['error'] || $_FILES['upload_picture']['error']) {
            switch ($_FILES['file']['error']) {
                case 1: // UPLOAD_ERR_INI_SIZE
                    echo"Le fichier dépasse la limite autorisée par le serveur (fichier php.ini) !";
                    break;
                case 2: // UPLOAD_ERR_FORM_SIZE
                    echo "Le fichier dépasse la limite autorisée dans le formulaire HTML !";
                    break;
                case 3: // UPLOAD_ERR_PARTIAL
                    echo "L'envoi du fichier a été interrompu pendant le transfert !";
                    break;
                case 4: // UPLOAD_ERR_NO_FILE
                    echo "Le fichier que vous avez envoyé a une taille nulle !";
                    break;
            }
        }
        header('Location: galerie');
    }
}