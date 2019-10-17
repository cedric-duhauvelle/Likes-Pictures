<?php

namespace Systeme;

/**
 *  Entity Helper
 */
class Helper
{
    /**
     *Nettoye un tableau
     *
     * @return array
     */
    public static function cleanArray($array)
    {
        return isset($array) ? filter_var_array($array, FILTER_SANITIZE_STRING) : null;
    }
}