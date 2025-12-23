<?php 
include_once dirname(__FILE__).'/class_opcard.php';
include_once dirname(__FILE__).'/class_opday.php';
include_once dirname(__FILE__).'/class_depart.php';

class ClassOpacc extends ClassDepart{

    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * @param string @date รูปแบบ พ.ศ. เช่น 2565-09-25
     * @param string @hn เช่น 99-9999
     * 
     * @return array ตามโครงสร้างของ opacc
     */
    public function getOpacc($date=null,$hn=null,$depart=null){
        if ($date===null && $hn===null) {
            return "getOpacc required date and hn";
        }

        if(!empty($depart)){
            $whereDepart = "AND `depart` = '$depart' ";
        }
        
        $q = $this->dbi->query("SELECT * FROM `opacc` WHERE `date` LIKE '$date%' AND `hn` = '$hn' $whereDepart ");
        $items = array();
        if ($q->num_rows>0) {
            while ($a = $q->fetch_assoc()) {
                $items[] = $a;
            }
        }else{
            return false;
        }

        return $items;
    } 
    
    public function insertOpacc($departItems=null,$detail=null,$officer=null,$credit=null,$date=''){ 

        if (empty($departItems)) {
            return "insertOpacc required departItems";
            exit;
        }
        
        $opaccItems = array();
        $thDateTime = $this->getThDateTime();
        if(!empty($date)){
            $thDateTime = $date.' '.date('H:i:s');
        }
        foreach ($departItems as $key => $id) {

            $dep = $this->getDepartFromId($id);

            $txdate = $dep['date'];
            $hn = $dep['hn'];
            $depart = $dep['depart'];
            $price = $dep['price'];
            $paid = $dep['paid'];
            $ptright = $dep['ptright'];
            $vn = $dep['tvn'];

            $sql = "INSERT INTO `opacc` ( 
                `row_id`, `date`, `txdate`, `hn`, `depart`, 
                `detail`, `price`, `paid`, `idname`, `credit`, 
                `ptright`, `vn`, `paidcscd`
            ) VALUES (
                NULL, '$thDateTime', '$txdate', '$hn', '$depart', 
                '$detail', '$price', '$paid', '$officer','$credit', 
                '$ptright', '$vn', '$paid'
            );";
            
            $save = $this->dbi->query($sql);
            if($save===false){
                return $this->dbi->error;
            }else{
                $opaccItems[] = $this->dbi->insert_id;
            }
            
        }
        return $opaccItems;
        
    }


    /**
     * 
     */
    public function findOpaccFromId($id=null, $fieldSelect=null){
        if (empty($id)) {
            return array('error'=>true, 'msg'=>'Required id');
        }

        $field = '*';
        if (!empty($fieldSelect)) {
            $field = implode(',', $fieldSelect);
        }
        $q = $this->dbi->query("SELECT $field FROM opacc WHERE row_id = '$id'");
        if ($q->num_rows>0) {
            $res = $q->fetch_assoc();
        }else{
            $res = array('error'=>true, 'msg'=>'not found data from '.$id);
        }
        return $res;
    }

    public function findOpaccFromTxdate($txDate, $hn, $vn){
        $q = $this->dbi->query("SELECT * FROM `opacc` WHERE `txdate` = '$txDate' AND `hn` = '$hn' AND `vn` = '$vn' ");
        $res = false;
        if ($q->num_rows>0) {
            $res = array();
            while ($a = $q->fetch_assoc()) {
                $res[] = $a;
            }
        }
        return $res;
    }

    public function updateOpacc($dataList=array(), $id=null){

        $updateList = array_map(array($this, 'mapUpdate'), array_keys($dataList), array_values($dataList));
        $updateTxt = implode(', ', $updateList);

        $sqlUpdatePatdata = "UPDATE `opacc` SET $updateTxt WHERE `row_id` = '$id' ";
        $save = $this->dbi->query($sqlUpdatePatdata);
        if ($this->dbi->error) {
            return $this->dbi->error.' : '.$sqlUpdatePatdata;
        }else{
            return $save;
        }
    }

    public function delOpaccFromId($row_id=''){
        $res = false;
        $sql = sprintf("DELETE FROM `opacc` WHERE `row_id` = '%s' ", $this->dbi->real_escape_string($row_id));
        var_dump($sql);
        $del = $this->dbi->query($sql);
        var_dump($del);
        if($del===false){
            $res = array('error'=>true, 'msg'=>$this->dbi->error.' : '.$sql);
        }
        return $res;
    }
}