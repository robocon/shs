<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>

<link href="sm3_style.css" rel="stylesheet" type="text/css" />
</head>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
window.open(theURL,winName,features);
}
//-->
</script>
<body>
<form id="form1" name="form1" method="post" action="">
  <table width="70%" border="0" align="center">
    <tr>
      <td colspan="2" align="center">ประวัติการับยากลับบ้าน </td>
    </tr>
    <tr>
      <td align="right">ระบุ HN :</td>
      <td><input type="text" name="hn" id="hn" class="fontsara1" /></td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td><input name="button" type="submit" class="fontsara1" id="button" value="ตกลง" /> <a  class="fontsara" target="_top" href="../nindex.htm">&lt;&lt;ไปเมนู</a></td>
    </tr>
  </table>
</form>

<? 

if(isset($_POST['hn'])){
echo "<HR>";
include("connect.inc");


$sql="SELECT  * FROM  `opday` WHERE  `hn` =  '".$_POST['hn']."' order by row_id desc limit 10";
$query=mysql_query($sql) or die (mysql_error());
//$arr2=mysql_fetch_assoc($query);

$opcard="SELECT *,concat(yot,name,' ',surname)as ptname FROM opcard WHERE hn='".$_POST['hn']."' ";
$queryopd=mysql_query($opcard) or die (mysql_error());
$arr2=mysql_fetch_assoc($queryopd); 
 
?>
<table  border="0">
  <tr>
    <td>ชื่อ-สกุล : </td>
    <td><strong><?=$arr2['ptname'];?></strong></td>
    <td>HN :</td>
    <td><strong><?=$arr2['hn'];?></strong></td>
  </tr>
  <tr>
    <td>สิทธิ :</td>
    <td><strong><?=$arr2['ptright'];?></strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

<table border="1" cellpadding="2" cellspacing="2">
  <tr>
    <td align="center">ลำดับ</td>
    <td align="center">วันที่มา รพ.</td>
    <td align="center">แพทย์ </td>
    <td align="center">Diag</td>
  </tr>
<?
 $i=1; 
while($arr=mysql_fetch_array($query)){?>
  <tr>
    <td align="center"><?=$i;?></td>
    <td><a href="Drug_reconciliation_print.php?hn=<?=$arr['hn']?>&date=<?=substr($arr['thidate'],0,10);?>" target="_blank"><?=$arr['thidate'];?></a></td>
    <td><?=$arr['doctor'];?></td>
    <td><?=$arr['diag'];?></td>
  </tr>
  <? 
  $i++;
  }
   ?>
</table>

<? } ?>
</body>
</html>