<?php
session_start();
include("connect.inc");

$pt_code = $_POST['ptright'];

//  $yrmonth="$thiyr-$rptmo-$date";
if($date == 'เลือก'){
	$date = '';
}
$date1 ="$thiyr-$rptmo-$date";
$date2 ="$date-$rptmo-$thiyr";
$sql = "Select a.date,a.txdate, a.hn, CONCAT(b.yot,' ',b.name,' ',b.surname) as full_name, a.depart, sum(a.price),b.idcard,b.note,sum(a.paidcscd) 
From opacc as a, 
opcard as b 
where a.hn=b.hn 
AND a.date like '".$date1."%'  
AND a.credit ='30บาท' 
AND a.ptright LIKE '$pt_code%'
group by a.hn, a.depart   
ORDER by a.date";
// var_dump($sql);
$result = mysql_Query($sql) or die(mysql_error());

$list = array();
$list2 = array();

while(list($date,$txdate, $hn, $full_name, $depart, $price,$idcard,$note,$paidcscd) = Mysql_fetch_row($result)){

 $date=substr($date,0,10);
 $d=substr($date,8,2);
  $m=substr($date,4,4);
   $y=substr($date,0,4);

  $note=substr($note,0,25);

	$list2[$hn] = $d."".$m."".$y."/".$full_name."/".$idcard."/".$note;
switch($depart){

	case "PHAR" : $list[$hn]["PHAR"] = $list[$hn]["PHAR"] + $price; break;
	case "PATHO" : $list[$hn]["PATHO"] = $list[$hn]["PATHO"] + $price; break;
	case "XRAY" : $list[$hn]["XRAY"] = $list[$hn]["XRAY"] + $price; break;
case "NID" : $list[$hn]["NID"] = $list[$hn]["NID"] + $paidcscd; break;
//case "EMER" : $list[$hn]["EMER"] = $list[$hn]["EMER"] + $price; break;
//case "SURG" : $list[$hn]["SURG"] = $list[$hn]["SURG"] + $price; break;
default:  $list[$hn]["OTHER"] = $list[$hn]["OTHER"] + $price; break;


}

}
$num='0';
$i='0';
echo "<font face='Angsana New' size ='4'><center> <b>ลูกหนหลักประกันสุขภาพประจำวันที่ $date2 <br></b> ";
echo "<font face='Angsana New' size ='3'> โรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง </center>";
echo "<table  border ='1' bordercolor='#000000' cellspacing='0' cellpadding='2' style='BORDER-COLLAPSE: collapse' >";
echo "<tr>
<td>&nbsp;&nbsp;#&nbsp;&nbsp;</td>
<td><font face='Angsana New' size ='1'><center> <b>&nbsp;&nbsp;วันที่&nbsp;&nbsp;</td>
<td><font face='Angsana New' size ='1'><center> <b>&nbsp;&nbsp;hn&nbsp;&nbsp;</td>
<td><font face='Angsana New' size ='1'><center> <b>&nbsp;&nbsp;ชื่อ - สกุล&nbsp;&nbsp;</td>
<td><font face='Angsana New' size ='1'><center> <b>&nbsp;&nbsp;บัตรประชาชน&nbsp;&nbsp;</td>
<td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;นายจ้าง&nbsp;&nbsp;</td>
<td><center> <b>&nbsp;&nbsp;ยา&nbsp;&nbsp;</td>
<td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;พยาธิ&nbsp;&nbsp;</td>
<td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;เอกเรย์&nbsp;&nbsp;&nbsp;</td>
<td><font face='Angsana New' size ='1'><center> <b>&nbsp;&nbsp;ตรวจอื่นๆ&nbsp;&nbsp;</td>
<td><center> <b><font face='Angsana New' size ='1'><center>&nbsp;&nbsp;รวม&nbsp;&nbsp;</td>
<!--<td><center> <b><font face='Angsana New' size ='1'><center>&nbsp;&nbsp;ICD10&nbsp;&nbsp;</td>
<td><center> <b><font face='Angsana New' size ='2'><center>&nbsp;&nbsp;ICD9&nbsp;&nbsp;</td>
<td><center> <b><font face='Angsana New' size ='1'><center>&nbsp;&nbsp;ICD10รอง&nbsp;&nbsp;</td>
<td><center> <b><font face='Angsana New' size ='1'><center>&nbsp;&nbsp;แพทย์&nbsp;&nbsp;</td>-->
</tr>";
foreach ($list2 as $key => $value) {

	$xx = explode("/",$value);
	$num++;
$i++;



$OTHER1=$list[$key]["NID"]+$list[$key]["OTHER"];

if ($list[$key]["PHAR"] > 0 ){$list[$key]["PHAR1"]=number_format( $list[$key]["PHAR"],2);} else {
	};
if ($list[$key]["PATHO"] > 0 ){$list[$key]["PATHO1"]=number_format( $list[$key]["PATHO"],2);} else {
	};
if ($list[$key]["XRAY"] > 0 ){$list[$key]["XRAY1"]=number_format( $list[$key]["XRAY"],2);} else {
	};
if ($list[$key]["PHYSI"] > 0 ){$list[$key]["PHYSI1"]=number_format( $list[$key]["PHYSI"],2);} else {
	};
	if ($list[$key]["EMER"] > 0 ){$list[$key]["EMER1"]=number_format( $list[$key]["EMER"],2);} else {
	};
	if ($list[$key]["SURG"] > 0 ){$list[$key]["SURG1"]=number_format( $list[$key]["SURG"],2);} else {
	};

if ($OTHER1 > 0 ){$OTHER1=number_format( $OTHER1,2);} else {
	};


$total=$list[$key]["PHAR"]+$list[$key]["PATHO"]+$list[$key]["XRAY"]+$list[$key]["PHYSI"]+$list[$key]["EMER"]+$list[$key]["SURG"] +$list[$key]["NID"]+$list[$key]["OTHER"];
$total=number_format($total,2);


 $sql = "SELECT icd10,icd9cm,icd101,doctor FROM opday WHERE  hn = '".$key."' and  thdatehn like '".$date2."%' ";

   list($icd10,$icd9cm,$icd101,$doctor) = mysql_fetch_row(Mysql_Query($sql));



	echo "<tr  >
	<td><font face='Angsana New' size ='2'>&nbsp;&nbsp;".$num."&nbsp;</td>
	<td><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$xx[1]."&nbsp;</b></td>
	<td><font face='Angsana New' size ='2'>&nbsp;&nbsp;".$xx[0]."&nbsp;</td>
	<td><font face='Angsana New' size ='2'>&nbsp;&nbsp;".$key."&nbsp;</td>
	<td><font face='Angsana New' size ='1'>&nbsp;&nbsp;".$xx[2]."&nbsp;</td>
	<td><font face='Angsana New' size ='1'>&nbsp;&nbsp;".$xx[3]."&nbsp;</td>
	<td align='right'><font face='Angsana New' size ='2'>".$list[$key]["PHAR1"]."</td>
	<td align='right'><font face='Angsana New' size ='2'>".$list[$key]["PATHO1"]."</td>
	<td align='right'><font face='Angsana New' size ='2'>".$list[$key]["XRAY1"]."</td>
	<td align='right'><font face='Angsana New' size ='2'>".$OTHER1."</td>
	<td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$total."&nbsp;</b></td>
	<!-- <td align='right'><font face='Angsana New' size ='1'>&nbsp;&nbsp;".$icd10."&nbsp;</td>
	<td align='right'><font face='Angsana New' size ='1'>&nbsp;&nbsp;".$icd9cm."&nbsp;</td>
	<td align='right'><font face='Angsana New' size ='1'>&nbsp;&nbsp;".$icd101."&nbsp;</td>
	<td align='right'><font face='Angsana New' size ='1'>&nbsp;&nbsp;".$doctor."&nbsp;</td> -->
	</tr>";



	if($i == '20'){
			echo "</table>";
			print ("<tr><td><div style=\"page-break-before: always;\"></div></td></tr>");

echo "<font face='Angsana New' size ='4'><center> <b>ลูกหนี้หลักประกันสุขภาพประจำวันที่ $date2 <br></b> ";
echo "<font face='Angsana New' size ='3'> โรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง </center>";

echo "<table  border ='1' bordercolor='#000000' cellspacing='0' cellpadding='2'  style='BORDER-COLLAPSE: collapse' >";



echo "<tr>
<td border-style:dashed>&nbsp;&nbsp;#&nbsp;&nbsp;</td>
<td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;วันที่&nbsp;&nbsp;</td>
<td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;hn&nbsp;&nbsp;</td>
<td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;ชื่อ - สกุล&nbsp;&nbsp;</td>
<td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;บัตรประชาชน&nbsp;&nbsp;</td>
<td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;นายจ้าง&nbsp;&nbsp;</td>
<td><center> <b>&nbsp;&nbsp;ยา&nbsp;&nbsp;</td>
<td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;พยาธิ&nbsp;&nbsp;</td>
<td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;เอกเรย์&nbsp;&nbsp;&nbsp;</td>
<td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;ตรวจอื่นๆ&nbsp;&nbsp;</td>
<td><center> <b>&nbsp;&nbsp;รวม&nbsp;&nbsp;</td>
<!-- <td><center> <b>&nbsp;&nbsp;ICD10หลัก&nbsp;&nbsp;</td>
<td><center> <b>&nbsp;&nbsp;ICD9&nbsp;&nbsp;</td>
<td><center> <b>&nbsp;&nbsp;ICD10รอง&nbsp;&nbsp;</td>
<td><center> <b><font face='Angsana New' size ='1'><center>&nbsp;&nbsp;แพทย์&nbsp;&nbsp;</td> -->
</tr>";
$i='0';


		}



	$PHAR = $PHAR+$list[$key]["PHAR"];
	$PATHO = $PATHO+$list[$key]["PATHO"];
	$XRAY = $XRAY+$list[$key]["XRAY"];
		$PHYSI = $PHYSI+$list[$key]["PHYSI"];	
		$EMER = $EMER+$list[$key]["EMER"];	
		$SURG = $SURG+$list[$key]["SURG"];
		$NID = $NID+$list[$key]["NID"];
	$OTHER = $OTHER+$list[$key]["OTHER"];
	$OTHER1=$OTHER+$NID;
	$sum = $sum+($list[$key]["PHAR"]+$list[$key]["PATHO"]+$list[$key]["XRAY"]+$list[$key]["PHYSI"]+$list[$key]["EMER"]+$list[$key]["SURG"]+$list[$key]["NID"]+$list[$key]["OTHER"]);
}


$PHAR=number_format( $PHAR,2);
$PATHO=number_format( $PATHO,2);
$XRAY=number_format($XRAY,2);
$PHYSI=number_format($PHYSI,2);
$EMER=number_format($EMER,2);
$SURG=number_format($SURG,2);
$OTHER1=number_format($OTHER1,2);

$sum=number_format($sum,2);

echo "<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><b><font face='Angsana New' size ='2'><center>รวม</td><td>&nbsp;</b></td>
<td align='right'><font face='Angsana New' size ='2'><b>".$PHAR."</b></td>
<td align='right'><font face='Angsana New' size ='2'><b>".$PATHO."</b></td>
<td align='right'><font face='Angsana New' size ='2'><b>".$XRAY."</b></td>
<td align='right'><font face='Angsana New' size ='2'><b>".$OTHER1."</b></td>
<td align='right'><font face='Angsana New' size ='3'><b>&nbsp;".$sum."&nbsp;</b></td>
<!--<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>-->
</tr></FONT>";

echo "</table>";



