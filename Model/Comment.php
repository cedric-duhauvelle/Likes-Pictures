<?php

namespace Model;

use Manager\UserManager;
use Manager\PictureManager;

class Comment
{
    private $_id;
    private $_user;
    private $_picture;
    private $_content;
    private $_published;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function setId(int $id)
    {
        $this->_id = $id;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function setUser(int $id)
    {
        $this->_user = $id;
    }

    public function getUser()
    {
        $user = new UserManager();
        return $user->getUserById($this->_user);
    }

    public function setPicture(int $id)
    {
        $this->_Picture = $id;
    }

    public function getPicture()
    {
        $picture = new PictureManager();
        return $picture->getPictureById($this->_user);
    }

    public function setContent(string $value)
    {
        $this->_content = $value;
    }

    public function getContent()
    {
        return $this->_content;
    }

    public function setPublished($time)
    {
        $this->_published = $time;
    }

    public function getPublished()
    {
        return $this->_published;
    }
}