<?php

namespace Model;

class Picture
{
    private $_id;
    private $_user;
    private $_title;
    private $_upload;

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
        if ($id > 0) {
            $this->_id = $id;
        }
    }

    public function getId()
    {
        return $this->_id;
    }

    public function setUser(int $id)
    {
        if ($id > 0) {
            $this->_user = $id;
        }
    }

    public function getUser()
    {
        return $this->_user;
    }

    public function setTitle(string $title)
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
        return $this->_upload;
    }
}