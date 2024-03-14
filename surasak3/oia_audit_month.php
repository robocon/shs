<?php
require_once 'bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$rptmo = sprintf("%s", $_POST['rptmo']);
$thiyr = sprintf("%s", $_POST['thiyr']);

if(empty($rptmo)){
	echo "กรุณาเลือกเดือน";
	exit;
}
if(empty($thiyr)){
	echo "กรุณาเลือกปี";
	exit;
}

$date1 = "$thiyr-$rptmo";
$date2 = "$rptmo-$thiyr";

$monthName = $def_fullm_th[$rptmo];

// $sql = "SELECT a.`date`,a.`txdate`, a.`hn`, '' AS `full_name`,a.`depart`, 
// SUM(a.`price`) AS `paidcscd`, 
// CONCAT(SUBSTRING(a.`txdate`,1,7)) AS `yearMonth`,
// SUBSTRING(a.`txdate`,6,2) AS `month` 
// FROM `opacc` AS a
// WHERE (a.`txdate` >= '2566-07-01 00:00:00' AND a.txdate <= '2566-09-31 23:59:59' )
// GROUP BY CONCAT(SUBSTRING(a.`txdate`,1,7)), a.`depart`
// ORDER BY CONCAT(SUBSTRING(a.`txdate`,1,7)) ASC";

$sql = "SELECT a.`date`,a.`txdate`, a.`hn`, '' AS `full_name`,a.`depart`, 
SUM(a.`price`) AS `paidcscd`, 
CONCAT(SUBSTRING(a.`txdate`,1,7)) AS `yearMonth`,
SUBSTRING(a.`txdate`,6,2) AS `month` 
FROM `opacc` AS a
WHERE (a.`txdate` LIKE '$date1%' )
GROUP BY CONCAT(SUBSTRING(a.`txdate`,1,7)), a.`depart`
ORDER BY CONCAT(SUBSTRING(a.`txdate`,1,7)) ASC";

$result = $dbi->query($sql);
$list = array();
$list2 = array();

while (list($date1, $date, $hn, $full_name, $depart, $paidcscd, $yearMonth, $month) = $result->fetch_row()) {

	$date=substr($date,0,10);
	$d=substr($date,8,2);
	$m=substr($date,4,4);
	$y=substr($date,0,4);

	// ของเดิมใช้ key ของ array $list2 เป็น $hn
	$key = $yearMonth;

	$list2[$key] = $d."".$m."".$y."/".$full_name;
	switch($depart){

		case "PHAR" : $list[$key]["PHAR"] = $list[$key]["PHAR"] + $paidcscd; break;
		case "PATHO" : $list[$key]["PATHO"] = $list[$key]["PATHO"] + $paidcscd; break;
		case "XRAY" : $list[$key]["XRAY"] = $list[$key]["XRAY"] + $paidcscd; break;
		case "DENTA" : $list[$key]["DENTA"] = $list[$key]["DENTA"] + $paidcscd; break;
		case "PHYSI" : $list[$key]["PHYSI"] = $list[$key]["PHYSI"] + $paidcscd; break;
		case "EMER" : $list[$key]["EMER"] = $list[$key]["EMER"] + $paidcscd; break;
		case "SURG" : $list[$key]["SURG"] = $list[$key]["SURG"] + $paidcscd; break;
		case "NID" : $list[$key]["NID"] = $list[$key]["NID"] + $paidcscd; break;
		case "OTHER" : $list[$key]["OTHER"] = $list[$key]["OTHER"] + $paidcscd; break;
		case "HEMO" : $list[$key]["HEMO"] = $list[$key]["HEMO"] + $paidcscd; break;
		case "EYE" : $list[$key]["EYE"] = $list[$key]["EYE"] + $paidcscd; break;
		default:  $list[$key]["OTHER2"] = $list[$key]["OTHER2"] + $paidcscd; break;

	}

} // END while

// dump($list);
// dump($list2);
// exit;


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>รายงานส่ง สตน. รายเดือน </title>
</head>
<body>
<?php 

$num='0';
$i='0';
$p='1';

echo "<font face='Angsana New' size ='4'> <center>เดือน $monthName </center><br> ";
echo "<font face='Angsana New' size ='3'> <center>โรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง</center>";
echo "<table  border ='1' bordercolor='#000000' cellspacing='0' cellpadding='4' style='BORDER-COLLAPSE: collapse'>";
echo "<tr><td>#</td>
<td><font face='Angsana New' size ='2'> เดือน</td>
<!-- <td><font face='Angsana New' size ='2'> ชื่อ - สกุล</td>
<td><font face='Angsana New' size ='2'> hn</td>-->
<td> ยา</td>
<td><font face='Angsana New' size ='2'> พยาธิ</td>
<td><font face='Angsana New' size ='2'> เอกเรย์</td>
<td><font face='Angsana New' size ='2'> ทันตกรรม</td>
<td><font face='Angsana New' size ='2'> กายภาพ</td>
<td><font face='Angsana New' size ='2'> บริการ</td>
<td><font face='Angsana New' size ='2'> ผ่าตัด</td>
<td><font face='Angsana New' size ='2'> ฝังเข็ม</td>
<td><font face='Angsana New' size ='2'> ไตเทียม</td>
<td><font face='Angsana New' size ='2'> ตรวจอื่นๆ</td>
<td><font face='Angsana New' size ='2'> ตา</td>
<td>***</td>
<td>รวม</td>
</tr>";
foreach ($list2 as $key => $value) {

	$xx = explode("/",$value);
	$num++;
	$i++;

	if ($list[$key]["PHAR"] > 0 ){
        $list[$key]["PHAR1"]=number_format( $list[$key]["PHAR"],2);
    }

	if ($list[$key]["PATHO"] > 0 ){
        $list[$key]["PATHO1"]=number_format( $list[$key]["PATHO"],2);
    }

	if ($list[$key]["XRAY"] > 0 ){
        $list[$key]["XRAY1"]=number_format( $list[$key]["XRAY"],2);
    }

	if ($list[$key]["DENTA"] > 0 ){
        $list[$key]["DENTA1"]=number_format( $list[$key]["DENTA"],2);
    }

	if ($list[$key]["PHYSI"] > 0 ){
        $list[$key]["PHYSI1"]=number_format( $list[$key]["PHYSI"],2);
    }

	if ($list[$key]["EMER"] > 0 ){
        $list[$key]["EMER1"]=number_format( $list[$key]["EMER"],2);
    }

	if ($list[$key]["SURG"] > 0 ){
        $list[$key]["SURG1"]=number_format( $list[$key]["SURG"],2);
    }

	if ($list[$key]["NID"] > 0 ){
        $list[$key]["NID1"]=number_format( $list[$key]["NID"],2);
    }

	if ($list[$key]["OTHER"] > 0 ){
        $list[$key]["OTHER1"]=number_format( $list[$key]["OTHER"],2);
    }

	if ($list[$key]["HEMO"] > 0 ){
        $list[$key]["HEMO1"]=number_format( $list[$key]["HEMO"],2);
    }

	if ($list[$key]["EYE"] > 0 ){
        $list[$key]["EYE1"]=number_format( $list[$key]["EYE"],2);
    }

	if ($list[$key]["OTHER2"] > 0 ){
        $list[$key]["OTHER21"]=number_format( $list[$key]["OTHER2"],2);
    }

	$total=$list[$key]["PHAR"]+$list[$key]["PATHO"]+$list[$key]["XRAY"]+$list[$key]["DENTA"]+$list[$key]["PHYSI"]+$list[$key]["EMER"]+$list[$key]["SURG"]+$list[$key]["NID"]+$list[$key]["OTHER"]+$list[$key]["HEMO"]+$list[$key]["EYE"]+$list[$key]["OTHER2"];
	$total=number_format($total,2);

    echo "<tr>
    <td><font face='Angsana New' size ='2'>".$num."</td>
    <td><font face='Angsana New' size ='2'>".$key."</td>
    <!-- <td><font face='Angsana New' size ='2'>".$xx[1]."</td>
    <td><font face='Angsana New' size ='2'>".$key."</td>-->
    <td align='right'><font face='Angsana New' size ='2'>".$list[$key]["PHAR1"]."</td>
    <td align='right'><font face='Angsana New' size ='2'>".$list[$key]["PATHO1"]."</td>
    <td align='right'><font face='Angsana New' size ='2'>".$list[$key]["XRAY1"]."</td>
    <td align='right'><font face='Angsana New' size ='2'>".$list[$key]["DENTA1"]."</td>
    <td align='right'><font face='Angsana New' size ='2'>".$list[$key]["PHYSI1"]."</td>
    <td align='right'><font face='Angsana New' size ='2'>".$list[$key]["EMER1"]."</td>
    <td align='right'><font face='Angsana New' size ='2'>".$list[$key]["SURG1"]."</td>
    <td align='right'><font face='Angsana New' size ='2'>".$list[$key]["NID1"]."</td>
    <td align='right'><font face='Angsana New' size ='2'>".$list[$key]["HEMO1"]."</td>
    <td align='right'><font face='Angsana New' size ='2'>".$list[$key]["OTHER1"]."</td>
    <td align='right'><font face='Angsana New' size ='2'>".$list[$key]["EYE1"]."</td>
    <td align='right'><font face='Angsana New' size ='2'>".$list[$key]["OTHER21"]."</td>
    <td align='right'><font face='Angsana New' size ='3'>".$total."</td>
    </tr>";

	$PHAR = $PHAR+$list[$key]["PHAR"];
	$PATHO = $PATHO+$list[$key]["PATHO"];
	$XRAY = $XRAY+$list[$key]["XRAY"];
	$DENTA = $DENTA+$list[$key]["DENTA"];
	$PHYSI = $PHYSI+$list[$key]["PHYSI"];
	$EMER = $EMER+$list[$key]["EMER"];
	$SURG = $SURG+$list[$key]["SURG"];
	$NID = $NID+$list[$key]["NID"];
	$OTHER = $OTHER+$list[$key]["OTHER"];
	$HEMO = $HEMO+$list[$key]["HEMO"];
	$EYE = $EYE+$list[$key]["EYE"];
	$OTHER1 = $OTHER1+$list[$key]["OTHER2"];
	$sum = $sum+($list[$key]["PHAR"]+$list[$key]["PATHO"]+$list[$key]["XRAY"]+$list[$key]["DENTA"]+$list[$key]["PHYSI"]+$list[$key]["EMER"]+$list[$key]["SURG"]+$list[$key]["NID"]+$list[$key]["HEMO"]+$list[$key]["EYE"]+$list[$key]["OTHER"]+$list[$key]["OTHER2"]);

} // END foreach


$PHAR=number_format( $PHAR,2);
$PATHO=number_format( $PATHO,2);
$XRAY=number_format($XRAY,2);
$DENTA=number_format( $DENTA,2);
$PHYSI=number_format( $PHYSI,2);
$EMER=number_format( $EMER,2);
$SURG=number_format( $SURG,2);
$NID=number_format($NID,2);
$OTHER=number_format($OTHER,2);
$HEMO=number_format($HEMO,2);
$EYE=number_format($EYE,2);
$OTHER2=number_format($OTHER2,2);

$sum=number_format($sum,2);

echo "<tr>
<!--<td></td>
<td></td>-->
<td colspan='2'><font face='Angsana New' size ='2'>รวมทั้งหมด</td>
<td align='right'><font face='Angsana New' size ='2'>".$PHAR."</td>
<td align='right'><font face='Angsana New' size ='2'>".$PATHO."</td>
<td align='right'><font face='Angsana New' size ='2'>".$XRAY."</td>
<td align='right'><font face='Angsana New' size ='2'>".$DENTA."</td>
<td align='right'><font face='Angsana New' size ='2'>".$PHYSI."</td>
<td align='right'><font face='Angsana New' size ='2'>".$EMER."</td>
<td align='right'><font face='Angsana New' size ='2'>".$SURG."</td>
<td align='right'><font face='Angsana New' size ='2'>".$NID."</td>
<td align='right'><font face='Angsana New' size ='2'>".$HEMO."</td>
<td align='right'><font face='Angsana New' size ='2'>".$OTHER."</td>
<td align='right'><font face='Angsana New' size ='2'>".$EYE."</td>
<td align='right'><font face='Angsana New' size ='2'>".$OTHER2."</td>
<td align='right'><font face='Angsana New' size ='3'>".$sum."</td>
</tr></FONT>";

echo "</table>";
?>
</body>
</html>