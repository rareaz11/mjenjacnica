<?php
class AppCore{
    protected static $dbObj;

    public static function getDB(){
        return self::$dbObj;
    }
    public function __construct()
    {
        $this->initDB();
        //router
        require_once('util/RequestHandler.class.php');
        RequestHandler::handle();
    }
    protected function initDB(){
        $localhost=$username=$password=$database='';
        require_once('config.inc.php');
        //create DB connection
        require_once('model/MySQLiDatabase.class.php');
        self::$dbObj=new MySQLiDatabase($localhost,$username,$password,$database);
        
        
    }
    public function handleException(Exception $e){
        $e->show();
    }
    
       
}

?>