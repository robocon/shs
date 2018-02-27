<?php
session_start();

include("connect.inc");

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


if(isset($_GET["del_refer"])){

	$sql = "Delete From `refer` where row_id = '".$_GET["search_id"]."' limit 1";
	$result = Mysql_Query($sql) or die(Mysql_Error());
	
	$get = "?";

	if($_GET["search_hn"] != ""){
		$get .= "search_hn=".$_GET["search_hn"]."&";
	}
	$get .= "view=opd";

	echo "
	<SCRIPT LANGUAGE=\"JavaScript\">
		
		window.onload = function(){
			
			setTimeout(\"window.location.href='ward_follow_refer2.php".$get."';\",0000);

		}
		
		</SCRIPT>
	";
exit();
}else if(isset($_POST["row_id"]) && $_POST["row_id"] !=""){
	
	if($_POST["hospital1"] != ""){
		$_POST["hospital"] = $_POST["hospital1"];
	}

	if($_POST["exrefer2"] != ""){
		$_POST["exrefer"] = $_POST["exrefer2"];
	}

	$_POST["day"] = sprintf("%02d",$_POST["day"]);

	$dateopd = $_POST["year"]."-".$_POST["month"]."-".$_POST["day"];

	$sql = "Update `refer` set `referh` = '".$_POST["hospital"]."' ,`pttype` = '".$_POST["pttype"]."' ,`diag` = '".$_POST["diag"]."'  ,`exrefer` = '".$_POST["exrefer"]."' ,`refercar` = '".$_POST["refercar"]."' ,`office` = '".$_SESSION["sOfficer"]."' ,`doctor` = '".$_POST["doctor"]."', type_wound='".$_POST["type_wound"]."', problem_refer = '".$_POST["problem_refer"]."', follow_refer = '".$_POST["follow_refer"]."', `dateopd` = '".$dateopd."', `time_refer` = '".$_POST["time_refer"]."', `officer` = '".$_SESSION["sOfficer"]."'  Where row_id = '".$_POST["row_id"]."'";

	$result = Mysql_Query($sql) or die(Mysql_Error());
	
	$get = "?";

	if($_GET["search_hn"] != ""){
		$get .= "search_hn=".$_GET["search_hn"]."&";
	}
	$get .= "view=opd";

	echo "
	<SCRIPT LANGUAGE=\"JavaScript\">
		
		window.onload = function(){
			
			setTimeout(\"window.location.href='ward_follow_refer2.php".$get."';\",3000);

		}
		
		</SCRIPT>
	";
	
	

	

	echo "<BR><CENTER><B>บันทึกข้อมูลเรียบร้อยแล้ว</B><BR><A HREF=\"#\" Onclick=\"window.location.href='ward_follow_refer2.php".$get."';\">&lt;&lt; กลับ</A></CENTER>";

exit();
}

?>
<html>
<head>
<title>ผู้ป่วย Refer จาก Ward</title>
<style type="text/css">


a:link {color:#FF0000; text-decoration:underline;}
a:visited {color:#FF0000; text-decoration:underline;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}

body,td,th {
	font-family:  MS Sans Serif;
	font-size: 14 px;
}

.font_title{
	font-family:  MS Sans Serif;
	font-size: 14 px;
	/*color:#FFFFFF;*/
	font-weight: bold;

}
</style>
</head>
<body>
<?php if(empty($_GET["view"])){?>
<A HREF="../nindex.htm">&lt; &lt; เมนู</A>
	
	<TABLE width="100%" border="0">
	<TR>
		<TD>
		<FORM METHOD=POST ACTION="">
		<TABLE border="1" bordercolor="#3366FF">
		<TR>
			<TD class="font_title" align="center" bgcolor="#3366FF">
		<B>ค้นหา</B>
		</TD>
		</TR>
		<TR>
			<TD>
			HN : <INPUT TYPE="text" NAME="search_hn" size="10"> หรือ 
			AN : <INPUT TYPE="text" NAME="search_an" size="10"><BR>
			<CENTER><INPUT TYPE="submit" name="submit_search" value="ค้นหา"></CENTER>
		</TD>
		</TR>
		</TABLE>
		</FORM>

<?php
}

if($_POST["submit_search"] == "ค้นหา" || $_GET["view"] == 'opd'){

	include 'includes/functions.php';

	$sections = array(
		'opd' => 'OPD', 
		'opd_obg' => 'สูติ', 
		'opd_eye' => 'ห้องตา', 
		'ER' => 'ห้องฉุกเฉิน',
		'Ward42' => 'Ward รวม',
		'Ward43' => 'Ward สูติ',
		'Ward44' => 'Ward ICU',
		'Ward45' => 'Ward พิเศษ',
	);

	$month_select = input_post('month_select', date('m'));
	$year_select = input_post('year_select', date('Y'));
	$section_select = input_post('section_select');
	
	?>
	<style type="text/css">
	@media print{ .no_print{ display: none; } }
	</style>
	<div class="no_print">
		<h3>ข้อมูล Refer</h3>
		<form action="ward_follow_refer2.php?view=opd" method="post">
			<div>
				แผนก 
				<select name="section_select" id="section">
					<option value="">แสดงทั้งหมด</option>
					<?php
					foreach ($sections as $key => $section) {
						$selected = ( $section_select === $key ) ? 'selected="selected"' : '';
						?>
						<option value="<?=$key;?>" <?=$selected;?> ><?=$section;?></option>
						<?php
					}
					?>
				</select>
				เดือน
				<?php
				getMonthList('month_select', $month_select);
				?>
				ปี
				<?php
				$year_range = range(2004, date('Y'));
				getYearList('year_select', true, $year_select, $year_range);
				?>
			</div>
			<div>
				<button type="submit">แสดงผล</button>
			</div>
		</form>
	</div>
	<?php
	$where = '';

	if($_REQUEST["search_hn"] != ""){
		$where .= "AND a.hn='".$_REQUEST["search_hn"]."' ";
	}else if($_POST["search_an"] != ""){
		$where .= "AND a.an='".$_POST["search_an"]."' ";
	}

	if( !empty($section_select) ){

		if( $section_select === 'Ward42' 
			OR $section_select === 'Ward43' 
			OR $section_select === 'Ward44' 
			OR $section_select === 'Ward45' ){

			$where .= "AND ward LIKE '$section_select%'";

		}else{
			$where .= "AND ward = '$section_select'";
		}
		
	}

	$sql = "SELECT row_id, name, sname, hn, an, date_format(dateopd,'%d-%m-%Y'), ward, officer, refer_runno,
	referh,diag,doctor,exrefer
	FROM refer 
	WHERE `dateopd` LIKE '".($year_select + 543)."-$month_select%' 
	".$where."
	ORDER BY row_id DESC ";
	$result = mysql_query($sql);

	echo "<table width=\"100%\"  border=\"0\" bordercolor=\"#3366FF\">
	<tr>
	<td >
	<table width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"3\"  bordercolor=\"#000000\" style=\"border-collapse:collapse\">
	<tr align=\"center\" bgcolor=\"#a6bcff\" class=\"font_title\">
	<td >เลข refer</td>
	<td >HN</td>
	<td >AN</td>
	<td >ชื่อ - สกุล</td>
	<td >วันที่ refer</td>
	<td >refer จาก</td>
	<td>refer ไป</td>
	<td >ผู้บันทึก</td>
	<td>Diag</td>
	<td>แพทย์</td>
	<td>สิทธิการรักษา</td>
	<td>สาเหตุที่ refer</td>
	<td class='no_print'>แก้ไข</td>
	<td class='no_print'>ลบ</td>
	</tr>";

	while(list($row_id, $name, $sname, $hn, $an, $dateopd, $ward, $officer, $refer_runno,$referh,$diag,$doctor,$exrefer) = Mysql_fetch_row($result)){
		
		if( preg_match('/^Ward(\d{2,})/', $ward, $match) > 0 ){
			$ward_key = $match['0'];
			$by = $sections[$ward_key];
		}else{
			switch($ward){
				case "opd" : $by = "ห้องตรวจโรค"; break;  
				case "opd_eye" : $by = "จักษุ"; break;
				case "opd_obg" : $by = "สูติ"; break;
				case "ER" : $by = "ER"; break;
			}
		}
		$an_detail = !empty($an) ? $an : '0' ;

		$refer_id = urlencode($refer_runno);

		if( empty($an) ){
			$thdatehn = $dateopd.$hn;
			$sql = "SELECT `ptright` FROM `opday` WHERE `thdatehn` = '$thdatehn' ";
			$q = mysql_query($sql) or die( mysql_error() );
			$ptr = mysql_fetch_assoc($q);
		}else{
			$sql = "SELECT `ptright` FROM `ipcard` WHERE `an` = '$an' ";
			$q = mysql_query($sql) or die( mysql_error() );
			$ptr = mysql_fetch_assoc($q);
		}
		

		echo "<tr align=\"center\" >
		<td><a href=\"ward_follow_refer_detail.php?id=$refer_id\" target=\"_blank\">".$refer_runno."</a></td>
		<td align=\"left\" >$hn</td>
		<td align=\"left\" >".$an."</td>
		<td align=\"left\">".$name." ".$sname."</td>
		<td >".$dateopd."</td>
		<td >".$by."</td>
		<td>".$referh."</td>
		<td >".$officer."</td>
		<td align=\"right\">$diag</td>
		<td align=\"right\">$doctor</td>
		<td align=\"right\">".$ptr['ptright']."</td>
		<td align=\"right\">".$exrefer."</td>";
		
		if($officer == "" || $officer == $_SESSION["sOfficer"]){
			echo "<td class='no_print'><A HREF=\"ward_follow_refer2.php?edit_refer=edit&search_id=".$row_id."\">แก้ไข</A></td>";
			echo "<td class='no_print'><A HREF=\"ward_follow_refer2.php?del_refer=true&search_id=".$row_id."\">ลบ</A></td>";
		}else{
			echo "<td colspan='2' class='no_print'>&nbsp;</td>";
		}
		echo "</tr>";
	}

	echo "</table>
	</td>
	</tr>
	</table>";

}else if($_GET["edit_refer"] == "edit" && $_GET["search_id"] !=""){

	$sql = "Select a.row_id, a.name, a.sname, a.age, a.hn, a.an, a.type_wound, date_format(a.dateopd,'%d-%m-%Y'), date_format(a.dateopd,'%H:%i'), time_format(a.time_refer,'%H:%i'), a.doctor, a.diag, a.exrefer , a.referh, a.problem_refer, a.pttype, a.refercar, a.list_type_patient, a.follow_refer, date_format(a.dateopd,'%d'), date_format(a.dateopd,'%m'), date_format(a.dateopd,'%Y')  From refer as a Where a.row_id='".$_GET["search_id"]."' Order by a.row_id DESC limit 1 ";

$result = mysql_query($sql);
if(Mysql_num_rows($result) ==0){
	echo "<BR><BR><CENTER>ไม่มีหมายเลข AN นี้</CENTER>";
}else{
	list($row_id, $name, $sname, $age, $hn, $an, $type_wound, $date, $time_date, $time_refer, $doctor, $diag, $exrefer , $referh, $problem_refer, $pttype, $refercar, $list_type_patient, $follow_refer, $day, $month, $year)=mysql_fetch_row($result);
	
echo "

<FORM METHOD=POST ACTION=\"\">
<TABLE border='1' bordercolor='#0033FF'><TR>
	<TD>
	<!-- รายละเอียดของการ Refer -->
		<TABLE>
		<TR>
			<TD align=\"center\" bgcolor='#0033FF'><FONT  COLOR=\"#FFFFFF\"><B>แก้ไขข้อมูล รายละเอียดของการ Refer</B></FONT></TD>
		</TR>
	<TR>
			<TD><BR>วันที่ Refer ";
?>

	<input type="text" name="day" size="2" value="<?php echo $day;?>">&nbsp;&nbsp; เดือน&nbsp;<select size="1" name="month">
    <option value="01" <?php if($month=="01") echo " Selected "; ?> >มกราคม</option>
    <option value="02" <?php if($month=="02") echo " Selected "; ?> >กุมภาพันธ์</option>
    <option value="03" <?php if($month=="03") echo " Selected "; ?> >มีนาคม</option>
    <option value="04" <?php if($month=="04") echo " Selected "; ?> >เมษายน</option>
    <option value="05" <?php if($month=="05") echo " Selected "; ?> >พฤษภาคม</option>
    <option value="06" <?php if($month=="06") echo " Selected "; ?> >มิถุนายน</option>
    <option value="07" <?php if($month=="07") echo " Selected "; ?> >กรกฎาคม</option>
    <option value="08" <?php if($month=="08") echo " Selected "; ?> >สิงหาคม</option>
    <option value="09" <?php if($month=="09") echo " Selected "; ?> >กันยายน</option>
    <option value="10" <?php if($month=="10") echo " Selected "; ?> >ตุลาคม</option>
    <option value="11" <?php if($month=="11") echo " Selected "; ?> >พฤษจิกายน</option>
    <option value="12" <?php if($month=="12") echo " Selected "; ?> >ธันวาคม</option>
  </select>&nbsp;พ.ศ.<input type="text" name="year" size="4" value="<?php echo $year;?>">

<?php

echo "	เวลาที่&nbsp;Refer&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; ?>

<select name="time_refer">
			<option value="07:00:00" <?php if($time_refer == "07:00") echo "Selected"; ?> >07:00 &#3609;.</option>
			<option value="07:30:00" <?php if($time_refer == "07:30") echo "Selected"; ?> >07:30 &#3609;.</option>
			<option value="08:00:00" <?php if($time_refer == "08:00") echo "Selected"; ?> >08:00 &#3609;.</option>
			<option value="08:30:00" <?php if($time_refer == "08:30") echo "Selected"; ?> >08:30 &#3609;.</option>
			<option value="09:00:00" <?php if($time_refer == "09:00") echo "Selected"; ?> >09:00 &#3609;.</option>
			<option value="09:30:00" <?php if($time_refer == "09:30") echo "Selected"; ?> >09:30 &#3609;.</option>
			<option value="10:00:00" <?php if($time_refer == "10:00") echo "Selected"; ?> >10:00 &#3609;.</option>
			<option value="10:30:00" <?php if($time_refer == "10:30") echo "Selected"; ?> >10:30 &#3609;.</option>
			<option value="11:00:00" <?php if($time_refer == "11:00") echo "Selected"; ?> >11:00 &#3609;.</option>
			<option value="11:30:00" <?php if($time_refer == "11:30") echo "Selected"; ?> >11:30 &#3609;.</option>
			<option value="13:00:00" <?php if($time_refer == "13:00") echo "Selected"; ?> >13:00 &#3609;.</option>
			<option value="13:30:00" <?php if($time_refer == "13:30") echo "Selected"; ?> >13:30 &#3609;.</option>
			<option value="14:00:00" <?php if($time_refer == "14:00") echo "Selected"; ?> >14:00 &#3609;.</option>
			<option value="14:30:00" <?php if($time_refer == "14:30") echo "Selected"; ?> >14:30 &#3609;.</option>
			<option value="15:00:00" <?php if($time_refer == "15:00") echo "Selected"; ?> >15:00 &#3609;.</option>
			<option value="15:30:00" <?php if($time_refer == "15:30") echo "Selected"; ?> >15:30 &#3609;.</option>
			<option value="16:00:00" <?php if($time_refer == "16:00") echo "Selected"; ?> >16:00 &#3609;.</option>
			<option value="16:30:00" <?php if($time_refer == "16:30") echo "Selected"; ?> >16:30 &#3609;.</option>
			<option value="17:00:00" <?php if($time_refer == "17:00") echo "Selected"; ?> >17:00 &#3609;.</option>
			<option value="17:30:00" <?php if($time_refer == "17:30") echo "Selected"; ?> >17:30 &#3609;.</option>
			<option value="18:00:00" <?php if($time_refer == "18:00") echo "Selected"; ?> >18:00 &#3609;.</option>
			<option value="18:30:00" <?php if($time_refer == "18:30") echo "Selected"; ?> >18:30 &#3609;.</option>
			<option value="19:00:00" <?php if($time_refer == "19:00") echo "Selected"; ?> >19:00 &#3609;.</option>
			<option value="19:30:00" <?php if($time_refer == "19:30") echo "Selected"; ?> >19:30 &#3609;.</option>
			<option value="20:00:00" <?php if($time_refer == "20:00") echo "Selected"; ?> >20:00 &#3609;.</option>
			<option value="21:00:00" <?php if($time_refer == "21:00") echo "Selected"; ?> >21:00 &#3609;.</option>
			</select>

<?php 

	echo "&nbsp; น.</TD>
		</TR>
		<TR>
			<TD> ชื่อ-สกลุ<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$name."&nbsp;".$sname."&nbsp;&nbsp;&nbsp;&nbsp;</U>&nbsp;&nbsp;อายุ&nbsp;<U>&nbsp;&nbsp;&nbsp;".$age."&nbsp;&nbsp;&nbsp;</U>HN<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$hn."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U>AN<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$an."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U></TD>
		</TR>
		<TR>
			<TD>สิทธิการรักษา&nbsp;:&nbsp;";
			echo "<SELECT NAME=\"type_wound\">
						<Option value='P01' >-------</Option>
						<Option value='P02' ".($type_wound == 'P02' ? ' Selected ':'').">ทหาร (น)</Option>
						<Option value='P03' ".($type_wound == 'P03' ? ' Selected ':'').">ทหาร (นส)</Option>
						<Option value='P04' ".($type_wound == 'P04' ? ' Selected ':'').">ทหาร (พลฯ)</Option>
						<Option value='P05' ".($type_wound == 'P05' ? ' Selected ':'').">ครอบครัว</Option>
						<Option value='P06' ".($type_wound == 'P06' ? ' Selected ':'').">พ.ต้น</Option>
						<Option value='P07' ".($type_wound == 'P07' ? ' Selected ':'').">พ.</Option>
						<Option value='P08' ".($type_wound == 'P08' ? ' Selected ':'').">ประกันสังคม</Option>
						<Option value='P09' ".($type_wound == 'P09' ? ' Selected ':'').">30บาท</Option>
						<Option value='P10' ".($type_wound == 'P10' ? ' Selected ':'').">30บาทฉุกเฉิน</Option>
						<Option value='P11' ".($type_wound == 'P11' ? ' Selected ':'').">พรบ.</Option>
						<Option value='P12' ".($type_wound == 'P12' ? ' Selected ':'').">กท.44</Option>
						</SELECT>";
			
			
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TD>
		</TR>
		
		<TR>
			<TD>แพทย์ผู้รักษา/Refer&nbsp;:&nbsp;<SELECT NAME=\"doctor\">";
		
	$sql_dc = "Select name From doctor where status = 'y' AND row_id != '0' Order by name ASC ";
	$result_dc = Mysql_Query($sql_dc);
	
	while(list($name) = Mysql_fetch_row($result_dc)){
		echo "<option value=\"".$name."\" ";
			if($doctor == $name) echo " Selected ";
		echo ">".$name."</option>";
	}

		echo "</SELECT>&nbsp;
			</TD>
		</TR>
		<TR>
			<TD>
				การวินิจฉัยโรค </TD>
		</TR>
		<TR>
			<TD>
				&nbsp;&nbsp;&nbsp;&nbsp;<TEXTAREA NAME=\"diag\" ROWS=\"4\" COLS=\"60\">".$diag."</TEXTAREA>";
			
		echo "</TD>
		</TR>
		<TR>
			<TD>สาเหตุการ Refer&nbsp;:&nbsp;<SELECT NAME=\"exrefer\" >
										<Option value=\"\" >-----------------</Option>
										<Option value=\"เตียงเต็ม\" ".($exrefer == 'เตียงเต็ม' ? ' Selected ':'').">เตียงเต็ม</Option>
										<Option value=\"ICU เต็ม\" ".($exrefer == 'ICU เต็ม' ? ' Selected ':'').">ICU เต็ม</Option>
										<Option value=\"Propermangement\" ".($exrefer == 'Propermangement' ? ' Selected ':'').">Propermangement</Option>
										<Option value=\"สิทธิ์รักษา รพ. ลำปาง\" ".($exrefer == 'สิทธิ์รักษา รพ. ลำปาง' ? ' Selected ':'').">สิทธิ์รักษา รพ. ลำปาง</Option>
										<Option value=\"พบแพทย์เฉพาะทาง\" ".($exrefer == 'พบแพทย์เฉพาะทาง' ? ' Selected ':'').">พบแพทย์เฉพาะทาง</Option>
										<Option value=\"ไม่มีเครื่องมือ\" ".($exrefer == 'ไม่มีเครื่องมือ' ? ' Selected ':'').">ไม่มีเครื่องมือ</Option>
										<Option value=\"ไม่มีเลือด\" ".($exrefer == 'ไม่มีเลือด' ? ' Selected ':'').">ไม่มีเลือด</Option>
										<Option value=\"ผู้ป่วย/ญาติต้องการ\" ".($exrefer == 'ผู้ป่วย/ญาติต้องการ' ? ' Selected ':'').">ผู้ป่วย/ญาติต้องการ</Option>
										<Option value=\"อื่นๆ\" ".($exrefer == 'อื่นๆ' ? ' Selected ':'').">อื่นๆ</Option>
										</SELECT>";
			if($exrefer != 'เตียงเต็ม' && $exrefer != 'ICU เต็ม' && $exrefer != 'Propermangement' && $exrefer != 'สิทธิ์รักษา รพ. ลำปาง' && $exrefer != 'พบแพทย์เฉพาะทาง' && $exrefer != 'ไม่มีเครื่องมือ' && $exrefer != 'ไม่มีเลือด' && $exrefer != 'ผู้ป่วย/ญาติต้องการ' && $exrefer != 'อื่นๆ' ){
				$exrefer2 = $exrefer;
			}
			echo "&nbsp;&nbsp;สาเหตุอื่นๆ <INPUT TYPE=\"text\" NAME=\"exrefer2\" size = \"40\" value=\"".$exrefer2."\">";
			echo "</TD>
		</TR>
		<TR>
			<TD> Refer ไปที่โรงพยาบาล&nbsp;:&nbsp;
						<select  name='hospital'>
 <option value='00' >-------------------</option>
 <option value='10672 ลำปาง' ".($referh == '10672 ลำปาง' ? ' Selected ':'').">โรงพยาบาลลำปาง</option>
 <option value='11146 แม่เมาะ' ".($referh == '11146 แม่เมาะ' ? ' Selected ':'').">โรงพยาบาลแม่เมาะ</option>
 <option value='11147 เกาะคา' ".($referh == '11147 เกาะคา' ? ' Selected ':'').">โรงพยาบาลเกาะคา</option>
 <option value='11148 เสริมงาม' ".($referh == '11148 เสริมงาม' ? ' Selected ':'').">โรงพยาบาลเสริมงาม</option>
 <option value='11149 งาว' ".($referh == '11149 งาว' ? ' Selected ':'').">โรงพยาบาลงาว</option>
 <option value='11150 แจ้ห่ม' ".($referh == '11150 แจ้ห่ม' ? ' Selected ':'').">โรงพยาบาลแจ้ห่ม</option>
 <option value='11152 เถิน' ".($referh == '11152 เถิน' ? ' Selected ':'').">โรงพยาบาลเถิน</option>
 <option value='11153 แม่พริก' ".($referh == '11153 แม่พริก' ? ' Selected ':'').">โรงพยาบาลแม่พริก</option>
 <option value='11154 แม่ทะ' ".($referh == '11154 แม่ทะ' ? ' Selected ':'').">โรงพยาบาลแม่ทะ</option>
 <option value='11155 สบปราบ' ".($referh == '11155 สบปราบ' ? ' Selected ':'').">โรงพยาบาลสบปราบ</option>
 <option value='11156 ห้างฉัตร' ".($referh == '11156 ห้างฉัตร' ? ' Selected ':'').">โรงพยาบาลห้างฉัตร</option>
 <option value='11157 เมืองปาน' ".($referh == '11157 เมืองปาน' ? ' Selected ':'').">โรงพยาบาลเมืองปาน</option>
 <option value='12005 แวนแซนวูด' ".($referh == '12005 แวนแซนวูด' ? ' Selected ':'').">โรงพยาบาลแวนแซนวูด</option>
 <option value='อื่นๆ' ".($referh == 'อื่นๆ' ? ' Selected ':'').">อื่นๆ</option>
  </select>";

if($referh != '10672 ลำปาง' && $referh != '11146 แม่เมาะ' && $referh != '11147 เกาะคา' && $referh != '11148 เสริมงาม' && $referh != '11149 งาว' && $referh != '11150 แจ้ห่ม' && $referh != '11152 เถิน' && $referh != '11153 แม่พริก' && $referh != '11154 แม่ทะ'  && $referh != '11155 สบปราบ' && $referh != '11156 ห้างฉัตร' && $referh != '11157 เมืองปาน' && $referh != '12005 แวนแซนวูด' && $referh != 'อื่นๆ' ){
				$referh2 = $referh;
			}
echo "สถานพยาบาลอื่น&nbsp;&nbsp; <input type='text' name='hospital1' size='15' value=\"".$referh2."\">";
	echo "						</TD>
		</TR>
		<TR>
			<TD>7. ปัญหาการ Refer&nbsp;:&nbsp;<INPUT TYPE=\"text\" NAME=\"problem_refer\" value=\"".$problem_refer."\"></TD>
		</TR>
		<TR>
			<TD>8. ประเภท&nbsp;:&nbsp;<INPUT TYPE='radio' NAME='pttype' VALUE='1' ".($pttype == '1' ? ' Checked ':'').">Emergency&nbsp;&nbsp;&nbsp;<INPUT TYPE='radio' NAME='pttype' VALUE='2' ".($pttype == '2' ? ' Checked ':'').">Urgent&nbsp;&nbsp;&nbsp;<INPUT TYPE='radio' NAME='pttype' VALUE='3' ".($pttype == '3' ? ' Checked ':'').">Non-Urgent &nbsp;</TD>
		</TR>
		<TR>
			<TD>9. ประเภทคนไข้&nbsp;:&nbsp;<SELECT NAME='list_type_patient' >
										<Option value=''>--------</Option>
										<Option value='Med'  ".($list_type_patient == 'Med' ? ' Selected ':'').">Med</Option>
										<Option value='Sx'  ".($list_type_patient == 'Sx' ? ' Selected ':'').">Sx</Option>
										<Option value='Ortho' ".($list_type_patient == 'Ortho' ? ' Selected ':'').">Ortho</Option>
										<Option value='OB. Gyne' ".($list_type_patient == 'OB. Gyne' ? ' Selected ':'').">OB. Gyne</Option>
										<Option value='Ped' ".($list_type_patient == 'Ped' ? ' Selected ':'').">Ped</Option>
										<Option value='Eye' ".($list_type_patient == 'Eye' ? ' Selected ':'').">Eye</Option>
										<Option value='Ent' ".($list_type_patient == 'Ent' ? ' Selected ':'').">Ent</Option>
										<Option value='Psycho' ".($list_type_patient == 'Psycho' ? ' Selected ':'').">Psycho</Option>
										</SELECT></TD>
		</TR>
		<TR>
			<TD>10. ไปโดย&nbsp;:&nbsp;<INPUT TYPE='radio' NAME='refercar' VALUE='01 รถพยาบาลไปรับ/ส่ง' ".($refercar == '01 รถพยาบาลไปรับ/ส่ง' ? ' Checked ':'').">รถพยาบาลไปรับ/ส่ง&nbsp;&nbsp;<INPUT TYPE='radio' NAME='refercar' VALUE='02 ผู้ป่วยเดินทางเอง' ".($refercar == '02 ผู้ป่วยเดินทางเอง' ? ' Checked ':'').">ผู้ป่วยเดินทางเอง &nbsp;</TD>
		</TR>
		<TR>
			<TD>11. ผลการติดตามผู้ป่วย</TD>
		</TR>
		<TR>
			<TD>&nbsp;&nbsp;&nbsp;<TEXTAREA NAME=\"follow_refer\" ROWS=\"8\" COLS=\"50\">".$follow_refer."</TEXTAREA></TD>
		</TR>
		<TR>
			<TD align='center'><INPUT TYPE=\"submit\" value=\"ตกลง\"><INPUT TYPE=\"hidden\" name=\"row_id\" value=\"".$row_id."\"></TD>
		</TR>
		</TABLE>
			<!-- รายละเอียดของการ Refer -->
	</TD>
</TR>
</TABLE>
</FORM>	";
}
}
?>

</body>
</html>
<?php include("unconnect.inc");?>
