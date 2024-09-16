<?php
include("connect.inc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>ปรับสถานะแลป</title>
</head>
<style type="text/css">
.ppo {
	font-family:"Angsana New";
	font-size:20px;
}
</style>
</head>
<body>
<a href ="../nindex.htm" >&lt;&lt; ไปเมนู</a>&nbsp;&nbsp;<a href ="upd_labstatus.php" class="tet">[ HN ใหม่ ]</a>
<?php
if(isset($_POST['hn'])){
	$sql = "select * from resulthead where hn='".$_POST['hn']."' group by labnumber order by orderdate desc";
  	$rows = mysql_query($sql);
	$num = mysql_num_rows($rows);
	echo "<div align='center'>รายการ LAB ที่ส่งตรวจ</div><table class='ppo' border='1' width='100%' align='center' cellpadding='5' cellspacing='0' style='border-collapse:collapse'><tr style='background-color:#45B39D'><td align='center'>Labnumber</td><td align='center'>HN</td><td align='center'>ชื่อ - สกุล</td><td align='center'>Orderdate</td><td align='center'>Order ที่ส่งตรวจ</td><td align='center'>สถานะการตรวจ</td><td align='center'>ปรับสถานะ</td></tr>";
  	echo "<div align='center' style='color:red; font-size:12px;'>*** <u><b>คำเตือน</b></u> กรุณาตรวจสอบวันที่ Labnumber, Orderdate และOrder ที่ส่งตรวจ ก่อนการปรับสถานะทุกครั้ง ***</div>";
	if($num < 1){
		echo "<tr><td colspan='7' align='center' style='color:red;'>-------------------- ไม่มีข้อมูล --------------------</td></tr>";
	}else{	
	while($result = mysql_fetch_array($rows)){ 
	
	$query1 = "select clinicalinfo from orderhead where labnumber='".$result['labnumber']."' group by labnumber";
	$result1 = mysql_query($query1) or die("Query failed,opday");
	list($orderclinicalinfo)=mysql_fetch_array($result1);	
	
	if($result['orderdate'] < "2022-02-13"){
		$orderclinicalinfo=$result['clinicalinfo'];
	}else{
		$orderclinicalinfo=$orderclinicalinfo;
	}	
	
	if(empty($result['clinicalinfo'])){
		$color="#FADBD8";
	}else{
		$color="#F2F3F4";
	}		
	
		echo "<tr style='background-color:$color'>";
		echo "<td align='center'>".$result['labnumber']."</td>";
		echo "<td align='center'>".$result['hn']."</td>";
		echo "<td align='center'>".$result['patientname']."</td>";
		echo "<td align='center'>".$result['orderdate']."</td>";
		echo "<td>&nbsp;".$orderclinicalinfo."</td>";
		echo "<td>&nbsp;".$result['clinicalinfo']."</td>";
		echo "<td align='center'><a href='upd_labstatus.php?ids=".$result['labnumber']."' >แก้ไข</a></td>";
		echo "</tr>";
	}
	}
	echo "</table>";
}
elseif(isset($_GET['ids'])){
	////*runno ตรวจสุขภาพ*/////////
	$query = "SELECT runno, prefix  FROM runno WHERE title = 's_chekup'";
	$result = mysql_query($query) or die("Query failed");
	
	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}
			if(!($row = mysql_fetch_object($result)))
			continue;
	}
	
	$nPrefix=$row->prefix;
	////*runno ตรวจสุขภาพ*/////////
	$sql2 = "select * from resulthead where labnumber='".$_GET['ids']."'";
  	$rows2 = mysql_query($sql2);
	$result2 = mysql_fetch_array($rows2);

	$yearTh= substr(date('Y')+543,2,2);
	$yearRange = array_reverse(range(58, $yearTh));
	?>
	<form id="form1" name="form1" method="post" action="upd_labstatus.php">
<table width="29%" border='0' align='center'>
  <tr>
    <td align="center">สถานะ : 
    <select  name='clinic'>
		<?php 
		if($result2!==false){
			?><option value='<?=$result2['clinicalinfo']?>'><?=$result2['clinicalinfo']?></option><?php
		}
		foreach ($yearRange as $yearItem) {
			$selected = ($yearItem === $nPrefix) ? 'selected="selected"' : '' ;
			?>
			<option value="ตรวจสุขภาพประจำปี<?=$yearItem?>" <?=$selected;?>>ตรวจสุขภาพประจำปี<?=$yearItem?></option>
			<?php
		}
		?>
 		<option value='ยกเลิก'>ยกเลิก</option>

	</select>&nbsp;
    <input name='ids' type="hidden" value="<?=$_GET['ids']?>" />
    <input type="submit" name="upbtn" id="button" value="ตกลง" /></td>
    </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
</table>
</form>
	<?
}
elseif(isset($_POST['upbtn'])){
	$sql2 = "update resulthead set clinicalinfo= '".$_POST['clinic']."' where labnumber='".$_POST['ids']."'";
  	$result = mysql_query($sql2);
	if($result){
		echo "<br><center>ปรับปรุงข้อมูลเรียบร้อยแล้ว</center>";
		echo "<meta http-equiv='refresh' content='3' />";
	}
}else{
?>
<form id="form1" name="form1" method="post" action="upd_labstatus.php">

<table width="29%" border='0' align='center'>
  <tr>
    <td align="center">ปรับปรุงสถานะห้องLAB</td>
  </tr>
  <tr>
    <td align="center">HN : 
      <input name="hn" type="text" id="hn" size="10" />&nbsp;<input type="submit" name="okbtn" id="button" value="ตกลง" /></td>
    </tr>
</table>
</form>
<?
}
?>
</body>
</html>