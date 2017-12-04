<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>ดาวน์โหลดเอกสาร</title>
</head>
<style type="text/css">
<!--
@import url("style11.css");
-->
</style>
<body>
<?php

include("connect.inc");

if($_GET["type"]=="องค์ความรู้ทางทหาร"){
$sql=mysql_query("select * from kmcounter where name='read1'");
$result=mysql_fetch_array($sql);
$counter=$result["runno"]+1;
$add=mysql_query("update kmcounter set runno='$counter' where row_id='".$result["row_id"]."'");
}

if($_GET["type"]=="องค์ความรู้ด้านวิชาชีพ"){
$sql=mysql_query("select * from kmcounter where name='read2'");
$result=mysql_fetch_array($sql);
$counter=$result["runno"]+1;
$add=mysql_query("update kmcounter set runno='$counter' where row_id='".$result["row_id"]."'");
}

if($_GET["type"]=="องค์ความรู้แนวทางในการปฏิบัติทาง"){
$sql=mysql_query("select * from kmcounter where name='read3'");
$result=mysql_fetch_array($sql);
$counter=$result["runno"]+1;
$add=mysql_query("update kmcounter set runno='$counter' where row_id='".$result["row_id"]."'");
}

if($_GET["type"]=="องค์ความรู้บทเรียนจากการปฏิบัติงาน/การรบ"){
$sql=mysql_query("select * from kmcounter where name='read4'");
$result=mysql_fetch_array($sql);
$counter=$result["runno"]+1;
$add=mysql_query("update kmcounter set runno='$counter' where row_id='".$result["row_id"]."'");
}

if($_GET["type"]=="องค์ความรู้ภูมิปัญญา"){
$sql=mysql_query("select * from kmcounter where name='read5'");
$result=mysql_fetch_array($sql);
$counter=$result["runno"]+1;
$add=mysql_query("update kmcounter set runno='$counter' where row_id='".$result["row_id"]."'");
}

if($_GET["type"]=="องค์ความรู้อื่นๆ"){
$sql=mysql_query("select * from kmcounter where name='read6'");
$result=mysql_fetch_array($sql);
$counter=$result["runno"]+1;
$add=mysql_query("update kmcounter set runno='$counter' where row_id='".$result["row_id"]."'");
}

$strSQL = "SELECT * FROM km  WHERE doc_id='".$_GET['doc_id']."'";
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
$objResult= mysql_fetch_array($objQuery);



$strSQL1 = "SELECT * FROM km_file  WHERE doc_id='".$_GET['doc_id']."' order by file_name asc";
$objQuery1 = mysql_query($strSQL1) or die ("Error Query [".$strSQL1."]");


$rows=mysql_num_rows($objQuery1);

if($rows){
?>
<table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000"  style="border-collapse:collapse" class="forntsarabun">
  <tr>
    <td colspan="2" align="center" bgcolor="#b9c9fe">ดาวน์โหลดเอกสาร</td>
  </tr>
  
<tr  onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
    <td>ชื่อเอกสาร</td>
    <td><?=$objResult['doc_name']?></td>
  </tr>
  
  <?
  $i=1;
  while($objResult1 = mysql_fetch_array($objQuery1)){
	  
	  
	  $dri1=substr($objResult['doc_date'],0,4)+543;

		if($objResult1['name_thai']==""){
			
			$name=$objResult1['file_name'];
		}else{
			$name=$objResult1['name_thai'];
		}
/////////////
		$structure = 'km_file/';
  ?>
  <tr  onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
    <td>ไฟล์แนบ <?=$i;?></td>
    <td><a href="<?=$structure.'/'.$objResult1['file_name'];?>" target="_blank"><?=$name;?></a></td>
  </tr>
  <? 
  $i++;
  } ?>
  <tr  onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
    <td>ประเภท</td>
    <td><?=$objResult['type']?></td>
  </tr>
  <tr  onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
    <td>ชื่อทีม</td>
    <td><?=$objResult['depart']?></td>
  </tr>
  <tr  onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
    <td>วันที่</td>
    <td><?=$objResult['doc_date']?></td>
  </tr>
</table>
<? }else{
	
	echo "ไม่มีไฟล์";
}
?>
<br />
<div align="center"><input name="btnButton" type="button" class="forntsarabun" onClick="JavaScript:window.close();" value="ปิดหน้าต่าง"></div>
</body>
</html>