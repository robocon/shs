<?
session_start();
include("connect.inc");
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<div align="center">
<?
$sql="SELECT diag.hn, opcard.idcard, diag.regisdate,diag.icd10, icd506.code,diag.svdate,opcard.address, opcard.tambol, opcard.ampur, opcard.changwat FROM  `diag`  INNER JOIN `icd506` ON `diag`.`icd10` = `icd506`.`icd10` INNER JOIN `opcard` ON  `diag`.`hn` = `opcard`.`hn` WHERE  `diag`.`regisdate`  between '2557-09-01 00:00:00' and '2557-09-30 23:59:59'  order by `diag`.`row_id` asc ";
//echo $sql;
$query=mysql_query($sql);
while($result=mysql_fetch_array($query)){
	$hn=$result["hn"];
	$idcard=$result["idcard"];
	$icd10=$result["icd10"];
	$icd506=$result["code"];
	$illhouse=$result["address"];
	$adress=substr($result["address"],-1);
	$illvill="0$adress";
	$illtamb=$result["tambol"];
	$illampu=$result["ampur"];
	$illchan=$result["changwat"];
	
	$shdate=substr($result["regisdate"],0,10);
	list($ty,$tm,$td)=explode("-",$shdate);
	$tty=$ty-543;
	$tdate=substr($result["regisdate"],-8);
	list($hh,$ss,$ii)=explode(":",$tdate);
	$timedate="$hh$ss$ii";	
	$dupdate="$tty$tm$td$timedate";
	$date=$shdate;	
	$showdate="$tty$tm$td";

	$svdate=substr($result["svdate"],0,10);
	list($vy,$vm,$vd)=explode("-",$svdate);
	$vvy=$vy-543;
	$illdate="$vvy$vm$vd";
	
	$msql=mysql_query("select pcucode from mainhospital where pcuid='1'");		
	list($pcucode)=mysql_fetch_row($msql);
	
	$opsql=mysql_query("select thidate, vn from opday where hn='$hn' and thidate like '$date%'");	
	list($thidate,$vn)=mysql_fetch_row($opsql);	

	$thaidate=substr($thidate,0,10);
	list($y1,$mm1,$dd1)=explode("-",$thaidate);
	$yy1=$y1-543;
	$ksdate="$yy1$mm1$dd1";
	$seq="$ksdate$vn";
		
	echo "$pcucode|$idcard|$hn|$seq|$showdate|$icd10|$icd506|$illdate|$illhouse|$illvill|$illtamb|$illampu|$illchan|$ptstat|$datedeath|$complica|$organism|$dupdate<br>";
}		
?>
</div>
