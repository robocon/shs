<?php
include dirname(__FILE__).'/database.php';
class Opcard extends DbConnect
{
    public $dbi = null;
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param string $hn HN ผู้มารับบริการ
     * @param array $fields ชื่อฟิลด์ที่ต้องการ select
     * 
     * @return array $item รายการตามที่ $fields ได้เลือกไว้หรือทั้งหมด
     */
    public function getByHn($hn=null, $fields=null)
    {
        
        $field = '*';
        if(!empty($fields)){
            $field = implode(',', $fields);
            $field .= ",`yot`,`name`,`surname`,`dbirth`,TIMESTAMPDIFF(YEAR,CONCAT((SUBSTRING(`dbirth`,1,4)-543),SUBSTRING(`dbirth`,5,6)),NOW()) AS `age`,CONCAT((SUBSTRING(`dbirth`,1,4)-543),SUBSTRING(`dbirth`,5,6)) AS `dbirth_en`";
        }
        $sql = sprintf("SELECT $field FROM `opcard` WHERE `hn`='%s'", $this->dbi->real_escape_string($hn));
        $result = $this->dbi->query($sql);
        $item = false;
        if($result->num_rows > 0){
            $item = $result->fetch_assoc();
            $item['ptname'] = $item['yot'].$item['name'].' '.$item['surname'];
            $item['age'] = (int) $this->getAge($item['dbirth']);
        }
        return $item;
    }

    public function getByIdcard($idcard=null, $fields=null)
    {
        $field = '*';
        if(!empty($fields)){
            $field = implode(',', $fields);
        }
        $query = sprintf("SELECT $field FROM `opcard` WHERE `idcard`='%s'", $idcard);
        $result = $this->dbi->query($query);
        $item = false;
        if($result->num_rows > 0){
            $item = $result->fetch_assoc();
            $item['ptname'] = $item['yot'].$item['name'].' '.$item['surname'];
            $item['age'] = $this->getAge($item['dbirth']);
        }
        return $item;
    }

    public function update($hn, $items=array()){ 

        if(count($items) > 1){
            $update = array();
            foreach ($items as $key => $value) {
                $update[] = sprintf("`$key` = '%s'", $value);
            }
            $update_txt = implode(', ', $update);
        }elseif (count($items)===1) { 
            $key = key($items);
            $value = $items[$key];
            $update_txt = sprintf("`$key` = '%s'", $value);
        }
        

        $sql = sprintf("UPDATE `opcard` SET ".$update_txt." WHERE `hn` = '%s'", $hn);
        $this->dbi->query($sql);

        return $hn;
    }

    /**
     * @param string $dbirth    ปี พ.ศ.
     */
    public function getAge($dbirth){
        list($y, $m, $d) = explode('-', $dbirth);
        $date2 = date('Y-m-d');
        $diff = abs(strtotime($date2) - strtotime(($y-543)."-$m-$d"));
        $years = floor($diff / (365*60*60*24));
        return $years;
    }

    public function dbirthThaiToEng($dbirth){
        list($y, $m, $d) = explode('-', $dbirth);
        return ($y-543).'-'.$m.'-'.$d;
    }
}
