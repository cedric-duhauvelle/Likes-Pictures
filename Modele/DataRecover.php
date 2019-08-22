<?php

namespace Modele;

use Modele\Data;

class DataRecover extends Data
{

    public function __construct($db)
    {
        return $this->_db = $db;
    }

    //Verifie si les données excitent dans la base de donnees
    public function checkData($tab, $champ, $value)
    {
        $this->callDisplay($tab);
        foreach ($this->_responses as $response) {
            if ($response[$champ] === $value) {
                return true;    
            }       
        }

        return false;
    }

    //return une donnee de la base de donnees
    public function returnData($tab, $champ, $name, $value)
    {
        $this->callDisplay($tab);
        foreach ($this->_responses as $response) {
            if ($response[$champ] === $name) {    
                return $response[$value];
            }
        }
    }

    //return toute les donnees d'une table de la base de donnees
    public function allData($tab)
    {
        $this->callDisplay($tab);
        foreach ($this->_responses as $response) {
            if ($response) {
                var_dump($response);
            }
            
        }
    }
}