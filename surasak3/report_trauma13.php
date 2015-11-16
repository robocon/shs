<?php
session_start();
include("connect.inc");

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

<?php
	
	
	$list_ptright = array();
	
	$list_ptright["P01"] = "-------";
	$list_ptright["P02"] = "ทหาร (น)";
	$list_ptright["P03"] = "ทหาร (นส)";
	$list_ptright["P04"] = "ทหาร (พลฯ)";
	$list_ptright["P05"] = "ครอบครัว";
	$list_ptright["P06"] = "พ.ต้น";
	$list_ptright["P07"] = "พ.";
	$list_ptright["P08"] = "ประกันสังคม";
	$list_ptright["P09"] = "30บาท";
	$list_ptright["P10"] = "30บาทฉุกเฉิน";
	$list_ptright["P11"] = "พรบ.";
	$list_ptright["P12"] = "กท.44";
	
	function echo_ka($time){
		

		if($time >= "07:31" && $time < "15:31"){
			$ka = "เช้า";
		}else if($time >= "15:31" && $time < "23:31"){
			$ka = "บ่าย";
		}else if($time >= "23:31" && $time <= "23:59"){
			$ka = "ดึก";
		}else if($time >= "00:00" && $time < "07:31"){
			$ka = "ดึก";
		}
		
		return $ka;

	}


	if(isset($_POST["submit"])){

		$_POST["d"] = sprintf('%02d',$_POST["d"]);

		$select_day = $_POST["yr"]."-".$_POST["m"]."-".$_POST["d"];
		

		$day_now = $_POST["d"];
		$month_now = $_POST["m"];
		$year_now = $_POST["yr"];

		$select_day2 = $_POST["yr2"]."-".$_POST["m2"]."-".$_POST["d2"];
		

		$day_now2 = $_POST["d2"];
		$month_now2 = $_POST["m2"];
		$year_now2 = $_POST["yr2"];
		


	}else{

		$select_day = (date("Y")+543).date("-m-d");
		$day_now = date("d");
		$month_now = date("m");
		$year_now = (date("Y")+543);

		$select_day2 = (date("Y",mktime(0,0,0,$month_now,$day_now+1,$year_now-543))+543).date("-m-d",mktime(0,0,0,$month_now,$day_now+1,$year_now-543));

		$day_now2 = date("d",mktime(0,0,0,$month_now,$day_now+1,$year_now-543));
		$month_now2 = date("m",mktime(0,0,0,$month_now,$day_now+1,$year_now-543));
		$year_now2 = (date("Y",mktime(0,0,0,$month_now,$day_now+1,$year_now-543))+543);


	}
?>
	<SCRIPT LANGUAGE="JavaScript">
	
		function wprint(){

			window.print();

		}
	
	</SCRIPT>
	<style media="print">
		.hid_p { display:none; }
	</style>
	<form method='POST' action='<?php echo $_SERVER["PHP_SELF"]?>'>
	<TABLE id="form_01" class="hid_p">
	<TR>
		<TD>
		วันที่&nbsp;&nbsp; 
	<input type='text' name='d' size='2' value='<?php echo $day_now;?>'>&nbsp;&nbsp;
	เดือน&nbsp; <input type='text' name='m' size='4' value='<?php echo $month_now;?>'>&nbsp;&nbsp;&nbsp;
	พ.ศ. <input type='text' name='yr' size='8' value='<?php echo $year_now;?>'>		</TD>
	</TR>
	<TR>
		<TD>
		ถึง วันที่&nbsp;&nbsp; 
	<input type='text' name='d2' size='2' value='<?php echo $day_now2;?>'>&nbsp;&nbsp;
	เดือน&nbsp; <input type='text' name='m2' size='4' value='<?php echo $month_now2;?>'>&nbsp;&nbsp;&nbsp;
	พ.ศ. <input type='text' name='yr2' size='8' value='<?php echo $year_now2;?>'>		</TD>
	</TR>
	<TR>
		<TD><input type='submit' name="submit" value='     ตกลง     ' > <INPUT TYPE="button" value="print" onClick="wprint();"></TD>
	</TR>
	</TABLE>
	</form>
<?php

if(isset($_POST["submit"])){
		
		
		
		$where .= " ( a.`date_in`  between '".$select_day." 00:00:00' AND '".$select_day2." 23:59:59' ) ";
		
		$xx = explode("-",$select_day);

		$select_day_w2 = date("-m-d",mktime('0','0','0',$xx[1]-1,$xx[2],$xx[0]-543));
		$select_day_w2_Y = date("Y",mktime('0','0','0',$xx[1]-1,$xx[2],$xx[0]-543));

		$where2 = " ( a.`date_in`  between '".($select_day_w2_Y+543).$select_day_w2." 00:00:00' AND '".$select_day2." 23:59:59' ) ";

		$sql = "Create temporary table trauma_2 Select * From trauma as a where ".$where2." AND  `repeat` = '' ";
		$result = Mysql_Query($sql) or die(mysql_error());

				$sql = "SELECT a.`row_id` , a.`vn` , a.`hn` , a.`an` , a.`dx` , a.`organ` , a.`maintenance` , a.`doctor` , CONCAT( b.`yot` , ' ', b.`name` , ' ', b.`surname` ) AS `full_name` , `age` , `list_ptright` , left( `time_in` , 5 ) AS `left2in` , left( `time_out` , 5 ) AS `left2` , `cure` , `admit_ward` , `refer_hospital` , CONCAT( a.`time_in` , ' ', date_format( a.`date` , '%H:%i:%s' ) ) AS `h_date` , `time_in` , left( `time_diag` , 5 ) AS `time_diag2` , date_format( `date_in` , '%d/%m/%Y' ) AS `date_in2` , `type_wounded` , `type_wounded2` , `repeat`, `to_or`,  `to_lr` , `to_hpt_lp`, `date_in` FROM `trauma` AS a, `opcard` AS b WHERE ".$where." AND a.`hn` = b.`hn`   AND `repeat` = '1' ORDER BY a.`date_in` ASC , `h_date` ASC";
				//echo $sql,"<BR>";
		
		
		$echoka = "";
		$echoka1 = "";
		$i=0;

		$result = Mysql_Query($sql);
		$rows = Mysql_num_rows($result);
		?>
จำนวนข้อมูลทั้งหมด  <?php echo $rows;?>
<TABLE cellpadding="2" cellspacing="0" border="1" bordercolor="#000000" style='BORDER-COLLAPSE: collapse'>
<TR>
	<TD align="center">No.</TD>
	<TD align="center">HN</TD>
	<TD align="center">AN</TD>
	
	<TD>ยศชื่อ-สกุล</TD>
	<TD align="center">Dx.</TD>
	<TD align="center">Dr.</TD>
	<TD align="center">ประเภทที่ 1</TD>
	<TD align="center">ประเภทที่ 2</TD>
	<TD align="center">อาการ</TD>
	<TD align="center">การรักษา</TD>
	<TD align="center">วันที่ตรวจ</TD>
	<TD align="center">เวลาเข้า</TD>
	<TD align="center">เวลาตรวจ</TD>
	<TD align="center">D/C</TD>
</TR>
<?php



		while(list($row_id, $vn,$hn,$an,$dx,$organ, $maintenance, $doctor, $fullname, $age, $list_ptright2, $time_in, $time_out, $cure, $admit_ward, $refer_hospital, $h_date, $time_in, $time_diag, $date_in, $type_wounded, $type_wounded2, $repeat,$to_or, $to_lr, $to_hpt_lp, $date_in2) = Mysql_fetch_row($result)){

		$bgcolor= "#FFFFFF";	

		if(substr($time_in,0,2) == "23"  && substr($time_out,0,2) == "00"){
			$xxx = strtotime(date("Y-m-d ").$time_in.":00");
			$yyy = strtotime(date("Y-m-d ",mktime('0','0','0',date("m"),date("d")+1,date("Y"))).$time_out.":00");
		}else{
			$xxx = strtotime(date("Y-m-d ").$time_in.":00");
			$yyy = strtotime(date("Y-m-d ").$time_out.":00");
		}

			$sec_between2 = ($yyy - $xxx)/60 ;

			if($sec_between2 < 0)
				$sec_between2 = "N/A";
			else
				$sec_between2 .= " นาที";
		

		$i++;

		if($i%2==0)
			$bgcolor="#FFFFFF";
		else
			$bgcolor="#FFFFAA";

		echo "<TR bgcolor=\"".$bgcolor."\">
						<TD>",$i,".</TD>
						<TD>",$hn,"</TD>
						<TD>&nbsp;",$an,"</TD>
						<TD>",$fullname,"</TD>
						<TD>",$dx,"</TD>
						<TD>",substr($doctor,5),"</TD>
						<TD align=\"center\">",$type_wounded,"</TD>
						<TD align=\"center\">",$type_wounded2,"</TD>
						<TD>",$organ,"</TD>
						<TD>",$maintenance,"</TD>
						<TD align=\"center\">",$date_in,"</TD>
						<TD align=\"center\">",$time_in,"</TD>
						<TD>&nbsp;",($time_diag=='00:00' ? '&nbsp;':$time_diag),"</TD>
						<TD>",$time_out,"</TD>
	
						";
			

			echo "</TR>";

$sql2 = "Select  `dx` , `organ` , `maintenance` , `doctor` , left( `time_in` , 5 ) AS `left2in` , left( `time_out` , 5 ) AS `left2` , left( `time_diag` , 5 ) AS `time_diag2` , date_format( `date_in` , '%d/%m/%Y' ) AS `date_in2` , `type_wounded` , `type_wounded2`  From trauma_2 where   hn = '".$hn."' AND((date_in < '".$date_in2."') OR (date_in = '".$date_in2."' AND time_in < '".$time_in.":00' )) Order by date_in DESC , time_in DESC  limit 0,1";
//echo "<!-- ",$sql2," -->";
$result2 = mysql_query($sql2) or die(mysql_error());
list($dx , $organ , $maintenance , $doctor , $time_in , $time_out , $time_diag, $date_in, $type_wounded , $type_wounded2 ) = mysql_fetch_row($result2);

			echo "<TR bgcolor=\"".$bgcolor."\">";
			echo "
						<TD colspan='4' align='center'>มาตรวจครั้งแรก </TD>
						<TD>",$dx,"</TD>
						<TD>",substr($doctor,5),"</TD>
						<TD align=\"center\">",$type_wounded,"</TD>
						<TD align=\"center\">",$type_wounded2,"</TD>
						<TD>",$organ,"</TD>
						<TD>",$maintenance,"</TD>
						<TD align=\"center\">",$date_in,"</TD>
						<TD align=\"center\">",$time_in,"</TD>
						<TD>&nbsp;",($time_diag=='00:00' ? '&nbsp;':$time_diag),"</TD>
						<TD>",$time_out,"</TD>
			";
			echo "</TR>";

		}

	}

?>
</TABLE>

</body>
</html>





<?php include("unconnect.inc");?>