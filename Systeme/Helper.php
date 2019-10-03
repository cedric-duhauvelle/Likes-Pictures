<?php

namespace Systeme;

class Helper
{
    public static function cleanArray($array)
    {
        return isset($array) ? filter_var_array($array, FILTER_SANITIZE_STRING) : null;
    }
}