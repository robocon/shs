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
require_once 'bootstrap.php';
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

    private $labList = array();
    private $labnumber = false;
    private $nLab = false;
    
    public function __construct($settings=NULL)
    {
        $labnumberType = $settings['labnumberType'];

        $this->dbi = new mysqli(HOST,USER,PASS,DB);
        $this->dbi->query("SET NAMES UTF8");
    }

    public function orderLab($labItems=array()){ 

        if(empty($this->clinicalinfo)){
            $clinicalinfo = implode(',', $labItems);
        }else{

            // 
            $clinicalinfo = $this->clinicalinfo;
        }
        
        $q_opcard = $this->dbi->query("SELECT toEn(`dbirth`) AS `dbirth`,IF(`sex`='ช', 'M', 'F') AS `sex`, CONCAT(`yot`,`name`,' ', `surname`) AS `ptname`,`ptright` FROM `opcard` WHERE `hn` = '$this->hn' ");
        $user = $q_opcard->fetch_assoc();
        $dbirth = $user['dbirth'];
        $gender = $user['sex'];
        $ptname = $user['ptname'];
        $ptright = $user['ptright'];

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
            '$count_item', 'ค่าตรวจวิเคราะห์โรค', '$sumPrice', '$sumYPrice', '$sumNPrice', '0', 
            'สุวสิริ สุวรรณจักร์', 'ตรวจสุขภาพ', '$this->vn', '$ptright', '$this->nLab', 'Y' 
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
                '$thai_date', '$this->hn', '$ptname', 'MD022 (ไม่ทราบแพทย์)', '$count_item', '$code', 
                '$detail', '1', '$price', '$nprice', '$yprice', 'PATHO', 
                'LAB', '$depart_id', '$ptright', 'Y' 
             )";
            $this->dbi->query($sql_patdata);
        }
    }

}
