<?php
include("../connect.inc");
$newyear = "$thiyr$rptmo$day";
$thimonth = "$thiyr-$rptmo";
$thiyr = $thiyr-543;
$yrmonth = "$thiyr-$rptmo";
$yy = 543;

print "1. �ҹ�����Ŵ�ҹ���ᾷ������آ�Ҿ ��ٻẺ 43 ����ҵðҹ ������7 ���ҧ SERVICE ��Ш���͹ $yrmonth <a target=_self  href='../../nindex.htm'><<�����</a><br> ";

$temp7="CREATE  TEMPORARY  TABLE report_service 
SELECT thidate, hn, vn, an, ptname, ptright, goup, toborow 
FROM opday WHERE thidate like '$thimonth%' ORDER BY thidate ASC";
//echo $temp7;
$querytmp7 = mysql_query($temp7) or die("Query failed,Create temp7");

$temp71="CREATE TEMPORARY TABLE report_serviceopacc 
SELECT date,paid,hn,credit,txdate 
FROM opacc WHERE txdate LIKE '$thimonth%' ";
$querytmp71 = mysql_query($temp71) or die("Query failed,Create temp71");

$sql7="SELECT thidate, hn, vn, an, ptname, ptright, goup, toborow 
From report_service";
$result7= mysql_query($sql7) or die("Query failed, Select report_service (service)");
$num=mysql_num_rows($result7);
//echo "$num <br>";
while (list ($thidate,$hn,$vn,$an,$ptname,$ptright,$goup,$toborow) = mysql_fetch_row ($result7)) {	

	$sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
	list($hospcode)=mysql_fetch_array($sqlhos);
	
	$sqlpt=mysql_query("select ptrightdetail from opcard where hn='$hn'");
	list($ptrightdetail)=mysql_fetch_array($sqlpt);
	
	
$chkdate=substr($thidate,0,10);	
$sqlopd="select temperature, pause, rate, bp1, bp2, organ 
from opd 
where thidate like '$chkdate%' 
and hn='$hn' 
and vn='$vn' 
order by thidate asc";
$resultopd=mysql_query($sqlopd);
$num=mysql_num_rows($resultopd);
//echo "==>$num <br>";
list($btemp,$pr,$rr,$sbp,$dbp,$organ)=mysql_fetch_array($resultopd);	

$sql = "Select sum(paid),credit From report_serviceopacc where hn = '$hn' and txdate like '$thimonth%'  ";
list($price,$credit)  = mysql_fetch_row(mysql_query($sql));
	
$sql1 = "Select sum(paid) From report_serviceopacc where hn = '$hn' and txdate like '$thimonth%' and credit = '�Թʴ' ";
list($paycash)  = mysql_fetch_row(mysql_query($sql1));
$payprice=$paycash;
if(empty($payprice) || $payprice==0){
$payprice="0.00";
}
$actualpay=$paycash;
if(empty($actualpay) || $actualpay==0){
$actualpay="0.00";
}	
$date=substr($date,0,10);
list($yy,$mm,$dd)=explode("-",$date);
$yy=$yy-543;
$daterecord="$yy$mm$dd";

$regis1=substr($thidate,0,10);
$regis2=substr($thidate,11,19);
list($yy,$mm,$dd)=explode("-",$regis1);
$yy=$yy-543;
list($hh,$ss,$ii)=explode(":",$regis2);
$d_update=$yy.$mm.$dd.$hh.$ss.$ii;  //�ѹ��͹�շ���Ѻ��ا������
$date_serv="$yy$mm$dd";  //�ѹ������Ѻ��ԡ��
$time_serv="$hh$ss$ii";  //���ҷ�����Ѻ��ԡ��

$vn=sprintf("%03d",$vn);
$seq=$date_serv.$vn;	  //�ӴѺ���

$location="1";  //����駢ͧ������������Ѻ��ԡ��
if($toborow=="EX04 �����¹Ѵ"){
		$typein="2";  //������������Ѻ��ԡ��
		$intime="1";  //�������Ѻ��ԡ��
}else if($toborow=="EX11 �ѡ���ä�͡�����Ҫ���"){
		$typein="1";  //������������Ѻ��ԡ��
		$intime="2";  //�������Ѻ��ԡ��
}else  if($toborow=="EX01 �ѡ���ä�����������Ҫ���"){
		$typein="1";  //������������Ѻ��ԡ��
		$intime="1";	  //�������Ѻ��ԡ��	
}else{
		$typein="1";  //������������Ѻ��ԡ��
		$intime="1";  //�������Ѻ��ԡ��
	}
	


// ����� ptrightdetail
if( !empty($ptrightdetail) ){
	$sqlptr = "Select code From  ptrightdetail where detail='$ptrightdetail'";
	$resultptr = mysql_query($sqlptr) or die(mysql_error());
	list($instype) = mysql_fetch_row($resultptr);
}else{
	$newptright = substr($ptright,0,3);
	if($newptright == "R01" || $newptright == "R05"){  //�Թʴ
		$instype = "9100";  //�������Է�ԡ���ѡ��
	}else if($newptright == "R02" || $newptright == "R03"  || $newptright == "R04"){  //�ç����ԡ���µç
		$instype = "1100";  //�������Է�ԡ���ѡ��
	}else if($newptright == "R06"){  //�.�.�.������ͧ�����ʺ��¨ҡö
		$instype = "6100";  //�������Է�ԡ���ѡ��
	}else if($newptright == "R07"){  //��Сѹ�ѧ��
		$instype = "4200";  //�������Է�ԡ���ѡ��
	}else if($newptright == "R09"){  //��Сѹ�آ�Ҿ��ǹ˹��
		$instype = "0100";  //�������Է�ԡ���ѡ��
	}
}

	

if(!empty($an)){  //ʶҹм�����Ѻ��ԡ��
	$typeout="2";    //�Ѻ����ѡ�ҵ��
}else{
	$typeout="1";  //��Ѻ��ҹ
}
		
$insid="";  //�Ţ���ѵõ���Է��
$causein="1";  //���˵ء���觼�����
$servplace="1";  //ʶҹ����ԡ��
$referouthos="";  //ʶҹ��Һ�ŷ���觵��

$organ1 = str_replace("/\r\n|\r|\n/","<br/>|<br>",$organ);
$organ2=(string)$organ1;
$chiefcomp=ereg_replace('[[:space:]]+', '', trim($organ2)); 

if(empty($price) || $price=="0.00"){
	$price="50.00";
}

echo "$hospcode|$hn|$hn|$seq|$date_serv|$time_serv|$location|$intime|$instype|$insid|$hospcode|$typein|$hospcode|$causein|$chiefcomp|$servplace|$btemp|$sbp|$dbp|$pr|$rr|$typeout|$referouthos|$caseout|$cost|$price|$payprice|$actualpay|$d_update<br>";			

}  //close while