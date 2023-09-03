<?php 
require_once 'class_file/opcard.php';
require_once 'class_file/opday.php';

class ClassPatdata
{
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

    public function getThDateTime(){
        return (date('Y')+543).date('-m-d H:i:s');
    }

    public function getPatdata($idno=null){

        if ($idno===null) {
            return "idno is Require in patdata";
            exit;
        }

        $sql = "SELECT * FROM `patdata` WHERE `idno` = '$idno' ";
        $q = $this->dbi->query($sql);
        $items = array();
        if ($q->num_rows>0) {
            while ($a = $q->fetch_assoc()) {
                $items[] = $a;
            }
        }
        return $items;
    }

    public function getDepart($id=null){
        if($id===null){
            return "getDepart required id";
            exit;
        }

        $sql = "SELECT hn,ptname,ptright FROM depart WHERE row_id = '$id'";
        $q = $this->dbi->query($sql);
        $res = false;
        if($q->num_rows>0){
            $res = $q->fetch_assoc();
        }
        return $res;
    }

    public function insertOnlyPatdata(
        $departId=null, 
        $labItems=array()
    ){
        if ($departId===null or empty($labItems)) {
            return "Depart id and lab items is required";
            exit;
        }
        
        $dep = $this->getDepart($departId);
        $hn = $ptname = $ptright = '';
        if($dep!==false){
            $hn = $dep['hn'];
            $ptname = $dep['ptname'];
            $ptright = $dep['ptright'];
        }else{
            return "Can not find data from depart id";
            exit;
        }
        
        $thDateTime = $this->getThDateTime();
        $countItem = count($labItems);
        dump($labItems);

        $patdataSaveItem = array();
        foreach ($labItems as $labCode) { 

            $sqlLabcare = sprintf("SELECT `code`,`oldcode`,`detail`,`price`,`yprice`,`nprice`,`depart`,`part` FROM `labcare` WHERE `code` = '%s' ", $labCode);
            $q = $this->dbi->query($sqlLabcare);
            if ($q->num_rows > 0) { 

                $lab = $q->fetch_assoc();
                $code = $lab['code'];
                $detail = $lab['detail'];
                $price = $lab['price'];
                $nprice = $lab['nprice'];
                $yprice = $lab['yprice'];
                $depart = $lab['depart'];
                $part = $lab['part'];
                
                $sqlPatdata = "INSERT INTO `patdata` ( 
                    `date`, `hn`, `ptname`, `doctor`, `item`, `code`, 
                    `detail`, `amount`, `price`, `yprice`, `nprice`, `depart`, 
                    `part`, `idno`, `ptright`, `status` 
                ) VALUES ( 
                    '$thDateTime', '$hn', '$ptname', 'MD022 (ไม่ทราบแพทย์)', '$countItem', '$code', 
                    '$detail', '1', '$price', '$nprice', '$yprice', '$depart', 
                    '$part', '$departId', '$ptright', 'Y' 
                )";
                dump($sqlPatdata);
                $save = $this->dbi->query($sqlPatdata);
                $patdataId = $this->dbi->insert_id;
                $patdataSaveItem[] = $patdataId;
        // return $departId;
                dump($save);
            }
            
        }

        dump($patdataSaveItem);

        // $test = $this->getPrice($labItems);
        // dump($test);
    }
}