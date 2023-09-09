<?php
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

}