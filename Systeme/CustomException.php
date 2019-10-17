<?php

namespace Systeme;

use Exception;
use Systeme\Session;

/**
 * Entity CustomException extends Exception
 */
class CustomException extends Exception
{
	public function __construct($message = null, $code = 0)
    {
        parent::__construct($message, $code);
        $session = new Session();
        $session->addSession('errorMessage', $this->getMessage());
        $session->addSession('errorCode', $this->getCode());

        //Appelle l'affichage
        require_once '../View/error-page.php';
    }
}
