<?php
session_start();
include("connect.inc");
?>
<style>
.fonthead{
	font-family:"TH SarabunPSK";
	font-size:16PX;
	font-weight:bold;
}
.fontlist{
	font-family:"TH SarabunPSK";
	font-size:16PX;
}
</style>
<?php

function displaydate($x) {
	$date_m=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฏาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");

	$date_array=explode("-",$x);
	$y=$date_array[0];
	$m=$date_array[1]-1;
	$d=$date_array[2];

	$m=$date_m[$m];

	$displaydate="$d $m $y";
	return $displaydate;
} 

//  $yrmonth="$thiyr-$rptmo-$date";
$date1 ="$thiyr-$rptmo-$date";
$date2 ="$date-$rptmo-$thiyr";

$dateshow ="$thiyr-$rptmo-$date";

$sql = "Select a.admit,a.dcdate,a.days ,a.an,a.hn,a.ptname,a.bfy,a.bfn,a.dpy,a.dpn,a.ddl,a.ddy,a.ddn,a.dsy,a.dsn,a.blood,a.lab,a.xray,a.sinv,a.surg,a.ncare,a.denta,a.pt,a.stx,a.mc,
b.icd10,b.comorbid,b.icd9cm, 
c.`idcard` 
From ipmonrep as a, 
ipcard as b, 
opcard AS c 
where a.hn=b.hn AND b.`hn` = c.`hn` 
AND a.dcdate  like '".$date1."%'  
AND a.credit ='30บาท' 
group by a.hn  ORDER by a.dcdate";
$result = mysql_query($sql) or die(mysql_error());

//echo $sql;



echo "<br><br>";
echo "<font face='TH SarabunPSK' size ='4'><center> <b>ลูกหนี้หลักประกันสุขภาพประจำวันที่ ".displaydate($dateshow)."</b> <br>";
echo "<font face='TH SarabunPSK' size ='4'> <b>โรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง</b> </center>";
echo "<table  border ='1' bordercolor='#000000' cellspacing='0' cellpadding='2' style='BORDER-COLLAPSE: collapse'>";
echo "<tr>
<td align=\"center\" class=\"fonthead\">#</td>
<td align=\"center\" class=\"fonthead\">วันรักษา</td>
<td align=\"center\" class=\"fonthead\">วันจำหน่าย</td>
<td align=\"center\" class=\"fonthead\">วันนอน</td>
<td align=\"center\" class=\"fonthead\">hn</td>
<td align=\"center\" class=\"fonthead\">AN</td>
<td align=\"center\" class=\"fonthead\">เลขบัตร ปชช.</td>
<td align=\"center\" class=\"fonthead\">ชื่อ - สกุล</td>
<td align=\"center\" class=\"fonthead\">ICD10</td>
<td align=\"center\" class=\"fonthead\">ICD10รอง</td>
<td align=\"center\" class=\"fonthead\">ICD9</td>
<td align=\"center\" class=\"fonthead\">ยา</td>
<td align=\"center\" class=\"fonthead\">ค่าห้อง</td>
<td align=\"center\" class=\"fonthead\">ค่าอาหาร</td>
<td align=\"center\" class=\"fonthead\">LAB</td>
<td align=\"center\" class=\"fonthead\">X-Ray</td>
<td align=\"center\" class=\"fonthead\">อื่นๆ</td>
<td align=\"center\" class=\"fonthead\">รวม</td>
</tr>";

$num=1;


while(list($admit,$dcdate,$days,$an,$hn,$ptname,$bfy,$bfn,$dpy,$dpn,$ddl,$ddy,$ddn,$dsy,$dsn,$blood,$lab,$xray,$sunv,$surg,$ncare,$denta,$pt,$stx,$mc,$icd10,$comorbid,$icd9cm,$idcard) = mysql_fetch_row($result)){

$date=substr($date,0,10);
$d=substr($date,8,2);
$m=substr($date,4,4);
$y=substr($date,0,4);

$drug=$dpy+$dpn+$ddl+$ddy+$ddn+$dsy+$dsn;

$room=$bfy+$bfn;
$other=$blood+$sunv+$surg+$ncare+$denta+$pt+$stx+$mc;

$total1=$drug+$lab+$xray+$room+$other;


$sql = "SELECT icd9cm FROM ipicd9cm WHERE an = '$an' GROUP BY icd9cm ";
$q = mysql_query($sql) or die( mysql_error() );
$icd9_lists = array();
while ( $item = mysql_fetch_assoc($q) ) {
	$icd9_lists[] = $item['icd9cm'];
}
$icd9cm = implode(',', $icd9_lists);

echo "<tr>
	<td class=\"fontlist\">".$num."</td>
	<td class=\"fontlist\">".$admit."</td>
	<td class=\"fontlist\">".$dcdate."</td>
	<td class=\"fontlist\" align=\"center\">".$days."</td>
	<td class=\"fontlist\">".$hn."</td>
	<td align='right' class=\"fontlist\">".$an."</td>
	<td>$idcard</td>
	<td class=\"fontlist\">".$ptname."</td>
	<td align='center' class=\"fontlist\">".$icd10."</td>
	<td align='center' class=\"fontlist\">".$comorbid."</td>
	<td align='right' class=\"fontlist\">".$icd9cm."</td>
	<td align='right' class=\"fontlist\">".number_format($drug,2)."</td>
	<td align='right' class=\"fontlist\">".number_format($room,2)."</td>
	<td align='right' class=\"fontlist\"></td>
	<td align='right' class=\"fontlist\">".number_format($lab,2)."</td>
	<td align='right' class=\"fontlist\">".number_format($xray,2)."</td>
	<td align='right' class=\"fontlist\">".number_format($other,2)."</td>
	<td align='right' class=\"fonthead\">".number_format($total1,2)."</b></td>
	</tr>";
$num++;

$sumdrug+=$drug;
$sumroom+=$room;
$sumlab+=$lab;
$sumxray+=$xray;
$sumother+=$other;

}



$sumtotal=$sumdrug+$sumroom+$sumlab+$sumxray+$sumother;
echo "<tr><b>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td class=\"fontlist\"><b><center>รวม</center></td>
<td class=\"fontlist\">&nbsp;</td>
<td class=\"fontlist\">&nbsp;</td>
<td align='right' class=\"fontlist\"></td>
<td align='right' class=\"fontlist\">".number_format($sumdrug,2)."</td>
<td align='right' class=\"fontlist\">".number_format($sumroom,2)."</td>
<td align='right' class=\"fontlist\"></td>
<td align='right' class=\"fontlist\">".number_format($sumlab,2)."</td>
<td align='right' class=\"fontlist\">".number_format($sumxray,2)."</td>
<td align='right' class=\"fontlist\">".number_format($sumother,2)."</td>
<td align='right' class=\"fontlist\"><b>".number_format($sumtotal,2)."</b></td>
</tr></FONT>";

echo "</table>";
?>