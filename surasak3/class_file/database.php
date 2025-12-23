<?php
/**
 * @todo ในอนาคตคิดว่าจะแยก ฟังก์ชั่นออกไปต่างหาก
 */
class DbConnect{ 
    public $dbi = null;
    private $msgError = '';
    public function __construct()
    {
        $this->dbi = new mysqli(HOST,USER,PASS,DB,PORT);
        if ($this->dbi->error) {
            var_dump('Class DbConnect Error : '.$this->dbi->error);
            exit;
        }
        // $this->dbi->query("SET NAMES UTF8");
        $this->dbi->set_charset('utf8');
    }

    public $callQuery = null;

    public function __query($sql){
        $this->callQuery = $sql;
        $q = false;
        try {
            $q = $this->dbi->query($sql);
            
            if($q==false){
                return $this->getError();
            }
        } catch (Exception $e) {
            return $this->getError();
        }
        return $q;
    }

    public function dbError(){
        return array("error"=>400, "message"=>"Data not found ".$this->dbi->error);
    }

    /**
     * @return string รูปแบบ Date Time ในปี พ.ศ. เช่น 2565-09-25 23:02:55 เป็นต้น
     */
    public function getThDateTime(){
        return (date('Y')+543).date('-m-d H:i:s');
    }

    /**
     * @return string ชื่อ-สกุล ของผู้ใช้งานจากค่าของ SESSION
     */
    public function getOfficer(){
        return $_SESSION['sOfficer'];
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

}