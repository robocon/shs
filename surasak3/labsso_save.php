<?php

include 'bootstrap.php';
$db = Mysql::load();

$error = '';

$Thidate = ( date('Y') + 543 ).date('-m-d H:i:s');
$cPtname = $_SESSION['cPtname'];
$cHn = $_SESSION['cHn'];
$cAn = '';
$cDoctor = $_SESSION['cDoctor'];
$cDepart = $_SESSION['cDepart'];
$aDetail = $_SESSION['aDetail'];
$sOfficer = $_SESSION['sOfficer'];
$cDiag = $_SESSION['cDiag'];
$cAccno = $_SESSION['cAccno'];
$tvn = $_SESSION['tvn'];
$cPtright = $_SESSION['cPtright'];
$cstaf_massage = $_SESSION['cstaf_massage'];


$sql = "SELECT `exam_no` FROM `opcardchk` WHERE `HN` = '$cHn' AND `part` = 'ลูกจ้าง61' ";
$db->select($sql);
$opcardchk = $db->get_item();

// ดึงจาก exam_no
$nLab = $opcardchk['exam_no'];

############################################################
### จัดการ รายการใน orderdetail ก่อนที่จะเก็บเงิน
### กรณีที่ มีการแก้ไขรายการแลป
############################################################

// รายการทั้งหมด
$all_lab_lists = array_merge_recursive($_POST['sso_list'], $_POST['shs_list']);
$new_lab_lists = array();
foreach ($all_lab_lists as $key => $cl) {
    $new_lab_lists[] = str_replace('-sso', '', $cl);
}

// order ที่เพิ่มไปแล้ว
$sql = "SELECT * FROM `orderdetail` WHERE `labnumber` = '180422$nLab' ";
$db->select($sql);
$test_lab = $db->get_items();
$default_lab = array();
foreach ($test_lab as $key => $tl) {
    $default_lab[] = $tl['labcode'];
}

// หาตัวที่เพิ่มเข้ามาใหม่
$added_diff = array_diff($new_lab_lists, $default_lab);
if( count($added_diff) > 0 ){
    foreach( $added_diff as $key => $new_lab ){

        $lab_sql = "SELECT `code`,`oldcode`,`detail` 
        FROM `labcare` 
        WHERE `code` = '$new_lab' 
        LIMIT 1";
        $db->select($lab_sql);
        $lab_item = $db->get_item($lab_item);

        $insert_detail = "INSERT INTO `orderdetail` ( 
            `labnumber` , `labcode`, `labcode1` , `labname` 
        ) VALUES ( 
            '180422$nLab', '".$lab_item['code']."', '".$lab_item['oldcode']."', '".$lab_item['detail']."'
        );";
        $insert = $db->insert($insert_detail);
        
    }
}

// หาตัวที่โดนลบออกไป เพื่อลบใน orderdetail
$rm_diff = array_diff($default_lab, $new_lab_lists);
if( count($rm_diff) > 0 ){
    foreach ($rm_diff as $key => $rm_lab) {
        
        $rm_sql = "DELETE FROM `orderdetail` WHERE `labnumber` = '180422$nLab' AND `labcode` = '$rm_lab'";
        $delete = $db->delete($rm_sql);

    }
}

############################################################

### จ่ายส่วนที่เป็นสิทธิประกันสังคม ###
$item = count($_POST['sso_list']);
$Netprice = (float) 0;
$aSumYprice = (float) 0;
$aSumNprice = (float) 0;

foreach ($_POST['sso_list'] as $key => $sso_code) {
    $sql = "SELECT `price`,`yprice`,`nprice` FROM labcare WHERE `code` LIKE '$sso_code'";
    $db->select($sql);
    $lab = $db->get_item();
    
    $Netprice += (float) $lab['price'];
    $aSumYprice += (float) $lab['yprice'];
    $aSumNprice += (float) $lab['nprice'];
}


$db->select("SELECT * FROM `runno` WHERE `title` = 'depart' ");
$test_run = $db->get_item();
$nRunno = $test_run['runno'] + 1;
$db->select("LOCK TALBES `runno` READ");

$update = $db->update("UPDATE runno SET runno = $nRunno WHERE title='depart'");
$db->select("UNLOCK TALBES");

$sql = "INSERT INTO depart(
    chktranx,date,ptname,hn,an,
    doctor,depart,item,detail,price,
    sumyprice,sumnprice,paid, idname,diag,
    accno,tvn,ptright,lab,staf_massage
)VALUES( 
    '$nRunno','$Thidate','$cPtname','$cHn','$cAn',
    '$cDoctor','$cDepart','$item','$aDetail', '$Netprice',
    '$aSumYprice','$aSumNprice','','$sOfficer','$cDiag',
    '$cAccno','$tvn','$cPtright','$nLab','$cstaf_massage'
);";

$save = $db->insert($sql);
if( $save !== true ){
    $error .= errorMsg('save', $save['id']).'<br>';
}

$last_id = $db->get_last_id();

foreach ($_POST['sso_list'] as $key => $sso_code) {

    $sql = "SELECT `detail`,`part`,`price`,`yprice`,`nprice` FROM labcare WHERE `code` LIKE '$sso_code'";
    $db->select($sql);
    $lab = $db->get_item();

    $price = $lab['price'];
    $yprice = $lab['yprice'];
    $nprice = $lab['nprice'];
    $detail = $lab['detail'];
    $part = $lab['part'];

    $sql = "INSERT INTO patdata(
        date,hn,an,ptname,doctor,
        item,code,detail,amount,price,
        yprice,nprice,depart,part,idno,
        ptright,film_size 
    ) VALUES( 
        '$Thidate','$cHn','$cAn','$cPtname','$cDoctor',
        '$item','$sso_code','$detail','1','$price',
        '$yprice','$nprice','$cDepart','$part','$last_id',
        '$cPtright',''
    );";
    $save = $db->insert($sql);
    if( $save !== true ){
        $error .= errorMsg('save', $save['id']).'<br>';
    }

}


### จ่ายส่วนที่เป็นสิทธิเงินสด ###
$Netprice = (float) 0;
$aSumYprice = (float) 0;
$aSumNprice = (float) 0;

foreach ($_POST['shs_list'] as $key => $shs_code) {
    $sql = "SELECT `price`,`yprice`,`nprice` FROM labcare WHERE `code` LIKE '$shs_code'";
    $db->select($sql);
    $lab = $db->get_item();
    
    $Netprice += (float) $lab['price'];
    $aSumYprice += (float) $lab['yprice'];
    $aSumNprice += (float) $lab['nprice'];
}

$db->select("SELECT * FROM `runno` WHERE `title` = 'depart' ");
$test_run = $db->get_item();
$nRunno = $test_run['runno'] + 1;
$db->select("LOCK TALBES `runno` READ");

$update = $db->update("UPDATE runno SET runno = $nRunno WHERE title='depart'");
$db->select("UNLOCK TALBES");

$cDiag = 'ตรวจสุขภาพ';
$cPtright = 'R29 ตรวจสุขภาพแบบกลุ่ม';
$item = count($_POST['shs_list']);

$sql = "INSERT INTO depart(
    chktranx,date,ptname,hn,an,
    doctor,depart,item,detail,price,
    sumyprice,sumnprice,paid, idname,diag,
    accno,tvn,ptright,lab,staf_massage
)VALUES( 
    '$nRunno','$Thidate','$cPtname','$cHn','$cAn',
    '$cDoctor','$cDepart','$item','$aDetail', '$Netprice',
    '$aSumYprice','$aSumNprice','','$sOfficer','$cDiag',
    '$cAccno','$tvn','$cPtright','$nLab','$cstaf_massage'
);";
$save = $db->insert($sql);
if( $save !== true ){
    $error .= errorMsg('save', $save['id']).'<br>';
}

$last_id = $db->get_last_id();


foreach ($_POST['shs_list'] as $key => $shs_code) {

    $sql = "SELECT `detail`,`part`,`price`,`yprice`,`nprice` FROM labcare WHERE `code` LIKE '$shs_code'";
    $db->select($sql);
    $lab = $db->get_item();

    $price = $lab['price'];
    $yprice = $lab['yprice'];
    $nprice = $lab['nprice'];
    $detail = $lab['detail'];
    $part = $lab['part'];

    $sql = "INSERT INTO patdata(
        date,hn,an,ptname,doctor,
        item,code,detail,amount,price,
        yprice,nprice,depart,part,idno,
        ptright,film_size 
    ) VALUES( 
        '$Thidate','$cHn','$cAn','$cPtname','$cDoctor',
        '$item','$shs_code','$detail','1','$price',
        '$yprice','$nprice','$cDepart','$part','$last_id',
        '$cPtright',''
    );";
    $save = $db->insert($sql);
    if( $save !== true ){
        $error .= errorMsg('save', $save['id']).'<br>';
    }

}

if( empty($error) ){
    ?>
    <p>บันทึกข้อมูลเสร็จเรียบร้อย</p>
    <?php
}else{
    echo $error;
}
