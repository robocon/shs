<?php
require_once 'class_file/opcard.php';

class Opday
{
    private $dbi = false;
    public function __construct()
    {
        $this->dbi = new mysqli(HOST,USER,PASS,DB);
        $this->dbi->query("SET NAMES UTF8");
    }

    public function getThisDay($hn)
    {
        $thDateHn = date('d-m-').(date('Y')+543).$hn;
        $q = $this->dbi->query("SELECT * FROM opday WHERE thdatehn = '$thDateHn' ");
        $opday = false;
        if($q->num_rows > 0){
            $opday = $q->fetch_assoc();
        }
        return $opday;
    }

    public function getAllDay($hn)
    {

    }

    public function createOpday($hn, $toborow){

        $opcard = new Opcard();
        $pt = $opcard->getOpcard($hn);
        $cPtname = $pt['yot'].$pt['name'].' '.$pt['surname'];
        $cPtright = $pt['ptright'];
        $cGoup = $pt['goup'];
        $cCamp = $pt['camp'];
        $cNote = $pt['note'];
        $cIdcard = $pt['idcard'];

        $vn = $this->getVn();
        
        $thidate = (date('Y')+543).date('-m-d H:i:s');
        $thdatehn = date('d-m-').(date('Y')+543).$hn;
        $thdatevn = date('d-m-').(date('Y')+543).$vn;

        $query = "INSERT INTO opday(
        `thidate`,`thdatehn`,`hn`,`vn`,`thdatevn`,`ptname`,
        `ptright`,`goup`,`camp`,`note`,`toborow`,`idcard`,
        `officer`) VALUES
        ('$thidate','$thdatehn','$hn','$vn','$thdatevn','$cPtname',
        '$cPtright','$cGoup','$cCamp','$cNote','$toborow',' $cIdcard',
        '".$_SESSION["sOfficer"]."'
        );";
        $save = $this->dbi->query($query);
        if($save===true){
            return $this->getThisDay($hn);
        }else{
            return $this->dbi->error;
        }

    }

    private function getVn(){
        $q_runno = $this->dbi->query("SELECT *,SUBSTRING(`startday`,1,10) AS `startday` FROM runno WHERE title = 'VN'");
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

        $this->dbi->query("UPDATE runno SET runno = $nVn WHERE title='VN'");

        return $nVn;
    }

    public function updateToborow($hn, $toborow){ 
        $thdatehn = date('d-m-').(date('Y')+543).$hn;
        $this->dbi->query("UPDATE `opday` SET `toborow` = '$toborow' WHERE `thdatehn` = '$thdatehn' ");
    }
}
?>