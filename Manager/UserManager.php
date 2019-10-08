<?php

namespace Manager;

use PDO;
use Model\User;
use Systeme\Database;

/**
 * Gere les appelles a la base de donnee pour les utilisateurs
 */
class UserManager
{
    private $_db;

    public function __construct()
    {
        $db = new DataBase();
        $this->_db = $db->connect();
    }

    /**
     * Retourne un utilisateur par son ID
     *
     * @return array
     */
    public function getUserById($id)
    {
        $id = (int) $id;
        $request = $this->_db->query('SELECT * FROM user WHERE user_id = '. $id);

        return new User($request->fetch(PDO::FETCH_ASSOC));
    }

    /**
     * Retourne un utilisateur par son nom
     *
     * @return object
     */
    public function getUserByName($name)
    {
        $request = $this->_db->query('SELECT * FROM user WHERE name="' . $name . '"');
        $data = $request->fetch(PDO::FETCH_ASSOC);
        if ($data !== false) {
            return new User($data);
        }

        return false;
    }

    /**
     * Retourne un utilisateur par son email
     *
     * @return array
     */
    public function getUserByEmail($email)
    {
        $request = $this->_db->query('SELECT * FROM user WHERE email="' . $email . '"');
        $data = $request->fetch(PDO::FETCH_ASSOC);
        if ($data !== false) {
            return new User($data);
        }

        return false;
    }

    /**
     * Retourne tous les utilsateurs
     *
     * @return array
     */
    public function getUsers()
    {
        $users = [];
        $request = $this->_db->query('SELECT * FROM user');
        while ($data =  $request->fetch(PDO::FETCH_ASSOC)) {
           $users[] = new User($data);
        }
        return $users;
    }

    /**
     * Ajoute un utilisateur a la base de donnee
     */
    public function add($name, $email, $password)
    {
        $request = $this->_db->prepare('INSERT INTO user(name, email, password, inscription) VALUES (:name, :email, :password, CURRENT_TIME)');
        $request->bindValue(':name', $name);
        $request->bindValue(':email', $email);
        $request->bindValue(':password', $password);
        $request->execute();
    }

    /**
     * Efface un utilisateur par son ID
     */
    public function delete($id)
    {
        $req = $this->_db->prepare('DELETE FROM user WHERE user_id=:id LIMIT 1');
        $req->bindValue(':id', $id);
        $req->execute();
    }

    /**
     * Modifie le nom utilisateur
     */
    public function updateName($id, $name)
    {
        $update = $this->_db->prepare('UPDATE user SET name=:name WHERE id=:id');
        $update->bindValue(':name', $name);
        $update->bindValue(':id', $id);
        $update->execute();
    }

    /**
     * Modifie l email utilisateur
     */
    public function updateEmail($id, $email)
    {
        $update = $this->_db->prepare('UPDATE user SET email=:email WHERE id=:id');
        $update->bindValue(':email', $email);
        $update->bindValue(':id', $id);
        $update->execute();
    }

    /**
     * Modifie le mot de passe utilisateur
     */
    public function updatePassword($id, $password)
    {
        $update = $this->_db->prepare('UPDATE user SET password=:password WHERE id=:id');
        $update->bindValue(':password', $password);
        $update->bindValue(':id', $id);
        $update->execute();
    }
}