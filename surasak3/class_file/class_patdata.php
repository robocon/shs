<?php 
require_once 'class_file/opcard.php';
require_once 'class_file/opday.php';
require_once 'class_file/class_depart.php';

class ClassPatdata extends ClassDepart
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * ดึงค่า patdata จาก ฟิลด์ idno ซึ่ง idno มาจาก row_id ของตาราง depart
     * 
     * @param string @idno 
     * 
     * @return array @items
     */
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

    // public function getDepart($id=null){
    //     if($id===null){
    //         return "getDepart required id";
    //         exit;
    //     }

    //     $sql = "SELECT hn,ptname,ptright FROM depart WHERE row_id = '$id'";
    //     $q = $this->dbi->query($sql);
    //     $res = false;
    //     if($q->num_rows>0){
    //         $res = $q->fetch_assoc();
    //     }
    //     return $res;
    // }

    /**
     * เพิ่มข้อมูลใน patdata จาก depart
     */
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
                $save = $this->dbi->query($sqlPatdata);
                if($save!==false){
                    $patdataId = $this->dbi->insert_id;
                    $patdataSaveItem[] = $patdataId;
                }else{
                    $patdataSaveItem[] = $this->dbi->error;
                }

            } // end if
            
        } // end foreach

        return $patdataSaveItem;
    }
}