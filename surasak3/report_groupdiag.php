<?php
session_start();
include("connect.inc");
?>
<html>
<head>
<title>สรุป</title>
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
	color:#FFFFFF;
	font-weight: bold;

}
</style>
</head>
<body>

<?php
	
	
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

			document.getElementById("form_01").style.display='none';
			window.print();

		}
	
	</SCRIPT>
	<form method='POST' action='<?php echo $_SERVER["PHP_SELF"];?>'>
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
		<TD>
			<SELECT NAME="sub">
				<Option value="" >--- เลือกทั้งหมด ---</Option>
				<Option value="refer" <?if(isset($_POST["sub"]) && $_POST["sub"] == "refer" ) echo " Selected ";?>>เฉพาะผู้ป่วย Refer</Option>
			</SELECT>
		</TD>
	</TR>
	<TR>
		<TD><input type='submit' name="submit" value='     ตกลง     ' > <INPUT TYPE="button" value="print" onclick="wprint();"></TD>
	</TR>
	</TABLE>
	</form>

<?php


	if(isset($_POST["submit"])){
	
	if($_POST["sub"] != ""){
		$where = " AND cure = 'refer' AND ( doc_refer = '1' OR doc_txt = '1' ) ";
		$j=1;
	}else{
		$j=4;
	
	$time[0][0] = " รวมทั้งหมด ";
	$time[0][1] = "  ";

	$time[1][0] = " เช้า ";
	$time[1][1] = " Where time_in >= '07:31:00' AND time_in < '15:31:00' ";


	$time[2][0] = " บ่าย ";
	$time[2][1] = " Where time_in >= '15:31:00' AND time_in < '23:31:00' ";


	$time[3][0] = " ดึก ";
	$time[3][1] = " Where ( time_in >= '23:31:00' AND time_in <= '23:59:00') OR ( time_in >= '00:00:00' AND time_in < '07:31:00')  ";
	}

	$list_count = array();
	
$sum=0;

for($i=0;$i<$j;$i++){

	if($j ==1){
	
	$sql = "Select dx, count(a.dx) as c_dx From trauma as a where ( a.date_in between '".$select_day." 00:00:00' AND '".$select_day2." 23:59:59' ) AND a.dx <> '' ".$where." Group by a.dx Order by  a.dx ASC ";
	$result = Mysql_Query($sql) or die(Mysql_error());

	}else{


	$sql = "Select dx, count(a.dx) as c_dx From ( Select * From trauma ".$time[$i][1]." ) as a where ( a.date_in between '".$select_day." 00:00:00' AND '".$select_day2." 23:59:59' ) AND a.dx <> '' ".$where." Group by a.dx Order by  a.dx ASC ";
	$result = Mysql_Query($sql) or die(Mysql_error());
	
	}
	
?>

<?php if($j>1 && $i ==0) 
	echo "<TABLE border='0'>
	<TR>
		<TD valign='top'>";
?>
<TABLE width="400" cellpadding="2" cellspacing="0" border="1" bordercolor="#000000">
<TR align="center">
	<TD colspan="2" bgcolor="#FFFF33"><?php echo $time[$i][0]; ?></TD>
</TR>
<TR align="center">
	<TD>ชื่อโรค</TD>
	<TD>จำนวน</TD>
</TR>
<?php

while($arr = Mysql_fetch_assoc($result)){

?>
<TR>
	<TD >&nbsp;&nbsp;<A HREF="report_trauma01_3.php?d=<?php echo $day_now;?>&m=<?php echo $month_now;?>&yr=<?php echo $year_now;?>&d2=<?php echo $day_now2;?>&m2=<?php echo $month_now2;?>&yr2=<?php echo $year_now2;?>&dx=<?php echo urlencode($arr["dx"]);?>" style='color:000000;text-decoration:none;' target="_blank"><?php echo $arr["dx"];?></A></TD>
	<TD >&nbsp;&nbsp;<?php echo $arr["c_dx"];?></TD>
</TR>
<?php 

	if($i==0 && (substr($arr["dx"],0,1) == '0' || substr($arr["dx"],0,1) == '1')){
		$list_count[substr($arr["dx"],0,2)] = $list_count[substr($arr["dx"],0,2)]+$arr["c_dx"];
	}

	$sum = $sum + $arr["c_dx"];
}?>
<TR align="center">
	<TD>รวม</TD>
	<TD><?php echo $sum;$sum=0;?></TD>
</TR>
</TABLE>
<?php 
	
if($i==0 && (substr($arr["dx"],0,1) == '0' || substr($arr["dx"],0,1) == '1')){
	echo "<BR><BR><table cellspacing=\"0\" border=\"1\" bordercolor=\"#000000\" width=\"400\" cellpadding=\"2\">";
			echo "<tr><td colspan='2' align='center' style='color:#FFFFFF;background-color: #FF0000'><B>สรุปกลุ่มโรค</B></td><tr>";
		foreach($list_count as $key => $value){
			echo "<tr><td width='350'>",$key,"</td><td width='50'>",$value,"</td><tr>";
		}
	echo "</table>";
	}

	if($j>1 && $i ==0){
		echo "</TD>
		</TD>
		<TD>
		";
	}else if($j>1 && $i-1 == $j){
		echo "</TD>
		</TR>
		</TABLE>";
	}

}

}
?>

</body>
</html>





<?php include("unconnect.inc");?>