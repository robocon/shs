<?php
include("../connect.inc");
$newyear = "$thiyr$rptmo$day";
$thimonth = "$thiyr-$rptmo";
$thiyr = $thiyr-543;
$yrmonth = "$thiyr-$rptmo";
$yy = 543;

print "1. �ҹ�����Ŵ�ҹ���ᾷ������آ�Ҿ ��ٻẺ 43 ����ҵðҹ ������5 ���ҧ DRUGGALLERGY ��Ш���͹ $yrmonth <a target=_self  href='../../nindex.htm'><<�����</a><br> ";

$temp5="CREATE  TEMPORARY  TABLE report_drugallergy1 
SELECT a.regisdate, a.hn
FROM opcard AS a, 
opday AS b 
where a.hn=b.hn 
AND a.regisdate like '$yrmonth%'  
group by a.hn";
//echo $temp5;
$querytmp5 = mysql_query($temp5) or die("Query failed,Create temp5");

$temp51="CREATE  TEMPORARY  TABLE report_drugallergy2 
SELECT date,hn,drugcode,tradname,advreact,asses,reporter
FROM drugreact 
where date like '$thimonth%'";
//echo $temp51;
$querytmp51 = mysql_query($temp51) or die("Query failed,Create temp51");

$sql5="SELECT a.regisdate,b.date,b.hn,b.drugcode,b.tradname,b.advreact,b.asses,b.reporter 
From report_drugallergy1 as a 
inner join report_drugallergy2 as b 
on a.hn=b.hn";
$result5= mysql_query($sql5) or die("Query failed, Select report_drugallergy (drugallergy)");
$num=mysql_num_rows($result5);
//echo "$num <br>";
while (list ($regisdate,$date,$hn,$drugcode,$tradname,$advreact,$asses,$reporter) = mysql_fetch_row ($result5)) {	

	$sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
	list($hospcode)=mysql_fetch_array($sqlhos);
	
	// ��24�鴨ҡ tradname
	$sqldrug = mysql_query("select drugcode,tradname,code24 from druglst where tradname like '%$tradname%' LIMIT 1");
	$code24Row = mysql_num_rows($sqldrug);
	list($dcode,$dname,$drugallergy) = mysql_fetch_array($sqldrug);
	
	// ����Ҩҡ tradname �������Ҩҡ genname
	if( $code24Row === 0 ){
		$sqldrug=mysql_query("select drugcode,tradname,code24 from druglst where genname like '%$tradname%' LIMIT 1");
		$code24Row = mysql_num_rows($sqldrug);
		list($dcode,$dname,$drugallergy) = mysql_fetch_array($sqldrug);
	}
		
	$date=substr($date,0,10);
	list($yy,$mm,$dd)=explode("-",$date);
	$yy=$yy-543;
	$daterecord="$yy$mm$dd";

	$regis1=substr($regisdate,0,10);
	$regis2=substr($regisdate,11,19);
	list($yy,$mm,$dd)=explode("-",$regis1);
	list($hh,$ss,$ii)=explode(":",$regis2);
	$d_update=$yy.$mm.$dd.$hh.$ss.$ii;  //�ѹ��͹�շ���Ѻ��ا������

	$typedx = "";  //����������ԹԨ���
	$alevel = $asses;  //�дѺ�����ع�ç
	$symptom = $advreact;  //�ѡɳ��ҡ��
	$informant = "1";  //���������ѵԡ����


	echo "$hospcode|$hn|$daterecord|$drugallergy|$dname|$typedx|$alevel|$symptom|$informant|$hospcode|$d_update<br>";	
	
}  //close while	