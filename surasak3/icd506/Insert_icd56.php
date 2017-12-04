
<html>
<head>
<title>บันทึก icd506</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874"></head>

<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 20px;
}
-->
</style>
<body>
<h1 class="forntsarabun">บันทึกแบบ รง.506 </h1>
<form action="Insert_icd56.php?do=add" name="frmAdd" method="post">
<table border="1" class="forntsarabun">
  <tr>
    <th > <div align="center">icd10</div></th>
    <th > <div align="center">โรค</div></th>
    <th > <div align="center">รหัสโรค</div></th>
    </tr>
  <tr>
	<td><div align="center">
	  <input name="txticd10" type="text" class="forntsarabun" id="txticd10" size="15">
	</div></td>
	<td><input name="txtdepart" type="text" class="forntsarabun" id="txtdepart" size="30"></td>
	<td><input name="txtcode" type="text" class="forntsarabun" id="txtcode" size="10"></td>
	</tr>
</table>
<input type="submit" name="btnAdd" id="btnAdd" value="Add" class="forntsarabun"> 
<br><br>

</form>
<?  include("Connections/connect.inc.php"); 

if($_REQUEST['do']=='add'){
	
	if($_POST["txtdepart"] !=''){
	$strSQL = "INSERT INTO icd506 ";
	$strSQL .="(icd10,depart,code)";
	$strSQL .="VALUES ";
	$strSQL .="('".$_POST["txticd10"]."','".$_POST["txtdepart"]."','".$_POST["txtcode"]."') ";
	$objQuery = mysql_query($strSQL);
	}

	if($objQuery){
	echo "<meta http-equiv='refresh' content='0; url=Insert_icd56.php'>" ;	
	}else{
	echo "ERROR";
	echo "<meta http-equiv='refresh' content='0; url=Insert_icd56.php'>" ;	
}
}

$strSQL = "SELECT * FROM icd506 Order by code asc";
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");


?>

<?
if($_REQUEST['do']=='frmEdit'){
	
	$sql="select * from icd506 where row_id='".$_REQUEST['row_id']."' ";
	$result=mysql_query($sql);
	$dbarr=mysql_fetch_array($result);
?>	
<form action="Insert_icd56.php?do=Edit" name="frmEdit" method="post">
<table border="1" class="forntsarabun">
  <tr>
    <th > <div align="center">icd10</div></th>
    <th > <div align="center">โรค</div></th>
    <th > <div align="center">รหัสโรค</div></th>
    </tr>
  <tr>
	<td><div align="center">
	  <input name="txticd10" type="text" class="forntsarabun" id="txticd10" size="15" value="<?=$dbarr['icd10'];?>">
	</div></td>
	<td><input name="txtdepart" type="text" class="forntsarabun" id="txtdepart" size="30" value="<?=$dbarr['depart'];?>"></td>
	<td><input name="txtcode" type="text" class="forntsarabun" id="txtcode" size="10" value="<?=$dbarr['code'];?>"></td>
	</tr>
</table>
<input type="hidden" name="row_id" value="<?=$_REQUEST['row_id'];?>">
<input type="submit" name="btnEdit" id="btnEdit" value="edit" class="forntsarabun"> 
<br><br>

</form>
<?
}elseif($_REQUEST['do']=='Edit'){
	
	
$strSQL = "UPDATE icd506 SET ";
$strSQL .="icd10 = '".$_POST["txticd10"]."' ";
$strSQL .=",depart = '".$_POST["txtdepart"]."' ";
$strSQL .=",code = '".$_POST["txtcode"]."' ";
$strSQL .="WHERE row_id = '".$_POST["row_id"]."' ";
$objQuery = mysql_query($strSQL);
if($objQuery)
{
	echo "Save Done.";
	echo "<meta http-equiv='refresh' content='0; url=Insert_icd56.php'>" ;
}
else
{
	echo "Error Save [".$strSQL."]";
	echo "<meta http-equiv='refresh' content='5; url=Insert_icd56.php'>" ;
}
}elseif($_REQUEST['do']=='del'){
				  
$strSQL = "DELETE FROM icd506 ";
$strSQL .="WHERE row_id = '".$_GET["row_id"]."' ";
$objQuery = mysql_query($strSQL);
if($objQuery)
{
	echo "Record Deleted.";
	echo "<meta http-equiv='refresh' content='0; url=Insert_icd56.php'>" ;
}
else
{
	echo "Error Delete [".$strSQL."]";
	echo "<meta http-equiv='refresh' content='0; url=Insert_icd56.php'>" ;
}				  
}
?>

<table border="1">
  <tr bgcolor=#ffff99 onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''" class="forntsarabun">
    <th bgcolor="#FF99CC"> <div align="center">icd10</div></th>
    <th bgcolor="#FF99CC"> <div align="center">โรค</div></th>
    <th bgcolor="#FF99CC"> <div align="center">รหัสโรค</div></th>
    <th bgcolor="#FF99CC">แก้ไข</th>
    <th bgcolor="#FF99CC">ลบ</th>
  </tr>
<?
while($objResult = mysql_fetch_array($objQuery))
{
?>
  <tr onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''" class="forntsarabun">
    <td><div align="center"><?=$objResult["icd10"];?></div></td>
    <td><?=$objResult["depart"];?></td>
    <td><?=$objResult["code"];?></td>
    <td align="center" valign="middle"><a href="Insert_icd56.php?do=frmEdit&&row_id=<?=$objResult["row_id"];?>"><img src="edit.gif" alt="แก้ไข" width="16" height="16" border="0"></a></td>
    <td align="center" valign="middle"><a href="?do=del&&row_id=<?=$objResult["row_id"];?>" onclick="return confirm('ยืนยันการลบข้อมูล\nรหัสโรค :: <?=$objResult["icd10"];?>\nชื่อโรค :: <?=$objResult["depart"];?>')" class="forntsarabun"><img src="del.gif" width="16" height="16" alt="ลบ" border="0"></a></td>
  </tr>
<?
}
?>
</table>
</body>
</html>