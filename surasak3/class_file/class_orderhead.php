<?php 
require_once dirname(__FILE__).'/database.php';

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

    function __construct()
    {
        parent::__construct();
    }

    public function insertOrderhead($data){ 

        // $this->labnumber = $data['labnumber'];
        $labnumber = $this->getLabnumber();

        $this->hn = $data['hn'];
        $this->patientname = $data['patientname'];
        $this->sex = $data['sex'];
        $this->dob = $data['dob'];
        $this->clinicalinfo = $data['clinicalinfo'];

        $orderhead_sql = "INSERT INTO `orderhead` ( 
            `autonumber`, `orderdate`, `labnumber`, `hn`, `patienttype`, `patientname`, 
            `sex`, `dob`, `sourcecode`, `sourcename`, `room`, `cliniciancode`, 
            `clinicianname`, `priority`, `clinicalinfo` 
        ) VALUES (
            NULL, NOW(), '$labnumber', '$this->hn', '$this->patienttype', '$this->patientname', 
            '$this->sex', '$this->dob', '', '', '', '', 
            '$this->clinicianname', 'R', '$this->clinicalinfo'
        );";
        $q = $this->dbi->query($orderhead_sql);
        
        if($q===false){
            $res = array('error'=>true,'message'=>$this->dbi->error);
        }else{
            $res = array('labnumber'=>$labnumber);
        }
        
        return $res;
    }

    public function insertOrderdetail($data){
        
        $labnumber = $data['labnumber'];
        $res = true;
        foreach ($data['labitems'] as $labItem) {
            $labinfo = $this->getLabinfo($labItem);
            $code = $labinfo['code'];
            $oldcode = $labinfo['oldcode'];
            $detail = $labinfo['detail'];

            $orderdetail_sql = "INSERT INTO `orderdetail` ( 
                `labnumber`,`labcode`,`labcode1`,`labname` 
            ) VALUES (
                '$labnumber', '$code', '$oldcode', '$detail'
            );";
            $insertOrderdetail = $this->dbi->query($orderdetail_sql);
            if($insertOrderdetail===false){
                $res = array('error'=>true,'message'=>$this->dbi->error);
            }else{
                $res = array('labnumber'=>$labnumber);
            }
            // else{
            //     $res[] = $this->dbi->insert_id;
            // }

        }
        return $res;

    }

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

    public function getLabinfo($code=''){
        $labcode = sprintf("%s", $code);
        $sqlLabcare = "SELECT `code`,`oldcode`,`detail`,`price`,`yprice`,`nprice`,`depart`,`part` FROM `labcare` WHERE `code` = '$labcode' ";
        $q = $this->dbi->query($sqlLabcare);
        if($q->num_rows>0){
            $res = $q->fetch_assoc();
        }else{
            $res = "Not found : ".$this->dbi->error;
        }
        return $res;
    }
    
}