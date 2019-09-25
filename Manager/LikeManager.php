<?php

namespace Manager;

use PDO;
use Systeme\Database;
use Model\Like;

class LikeManager
{
    private $_db;

    public function __construct()
    {
        $db = new DataBase();
        $this->_db = $db->connect();
    }

    public function add($element, $elementId, $user)
    {
        $request = $this->_db->prepare('INSERT INTO like_element(element, elementId, user, published) VALUES (:element, :elementId, :user, CURRENT_TIME)');
        $request->bindValue(':element', $element);
        $request->bindValue(':elementId', $elementId);
        $request->bindValue(':user', $user);
        $request->execute();
    }

    public function getLikes()
    {
        $likes = [];
        $request = $this->_db->query('SELECT * FROM like_element');
        while ($data = $request->fetch(PDO::FETCH_ASSOC)) {
            $likes[] = new Like($data);
        }
        return $likes;
    }

    public function getLikesByElementId($id, $element)
    {
        $likes = [];
        $request = $this->_db->query('SELECT * FROM like_element WHERE elementId = '. $id . ' AND element="' . $element . '"');
        while ($data = $request->fetch(PDO::FETCH_ASSOC)) {
            $likes[] = new Like($data);
        }

        return $likes;
    }

    public function getLikesNumberByElementId($elementId, $element)
    {
        $query = $this->_db->query('SELECT COUNT(*) FROM like_element WHERE elementId=' . $elementId . ' AND element="' . $element .'"');
        $likeNumber = $query->fetch(PDO::FETCH_ASSOC);
        return $likeNumber['COUNT(*)'];
    }

    //Efface un like
    public function delete($id)
    {
        $req = $this->_db->prepare('DELETE FROM like_element WHERE id=:id LIMIT 1');
        $req->bindValue(':id', $id);
        $req->execute();
    }
}