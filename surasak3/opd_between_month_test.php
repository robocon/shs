<?php
session_start();
set_time_limit(10);
include("connect.inc");
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
	font-family:  TH SarabunPSK;
	font-size: 16 px;
}

.font_title{
	font-family:  TH SarabunPSK;
	font-size: 16 px;
	color:#FFFFFF;
	font-weight: bold;

}

.txtbutton{
	font-family:  TH SarabunPSK;
	font-size: 16 px;

}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874"></HEAD>

<BODY>
<A HREF="..\nindex.htm">&lt;&lt; เมนู</A>   || <a href="opd_between_month1.php">ช่วงเวลาตามจริง</a>
<?
$mon = isset($_POST['mon']) ? $_POST['mon'] : '' ;
$year = isset($_POST['year']) ? $_POST['year'] : '' ;

$months = array(
	'01' => 'มกราคม', '02' => 'กุมภาพันธ์', '03' => 'มีนาคม', '04' => 'เมษายน', '05' => 'พฤษภาคม', '06' => 'มิถุนายน', 
	'07' => 'กรกฎาคม', '08' => 'สิงหาคม', '09' => 'กันยายน', '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม', 
);
?>
<form method='POST' action='<?php echo $_SERVER["PHP_SELF"];?>'>
<input name="act" type="hidden" value="show">
	<TABLE width="487" id="form_01">
<TR>
		<TD>
		เดือน&nbsp; 	<select name="mon" class="txtbutton">
		<?php
		foreach($months as $key => $val){
			$select = ($key == $mon) ? 'selected="selected"' : '' ;
			?>
		<option value="<?php echo $key;?>" <?php echo $select;?>><?php echo $val;?></option><?php
		}
		?>
	</select>
	&nbsp;&nbsp;&nbsp;พ.ศ.
	<?php
			$Y=date("Y")+543;
			$date=date("Y")+543+5;

			$dates=range(2547,$date);
			echo "<select name='year' class='txtbutton'>";
			foreach($dates as $i){
				?>
				<option value='<?=$i; ?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
				<?php
			}
			echo "<select>";
			?>
		</TD>
	</TR>
	<TR>
		<TD>
			อาชีพ : 
			<SELECT NAME="career" class="txtbutton">
				<Option value="1">เฉพาะทหาร</Option>
				<Option value="2">ทั่วไป</Option>
				<Option value="" <?php if($_POST["career"] != "1") echo " Selected ";?>>ดูทั้งหมด</Option>
			</SELECT>
	  </TD>
	</TR>
	<TR>
		<TD><input name="submit" type='submit' class="txtbutton" value='     ตกลง     ' >
      <INPUT TYPE="button" class="txtbutton" onClick="print();" value="   Print   "></TD>
	</TR>
	</TABLE>
<INPUT TYPE="hidden" name="submit_date" value="1">
	</form><BR><BR>
<?php
function TimeDiff($strTime1,$strTime2){
	return (strtotime($strTime2) - strtotime($strTime1))/ ( 60 ); // 1 Minute =60
}
	
if($_POST["act"]=="show"){
	
	if($_POST["submit_date"]=="1"){
		$month_now = sprintf("%02d", $_POST["mon"]);
		$year_now = sprintf("%02d", $_POST["year"]);
		
		$select_day = $year_now."-".$month_now;
		$select_day2 = $months[$month_now]." ".$year_now;
		if($_POST["career"] == "1"){
			$pcareer = "WHERE left(`idguard`,4) = 'MX01'  AND `career` like '05%' ";
			
		} else if( $_POST["career"] == '2' ){
			$pcareer = "WHERE `idguard` LIKE 'MX00%' AND `career` NOT LIKE '05%' ";
			
		}else{
			$pcareer = "";
		}

	}else{
		$month_now = date("m");
		$year_now = (date("Y")+543);

		$select_day = $year_now."-".$month_now;
		$select_day2 = $month[$month_now]." ".$year_now;
		$pcareer = "WHERE left(`idguard`,4) = 'MX01'  AND `career` like '05%' ";

	}
	
	// ช่วงเวลาที่ลงทะเบียน และ หมอซักประวัติ
	$sql = "CREATE TEMPORARY TABLE opd_now 
	SELECT a.hn, `thidate`, time_format(a.thidate,'%H:%i') as time_opd, time_format(a.dc_diag,'%H:%i') as time_dc, a.clinic 
	FROM opd as a  
	WHERE a.thidate LIKE '".$select_day."%' 
	AND (toborow like 'EX01%' OR toborow like 'EX04%')";
	//echo "--->".$sql;
	echo "<pre>";
	var_dump($sql);
	$result_opd = mysql_query($sql);

	// $sql = "CREATE TEMPORARY TABLE dphardep_now SELECT tvn, hn, stkcutdate  FROM `dphardep` WHERE date LIKE '".$select_day."%' ";
	//echo "===>".$sql;
	// $result_dphardep = mysql_query($sql);

	// หาวันนัดจาก ปี และ เดือน โดยที่ $select_day2 จะเป็นภาษาไทย
	$sql = "CREATE TEMPORARY TABLE appoint_now 
	SELECT hn  FROM `appoint` 
	WHERE appdate LIKE '%".$select_day2."' 
	AND apptime <> 'ยกเลิกการนัด' ";
	var_dump($sql);
	//echo "===>".$sql;
	$result_dphardep = mysql_query($sql);
	
	// ข้อมูล hn จาก opcard
	$sql = "CREATE TEMPORARY TABLE opcard_now  Select hn From opcard ".$pcareer;
	var_dump($sql);
	$result_opcard = mysql_query($sql);

	
	$sql = "CREATE TEMPORARY TABLE opday_now 
	Select a.vn, a.hn, a.ptname, time_format(a.thidate,'%H:%i') as time1_1, time_format(a.time2,'%H:%i') as time2_1 
	From opday as a 
	where thidate LIKE '".$select_day."%' 
	AND (toborow like 'EX01%' OR toborow like 'EX04%')";
	//echo "--->".$sql;
	var_dump($sql);
	$result_opday = mysql_query($sql) or die(mysql_error());


//clinic in ('12 เวชปฏิบัติ','01 อายุรกรรม','02 ศัลยกรรม','05 กุมารเวช','05 กุมารเวช','06 โสต ศอ นาสิก','08 ศัลยกรรมกระดูก','08 ศัลยกรรมทางเดินปัสสาวะ') 

	// ถ้า hn ใน opd มีใน appoint คล้ายๆเป็นการ JOIN กัน 
	$sql = "Select hn, time_opd, time_dc From opd_now where hn not in (Select hn From appoint_now) ORDER BY thidate ASC;";
	var_dump($sql);
	$result = mysql_query($sql) or die(mysql_error());
	
?>
<p><strong>ช่วงเวลาในการให้บริการผู้ป่วย ประจำเดือน <?=$_POST['mon']."/".$_POST['year'];?> ประเภท : <? if($_POST['career']=="1"){ echo "ทหาร/ครอบครัวทหาร";}else{ echo "ทั้งหมด";}?></strong>
</p>
	<TABLE cellpadding="2" cellspacing="0" border="1" bordercolor="#000000" style='BORDER-COLLAPSE: collapse'>
	<TR align='center'>
		<TD colspan="7" align="center" bgcolor="#66CC99"><strong>คนไข้ทั่วไป</strong></TD>
	</TR>
	<TR align='center'>
		<TD width="20">No.</TD>
		<TD width="80">HN</TD>
		<TD width="150">ชื่อ - สกุล</TD>
		<TD width="50">ลงทะเบียน</TD>
		<TD width="50">ซักประวัติ</TD>
		<TD width="50">รวมเวลา</TD>
	</TR>
<?php
	$i=0;
	$sumtime=0;
	while(list($hn,$time_opd,$time_dc) = mysql_fetch_row($result)){	
		
		// ตัวนี้ยังไม่เข้าใจว่าจะเอามา Count ใน opcard ทำไม
		// $sql = "Select count(hn)  From opcard_now where hn = '".$hn."' limit 1 ";
		// list($rows) = mysql_fetch_row(mysql_query($sql));

		// if($rows > 0){
			$sql = "Select vn, hn , ptname, time1_1, time2_1 From opday_now where hn = '".$hn."' limit 1 ";
			$result_opday_now = mysql_query($sql);
			list($vn, $hn, $ptname,$time_reg,$time_freg) = mysql_fetch_row($result_opday_now);
			
			// ตัวนี้ก็ไม่เข้าใจว่า $time_drug ไม่ได้ใช้แล้วจะ Query มาทำไม
			// $sql = "Select time_format(stkcutdate,'%H:%i') From dphardep_now where tvn = '".$vn."' limit 1 ";
			// list($time_drug) = mysql_fetch_row(mysql_query($sql));
			
//echo $newtime_reg;
//echo "Time Diff = ".TimeDiff($time_reg,$time_opd)."<br>";	
	$totaltime= TimeDiff($time_reg,$time_opd);		

	if(!empty($hn) && 	!empty($time_reg) && !empty($time_opd) && ($time_reg < $time_opd) && ($totaltime >=5 && $totaltime<=30)){
	$i++;
	echo "
	<TR>
		<TD>".$i.".</TD>
		<TD>".$hn."</TD>
		<TD>".$ptname."</TD>
		<TD>".$time_reg."</TD>
		<TD>".$time_opd."</TD>
		<TD align='right'>".$totaltime."</TD>
	</TR>";
		$sumtime=$sumtime+$totaltime;
		}  //close if
		// }  //close if
	 }  //close while
	$avgtime=$sumtime/$i;
echo "
	<TR>
		<TD colspan='5' align='right'><strong>เวลาเฉลี่ย</strong></TD>
		<TD align='right'>".number_format($avgtime,2)."</TD>
	</TR>";	 
	 
	 ?>
     
	</TABLE>

<BR><BR>
<?php
	$sql = "Select hn, time_opd, time_dc From opd_now where hn in (Select hn From appoint_now) ;";
	$result = mysql_query($sql) or die(mysql_error());
	$num=mysql_num_rows($result);
	//echo "--->".$num;
?>
<TABLE cellpadding="2" cellspacing="0" border="1" bordercolor="#000000" style='BORDER-COLLAPSE: collapse'>
	<TR align='center'>
		<TD colspan="7" align="center" bgcolor="#FFCC99"><strong>คนไข้นัด</strong></TD>
  </TR>
	<TR align='center'>
		<TD width="20">No.</TD>
		<TD width="80">HN</TD>
		<TD width="150">ชื่อ - สกุล</TD>
		<TD width="50">ลงทะเบียน</TD>
		<TD width="50">ซักประวัติ</TD>
		<TD width="50">รวมเวลา</TD>
	</TR>
<?php
	
	$i=0;
	$sumtime=0;
	while(list($hn,$time_opd,$time_dc) = mysql_fetch_row($result)){
		
		// $sql = "Select count(hn)  From opcard_now where hn = '".$hn."' limit 1 ";
		// list($rows) = mysql_fetch_row(mysql_query($sql));

		// if($rows > 0){

			$sql = "Select vn, hn , ptname, time1_1, time2_1   From opday_now where hn = '".$hn."' limit 1 ";
			$result_opday_now = mysql_query($sql);
			list($vn, $hn, $ptname,$time_reg,$time_freg) = mysql_fetch_row($result_opday_now);

			// $sql = "Select time_format(stkcutdate,'%H:%i') From dphardep_now where tvn = '".$vn."' limit 1 ";
			// list($time_drug) = mysql_fetch_row(mysql_query($sql));

$totaltime= TimeDiff($time_reg,$time_opd);	
	if(!empty($hn) && 	!empty($time_reg) && !empty($time_opd) && ($time_reg < $time_opd) && ($totaltime >=5 && $totaltime<=30)){
	$i++;
	echo "
	<TR>
		<TD>".$i.".</TD>
		<TD>".$hn."</TD>
		<TD>".$ptname."</TD>
		<TD>".$time_reg."</TD>
		<TD>".$time_opd."</TD>
		<TD>".$totaltime."</TD>
	</TR>";
		$sumtime=$sumtime+$totaltime;
		}  //close if
		// }  //close if
	 }  //close while
	$avgtime=$sumtime/$i;
echo "
	<TR>
		<TD colspan='5' align='right'><strong>เวลาเฉลี่ย</strong></TD>
		<TD align='right'>".number_format($avgtime,2)."</TD>
	</TR>";	 
	 
	 ?>
	</TABLE>
<?
}
?>
</BODY>
</HTML>
<?php include("unconnect.inc");?>
