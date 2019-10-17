<?php

namespace Controller;

use Systeme\Session;
use Systeme\Helper;
use Manager\UserManager;

/**
 * Gere l inscription utilisateur
 */
class InscriptionController
{
    public function __construct()
    {
        $this->inscription();
    }

    /**
     * Gere et verifie les informations utilisateur pour l inscription
     */
    public function inscription()
    {
        $postClean = Helper::cleanArray($_POST);
        $session = new Session();

        $userManager = new UserManager();

        //Verifie si le nom est déja utilise
        if ($userManager->getUserByName($postClean['name']) !== false) {
            $session->addSession('errorName', 'Nom déjà utilisé!!');

            return header('Location: inscription');
        }

        //Verifie si l email est deja utilise
        if ($userManager->getUserByEmail($postClean['email']) !== false) {
            $session->addSession('errorEmail', 'Email déjà utilisé!!');

            return header('Location: inscription');
        }

        //Verifie si les deux mots de passe sont identique
        if ($postClean['password'] !== $postClean['confirm_password']) {
            $session->addSession('errorPassword', 'Les mots de passe ne sont pas identiques');

            return header('Location: inscription');
        }

        //Ajout un utlisateur a l a base de donnee
        $userManager->add($postClean['name'], $postClean['email'], password_hash($postClean['password'], PASSWORD_DEFAULT));
        $user = $userManager->getUserByName($postClean['name']);
        $session->addSession('id', $user->getUserId());
        $session->addSession('name', $user->getName());
        header('Location: profil');
    }
}