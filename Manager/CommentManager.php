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
        $request = $this->_db->query('SELECT * FROM comment WHERE comment_id ="'. $id . '"');

        return new Comment($request->fetch(PDO::FETCH_ASSOC));
    }

    /**
     * Retourne les commentaires d une photo par son ID
     *
     * @return array
     */
    public function getCommentByPicture($pictureId)
    {
        $comments = [];
        $request = $this->_db->query('SELECT * FROM comment WHERE picture_id = "'. $pictureId .'"');
        while ($data =  $request->fetch(PDO::FETCH_ASSOC)) {
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
        $request = $this->_db->query('SELECT * FROM comment ORDER BY published DESC');

        return new Comment($request->fetch(PDO::FETCH_ASSOC));
    }

    /**
     * Ajoute un commenteire a la base de donnee
     */
    public function add($userId, int $pictureId, $content)
    {
        $request = $this->_db->prepare('INSERT INTO comment(user_id, picture_id, content, published) VALUES (:user_id, :picture_id, :content, CURRENT_TIME)');
        $request->bindValue(':user_id', $userId);
        $request->bindValue(':picture_id', $pictureId);
        $request->bindValue(':content', $content);
        $request->execute();
    }

    /**
     * Efface un commentaire par son ID
     */
    public function delete($id)
    {
        $req = $this->_db->prepare('DELETE FROM comment WHERE comment_id=:id LIMIT 1');
        $req->bindValue(':id', $id);
        $req->execute();
    }
}