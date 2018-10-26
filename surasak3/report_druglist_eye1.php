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
<div align="center" style="margin-top: 20px;"><strong>รายงานอัตราการใช้ยาทางจักษุแพทย์ตามห้วงเวลา</strong></div>
<div align="center">ระว่างวันที่ <?=$showdate1;?> ถึงวันที่ <?=$showdate2;?>
</div>
<table width="97%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="7%" align="center" bgcolor="#66CC99"><strong>ลำดับ</strong></td>
    <td width="8%" align="center" bgcolor="#66CC99"><strong>รหัสยา</strong></td>
    <td width="19%" align="center" bgcolor="#66CC99"><strong>ชื่อการค้า</strong></td>
    <td width="24%" align="center" bgcolor="#66CC99"><strong>ชื่อสามัญ</strong></td>
    <td width="6%" align="center" bgcolor="#66CC99"><strong>ประเภท</strong></td>
    <td width="12%" align="center" bgcolor="#66CC99"><strong>ราคาทุน</strong></td>
    <td width="12%" align="center" bgcolor="#66CC99"><strong>ราคาขาย</strong></td>
    <td width="12%" align="center" bgcolor="#66CC99"><strong>จ่ายให้ผู้ป่วย</strong></td>
    <td width="12%" align="center" bgcolor="#66CC99"><strong>รวมเป็นเงิน</strong></td>
  </tr>
<?
$chkdate1=($_POST["year1"])."-".$_POST["month1"]."-".$_POST["date1"];
$chkdate2=($_POST["year2"])."-".$_POST["month2"]."-".$_POST["date2"];

$end=mktime(0,0,0,$_POST["month2"],$_POST["date2"],$_POST["year2"]-543);
$start=mktime(0,0,0,$_POST["month1"],$_POST["date1"],$_POST["year1"]-543);
$datenum=ceil(($end-$start)/86400)+1;
//echo $datenum;

$sql="select *,sum(amount) as sumamount from drugrx where (date >= '$chkdate1 00:00:00' and date <='$chkdate2 23:59:59') and amount > 0 and (drugcode like '6%' OR drugcode like '2BOTO%' OR drugcode like '2LUC%' OR drugcode like '2FLUR%' OR drugcode like '2MITO%')  group by drugcode order by drugcode asc";
//echo $sql;
$query=mysql_query($sql);
$i=0;
while($rows=mysql_fetch_array($query)){
$i++;
$avg=$rows["sumamount"]/$datenum;
$sql1="select * from druglst where drugcode='$rows[drugcode]'";
$query1=mysql_query($sql1);
$rows1=mysql_fetch_array($query1);
$sumprice=$rows1["salepri"]*$rows["sumamount"];
?>  
  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$rows["drugcode"]?></td>
    <td><?=$rows["tradname"]?></td>
    <td><?=$rows1["genname"]?></td>
    <td align="center"><? if($rows1["ised"]=="e"){ echo "ED";}else if($rows1["ised"]=="n" || $rows1["part"]=="DDY"){ echo "NED";} ?></td>
    <td align="center"><?=$rows1["unitpri"]?></td>
    <td align="center"><?=$rows1["salepri"]?></td>
    <td align="right"><?=$rows["sumamount"]?></td>
    <td align="right"><?=number_format($sumprice,2);?></td>
  </tr>
<?
}
?>  
</table>
