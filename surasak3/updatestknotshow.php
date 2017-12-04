<?
include("connect.inc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 16px;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
.style1 {color: #FF0000}
.style2 {
	color: #0000FF;
	font-weight: bold;
}
-->
</style></head>

<body>
<?
if($_POST["act"]=="edit"){
$edit="update stktranx set getdate='$_POST[getdate]' WHERE row_id =  '$_POST[row_id]'";
if(mysql_query($edit)){
	echo "<script>alert('แก้ไขข้อมูลเรียบร้อยแล้ว');window.location='editstknotshow.php';</script>";									
}else{
	echo "<script>alert('ผิดพลาด แก้ไขข้อมูลไม่สำเร็จ');window.location='updatestknotshow.php?id=$_POST[row_id]';</script>";	
}

}

$getid=$_GET["id"];
$sql="SELECT  * FROM  `stktranx` WHERE `row_id` =  '$getid'";
$query=mysql_query($sql);
$rows=mysql_fetch_array($query);
?>
<form action="" method="post" name="form2">
<input name="act" type="hidden" value="edit" />
<input name="row_id" type="hidden" value="<?=$rows["row_id"];?>" />
  <table width="100%" border="0">
    <tr>
      <td height="29" colspan="2" align="left"><span class="style2">แก้ไขข้อมูลวันที่ เพื่อให้ข้อมูลยาแสดงในรายงาน ร.พ.5 ประจำเดือน</span></td>
    </tr>
    <tr>
      <td align="right"><strong>Date : </strong></td>
      <td align="left"><?=$rows["date"];?></td>
    </tr>
    <tr>
      <td width="12%" align="right"><strong>รหัสยา : </strong></td>
      <td width="88%" align="left"><?=$rows["drugcode"];?></td>
    </tr>
    <tr>
      <td align="right"><strong>ชื่อยา : </strong></td>
      <td align="left"><?=$rows["tradname"];?></td>
    </tr>
    <tr>
      <td align="right"><strong>Lot No. : </strong></td>
      <td align="left"><?=$rows["lotno"];?></td>
    </tr>
    <tr>
      <td align="right"><strong>Bill No. : </strong></td>
      <td align="left"><?=$rows["billno"];?></td>
    </tr>
    <tr>
      <td align="right"><strong>จำนวน : </strong></td>
      <td align="left"><?=$rows["amount"];?></td>
    </tr>
    <tr>
      <td align="right"><strong>Getdate : </strong></td>
      <td align="left"><strong>
        <label>
        <input type="text" name="getdate" id="getdate" value="<?=$rows["getdate"];?>" style="font-family:'TH SarabunPSK'; font-size:16px; background-color: #FFCC99;" />
        </label>
        <span class="style1">*** แก้ไขตรงนี้        </span></strong></td>
    </tr>
    <tr>
      <td height="57" align="right">&nbsp;</td>
      <td align="left"><input type="submit" name="button" id="button" value="แก้ไขข้อมูล"  style="font-family:'TH SarabunPSK'; font-size:16px;" />&nbsp;&nbsp;<A HREF="../nindex.htm" class="fontsara1">&lt;&lt; ไปเมนู</A></td>
    </tr>
  </table>
</form>
</body>
</html>
