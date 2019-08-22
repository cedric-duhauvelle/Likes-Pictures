<?php

namespace Controller;

use Modele\Router;
use Modele\Session;
use Modele\DataRecover;

$router = new Router($this->_db);

$postClean = $router->cleanArray($_POST);

var_dump($postClean);

$data = new DataRecover($this->_db);
$session = new Session();
if ($data->checkData('user', 'name', $postClean['name'])) {
    $checkPassword = $data->returnData('user', 'name', $postClean['name'], 'password');
    if (password_verify($postClean['password'], $checkPassword)) {
        $session->addSession('name', $postClean['name']);
        $session->addSession('id', $data->returnData('user', 'name', $postClean['name'], 'id'));
        header('Location: profil');
    } else {
        $session->addSession('errorPassword', 'Mot de passe incorrect');
        header('Location: connexion');
    }    
} else {
    $session->addSession('errorName', 'Nom incorrect');
    header('Location: connexion');
}

