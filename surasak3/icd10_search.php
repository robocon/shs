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
.txt {	font-family: TH SarabunPSK;
	font-size: 18px;
}
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
</head>

<body>
<p align="center" style="margin-top: 20px;"><strong>ค้นหาข้อมูล ICD10 ในสถานพยาบาล</strong></p>
<div align="center">
  <form method="post" action="icd10_search.php">
    <input type="hidden" name="act" value="show" />
    ค้นหา&nbsp;&nbsp;
	<input name="txtsearch" type="text" class="txt" />
	&nbsp;&nbsp; 
    <input type="submit" value="ดูข้อมูล" name="B1"  class="txt" />
    &nbsp;&nbsp;
    <input type="button" value="ไปเมนูหลัก" name="B2"  class="txt" onclick="window.location='../nindex.htm' " />
  </form>
</div>
<?
if($_POST["act"]=="show"){
$txtsearch=$_POST["txtsearch"];
?>
<hr />
<div align="center" style="margin-top: 20px;"><strong>รายงานแสดงข้อมูลรหัสโรค ICD10</strong></div>
<div align="center"><strong>คำค้น : </strong>
  <?=$txtsearch;?>
</div>
<table width="97%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="5%" align="center" bgcolor="#66CC99"><strong>ลำดับ</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>รหัสโรค</strong></td>
    <td width="32%" align="center" bgcolor="#66CC99"><strong>ชื่อโรคภาษาอังกฤษ</strong></td>
    <td width="34%" align="center" bgcolor="#66CC99"><strong>ชื่อโรคภาษาภาษาไทย</strong></td>
  </tr>
  <?

$sql="select * from icd10  where detail LIKE '%$txtsearch%' OR diag_thai LIKE '%$txtsearch%' OR code LIKE '%$txtsearch%'";
//echo $sql;
$query=mysql_query($sql);
$i=0;
if(mysql_num_rows($query) < 1){
?>
  <tr>
    <td align="center" colspan="4" style="color:#FF0000;">--------------------------------------------------------- ไม่พบข้อมูล ---------------------------------------------------------</td>
  </tr>
<?
}else{
while($rows=mysql_fetch_array($query)){
$i++;
?>
  <tr>
    <td align="center"><?=$i;?></td>
    <td align="left"><?=$rows["code"]?></td>
    <td align="left"><?=$rows["detail"]?></td>
    <td align="left"><?=$rows["diag_thai"]?></td>
  </tr>
  <?
	}
}
?>  
</table>

<?
}
?>
</body>
</html>
