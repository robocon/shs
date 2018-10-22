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
<p align="center" style="margin-top: 20px;"><strong>ค้นหาข้อมูลหัตถการ icd9cm ในสถานพยาบาล</strong></p>
<div align="center">
  <form method="post" action="icd9cm_search.php">
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
<div align="center" style="margin-top: 20px;"><strong>รายงานแสดงข้อมูลรหัสหัตถการ icd9cm</strong></div>
<div align="center"><strong>คำค้น : </strong>
  <?=$txtsearch;?>
</div>
<table width="97%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="5%" align="center" bgcolor="#66CC99"><strong>ลำดับ</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>รหัส ICD9CM</strong></td>
    <td width="32%" align="center" bgcolor="#66CC99"><strong>รายละเอียด</strong></td>
  </tr>
  <?

$sql="select * from icd9cm  where detail LIKE '%$txtsearch%' OR code LIKE '%$txtsearch%'";
//echo $sql;
$query=mysql_query($sql);
$i=0;
if(mysql_num_rows($query) < 1){
?>
  <tr>
    <td align="center" colspan="3" style="color:#FF0000;">--------------------------------------------------------- ไม่พบข้อมูล ---------------------------------------------------------</td>
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
