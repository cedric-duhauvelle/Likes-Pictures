<?php

namespace Manager;

use PDO;
use Systeme\DataBase;
use Model\PictureLike;

/**
 * Gere les appelles a la base de donnee pour les likes des photos
 */
class PictureLikeManager
{
    private $_db;

    public function __construct()
    {
        $db = new DataBase();
        $this->_db = $db->connect();
    }

    /**
     * Ajout un like d une photo a la base de donnee
     */
    public function add($pictureId, $userId)
    {
        $query = $this->_db->prepare('INSERT INTO picture_like(picture_id, user_id, published) VALUES (:picture_id, :user_id, CURRENT_TIME)');
        $query->bindValue(':picture_id', $pictureId);
        $query->bindValue(':user_id', $userId);
        $query->execute();
    }

    /**
     * Retourne les likes des photos
     *
     * @return array
     */
    public function getPicturesLikes()
    {
        $likes = [];
        $query = $this->_db->query('SELECT * FROM picture_like');
        while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
            $likes[] = new PictureLike($data);
        }
        return $likes;
    }

    /**
     * Retourne les likes d une photo par son ID
     *
     * @return array
     */
    public function getPicturesLikesByPictureId($pictureId)
    {
        $likes = [];
        $query = $this->_db->query('SELECT * FROM picture_like WHERE picture_id ="'. $pictureId . '"');
        while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
            $likes[] = new PictureLike($data);
        }

        return $likes;
    }

    /**
     * Retourne le nombre de likes sur une photos par son ID
     *
     * @return int
     */
    public function getPicturesLikesNumberByPictureId($pictureId)
    {
        $query = $this->_db->query('SELECT COUNT(*) FROM picture_like WHERE picture_id="' . $pictureId . '"');
        $likeNumber = $query->fetch(PDO::FETCH_ASSOC);
        return $likeNumber['COUNT(*)'];
    }

    /**
     * Efface un like sur une photo par son ID
     */
    public function delete($id)
    {
        $req = $this->_db->prepare('DELETE FROM picture_like WHERE picture_like_id=:id LIMIT 1');
        $req->bindValue(':id', $id);
        $req->execute();
    }
}