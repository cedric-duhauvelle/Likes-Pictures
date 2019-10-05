<?php

namespace Manager;

use PDO;
use Systeme\DataBase;
use Model\CommentReport;

class CommentReportManager
{
    private $_db;

    public function __construct()
    {
        $db = new DataBase();
        $this->_db = $db->connect();
    }

    public function add($commentId, $userId)
    {
        $request = $this->_db->prepare('INSERT INTO comment_report(comment_id, user_id, published) VALUES (:comment_id, :user_id, CURRENT_TIME)');
        $request->bindValue(':comment_id', $commentId);
        $request->bindValue(':user_id', $userId);
        $request->execute();
    }

    public function delete($id)
    {
        $req = $this->_db->prepare('DELETE FROM comment_report WHERE comment_report_id=:id LIMIT 1');
        $req->bindValue(':id', $id);
        $req->execute();
    }

    public function getCommentsReportsByCommentId($commentId)
    {
        $reports = [];
        $request = $this->_db->query('SELECT * FROM comment_report WHERE comment_id ="' . $commentId . '"');
        while ($data = $request->fetch(PDO::FETCH_ASSOC)) {
            $reports[] = new CommentReport($data);
        }

        return $reports;
    }

    public function getCommentsReportsNumberByCommentId($commentId)
    {
        $query = $this->_db->query('SELECT COUNT(*) FROM comment_report WHERE comment_id="' . $commentId . '"');
        $reportNumber = $query->fetch(PDO::FETCH_ASSOC);
        return $reportNumber['COUNT(*)'];
    }
}