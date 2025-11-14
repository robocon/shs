<?php
require_once dirname(__FILE__).'/database.php';

class Runno extends DbConnect{
    public $dbi = null;
    function __construct()
    {
        parent::__construct();
    }

    public function getRunno($name){
        $sql = sprintf("SELECT `runno` FROM `runno` WHERE `title` = '%s' LIMIT 1", $this->dbi->real_escape_string($name));
        $q = $this->dbi->query($sql);
        $runno = 0;
        if($q->num_rows){
            $r = $q->fetch_assoc();
            $runno = intval($r['runno'])+1;
        }
        return $runno;
    }

    public $nextRunno = 0;
    public function setNextRunno(){
        $sql = sprintf("UPDATE `runno` SET `runno`='%s', `startday`=NOW() WHERE `title`='diabetes' LIMIT 1;", $this->nextRunno);
        $q = $this->dbi->query($sql);
        return $q;
    }
}