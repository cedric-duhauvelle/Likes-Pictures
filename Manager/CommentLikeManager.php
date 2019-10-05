<?php

namespace Manager;

use PDO;
use Systeme\Database;
use Model\CommentLike;

class CommentLikeManager
{
    private $_db;

    public function __construct()
    {
        $db = new DataBase();
        $this->_db = $db->connect();
    }

    public function add($commentId, $userId)
    {
        $request = $this->_db->prepare('INSERT INTO comment_like(comment_id, user_id, published) VALUES (:comment_id, :user_id, CURRENT_TIME)');
        $request->bindValue(':comment_id', $commentId);
        $request->bindValue(':user_id', $userId);
        $request->execute();
    }

    public function getCommentsLikes()
    {
        $comments = [];
        $request = $this->_db->query('SELECT * FROM comment_like');
        while ($data = $request->fetch(PDO::FETCH_ASSOC)) {
            $comments[] = new CommentLike($data);
        }

        return $comments;
    }

    public function getCommentsLikesByCommentId($commentId)
    {
        $comments = [];
        $request = $this->_db->query('SELECT * FROM comment_like WHERE comment_id ="'. $commentId . '"');
        while ($data = $request->fetch(PDO::FETCH_ASSOC)) {
            $comments[] = new CommentLike($data);
        }

        return $comments;
    }

    public function getCommentsLikesNumberByCommentId($commentId)
    {
        $query = $this->_db->query('SELECT COUNT(*) FROM comment_like WHERE comment_id="' . $commentId . '"');
        $likeNumber = $query->fetch(PDO::FETCH_ASSOC);

        return $likeNumber['COUNT(*)'];
    }

    //Efface un like
    public function delete($id)
    {
        $req = $this->_db->prepare('DELETE FROM comment_like WHERE comment_like_id=:id LIMIT 1');
        $req->bindValue(':id', $id);
        $req->execute();
    }
}