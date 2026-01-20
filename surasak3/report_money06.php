<?
session_start();
include("connect.inc");

$showdate1=$_POST["date1"]."/".$_POST["month1"]."/".$_POST["year1"];
$showdate2=$_POST["date2"]."/".$_POST["month2"]."/".$_POST["year2"];
$credit=$_POST["credit"];
if($credit=="all"){
	$showcredit="ทั้งหมด";
}else{
	$showcredit=$credit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>รายงานรายรับสถานพยาบาลตามห้วงเวลา</title>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 24px;
}
-->
</style></head>

<body>
<div align="center" style="margin-top: 20px;"><strong>รายงานรายรับสถานพยาบาลตามห้วงเวลา</strong></div>
<div align="center">ลูกหนี้ : <?=$showcredit?>&nbsp;&nbsp;ระว่างวันที่ <?=$showdate1;?> ถึงวันที่ <?=$showdate2;?>
</div>
<?
$chkdate1=$_POST["year1"]."-".$_POST["month1"]."-".$_POST["date1"]." 00:00:00";
$chkdate2=$_POST["year2"]."-".$_POST["month2"]."-".$_POST["date2"]." 23:59:59";

if($credit=="all"){
/*$query = "SELECT * FROM opacc WHERE date >= '$chkdate1' and date <= '$chkdate2' AND (
credit != '' AND credit != 'ยกเลิก' AND credit != 'ยกเว้น' AND credit != 'ค้างจ่าย' AND credit != 'อื่นๆ' AND credit != 'นอนโรงพยาบาล' AND credit NOT
LIKE 'SSO%' AND credit NOT
LIKE 'PAY%' AND credit != 'โครงการนภา'
) and txdate!='' ";*/

$query = "SELECT * FROM opacc WHERE date BETWEEN '$chkdate1' AND '$chkdate2'
AND (credit != '' AND credit != 'ยกเลิก' AND credit != 'ยกเว้น' AND credit != 'ค้างจ่าย' AND credit != 'นอนโรงพยาบาล' AND credit != 'โครงการนภา' AND credit != 'เซ็นทรัล') 
and txdate!='' ";
}else{
$query = "SELECT * FROM opacc WHERE date >= '$chkdate1' and date <= '$chkdate2' and credit='$credit' and txdate!='' ";
}
//echo $query;
$result = mysql_query($query)or die("Query failed");
$i=0;
$total=0;
$sumphar=0;
$sumxray=0;
$sumpatho=0;
$sumother=0;
$sumhemo=0;
while($rows=mysql_fetch_array($result)){
$i++;
$depart=$rows["depart"];
if($rows["credit"]=="จ่ายตรง" || $rows["credit"]=="จ่ายตรง อปท." || $rows["credit"]=="จ่ายตรง อปท. (HD)" || $rows["credit"]=="กทม" || $rows["credit"]=="กสทช"
 || $rows["credit"]=="ททท" || $rows["credit"]=="กฟผ"){
	$paidcscd=$rows["paidcscd"];
}else if($rows["credit"]=="เงินสด" || $rows["credit"]=="เงินโอน" || $rows["credit"]=="เช็ค" || $rows["credit"]=="กรุงไทย"){
	$paidcscd=$rows["paid"];		
}else{
	if($depart=="PHAR"){  //ถ้าเป็นค่ายา
		$paidcscd=$rows["paid"];
	}else{
		$paidcscd=$rows["paidcscd"];
	}	
}		


if($depart=="PHAR"){  //ค่ายา
	$sumphar=$sumphar+$paidcscd;
}else if($depart=="XRAY"){  //ค่า xray
	$sumxray=$sumxray+$paidcscd;
}else if($depart=="PATHO"){  //ค่า LAB
	$sumpatho=$sumpatho+$paidcscd;
}else if($depart=="HEMO"){  //ค่า  HEMO
	$sumhemo=$sumhemo+$paidcscd;	
}else{  //ค่าอื่นๆ
	$sumother=$sumother+$paidcscd;
}
$total=$sumphar+$sumxray+$sumpatho+$sumother+$sumhemo;
}

?>	  
<table width="90%" border="0" align="center" cellpadding="3" cellspacing="0">
  <tr>
    <td><strong>ผู้ป่วยนอก</strong></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="63%">ค่ายา/เวชภัณฑ์ และอุปกรณ์</td>
    <td width="25%" align="right"><?=number_format($sumphar,2);?></td>
    <td width="2%">&nbsp;</td>
    <td width="10%">บาท</td>
  </tr>
  <tr>
    <td>ค่า XRAY</td>
    <td align="right"><?=number_format($sumxray,2);?></td>
    <td>&nbsp;</td>
    <td>บาท</td>
  </tr>
  <tr>
    <td>ค่า LAB</td>
    <td align="right"><?=number_format($sumpatho,2);?></td>
    <td>&nbsp;</td>
    <td>บาท</td>
  </tr>
  <tr>
    <td>ค่าฟอกไต</td>
    <td align="right"><?=number_format($sumhemo,2);?></td>
    <td>&nbsp;</td>
    <td>บาท</td>
  </tr>  
  <tr>
    <td>ค่าตรวจวิเคราะห์ ค่าบริการทางการแพทย์ และค่าบริการอื่นๆ</td>
    <td align="right"><?=number_format($sumother,2);?></td>
    <td>&nbsp;</td>
    <td>บาท</td>
  </tr>
  <tr>
    <td align="right"><strong>รวมทั้งสิ้น</strong></td>
    <td align="right"><strong>
      <?=number_format($total,2);?>
    </strong></td>
    <td>&nbsp;</td>
    <td><strong>บาท</strong></td>
  </tr>
</table>
<p><hr /></p>
<?
if($credit=="all"){
$query1 = "SELECT * FROM ipmonrep WHERE date >= '$chkdate1' and date <= '$chkdate2' and price > 0 and (credit !='' OR credit is null OR credit !='ยกเลิก' OR credit !='ยกเว้น' OR credit !='ค้างจ่าย') group by an,credit";
}else{
$query1 = "SELECT * FROM ipmonrep WHERE date >= '$chkdate1' and date <= '$chkdate2' and price > 0 and credit ='$credit' group by an,credit";
}
//echo $query1;
$result1 = mysql_query($query1)or die("Query failed");
$i=0;
$total_ipd=0;
$sumroom_ipd=0;
$sumphar_ipd=0;
$sumxray_ipd=0;
$sumpatho_ipd=0;
$sumother_ipd=0;
while($rows1=mysql_fetch_array($result1)){
$i++;

	if($rows1["credit"] !="" && $rows1["credit"] !="ยกเลิก" && $rows1["credit"] !="ยกเว้น" && $rows1["credit"] !="ค้างจ่าย" && $rows1["credit"] !="เงินสด" && $rows1["credit"] !="เงินโอน"){
	$sumroom_ipd=$sumroom_ipd+($rows1["bfy"]+$rows1["bfn"]);
	$sumphar_ipd=$sumphar_ipd+($rows1["ddl"]+$rows1["ddy"]+$rows1["dpy"]+$rows1["dsy"]+$rows1["ddn"]+$rows1["dpn"]+$rows1["dsn"]);
	$sumxray_ipd=$sumxray_ipd+$rows1["xray"];
	$sumpatho_ipd=$sumpatho_ipd+($rows1["blood"]+$rows1["lab"]);
	$sumother_ipd=$sumother_ipd+($rows1["sinv"]+$rows1["surg"]+$rows1["ncare"]+$rows1["denta"]+$rows1["pt"]+$rows1["stx"]+$rows1["mc"]+$rows1["tool"]);
	
	$total_ipd=$sumphar_ipd+$sumxray_ipd+$sumpatho_ipd+$sumother_ipd+$sumroom_ipd;
	}else if($rows1["credit"]=="เงินสด" || $rows1["credit"]=="เงินโอน"){
		
	$sumroom_ipd=$sumroom_ipd+0;
	$sumphar_ipd=$sumphar_ipd+0;
	$sumxray_ipd=$sumxray_ipd+0;
	$sumpatho_ipd=$sumpatho_ipd+0;
	$sumother_ipd=$sumother_ipd+($rows1["cash"]);	
	$total_ipd=$sumphar_ipd+$sumxray_ipd+$sumpatho_ipd+$sumother_ipd+$sumroom_ipd;		
	}	
}
?>	  
<table width="90%" border="0" align="center" cellpadding="3" cellspacing="0">
  <tr>
    <td><strong>ผู้ป่วยใน</strong></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>ค่าห้องและค่าอาหาร</td>
    <td align="right"><?=number_format($sumroom_ipd,2);?></td>
    <td>&nbsp;</td>
    <td>บาท</td>
  </tr>
  <tr>
    <td width="63%">ค่ายา/เวชภัณฑ์ และอุปกรณ์</td>
    <td width="25%" align="right"><?=number_format($sumphar_ipd,2);?></td>
    <td width="2%">&nbsp;</td>
    <td width="10%">บาท</td>
  </tr>
  <tr>
    <td>ค่า XRAY</td>
    <td align="right"><?=number_format($sumxray_ipd,2);?></td>
    <td>&nbsp;</td>
    <td>บาท</td>
  </tr>
  <tr>
    <td>ค่า LAB</td>
    <td align="right"><?=number_format($sumpatho_ipd,2);?></td>
    <td>&nbsp;</td>
    <td>บาท</td>
  </tr>
  <tr>
    <td>ค่าตรวจวิเคราะห์ ค่าบริการทางการแพทย์ และค่าบริการอื่นๆ</td>
    <td align="right"><?=number_format($sumother_ipd,2);?></td>
    <td>&nbsp;</td>
    <td>บาท</td>
  </tr>
  <tr>
    <td align="right"><strong>รวมทั้งสิ้น</strong></td>
    <td align="right"><strong>
      <?=number_format($total_ipd,2);?>
    </strong></td>
    <td>&nbsp;</td>
    <td><strong>บาท</strong></td>
  </tr>
</table>
</body>
</html>
