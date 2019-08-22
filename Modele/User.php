<?php

namespace Modele;

use Modele\DataInsert;
use Modele\DataRecover;
use Modele\Session;

class User
{

    //return donnee utilisateur
    public function returnData($db, $champ, $value, $return)
    {
        $data = new DataRecover($db);

        return $data->returnData('user', $champ, $value, $return);    
    }
}