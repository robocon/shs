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
<table width="90%" border="1" align="center" cellpadding="4" cellspacing="0" bordercolor="#000000">
  <tr>
    <td height="19" align="center"><strong>วันที่</strong></td>
    <td align="center"><strong>ชื่อผู้มารับบริการ</strong></td>
    <td align="center"><strong>HN</strong></td>
    <td align="center"><strong>แพทย์</strong></td>
    <td align="center"><strong>จำนวน</strong></td>
    <td align="center"><strong>ราคา</strong></td>
    <td align="center"><strong>รหัสโรค</strong></td>
    <td align="center"><strong>VN</strong></td>
    <td align="center"><strong>สิทธิ</strong></td>
    <td align="center"><strong>บัญชี</strong></td>
    <td align="center"><strong>หมอนวด</strong></td>
  </tr>
  <?
$sql="select * from depart where (date >='2563-03-01 00:00:00' and date <='2563-03-31 23:59:59') and cashok !='' and staf_massage !='' and an='' order by date,tvn";	
//echo $sql;
$query=mysql_query($sql);
$numchkup=mysql_num_rows($query);
$i=0;
while($rows=mysql_fetch_array($query)){
$i++;

    $dated=substr($rows["date"],8,2);
    $datem=substr($rows["date"],5,2); 
	$datey=substr($rows["date"],0,4); 
	$time=substr($rows["date"],11,8); 
	$datetime="$dated-$datem-$datey $time";
	
	$chkdate="$datey-$datem-$dated";
	
$sql2="select * from opday where hn ='".$rows["hn"]."' and vn ='".$rows["tvn"]."' and thidate like '".$chkdate."%'";	
//echo $sql2."<br>";
$query2=mysql_query($sql2);
$rows2=mysql_fetch_array($query2);
	
?>      
  <tr>
    <td width="14%" align="center"><?=$datetime;?></td>
    <td width="10%"><?=$rows["ptname"];?></td>
    <td width="22%"><?=$rows["hn"];?></td>
    <td width="6%"><?=$rows["doctor"];?></td>
    <td width="14%"><?=$rows["item"];?></td>
    <td width="11%"><?=$rows["price"];?></td>
    <td width="23%"><?=$rows2["icd10"];?></td>
    <td width="23%"><?=$rows["tvn"];?></td>
    <td width="23%"><?=$rows["ptright"];?></td>
    <td width="23%"><?=$rows["cashok"];?></td>
    <td width="23%"><?=$rows["staf_massage"];?></td>
  </tr>
<?
}
?>  
</table>
