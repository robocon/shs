<?php
session_start();
set_time_limit();
include("connect.inc");

$Conn = mysql_connect('192.168.131.250','remoteuser','') or die ("ไม่สามารถติดต่อกับเซิร์ฟเวอร์ได้ ");
mysql_select_db('smdb',$Conn) or die ("ไม่สามารถติดต่อกับฐานข้อมูลได้");

?>
<html>
<head>
<title>รายการยาขอคืนห้องไตเทียม</title>
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
	
function echo_ka($time){
	if($time >= "07:31:00" && $time < "15:31:00"){
		$ka = "เช้า";
	}else if($time >= "15:31:00" && $time < "23:31:00"){
		$ka = "บ่าย";
	}else if($time >= "23:3:001" && $time <= "23:59:00"){
		$ka = "ดึก";
	}else if($time >= "00:00:00" && $time < "07:31:00"){
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
		// document.getElementById("form_01").style.display='none';
		window.print();
	}
</SCRIPT>
<style type="text/css">
	@media print{
		#submit_form{
			display: none;
		}
		#hemo_item_1, #hemo_item_2{
			float: none;
			width: 100%!important;
		}
	}
</style>
<form method='POST' action='<?php echo $_SERVER["PHP_SELF"]?>' id="submit_form">
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
			<TD><input type='submit' name="submit" value='     ตกลง     ' > <INPUT TYPE="button" value="print" onClick="wprint();">&nbsp;<a target=_self  href='../nindex.htm'> &lt;&lt; ไปเมนู</a></TD>
		</TR>
	</TABLE>
</form>
<BR>
<?php
if(isset($_POST["submit"])){
	//$sql = "Create temporary table dphardep_2 Select row_id From dphardep where date like '".$select_day."%' AND doctor = 'HD ณรงค์  (ว.12456)' ";
	//$result = mysql_query($sql);

	$select_day = $_POST["yr"]."-".$_POST["m"]."-".$_POST["d"];
	$select_day2 = (date("Y",mktime(0,0,0,$_POST["m"],$_POST["d"]+1,$_POST["yr"]-543))+543).date("-m-d",mktime(0,0,0,$_POST["m"],$_POST["d"]+1,$_POST["yr"]-543));

	$sql = "SELECT a.hn, a.drugcode , a.tradname , a.amount, b.ptname, date_format( a.date, '%H:%i:%s' ) 
	FROM ( 
		SELECT hn,drugcode , tradname , amount, idno, date  FROM ddrugrx where  date like '".$select_day."%' 
	) as a 
	INNER JOIN ( 
		Select ptname, row_id From dphardep where date like '".$select_day."%'  AND doctor like 'HD%' AND dr_cancle is null 
	) as b ON a.idno = b.row_id 
	Order by a.date ASC ";

	$echoka = "";
	$echoka1 = "";
	$i=0;
	$result = Mysql_Query($sql) or die(mysql_error());
	$rows = Mysql_num_rows($result);
	?>
	จำนวนข้อมูลทั้งหมด  <?php echo $rows;?>


	<style>
	.clearfix::after {
		content: "";
		clear: both;
		display: table;
	}
	</style>
	<div class="clearfix">
		<div style="float:left; width:50%;" id="hemo_item_1">
			<h2>ไตเทียม 1</h2>
			<TABLE cellpadding="2" cellspacing="0" border="1" bordercolor="#000000" style='BORDER-COLLAPSE: collapse'>
				<TR>
					<td align="center">HN</td>
					<TD align="center">ชื่อผู้ป่วย</TD>
					<TD align="center">ชื่อยา</TD>
					<TD align="center">จำนวน</TD>
				</TR>
				<?php
				
				$drug_hemo_1 = array();
				$today_en = ($_POST["yr"]-543)."-".$_POST["m"]."-".$_POST["d"];

				while(list($hn, $drugcode , $tradname , $amount, $ptname, $time_in) = Mysql_fetch_row($result)){
					
					// if(!in_array($drugcode, $drug_hemo_1))
					// {
						// $drug_hemo_1[$drugcode] += $amount;
					// }
					// else
					// {
					// 	$drug_hemo_1[$drugcode] += $amount;
					// }

					$sql_hemo_1 = "SELECT * FROM `appoint` WHERE `appdate_en` = '$today_en' AND `detail` LIKE 'FU18%' AND `hn` = '$hn' ";
					$q1 = mysql_query($sql_hemo_1);
					if(mysql_num_rows($q1) == 0)
					{
						continue;
					}

					$drug_hemo_1[$drugcode]['name'] = $tradname;
					$drug_hemo_1[$drugcode]['amount'] += $amount;

					if($i%2==0)
						$bgcolor= "#FFFFFF";	
					else
						$bgcolor= "#FFFFB7";

					$i++;
							
					$echoka = echo_ka($time_in);
					
					// if($echoka != $echoka1 && !empty($_POST["d"])){
					// 	echo "<TR bgcolor=\"#FFFFCC\"><TD colspan=\"3\">&nbsp;&nbsp;<B>วันที่ ".$select_day." เวร ".$echoka."</B></TD></TR>";
					// 	$echoka1 = $echoka;
					// }

					echo "<TR bgcolor=\"".$bgcolor."\">
							<td>$hn</td>
							<TD>",$ptname,".</TD>
							<TD>",$tradname,".</TD>
							<TD>",$amount,"</TD>";
					echo "</TR>";
				}
				?>
			</table>
			<br>
			<p><b>สรุปรวมรายการยาทั้งหมด</b></p>
			<table cellpadding='2' cellspacing='0' border='1' bordercolor='#000000' style='BORDER-COLLAPSE: collapse'>
				<?php 
				foreach ($drug_hemo_1 as $d_hemo) {
					?>
					<tr>
						<td><?=$d_hemo['name'];?></td>
						<td><?=$d_hemo['amount'];?></td>
						<td width='150'></td>
					</tr>
					<?php
				}
				?>
			</table>

		</div>
		<div style="float:right; width:50%;" id="hemo_item_2">
			<h2>ไตเทียม 2</h2>
			<TABLE cellpadding="2" cellspacing="0" border="1" bordercolor="#000000" style='BORDER-COLLAPSE: collapse'>
				<TR>
					<td align="center">HN</td>
					<TD align="center">ชื่อผู้ป่วย</TD>
					<TD align="center">ชื่อยา</TD>
					<TD align="center">จำนวน</TD>
				</TR>
				<?php
				$sql = "SELECT a.hn, a.drugcode , a.tradname , a.amount, b.ptname, date_format( a.date, '%H:%i:%s' ) 
				FROM ( 
					SELECT hn,drugcode , tradname , amount, idno, date  FROM ddrugrx WHERE date LIKE '".$select_day."%' 
				) AS a 
				INNER JOIN ( 
					SELECT ptname, row_id FROM dphardep where date LIKE '".$select_day."%'  AND doctor LIKE 'HD%' AND dr_cancle IS NULL 
				) as b ON a.idno = b.row_id 
				ORDER BY a.date ASC ";

				$result = Mysql_Query($sql) or die(mysql_error());

				$drug_hemo_2 = array();

				while(list($hn, $drugcode , $tradname , $amount, $ptname, $time_in) = Mysql_fetch_row($result)){

					

					$sql_hemo_1 = "SELECT * FROM `appoint` WHERE `appdate_en` = '$today_en' AND `detail` LIKE 'FU39%' AND `hn` = '$hn' ";
					$q1 = mysql_query($sql_hemo_1);
					if(mysql_num_rows($q1) == 0)
					{
						continue;
					}


					// $drug_hemo_2[$drugcode] += $amount;
					$drug_hemo_2[$drugcode]['name'] = $tradname;
					$drug_hemo_2[$drugcode]['amount'] += $amount;


					if($i%2==0)
						$bgcolor= "#FFFFFF";	
					else
						$bgcolor= "#FFFFB7";

					$i++;
							
					$echoka = echo_ka($time_in);

					// if($echoka != $echoka1 && !empty($_POST["d"])){
					// 	echo "<TR bgcolor=\"#FFFFCC\"><TD colspan=\"3\">&nbsp;&nbsp;<B>วันที่ ".$date_in." เวร ".$echoka."</B></TD></TR>";
					// 	$echoka1 = $echoka;
					// }

					echo "<TR bgcolor=\"".$bgcolor."\">
							<td>$hn</td>
							<TD>",$ptname,".</TD>
							<TD>",$tradname,".</TD>
							<TD>",$amount,"</TD>";
					echo "</TR>";
				}
				?>
			</table>
			<br>
			<p><b>สรุปรวมรายการยาทั้งหมด</b></p>
			<table cellpadding='2' cellspacing='0' border='1' bordercolor='#000000' style='BORDER-COLLAPSE: collapse'>
				<?php 
				foreach ($drug_hemo_2 as $d_hemo) {
					?>
					<tr>
						<td><?=$d_hemo['name'];?></td>
						<td><?=$d_hemo['amount'];?></td>
						<td width='150'></td>
					</tr>
					<?php
				}
				?>
			</table>
		</div>
	</div>
	<?php

	/*
	echo "<br>";
	echo "<TABLE cellpadding='2' cellspacing='0' border='1' bordercolor='#000000' style='BORDER-COLLAPSE: collapse'>";
	echo "<strong>สรุปรวมรายการยาทั้งหมด</strong>";
	$sql = "SELECT a.drugcode , a.tradname , a.amount, b.ptname, date_format( a.date, '%H:%i:%s' ),sum(a.amount) as num  FROM ( SELECT drugcode , tradname , amount, idno, date  FROM ddrugrx where  date like '".$select_day."%' ) as a  INNER JOIN (Select ptname, row_id From dphardep where date like '".$select_day."%'  AND doctor like 'HD%' AND dr_cancle is null) as b ON a.idno = b.row_id Group by a.tradname Order by a.date ASC";
	$result = Mysql_Query($sql) or die(mysql_error());
	$rows = Mysql_num_rows($result);
	while(list($drugcode , $tradname , $amount, $ptname, $time_in,$num) = Mysql_fetch_row($result)){
		echo "<TR>
		<TD>",$tradname,"</TD>
		<TD>",$num,"</TD>
		<TD width='150'>&nbsp;</TD>";
		echo "</TR>";
		$sum +=$num;
	}
	echo "</div>";
	*/
}
?>
</TABLE>
</body>
</html>
<?php include("unconnect.inc");?>