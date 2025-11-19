<?php
session_start();
require_once 'connect.php';
//  $yrmonth="$thiyr-$rptmo-$date";
function dump($t){
	echo "<pre>";
	var_dump($t);
	echo "</pre>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>รายงานส่งAudit</title>
</head>
<style type="text/css">
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 21px;  
}

</style>
<body>
<?php 
$chkdate1=($_POST["year1"])."-".$_POST["month1"]."-".$_POST["date1"];
$chkdate2=($_POST["year2"])."-".$_POST["month2"]."-".$_POST["date2"];
	
// ของเดิม group by a.hn, a.depart 
$sql = "SELECT a.`date`,
a.`txdate`,
a.`hn`,
CONCAT(b.`yot`,' ',b.`name`,' ',b.`surname`) AS full_name,
a.`depart`,
a.`paid`,
a.`paidcscd`,
CONCAT(SUBSTRING(a.`date`,1,10),a.`hn`,a.`depart`) AS `thdateHn` ,
a.`credit`,
a.`credit_detail`,
a.`idname`,
a.`billno`,
a.`price`,
a.`vn`
FROM `opacc` AS a, 
`opcard` AS b 
where a.`hn`=b.`hn` 
AND (a.date >= '$chkdate1 00:00:00' and a.date <='$chkdate2 23:59:59')  
AND (a.`credit` !='ยกเลิก' AND a.`credit` !='นอนโรงพยาบาล' AND a.`credit` !='อื่นๆ' AND a.`credit` !='ยกเว้น'  AND a.`credit` !='ค้างจ่าย') 
ORDER by a.`date` ASC";

//echo $sql;
$result = mysql_Query($sql) or die(mysql_error());
$list = array();
$list2 = array();

while(list($date, $txdate, $hn, $full_name, $depart, $paid, $paidcscd, $thdatehn,$showcredit,$depart_detail,$idname,$billno,$price,$vn) = Mysql_fetch_row($result)){

	$visitdate=substr($txdate,0,10);  //วันที่รับบริการ
	$txd=substr($visitdate,8,2);
	$txm=substr($visitdate,4,4);
	$txy=substr($visitdate,0,4);


	$date=substr($date,0,10);  //วันที่เรียกเก็บ
	$d=substr($date,8,2);
	$m=substr($date,4,4);
	$y=substr($date,0,4);

	// ของเดิมใช้ key ของ array $list2 เป็น $hn
	$key = $txdate.$hn.$depart.$showcredit.$billno;

	$list2[$key] = $d."".$m."".$y."|".$full_name."|".$showcredit."|".$depart_detail."|".$hn."|".$depart."|".$idname."|".$billno."|".$price."|".$txd."".$txm."".$txy."|".$vn."|".$visitdate;
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
}else if($showcredit=="เงินสด" || $showcredit=="เงินโอน" || $showcredit=="30บาท" || $showcredit=="ประกันสังคม" || $showcredit=="พรบ." || $showcredit=="กท.44" || $showcredit=="เช็ค" || $showcredit=="ทหารไทย" || $showcredit=="กรุงไทย"){
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

echo "<center> <b>ลูกหนี้ผู้ป่วยนอก ประจำวันที่ $date2 <br></b> ";
echo " โรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<!--แผ่นที่&nbsp;$p--></center>";
echo "<table  border ='1' bordercolor='#000000' cellspacing='0' cellpadding='0' style='BORDER-COLLAPSE: collapse' align='center' width='90%'>";
echo "<tr>
<td><center><b>วันที่เรียกเก็บ</td>
<td><center><b>วันที่รับบริการ</td>
<td><center><b>User</td>
<td><center><b>ชื่อ-สกุล</td>
<td><center><b>HN</td>
<td><center><b>VN</td>
<td><center><b>หมวด</b></td>
<td><center><b>ลูกหนี้</b></td>
<td><center><b>Billno</td>
<td><center><b>จำนวนเงิน</td>
<td><center><b>เรียกเก็บ</td>
</tr>";
foreach ($list2 as $key => $value) {

	$xx = explode("|",$value);
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


if($xx[5]=="PHAR"){
	$showdepart="ยา/เวชภัณฑ์";
}else if($xx[5]=="PATHO"){
	$showdepart="พยาธิ";
}else if($xx[5]=="XRAY"){
	$showdepart="เอ็กซเรย์";
}else if($xx[5]=="DENTA"){
	$showdepart="ทันตกรรม";
}else if($xx[5]=="PHYSI"){
	$showdepart="กายภาพ";
}else if($xx[5]=="EMER"){
	$showdepart="บริการ";
}else if($xx[5]=="SURG"){
	$showdepart="ผ่าตัด/หัตถการ";
}else if($xx[5]=="NID"){
	$showdepart="นวด/ฝังเข็ม";
}else if($xx[5]=="HEMO"){
	$showdepart="ไตเทียม";
}else if($xx[5]=="OTHER"){
	 $showdepart="ค่าบริการอื่นๆ";
}else if($xx[5]=="EYE"){
	 $showdepart="ตา";
}else{
	 $showdepart="อื่นๆ";
}


if($xx[10]==""){
	$sql2="select vn from opday where hn='".$xx[4]."' and thidate like '".$xx[11]."%' ";
	//echo $sql2."<br>";
	$query2=mysql_query($sql2);
	list($vn)=mysql_fetch_array($query2);	
}else{
	$vn=$xx[10];
}	




    echo "<tr>
	<td align='center'>".$xx[0]."</td>
	<td align='center'>".$xx[9]."</td>
	<td>".$xx[6]."</td>
	<td>".$xx[1]."</td>
	<td align='center'>".$xx[4]."</td>
	<td align='center'>".$vn."</td>
	<td>".$showdepart."</td>
	<td align='center'>".$xx[2]."</td>
	<td align='center'>".$xx[7]."</td>
	<td align='right'>".number_format($xx[8],2)."</td>";
	
if($xx[5]=="PHAR"){
	echo "<td align='right'>".$list[$key]["PHAR1"]."</td>";
}else if($xx[5]=="PATHO"){
	echo "<td align='right'>".$list[$key]["PATHO1"]."</td>";
}else if($xx[5]=="XRAY"){
	echo "<td align='right'>".$list[$key]["XRAY1"]."</td>";
}else if($xx[5]=="DENTA"){
	echo "<td align='right'>".$list[$key]["DENTA1"]."</td>";
}else if($xx[5]=="PHYSI"){
	echo "<td align='right'>".$list[$key]["PHYSI1"]."</td>";
}else if($xx[5]=="EMER"){
	echo "<td align='right'>".$list[$key]["EMER1"]."</td>";
}else if($xx[5]=="SURG"){
	echo "<td align='right'>".$list[$key]["SURG1"]."</td>";
}else if($xx[5]=="NID"){
	echo "<td align='right'>".$list[$key]["NID1"]."</td>";
}else if($xx[5]=="HEMO"){
	echo "<td align='right'>".$list[$key]["HEMO1"]."</td>";
}else if($xx[5]=="OTHER"){
	echo "<td align='right'>".$list[$key]["OTHER1"]."</td>";
}else if($xx[5]=="EYE"){
	echo "<td align='right'>".$list[$key]["EYE1"]."</td>";
}else{
	echo "<td align='right'>".$list[$key]["OTHER2"]."</td>";
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
echo "</table>";
?>
</body>
</html>