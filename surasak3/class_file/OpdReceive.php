<?php 
/**
 * ความตั้งใจในการสร้าง class ตัวนี้ขึ้นมาก็เพื่อใช้ยิงค่าใช้จ่ายเกี่ยวกับ lab เพราะขี้เกียจจะมาเขียนโปรแกรมทุกครั้งเมื่อมีการ
 * ทำงานเกี่ยวกับค่าใช้จ่ายของ lab ที่เป็นผู้ป่วยนอก
 * 
 * -== INPUT ==-
 * 1. HN
 * 2. VN
 * 3. Lab Code
 * 
 * default วันที่ปัจจุบัน
 * 
 * !!! ไม่เกี่ยวกับ ค่าบริการผู้ป่วยนอก หรือการสร้าง VN แต่อย่างใด
 * 
 * ตารางที่เกี่ยวข้อง 
 * 1. orderhead -> orderdetail 
 * 2. depart -> patdata
 * 
 */
require_once '../bootstrap.php';
require_once 'class_file/opday.php';
/**
 * !!! ตรวจ labnumber !!!  -->  อาจจะต้องมีเงื่อนไขหรือ setting อะไรสักอย่างเพื่อบอกว่า labnubmer เป็นแบบตรวจสุขภาพภายนอก
 * หรือ เป็นแบบ walk-in 
 * 
 * 
 */
class OpdReceive 
{
    private $dbi = false;

    public $hn = false;
    public $vn = false;
    public $clinicalinfo = false; // กำหนดชื่อ clinicalinfo เอง เช่น ตรวจสุขภาพประจำปี65
    public $custom_labnumber = false; // กำหนด labnumber เอง เช่น 650919301
    public $sOfficer = false;

    private $labList = array();
    private $labnumber = false;
    private $nLab = false;

    private $xrayList = array();
    
    public function __construct($settings=NULL)
    {
        $labnumberType = $settings['labnumberType'];

        $this->dbi = new mysqli(HOST,USER,PASS,DB);
        $this->dbi->query("SET NAMES UTF8");
    }

    public function orderLab($labItems=array())
    { 
        
        if(empty($this->clinicalinfo)){ 
            $clinicalinfo = implode(',', $labItems);

        }else{
            $clinicalinfo = $this->clinicalinfo;

        }
        
        $q_opcard = $this->dbi->query("SELECT toEn(`dbirth`) AS `dbirth`,IF(`sex`='ช', 'M', 'F') AS `sex`, CONCAT(`yot`,`name`,' ', `surname`) AS `ptname`,`ptright` FROM `opcard` WHERE `hn` = '$this->hn' ");
        $user = $q_opcard->fetch_assoc();
        $dbirth = $user['dbirth'];
        $gender = $user['sex'];
        
        // 
        $opday = new Opday();
        $op = $opday->getThisDay($this->hn);
        $ptright = $op['ptright'];
        $ptname = $op['ptname'];

        if(empty($this->custom_labnumber)){

            // runno ของห้องแลป
            $q_runno = $this->dbi->query("SELECT `runno`, SUBSTRING(`startday`,1,10) AS `startday` FROM `runno` WHERE `title` = 'lab'");
            $row = $q_runno->fetch_assoc();
            $nLab = $row['runno'];
            $dLabdate = $row['startday'];

            //ถ้าขึ้นวันใหม่ให้ตีเป็น 1
            if(substr($dLabdate,0,10) != date("Y-m-d")){
                $nLab = 1;
                $dLabdate = date("Y-m-d 00:00:00");
            }

            $this->nLab = $nLab;
            // รูปแบบ labnumber 
            $this->labnumber = $labnumber = date("ymd").sprintf("%03d", $nLab);

        }else{

            // กรณีใช้เลข labnumber แบบกำหนดเอง
            $this->labnumber = $labnumber = $this->custom_labnumber;

        }
        
        $orderhead_sql = "INSERT INTO `orderhead` ( 
            `autonumber`, `orderdate`, `labnumber`, `hn`, `patienttype`, `patientname`, 
            `sex`, `dob`, `sourcecode`, `sourcename`, `room`, `cliniciancode`, 
            `clinicianname`, `priority`, `clinicalinfo` 
        ) VALUES (
            NULL, NOW(), '$labnumber', '$this->hn', 'OPD', '$ptname', 
            '$gender', '$dbirth', '', '', '', '', 
            'MD022 (แพทย์เวชปฎิบัติ)', 'R', '$clinicalinfo'
        );";
        $orderhead_save = $this->dbi->query($orderhead_sql);
        if($orderhead_save==false){ 
            die($this->dbi->error);
        }

        $sumPrice = 0;
        $sumYPrice = 0;
        $sumNPrice = 0;
        foreach ($labItems as $key => $item) { 

            $lab_code = $this->dbi->escape_string($item);
            $q = $this->dbi->query("SELECT `code`,`oldcode`,`detail`,`price`,`yprice`,`nprice`,`depart`,`part` FROM `labcare` WHERE `code` = '$lab_code' ");
            if ($q->num_rows > 0) { 

                $this->labList[] = $labcare = $q->fetch_assoc();

                $sumPrice += $labcare['price'];
                $sumYPrice += $labcare['yprice'];
                $sumNPrice += $labcare['nprice'];

                $code = $labcare['code'];
                $oldcode = $labcare['oldcode'];
                $detail = $labcare['detail'];

                $orderdetail_sql = "INSERT INTO `orderdetail` ( 
                    `labnumber`,`labcode`,`labcode1`,`labname` 
                ) VALUES (
                    '$labnumber', '$code', '$oldcode', '".$detail."'
                );";
                $this->dbi->query($orderdetail_sql);

            }
            
        } // End foreach รายการแลป

        
        if(empty($this->custom_labnumber)){ 
            $nLab++;
            $query ="UPDATE runno SET runno = $nLab, startday = '$dLabdate' WHERE title='lab'";
            $this->dbi->query($query);
        }
        

        $q_runno_stk = $this->dbi->query("SELECT `runno`, `startday` FROM `runno` WHERE `title` = 'stktranx'");
        $nStktranx = $q_runno_stk->fetch_assoc();
		$runno_stk = $nStktranx['runno']+1;
        $thai_date = (date('Y')+543).date('-m-d H:i:s');
        $count_item = count($this->labList);

        // $itemPrice = array_column($this->labList, 'price');
        // $sumPrice = array_sum($itemPrice);

        // $itemYPrice = array_column($this->labList, 'yprice');
        // $sumYPrice = array_sum($itemYPrice);

        // $itemNPrice = array_column($this->labList, 'nprice');
        // $sumNPrice = array_sum($itemNPrice);

        $sql_depart = "INSERT INTO `depart` ( 
            `chktranx`, `date`, `ptname`, `hn`, `doctor`, `depart`, 
            `item`, `detail`, `price`, `sumyprice`, `sumnprice`, `paid`, 
            `idname`, `diag`, `tvn`, `ptright`, `lab`, `status` 
        ) VALUES ( 
            '$runno_stk', '$thai_date', '$ptname', '$this->hn', 'MD022 (ไม่ทราบแพทย์)', 'PATHO', 
            '$count_item', 'ตรวจสุขภาพประกันสังคม', '$sumPrice', '$sumYPrice', '$sumNPrice', '0', 
            '$this->sOfficer', 'ตรวจสุขภาพ', '$this->vn', '$ptright', '$this->nLab', 'Y' 
        )";
        $depart_save = $this->dbi->query($sql_depart);
        if($depart_save==false){
            die($this->dbi->error);
        }
        $depart_id = $this->dbi->insert_id;
        
        foreach ($this->labList as $lab) { 

            $code = $lab['code'];
            $detail = $lab['detail'];

            $price = $lab['price'];
            $nprice = $lab['nprice'];
            $yprice = $lab['yprice'];

            $sql_patdata = "INSERT INTO `patdata` ( 
                `date`, `hn`, `ptname`, `doctor`, `item`, `code`, 
                `detail`, `amount`, `price`, `yprice`, `nprice`, `depart`, 
                `part`, `idno`, `ptright`, `status` 
            ) VALUES ( 
                '$thai_date', '$this->hn', '$ptname', 'MD022 แพทย์เวชปฎิบัติ', '$count_item', '$code', 
                '$detail', '1', '$price', '$nprice', '$yprice', 'PATHO', 
                'LAB', '$depart_id', '$ptright', 'Y' 
             )";
            $this->dbi->query($sql_patdata);
        }
    }

    public function insertOther(){ 

        $opday = new Opday();
        $op = $opday->getThisDay($this->hn);
        $ptname = $op['ptname'];
        $hn = $op['hn'];
        $vn = $op['vn'];
        $ptright = $op['ptright'];

        $date = (date('Y')+543).date('-m-d H:i:s');

        //////////////////////////////
        ////////// RUNNO DEPART
        //////////////////////////////
        $q_runno = $this->dbi->query("SELECT `title`,`prefix`,`runno` FROM `runno` WHERE `title` = 'depart'");
        $runno_row = $q_runno->fetch_assoc();
		$chktranx = $runno_row['runno'];
		$chktranx++;
        $this->dbi->query("UPDATE `runno` SET `runno` = $chktranx WHERE `title`='depart'");
        //////////////////////////////
        ////////// RUNNO DEPART
        //////////////////////////////

        $depart_sql = "INSERT INTO `depart` (
            `row_id`, `chktranx`, `date`, `ptname`, `hn`, `an`, 
            `doctor`, `depart`, `item`, `detail`, `price`, `sumyprice`, 
            `sumnprice`, `paid`, `idname`, `diag`, `accno`, `tvn`, 
            `ptright`, `lab`, `cashok`, `detailbydr`, `status`, `priority`, 
            `patient_from`, `staf_massage`
        ) VALUES (
            NULL, '$chktranx', '$date', '$ptname', '$hn', '', 
            NULL, 'OTHER', '1', '(55020/55021 ค่าบริการผู้ป่วยนอก)', '50.00', '50.00', 
            '0.00', '50.00', '$this->sOfficer', NULL, '0', '$vn', 
            '$ptright', NULL, '', '', 'Y', '', 
            '', ''
        );";
        $this->dbi->query($depart_sql);
        $depart_id = $this->dbi->insert_id;

        $patdata_sql = "INSERT INTO `patdata` (
            `row_id`, `date`, `hn`, `an`, `ptname`, `copy`, 
            `doctor`, `item`, `code`, `detail`, `amount`, `price`, 
            `yprice`, `nprice`, `paid`, `depart`, `labcode`, `report`, 
            `part`, `idno`, `picture`, `ptright`, `film_size`, `status`, 
            `priority`, `tranipacc`
        ) VALUES (
            NULL, '$date', '$hn', '', '$ptname', NULL, 
            NULL, '1', 'SERVICE', '(55020/55021 ค่าบริการผู้ป่วยนอก)', '1', '50.00', 
            '50.00', '0.00', NULL, 'OTHER', NULL, NULL, 
            'OTHER', '$depart_id', NULL, '$ptright', NULL, 'Y', 
            '', ''
        );";
        $this->dbi->query($patdata_sql);

    }

    public function orderXray($xrayList=array())
    {
        dump($xrayList);

        // if($cDepart == 'XRAY'){
            //echo "==>$cDiag---->$aDetail";
        $sql = "Select xn From xrayno where hn = '".$cHn."' Order by row_id DESC limit 0,1 ";
        list($xn) = mysql_fetch_row(mysql_query($sql));
    
        $sql = "Select dbirth From opcard where hn = '".$cHn."' limit 0,1 ";
        list($dbirth) = mysql_fetch_row(mysql_query($sql));
        
        $age = "-";
            if(!empty($dbirth))
                $age = calcage($dbirth);
        $count = array();
        $stat_digital = 0;
        $stat_10_12 = 0;
        $stat_14_17 = 0;
        $stat_none = 0;
    
        foreach ($aFilmsize as $key => $value){
            
            //echo $value," ",strlen($value),"<BR>";
            switch($value){
                case 'DIGITAL': $stat_digital++; break;
                case '10*12': $stat_10_12++; break;
                case '14*17': $stat_14_17++; break;
                case 'NONE': $stat_none++; break;
            }
    
        }
        //echo substr($xn,-2)," - ",substr(date("Y")+543,-2);
        if(substr($xn,-2) == substr(date("Y")+543,-2)){
            $xn_new = $xn;
            $xn = "";
        }
    
        $sql = "INSERT INTO `xray_stat` (
            `date` ,`hn` ,`xn` ,`xn_new` ,`ptname` ,`age` ,
            `ptright` ,`patient_from` ,`detail` ,`doctor` ,`digital` ,`10_12` ,
            `14_14` ,`NONE` ,`office` ,`idno`,`remark` 
        )VALUES ( 
            '".$Thidate."', '".$cHn."', '".$xn."', '".$xn_new."', '".$cPtname."', '".$age."', 
            '".$cPtright."', '".$patient_from."', '".$_SESSION["cXraydetail"]."', '".$cDoctor."', '".$stat_digital."', '".$stat_10_12."', 
            '".$stat_14_17."', '".$stat_none."', '".$this->sOfficer."', '".$nRunno."', '".$Netprice."'
        );";
        $result = mysql_query($sql);
        //echo $sql,"<BR>";
        
        // }

    }

}
