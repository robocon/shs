<?php
set_time_limit(50);
include("connect.inc");
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> New Document </TITLE>
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
</HEAD>

<BODY>
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

<form method='POST' action=''>
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
		<TD><input type='submit' name="submit" value='     ตกลง     ' ></TD>
	</TR>
	</TABLE>
	</form>

<?php

	if(isset($_POST["submit"])){

		$sql = "Select camp, goup, count(hn) From opday where ( `thidate`  between '".$select_day." 00:00:00' AND '".$select_day2." 23:59:59' ) AND left(camp,3) <> 'M01' AND left(goup,3) in ('G11','G12','G13','G14','G15','G21','G22','G23','G24','G31','G33','G34') Group by camp, goup Order by camp ASC ";
		//echo $sql;
		$result = Mysql_Query($sql) or die(Mysql_Error());
		echo "<Table width='500'>";
		echo "<TR align='center' style='color:#FFFFFF;background-color: #3300FF;font-weight: bold;'><TD>สังกัด</TD><TD>ประเภท</TD><TD>จำนวน (ครั้ง)</TD></TR>";

		$i=0;

		while(list($camp, $goup, $count_hn) = Mysql_fetch_row($result)){
		
		if($i % 2)
			$bgcolor= "#FFFFAE";
		else
			$bgcolor= "#FFFFFF";
				
				
				echo "<TR style='background-color: ".$bgcolor."'><TD>".$camp."</TD><TD>".$goup."</TD><TD>".$count_hn."</TD></TR>";
				
		$i++;
		}
		echo "</Table>";
	}

include("unconnect.inc");
?>

	</BODY>
</HTML>