<?php

namespace Manager;

use PDO;
use Model\User;

class UserManager
{
    private $_db;

    public function __construct(PDO $db)
    {
        $this->setDb($db);
    }

    public function setDb($db)
    {
        $this->_db = $db;
    }

    //retourne un utilisateur
    public function getUser($id)
    {
        $id = (int) $id;
        $q = $this->_db->query('SELECT * FROM user WHERE id = '. $id);
        $data =  $q->fetch(PDO::FETCH_ASSOC);

        return new User($data);
    }

    //retourne tous les utilisateurs
    public function getUsers()
    {
        $users = [];
        $q = $this->_db->query('SELECT * FROM user');
        while ($data =  $q->fetch(PDO::FETCH_ASSOC)) {
           $users[] = new User($data);
        }
        return $users;
    }

    public function add($name, $email, $password)
    {
        $req = $this->_db->prepare('INSERT INTO user(name, email, password, inscription) VALUES (:name, :email, :password, CURRENT_TIME)');
        $req->bindValue(':name', $name);
        $req->bindValue(':email', $email);
        $req->bindValue(':password', $password);
        $req->execute();
    }

    //return donnee utilisateur
    public function returnData($champ, $name, $value)
    {
        $resp = $this->_db->prepare('SELECT * FROM user');
        $resp->execute();
        $responses = $resp->fetchAll();
        foreach ($responses as $response) {
            if ($response[$champ] === $name) {
                return $response[$value];
            }
        }
        return null;

    }
}