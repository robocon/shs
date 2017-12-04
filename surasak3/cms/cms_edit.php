

<html>
<head>
<title>แก้ไขข้อมูลอุปกรณ์</title>
</head>
<style>
.font{
	font-family:"Angsana New";
	color:#FFF;
	font-size:16pt;
}
.font2{
	font-family:"Angsana New";
	font-size:16pt;
}
</style>
<body>
<h1 class="font2">แก้ไขข้อมูลอุปกรณ์ </h1>
<?

include("../connect.inc");

$strSQL = "SELECT * FROM  cms WHERE row_id = '".$_GET["row_id"]."' ";
$objQuery = mysql_query($strSQL);
$objResult = mysql_fetch_array($objQuery);
if($objResult){
?>
<form action="cms_edit.php?action=edit" name="frmEdit" method="post">

  <table border="0"  class="font2">
   
    <tr>
      <td width="119">รหัสอุปกรณ์</td>
      <td width="457">
      <input name="code" type="text"  id="code"  value="<?=$objResult["code"];?>" readonly/>
      <span class="dot">*</span></td>
    </tr>
    <tr>
      <td>ชื่ออุปกรณ์</td>
      <td><input name="detail" type="text"  id="detail"  value="<?=$objResult["detail"];?>"/></td>
    </tr>
    <tr>
      <td>หน่วยนับ</td>
      <td><input name="unit" type="text"  id="unit"  value="<?=$objResult["unit"];?>"/></td>
    </tr>
    <tr>
      <td>รายละเอียด</td>
      <td><label for="note"></label>
      <textarea name="note" id="note" cols="45" rows="5"><?=$objResult["note"];?></textarea></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input name="button" type="submit" class="font2" id="button" value="บันทึกข้อมูล" /><input type="hidden" name="row_id"  style="font-size:24px" value="<?=$objResult["row_id"];?>"></td>
    </tr>
  </table>
</form>
  <?
  }
 
if($_GET['action']=='edit'){
	 
$strSQL1 = "UPDATE `cms` SET `code` = '".$_POST['code']."',
`detail` = '".$_POST['detail']."',
`unit` = '".$_POST['unit']."',
`note` = '".$_POST['note']."'   WHERE `row_id` = '".$_POST['row_id']."' ";
$objQuery1 = mysql_query($strSQL1);

if($objQuery1)
{
	echo "Save Done.";
?>
<script>
window.opener.location.reload();
window.open('','_self');
setTimeout("self.close()",2000);
</script>	
<?
}
else
{
	echo "Error Save [".$strSQL1."]";
}	 
 }
  ?>

</body>
</html>