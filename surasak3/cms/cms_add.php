<? 
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>
<style>
.font{
	font-family:"Angsana New";
	font-size:16pt;
	color:#FFF;
}
.font2{
	font-family:"Angsana New";
	font-size:16pt;
}
.dot {
	font-family:"Angsana New";
	color: #F00;
	font-size: 16pt;
}
</style>
<body>
<h1 class="font2">ขึ้นทะเบียนอุปกรณ์ (<a  class="font2" target="_top" href="../../nindex.htm">&lt;&lt; เลิกทำ,ไปเมนู</a>)</h1>
<form id="form1" name="form1" method="post" action="cms_add.php?action=ADD">
  <table border="0"  class="font2">
   
    <tr>
      <td>รหัสอุปกรณ์</td>
      <td colspan="3" >
        <input name="code" type="text"  id="code" />
        <span class="dot">* &nbsp;&nbsp;</span>ชื่ออุปกรณ์:
        <input name="detail" type="text"  id="detail" />
      หน่วยนับ:
      <input name="unit" type="text" id="unit" /></td>
    </tr>
    <tr>
      <td>รายละเอียด</td>
      <td><label for="note"></label>
      <textarea name="note" id="note" cols="45" rows="5"></textarea></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" align="center"><input name="button" type="submit" class="font2" id="button" value="บันทึกข้อมูล" /></td>
    </tr>
  </table>
</form>

<br />

<?
 


if(trim($_GET['action']) == "ADD"){
	include("../connect.inc");
if($_POST["code"]==''){	

echo "<div class='dot'>กรุณาใส่รหัสอุปกรณ์ด้วยครับ</div>";
echo"<meta http-equiv='refresh' content='2;URL=cms_add.php'>";
//echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"5;URL=..\sm3.php\">";
exit();
}else{
	
	$sqlchk="SELECT * FROM `cms` WHERE code='".$_POST['code']."' ";
	$querychk = mysql_query($sqlchk);
	$row=mysql_num_rows($querychk);
	if($row>0){
		echo "<div class='dot'>รหัส '".$_POST['code']."' มีอยู่ในระบบแล้วครับ กรุณาตรวจสอบ.....</div>";
		echo"<meta http-equiv='refresh' content='2;URL=cms_add.php'>";
		exit();
	}else{
$sql="INSERT INTO `cms` (`code` , `detail` , `unit` , `note` )VALUES ('".$_POST['code']."', '".$_POST['detail']."', '".$_POST['unit']."', '".$_POST['note']."')";
$objQuery = mysql_query($sql) or die (mysql_error());

if($objQuery){
	echo "<div class='font2'>บันทึกข้อมูลเรียบร้อยแล้ว.......</div>";
	echo"<meta http-equiv='refresh' content='2;URL=cms_add.php'>";
	
	}
	}

}	
}
?>

<hr />

<? include("cms_list.php");?>

<br>
</body>
</html>