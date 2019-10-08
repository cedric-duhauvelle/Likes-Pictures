<?php

namespace Systeme;

use PDO;
use Systeme\CustomException;

/**
 * Connection a la base de donnee
 */
class DataBase
{
    private $_host;
    private $_name;
    private $_user;
    private $_password;

    public function __construct()
    {
        require ('../Systeme/Private/adressDataBase.php');
        $this->_host = $db['host'];
        $this->_name = $db['name'];
        $this->_user = $db['user'];
        $this->_password = $db['password'];
    }

    public function connect()
    {
        try {
            $db = new PDO('mysql:host=' . $this->getHost() . ';dbname=' . $this->getName() . ';charset=utf8', $this->getUser(), $this->getPassword());
        } catch(CustomException $e) {
            new CustomException('Erreur de chargement à la base de données', 404);
        }
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $db;
    }

    public function getHost()
    {
        return $this->_host;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function getUser()
    {
        return $this->_user;
    }

    public function getPassword()
    {
        return $this->_password;
    }
}