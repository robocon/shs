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

$sql = "SELECT `pid` FROM `opcardchk` WHERE `HN` = '$cHn' AND `part` = 'ลูกจ้าง61' ";
$db->select($sql);
$opcardchk = $db->get_item();

// ดึงจาก exam_no
$nLab = $opcardchk['pid'] + 300;
$item = count($_POST['sso_list']);

### จ่ายส่วนที่เป็นสิทธิประกันสังคม ###
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
$cPtright = 'R01 เงินสด';

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
