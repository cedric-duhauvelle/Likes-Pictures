<?php

namespace Systeme;

/**
 *
 */
class Session
{
    /**
     * Cree une variable $_SESSION
     */
    public function addSession($name, $value)
    {
        $_SESSION[$name] = $value;
    }
}