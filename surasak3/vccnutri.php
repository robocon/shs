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
$sql="SELECT * FROM  `opcard`  INNER JOIN `well_baby` ON `well_baby`.`hn` = `opcard`.`hn`  WHERE  `well_baby`.`thidate`  between '2014-09-01' and '2014-09-30'  order by `well_baby`.`row_id` asc ";
$query=mysql_query($sql);
while($result=mysql_fetch_array($query)){
	$hn=$result["hn"];
	$idcard=$result["idcard"];
	$yearage=substr($result["age"],0,1);
	$monthage=substr($result["age"],5,1);
	$yearmonth=$yearage*12;
	$age=$yearmonth+$monthage;
	
	$weight=number_format($result["weight"],2);
	$height=number_format($result["height"],2);
	if($result["growth"]=="N"){
		$nlevel="1";
	}else if($result["growth"]=="L"){
		$nlevel="3";
	}else if($result["growth"]=="H"){
		$nlevel="5";
	}
	
	$msql=mysql_query("select pcucode from mainhospital where pcuid='1'");		
	list($pcucode)=mysql_fetch_row($msql);
	
	list($y,$mm,$dd)=explode("-",$result["thidate"]);
	$yy=$y+543;
	$date="$yy-$mm-$dd";	
	$showdate="$y$mm$dd";
	
	$shdate=substr($result["register"],0,10);
	list($ty,$tm,$td)=explode("-",$shdate);
	$tdate=substr($result["register"],-8);
	list($hh,$ss,$ii)=explode(":",$tdate);
	$timedate="$hh$ss$ii";	
	$dupdate="$ty$tm$td$timedate";
	
	$opsql=mysql_query("select thidate, vn from opday where hn='$hn' and thidate like '$date%'");		
	list($thidate,$vn)=mysql_fetch_row($opsql);	

	$thaidate=substr($thidate,0,10);
	list($y1,$mm1,$dd1)=explode("-",$thaidate);
	$yy1=$y1-543;
	$ksdate="$yy1$mm1$dd1";
	$seq="$ksdate$vn";
		
	echo "$pcucode|$hn|$seq|$showdate|$age|$weight|$height|$nlevel|$dupdate|$idcard<br>";
}		
?>
</div>
