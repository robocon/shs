<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<body>

<?
include("connect.inc");
print "<div align=\"center\" class=\"forntsarabun\">รายชื่อ บุตรกำลังพล ตามโครงการเด็กไทยไม่อ้วน สังกัด ".$_GET['addwork']."</div><BR>";

$query = "SELECT * FROM survey_nofat WHERE addwork1='".$_GET['addwork']."' ";
$result = mysql_query($query) or die("Query failed ".$query."");
?>
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse; border-color:#000;" class="forntsarabun">
  <tr bgcolor="#CCCCCC">
    <td align="center">ลำดับ</td>
    <td align="center">ชื่อ-สกุล</td>
    <td align="center">วันเกิด</td>
    <td align="center">อายุ</td>
    <td align="center">ชื่อ-สกุล บิดา</td>
    <td align="center">ชื่อ-สกุล บิดา</td>
    <td align="center">น้ำหนัก</td>
    <td align="center">ส่วนสูง</td>
    <td align="center">หมายเหตุ</td>
  </tr>
 <?   
 $i=1;
 while ($arr = mysql_fetch_array ($result)) {
	
?>

  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$arr['ptname'];?></td>
    <td><?=$arr['bdate']?></td>
    <td><?=$arr['age']?></td>
    <td><?=$arr['father'];?></td>
    <td><?=$arr['mother'];?></td>
    <td><?=$arr['weight'];?></td>
    <td><?=$arr['height'];?></td>
    <td>&nbsp;</td>
  </tr>
  <? 	
  $i++;
  }
  
  ?>
</table>
</body>
</html>