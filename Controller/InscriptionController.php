<?php

namespace Controller;

use Modele\Router;
use Modele\User;
use Modele\DataRecover;
use Modele\DataInsert;
use Modele\Session;


$router = new Router($this->_db);
$cleanPost = $router->cleanArray($_POST);

$data = new DataRecover($this->_db);
$session = new Session();

if (!$data->checkData('user', 'name', $cleanPost['name'])) {
    if (!$data->checkData('user', 'email', $cleanPost['email'])) {
        if ($cleanPost['password'] === $cleanPost['confirm_password']) {
            $password = password_hash($cleanPost['password'], PASSWORD_DEFAULT);

            $dataInsert = new DataInsert($this->_db);
            $dataInsert->user($cleanPost['name'], $cleanPost['email'], $password);

            $session->addSession('name', $cleanPost['name']);
            $session->addSession('id', $data->returnData('user', 'name', $cleanPost['name'], 'id'));

            header('Location: profil');
        } else {
            $session->addSession('errorPassword', 'Les mots de passe ne sont pas identiques !!');
            header('Location: inscription');
        }
    } else {
        $session->addSession('errorEmail', 'Email déjà utilisé !!');
        header('Location: inscription');
    }
} else {
    $session->addSession('errorName', 'Nom Déjà utilisé !!');
    header('Location: inscription');

}