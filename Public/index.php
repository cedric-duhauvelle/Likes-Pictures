<?php

use Systeme\Router;
use Systeme\CustomException;

session_start();
include('../Systeme/AutoLoad.php');

$router = new Router();
$getClean = $router->cleanArray($_GET);

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