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


$drugcode="1FAVI200";
$sql="select *,sum(amount) as sumamount from drugrx where (date >= '$chkdate1 00:00:00' and date <='$chkdate2 23:59:59') and drugcode = '$drugcode' group by hn,drugcode HAVING SUM( amount ) >0 order by date";
//echo $sql;
$query=mysql_query($sql);
$num=mysql_num_rows($query);
?>
<strong><div align="center" style="margin-top: 20px;">ข้อมูลการเบิกยา Favipiravir 200 mg  Tablet   หน่วยงานที่เบิก  รพ.ค่ายสุรศักดิ์มนตรี   ตั้งแต่วันที่ <?=$showdate1;?> ถึงวันที่ <?=$showdate2;?></div>
<table width="95%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="5%" align="center" bgcolor="#66CC99"><strong>รหัสแม่ข่าย</strong></td>
	<td width="5%" align="center" bgcolor="#66CC99"><strong>วัน/เดือน/ปี</strong></td>
	<td width="5%" align="center" bgcolor="#66CC99"><strong>รับ/จ่าย</strong></td>
	<td width="5%" align="center" bgcolor="#66CC99"><strong>รหัส</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>หน่วยงาน</strong></td>
	<td width="5%" align="center" bgcolor="#66CC99"><strong>จำนวน</strong></td>
	<td width="5%" align="center" bgcolor="#66CC99"><strong>คงเหลือ</strong></td>
	<td width="5%" align="center" bgcolor="#66CC99"><strong>LotNo</strong></td>
	<td width="5%" align="center" bgcolor="#66CC99"><strong>ผู้ป่วยใหม่</strong></td>
    <td width="15%" align="center" bgcolor="#66CC99"><strong>ชื่อ-สกุลผู้ป่วย</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>เลชบัตรประจำตัวผู้ป่วย</strong></td>
    <td width="5%" align="center" bgcolor="#66CC99"><strong>ประเภทบัตร</strong></td>
	<td width="15%" align="center" bgcolor="#66CC99"><strong>ความหมายของบัตร</strong></td>
	<td width="5%" align="center" bgcolor="#66CC99"><strong>ต่างชาติ</strong></td>
	<td width="15%" align="center" bgcolor="#66CC99"><strong>สถานะผู้ป่วยต่างชาติ</strong></td>
	<td width="5%" align="center" bgcolor="#66CC99"><strong>หมายเหตุ</strong></td>
  </tr>
  <?
$i=0;
$sum=0;
while($rows=mysql_fetch_array($query)){
$i++;
$sum=$sum+$rows["sumamount"];

$y = substr($rows["date"],0,4);
$m = substr($rows["date"],5,2);
$d = substr($rows["date"],8,2);
$date="$d/$m/$y";

	$sql1="select an,vn from opday where hn='".$rows['hn']."' and thidate LIKE '".substr($rows['date'],0,10)."%' LIMIT 1";
	//echo $sql1;
	$query1=mysql_query($sql1);
	list($an,$vn)=mysql_fetch_array($query1);

	if(!empty($an)){
		$visit=$an;
	}else{
		$visit=$vn;
	}

	$sql2="select yot,name,surname,ptright,idcard from opcard where hn='$rows[hn]' ";
	$query2=mysql_query($sql2);
	list($yot,$name,$surname,$ptright,$idcard)=mysql_fetch_array($query2);
	

?>
  <tr>
    <td width="5%" align="center" ><strong>10672</strong></td>
	<td width="5%" align="center" ><strong><?=$date;?></strong></td>
	<td width="5%" align="center" ><strong>21</strong></td>
	<td width="5%" align="center" ><strong>11512</strong></td>
    <td width="10%" align="center" ><strong>รพ.ค่ายสุรศักดิ์มนตรี</strong></td>
	<td width="5%" align="center" ><strong><?=$rows["sumamount"];?></strong></td>
	<td width="5%" align="center" ><strong></strong></td>
	<td width="5%" align="center" ><strong></strong></td>
	<td width="5%" align="center" ><strong>1</strong></td>
    <td width="15%" align="left" ><strong><?=$yot."".$name." ".$surname;?></strong></td>
    <td width="10%" align="center" ><strong><?=$idcard;?></strong></td>
    <td width="5%" align="center" ><strong>1</strong></td>
	<td width="15%" align="center" ><strong>บัตรประจำตัวประชาชน</strong></td>
	<td width="5%" align="center" ><strong>0</strong></td>
	<td width="15%" align="center" ><strong>คนไทย (สัญชาติไทย)</strong></td>
	<td width="5%" align="center" ><strong></strong></td>	
  </tr>
  <?
}
?>
</table>
