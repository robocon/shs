<?php
    session_start();
	include("connect.inc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.ppo {
	font-family: "TH SarabunPSK";
	font-size:20px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
}
-->
</style>
</head>
 
<body>
<div id="no_print" >
<a href ="../nindex.htm" >&lt;&lt; ไปเมนู</a>
<form id="form1" name="form1" method="post" action="report_tahan2.php">
<table width="42%" border="0" align="center">
  <tr>
    <td align="center">ค้นหารายชื่อผู้ที่ยังไม่ได้ทำการตรวจร่างกายประจำปี ทบ.</td>
  </tr>
  <tr>
    <td align="center">
          กลุ่ม :  
<select  name='camp'>
<option value='0' >--เลือกสังกัด--</option>
<option value='พลเรือน'>พลเรือน</option>
<option value='ร.17 พัน2'>ร.17 พัน2</option>
<option value='มณฑลทหารบกที่32'>มณฑลทหารบกที่32</option>
<option value='ร.พ.ค่ายสุรศักดิ์มนตรี'>ร.พ.ค่ายสุรศักดิ์มนตรี</option>
<option value='ช.พัน4'>ช.พัน4</option>
<option value='ร้อยฝึกรบพิเศษประตูผา'>ร้อยฝึกรบพิเศษประตูผา</option>
<option value='บก.มทบ.32'>บก.มทบ.32</option>
<option value='กกพ.มทบ.32'>กกพ.มทบ.32</option>
<option value='กขว.,ฝผท.มทบ.32'>กขว.,ฝผท.มทบ.32</option>
<option value='กยก.มทบ.32'>กยก.มทบ.32</option>
<option value='กกบ.มทบ.32'>กกบ.มทบ.32</option>
<option value='กกร.มทบ.32'>กกร.มทบ.32</option>
<option value='ฝคง.มทบ.32'>ฝคง.มทบ.32</option>
<option value='ฝกง.มทบ.32'>ฝกง.มทบ.32</option>
<option value='ฝสก.มทบ.32'>ฝสก.มทบ.32</option>
<option value='ฝปบฝ.มทบ.32'>ฝปบฝ.มทบ.32</option>
<option value='ผพธ.มทบ.32'>ผพธ.มทบ.32</option>
<option value='อก.ศาล มทบ.32'>อก.ศาล มทบ.32</option>
<option value='ฝสวส.มทบ.32'>ฝสวส.มทบ.32</option>
<option value='ฝธน.มทบ.32'>ฝธน.มทบ.32</option>
<option value='อศจ.มทบ.32'>อศจ.มทบ.32</option>
<option value='ร้อย.มทบ.32'>ร้อย.มทบ.32</option>
<option value='สขส.มทบ.32'>สขส.มทบ.32</option>
<option value='รจ.มทบ.32'>รจ.มทบ.32</option>
<option value='ผยย.มทบ.32'>ผยย.มทบ.32</option>
<option value='สส.มทบ.32'>สส.มทบ.32</option>
<option value='ฝสห.มทบ.32'>ฝสห.มทบ.32</option>
<option value='ร้อย.สห.มทบ.32'>ร้อย.สห.มทบ.32</option>
<option value='มว.ดย.มทบ.32'>มว.ดย.มทบ.32</option>
<option value='ผสพ.มทบ.32'>ผสพ.มทบ.32</option>
<option value='สรรพกำลัง มทบ.32'>สรรพกำลัง มทบ.32</option>
<option value='ศฝ.นศท.มทบ.32'>ศฝ.นศท.มทบ.32</option>
<option value='ศาล.มทบ.32'>ศาล.มทบ.32</option>
<option value='ศูนย์โทรศัพท์ มทบ.32'>ศูนย์โทรศัพท์ มทบ.32</option>
<option value='ผปบ.มทบ.32'>ผปบ.มทบ.32</option>
<option value='สัสดีจังหวัดลำปาง'>สัสดีจังหวัดลำปาง</option>
<option value='มว.คลัง สป.๓ฯ'>มว.คลัง สป.๓ฯ</option>
<option value='กรม ทพ.33'>กรม ทพ.33</option>
<option value='หน่วยทหารอื่นๆ'>หน่วยทหารอื่นๆ</option>
</select>
&nbsp;ปี :
<select name="year">
<?php for($i=date("Y")+540;$i<date("Y")+545;$i++){?>
<option value="<?php echo $i;?>" <?php if($i == date("Y")+543) echo "Selected"; ?> ><?php echo $i;?></option>
<?php }?>
</select>
    </td>
    </tr>
  <tr>
    <td align="center"><input type="submit" name="button" id="button" value="ตกลง" /></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    </tr>
</table>
</form>
</div>
<?
if(isset($_POST['button'])){
	$sql = "select *,concat(yot,' ',name,' ',surname) as ptname from opcard where camp like '%".$_POST['camp']."%' and (goup like '%G11%' or goup like '%G12%' or goup like '%G14%') and (yot != 'พลฯ' and yot !='พลทหาร' and yot !='พล ฯ') and (idguard !='MX07 ทำลายประวัติ' and idguard !='MX05 ยุบประวัติ') ";
	$row = mysql_query($sql);
	$z=0;
	$p=0;
	echo "<span class='ppo'>รายชื่อผู้ที่ยังไม่ได้ทำการตรวจสุขภาพ ".$_POST['camp']."</span><br>";
	echo "<table class='ppo' border='1' cellpadding='0' cellspacing='0' style='border-collapse:collapse' width='50%'>";
	while($result2 = mysql_fetch_array($row)){
		
		$sql2 = "select * from condxofyear_so where status_dr='Y' and yearcheck='".$_POST['year']."' and hn='".$result2['hn']."'";
		$row2 = mysql_query($sql2);
		$numrow = mysql_num_rows($row2);
		if($numrow==0){
			$result = mysql_fetch_array($row2);
			$z++;
			$p++;
			echo "<tr valign='top'><td align='center'>".$z."</td><td>&nbsp;".$result2['hn']."</td><td>&nbsp;".$result2['ptname']."</td>";
			echo "</tr>";
		}
		if($p==35){
			echo "</table>";
			echo "<div style='page-break-after: always'></div>";
			echo "<table class='ppo' border='1' cellpadding='0' cellspacing='0' style='border-collapse:collapse' width='50%'>";
			$p=0;
		}		
	}
		echo "</table>";
		
}
?>

</body>
</html>