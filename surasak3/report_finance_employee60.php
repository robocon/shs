<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
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
<div><strong>สิทธิ : ประกันสังคม</strong></div>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="2%" rowspan="2" align="center"><strong>ลำดับ</strong></td>
    <td width="11%" rowspan="2" align="center"><strong>HN</strong></td>
    <td width="11%" rowspan="2" align="center"><strong>ชื่อ - สกุล</strong></td>
    <td width="4%" rowspan="2" align="center"><strong>อายุ</strong></td>
    <td width="6%" rowspan="2" align="center"><strong>สังกัด</strong></td>
    <td width="4%" rowspan="2" align="center"><strong>สิทธิ</strong></td>
    <td colspan="8" align="center"><strong>เบิกได้</strong></td>
    <td colspan="9" align="center"><strong>เบิกไม่ได</strong>้</td>
    <td width="4%" rowspan="2" align="center"><strong>รวมสุทธิ</strong></td>
  </tr>
  <tr>
    <td width="5%" align="center"><strong>CBC</strong></td>
    <td width="4%" align="center"><strong>UA</strong></td>
    <td width="5%" align="center"><strong>FBS</strong></td>
    <td align="center"><strong>Lipid profile</strong></td>
    <td width="3%" align="center"><strong>CR</strong></td>
    <td width="4%" align="center"><strong>HBSAG</strong></td>
    <td width="8%" align="center"><strong>X-RAY</strong></td>
    <td width="8%" align="center"><strong>รวมทั้งสิ้น</strong></td>
    <td width="5%" align="center"><strong>BUN</strong></td>
    <td width="3%" align="center"><strong>CR</strong></td>
    <td width="6%" align="center"><strong>URIC</strong></td>
    <td width="7%" align="center"><strong>SGOT</strong></td>
    <td width="6%" align="center"><strong>SGPT</strong></td>
    <td width="4%" align="center"><strong>ALK</strong></td>
    <td width="4%" align="center"><strong>HBSAG</strong></td>
    <td width="4%" align="center"><strong>HBSAB</strong></td>
    <td width="4%" align="center"><strong>รวมทั้งสิ้น</strong></td>
  </tr>
<?
$sql="SELECT  * FROM opcardchk AS a INNER JOIN dxofyear_emp AS b on a.HN=b.hn WHERE a.part='ลูกจ้าง60' and a.active='y' and b.yearchk='60' and a.branch='ประกันสังคม' group by b.hn order by  a.agey desc, a.course desc";
//echo $sql."<br>";
$row = mysql_query($sql)or die ("Query Fail");
$i=0;
while($result = mysql_fetch_array($row)){
$i++;
$ptname=$result["name"]." ".$result["surname"];


?>  
  <tr>
    <td><?=$i;?></td>
    <td><?=$result["HN"];?></td>
    <td><?=$ptname;?></td>
    <td><?=$result["agey"];?></td>
    <td><?=$result["course"];?></td>
    <td><?=$result["branch"];?></td>
    <td><?
$sqlcbc="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'HCT' AND b.result !='DELETE' AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60'
)
GROUP BY a.`profilecode` ";
//echo $sqlcbc;
$querycbc=mysql_query($sqlcbc);
list($cbc,$flag)=mysql_fetch_array($querycbc);
if(!empty($cbc)){
	$cbcy="90";
	echo $cbcy;
}else{
	$cbcy="0";
	echo $cbcy;
}
?> </td>
    <td><?
$sqlua="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'BLOODU' AND b.result !='DELETE' AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60'
)
GROUP BY a.`profilecode` ";
//echo $sqlua;
$queryua=mysql_query($sqlua);
list($bloodu,$flag1)=mysql_fetch_array($queryua);

if(!empty($bloodu)){
	$uay="50";
	echo $uay;	
}else{
	$uay="0";
	echo $uay;	
}
?></td>
    <td align="center">
<?
$sql1="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'GLU' AND b.result !='DELETE' AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60'
)
GROUP BY a.`profilecode` ";
//echo $sql1;
$query1=mysql_query($sql1);
list($glu,$flag)=mysql_fetch_array($query1);
if($result["agey"] >=35){
	if($flag=="L" || $flag=="N" || $flag=="H"){
		$fbsy="40";
		echo $fbsy;		
	}
}else{
		$fbsy="0";
		echo $fbsy;	
}
?>    </td>
    <td align="center"><? if($result["agey"] >= 35){ $lipidy="200"; echo $lipidy;}else{ $lipidy="0"; echo $lipidy;}?></td>
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
if($result["agey"] >=55){
	if($flag=="L" || $flag=="N" || $flag=="H"){
		$cry="50";
		echo $cry;	
	}
}else{
		$cry="0";
		echo $cry;	
}
?></td>
    <td align="center"><?
$sql12="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'HBSAG' AND b.result !='DELETE' AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60'
)
GROUP BY a.`profilecode` ";
//echo $sql12;
$query12=mysql_query($sql12);
list($hbsag,$flag)=mysql_fetch_array($query12);
if($result["agey"] > 25){
	if($flag=="L" || $flag=="N" || $flag=="H"){
		$hbgy="130";
		echo $hbgy;			
	}else{
		$hbgy="0";
		echo $hbgy;	
	}
}else{
		$hbgy="0";
		echo $hbgy;	
}
?></td>
    <td align="center"><?
		$xry="200";
		echo $xry;	
?></td>
    <td align="right">
    <?
    $totaly=$cbcy+$uay+$fbsy+$lipidy+$cry+$hbg+$xry;
	echo "<strong>$totaly</strong>";
	?>    </td>
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
if($result["agey"] >=35){
	if($flag=="L" || $flag=="N" || $flag=="H"){
		$bunn="50";
		echo $bunn;			
	}
}else{
		$bunn="0";
		echo $bunn;		
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
if($result["agey"] >=35 && $result["agey"] < 55){
	if($flag=="L" || $flag=="N" || $flag=="H"){
		$crn="50";
		echo $crn;			
	}
}else{
		$crn="0";
		echo $crn;		
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
if($result["agey"] >=35){
	if($flag=="L" || $flag=="N" || $flag=="H"){
		$uricn="60";
		echo $uricn;				
	}
}else{
		$uricn="0";
		echo $uricn;	
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
if($result["agey"] >=35){
	if($flag=="L" || $flag=="N" || $flag=="H"){
		$astn="50";
		echo $astn;	
	}
}else{
		$astn="0";
		echo $astn;
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
if($result["agey"] >=35){
	if($flag=="L" || $flag=="N" || $flag=="H"){
		$altn="50";
		echo $altn;	
	}
}else{
		$altn="0";
		echo $altn;
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
if($result["agey"] >=35){
	if($flag=="L" || $flag=="N" || $flag=="H"){
		$alpn="50";
		echo $alpn;
	}
}else{
		$alpn="0";
		echo $alpn;
}	
?></td>
    <td align="center"><?
$sql12="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'HBSAG' AND b.result !='DELETE' AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60'
)
GROUP BY a.`profilecode` ";
//echo $sql12;
$query12=mysql_query($sql12);
list($hbsag,$flag)=mysql_fetch_array($query12);
if($result["agey"] < 25){
	if($flag=="L" || $flag=="N" || $flag=="H"){
		$hbgn="130";
		echo $hbgn;
	}else{
		$hbgn="0";
		echo $hbgn;
	}
}else{
		$hbgn="0";
		echo $hbgn;
}
?></td>
    <td align="center"><?
$sql13="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'ANTIHB' AND b.result !='DELETE' AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60'
)
GROUP BY a.`profilecode` ";
//echo $sql13;
$query13=mysql_query($sql13);
list($hbsab,$flag)=mysql_fetch_array($query13);
if($flag=="L" || $flag=="N" || $flag=="H"){
		$hbbn="180";
		echo $hbbn;
}else{
		$hbbn="0";
		echo $hbbn;
}
?></td>
    <td align="right"><?
    $totaln=$bunn+$crn+$uricn+$astn+$altn+$alpn+$hbgn+$hbbn;
	echo "<strong>$totaln</strong>";
	?></td>
    <td align="right"><strong><? $sum=$totaly+$totaln; echo $sum;?></strong></td>
  </tr>
<? } ?>  
</table>
<br />
<div><strong>สิทธิ : เงินสด</strong></div>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="2%" align="center"><strong>ลำดับ</strong></td>
    <td width="11%" align="center"><strong>HN</strong></td>
    <td width="11%" align="center"><strong>ชื่อ - สกุล</strong></td>
    <td width="4%" align="center"><strong>อายุ</strong></td>
    <td width="6%" align="center"><strong>สังกัด</strong></td>
    <td width="4%" align="center"><strong>สิทธิ</strong></td>
    <td width="5%" align="center"><strong>CBC</strong></td>
    <td width="4%" align="center"><strong>UA</strong></td>
    <td width="5%" align="center"><strong>FBS</strong></td>
    <td align="center"><strong>Lipid profile</strong></td>
    <td width="5%" align="center"><strong>BUN</strong></td>
    <td width="3%" align="center"><strong>CR</strong></td>
    <td width="6%" align="center"><strong>URIC</strong></td>
    <td width="7%" align="center"><strong>SGOT</strong></td>
    <td width="6%" align="center"><strong>SGPT</strong></td>
    <td width="4%" align="center"><strong>ALK</strong></td>
    <td width="4%" align="center"><strong>HBSAG</strong></td>
    <td width="4%" align="center"><strong>HBSAB</strong></td>
    <td width="8%" align="center"><strong>X-RAY</strong></td>
  </tr>
<?
$sql="SELECT  * FROM opcardchk AS a INNER JOIN dxofyear_emp AS b on a.HN=b.hn WHERE a.part='ลูกจ้าง60' and a.active='y' and b.yearchk='60' and a.branch='เงินสด' group by b.hn order by  a.agey desc, a.course desc";
//echo $sql."<br>";
$row = mysql_query($sql)or die ("Query Fail");
$i=0;
while($result = mysql_fetch_array($row)){
$i++;
$ptname=$result["name"]." ".$result["surname"];


?>  
  <tr>
    <td><?=$i;?></td>
    <td><?=$result["HN"];?></td>
    <td><?=$ptname;?></td>
    <td><?=$result["agey"];?></td>
    <td><?=$result["course"];?></td>
    <td><?=$result["branch"];?></td>
    <td><?
$sqlcbc="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'HCT' AND b.result !='DELETE' AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60'
)
GROUP BY a.`profilecode` ";
//echo $sqlcbc;
$querycbc=mysql_query($sqlcbc);
list($cbc,$flag)=mysql_fetch_array($querycbc);
if(!empty($cbc)){
	echo "90";
}
?> </td>
    <td><?
$sqlua="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'BLOODU' AND b.result !='DELETE' AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60'
)
GROUP BY a.`profilecode` ";
//echo $sqlua;
$queryua=mysql_query($sqlua);
list($bloodu,$flag1)=mysql_fetch_array($queryua);

if(!empty($bloodu)){
	echo "50";
}
?></td>
    <td align="center">
<?
$sql1="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'GLU' AND b.result !='DELETE' AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60'
)
GROUP BY a.`profilecode` ";
//echo $sql1;
$query1=mysql_query($sql1);
list($glu,$flag)=mysql_fetch_array($query1);
if($result["agey"] >=35){
	if($flag=="L" || $flag=="N" || $flag=="H"){
		echo "40";
	}
}else{
	echo "&nbsp;";
}
?>    </td>
    <td align="center"><? if($result["agey"] >= 35){ echo "200";}else{ echo "&nbsp;";}?></td>
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
if($result["agey"] >=35){
	if($flag=="L" || $flag=="N" || $flag=="H"){
		echo "50";
	}
}else{
	echo "&nbsp;";
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
if($result["agey"] >=35){
	if($flag=="L" || $flag=="N" || $flag=="H"){
		echo "50";
	}
}else{
	echo "&nbsp;";
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
if($result["agey"] >=35){
	if($flag=="L" || $flag=="N" || $flag=="H"){
		echo "60";
	}
}else{
	echo "&nbsp;";
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
if($result["agey"] >=35){
	if($flag=="L" || $flag=="N" || $flag=="H"){
		echo "50";
	}
}else{
	echo "&nbsp;";
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
if($result["agey"] >=35){
	if($flag=="L" || $flag=="N" || $flag=="H"){
		echo "50";
	}
}else{
	echo "&nbsp;";
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
if($result["agey"] >=35){
	if($flag=="L" || $flag=="N" || $flag=="H"){
		echo "50";
	}
}else{
	echo "&nbsp;";
}	
?></td>
    <td align="center"><?
$sql12="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'HBSAG' AND b.result !='DELETE' AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60'
)
GROUP BY a.`profilecode` ";
//echo $sql12;
$query12=mysql_query($sql12);
list($hbsag,$flag)=mysql_fetch_array($query12);

if($flag=="L" || $flag=="N" || $flag=="H"){
	echo "130";
}
?></td>
    <td align="center"><?
$sql13="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'ANTIHB' AND b.result !='DELETE' AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60'
)
GROUP BY a.`profilecode` ";
//echo $sql13;
$query13=mysql_query($sql13);
list($hbsab,$flag)=mysql_fetch_array($query13);
if($flag=="L" || $flag=="N" || $flag=="H"){
	echo "180";
}
?></td>
    <td align="center"><?
/*$sql1="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE a.profilecode = 'GLU' AND b.result !='DELETE' AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60'
)
GROUP BY a.`profilecode` ";
//echo $sql1;
$query1=mysql_query($sql1);
list($glu,$flag)=mysql_fetch_array($query1);*/
echo "200";
?></td>
  </tr>
<? } ?>  
</table>
<br />
<div><strong>สิทธิ : อื่นๆ</strong></div>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="2%" align="center"><strong>ลำดับ</strong></td>
    <td width="11%" align="center"><strong>HN</strong></td>
    <td width="11%" align="center"><strong>ชื่อ - สกุล</strong></td>
    <td width="4%" align="center"><strong>อายุ</strong></td>
    <td width="6%" align="center"><strong>สังกัด</strong></td>
    <td width="4%" align="center"><strong>สิทธิ</strong></td>
    <td width="5%" align="center"><strong>CBC</strong></td>
    <td width="4%" align="center"><strong>UA</strong></td>
    <td width="5%" align="center"><strong>FBS</strong></td>
    <td align="center"><strong>Lipid profile</strong></td>
    <td width="5%" align="center"><strong>BUN</strong></td>
    <td width="3%" align="center"><strong>CR</strong></td>
    <td width="6%" align="center"><strong>URIC</strong></td>
    <td width="7%" align="center"><strong>SGOT</strong></td>
    <td width="6%" align="center"><strong>SGPT</strong></td>
    <td width="4%" align="center"><strong>ALK</strong></td>
    <td width="4%" align="center"><strong>HBSAG</strong></td>
    <td width="4%" align="center"><strong>HBSAB</strong></td>
    <td width="8%" align="center"><strong>X-RAY</strong></td>
  </tr>
<?
$sql="SELECT  * FROM opcardchk AS a INNER JOIN dxofyear_emp AS b on a.HN=b.hn WHERE a.part='ลูกจ้าง60' and a.active='y' and b.yearchk='60' and (a.branch!='ประกันสังคม' && a.branch!='เงินสด') group by b.hn order by  a.agey desc, a.course desc";
//echo $sql."<br>";
$row = mysql_query($sql)or die ("Query Fail");
$i=0;
while($result = mysql_fetch_array($row)){
$i++;
$ptname=$result["name"]." ".$result["surname"];


?>  
  <tr>
    <td><?=$i;?></td>
    <td><?=$result["HN"];?></td>
    <td><?=$ptname;?></td>
    <td><?=$result["agey"];?></td>
    <td><?=$result["course"];?></td>
    <td><?=$result["branch"];?></td>
    <td><?
$sqlcbc="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'HCT' AND b.result !='DELETE' AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60'
)
GROUP BY a.`profilecode` ";
//echo $sqlcbc;
$querycbc=mysql_query($sqlcbc);
list($cbc,$flag)=mysql_fetch_array($querycbc);
if(!empty($cbc)){
	echo "90";
}
?> </td>
    <td><?
$sqlua="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'BLOODU' AND b.result !='DELETE' AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60'
)
GROUP BY a.`profilecode` ";
//echo $sqlua;
$queryua=mysql_query($sqlua);
list($bloodu,$flag1)=mysql_fetch_array($queryua);

if(!empty($bloodu)){
	echo "50";
}
?></td>
    <td align="center">
<?
$sql1="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'GLU' AND b.result !='DELETE' AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60'
)
GROUP BY a.`profilecode` ";
//echo $sql1;
$query1=mysql_query($sql1);
list($glu,$flag)=mysql_fetch_array($query1);
if($result["agey"] >=35){
	if($flag=="L" || $flag=="N" || $flag=="H"){
		echo "40";
	}
}else{
	echo "&nbsp;";
}
?>    </td>
    <td align="center"><? if($result["agey"] >= 35){ echo "200";}else{ echo "&nbsp;";}?></td>
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
if($result["agey"] >=35){
	if($flag=="L" || $flag=="N" || $flag=="H"){
		echo "50";
	}
}else{
	echo "&nbsp;";
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
if($result["agey"] >=35){
	if($flag=="L" || $flag=="N" || $flag=="H"){
		echo "50";
	}
}else{
	echo "&nbsp;";
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
if($result["agey"] >=35){
	if($flag=="L" || $flag=="N" || $flag=="H"){
		echo "60";
	}
}else{
	echo "&nbsp;";
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
if($result["agey"] >=35){
	if($flag=="L" || $flag=="N" || $flag=="H"){
		echo "50";
	}
}else{
	echo "&nbsp;";
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
if($result["agey"] >=35){
	if($flag=="L" || $flag=="N" || $flag=="H"){
		echo "50";
	}
}else{
	echo "&nbsp;";
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
if($result["agey"] >=35){
	if($flag=="L" || $flag=="N" || $flag=="H"){
		echo "50";
	}
}else{
	echo "&nbsp;";
}	
?></td>
    <td align="center"><?
$sql12="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'HBSAG' AND b.result !='DELETE' AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60'
)
GROUP BY a.`profilecode` ";
//echo $sql12;
$query12=mysql_query($sql12);
list($hbsag,$flag)=mysql_fetch_array($query12);

if($flag=="L" || $flag=="N" || $flag=="H"){
	echo "130";
}
?></td>
    <td align="center"><?
$sql13="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'ANTIHB' AND b.result !='DELETE' AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60'
)
GROUP BY a.`profilecode` ";
//echo $sql13;
$query13=mysql_query($sql13);
list($hbsab,$flag)=mysql_fetch_array($query13);
if($flag=="L" || $flag=="N" || $flag=="H"){
	echo "180";
}
?></td>
    <td align="center"><?
/*$sql1="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE a.profilecode = 'GLU' AND b.result !='DELETE' AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60'
)
GROUP BY a.`profilecode` ";
//echo $sql1;
$query1=mysql_query($sql1);
list($glu,$flag)=mysql_fetch_array($query1);*/
echo "200";
?></td>
  </tr>
<? } ?>  
</table>
</body>
</html>
