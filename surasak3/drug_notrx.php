<?php
session_start();
include("connect.inc");
?>
<html>
<head>
<title>รายงานการจ่ายยาสูงสุด 10 อับดับ</title>
<style type="text/css">


a:link {color:#000000; text-decoration:none;}
a:visited {color:#000000; text-decoration:none;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}

body,td,th {
	font-family:  MS Sans Serif;
	font-size: 16 px;
}

.font_title{
	font-family:  MS Sans Serif;
	font-size: 16 px;
	color:#FFFFFF;
	font-weight: bold;

}
</style>
</head>
<body>
<?php


echo "<A HREF=\"../nindex.htm\" style='color:#FF0000;'>&lt; &lt; เมนู</A>";


if(isset($_POST["submit"])){

		$_POST["d"] = sprintf('%02d',$_POST["d"]);

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
<FORM METHOD=POST ACTION="">
<TABLE id="form_01">
	<TR>
		<TD>
		
	เดือน&nbsp; <input type='text' name='m' size='4' value='<?php echo $month_now;?>'>&nbsp;&nbsp;&nbsp;
	พ.ศ. <input type='text' name='yr' size='8' value='<?php echo $year_now;?>'>
		</TD>
	</TR>
	<TR>
		<TD><input type='submit' name="submit" value='     ตกลง     ' ></TD>
	</TR>
</TABLE>
</FORM>

<?php
	
	if($_POST["m"] == "" || $_POST["yr"] == ""){
		
		exit();

	}

	$str_date = $_POST["yr"]."-".$_POST["m"];

	$sql = "CREATE TEMPORARY TABLE sub_drugrx SELECT drugcode, tradname FROM drugrx WHERE tradname <> '' AND drugcode <> '2IM' AND drugcode <> '2IM' AND date like '".$str_date."%'  AND left(drugcode,1) in ('0','1','2','3','4','5','6','7','8','9') AND right(left(drugcode,2),1) not in ('0','1','2','3','4','5','6','7','8','9') Group by drugcode Having sum(amount) > 0 ";
	$result = Mysql_Query($sql) or die(Mysql_Error());
	
	$sql = "CREATE TEMPORARY TABLE sub_druglst SELECT drugcode, tradname, unitpri, part FROM druglst WHERE left(drugcode,1) in ('0','1','2','3','4','5','6','7','8','9') AND right(left(drugcode,2),1) not in ('0','1','2','3','4','5','6','7','8','9') ";
	$result = Mysql_Query($sql) or die(Mysql_Error());



	$sql = "Select a.drugcode, a.tradname From sub_druglst as a LEFT JOIN  sub_drugrx as b ON a.drugcode = b.drugcode  where b.drugcode is Null ";
	$result = Mysql_Query($sql) or die(Mysql_Error());


?>
	<TABLE   align="center" border="1" bordercolor="#3366FF">
	<TR>
		<TD>
	<TABLE>
	<TR bgcolor="#3366FF" colspan="2" align="center" style="color:#FFFFFF;">
		<TD>No.</TD>
		<TD>ชื่อยา</TD>
	</TR>
<?php
	$i=1;
	while($arr = Mysql_fetch_assoc($result)){

	if($i %2 == 0){
				$bgcolor = "#FFFFA6";
			}else{
				$bgcolor = "#FFFFFF";
			}

		echo "<TR bgcolor='$bgcolor'>";
			echo "<TD>".$i."</TD>";
			echo "<TD>".$arr["tradname"]."</TD>";
		echo "</TR>";
	
	$i++;

	}
?>
	</TABLE>
	</TD>
</TR>
</TABLE>

</body>
</html>
<?php include("unconnect.inc");?>