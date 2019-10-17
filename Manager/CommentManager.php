<?php

namespace Manager;

use PDO;
use Model\Comment;
use Systeme\DataBase;

/**
 * Gere les appelles a la base de donnee pour les commentaires
 */
class CommentManager
{
    private $_db;

    public function __construct()
    {
        $db = new DataBase();
        $this->_db = $db->connect();
    }

    /**
     * Retourne un commentaire par son ID
     *
     * @return  object
     */
    public function getCommentById(int $id)
    {
        $query = $this->_db->query('SELECT * FROM comment WHERE comment_id ="'. $id . '"');

        return new Comment($query->fetch(PDO::FETCH_ASSOC));
    }

    /**
     * Retourne les commentaires d une photo par son ID
     *
     * @return array
     */
    public function getCommentByPictureId($pictureId)
    {
        $comments = [];
        $query = $this->_db->query('SELECT * FROM comment WHERE picture_id = "'. $pictureId .'"');
        while ($data =  $query->fetch(PDO::FETCH_ASSOC)) {
            $comments[] = new Comment($data);
        }

        return $comments;
    }

    /**
     * Retourne le dernier Commentaire
     *
     * @return object
     */
    public function getCommentLast()
    {
        $query = $this->_db->query('SELECT * FROM comment ORDER BY published DESC');

        return new Comment($query->fetch(PDO::FETCH_ASSOC));
    }

    /**
     * Ajoute un commenteire a la base de donnee
     */
    public function add($userId, int $pictureId, $content)
    {
        $query = $this->_db->prepare('INSERT INTO comment(user_id, picture_id, content, published) VALUES (:user_id, :picture_id, :content, CURRENT_TIME)');
        $query->bindValue(':user_id', $userId);
        $query->bindValue(':picture_id', $pictureId);
        $query->bindValue(':content', $content);
        $query->execute();
    }

    /**
     * Efface un commentaire par son ID
     */
    public function delete(int $id)
    {
        $query = $this->_db->prepare('DELETE FROM comment WHERE comment_id=:id LIMIT 1');
        $query->bindValue(':id', $id);
        $query->execute();
    }
}