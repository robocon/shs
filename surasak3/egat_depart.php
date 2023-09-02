<?php 
include 'bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$sql = "SELECT b.* 
FROM( 
    SELECT HN,exam_no,idcard,CONCAT(name,' ',surname) AS ptname FROM opcardchk WHERE part = 'บริษัท รักษาความปลอดภัย เอเอสเอ็ม แมเนจเมนท์ จำกัด (โรงไฟฟ้าแม่เมาะ) ส.ค.66' 
) AS a LEFT JOIN (
    SELECT row_id,thidate,hn,vn,ptname FROM opday WHERE thidate LIKE '2566-08-31%'
) AS b ON b.hn = a.hn";
$q = $dbi->query($sql);
if ($q->num_rows > 0) {
    # code...
    while ($a = $q->fetch_assoc()) { 
        # code...
        dump($a);
    }
}


// INSERT INTO `sm3db-utf8`.`depart` (`row_id`, `chktranx`, `date`, `ptname`, `hn`, `an`, `doctor`, `depart`, `item`, `detail`, `price`, `sumyprice`, `sumnprice`, `paid`, `idname`, `diag`, `accno`, `tvn`, `ptright`, `lab`, `cashok`, `detailbydr`, `status`, `priority`, `patient_from`, `staf_massage`, `lastupdate`) VALUES ('4657021', '5097582', '2566-08-31 09:59:33', 'นาย เจษฎากร  คำปา', '64-3179', '', 'MD022 (ไม่ทราบแพทย์)', 'XRAY', '1', 'ค่าตรวจวิเคราะห์โรค', '170.00', '170.00', '0.00', '170.00', 'เมธินี พลเมฆ', 'ตรวจสุขภาพ', '0', '8', 'R01 เงินสด', '', 'PAYCHKUP66', '', 'Y', '', '', '', '');



exit;

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
    '$this->sOfficer', 'ตรวจสุขภาพ', '$this->vn', '$ptright', '$nLab_orderhead', 'Y' 
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
?>