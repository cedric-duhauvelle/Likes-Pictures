<?php

namespace Model;

use Manager\UserManager;
use Manager\PictureManager;
use Manager\CommentManager;

class Report
{
    private $_id;
    private $_element;
    private $_elementId;
    private $_userId;
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
        if ('picture' == $this->_element) {
            $picture = new PictureManager();

            return $picture->getPictureById($this->getElementId());
        } elseif ('comment' == $this->_element) {
            $comment = new CommentManager();

            return $comment->getCommentById($this->getElementId());
        }
    }

    public function setElementId($elementId)
    {
        $this->_elementId = $elementId;
    }

    public function getElementId()
    {
        return $this->_elementId;
    }

    public function setUser($userId)
    {
        $this->_userId = $userId;
    }

    public function getUser()
    {
        $user = new UserManager();
        return $user->getUserById($this->_userId);
    }

    public function setPublished($time)
    {
        $this->_published = $time;
    }

    public function getPublished()
    {
        return date_format(date_create($this->_published), 'd/m/Y à H:i');
    }
}