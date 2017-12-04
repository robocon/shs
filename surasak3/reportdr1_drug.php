<?php

set_time_limit(30);
include("connect.inc");

if(isset($_GET["submit"])){

		$_GET["d"] = sprintf('%02d',$_GET["d"]);
		$_GET["m"] = sprintf('%02d',$_GET["m"]);
		$_GET["d2"] = sprintf('%02d',$_GET["d2"]);
		$_GET["m2"] = sprintf('%02d',$_GET["m2"]);

		$select_day = $_GET["yr"]."-".$_GET["m"]."-".$_GET["d"];
		

		$day_now = $_GET["d"];
		$month_now = $_GET["m"];
		$year_now = $_GET["yr"];

		$select_day2 = $_GET["yr2"]."-".$_GET["m2"]."-".$_GET["d2"];
		

		$day_now2 = $_GET["d2"];
		$month_now2 = $_GET["m2"];
		$year_now2 = $_GET["yr2"];
		

	}else{

		$select_day = (date("Y")+543).date("-m-d");
		$day_now = date("d");
		$month_now = date("m");
		$year_now = (date("Y")+543);

		$select_day2 = (date("Y")+543).date("-m-d");
		$day_now2 = date("d");
		$month_now2 = date("m");
		$year_now2 = (date("Y")+543);


	}

?>
<html>
<head>
<title>สรุป</title>
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

<B>รายงานสรุปการใช้ยา</B>

<form name="" method='GET' action='<?php echo $_SERVER["PHP_SELF"];?>'>
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
		<TD><input type='submit' value='     ตกลง     ' > <INPUT TYPE="button" value="print" onclick="wprint();"></TD>
	</TR>
	</TABLE>
	<INPUT TYPE="hidden" name="submit" value="true">
	</form>


<?php
if(strlen($select_day) == 10 && strlen($select_day2) == 10 ){

	$sql = "create temporary table drugrx_now Select price, amount, drugcode, tradname  From drugrx where an is Null  AND (date between '".$select_day." 00:00:00' AND '".$select_day2." 23:59:59') AND (left(drugcode,1) in ('0','1','2','3','4','5','6','7','8','9') AND right(left(drugcode,2),1) not in ('0','1','2','3','4','5','6','7','8','9'))";
	$result = Mysql_Query($sql) or die(mysql_error());

	$sql = "Select drugcode, tradname, sum(price) as sum_p, sum(amount) as sum_a From drugrx_now group by drugcode having sum(price) > 0 Order by sum_p DESC limit 10 ";
	$result = Mysql_Query($sql) or die(mysql_error());

	echo "<table border='1' bordercolor=\"#000000\" width='500' cellpadding=\"2\" cellspacing=\"0\">";
	echo "<TR align='center' style=\"background-color: #0055AA; color:#FFFFFF;font-weight: bold;\">";
				echo "<TD>ชื่อการค้า</TD>";
				echo "<TD>จำนวน</TD>";
				echo "<TD>ราคา</TD>";
			echo "</TR>";
	$i=0;
		while($arr = mysql_fetch_assoc($result)){
			if($i%2==0){
				$color = "#FFD1A4";
			}else{
				$color = "#FFFFFF";
			}

$drugcode[$i] = $arr["drugcode"];
$tradname[$i] = $arr["tradname"];
			echo "<TR bgcolor=\"".$color."\">";
				echo "<TD>",$arr["tradname"],"</TD>";
				echo "<TD align='right'>",number_format($arr["sum_a"],2,".",","),"</TD>";
				echo "<TD align='right'>",number_format($arr["sum_p"],2,".",","),"</TD>";
			echo "</TR>";
			$i++;
		}
	echo "</table>";

}


$sql = "Create temporary table phardep_now Select row_id, doctor From phardep where an is Null  AND (date between '".$select_day." 00:00:00' AND '".$select_day2." 23:59:59 ')  ";
	$result = Mysql_Query($sql) or die(mysql_error());

$sql = "Create temporary table drugrx_now2 Select drugcode, tradname, price, idno, amount  From drugrx where an is Null  AND (date between '".$select_day." 00:00:00' AND '".$select_day2." 23:59:59') AND (left(drugcode,1) in ('0','1','2','3','4','5','6','7','8','9') AND right(left(drugcode,2),1) not in ('0','1','2','3','4','5','6','7','8','9')) ";

	$result = Mysql_Query($sql) or die(mysql_error());


for($j=0;$j<count($drugcode);$j++){
echo "<BR><BR>";
echo "<FONT COLOR=\"red\"><B>",$tradname[$j],"</B></FONT>";
echo "<table border='1' bordercolor=\"#000000\" width='500' cellpadding=\"2\" cellspacing=\"0\">";
	echo "<TR align='center' style=\"background-color: #0055AA; color:#FFFFFF;font-weight: bold;\">";
				echo "<TD>แพทย์</TD>";
				echo "<TD>จำนวน</TD>";
				echo "<TD>ราคา</TD>";
			echo "</TR>";

$sql = "Select a.doctor, sum(b.price), sum(b.amount) From drugrx_now2 as b INNER JOIN phardep_now as a ON b.idno = a.row_id where  b.drugcode = '".$drugcode[$j]."'  GROUP by a.doctor Order by sum(b.price) DESC ";
$result = Mysql_Query($sql) or die(mysql_error());
$sum1 = 0; 
$sum2 = 0;
while(list($doctor,$price,$amount) = mysql_fetch_row($result)){

if($i==0){
				$color = "#FFD1A4";
				$i=1;
			}else{
				$color = "#FFFFFF";
				$i=0;
			}

			echo "<TR bgcolor=\"".$color."\">";
				echo "<TD>",$doctor,"</TD>";
				echo "<TD align='right'>",number_format($amount,2,".",","),"</TD>";
				echo "<TD align='right'>",number_format($price,2,".",","),"</TD>";
			echo "</TR>";
			$sum1 = $sum1 + $amount; 
			$sum2 = $sum2 + $price;
}
echo "<TR >";
				echo "<TD>รวม</TD>";
				echo "<TD align='right'>",number_format($sum1,2,".",","),"</TD>";
				echo "<TD align='right'>",number_format($sum2,2,".",","),"</TD>";
			echo "</TR>";
echo "</table>";
}

 include("unconnect.inc");
?>
</body>
</html>

