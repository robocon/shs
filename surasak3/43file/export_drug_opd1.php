<?php
include("../connect.inc");
$yrmonth="$thiyr-$rptmo";
$yy=543;

print "1. �ҹ�����Ŵ�ҹ���ᾷ������آ�Ҿ ��ٻẺ 43 ����ҵðҹ ������12 ���ҧ DRUG_OPD ��Ш���͹ $yrmonth <a target=_self  href='../../nindex.htm'><<�����</a><br> ";

   $sql="SELECT a.date,a.hn,a.an,a.drugcode,a.tradname,a.amount,b.code24,b.unit,b.unitpri,b.salepri FROM drugrx as a inner join druglst as b on a.drugcode=b.drugcode WHERE a.date LIKE '$yrmonth%' and (a.an is null or a.an='')";
   	$result = mysql_query($sql) or die(mysql_error());
    while (list ($date,$hn,$an,$drugcode,$dname,$amount,$didstd,$unitpack,$drugcost,$drugprice) = mysql_fetch_row ($result)) {	

	$sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
	list($hospcode)=mysql_fetch_array($sqlhos);
	
	$num2=543;
    $d=substr($date,8,2);
    $m=substr($date,5,2); 
    $y=substr($date,0,4); 
	$y1=$y-$num2;
   	$y2=substr($y1,2,2);
	$dateserv="$y1$m$d";
	

	$regis1=substr($date,0,10);
	$regis2=substr($date,11,19);
	list($yy,$mm,$dd)=explode("-",$regis1);
	list($hh,$ss,$ii)=explode(":",$regis2);
	$d_update=($yy-543).$mm.$dd.$hh.$ss.$ii;
	list($hn1,$hn2)=explode("-",$hn);
	$seq=($yy-543).$mm.$dd.$hn1.$hn2;	

       echo  "$hospcode|$hn|$seq|$dateserv|$clinic|$didstd|$dname|$amount|$unit|$unitpack|$drugprice|$drugcost|$provider|$d_update<br>";
     }
	
    include("unconnect.inc");
?>
