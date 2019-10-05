<?php

namespace Manager;

use PDO;
use Systeme\Database;
use Model\PictureLike;

class PictureLikeManager
{
    private $_db;

    public function __construct()
    {
        $db = new DataBase();
        $this->_db = $db->connect();
    }

    public function add($pictureId, $userId)
    {
        $request = $this->_db->prepare('INSERT INTO picture_like(picture_id, user_id, published) VALUES (:picture_id, :user_id, CURRENT_TIME)');
        $request->bindValue(':picture_id', $pictureId);
        $request->bindValue(':user_id', $userId);
        $request->execute();
    }

    public function getPicturesLikes()
    {
        $likes = [];
        $request = $this->_db->query('SELECT * FROM picture_like');
        while ($data = $request->fetch(PDO::FETCH_ASSOC)) {
            $likes[] = new PictureLike($data);
        }
        return $likes;
    }

    public function getPicturesLikesByPictureId($pictureId)
    {
        $likes = [];
        $request = $this->_db->query('SELECT * FROM picture_like WHERE picture_id ="'. $pictureId . '"');
        while ($data = $request->fetch(PDO::FETCH_ASSOC)) {
            $likes[] = new PictureLike($data);
        }

        return $likes;
    }

    public function getPicturesLikesNumberByPictureId($pictureId)
    {
        $query = $this->_db->query('SELECT COUNT(*) FROM picture_like WHERE picture_id="' . $pictureId . '"');
        $likeNumber = $query->fetch(PDO::FETCH_ASSOC);
        return $likeNumber['COUNT(*)'];
    }

    //Efface un like
    public function delete($id)
    {
        $req = $this->_db->prepare('DELETE FROM picture_like WHERE picture_like_id=:id LIMIT 1');
        $req->bindValue(':id', $id);
        $req->execute();
    }
}