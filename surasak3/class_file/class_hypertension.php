<?php
require_once dirname(__FILE__).'/database.php';

class Hypertension extends DbConnect{
    public $dbi = null;
    function __construct()
    {
        parent::__construct();
    }

    public function __singleQuery($sql){
        $q = $this->dbi->query($sql);
        if($q->num_rows>0){
            $res = $q->fetch_assoc();
        }else{
            $msg = $this->dbi->error ? $this->dbi->error : 'ไม่พบข้อมูล' ;
            $res = array('error_code'=>400, 'error'=>true, 'msg'=>$msg);
        }
        return $res;
    }

    public function getData($hn){
        $hn = sprintf("%s", $hn);
        $sql = sprintf("SELECT * FROM `hypertension_clinic` WHERE `hn` = '$hn' LIMIT 1",$this->dbi->real_escape_string($hn));
        $res = $this->__singleQuery($sql);
        return $res;
    }

    private $ht_no = '';
    private $thidate = '';
    private $dateN = '';
    private $hn = '';
    private $doctor = '';
    private $ptname = '';
    private $ptright = '';
    private $sex = '';
    private $diagnosis = '';
    private $ht = '';
    private $joint_disease = '';
    private $joint_disease_dm = '';
    private $joint_disease_nephritic = '';
    private $joint_disease_myocardial = '';
    private $joint_disease_paralysis = '';
    private $smork = '';
    private $bmi = '';
    private $height = '';
    private $weight = '';
    private $round = '';
    private $temperature = '';
    private $pause = '';
    private $rate = '';
    private $bp1 = '';
    private $bp2 = '';
    private $officer = '';
    private $officer_edit = '';
    private $register_date = '';
    private $pension = '';
    private $age_str = '';
    private $diag_date = '';
    private $bp3 = '';
    private $bp4 = '';
    private $ecgCxr = '';
    private $dateEcgCxr = '';
    private $albumin = '';
    private $dateAlbumin = '';
    private $albuminLabnumber = '';
    private $creatinine = '';
    private $dateCreatinine = '';
    private $creatinineLabnumber = '';
    private $row_id = '';

    public function setRowId($id){
        $this->row_id = $this->dbi->real_escape_string($id);
    }

    public function newHtNumber(){
        $sql = "SELECT  MAX(`ht_no`) AS `ht_no` FROM `hypertension_clinic` LIMIT 1";
        $res = $this->__singleQuery($sql);
        return $res;
    }

    public function setHypertension_clinic($a){
        $this->ht_no = $this->dbi->real_escape_string($a['ht_no']);
        $this->thidate = $this->dbi->real_escape_string($a['thidate']);
        $this->dateN = date("Y-m-d");
        $this->hn = $this->dbi->real_escape_string($a['hn']);
        $this->doctor = $this->dbi->real_escape_string($a['doctor']);
        $this->ptname = $this->dbi->real_escape_string($a['ptname']);
        $this->ptright = $this->dbi->real_escape_string($a['ptright']);
        $this->sex = $this->dbi->real_escape_string($a['sex']);
        $this->diagnosis = $this->dbi->real_escape_string($a['diagnosis']);
        $this->ht = $this->dbi->real_escape_string($a['ht']);
        $this->joint_disease = $this->dbi->real_escape_string($a['joint_disease']);
        $this->joint_disease_dm = $this->dbi->real_escape_string($a['joint_disease_dm']);
        $this->joint_disease_nephritic = $this->dbi->real_escape_string($a['joint_disease_nephritic']);
        $this->joint_disease_myocardial = $this->dbi->real_escape_string($a['joint_disease_myocardial']);
        $this->joint_disease_paralysis = $this->dbi->real_escape_string($a['joint_disease_paralysis']);
        $this->smork = $this->dbi->real_escape_string($a['smork']);
        $this->bmi = $this->dbi->real_escape_string($a['bmi']);
        $this->height = $this->dbi->real_escape_string($a['height']);
        $this->weight = $this->dbi->real_escape_string($a['weight']);
        $this->round = $this->dbi->real_escape_string($a['round']);
        $this->temperature = $this->dbi->real_escape_string($a['temperature']);
        $this->pause = $this->dbi->real_escape_string($a['pause']);
        $this->rate = $this->dbi->real_escape_string($a['rate']);
        $this->bp1 = $this->dbi->real_escape_string($a['bp1']);
        $this->bp2 = $this->dbi->real_escape_string($a['bp2']);
        $this->officer = $this->dbi->real_escape_string($a['officer']);
        $this->officer_edit = $this->dbi->real_escape_string($a['officer_edit']);
        $this->register_date = date("Y-m-d H:i:s");
        $this->pension = $this->dbi->real_escape_string($a['pension']);
        $this->age_str = $this->dbi->real_escape_string($a['age_str']);
        $this->diag_date = $this->dbi->real_escape_string($a['diag_date']);
        $this->bp3 = $this->dbi->real_escape_string($a['bp3']);
        $this->bp4 = $this->dbi->real_escape_string($a['bp4']);
        $this->ecgCxr = $this->dbi->real_escape_string($a['ecgCxr']);
        $this->dateEcgCxr = $this->dbi->real_escape_string($a['dateEcgCxr']);
        $this->albumin = $this->dbi->real_escape_string($a['albumin']);
        $this->dateAlbumin = $this->dbi->real_escape_string($a['dateAlbumin']);
        $this->albuminLabnumber = $this->dbi->real_escape_string($a['albuminLabnumber']);
        $this->creatinine = $this->dbi->real_escape_string($a['creatinine']);
        $this->dateCreatinine = $this->dbi->real_escape_string($a['dateCreatinine']);
        $this->creatinineLabnumber = $this->dbi->real_escape_string($a['creatinineLabnumber']);
    }

    public function insert(){

        $sql = "INSERT INTO `hypertension_clinic` (
            `row_id`, `ht_no`, `thidate`, `dateN`, `hn`, `doctor`, 
            `ptname`, `ptright`, `sex`, `diagnosis`, `ht`, `joint_disease`, 
            `joint_disease_dm`, `joint_disease_nephritic`, `joint_disease_myocardial`, `joint_disease_paralysis`, `smork`, `bmi`, 
            `height`, `weight`, `round`, `temperature`, `pause`, `rate`, 
            `bp1`, `bp2`, `officer`, `officer_edit`, `register_date`, `pension`, 
            `age_str`, `diag_date`, `bp3`, `bp4`, `ecgCxr`, `dateEcgCxr`, 
            `albumin`, `dateAlbumin`, `albuminLabnumber`, `creatinine`, `dateCreatinine`, `creatinineLabnumber`
        ) 
        VALUES 
        (
            NULL, '$this->ht_no', '$this->thidate', '$this->dateN', '$this->hn', '$this->doctor', 
            '$this->ptname', '$this->ptright', '$this->sex', '$this->diagnosis', '$this->ht', '$this->joint_disease', 
            '$this->joint_disease_dm', '$this->joint_disease_nephritic', '$this->joint_disease_myocardial', '$this->joint_disease_paralysis', '$this->smork', '$this->bmi', 
            '$this->height', '$this->weight', '$this->round', '$this->temperature', '$this->pause', '$this->rate', 
            '$this->bp1', '$this->bp2', '$this->officer', '$this->officer_edit', '$this->register_date', '$this->pension', 
            '$this->age_str', '$this->diag_date', '$this->bp3', '$this->bp4', '$this->ecgCxr', '$this->dateEcgCxr', 
            '$this->albumin', '$this->dateAlbumin', '$this->albuminLabnumber', '$this->creatinine', '$this->dateCreatinine', '$this->creatinineLabnumber'
        );";
        $q = $this->dbi->query($sql);
        if($this->dbi->error){
            $msg = $this->dbi->error ? $this->dbi->error : 'ไม่พบข้อมูล' ;
            $res = array('error_code'=>400, 'error'=>true, 'msg'=>$msg);
        }else{
            $res = array('hypertension_id' => $q->insert_id);
        }

        return $res;

    }

    public function update(){
        $sql = "UPDATE `hypertension_clinic` SET 
        `thidate` = '$this->thidate', 
        `doctor` = '$this->doctor', 
        `ptname` = '$this->ptname', 
        `ptright` = '$this->ptright', 
        `sex` = '$this->sex', 
        `ht` = '$this->ht', 
        `joint_disease_dm` = '$this->joint_disease_dm', 
        `joint_disease_nephritic` = '$this->joint_disease_nephritic', 
        `joint_disease_myocardial` = '$this->joint_disease_myocardial', 
        `joint_disease_paralysis` = '$this->joint_disease_paralysis', 
        `smork` = '$this->smork', 
        `bmi` = '$this->bmi', 
        `height` = '$this->height', 
        `weight` = '$this->weight', 
        `round` = '$this->round', 
        `temperature` = '$this->temperature', 
        `pause` = '$this->pause', 
        `rate` = '$this->rate', 
        `bp1` = '$this->bp1', 
        `bp2` = '$this->bp2', 
        `officer_edit` = '$this->officer_edit', 
        `diag_date` = '$this->diag_date', 
        `bp3` = '$this->bp3', 
        `bp4` = '$this->bp4', 
        `ecgCxr` = '$this->ecgCxr', 
        `dateEcgCxr` = '$this->dateEcgCxr', 
        `albumin` = '$this->albumin', 
        `dateAlbumin` = '$this->dateAlbumin', 
        `albuminLabnumber` = '$this->albuminLabnumber', 
        `creatinine` = '$this->creatinine', 
        `dateCreatinine` = '$this->dateCreatinine', 
        `creatinineLabnumber` = '$this->creatinineLabnumber' 
        WHERE `row_id` = '$this->row_id' ";
        $q = $this->dbi->query($sql);
        if($this->dbi->error){
            $msg = $this->dbi->error ? $this->dbi->error : 'ไม่พบข้อมูล' ;
            $res = array('error_code'=>400, 'error'=>true, 'msg'=>$msg);
        }else{
            $res = array('status' => 200);
        }
        return $res;
    }

    public function insert_history(){

        $sql = "INSERT INTO `hypertension_history` (
            `ht_no`, `thidate`, `dateN`, `hn`, `doctor`, 
            `ptname`, `ptright`, `sex`, `diagnosis`, `ht`, `joint_disease`, 
            `joint_disease_dm`, `joint_disease_nephritic`, `joint_disease_myocardial`, `joint_disease_paralysis`, `smork`, `bmi`, 
            `height`, `weight`, `round`, `temperature`, `pause`, `rate`, 
            `bp1`, `bp2`, `officer`, `officer_edit`, `register_date`, `pension`, 
            `age_str`, `diag_date`, `bp3`, `bp4`, `ecgCxr`, `dateEcgCxr`, 
            `albumin`, `dateAlbumin`, `albuminLabnumber`, `creatinine`, `dateCreatinine`, `creatinineLabnumber`
        ) 
        VALUES 
        (
            '$this->ht_no', '$this->thidate', '$this->dateN', '$this->hn', '$this->doctor', 
            '$this->ptname', '$this->ptright', '$this->sex', '$this->diagnosis', '$this->ht', '$this->joint_disease', 
            '$this->joint_disease_dm', '$this->joint_disease_nephritic', '$this->joint_disease_myocardial', '$this->joint_disease_paralysis', '$this->smork', '$this->bmi', 
            '$this->height', '$this->weight', '$this->round', '$this->temperature', '$this->pause', '$this->rate', 
            '$this->bp1', '$this->bp2', '$this->officer', '$this->officer_edit', '$this->register_date', '$this->pension', 
            '$this->age_str', '$this->diag_date', '$this->bp3', '$this->bp4', '$this->ecgCxr', '$this->dateEcgCxr', 
            '$this->albumin', '$this->dateAlbumin', '$this->albuminLabnumber', '$this->creatinine', '$this->dateCreatinine', '$this->creatinineLabnumber'
        );";

        $q = $this->dbi->query($sql);
        if($this->dbi->error){
            $msg = $this->dbi->error ? $this->dbi->error : 'ไม่พบข้อมูล' ;
            $res = array('error_code'=>400, 'error'=>true, 'msg'=>$msg);
        }else{
            $res = array('hypertension_id' => $q->insert_id);
        }
        return $res;

    }
}