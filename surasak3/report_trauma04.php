<?php
session_start();
set_time_limit(40);
include("connect.inc");

?>
<html>
<head>
<title>แบบรายงานเฝ้าระวังการบาดเจ็บ 19 สาเหตุ</title>
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
	
	
	
	$list_vehicle = array();
	
/*
	$list_vehicle["V01"] = "จักรยานและสามล้อ";
	$list_vehicle["V02"] = "จักรยานยนต์";
	$list_vehicle["V03"] = "รถเก๋ง";
	$list_vehicle["V04"] = "รถปิกอั๊พ หรือ รถตู้";
	$list_vehicle["V05"] = "รถบรรทุกหนัก ตั้งแต่ 6 ล้อ ขึ้นไป";
	$list_vehicle["V06"] = "รถพ่วง";
	$list_vehicle["V07"] = "รถโดยทาง 2 แถว";
	$list_vehicle["V08"] = "รถโดยสารบัล";
	$list_vehicle["V09"] = "อื่นๆ";
	$list_vehicle["V10"] = "ไม่ทราบ";
*/
	
	$list_vehicle["V01"] = "BC";
	$list_vehicle["V02"] = "Mc";
	$list_vehicle["V03"] = "PC";
	$list_vehicle["V04"] = "PU";
	$list_vehicle["V11"] = "VN";
	$list_vehicle["V12"] = "TC";
	$list_vehicle["V05"] = "TK";
	$list_vehicle["V06"] = "TK";
	$list_vehicle["V07"] = "99";
	$list_vehicle["V08"] = "BU";
	$list_vehicle["V09"] = "99";
	$list_vehicle["V10"] = "00";
	
	function vehicle($v){
		
		$vv = $v;
		switch($v){
			case "V01" :  $vv = "BC"; break;
			case "V02" :  $vv = "Mc"; break;
			case "V03" :  $vv = "PC"; break;
			case "V04" :  $vv = "PU"; break;
			case "V11" :  $vv = "VN"; break;
			case "V12" :  $vv = "TC"; break;
			case "V05" :  $vv = "TK"; break;
			case "V06" :  $vv = "TK"; break;
			case "V07" :  $vv = "99"; break;
			case "V08" :  $vv = "BU"; break;
			case "V09" :  $vv = "99"; break;
			case "V10" :  $vv = "00"; break;
			default : $vv = "00"; break;
		}

		return $vv;
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
		<TD><input type='submit' name="submit" value='     ตกลง     ' > <INPUT TYPE="button" value="print" onclick="wprint();"></TD>
	</TR>
	</TABLE>
	</form>

<?php 
	if(isset($_POST["submit"])){
		
		
		$sql = "Create Temporary table trauma2 Select list_ptright, hn, an, wounded_detail, helmet, belt, spirits, cure, date_in, wounded_vehicle, time_in, time_out, with_cause_accident, list_with_cause_accident   From trauma where trauma = 'trauma' AND type_accident = '1' AND date_in like '".$select_day."%' AND (list_ptright in ('P02', 'P03', 'P04', 'P05') OR list_ptright2 in ('P02', 'P03', 'P04', 'P05') ) Order by date_in DESC, time_in DESC ";

		$result = Mysql_Query($sql);
		
		$sql = "Create Temporary table opcard3 Select hn, yot, name, surname, camp From opcard  where hn in (Select hn From trauma2)";
		$result2 = Mysql_Query($sql);

		$sql = "CREATE TEMPORARY TABLE opacc2 SELECT sum(price) as price, date, hn FROM opacc WHERE date LIKE '".$select_day."%' AND hn in (Select hn From trauma2 ) Group by date, hn ";
		$result3 = Mysql_Query($sql);

		$sql = "CREATE TEMPORARY TABLE opday2  Select hn, an, thidate From opday where  thidate LIKE '".$select_day."%' AND an <> '' AND an is not NULL AND hn in (Select hn From trauma2 ) ";

		$result5 = Mysql_Query($sql);

		$sql = "Select count(hn) as c_hn From opday2 ";
		$result = Mysql_Query($sql);
		list($total_admit) = Mysql_fetch_row($result);


		
		
				
?>

แบบรายงานการบาดเจ็บ/เสียชีวิตจากอุบัติเหตุจราจรของทหาร - ครอบครัว
<table  cellpadding="2" cellspacing="0" border="1" bordercolor="#000000" style='BORDER-COLLAPSE: collapse'>
  <tr align="center">
    <td rowspan="2">ลำดับที่</td>
	<td rowspan="2">ว/ด/ป</td>
    <td rowspan="2">ชื่อ-สกุลผู้บาดเจ็บ</td>
    <td rowspan="2">HN/AN</td>
    <td colspan="4">ประเภท</td>
    <td rowspan="2">สังกัด</td>
    <td colspan="3">สถานะ</td>
    <td colspan="2">ยานพาหนะ</td>
    <td rowspan="2">หมวกกันน็อก</td>
    <td rowspan="2">เข็มขัดนิรภัย</td>
    <td rowspan="2">สุรา</td>
    <td colspan="4">ผลการรักษา</td>
	<td colspan="1" rowspan="2">ค่าใช่จ่ายในการ<BR>รักษาพยาบาล</td>
	<td rowspan="2">ว/ด/ป DC</td>
    
  </tr>
  <tr>
    <td align="center">นายทหาร</td>
    <td align="center">นายสิบ</td>
    <td align="center">พลฯ</td>
    <td align="center">ครอบครัว</td>
    <td align="center">คนเดินเท้า</td>
    <td align="center">ผู้ขับขี่</td>
    <td align="center">ผู้โดยสาร</td>
    <td align="center">ผู้ขับขี่</td>
    <td align="center">คู่กรณี</td>
    <td align="center">ไม่รักษา</td>
    <td align="center">Admit</td>
    <td align="center">Refer</td>
	<td align="center">D/C</td>

  </tr>
  <?php


$hn_old="";

$sql = "Select a.hn, a.an, b.yot, b.name, b.surname, a.list_ptright, a.wounded_detail, (case when(a.helmet <> '1')  then '<img src=\"../check2.gif\">' else '<img src=\"../check.gif\">' end) as helmet1, (case when(a.belt <> '1')  then '<img src=\"../check2.gif\">' else '<img src=\"../check.gif\">' end) as belt1, (case when(a.spirits <> '1')  then '<img src=\"../check2.gif\">' else '<img src=\"../check.gif\">' end) as spirits1, a.cure, date_format(a.date_in, '%d/%m/%y') as date_in2, a.date_in, b.camp, a.wounded_vehicle, a.with_cause_accident, a.list_with_cause_accident , a.time_in, a.time_out From trauma2 as a , opcard3 as b where a.hn=b.hn Group by hn , date_in2 Order by date_in ASC ";

$result = Mysql_Query($sql) or die(Mysql_error());
$i=1;

	$lst_ptright['P02'] = '&nbsp;'; 
	$lst_ptright['P03'] = '&nbsp;'; 
	$lst_ptright['P04'] = '&nbsp;'; 
	$lst_ptright['P05'] = '&nbsp;'; 

	$list_wounded["W01"] = '&nbsp;';
	$list_wounded["W02"] = '&nbsp;';
	$list_wounded["W03"] = '&nbsp;';

while($arr = Mysql_fetch_assoc($result)){
	
	$lst_ptright[$arr["list_ptright"]] = "<img src=\"../check.gif\">"; 
	$list_wounded[$arr["wounded_detail"]] = "<img src=\"../check.gif\">";
	$no = '&nbsp;';
	$admit = '&nbsp;';
	$refer = '&nbsp;';
	$dc = '&nbsp;';
	$dc_date = $arr['date_in2'];
	switch($arr["cure"]){
		case "no" : $no= "<img src=\"../check.gif\">"; break;
		case "admit" : $admit =  "<img src=\"../check.gif\">"; 
			
			if($arr['cure'] == "admit"){
				$sql = "Select date_format(dcdate,'%d/%m/%Y') as dc_date From ipcard where an = '".$arr["an"]."' limit 1 ";
				
				$result2 = Mysql_Query($sql);
				list($dc_date) = Mysql_fetch_row($result2);
			}
		
		break;
		case "refer" : $refer="<img src=\"../check.gif\">"; break;
		case "dic" : $dc="<img src=\"../check.gif\">"; break;
		case "d/c" : $dc="<img src=\"../check.gif\">"; break;
	}

 echo" <tr>
    <td align=\"center\">".$i."</td>
	<td align=\"center\">".$arr['date_in2']."</td>
    <td>".$arr["yot"]." ".$arr["name"]." ".$arr["surname"]."</td>
    <td align=\"center\">".$arr["hn"]."<BR>".$arr["an"]."</td>
    <td align=\"center\">".$lst_ptright['P02']."</td>
    <td align=\"center\">".$lst_ptright['P03']."</td>
    <td align=\"center\">".$lst_ptright['P04']."</td>
    <td align=\"center\">".$lst_ptright['P05']."</td>
    <td align=\"center\">".substr($arr['camp'],4)."</td>
    <td align=\"center\">".$list_wounded['W03']."</td>
    <td align=\"center\">".$list_wounded['W01']."</td>
    <td align=\"center\">".$list_wounded['W02']."</td>
    <td align=\"center\">".vehicle($arr['wounded_vehicle'])."</td>
    <td align=\"center\">".vehicle($arr["list_with_cause_accident"])."</td>
    <td align=\"center\">".$arr['helmet1']."</td>
    <td align=\"center\">".$arr['belt1']."</td>
    <td align=\"center\">".$arr['spirits1']."</td>
    <td align=\"center\">".$no."</td>
    <td align=\"center\">".$admit."</td>
    <td align=\"center\">".$refer."</td>
	<td align=\"center\">".$dc."</td>";

$Sum1 = 0;
$Sum = 0;


$sql = "Select sum(price) as price2 From opacc2 where date like '".$arr["date_in"]."%' AND hn = '".$arr["hn"]."' ";

$result2 = Mysql_Query($sql) or die(Mysql_error());
list($Sum1) = Mysql_fetch_row($result2);
$Sum = $Sum + $Sum1;

if($Sum == 0 && $arr["time_in"] > $arr["time_out"]){
	
	$xxx = explode("-",$arr["date_in"]);
	$xxx[0] = $xxx[0] - 543;

	$yyy = mktime(0,0,0,$xxx[1],$xxx[2]+1,$xxx[0]);
	$next_date = date("Y-m-d",$yyy);
	$xxx = explode("-",$next_date);
	$xxx[0] = $xxx[0] + 543;
	$next_date = $xxx[0]."-".$xxx[1]."-".$xxx[2];
	$sql = "Select sum(price) as price2 From opacc2 where date like '".$next_date."%' AND hn = '".$arr["hn"]."' ";
	$result2 = Mysql_Query($sql) or die(Mysql_error());
	list($Sum1) = Mysql_fetch_row($result2);
	$Sum = $Sum + $Sum1;
	
	$by_admit = " OR thidate like '".$next_date."%' ";
}else{	
	$by_admit = "";
}

if($admit == '<img src="../check.gif">' && $total_admit > 0){
	$sql = "Select sum(price) as price2 From ipacc where an in (Select an From opday2 where (thidate like '".$arr["date_in"]."%' ".$by_admi." ) AND hn = '".$arr["hn"]."' ) ";
	$result2 = Mysql_Query($sql) or die(Mysql_error());
	list($Sum1) = Mysql_fetch_row($result2);
}
$Sum = $Sum + $Sum1;

if($Sum == 0){
	
	$sql = "Select sum(a.price) as sum_price1, sum(b.price) as sum_price2 From patdata as a, drugrx as b where a.date like '".$arr["date_in"]."%' AND a.hn = '".$arr["hn"]."' AND b.date like '".$arr["date_in"]."%' AND b.hn = '".$arr["hn"]."'   ";

	$result2 = Mysql_Query($sql) or die(Mysql_error());
	list($Sum1, $Sum2) = Mysql_fetch_row($result2);
	$Sum = $Sum + $Sum1 + $Sum2;
}

	echo "<td align=\"right\">".number_format($Sum,2)."</td>
	<td align=\"center\">".$dc_date."</td>   
	
  </tr>";

$i++;

	$lst_ptright['P02'] = '&nbsp;'; 
	$lst_ptright['P03'] = '&nbsp;'; 
	$lst_ptright['P04'] = '&nbsp;'; 
	$lst_ptright['P05'] = '&nbsp;'; 
	$list_wounded["W01"] = '&nbsp;';
	$list_wounded["W02"] = '&nbsp;';
	$list_wounded["W03"] = '&nbsp;';
 }?>
</table>




<?php }?>


</body>
</html>





<?php include("unconnect.inc");?>