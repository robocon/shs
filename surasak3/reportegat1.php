<?php
session_start();
include("connect.inc");
//  $yrmonth="$thiyr-$rptmo-$date";
$showdate1=$_POST["date1"]."/".$_POST["month1"]."/".$_POST["year1"];
$showdate2=$_POST["date2"]."/".$_POST["month2"]."/".$_POST["year2"];

$chkdate1=$_POST["year1"]."-".$_POST["month1"]."-".$_POST["date1"]." 00:00:00";
$chkdate2=$_POST["year2"]."-".$_POST["month2"]."-".$_POST["date2"]." 23:59:59";

$sql = "Select a.date,a.txdate, a.hn, CONCAT(b.yot,' ',b.name,' ',b.surname) as full_name, a.depart, sum(a.price),b.idcard,b.note,sum(a.paidcscd),billno From opacc as a, opcard as b  where a.hn=b.hn AND (a.txdate >= '$chkdate1' and a.txdate <='$chkdate2')  AND a.credit ='กฟผ'  group by a.date, a.hn, a.vn, a.depart ORDER by a.txdate";
$result = mysql_Query($sql) or die(mysql_error());
//echo $sql;
$list = array();
$list2 = array();

while(list($date,$txdate, $hn, $full_name, $depart, $price,$idcard,$note,$paidcscd,$billno) = Mysql_fetch_row($result)){
	//echo $hn."===>".$invno;

$date=substr($txdate,0,10);
$d=substr($txdate,8,2);
$m=substr($txdate,4,4);
$y=substr($txdate,0,4);

  //$note=substr($note,0,50);
  //$note=mb_substr($note,0,25,"UTF-8"); 

	$list2[$hn] = $d."".$m."".$y."/".$full_name."/".$idcard."/".$note."/".$billno;
switch($depart){

case "PHAR" : $list[$hn]["PHAR"] = $list[$hn]["PHAR"] + $price; break;
case "PATHO" : $list[$hn]["PATHO"] = $list[$hn]["PATHO"] + $price; break;
case "XRAY" : $list[$hn]["XRAY"] = $list[$hn]["XRAY"] + $price; break;
case "NID" : $list[$hn]["NID"] = $list[$hn]["NID"] + $paid; break;
//case "EMER" : $list[$hn]["EMER"] = $list[$hn]["EMER"] + $price; break;
//case "SURG" : $list[$hn]["SURG"] = $list[$hn]["SURG"] + $price; break;
default:  $list[$hn]["OTHER"] = $list[$hn]["OTHER"] + $price; break;


}

}
$num='0';
$i='0';
echo "<font face='TH SarabunPSK' size ='4'><center><strong>ลูกหนี้กฟผ ประจำวันที่ $showdate1 ถึงวันที่ $showdate2 <br></strong>";
echo "<font face='TH SarabunPSK' size ='3'>โรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง </center>";
echo "<table  border ='1' bordercolor='#000000' cellspacing='0' cellpadding='2' style='BORDER-COLLAPSE: collapse' >";
echo "<tr>
<td>#</td>
<td><font face='TH SarabunPSK' size ='3'><center><strong>ชื่อ - สกุล</strong></center></td>
<td><font face='TH SarabunPSK' size ='3'><center><strong>วันที่เข้ารับบริการ</strong></center></td>
<td><font face='TH SarabunPSK' size ='3'><center><strong>billno</strong></center></td>
<td><font face='TH SarabunPSK' size ='3'><center><strong>hn</strong></center></td>
<td><font face='TH SarabunPSK' size ='3'><center><strong>vn</strong></center></td>
<td><font face='TH SarabunPSK' size ='3'><center><strong>บัตรประชาชน</strong></center></td>
<td><center><strong><font face='TH SarabunPSK' size ='3'>ICD10</strong></center></td>
<td><center><strong><font face='TH SarabunPSK' size ='3'>ICD9</strong></center></td>
<td><center><strong>ยา</strong></center></td>
<td><font face='TH SarabunPSK' size ='3'><center><strong>พยาธิ</strong></center></td>
<td><font face='TH SarabunPSK' size ='3'><center><strong>เอกเรย์</strong></center></td>
<td><font face='TH SarabunPSK' size ='3'><center><strong>ตรวจอื่นๆ</strong></center></td>
<td><center><strong><font face='TH SarabunPSK' size ='3'>รวม</strong></center></td>
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


$sql = "SELECT icd10,icd9cm,icd101,doctor,thidate,vn FROM opday WHERE  hn = '".$key."' and  thdatehn like '".$xx[0]."%' ";
//echo $sql."<br>";
list($icd10,$icd9cm,$icd101,$doctor,$thidate,$vn) = mysql_fetch_row(mysql_query($sql));

$opdate=explode(' ',$thidate);
$dateth=$opdate[0];
$dateth1=explode('-',$dateth);
$yy=$dateth1[0]-543;
//$day=$dateth1[2].'-'.$dateth1[1].'-'.$dateth1[0];
$day=$yy.''.$dateth1[1].''.$dateth1[2];
$timeth=$opdate[1];
//$datetime=$day.' '.$timeth;
$datetime=$day;
//$vn=sprintf("%03d",$vn);

    echo "<tr  >
	<td><font face='TH SarabunPSK' size ='3'>".$num."</td>
	<td><font face='TH SarabunPSK' size ='3'>".$xx[1]."</td>
	<td><font face='TH SarabunPSK' size ='3'>".$datetime."</td>
	<td><font face='TH SarabunPSK' size ='3'>".$xx[4]."</td>
	<td><font face='TH SarabunPSK' size ='3'>".$key."</td>
	<td><font face='TH SarabunPSK' size ='3'>".$vn."</td>
	<td><font face='TH SarabunPSK' size ='3'>".$xx[2]."</td>
	<td align='right'><font face='TH SarabunPSK' size ='3'>".$icd10."</td>
	<td align='right'><font face='TH SarabunPSK' size ='3'>".$icd9cm."</td>
	<td align='right'><font face='TH SarabunPSK' size ='3'>".$list[$key]["PHAR1"]."</td>
	<td align='right'><font face='TH SarabunPSK' size ='3'>".$list[$key]["PATHO1"]."</td>
	<td align='right'><font face='TH SarabunPSK' size ='3'>".$list[$key]["XRAY1"]."</td>
	<td align='right'><font face='TH SarabunPSK' size ='3'>".$OTHER1."</td>
	<td align='right'><font face='TH SarabunPSK' size ='3'><b>".$total."</b></td>
	</tr>";



	if($i == '100'){
			echo "</table>";
			print ("<tr><td><div style=\"page-break-before: always;\"></div></td></tr>");

echo "<font face='TH SarabunPSK' size ='4'><center><strong>ลูกหนี้กฟผ ประจำวันที่ $showdate1 ถึงวันที่ $showdate2<br></strong>";
echo "<font face='TH SarabunPSK' size ='3'> โรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง </center>";

echo "<table  border ='1' bordercolor='#000000' cellspacing='0' cellpadding='2'  style='BORDER-COLLAPSE: collapse' >";



echo "<tr><td border-style:dashed>#</td>
<td>#</td>
<td><font face='TH SarabunPSK' size ='3'><center><strong>ชื่อ - สกุล</strong></center></td>
<td><font face='TH SarabunPSK' size ='3'><center><strong>วันที่เข้ารับบริการ</strong></center></td>
<td><font face='TH SarabunPSK' size ='3'><center><strong>billno</strong></center></td>
<td><font face='TH SarabunPSK' size ='3'><center><strong>hn</strong></center></td>
<td><font face='TH SarabunPSK' size ='3'><center><strong>vn</strong></center></td>
<td><font face='TH SarabunPSK' size ='3'><center><strong>บัตรประชาชน</strong></center></td>
<td><center><strong><font face='TH SarabunPSK' size ='3'>ICD10</strong></center></td>
<td><center><strong><font face='TH SarabunPSK' size ='3'>ICD9</strong></center></td>
<td><center><strong>ยา</strong></center></td>
<td><font face='TH SarabunPSK' size ='3'><center><strong>พยาธิ</strong></center></td>
<td><font face='TH SarabunPSK' size ='3'><center><strong>เอกเรย์</strong></center></td>
<td><font face='TH SarabunPSK' size ='3'><center><strong>ตรวจอื่นๆ</strong></center></td>
<td><center><strong><font face='TH SarabunPSK' size ='3'>รวมทั้งสิ้น</strong></center></td>
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

echo "<tr><b>
<td colspan='9' align='right'><b><font face='TH SarabunPSK' size ='3'>รวมเป็นเงิน</b></td>
<td align='right'><font face='TH SarabunPSK' size ='3'><b>".$PHAR."</td>
<td align='right'><font face='TH SarabunPSK' size ='3'><b>".$PATHO."</td>
<td align='right'><font face='TH SarabunPSK' size ='3'><b>".$XRAY."</td>
<td align='right'><font face='TH SarabunPSK' size ='3'><b>".$OTHER1."</td>
<td align='right'><font face='TH SarabunPSK' size ='3'><b>".$sum."</td></b>
</tr></FONT>";

echo "</table>";



