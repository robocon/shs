<?php
session_start();

include_once dirname(__FILE__).'/includes/config.php';
include_once dirname(__FILE__).'/includes/functions.php';
include_once dirname(__FILE__).'/connect.php';

$sIdname = $_SESSION['sIdname'];
if (!isset($sIdname)) {
    endSession();
}

$bsConn = mysqli_connect(BLOOD_SERVER,BLOOD_USER,BLOOD_PASS,BLOOD_DB);
$bsConn->query("SET NAMES UTF8");

$_SESSION["cBedcode"] = $_GET["cBedcode"];
$cBedcode = $_GET['cBedcode'];
$_GET['code'] = substr($_GET["cBedcode"], 0, 2);

include_once dirname(__FILE__).'/alert_booking.php';

session_unregister("cDepart");
session_unregister("aDetail");
session_unregister("cTitle");
//ipdata.php
session_unregister("x");
session_unregister("aDgcode");
session_unregister("aTrade");
session_unregister("aPrice");
session_unregister("aPart");
session_unregister("aAmount");
session_unregister("aMoney");
session_unregister("Netprice");
session_unregister('cDate');
session_unregister('cBedcode');
session_unregister('oBedcode');
session_unregister('cBed');
session_unregister('cPtname');
session_unregister('cAge');
session_unregister('cPtright');
session_unregister('cDoctor');
session_unregister('cHn');
session_unregister('cAn');
session_unregister('cDiag');
session_unregister('cBedpri');
session_unregister('cChgdate');
session_unregister('cChgwdate');
session_unregister('cBedname');
session_unregister('cAccno');
session_unregister("nRunno");
////

$Bedcode = $cBedcode; // ! ในหน้านี้ไม่มีใช้งาน แต่ไม่รู้ว่าหน้าอื่นๆ ได้เปิดเป็น Global ใช้ต่อรึป่าว
session_register("Bedcode");

$x = 0;
$aDgcode = array("รหัส");
$aTrade  = array("รายการ");
$aPrice  = array("ราคา ");
$aPart = array("part");
$aAmount = array("        จำนวน   ");
$aMoney = array("       รวมเงิน   ");
$Netprice = "";

$cDate = "";
$cBed = "";
$cPtname = "";
$cAge = "";
$cPtright = "";
$cDoctor = "";
$cHn = "";
$cAn = "";
$cDiag = "";
$cBedpri = "";
$cChgdate = "";
$cChgwdate = "";
$cBedname = "";
$cAccno = "";

$nRunno = "";
session_register("nRunno");

session_register("x");
session_register("aDgcode");
session_register("aTrade");
session_register("aPrice");
session_register("aPart");
session_register("aAmount");
session_register("aMoney");
session_register("Netprice");

session_register('cDate');
session_register('cBedcode');
session_register('oBedcode');
session_register('cBed');
session_register('cPtname');
session_register('cAge');
session_register('cPtright');
session_register('cDoctor');
session_register('cHn');
session_register('cAn');
session_register('cDiag');
session_register('cBedpri');
session_register('cChgdate');
session_register('cChgwdate');
session_register('cBedname');
session_register('cAccno');

$row = array();
global $idcard, $camp, $gang, $dbirth, $address, $tambol, $ampur, $changwat;

$query = "SELECT * FROM bed WHERE bedcode = '$cBedcode'";
$result = mysql_query($query) or die("Query failed bed");
if(mysql_num_rows($result)==0){
    ?>
    <p>ไม่พบข้อมูล Bed: <u><?= $cBedcode ?></u> กรุณาตรวจสอบข้อมูลอีกครั้ง</p>
    <?php
    exit;
}
$row = mysql_fetch_object($result);
if ($result) {
    $cDate = $row->date;
    $cBedcode = $row->bedcode;
    $cBed = $row->bed;
    $cPtname = $row->ptname;
    $cAge = $row->age;
    $cPtright = $row->ptright;
    $cDoctor = $row->doctor;
    $cHn = $row->hn;
    $cAn = $row->an;
    $cDiag = $row->diagnos;
    $cBedpri = $row->bedpri;
    $cChgdate = $row->chgdate;
    $cBedname = $row->bedname;
    $cAccno = $row->accno;
    $idcard = $row->idcard;
    //runno  for chktranx
    $query = "SELECT title,prefix,runno FROM runno WHERE title = 'depart'";
    $result = mysql_query($query) or die("Query failed ipdata.php : ".mysql_error());

    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if (!($row = mysql_fetch_object($result)))
            continue;
    }

    $nRunno = $row->runno;
    $nRunno++;

    $query = "update runno SET runno = $nRunno WHERE title='depart'";
    $result = mysql_query($query) or die("Query failed");
    //end  runno  for chktranx
} else {
    echo "ไม่พบ HN : $cBedcode";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $cBed ?>-บันทึกค่าใช้จ่าย / คืนยา / จำหน่าย </title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
<div class="mt-2">
    <h3>บันทึกค่าใช้จ่าย / คืนยา / จำหน่าย</h3>
<style>
*, fieldset legend{
    font-family: "TH SarabunPSK";
    font-size: 16pt;
}
body{
    padding-left:8px;
}
.bloodContainer{
    display: inline-block;
    margin-right: 0.5em;
    margin-bottom: 0.5em;
    font-family: "TH SarabunPSK";
    border: 2px solid red;
    border-radius: 6px;
    padding: 4px 6px;
    background-color: pink;
}

.button {
  background-color: red;
  border: none;
  color: white;
  padding: 8px 16px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  cursor: pointer;
  border-radius: 4px;
}
.button:hover{
    box-shadow: 3px 3px 3px #3e3e3e;
}
.button2 {background-color: #04AA6D;}
.button4 {background-color: #cfcfcf; color: black;}
</style>
<?php
$Thidate = (date("Y") + 543) . date("-m-d H:i:s");
$chgdate = (substr($cDate, 0, 4) - 543) . substr($cDate, 4); //วันนอน
$datenow = date("Y-m-d H:i:s"); //วันนี้
$s = strtotime($datenow) - strtotime($chgdate);
$d = intval($s / 86400);   //day
$s -= $d * 86400;
$h  = intval($s / 3600);    //hour

if(file_exists("../image_patient/$idcard.jpg")){
	$img="../image_patient/$idcard.jpg";
}else{
	$img='../image_patient/NoPicture.jpg';
}

?>
<table>
    <tr>
        <td style="padding-right: 1em; padding-left: 1em;">
            <img src="<?= $img; ?>" style="width:120px;">
        </td>
        <td>
            <table>
                <tr>
                    <td align="right"><strong>เตียง:</strong></td>
                    <td colspan="3"><?= $cBed; ?></td>
                </tr>
                <tr>
                    <td align="right"><strong>ชื่อ:</strong></td>
                    <td><?= $cPtname ?></td>
                    <td align="right"><strong>อายุ:</strong></td>
                    <td><?= $cAge; ?></td>
                </tr>
                <tr>
                    <td align="right"><strong>HN :</strong></td>
                    <td><?= $cHn; ?></td>
                    <td align="right"><strong>AN:</strong></td>
                    <td><?= $cAn; ?></td>
                </tr>
                <tr>
                    <td align="right"><strong>สิทธิการรักษา:</strong></td>
                    <td colspan="3"><?= $cPtright; ?></td>
                </tr>
                <tr>
                    <td align="right"><strong>โรค:</strong></td>
                    <td><?= $cDiag; ?></td>
                    <td align="right"><strong>แพทย์:</strong></td>
                    <td><?= $cDoctor; ?></td>
                </tr>
                <tr>
                    <td align="right"><strong>วันที่ Admit:</strong></td>
                    <td><?= $cDate; ?></td>
                    <td align="right" style="padding-left: 1em;"><strong>จำนวนวันนอน:</strong></td>
                    <td><?= $d; ?> วัน <?= $h; ?> ชั่วโมง</td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<hr>
<?php
$sql = "Select dcdate,lock_dc From ipcard where an = '$cAn' limit 1";
$result2 = mysql_query($sql) or die(mysql_error());
list($dcdate, $lockdc) = mysql_fetch_row($result2);
?>
<div>
    <a href="wardpage.php?cAn=<?= $cAn; ?>&Bed=<?= $cBedcode; ?>" target="_blank" class="button button4">บันทึกค่าบริการทางการแพทย์</a>
    <a href="iptopay.php?cAn=<?= $cAn; ?>&Bed=<?= $cBedcode; ?>" target="_blank" class="button button4">ค่าบริการอื่นที่ไม่เกี่ยวข้องกับการรักษา</a>
    <a href="drugoutside_ward.php?cAn=<?= $cAn; ?>" target="_blank" class="button button4">บันทึกค่าบริการ นอกโรงพยาบาล</a>
</div>
<div>
    <p style="margin:0; padding:0;" class="p-2"><font size='3' color='#FF0000'><b>ห้ามคิดค่าบริการทางการพยาบาล <u>เพราะคอมจะคิดตอนย้ายหรือจำหน่าย</u></b></font></p>
</div>
<div>
    <a href="ipacc.php?cAn=<?=$cAn;?>&Bed=<?= $cBedcode; ?>&cAccno=<?=$cAccno;?>" target="_blank" class="button button4">ดูบัญชีค่ารักษา</a>
    <a href="ipaccrep.php?cAn=<?=$cAn;?>&cBedcode=<?= $cBedcode; ?>" target="_blank" class="button button4">รวมเงินค่ารักษาพยาบาล</a>
    <a href="returndrug.php?cAn=<?= $cAn; ?>&Bed=<?= $cBedcode; ?>" target="_blank" class="button button4">ใบคืนยา</a>
    <a href="rx_index.php?cAn=<?= $cAn; ?>&Bed=<?= $cBedcode; ?>" target="_blank" class="button button4">เบิกเวชภัณฑ์</a>
</div>
<hr>
<?php
$sql = "SELECT SUM(nprice) AS nprice FROM ipacc WHERE an = '$cAn' ";
$q = mysql_query($sql);
if (mysql_num_rows($q) > 0) {
    $ipacc = mysql_fetch_assoc($q);
    $nprice = $ipacc['nprice'];
    if ($nprice > 0) {
    ?>
    <div style="background-color: #e35d6a; display: inline-block; padding: 6px;">
        <span><u>ผู้ป่วยมีค่าใช้จ่ายส่วนเกิน <b><?= number_format($nprice, 2); ?>บาท</b></u> <br>กรุณาประสานส่วนเก็บเงิน เพื่อยืนยันค่าใช้จ่ายส่วนเกินดังกล่าว<br>และแจ้งให้ผู้ป่วยทราบก่อนทำการ Discharge ต่อไป</span>
    </div>
    <hr>
    <?php
    }
}
$bloodItems = array();
$sqlTrnBlood = "SELECT * 
FROM `mst_stock` 
WHERE `Hn_Reserved` = '$cHn' 
AND `Exp_Date` >= CURDATE() 
AND `Flag_Reserved`='Y' 
AND `Unit_Number` NOT IN ( SELECT `Unit_Number` FROM `trn_blood` )";
$qTrn = $bsConn->query($sqlTrnBlood);
if ($qTrn->num_rows > 0) {
    while ($a = $qTrn->fetch_assoc()) {
        $bloodItems[] = array(
            'bloodGroup' => $a['Blood_Group'],
            'expireDate' => $a['Exp_Date'],
            'unitNumber' => $a['Unit_Number']
        );
    }
}
if(count($bloodItems)>0){
    ?>
    <fieldset style="margin:6px 0; border-left: 5px solid red; padding-left: 10px;" class="mt-2 mb-2">
        <legend>⚠️<strong>แจ้งเตือน</strong> มีถุงเลือดที่ยังไม่ได้คืน กรุณาคืนถุงเลือดก่อนจำหน่ายผู้ป่วย</legend>
        <div>
        <?php
        foreach ($bloodItems as $a) {
            list($expY, $expM, $expD) = explode('-', $a['expireDate']);
            $expDateTh = $expD.' '.$def_month_th[$expM].' '.($expY + 543);
            ?>
            <span class="bloodContainer">🩸 ถุงเลือด ( <?= $a['bloodGroup'] ?> ) <strong>Unit Number</strong>: <?= $a['unitNumber'] ?> <strong>วันหมดอายุ</strong>: <?= $expDateTh ?></span>
            <?php
        }
        ?>
        </div>
    </fieldset>
    <?php
}

if (($dcdate == '' || $dcdate == '0000-00-00 00:00:00') && $lockdc != "") {
    $hrefUri='ipdc_confirm.php?cAn='.$cAn;
    $clickdc = '';
    $status = '';
    if(count($bloodItems)>0){
        $hrefUri='javascript:void(0);';
        $clickdc = 'onclick="swalAlert(\'ประสานห้องแลปเพื่อคืนถุงเลือด ก่อนจำหน่ายผู้ป่วย\')"';
        $status = '<span title="คืนถุงเลือดก่อนจำหน่าย">🔒</span>';
    }
    ?>
    <p><a href="<?= $hrefUri; ?>" <?= $clickdc; ?> class="button button2"> <?= $status; ?> จำหน่าย ( discharge ) / ยกเลิก Admit</a></p>
    <?php
} else if ($lockdc == "") {
    ?>
    <p><a href="javascript:void(0);" onclick="swalAlert('ไม่สามารถจำหน่ายได้ เนื่องจากห้องยาไม่ได้การปลดล็อค หรือจ่ายยายังไม่สำเร็จกรุณาติดต่อห้องจ่ายยา โทร.1160');" class="button button2"><span title="สถานะ Lock">🔒</span> จำหน่าย ( discharge ) / ยกเลิก Admit</a></p>
    <?php
} else {
    ?>
    <p><FONT SIZE="" COLOR="FF0000">คำเตือน! หอผู้ป่วยได้ทำการจำหน่ายผู้ป่วยแล้ว <BR>ถ้าจำหน่ายอีกครั้งจะทำให้คิดค่าบริการและค่าห้องเพิ่มขึ้น ให้ทำการลบข้อมูลแทน</FONT></p>
    <?php
}
?>
<p><a target="_self" href="erasbed.php" style="text-decoration:none;" class="button">*ลบข้อมูลจากเตียงผู้ป่วย? ใช้ในกรณีพิเศษเท่านั้น <strong>ห้ามใช้เมนูนี้ <u>กรณียกเลิก Admit</u></strong></a></p>
</div>

<script>
    function swalAlert(msg){
        Swal.fire({
            icon:'warning',
            title: msg
        });
        return false;
    }
</script>
</body>
</html>