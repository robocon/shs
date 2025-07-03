<?php
require_once dirname(__FILE__).'/database.php';

class Ipcard extends DbConnect{
    public $dbi = null;
    function __construct()
    {
        parent::__construct();
    }

    function getIpcard($an = null){
        if(empty($an)){
            return "Invalid AN";
        }
        $sql = sprintf("SELECT * FROM `ipcard` WHERE `an` = '%s' ", $this->dbi->real_escape_string($an));
        $q = $this->__query($sql);
        if($q->num_rows>0){
            $res = $q->fetch_assoc();
        }else{
            $res = $this->dbError();
        }
        return $res;
    }
}