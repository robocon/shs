<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<body>
<?
	include("connect.inc");
	$today = (date("Y")+543).date("-m-d");
	$todaytime = (date("Y")+543).date("-m-d H:i:s");
	$sqlvn = "select * from opday where hn='$hn' and thidate like '$today%'";
	$result = mysql_query($sqlvn) or die("Query failed opday");
	$rownum = mysql_num_rows($result);
	if($rownum==0){
		echo "ผู้ป่วยยังไม่ได้ลงทะเบียน กรุณาติดต่อแผนกทะเบียนเพื่อออก VN ก่อน";
	}
	else{
		$arr = mysql_fetch_array($result);
		$sqlupdate = "update dphardep set date ='".$todaytime."',tvn='".$arr['vn']."' where row_id = '".$_GET["nRow_id"]."' ";
		$result1 = mysql_query($sqlupdate);
		$sqlupdrug = "update ddrugrx set date = '".$todaytime."' where idno='".$_GET["nRow_id"]."'";
		$result2 = mysql_query($sqlupdrug);
			
		if($result1&&$result2){
			echo "บันทึกข้อมูลเรียบร้อยแล้ว ทำรายการจ่ายยาได้ตามปกติ <br> กรุณาปิดหน้าต่าง";
			?>
			<script>
            	window.location.href='drxdetail.php?sDate=<?=$todaytime?>&nRow_id=<?=$_GET["nRow_id"]?>&nAccno=<?=$_GET["nAccno"]?>&sPtright=<?=$_GET["sPtright"]?>';
            </script>
			<?
		}
	}
?>
</body>
</html>