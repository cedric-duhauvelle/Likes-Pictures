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
        $query = $this->_db->query('SELECT * FROM picture WHERE picture_id = "'. $id .'"');

        return new Picture($query->fetch(PDO::FETCH_ASSOC));
    }

    /**
     * Retourne tous les images
     *
     * @return array
     */
    public function getPictures()
    {
        $pictures = [];
        $query = $this->_db->query('SELECT * FROM picture');
        while ($data =  $query->fetch(PDO::FETCH_ASSOC)) {
           $pictures[] = new Picture($data);
        }

        return $pictures;
    }

    /**
     * Retourne les photos a partir du dernier ajout
     *
     * @return array
     */
    public function getLastPictures($start, $numberPicture)
    {
        $pictures = [];
        $query = $this->_db->query('SELECT * FROM picture ORDER BY upload DESC LIMIT ' . $start . ',' .$numberPicture);
        while ($data =  $query->fetch(PDO::FETCH_ASSOC)) {
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
        $query = $this->_db->query('SELECT * FROM picture WHERE user_id = '. $userId);
        while ($data =  $query->fetch(PDO::FETCH_ASSOC)) {
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
            $query = $this->_db->prepare('INSERT INTO picture(user_id, title, upload) VALUES (:user_id, :title, CURRENT_TIME)');
            $query->bindValue(':user_id', $user);
            $query->bindValue(':title', $title);
            $query->execute();
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
        $query = $this->_db->query('SELECT * FROM picture ORDER BY picture_id DESC LIMIT 1');

        return new Picture($query->fetch(PDO::FETCH_ASSOC));
    }

    /**
     * Retourne le nombre de photos
     *
     * @return int
     */
    public function getPicturesNumber()
    {
        $query = $this->_db->query('SELECT COUNT(*) FROM picture');
        $pictureNumber = $query->fetch(PDO::FETCH_ASSOC);

        return $pictureNumber['COUNT(*)'];
    }

    /**
     * Efface une photo par son ID
     */
    public function delete($id)
    {
        $query = $this->_db->prepare('DELETE FROM picture WHERE picture_id=:id LIMIT 1');
        $query->bindValue(':id', $id);
        $query->execute();
    }
}