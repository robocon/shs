<?php 
class Patdata extends Database
{
    public $dbi;
    protected $depart;
    public function __construct()
    {
        parent::__construct();
        $this->depart = new Depart();
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
     * @param string    $departId   depart row_id
     * @param array     $labItems   รายการจาก labcare
     * @param string    $date       (Optional) วันที่เพิ่ม
     */
    public function insertOnlyPatdata(
        $departId='', 
        $labItems=array(),
        $date=''
    ){
        if (empty($departId) or empty($labItems)) {
            $this->setMsgError("Depart id and lab items is required");
            return false;
            exit;
        }

        $dep = $this->depart->getDepartFromId($departId);
        $hn = $ptname = $ptright = '';
        if($dep!==false){
            $hn = $dep['hn'];
            $ptname = $dep['ptname'];
            $ptright = $dep['ptright'];
        }else{
            $this->setMsgError("Depart id and lab items is required");
            return false;
            exit;
        }
        
        $thDateTime = $this->getThDateTime();
        if(!empty($date)){
            $thDateTime = $date.' '.date('H:i:s');;
        }
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

    public function updateFromIdno($dataList=array(), $idno=null){

        $updateList = array_map(array($this, 'mapUpdate'), array_keys($dataList), array_values($dataList));
        $updateTxt = implode(', ', $updateList);

        $sqlUpdatePatdata = "UPDATE `patdata` SET $updateTxt WHERE `idno` = '$idno' ";
        $save = $this->dbi->query($sqlUpdatePatdata);
        if ($this->dbi->error) {
            return $this->dbi->error.' : '.$sqlUpdatePatdata;
        }else{
            return $save;
        }

    }

    public function delPatdataFromIdno($idno=false){
        if(empty($idno)){
            $this->setMsgError("Not found Idno");
            return false;
        }
        $sql = sprintf("DELETE FROM `patdata` WHERE `idno` = '%s' ", $this->dbi->real_escape_string($idno));
        $res = $this->dbi->query($sql);
        if($res===false){
            $this->setMsgError($this->dbi->error.' : '.$sql);
        }else{
            $res = true;
        }
        return $res;
    }

}