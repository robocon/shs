<? session_start(); ?>
<html>
<head>
<title>เพิ่มข้อมูลสารบัญยา</title>
</head>
<style>
.font1{
	font-family:"TH SarabunPSK";
	font-size:18pt;
}
.font2{
	font-family:"TH SarabunPSK";
	font-size:16pt;
}
</style>
<body>

<? 
 include("connect.inc");
$sql="SELECT * FROM `content` WHERE page ='".$_GET['cPage']."'  ";
$query=mysql_query($sql) or die (mysql_error());
$dbarr=mysql_fetch_array($query);
?>
<h1 class="font1">แก้ไขสารบัญยา</h1>
<form action="" name="frmAdd" method="post">
<table width="267" border="1" class="font1">
  <tr>
    <th width="91"> <div align="center">รหัสสารบัญ</div></th>
    <th width="160"> <div align="center">ชื่อสารบัญ</div></th>
    </tr>
  <tr>
    <td><div align="center"><input name="page" type="text" class="font1" size="10" value="<?=$dbarr['page'];?>"></div></td>
    <td><input name="title" type="text" class="font1" size="60" value="<?=$dbarr['title'];?>"></td>
    </tr>
  <tr>
    <td colspan="2" align="center">
    <input type="hidden" name="id" value="<?=$dbarr['row_id'];?>">
    <input name="submit" type="submit" class="font1" value="บันทึกแก้ไข"></td>
    </tr>
  </table>
</form>

<?
if(isset($_POST['submit'])){
	
	$update="UPDATE content SET page='".$_POST['page']."' , title='".$_POST['title']."' WHERE row_id='".$_POST['id']."' ";
	$query2=mysql_query($update) or die (mysql_error());
	
	
	if($query2){
		
echo "<h2 class='font1'>แก้ไขข้อมูลเรียบร้อยแล้ว</h2></center>";
echo "<meta http-equiv='refresh' content='2; url=dgcontent.php'>" ;	
	}
}

 ?>
</body>
</html>