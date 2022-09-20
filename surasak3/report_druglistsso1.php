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
<div align="center" style="margin-top: 20px;"><strong>รายงานอัตราการจ่ายยาประกันสังคม</strong></div>
<div align="center">ระว่างวันที่ <?=$showdate1;?> ถึงวันที่ <?=$showdate2;?>
</div>
<table width="97%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="3%" align="center" bgcolor="#66CC99"><strong>ลำดับ</strong></td>
    <td width="4%" align="center" bgcolor="#66CC99"><strong>รหัสยา</strong></td>
    <td width="15%" align="center" bgcolor="#66CC99"><strong>ชื่อการค้า</strong></td>
    <td width="15%" align="center" bgcolor="#66CC99"><strong>ชื่อสามัญ</strong></td>
    <td width="8%" align="center" bgcolor="#66CC99"><strong>จ่ายให้ผู้ป่วย</strong></td>
    <td width="8%" align="center" bgcolor="#66CC99"><strong>ค่าเฉลี่ยการจ่าย</strong></td>
    <td width="6%" align="center" bgcolor="#66CC99"><strong>ห้องยา</strong></td>
    <td width="6%" align="center" bgcolor="#66CC99"><strong>คลังยา</strong></td>
    <td width="6%" align="center" bgcolor="#66CC99"><strong>คงเหลือทั้งสิ้น</strong></td>
  </tr>
<?
$chkdate1=($_POST["year1"])."-".$_POST["month1"]."-".$_POST["date1"];
$chkdate2=($_POST["year2"])."-".$_POST["month2"]."-".$_POST["date2"];

$end=mktime(0,0,0,$_POST["month2"],$_POST["date2"],$_POST["year2"]-543);
$start=mktime(0,0,0,$_POST["month1"],$_POST["date1"],$_POST["year1"]-543);
$datenum=ceil(($end-$start)/86400)+1;
//echo $datenum;

$sql="select *,sum(amount) as sumamount from drugrx where (date >= '$chkdate1 00:00:00' and date <='$chkdate2 23:59:59') and drugcode like '20%' and and (amount >0 and price >0) group by drugcode order by drugcode asc";
//echo $sql;
$query=mysql_query($sql);
$i=0;
while($rows=mysql_fetch_array($query)){
$i++;
$avg=$rows["sumamount"]/$datenum;
$sql1="select * from druglst where drugcode='$rows[drugcode]'";
$query1=mysql_query($sql1);
$rows1=mysql_fetch_array($query1);
?>  
  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$rows["drugcode"]?></td>
    <td><?=$rows["tradname"]?></td>
    <td><?=$rows1["genname"]?></td>
    <td align="right"><?=$rows["sumamount"]?></td>
    <td align="right"><?=number_format($avg,2);?></td>
    <td align="right"><?=$rows1["stock"]?></td>
    <td align="right"><?=$rows1["mainstk"]?></td>
    <td align="right"><?=$rows1["totalstk"];?></td>
  </tr>
<?
}
?>  
</table>
