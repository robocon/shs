<?php
require_once dirname(__FILE__).'/database.php';

class Hypertension extends DbConnect{
    public $dbi = null;
    function __construct()
    {
        parent::__construct();
    }
    function getData($hn){
        $hn = sprintf("%s", $hn);
        $q = $this->dbi->query(sprintf("SELECT * FROM `hypertension_clinic` WHERE `hn` = '$hn' LIMIT 1",$this->dbi->real_escape_string($hn)));
        if($q->num_rows>0){
            $res = $q->fetch_assoc();
        }else{
            $res = array('error_code'=>400, 'error'=>$this->dbi->error, 'message'=>'ไม่พบข้อมูล');
        }
        return $res;
    }
}