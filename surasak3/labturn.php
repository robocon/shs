<?php
session_start();
include dirname(__FILE__).'/bootstrap.php';

$Conn = mysql_connect(HOST, USER, PASS) or die( mysql_error() );
mysql_select_db(DB, $Conn) or die( mysql_error() );
mysql_query("SET NAMES UTF8", $Conn);

$Thaidate = date("d-m-") . (date("Y") + 543) . "  " . date("H:i:s");
$Thidate = (date("Y") + 543) . date("-m-d H:i:s");

$departRowId = $_GET['row_id'];
$query = "SELECT status, price FROM depart WHERE row_id = '$departRowId' limit 1 ";
$result = mysql_query($query);
list($status, $price) = mysql_fetch_row($result);
if ($status == "N") {
    ?>
    <h3 style="text-align:center;">รายการนี้เคยถูกยกเลิกไปแล้ว</h3>
    <div style="text-align:center;">
        <a href="allerase.php">คลิกที่นี่</a> เพื่อกลับไปหน้าแรก
    </div>
    <?php
    exit();

} else if ($price < 0) {
    ?>
    <h3 style="text-align:center;">รายการนี้เคยถูกยกเลิกไปแล้ว</h3>
    <div style="text-align:center;">
        <a href="allerase.php">คลิกที่นี่</a> เพื่อกลับไปหน้าแรก
    </div>
    <?php
    exit();

}

$query = "SELECT title,prefix,runno FROM runno WHERE title = 'depart'";
$result = mysql_query($query) or die("Query failed");
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

$query = "UPDATE runno SET runno = $nRunno WHERE title='depart'";
$result = mysql_query($query) or die("Query failed");
//end  runno  for chktranx



//to find data from depart
$query = "SELECT * FROM depart WHERE row_id = '$departRowId' "; //session
$result = mysql_query($query) or die("Query failed");

for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
    if (!mysql_data_seek($result, $i)) {
        echo "Cannot seek to row $i\n";
        continue;
    }

    if (!($row = mysql_fetch_object($result)))
        continue;
}
//	$Thidate    =$row->date;

$cPtname  = $row->ptname;
$cPtright  = $row->ptright;
$cHn       = $row->hn;
$cAn       = $row->an;
$cDoctor  = $row->doctor;
$cDepart  = $row->depart;
$aDetail  = $row->detail;
$item     = $row->item;
$x = $item;
//	$sOfficer  =$row->idname;
$cDiag    = $row->diag;
$Netprice  = $row->price * -1;
$aSumYprice = $row->sumyprice * -1;
$aSumNprice = $row->sumnprice * -1;
$cAccno  = $row->accno;
$tvn   = $row->tvn;
$sOfficer = $_SESSION['sOfficer'];

//ยกเลิกสถิติฟิล์ม
$query = "UPDATE xray_stat SET cancle = '1' WHERE idno = '" . $row->chktranx . "' limit 1";
$result = mysql_query($query) or die("Query failed");

//insert data into depart
$query = "INSERT INTO depart(chktranx,date,ptname,hn,an,doctor,depart,item,detail,price,sumyprice,sumnprice,paid, idname,diag,accno,tvn,ptright)VALUES('$nRunno','$Thidate','$cPtname','$cHn',
        '$cAn','$cDoctor','$cDepart','$item','$aDetail','$Netprice','$aSumYprice','$aSumNprice','','$sOfficer','$cDiag','$cAccno','$tvn','$cPtright');";

$result = mysql_query($query) or die("**เตือน !ท่านได้ยกเลิกรายการไปก่อนหน้านี้แล้ว".mysql_error());
$idno = mysql_insert_id();

//insert data into patdata
$aCode = array("code");
$aDetail  = array("detail");
$aAmount = array("จำนวน ");
$aMoney = array("รวมเงิน ");
$aYprice = array("Yprice ");
$aNprice = array("Nprice");
$aPart = array("part ");

$query = "SELECT code,detail,amount,price,yprice,nprice,part,row_id FROM patdata WHERE idno = '$departRowId' ";
$result = mysql_query($query) or die("Query failed");
while (list($code, $detail, $amount, $price, $yprice, $nprice, $part, $row_id) = mysql_fetch_row($result)) {
    array_push($aCode, $code);
    array_push($aDetail, $detail);
    array_push($aAmount, $amount * -1);
    array_push($aMoney, $price * -1);
    array_push($aYprice, $yprice * -1);
    array_push($aNprice, $nprice * -1);
    array_push($aPart, $part);
}

//insert data into patdata
for ($n = 1; $n <= $x; $n++) {
    if (!empty($aCode[$n])) {
        $query = "INSERT INTO patdata(date,hn,an,ptname,doctor,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright)
        VALUES('$Thidate','$cHn','$cAn','$cPtname','$cDoctor','$item','$aCode[$n]','$aDetail[$n]','$aAmount[$n]',
        '$aMoney[$n]','$aYprice[$n]','$aNprice[$n]','$cDepart','$aPart[$n]','$idno','$cPtright');";
        $result = mysql_query($query) or die("Query failed,cannot insert into patdata");
    }
}

// in case of inpatient insert data into ipacc
if (!empty($cAn)) {
    for ($n = 1; $n <= $x; $n++) {

        if ($aPart[$n] == "DPY" and $aNprice[$n] < 0) {
            $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,
            idname,part,accno,idno)VALUES('$Thidate','$cAn','$aCode[$n]','$cDepart','$aDetail[$n]',
            '$aAmount[$n]','$aYprice[$n]','$sOfficer','DPY','$cAccno','$idno');";
            $result = mysql_query($query) or die("Query failed,cannot insert into ipacc1");
        }

        if ($aPart[$n] == "DPY" and $aNprice[$n] < 0) {
            $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,
            idname,part,accno,idno)VALUES('$Thidate','$cAn','$aCode[$n]','$cDepart','$aDetail[$n]',
            '$aAmount[$n]','$aNprice[$n]','$sOfficer','DPN','$cAccno','$idno');";
            $result = mysql_query($query) or die("Query failed,cannot insert into ipacc2");
        } else {
            $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,
            idname,part,accno,idno)VALUES('$Thidate','$cAn','$aCode[$n]','$cDepart','$aDetail[$n]',
            '$aAmount[$n]','$aMoney[$n]','$sOfficer','$aPart[$n]','$cAccno','$idno');";
            $result = mysql_query($query) or die("Query failed,cannot insert into ipacc3");
        }
    }
}
//update data in opday 
if ($cDepart == 'XRAY') {
    $xraypri = $Netprice;
} else {
    $xraypri = 0;
}
if ($cDepart == 'PATHO') {
    $pathopri = $Netprice;
} else {
    $pathopri = 0;
}
if ($cDepart == 'EMER') {
    $emerpri = $Netprice;
} else {
    $emerpri = 0;
}
if ($cDepart == 'SURG') {
    $surgpri = $Netprice;
} else {
    $surgpri = 0;
}
if ($cDepart == 'PHYSI') {
    $physipri = $Netprice;
} else {
    $physipri = 0;
}
if ($cDepart == 'DENTA') {
    $dentapri = $Netprice;
} else {
    $dentapri = 0;
}
if ($cDepart == 'OTHER') {
    $otherpri = $Netprice;
} else {
    $otherpri = 0;
}

$Thdhn = date("d-m-") . (date("Y") + 543) . $cHn;
$query = "UPDATE opday SET   xray= xray+$xraypri,
        patho=patho+$pathopri,
        emer=emer+$emerpri,
        surg=surg+$surgpri,
        physi=physi+$physipri,
        denta=denta+$dentapri,
        other=other+$otherpri
        WHERE thdatehn= '$Thdhn' AND vn = '" . $_SESSION["sVn"] . "' ";
$result = mysql_query($query) or die("Query failed,update opday");

$sql = "Update depart set status = 'N' where row_id = '$departRowId' ";
$result = mysql_query($sql);

$sql = "Update patdata set status = 'N' where idno = '$departRowId' ";
$result = mysql_query($sql);
?>
<style>
    *{
        font-family: "TH SarabunPSK";
        font-size: 20px;
    }
</style>
<table>
    <tr>
        <td align="right"><b>วันที่ :</b></td>
        <td><?=$Thaidate;?></td>
        <td align="right"><b>ชื่อ-สกุล :</b></td>
        <td><?=$cPtname;?></td>
    </tr>
    <tr>
        <td align="right"><b>HN :</b></td>
        <td><?=$cHn;?></td>
        <td align="right"><b>VN :</b></td>
        <td><?=$tvn;?></td>
    </tr>
    <tr>
        <td align="right"><b>AN :</b></td>
        <td><?=$cAn;?></td>
        <td align="right"><b>สิทธิ :</b></td>
        <td><?=$cPtright;?></td>
    </tr>
    <tr>
        <td align="right"><b>Diag :</b></td>
        <td><?=$cDiag;?></td>
        <td align="right"><b>แพทย์ :</b></td>
        <td><?=$cDoctor;?></td>
    </tr>
</table>
<table border="1" style="border-collapse:collapse; border: 1px solid #000000;">
<tr style="background-color: #008080; color: #ffffff;">
    <th>#</th>
    <th>รายการ</th>
    <th>จำนวน</th>
    <th>ราคา</th>
</tr>
<?php
//ใบแจ้งการยกเลิก
$no = 0;
for ($n = 1; $n <= $x; $n++) {
    if (!empty($aCode[$n])) {
        $no++;
        ?>
        <td><?=$no;?></td>
        <td><?=$aDetail[$n];?></td>
        <td align="right"><?=$aAmount[$n];?></td>
        <td align="right"><?=$aMoney[$n];?></td>
        <?php
    }
};
?>
</table>
<?php
print "ราคารวม $Netprice บาท<br>";
print "จนท. $sOfficer  $Thaidate<br>";
//จบใบแจ้งการยกเลิก
?>
<h3 style="font-size: 28px;"><u>ยกเลิกรายการเรียบร้อย</u></h3>