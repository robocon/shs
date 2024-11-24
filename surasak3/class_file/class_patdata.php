<?php 
require_once dirname(__FILE__).'/class_depart.php';

class ClassPatdata extends ClassDepart
{
    public function __construct()
    {
        parent::__construct();
    }

    private function __singleQuery($sql){
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
     * @param string $idno
     * @return array
     */
    public function getPatdataFromIdno($idno=null){ 
        $idno = $this->__input('%s', $idno);
        if (empty($idno)) {
            $res = $this->res400('Required idno');
        }else{
            $q = $this->dbi->query("SELECT * FROM `patdata` WHERE `idno` = '$idno' ");
            $res = array();
            if ($q->num_rows>0) {
                while ($a = $q->fetch_assoc()) {
                    $res[] = $a;
                }
            }else{
                $res = $this->res400('Can not find data');
            }
        }
        return $res;
    }

    /**
     * Summary of getPatdataFromId
     * @param string $id
     * @return array|bool|null
     */
    public function getPatdataFromId($id=null){
        $id = $this->__input('%s', $id);
        if(empty($id)){
            $res = $this->res400('Required id');
        }else{
            $q = $this->__query("SELECT * FROM `patdata` WHERE `row_id` = '$id'");
            if(!$q->errorStatus){
                if($q->num_rows>0){
                    $res = $q->fetch_assoc();
                }else{
                    $res = $this->res400('Can not find data');
                }
            }else{
                $res = $this->res400($q->errorMessage);
            }
        }
        return $res;
    }
    

    /**
     * แค่เทสใน egat_depart.php 
     * @deprecated No longer used by internal code and not recommended.
     */
    public function getDataFromIdnoAndCode($idno=null, $code=null, $fieldSelect=null){
        $idno = $this->__input('%s', $idno);
        $code = $this->__input('%s', $code);
        if(empty($idno) OR empty($code)){
            $res = $this->res400('Required idno and code');
        }else{
            $field = '*';
            if (!empty($fieldSelect)) {
                $field = implode(',', $fieldSelect);
            }
            // $this->__singleQuery("SELECT $field FROM `patdata` WHERE `idno`='$idno' AND `code`='$code' ");
        }
    }

    /**
     * เพิ่มข้อมูลใน patdata จาก depart
     * @param string $departId       row_id จาก depart
     * @param mixed $labItems       code หัตถการ
     * @return array|string
     */
    public function insertOnlyPatdata(
        $departId=null, 
        $labItems=array()
    ){
        if ($departId===null or empty($labItems)) {
            return $this->res400('Depart id and lab items is required');
        }else{

            $dep = $this->getDepartFromId($departId);
            $hn = $ptname = $ptright = '';
            if($dep['codeStatus']!="400"){
                $hn = $dep['hn'];
                $ptname = $dep['ptname'];
                $ptright = $dep['ptright'];
            }else{
                return $this->res400("Can not find data from depart id");
            }
            
            $thDateTime = $this->getThDateTime();
            $countItem = count($labItems);

            $res = array();
            foreach ($labItems AS $key => $labCode) { 
                $sqlLabcare = sprintf(
                    "SELECT `code`,`oldcode`,`detail`,`price`,`yprice`,`nprice`,`depart`,`part` 
                    FROM `labcare` 
                    WHERE `code` = '%s' ", 
                    $this->dbi->real_escape_string($labCode)
                );
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
                        $res[] = $patdataId;
                    }else{
                        $res[] = $this->dbi->error;
                    }

                } // end if
                
            } // end foreach
            return $res;
        }
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