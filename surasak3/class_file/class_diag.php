<?php
require_once dirname(__FILE__).'/database.php';

class Diag extends DbConnect{
    public $dbi = null;
    function __construct()
    {
        parent::__construct();
    }

    public function getDiagI10FromHnForBasicOpd($hn){
        $hn = sprintf("%s", $hn);
        $sql = sprintf("SELECT * FROM `diag` WHERE `hn` = '%s' AND `icd10` = 'I10' AND `status` = 'Y' ORDER BY `row_id` DESC LIMIT 5", $this->dbi->real_escape_string($hn));
        $q = $this->dbi->query($sql);
        if($q->num_rows>0){
            while ($a = $q->fetch_assoc()) {
                $items[] = $a;
            }
        }else{
            $items[] = array('error_code'=>400, 'error'=>$this->dbi->error, 'message'=>'ไม่พบข้อมูล');
        }
        return $items;
    }
}