<?php 
class Opcard
{
    private $dbi = null;
    public function __construct()
    {
        $this->dbi = new mysqli(HOST,USER,PASS,DB);
        $this->dbi->query("SET NAMES UTF8");
        if($this->dbi->connect_error){
            die("Connection failed: ".$this->dbi->connect_error);
        }
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
        }
        $query = sprintf("SELECT $field FROM `opcard` WHERE `hn`='%s'", $this->dbi->escape_string($hn));
        $result = $this->dbi->query($query);
        $item = false;
        if($result->num_rows > 0){
            $item = $result->fetch_assoc();
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
