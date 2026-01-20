<?php
session_start();
require_once 'connect.php';
//  $yrmonth="$thiyr-$rptmo-$date";
function dump($t){
	echo "<pre>";
	var_dump($t);
	echo "</pre>";
}

$date = $_POST['date'];
$rptmo = $_POST['rptmo'];
$thiyr = $_POST['thiyr'];

if(empty($rptmo)){
	echo "กรุณาเลือกเดือน";
	exit;
}

$credit = $_POST['credit'];
if(empty($credit)){
	echo "กรุณาเลือกประเภทค่ารักษาพยาบาล";
	exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>รายงานส่งAudit <?=$credit;?></title>
</head>
<body>
<?php 
if(empty($date)){
	$date1 ="$thiyr-$rptmo";
	$date2 ="$rptmo-$thiyr";
}else{
	$date1 ="$thiyr-$rptmo-$date";
	$date2 ="$date-$rptmo-$thiyr";
}
//echo $credit."<br>";
if($credit=="phar"){
	$chkdepart="PHAR";
	$depart_name="ยา";
}else if($credit=="patho"){
	$chkdepart="PATHO";
	$depart_name="พยาธิ";
}else if($credit=="xray"){
	$chkdepart="XRAY";
	$depart_name="เอกซเรย์";
}else if($credit=="dental"){
	$chkdepart="DENTA";
	$depart_name="ทันตกรรม";
}else if($credit=="pt"){
	$chkdepart="PHYSI";
	$depart_name="กายภาพ";
}else if($credit=="emer"){
	$chkdepart="EMER";
	$depart_name="บริการ";
}else if($credit=="surg"){
	$chkdepart="SURG";
	$depart_name="ผ่าตัด";
}else if($credit=="nid"){
	$chkdepart="NID";
	$depart_name="ฝังเข็ม";
}else if($credit=="hemo"){
	$chkdepart="HEMO";
	$depart_name="ไตเทียม";
}else if($credit=="other"){
	$chkdepart="OTHER";
	$depart_name="ตรวจอื่นๆ";
}else if($credit=="eye"){
	$chkdepart="EYE";
	$depart_name="ตา";
}
	
// ของเดิม group by a.hn, a.depart 
$sql = "SELECT a.`date`,
a.`txdate`,
a.`hn`,
CONCAT(b.`yot`,' ',b.`name`,' ',b.`surname`) AS full_name,
a.`depart`,
sum(a.`paid`),
sum(a.`paidcscd`),
CONCAT(SUBSTRING(a.`date`,1,10),a.`hn`,a.`depart`) AS `thdateHn` ,
a.`credit`,
a.`credit_detail`
FROM `opacc` AS a, 
`opcard` AS b 
where a.`hn`=b.`hn` 
AND a.`txdate` like '$date1%' 
AND a.`depart` ='$chkdepart' 
AND (a.`credit` !='ยกเลิก' AND a.`credit` !='นอนโรงพยาบาล' AND a.`credit` !='อื่นๆ' AND a.`credit` !='ยกเว้น'  AND a.`credit` !='ค้างจ่าย') 
group by CONCAT(SUBSTRING(a.`date`,1,10),a.`hn`,a.`depart`,a.`credit`) 
ORDER by a.`date` ASC,a.`hn` ASC";

//echo $sql;
$result = mysql_Query($sql) or die(mysql_error());
$list = array();
$list2 = array();

while(list($date1, $date, $hn, $full_name, $depart, $paid, $paidcscd, $thdatehn,$showcredit,$credit_detail) = Mysql_fetch_row($result)){

	$date=substr($date,0,10);
	$d=substr($date,8,2);
	$m=substr($date,4,4);
	$y=substr($date,0,4);

	// ของเดิมใช้ key ของ array $list2 เป็น $hn
	$key = $hn.$showcredit;

	$list2[$key] = $d."".$m."".$y."/".$full_name."/".$showcredit."/".$credit_detail."/".$hn;
	//echo $list2[$key]."<br>";
if($showcredit=="จ่ายตรง" || $showcredit=="จ่ายตรง อปท." || $showcredit=="จ่ายตรง อปท. (HD)" || $showcredit=="กทม" || $showcredit=="กสทช" || $showcredit=="ททท"){
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
}else if($showcredit=="เงินสด" || $showcredit=="เงินโอน" || $showcredit=="เช็ค" || $showcredit=="ทหารไทย"){
	switch($depart){
			case "PHAR" : $list[$key]["PHAR"] = $list[$key]["PHAR"] + $paid; break;
			case "PATHO" : $list[$key]["PATHO"] = $list[$key]["PATHO"] + $paid; break;
			case "XRAY" : $list[$key]["XRAY"] = $list[$key]["XRAY"] + $paid; break;
			case "DENTA" : $list[$key]["DENTA"] = $list[$key]["DENTA"] + $paid; break;
			case "PHYSI" : $list[$key]["PHYSI"] = $list[$key]["PHYSI"] + $paid; break;
			case "EMER" : $list[$key]["EMER"] = $list[$key]["EMER"] + $paid; break;
			case "SURG" : $list[$key]["SURG"] = $list[$key]["SURG"] + $paid; break;
			case "NID" : $list[$key]["NID"] = $list[$key]["NID"] + $paid; break;
			case "OTHER" : $list[$key]["OTHER"] = $list[$key]["OTHER"] + $paid; break;
			case "HEMO" : $list[$key]["HEMO"] = $list[$key]["HEMO"] + $paid; break;
			case "EYE" : $list[$key]["EYE"] = $list[$key]["EYE"] + $paid; break;
			default:  $list[$key]["OTHER2"] = $list[$key]["OTHER2"] + $paid; break;
	}
}else{
	switch($depart){
			case "PHAR" : $list[$key]["PHAR"] = $list[$key]["PHAR"] + $paid; break;
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
}

} // END while

$num='0';
$i='0';
$p='1';

echo "<font face='Angsana New' size ='4'><center> <b>ลูกหนี้หมวด$depart_name ประจำวันที่ $date2 <br></b> ";
echo "<font face='Angsana New' size ='3'> โรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<!--แผ่นที่&nbsp;$p--></center>";
echo "<table  border ='1' bordercolor='#000000' cellspacing='0' cellpadding='0' style='BORDER-COLLAPSE: collapse' align='center' width='60%'>";
echo "<tr>
<td>&nbsp;&nbsp;#&nbsp;&nbsp;</td>
<td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;วันที่&nbsp;&nbsp;</td>
<td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;ชื่อ - สกุล&nbsp;&nbsp;</td>
<td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;HN&nbsp;&nbsp;</td>
<td><b>&nbsp;&nbsp;ลูกหนี้&nbsp;&nbsp;</b></td>
<td><center> <b>&nbsp;&nbsp;จำนวนเงิน&nbsp;&nbsp;</td>
</tr>";
foreach ($list2 as $key => $value) {

	$xx = explode("/",$value);
	$num++;
	$i++;


	if ($list[$key]["PHAR"] > 0 ){$list[$key]["PHAR1"]=number_format( $list[$key]["PHAR"],2);} else {
	};	
	if ($list[$key]["PATHO"] > 0 ){$list[$key]["PATHO1"]=number_format( $list[$key]["PATHO"],2);} else {
	};
	if ($list[$key]["XRAY"] > 0 ){$list[$key]["XRAY1"]=number_format( $list[$key]["XRAY"],2);} else {
	};
	if ($list[$key]["DENTA"] > 0 ){$list[$key]["DENTA1"]=number_format( $list[$key]["DENTA"],2);} else {
	};
	if ($list[$key]["PHYSI"] > 0 ){$list[$key]["PHYSI1"]=number_format( $list[$key]["PHYSI"],2);} else {
	};
	if ($list[$key]["EMER"] > 0 ){$list[$key]["EMER1"]=number_format( $list[$key]["EMER"],2);} else {
	};
	if ($list[$key]["SURG"] > 0 ){$list[$key]["SURG1"]=number_format( $list[$key]["SURG"],2);} else {
	};
	if ($list[$key]["NID"] > 0 ){$list[$key]["NID1"]=number_format( $list[$key]["NID"],2);} else {
	};
	if ($list[$key]["OTHER"] > 0 ){$list[$key]["OTHER1"]=number_format( $list[$key]["OTHER"],2);} else {
	};
	if ($list[$key]["HEMO"] > 0 ){$list[$key]["HEMO1"]=number_format( $list[$key]["HEMO"],2);} else {
	};
	if ($list[$key]["EYE"] > 0 ){$list[$key]["EYE1"]=number_format( $list[$key]["EYE"],2);} else {
	};	
	if ($list[$key]["OTHER2"] > 0 ){$list[$key]["OTHER2"]=number_format( $list[$key]["OTHER2"],2);} else 
	{
	};

	$total=$list[$key]["PHAR"]+$list[$key]["PATHO"]+$list[$key]["XRAY"]+$list[$key]["DENTA"]+$list[$key]["PHYSI"]+$list[$key]["EMER"]+$list[$key]["SURG"]+$list[$key]["NID"]+$list[$key]["OTHER"]+$list[$key]["HEMO"]+$list[$key]["EYE"]+$list[$key]["OTHER2"];
	$total=number_format($total,2);

    echo "<tr>
	<td align='center'><font face='Angsana New' size ='2'>".$num."</td>
	<td><font face='Angsana New' size ='2'>".$xx[0]."</td>
	<td><font face='Angsana New' size ='2'>&nbsp;&nbsp;".$xx[1]."&nbsp;</td>
	<td><font face='Angsana New' size ='2'>&nbsp;&nbsp;".$xx[4]."&nbsp;</td>
	<td align='center'><font face='Angsana New' size ='2'>&nbsp;&nbsp;".$xx[2]."&nbsp;</td>";
if($credit=="phar"){
	echo "<td align='right'><font face='Angsana New' size ='2'>".$list[$key]["PHAR1"]."</td>";
}else if($credit=="patho"){
	echo "<td align='right'><font face='Angsana New' size ='2'>".$list[$key]["PATHO1"]."</td>";
}else if($credit=="xray"){
	echo "<td align='right'><font face='Angsana New' size ='2'>".$list[$key]["XRAY1"]."</td>";
}else if($credit=="dental"){
	echo "<td align='right'><font face='Angsana New' size ='2'>".$list[$key]["DENTA1"]."</td>";
}else if($credit=="pt"){
	echo "<td align='right'><font face='Angsana New' size ='2'>".$list[$key]["PHYSI1"]."</td>";
}else if($credit=="emer"){
	echo "<td align='right'><font face='Angsana New' size ='2'>".$list[$key]["EMER1"]."</td>";
}else if($credit=="surg"){
	echo "<td align='right'><font face='Angsana New' size ='2'>".$list[$key]["SURG1"]."</td>";
}else if($credit=="nid"){
	echo "<td align='right'><font face='Angsana New' size ='2'>".$list[$key]["NID1"]."</td>";
}else if($credit=="hemo"){
	echo "<td align='right'><font face='Angsana New' size ='2'>".$list[$key]["HEMO1"]."</td>";
}else if($credit=="other"){
	echo "<td align='right'><font face='Angsana New' size ='2'>".$list[$key]["OTHER1"]."</td>";
}else if($credit=="eye"){
	echo "<td align='right'><font face='Angsana New' size ='2'>".$list[$key]["EYE1"]."</td>";
}else{
	echo "<td align='right'><font face='Angsana New' size ='2'>".$list[$key]["OTHER2"]."</td>";
}
	
	echo "</tr>";

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

} // END foreach


if($credit=="phar"){
	$sumtotal=number_format( $PHAR,2);
}else if($credit=="patho"){
	$sumtotal=number_format( $PATHO,2);
}else if($credit=="xray"){
	$sumtotal=number_format($XRAY,2);
}else if($credit=="dental"){
	$sumtotal=number_format( $DENTA,2);
}else if($credit=="pt"){
	$sumtotal=number_format( $PHYSI,2);
}else if($credit=="emer"){
	$sumtotal=number_format( $EMER,2);
}else if($credit=="surg"){
	$sumtotal=number_format( $SURG,2);
}else if($credit=="nid"){
	$sumtotal=number_format($NID,2);
}else if($credit=="other"){
	$sumtotal=number_format($OTHER,2);
}else if($credit=="hemo"){
	$sumtotal=number_format($HEMO,2);
}else if($credit=="eye"){
	$sumtotal=number_format($EYE,2);
}else{
	$sumtotal=number_format($OTHER1,2);
}

echo "<tr>
<td colspan='5' align='right'><b>รวมทั้งหมด</b></td>
<td align='right'><b>&nbsp;".$sumtotal."&nbsp;</b></td>
</tr>";

echo "</table>";
?>
</body>
</html>