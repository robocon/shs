<?php
define('LOG_FILE', dirname(__FILE__).'/../logs/mysql-query-error.txt');
/**
 * @todo ในอนาคตคิดว่าจะแยก ฟังก์ชั่นออกไปต่างหาก
 */
class DbConnect{ 
    public $dbi = null;
    public function __construct()
    {
        $this->dbi = new mysqli(HOST,USER,PASS,DB);
        if ($this->dbi->connect_errno) {
            var_dump($this->dbi->error);
            exit;
        }
        $this->dbi->query("SET NAMES UTF8");
    }

    /**
     * @param string sprintf with real_escape_string
     * @see ประเภทของ sprintf อ่านต่อ >>> https://www.w3schools.com/php/func_string_sprintf.asp
     * @param string ข้อความ
     * 
     * @return string
     */
    public function __input($t, $s){
        return sprintf($t, $this->dbi->real_escape_string(trim($s)));
    }

    /**
     * Summary of __query
     * @param mixed $sql
     * @return bool|mysqli_result|stdClass
     */
    public function __query($sql){
        $q = false;
        try {
            $q = $this->dbi->query($sql);
            if($q==false){
                return $this->getError($sql);
            }
        } catch (Exception $e) {
            return $this->getError($sql);
        }
        return $q;
    }

    public function dbError(){
        return array("error"=>400, "message"=>"Data not found ".$this->dbi->error);
    }

    /**
     * @return string รูปแบบ Y-m-d H:i:s เป็นปี พ.ศ. เช่น 2565-09-25 23:02:55 เป็นต้น
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

    public function getError($code=''){
        $e = new stdClass;
        $e->errorStatus = 'error';
        $e->errorNumber = $this->dbi->errno;
        $e->errorDetail = $this->dbi->error;
        $e->errorMessage = "MySQL Error: [{$this->dbi->errno}] {$this->dbi->error}";
        $this->setLog($e->errorMessage,$code);
        return $e;
    }

    private function setLog($m, $c=null){
        $msg = date('Y-m-d H:i:s').' '.$m;
        if(!empty($c)){
            $msg .= "\n[Error code] : $c \n";
        }
        $msg .= "\n";
        file_put_contents(LOG_FILE, $msg, FILE_APPEND | LOCK_EX);
    }

    /**
     * @example Example response
     * ```php
     * <?php 
     * return array("codeStatus"=>400, "codeMsg"=>"Say some thing");
     * ?>
     * @return array
     */
    public function res400($msg){
        return array('codeStatus'=>400,'codeMsg'=>$msg);
    }

}