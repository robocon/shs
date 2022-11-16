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
    <td align="center"><strong>HN</strong></td>
    <td align="center"><strong>AN</strong></td>
    <td align="center"><strong>ชื่อผู้มารับบริการ</strong></td>
    <td align="center"><strong>ราคา</strong></td>
    <td align="center"><strong>เจ้าหน้าที่</strong></td>
    <td align="center"><strong>สิทธิ</strong></td>
    <td align="center"><strong>บัญชี</strong></td>
    <td align="center"><strong>เลขที่ใบเสร็จ</strong></td>
  </tr>
  <?
$query1="CREATE TEMPORARY TABLE reportipmonrep select * from ipmonrep where (date >='2562-09-01 00:00:00' and date <='2563-03-31 23:59:59') and credit NOT IN ('ยกเลิก','อื่นๆ','') order by dcdate,hn" ;
//echo $query;
$result = mysql_query($query1) or die("Query failed BillTran, Create reportipmonrep Error !!!");  

$sql="select * from reportipmonrep order by date,an";	
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

$sql2="select * from ipcard where an ='".$rows["an"]."'";
//echo $sql2."<br>";
$query2=mysql_query($sql2);
$rows2=mysql_fetch_array($query2);	
	
if($rows["credit"]=='เงินสด'){
	$price=$rows["cash"];
}else if($rows["credit"]=='เครดิด'){
	$price=$rows["cash"];
}else{
$sql3="select sum(cash) as sumcash from ipmonrep where an ='".$rows["an"]."' and (credit='เงินสด' || credit='เครดิด')";
//echo $sql3."<br>";
$query3=mysql_query($sql3);
$rows3=mysql_fetch_array($query3);	
	$price=$rows["price"]-$rows3["sumcash"];
}

?>      
  <tr>
    <td width="14%" align="center"><?=$datetime;?></td>
    <td width="22%"><?=$rows["hn"];?></td>
    <td width="23%"><?=$rows["an"];?></td>
    <td width="10%"><?=$rows["ptname"];?></td>
    <td width="11%"><?=number_format($price,2);?></td>
    <td width="23%"><?=$rows["idname"];?></td>
    <td width="23%"><?=$rows["ptright"];?></td>
    <td width="23%"><?=$rows["credit"];?></td>
    <td width="23%"><? if(empty($rows["billno"]) || $rows["billno"]=="0"  || $rows["billno"]=="00"){ echo "";}else{ echo $rows["billno"];} ?></td>
  </tr>
<?
}
?>  
</table>
