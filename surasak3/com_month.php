<?
include("connect.inc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.font1 {	font-family: "TH SarabunPSK";
	font-size: 22px;
}
.font1 {
	font-family: "TH SarabunPSK";
}
.style1 {font-family: "TH SarabunPSK"; font-size: 22px; font-weight: bold; }
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 22px;
}
.style3 {font-family: "TH SarabunPSK"; font-size: 22px}
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
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
-->
</style>
</head>

<body>
<?php
print "<a target=_self  href='../nindex.htm' class='forntsarabun'>กลับหน้าเมนูหลัก</a>&nbsp;&nbsp;||&nbsp;&nbsp;<a  href='com_support.php'><font size='4' class='forntsarabun'>ดูข้อมูลแจ้งซ่อม/ปรับปรุงโปรแกรม</font></a>&nbsp;&nbsp;||&nbsp;&nbsp;<a target=_self  href='com_month.php'><font size='4' class='forntsarabun'>รายงานประจำเดือน</font></a>&nbsp;&nbsp;||&nbsp;&nbsp;<a target=_blank  href='report_comsupport.php'><font size='4' class='forntsarabun'>รายงานผลการทำงาน</font></a>";
print "<hr>";
?>
<?
if(!isset($_POST['search'])){
?>

<form action="<? $_SERVER['PHP_SELF']?>" name="f1" method="post" target="_blank">
<table width="80%">
	<tr><td align="center" class="font1"><strong>รายงานประจำเดือน</strong></td>
	</tr>
    <tr>
      <td align="center" class="style1"><strong>ประเภทงาน&nbsp;</strong>
        <select name="jobtype" id="jobtype" class="forntsarabun">
      <option value="0" selected>เลือกงานทั้งหมด</option>
      <option value="hardware">งานซ่อมอุปกรณ์คอมพิวเตอร์/ระบบเครือข่าย</option>
      <option value="software">งานแก้ไข/พัฒนาโปรแกรมโรงพยาบาล</option>
        </select>&nbsp;&nbsp;เดือน
          <select name="m" class="forntsarabun">
<?
	$m=date("m");
	$month = array('0','มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');
	for($a=1;$a<13;$a++){
		if($a<10) $ss = "0";
		else $ss='';
	?>
            <option value="<?=$ss?><?=$a?>" <? if($m==$a) echo "selected='selected'"?>>
              <?=$month[$a]?>
            </option>
            <?
	}
	?>
          </select>
      ปี
          <select name="yr" class="forntsarabun">
            <?
	$year = date("Y")+543;
	for($a=($year-5);$a<($year+5);$a++){
	?>
            <option value="<?=$ss?><?=$a?>" <? if($year==$a) echo "selected='selected'"?>>
            <?=$a?>
            </option>
            <?
	}
	?>
          </select>      </td>
</tr>
      <tr>
  <td align="center" class="font1">
    <input name="search" type="submit" class="forntsarabun" value="  ตกลง  " style="font:TH SarabunPSK"/>  </td>
</tr> 
</table>

</form>
<?
}
if(isset($_POST['search'])){
	$month = array('0','มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');
	
if($_POST['jobtype']=="0"){
	$sql = "select * from com_support where date like '".$_POST['yr']."-".$_POST['m']."%' and dateend != '0000-00-00 00:00:00'";
}else{
	$sql = "select * from com_support where date like '".$_POST['yr']."-".$_POST['m']."%' and dateend != '0000-00-00 00:00:00' and jobtype='".$_POST['jobtype']."'";
}	
	//echo $sql;
	$row = mysql_query($sql);
	$num=mysql_num_rows($row);

?>
<center>
  <span class="style1">รายงานการแจ้งซ่อมอุปกรณ์ทางคอมพิวเตอร์ และแก้ไขปรับปรุงโปรแกรมโรงพยาบาล<br />
  ประจำเดือน 
  <?=$month[$_POST['m']+0]?> ปี <?=$_POST['yr']?>
  </span>
</center>
<table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse; font-size: 14px;">
<tr><td width="3%" align="center" valign="top" class="font1"><strong>ลำดับ</strong></td>
  <td width="7%" align="center" valign="top" class="style1">วันที่แจ้ง</td>
  <td width="7%" align="center" valign="top" class="style1">แผนก</td>
  <td width="10%" align="center" valign="top" class="style1">ผู้ร้องขอ</td>
  <td width="10%" align="center" valign="top" class="style1">ประเภทงาน</td>
  <td width="10%" align="center" valign="top" class="style1">หัวข้อ</td>
  <td width="28%" align="center" valign="top" class="style1">รายละเอียด</td>
  <td width="20%" align="center" valign="top" class="style1">ผลการดำเนินการ</td>
  <td width="6%" align="center" valign="top" class="style1">ผู้รับผิดชอบ</td>
  <td width="7%" align="center" valign="top" class="style1">วันที่ดำเนินการ</td>
  <td width="7%" align="center" valign="top" class="style1">ระยะเวลา/วัน</td>
</tr>
<?
	if($num <1){
		echo "<tr><td colspan='11' align='center'>----------------------------------------------- ไม่มีข้อมูลในระบบ -----------------------------------------------</td></tr>";
	}else{
	while($result = mysql_fetch_array($row)){
		$i++;	
?>
		<tr><td align="center" valign="top" class="font1">
	    <?=$i?>
		</td>
		  <td valign="top" class="font1">
	      <?=$result['date']?>		  </td>
		  <td valign="top" class="font1">
	      <?=$result['depart']?>		  </td>
		  <td valign="top" class="font1">
	      <?=$result['user1']?>		  </td>
		  <td valign="top" class="font1"><?=$result['jobtype']?>          </td>
		  <td valign="top" class="font1">
	      <?=$result['head']?>		  </td>
		  <td valign="top" class="font1">
	      <?=nl2br($result['detail'])?>		  </td>
		  <td valign="top" class="font1">
	      <?=$result['p_edit']?>		  </td>
		  <td valign="top" class="font1">
	      <?=$result['programmer']?>		  </td>
		  <td valign="top" class="font1">
	      <?=$result['dateend']?>		  </td>
		  <td align="center" valign="top" class="font1"><?=$result['hold']?></td>
		</tr>
<?
	}}
?>
</table>
<?
}
?>
</body>
</html>