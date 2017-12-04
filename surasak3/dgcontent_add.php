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
<form action="" name="frmAdd" method="post">
<table width="267" border="1" class="font1">
  <tr>
    <th width="91"> <div align="center">รหัสสารบัญ</div></th>
    <th width="160"> <div align="center">ชื่อสารบัญ</div></th>
    </tr>
  <tr>
    <td><div align="center"><input name="page" type="text" class="font1" size="10"></div></td>
    <td><input name="title" type="text" class="font1" size="60"></td>
    </tr>
  <tr>
    <td colspan="2" align="center"><input name="submit" type="submit" class="font1" value="บันทึก"></td>
    </tr>
  </table>
</form>

<? 
if(isset($_POST['submit'])){
	
 include("connect.inc");
 
$strSQL = "INSERT INTO content ";
$strSQL .="(page,title) ";
$strSQL .="VALUES ";
$strSQL .="('".$_POST["page"]."','".$_POST["title"]."') ";
$objQuery = mysql_query($strSQL);

if($objQuery){
		
echo "<h2 class='font1'>บันทึกข้อมูลเรียบร้อยแล้ว</h2></center>";
echo "<meta http-equiv='refresh' content='1; url=dgcontent.php'>" ;	
	}
	
}
?>
</body>
</html>