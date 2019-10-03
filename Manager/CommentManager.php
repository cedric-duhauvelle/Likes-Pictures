<?php

namespace Manager;

use PDO;
use Model\Comment;
use Systeme\DataBase;

class CommentManager
{
    private $_db;

    public function __construct()
    {
        $db = new DataBase();
        $this->_db = $db->connect();
    }

    public function getCommentById(int $id)
    {
        $request = $this->_db->query('SELECT * FROM comment WHERE id = "'. $id .'"');

        return new Comment($request->fetch(PDO::FETCH_ASSOC));
    }

    public function getCommentByPicture($pictureId)
    {
        $comments = [];
        $request = $this->_db->query('SELECT * FROM comment WHERE picture = "'. $pictureId .'"');
        while ($data =  $request->fetch(PDO::FETCH_ASSOC)) {
            $comments[] = new Comment($data);
        }

        return $comments;
    }

    public function getCommentLast()
    {
        $request = $this->_db->query('SELECT * FROM comment ORDER BY published DESC');

        return new Comment($request->fetch(PDO::FETCH_ASSOC));
    }

    public function add($user, int $picture, $content)
    {
        $request = $this->_db->prepare('INSERT INTO comment(user, picture, content, published) VALUES (:user, :picture, :content, CURRENT_TIME)');
        $request->bindValue(':user', $user);
        $request->bindValue(':picture', $picture);
        $request->bindValue(':content', $content);
        $request->execute();
    }

    public function delete($id)
    {
        $req = $this->_db->prepare('DELETE FROM comment WHERE id=:id LIMIT 1');
        $req->bindValue(':id', $id);
        $req->execute();
    }
}