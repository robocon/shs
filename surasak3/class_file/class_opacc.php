<?php 
require_once 'class_file/opcard.php';
require_once 'class_file/opday.php';
require_once 'class_file/class_depart.php';

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
    public function getOpacc($date=null,$hn=null){
        if ($date===null && $hn===null) {
            return "getOpacc required date and hn";
            exit;
        }

        $q = $this->dbi->query("SELECT * FROM opacc WHERE date LIKE '$date%' AND hn = '$hn' ");
        $items = array();
        if ($q->num_rows>0) {
            while ($a = $q->fetch_assoc()) {
                $items[] = $a;
            }
        }else{
            return false;
            exit;
        }

        return $items;
    } 
    
    public function insertOpacc($departItems=null,$detail=null,$officer=null,$credit=null){ 

        if (empty($departItems)) {
            return "insertOpacc required departItems";
            exit;
        }
        
        $opaccItems = array();
        $thDateTime = $this->getThDateTime();
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
                exit;
            }else{
                $opaccItems[] = $this->dbi->insert_id;
            }
            
        }
        return $opaccItems;
        
    }


    /**
     * 
     */
    public function findOpaccFromId($id=null, $field=null){
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
            $res = array('error'=>true, 'msg'=>$this->dbi->error);
        }
        return $res;
    }

    public function findOpaccFromTxdate(){

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
}