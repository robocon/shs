<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">

body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}

</style>
</head>
<?
include("connect.inc");

?>	
<body>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="2%" align="center"><strong>ลำดับ</strong></td>
    <td width="11%" align="center"><strong>HN</strong></td>
    <td width="11%" align="center"><strong>ชื่อ - สกุล</strong></td>
    <td width="4%" align="center"><strong>สิทธิ</strong></td>
    <td width="4%" align="center"><strong>อายุ</strong></td>
    <td width="6%" align="center"><strong>สังกัด</strong></td>
    <td width="5%" align="center"><strong>น้ำหนัก</strong></td>
    <td width="5%" align="center"><strong>ส่วนสูง</strong></td>
    <td width="5%" align="center"><strong>BMI</strong></td>
    <td width="5%" align="center"><strong>เส้นรอบเอว</strong></td>
    <td width="5%" align="center"><strong>BP</strong></td>
    <td width="5%" align="center"><strong>CBC</strong></td>
    <td width="4%" align="center"><strong>UA</strong></td>
    <td width="5%" align="center"><strong>GLU</strong></td>
    <td width="7%" align="center"><strong>CHOL</strong></td>
    <td width="3%" align="center"><strong>TG</strong></td>
    <td width="7%" align="center"><strong>HDL-C</strong></td>
    <td width="7%" align="center"><strong>LDL-C</strong></td>
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
// $sql="SELECT  * FROM opcardchk AS a INNER JOIN dxofyear_emp AS b on a.HN=b.hn WHERE a.part='ลูกจ้าง60' and a.active='y' group by b.hn order by a.course desc, a.agey desc";
//echo $sql."<br>";
$sql="SELECT  * ,c.`idcard`,c.`address`,c.`tambol`,c.`ampur`,c.`changwat`,c.`phone`
FROM opcardchk AS a 
INNER JOIN dxofyear_emp AS b on a.HN=b.hn 
LEFT JOIN opcard AS c ON c.hn = a.HN 
WHERE a.part='ลูกจ้าง60' 
and a.active='y' 
and a.branch='ประกันสังคม' 
group by b.hn 
order by a.course desc, a.agey desc";
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
    <td><?=$result["branch"];?></td>
    <td><?=$result["agey"];?></td>
    <td><?=$result["course"];?></td>
    <td><?=$result["weight"];?></td>
    <td><?=$result["height"];?></td>
    <td><?=$result["bmi"];?></td>
    <td><?=$result["round_"];?></td>
    <td><?=$result["bp1"]."/".$result["bp2"];?></td>
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
if($flag=="N"){
	echo "$cbc";
}else{
	echo "<strong style='color:#FF0000'>$cbc</strong>";
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

$sqlua1="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'PROU' AND b.result !='DELETE' AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60'
)
GROUP BY a.`profilecode` ";
//echo $sqlua1;
$queryua1=mysql_query($sqlua1);
list($prou,$flag2)=mysql_fetch_array($queryua1);

if($flag1=="N" && $flag2=="N"){
	echo "Negative";
}else if($flag1!="N"){
	echo "<strong style='color:#FF0000'>$bloodu</strong>";
}else if($flag2!="N"){
	echo "<strong style='color:#FF0000'>$prou</strong>";
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
if($flag=="N"){
	echo $glu;
}else{
	echo "<strong style='color:#FF0000'>$glu</strong>";
}
?>    </td>
    <td align="center"><?
$sql2="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'CHOL' AND b.result !='DELETE' AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60'
)
GROUP BY a.`profilecode` ";
//echo $sql2;
$query2=mysql_query($sql2);
list($chol,$flag)=mysql_fetch_array($query2);

if($flag=="N"){
	echo $chol;
}else{
	echo "<strong style='color:#FF0000'>$chol</strong>";
}
?></td>
    <td align="center"><?
$sql3="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'TRIG' AND b.result !='DELETE' AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60'
)
GROUP BY a.`profilecode` ";
//echo $sql3;
$query3=mysql_query($sql3);
list($tg,$flag)=mysql_fetch_array($query3);

if($flag=="N"){
	echo $tg;
}else{
	echo "<strong style='color:#FF0000'>$tg</strong>";
}
?></td>
    <td align="center"><?
$sql4="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'HDL' AND b.result !='DELETE' AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60'
)
GROUP BY a.`profilecode` ";
//echo $sql4;
$query4=mysql_query($sql4);
list($hdl,$flag)=mysql_fetch_array($query4);

if($flag=="N"){
	echo $hdl;
}else{
	echo "<strong style='color:#FF0000'>$hdl</strong>";
}
?></td>
    <td align="center"><?
$sql5="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE (b.labcode = 'LDL' || b.labcode = 'LDL-C' || b.labcode = '10001')  AND b.result !='DELETE' AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60'
)
GROUP BY a.`profilecode` ";
//echo $sql5;
$query5=mysql_query($sql5);
list($ldl,$flag)=mysql_fetch_array($query5);

if($flag=="N"){
	echo $ldl;
}else{
	echo "<strong style='color:#FF0000'>$ldl</strong>";
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
WHERE b.labcode = 'HBSAG' AND b.result !='DELETE' AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60'
)
GROUP BY a.`profilecode` ";
//echo $sql12;
$query12=mysql_query($sql12);
list($hbsag,$flag)=mysql_fetch_array($query12);

if($flag=="N"){
	echo $hbsag;
}else{
	echo "<strong style='color:#FF0000'>$hbsag</strong>";
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
if($flag=="N"){
	echo $hbsab;
}else{
	echo "<strong style='color:#FF0000'>$hbsab</strong>";
}
?></td>
    <td align="center"><? 
		  if($result["hn"]=="47-6628"){
		  	  echo "ผิดปกติควรพบแพทย์...สงสัยน้ำในเยื่อหุ้มปอดซ้าย และ มีกระดูกซี่โครงด้านซ้ายหลายซี่หักเก่า";
		  }else{
			  if($result["cxr"]==""){ echo "ปกติ"; }else{ echo $result["cxr"]."...".$result["reason_cxr"]; }
		  }
		   ?></td>
  </tr>
<? } ?>  
</table>

</body>
</html>
