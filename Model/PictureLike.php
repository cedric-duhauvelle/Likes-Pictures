<?php

namespace Model;

use Manager\UserManager;
use Manager\PictureManager;

/**
 * Entity PictureLike
 */
class PictureLike
{
    private $_pictureLikeId;
    private $_pictureId;
    private $_userId;
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
                if (array_key_exists(2, $arrayKey)) {
                    $key = $arrayKey[0] . ucfirst($arrayKey[1]) . ucfirst($arrayKey[2]);
                }
            }
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function setPictureLikeId(int $id)
    {
        $this->_pictureLikeId = $id;
    }

    public function getPictureLikeId()
    {
        return $this->_pictureLikeId;
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

    public function setUserId(int $userId)
    {
        $this->_userId = $userId;
    }

    public function getUserId()
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