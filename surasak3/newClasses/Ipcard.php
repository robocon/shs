<?php
require_once dirname(__FILE__).'/database.php';

class Ipcard extends Database{
    public $dbi = null;
    function __construct()
    {
        parent::__construct();
    }

    function getIpcard($an = ''){
        if(empty($an)){
            return "Invalid AN";
        }
        $sql = sprintf("SELECT * FROM `ipcard` WHERE `an` = '%s' LIMIT 1;", $this->dbi->real_escape_string($an));
        $q = $this->dbi->query($sql);
        if($q->num_rows>0){
            $res = $q->fetch_assoc();
        }else{
            $res = false;
        }
        return $res;
    }

    function getIpNotDc($an = ''){
        if(empty($an)){
            return "Invalid AN";
        }
        $sql = sprintf("SELECT * FROM `ipcard` WHERE `an` = '%s' AND `dcdate` = '0000-00-00 00:00:00' LIMIT 1; ", $this->dbi->real_escape_string($an));
        $q = $this->dbi->query($sql);
        if($q->num_rows>0){
            $res = $q->fetch_assoc();
        }else{
            $res = false;
        }
        return $res;
    }
}