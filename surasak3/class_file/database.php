<?php
require_once '../bootstrap.php';
class DbConnect{ 
    public $dbi;
    public function __construct()
    {
        $this->dbi = new mysqli(HOST,USER,PASS,DB);
        if ($this->dbi->connect_errno) {
            var_dump($this->dbi->error);
            exit;
        }
        $this->dbi->query("SET NAMES UTF8");
        return $this->dbi;
    }

}