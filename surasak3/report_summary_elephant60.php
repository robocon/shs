<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>รายงานสรุปผลตรวจสุขภาพ</title>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
</head>
<?
include("connect.inc");

?>	
<body>
<div align="center"><strong>ผลการตรวจสุขภาพเจ้าหน้าที่ มูลนิธิคืนช้างสู่ธรรมชาติ  บริการตรวจสุขภาพ ณ โรงพยาบาลค่ายสุรศักดิ์มนตรี</strong></div>
<div align="center"><strong>ระหว่างวันที่ 21-23 กรกฎาคม 2560 จำนวน 16 ราย</strong></div>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="3%" rowspan="2" align="center"><strong>ลำดับ</strong></td>
    <td width="5%" rowspan="2" align="center"><strong>HN</strong></td>
    <td width="15%" rowspan="2" align="center"><strong>ชื่อ - สกุล</strong></td>
    <td width="4%" rowspan="2" align="center"><strong>อายุ</strong></td>
    <td width="5%" rowspan="2" align="center"><strong>น้ำหนัก</strong></td>
    <td width="5%" rowspan="2" align="center"><strong>ส่วนสูง</strong></td>
    <td width="5%" rowspan="2" align="center"><strong>BP</strong></td>
    <td colspan="17" align="center"><strong>รายการตรวจ</strong></td>
    <td width="8%" rowspan="2" align="center"><strong>ภาวะสุขภาพโดยรวม</strong></td>
    <td colspan="2" align="center"><strong>สรุปผลการตรวจ</strong></td>
  </tr>
  <tr>
    <td width="3%" align="center"><strong>PE</strong></td>
    <td width="7%" align="center"><strong>X-RAY</strong></td>
    <td width="5%" align="center"><strong>ABOC</strong></td>
    <td width="5%" align="center"><strong>BS</strong></td>
    <td width="6%" align="center"><strong>CHOL</strong></td>
    <td width="6%" align="center"><strong>TRIG</strong></td>
    <td width="5%" align="center"><strong>HDL</strong></td>
    <td width="5%" align="center"><strong>LDL</strong></td>
    <td width="5%" align="center"><strong>BUN</strong></td>
    <td width="3%" align="center"><strong>CR</strong></td>
    <td width="6%" align="center"><strong>URIC</strong></td>
    <td width="7%" align="center"><strong>SGOT</strong></td>
    <td width="6%" align="center"><strong>SGPT</strong></td>
    <td width="4%" align="center"><strong>ALK</strong></td>
    <td width="7%" align="center"><strong>HBSAG</strong></td>
    <td width="6%" align="center"><strong>FOBT</strong></td>
    <td width="6%" align="center"><strong>EKG</strong></td>
    <td width="5%" align="center"><strong>พบแพทย์</strong></td>
    <td width="6%" align="center"><strong>ไม่พบแพทย์</strong></td>
  </tr>
<?
$sql="SELECT  *  FROM opcardchk WHERE part='มูลนิธิคืนช้างสู่ธรรมชาติ60' and active='y' order by row";
//echo $sql."<br>";
$row = mysql_query($sql)or die ("Query Fail");
$i=0;
while($result = mysql_fetch_array($row)){

$sql2="select * from out_result_chkup where hn='".$result["HN"]."'";
//echo $sql2;
$query2=mysql_query($sql2);
$result2=mysql_fetch_array($query2);

$i++;
$ptname=$result["yot"].$result["name"]." ".$result["surname"];
if($result2["bp1"] && $result2["bp2"]){
	$bp=$result2["bp1"]."/".$result2["bp2"];
}else{
	$bp="&nbsp;";
}
if($result["congenital_disease"]=="ปฎิเสธ" || empty($result["congenital_disease"])){
	$disease="ไม่มี";
}else{
	$disease="มี";
}
?>  
  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$result["HN"];?></td>
    <td><?=$ptname;//."->".$result2["part"];?></td>
    <td align="center"><?=$result["agey"];?></td>
    <td align="center"><?=$result2["weight"];?></td>
    <td align="center"><?=$result2["height"];?></td>
    <td align="center"><?=$bp;?></td>
    <td>&nbsp;</td>
    <td align="left"><? 
			  if($result["HN"]=="60-3343" || $result["HN"]=="60-3385"){
			  	if($result2["cxr"]==""){ echo "ปกติ"; }else{ echo $result2["cxr"];}
			  }
			  
		   ?></td>
    <td align="center"><?
$sql17="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'ABOC' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60' OR a.clinicalinfo = 'ตรวจสุขภาพประกันสังคม60'
)
GROUP BY a.`profilecode` ";
//echo $sql1;
$query17=mysql_query($sql17);
list($aboc,$flag)=mysql_fetch_array($query17);
if($flag=="N"){
	echo $aboc;
}else if($flag=="H" || $flag=="L"){
	echo "<strong style='color:#FF0000'>$aboc</strong>";
}else{
	echo "&nbsp;";
}
?></td>
    <td align="center"><?
$sql1="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'BUN' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60' OR a.clinicalinfo = 'ตรวจสุขภาพประกันสังคม60'
)
GROUP BY a.`profilecode` ";
//echo $sql1;
$query1=mysql_query($sql1);
list($glu,$flag)=mysql_fetch_array($query1);
if($flag=="N"){
	echo $glu;
}else if($flag=="H" || $flag=="L"){
	echo "<strong style='color:#FF0000'>$glu</strong>";
}else{
	echo "&nbsp;";
}
?>    </td>
    <td align="center"><?
$sql2="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'CHOL' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60' OR a.clinicalinfo = 'ตรวจสุขภาพประกันสังคม60'
)
GROUP BY a.`profilecode` ";
//echo $sql2;
$query2=mysql_query($sql2);
list($chol,$flag)=mysql_fetch_array($query2);

if($flag=="N"){
	echo $chol;
}else if($flag=="H" || $flag=="L"){
	echo "<strong style='color:#FF0000'>$chol</strong>";
}else{
	echo "&nbsp;";
}
?></td>
    <td align="center"><?
$sql3="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'TRIG' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60' OR a.clinicalinfo = 'ตรวจสุขภาพประกันสังคม60'
)
GROUP BY a.`profilecode` ";
//echo $sql3;
$query3=mysql_query($sql3);
list($trig,$flag)=mysql_fetch_array($query3);

if($flag=="N"){
	echo $trig;
}else if($flag=="H" || $flag=="L"){
	echo "<strong style='color:#FF0000'>$trig</strong>";
}else{
	echo "&nbsp;";
}
?></td>
    <td align="center"><?
$sql4="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'HDL' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60' OR a.clinicalinfo = 'ตรวจสุขภาพประกันสังคม60'
)
GROUP BY a.`profilecode` ";
//echo $sql4;
$query4=mysql_query($sql4);
list($hdl,$flag)=mysql_fetch_array($query4);

if($flag=="N"){
	echo $hdl;
}else if($flag=="H" || $flag=="L"){
	echo "<strong style='color:#FF0000'>$hdl</strong>";
}else{
	echo "&nbsp;";
}
?></td>
    <td align="center"><?
$sql5="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'LDL' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60' OR a.clinicalinfo = 'ตรวจสุขภาพประกันสังคม60'
)
GROUP BY a.`profilecode` ";
//echo $sql5;
$query5=mysql_query($sql5);
list($ldl,$flag)=mysql_fetch_array($query5);

if($flag=="N"){
	echo $ldl;
}else if($flag=="H" || $flag=="L"){
	echo "<strong style='color:#FF0000'>$ldl</strong>";
}else{
	echo "&nbsp;";
}
?></td>
    <td align="center"><?
$sql6="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'BUN' AND b.result !='DELETE' AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60'
)
GROUP BY a.`profilecode` ";
//echo $sql6;
$query6=mysql_query($sql6);
list($bun,$flag)=mysql_fetch_array($query6);

if($flag=="N"){
	echo $bun;
}else{
	echo "<strong style='color:#FF0000'>$bun</strong>";
}
?></td>
    <td align="center"><?
$sql7="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'CREA' AND b.result !='DELETE' AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60'
)
GROUP BY a.`profilecode` ";
//echo $sql7;
$query7=mysql_query($sql7);
list($crea,$flag)=mysql_fetch_array($query7);

if($flag=="N"){
	echo $crea;
}else{
	echo "<strong style='color:#FF0000'>$crea</strong>";
}
?></td>
    <td align="center"><?
$sql8="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'URIC' AND b.result !='DELETE' AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60'
)
GROUP BY a.`profilecode` ";
//echo $sql8;
$query8=mysql_query($sql8);
list($uric,$flag)=mysql_fetch_array($query8);

if($flag=="N"){
	echo $uric;
}else{
	echo "<strong style='color:#FF0000'>$uric</strong>";
}
?></td>
    <td align="center"><?
$sql9="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'AST' AND b.result !='DELETE' AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60'
)
GROUP BY a.`profilecode` ";
//echo $sql9;
$query9=mysql_query($sql9);
list($ast,$flag)=mysql_fetch_array($query9);

if($flag=="N"){
	echo $ast;
}else{
	echo "<strong style='color:#FF0000'>$ast</strong>";
}
?></td>
    <td align="center"><?
$sql10="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'ALT' AND b.result !='DELETE' AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60'
)
GROUP BY a.`profilecode` ";
//echo $sql10;
$query10=mysql_query($sql10);
list($alt,$flag)=mysql_fetch_array($query10);

if($flag=="N"){
	echo $alt;
}else{
	echo "<strong style='color:#FF0000'>$alt</strong>";
}
?></td>
    <td align="center"><?
$sql11="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'ALP' AND b.result !='DELETE' AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60'
)
GROUP BY a.`profilecode` ";
//echo $sql11;
$query11=mysql_query($sql11);
list($alp,$flag)=mysql_fetch_array($query11);

if($flag=="N"){
	echo $alp;
}else{
	echo "<strong style='color:#FF0000'>$alp</strong>";
}
?></td>
    <td align="center"><?
$sql12="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'HBSAG' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60' OR a.clinicalinfo = 'ตรวจสุขภาพประกันสังคม60'
)
GROUP BY a.`profilecode` ";
//echo $sql12;
$query12=mysql_query($sql12);
list($hbsag,$flag)=mysql_fetch_array($query12);

if($hbsag=="Negative"){
	echo "ไม่พบเชื้อ";
}else if($hbsag=="Positive"){
	echo "<strong style='color:#FF0000'>พบเชื้อ</strong>";
}else{
	echo "&nbsp;";
}
?></td>
    <td align="center"><?
$sql13="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'OCCULT' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60' OR a.clinicalinfo = 'ตรวจสุขภาพประกันสังคม60'
)
GROUP BY a.`profilecode` ";
//echo $sql13;
$query13=mysql_query($sql13);
list($hbsag,$flag)=mysql_fetch_array($query13);

if($hbsag=="Negative"){
	echo "ไม่พบเลือด";
}else if($hbsag=="Positive"){
	echo "<strong style='color:#FF0000'>พบเลือด</strong>";
}else{
	echo "&nbsp;";
}
?></td>
    <td><? 
	$sql3="select * from patdata where hn='".$result["HN"]."' and code='51410' order by row_id desc";
	//echo $sql3;
	$query3=mysql_query($sql3);
	$num3=mysql_num_rows($query3);
	if(!empty($num3)){
		if($result["HN"]=="56-9685"){ echo $result2["ekg"]; }else{ echo "ปกติ"; }
	} ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
<? } ?>  
</table>
<p align="center">PE = การตรวจร่างกายทั่วไป  BS = น้ำตาลในเลือด  CHOL,TRI = ไขมันในเลือด  HBsAg = เชื้อไวรัสตับอักเสบ  FOBT = เลือดในอุจจาระ</p>
</body>
</html>
