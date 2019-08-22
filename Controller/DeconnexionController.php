<?php

session_start();

//Detruit la session en cours
$_SESSION = array();
session_destroy();

//Redirection
header('Location: accueil');