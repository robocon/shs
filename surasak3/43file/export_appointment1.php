<?php
include("../connect.inc");
$yrmonth="$thiyr-$rptmo";
$yy=543;

print "1. �ҹ�����Ŵ�ҹ���ᾷ������آ�Ҿ ��ٻẺ 43 ����ҵðҹ ������8 ���ҧ APPOINTMENT ��Ш���͹ $yrmonth <a target=_self  href='../../nindex.htm'><<�����</a><br> ";

   $sql="SELECT  date,hn,appdate,detail,depcode From appoint where date like '$yrmonth%'";

   	$result = mysql_query($sql) or die(mysql_error());
    while (list ($date,$hn,$appdate,$detail,$depcode) = mysql_fetch_row ($result)) {	
	$aptype=substr($detail,0,3);
	$depcode=substr($depcode,0,3);
	$lenappdate=strlen($appdate);
	if($lenappdate < 12){
	list($app1,$app2,$app3)=explode("-",$appdate);
	list($yapp,$mapp,$dapp)=explode("-",$appdate);
	$yapp=$yapp-543;
	$apdate=$yapp.$mapp.$dapp;	
	}else{
	list($app1,$app2,$app3)=explode(" ",$appdate);
	if($app2=="���Ҥ�"){ $app2="01";}
	if($app2=="����Ҿѹ��"){ $app2="02";}
	if($app2=="�չҤ�"){ $app2="03";}
	if($app2=="����¹"){ $app2="04";}
	if($app2=="����Ҥ�"){ $app2="05";}
	if($app2=="�Զع�¹"){ $app2="06";}
	if($app2=="�á�Ҥ�"){ $app2="07";}
	if($app2=="�ԧ�Ҥ�"){ $app2="08";}
	if($app2=="�ѹ��¹"){ $app2="09";}
	if($app2=="���Ҥ�"){ $app2="10";}
	if($app2=="��Ȩԡ�¹"){ $app2="11";}
	if($app2=="�ѹ�Ҥ�"){ $app2="12";}
	if($app3=="2557"){ $app3="2014";}
	$apdate=$app3.$app2.$app1;
	}

	$sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
	list($hospcode)=mysql_fetch_array($sqlhos);
	
	
	$num2=543;
    $d=substr($date,8,2);
    $m=substr($date,5,2); 
    $y=substr($date,0,4); 
	$y1=$y-$num2;
   	$y2=substr($y1,2,2);
	$dateserv="$y1$m$d";
	list($hn1,$hn2)=explode("-",$hn);
	$seq=$dateserv.$hn1.$hn2;

	
  	$time1=substr($thidate,11,2); 
	$time2=substr($thidate,14,2); 
    $time3=substr($thidate,17,2); 
	$timeserv="$time1$time2$time3";	
	

	$regis1=substr($date,0,10);
	$regis2=substr($date,11,19);
	list($yy,$mm,$dd)=explode("-",$regis1);
	list($hh,$ss,$ii)=explode(":",$regis2);
	$d_update=($yy-543).$mm.$dd.$hh.$ss.$ii;

       echo  "$hospcode|$hn||$seq|$dateserv|$depcode|$apdate|$aptype|||$d_update<br>";
          }
	
    include("unconnect.inc");
?>
