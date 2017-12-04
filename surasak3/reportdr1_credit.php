<?php

set_time_limit(30);
include("connect.inc");

$list_ptright["R01"] = 'เงินสด' ;
$list_ptright["R02"] = 'เบิกคลังจังหวัด' ;
$list_ptright["R03"] = 'โครงการเบิกจ่ายตรง' ;
$list_ptright["R04"] = 'รัฐวิสาหกิจ';
$list_ptright["R05"] = 'บริษัท(มหาชน)' ;
$list_ptright["R06"] = 'พ.ร.บ.คุ้มครองผู้ประสบภัยจากรถ' ;
$list_ptright["R07"] = 'ประกันสังคม' ;
$list_ptright["R08"] = 'ก.ท.44(บาดเจ็บในงาน)' ;
$list_ptright["R09"] = 'ประกันสุขภาพถ้วนหน้า';
$list_ptright["R10"] = 'ประกันสุขภาพถ้วนหน้า(เด็กเกิดใหม่)';
$list_ptright["R11"] = 'ประกันสุขภาพถ้วนหน้า(มาตรา8)';
$list_ptright["R12"] = 'ประกันสุขภาพถ้วนหน้า(ทหารผ่านศึก/ผู้พิการ)' ;
$list_ptright["R13"] = 'ประกันสุขภาพถ้วนหน้า(ในจังหวัดฉุกเฉิน)';
$list_ptright["R14"] = 'ประกันสุขภาพถ้วนหน้า(นอกจังหวัดฉุกเฉิน)' ;
$list_ptright["R15"] = 'ประกันสุขภาพนักเรียน(บริษัท)' ;
$list_ptright["R16"] = 'ศึกษาธิการ(ครูเอกชน)';
$list_ptright["R17"] = 'พลทหาร';
$list_ptright["R18"] = 'โครงการรักษาโรคไต (HD)';
$list_ptright["R19"] = 'โครงการนภา(NAPA)';
$list_ptright["R20"] = 'ประกันสังคมกรณีคลอดบุตร';
$list_ptright["R21"] = 'องค์กรปกครองส่วนท้องถิ่น';
$list_ptright["R22"] = 'ตรวจสุขภาพประจำปีกองทัพบก';
$list_ptright["R23"] = 'นักเรียน/นักศึกษาทหาร';



if(isset($_GET["submit"])){

		$_GET["d"] = sprintf('%02d',$_GET["d"]);
		$_GET["m"] = sprintf('%02d',$_GET["m"]);
		$_GET["d2"] = sprintf('%02d',$_GET["d2"]);
		$_GET["m2"] = sprintf('%02d',$_GET["m2"]);

		$select_day = $_GET["yr"]."-".$_GET["m"]."-".$_GET["d"];
		

		$day_now = $_GET["d"];
		$month_now = $_GET["m"];
		$year_now = $_GET["yr"];

		$select_day2 = $_GET["yr2"]."-".$_GET["m2"]."-".$_GET["d2"];
		

		$day_now2 = $_GET["d2"];
		$month_now2 = $_GET["m2"];
		$year_now2 = $_GET["yr2"];
		

	}else{

		$select_day = (date("Y")+543).date("-m-d");
		$day_now = date("d");
		$month_now = date("m");
		$year_now = (date("Y")+543);

		$select_day2 = (date("Y")+543).date("-m-d");
		$day_now2 = date("d");
		$month_now2 = date("m");
		$year_now2 = (date("Y")+543);


	}

?>
<html>
<head>
<title>สรุป</title>
<style type="text/css">


a:link {color:#000000; text-decoration:none;}
a:visited {color:#000000; text-decoration:none;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}

body,td,th {
	font-family:  MS Sans Serif;
	font-size: 14 px;
}

.font_title{
	font-family:  MS Sans Serif;
	font-size: 14 px;
	color:#FFFFFF;
	font-weight: bold;

}
</style>
</head>
<body>

<form name="" method='GET' action='<?php echo $_SERVER["PHP_SELF"];?>'>
	<TABLE id="form_01">
	<TR>
		<TD>
		วันที่&nbsp;&nbsp; 
	<input type='text' name='d' size='2' value='<?php echo $day_now;?>'>&nbsp;&nbsp;
	เดือน&nbsp; <input type='text' name='m' size='4' value='<?php echo $month_now;?>'>&nbsp;&nbsp;&nbsp;
	พ.ศ. <input type='text' name='yr' size='8' value='<?php echo $year_now;?>'>
		</TD>
	</TR>
	<TR>
		<TD>
		ถึง วันที่&nbsp;&nbsp; 
	<input type='text' name='d2' size='2' value='<?php echo $day_now2;?>'>&nbsp;&nbsp;
	เดือน&nbsp; <input type='text' name='m2' size='4' value='<?php echo $month_now2;?>'>&nbsp;&nbsp;&nbsp;
	พ.ศ. <input type='text' name='yr2' size='8' value='<?php echo $year_now2;?>'>
		</TD>
	</TR>
	<TR>
		<TD><input type='submit' value='     ตกลง     ' > <INPUT TYPE="button" value="print" onclick="wprint();"></TD>
	</TR>
	</TABLE>
	<INPUT TYPE="hidden" name="submit" value="true">
	</form>


<?php
if(strlen($select_day) == 10 && strlen($select_day2) == 10 ){

	$sql = "create temporary table opacc_now Select price, credit   From opacc where an = ''  AND (date between '".$select_day." 00:00:00' AND '".$select_day2." 23:59:59 ') AND credit <> '' AND credit <> 'ยกเลิก' ";
	$result = Mysql_Query($sql) or die(mysql_error());

	$sql = "Select credit, sum(price) as sum_p From opacc_now group by credit having sum(price) > 0 Order by sum_p DESC ";
	$result = Mysql_Query($sql) or die(mysql_error());

	echo "<table border='1' bordercolor=\"#000000\" width='500' cellpadding=\"2\" cellspacing=\"0\">";
	echo "<TR align=\"center\" style=\"background-color: #0055AA; color:#FFFFFF;font-weight: bold;\" >";
		echo "<TD>ใบเสร็จ</TD>";
		echo "<TD>ราคา</TD>";
	echo "</TR>";
	$i=0;
		while($arr = mysql_fetch_assoc($result)){

			if($i==0){
				$color = "#FFD1A4";
				$i=1;
			}else{
				$color = "#FFFFFF";
				$i=0;
			}

			echo "<TR bgcolor=\"".$color."\">";
				echo "<TD>&nbsp;",$arr["credit"],"</TD>";
				echo "<TD align=\"right\">",number_format($arr["sum_p"],2,".",","),"</TD>";
			echo "</TR>";
		}
	echo "</table>";

}

   include("unconnect.inc");
?>
</body>
</html>


