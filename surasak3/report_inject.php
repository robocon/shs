<?php
session_start();
include("connect.inc");

if($_GET["action"] == "del"){

	$sql = "Delete From `trauma_inject` where row_id = '".$_GET["rowid"]."' ";
	Mysql_Query($sql);
	echo "<meta http-equiv=\"REFRESH\" content=\"0;url=report_inject.php\">";
exit();
}

function echo_ka($time){
		

		if($time >= "07:31:00" && $time < "15:31:00"){
			$ka = "เช้า";
		}else if($time >= "15:31:00" && $time < "23:31:00"){
			$ka = "บ่าย";
		}else if($time >= "23:31:00" && $time <= "23:59:59"){
			$ka = "ดึก";
		}else if($time >= "00:00:00" && $time < "07:31:00"){
			$ka = "ดึก";
		}
		
		return $ka;

	}

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


a:link {color:#0000FF; text-decoration:none;}
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
<SCRIPT LANGUAGE="JavaScript">
	
		function wprint(){

			document.getElementById("form_01").style.display='none';
			window.print();

		}
	
	</SCRIPT>
	<form method='POST' action='report_inject.php'>
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
		<TD><input type='submit' name="submit" value='     ตกลง     ' ></TD>
	</TR>
	</TABLE>
	</form>

<TABLE width="800" cellpadding="2" cellspacing="0" border="1" bordercolor="#000000" style='BORDER-COLLAPSE: collapse'>
<TR align="center">
	<TD>No.</TD>
	<TD>วัน-เวลา ยืนยัน</TD>
	<TD>HN</TD>
	<TD>ชื่อ - สกุล</TD>
	<TD>อายุ</TD>
	<TD>สิทธิ์</TD>
	<TD>ประเภทการฉีด</TD>
	<TD>ชื่อยา</TD>
	<TD>&nbsp;</TD>
	<TD>&nbsp;</TD>
</TR>

<?php
		if(!empty($_POST["yr"]) && !empty($_POST["m"]) && !empty($_POST["d"])){
		
		$select_day = $_POST["yr"]."-".$_POST["m"]."-".$_POST["d"];
		$select_day2 = (date("Y",mktime(0,0,0,$_POST["m"],$_POST["d"]+1,$_POST["yr"]-543))+543).date("-m-d",mktime(0,0,0,$_POST["m"],$_POST["d"]+1,$_POST["yr"]-543));

		}else{
		
		$dd = date("d");
		$mm = date("m");
		$yrr = date("Y")+543;

		$select_day = $yrr."-".$mm."-".$dd;
		$select_day2 = (date("Y",mktime(0,0,0,$mm,$dd+1,$yrr-543))+543).date("-m-d",mktime(0,0,0,$mm,$dd+1,$yrr-543));

		}
$i=1;
//		
		$where = " (( thidate between '".$select_day." 07:31:00' AND '".$select_day." 23:59:59' ) OR ( thidate between '".$select_day2." 00:00:00' AND '".$select_day2." 07:30:59' ) ) ";
		
		$sql = "Select   row_id, right(thidate,8) as time_in , date_format(thidate,'%d/%m/%Y') , `hn` , `ptname` , `age` , `ptright` , `type` , `tradname` From `trauma_inject` where  ".$where." AND type <> 'NO' Order by thidate ASC ";
		
		$echoka = "";
		$echoka1 = "";

$hn_now = "";
$thidate_now = "";

		$result = Mysql_Query($sql) or die(Mysql_Error());
		while(list($row_id, $time_in, $thidate, $hn, $ptname, $age, $ptright, $type, $tradname) = Mysql_fetch_row($result)){
	
	$echoka = echo_ka($time_in);

	if($echoka != $echoka1){
		echo "<TR bgcolor=\"#FFFFCC\"><TD colspan=\"10\">&nbsp;&nbsp;<B> เวร ".$echoka."</B></TD></TR>";
		$echoka1 = $echoka;
		$i=1;
	}

echo "<TR>";
if($hn != $hn_now && $thidate.$time_in != $thidate_now){
	
	$hn_now = $hn;
	$thidate_now = $thidate.$time_in;
		echo "
						<TD>",$i,"</TD>
						<TD align=\"center\">",$thidate." ".$time_in,"</TD>
						<TD>",$hn,"</TD>
						<TD>",$ptname,"</TD>
						<TD>",$age,"</TD>
						<TD>",$ptright,"</TD>";
}else{
	
	echo "<TD colspan=\"6\">&nbsp;</TD>";
	$i--;

}

		

		echo "
						<TD align=\"center\">",$type,"</TD>
						<TD>",$tradname,"</TD>
						<TD><A HREF=\"report_inj_edit.php?rowid=".$row_id."\" target=\"_blank\">แก้ไข</A></TD>
						<TD align=\"center\"><A HREF=\"#\" Onclick=\"if(confirm('ท่านต้องการลบข้อมูลใช่หรือไม่?')){window.location.href='report_inject.php?action=del&rowid=".$row_id."';}\">ลบ</A></TD>
					</TR>
						";
$i++;
		}
?>
</Table>
</body>
</html>
<?php include("unconnect.inc");?>