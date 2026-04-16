<?php
class Runno extends Database
{
    public $dbi = null;
    public $nextRunno = 0;
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
            $this->nextRunno = $runno = intval($r['runno'])+1;
        }
        return $runno;
    }
    
    public function setNextRunno(){
        $sql = sprintf("UPDATE `runno` SET `runno`='%s', `startday`=NOW() WHERE `title`='diabetes' LIMIT 1;", $this->nextRunno);
        $q = $this->dbi->query($sql);
        return $q;
    }
}