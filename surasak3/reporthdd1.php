<?php
session_start();
include("connect.inc");
//  $yrmonth="$thiyr-$rptmo-$date";
$dateopday = $date1 ="$thiyr-$rptmo-$date";
$date2 ="$date-$rptmo-$thiyr";
$sql = "Select a.date,a.txdate, a.hn, CONCAT(b.yot,' ',b.name,' ',b.surname) as full_name, a.depart, sum(a.paid),a.credit_detail From opacc as a, opcard as b where a.hn=b.hn AND a.date like '".$date1."%' AND a.credit ='HD' group by a.hn, a.depart   ORDER by a.date,a.credit_detail";

$result = mysql_Query($sql) or die(mysql_error());
$list = array();
$list2 = array();

while(list($date1, $date, $hn, $full_name, $depart, $paidcscd,$credit_detail) = Mysql_fetch_row($result)){
	$sql2 = "select vn from opday where hn='$hn' and thidate like '".$dateopday."%' limit 1";
	list($vn) = mysql_fetch_array(mysql_query($sql2));
	
 $date=substr($date,0,10);
 $d=substr($date,8,2);
  $m=substr($date,4,4);
   $y=substr($date,0,4);


	$list2[$hn] = $d."".$m."".$y."/".$full_name."/".$credit_detail."/".$vn;
switch($depart){
	case "PHAR" : $list[$hn]["PHAR"] = $list[$hn]["PHAR"] + $paidcscd; break;
	case "PATHO" : $list[$hn]["PATHO"] = $list[$hn]["PATHO"] + $paidcscd; break;
	case "XRAY" : $list[$hn]["XRAY"] = $list[$hn]["XRAY"] + $paidcscd; break;
	case "DENTA" : $list[$hn]["DENTA"] = $list[$hn]["DENTA"] + $paidcscd; break;
	case "PHYSI" : $list[$hn]["PHYSI"] = $list[$hn]["PHYSI"] + $paidcscd; break;
	case "EMER" : $list[$hn]["EMER"] = $list[$hn]["EMER"] + $paidcscd; break;
	case "SURG" : $list[$hn]["SURG"] = $list[$hn]["SURG"] + $paidcscd; break;
	case "NID" : $list[$hn]["NID"] = $list[$hn]["NID"] + $paidcscd; break;
		case "OTHER" : $list[$hn]["OTHER"] = $list[$hn]["OTHER"] + $paidcscd; break;
				case "HEMO" : $list[$hn]["HEMO"] = $list[$hn]["HEMO"] + $paidcscd; break;
	default:  $list[$hn]["OTHER2"] = $list[$hn]["OTHER2"] + $paidcscd; break;

}

}
$num='0';
$i='0';
$p='1';

echo "<font face='Angsana New' size ='4'><center> <b>ลูกหนี้โครงการHDประจำวันที่ $date2 <br></b> ";
echo "<font face='Angsana New' size ='3'> โรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;แผ่นที่&nbsp;$p</center>";
echo "<table  border ='1' bordercolor='#000000' cellspacing='0' cellpadding='0' style='BORDER-COLLAPSE: collapse'>";
echo "<tr><td>&nbsp;&nbsp;#&nbsp;&nbsp;</td>
<td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;วันที่&nbsp;&nbsp;</td>
<td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;ชื่อ - สกุล&nbsp;&nbsp;</td>
<td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;สิทธิ์&nbsp;&nbsp;</td>

<td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;hn&nbsp;&nbsp;</td>
<td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;vn&nbsp;&nbsp;</td>
<td><center> <b>&nbsp;&nbsp;ยา&nbsp;&nbsp;</td>
<td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;พยาธิ&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;เอกเรย์&nbsp;&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;ทันตกรรม&nbsp;&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;กายภาพ&nbsp;&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;บริการ&nbsp;&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;ผ่าตัด&nbsp;&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;ฝังเข็ม&nbsp;&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;ไตเทียม&nbsp;&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b><center> <b>&nbsp;&nbsp;ตรวจอื่นๆ&nbsp;&nbsp;</td><td>&nbsp;&nbsp;***&nbsp;&nbsp;</td><td><center> <b>&nbsp;&nbsp;รวม&nbsp;&nbsp;</td></tr>";
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
if ($list[$key]["OTHER2"] > 0 ){$list[$key]["OTHER21"]=number_format( $list[$key]["OTHER2"],2);} else 
	{
	};




$total=$list[$key]["PHAR"]+$list[$key]["PATHO"]+$list[$key]["XRAY"]+$list[$key]["DENTA"]+$list[$key]["PHYSI"]+$list[$key]["EMER"]+$list[$key]["SURG"]+$list[$key]["NID"]+$list[$key]["OTHER"]+$list[$key]["HEMO"]+$list[$key]["OTHER2"];
$total=number_format($total,2);



    echo "<tr  ><td><font face='Angsana New' size ='2'>&nbsp;&nbsp;".$num."&nbsp;</td><td><font face='Angsana New' size ='2'>&nbsp;&nbsp;".$xx[0]."&nbsp;</td><td><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$xx[1]."&nbsp;</b><td><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$xx[2]."&nbsp;</b></td><td><font face='Angsana New' size ='2'>&nbsp;&nbsp;".$key."&nbsp;</td><td><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$xx[3]."&nbsp;</b></td><td align='right'><font face='Angsana New' size ='2'>&nbsp;&nbsp;".$list[$key]["PHAR1"]."&nbsp;</td><td align='right'><font face='Angsana New' size ='2'>&nbsp;&nbsp;".$list[$key]["PATHO1"]."&nbsp;</td><td align='right'><font face='Angsana New' size ='2'>&nbsp;&nbsp;".$list[$key]["XRAY1"]."&nbsp;</td><td align='right'><font face='Angsana New' size ='2'>&nbsp;&nbsp;".$list[$key]["DENTA1"]."&nbsp;</td><td align='right'><font face='Angsana New' size ='2'>&nbsp;&nbsp;".$list[$key]["PHYSI1"]."&nbsp;</td><td align='right'><font face='Angsana New' size ='2'>&nbsp;&nbsp;".$list[$key]["EMER1"]."&nbsp;</td><td align='right'><font face='Angsana New' size ='2'>&nbsp;&nbsp;".$list[$key]["SURG1"]."&nbsp;</td><td align='right'><font face='Angsana New' size ='2'>&nbsp;&nbsp;".$list[$key]["NID1"]."&nbsp;</td><td align='right'><font face='Angsana New' size ='2'>&nbsp;&nbsp;".$list[$key]["HEMO1"]."&nbsp;</td><td align='right'><font face='Angsana New' size ='2'>&nbsp;&nbsp;".$list[$key]["OTHER1"]."&nbsp;</td><td align='right'><font face='Angsana New' size ='2'>&nbsp;&nbsp;".$list[$key]["OTHER21"]."&nbsp;</td><td align='right'><font face='Angsana New' size ='3'><b>&nbsp;&nbsp;".$total."&nbsp;</b></td></tr>";



	if($i == '20'){
		$p++;
			echo "</table>";
			print ("<tr><td><div style=\"page-break-before: always;\"></div></td></tr>");

echo "<font face='Angsana New' size ='4'><center> <b>ลูกหนี้โครงการHDประจำวันที่ $date2 <br></b> ";
echo "<font face='Angsana New' size ='3'> โรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;แผ่นที่&nbsp;$p</center>";

echo "<table  border ='1' bordercolor='#000000' cellspacing='0' cellpadding='0' style='BORDER-COLLAPSE: collapse'>";



echo "<tr><td>&nbsp;&nbsp;#&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;วันที่&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;ชื่อ - สกุล&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;สิทธิ์&nbsp;&nbsp;</td>
<td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;hn&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;vn&nbsp;&nbsp;</td><td><center> <b>&nbsp;&nbsp;ยา&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;พยาธิ&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;เอกเรย์&nbsp;&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;ทันตกรรม&nbsp;&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;กายภาพ&nbsp;&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;บริการ&nbsp;&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;ผ่าตัด&nbsp;&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;ฝังเข็ม&nbsp;&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;ไตเทียม&nbsp;&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b><center> <b>&nbsp;&nbsp;ตรวจอื่นๆ&nbsp;&nbsp;</td><td>&nbsp;&nbsp;***&nbsp;&nbsp;</td><td><center> <b>&nbsp;&nbsp;รวม&nbsp;&nbsp;</td></tr>";

$i='0';


		}


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
	$OTHER1 = $OTHER1+$list[$key]["OTHER2"];
	$sum = $sum+($list[$key]["PHAR"]+$list[$key]["PATHO"]+$list[$key]["XRAY"]+$list[$key]["DENTA"]+$list[$key]["PHYSI"]+$list[$key]["EMER"]+$list[$key]["SURG"]+$list[$key]["NID"]+$list[$key]["HEMO"]+$list[$key]["OTHER"]+$list[$key]["OTHER2"]);
}


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
$OTHER2=number_format($OTHER2,2);

$sum=number_format($sum,2);

echo "<tr><b><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td><b><font face='Angsana New' size ='2'><center>รวมทั้งหมด</td><td>&nbsp;</td><td>&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;".$PHAR."&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;".$PATHO."&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;".$XRAY."&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;".$DENTA."&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;".$PHYSI."&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;".$EMER."&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;".$SURG."&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;".$NID."&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;".$HEMO."&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;".$OTHER."&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;".$OTHER2."&nbsp;</td><td align='right'><font face='Angsana New' size ='3'><b>&nbsp;".$sum."&nbsp;</td></b></tr></FONT>";

echo "</table>";


?>
