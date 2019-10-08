<?php

use Systeme\Helper;
use Systeme\Router;
use Systeme\CustomException;

session_start();
spl_autoload_register(function ($class) {
    $class = '../' . str_replace("\\", '/', $class) . '.php';
    if (is_file($class)) {
        require_once($class);
    } else {
        new Exception('Erreur interne de chargement');
    }
});

$router = new Router();
$getClean = Helper::cleanArray($_GET);

if(array_key_exists('url', $_GET)) {
    $url = $getClean['url'];
} else {
	$url = 'accueil';
}
//Gestion des erreurs
set_exception_handler('exception');
function exception($e)
{
    new CustomException($e);
}

$router->setUrl($url);