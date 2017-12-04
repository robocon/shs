<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<? 
include("connect.inc");
?>
<table width="100%" border="1">
  <tr>
    <td>#</td>
    <td>HN</td>
    <td>ชื่อ</td>
    <td>นามสกุล</td>
  </tr>
<?
$sql="select * from opcardchk where part='สวนดุสิต60'";
$query=mysql_query($sql);
$i=0;
while($rows=mysql_fetch_array($query)){
$i++;
$sql1="select * from opcard where hn='$rows[idcard]'";
//echo $sql1."<br>";
$query1=mysql_query($sql1);
$rows1=mysql_fetch_array($query1);
?>
  <tr>
    <td><?=$i;?></td>
    <td><?=$rows1["hn"];?></td>
    <td><?=$rows1["name"];?></td>
    <td><?=$rows1["surname"];?></td>
  </tr>
<?
}
?>  
</table>
