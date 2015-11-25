<?
session_start();
include("connect.inc");

function displaydate($x) {
	$thai_m=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฏาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
	$date_array=explode("-",$x);
	$y=$date_array[0];
	$m=$date_array[1]-1;
	$d=$date_array[2];

	$m=$thai_m[$m];
	$y=$y+543;

	$displaydate="$d $m $y";
	return $displaydate;
} // end function displaydate
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>ข้อมูลการปฏิบัติงานประจำวัน ศูนย์คอมพิวเตอร์</title>
<style type="text/css">
<!--
.forntsarabun {	font-family: "TH SarabunPSK";
	font-size: 18px;
}
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
.style1 {
	font-size: 22px;
	font-weight: bold;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
.style4 {font-weight: bold}
-->
</style>
</head>

<body>
<h21>
<table width="90%" border="0" align="center">
  <tr>
    <td colspan="2" align="center"><span class="style1">ข้อมูลการปฏิบัติงานประจำวัน </span></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><strong>ห้องโปรแกรมเมอร์ ศูนย์คอมพิวเตอร์</strong></td>
  </tr>
  <tr>
    <td width="49%" align="left"><strong><a target="_self"  href='../nindex.htm'>&lt;&lt;ไปเมนู&gt;&gt;</a></strong></td>
    <td width="51%" align="right">
	<?
    if($_SESSION["smenucode"]=="ADM"){
	?>
    	<a href="comservicereport.php" target="_self">รายงานประจำเดือน</a>  ||  
    	<a href="comservice.php" target="_self">บันทึกข้อมูล</a>
    <? 
	}else{
	?>
		<a href="comservicereport.php" target="_self">รายงานประจำเดือน</a>
	<?
    }	
	?>
    
    </td>
  </tr>
</table>
<?

$date=date("Y-m");
$sql="select * from comservice where datework like '2015-10%' or datework like '$date%' order by datework desc, timework desc";
//echo $sql;
$query=mysql_query($sql); 
$num=mysql_num_rows($query);           
?>
<table width="90%" border="0" align="center" cellpadding="0">
  <tr>
    <td width="4%" rowspan="2" align="center" bgcolor="#A7C941" class="style4"><strong>ลำดับที่ </strong></td>
    <td height="25" colspan="2" align="center" bgcolor="#A7C941" class="style4"><strong>วันที่ปฏิบัติงาน</strong></td>
    <td width="11%" rowspan="2" align="center" bgcolor="#A7C941" class="style4"><strong>แผนกที่ร้องขอ</strong></td>
    <td width="12%" rowspan="2" align="center" bgcolor="#A7C941" class="style4"><strong>ผู้ที่ร้องขอ</strong></td>
    <td width="10%" rowspan="2" align="center" bgcolor="#A7C941" class="style4"><strong>ผู้ปฏิบัติงาน</strong></td>
    <td width="43%" rowspan="2" align="center" bgcolor="#A7C941" class="style4"><strong>รายละเอียดงานที่ทำ</strong></td>
    <td width="7%" rowspan="2" align="center" bgcolor="#A7C941"><strong>ใบแจ้งงาน</strong></td>
  </tr>
  <tr>
    <td width="6%" height="25" align="center" bgcolor="#A7C941" class="style4"><strong>วัน/เดือน/ปี</strong></td>
    <td width="7%" align="center" bgcolor="#A7C941" class="style4"><strong>เวลา</strong></td>
  </tr>
  <?
if(empty($num)){
echo "
	<tr>
		<td colspan='6' align='center' bgcolor='#EBF2D3' class='style3'><--------------- ไม่มีข้อมูลในระบบ ---------------></td>
	</tr>
";
}else{
	$i=0;
	while($rows=mysql_fetch_array($query)){
	$i++;
	$ited_request1=$rows["datework"];
	list($y,$m,$d)=explode("-",$ited_request1);
	$y=$y+543;
	$newdate="$d/$m/$y";	
?>
  <tr>
    <td height="23" align="center" bgcolor="#EBF2D3"><?=$i;?></td>
    <td align="center" bgcolor="#EBF2D3"><?=$newdate;?></td>
    <td align="center" bgcolor="#EBF2D3"><?=$rows["timework"];?></td>
    <td align="left" bgcolor="#EBF2D3"><?=$rows["depart"];?></td>
    <td align="left" bgcolor="#EBF2D3"><?=$rows["personal"];?></td>
    <td align="left" bgcolor="#EBF2D3"><?=$rows["user"];?></td>
    <td align="left" bgcolor="#EBF2D3"><?=$rows["detail"];?></td>
    <td align="center" bgcolor="#EBF2D3"><a href="comserviceprint.php?id=<?=$rows["row_id"];?>" target="_blank">พิมพ์</a></td>
  </tr>
  <?
	}
}
?>
</table>
</body>
</html>
