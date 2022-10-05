<?php
require_once 'class_file/opcard.php';

class Opday
{
    private $dbi = null;

    public $toborow = '';
    public $ptright = '';
    public $sOfficer = '';

    public function __construct()
    {
        $this->dbi = new mysqli(HOST,USER,PASS,DB);
        $this->dbi->query("SET NAMES UTF8");
        if($this->dbi->connect_error){
            die("Connection failed: ".$this->dbi->connect_error);
        }
    }

    public function getThisDay($hn=null)
    {
        $sql = sprintf("SELECT * FROM `opday` WHERE `thdatehn` = '%s' ", 
            date('d-m-').(date('Y')+543).$this->dbi->escape_string($hn)
        );
        $q = $this->dbi->query($sql);
        $opday = false;
        if($q->num_rows > 0){
            $opday = $q->fetch_assoc();
        }
        return $opday;
    }

    /**
     * @param string $hn 
     * @param string $toborow รายการเพื่อบอกว่าผู้ป่วยมารับบริการอะไรในวันนั้น เช่น EX26 ตรวจสุขภาพประจำปี
     * 
     * @return array จาก getThisDay
     */
    public function createOpday($hn=null){

        $opcard = new Opcard();
        $pt = $opcard->getByHn($hn);
        $cPtname = $pt['yot'].$pt['name'].' '.$pt['surname'];
        $cPtright = $pt['ptright'];
        $cGoup = $pt['goup'];
        $cCamp = $pt['camp'];
        $cNote = $pt['note'];
        $cIdcard = $pt['idcard'];
        $toborow = '';
        if(!empty($this->toborow)){
            $toborow = $this->toborow;
        }
        if(!empty($this->ptright)){
            $cPtright = $this->ptright;
        }
        
        $vn = $this->getVn();
        
        $thidate = (date('Y')+543).date('-m-d H:i:s');
        $thdatehn = date('d-m-').(date('Y')+543).$hn;
        $thdatevn = date('d-m-').(date('Y')+543).$vn;

        $query = "INSERT INTO opday(
        `thidate`,`thdatehn`,`hn`,`vn`,`thdatevn`,`ptname`,
        `ptright`,`goup`,`camp`,`note`,`toborow`,`idcard`,
        `officer`,`checkdx`) VALUES
        ('$thidate','$thdatehn','$hn','$vn','$thdatevn','$cPtname',
        '$cPtright','$cGoup','$cCamp','$cNote','$toborow',' $cIdcard',
        '$this->sOfficer','sso');";
        $save = $this->dbi->query($query);
        if($save===true){
            return $this->getThisDay($hn);
        }else{
            return $this->dbi->error;
        }

    }

    /**
     * @return $nVn ออกVN
     */
    private function getVn(){
        $q_runno = $this->dbi->query("SELECT *,SUBSTRING(`startday`,1,10) AS `startday` FROM `runno` WHERE `title` = 'VN'");
        $run = $q_runno->fetch_assoc();

        $nVn = $run['runno'];
        $dVndate = $run['startday'];
        $today = date("Y-m-d"); 
        
        // ถ้าวันที่เท่ากันก็รัน vn ต่อได้เลย
        if($today==$dVndate){
            $nVn++;
        }elseif ($today!=$dVndate) {
            $nVn = 1;
        }

        $this->dbi->query("UPDATE `runno` SET `runno` = '$nVn', `startday`='$today' WHERE `title`='VN'");

        return $nVn;
    }

    public function updateToborow($hn, $toborow){ 
        $thdatehn = date('d-m-').(date('Y')+543).$hn;
        $query = sprintf("UPDATE `opday` SET `toborow` = '%s' WHERE `thdatehn` = '%s'", $toborow, $thdatehn);
        $this->dbi->query($query);

    }

    public function update($row_id, $items=array()){ 

        if(count($items) > 1){ 
            $update = array();
            foreach ($items as $key => $value) {
                $update[] = sprintf("`$key` = '%s'", $value);
            }
            $update_txt = implode(', ', $update);
        }elseif (count($items) === 1) {
            $key = key($items);
            $value = $items[$key];
            $update_txt = sprintf("`$key` = '%s'", $value);
        }
        
        $sql = sprintf("UPDATE `opday` SET ".$update_txt." WHERE `row_id` = '%s'", $row_id);
        $this->dbi->query($sql);

        return $row_id;
    }
}
?>