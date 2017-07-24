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
<div align="center"><strong>ผลการตรวจสุขภาพนักศึกษาใหม่ ปีการศึกษา 2560  บริการตรวจสุขภาพ โดย โรงพยาบาลค่ายสุรศักดิ์มนตรี</strong></div>
<div align="center"><strong>ณ มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนาลำปาง ระหว่างวันที่ 29-30 มิถุนายน 2560 จำนวน 606 ราย</strong></div>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="5%" rowspan="2" align="center"><strong>ลำดับ</strong></td>
    <td width="5%" rowspan="2" align="center"><strong>HN</strong></td>
    <td width="14%" rowspan="2" align="center"><strong>ชื่อ - สกุล</strong></td>
    <td width="18%" rowspan="2" align="center"><strong>คณะ</strong></td>
    <td width="6%" rowspan="2" align="center"><strong>น้ำหนัก</strong></td>
    <td width="6%" rowspan="2" align="center"><strong>ส่วนสูง</strong></td>
    <td width="6%" rowspan="2" align="center"><strong>BP</strong></td>
    <td colspan="2" align="center"><strong>รายการตรวจ</strong></td>
    <td width="10%" rowspan="2" align="center"><strong>ภาวะสุขภาพโดยรวม</strong></td>
    <td colspan="2" align="center"><strong>สรุปผลการตรวจ</strong></td>
  </tr>
  <tr>
    <td width="7%" align="center"><strong>METAMP</strong></td>
    <td width="8%" align="center"><strong>X-RAY</strong></td>
    <td width="7%" align="center"><strong>พบแพทย์</strong></td>
    <td width="8%" align="center"><strong>ไม่พบแพทย์</strong></td>
  </tr>
<?
$sql="SELECT  *  FROM opcardchk WHERE part='ราชมงคลลำปาง60' and active='y' order by row";
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
    <td align="center"><?=$result["course"];?></td>
    <td align="center"><?=$result2["weight"];?></td>
    <td align="center"><?=$result2["height"];?></td>
    <td align="center"><?=$bp;?></td>
    <td align="center"><?
$sql12="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'METAMP' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพราชมงคลลำปาง60'
)
GROUP BY a.`profilecode` ";
//echo $sql12;
$query12=mysql_query($sql12);
list($hbsag,$flag)=mysql_fetch_array($query12);

if($hbsag=="Negative"){
	echo "ไม่พบ";
}else if($hbsag=="Positive"){
	echo "<strong style='color:#FF0000'>พบ</strong>";
}else{
	echo "&nbsp;";
}
?></td>
    <td align="left"><? 
			  if($result2["cxr"]==""){ echo "รอผล"; }else{ echo $result2["cxr"]; }
		   ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
<? } ?>  
</table>
<p align="center">METAMP = การตรวจหาสารเสพติด</p>
</body>
</html>
