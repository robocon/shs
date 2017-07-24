<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>ลูกหนี้ตรวจสุขภาพประกันสังคม</title>
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
<p>
<form name="form1" method="post" action="<? $PHP_SELF;?>" >
<input name="act" type="hidden" value="show">
  <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center">หน่วยงาน :
        <label>      
        <select name="camp" id="camp">
          <option value="อินทราเซรามิค60">อินทราเซรามิค</option>
          <option value="เขลางค์ทรานสปอร์ต60">เขลางค์ทรานสปอร์ต</option>
          <option value="พูลผลการเกษตร60">พูลผลการเกษตร</option>
          <option value="นอร์ทเทิร์น60">นอร์ทเทิร์น</option>
          <option value="กรมทางหลวง60">กรมทางหลวง</option>
          <option value="มูลนิธิคืนช้างสู่ธรรมชาติ60">มูลนิธิคืนช้างสู่ธรรมชาติ</option>
        </select>
        <input type="submit" name="button" id="button" value="ดูรายงาน">
        </label></td>
    </tr>
  </table>
</form>
</p>
<?
if($_POST["act"]=="show"){
$camp=$_POST["camp"];
?>
<div align="center"><strong>หน่วยงาน : <?=$camp;?></strong></div>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="2%" rowspan="2" align="center"><strong>ลำดับ</strong></td>
    <td width="2%" rowspan="2" align="center"><strong>วันที่ตรวจ</strong></td>
    <td width="2%" rowspan="2" align="center"><strong>HN</strong></td>
    <td width="5%" rowspan="2" align="center"><strong>ชื่อ - สกุล</strong></td>
    <td width="5%" rowspan="2" align="center"><strong>เลขบัตรปชช</strong></td>
    <td width="3%" rowspan="2" align="center"><strong>ที่อยู่</strong></td>
    <td width="7%" rowspan="2" align="center"><strong>เบอร์โทรศัพท์</strong></td>
    <td width="2%" rowspan="2" align="center"><strong>อายุ (ปี)</strong></td>
    <td width="7%" rowspan="2" align="center"><strong>โรคประจำตัว</strong></td>
    <td width="3%" rowspan="2" align="center"><strong>น้ำหนัก</strong></td>
    <td width="3%" rowspan="2" align="center"><strong>ส่วนสูง</strong></td>
    <td width="7%" rowspan="2" align="center"><strong>ค่าความดันโลหิตบน</strong></td>
    <td width="7%" rowspan="2" align="center"><strong>ค่าความดันโลหิตล่าง</strong></td>
    <td colspan="6" align="center"><strong>ความสมบูรณ์ของเม็ดเลือด CBC</strong></td>
    <td colspan="6" align="center"><strong>การทำงานของปัสสาวะ UA</strong></td>
    <td width="3%" rowspan="2" align="center"><strong>CHOL</strong></td>
    <td width="3%" rowspan="2" align="center"><strong>HDL</strong></td>
    <td width="2%" rowspan="2" align="center"><strong>FBS</strong></td>
    <td width="5%" rowspan="2" align="center"><strong>HBSAG</strong></td>
    <td width="12%" rowspan="2" align="center"><strong>FOBT</strong></td>
    <td width="7%" rowspan="2" align="center"><strong>X-RAY</strong></td>
  </tr>
  <tr>
    <td width="2%" align="center">การตรวจนับเม็ดเลือดขาว (WBC)</td>
    <td width="2%" align="center">การติดเชื้อแบคทีเรีย (NEU)</td>
    <td width="2%" align="center">การติดเชื้อไวรัส หรือมะเร็งเม็ดเลือด (LYMP)</td>
    <td width="2%" align="center">อาการของโรคภูมแพ้ หรือพยาธิ (EOS)</td>
    <td width="2%" align="center">การวัดเม็ดเลือดแดงอัดแน่น (HCT)</td>
    <td width="2%" align="center">การตรวจนับเกล็ดเลือดในเลือด (PLTC) </td>
    <td width="1%" align="center">ความถ่วงจำเพาะ (SPGR) </td>
    <td width="1%" align="center">ความเป็นกรด (PHU)</td>
    <td width="1%" align="center">โปรตีนในปัสสาวะ (PROU)</td>
    <td width="1%" align="center">น้ำตาลในปัสสาวะ (GLUU)</td>
    <td width="1%" align="center">เม็ดเลือดขาว (WBCU)</td>
    <td width="1%" align="center">เม็ดเลือดแดง (RBCU)</td>
  </tr>
<?
$sql="SELECT  * ,c.`idcard`,c.`address`,c.`tambol`,c.`ampur`,c.`changwat`,c.`phone`,c.`congenital_disease` FROM opcardchk AS a LEFT JOIN opcard AS c ON c.hn = a.HN WHERE a.part='$camp' and a.active='y' order by a.agey desc";
//echo $sql."<br>";
$row = mysql_query($sql)or die ("Query Fail");
$i=0;
while($result = mysql_fetch_array($row)){
$i++;
$strSQL1="SELECT date_format(b.authorisedate,'%d-%m-%Y') as authorisedate
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE  (b.result !='DELETE' OR b.result !='*') AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60' OR a.clinicalinfo = 'ตรวจสุขภาพประกันสังคม60'
)
GROUP BY a.`profilecode` limit 0,1";

$objQuery1 = mysql_query($strSQL1);
list($authorisedate)=mysql_fetch_array($objQuery1);	


$sql2="select * from out_result_chkup where hn='".$result["HN"]."'";
//echo $sql2;
$query2=mysql_query($sql2);
$result2=mysql_fetch_array($query2);

$ptname=$result["yot"].$result["name"]." ".$result["surname"];

if($result["congenital_disease"]=="ปฎิเสธ" || empty($result["congenital_disease"])){
	$disease="ไม่มี";
}else{
	$disease="<strong style='color:#FF0000'>มี</strong>"."....".$result["congenital_disease"];
}
	
?>  
  <tr>
    <td><?=$i;?></td>
    <td><?=$authorisedate;?></td>
    <td><?=$result["HN"];?></td>
    <td><?=$ptname;?></td>
    <td><?=$result['idcard'];?></td>
    <td><?=$result['address'].' ต.'.$result['tambol'].' อ.'.$result['ampur'].' จ.'.$result['changwat'];?></td>
    <td><?=$result['phone'];?></td>
    <td align="center"><?=$result["agey"];?></td>
    <td align="left"><?=$disease;?></td>
    <td align="center"><?=$result2["weight"];?></td>
    <td align="center"><?=$result2["height"];?></td>
    <td align="center"><?=$result2["bp1"];?></td>
    <td align="center"><?=$result2["bp2"];?></td>
    <td align="center"><?
$sql31="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'WBC' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60' OR a.clinicalinfo = 'ตรวจสุขภาพประกันสังคม60'
)
GROUP BY a.`profilecode` ";
//echo $sql31;
$query31=mysql_query($sql31);
list($cbc31,$flag)=mysql_fetch_array($query31);

if($flag=="N"){
	echo "ปกติ";
}else if($flag=="H" || $flag=="L"){
	echo "<strong style='color:#FF0000'>ผิดปกติ</strong>";
}else{
	echo "&nbsp;";
}
?></td>
    <td align="center"><?
$sql32="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'NEU' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60' OR a.clinicalinfo = 'ตรวจสุขภาพประกันสังคม60'
)
GROUP BY a.`profilecode` ";
//echo $sql32;
$query32=mysql_query($sql32);
list($cbc32,$flag)=mysql_fetch_array($query32);

if($flag=="N"){
	echo "ปกติ";
}else if($flag=="H" || $flag=="L"){
	echo "<strong style='color:#FF0000'>ผิดปกติ</strong>";
}else{
	echo "&nbsp;";
}
?></td>
    <td align="center"><?
$sql33="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'LYMP' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60' OR a.clinicalinfo = 'ตรวจสุขภาพประกันสังคม60'
)
GROUP BY a.`profilecode` ";
//echo $sql33;
$query33=mysql_query($sql33);
list($cbc33,$flag)=mysql_fetch_array($query33);

if($flag=="N"){
	echo "ปกติ";
}else if($flag=="H" || $flag=="L"){
	echo "<strong style='color:#FF0000'>ผิดปกติ</strong>";
}else{
	echo "&nbsp;";
}
?></td>
    <td align="center"><?
$sql34="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'EOS' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60' OR a.clinicalinfo = 'ตรวจสุขภาพประกันสังคม60'
)
GROUP BY a.`profilecode` ";
//echo $sql34;
$query34=mysql_query($sql34);
list($cbc34,$flag)=mysql_fetch_array($query34);

if($flag=="N"){
	echo "ปกติ";
}else if($flag=="H" || $flag=="L"){
	echo "<strong style='color:#FF0000'>ผิดปกติ</strong>";
}else{
	echo "&nbsp;";
}
?></td>
    <td align="center"><?
$sql35="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'HCT' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60' OR a.clinicalinfo = 'ตรวจสุขภาพประกันสังคม60'
)
GROUP BY a.`profilecode` ";
//echo $sql35;
$query35=mysql_query($sql35);
list($cbc35,$flag)=mysql_fetch_array($query35);

if($flag=="N"){
	echo "ปกติ";
}else if($flag=="H" || $flag=="L"){
	echo "<strong style='color:#FF0000'>ผิดปกติ</strong>";
}else{
	echo "&nbsp;";
}
?></td>
    <td align="center"><?
$sql36="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'PLTC' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60' OR a.clinicalinfo = 'ตรวจสุขภาพประกันสังคม60'
)
GROUP BY a.`profilecode` ";
//echo $sql36;
$query36=mysql_query($sql36);
list($cbc36,$flag)=mysql_fetch_array($query36);

if($flag=="N"){
	echo "ปกติ";
}else if($flag=="H" || $flag=="L"){
	echo "<strong style='color:#FF0000'>ผิดปกติ</strong>";
}else{
	echo "&nbsp;";
}
?></td>
    <td align="center"><?
$sql41="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'SPGR' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60' OR a.clinicalinfo = 'ตรวจสุขภาพประกันสังคม60'
)
GROUP BY a.`profilecode` ";
//echo $sql41;
$query41=mysql_query($sql41);
list($ua41,$flag)=mysql_fetch_array($query41);

if($flag=="N"){
	echo "ปกติ";
}else if($flag=="H" || $flag=="L"){
	echo "<strong style='color:#FF0000'>ผิดปกติ</strong>";
}else{
	echo "&nbsp;";
}
?></td>
    <td align="center"><?
$sql42="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'PHU' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60' OR a.clinicalinfo = 'ตรวจสุขภาพประกันสังคม60'
)
GROUP BY a.`profilecode` ";
//echo $sql42;
$query42=mysql_query($sql42);
list($ua42,$flag)=mysql_fetch_array($query42);

if($flag=="N"){
	echo "ปกติ";
}else if($flag=="H" || $flag=="L"){
	echo "<strong style='color:#FF0000'>ผิดปกติ</strong>";
}else{
	echo "&nbsp;";
}
?></td>
    <td align="center"><?
$sql43="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'PROU' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60' OR a.clinicalinfo = 'ตรวจสุขภาพประกันสังคม60'
)
GROUP BY a.`profilecode` ";
//echo $sql43;
$query43=mysql_query($sql43);
list($ua43,$flag)=mysql_fetch_array($query43);

if($flag=="N"){
	echo "ปกติ";
}else if($flag=="H" || $flag=="L"){
	echo "<strong style='color:#FF0000'>ผิดปกติ</strong>";
}else{
	echo "&nbsp;";
}
?></td>
    <td align="center"><?
$sql44="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'GLUU' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60' OR a.clinicalinfo = 'ตรวจสุขภาพประกันสังคม60'
)
GROUP BY a.`profilecode` ";
//echo $sql44;
$query44=mysql_query($sql44);
list($ua44,$flag)=mysql_fetch_array($query44);

if($flag=="N"){
	echo "ปกติ";
}else if($flag=="H" || $flag=="L"){
	echo "<strong style='color:#FF0000'>ผิดปกติ</strong>";
}else{
	echo "&nbsp;";
}
?></td>
    <td align="center"><?
$sql45="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'WBCU' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60' OR a.clinicalinfo = 'ตรวจสุขภาพประกันสังคม60'
)
GROUP BY a.`profilecode` ";
//echo $sql45;
$query45=mysql_query($sql45);
list($ua45,$flag)=mysql_fetch_array($query45);

if($flag=="N"){
	echo "ปกติ";
}else if($flag=="H" || $flag=="L"){
	echo "<strong style='color:#FF0000'>ผิดปกติ</strong>";
}else{
	echo "&nbsp;";
}
?></td>
    <td align="center"><?
$sql46="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'RBCU' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60' OR a.clinicalinfo = 'ตรวจสุขภาพประกันสังคม60'
)
GROUP BY a.`profilecode` ";
//echo $sql46;
$query46=mysql_query($sql46);
list($ua46,$flag)=mysql_fetch_array($query46);

if($flag=="N"){
	echo "ปกติ";
}else if($flag=="H" || $flag=="L"){
	echo "<strong style='color:#FF0000'>ผิดปกติ</strong>";
}else{
	echo "&nbsp;";
}
?></td>
    <td align="center"><?
$sql5="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'CHOL' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60' OR a.clinicalinfo = 'ตรวจสุขภาพประกันสังคม60'
)
GROUP BY a.`profilecode` ";
//echo $sql5;
$query5=mysql_query($sql5);
list($chol,$flag)=mysql_fetch_array($query5);

if($flag=="N"){
	echo "ปกติ";
}else if($flag=="H" || $flag=="L"){
	echo "<strong style='color:#FF0000'>ผิดปกติ</strong>";
}else{
	echo "&nbsp;";
}
?></td>
    <td align="center"><?
$sql6="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'HDL' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60' OR a.clinicalinfo = 'ตรวจสุขภาพประกันสังคม60'
)
GROUP BY a.`profilecode` ";
//echo $sql6;
$query6=mysql_query($sql6);
list($hdl,$flag)=mysql_fetch_array($query4);

if($flag=="N"){
	echo "ปกติ";
}else if($flag=="H" || $flag=="L"){
	echo "<strong style='color:#FF0000'>ผิดปกติ</strong>";
}else{
	echo "&nbsp;";
}
?></td>
    <td align="center"><?
$sql7="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'GLU' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60' OR a.clinicalinfo = 'ตรวจสุขภาพประกันสังคม60'
)
GROUP BY a.`profilecode` ";
//echo $sql7;
$query7=mysql_query($sql7);
list($hdl,$flag)=mysql_fetch_array($query7);

if($flag=="N"){
	echo "ปกติ";
}else if($flag=="H" || $flag=="L"){
	echo "<strong style='color:#FF0000'>ผิดปกติ</strong>";
}else{
	echo "&nbsp;";
}
?></td>
    <td align="center"><?
$sql8="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'HBSAG' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60' OR a.clinicalinfo = 'ตรวจสุขภาพประกันสังคม60'
)
GROUP BY a.`profilecode` ";
//echo $sql8;
$query8=mysql_query($sql8);
list($hbsag,$flag)=mysql_fetch_array($query8);

if($hbsag=="Negative"){
	echo "ไม่พบเชื้อ";
}else if($hbsag=="Positive"){
	echo "<strong style='color:#FF0000'>พบเชื้อ</strong>";
}else{
	echo "&nbsp;";
}
?></td>
    <td align="center"><?
$sql9="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'OCCULT' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = 'ตรวจสุขภาพประจำปี60' OR a.clinicalinfo = 'ตรวจสุขภาพประกันสังคม60'
)
GROUP BY a.`profilecode` ";
//echo $sql9;
$query9=mysql_query($sql9);
list($hbsag,$flag)=mysql_fetch_array($query9);

if($hbsag=="Negative"){
	echo "ไม่พบเลือด";
}else if($hbsag=="Positive"){
	echo "<strong style='color:#FF0000'>พบเลือด</strong>";
}else{
	echo "&nbsp;";
}
?></td>
    <td align="left">
	<? 
	if($camp=="มูลนิธิคืนช้างสู่ธรรมชาติ60"){
		if($result["HN"]=="60-3343" || $result["HN"]=="60-3385"){
			  	if($result2["cxr"]==""){ echo "ปกติ"; }else{ echo $result2["cxr"];}
		}
	}else{
		if($result2["cxr"]==""){ echo "ปกติ"; }else{ echo $result2["cxr"]; }
	}
	?></td>
  </tr>
<? } ?>  
</table>
<? } ?>
</body>
</html>
