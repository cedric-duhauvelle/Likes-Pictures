<?php

namespace Manager;

use PDO;
use Model\Pictures;

class PictureManager
{
    private $_db;

    public function __construct(PDO $db)
    {
        $this->setDb($db);
    }

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }

    //retourne tous les images
    public function getPictures()
    {
        $pictures = [];
        $q = $this->_db->query('SELECT * FROM users');
        while ($data =  $q->fetch(PDO::FETCH_ASSOC)) {
           $pictures[] = new Picture($data);
        }
        return $pictures;
    }

    public function add($db, $file, $route, $name, $id)
    {
        $this->insertDatabase($db, $id, $name);
        $idPicture = $this->recoverId($db, $id);
        var_dump($idPicture);
        move_uploaded_file($_FILES[$file]['tmp_name'], $route . $name . $idPicture);
    }

    public function recoverId($db, $idUser)
    {
        $data = new DataRecover($db);
        return $data->returnData('picture', 'user', $idUser, 'id');
    }

    public function insertDatabase($db, $id, $title)
    {
        $data = new DataInsert($db);
        $data->picture($id, $title);
    }

    public function displayGalerie($db)
    {

    }
}