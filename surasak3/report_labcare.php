<?php
session_start();
include("connect.inc");

$list_labcare = array();


$list_labcare["L28"] = "ป้ายตา / ปิดตา";
$list_labcare["L29"] = "ฉีดยาใน ER / IM";
$list_labcare["L30"] = "ฉีดยาใน ER / IV";
$list_labcare["L31"] = "ฉีดยาใน ER / SC";
$list_labcare["L15"] = "เจาะ DTX";
$list_labcare["L16"] = "เจาะเลือด / เก็บ specimen";
$list_labcare["L32"] = "เตรียมฉีดยาเข่า (Synvise / GO-ON / KA / Hyruan)";
$list_labcare["L33"] = "เตรียมฉีด Needle puncture";
$list_labcare["L34"] = "เตรียมฉีด KA";
$list_labcare["L35"] = "เตรียม Aspirate cyst";
$list_labcare["L52"] = "Anterior nasal packing";
$list_labcare["L54"] = "Accupunture";
$list_labcare["L60"] = "Abdominal Tapping";
$list_labcare["L47"] = "aspirate Nail/Aspirate knee/Aspirate hematoma";
$list_labcare["L45"] = "Cold compression";
$list_labcare["L58"] = "CPR";
$list_labcare["L67"] = "Close Reduction";
$list_labcare["L17"] = "Dressing wound";
$list_labcare["L66"] = "Drip ยา";
$list_labcare["L06"] = "EKG 12 Lead";
$list_labcare["L26"] = "Eye irrigation";
$list_labcare["L65"] = "FHS";
$list_labcare["L57"] = "Hold ambu-bag";
$list_labcare["L20"] = "I & D";
$list_labcare["L50"] = "Irrigate bladder";
$list_labcare["L61"] = "LP ( lumbar puncture)";
$list_labcare["L04"] = "Nebulizer";
$list_labcare["L46"] = "Nail out/ Partial nail out";
$list_labcare["L22"] = "NG lavage";
$list_labcare["L49"] = "NG-feeding";
$list_labcare["L02"] = "On Oxygen";					
$list_labcare["L03"] = "On 02 – Sat.";					
$list_labcare["L05"] = "On EKG Monitor";
$list_labcare["L07"] = "On BP Monitor";
$list_labcare["L36"] = "On defibrillator";
$list_labcare["L08"] = "On Slab";
$list_labcare["L37"] = "Off Slab";
$list_labcare["L09"] = "On Cast";
$list_labcare["L38"] = "Off Cast";
$list_labcare["L10"] = "On Splint / FS";
$list_labcare["L39"] = "Off Splint / FS";
$list_labcare["L40"] = "Off wire";
$list_labcare["L41"] = "Off gauze bandage";
$list_labcare["L69"] = "Off Staple";
$list_labcare["L42"] = "On hard collar/ on soft collar/ on philladellphia";
$list_labcare["L43"] = "On jones ’bandage";
$list_labcare["L44"] = "On skin traction";
$list_labcare["L11"] = "Off Cast"; 
$list_labcare["L12"] = "On IVF";
$list_labcare["L13"] = "On Plug / Lock";
$list_labcare["L14"] = "On Blood";
$list_labcare["L21"] = "On NG tube";
$list_labcare["L48"] = "Off NG-Tube";
$list_labcare["L23"] = "On Foley’s catheter";
$list_labcare["L51"] = "Off Foley’s catheter";
$list_labcare["L56"] = "On ET-Tube/ on TT-Tube";
$list_labcare["L53"] ="Pack gauze";
$list_labcare["L63"] ="PR";
$list_labcare["L64"] ="PV";
$list_labcare["L27"] = "Remove FB";
$list_labcare["L18"] = "Suture"; 
$list_labcare["L19"] = "Stitches – off";
$list_labcare["L24"] = "Single catheter / intermittent cath";
$list_labcare["L25"] = "Sponge bath";
$list_labcare["L55"] ="Suction";
$list_labcare["L59"] ="Thoracentesis/ thoracocentesis";
$list_labcare["L62"] ="Throat Swab";
$list_labcare["L68"] ="Xylocaine block";

?>
<html>
<head>
<style type="text/css">


a:link {color:#0000FF; text-decoration:none;}
a:visited {color:#0000FF; text-decoration:none;}
a:active {color:#0000FF; text-decoration:none;}
a:hover {color:#0000FF; text-decoration:none;}

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
		
		if($_POST["d"] == ""){
			
			$day_now = $_POST["d"];
			$month_now = $_POST["m"];
			$year_now = $_POST["yr"];
			$select_day = $_POST["yr"]."-".$_POST["m"]."-01";
			$select_day2 = (date("Y",mktime(0,0,0,$_POST["m"]+1,01,$_POST["yr"]-543))+543)."-".date("m",mktime(0,0,0,$_POST["m"]+1,01,$_POST["yr"]-543))."-01";
			
		}else{

			$day_now = $_POST["d"];
			$month_now = $_POST["m"];
			$year_now = $_POST["yr"];

			$select_day = $_POST["yr"]."-".$_POST["m"]."-".$_POST["d"];
			$select_day2 = (date("Y",mktime(0,0,0,$_POST["m"],$_POST["d"]+1,$_POST["yr"]-543))+543).date("-m-d",mktime(0,0,0,$_POST["m"],$_POST["d"]+1,$_POST["yr"]-543));

		}

		

	}else{
		$select_day = (date("Y")+543).date("-m-d");
		$select_day2 = (date("Y",mktime(0,0,0,date("m"),date("d")+1,date("Y")))+543).date("-m-d",mktime(0,0,0,date("m"),date("d")+1,date("Y")));

		$day_now = date("d");
		$month_now = date("m");
		$year_now = (date("Y")+543);

	}
	
?>

	<form method='POST' action='report_labcare.php'>
	<p>วันที่&nbsp;&nbsp; 
	<input type='text' name='d' size='4' value='<?php echo $day_now;?>'>&nbsp;&nbsp;
	เดือน&nbsp; <input type='text' name='m' size='4' value='<?php echo $month_now;?>'>&nbsp;&nbsp;&nbsp;
	พ.ศ. <input type='text' name='yr' size='8' value='<?php echo $year_now;?>'></font></p>
	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type='submit' name="submit" value='     ตกลง     ' >&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;
	</p>
	</form>

	
<?php
	
	if($day_now != ""){
		$where = " AND ((date_in = '".$select_day."' AND (time_in >= '07:31:00' AND time_in <= '23:59:59' )) OR (date_in = '".$select_day2."' AND (time_in >= '00:00:00' AND time_in < '07:31:00' ))) ";
		$title="2";
	}else{
		$where = " AND (date_in BETWEEN '".$select_day." 07:31:00 ' AND '".$select_day2." 07:30:59' ) ";
		$title="2";
	}

	$sql="Select date_format( a.date_in, '%d' ) as days , date_format( a.date_in, '%m' ) as months , date_format( a.date_in, '%Y' ) as years,  a.time_in, time_format( a.time_in, '%H' ) as hours, time_format( a.time_in, '%i' ) as mins, time_format( a.time_in, '%s' ) as sec ,b.lst_labcare, b.amount From trauma as a, trauma_lst_labcare as b where a.row_id = b.for_id ".$where ;


	$result = Mysql_Query($sql);
	$type_w = array();
	while($arr = Mysql_fetch_assoc($result)){

		
		if($arr["time_in"] >= "07:31:00" && $arr["time_in"] < "15:31:00"){
			$type_w[$arr["lst_labcare"]]["A1"] = $type_w[$arr["lst_labcare"]]["A1"]+$arr["amount"]; 
		}else if($arr["time_in"] >= "15:31:00" && $arr["time_in"] < "23:31:00"){
			$type_w[$arr["lst_labcare"]]["A2"] = $type_w[$arr["lst_labcare"]]["A2"]+$arr["amount"]; 
		}else if($arr["time_in"] >= "23:31:00" && $arr["time_in"] <= "23:59:59"){
			$type_w[$arr["lst_labcare"]]["A3"] = $type_w[$arr["lst_labcare"]]["A3"]+$arr["amount"]; 
		}else if($arr["time_in"] >= "00:00:00" && $arr["time_in"] < "07:31:00"){
			$type_w[$arr["lst_labcare"]]["A3"] = $type_w[$arr["lst_labcare"]]["A3"]+$arr["amount"]; 
		}
	}

?>


<TABLE width="400" bordercolor="#000000" border="1" cellpadding="2" cellspacing="0">
<TR align="center">
	<TD rowspan="<?php echo $title;?>">ลำดับ</TD>
	<TD rowspan="<?php echo $title;?>">รายการ</TD>
	<TD colspan="3">เวร</TD>
	<TD rowspan="<?php echo $title;?>">จำนวน</TD>
</TR>
<TR align="center">
			<TD>ช</TD>
			<TD>บ</TD>
			<TD>ด</TD>
		</TR>


<?php
$i=1;

$sum1 = 0;
$sum2 = 0;
$sum3 = 0;
$sum4 = 0;

foreach($list_labcare as $key => $value){

		echo "<TR align=\"center\">
						<TD >",$i,"</TD>
						<TD ><A HREF=\"report_labcare_detail.php?key=".$key."&d=".$day_now ."&m=".$month_now ."&yr=".$year_now ."\" target=\"_blank\">",$value,"</A></TD>";

		echo "	<TD align=\"right\">",$type_w[$key]["A1"],"&nbsp;</TD>";
		echo "	<TD align=\"right\">",$type_w[$key]["A2"],"&nbsp;</TD>";
		echo "	<TD align=\"right\">",$type_w[$key]["A3"],"&nbsp;</TD>";
		echo "	<TD align=\"right\">",($type_w[$key]["A1"]+$type_w[$key]["A2"]+$type_w[$key]["A3"]),"</TD>";
		echo "</TR>";
$i++;

$sum1 = $sum1 + $type_w[$key]["A1"];
$sum2 = $sum2 + $type_w[$key]["A2"];
$sum3 = $sum3 + $type_w[$key]["A3"];
$sum4 = $sum4 + ($type_w[$key]["A1"]+$type_w[$key]["A2"]+$type_w[$key]["A3"]);
	}
?>

<?php

if($day_now != ""){
		$where = " AND ((date_in = '".$select_day."' AND (time_in >= '07:31:00' AND time_in <= '23:59:59' )) OR (date_in = '".$select_day2."' AND (time_in >= '00:00:00' AND time_in < '07:31:00' ))) ";
	}else{

		$where = " AND (date_in BETWEEN '".$select_day." 07:31:00 ' AND '".$select_day2." 07:30:59' ) ";
	}

$sql = "Select distinct b.labcare From trauma as a, trauma_labcare as b where a.row_id = b.for_id AND b.labcare != '' ".$where;

$result = Mysql_Query($sql);
while($arr = Mysql_fetch_assoc($result)){
	
	$j=0;
	$k=0;
	$l=0;

	$sql = "Select date_format( a.date_in, '%d' ) as days , date_format( a.date_in, '%m' ) as months , date_format( a.date_in, '%Y' ) as years, time_format( a.time_in, '%H' ) as hours, time_format( a.time_in, '%i' ) as mins, time_format( a.time_in, '%s' ) as sec, b.amount, a.time_in From trauma as a, trauma_labcare as b where a.row_id = b.for_id AND labcare = '".$arr["labcare"]."' ".$where;

	$result2 = Mysql_Query($sql);
	
	while($arr2 = Mysql_fetch_assoc($result2)){

		if($arr2["time_in"] >= "07:31:00" && $arr2["time_in"] < "15:31:00"){
			$j = $j+$arr2["amount"]; 
		}else if($arr2["time_in"] >= "15:31:00" && $arr2["time_in"] < "23:31:00"){
			$k = $k+$arr2["amount"]; 
		}else if($arr2["time_in"] >= "23:31:00" && $arr2["time_in"] <= "23:59:59"){
			$l = $l+$arr2["amount"]; 
		}else if($arr2["time_in"] >= "00:00:00" && $arr2["time_in"] < "07:31:00"){
			$l = $l+$arr2["amount"]; 
		}

	}
		echo "<TR align=\"center\">
						<TD >",$i,"</TD>
						<TD ><A HREF=\"report_labcare_detail2.php?key=".urlencode($arr["labcare"])."&d=".$day_now ."&m=".$month_now ."&yr=".$year_now ."\" target=\"_blank\">",$arr["labcare"],"</A></TD>";
		

			echo "<TD align=\"right\">",$j,"&nbsp;</TD>";
			echo "<TD align=\"right\">",$k,"&nbsp;</TD>";
			echo "<TD align=\"right\">",$l,"&nbsp;</TD>";

			echo "<TD align=\"right\">",($j+$k+$l),"</TD>";
			echo "</TR>";
$i++;

$sum1 = $sum1 + $j;
$sum2 = $sum2 + $k;
$sum3 = $sum3 + $l;
$sum4 = $sum4 + ($j+$k+$l);

}
echo "<TR align=\"center\">
						<TD align=\"center\" colspan=\"2\">รวม</TD>";

			echo "<TD align=\"right\">",$sum1,"&nbsp;</TD>";
			echo "<TD align=\"right\">",$sum2,"&nbsp;</TD>";
			echo "<TD align=\"right\">",$sum3,"&nbsp;</TD>";

			echo "<TD align=\"right\">",($sum4),"</TD>";
echo "</TR>";

if($day_now != ""){
		$where = " AND ((date_in = '".$select_day."' AND (time_in >= '07:31:00' AND time_in <= '23:59:59' )) OR (date_in = '".$select_day2."' AND (time_in >= '00:00:00' AND time_in < '07:31:00' ))) ";
}else{
		$where = " AND (date_in BETWEEN '".$select_day." 07:31:00 ' AND '".$select_day2." 07:30:59' ) ";
}

$sql = "Select row_id,time_in, obs From trauma where obs = '1' ".$where." ";

$result_obs = mysql_query($sql);
$j=0;
$k=0;
$l=0;
while($arr2 = mysql_fetch_assoc($result_obs)){

if($arr2["time_in"] >= "07:31:00" && $arr2["time_in"] < "15:31:00"){
			$j = $j+$arr2["obs"]; 
		}else if($arr2["time_in"] >= "15:31:00" && $arr2["time_in"] < "23:31:00"){
			$k = $k+$arr2["obs"]; 
		}else if($arr2["time_in"] >= "23:31:00" && $arr2["time_in"] <= "23:59:59"){
			$l = $l+$arr2["obs"]; 
			//echo $arr2["row_id"],"-";
		}else if($arr2["time_in"] >= "00:00:00" && $arr2["time_in"] < "07:31:00"){
			$l = $l+$arr2["obs"]; 
			//echo $arr2["row_id"],"-";
		}
}
echo "<TR align=\"center\">";
			echo "<TD align=\"center\" colspan=\"2\">Observe</TD>";
			echo "<TD align=\"right\">",$j,"&nbsp;</TD>";
			echo "<TD align=\"right\">",$k,"&nbsp;</TD>";
			echo "<TD align=\"right\">",$l,"&nbsp;</TD>";

			echo "<TD align=\"right\">",($j+$k+$l),"</TD>";
echo "</TR>";

echo "<TR align=\"center\">";
			echo "<TD align=\"center\" colspan=\"2\">รวม Observe + หัตถการ</TD>";
			echo "<TD align=\"right\">",$sum1+$j,"&nbsp;</TD>";
			echo "<TD align=\"right\">",$sum2+$k,"&nbsp;</TD>";
			echo "<TD align=\"right\">",$sum3+$l,"&nbsp;</TD>";

			echo "<TD align=\"right\">",$sum4+($j+$k+$l),"</TD>";
echo "</TR>";

?>

</TABLE>
</body>
</html>





<?php include("unconnect.inc");?>