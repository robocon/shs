

<html>
<head>
<title>อัพเดทสถานะ คำนำหน้า</title>
</head>
<body>

<script language="JavaScript">
	function ClickCheckAll(vol)
	{
	
		var i=1;
		for(i=1;i<=document.frmMain.hdnCount.value;i++)
		{
			if(vol.checked == true)
			{
				eval("document.frmMain.chkDel"+i+".checked=true");
			}
			else
			{
				eval("document.frmMain.chkDel"+i+".checked=false");
			}
		}
	}
	function ClickCheckAll2(vol)
	{
	
		var i=1;
		for(i=1;i<=document.frmMain2.hdnCount2.value;i++)
		{
			if(vol.checked == true)
			{
				eval("document.frmMain2.chkDel2"+i+".checked=true");
			}
			else
			{
				eval("document.frmMain2.chkDel2"+i+".checked=false");
			}
		}
	}

	function onDelete()
	{
		if(confirm('คุณต้องการปิดใช้งาน ?')==true)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function onDelete2()
	{
		if(confirm('คุณต้องการ เปิดใช้งาน ?')==true)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
</script>

<?
   include("connect.inc");
$strSQL = "SELECT * FROM  prename  WHERE status='Y' ";
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
?>
<table  border="0" align="center" cellpadding="3" cellspacing="3">
  <tr>
    <td colspan="2" valign="top"><a href="../nindex.htm"><---ไปเมนู</a></td>
  </tr>
  <tr>
    <td valign="top">
 <form name="frmMain" action="?action=N" method="post" OnSubmit="return onDelete();">
    
    <h3 align="center">คำนำหน้า ที่เปิดใช้</h3>
<table border="1" align="center" style="border-collapse:collapse; border-color:#000" cellpadding="0" cellspacing="0">
  <tr>
    <th> <div align="center">รหัส </div></th>
    <th> <div align="center">ตัวย่อ </div></th>
    <th> <div align="center">ชื่อเต็ม </div></th>
    <th>  <div align="center">ทั้งหมด
      <input name="CheckAll" type="checkbox" id="CheckAll" value="Y" onClick="ClickCheckAll(this);">
    </div></th>
  </tr>
<?
$i=0;
while($objResult = mysql_fetch_array($objQuery))
{
$i++;

if($i%2==0)
{
$bg = "#CCCCCC";
}
else
{
$bg = "#FFFFFF";
}
?>
<tr bgcolor="<?=$bg;?>">
    <td><div align="center"><?=$objResult["code"];?></div></td>
    <td><?=$objResult["detail1"];?></td>
    <td><?=$objResult["detail2"];?></td>
    <td align="center"><input type="checkbox" name="chkDel[]"  id="chkDel<?=$i;?>" value="<?=$objResult["code"];?>"></td>
  </tr>
<?
}
?>
</table>
<input type="hidden" name="hdnCount" value="<?=$i;?>">
<div align="center"><input type="submit" name="btnDelete" value="ปิดการใช้งาน"></div>

</form>
</td>
<td valign="top">
<?

$strSQL2 = "SELECT * FROM  prename  WHERE status='N' ";
$objQuery2 = mysql_query($strSQL2) or die ("Error Query [".$strSQL2."]");
?>

 <form name="frmMain2" action="?action=Y" method="post" OnSubmit="return onDelete2();">
<h3 align="center">คำนำหน้า ไม่ได้ใช้</h3>
<table border="1" align="center" style="border-collapse:collapse; border-color:#000" cellpadding="0" cellspacing="0">
  <tr>
    <th> <div align="center">รหัส </div></th>
    <th> <div align="center">ตัวย่อ </div></th>
    <th> <div align="center">ชื่อเต็ม </div></th>
    <th>  <div align="center">ทั้งหมด
      <input name="CheckAll2" type="checkbox" id="CheckAll2" value="Y" onClick="ClickCheckAll2(this);">
    </div></th>
  </tr>
<?
$i2=0;
while($objResult2 = mysql_fetch_array($objQuery2))
{
$i2++;

if($i2%2==0)
{
$bg2 = "#CCCCCC";
}
else
{
$bg2 = "#FFFFFF";
}
?>
<tr bgcolor="<?=$bg2;?>">
    <td><div align="center"><?=$objResult2["code"];?></div></td>
    <td><?=$objResult2["detail1"];?></td>
    <td><?=$objResult2["detail2"];?></td>
    <td align="center"><input type="checkbox" name="chkDel2[]"  id="chkDel2<?=$i2;?>" value="<?=$objResult2["code"];?>"></td>
  </tr>
<?
}
?>
</table>
<input type="hidden" name="hdnCount2" value="<?=$i2;?>">
<div align="center"><input type="submit" name="btnDelete2" value="เปิดการใช้งาน"></div></form></td>
  </tr>
</table>



<?

if($_GET['action']=="N"){
	
	
	for($i=0;$i<count($_POST["chkDel"]);$i++)
	{
		if($_POST["chkDel"][$i] != "")
		{
			$strSQL = "UPDATE  prename  SET status='N' ";
			$strSQL .="WHERE code = '".$_POST["chkDel"][$i]."' ";
			$objQuery = mysql_query($strSQL)or die (mysql_error());
			if($objQuery){
			echo "<META HTTP-EQUIV='Refresh'  CONTENT='1;URL=update_pername.php'>";
			}
		}
	}

}elseif($_GET['action']=="Y"){
	
	
	for($i=0;$i<count($_POST["chkDel2"]);$i++)
	{
		if($_POST["chkDel2"][$i] != "")
		{
			$strSQL = "UPDATE  prename  SET status='Y' ";
			$strSQL .="WHERE code = '".$_POST["chkDel2"][$i]."' ";
			$objQuery = mysql_query($strSQL)or die (mysql_error());
			if($objQuery){
			echo "<META HTTP-EQUIV='Refresh'  CONTENT='1;URL=update_pername.php'>";
			}
		}
	}

	
}

?>

</body>
</html>