<?php 

require_once dirname(__FILE__).'/database.php';

class Doctor extends DbConnect{

    public function __construct(){
        parent::__construct();
    }

    /**
     * แสดงรายชื่อแพทย์ทั้งหมด
     * @param string $doctor_id เลข ว. ของหมอ
     * @return mixed $res 
     */
    public function getAllDoctor($doctor_id=null){
        $where = '';
        if($doctor_id != null){
            $where = "AND doctorcode = '$doctor_id'";
        }
        $q = $this->dbi->query("SELECT * FROM doctor WHERE status = 'y' $where ");
        $rows = $q->num_rows;
        if($rows==1){
            $res = $q->fetch_assoc();

        }elseif ($rows>1) {
            $items = array();
            while ($a = $q->fetch_assoc()) {
                $items[] = $a;
            }
            $res = $items;
        }else{
            $res = $this->dbError();
        }
        return $res;
    }

    /**
     * 
     */
    public function getExamTable($id=null){

        $where = '';
        if(!is_null($id)){
            $where = " WHERE id = '$id'";
        }

        $q = $this->dbi->query("SELECT * FROM exam_doctor $where");
        $rows = $q->num_rows;
        if($rows > 1){
            $items = array();
            while ($a = $q->fetch_assoc()) {
                $items[] = $a;
            }
            $res = $items;
        }elseif($rows==1){
            $res = $q->fetch_assoc();

        }else{
            $res = $this->dbError();

        }
        return $res;

    }

    public function saveExamTable($data=null){
        return $data;
    }

}