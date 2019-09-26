<?php

namespace Manager;

use PDO;
use Model\Picture;
use Systeme\DataBase;
use Manager\UserManager;

class PictureManager
{
    private $_db;

    public function __construct()
    {
        $db = new DataBase();
        $this->_db = $db->connect();
    }

    public function getPictureById($id)
    {
        $request = $this->_db->query('SELECT * FROM picture WHERE id = "'. $id .'"');

        return new Picture($request->fetch(PDO::FETCH_ASSOC));
    }

    //retourne tous les images
    public function getPictures()
    {
        $pictures = [];
        $q = $this->_db->query('SELECT * FROM picture');
        while ($data =  $q->fetch(PDO::FETCH_ASSOC)) {
           $pictures[] = new Picture($data);
        }
        return $pictures;
    }

    //retourne les images a partir du dernier ajout
    public function getLastPictures()
    {
        $pictures = [];
        $q = $this->_db->query('SELECT * FROM picture ORDER BY upload DESC');
        while ($data =  $q->fetch(PDO::FETCH_ASSOC)) {
           $pictures[] = new Picture($data);
        }
        return $pictures;
    }

    //retourne toutes les images d'un utilisateur
    public function getPicturesByUser($id)
    {
        $pictures = [];
        $q = $this->_db->query('SELECT * FROM picture WHERE user = '. $id);
        while ($data =  $q->fetch(PDO::FETCH_ASSOC)) {
           $pictures[] = new Picture($data);
        }
        return $pictures;
    }

    public function add($file, $route, $title, $user)
    {
        $pictureId = $user;
        if ('upload_picture' === $file) {
            $req = $this->_db->prepare('INSERT INTO picture(user, title, upload) VALUES (:user, :title, CURRENT_TIME)');
            $req->bindValue(':user', $user);
            $req->bindValue(':title', $title);
            $req->execute();
            $picture = $this->returnLastData();
            $pictureId = $picture->getId();
        }

        move_uploaded_file($_FILES[$file]['tmp_name'], $route . $title . $pictureId . '.jpg');
    }

    //return donnee image
    public function returnLastData()
    {
        $resp = $this->_db->query('SELECT * FROM picture ORDER BY id DESC LIMIT 1');

        return new Picture($resp->fetch(PDO::FETCH_ASSOC));
    }

    public function delete($id)
    {
        $req = $this->_db->prepare('DELETE FROM picture WHERE id=:id LIMIT 1');
        $req->bindValue(':id', $id);
        $req->execute();
    }
}