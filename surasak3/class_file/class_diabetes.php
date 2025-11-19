<?php
include_once dirname(__FILE__).'/database.php';
include_once dirname(__FILE__).'/class_opd.php';
include_once dirname(__FILE__).'/class_runno.php';

class Diabetes extends Opd
{
    public $dbi = null;
    public $diabetesState = 400;
    public $diabetesError = '';

    public function __construct()
    {
        parent::__construct();
    }

    public function data($d){
        return empty($d) ? '' : $this->dbi->real_escape_string($d);
    }

    public function getState(){
        return $this->diabetesState;
    }

    public function getError(){
        return $this->diabetesError;
    }

    public function getDiabetesFromHn($hn=null){
        $sql = sprintf("SELECT * FROM `diabetes_clinic` WHERE `hn` = '%s' ", $this->dbi->real_escape_string($hn));
        $q = $this->dbi->query($sql);
        $item = false;
        if($q->num_rows > 0){
            $item = $q->fetch_assoc();
        }
        return $item;
    }

    /**
     * เพิ่มข้อมูลใน diabetes_clinic โดยเน้นที่การเพิ่ม retinal exam
     * @param string $dmNumber 
     * @param array $post
     * @return int last insert id
     */
    public function insertRetinalDiabetes($dmNumber='', $post=array()){
        $dateN = date('Y-m-d');
        $registerDate = date('Y-m-d H:i:s');
        $res = false;
        $sql = sprintf("INSERT INTO `diabetes_clinic`(
        `dm_no`, `thidate`, `dateN`, `hn`, `doctor`, `ptname`,
        `bmi`, `retinal`, `height`, `weight`, `round`, `temperature`, 
        `pause`, `rate`, `bp1`, `bp2`, `officer`, `register_date`, 
        `retinal_date`, `follow`, `followText`
        ) VALUES(
        '%s', CURDATE(), '%s', '%s', '%s', '%s',
        '%s', '%s', '%s', '%s', '%s', '%s',
        '%s', '%s', '%s', '%s', '%s', '%s',
        '%s', '%s', '%s'
        );",
        $dmNumber, $post['date'], $post['hn'], $post['doctor'], $post['ptname'],
        $post['bmi'], $post['retinal'], $post['height'], $post['weight'], $post['waist'], $post['temp'],
        $post['pulse'],$post['rate'],$post['bp1'],$post['bp2'],$_SESSION['sOfficer'],$registerDate,
        $post['retinal_date'],$post['follow'],$post['followText']
        );
        
        $q = $this->dbi->query($sql);
        if($q!==false){
            $this->diabetesState = 200;
            $res = $dmNumber;
        }else{
            $this->diabetesState = 400;
            $this->diabetesError = $this->dbi->error;
        }
        return $res;
    }

    /**
     * อัพเดทข้อมูลใน diabetes_clinic เน้นที่ retinal exam
     */
    public function updateRetinalDiabetes($dmNumber='',$dateN='',$post=array()){
        $sql = sprintf("UPDATE `diabetes_clinic` SET 
        `dateN` = '%s',
        `retinal` = '%s',
        `retinal_date` = '%s',
        `follow` = '%s',
        `followText` = '%s'
        WHERE `dm_no` = '%s'",
        $dateN,
        $this->data($post['retinal']),
        $this->data($post['retinal_date']),
        $this->data($post['follow']),
        $this->data($post['followText']),
        $this->data($dmNumber));
        $res = array();
        $q = $this->dbi->query($sql);
        if($q!==false){
            $res = $dmNumber;
        }else{
            $res = $this->dbi->error;
        }
        return $res;
    }

    /**
     * ค้นหา diabetes_clinic_history จาก HN ของวันนี้
     */
    public function findDiabetesHistoryToday($hn=null){
        if(empty($hn)){
            return false;
        }
        $sql = sprintf("SELECT `row_id` FROM `diabetes_clinic_history` WHERE `hn` = '%s' AND `dateN` = CURDATE() ", $this->data($hn));
        $q = $this->dbi->query($sql);
        $row_id = false;
        if($q->num_rows > 0){
            $item = $q->fetch_assoc();
            $row_id = $item['row_id'];
        }
        return $row_id;
    }

    /**
     * บันทึกข้อมูลที่สำคัญของ retinal exam เข้าไปใน diabetes_clinic_history
     */
    public function insertRetinalDiabetesHistory($dmNumber='', $post=array()){
        $dateN = date('Y-m-d');
        $res = false;
        $dummy_no = '';
        for($i = 0; $i < 8; $i++){
            $dummy_no .= rand(0, 9);
        }

        $sql = sprintf("INSERT INTO `diabetes_clinic_history`(
        `dm_no`, `dateN`, `hn`, `doctor`, `ptname`,
        `bmi`, `retinal`, `height`, `weight`, `round`, `temperature`,
        `pause`, `rate`, `bp1`, `bp2`, `officer`, `edited_user`,
        `added_date`,`edited_date`,`dummy_no`,
        `retinal_date`, `follow`, `followText`,`opd_id`
        ) VALUES(
        '%s', '%s', '%s', '%s', '%s',
        '%s', '%s', '%s', '%s', '%s', '%s',
        '%s', '%s', '%s', '%s', '%s', '%s',
        NOW(), NOW(), '%s',
        '%s', '%s', '%s', '%s'
        );",
        $dmNumber, $dateN, $post['hn'], $post['doctor'], $post['ptname'],
        $post['bmi'], $post['retinal'], $post['height'], $post['weight'], $post['waist'], $post['temp'],
        $post['pulse'],$post['rate'],$post['bp1'],$post['bp2'],$_SESSION['sOfficer'],$_SESSION['sIdname'],
        $dummy_no,
        $post['retinal_date'],$post['follow'],$post['followText'],$post['opd_id']
        );
        $q = $this->dbi->query($sql);
        if($q!==false){
            $this->diabetesState = 200;
            $res = $this->dbi->insert_id;
        }else{
            $this->diabetesState = 400;
            $this->diabetesError = $this->dbi->error;
        }
        return $res;
    }

    /**
     * ค้นหา retinal_exam จาก datehn รูปแบบ YYYY-mm-ddHN
     */
    public function findRetinalExamFromDateHn($datehn=''){
        $sql = sprintf("SELECT * FROM `retinal_exam` WHERE `datehn` = '%s' ", $this->data($datehn));
        $q = $this->dbi->query($sql);
        $id = false;
        if($q->num_rows > 0){
            $item = $q->fetch_assoc();
            $id = $item['id'];
        }
        return $id;
    }

    /**
     * บันทึกข้อมูลเข้าไปใน retinal_exam
     */
    public function insertRetinalExam($dmNumber='',$post=array()){
        $datehn = $post['date'].$post['hn'];
        $res = false;

        $sql = sprintf("INSERT INTO `retinal_exam` (
        `date`, `dm_no`, `hn`, `datehn`, `opd_id`, `retinal`, 
        `retinal_date`, `follow`, `follow_text`, `officer`
        ) VALUES (
        CURDATE(), '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'
        );",
        $dmNumber, $this->data($post['hn']), $datehn, $this->data($post['opd_id']), $this->data($post['retinal']),
        $this->data($post['retinal_date']),$this->data($post['follow']),$this->data($post['followText']),$_SESSION['sOfficer']
        );
        $q = $this->dbi->query($sql);
        if($q!==false){
            $this->diabetesState = 200;
            $res = $this->dbi->insert_id;
        }else{
            $this->diabetesState = 400;
            $this->diabetesError = $this->dbi->error;
        }
        return $res;
    }

    /**
     * อัพเดทข้อมูลใน retinal exam
     */
    public function updateRetinalExam($post=array()){

        $datehn = $post['date'].$post['hn'];
        $res = false;
        $sql = sprintf("UPDATE `retinal_exam` SET 
        `retinal`='%s', 
        `retinal_date`='%s', 
        `follow`='%s', 
        `follow_text`='%s', 
        `officer`='%s' 
        WHERE (`datehn`='%s');",
        $this->data($post['retinal']),
        $this->data($post['retinal_date']),
        $this->data($post['follow']),
        $this->data($post['follow_text']),
        $this->data($post['officer']),
        $this->data($datehn)
        );
        $q = $this->dbi->query($sql);
        if($q!==false){
            $this->diabetesState = 200;
            $res = $this->dbi->insert_id;
        }else{
            $this->diabetesState = 400;
            $this->diabetesError = $this->dbi->error;
        }
        return $res;
    }
}