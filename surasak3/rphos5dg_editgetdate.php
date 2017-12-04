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
<p align="center"><strong>แก้ไขวันที่รายงาน รพ.5 ประจำเดือน</strong></p>
<form name="form1" action="<? $_SERVER['PHP_SELF']?>" method="post">
<input name="act" type="hidden" value="search" />
<p align="center"><label>รหัสยา : </label>
<input name="drugcode" type="text" />
<span class="font1">
<font face="Angsana New">
เดือน 
</font>
</span>
<span class="font1">
<font face="Angsana New">
ปี
</font>
</span>
<?
$Y=date("Y")+543;
$date=date("Y")+543+5;
			  
$dates=range(2547,$date);
echo "<select name='year' class='forntsarabun'>";
foreach($dates as $i){
?>
	<option value='<?=$i-543; ?>' <? if($Y==$i){ echo "selected"; }?>>
	<?=$i;?>
	</option>
<?
}
echo "<select>";
?>
</p>
 <p align="center"><input name="submit" type="submit" value="ค้นหาข้อมูล" />
 </p>
</form>
<?
if($_POST["act"]=="search"){
$chkdate=$_POST["year"];
$drugcode=$_POST["drugcode"];
?>
<table width="100%" border="1" cellpadding="2" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="4%" align="center" bgcolor="#66CC99"><strong>ลำดับ</strong></td>
    <td width="8%" align="center" bgcolor="#66CC99"><strong>วัน/เดือน/ปี</strong></td>
    <td width="8%" align="center" bgcolor="#66CC99"><strong>วัน/เดือน/ปี</strong></td>
    <td width="11%" align="center" bgcolor="#66CC99"><strong>ที่เอกสาร</strong></td>
    <td width="9%" align="center" bgcolor="#66CC99"><strong>เลขที่รับ<br />
    ลำดับคลัง</strong></td>
    <td width="15%" align="center" bgcolor="#66CC99"><strong>รหัสยา</strong></td>
    <td width="22%" align="center" bgcolor="#66CC99"><strong>รายละเอียด</strong></td>
    <td width="9%" align="right" bgcolor="#66CC99"><strong>ราคา/หน่วย</strong></td>
    <td width="6%" align="right" bgcolor="#66CC99"><strong>รับ</strong></td>
    <td width="7%" align="right" bgcolor="#66CC99"><strong>จ่าย</strong></td>
    <td width="9%" align="right" bgcolor="#66CC99"><strong>คงเหลือ</strong></td>
  </tr>
 <?
 $sql = "SELECT * FROM stktranx WHERE active !='N' and drugcode ='".$drugcode."' and getdate like '$chkdate%' order by getdate asc";
$result = mysql_query($sql) or die("Query failed");
$num=mysql_num_rows($result);
$i=0;
while($rows = mysql_fetch_array($result)){
$i++;

	$result1 = "select stkno from combill where billno = '$rows[billno]'";
	$row1 = mysql_query($result1);
	list($stkno)=mysql_fetch_array($row1);	
 ?>
  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$rows["date"];?></td>
    <td><a href="rphos5dg_editgetdate1.php?getid=<?=$rows["row_id"];?>" target="_blank"><?=$rows["getdate"];?></a></td>
    <td align="center"><?=$rows["billno"];?></td>
    <td align="center"><?=$stkno;?></td>
    <td><?=$rows["drugcode"];?></td>
    <td><?=$rows["department"];?></td>
    <td align="right"><?=$rows["unitpri"];?></td>
    <td align="right"><? if($rows["stkcut"]==0){ echo $rows["amount"];}else{ echo "-";}?></td>
    <td align="right"><? if($rows["stkcut"]!=0){ echo $rows["stkcut"];}else{ echo "-";}?></td>
    <td align="right"><?=$rows["netlotno"];?></td>
  </tr>
<?
}
?>  
</table>

<?
}
?>

<?
if($_GET["act"]=="edit"){
$getid=$_GET["getid"];
 $sql = "SELECT * FROM stktranx WHERE row_id ='".$getid."' ";
$result = mysql_query($sql) or die("Query failed");
$rows = mysql_fetch_array($result);
?>
<hr />
<form action="rphos5dg_editgetdate.php" method="post" name="form1">
<input name="act" type="hidden" value="edit" />
<input name="row_id" type="hidden" value="<?=$getid;?>" />
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
      <input name="drugcode" type="text" class="inputtext" id="drugcode" value="<?=$rows["drugcode"];?>" />
    </label></td>
  </tr>
  <tr>
    <td width="42%" align="right"><strong>ชื่อยา : </strong></td>
    <td width="1%">&nbsp;</td>
    <td width="57%"><label>
      <input name="tradname" type="text" class="inputtext" id="tradname" value="<?=$rows["tradname"];?>" size="40"  />
    </label></td>
  </tr>
  <tr>
    <td align="right"><strong>ราคา/หน่วย : </strong></td>
    <td>&nbsp;</td>
    <td><label>
      <input name="unitprice" type="text" class="inputtext" id="unitprice" value="<?=$rows["unitpri"];?>"  />
    </label></td>
  </tr>
  <tr>
    <td align="right"><strong>จำนวน : </strong></td>
    <td>&nbsp;</td>
    <td><label>
      <input name="num" type="text" class="inputtext" id="num" value="<?=$rows["netlotno"];?>"  />
    </label></td>
  </tr>
  <tr>
    <td align="right"><strong>ราคารวม :</strong></td>
    <td>&nbsp;</td>
    <td><label>
      <input name="price" type="text" class="inputtext" id="price" value="<?=$price;?>"  />
    </label></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td><label>
      <input name="button" type="submit" class="inputtext" id="button" value="ตั้งต้นข้อมูล" />
    </label></td>
  </tr>
</table>
</form>
<?
}
?>
</body>
</html>
