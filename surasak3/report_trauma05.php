<?php
session_start();
set_time_limit(30);
include("connect.inc");

?>
<html>
<head>
<title>รายงานผู้ป่วยนำส่งโดย อปพร/1669/กู้ชีพ/กู้ชีพรพ.ค่าย</title>
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
	
	
	$list_ptright = array();
	
	$list_ptright["P02"] = "ทหาร (น)";
	$list_ptright["P03"] = "ทหาร (นส)";
	$list_ptright["P04"] = "ทหาร (พลฯ)";
	$list_ptright["P05"] = "ครอบครัว";
	$list_ptright["P06"] = "พ.ต้น";
	$list_ptright["P07"] = "พ.";
	$list_ptright["P08"] = "ประกันสังคม";
	$list_ptright["P09"] = "30บาท";
	$list_ptright["P10"] = "30บาทฉุกเฉิน";
	$list_ptright["P11"] = "พรบ.";
	$list_ptright["P12"] = "กท.44";

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
		<TD><input type='submit' name="submit" value='     ตกลง     ' > <INPUT TYPE="button" value="print" onClick="wprint();"></TD>
	</TR>
	</TABLE>
	</form>

<?php 
	if(isset($_POST["submit"])){
		
		
		$sql = "Create Temporary table trauma2 Select list_ptright, hn, an, dx, age, maintenance, cure, date_in, sender ,etc_sender From trauma where sender in ('2','4','5','6')  AND ( date_in between '".$select_day." 00:00:00' AND '".$select_day2." 23:59:59' ) Order by  date_in DESC ";
		$result = Mysql_Query($sql);

		$sql = "Create Temporary table opcard2 Select hn, yot, name, surname, idcard From opcard  where hn in (Select hn From trauma2) ";
		$result = Mysql_Query($sql);
		

?>

รายงานผู้ป่วยนำส่งโดย อปพร/1669/กู้ชีพ/กู้ชีพรพ.ค่าย
<table  cellpadding="2" cellspacing="0" border="1" bordercolor="#000000" style='BORDER-COLLAPSE: collapse'>
  <tr>
    <td align="center">ลำดับ</td>
    <td align="center">HN</td>
	<td align="center">AN</td>
    <td align="center">ว/ด/ป</td>
    <td align="center">ชื่อ-สกุล</td>
    <td align="center">อายุ</td>
	<td align="center">idcard</td>
    <td align="center">สิทธิการ<BR>รักษา</td>
    <td align="center">โรค</td>
    <td align="center">การรักษาที่ได้</td>
    <td align="center">Admit/D/C/<BR>Refer</td>
	<td align="center">day DC</td>
    <td align="center">หมายเหตุ</td>

  </tr>
  <?php

$sql = "Select a.hn, a.an, date_format(date_in,'%d/%m/%Y') as date_in2, b.yot, b.name, b.surname, a.age, a.list_ptright , a.dx , a.maintenance, a.cure, a.sender,a.etc_sender, b.idcard   From trauma2 as a , opcard2 as b where a.hn=b.hn  Group by a.hn Order by date_in ASC ";
$result = Mysql_Query($sql);
$i=1;

while($arr = Mysql_fetch_assoc($result)){
	
	$arr['cure'] = str_replace('dic','d/c',$arr['cure']);
	
	if($arr["sender"]=='2'){
		$sender="ALS";
	}elseif($arr["sender"]=='3'){
		$sender="BLS";
	}elseif($arr["sender"]=='4'){
		$sender="FR";
	}else{
		$sender="";
	}

 echo" <tr>
    <td align=\"center\">".$i."</td>
    <td align=\"center\">&nbsp;".$arr["hn"]."&nbsp;</td>
	<td align=\"center\">&nbsp;".$arr["an"]."&nbsp;</td>
    <td align=\"center\">".$arr['date_in2']."</td>
    <td align=\"center\">",$arr['yot']," ", $arr['name'], " ", $arr['surname']."</td>
    <td align=\"center\">".$arr['age']."</td>
	<td align=\"center\">".$arr['idcard']."</td>
    <td align=\"center\">".$list_ptright[$arr['list_ptright']]."</td>
    <td align=\"center\">".$arr['dx']."</td>
    <td align=\"center\">".$arr['maintenance']."</td>
	<td align=\"center\">".($arr['cure']=='no' ? 'ไม่รับบริการ':$arr['cure'])."</td>";

if($arr['cure'] == "admit"){
	$sql = "Select date_format(dcdate,'%d/%m/%Y') as dc_date From ipcard where an = '".$arr["an"]."' limit 1 ";
	
	$result2 = Mysql_Query($sql);
	list($dc_date) = Mysql_fetch_row($result2);
}


echo "<td align=\"center\">".$dc_date."</td>
    <td >".$sender."</td>
  </tr>";
$dc_date = "";
$i++;

 }?>
</table>




<?php }?>


</body>
</html>





<?php include("unconnect.inc");?>