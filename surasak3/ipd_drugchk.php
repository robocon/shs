<?php
session_start();
include("connect.inc");

     $month_["01"] = "มกราคม";
    $month_["02"] = "กุมภาพันธ์";
    $month_["03"] = "มีนาคม";
    $month_["04"] = "เมษายน";
    $month_["05"] = "พฤษภาคม";
    $month_["06"] = "มิถุนายน";
    $month_["07"] = "กรกฏาคม";
    $month_["08"] = "สิงหาคม";
    $month_["09"] = "กันยายน";
    $month_["10"] = "ตุลาคม";
    $month_["11"] = "พฤศจิกายน";
    $month_["12"] = "ธันวาคม";
	
	$list_status_drug["STAT1"] = "Stat";
	$list_status_drug["STAT"] = "One day";
	$list_status_drug["CONT"] = "Continue";
	$list_status_drug["OLD"] = "ยาเดิม";
	$list_status_drug["OLDEX"] = "ยาเดิมนอกโรงพยาบาล";	


include 'bootstrap.php';

$dbi = new mysqli(HOST, USER, PASS, DB);
$dbi->query("SET NAMES UTF8");


$action = sprintf("%s", $_REQUEST['action']);
$page = sprintf("%s", $_REQUEST['page']);

$wards = array(
    '42' => 'หอผู้ป่วยรวม',
    '43' => 'หอผู้ป่วยสูติ',
    '44' => 'หอผู้ป่วยICU',
    '45' => 'หอผู้ป่วยพิเศษ',
	'46' => 'หอผู้ป่วย Cohort Ward',
	'47' => 'หอผู้ป่วย Home Isolation',
	'48' => 'หอผู้ป่วย รพ.สนาม'
);

/*
เตียง1-9 ,301-310 พิเศษชั้นสาม
เตียง10-17,201-207 พิเศษชั้นสอง
*/
function getFullWardName($cbedcode){
    global $wards;
    $wardExTest = preg_match('/45.+/', $cbedcode);
    $exName = '';
    if( $wardExTest > 0 ){
        $wardBxTest = preg_match('/45(F[1-3]|M[1-6])/', $cbedcode); // B1-B9
        $wardR3Test = preg_match('/45R3[0-9]{2}/', $cbedcode); // R301-R310
        $exName = ($wardBxTest > 0 || $wardR3Test > 0) ? 'ชั้น3' : 'ชั้น2' ;
        
    }

    $short_code = substr($cbedcode,0,2);
    $fullWardName = $wards[$short_code].$exName;
    return $fullWardName;
}
?>

<style type="text/css">
body{ 
	font-family: 'TH SarabunPSK';
	background-color:#e1f5fe;
	font-size: 22px;
 }
a:link {color:#FF0000; text-decoration:underline;}
a:visited {color:#669900; text-decoration:underline;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}
.font_title{
	font-family: 'TH SarabunPSK';
	font-size: 22 px;
	color:#FFFFFF;
	font-weight: bold;

}
tr:hover {background-color: #dcedc8;}

*{
    font-family: "TH SarabunPSK","TH Sarabun New";
    font-size: 16pt;
}
p{
    margin: 0;
}
.chk_table{
    border-collapse: collapse;
}

.chk_table, th, td{
    border: 1px solid black;
    font-size: 16pt;
}

.chk_table th,
.chk_table td{
    padding: 3px;
}

tr{
    vertical-align: top;
}

#imgContainer{
    position: absolute;
    top: 2%;
    left: 2%;
    background-color: #ffffff;
    border: 2px solid #000000;
}
#imgContent{
    max-width: 210mm;
}
#imgBtnClose{
    text-align: center; 
    background-color: #b8b8b8;
}
#imgBtnClose:hover{
    cursor: pointer;
}
</style>
<SCRIPT LANGUAGE="JavaScript">
	
	function print_page(){
		
		document.getElementById('form_search').style.display='none';
		document.getElementById('print_button').style.display='none';
		setTimeout("window.print();",1500);

	}

</SCRIPT>

<?php

$getan=$_GET["an"];
$gethn=$_GET["hn"];
$getmonth=$_GET["month"];
$getyear=$_GET["year"];
$getdate=$_GET["date"];

if(trim($_REQUEST["an"]) == ""){
	exit();
}

if(isset($_REQUEST["an"])){


$an_now = $_REQUEST["an"];

$sql="CREATE TEMPORARY TABLE drugrx2 SELECT drugcode,tradname,slcode,statcon,date, amount FROM drugrx WHERE an = '".$an_now."' AND date LIKE '".$_REQUEST["year"]."-".$_REQUEST["month"]."%' AND slcode  <> '' AND  statcon is not NULL ";
$result = Mysql_Query($sql);

//echo $sql;


$sql="CREATE TEMPORARY TABLE dgprofile2 SELECT row_id, an, drugcode, tradname, onoff, slcode, statcon, dateoff,ranktime From dgprofile WHERE an = '".$an_now."' AND left( drugcode, 1 ) in ('0','1','2','3','4','5','6','7','8','9')";
$result = Mysql_Query($sql);

$sql = "Select distinct drugcode, tradname, slcode,statcon From drugrx2  Order by drugcode,statcon ASC ";
$result = Mysql_Query($sql);
if(mysql_num_rows($result) == 0){
	echo "ไม่พบหมายเลข AN หรือ ข้อมูลอาจเก่าเกินไปยังไม่ได้ใช้ระบบจ่ายยาคนไข้ในตัวใหม่";
exit();
}

while($arr = Mysql_fetch_assoc($result)){
	
	$sql2 = "Select date, amount From  drugrx2 where drugcode ='".$arr["drugcode"]."' AND slcode ='".$arr["slcode"]."' AND  statcon ='".$arr["statcon"]."' ";

	$result2 = Mysql_Query($sql2);

	while($arr2 = Mysql_fetch_assoc($result2)){

		$date_show = intval(substr($arr2["date"],8,-9));

		$sum[$arr["drugcode"]][$arr["slcode"]][$arr["statcon"]][$date_show] = $sum[$arr["drugcode"]][$arr["slcode"]][$arr["statcon"]][$date_show] + $arr2["amount"];
		
	}

}

mysql_data_seek($result, 0);

$sql_detail = "SELECT hn,an,ptname,age,ptright,bedcode,doctor,bed,diagnos FROM bed WHERE an = '".$_REQUEST["an"]."'";
$result_detail = Mysql_Query($sql_detail);
if(Mysql_num_rows($result_detail) == 0){
	$sql = "Select hn,an,ptname,age,ptright,bedcode,doctor,bed,diag From ipcard WHERE an = '".$_REQUEST["an"]."'";
	$result_detail = Mysql_Query($sql_detail);
	$arr = Mysql_fetch_assoc($result_detail);
}else{
	$arr = Mysql_fetch_assoc($result_detail);
}

			$sql_react = "Select drugcode,  tradname , advreact  From drugreact where hn = '".$arr["hn"]."'  ";

			$result_react = Mysql_Query($sql_react);
			$rows_react = Mysql_num_rows($result_react);
			if($rows_react> 0){
				echo "<FONT COLOR=\"red\">แพ้ยาทั้งหมด ".$rows_react." รายการ<BR>";
				while(list($drugcode,  $tradname , $advreact) = Mysql_fetch_row($result_react)){
					echo "[",$drugcode,"] : ", $tradname , " ( อาการ : ",$advreact," )<BR>";
				}
				echo "</FONT>";
			}
echo "<div style='margin-top:50px;'></div>";
echo "<CENTER>โรงพยาบาลค่ายสุรศักดิ์มนตรี</CENTER>";
echo "<CENTER>แบบบันทึกการใช้ยา/เวชภัณฑ์ผู้ป่วยใน</CENTER>";
echo "<CENTER>กองเภสัชกรรมเอกสารหมายเลข FR-PHA-001/11</CENTER>";
echo "<CENTER>
HN<U>&nbsp;&nbsp;",$arr["hn"],"&nbsp;&nbsp;</U>
AN<U>&nbsp;&nbsp;",$arr["an"],"&nbsp;&nbsp;</U>
ชื่อผู้ป่วย<U>&nbsp;&nbsp;",$arr["ptname"],"&nbsp;&nbsp;</U>
อายุ<U>&nbsp;&nbsp;",$arr["age"],"&nbsp;&nbsp;</U>
<BR>
สิทธิ์<U>&nbsp;&nbsp;",$arr["ptright"],"&nbsp;&nbsp;</U>
โรค<U>&nbsp;&nbsp;",$arr["diagnos"],"&nbsp;&nbsp;</U>
แพทย์<U>&nbsp;&nbsp;",$arr["doctor"],"&nbsp;&nbsp;</U>
</CENTER><BR>";
echo "<CENTER>ข้อมูลเดือน ".$month_[$_REQUEST["month"]]," ปี ",$_REQUEST["year"],"</CENTER><BR>";
echo "<TABLE border = '1' bordercolor=\"#000000\" cellspacing=\"0\" cellpadding=\"5\" width=\"95%\" align=\"center\" style=\"font-size:20px;\">
<TR align=\"center\" style=\"font-weight:bold;height: 70px;\" bgcolor='#00838f'>
	<TD>no.</TD>
	<TD>รหัสยา</TD>
	<TD>ชื่อยา</TD>
	<TD>วิธีใช้</TD>
	<TD>สถานะ</TD>";
for($i=1;$i<32;$i++)
	echo "<TD width='2%'>",$i,"</TD>";
	echo "<TD width='4%'>OFF</TD>";
	echo "<TD width='4%'>เวลาให้ยา</TD>";
echo "</TR>\n";
$i=1;
while($arr = Mysql_fetch_assoc($result)){
	if($i%2==0){ //$bgcolor="#FFFFBB"; 
		$bgcolor="#f5f5f5"; 
	}else{
		$bgcolor="#b2dfdb";
	}

	$sql = "Select row_id,ranktime From dgprofile2 where an = '".$_REQUEST["an"]."' AND drugcode = '".$arr["drugcode"]."' AND slcode= '".$arr["slcode"]."' AND statcon = '".$arr["statcon"]."'  limit 0,1 ";
	$result4 = Mysql_Query($sql);
	list($row_id,$ranktime) = Mysql_fetch_row($result4);
	//echo "==>".$row_id;

echo "<TR bgcolor='$bgcolor' style=\"height: 50px;\">
	<TD align='center'>&nbsp;",$i,"</TD>
	<TD><strong style='font-size:20px;'><a href='ipd_drugslip_template.php?row_id=$row_id&an=$getan&hn=$gethn&month=$getmonth&year=$getyear&date=$getdate'>",$arr["drugcode"],"</a></strong></TD>
	<TD>&nbsp;",$arr["tradname"],"</TD>
	<TD>&nbsp;",$arr["slcode"],"</TD>
	<TD>&nbsp;",$list_status_drug[$arr["statcon"]],"</TD>";

	for($j=1;$j<32;$j++)
	echo "<TD align=\"center\"><strong style='font-size:20px;'>",$sum[$arr["drugcode"]][$arr["slcode"]][$arr["statcon"]][$j],"</strong></TD>";
	
	$sql = "Select dateoff From dgprofile2 where an = '".$_REQUEST["an"]."' AND drugcode = '".$arr["drugcode"]."' AND onoff = 'OFF' AND slcode= '".$arr["slcode"]."' AND statcon = '".$arr["statcon"]."'  limit 0,1 ";
	$result2 = Mysql_Query($sql);
	list($dateoff) = Mysql_fetch_row($result2);
	if($dateoff != ""){
	$day = explode(" ",$dateoff);
		$date = explode("-",$day[0]);
		echo "<TD align=\"center\">",$date[2],"/",$date[1],"/",($date[0]+543),"<BR>",$day[1],"&nbsp;</TD>";
	}else{
		echo "<TD align=\"center\">&nbsp;&nbsp;</TD>";
	}
	echo "<TD align=\"center\">",$ranktime,"</TD>";
echo "</TR>\n";
$i++;

$endtime = "";
}

echo "</TABLE>";
	
}
	
?>
<br>