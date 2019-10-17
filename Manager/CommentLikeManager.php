<?php

namespace Manager;

use PDO;
use Systeme\DataBase;
use Model\CommentLike;

/**
 * Gere les appelles a la base de donnee pour les likes sur les commentaires
 */
class CommentLikeManager
{
    private $_db;

    public function __construct()
    {
        $db = new DataBase();
        $this->_db = $db->connect();
    }

    /**
     * Ajoute un like sur un commentaire dans la base de donnee
     */
    public function add($commentId, $userId)
    {
        $query = $this->_db->prepare('INSERT INTO comment_like(comment_id, user_id, published) VALUES (:comment_id, :user_id, CURRENT_TIME)');
        $query->bindValue(':comment_id', $commentId);
        $query->bindValue(':user_id', $userId);
        $query->execute();
    }

    /**
     * Retourne tous les likes sur les commentaires
     *
     * @return array
     */
    public function getCommentsLikes()
    {
        $comments = [];
        $query = $this->_db->query('SELECT * FROM comment_like');
        while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
            $comments[] = new CommentLike($data);
        }

        return $comments;
    }

    /**
     * Retourne les likes d un commentaire par sont ID
     *
     * @return array
     */
    public function getCommentsLikesByCommentId($commentId)
    {
        $comments = [];
        $query = $this->_db->query('SELECT * FROM comment_like WHERE comment_id ="'. $commentId . '"');
        while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
            $comments[] = new CommentLike($data);
        }

        return $comments;
    }

     /**
     * Retourne le nombre de likes d un commentaire par son ID
     *
     * @return array
     */
    public function getCommentsLikesNumberByCommentId($commentId)
    {
        $query = $this->_db->query('SELECT COUNT(*) FROM comment_like WHERE comment_id="' . $commentId . '"');
        $likeNumber = $query->fetch(PDO::FETCH_ASSOC);

        return $likeNumber['COUNT(*)'];
    }

     /**
     * Efface un like par son ID
     */
    public function delete($id)
    {
        $query = $this->_db->prepare('DELETE FROM comment_like WHERE comment_like_id=:id LIMIT 1');
        $query->bindValue(':id', $id);
        $query->execute();
    }
}