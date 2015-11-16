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

		$select_day = $_POST["yr"]."-".$_POST["m"]."-".$_POST["d"];
		

		$day_now = $_POST["d"];
		$month_now = $_POST["m"];
		$year_now = $_POST["yr"];

	}else{
		$select_day = (date("Y")+543).date("-m-d");
		
		$day_now = date("d");
		$month_now = date("m");
		$year_now = (date("Y")+543);

	}
?>
	<SCRIPT LANGUAGE="JavaScript">
	
		function wprint(){

			document.getElementById("form_01").style.display='none';
			window.print();

		}
	
	</SCRIPT>

<?php



		$_GET["d"] = sprintf('%02d',$_GET["d"]);

		$select_day = $_GET["yr"]."-".$_GET["m"]."-".$_GET["d"];
		

		$day_now = $_GET["d"];
		$month_now = $_GET["m"];
		$year_now = $_GET["yr"];

		$select_day2 = $_GET["yr2"]."-".$_GET["m2"]."-".$_GET["d2"];
		

		$day_now2 = $_GET["d2"];
		$month_now2 = $_GET["m2"];
		$year_now2 = $_GET["yr2"];

		if(strlen($select_day) != 10 || strlen($select_day2) != 10){
			exit();
		}

		if($_GET["dx"] != ""){
			$where .= " AND `dx` = '".$_GET["dx"]."'";
		}

				$sql = "SELECT a.`row_id` , a.`vn` , a.`hn` , a.`an` , a.`dx` , a.`organ` , a.`maintenance` , a.`doctor` , CONCAT( b.`yot` , ' ', b.`name` , ' ', b.`surname` ) AS `full_name` , `age` , `list_ptright` , left( `time_in` , 5 ) AS `left2in` , left( `time_out` , 5 ) AS `left2` , `cure` , `admit_ward` , `refer_hospital` , CONCAT( a.`time_in` , ' ', date_format( a.`date` , '%H:%i:%s' ) ) AS `h_date` , `time_in` , left( `time_diag` , 5 ) AS `time_diag2` , date_format( `date_in` , '%d/%m/%Y' ) AS `date_in2` , `type_wounded` , `type_wounded2` , `repeat`, `to_or`,  `to_lr`,  `to_etc`,  `to_hpt_lp`  FROM `trauma` AS a, `opcard` AS b WHERE a.`hn` = b.`hn` AND ( a.date_in between '".$select_day." 00:00:00' AND '".$select_day2." 23:59:59' ) ".$where."  ORDER BY a.`date_in` ASC , `h_date` ASC";

		$echoka = "";
		$echoka1 = "";
		$i=0;

		$result = Mysql_Query($sql) or die(Mysql_Error());
		$rows = Mysql_num_rows($result);
		?>
จำนวนข้อมูลทั้งหมด  <?php echo $rows;?>
<TABLE cellpadding="2" cellspacing="0" border="1" bordercolor="#000000" style='BORDER-COLLAPSE: collapse'>
<TR>
	<TD align="center">No.</TD>
	<TD align="center">HN</TD>
	<TD align="center">AN</TD>
	
	<TD>ยศชื่อ-สกุล</TD>
	<TD align="center">อายุ</TD>
	<TD align="center">สังกัด</TD>
	<TD align="center">Dx.</TD>
	<TD align="center">Dr.</TD>
	<TD align="center">ประเภทที่ 1</TD>
	<TD align="center">ประเภทที่ 2</TD>
	<TD align="center">อาการ</TD>
	<TD align="center">การรักษา</TD>
	<TD align="center">เวลาเข้า</TD>
	<TD align="center">เวลาตรวจ</TD>
	<TD align="center">ช่วงเวลา1</TD>
	<TD align="center">D/C</TD>
	<TD align="center">ช่วงเวลา2</TD>
	<TD align="center">หมายเหตุ</TD>
</TR>
<?php



		while(list($row_id, $vn,$hn,$an,$dx,$organ, $maintenance, $doctor, $fullname, $age, $list_ptright2, $time_in, $time_out, $cure, $admit_ward, $refer_hospital, $h_date, $time_in, $time_diag, $date_in, $type_wounded, $type_wounded2, $repeat, $to_or, $to_lr,$to_etc, $to_hpt_lp) = Mysql_fetch_row($result)){

$bgcolor= "#FFFFFF";	


		if($type_wounded2 != "" && $type_wounded != $type_wounded2 )
			$bgcolor = "#B8FF88";
		else
		if($time_diag != "00:00" && $time_diag != ""){
			
			if(substr($time_in,0,2) == "23"  && substr($time_diag,0,2) == "00"){
				
				$xxx = strtotime(date("Y-m-d ").$time_in.":00");
				$yyy = strtotime(date("Y-m-d ",mktime('0','0','0',date("m"),date("d")+1,date("Y"))).$time_diag.":00");

			}else{
				$xxx = strtotime(date("Y-m-d ").$time_in.":00");
				$yyy = strtotime(date("Y-m-d ").$time_diag.":00");
			}
			$sec_between1 = ($yyy - $xxx)/60 ;

			if(($type_wounded == "1" && $sec_between1 > 10) || ($type_wounded == "2" && $sec_between1 > 20)){
				$bgcolor= "#FFAAAA";
			}

			if($sec_between1 < 0)
				$sec_between1 = "N/A";
			else
				$sec_between1 .= " นาที";
			
			

		}else{
			$sec_between1 = "&nbsp;";
		}

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
		


		if(empty($_POST["d"])){
			$time_in = $date_in."<BR>".$time_in;
		}

		$i++;
		echo "<TR bgcolor=\"".$bgcolor."\">
						<TD>",$i,".</TD>
						<TD>",$hn,"</TD>
						<TD>&nbsp;",$an,"</TD>
						
						<TD>",$fullname,"</TD>
						<TD>",$age,"</TD>
						<TD>",$list_ptright[$list_ptright2],"</TD>
						<TD><A HREF=\"trauma_edit.php?title_name=".urlencode("DX")."&fn=dx&row_id=".$row_id."\" target=\"_blank\">",$dx,"</A></TD>
						<TD>",substr($doctor,5),"</TD>
						<TD align=\"center\">",$type_wounded,"</TD>
						<TD align=\"center\">",$type_wounded2,"</TD>
						<TD><A HREF=\"trauma_edit.php?title_name=".urlencode("อาการ")."&fn=organ&row_id=".$row_id."\" target=\"_blank\">",$organ,"</A></TD>
						<TD><A HREF=\"trauma_edit.php?title_name=".urlencode("การรักษา")."&fn=maintenance&row_id=".$row_id."\" target=\"_blank\">",$maintenance,"</A></TD>
						<TD align=\"center\">",$time_in,"</TD>
						<TD>&nbsp;",($time_diag=='00:00' ? '&nbsp;':$time_diag),"</TD>
						<TD align=\"center\">".$sec_between1."</TD>
						<TD>",$time_out,"</TD>
						<TD align=\"center\">".$sec_between2."</TD>
						";
			if($cure == "admit")
				$remark = "Admit หอผู้ป่วย ".$admit_ward."<BR> ";
			else if($cure == "refer")
				$remark = "Refer ".$refer_hospital."<BR> ";
			else if($cure == "no")
				$remark = "ไม่รอรับบริการ<BR> ";
			else
				$remark = "&nbsp;";
			
			if($repeat == "1"){
				$remark .= " (มาตรวจซ้ำ)<BR>";
			}
			if($to_or == "1"){
				$remark .= " ส่งต่อ OR<BR>";
			}
			if($to_lr == "1"){
				$remark .= " ส่งต่อ LR<BR>";
			}
			if($to_etc != "" && $to_etc != "---------"){
				$remark .= $to_etc." <BR>";
			}
			if($to_hpt_lp == "1"){
				$remark .= " แนะนำรักษาต่อรพ.ลำปาง<BR>";
			}

			echo "<TD>".$remark."</TD>";

			echo "</TR>";

		}

	

?>
</TABLE>

</body>
</html>





<?php include("unconnect.inc");?>