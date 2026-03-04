<?php
session_start();
include_once dirname(__FILE__) .'/connect.php';
include_once dirname(__FILE__).'/includes/functions.php';
$sIdname = $_SESSION['sIdname'];
if (!isset($sIdname)) {
    endSession();
}

$_SESSION["cBedcode"] = $_GET["cBedcode"];
$cBedcode = $_GET['cBedcode'];
$_GET['code'] = substr($_GET["cBedcode"], 0, 2);
include("alert_booking.php");

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
$result = mysql_query($query)
    or die("Query failed bed");

for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
    if (!mysql_data_seek($result, $i)) {
        echo "Cannot seek to row $i\n";
        continue;
    }

    if (!($row = mysql_fetch_object($result)))
        continue;
}

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
}


echo "เตียง: $cBed<br>";
echo "ชื่อ: $cPtname,อายุ $cAge <br>";
echo "HN: $cHn,   AN: $cAn<br>";
echo "สิทธิการรักษา: $cPtright<br>";
echo "โรค: $cDiag<br>";
echo "แพทย์: $cDoctor<br>";
$Thidate = (date("Y") + 543) . date("-m-d H:i:s");
$chgdate = (substr($cDate, 0, 4) - 543) . substr($cDate, 4); //วันนอน
$datenow = date("Y-m-d H:i:s"); //วันนี้
$s = strtotime($datenow) - strtotime($chgdate);
$d = intval($s / 86400);   //day
$s -= $d * 86400;
$h  = intval($s / 3600);    //hour
echo "วันที่ admit : $cDate <br>";
echo "จำนวนวันนอน : $d วัน $h ชั่วโมง<br>";


$sql = "Select dcdate,lock_dc From ipcard where an = '$cAn' limit 1";
$result2 = mysql_query($sql) or die(mysql_error());
list($dcdate, $lockdc) = mysql_fetch_row($result2);

print " <br><a target=_self href='wardpage.php'>บันทึกค่าบริการทางการแพทย์</a>";
print " &nbsp;&nbsp;&nbsp;<a target=_self href='iptopay.php'>ค่าบริการอื่นที่ไม่เกี่ยวข้องกับการรักษา</a>";
print " &nbsp;&nbsp;&nbsp;<a target=_self href='drugoutside_ward.php?cAn=$cAn'>บันทึกค่าบริการ นอกโรงพยาบาล</a>";
print " <br><FONT SIZE='3' COLOR='#FF0000'><B>ห้ามคิดค่าบริการทางการพยาบาลเพราะคอมจะคิดตอนย้ายหรือจำหน่าย</B></FONT>";
print "<br><BR><a href='ipacc.php?cAn=$cAn&cAccno=$cAccno' target='_blank'>ดูบัญชีค่ารักษา</a>";
print "&nbsp;&nbsp;&nbsp;<a target=_self href='ipaccrep.php'>รวมเงินค่ารักษาพยาบาล</a>";
print "&nbsp;&nbsp;&nbsp;<a target=_self  href=\"returndrug.php?cAn=$cAn&Bed=$cBedcode\">ใบคืนยา</a>";
print "&nbsp;&nbsp;&nbsp;<a target=_self  href=\"rx_index.php?cAn=$cAn&Bed=$cBedcode\">เบิกเวชภัณฑ์</a>";


$sql = "SELECT SUM(nprice) AS nprice FROM ipacc WHERE an = '$cAn' ";
$q = mysql_query($sql);
if (mysql_num_rows($q) > 0) {
    $ipacc = mysql_fetch_assoc($q);
    $nprice = $ipacc['nprice'];
    if ($nprice > 0) {
    ?>
    <br><br>
    <div style="background-color: #e35d6a; display: inline-block; padding: 6px;">
        <span><u>ผู้ป่วยมีค่าใช้จ่ายส่วนเกิน <b><?= number_format($nprice, 2); ?>บาท</b></u> <br>กรุณาประสานส่วนเก็บเงิน เพื่อยืนยันค่าใช้จ่ายส่วนเกินดังกล่าว<br>และแจ้งให้ผู้ป่วยทราบก่อนทำการ Discharge ต่อไป</span>
    </div>
    <?php
    }
}
?>
<h1>แจ้งเตือน Blood Stock</h1>
<h1>ถ้าไม่คืนถุงเลือดจะทำการ D/C ไม่ได้</h1>
<h1>ถามพี่ยศอีกทีว่าคืนถุงเลือดคือเมนูไหนของโม</h1>
<?php
$bloodItems = array();
$sqlTrnBlood = "SELECT a.*,b.* FROM (
    SELECT `Unit_number`,`Pt_HN`,`Pt_Name` FROM `trn_blood` WHERE `Pt_HN` = '$cHn'
) AS a LEFT JOIN `mst_stock` AS b ON a.`Unit_number` = b.`Unit_number`
";
$qTrn = $bsConn->query($sqlTrnBlood);
if ($qTrn->num_rows > 0) {
    while ($a = $qTrn->fetch_assoc()) {
        $bloodItems[] = array(
            'bloodGroup' => $a['Blood_Group'],
            'expireDate' => $a['Exp_Date'],
            'unitNumber' => $a['Unit_number']
        );
    }
}

if(count($bloodItems)>0){
    ?>
    <div>
        แจ้งเตือน มีถุงเลือดที่ยังไม่ได้คืน กรุณาคืนถุงเลือดก่อนจำหน่ายผู้ป่วย
        <div><strong>Unitnumber</strong>: {{unitNumber}}</div>
        <div><strong>วันหมดอายุ</strong>: {{expireDate}}</div>
    </div>
    <?php
}

// !!!จะจำหน่ายผู้ป่วยต่อเมื่อ
// dcdate เป็น "ค่าว่าง" หรืออยู่ในรูปแบบ '0000-00-00 00:00:00' 
// และ lockdc ไม่เป็นค่าว่าง
// ในช่อง lockdc ห้องยาจะเป็นคนปลดล็อคจะเป็นการอัพเดท lockdc ให้อยู่ในรูปแบบ YYYY-mm-dd
if (($dcdate == '' || $dcdate == '0000-00-00 00:00:00') && $lockdc != "") {
    $hrefUri='javascript:void(0);';
    $clickdc = '';
    if(count($bloodItems)>0){
        $hrefUri='ipdc_confirm.php';
        $clickdc = 'onclick="alert(\'ก็บอกไปแล้วว่าต้องคืนถุงเลือดให้ห้องพยาธิก่อน\');"';
    }
    ?>
    <p><a href="<?= $hrefUri; ?>" >จำหน่าย(discharge) / ยกเลิก Admit</a></p>
    <?php
} else if ($lockdc == "") {
    print "<br><BR><a href='#' onclick=\"alert('ไม่สามารถจำหน่ายได้เนื่องจากห้องยาไม่ได้การปลดล็อค หรือจ่ายยายังไม่สำเร็จกรุณาติดต่อห้องจ่ายยา โทร.1160');\">จำหน่าย(discharge) / ยกเลิก Admit</a>";
} else {
    print " <br><BR><BR><FONT SIZE='' COLOR='FF0000'>คำเตือน! หอผู้ป่วยได้ทำการจำหน่ายผู้ป่วยแล้ว <BR>ถ้าจำหน่ายอีกครั้งจะทำให้คิดค่าบริการและค่าห้องเพิ่มขึ้น ให้ทำการลบข้อมูลแทน</FONT> ";
}
print " <br><BR><br><a target=_self href='erasbed.php'>*ลบข้อมูลจากเตียงผู้ป่วย? ใช้ในกรณีพิเศษเท่านั้น ห้ามใช้เมนูนี้ กรณียกเลิก Admit</a>";
?>