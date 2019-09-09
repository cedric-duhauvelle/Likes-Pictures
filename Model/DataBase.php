<?php

namespace Model;

use PDO;

class DataBase
{
    private $_host;
    private $_name;
    private $_user;
    private $_password;

    public function __construct()
    {
        include('../Public/Private/adressDataBase.php');
        $this->_host = $db['host'];
        $this->_name = $db['name'];
        $this->_user = $db['user'];
        $this->_password = $db['password'];
    }

    public function connect()
    {
        try {
            return new PDO('mysql:host=' . $this->_host . ';dbname=' . $this->_name . ';charset=utf8', $this->_user, $this->_password);
        } catch(Exception $e) {

        }
    }
}