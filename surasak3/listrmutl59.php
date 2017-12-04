<?
session_start();
include("connect.inc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style5 {font-family: "TH SarabunPSK"; font-size: 18px; font-weight: bold; }
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
</head>
<body>
<?
if($_POST["act"]=="add"){	
	for($i=1;$i<=$_POST["hdnLine"];$i++)
	{
		if($_POST["HN$i"] != "")
		{
			$hn=$_POST["HN$i"];
			$active=$_POST["active$i"];
			$add="update opcardchk set active='$active' where HN='$hn';";
			//echo $add."<br>";
			mysql_query($add);
		}
	}
	echo "<script>alert('บันทึกข้อมูลเรียบร้อยครับ');</script>";
}
?>
<p align="center"><strong>รายชื่อนักศึกษาราชมงคล59 ที่นำเข้าระบบทั้งหมด</strong></p>
<form name="form1" action="<? $PHP_SELF;?>" method="post">
<input type="hidden" name="act" value="add" />
<table width="90%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="2%" align="center" bgcolor="#66CC99"><span class="style5">ลำดับ</span></td>
    <td width="5%" align="center" bgcolor="#66CC99"><span class="style5">HN</span></td>
    <td width="10%" align="center" bgcolor="#66CC99"><span class="style5">รหัสนักศึกษา</span></td>
    <td width="19%" align="center" bgcolor="#66CC99"><span class="style5">ชื่อ - นามสกุล</span></td>
    <td width="17%" align="center" bgcolor="#66CC99"><span class="style5">กลุ่ม</span></td>
    <td width="28%" align="center" bgcolor="#66CC99"><span class="style5">สาขา</span></td>
    <td width="14%" align="center" bgcolor="#66CC99">วันที่ตรวจ</td>
    <td width="6%" align="center" bgcolor="#66CC99" class="style5">มีผล LAB</td>
  </tr>
<?
$sql="select * from opcardchk where part='ราชมงคล59' order by row asc";
//echo $sql;
$query=mysql_query($sql);
$num=mysql_num_rows($query);
$i=0;
while($rows=mysql_fetch_array($query)){
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
    <td align="center"><?=$i;?></td>
    <td><input name="HN<?=$i;?>" type="hidden" value="<?=$rows["HN"];?>" /><?=$rows["HN"];?></td>
    <td><?=$rows["pid"];?></td>
    <td><?=$rows["name"];?></td>
    <td><?=$rows["course"];?></td>
    <td><?=$rows["branch"];?></td>
    <td><?=$rows["datechkup"];?></td>
    <td align="center"><input name="active<?=$i;?>" type="checkbox" value="y" <? if($rows["active"]=="y"){ echo "checked='checked'"; } ?> /></td>
  </tr>
<?
}
?>  
</table>
<input type="hidden" name="hdnLine" value="<?=$num;?>" />
<p align="center"><input name="submit" type="submit" value="บันทึกข้อมูล" /></p>
</form>
</body>
</html>