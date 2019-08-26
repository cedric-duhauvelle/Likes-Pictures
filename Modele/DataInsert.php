<?php

namespace Modele;

use Modele\Data;

class DataInsert extends Data
{

    public function __construct($db)
    {
        return $this->_db = $db;
    }


    public function picture($idUser, $title)
    {
        $req = $this->_db->prepare('INSERT INTO picture(user, title, upload) VALUES (:user, :title, CURRENT_TIME)');
        $req->bindValue(':user', $idUser);
        $req->bindValue(':title', $title);
        $req->execute();
    }
}