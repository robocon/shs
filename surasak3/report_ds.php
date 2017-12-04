<?php
session_start();
set_time_limit(30);
include("connect.inc");

if($_GET["action"] == "del"){

	$sql = "Delete From `trauma_ds` where row_id = '".$_GET["rowid"]."' ";
	Mysql_Query($sql);
	echo "<meta http-equiv=\"REFRESH\" content=\"0;url=report_ds.php\">";
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
	<form method='POST' action='report_ds.php'>
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

<TABLE width="700" cellpadding="2" cellspacing="0" border="1" bordercolor="#000000" style='BORDER-COLLAPSE: collapse'>
<TR align="center">
	<TD colspan="2">No.</TD>
	<TD>วัน-เวลา ยืนยัน</TD>
	<TD>HN</TD>
	<TD>ชื่อ - สกุล</TD>
	<TD>อายุ</TD>
	<TD>สิทธิ์</TD>
	<TD>ขนาด</TD>
	<TD>บริเวณ</TD>
	<TD>&nbsp;</TD>
	<TD>&nbsp;</TD>
</TR>

<?php
		if(!empty($_POST["yr"]) && !empty($_POST["m"])){
		
		if($_POST["d"] == ""){
			

			$select_day = $_POST["yr"]."-".$_POST["m"]."-01";
			$select_day2 =  (date("Y",mktime(0,0,0,$_POST["m"]+1,01,$_POST["yr"]-543))+543)."-".date("m",mktime(0,0,0,$_POST["m"]+1,01,$_POST["yr"]-543))."-01";

		}else{

			$select_day = $_POST["yr"]."-".$_POST["m"]."-".$_POST["d"];
			$select_day2 = (date("Y",mktime(0,0,0,$_POST["m"],$_POST["d"]+1,$_POST["yr"]-543))+543).date("-m-d",mktime(0,0,0,$_POST["m"],$_POST["d"]+1,$_POST["yr"]-543));
		}
		
		$dd = $_POST["d"];
		$mm = $_POST["m"];
		$yrr = $_POST["yr"]+543;

		}else{
		
		$dd = date("d");
		$mm = date("m");
		$yrr = date("Y")+543;

		$select_day = $yrr."-".$mm."-".$dd;
		$select_day2 = (date("Y",mktime(0,0,0,$mm,$dd+1,$yrr-543))+543).date("-m-d",mktime(0,0,0,$mm,$dd+1,$yrr-543));

		}

$i=1;
$j=0;

//		
		if($dd == ""){
			
			$where = " AND ( thidate between '".$select_day." 07:31:00' AND '".$select_day2." 07:30:59' )   ";

		}else{
			$where = " AND (( thidate between '".$select_day." 07:31:00' AND '".$select_day." 23:59:59' ) OR ( thidate between '".$select_day2." 00:00:00' AND '".$select_day2." 07:30:59' ) )";
		}
		
		$sql = "Select   row_id, right(thidate,8) as time_in , date_format(thidate,'%d/%m/%Y') , `hn` , `ptname` , `age` , `ptright` , `size` , `location` From `trauma_ds` where  type <> 'N' ".$where."  Order by thidate ASC ";


		$echoka = "";
		$echoka1 = "";
		
		$hn_now = "";
		$thidate_now = "";
		$thidate_now2 = "";
		$s_hn = array();
		$name_hn = array();


		$result = Mysql_Query($sql) or die(Mysql_Error());
		$k= Mysql_num_rows($result);
		while(list($row_id, $time_in, $thidate, $hn, $ptname, $age, $ptright, $size, $location) = Mysql_fetch_row($result)){
	
		$s_hn[$hn] = $s_hn[$hn] + 1;
		$name_hn[$hn] = $ptname; 
	
	
	if($thidate != $thidate_now2){
		echo "<TR bgcolor=\"#7DBEFF\"height=\"30\"><TD colspan=\"2\">No.</TD><TD colspan=\"11\" align=\"center\">&nbsp;&nbsp;<B>วันที่ ".$thidate."</B></TD></TR>";
		$thidate_now2 = $thidate;

		$j=1;
	}

	$echoka = echo_ka($time_in);
	if($echoka != $echoka1){
		echo "<TR><TD bgcolor=\"#7DBEFF\">&nbsp;</TD><TD bgcolor=\"#FFFFCC\">No.</TD><TD colspan=\"11\"  bgcolor=\"#FFFFCC\">&nbsp;&nbsp;<B> เวร ".$echoka."</B></TD></TR>";
		$echoka1 = $echoka;
		$i=1;
	
	
echo "<TR>";
	}

if($hn != $hn_now && $thidate.$time_in != $thidate_now){
	
	$hn_now = $hn;
	$thidate_now = $thidate.$time_in;
		echo "
						<TD bgcolor=\"#7DBEFF\">",$j,"</TD>
						<TD bgcolor=\"#FFFFCC\">",$i,"</TD>
						<TD align=\"center\">",$thidate." ".$time_in,"</TD>
						<TD>",$hn,"</TD>
						<TD>",$ptname,"</TD>
						<TD>",$age,"</TD>
						<TD>",$ptright,"</TD>";
}else{
	
	echo "<TD colspan=\"7\">&nbsp;</TD>";
	$i--;
	$j--;

}

		echo "						
						<TD align=\"center\">",$size,"</TD>
						<TD>",$location,"</TD>
						<TD align=\"center\"><A HREF=\"report_ds_edit.php?rowid=".$row_id."\" target=\"_blank\">แก้ไข</A></TD>
						<TD align=\"center\">
							
						<A HREF=\"#\" Onclick=\"if(confirm('ท่านต้องการลบข้อมูลใช่หรือไม่?')){window.location.href='report_ds.php?action=del&rowid=".$row_id."';}\">ลบ</A></TD>
					</TR>
						";
$i++;
$j++;

		}

?>
</Table>

<BR>

<?php
if($k > 0){
	echo "
	<TABLE>
	<TR>
		<TD colspan=\"2\">ผู้มาทำแผลทั้งหมด</TD>
		<TD align=\"right\">",count($s_hn)," คน</TD>
	</TR>
	<TR>
		<TD colspan=\"2\">รวมการทำแผลทั้งหมด</TD>
		<TD align=\"right\">",$k," ครั้ง</TD>
	</TR>";

	foreach($s_hn as $key => $value){

		echo "
		<TR>
			<TD>",$key,"</TD>
			<TD>",$name_hn[$key],"</TD>
			<TD align=\"right\">",$value," ครั้ง</TD>
		</TR>";

	}
}

echo "</TABLE>";
?>

</body>
</html>
<?php include("unconnect.inc");?>