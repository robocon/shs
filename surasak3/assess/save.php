<?
$row_id=$_POST['row_id'];
$ch1=$_POST['ch1'];	
$ch2=$_POST['ch2'];
$ch3=$_POST['ch3'];	
$ch4=$_POST['ch4'];
$ch5=$_POST['ch5'];	
$ch6=$_POST['ch6'];
$ch7=$_POST['ch7'];	
$ch8=$_POST['ch8'];
$ch9=$_POST['ch9'];	
$ch10=$_POST['ch10'];
$ch11=$_POST['ch11'];
$ch12=$_POST['ch12']; 
$ch13=$_POST['ch13']; 
$ch14=$_POST['ch14']; 
$ch15=$_POST['ch15']; 
$ch16=$_POST['ch16'];
$ip = $_SERVER['REMOTE_ADDR']; 
$now = date("Y-m-d H:i:s");
$com1 =$_POST['com1'];
include "connect.php";

////*runno ตรวจสุขภาพ*/////////
$query = "SELECT runno, prefix  FROM runno WHERE title = 'y_chekup'";
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

$sql="insert into tb_assess  ( `row_id` , `q1` , `q2` , `q3` , `q4` , `q5` , `q6` , `q7` , `q8` , `q9` , `q10` , `q11` , `q12` , `q13` , `q14` , `q15` , `q16` , `ip` , `date` , `com1` , `year`) values ('$row_id','$ch1','$ch2','$ch3','$ch4','$ch5','$ch6','$ch7','$ch8','$ch9','$ch10','$ch11','$ch12','$ch13','$ch14','$ch15','$ch16','$ip','$now','$com1','$nPrefix')";


$result=mysql_db_query($dbname,$sql)or die (mysql_error());
if (!$result) {
	echo "ไม่สามารถบันทึกข้อมูลได้";
	exit;
}
echo "<H3>ขอบคุณครับที่ช่วยตอบแบบประเมิน </H3>";
echo "<script>alert('บันทึกข้อมูลของท่านเรียบร้อยแล้ว')</script>";
echo "<script>window.close();</script>";
/*echo "<script>window.location='../../nindex.htm'</script>";*/

?>