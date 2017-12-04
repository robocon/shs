<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<body>
<?
include("connect.inc");
$today2=$_GET['tdate'];
$credit=$_GET['tcredit'];

$query = "SELECT * FROM  `opacc` WHERE 1  AND  `credit` ='hd' and date LIKE '".$today2."%' and credit_detail ='".$credit."'  and price>0";
$result = mysql_query($query) or die("Query failed ".$query."");


?>

<table border="1" style="border-collapse:collapse;" bordercolor="#000000" cellpadding="0" cellspacing="0">
  <tr>
    <td>ลำดับ</td>
    <td>วันที่</td>
    <td>HN</td>
    <td>ชื่อ-สกุล</td>
    <td>รายละเอียด</td>
    <td>ราคา</td>
  </tr>
  
  <?
  $i=1;
  while($arr=mysql_fetch_array($result)){
	  
	  
	  $sql="SELECT concat(  yot,  name,  ' ',  surname )  AS ptname From opcard WHERE hn='".$arr['hn']."' ";
	  $query=mysql_query($sql);
	  $arr2=mysql_fetch_array($query);
  ?>
  <tr>
    <td><?=$i;?></td>
    <td><?=$arr['date'];?>&nbsp;</td>
    <td><?=$arr['hn'];?>&nbsp;</td>
    <td><?=$arr2['ptname'];?>&nbsp;</td>
    <td><?=$arr['detail'];?>&nbsp;</td>
    <td><?=$arr['price'];?>&nbsp;</td>
  </tr>
  <? 
  
  $i++;} ?>
</table>

</body>
</html>