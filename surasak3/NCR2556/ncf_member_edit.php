<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>
<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
@media print{
#no_print{
	display:none;
	}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 
-->
</style>
<body>


<?
include("connect.inc");


$sel="SELECT * FROM member WHERE member_id='".$_GET['id']."' ";
$querysel=mysql_query($sel);
$arr=mysql_fetch_array($querysel);
?>
<form id="form1" name="form1" method="post" action="?action=edit">
<table border="0" align="center" class="forntsarabun">
  <tr>
    <td colspan="2" align="center">แก้ไขข้อมูลผู้ใช้งาน</td>
  </tr>
  <tr>
    <td>ชื่อผู้ใช้(สำหรับเข้าสู่ระบบ)</td>
    <td>
      <input type="text" name="username" id="username"  class="forntsarabun" value="<?=$arr['username'];?>"/>
    </td>
  </tr>
  <tr>
    <td>รหัสผ่าน </td>
    <td><input type="text" name="password" id="password"  class="forntsarabun" value="<?=$arr['password'];?>"/></td>
  </tr>
  <tr>
    <td>ชื่อ-นามสกุล</td>
    <td><input type="text" name="name" id="name"  class="forntsarabun" value="<?=$arr['name'];?>"/></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="hidden" name="member_id" value="<?=$arr['member_id'];?>" /><input type="submit" name="button" id="button" value="บันทึกการเปลี่ยนแปลง" class="forntsarabun" /></td>
    </tr>
</table>
</form>


<?
if($_GET['action']=='edit'){


$sql="UPDATE member SET username ='".$_POST['username']."' ,
password ='".$_POST['password']."' ,
name ='".$_POST['name']."' WHERE member_id='".$_POST['member_id']."' ";
$query=mysql_query($sql);

if($query){
	echo "<div align='center'>บันทึกข้อมูลเรียบร้อยแล้ว</div>";
	?>
<script language="javascript">
	window.opener.location.reload();
    window.open('','_self');
	self.close();
	</script>
    <?
}

}

?>
</body>
</html>