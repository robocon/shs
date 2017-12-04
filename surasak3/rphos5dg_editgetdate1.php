<?php
    include("connect.inc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>แก้ไขวันที่รายงาน รพ.5</title>
</head>
<body>
<p align="center"><strong>แก้ไขวันที่รายงาน รพ.5</strong></p>
<?
$getid=$_GET["getid"];
$sql = "SELECT * FROM stktranx WHERE row_id ='".$getid."' ";
$result = mysql_query($sql) or die("Query failed");
$rows = mysql_fetch_array($result);
?>
<hr />
<form action="rphos5dg_editgetdate1.php" method="post" name="form1">
<input name="act" type="hidden" value="edit" />
<input name="row_id" type="hidden" value="<?=$getid;?>" />
<input name="drugcode" type="hidden" value="<?=$rows["drugcode"];?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="3">
  <tr>
    <td align="right"><strong>วัน/เดือน/ปี : </strong></td>
    <td>&nbsp;</td>
    <td><input name="getdate" type="text" class="inputtext" id="getdate" value="<?=$rows["getdate"];?>" /></td>
  </tr>
  <tr>
    <td align="right"><strong>รหัสยา :</strong></td>
    <td>&nbsp;</td>
    <td><label>
      <?=$rows["drugcode"];?>
    </label></td>
  </tr>
  <tr>
    <td width="42%" align="right"><strong>ชื่อยา : </strong></td>
    <td width="1%">&nbsp;</td>
    <td width="57%"><label>
      <?=$rows["tradname"];?>
    </label></td>
  </tr>
  <tr>
    <td align="right"><strong>ราคา/หน่วย : </strong></td>
    <td>&nbsp;</td>
    <td><label>
      <?=$rows["unitpri"];?>
    </label></td>
  </tr>
  <tr>
    <td align="right"><strong><? if($rows["stkcut"]==0){ echo "รับ : 	";}else{ echo "จ่าย : 	";}?></strong></td>
    <td>&nbsp;</td>
    <td><label>
    <?
	if($rows["stkcut"]==0){
	?>
      <?=$rows["amount"];?>
    <?
    }else{
	?>
      <?=$rows["stkcut"];?>
    <?
    }
	?>    
    </label></td>
  </tr>
  <tr>
    <td align="right"><strong>คงเหลือ :</strong></td>
    <td>&nbsp;</td>
    <td><label>
      <?=$rows["netlotno"];?>
    </label></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td><label>
      <input name="button" type="submit" class="inputtext" id="button" value="แก้ไขข้อมูล" />
    </label></td>
  </tr>
</table>
</form>
<?
if($_POST["act"]=="edit"){
$rowid=$_POST["row_id"];
$getdate=$_POST["getdate"];
$drugcode=$_POST["drugcode"];
		$edit="update stktranx set getdate='$getdate' where row_id='$rowid'";
		if(mysql_query($edit)){ 
			echo "<script>alert('แก้ไขวันที่รหัสยา : $drugcode เสร็จแล้ว');</script>";
			echo "<script>window.opener.location.reload();</script>";
			echo "<script>window.close();</script>";
		}	
}			
?>
</body>
</html>
