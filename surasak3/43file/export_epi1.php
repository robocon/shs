<?php
include("../connect.inc");
$newyear = "$thiyr$rptmo$day";
$thimonth = "$thiyr-$rptmo";
$thiyr = $thiyr-543;
$yrmonth = "$thiyr-$rptmo";
$yy = 543;

print "1. ฐานข้อมูลด้านการแพทย์และสุขภาพ ในรูปแบบ 43 แฟ้มมาตรฐาน แฟ้มที่22 ตาราง EPI ประจำเดือน $yrmonth <a target=_self  href='../../nindex.htm'><<ไปเมนู</a><br> ";

$sql22="SELECT thidate,hn,drugcode  
FROM trauma_inject 
WHERE thidate LIKE '$thimonth%' 
GROUP BY `hn`";
$result22 = mysql_query($sql22) or die("Query Create file epi Error");
$num22 = mysql_num_rows($result22);

$i=0;
while (list ($thidate,$hn,$drugcode) = mysql_fetch_row ($result22)) {
	$i++;
	$sqlhos22=mysql_query("select pcucode from mainhospital where pcuid='1'");
	list($hospcode)=mysql_fetch_array($sqlhos22);

	$chkdate=substr($thidate,0,10);	
	$sqlopd22="select vn,doctor 
	from opday 
	where thidate like '$chkdate%' 
	and hn='$hn'";
	//echo $sqlopd1;
	$resultopd22=mysql_query($sqlopd22);	
	list($vn,$doctor)=mysql_fetch_array($resultopd22);	
	$newdoctor=substr($doctor,7,10);

	if($drugcode=='0TT'){$vaccinetype='101';}else{$vaccinetype='111';};

	$regis1=substr($thidate,0,10);
	$regis2=substr($thidate,11,19);
	list($yy,$mm,$dd)=explode("-",$regis1);
	list($hh,$ss,$ii)=explode(":",$regis2);
	$yy=$yy-543;
	$d_update=$yy.$mm.$dd.$hh.$ss.$ii;

	$date_serv="$yy$mm$dd";
	$vn=sprintf("%03d",$vn);
	$seq = $date_serv.$vn;	  //ลำดับที่	

	$sqldoc22=mysql_query("select doctorcode from doctor where name like'%$newdoctor%'");
	list($doctorcode)=mysql_fetch_array($sqldoc22);
	if(empty($doctorcode)){
		$sqldoc22=mysql_query("select codedoctor from inputm where name like'%$doctor%'");
		list($doctorcode)=mysql_fetch_array($sqldoc22);
		if(empty($doctorcode)){
			$provider=$date_serv.$vn."00000";
		}else{
			$provider=$date_serv.$vn.$doctorcode;
		}
	}else{
		$provider=$date_serv.$vn.$doctorcode;
	}	

	echo "$hospcode|$hn|$seq|$date_serv|$vaccinetype|$hospcode|$provider|$d_update<br>";		

}  //close while

if($num22 == $i){
	$sql221="SELECT date,hn,drugcode  
	FROM drugrx 
	WHERE date LIKE '$thimonth%' 
	and drugcode like '0INF2015%' 
	and amount='1' 
	group by hn";
	$result221 = mysql_query($sql221) or die("Query Create file epi Error");
	while (list ($thidate,$hn,$drugcode) = mysql_fetch_row ($result221)) {	
		$sqlhos221=mysql_query("select pcucode from mainhospital where pcuid='1'");
		list($hospcode)=mysql_fetch_array($sqlhos221);

		$chkdate=substr($thidate,0,10);	
		$sqlopd221="select vn,doctor 
		from opday 
		where thidate like '$chkdate%' 
		and hn='$hn'";
		//echo $sqlopd1;
		$resultopd221=mysql_query($sqlopd221);	
		list($vn,$doctor)=mysql_fetch_array($resultopd221);	
		$newdoctor=substr($doctor,7,10);

		$vaccinetype='815';

		$regis1=substr($thidate,0,10);
		$regis2=substr($thidate,11,19);
		list($yy,$mm,$dd)=explode("-",$regis1);
		list($hh,$ss,$ii)=explode(":",$regis2);
		$yy=$yy-543;
		$d_update=$yy.$mm.$dd.$hh.$ss.$ii;

		$date_serv="$yy$mm$dd";
		$vn=sprintf("%03d",$vn);
		$seq=$date_serv.$vn;	  //ลำดับที่	

		$sqldoc22=mysql_query("select doctorcode from doctor where name like'%$newdoctor%'");
		list($doctorcode)=mysql_fetch_array($sqldoc22);
		if(empty($doctorcode)){
			$sqldoc22=mysql_query("select codedoctor from inputm where name like'%$doctor%'");
			list($doctorcode)=mysql_fetch_array($sqldoc22);
			if(empty($doctorcode)){
				$provider=$date_serv.$vn."00000";
			}else{
				$provider=$date_serv.$vn.$doctorcode;
			}
		}else{
			$provider=$date_serv.$vn.$doctorcode;
		}	

		echo "$hospcode|$hn|$seq|$date_serv|$vaccinetype|$hospcode|$provider|$d_update<br>";	

	}  //close while
}  //close if $num22==$i