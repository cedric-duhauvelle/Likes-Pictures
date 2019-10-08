<?php

namespace Model;

/**
 *
 */
class User
{
    private $_userId;
    private $_name;
    private $_email;
    private $_password;
    private $_inscription;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            if (strpos($key, '_')) {
                $arrayKey = explode('_', $key);
                $key = $arrayKey[0] . ucfirst($arrayKey[1]);
            }
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function setUserId(int $id)
    {
        if ($id > 0) {
            $this->_userId = $id;
        }
    }

    public function getUserId()
    {
        return $this->_userId;
    }

    public function setName($name)
    {
        if (is_string($name)) {
            $this->_name = $name;
        }
    }

    public function getName()
    {
        return $this->_name;
    }

    public function setEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->_email = $email;
        }
    }

    public function getEmail()
    {
        return $this->_email;
    }

    public function setPassword($password)
    {
        if (is_string($password)) {
            $this->_password = $password;
        }
    }

    public function getPassword()
    {
        return $this->_password;
    }

    public function setInscription($inscription)
    {
        $this->_inscription = $inscription;
    }

    public function getInscription()
    {
        return date_format(date_create($this->_inscription), 'd/m/Y à H:i');
    }
}