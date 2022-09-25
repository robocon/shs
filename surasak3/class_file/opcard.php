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
}
