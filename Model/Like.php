<?php

namespace Model;

use Manager\UserManager;
use Manager\PictureManager;
use Manager\CommentManager;

class Like
{
    private $_id;
    private $_element; //photo || commentaire
    private $_elementId;
    private $_user;
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

    public function setId($id)
    {
        $this->_id = $id;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function setElement($element)
    {
        $this->_element = $element;
    }

    public function getElement()
    {
        return $this->_element;
    }

    public function setElementId($id)
    {
        $this->_element = $id;
    }

    public function getElementId()
    {
        if ('picture' === $this->getElementId()) {
            $picture = new PictureManager();
            return $picture->getPictureById($this->getElement());
        }
        $comment = new commentManager();
        return $comment->getCommentById($this->getElement());
    }

    public function setUser($id)
    {
        $this->_user = $id;
    }

    public function getUser()
    {
        $user = new UserManager();
        return $user->getUserById($this->_user);
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