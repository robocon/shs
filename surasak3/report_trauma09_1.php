<?php
session_start();
include("connect.inc");
$date_field = "b.date";
if($_GET["action"] == "del"){

	$sql = "Delete From `trauma_inject` where row_id = '".$_GET["rowid"]."' ";
	Mysql_Query($sql);
	echo "<meta http-equiv=\"REFRESH\" content=\"0;url=report_inject.php\">";
exit();
}

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

$thmonthname = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");

if(isset($_POST["submit"])){

		$day_now = $_POST["d"];
		$month_now = $_POST["m"];
		$year_now = $_POST["yr"];

	}else{
	
		$day_now = date("d");
		$month_now = date("m");
		$year_now = (date("Y")+543);

	}

?>
<html>
<head>
<style type="text/css">


a:link {color:#000000; text-decoration:underline;}
a:visited {color:#000000; text-decoration:underline;}
a:active {color:#000000; text-decoration:underline;}
a:hover {color:#000000; text-decoration:underline;}

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
<SCRIPT LANGUAGE="JavaScript">
	
		function wprint(){

			document.getElementById("form_01").style.display='none';
			document.getElementById("menu1").style.display='none';
			window.print();

		}
	
	</SCRIPT>
	<form method='POST' action=''>
	<TABLE id="form_01">
	<TR>
		<TD>
		
	เดือน&nbsp; <input type='text' name='m' size='4' value='<?php echo $month_now;?>'>&nbsp;&nbsp;&nbsp;
	พ.ศ. <input type='text' name='yr' size='8' value='<?php echo $year_now;?>'>
		</TD>
	</TR>
	
	<TR>
		<TD><input type='submit' name="submit" value='     ตกลง     ' >&nbsp;<INPUT TYPE="button" value="print" onclick="wprint();"></TD>
	</TR>
	</TABLE>
	</form>
	<Div id="menu1" style="color:#FF0000;">
	<A HREF="report_trauma09.php" style="color:#FF0000;">ER</A> | <A HREF="report_trauma09_1.php?w=opd" style="color:#FF0000;">OPD</A> | <A HREF="report_trauma09_1.php?w=opd_eye" style="color:#FF0000;">จักษุ</A> | <A HREF="report_trauma09_1.php?w=opd_obg" style="color:#FF0000;">สูติ</A> | <A HREF="report_trauma09_1.php?w=42" style="color:#FF0000;">Wardรวม</A> | <A HREF="report_trauma09_1.php?w=44" style="color:#FF0000;">WardICU</A> | <A HREF="report_trauma09_1.php?w=45" style="color:#FF0000;">Wardพิเศษ</A> | <A HREF="report_trauma09_1.php?w=43" style="color:#FF0000;">Wardสูตินารี</A>
	</Div>
<?php
		
		if(!empty($_POST["yr"]) && !empty($_POST["m"]) ){
			
			if(strlen($_POST["m"]) == 1){
				$_POST["m"] = "0".$_POST["m"];
			}

			$select_day = $_POST["yr"]."-".$_POST["m"]."-";
			
			$mm = $_POST["m"];
			$yrr =  $_POST["yr"];

		}else{
		
			$dd = date("d");
			$mm = date("m");
			$yrr = date("Y")+543;
			$select_day = $yrr."-".$mm."-";
			
		}

		$mm = ($mm * 1)-1;
?>

<CENTER>สรุปการ Refer ผู้ป่วย เดือน......<?php echo $thmonthname[$mm];?>......พ.ศ. .......<?php echo $yrr;?>.......<BR>
						หอผู้ป่วย<?php
						
						switch($_GET["w"]){
							case "42": echo "รวม"; $filedward = "Ward".$_GET["w"]."%"; break;
							case "45":  echo "พิเศษ";  $filedward = "Ward".$_GET["w"]."%"; break;
							case "44":  echo "ICU";  $filedward = "Ward".$_GET["w"]."%"; break;
							case "43":  echo "สูตินรี";  $filedward = "Ward".$_GET["w"]."%"; break;
							case "opd":  echo "OPD";  $filedward = "opd"; $date_field = "a.dateopd"; break;
							case "opd_eye":  echo "จักษุ";  $filedward = "opd_eye"; $date_field = "a.dateopd"; break;
							case "opd_obg":  echo "สูติ";  $filedward = "opd_obg"; $date_field = "a.dateopd"; break;
						}

						?> รพ.ค่ายสุรศักดิ์มนตรี
</CENTER>

<TABLE align="center" width="600">
<TR>
	<TD><U><I>ส่วนที่ 1</I></U></TD>
</TR>
<TR>
	<TD>
	<?php
		
	
		$where = " ( dateopd like '".$select_day."%' ) AND ward like '".$filedward."' ";
		
		$sql = "Select count(hn) From `refer` where  ".$where."   ";

		list($count) = Mysql_fetch_row(Mysql_Query($sql));

	?>
	จำนวนผู้ป่วย Refer ..........<?php echo $count;?>.......... ราย</TD>
</TR>
<TR>
	<TD><U><I>ประเภทผู้ป่วย</I></U></TD>
</TR>
<TR>
	<TD align="center">
	<!-- ส่วนที่ 1.1 -->
<TABLE width="500" cellpadding="2" cellspacing="0" border="0" bordercolor="#000000" style='BORDER-COLLAPSE: collapse'>
<?php

$i=1;
//		
		$where = " ( dateopd like '".$select_day."%' ) AND ward like '".$filedward."' ";
		
	$sql = "Select type_wound , count(hn) From `refer` where  ".$where."  Group by type_wound ";
		

		$result = Mysql_Query($sql) or die(Mysql_Error());
		while(list($type_wound, $c_hn) = Mysql_fetch_row($result)){
	
		echo "<TR>
						<TD width='400'>",$i,". ".$list_ptright[$type_wound]."</TD>
						<TD width='100' align=\"center\">.....".$c_hn.".....ราย</TD>
					</TR>
						";
$i++;
		}
?>
</Table>
<!-- จบ ส่วนที่ 1.1 -->
<BR><BR><BR>
	</TD>
</TR>
<TR>
	<TD><U><I>ช่วงเวลาที่ Refer</I></U></TD>
</TR>
<TR>
	<TD align="center">
	<!-- ส่วนที่ 1.2 -->

	<TABLE width="500" cellpadding="2" cellspacing="0" border="0" bordercolor="#000000" style='BORDER-COLLAPSE: collapse'>
	<TR>
		<TD width='400'>08.00 - 16.00</TD>
		<TD width='100' align="center">.....
		<?php
			$sql = "Select count(hn) From `refer` where  ".$where." AND (time_refer between '08:00:00' AND '16:00:00' )";
			list($count) = Mysql_fetch_row(Mysql_Query($sql));
			echo $count;
		?>.....ราย
		</TD>
	</TR>
	<TR>
		<TD width='400'>16.00 - 24.00</TD>
		<TD width='100' align="center">.....
		<?php
			$sql = "Select count(hn) From `refer` where  ".$where."  AND  (time_refer between '16:00:01' AND '23:59:59' )";
			list($count) = Mysql_fetch_row(Mysql_Query($sql));
			echo $count;
		?>.....ราย
		</TD>
	</TR>
	<TR>
		<TD width='400'>24.00 - 08.00</TD>
		<TD width='100' align="center">.....
		<?php
			$sql = "Select count(hn) From `refer` where  ".$where."  AND (time_refer between '00:00:00' AND '07:59:59' )";
			list($count) = Mysql_fetch_row(Mysql_Query($sql));
			echo $count;
		?>.....ราย
		</TD>
	</TR>
	</TABLE>
<BR><BR><BR>
<!-- จบ ส่วนที่ 1.2 -->
</TD>
</TR>
<TR>
	<TD><U><I>สาเหตุการ Refer</I></U></TD>
</TR>
<TR>
	<TD align="center">
	<!-- ส่วนที่ 1.3 -->
<TABLE width="500" cellpadding="2" cellspacing="0" border="0" bordercolor="#000000" style='BORDER-COLLAPSE: collapse'>
<?php
		
$i=1;
//		
		$where = " ( dateopd like '".$select_day."%' ) AND ward like '".$filedward."' ";
		$sql = "Select exrefer , count(hn) From `refer` where  ".$where."   Group by exrefer ";

		$result = Mysql_Query($sql) or die(Mysql_Error());
		while(list($exrefer, $c_hn) = Mysql_fetch_row($result)){
	
		echo "<TR>
						<TD width='400'>",$i,". ".$exrefer."</TD>
						<TD width='100' align=\"center\">.....".$c_hn.".....ราย</TD>
					</TR>
						";
$i++;
		}
?>
</Table>
<!-- จบ ส่วนที่ 1.3 -->

<DIV style="page-break-after:always"></DIV><BR><BR>
	</TD>
</TR>
<TR>
	<TD><U><I>ส่วนที่ 2</I></U></TD>
</TR>
<?php
	
	$i=1;
	
	$sql = "Select a.name, a.sname, a.age, a.hn, a.an, a.type_wound, date_format(".$date_field.",'%d-%m-%Y'), date_format(".$date_field.",'%H:%i'), time_format(a.time_refer,'%H:%i'), a.doctor, a.diag, a.exrefer , a.referh, a.problem_refer, a.pttype, a.refercar, a.list_type_patient, a.follow_refer, a.organ, a.maintenance, a.doc_refer, a.nurse, a.assistant_nurse, a.estimate, a.no_estimate, a.cradle, a.doc_txt, a.suggestion  From refer as a INNER JOIN ipcard as b ON a.an=b.an Where ".$where." ";
	 

	$result = Mysql_Query($sql);
	while(list($name, $sname, $age, $hn, $an, $type_wound, $date, $time_date, $time_refer, $doctor, $diag, $exrefer , $referh, $problem_refer, $pttype, $refercar, $list_type_patient, $follow_refer, $organ, $maintenance, $doc_refer, $nurse, $assistant_nurse, $estimate, $no_estimate, $cradle, $doc_txt, $suggestion) = mysql_fetch_row($result)){
		
		if($doctor[0] == "M"){
			$doctor = substr($doctor,5);
		}
		
		if($type_wounded2 == "")
			$type_wounded2 = $type_wounded;

		if($pttype == "1"){
			$pttype = "Emergency";
		}else if($pttype == "2"){
			$pttype = "Urgent";
		}else if($pttype == "3"){
			$pttype = "Non-Urgent";
		}
		
		$list_remark = array();
		echo "	<TR>
	<TD>
	<!-- รายละเอียดของการ Refer -->
		<TABLE>
		<TR>
			<TD>รายละเอียดของการ Refer</TD>
		</TR>
		<TR>
			<TD>1. ชื่อ-สกลุ<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$name."&nbsp;".$sname."&nbsp;&nbsp;&nbsp;&nbsp;</U>&nbsp;&nbsp;อายุ&nbsp;<U>&nbsp;&nbsp;&nbsp;".$age."&nbsp;&nbsp;&nbsp;</U>HN<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$hn."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U>AN<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$an."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U></TD>
		</TR>
		<TR>
			<TD>สิทธิการรักษา<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$list_ptright[$type_wound]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U></TD>
		</TR>
		<TR>
			<TD>2. วัน/เดือน/ปีที่มาตรวจ <U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$date."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U>&nbsp;เวลา&nbsp;<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$time_date."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U>&nbsp;น.&nbsp;เวลาที่&nbsp;Refer&nbsp;<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$time_refer."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U> น.</TD>
		</TR>
		<TR>
			<TD>3. แพทย์ผู้รักษา/Refer <U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$doctor."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U>&nbsp;การวินิจฉัยโรค&nbsp;<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".nl2br($diag)."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U></TD>
		</TR>
		<TR>
			<TD>4. ข้อมูลสำคัญของผู้ป่วย</TD>
		</TR>
		<TR>
		<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".nl2br($organ)."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<BR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".nl2br($maintenance)."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TD>
		</TR>
		<TR>
			<TD>5. สาเหตุการ Refer</TD>
		</TR>
		<TR>
			<TD><U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$exrefer."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U></TD>
		</TR>
		<TR>
			<TD>6. Refer ไปที่โรงพยาบาล  <U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$referh."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U> </TD>
		</TR>
		<TR>
			<TD>7. ปัญหาการ Refer&nbsp;<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$problem_refer."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U></TD>
		</TR>
		<TR>
			<TD>8. ประเภท&nbsp;<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$pttype."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U></TD>
		</TR>
		<TR>
			<TD>9. ประเภทคนไข้&nbsp;<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$list_type_patient."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U></TD>
		</TR>
		<TR>
			<TD>10. ไปโดย&nbsp;<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$refercar."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U></TD>
		</TR>
				<TR>
			<TD>11. ผลการติดตามผู้ป่วย&nbsp;<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$follow_refer."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U></TD>
		</TR>";

			if($suggestion){
				array_push($list_remark,"ให้คำแนะนำ");
			}
			if($doc_refer){
				array_push($list_remark,"ใบ Refer");
			}
			if($nurse){
				array_push($list_remark,"พยาบาล");
			}
			if($assistant_nurse){
				array_push($list_remark,"ผู้ช่วย");
			}
			if($estimate){
				array_push($list_remark,"แบบประเมิน รพ.ลำปาง หมายเลข ".$no_estimate);
			}
			if($cradle){
				array_push($list_remark,"เปล");
			}
			if($doc_txt){
				array_push($list_remark,"ใบบันทึกข้อความ");
			}

			echo "<TR>
			<TD>*หมายเหตุ : ".implode(", ",$list_remark)."</TD>
		</TR>";
		echo "
		</TABLE>
			<!-- รายละเอียดของการ Refer -->
	</TD>
</TR>	";

if($i%2 == 0)
	echo "<TR><TD><DIV style=\"page-break-after:always\"></DIV><BR><BR></TD></TR>";
else
	echo "<TR><TD><HR><BR><BR></TD></TR>";
$i++;

}

?>
</TABLE>

</body>
</html>
<?php include("unconnect.inc");?>