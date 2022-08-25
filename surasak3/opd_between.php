<?php
session_start();
set_time_limit(0);
include("connect.inc");

//ติดต่อกับฐานข้อมูลผ่านฟังก์ชัน MySQL
$Conn = mysql_connect('192.168.131.250','remoteuser','') or die ("ไม่สามารถติดต่อกับเซิร์ฟเวอร์ได้");

//เลือกชื่อฐานข้อมูล คือ smdb
mysql_select_db('smdb',$Conn) or die ("ไม่สามารถติดต่อกับฐานข้อมูลได้");
// mysql_query("SET NAMES TIS620", $Conn);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> ช่วงเวลาในการบริการ </TITLE>
<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
<style type="text/css">


a:link {color:#000000; text-decoration:none;}
a:visited {color:#000000; text-decoration:none;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}

body,td,th {
	font-family: "TH SarabunPSK";
	font-size: 16 px;
}

.font_title{
	font-family: "TH SarabunPSK";
	font-size: 16 px;
	color:#FFFFFF;
	font-weight: bold;

}
</style>
</HEAD>

<BODY>

<A HREF="..\nindex.htm">&lt;&lt; เมนู</A>
<?php

	$month["01"]="มกราคม";
    $month["02"]="กุมภาพันธ์";
    $month["03"]="มีนาคม";
    $month["04"]="เมษายน";
    $month["05"]="พฤษภาคม";
    $month["06"]="มิถุนายน";
    $month["07"]="กรกฎาคม";
    $month["08"]="สิงหาคม";
    $month["09"]="กันยายน";
    $month["10"]="ตุลาคม";
    $month["11"]="พฤศจิกายน";
    $month["12"]="ธันวาคม";

	if(isset($_POST["submit_date"])){

		$day_now = 0;
		if(!empty($_POST["d"])){
			$day_now = sprintf("%02d", $_POST["d"]);
		}
		
		$month_now = sprintf("%02d", $_POST["m"]);
		$year_now = sprintf("%02d", $_POST["yr"]);

	// echo "<pre>";
	// var_dump($day_now);
	// echo "</pre>";

		if(!empty($day_now)){
			$select_day = $year_now."-".$month_now."-".$day_now;
			$appdate_en = ($_POST["yr"]-543)."-".$month_now."-".$day_now;

		}else{
			$select_day = $year_now."-".$month_now;
			$appdate_en = ($_POST["yr"]-543)."-".$month_now;

		}
		
		
		$select_day2 = $day_now." ".$month[$month_now]." ".$year_now;
		if($_POST["career"] == "1"){ 
			// career 05 เป็นอาชีพ ทหาร/ตำรวจ
			// idguard MX01 ทหาร/ครอบครัว
			$pcareer = "where left(idguard,4) = 'MX01'  AND career like '05%' ";
		}else{
			$pcareer = "";
		}

	}else{
		
		$day_now = date("d");
		$month_now = date("m");
		$year_now = (date("Y")+543);

		$appdate_en = date('Y-m-d');

		$select_day = $year_now."-".$month_now."-".$day_now;
		$select_day2 = $day_now." ".$month[$month_now]." ".$year_now;
		$pcareer = "where left(idguard,4) = 'MX01'  AND career like '05%' ";

	}


	$where_sso = '';
	if($_POST['sso_check']=="sso"){ 
		$pcareer = "where b.`ptright` LIKE 'R07%'";
	}
	

	// opd_now เป็น temp toborow EX01 รักษาโรคทั่วไป กับ EX04 ผู้ป่วยนัด
	// ปรับเอา opcardรวมใน opd เลย
	$sql = "CREATE TEMPORARY TABLE opd_now 
	SELECT a.hn, SUBSTRING(thidate,1,10) AS th_date, time_format(a.thidate,'%H:%i') as time_opd, time_format(a.dc_diag,'%H:%i') as time_dc, a.clinic,b.ptright,a.toborow 
	FROM ( 
		SELECT y.* 
		FROM ( 
			SELECT MAX(row_id) AS last_id FROM opd WHERE thidate LIKE '$select_day%' AND (toborow like 'EX01%' OR toborow like 'EX04%') GROUP BY hn 
		) AS x 
		LEFT JOIN opd AS y ON y.row_id = x.last_id 
		ORDER BY y.row_id
	) as a 
	LEFT JOIN opcard AS b ON b.`hn` = a.`hn` 
	$pcareer ";
	// echo "<pre>";
	// var_dump($sql);
	// echo "</pre>";
	$result_opd = mysql_query($sql);

	$sql = "CREATE TEMPORARY TABLE dphardep_now 
	SELECT tvn, hn, stkcutdate  FROM `dphardep` WHERE date LIKE '$select_day%' ";
	$result_dphardep = mysql_query($sql) or die(mysql_error());

	//
	// $sql = "CREATE TEMPORARY TABLE appoint_now SELECT hn  FROM `appoint` WHERE appdate LIKE '".$select_day2."' AND apptime <> 'ยกเลิกการนัด' ";
	$sql = "CREATE TEMPORARY TABLE appoint_now SELECT hn  FROM `appoint` WHERE appdate_en LIKE '$appdate_en%' AND apptime <> 'ยกเลิกการนัด' GROUP BY hn";
	$result_dphardep = mysql_query($sql) or die(mysql_error());
	
	// $sql = "CREATE TEMPORARY TABLE opcard_now  Select hn From opcard ".$pcareer;
	// $result_opcard = mysql_query($sql);

	$sql = "CREATE TEMPORARY TABLE opday_now Select a.vn, a.hn, a.ptname, time_format(a.thidate,'%H:%i') as time1_1, time_format(a.time2,'%H:%i') as time2_1 From opday as a where thidate LIKE '".$select_day."%' AND (toborow like 'EX01%' OR toborow like 'EX04%') GROUP BY hn";
	$result_opday = mysql_query($sql) or die(mysql_error());

?>

<form method='POST' action='<?php echo $_SERVER["PHP_MYSELF"];?>'>
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
		<TD>อาชีพ : <SELECT NAME="career"><Option value="1">เฉพาะทหาร</Option><Option value="" <?php if($_POST["career"] != "1") echo " Selected ";?>>ดูทั้งหมด</Option></SELECT></TD>
	</TR>
	<tr>
		<td>
			<?php 
			$checked = ($_POST['sso_check']=="sso") ? 'checked="checked"' : '' ;
			?>
			<label for="sso_check"><input type="checkbox" name="sso_check" id="sso_check" value="sso" <?=$checked;?>> สิทธิประกันสังคม</label>
		</td>
	</tr>
	<TR>
		<TD><input type='submit' name="submit" value='     ตกลง     ' > <INPUT TYPE="button" value="print" onclick="print();"></TD>
	</TR>
	</TABLE>
	<INPUT TYPE="hidden" name="submit_date" value="1">
	</form><BR><BR>


<?php

//clinic in ('12 เวชปฏิบัติ','01 อายุรกรรม','02 ศัลยกรรม','05 กุมารเวช','05 กุมารเวช','06 โสต ศอ นาสิก','08 ศัลยกรรมกระดูก','08 ศัลยกรรมทางเดินปัสสาวะ') 
	$sql = "Select hn, th_date, time_opd, time_dc,ptright,toborow From opd_now where hn not in (Select hn From appoint_now) ;";
	$result = mysql_query($sql) or die(mysql_error());
	
?>

	<TABLE cellpadding="2" cellspacing="0" border="1" bordercolor="#000000" style='BORDER-COLLAPSE: collapse'>
	<TR align='center'>
		<TD colspan="9" align="center">คนไข้ทั่วไป</TD>
	</TR>
	<TR align='center'>
		<TD width="20">No.</TD>
		<td>วันที่</td>
		<TD width="80">HN</TD>
		<TD width="150">ชื่อ - สกุล</TD>
		<TD width="50">ลงทะเบียน</TD>
		<TD width="50">ซักประวัติ</TD>
		<TD width="50">แพทย์ตรวจ</TD>
		<TD width="50">จ่ายยา</TD>
		<td>รวมเวลา</td>
	</TR>
	<?php
	$i=1;
	$all_time = 0;
	while(list($hn,$th_date,$time_opd,$time_dc,$ptright,$toborow) = mysql_fetch_row($result)){

		$sql = "Select vn, hn , ptname, time1_1, time2_1   From opday_now where hn = '".$hn."' limit 1 ";
		$result_opday_now = mysql_query($sql);
		if(mysql_num_rows($result_opday_now)==0){ 
			continue;
		}
		list($vn, $hn2, $ptname,$time_reg,$time_freg) = mysql_fetch_row($result_opday_now);

		$sql = "Select time_format(stkcutdate,'%H:%i') From dphardep_now where tvn = '".$vn."' limit 1 ";
		list($time_drug) = mysql_fetch_row(mysql_query($sql));

		$timediff = strtotime($time_opd) - strtotime($time_reg);
		if(!empty($time_dc)){
			$timediff = strtotime($time_dc) - strtotime($time_reg);
		}
		if(!empty($time_drug)){
			$timediff = strtotime($time_drug) - strtotime($time_reg);
		}

		$all_time += $timediff;

	echo "
	<TR>
		<TD>".$i.".</TD>
		<td>".$th_date."</td>
		<TD>".$hn2."</TD>
		<TD>".$ptname."</TD>
		<TD>".$time_reg."</TD>
		<TD>".$time_opd."</TD>
		<TD>".$time_dc."</TD>
		<TD>".$time_drug."</TD>
		<td>".gmdate('H:i:s', $timediff)."</td>
	</TR>";
	$i++;
	 }
	 ?>
	 <tr>
		<td colspan="8">เวลาเฉลี่ย</td>
		<td><?=gmdate('H:i:s', $all_time/$i);?></td>
	 </tr>
	</TABLE>

<BR><BR>
<?php
	$sql = "Select hn, th_date, time_opd, time_dc,ptright,toborow From opd_now where hn in (Select hn From appoint_now) ;";
	$result = mysql_query($sql) or die(mysql_error());
?>
<TABLE cellpadding="2" cellspacing="0" border="1" bordercolor="#000000" style='BORDER-COLLAPSE: collapse'>
	<TR align='center'>
		<TD colspan="9" align="center">คนไข้นัด</TD>
	</TR>
	<TR align='center'>
		<TD width="20">No.</TD>
		<td>วันที่</td>
		<TD width="80">HN</TD>
		<TD width="150">ชื่อ - สกุล</TD>
		<TD width="50">ลงทะเบียน</TD>
		<TD width="50">ซักประวัติ</TD>
		<TD width="50">แพทย์ตรวจ</TD>
		<TD width="50">จ่ายยา</TD>
		<td>รวมเวลา</td>
	</TR>
<?php
	
	$i=1;
	$all_time = 0;
	while(list($hn,$th_date,$time_opd,$time_dc,$ptright,$toborow) = mysql_fetch_row($result)){
		
		// $sql = "Select count(hn)  From opcard_now where hn = '".$hn."' limit 1 ";
		// $sql = "SELECT * FROM `opcard` WHERE `hn` = '$hn' ";
		// list($rows) = mysql_fetch_row(mysql_query($sql));

		// if($rows > 0){

			$sql = "Select vn, hn , ptname, time1_1, time2_1   From opday_now where hn = '".$hn."' limit 1 ";
			$result_opday_now = mysql_query($sql);
			if(mysql_num_rows($result_opday_now)==0){ 
				// ถ้ามีใน opd แต่ไม่มีใน opday ให้ข้ามไปเลย
				continue;
			}
			list($vn, $hn, $ptname,$time_reg,$time_freg) = mysql_fetch_row($result_opday_now);

			$sql = "Select time_format(stkcutdate,'%H:%i') From dphardep_now where tvn = '".$vn."' limit 1 ";
			list($time_drug) = mysql_fetch_row(mysql_query($sql));

			$timediff = strtotime($time_opd) - strtotime($time_reg);
			if(!empty($time_dc)){
				$timediff = strtotime($time_dc) - strtotime($time_reg);
			}
			if(!empty($time_drug)){
				$timediff = strtotime($time_drug) - strtotime($time_reg);
			}

			$all_time += $timediff;
	echo "
	<TR>
		<TD>".$i.".</TD>
		<td>".$th_date."</td>
		<TD>".$hn."</TD>
		<TD>".$ptname."</TD>
		<TD>".$time_reg."</TD>
		<TD>".$time_opd."</TD>
		<TD>".$time_dc."</TD>
		<TD>".$time_drug."</TD>
		<td>".gmdate('H:i:s', $timediff)."</td>
	</TR>";
	$i++;
		// }
	 } ?>
	 <tr>
		<td colspan="8">เวลาเฉลี่ย</td>
		<td><?=gmdate('H:i:s', $all_time/$i);?></td>
	 </tr>
	</TABLE>

</BODY>
</HTML>
<?php include("unconnect.inc");?>
