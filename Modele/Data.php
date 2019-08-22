<?php
namespace Modele;

class Data
{

	protected $_db;
    protected $_responses;

    public function __construct(PDO $db)
    {
        $this->setDb($db);
    }
    
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    } 

    //Appel a la base de donnees
    public function callDisplay($table)
    {
        $resp = $this->_db->prepare('SELECT * FROM ' . $table);
        $resp->execute();
        $this->_responses = $resp->fetchAll();
        return $this->_responses;
    }  
}