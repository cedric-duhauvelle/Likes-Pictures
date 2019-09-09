<?php

namespace Manager;

use PDO;
use Model\User;
use Systeme\Database;

class UserManager
{
    private $_db;

    public function __construct()
    {
        $db = new DataBase();
        $this->_db = $db->connect();
    }

    //retourne un utilisateur
    public function getUserById($id)
    {
        $id = (int) $id;
        $request = $this->_db->query('SELECT * FROM user WHERE id = '. $id);

        return new User($request->fetch(PDO::FETCH_ASSOC));
    }

    //retourne un utilisateur
    public function getUserByName($name)
    {
        $request = $this->_db->query('SELECT * FROM user WHERE name="' . $name . '"');
        $data = $request->fetch(PDO::FETCH_ASSOC);
        if ($data !== false) {
            return new User($data);
        }

        return false;
    }

    //retourne un utilisateur
    public function getUserByEmail($email)
    {
        $request = $this->_db->query('SELECT * FROM user WHERE email="' . $email . '"');
        $data = $request->fetch(PDO::FETCH_ASSOC);
        if ($data !== false) {
            return new User($data);
        }

        return false;
    }

    //retourne tous les utilisateurs
    public function getUsers()
    {
        $users = [];
        $request = $this->_db->query('SELECT * FROM user');
        while ($data =  $request->fetch(PDO::FETCH_ASSOC)) {
           $users[] = new User($data);
        }
        return $users;
    }

    public function add($name, $email, $password)
    {
        $request = $this->_db->prepare('INSERT INTO user(name, email, password, inscription) VALUES (:name, :email, :password, CURRENT_TIME)');
        $request->bindValue(':name', $name);
        $request->bindValue(':email', $email);
        $request->bindValue(':password', $password);
        $request->execute();
    }

    //return donnee utilisateur
    public function returnData($name)
    {
        $users = $this->getUserByName($name);

        return $users;
    }
}