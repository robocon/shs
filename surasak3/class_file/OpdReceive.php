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
require_once 'class_file/opday.php';
require_once 'class_file/opcard.php';
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
    public $labnumber = false;
    public $nLab = false;
    private $xrayList = array();
    private $thaiDate = false;
    private $thaiDateFull = false;
    
    public function __construct($settings=NULL)
    {
        $this->thaiDate = (date('Y')+543).date('-m-d');
        $this->thaiDateFull = $this->thaiDate.' '.date("H:i:s");

        $labnumberType = $settings['labnumberType'];

        $this->dbi = new mysqli(HOST,USER,PASS,DB);
        $this->dbi->query("SET NAMES UTF8");
    }

    public function findOrderLab()
    {
        $sql = sprintf("SELECT `row_id` FROM `depart` 
        WHERE `date` LIKE '%s%%' 
        AND `hn` = '%s' 
        AND `depart` = 'PATHO' 
        AND ( `status` != 'N' AND `price` > 0 ) ", $this->thaiDate, $this->hn);
        $q = $this->dbi->query($sql);
        $res = false;
        if($q->num_rows > 0)
        {   
            $item = $q->fetch_assoc();
            $res = $item['row_id'];
        }
        return $res;
    }

    public function setLabRunno($number){
        $this->nLab = $number;
    }

    public function getLabRunno(){
        return $this->nLab;
    }

    /**
     * บันทึกค่าใช้จ่ายของแลป
     * orderhead, orderdetail, depart, patdata
     * 
     * ต้องการค่า hn, vn, sOfficer, รายการแลป
     * optional มี clinicalinfo
     */
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

        
        // runno ของห้องแลป
        $q_runno = $this->dbi->query("SELECT `runno`, SUBSTRING(`startday`,1,10) AS `startday` FROM `runno` WHERE `title` = 'lab'");
        $row = $q_runno->fetch_assoc();
        $nLab = $row['runno'];
        $dLabdate = $row['startday'];

        //ถ้าขึ้นวันใหม่ให้ตีเป็น 1
        if(substr($dLabdate,0,10) != date("Y-m-d")){
            $nLab = 1;
            $dLabdate = date("Y-m-d 00:00:00");
        }else{
            $nLab++;
        }

        $query ="UPDATE runno SET `runno` = '$nLab', `startday` = '$dLabdate' WHERE `title`='lab'";
        $this->dbi->query($query);

        // รูปแบบ labnumber 
        $this->labnumber = $labnumber = date("ymd").sprintf("%03d", $nLab);
        
        $q_orderhead = $this->dbi->query("SELECT * FROM `orderhead` WHERE `hn`='$this->hn' AND `clinicalinfo = '$clinicalinfo' ");
        if($q_orderhead->num_rows == 0){
        
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
            foreach ($labItems as $key => $lab_code) { 

                $sql_labcare = sprintf("SELECT `code`,`oldcode`,`detail`,`price`,`yprice`,`nprice`,`depart`,`part` FROM `labcare` WHERE `code` = '%s' ", $lab_code);
                $q = $this->dbi->query($sql_labcare);
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

        }

        if($this->findOrderLab()==false){
        
            $q_chktranx = $this->dbi->query("SELECT `runno`, `startday` FROM `runno` WHERE `title` = 'depart'");
            $chktranx = $q_chktranx->fetch_assoc();
            $runno_chktranx = $chktranx['runno']+1;
            $thai_date = (date('Y')+543).date('-m-d H:i:s');
            $count_item = count($this->labList);
            $this->dbi->query("UPDATE `runno` SET `runno` = '$runno_chktranx' WHERE `title`='depart'");

            $sql_depart = "INSERT INTO `depart` ( 
                `chktranx`, `date`, `ptname`, `hn`, `doctor`, `depart`, 
                `item`, `detail`, `price`, `sumyprice`, `sumnprice`,  
                `idname`, `diag`, `tvn`, `ptright`, `lab`, `status` 
            ) VALUES ( 
                '$runno_chktranx', '$thai_date', '$ptname', '$this->hn', 'MD022 (ไม่ทราบแพทย์)', 'PATHO', 
                '$count_item', 'ตรวจสุขภาพประกันสังคม', '$sumPrice', '$sumYPrice', '$sumNPrice', 
                '$this->sOfficer', 'ตรวจสุขภาพ', '$this->vn', '$ptright', '$nLab', 'Y' 
            )";
            $depart_save = $this->dbi->query($sql_depart);
            if($depart_save==false){
                dump($this->dbi->error);
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
                    '$thai_date', '$this->hn', '$ptname', 'MD022 (ไม่ทราบแพทย์)', '$count_item', '$code', 
                    '$detail', '1', '$price', '$nprice', '$yprice', 'PATHO', 
                    'LAB', '$depart_id', '$ptright', 'Y' 
                )";
                $this->dbi->query($sql_patdata);
            }

        }

    }

    /**
     * บันทึก ค่าบริการผู้ป่วยนอก
     */
    public function insertOther()
    { 

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
        $this->dbi->query("UPDATE `runno` SET `runno` = '$chktranx' WHERE `title`='depart'");
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
            '0.00', '0.00', '$this->sOfficer', NULL, '0', '$vn', 
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

    public function findOther()
    {
        
        $sql = sprintf("SELECT `row_id` FROM `depart` WHERE `date` LIKE '%s%%' AND `hn` = '%s' AND `depart` = 'OTHER' AND `detail` = '(55020/55021 ค่าบริการผู้ป่วยนอก)' ", $this->thaiDate, $this->hn);
        $q = $this->dbi->query( $sql );
        $res = false;
        if($q->num_rows > 0)
        {
            $item = $q->fetch_assoc();
            $res = $item['row_id'];
        }
        return $res;
    }

    /**
     * ยังไม่ได้ปรับให้ insert หลายโค้ด
     */
    public function orderXray($xrayList=array())
    {
		$opc = new Opcard();
        $opItem = $opc->getByHn($this->hn,array('yot','name','surname','dbirth'));
        $yot = $opItem['yot'];
        $name = $opItem['name'];
        $surname = $opItem['surname'];
        $dbirth = $opItem['dbirth'];
        $age = $opc->getAge($dbirth);

        $sql_xray = sprintf("SELECT `code`,`oldcode`,`detail`,`price`,`yprice`,`nprice`,`depart`,`part` FROM `labcare` WHERE `code` = '%s' ", $xrayList['0']);
        $q_xray = $this->dbi->query($sql_xray);
        if ($q_xray->num_rows > 0) { 
            $xray = $q_xray->fetch_assoc();
            $code = $xray['code'];
            $detail = $xray['detail'];
            $sumPrice = $xray['price'];
            $sumYPrice = $xray['yprice'];
            $sumNPrice = $xray['nprice'];
        }

        $q_runno = $this->dbi->query("SELECT `title`,`prefix`,`runno` FROM `runno` WHERE `title` = 'xrayno'");
        $runno_row = $q_runno->fetch_assoc();
		$xray_no = $runno_row['runno'];
		$xray_no++;
        $this->dbi->query("UPDATE `runno` SET `runno` = '$xray_no' WHERE `title`='xrayno'");
        
		
		$sql_xray_doctor = "INSERT INTO `xray_doctor` (
            `date` ,`hn` ,`vn` ,`yot` ,`name` ,`sname` ,
            `detail` ,`doctor` ,`status` ,`xrayno` ,`film` ,`type_diag`,
            `detail_all`,`dbirth`,`orderby`
        )VALUES (
            '$this->thaiDateFull', '$this->hn', '$this->vn', '$yot', '$name', '$surname', 
            '1. CHEST CHECK UP', 'MD022 (ไม่ทราบแพทย์)', 'N', '$xray_no', 'digital', 'ตรวจสุขภาพ', 
            '1. CHEST CHECK UP', '$dbirth', 'XRAY'
        );";
        $xray_doctor_save = $this->dbi->query($sql_xray_doctor);
        if($xray_doctor_save==false){ 
            die($this->dbi->error);
        }
            
        $sql_xray_detail = "INSERT INTO `xray_doctor_detail` (
            `date` ,`hn` ,`xrayno` ,`doctor_detail`,`detail_all`
        )VALUES (
            '$this->thaiDateFull','$this->hn','$xray_no','1. CHEST CHECK UP','1. CHEST CHECK UP'
        );";
        $sql_xray_detail_save = $this->dbi->query($sql_xray_detail);
        if($sql_xray_detail_save==false){
            die($this->dbi->error);
        }

        $opday = new Opday();
        $op = $opday->getThisDay($this->hn);
        // $ptright = $op['ptright'];
        $ptright = 'R42 ตรวจสุขภาพลูกจ้างประจำปี';
        $ptname = $op['ptname'];

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

        $sql_depart = "INSERT INTO `depart` ( 
            `chktranx`, `date`, `ptname`, `hn`, `doctor`, `depart`, 
            `item`, `detail`, `price`, `sumyprice`, `sumnprice`, 
            `idname`, `diag`, `tvn`, `ptright`, `lab`, `status` 
        ) VALUES ( 
            '$chktranx', '$this->thaiDateFull', '$ptname', '$this->hn', 'MD022 (ไม่ทราบแพทย์)', 'XRAY', 
            '1', 'ตรวจสุขภาพประกันสังคม', '$sumPrice', '$sumYPrice', '$sumNPrice', 
            '$this->sOfficer', 'ตรวจสุขภาพ', '$this->vn', '$ptright', '', 'Y' 
        )";
        $depart_save = $this->dbi->query($sql_depart);
        if($depart_save==false){
            die($this->dbi->error);
        }
        $depart_id = $this->dbi->insert_id;

        $sql_patdata = "INSERT INTO `patdata` ( 
            `date`, `hn`, `ptname`, `doctor`, `item`, `code`, 
            `detail`, `amount`, `price`, `yprice`, `nprice`, `depart`, 
            `part`, `idno`, `ptright`, `film_size`, `status` 
        ) VALUES ( 
            '$this->thaiDateFull', '$this->hn', '$ptname', 'MD022 (ไม่ทราบแพทย์)', '1', '$code', 
            '$detail', '1', '$sumPrice', '$sumYPrice', '$sumNPrice', 'XRAY', 
            'XRAY', '$depart_id', '$ptright', 'DIGITA', 'Y' 
        )";
        $patdata_save = $this->dbi->query($sql_patdata);
        if($patdata_save==false){
            die($this->dbi->error);
        }

        $sql_xray_stat = "INSERT INTO `xray_stat` (
            `date` ,`hn` ,`xn` ,`xn_new` ,`ptname` ,`age` ,
            `ptright` ,`patient_from` ,`detail` ,`doctor` ,`digital` ,`10_12` ,
            `14_14` ,`NONE` ,`office` ,`idno`,`remark` 
        )VALUES ( 
            '$this->thaiDateFull', '$this->hn', '', '', '$ptname', '$age', 
            '$ptright', 'OPD', '1.CHEST CHECK UP', 'MD022 (ไม่ทราบแพทย์)', '1', '0', 
            '0', '0', '$this->sOfficer', '$depart_id', '$sumPrice'
        );";
        $xray_stat_save = $this->dbi->query($sql_xray_stat);
        if($xray_stat_save==false){
            die($this->dbi->error);
        }

    }

    public function findXray(){
        $sql = sprintf("SELECT `row_id` 
        FROM `depart` 
        WHERE `date` LIKE '%s%%' 
        AND `hn` = '%s' 
        AND `depart` = 'XRAY' 
        AND `status` != 'N' 
        AND `price` > 0", $this->thaiDate, $this->hn);
        $q = $this->dbi->query( $sql );
        $res = false;
        if($q->num_rows > 0)
        {
            $item = $q->fetch_assoc();
            $res = $item['row_id'];
        }
        return $res;
    }

}
