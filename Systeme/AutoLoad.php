<?php

spl_autoload_register(function ($class) {
    $class = '../' . str_replace("\\", '/', $class) . '.php';
    if (is_file($class)) {
        require_once($class);
    } else {
        new Exception('Erreur interne de chargement');
    }
});