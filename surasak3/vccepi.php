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
$sql="select drugcode, tradname, codevs from druglst where typedrug='T04 ÇÑ¤«Õ¹'";
//echo $sql;
$query=mysql_query($sql);
while($rows=mysql_fetch_array($query)){
	$drugcode=$rows["drugcode"];
	$tradname=substr($rows["tradname"],0,7);
	$codevs=$rows["codevs"];
	$csql="select date, hn from drugrx where drugcode='$drugcode' and (date between '2557-09-01 00:00:00' and '2557-09-30 23:59:59')";
	//echo $csql."<br>";
	$cquery=mysql_query($csql);
	while($crows=mysql_fetch_array($cquery)){
		$tdate=substr($crows["date"],-8);
		list($hh,$ss,$ii)=explode(":",$tdate);
		$timedate="$hh$ss$ii";
		
		$date=substr($crows["date"],0,10);
		list($dty,$dtm,$dtd)=explode("-",$date);
		$dty=$dty-543;
		$dupdate="$dty$dtm$dtd$timedate";
		
		$chn=$crows["hn"];
//		$chn="53-1882";
		$asql="select * from appoint where hn='$chn' and appdate='$date' and detail2 like '%$tradname%' limit 0,1";
		//echo $asql."<br>";
		$aquery=mysql_query($asql);
		while($arows=mysql_fetch_array($aquery)){
			$injno=substr($arows["injno"],-1);
			$hn=$arows["hn"];
			$vcc=$codevs.$injno;
			list($y,$mm,$dd)=explode("-",$date);
			$yy=$y-543;
			$showdate="$yy$mm$dd";
				
			$msql=mysql_query("select pcucode from mainhospital where pcuid='1'");		
			list($pcucode)=mysql_fetch_row($msql);
			
			$osql=mysql_query("select idcard from opcard where hn='$hn'");		
			list($idcard)=mysql_fetch_row($osql);
			
			$opsql=mysql_query("select thidate, vn from opday where hn='$hn' and thidate like '$date%'");		
			list($thidate,$vn)=mysql_fetch_row($opsql);
				
			$thaidate=substr($thidate,0,10);
			list($y1,$mm1,$dd1)=explode("-",$thaidate);
			$yy1=$y1-543;
			$ksdate="$yy1$mm1$dd1";
			$seq="$ksdate$vn";						
			echo "$pcucode|$hn|$seq|$showdate|$vcc|$pcucode|$dupdate|$idcard<br>";
		}  //close while $arows
	}  //close while $crows
}  //close while $rows
//echo "-----------------------end-------------------------<br>";
$tbSQL="SELECT  *, LENGTH(code) as lenvcode FROM `opcard` INNER JOIN `tb_service` ON `tb_service`.`hn` = `opcard`.`hn` INNER JOIN `vaccine` ON `vaccine`.`id_vac` = `tb_service`.`id_vac` where  `tb_service`.`date_ser`  between '2014-09-01' and '2014-09-30' order by `tb_service`.`date_ser` asc ";
$tbQuery=mysql_query($tbSQL);
while($result=mysql_fetch_array($tbQuery)){
	$hn=$result["hn"];
	$idcard=$result["idcard"];
	
	$msql=mysql_query("select pcucode from mainhospital where pcuid='1'");		
	list($pcucode)=mysql_fetch_row($msql);
	
	list($y,$mm,$dd)=explode("-",$result["date_ser"]);
	$yy=$y+543;
	$date="$yy-$mm-$dd";	
	$showdate="$y$mm$dd";
	
	$shdate=substr($result["date_insert"],0,10);
	list($td,$tm,$ty)=explode("/",$shdate);
	$tty=$ty-543;
	$tdate=substr($result["date_insert"],-8);
	list($hh,$ss,$ii)=explode(":",$tdate);
	$timedate="$hh$ss$ii";	
	$dupdate="$tty$tm$td$timedate";
	
	$opsql=mysql_query("select thidate, vn from opday where hn='$hn' and thidate like '$date%'");		
	list($thidate,$vn)=mysql_fetch_row($opsql);	
	
	$thaidate=substr($thidate,0,10);
	list($y1,$mm1,$dd1)=explode("-",$thaidate);
	$yy1=$y1-543;
	$ksdate="$yy1$mm1$dd1";	
	$seq="$ksdate$vn";
	
	if($result["lenvcode"] =="3"){
		$vcc=$result["code"];
	}else if($result["lenvcode"] =="2"){
		$vcc=$result["code"].$result["num"];
	}	
	echo "$pcucode|$hn|$seq|$showdate|$vcc|$pcucode|$dupdate|$idcard<br>";
}		
?>
</div>