<?php

namespace Controller;

/**
 * Deconnect l utilisateur
 */
class DeconnexionController
{
    public function __construct()
    {
        $this->deconnexion();
    }

    public function deconnexion()
    {
        //Detruit la session en cours
        $_SESSION = array();
        session_destroy();

        //Redirection
        header('Location: accueil');
    }
}
