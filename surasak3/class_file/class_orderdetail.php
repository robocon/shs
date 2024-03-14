<?php 
require_once dirname(__FILE__).'/database.php';

class Class_Orderdetail extends DbConnect
{
    public $dbi = null;
    function __construct()
    {
        parent::__construct();
    }
    public function insertOrderdetail($data){ 

        $labitems = $data['labitems'];

        foreach ($labitems as $labItem) {
            dump($labItem);
            // $info = $this->getLabinfo($labItem);
            // dump($info);
            # code...
        }
    

        // $orderdetail_sql = "INSERT INTO `orderdetail` ( 
        //     `labnumber`,`labcode`,`labcode1`,`labname` 
        // ) VALUES (
        //     '$labnumber', '$code', '$oldcode', '".$detail."'
        // );";
        // $this->dbi->query($orderdetail_sql);

        
        $res = [];
        return $res;


    }

    public function getLabinfo($code=''){
        $labcode = sprintf("%s", $code);
        $sqlLabcare = "SELECT `code`,`oldcode`,`detail`,`price`,`yprice`,`nprice`,`depart`,`part` FROM `labcare` WHERE `code` = '$labcode' ";
        $q = $this->dbi->query($sqlLabcare);
        if($q->num_rows>0){
            $res = $q->fetch_assoc();
        }else{
            $res = "Not found : ".$this->dbi->error;
        }
        return $res;
    }
}