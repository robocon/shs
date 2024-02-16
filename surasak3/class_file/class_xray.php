<?php
require_once dirname(__FILE__).'/database.php';
require_once dirname(__FILE__).'/class_opcard.php';

class Xray extends DbConnect
{ 
    public $dbi = null;
    public $doctor = 'MD022 (ไม่ทราบแพทย์)';
    public $typeDiag = 'ตรวจสุขภาพ';
    public $patent_from = 'OPD';
    public $vn = '';
    public $officer = '';
    public $digital = 0;
    
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
        }

        $opcardClass = new Opcard();
        $opcard = $opcardClass->getByHn($hn);
        $thaiDateFull = $this->getThaiDateFull();
        $runno = $this->getXrayRunno();
        $xray_no = $runno+1;

        $preSQL = array_map(array($this, 'mapXrayList'), array_keys($stanceList), array_values($stanceList));
        $detailAll = implode(' ', $preSQL);

        $data = array(
            'date' => $thaiDateFull,
            'hn' => $hn,
            'vn' => $this->vn,
            'yot' => $opcard['yot'],
            'name' => $opcard['name'],
            'sname' => $opcard['surname'],
            'ptname' => $opcard['yot'].$opcard['name'].' '.$opcard['surname'],
            'age' => $opcard['age'],
            'ptright' => $opcard['ptright'],
            'detail' => $detailAll,
            'doctor' => $this->doctor,
            'digital' => 1,
            'xrayno' => $xray_no,
            'type_diag' => $this->typeDiag,
            'detail_all' => $detailAll,
            'dbirth' => $opcard['dbirth'],
            'sOfficer' => sprintf("%s", $this->officer),
            'patent_from' => $this->patent_from
        );
        
        $resInsertXrayDoctor = $this->insertXrayDoctor($data);
        $this->updateXrayRunno($xray_no);

        $resInsertXrayStat = $this->insertXrayStat($data, $resInsertXrayDoctor);
        
        $res = array(
            'data' => array(
                'resInsertXrayDoctor' => $resInsertXrayDoctor,
                'resInsertXrayStat' => $resInsertXrayStat,
                'xray_number' => $xray_no
            )
        );

        return $res;

    }

    /**
     * @return string xray number
     */
    public function getXrayRunno(){
        $q_runno = $this->dbi->query("SELECT `title`,`prefix`,`runno` FROM `runno` WHERE `title` = 'xrayno'");
        $runno_row = $q_runno->fetch_assoc();
        $xray_no = $runno_row['runno'];
        return $xray_no;
    }

    /**
     * @param string new xray number
     * @return string update status
     */
    public function updateXrayRunno($xray_no){ 
        $update = $this->dbi->query("UPDATE `runno` SET `runno` = '$xray_no' WHERE `title`='xrayno'");
        return $update;
    }

    public function insertXrayDoctor($data = array()){
        
        if(empty($data)){
            return "Insert xray doctor data can not be emtpty";
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

        $save = $this->dbi->query($sqlXrayDoctor);
        if($save===true){
            $res = array('xrayno'=>$data['xrayno']);
        }else{
            $res = array('errors'=>array('status'=>400,'detail'=>$this->dbi->error));
        }

        return $res;
    }

    /**
     * field digital ของ xray_stat จะนับตามจำนวนรายการค่าใช้จ่ายที่ถูกคิดเข้ามาตาม patdata
     */
    public function insertXrayStat($data = array(), $xray_doctor=array()){

        if(empty($data)){
            return "Insert xray stat can not be emtpty";
        }elseif (empty($xray_doctor['xrayno'])) {
            return "Xray doctor is empty ".$xray_doctor['errors']['detail'];
        }

        $xrayDoctorId = $xray_doctor['xrayno'];
        
        $sql_xray_stat = "INSERT INTO `xray_stat` (
            `date` ,`hn` ,`xn` ,`xn_new` ,`ptname` ,`age` ,
            `ptright` ,`patient_from` ,`detail` ,`doctor` ,`digital` ,`10_12` ,
            `14_14` ,`NONE` ,`office` ,`idno`,`remark` 
        )VALUES ( 
            '".$data['date']."', '".$data['hn']."', '', '', '".$data['ptname']."', '".$data['age']."', 
            '".$data['ptright']."', '".$data['patent_from']."', '".$data['detail']."', '".$data['doctor']."', '".$data['digital']."', '0', 
            '0', '0', '".$data['sOfficer']."', '$xrayDoctorId', ''
        );";
        if($this->dbi->query($sql_xray_stat)===true){
            $res = array('xray_stat_id'=>$this->dbi->insert_id);
        }else{
            $res = array('errors'=>array('status'=>400,'detail'=>$this->dbi->error));
        }

        return $res;
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