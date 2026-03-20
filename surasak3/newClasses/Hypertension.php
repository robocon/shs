<?php
class Hypertension extends Database
{
    public $dbi = null;
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Summary of __singleQuery Select statement อะไรก็ได้เอาไว้ใช้ตอน query อะไรที่มันต้อง return มาเป็น row เดียว
     * @param string $sql
     * @return mixed
     */
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

    /**
     * Summary of getOneFromHn ่Select row เดียวจาก hypertension_clinic
     * Select 1 row
     * @param mixed $hn
     * @return mixed 
     */
    public function getOneFromHn($hn){
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
    private $history_id = '';

    /**
     * Summary of setRowId ตั้งค่า row_id 
     * @param mixed $id
     * @return void
     */
    public function setRowId($id){
        $this->row_id = sprintf("%s", $this->dbi->real_escape_string($id));
    }

    /**
     * Summary of setHistoryId ตั้งค่า id ให้กับ hypertension_history
     * @param mixed $id
     * @return void
     */
    public function setHistoryId($id){
        $this->history_id = sprintf("%s", $this->dbi->real_escape_string($id));
    }

    public function setDateN($d){
        $this->dateN = sprintf("%s", $this->dbi->real_escape_string($d));
    }

    /**
     * Summary of newHtNumber select เอา ht_no มา +1 เป็น id ตัวใหม่
     * @return mixed
     */
    public function newHtNumber(){
        $sql = "SELECT  MAX(`ht_no`) AS `ht_no` FROM `hypertension_clinic` LIMIT 1";
        $res = $this->__singleQuery($sql);
        return $res;
    }

    /**
     * Summary of getHtHistoryThisDay เอาไว้เช็กว่า ในวันนี้มีการ insert เข้ามาแล้วรึยัง
     * @param mixed $hn
     * @return mixed
     */
    public function getHtHistoryThisDay($hn){
        $thisDay = date('Y-m-d');
        $sql = sprintf("SELECT * FROM `hypertension_history` WHERE `thidate` = '$thisDay' AND `hn` = '%s' LIMIT 1 ", $this->dbi->real_escape_string($hn));
        $res = $this->__singleQuery($sql);
        return $res;
    }

    /**
     * Summary of setHypertension_clinic เซ็ตค่าเข้าไปใน private ก่อนที่จะเพิ่ม หรือ อัพเดทข้อมูล
     * @param mixed $a
     * @return void
     */
    public function setHypertension_clinic($a){
        $this->ht_no = $a['ht_no'];
        $this->thidate = $a['thidate'];
        $this->dateN = date("Y-m-d");
        $this->hn = $a['hn'];
        $this->doctor = $a['doctor'];
        $this->ptname = $a['ptname'];
        $this->ptright = $a['ptright'];
        $this->sex = $a['sex'];
        $this->diagnosis = $a['diagnosis'];
        $this->ht = $a['ht'];
        $this->joint_disease = $a['joint_disease'];
        $this->joint_disease_dm = $a['joint_disease_dm'];
        $this->joint_disease_nephritic = $a['joint_disease_nephritic'];
        $this->joint_disease_myocardial = $a['joint_disease_myocardial'];
        $this->joint_disease_paralysis = $a['joint_disease_paralysis'];
        $this->smork = $a['smork'];
        $this->bmi = $a['bmi'];
        $this->height = $a['height'];
        $this->weight = $a['weight'];
        $this->round = $a['round'];
        $this->temperature = $a['temperature'];
        $this->pause = $a['pause'];
        $this->rate = $a['rate'];
        $this->bp1 = $a['bp1'];
        $this->bp2 = $a['bp2'];
        $this->officer = $a['officer'];
        $this->officer_edit = $a['officer_edit'];
        $this->register_date = date("Y-m-d H:i:s");
        $this->pension = $a['pension'];
        $this->age_str = $a['age_str'];
        $this->diag_date = $a['diag_date'];
        $this->bp3 = $a['bp3'];
        $this->bp4 = $a['bp4'];
        $this->ecgCxr = $a['ecgCxr'];
        $this->dateEcgCxr = $a['dateEcgCxr'];
        $this->albumin = $a['albumin'];
        $this->dateAlbumin = $a['dateAlbumin'];
        $this->albuminLabnumber = $a['albuminLabnumber'];
        $this->creatinine = $a['creatinine'];
        $this->dateCreatinine = $a['dateCreatinine'];
        $this->creatinineLabnumber = $a['creatinineLabnumber'];
    }

    public function insert(){

        $sql = sprintf("INSERT INTO `hypertension_clinic` (
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
            NULL, '%s', '%s', '%s', '%s', '%s', 
            '%s', '%s', '%s', '%s', '%s', '%s', 
            '%s', '%s', '%s', '%s', '%s', '%s', 
            '%s', '%s', '%s', '%s', '%s', '%s', 
            '%s', '%s', '%s', '%s', '%s', '%s', 
            '%s', '%s', '%s', '%s', '%s', '%s', 
            '%s', '%s', '%s', '%s', '%s', '%s'
        );",
        $this->dbi->real_escape_string($this->ht_no),
        $this->dbi->real_escape_string($this->thidate),
        $this->dbi->real_escape_string($this->dateN),
        $this->dbi->real_escape_string($this->hn),
        $this->dbi->real_escape_string($this->doctor),
        $this->dbi->real_escape_string($this->ptname),
        $this->dbi->real_escape_string($this->ptright),
        $this->dbi->real_escape_string($this->sex),
        $this->dbi->real_escape_string($this->diagnosis),
        $this->dbi->real_escape_string($this->ht),
        $this->dbi->real_escape_string($this->joint_disease),
        $this->dbi->real_escape_string($this->joint_disease_dm),
        $this->dbi->real_escape_string($this->joint_disease_nephritic),
        $this->dbi->real_escape_string($this->joint_disease_myocardial),
        $this->dbi->real_escape_string($this->joint_disease_paralysis),
        $this->dbi->real_escape_string($this->smork),
        $this->dbi->real_escape_string($this->bmi),
        $this->dbi->real_escape_string($this->height),
        $this->dbi->real_escape_string($this->weight),
        $this->dbi->real_escape_string($this->round),
        $this->dbi->real_escape_string($this->temperature),
        $this->dbi->real_escape_string($this->pause),
        $this->dbi->real_escape_string($this->rate),
        $this->dbi->real_escape_string($this->bp1),
        $this->dbi->real_escape_string($this->bp2),
        $this->dbi->real_escape_string($this->officer),
        $this->dbi->real_escape_string($this->officer_edit),
        $this->dbi->real_escape_string($this->register_date),
        $this->dbi->real_escape_string($this->pension),
        $this->dbi->real_escape_string($this->age_str),
        $this->dbi->real_escape_string($this->diag_date),
        $this->dbi->real_escape_string($this->bp3),
        $this->dbi->real_escape_string($this->bp4),
        $this->dbi->real_escape_string($this->ecgCxr),
        $this->dbi->real_escape_string($this->dateEcgCxr),
        $this->dbi->real_escape_string($this->albumin),
        $this->dbi->real_escape_string($this->dateAlbumin),
        $this->dbi->real_escape_string($this->albuminLabnumber),
        $this->dbi->real_escape_string($this->creatinine),
        $this->dbi->real_escape_string($this->dateCreatinine),
        $this->dbi->real_escape_string($this->creatinineLabnumber));
        $q = $this->dbi->query($sql);
        if($this->dbi->error){
            $msg = $this->dbi->error ? $this->dbi->error : 'ไม่พบข้อมูล' ;
            $res = array('error_code'=>400, 'error'=>true, 'msg'=>$msg);
        }else{
            $res = array('hypertension_id' => $this->dbi->insert_id);
        }

        return $res;

    }

    public function update(){
        $sql = sprintf("UPDATE `hypertension_clinic` SET 
        `thidate` = '%s', 
        `doctor` = '%s', 
        `ptname` = '%s', 
        `ptright` = '%s', 
        `sex` = '%s', 
        `ht` = '%s', 
        `joint_disease_dm` = '%s', 
        `joint_disease_nephritic` = '%s', 
        `joint_disease_myocardial` = '%s', 
        `joint_disease_paralysis` = '%s', 
        `smork` = '%s', 
        `bmi` = '%s', 
        `height` = '%s', 
        `weight` = '%s', 
        `round` = '%s', 
        `temperature` = '%s', 
        `pause` = '%s', 
        `rate` = '%s', 
        `bp1` = '%s', 
        `bp2` = '%s', 
        `officer_edit` = '%s', 
        `diag_date` = '%s', 
        `bp3` = '%s', 
        `bp4` = '%s', 
        `ecgCxr` = '%s', 
        `dateEcgCxr` = '%s', 
        `albumin` = '%s', 
        `dateAlbumin` = '%s', 
        `albuminLabnumber` = '%s', 
        `creatinine` = '%s', 
        `dateCreatinine` = '%s', 
        `creatinineLabnumber` = '%s' 
        WHERE `row_id` = '%s' ",
        $this->dbi->real_escape_string($this->thidate),
        $this->dbi->real_escape_string($this->doctor),
        $this->dbi->real_escape_string($this->ptname),
        $this->dbi->real_escape_string($this->ptright),
        $this->dbi->real_escape_string($this->sex),
        $this->dbi->real_escape_string($this->ht),
        $this->dbi->real_escape_string($this->joint_disease_dm),
        $this->dbi->real_escape_string($this->joint_disease_nephritic),
        $this->dbi->real_escape_string($this->joint_disease_myocardial),
        $this->dbi->real_escape_string($this->joint_disease_paralysis),
        $this->dbi->real_escape_string($this->smork),
        $this->dbi->real_escape_string($this->bmi),
        $this->dbi->real_escape_string($this->height),
        $this->dbi->real_escape_string($this->weight),
        $this->dbi->real_escape_string($this->round),
        $this->dbi->real_escape_string($this->temperature),
        $this->dbi->real_escape_string($this->pause),
        $this->dbi->real_escape_string($this->rate),
        $this->dbi->real_escape_string($this->bp1),
        $this->dbi->real_escape_string($this->bp2),
        $this->dbi->real_escape_string($this->officer_edit),
        $this->dbi->real_escape_string($this->diag_date),
        $this->dbi->real_escape_string($this->bp3),
        $this->dbi->real_escape_string($this->bp4),
        $this->dbi->real_escape_string($this->ecgCxr),
        $this->dbi->real_escape_string($this->dateEcgCxr),
        $this->dbi->real_escape_string($this->albumin),
        $this->dbi->real_escape_string($this->dateAlbumin),
        $this->dbi->real_escape_string($this->albuminLabnumber),
        $this->dbi->real_escape_string($this->creatinine),
        $this->dbi->real_escape_string($this->dateCreatinine),
        $this->dbi->real_escape_string($this->creatinineLabnumber),
        $this->dbi->real_escape_string($this->row_id));
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

        $sql = sprintf("INSERT INTO `hypertension_history` (
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
            '%s', '%s', '%s', '%s', '%s', 
            '%s', '%s', '%s', '%s', '%s', '%s', 
            '%s', '%s', '%s', '%s', '%s', '%s', 
            '%s', '%s', '%s', '%s', '%s', '%s', 
            '%s', '%s', '%s', '%s', '%s', '%s', 
            '%s', '%s', '%s', '%s', '%s', '%s', 
            '%s', '%s', '%s', '%s', '%s', '%s'
        );",
        $this->dbi->real_escape_string($this->ht_no),
        $this->dbi->real_escape_string($this->thidate),
        $this->dbi->real_escape_string($this->dateN),
        $this->dbi->real_escape_string($this->hn),
        $this->dbi->real_escape_string($this->doctor),
        $this->dbi->real_escape_string($this->ptname),
        $this->dbi->real_escape_string($this->ptright),
        $this->dbi->real_escape_string($this->sex),
        $this->dbi->real_escape_string($this->diagnosis),
        $this->dbi->real_escape_string($this->ht),
        $this->dbi->real_escape_string($this->joint_disease),
        $this->dbi->real_escape_string($this->joint_disease_dm),
        $this->dbi->real_escape_string($this->joint_disease_nephritic),
        $this->dbi->real_escape_string($this->joint_disease_myocardial),
        $this->dbi->real_escape_string($this->joint_disease_paralysis),
        $this->dbi->real_escape_string($this->smork),
        $this->dbi->real_escape_string($this->bmi),
        $this->dbi->real_escape_string($this->height),
        $this->dbi->real_escape_string($this->weight),
        $this->dbi->real_escape_string($this->round),
        $this->dbi->real_escape_string($this->temperature),
        $this->dbi->real_escape_string($this->pause),
        $this->dbi->real_escape_string($this->rate),
        $this->dbi->real_escape_string($this->bp1),
        $this->dbi->real_escape_string($this->bp2),
        $this->dbi->real_escape_string($this->officer),
        $this->dbi->real_escape_string($this->officer_edit),
        $this->dbi->real_escape_string($this->register_date),
        $this->dbi->real_escape_string($this->pension),
        $this->dbi->real_escape_string($this->age_str),
        $this->dbi->real_escape_string($this->diag_date),
        $this->dbi->real_escape_string($this->bp3),
        $this->dbi->real_escape_string($this->bp4),
        $this->dbi->real_escape_string($this->ecgCxr),
        $this->dbi->real_escape_string($this->dateEcgCxr),
        $this->dbi->real_escape_string($this->albumin),
        $this->dbi->real_escape_string($this->dateAlbumin),
        $this->dbi->real_escape_string($this->albuminLabnumber),
        $this->dbi->real_escape_string($this->creatinine),
        $this->dbi->real_escape_string($this->dateCreatinine),
        $this->dbi->real_escape_string($this->creatinineLabnumber));
        
        $q = $this->dbi->query($sql);
        if($this->dbi->error){
            $msg = $this->dbi->error ? $this->dbi->error : 'ไม่พบข้อมูล' ;
            $res = array('error_code'=>400, 'error'=>true, 'msg'=>$msg);
        }else{
            $res = array('hypertension_history_id' => $this->dbi->insert_id);
        }
        return $res;

    }
    public function update_history(){
        $sql = sprintf("UPDATE `hypertension_history` SET 
        `thidate` = '%s', 
        `doctor` = '%s', 
        `ptname` = '%s', 
        `ptright` = '%s', 
        `sex` = '%s', 
        `ht` = '%s', 
        `joint_disease_dm` = '%s', 
        `joint_disease_nephritic` = '%s', 
        `joint_disease_myocardial` = '%s', 
        `joint_disease_paralysis` = '%s', 
        `smork` = '%s', 
        `bmi` = '%s', 
        `height` = '%s', 
        `weight` = '%s', 
        `round` = '%s', 
        `temperature` = '%s', 
        `pause` = '%s', 
        `rate` = '%s', 
        `bp1` = '%s', 
        `bp2` = '%s', 
        `officer_edit` = '%s', 
        `diag_date` = '%s', 
        `bp3` = '%s', 
        `bp4` = '%s', 
        `ecgCxr` = '%s', 
        `dateEcgCxr` = '%s', 
        `albumin` = '%s', 
        `dateAlbumin` = '%s', 
        `albuminLabnumber` = '%s', 
        `creatinine` = '%s', 
        `dateCreatinine` = '%s', 
        `creatinineLabnumber` = '%s' 
        WHERE `id` = '%s' ",
        $this->dbi->real_escape_string($this->thidate),
        $this->dbi->real_escape_string($this->doctor),
        $this->dbi->real_escape_string($this->ptname),
        $this->dbi->real_escape_string($this->ptright),
        $this->dbi->real_escape_string($this->sex),
        $this->dbi->real_escape_string($this->ht),
        $this->dbi->real_escape_string($this->joint_disease_dm),
        $this->dbi->real_escape_string($this->joint_disease_nephritic),
        $this->dbi->real_escape_string($this->joint_disease_myocardial),
        $this->dbi->real_escape_string($this->joint_disease_paralysis),
        $this->dbi->real_escape_string($this->smork),
        $this->dbi->real_escape_string($this->bmi),
        $this->dbi->real_escape_string($this->height),
        $this->dbi->real_escape_string($this->weight),
        $this->dbi->real_escape_string($this->round),
        $this->dbi->real_escape_string($this->temperature),
        $this->dbi->real_escape_string($this->pause),
        $this->dbi->real_escape_string($this->rate),
        $this->dbi->real_escape_string($this->bp1),
        $this->dbi->real_escape_string($this->bp2),
        $this->dbi->real_escape_string($this->officer_edit),
        $this->dbi->real_escape_string($this->diag_date),
        $this->dbi->real_escape_string($this->bp3),
        $this->dbi->real_escape_string($this->bp4),
        $this->dbi->real_escape_string($this->ecgCxr),
        $this->dbi->real_escape_string($this->dateEcgCxr),
        $this->dbi->real_escape_string($this->albumin),
        $this->dbi->real_escape_string($this->dateAlbumin),
        $this->dbi->real_escape_string($this->albuminLabnumber),
        $this->dbi->real_escape_string($this->creatinine),
        $this->dbi->real_escape_string($this->dateCreatinine),
        $this->dbi->real_escape_string($this->creatinineLabnumber),
        $this->dbi->real_escape_string($this->history_id));

        $q = $this->dbi->query($sql);
        if($this->dbi->error){
            $msg = $this->dbi->error ? $this->dbi->error : 'ไม่พบข้อมูล' ;
            $res = array('error_code'=>400, 'error'=>true, 'msg'=>$msg);
        }else{
            $res = array('status' => 200);
        }
        return $res;
    }

}