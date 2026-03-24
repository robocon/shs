<?php
/**
 * @todo ในอนาคตคิดว่าจะแยก ฟังก์ชั่นออกไปต่างหาก
 */
class Database{ 
    public $dbi;
    public $msgError;
    public function __construct()
    {
        $this->dbi = new mysqli(HOST,USER,PASS,DB,PORT);
        if ($this->dbi->error) {
            return $this->dbi->error;
        }
        $this->dbi->query("SET NAMES UTF8");
        $this->dbi->set_charset('utf8');
    }

    /**
     * @return string รูปแบบ Date Time ในปี พ.ศ. เช่น 2565-09-25 23:02:55 เป็นต้น
     */
    public function getThDateTime(){
        return (date('Y')+543).date('-m-d H:i:s');
    }

    /**
     * @return string Format YYYY-mm-dd Example 2565-09-25
     */
    public function getThDate(){
        return (date('Y')+543).date('-m-d');
    }

    public function getError(){
        $e = new stdClass;
        $e->errorNumber = $this->dbi->errno;
        $e->errorDetail = $this->dbi->error;
        $e->errorMessage = "MySQL Error: [{$this->dbi->errno}] {$this->dbi->error}";
        return $e;
    }

    public function setMsgError($t){
        $this->msgError=$t;
    }

    public function getMsgError(){
        return $this->msgError;
    }

    /**
     * เพิ่มข้อมูลเข้าไปในตาราง X ตาม Array ที่ส่งเข้ามา
     * @param string $table
     * @param array $data
     * - key string แทนชื่อฟิลด์
     * - value string แทนค่าของฟิลด์
     */
    public function insertData($table, $data){
        $fields = array_keys($data);
        $values = array();
        foreach (array_values($data) as $val) {
            $values[] = sprintf("'%s'", $val);
        }
        $sql = "INSERT INTO `$table` (`" . implode("`,`", $fields) . "`) VALUES (" . implode(",", $values) . ")";
        $insert = $this->dbi->query($sql);
        $res = false;
        if($insert!==false){
            $res = $this->dbi->insert_id;
        }else{
            $this->setMsgError($this->dbi->error);
        }
        return $res;
    }

}