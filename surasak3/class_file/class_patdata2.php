<?php 
require_once dirname(__FILE__).'/class_opcard.php';
require_once dirname(__FILE__).'/class_opday.php';
require_once dirname(__FILE__).'/class_depart.php';

class ClassPatdata extends ClassDepart
{
    public function __construct()
    {
        parent::__construct();
    }

    public function __singleQuery($sql){
        $q = $this->dbi->query($sql);
        if($q->num_rows>0){
            $res = $q->fetch_assoc();
        }else{
            $msg = $this->dbi->error ? $this->dbi->error : 'can not find data' ;
            $res = array('error'=>true, 'msg'=>$msg);
        }
        return $res;
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

    /**
     * @param string $id row_id
     * @return array $res result from patdata
     */
    public function getPatdataFromId($id=null){
        if(empty($id)){
            return array('error'=>true, 'msg'=>'Required id');
        }

        return $this->__singleQuery("SELECT * FROM patdata WHERE row_id = '$id'");
    }
    

    public function getDataFromIdnoAndCode($idno=null, $code=null, $fieldSelect=null){
        if(empty($idno) OR empty($code)){
            return array('error'=>true, 'msg'=>'Required idno and code');
        }

        $field = '*';
        if (!empty($fieldSelect)) {
            $field = implode(',', $fieldSelect);
        }

        return $this->__singleQuery("SELECT $field FROM patdata WHERE idno='$idno' AND code='$code' ");
    }

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

        $dep = $this->getDepartFromId($departId);
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
        foreach ($labItems AS $key => $labCode) { 
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
                    '$detail', '1', '$price', '$yprice', '$nprice', '$depart', 
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

    /**
     * @param array $dataList ข้อมูลที่จะอัพเดทใส่มาเป็น key => value
     * @param string $id primary key ของ patdata
     */
    public function updatePatdata($dataList=array(), $id=null){

        $updateList = array_map(array($this, 'mapUpdate'), array_keys($dataList), array_values($dataList));
        $updateTxt = implode(', ', $updateList);

        $sqlUpdatePatdata = "UPDATE `patdata` SET $updateTxt WHERE `row_id` = '$id' ";
        $save = $this->dbi->query($sqlUpdatePatdata);
        if ($this->dbi->error) {
            return $this->dbi->error.' : '.$sqlUpdatePatdata;
        }else{
            return $save;
        }

    }

}