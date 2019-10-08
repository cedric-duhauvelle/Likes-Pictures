<?php

namespace Manager;

use PDO;
use Systeme\DataBase;
use Model\PictureReport;

/**
 * Gere les appelles a la base de donnee pour les signalements des photos
 */
class PictureReportManager
{
    private $_db;

    public function __construct()
    {
        $db = new DataBase();
        $this->_db = $db->connect();
    }

    /**
     * Ajoute un signalement d'une photo a la base de donnee
     */
    public function add($pictureId, $userId)
    {
        $request = $this->_db->prepare('INSERT INTO picture_report(picture_id, user_id, published) VALUES (:picture_id, :user_id, CURRENT_TIME)');
        $request->bindValue(':picture_id', $pictureId);
        $request->bindValue(':user_id', $userId);
        $request->execute();
    }

    /**
     * Efface un signalement d une photo par son ID
     */
    public function delete($id)
    {
        $req = $this->_db->prepare('DELETE FROM picture_report WHERE picture_report_id=:id LIMIT 1');
        $req->bindValue(':id', $id);
        $req->execute();
    }

    /**
     * Retourne les signalements d une photo par son ID
     *
     * @return array
     */
    public function getPicturesReportsByPictureId($pictureId)
    {
        $reports = [];
        $request = $this->_db->query('SELECT * FROM picture_report WHERE picture_id ="' . $pictureId . '"');
        while ($data = $request->fetch(PDO::FETCH_ASSOC)) {
            $reports[] = new PictureReport($data);
        }

        return $reports;
    }

    /**
     * Retourne les signalements des photos
     *
     * @return array
     */
    public function getPicturesReports()
    {
        $reports = [];
        $request = $this->_db->query('SELECT * FROM picture_report');
        while ($data = $request->fetch(PDO::FETCH_ASSOC)) {
            $reports[] = new PictureReport($data);
        }

        return $reports;
    }

    /**
     * Retourne le nombre de signalements d une photo par son ID
     */
    public function getPicturesReportsNumberByPictureId($pictureId)
    {
        $query = $this->_db->query('SELECT COUNT(*) FROM picture_report WHERE picture_id="' . $pictureId . '"');
        $reportNumber = $query->fetch(PDO::FETCH_ASSOC);
        return $reportNumber['COUNT(*)'];
    }
}