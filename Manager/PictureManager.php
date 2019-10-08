<?php

namespace Manager;

use PDO;
use Model\Picture;
use Systeme\DataBase;
use Manager\UserManager;

/**
 * Gere les appelles a la base de donnee des photos
 */
class PictureManager
{
    private $_db;

    public function __construct()
    {
        $db = new DataBase();
        $this->_db = $db->connect();
    }

    /**
     * Retourne un photo par son ID
     *
     * @return object
     */
    public function getPictureById($id)
    {
        $request = $this->_db->query('SELECT * FROM picture WHERE picture_id = "'. $id .'"');

        return new Picture($request->fetch(PDO::FETCH_ASSOC));
    }

    /**
     * Retourne tous les images
     *
     * @return array
     */
    public function getPictures()
    {
        $pictures = [];
        $q = $this->_db->query('SELECT * FROM picture');
        while ($data =  $q->fetch(PDO::FETCH_ASSOC)) {
           $pictures[] = new Picture($data);
        }

        return $pictures;
    }

    /**
     * Retourne les photos a partir du dernier ajout
     *
     * @return array
     */
    public function getLastPictures()
    {
        $pictures = [];
        $q = $this->_db->query('SELECT * FROM picture ORDER BY upload DESC');
        while ($data =  $q->fetch(PDO::FETCH_ASSOC)) {
           $pictures[] = new Picture($data);
        }

        return $pictures;
    }

    /**
     * Retourne toutes les images d'un utilisateur par son ID
     *
     * @return array
     */
    public function getPicturesByUser($userId)
    {
        $pictures = [];
        $q = $this->_db->query('SELECT * FROM picture WHERE user_id = '. $userId);
        while ($data =  $q->fetch(PDO::FETCH_ASSOC)) {
           $pictures[] = new Picture($data);
        }

        return $pictures;
    }

    /**
     * Ajoute une photo dans la base de donnee
     */
    public function add($file, $route, $title, $user)
    {
        $pictureId = $user;
        if ('upload_picture' === $file) {
            $req = $this->_db->prepare('INSERT INTO picture(user_id, title, upload) VALUES (:user_id, :title, CURRENT_TIME)');
            $req->bindValue(':user_id', $user);
            $req->bindValue(':title', $title);
            $req->execute();
            $picture = $this->getLastPicture();
            $pictureId = $picture->getPictureId();
        }

        move_uploaded_file($_FILES[$file]['tmp_name'], $route . $title . $pictureId . '.jpg');
    }

    /**
     * Retourne la derniere photo ajoutee
     *
     * @return object
     */
    public function getLastPicture()
    {
        $resp = $this->_db->query('SELECT * FROM picture ORDER BY picture_id DESC LIMIT 1');

        return new Picture($resp->fetch(PDO::FETCH_ASSOC));
    }

    /**
     * Efface une photo par son ID
     */
    public function delete($id)
    {
        $req = $this->_db->prepare('DELETE FROM picture WHERE picture_id=:id LIMIT 1');
        $req->bindValue(':id', $id);
        $req->execute();
    }
}