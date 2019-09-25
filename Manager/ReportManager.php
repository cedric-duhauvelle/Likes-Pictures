<?php

namespace Manager;

use PDO;
use Systeme\DataBase;
use Model\Report;

class ReportManager
{
    private $_db;

    public function __construct()
    {
        $db = new DataBase();
        $this->_db = $db->connect();
    }

    public function add($element, $elementId, $user)
    {
        $request = $this->_db->prepare('INSERT INTO report(element, elementId, user, published) VALUES (:element, :elementId, :user, CURRENT_TIME)');
        $request->bindValue(':element', $element);
        $request->bindValue(':elementId', $elementId);
        $request->bindValue(':user', $user);
        $request->execute();
    }

    public function delete($id)
    {
        $req = $this->_db->prepare('DELETE FROM report WHERE id=:id LIMIT 1');
        $req->bindValue(':id', $id);
        $req->execute();
    }

    public function getReportsByElementId($id, $element)
    {
        $reports = [];
        $request = $this->_db->query('SELECT * FROM report WHERE elementId = '. $id . ' AND element="' . $element . '"');
        while ($data = $request->fetch(PDO::FETCH_ASSOC)) {
            $reports[] = new Report($data);
        }

        return $reports;
    }

    public function getReportsNumberByElementId($elementId, $element)
    {
        $query = $this->_db->query('SELECT COUNT(*) FROM report WHERE elementId=' . $elementId . ' AND element="' . $element .'"');
        $likeNumber = $query->fetch(PDO::FETCH_ASSOC);
        return $likeNumber['COUNT(*)'];
    }

}