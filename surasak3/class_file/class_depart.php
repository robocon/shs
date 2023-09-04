<?php 

require_once 'class_file/opcard.php';
require_once 'class_file/opday.php';

class ClassDepart{

    public $dbi;
    public function __construct()
    {
        $this->dbi = new mysqli(HOST,USER,PASS,DB);
        if ($this->dbi->connect_errno) {
            var_dump($this->dbi->error);
            exit;
        }
        $this->dbi->query("SET NAMES UTF8");
        return $this->dbi;
    }

    /**
     * รันเลข runno ใน depart เอาไปใช้ในฟิลด์ chktranx
     */
    public function startRunno(){
        $q_runno = $this->dbi->query("SELECT `title`,`prefix`,`runno` FROM `runno` WHERE `title` = 'depart'");
        $runno_row = $q_runno->fetch_assoc();
		$chktranx = $runno_row['runno'];
		$chktranx++;
        $this->dbi->query("UPDATE `runno` SET `runno` = '$chktranx' WHERE `title`='depart'");
        return $chktranx;
    }

    public function getThDateTime(){
        return (date('Y')+543).date('-m-d H:i:s');
    }

    public function getOfficer(){
        return $_SESSION['sOfficer'];
    }

    public function getDepartFromId($id=null){
        if ($id===null) {
            return "required id";
            exit;
        }

        $sql = sprintf("SELECT * FROM depart WHERE row_id = %s LIMIT 1", $id);
        $q = $this->dbi->query($sql);
        $res = array();
        if($q->num_rows>0){
            $res = $q->fetch_assoc();
            $q->free_result();
        }else{
            return "not found data";
            exit;
        }
        return $res;

    }

    /**
     * ดึงข้อมูลจากใน depart 
     * required    date รูปแบบวันที่ของไทย
     *             hn เลขที่ผู้มารับบริการ
     * optional    depart เอาไว้แยกตามประเภท
     */
    public function getDepart($date=null, $hn=null, $depart=null){

        if ($date==null OR $hn===null) {
            return "getDepart required date(THAI FORMAT IN YYYY-mm-dd) and HN";
            exit;
        }

        $sql = "SELECT * FROM depart WHERE date LIKE '$date%' AND hn = '$hn' ";
        if ($depart!==null) {
            $sql .= " AND depart = '$depart' ";
        }

        $q = $this->dbi->query($sql);
        $items = array();
        while ($a = $q->fetch_assoc()) {
            $items[] = $a;
        }
        return $items;
    }

    /**
     * เพิ่มข้อมูลค่าใช้จ่ายของแลปใน depart เท่านั้น
     */
    public function insertOnlyDepart(
        $hn=null, 
        $detail='',             // รายละเอียดว่าตรวจอะไร
        $diag='', 
        $labItems=array(),      // มีรายการตรวจอะไรบ้างเอาไปคำนวณค่าใช้จ่าย
        $officer='',            // จนท.ผู้บันทึก
        $cashok='',             // สถานะการเก็บเงิน(ดีดลูกหนี้)
        $nLab_orderhead = '',   // เลขที่แลป
        $depart=''              // แผนก
    ){ 

        $opday = new Opday();
        $op = $opday->getThisDay($hn);
        if ($op===false) {
            return "ไม่มีข้อมูลการออก VN ในวันนี้";
            exit;
        }

        $ptright = $op['ptright'];
        $ptname = $op['ptname'];
        $vn = $op['vn'];

        $labprice = $this->getPrice($labItems);
        $sumPrice = $labprice['sumPrice'];
        $sumYPrice = $labprice['sumYPrice'];
        $sumNPrice = $labprice['sumNPrice'];

        $runnoChktranx = $this->startRunno();
        $thaiDateTime = $this->getThDateTime();
        $countItem = count($labItems);
        if (empty($officer)) {
            $officer = $this->getOfficer();
        }
        
        $sql_depart = "INSERT INTO `depart` ( 
            `chktranx`, `date`, `ptname`, `hn`, `doctor`, `depart`, 
            `item`, `detail`, `price`, `sumyprice`, `sumnprice`, 
            `idname`, `diag`, `tvn`, `ptright`, `lab`, `status` ,
            `cashok`, `paid`
        ) VALUES ( 
            '$runnoChktranx', '$thaiDateTime', '$ptname', '$hn', 'MD022 (ไม่ทราบแพทย์)', '$depart', 
            '$countItem', '$detail', '$sumPrice', '$sumYPrice', '$sumNPrice', 
            '$officer', '$diag', '$vn', '$ptright', '$nLab_orderhead', 'Y', 
            '$cashok', '$sumPrice'
        )";
        
        $depart_save = $this->dbi->query($sql_depart);
        if($depart_save==false){
            return $this->dbi->error;

        }
        $departId = $this->dbi->insert_id;
        return $departId;

    }

    // public $labList = array();
    public function getPrice($labItems){
        $sumPrice = 0;
        $sumYPrice = 0;
        $sumNPrice = 0;
        foreach ($labItems as $key => $lab_code) { 

            $sql_labcare = sprintf("SELECT `code`,`oldcode`,`detail`,`price`,`yprice`,`nprice`,`depart`,`part` FROM `labcare` WHERE `code` = '%s' ", $lab_code);
            $q = $this->dbi->query($sql_labcare);
            if ($q->num_rows > 0) { 

                // $this->labList[] = $labcare = $q->fetch_assoc();
                $labcare = $q->fetch_assoc();
                $sumPrice += $labcare['price'];
                $sumYPrice += $labcare['yprice'];
                $sumNPrice += $labcare['nprice'];

            }
            
        } // End foreach รายการแลป

        return array(
            'sumPrice' => number_format($sumPrice, 2),
            'sumYPrice' => number_format($sumYPrice, 2),
            'sumNPrice' => number_format($sumNPrice, 2)
        );
    }

    public function insertXrayOnlyDepart(
        $hn=null, 
        $detail='', 
        $diag='', 
        $xrayItems=array(),
        $officer='',
        $cashok=''
    ){

        $opday = new Opday();
        $op = $opday->getThisDay($hn);
        if ($op===false) {
            return "ไม่มีข้อมูลการออก VN ในวันนี้";
            exit;
        }

        $ptright = $op['ptright'];
        $ptname = $op['ptname'];
        $vn = $op['vn'];

        $labprice = $this->getPrice($xrayItems);
        $sumPrice = $labprice['sumPrice'];
        $sumYPrice = $labprice['sumYPrice'];
        $sumNPrice = $labprice['sumNPrice'];

        // //////////////////////////////
        // ////////// RUNNO DEPART
        // //////////////////////////////
        // $q_runno = $this->dbi->query("SELECT `title`,`prefix`,`runno` FROM `runno` WHERE `title` = 'depart'");
        // $runno_row = $q_runno->fetch_assoc();
		// $chktranx = $runno_row['runno'];
		// $chktranx++;
        // $this->dbi->query("UPDATE `runno` SET `runno` = $chktranx WHERE `title`='depart'");
        // //////////////////////////////
        // ////////// RUNNO DEPART
        // //////////////////////////////




        $runnoChktranx = $this->startRunno();
        $thaiDateTime = $this->getThDateTime();
        $countItem = count($xrayItems);
        if (empty($officer)) {
            $officer = $this->getOfficer();
        }

        $sql_depart = "INSERT INTO `depart` ( 
            `chktranx`, `date`, `ptname`, `hn`, `doctor`, `depart`, 
            `item`, `detail`, `price`, `sumyprice`, `sumnprice`, 
            `idname`, `diag`, `tvn`, `ptright`, `lab`, `status` 
        ) VALUES ( 
            '$runnoChktranx', '$thaiDateTime', '$ptname', '$hn', 'MD022 (ไม่ทราบแพทย์)', 'XRAY', 
            '$countItem', '$detail', '$sumPrice', '$sumYPrice', '$sumNPrice', 
            '$officer', '$diag', '$vn', '$ptright', '', 'Y' 
        )";
        $depart_save = $this->dbi->query($sql_depart);
        if($depart_save==false){
            die($this->dbi->error);
        }
        $depart_id = $this->dbi->insert_id;
        return $depart_id;
    }
    
}

