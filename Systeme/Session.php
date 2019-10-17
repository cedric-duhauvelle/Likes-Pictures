<?php

namespace Systeme;

/**
 * Entity Session
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