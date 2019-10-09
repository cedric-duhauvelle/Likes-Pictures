<?php

namespace Model;

use Manager\UserManager;

/**
 *
 */
class Picture
{
    private $_pictureId;
    private $_userId;
    private $_title;
    private $_upload;

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

    public function setPictureId(int $id)
    {
        $this->_pictureId = $id;
    }

    public function getPictureId()
    {
        return $this->_pictureId;
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

    public function setTitle($title)
    {
        $this->_title = $title;
    }

    public function getTitle()
    {
        return $this->_title;
    }

    public function setUpload($date)
    {
        $this->_upload = $date;
    }

    public function getUpload()
    {
        return date_format(date_create($this->_upload), 'd/m/Y à H:i');
    }
}