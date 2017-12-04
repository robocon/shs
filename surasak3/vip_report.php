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

		$select_day = $_POST["yr"]."-".$_POST["m"]."-";
		

		$month_now = $_POST["m"];
		$year_now = $_POST["yr"];

		


	}else{

		$select_day = (date("Y")+543).date("-m");
		$month_now = date("m");
		$year_now = (date("Y")+543);



	}
?>

<form method='POST' action=''>
	<TABLE width="555" id="form_01">
	<TR>
		<TD>
	เดือน&nbsp; <input type='text' name='m' size='4' value='<?php echo $month_now;?>'>&nbsp;&nbsp;&nbsp;
	พ.ศ. <input type='text' name='yr' size='8' value='<?php echo $year_now;?>'>  
	<INPUT TYPE="checkbox" NAME="noid" value="1">&nbsp;เฉพาะทหารและครอบครัว
	<INPUT TYPE="checkbox" NAME="noid" value="2" id="noid">&nbsp;ข้าราชการบำนาญ
	<INPUT TYPE="checkbox" NAME="noid" value="3" id="noid">&nbsp;ทหารและครอบครัว+ข้าราชการบำนาญ
        </TD>
	</TR>
	<TR>
		<TD><input type='submit' name="submit" value='     ตกลง     ' ></TD>
	</TR>
</TABLE>
	</form>

<?php

	if(isset($_POST["submit"])){

		if($_POST["noid"] == "1"){
			$where =" AND camp not like 'M01%' AND goup not like 'G32%' and note not like '%บำนาญ%'";
			$sql = "Select date_format(thidate,'%d-%m-%Y'), hn ,  ptname ,goup, camp From opday where thidate like '".$select_day."%' AND hn in (Select hn From opcard where idguard like 'MX03%'".$where."   ) ";
		}elseif($_POST["noid"] == "2"){
			$where =" AND camp not like 'M01%' AND goup like 'G32%' ";
			$sql = "Select date_format(thidate,'%d-%m-%Y'), hn ,  ptname ,goup, camp From opday where thidate like '".$select_day."%' AND hn in (Select hn From opcard where idguard like 'MX03%'".$where."   ) ";
		}elseif($_POST["noid"] == "3"){
			$where =" AND camp not like 'M01%' AND (goup like 'G11%' OR goup like 'G31%' OR goup like 'G32%')";
			$sql = "Select date_format(thidate,'%d-%m-%Y'), hn ,  ptname ,goup, camp From opday where thidate like '".$select_day."%' AND hn in (Select hn From opcard where idguard like 'MX03%'".$where."   ) ";		
		}else{
			$where =" AND camp like 'M01%' ";
			$sql = "Select date_format(thidate,'%d-%m-%Y'), hn ,  ptname ,camp From opday where thidate like '".$select_day."%' AND hn in (Select hn From opcard where idguard like 'MX03%'".$where."   ) ";
		}

		//echo $sql;
		//$sql = "Select date_format(thidate,'%d-%m-%Y'), hn ,  ptname ,camp From opday where thidate like '".$select_day."%' AND hn in (Select hn From opcard where idguard like 'MX03%'".$where."   ) ";

		$result = Mysql_Query($sql) or die(Mysql_Error());
		echo "<Table width='500'>";
		echo "<TR align='center' style='color:#FFFFFF;background-color: #3300FF;font-weight: bold;'><TD>วันที่มาตรวจรักษา</TD><TD>hn</TD><TD>ชื่อ-สกุล</TD><TD>goup</TD><TD>หน่วย</TD></TR>";

		$i=0;

		while(list($date, $hn, $ptname,$goup,$camp) = Mysql_fetch_row($result)){
		
		if($i % 2)
			$bgcolor= "#FFFFAE";
		else
			$bgcolor= "#FFFFFF";
				
				
				echo "<TR style='background-color: ".$bgcolor."'><TD align='center'>".$date."</TD><TD>".$hn."</TD><TD>".$ptname."</TD><TD>".$goup."</TD><TD>".$camp."</TD></TR>";
				
		$i++;
		}
		echo "</Table>";
	}

include("unconnect.inc");
?>

	</BODY>
</HTML>