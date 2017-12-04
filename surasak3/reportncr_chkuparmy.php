<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>รายงานกลุ่มเสี่ยงกำลังพล ทบ.</title>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
.sarabun {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
</head>

<body>

<form action="reportncr_chkuparmy.php" method="post" name="form1">
<input name="act" type="hidden" value="show" />
<p><strong>เลือกหัวข้อที่ต้องการดูข้อมูล :</strong> 
<select name="selncr" class="sarabun" id="selncr">
  <option value="กลุ่มปกติ">กลุ่มปกติ</option>
  <option value="กลุ่มเสี่ยง">กลุ่มเสี่ยง</option>
  <option value="กลุ่มเป็นโรค">กลุ่มเป็นโรค</option>
</select>
 <label>
 &nbsp;&nbsp;
 <input name="button" type="submit" class="sarabun" id="button" value="ดูข้อมูล" />  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm"><< เมนูหลัก</a>
 </label>
</p>
</form>
<?
if($_POST["act"]=="show"){
 	include("connect.inc");
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
	$showyear="25".$nPrefix;
	
	$sql="select distinct camp1 from condxofyear_so where yearcheck ='$showyear' and camp1 !='' order by camp1";
	//echo $sql;
	$query=mysql_query($sql);
	
	echo "<p><strong>รายชื่อหน่วยงานที่กำลังพลสังกัด กลุ่ม : <span style='color:blue'>$_POST[selncr]</span> ประจำปี $showyear</strong></p>";
	$i=0;
	while($rows=mysql_fetch_array($query)){
	$i++;
	if($_POST["selncr"]=="กลุ่มปกติ"){
	$sql1="select count(row_id) from condxofyear_so where yearcheck ='$showyear' and camp1='$rows[camp1]' and sum1='ปกติ (ไม่พบความเสี่ยง)'";	
	}else if($_POST["selncr"]=="กลุ่มเสี่ยง"){
	$sql1="select count(row_id) from condxofyear_so where yearcheck ='$showyear' and camp1='$rows[camp1]' and sum2='พบความเสี่ยงเบื้องต้นต่อโรค'";	
	}else if($_POST["selncr"]=="กลุ่มเป็นโรค"){
	$sql1="select count(row_id) from condxofyear_so where yearcheck ='$showyear' and camp1='$rows[camp1]' and sum5='ป่วยด้วยโรคเรื้อรัง'";		
	}
	//echo $sql1;
	$query1=mysql_query($sql1);
	list($count)=mysql_fetch_array($query1);
	
		echo "<div>$i) <a href='reportncr1_chkuparmy.php?camp=$rows[camp1]&ncr=$_POST[selncr]&yearcheck=$showyear' target='_blank'>$rows[camp1] ($count)</a></div>";
	}
?>

<?
}
?>
</body>
</html>
