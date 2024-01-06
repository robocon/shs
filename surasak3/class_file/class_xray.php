<?php
require_once dirname(__FILE__).'/database.php';
require_once dirname(__FILE__).'/class_opday.php';
// require_once dirname(__FILE__).'/class_opcard.php';

class Xray extends DbConnect
{ 
    public $dbi = null;
    public string $doctor = 'MD022 (ไม่ทราบแพทย์)';
    public string $typeDiag = 'ตรวจสุขภาพ';
    public string $patent_from = 'OPD';
    // public $thaiDateFull = (date('Y')+543).date('-m-d H:i:s');
    function __construct()
    {
        parent::__construct();
    }

    public function getThaiDateFull(){
        return (date('Y')+543).date('-m-d H:i:s');
    }

    public function mapXrayList($i, $a){
        $key = sprintf("%s", $i)+1;
        $value = sprintf("%s", $a);
        return "$key.$value";
    }
    
    /**
     * 
     */
    public function addXrayOnlyItem($hn=null, $stanceList=array()){ 

        if(empty($hn) OR empty($stanceList)){
            return "HN and Xray item is required";
            exit;
        }
        
        $opdayClass = new Opday();
        $opday = $opdayClass->getThisDay($hn);
        if($opday===false){
            return "Can not find VN";
            exit;
        }

        $opcardClass = new Opcard();
        $opcard = $opcardClass->getByHn($hn);
        $thaiDateFull = $this->getThaiDateFull();
        $runno = $this->getXrayRunno();
        $xray_no = $runno++;

        $preSQL = array_map(array($this, 'mapXrayList'), array_keys($stanceList), array_values($stanceList));
        $detailAll = implode(' ', $preSQL);

        $age = findPtAge($opcard['dbirth']);

        $data = array(
            'date' => $thaiDateFull,
            'hn' => $hn,
            'vn' => $opday['vn'],
            'yot' => $opcard['yot'],
            'name' => $opcard['name'],
            'sname' => $opcard['surname'],
            'ptname' => $opcard['yot'].$opcard['name'].' '.$opcard['surname'],
            'age' => $age,
            'ptright' => $opcard['ptcard'],
            'detail' => $detailAll,
            'doctor' => $this->doctor,
            'xrayno' => $xray_no,
            'type_diag' => $this->typeDiag,
            'detail_all' => $detailAll,
            'dbirth' => $opcard['dbirth'],
            'sOfficer' => sprintf("%s", $_SESSION['sOfficer'])
        );
        $resInsertXrayDoctor = $this->insertXrayDoctor($data);
        dump($resInsertXrayDoctor);

        $resInsertXrayStat = $this->insertXrayStat($data);
        dump($resInsertXrayStat);

        // $sql_xray_detail = "INSERT INTO `xray_doctor_detail` (
        //     `date` ,`hn` ,`xrayno` ,`doctor_detail`,`detail_all`
        // )VALUES (
        //     '$this->thaiDateFull','$this->hn','$xray_no','1. CHEST CHECK UP','1. CHEST CHECK UP'
        // );";

        // $sql_xray_stat = "INSERT INTO `xray_stat` (
        //     `date` ,`hn` ,`xn` ,`xn_new` ,`ptname` ,`age` ,
        //     `ptright` ,`patient_from` ,`detail` ,`doctor` ,`digital` ,`10_12` ,
        //     `14_14` ,`NONE` ,`office` ,`idno`,`remark` 
        // )VALUES ( 
        //     '$this->thaiDateFull', '$this->hn', '', '', '$ptname', '$age', 
        //     '$ptright', 'OPD', '1.CHEST CHECK UP', 'MD022 (ไม่ทราบแพทย์)', '1', '0', 
        //     '0', '0', '$this->sOfficer', '$depart_id', '$sumPrice'
        // );";

    }

    public function getXrayRunno(){
        $q_runno = $this->dbi->query("SELECT `title`,`prefix`,`runno` FROM `runno` WHERE `title` = 'xrayno'");
        $runno_row = $q_runno->fetch_assoc();
        $xray_no = $runno_row['runno'];
        return $xray_no;
    }

    public function updateXrayRunno($xray_no){
        $update = $this->dbi->query("UPDATE `runno` SET `runno` = '$xray_no' WHERE `title`='xrayno'");
        return $update;
    }

    public function insertXrayDoctor($data = array()){
        
        if(empty($data)){
            return "Insert xray doctor data can not be emtpty";
            exit;
        }

        $sqlXrayDoctor = "INSERT INTO `xray_doctor` (
            `date` ,`hn` ,`vn` ,`yot` ,`name` ,`sname` ,
            `detail` ,`doctor` ,`status` ,`xrayno` ,`film` ,`type_diag`,
            `detail_all`,`dbirth`,`orderby`
        )VALUES (
            '".$data['date']."', '".$data['hn']."', '".$data['vn']."', '".$data['yot']."', '".$data['name']."', '".$data['sname']."', 
            '".$data['detail']."', '".$data['doctor']."', 'N', '".$data['xrayno']."', 'digital', '".$data['type_diag']."', 
            '".$data['detail_all']."', '".$data['dbirth']."', 'XRAY'
        );";

        if($this->dbi->query($sqlXrayDoctor)===true){
            $res = true;
        }else{
            $res = $this->dbi->error;
        }

        return $res;
    }

    public function insertXrayStat($data = array()){

        if(empty($data)){
            return "Insert xray stat can not be emtpty";
            exit;
        }

        $sql_xray_stat = "INSERT INTO `xray_stat` (
            `date` ,`hn` ,`xn` ,`xn_new` ,`ptname` ,`age` ,
            `ptright` ,`patient_from` ,`detail` ,`doctor` ,`digital` ,`10_12` ,
            `14_14` ,`NONE` ,`office` ,`idno`,`remark` 
        )VALUES ( 
            '".$data['date']."', '".$data['hn']."', '', '', '".$data['ptname']."', '".$data['age']."', 
            '".$data['ptright']."', '{$this->patent_from}', '".$data['detail']."', '".$data['doctor']."', '1', '0', 
            '0', '0', '".$data['sOfficer']."', '', ''
        );";
        $q = $this->dbi->query($sql_xray_stat);
    }

    public function getXrayItem($code){
        $code = sprintf("%s", $code);
        $sql = "SELECT * FROM labcare WHERE depart = 'XRAY' AND part = 'XRAY' and code = '$code' LIMIT 1 ";
        $q = $this->dbi->query($sql);
        if($q->num_rows>0){
            $res = $q->fetch_assoc();
        }
        return $res;
    }

    public function getXrayItems($code){
        $code = sprintf("%s", $code);
        $sql = "SELECT * FROM labcare WHERE depart = 'XRAY' AND part = 'XRAY' and code = '$code' ";
        $q = $this->dbi->query($sql);
        $res = array();
        if($q->num_rows>0){
            while ($a = $q->fetch_assoc()) {
                $res[] = $a;
            }
        }
        return $res;
    }
}