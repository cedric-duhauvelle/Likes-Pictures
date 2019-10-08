<?php

namespace Model;

use Manager\UserManager;
use Manager\PictureManager;

/**
 *
 */
class Comment
{
    private $_commentId;
    private $_userId;
    private $_pictureId;
    private $_content;
    private $_published;

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

    public function setCommentId(int $id)
    {
        $this->_commentId = $id;
    }

    public function getCommentId()
    {
        return $this->_commentId;
    }

    public function setUserId(int $id)
    {
        $this->_userId = $id;
    }

    public function getUserId()
    {
        $user = new UserManager();
        return $user->getUserById($this->_userId);
    }

    public function setPictureId(int $id)
    {
        $this->_pictureId = $id;
    }

    public function getPictureId()
    {
        $picture = new PictureManager();
        return $picture->getPictureById($this->_pictureId);
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
        return date_format(date_create($this->_published), 'd/m/Y à H:i');
    }
}