<?php

namespace Modele;

use Modele\DataInsert;
use Modele\DataRecover;

class Pictures
{

    public function upload($db, $file, $route, $name, $id)
    {
        $this->insertDatabase($db, $id, $name);
        $idPicture = $this->recoverId($db, $id);
        var_dump($idPicture);    
        move_uploaded_file($_FILES[$file]['tmp_name'], $route . $name . $idPicture);                
    }

    public function recoverId($db, $idUser)
    {
        $data = new DataRecover($db);
        return $data->returnData('picture', 'user', $idUser, 'id');
    }

    public function insertDatabase($db, $id, $title)
    {
        $data = new DataInsert($db);
        $data->picture($id, $title);
    }

    public function displayGalerie($db)
    {
        
    }
}