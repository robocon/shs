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
    <td width="14%" align="center"><strong>วัน/เดือน/ปี</strong></td>
    <td width="10%" height="31" align="center"><strong>HN</strong></td>
      <td width="22%" align="center" ><strong>ชื่อ - นามสกุล</strong></td>
      <td width="6%" align="center"><strong>VN</strong></td>
      <td width="14%" align="center"><strong>สิทธิ</strong></td>
    <td width="11%" align="center"><strong>อายุ</strong></td>
    <td width="23%" align="center"><strong>โรค</strong></td>
    <td width="23%" align="center"><strong>การมาโรงพยาบาล</strong></td>
    <?
$sql="select * from opday where (thidate >='2563-03-01 00:00:00' and thidate <='2563-03-31 23:59:59') and (an is null or an='') order by thidate,vn";	
//echo $sql;
$query=mysql_query($sql);
$numchkup=mysql_num_rows($query);
$i=0;
while($rows=mysql_fetch_array($query)){
$i++;

    $dated=substr($rows["thidate"],8,2);
    $datem=substr($rows["thidate"],5,2); 
	$datey=substr($rows["thidate"],0,4); 
	$time=substr($rows["thidate"],11,8); 
	$datetime="$dated-$datem-$datey $time";
	
	$chkdate="$datey-$datem-$dated";
	
	
/*$sql3="select sum(price) as sumprice from opacc where hn ='".$rows["hn"]."' and vn ='".$rows["vn"]."' and date like '".$chkdate."%' and (credit !='ยกเลิก' || credit !='นอนโรงพยาบาล' || credit !='ค้างจ่าย'  || credit !='อื่นๆ'  || credit !='ยกเว้น')";
echo $sql3."<br>";	
$query3=mysql_query($sql3);
$rows3=mysql_fetch_array($query3);	

$sumprice=$rows3["sumprice"];*/
?>    
  <tr>
    <td align="center"><?=$datetime;?></td>
    <td><?=$rows["hn"];?></td>
    <td><?=$rows["ptname"];?></td>
    <td><?=$rows["vn"];?></td>
    <td><?=$rows["ptright"];?></td>
    <td><?=$rows["age"];?></td>
    <td><?=$rows["diag"];?></td>
    <td><?=$rows["toborow"];?></td>
  </tr>
<?
}
?>  
</table>
