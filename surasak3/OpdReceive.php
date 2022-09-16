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
    
    public function __construct($settings=NULL)
    {
        $labnumberType = $settings['labnumberType'];

        $this->dbi = new mysqli(HOST,USER,PASS,DB);
        $this->dbi->query("SET NAMES UTF8");
    }

    public function orderLab(array $labItems){ 

        $clinicalinfo = implode(',', $labItems);

        $q_opcard = $this->dbi->query("SELECT toEn(`dbirth`) AS `dbirth`,IF(`sex`='ช', 'M', 'F') AS `sex`, CONCAT(`yot`,`name`,' ', `surname`) AS `ptname` FROM `opcard` WHERE `hn` = '$this->hn' ");
        $user = $q_opcard->fetch_assoc();
        $dbirth = $user['dbirth'];
        $gender = $user['sex'];
        $ptname = $user['ptname'];

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

        // รูปแบบ labnumber 
        $labnumber = date("ymd").sprintf("%03d", $nLab);

        $orderhead_sql = "INSERT INTO `orderhead` ( 
            `autonumber`, `orderdate`, `labnumber`, `hn`, `patienttype`, `patientname`, 
            `sex`, `dob`, `sourcecode`, `sourcename`, `room`, `cliniciancode`, 
            `clinicianname`, `priority`, `clinicalinfo` 
        ) VALUES (
            NULL, 'NOW()', '$labnumber', '$this->hn', 'OPD', '$ptname', 
            '$gender', '$dbirth', '', '', '', '', 
            'MD022 (แพทย์เวชปฎิบัติ)', 'R', '$clinicalinfo'
        );";
        // $this->dbi->query($orderhead_sql);


        foreach ($labItems as $key => $item) { 
            $code = $this->dbi->escape_string($item);
            $q = $this->dbi->query("SELECT `code`,`oldcode`,`detail`,`price`,`yprice`,`nprice` FROM `labcare` WHERE `code` = '$item' ");

            if ($q->num_rows > 0) { 

                
                
                
                


                $nLab++;
                $query ="UPDATE runno SET runno = $nLab, startday = '$dLabdate' WHERE title='lab'";
                // $result = mysql_query($query) or die("Query failed");

            }

            

// รายการด้านล่างของ depart
// doctor
// detail
// idname
// diag
            // print_r($q->fetch_assoc());
            
        }
    }
}

$dbi = new mysqli(HOST, USER, PASS, DB);
$dbi->query("SET NAMES UTF8");

$hn = '48-683'; // $_REQUEST
$thiDate = (date('Y')+543).date('-m-d');
$q = $dbi->query("SELECT `vn` FROM `opday` WHERE `thidate` LIKE '$thiDate%' AND `hn` = '$hn' ");
// print_r("SELECT `vn` FROM `opday` WHERE `thidate` LIKE '$thidate' AND `hn` = '$hn' ");
// print_r($q);
if($q->num_rows > 0){

    $opday = $q->fetch_assoc();
    // print_r($opday);
    $a = new OpdReceive();
    $a->hn = $hn;
    $a->vn = $opday['vn']; 
    $a->orderLab(['cbc-sso','hdl']);
}


// 