<?php
//ini_set('display_errors', 1);
Class DB
{    
    private $host;
    private $user;
    private $pswd;
    private $dbname;
    
    function __construct($host, $user, $pswd, $dbname) {
        $this->host = $host;
        $this->user = $user;
        $this->pswd = $pswd;
        $this->dbname = $dbname;
    }
    
    // Setters
    
    public function setHost($host) {
        $this->host = $host;
    }
    
    public function setUser($user) {
        $this->user = $user;
    }
    
    public function setPassword($pswd) {
        $this->pswd = $pswd;
    }
    
    public function setDbname($dbname) {
        $this->dbname = $dbname;
    }
    
    // Getters
    
    public function getHost() {
        return $this->host;
    }
    
    public function getUser() {
        return $this->user;
    }
    
    public function getPassword() {
        return $this->pswd;
    }
    
    public function getDbname() {
        return $this->dbname;
    }
}



?>


