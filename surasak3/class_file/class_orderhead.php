<?php 
require_once dirname(__FILE__).'/database.php';
/**
 * Summary of Orderhead
 * 
 * 
 */
class Orderhead extends DbConnect
{
    public $dbi = null;
    public $hn = null;
    public $labnumber = null;
    public $patienttype = 'OPD';
    public $patientname = null;
    public $sex = null;
    public $dob = null;
    public $clinicianname = 'MD022 (แพทย์เวชปฎิบัติ)';
    public $clinicalinfo = null;
    public $sourcename = 'ตรวจสุขภาพภายนอก';
    public $sourcecode = '101';
    public $is_nhealth = '0';

    function __construct()
    {
        parent::__construct();
    }

    /**
     * เพิ่มข้อมูลเข้า orderhead !!! ไม่ต้องสร้าง labnumber !!!
     * @param string hn            HN
     * @param string patientname   ชื่อสกุล
     * @param string sex           เพศ m, f
     * @param string dob           วันเดือนปีเกิด แบบ ค.ศ.
     * @param string clinicalinfo  รายละเอียดบ่งบอกว่ามีรายการแลปอะไรบ้าง หรือเป็น ตรวจสุขภาพประจำปี
     * 
     * @return mixed labnumber หรือ error => true
     */
    public function insertOrderhead($data){ 

        $labnumber = $this->getLabnumber();

        $this->hn = $data['hn'];
        $this->patientname = $data['patientname'];
        $this->sex = $data['sex'];
        $this->dob = $data['dob'];
        $this->clinicalinfo = $data['clinicalinfo'];
        $this->is_nhealth = $data['is_nhealth'];

        $orderhead_sql = "INSERT INTO `orderhead` ( 
            `autonumber`, `orderdate`, `labnumber`, `hn`, `patienttype`, `patientname`, 
            `sex`, `dob`, `sourcecode`, `sourcename`, `room`, `cliniciancode`, 
            `clinicianname`, `priority`, `clinicalinfo`, `isquery`, `is_nhealth`
        ) VALUES (
            NULL, NOW(), '$labnumber', '$this->hn', '$this->patienttype', '$this->patientname', 
            '$this->sex', '$this->dob', '$this->sourcecode', '$this->sourcename', '', '', 
            '$this->clinicianname', 'R', '$this->clinicalinfo', '1', '$this->is_nhealth' 
        );";
        $q = $this->dbi->query($orderhead_sql);
        $res = array('error'=>true,'message'=>$this->dbi->error);
        if($q===true){
            $res = array('labnumber'=>$labnumber);
        }
        return $res;
    }

    /**
     * เพิ่มข้อมูลเข้า orderdetail
     * @param string labnumber  labnumber
     * @param array labitems    รายการแลปที่ตรวจ
     */
    public function insertOrderdetail($data){
        
        $labnumber = $data['labnumber'];
        $res = true;
        foreach ($data['labitems'] as $labItem) {
            $labinfo = $this->getLabcare($labItem);
            $code = $labinfo['code'];
            $oldcode = $labinfo['oldcode'];
            $detail = $labinfo['detail'];
            $labtype = $labinfo['labtype'];

            $orderdetail_sql = "INSERT INTO `orderdetail` ( 
                `labnumber`,`labcode`,`labcode1`,`labname`,`type`
            ) VALUES (
                '$labnumber', '$code', '$oldcode', '$detail', '$labtype'
            );";
            $insertOrderdetail = $this->dbi->query($orderdetail_sql);
            if($insertOrderdetail===false){
                $res = array('error'=>true,'message'=>$this->dbi->error);
            }else{
                $res = array('labnumber'=>$labnumber);
            }
        }
        return $res;
    }

    /**
     * สร้าง Labnumber
     * @return string labnumber ฟอแมต ymd+runno title=lab
     */
    public function getLabnumber(){

        $q_runno = $this->dbi->query("SELECT `runno`, SUBSTRING(`startday`,1,10) AS `startday` FROM `runno` WHERE `title` = 'lab'");
        $row = $q_runno->fetch_assoc();
        $nLab = $row['runno'];
        $dLabdate = $row['startday'];

        $labnumber = date('ymd').$nLab;

        $nLab = $nLab + 1;
        $query ="UPDATE runno SET `runno` = '$nLab', `startday` = '$dLabdate' WHERE `title`='lab'";
        $this->dbi->query($query);

        return $labnumber;
    }

    /**
     * ค้นหา labcare แบบตัวเดียว
     * @param string $code 
     */
    public function getLabcare($code=''){
        $labcode = sprintf("%s", $code);
        $sql = sprintf("SELECT `code`,`oldcode`,`detail`,`price`,`yprice`,`nprice`,`depart`,`part`,`labtype` FROM `labcare` WHERE `code` = '%s' ", $labcode);
        $q = $this->dbi->query($sql);
        if($q->num_rows>0){
            $res = $q->fetch_assoc();
        }else{
            $res = array('error'=>true,'message'=>$this->dbi->error);
        }
        return $res;
    }

    /**
     * ค้นหาข้อมุลจาก labcare แบบ LIKE
     * @param string $code      ฟิลด์ code 
     * @param string $depart    ค่า default เป็น PATHO
     */
    public $depart = 'PATHO';
    public $part = 'LAB';
    public function getLabcares($code){
        $labcode = sprintf("%s", $code);
        $depart = $this->depart;
        $part = $this->part;
        $sql = "SELECT `code`,`oldcode`,`detail`,`price`,`yprice`,`nprice`,`depart`,`part` 
        FROM `labcare` 
        WHERE ( `depart` = '$depart' AND `part` = '$part' )
        AND (`code` LIKE '%$labcode%' OR `codelab` LIKE '%$labcode%' )
        AND `labstatus` = 'Y'  ";
        $q = $this->dbi->query($sql);
        if($q->num_rows>0){
            $items = array();
            while($a = $q->fetch_assoc()){
                $items[] = $a;
            }
            $res = array('data'=>$items,'count'=>count($items));
        }else{
            $res = array('error'=>true,'message'=>$this->dbi->error);
        }
        return $res;
    }
}