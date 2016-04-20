<?php
include("../connect.inc");
$thiyr=$thiyr-543;
$yrmonth="$thiyr-$rptmo";
$yy=543;

print "1. ฐานข้อมูลด้านการแพทย์และสุขภาพ ในรูปแบบ 43 แฟ้มมาตรฐาน แฟ้มที่2 ตาราง ADDRESS ประจำเดือน $yrmonth <a target=_self  href='../../nindex.htm'><<ไปเมนู</a><br> ";

   $sql="SELECT a.hn,a.changwat,a.ampur,a.dbirth,a.sex,a.married,a.career,a.nation,a.idcard,b.thidate,a.yot,a.name,a.surname,a.education,a.career,a.address,a.tambol,a.ampur,a.religion,a.regisdate,b.thidate,a.blood,a.idguard,a.hphone,a.phone From opcard as a,opday as b where a.hn=b.hn AND a.regisdate like '$yrmonth%'  group by a.hn";


   $result = mysql_query($sql) or die(mysql_error());
    while (list ($hn,$changwat,$amphur,$dob,$sex,$marringe,$occupa,$nation,$id,$thidate,$yot,$name,$surname,$education,$career,$address,$tambol,$ampur,$religion,$regisdate,$thidate,$blood,$idguard,$hphone,$phone) = mysql_fetch_row ($result)) {	
	$sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
	list($hospcode)=mysql_fetch_array($sqlhos);

$sql ="SELECT DISTRICT_CODE ,AMPHUR_CODE,PROVINCE_CODE FROM `district` INNER JOIN `amphur` ON `district`.`AMPHUR_ID` = `amphur`.`AMPHUR_ID` INNER JOIN `province` ON `amphur`.`PROVINCE_ID` = `province`.`PROVINCE_ID` where `province`.`PROVINCE_NAME`='$changwat' AND `district`.`district_name` ='$tambol' AND `amphur`.`amphur_name` = '$ampur' ";

$row = mysql_query($sql);
list($cdistrict,$camphur,$cprovince) = mysql_fetch_array($row);

$cdistrict=substr($cdistrict,4,2);
$camphur=substr($camphur,2,2);
$subadd = explode(" ",$address); 
$num_address = $subadd[0];
$posmoo = strpos($address,"ม.");
if($posmoo!=false){
	$moo = substr($address,$posmoo+2,2);
	if($moo<=9){
		$moo = "0".$moo;
	}
}
       echo  "$hospcode|$hn|||9|||$num_address|||||$moo|$cdistrict|$camphur|$cprovince|$hphone|$phone|$d_update<br>";
       }
include("unconnect.inc");
?>
