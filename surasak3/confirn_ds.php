<?php
session_start();
include("connect.inc");


function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}

	if ($ageM==0){
		$pAge="$ageY ปี";
	}else{
		$pAge="$ageY ปี $ageM เดือน";
	}

return $pAge;
}

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
 <A HREF="report_ds.php" target="_blank">รายชื่อผู้มาทำแผลที่ยืนยันแล้ว</A>
<?php
	
	if(isset($_GET["row_id"]) && $_GET["row_id"] != ""){

		$sql = "Select hn, ptname, ptright, thidate From opday2 where row_id = '".$_GET["row_id"]."' limit 1 ";
		$result = Mysql_Query($sql);
		$arr = Mysql_fetch_assoc($result);
		
		$sql = "Select dbirth From opcard where hn = '".$arr["hn"]."' limit 1 ";
		$result = Mysql_Query($sql);
		list($dbirth) = Mysql_fetch_row($result);
		
		$sql = "Select size_wound, detail  From inhale_wound where hn = '".$arr["hn"]."' Order by row_id DESC limit 1 ";
		$result = Mysql_Query($sql);
		list($size_wound, $location) = Mysql_fetch_row($result);

		$age = calcage($dbirth);
		$sql = "Select count(hn) as c_hn From `trauma_ds` where hn='' AND thidate_regis = '' limit 1";
		list($rows) = Mysql_fetch_row(Mysql_Query($sql));
		
		if($rows == 0){
		$sql = "INSERT INTO `trauma_ds` (  `thidate` , `thidate_regis` , `hn` , `ptname` , `age` , `ptright`, `type`, `size`, `location` ) VALUES ( '".(date("Y")+543).date("-m-d H:i:s")."', '".$arr["thidate"]."', '".$arr["hn"]."', '".$arr["ptname"]."', '".$age."', '".$arr["ptright"]."', '".$_GET["stat"]."', '".$size_wound."', '".$location."');";

		Mysql_Query($sql);

		echo "<meta http-equiv=\"REFRESH\" content=\"0;url=confirn_ds.php\">";
		}else{
		echo "<meta http-equiv=\"REFRESH\" content=\"0;url=confirn_ds.php\">";

		}

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

			document.getElementById("form_01").style.display='none';
			window.print();

		}
	
	</SCRIPT>
	<form method='POST' action='confirn_ds.php'>
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

<SCRIPT LANGUAGE="JavaScript">

function checkForm(){

	if(confirm("ผู้ป่วยได้มาทำแผลจริงใช่หรือไม่?"))
		return true;
	else
		return false;

}

function send_data(row_id, stat){
	
	if(stat == "P" && confirm("ผู้ป่วยได้มาทำแผลจริงใช่หรือไม่?")){
		window.location.href="confirn_ds.php?row_id="+row_id+"&stat="+stat;
	}else if(stat == "N" && confirm("ต้องการลบข้อมูลคนไข้ออกจากรายการใช่หรือไม่?")){
		window.location.href="confirn_ds.php?row_id="+row_id+"&stat="+stat;
	}


}


</SCRIPT>
<TABLE width="600" cellpadding="2" cellspacing="0" border="1" bordercolor="#000000">

	<TD>HN</TD>
	<TD>AN</TD>
	<TD>เวลาลงทะเบียน</TD>
	<TD>ยศชื่อ-สกุล</TD>
	<TD>&nbsp;</TD>
	<TD>เคยยืนยันการทำแผลแล้ว</TD>
</TR>
<?php
		
		$list_count = array();
		$sql = " Select thidate_regis, hn From trauma_ds where thidate_regis like '".$select_day."%' ";
		$result = Mysql_Query($sql);
		while(list($thidate_regis, $hn) = Mysql_fetch_row($result)){
			$list_count[$thidate_regis.$hn] = true;
		}


		$sql = "Select row_id, hn, an, ptname, right(thidate,8) as time, thidate From opday2 where thidate like '".$select_day."%' AND left(toborow,4) = 'EX19' Order by thidate DESC ";

		$echoka = "";
		$echoka1 = "";


		$result = Mysql_Query($sql);

		while(list($row_id, $hn, $an, $ptname, $time, $thidate_regis) = Mysql_fetch_row($result)){
		
		if (array_key_exists($thidate_regis.$hn ,   $list_count))
			continue;
	

		echo "<TR>
						<TD align=\"center\">",$hn,"</TD>
						<TD align=\"center\">&nbsp;",$an,"</TD>
						<TD align=\"center\">&nbsp;",$time,"</TD>
						<TD>",$ptname,"</TD>
						<TD align=\"center\"><INPUT TYPE=\"button\"  value=\"ยืนยันการทำแผล\" Onclick=\"send_data('".$row_id."','P');\">
			&nbsp;
						<INPUT TYPE=\"button\"  value=\"ไม่นับ\" Onclick=\"send_data('".$row_id."','N');\"></TD>
							";
	
	$sql = "Select thidate From trauma_ds where thidate like '".$select_day."%' AND hn = '".$hn."' limit 1 ";
	$result2 = Mysql_Query($sql);
	list($thidate2) = Mysql_fetch_row($result2);
	echo "<TD>".$thidate2."&nbsp;</TD>";

	echo "</TR>
		";
$i--;
		}

?>
</TABLE>

</body>
</html>





<?php include("unconnect.inc");?>