<?php

namespace Modele;

use Modele\Data;

class DataInsert extends Data
{

    public function __construct($db)
    {
        return $this->_db = $db;
    }

    public function user($name, $email, $password)
    {
        $req = $this->_db->prepare('INSERT INTO user(name, email, password, inscription) VALUES (:name, :email, :password, CURRENT_TIME)');
        $req->bindValue(':name', $name);
        $req->bindValue(':email', $email);
        $req->bindValue(':password', $password);
        $req->execute();
    }

    public function picture($idUser, $title)
    {
        $req = $this->_db->prepare('INSERT INTO picture(user, title, upload) VALUES (:user, :title, CURRENT_TIME)');
        $req->bindValue(':user', $idUser);
        $req->bindValue(':title', $title);
        $req->execute();
    }
}