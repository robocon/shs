<?
include("connect.inc");
?>
<style type="text/css">
<!--
.font1 {
	font-family: AngsanaUPC;
	font-size: 20px;
}
.font2 {
	font-size: 24px;
}
-->
</style>
<table border="1" style="border-collapse:collapse" cellpadding="0" cellspacing="0" class="font1">
<tr><td>รหัสยา</td><td>ชื่อการค้า</td><td>ชื่อสามัญ</td><td>ราคาขาย</td><td>มูลค่าการจ่ายยาทั้งหมด</td><td>มูลค่าการจ่ายยาเบิกจ่ายตรง</td><td>มูลค่าการจ่ายยาเบิกคลัง</td></tr>
<?
//$sql3= "CREATE TEMPORARY TABLE drugrx_cscd select a.amount,a.drugcode from drugrx as a,phardep as b where a.idno=b.row_id and b.ptright like '%จ่ายตรง%' and a.date between '2554-07-01 00:00:00' and '2555-08-31 23:59:59' ";

$sql = "select * from druglst where part = 'DDN' or part = 'DDL' or part ='DDY'  ";
$rows = mysql_query($sql);
while($result = mysql_fetch_array($rows)){
	$sql2= "select sum(amount) from drugrx where drugcode = '".$result['drugcode']."' and an is null and date between '2554-07-01 00:00:00' and '2555-09-12 23:59:59'  ";
	$rows2 = mysql_query($sql2);
	list($all) = mysql_fetch_array($rows2);
	
	$sql3= "select sum(amount) from drugrx as a,phardep as b where a.idno=b.row_id and b.ptright like '%จ่ายตรง%' and a.an is null and drugcode = '".$result['drugcode']."' and a.date between '2554-07-01 00:00:00' and '2555-08-31 23:59:59' ";
	$rows3 = mysql_query($sql3);
	list($cscd) = mysql_fetch_array($rows3);
	
	$sql4= "select sum(amount) from drugrx as a,phardep as b where a.idno=b.row_id and b.ptright like '%เบิกคลัง%' and a.an is null and drugcode = '".$result['drugcode']."' and a.date between '2554-07-01 00:00:00' and '2555-08-31 23:59:59' ";
	$rows4 = mysql_query($sql4);
	list($cscd2) = mysql_fetch_array($rows4);

	if($all!=0||$all!=""){
	?>
	<tr><td><?=$result['drugcode']?></td><td><?=$result['tradname']?></td><td><?=$result['genname']?></td><td><?=$result['salepri']?></td><td><?=$all?></td><td><?=$cscd?></td><td><?=$cscd2?></td></tr>
	<?
	}
}
?>
</table>
