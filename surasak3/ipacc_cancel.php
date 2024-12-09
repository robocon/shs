<?php 
require_once 'bootstrap.php';
require_once 'includes/JSON.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$json = new Services_JSON();

$id = sprintf("%s", $_REQUEST['id']);

// $sql = "SELECT * FROM `ipacc` WHERE `officemon` = '$id' LIMIT 1 ";


$sql = "SELECT * FROM `ipacc` WHERE `row_id` = '$id' AND `officemon` IS NULL LIMIT 1 ";
$q = $dbi->query($sql);
if($q->num_rows>0){

    $ipacc = $q->fetch_assoc();
    $thidate = (date('Y')+543).date('-m-d H:i:s');
    $ipaccId = $ipacc['row_id'];
    $an = $ipacc['an'];
    $code = $ipacc['code'];
    $depart = $ipacc['depart'];
    $detail = $ipacc['detail'];

    $amount = $ipacc['amount']*-1;
    $price = $ipacc['price']*-1;
    $paid = $ipacc['paid']*-1;
    $part = $ipacc['part'];
    $yprice = $ipacc['yprice']*-1;
    $nprice = $ipacc['nprice']*-1;

    $idname = sprintf("%s", $_SESSION['sOfficer']);

    $sql = "UPDATE `ipacc` SET `officemon` = 'ยกเลิก' WHERE `row_id` = '$ipaccId' ";
    $dbi->query($sql);
    
    // เอา row_id ไปใส่ใน officemon เพื่อให้ relation กันว่า item นี้เคย cancel ไปแล้ว
    $sql = "INSERT INTO `ipacc` (
    `row_id`, `date`, `an`, `code`, `depart`, `detail`, 
    `amount`, `price`, `paid`, `part`, `yprice`, `nprice`, 
    `idname`, `accno`, `idno`, `startdatetime`, `enddatetime`, `status`, 
    `billno`, `officemon`, `ptright`) 
    VALUES 
    (NULL, '$thidate', '$an', '$code', '$depart', '$detail', 
    '$amount', '$price', '$paid', '$part', '$yprice', '$nprice', 
    '$idname', '1', '0', NULL, NULL, 
    '', NULL, '$ipaccId', NULL);";
    $q = $dbi->query($sql);

    $res = array('status'=>200,'message'=>'บันทึกข้อมูลเรียบร้อย');
    if ($q==false) {
        $res = array('status'=>400, 'message'=>'ไม่สามารถบันทึกข้อมูลได้', 'error'=>$dbi->error);
    }
    
}else{
    $res = array('status'=>400, 'message'=>'รายการนี้เคยยกเลิกข้อมูลไปแล้ว');
}
echo $json->encode($res);