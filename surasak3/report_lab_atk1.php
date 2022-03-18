<?
session_start();
include("connect.inc");

$showdate1=$_POST["date1"]."/".$_POST["month1"]."/".$_POST["year1"];
$showdate2=$_POST["date2"]."/".$_POST["month2"]."/".$_POST["year2"];
$camp=$_POST["camp"];
if($camp=="all"){
	$showcamp="ทุกหน่วย";
}else{
	$showcamp=$camp;
}
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

$date1=($_POST["year1"]-543)."-".$_POST["month1"]."-".$_POST["date1"];
$date2=($_POST["year2"]-543)."-".$_POST["month2"]."-".$_POST["date2"];

$end=mktime(0,0,0,$_POST["month2"],$_POST["date2"],$_POST["year2"]-543);
$start=mktime(0,0,0,$_POST["month1"],$_POST["date1"],$_POST["year1"]-543);

//echo $datenum;

/*$csql="SELECT b.authorisedate, a.orderdate, a.hn, a.patientname, b.labcode, b.result, c.camp, c.idcard, c.ptright
FROM `resulthead` AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
INNER JOIN opcard AS c ON a.hn = c.hn
WHERE (a.orderdate >= '$date1 00:00:00' and a.orderdate <='$date2 23:59:59') AND b.labcode = 'covid'";*/

$csql="SELECT substring(a.orderdate,1,10),b.authorisedate, a.orderdate, a.hn, a.patientname, b.labcode, b.result, c.camp, c.idcard, c.ptright
FROM `resulthead` AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
INNER JOIN opcard AS c ON a.hn = c.hn
WHERE (a.orderdate >= '$date1 00:00:00' and a.orderdate <='$date2 23:59:59') AND b.labcode = 'covid' group by substring(a.orderdate,1,10),a.hn,b.result order by a.orderdate";

//echo $csql;
$cquery=mysql_query($csql);
$num=mysql_num_rows($cquery);
?>
<div align="center" style="margin-top: 20px;"><strong>รายงานการตรวจ ATK</strong></div>
<div align="center">ระว่างวันที่ <?=$showdate1;?> ถึงวันที่ <?=$showdate2;?></div>
<table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="5%" align="center" bgcolor="#FF6699"><strong>ลำดับ</strong></td>
	<td width="15%" align="center" bgcolor="#FF6699"><strong>วันและเวลาที่ออกผลตรวจ</strong></td>
	<td width="10%" align="center" bgcolor="#FF6699"><strong>HN</strong></td>
    <td width="15%" align="center" bgcolor="#FF6699"><strong>ชื่อ - นามสกุล</strong></td>
	<td width="10%" align="center" bgcolor="#FF6699"><strong>เลขที่บัตรประชาชน</strong></td>
	<td width="15%" align="center" bgcolor="#FF6699"><strong>สิทธิการรักษา</strong></td>
	<? if($_SESSION["smenucode"]=="ADM" || $_SESSION["smenucode"]=="ADMLAB" || $_SESSION["smenucode"]=="ADMMON"  || $_SESSION["smenucode"]=="ADMNHSO"){ ?>
	<td width="10%" align="center" bgcolor="#FF6699"><strong>ผลตรวจ</strong></td>
	<? } ?>
  </tr>
<?
$i=0;
while($result=mysql_fetch_array($cquery)){
	$i++;
	$year=substr($result["orderdate"],0,4)+543;
	$datetime=$year.substr($result["orderdate"],4);		

	if($result["result"]=="POSITIVE" || $result["result"]=="Positive"  || $result["result"]=="positive"){
		$color="#FF0000";
	}else{
		$color="#000000";
	}
?>
  <tr>
    <td width="5%" align="center"><strong><?=$i;?></strong></td>
	<td width="15%" align="center"><strong><?=$datetime;?></strong></td>
	<td width="10%" align="center"><strong><?=$result["hn"];?></strong></td>
	<td width="15%" align="left"><strong><?=$result["patientname"];?></strong></td>
	<td width="10%" align="center"><strong><?=$result["idcard"];?></strong></td>
	<td width="15%" align="left"><strong><?=$result["ptright"];?></strong></td>
	<? if($_SESSION["smenucode"]=="ADM"|| $_SESSION["smenucode"]=="ADMLAB" || $_SESSION["smenucode"]=="ADMMON" || $_SESSION["smenucode"]=="ADMNHSO"){ ?>
	<td width="10%" align="center" style="color:<?=$color;?>"><strong><?=$result["result"];?></strong></td>
	<? } ?>
  </tr>
<?
}
?>  
</table>