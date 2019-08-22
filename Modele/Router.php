<?php
namespace Modele;

use Modele\Data;

class Router extends Data
{ 

    public function __construct($db)
    {
        return $this->_db = $db;
    }
    
    //Nettoyeur de tableau
    public function cleanArray($array)
    {
        return isset($array) ? filter_var_array($array, FILTER_SANITIZE_STRING) : null;
    }
    
    //Recupere url
    public function setUrl($url)
    {
        $this->route($url);
    }

    //Redection vers la page souhaitee
    private function route($page)
    {  
        //Redirection vers les controllers
        if (strpos($page, 'Controller') && is_file('../Controller/' . $page . '.php')) {
            require_once '../Controller/' . $page . '.php';
        //Redirection vers les templates
        } elseif (is_file('../View/' . $page . '.php')) {               
            require_once '../Controller/PageController.php';
        } else {
            new Exception("Page introuvable", 404);  
        }
    }
}