<?php 
require_once dirname(__FILE__).'/database.php';
require_once dirname(__FILE__).'/class_drug.php';

class Dgprofile extends Drug{
    public $dbi = null;
    private $dateTh = null;
    public function __construct()
    {
        parent::__construct();
        $this->dateTh = (date('Y')+543).date('-m-d');
    }

    public function updateAmount($id, $amount){
        
        if(empty($id) || empty($amount)){
            return false;
        }

        $sql = sprintf("UPDATE `dgprofile` SET `amount` = '%s' WHERE `row_id` = '%s'", 
            $this->dbi->real_escape_string($amount), 
            $this->dbi->real_escape_string($id)
        );
        $q = $this->dbi->query($sql);
        if($q){
            return true;
        }else{
            return $this->dbError();
        }
    }

    public function updateSlcode($id, $slcode){
        
        if(empty($id) || empty($slcode)){
            return false;
        }

        $q = $this->dbi->query(sprintf("UPDATE `dgprofile` SET `slcode` = '%s' WHERE `row_id` = '%s'", 
            $this->dbi->real_escape_string($slcode), 
            $this->dbi->real_escape_string($id))
        );

        if($q){
            return true;
        }else{
            return $this->dbError();
        }
    }
}