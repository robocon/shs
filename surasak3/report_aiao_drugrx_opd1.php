<?
session_start();
include("connect.inc");

$showdate1=$_POST["date1"]."/".$_POST["month1"]."/".$_POST["year1"];
$showdate2=$_POST["date2"]."/".$_POST["month2"]."/".$_POST["year2"];
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<?
$chkdate1=($_POST["year1"])."-".$_POST["month1"]."-".$_POST["date1"];
$chkdate2=($_POST["year2"])."-".$_POST["month2"]."-".$_POST["date2"];

$end=mktime(0,0,0,$_POST["month2"],$_POST["date2"],$_POST["year2"]-543);
$start=mktime(0,0,0,$_POST["month1"],$_POST["date1"],$_POST["year1"]-543);
$datenum=ceil(($end-$start)/86400)+1;

//echo $datenum;

$sql="select a.drugcode,a.tradname,a.part,a.amount,a.price,b.date,b.hn,b.tvn,b.ptname,b.cashok,b.ptright from drugrx as a inner join phardep as b on a.idno=b.row_id where (a.date >= '$chkdate1 00:00:00' and a.date <='$chkdate2 23:59:59') and a.amount >0 and (b.cashok !='' and b.cashok !='ค้างจ่าย' and b.cashok !='ค้างจ่าย' and b.cashok !='อื่นๆ') and a.datedr !='' and b.price >0 and b.borrow is null order by a.date";
//echo $sql;
$query=mysql_query($sql);
$num=mysql_num_rows($query);
?>
<strong><div align="center" style="margin-top: 20px;">รายงานอัตราการสั่งจ่ายยาให้ผู้ป่วยนอก</div>
<div align="center">ระว่างวันที่ <?=$showdate1;?> ถึงวันที่ <?=$showdate2;?></div>
<table width="97%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>วันที่รับบริการ</strong></td>
    <td width="5%" align="center" bgcolor="#66CC99"><strong>VN</strong></td>
	<td width="8%" align="center" bgcolor="#66CC99"><strong>HN</strong></td>	
	<td width="15%" align="center" bgcolor="#66CC99"><strong>ชื่อ - สกุล</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>รหัสยา</strong></td>
	<td width="15%" align="center" bgcolor="#66CC99"><strong>รายการยา</strong></td>
	<td width="8%" align="center" bgcolor="#66CC99"><strong>จำนวน</strong></td>
	<td width="8%" align="center" bgcolor="#66CC99"><strong>ราคา/หน่วย</strong></td>
	<td width="8%" align="center" bgcolor="#66CC99"><strong>ราคารวม</strong></td>
	<!--td width="15%" align="center" bgcolor="#66CC99"><strong>ชำระโดย</strong></td-->
	<td width="15%" align="center" bgcolor="#66CC99"><strong>สิทธิการรักษา</strong></td>
  </tr>
  <?
$i=0;
$sum=0;
while($rows=mysql_fetch_array($query)){
$i++;
$sum=$sum+$rows["price"];

$date = substr($rows["date"],0,10);
$d=substr($date,8,2);
$m=substr($date,5,2);
$y=substr($date,0,4);
$visitdate="$d/$m/$y";

$unit=$rows["price"]/$rows["amount"];
$ptright=substr($rows["ptright"],0,3);
if($rows["part"]=="DDN" || $rows["part"]=="DSN" || $rows["part"]=="DPN"){
	
	if($ptright !="R07" && $ptright!='R09' && $ptright!='R12' && $ptright!='R27'){
		//echo "==>".$ptright.$rows["part"].$rows["hn"]."<br>";
		$sql2="select credit from opacc where hn='$rows[hn]' and txdate='$rows[date]' and depart='PHAR' and (credit='เงินสด' ||  credit='เงินโอน'  || credit='ทหารไทย' || credit='กรุงไทย' )";
		//echo $sql2."<br>";
		$query2=mysql_query($sql2);
		list($credit)=mysql_fetch_array($query2);
	}else{
		$credit=$rows["cashok"];
	}		
}else{
	$credit=$rows["cashok"];
}	
?>
  <tr>
    <td><?=$visitdate;?></td>
	<td align="center"><?=$rows["tvn"];?></td>
	<td><?=$rows["hn"];?></td>	
	<td><?=$rows["ptname"];?></td>
    <td><?=$rows["drugcode"];?></td>
	<td><?=$rows["tradname"];?></td>
    <td align="center"><?=$rows["amount"];?></td>
	<td align="right"><?=number_format($unit,2);?></td>
	<td align="right"><?=number_format($rows["price"],2);?></td>
	<!--td><?=$credit;?></td-->
	<td><?=$rows["ptright"];?></td>
  </tr>
  <?
}
?>
</table>
