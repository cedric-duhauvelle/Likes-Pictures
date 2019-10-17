<?php

namespace Manager;

use PDO;
use Systeme\DataBase;
use Model\CommentReport;

/**
 * Gere les appelles a la base de donnee pour les signalement des commentaires
 */
class CommentReportManager
{
    private $_db;

    public function __construct()
    {
        $db = new DataBase();
        $this->_db = $db->connect();
    }

    /**
     * Ajout un signalement
     */
    public function add($commentId, $userId)
    {
        $query = $this->_db->prepare('INSERT INTO comment_report(comment_id, user_id, published) VALUES (:comment_id, :user_id, CURRENT_TIME)');
        $query->bindValue(':comment_id', $commentId);
        $query->bindValue(':user_id', $userId);
        $query->execute();
    }

    /**
     * Efface un signalement par son ID
     */
    public function delete($id)
    {
        $query = $this->_db->prepare('DELETE FROM comment_report WHERE comment_report_id=:id LIMIT 1');
        $query->bindValue(':id', $id);
        $query->execute();
    }

    /**
     * Retourne les signalement sur les commentaires
     *
     * @return array
     */
    public function getCommentsReports()
    {
        $reports = [];
        $query = $this->_db->query('SELECT * FROM comment_report');
        while ($data = $queryt->fetch(PDO::FETCH_ASSOC)) {
            $reports[] = new CommentReport($data);
        }

        return $reports;
    }

    /**
     * Retourne les signalements d un commentaire par son ID
     *
     * @return array
     */
    public function getCommentsReportsByCommentId($commentId)
    {
        $reports = [];
        $query = $this->_db->query('SELECT * FROM comment_report WHERE comment_id ="' . $commentId . '"');
        while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
            $reports[] = new CommentReport($data);
        }

        return $reports;
    }

    /**
     * Retourne le nombre de siganlement sur un commentaire par son ID
     *
     * @return int
     */
    public function getCommentsReportsNumberByCommentId($commentId)
    {
        $query = $this->_db->query('SELECT COUNT(*) FROM comment_report WHERE comment_id="' . $commentId . '"');
        $reportNumber = $query->fetch(PDO::FETCH_ASSOC);
        return $reportNumber['COUNT(*)'];
    }
}