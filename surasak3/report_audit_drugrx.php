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
  <td height="38"><strong>VN</strong></td>
    <td><strong>HN</strong></td>
    <td><strong>วันที่-เวลา</strong></td>
    <td><strong>ชื่อ-สกุล</strong></td>
    <td><strong>อายุ</strong></td>
    <td><strong>สิทธิการรักษา</strong></td>
    <td><strong>รหัสยา</strong></td>
    <td><strong>รายการ</strong></td>
    <td><strong>ราคาต่อหน่วย</strong></td>
    <td><strong>จำนวน</strong></td>
    <td><strong>รวมเงิน</strong></td>
    <td><strong>เลขที่ใบเสร็จรับเงิน</strong></td>
    <td><strong>รหัสโรค</strong></td>
    <td><strong>ชื่อโรค</strong></td>
    <td><strong>แพทย์</strong></td>
    <td><strong>บัญชี</strong></td>
<?
$query1="CREATE TEMPORARY TABLE reportdrugrx select * from drugrx where (date >='2563-03-01 00:00:00' and date <='2563-03-31 23:59:59') and (an is null or an='') GROUP BY drugcode,hn order by date,hn" ;
//echo $query;
$result = mysql_query($query1) or die("Query failed BillTran, Create reportdrugrx Error !!!");

$sql="select * from reportdrugrx order by date,hn";
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
	
	
	$unitprice=$rows["price"]/$rows["amount"];

$sql1="select * from phardep where row_id ='".$rows["idno"]."'";	
$query1=mysql_query($sql1);
$rows1=mysql_fetch_array($query1);

$sql2="select * from opday where hn ='".$rows["hn"]."' and vn ='".$rows1["tvn"]."' and thidate like '".$chkdate."%'";	
$query2=mysql_query($sql2);
$rows2=mysql_fetch_array($query2);

$sql3="select * from opacc where hn ='".$rows["hn"]."' and txdate like '".$rows1["date"]."%' and depart='PHAR'";	
$query3=mysql_query($sql3);
$rows3=mysql_fetch_array($query3);
?> 
  <tr>
    <td><?=$rows1["tvn"];?></td>
    <td><?=$rows["hn"];?></td>
    <td><?=$datetime;?></td>
    <td><?=$rows1["ptname"];?></td>
    <td><?=$rows2["age"];?></td>
    <td><?=$rows1["ptright"];?></td>
    <td><?=$rows["drugcode"];?></td>
    <td><?=$rows["tradname"];?></td>
    <td><?=number_format($unitprice, 2, '.', '');?></td>
    <td><?=$rows["amount"];?></td>
    <td><?=$rows["price"];?></td>
    <td><?=$rows3["billno"];?></td>
    <td><?=$rows2["icd10"];?></td>
    <td><?=$rows2["diag"];?></td>
    <td><?=$rows1["doctor"];?></td>
    <td><?=$rows1["cashok"];?></td>
  </tr>
<?
}
?>  
</table>
