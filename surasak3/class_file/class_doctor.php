<?php 

require_once dirname(__FILE__).'/database.php';

class Doctor extends DbConnect{

    public function __construct(){
        parent::__construct();
    }

    public function getDoctorFromCode($doctor_code=null){
        if(empty($doctor_code)){
            return array('error'=>400,'msg'=> 'Doctorcode is required');
        }

        $q = $this->dbi->query("SELECT * FROM doctor WHERE doctorcode = '$doctor_code' ORDER BY row_id ASC LIMIT 1 ; ");
        if($q->num_rows > 0){
            $res = $q->fetch_assoc();
        }else{
            $res = $this->dbError();
        }
        return $res;
    }

    public function getDoctorFromMdName($name){

        $q = $this->dbi->query("SELECT * FROM doctor WHERE name = '$name' ORDER BY row_id ASC LIMIT 1 ; ");
        if($q->num_rows > 0){
            $res = $q->fetch_assoc();
        }else{
            $res = $this->dbError();
        }
        return $res;

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

        $sql = "SELECT * 
        FROM doctor 
        WHERE status = 'y' 
        AND ( doctorcode IS NOT NULL AND name NOT LIKE 'HD%' ) 
        AND ( row_id NOT IN('41','68','167', '173') ) 
        $where 
        ORDER BY row_id ASC";
        $q = $this->dbi->query($sql);
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
     * แสดงคลินิกจาก f43_clinic
     */
    public function getAllClinic(){
        $q = $this->dbi->query("SELECT * FROM f43_clinic ORDER BY id ASC");
        if( $q->num_rows > 0){
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
     * ดึงข้อมูลใน exam_doctor
     * @param string $id    OPTIONAL DATA
     */
    public function getExamTable($id=null){

        $where = '';
        if(!is_null($id)){
            $where = " WHERE id = '$id'";
        }

        $q = $this->dbi->query("SELECT * FROM exam_doctor $where");
        $rows = $q->num_rows;
        if($rows > 0 && $id===null){
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

    public function getExamTableFromDoctorId($doctorId=null){

        if(empty($doctorId)){
            return array('error'=>400, 'message'=> 'Doctor Id is required');
        }

        $sql = "SELECT * FROM exam_doctor WHERE doctor_id = '$doctorId' ";
        
        $q = $this->dbi->query($sql);
        if($q->num_rows > 0){
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
     * บันทึกข้อมูล(insert/update)ในตาราง exam_table
     * name ชื่อหมอ
     * doctor_id เลขที่ ว.
     * day วันที่เป็น array ให้ดูจาก date('w')
     * detail รายละเอียด
     * time_start เวลาที่เริ่ม
     * time_end เวลาที่ตรวจเสร็จ
     * clinic คลินิก
     * @param mixed $a 
     */
    public function saveExamTable($a=null){ 

        $dt = $this->getDoctorFromCode($a['doctor']);
        $name = $dt['name'];
        $doctor_id = $dt['doctorcode'];

        $day = implode(',', $a['dataDays']);
        $time_start = $a['start_hour'].':'.$a['end_hour'];
        $time_end = $a['start_min'].':'.$a['end_min'];
        
        if($a['formStatus']==='save'){
            $sql = "INSERT INTO `exam_doctor` (
                `id`, `name`, `doctor_id`, `day`, `detail`, `time_start`, `time_end`, `clinic`
            ) VALUES ( 
                NULL, '$name', '$doctor_id', '$day', '".$a['detail']."', '$time_start', '$time_end', '".$a['clinic']."' 
            );";

        }else if($a['formStatus']==='update'){ 

            $id = $a['id'];

            $sql = "UPDATE`exam_doctor` SET 
            `name`='$name', 
            `doctor_id`='$doctor_id', 
            `day`='$day', 
            `detail`='".$a['detail']."', 
            `time_start`='$time_start', 
            `time_end`='$time_end', 
            `clinic`='".$a['clinic']."' 
            WHERE (`id`='$id');";
        }

        $save = $this->dbi->query($sql);
        return $save;
    }

    /**
     * ลบข้อมูลใน exam_doctor
     * @param string $id
     */
    public function removeExamtaTable($id=null){
        $res = $this->getExamTable($id);
        if(!$res['error']){
            $q = $this->dbi->query("DELETE FROM exam_doctor WHERE id = '$id' ");
            $res = array('status'=>200, 'message'=>'ลบข้อมูลเรียบร้อย');
            if($q==false){
                $res = array('error'=>400,'message'=> $this->dbi->error);
            }
        }
        return $res;
    }

}