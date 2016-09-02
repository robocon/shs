<?php
session_start();
include("connect.inc");
if(isset($_GET["action"])){
	header("content-type: application/x-javascript; charset=TIS-620");
}
?>

<style type="text/css">
<!--
.font3 {
	font-family: "TH SarabunPSK";
	font-size:30px;
}
.font1 {
	font-family: "TH SarabunPSK";
	font-size:20px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
}

	.today { font-family: Angsana New; font-size: 24px; font-weight: bold; background-color: #C6B3FF; color: #000000;  }
	.sunday { font-family: Angsana New; font-size: 24px; font-weight: bold; background-color: #FF9393; color: #FFFFFF; }
	.saturday { font-family: Angsana New; font-size: 24px; font-weight: bold; background-color: #ECC4FF; color: #000000; }
	.norm     { font-family: Angsana New; font-size: 24px; font-weight: bold; background-color: #FFFFFF; color: #000000; }
	.link_calendar { font-family: Angsana New; font-size: 24px; font-weight: bold; background-color: #FFFFFF; color: #000000; }
	.total_appointnorm { font-family: Angsana New; font-size: 24px; font-weight: bold; background-color: #FFFFFF; color: #FF0000; text-decoration:none;}
	.total_appointsunday { font-family: Angsana New; font-size: 24px; font-weight: bold; background-color: #FF9393; color: #FF0000;
	text-decoration:none;}
	.total_appointsaturday { font-family: Angsana New; font-size: 24px; font-weight: bold; background-color: #ECC4FF; color: #FF0000;
	text-decoration:none;}
-->
</style>

<script>
function show_tooltip(title,detail,al,l,r){

	tooltip.style.left=document.body.scrollLeft+event.clientX+l;
	tooltip.style.top=document.body.scrollTop+event.clientY+r;
	tooltip.innerHTML="";
	tooltip.innerHTML = tooltip.innerHTML+"<TABLE border=\"1\" bordercolor=\"blue\"><TR bgcolor=\"blue\"><TD align=\"center\"><B><FONT COLOR=\"#FFFFFF\">"+title+"</FONT></B></TD></TR><TR><TD align=\""+al+"\">"+detail+"</TD></TR></TABLE>";
	tooltip.style.display="";
}

function hid_tooltip(){
	tooltip.style.display="none";
	tooltip.innerHTML = "";

}
function handlerMMX(e){
	x = (document.layers) ? e.pageX : document.body.scrollLeft+event.clientX

	return x;
}

function handlerMMY(e){
	y = (document.layers) ? e.pageY : document.body.scrollTop+event.clientY
	return y;
}
</script>
</head>
<?
function LastDay($m, $y) {
   for ($i=29; $i<=32; $i++) {
      if (checkdate($m, $i, $y) == 0) {
         return $i - 1;
      }
   }
}

if($_GET["action"] == "carlendar"){

/*$sql = "Select mdcode From inputm where name = '".$_SESSION["dt_doctor"]."' limit 1";
list($mdcode) = Mysql_fetch_row(Mysql_Query($sql));
echo $sql;*/

$sql = "Select name From doctor where name like '".substr($_SESSION["dt_doctor"],0,5)."%' limit 1 ";
list($appoint_doctor) = Mysql_fetch_row(Mysql_Query($sql));


/*switch($_SESSION["dt_doctor"]){
	case 'ปิยะบุตร บุญมี (ว.29265)': $appoint_doctor ="MD060  ปิยะบุตร บุญม"; Break;
	case 'สมัชชา เบี้ยจรัส (ว.20182)': $appoint_doctor ="MD014 สมัชชา เบี้ยจรัส"; Break;
	case 'พิพิธ บุรัสการ (ว.38220)': $appoint_doctor ="MD056  พิพิธ  บุรัสการ"; Break;
	case 'สุรภัทร ศรีนนท์ (ว.29290)': $appoint_doctor ="MD048  สุรภัทร ศรีนนท์"; Break;
	case 'วันชาติ นำประเสริฐชัย (ว.24535)': $appoint_doctor ="MD047  วันชาติ นำประเสริฐชัย"; Break;
	case 'นิธิไชย บุญไชย (ว.28437)': $appoint_doctor ="MD053  นิธิไชย  บุญไชย"; Break;
	case 'ปฎิพงค์ ศรีทิภัณฑ์ (ว.10212)': $appoint_doctor ="MD037 ปฏิพงค์  ศรีทิภัณฑ์"; break;
	case 'ไพบูลย์ คูหเพ็ญแสง (ว.38222)': $appoint_doctor ="MD057  ไพบูลย์  คูหเพ็ญแสง"; Break;
	case 'อัศวิน แก้วเนตร (ว.21329)': $appoint_doctor ="MD016 อัศวิน แก้วเนตร"; Break;
	case 'ศุภสิทธิ์ คงมีผล (ว.20278)': $appoint_doctor ="MD036 ศุภสิทธิ์  คงมีผล"; Break;
	case 'ธนบดินทร์ ผลศรีนาค (ว.19921)': $appoint_doctor ="MD013 ธนบดินทร์ ผลศรีนาค"; Break;
	case 'อนุพงษ์ รอดสาย (ว.20186)': $appoint_doctor ="MD011 อนุพงษ์ รอดสาย"; Break;
	case 'นภสมร ธรรมลักษมี (ว.19364)': $appoint_doctor ="MD009 นภสมร ธรรมลักษมี"; Break;
	case 'ทองแดง อาฒยะพันธ์ (ว.24512)': $appoint_doctor ="MD051  ทองแดง  อาฒยะพันธ์"; Break;
	case 'วุฒิไชย อิศระ (ว.14286)': $appoint_doctor ="MD052  วุฒิไชย  อิศระ"; Break;
	case 'วรวิทย์ วงษ์มณี (ว.27035)': $appoint_doctor ="MD041  วรวิทย์ วงษ์มณี"; Break;
	case 'เลือก  ด่านสว่าง  (ว.12891)': $appoint_doctor ="MD006 เลือก ด่านสว่าง"; Break;
	case 'ณรงค์ ปรีดาอนันทสุข (ว.12456)': $appoint_doctor ="MD007 ณรงค์ ปรีดาอนันทสุข"; Break;
	case 'อรรณพ ธรรมลักษมี (ว.16633)': $appoint_doctor ="MD008 อรรณพ ธรรมลักษมี"; Break;
	case 'ชัยเนตรอาร์ เนตรพิชิต (ว.28422)': $appoint_doctor ="MD059  ชัยเนตรอาร์ เนตรพิชิต"; Break;
	case 'การุณย์ สุริยวงศ์พงศา (ว.13553)': $appoint_doctor ="MD054  การุณย์  สุริยวงศ์พงศา"; Break;
	case 'กฤษฎิ์พงษ์ ศิริสารศักดา': $appoint_doctor ="MD061 กฤษฎิ์พงษ์ ศิริสารศักดา"; Break;
	case 'กัณฐรัตน์ จันรุ่งเรือง': $appoint_doctor ="MD062 กัณฐรัตน์ จันรุ่งเรือง"; Break;
	case 'ณัฐพล แหยมแก้ว': $appoint_doctor ="MD063 ณัฐพล แหยมแก้ว"; Break;
	case 'กฤษดากร ไวทยโยธิน (ว.37525)': $appoint_doctor ="MD050  กฤษดากร ไวทยโยธิน"; Break;
}*/

   /* $diffHour และ $diffMinute คือตัวแปรที่ใช้เก็บจำนวนชั่วโมงและจำนวนนาทีที่แตกต่างกันระหว่างเครื่อง ไคลเอนต์กับเครื่องเซิร์ฟเวอร์ ตามลำดับ เช่นถ้าเวลาของเครื่องไคลเอ็นต์เร็วกว่าเวลาของเครื่องเซิร์ฟเวอร์ 11 ชั่วโมง 15 นาที ก็ให้กำหนด $diffHour เป็น 11 และกำหนด $diffMinute เป็น 15 */
$diffHour = 0;
$diffMinute = 0;

if ($dfMonth == "") {
   /* ถ้าไม่มีการระบุให้แสดงปฏิทินของเดือนใดเดือนหนึ่ง เราจะแสดงปฏิทินของเดือนปัจจุบันตามเวลาในเครื่องไคลเอ็นต์ โดยใช้ฟังก์ชั่น getdate() สร้างวันที่/เวลาปัจจุบันของเครื่องไคลเอ็นต์เก้บไว้ในตัวแปร $calTime ซึ่งฟังก์ชั่นนี้จะคืนค่ากลับมาเป็นอาร์เรย์ */
   $calTime = getdate(date(mktime(date("H") + $diffHour,
   date("i") + $diffMinute)));
   $today = $calTime["mday"];     //วันที่
   $month = $calTime["mon"];      //เดือน
   $year = $calTime["year"];        // ปี
}
else {
   /* กรณีที่ระบุให้แสดงปฏิทินของเดือน/ปีหนึ่งๆ นั้น จะมีการส่งตัวแปร $today,
$dfMonth และ $dfYear ผ่านมาทาง query string ด้วย */
   if ($dfMonth == 0) {
   /* ถ้าตัวแปร $dfMonth เป็น 0 เราจะแสดงปฏิทินของเดือนธันวาคมของปีที่น้อยกว่าปีที่กำลังแสดงอยู่ */
       $dfMonth = 12;
       $dfYear = $dfYear - 1;
   }
   elseif ($dfMonth == 13) {
   /* ถ้าตัวแปร $dfMonth เป็น 13 เราจะแสดงปฏิทินของเดือนมกราคมของปีที่มากกว่าปีที่กำลังแสดงอยู่ */
       $dfMonth = 1;
       $dfYear = $dfYear + 1;
   }

   //สร้างวัน/เวลาของเดือนและปีที่ผู้ใช้ระบุ เก็บไว้ในตัวแปร $calTime
   $calTime = getdate(date(mktime((date("H") + $diffHour),
      (date("i") + $diffMinute), 0, $dfMonth, $today, $dfYear)));
   $today = $calTime["mday"];      //วันที่
   $month = $calTime["mon"];       //เดือน
   $year = $calTime["year"];         //ปี
}



/* เรียกฟังก์ชัน LastDay() ซึ่งเป็นฟังก์ชั่นที่เราสร้างขึ้นเอง เพื่อหา"จำนวนวัน" ของเดือนและปีที่จะแสดงปฏิทิน โดยเก้บไว้ในตัวแปร $Lday */
$Lday = LastDay($month, $year);
//เก็บ timestamp ของวันที่ 1 ของเดือนที่จะแสดงปฏิทิน ไว้ในตัวแปร $FTime
$FTime = getdate(date(mktime(0, 0, 0, $month, 1, $year)));
//เก็บ "วันในสัปดาห์" (จันทร์, อังคาร ฯลฯ) ของวันที่ 1 ของเดือนไว้ในตัวแปร $wday
$wday = $FTime["wday"];

//สร้างตัวแปรชนิดอาร์เรย์เก็บชื่อเดือนภาษาไทย
$thmonthname = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");

$sql = "Select appdate, apptime, count(distinct hn) as total_app From appoint  where appdate like '% ".$thmonthname[$month - 1]." ".($year+543)."' AND doctor in ('".$_SESSION["dt_doctor"]."','".$appoint_doctor."') AND apptime <> 'ยกเลิกการนัด' GROUP BY appdate, apptime  ";

$result = Mysql_Query($sql);
$list_app = array();
while($arr = Mysql_fetch_assoc($result)){
	
	$list_app["A".substr($arr["appdate"],0,2)]["detail"] .= " ".$arr["apptime"]." จำนวน ".$arr["total_app"]." คน<BR>";
	$list_app["A".substr($arr["appdate"],0,2)]["sum"] = $list_app["A".substr($arr["appdate"],0,2)]["sum"] + $arr["total_app"];


}

$sql = "Select date_format(date_holiday,'%d') as date_holiday2, detail From holiday where date_holiday like '".($year+543)."-".sprintf("%02d",$month)."%' ";


$result = Mysql_Query($sql);
while($arr = Mysql_fetch_assoc($result)){
	$holiday["A".$arr["date_holiday2"]]["date"] = true;
	$holiday["A".$arr["date_holiday2"]]["detail"] = $arr["detail"];

}

$long_time = $month+$year;
$month2 = date("m");
$year2 = date("Y");
$long_time2 = $month2 + $year2;


if($year == $year2){
	if(($long_time - $long_time2) >0 )
		$title_time = " (นัด ".($long_time - $long_time2)." เดือน)";
}else{
		$title_time = " (นัด ".(12 - date("m") + $month )." เดือน)";
}

echo "<TABLE>
<TR   valign=\"top\">
	<TD>";

	/*	$i=  count($_COOKIE);
		if($i > 1){

			foreach($_COOKIE as $key => $value){
				
				$xxx = explode(">",$value);
				$yyy = explode("<",$xxx[1]);
				$zzz = $yyy[0];
				
				$sql = "Select count(appdate) as c_app From appoint where appdate = '".$zzz."' AND doctor in ('".$_SESSION["dt_doctor"]."','".$appoint_doctor."') AND apptime <> 'ยกเลิกการนัด'  ";

				$result = Mysql_Query($sql) or die(mysql_error());
				list($c_app) = Mysql_fetch_row($result);

				echo "",$value,"(".$c_app." คน)(1M)[X]<BR>";
				$i--;
				if($i==1)
					break;
			}
		}
*/
echo "	</TD>
</TD>
	<TD>";

if(!checkdate  ( $month - 1, $today  , $year  )){
	$today1 = "1";
}else{
	$today1 = $today;
}

if(!checkdate  ( $month + 1, $today  , $year  )){
	$today2 = "1";
}else{
	$today2 = $today;
}


echo "<table border=\"1\" bordercolor=\"black\" width=\"320\" height=\"270\">
<tr class=\"norm\"><td width=\"50\" align=\"center\">
<a href=\"javascript:void(0);\" Onclick=\"show_carlendar('&today=".$today1."&dfMonth=".($month - 1)."&dfYear=".$year."');\">&lt;</a>
</td>
<td width=\"250\" align=\"center\" colspan=\"5\" bgcolor=\"#F9F4DD\">
".$thmonthname[$month - 1]."&nbsp;
".($year + 543)." ".$title_time."
</td>
<td width=\"50\" align=\"center\">
<a href=\"javascript:void(0);\" Onclick=\"show_carlendar('&today=".$today2."&dfMonth=".($month + 1)."&dfYear=".$year."');\">&gt;</a>
</td></tr>

<tr><td width=\"50\" align=\"center\" class=\"sunday\">อา</td>
<td width=\"50\" align=\"center\" class=\"norm\">จ</td>
<td width=\"50\" align=\"center\" class=\"norm\">อ</td>
<td width=\"50\" align=\"center\" class=\"norm\">พ</td>
<td width=\"50\" align=\"center\" class=\"norm\">พฤ</td>
<td width=\"50\" align=\"center\" class=\"norm\">ศ</td>
<td width=\"50\" align=\"center\" class=\"saturday\">ส</td></tr><tr height=\"60\" valign=\"top\">";


$iday = 1;
//แสดงแถวแรกของปฏิทิน
for ($i=0; $i<=6; $i++) {
	$holiday_detail = "";
   if ($i < $wday) {    //แสดงเซลล์ว่างก่อนวันที่ 1 ของเดือน
      if ($i == 0) {       //กรณีที่เป็นวันอาทิตย์
         echo "<td width=\"50\" align=\"center\" class=\"sunday\">&nbsp;</td>\n";
      }else if ($i == 6) {       //กรณีที่เป็นวันเสาร์
         echo "<td width=\"50\" align=\"center\" class=\"saturday\">&nbsp;</td>\n";
      }
      else {              //กรณีที่เป็นวันอื่นๆ ที่ไม่ใช่วันอาทิตย์
         echo "<td width=\"50\" align=\"center\" class=\"norm\">&nbsp;</td>\n";
      }
   }
   else {                  //แสดงวันที่ในแถวแรกของปฏิทิน
      if ($i == 0 ) {
      //กรณีที่เป็นวันอาทิตย์ และไม่ใช่วันปัจจุบัน
         echo "<td width=\"50\" valign=\"top\" align=\"center\" class=\"sunday\"><A class=\"sunday\" href=\"javascript:void(0);\" Onclick=\"document.getElementById('datenew').value='".sprintf("%02d",$iday)." ".$thmonthname[$month - 1]." ".($year+543)."';\">$iday</A>";
		 if(!empty($list_app["A".sprintf("%02d",$iday)]["sum"]))
			 echo "<BR>(<A HREF=\"javascript:void(0);\" OnmouseOver = \"show_tooltip('ผู้ป่วยนัด','".$list_app["A".sprintf("%02d",$iday)]["detail"]."','left',-250,-210);\" OnmouseOut = \"hid_tooltip();\" class=\"total_appointsunday\">".$list_app["A".sprintf("%02d",$iday)]["sum"]."</A>)";
		 else
			 echo "<BR>&nbsp;";
		 echo "</td>\n";
      }else  if ($i == 6 ) {
      //กรณีที่เป็นวันอาทิตย์ และไม่ใช่วันปัจจุบัน
         echo "<td width=\"50\" align=\"center\" class=\"saturday\"><A class=\"saturday\" href=\"javascript:void(0);\" Onclick=\"document.getElementById('datenew').value='".sprintf("%02d",$iday)." ".$thmonthname[$month - 1]." ".($year+543)."';\">$iday</A>";
		  if(!empty($list_app["A".sprintf("%02d",$iday)]["sum"]))
			 echo "<BR>(<A HREF=\"javascript:void(0);\" OnmouseOver = \"show_tooltip('ผู้ป่วยนัด','".$list_app["A".sprintf("%02d",$iday)]["detail"]."','left',-250,-210);\" OnmouseOut = \"hid_tooltip();\" class=\"total_appointsaturday\">".$list_app["A".sprintf("%02d",$iday)]["sum"]."</A>)";
		  else
			 echo "<BR>&nbsp;";
		 echo "</td>\n";
      }
      else {

		  if($holiday["A".sprintf("%02d",$iday)]["date"]){
			$class = "sunday";
			$holiday_detail = " OnmouseOver = \"show_tooltip('วันหยุด','".$holiday["A".sprintf("%02d",$iday)]["detail"]."','left',-200,-210);\" OnmouseOut = \"hid_tooltip();\" ";
		  }else{
			$class = "norm";
		  }



         echo "<td width=\"50\" align=\"center\" class=\"".$class."\"><A class=\"".$class."\" href=\"javascript:void(0);\" Onclick=\"document.getElementById('datenew').value='".sprintf("%02d",$iday)." ".$thmonthname[$month - 1]." ".($year+543)."';\"  ".$holiday_detail.">$iday</A>";
		  if(!empty($list_app["A".sprintf("%02d",$iday)]["sum"]))
			 echo "<BR>(<A HREF=\"javascript:void(0);\" OnmouseOver = \"show_tooltip('ผู้ป่วยนัด','".$list_app["A".sprintf("%02d",$iday)]["detail"]."','left',-250,-210);\" OnmouseOut = \"hid_tooltip();\" class=\"total_appoint".$class."\">".$list_app["A".sprintf("%02d",$iday)]["sum"]."</A>)";
		  else
			 echo "<BR>&nbsp;";
		 echo "</td>\n";

      }

      $iday++;

   }
}

//แสดงแถวที่เหลือของปฏิทิน (หลังจากแสดงแถวแรกไปแล้ว จะเหลืออย่างมาก 5 แถว)
for ($j=0; $j<=4; $j++) {
   if ($iday <= $Lday) {
      echo "<tr  height=\"60\" valign=\"top\">\n";
		for ($i=0; $i<=6; $i++) {
			$holiday_detail = "";
			if ($iday <= $Lday) {
			if ($i == 0 ) {
				if($holiday["A".sprintf("%02d",$iday)]["date"]){
					$class = "sunday";
					$holiday_detail = " OnmouseOver = \"show_tooltip('วันหยุด','".$holiday["A".sprintf("%02d",$iday)]["detail"]."','left',-200,-210);\" OnmouseOut = \"hid_tooltip();\" ";
				  }else{
					$class = "norm";
				  }
				echo "<td width=\"50\" align=\"center\" class=\"sunday\"><A class=\"sunday\" href=\"javascript:void(0);\" Onclick=\"document.getElementById('datenew').value='".sprintf("%02d",$iday)." ".$thmonthname[$month - 1]." ".($year+543)."';\" ".$holiday_detail.">$iday</A>";
					if(!empty($list_app["A".sprintf("%02d",$iday)]["sum"]))
						echo "<BR>(<A HREF=\"javascript:void(0);\" OnmouseOver = \"show_tooltip('ผู้ป่วยนัด','".$list_app["A".sprintf("%02d",$iday)]["detail"]."','left',-250,-210);\" OnmouseOut = \"hid_tooltip();\" class=\"total_appointsunday\">".$list_app["A".sprintf("%02d",$iday)]["sum"]."</A>)";
						echo "</td>\n";
			}else  if ($i == 6 ) {
				if($holiday["A".sprintf("%02d",$iday)]["date"]){
					$class = "sunday";
					$holiday_detail = " OnmouseOver = \"show_tooltip('วันหยุด','".$holiday["A".sprintf("%02d",$iday)]["detail"]."','left',-200,-210);\" OnmouseOut = \"hid_tooltip();\" ";
				  }else{
					$class = "norm";
				  }
				echo "<td width=\"50\" align=\"center\" class=\"saturday\"><A class=\"saturday\" href=\"javascript:void(0);\" Onclick=\"document.getElementById('datenew').value='".sprintf("%02d",$iday)." ".$thmonthname[$month - 1]." ".($year+543)."';\" ".$holiday_detail." >$iday</A>";
					if(!empty($list_app["A".sprintf("%02d",$iday)]["sum"]))
						echo "<BR>(<A HREF=\"javascript:void(0);\" OnmouseOver = \"show_tooltip('ผู้ป่วยนัด','".$list_app["A".sprintf("%02d",$iday)]["detail"]."','left',-250,-210);\" OnmouseOut = \"hid_tooltip();\" class=\"total_appointsaturday\">".$list_app["A".sprintf("%02d",$iday)]["sum"]."</A>)";
				echo "</td>\n";
			}else {
				if($holiday["A".sprintf("%02d",$iday)]["date"]){
					$class = "sunday";
					$holiday_detail = " OnmouseOver = \"show_tooltip('วันหยุด','".$holiday["A".sprintf("%02d",$iday)]["detail"]."','left',-200,-210);\" OnmouseOut = \"hid_tooltip();\" ";
				  }else{
					$class = "norm";
				  }
				echo "<td width=\"50\" align=\"center\" class=\"".$class."\"><A class=\"".$class."\" href=\"javascript:void(0);\" Onclick=\"document.getElementById('datenew').value='".sprintf("%02d",$iday)." ".$thmonthname[$month - 1]." ".($year+543)."';\" ".$holiday_detail." >$iday</A>";
					if(!empty($list_app["A".sprintf("%02d",$iday)]["sum"]))
						echo "<BR>(<A HREF=\"javascript:void(0);\" OnmouseOver = \"show_tooltip('ผู้ป่วยนัด','".$list_app["A".sprintf("%02d",$iday)]["detail"]."','left',-250,-210);\" OnmouseOut = \"hid_tooltip();\" class=\"total_appoint".$class."\">".$list_app["A".sprintf("%02d",$iday)]["sum"]."</A>)";
				echo "</td>\n";
			}
		$iday++;
		}
		else {
		echo "<td width=\"50\" align=\"center\" class=\"norm\">&nbsp;</td>\n";
		}
      }
      echo "</tr>\n";
   }
   else {
      break;
   }
}

echo "</table></TD>
</TR>
</TABLE>";
exit();

}
?>
<script>
<!-- 
function newXmlHttp(){
	var xmlhttp = false;

		try{
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		}catch(e){
		try{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}catch(e){
				xmlhttp = false;
			}
		}

		if(!xmlhttp && document.createElement){
			xmlhttp = new XMLHttpRequest();
		}
	return xmlhttp;
}

function show_carlendar(xxx){

	xmlhttp = newXmlHttp();
	
	url = 'ap_putoff.php?action=carlendar' + xxx;
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	document.getElementById("div_right_list").innerHTML = xmlhttp.responseText;

}

//-->
</script>
<body onLoad="show_carlendar('');">
<div id="no_print" >
<center><span class="font3"><strong>โปรแกรมเลื่อนนัด</strong></span></center>
<a target=_top  href="../nindex.htm"><< ไปเมนู </a><br />
<form action="ap_putoff.php" method="post" class="font1" name="form11">
<table width="38%" border="1" cellpadding="0" cellspacing="0">
<tr>
  <td>
	<table width="100%">
  <tr>
    <td>วันที่
      <select name="d">
        <option value="0">-</option>
        <?
		for($a=1;$a<=31;$a++){
		if($a<10) $ss = "0";
		else $ss='';
	?>
        <option value="<?=$ss?><?=$a?>">
          <?=$a?>
          </option>
        <?
	}
	?>
        </select>
      เดือน
      <select name="m">
        <?
	$month = array('0','มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');
	for($a=1;$a<13;$a++){
	?>
        <option value="<?=$month[$a]?>">
          <?=$month[$a]?>
          </option>
        <?
	}
	?>
        </select>
      พ.ศ.
      <select name="yr">
        <?
	$year = date("Y")+543;
	for($a=($year-5);$a<($year+5);$a++){
	?>
        <option value="<?=$ss?><?=$a?>" <? if($year==$a) echo "selected='selected'";?>>
          <?=$a?>
          </option>
        <?
	}
	?>
      </select></td>
    </tr>
  <tr>
    <td>แพทย์
      <select name="dr">
        <?
	$strSQL = "SELECT name FROM doctor where status='y'  order by name"; 
	$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
	while($objResult = mysql_fetch_array($objQuery)){
	?>
        <option value="<?=$objResult["name"];?>">
          <?=$objResult["name"];?>
          </option>
        <?
	}
	?>
      </select></td>
    </tr>
    <tr>
    <td>นัดมาเพื่อ 
      <select name="detail">
      <option value="">--เลือกทั้งหมด--</option>
        <?
	$strSQL ="select * from applist where status='Y' ";
	$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
	while($objResult = mysql_fetch_array($objQuery)){
	?>
        <option value="<?=$objResult["appvalue"];?>"><?=$objResult["applist"];?></option>
        <?
	}
	?>
      </select></td>
  </tr>
  <tr>
    <td align="center"><input name="okbtn" type="submit" value="  ตกลง  " class="font1"/></td>
    </tr></table></td></tr>
</table>
</form><br />
</a>
</div>
<?
if(isset($_POST['okbtn'])){
		$_SESSION["dt_doctor"]=$_POST['dr'];
		if($_POST['detail']!=""){
			$where = "and detail = '".$_POST['detail']."' ";
		}else{
			$where = "";
		}
		$sql = "select * from appoint where appdate LIKE '".$_POST['d']." ".$_POST['m']." ".$_POST['yr']."%' and doctor ='".$_POST['dr']."' and apptime !='ยกเลิกการนัด' $where";
		//echo $sql;
		$row = mysql_query($sql);
		$num1 = mysql_num_rows($row);
		if($num1>0){
			echo "<form action='ap_putoff.php' method='post' class='font1' name='form12'>";
			echo "<strong>วันที่ ".$_POST['d']." ".$_POST['m']." ".$_POST['yr']."</strong>";
			echo "<table border='1' class='font1' style='border-collapse:collapse' width='100%'><tr><strong><td align='center'>เลือก </td><td align='center'>HN</td><td align='center'>ชื่อ-สกุล</td><td align='center'>ที่อยู่</td><td align='center'>เบอร์โทร.</td><td align='center'>อายุ</td><td align='center'>นัดมาเพื่อ</td><td align='center'>วันที่</td><td align='center'>เวลา</td></strong>";
			//<input name='chch' type='checkbox' onclick=CheckAll();>
			$i=0;
			while($result = mysql_fetch_array($row)){
				$sql3 = "select concat(address,' ',tambol,' ',ampur,' ',changwat) as address,phone from opcard where hn='".$result['hn']."'";
				$row3 = mysql_query($sql3);
				$num3 = mysql_fetch_array($row3);
				$doctor= $result['doctor'];
				$i++;
				echo "<tr><td align='center'><input name='ch".$i."' id='ch".$i."' type='checkbox' value='".$result['row_id']."' ></td>";
				echo "<td>".$result['hn']."</td>";
				echo "<td>".$result['ptname']."</td>";
				echo "<td>".$num3['address']."</td>";
				echo "<td>".$num3['phone']."</td>";
				echo "<td>".$result['age']."</td>";
				echo "<td>".$result['detail']."</td>";
				echo "<td>".$result['appdate']."</td>";
				echo "<td>".$result['apptime']."</td></tr>";
			}?>
			</table><br />
            <div id="div_right_list" ></div><br>
			เลื่อนนัดเป็นวันที่ <input name="datenew" type="text"  size="15" id="datenew"/>
            
เวลา
<?php if($_SESSION["sIdname"]== 'ฝังเข็ม' || $_COOKIE["until"] == "ฝังเข็ม"){
		   
		   if(empty($_COOKIE["until"])){
			 @setcookie("until", "ฝังเข็ม", time()+(3600*12));
		   }
	
		   ?>
<select size="1" name="capptime">
		<option value="07:30 น. - 08:00 น.">07:30 น. - 08:00 น.</option>
			<option value="08:30 น. - 09:00 น.">08:30 น. - 09:00 น.</option>
			<option value="09:30 น. - 10:00 น.">09:30 น. - 10:00 น.</option>
			<option value="10:30 น. - 11:00 น.">10:30 น. - 11:00 น.</option>
			<option value="11:30 น. - 12:00 น.">11:30 น. - 12:00 น.</option>
			<option value="12:30 น. - 13:00 น.">12:30 น. - 13:00 น.</option>
			<option value="15:30 น. - 16:00 น.">15:30 น. - 16:00 น.</option>
			<option value="16:30 น. - 17:00 น.">16:30 น. - 17:00 น.</option>
			<option value="17:30 น. - 18:00 น.">17:30 น. - 18:00 น.</option>
			<option value="18:30 น. - 19:00 น.">18:30 น. - 19:00 น.</option>
	
	</select>
	
	   <?php }else{ ?>
		<select size="1" name="capptime">
		<option selected>&lt;&#3648;&#3621;&#3639;&#3629;&#3585;&#3648;&#3623;&#3621;&#3634;&#3609;&#3633;&#3604;&gt;</option>
		<option selected>08:00 &#3609;. - 10.30 &#3609;.</option>
		<option>07:00 &#3609;.</option>
		<option>07:30 &#3609;.</option>
		<option>08:00 &#3609;.</option>
		<option>08:30 &#3609;.</option>
		<option>09:00 &#3609;.</option>
		<option>09:30 &#3609;.</option>
		<option>10:00 &#3609;.</option>
		<option>10:30 &#3609;.</option>
		<option>11:00 &#3609;.</option>
		<option>11:30 &#3609;.</option>
		<option>13:00 &#3609;.</option>
		<option>13:30 &#3609;.</option>
		<option>14:00 &#3609;.</option>
		<option>14:30 &#3609;.</option>
		<option>15:00 &#3609;.</option>
		<option>15:30 &#3609;.</option>
		<option>16:00 &#3609;.</option>
		<option>16:30 &#3609;.</option>
		<option>17:00 &#3609;.</option>
		<option>17:30 &#3609;.</option>
		<option>18:00 &#3609;.</option>
		<option>18:30 &#3609;.</option>
		<option>19:00 &#3609;.</option>
		<option>19:30 &#3609;.</option>
		<option>20:00 &#3609;.</option>
		<option>21:00 &#3609;.</option>
		</select>
		<?php 
		} 
		?><br><br>
      <input name="chdr" type="checkbox" value="1" onClick="if(document.getElementById('dr2').style.display=='none'){document.getElementById('dr2').style.display='';}else{document.getElementById('dr2').style.display='none'}"/>ต้องการเปลี่ยนแพทย์ 
        <select name="dr2" id="dr2" style="display:none">
          <?
            $strSQL = "SELECT name FROM doctor where status='y'  order by name"; 
            $objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
            while($objResult = mysql_fetch_array($objQuery)){
            ?>
          <option value="<?=$objResult["name"];?>" <? if($doctor==$objResult["name"]) echo "selected";?>><?=$objResult["name"];?>
          </option>
          <?
            }
            ?>
        </select><br><br>
		<input name="count" type="hidden" value="<?=$i?>" />
		<input type="submit" name="ok2" value="ตกลงเลื่อนนัด"  />
		<?
        echo "</form>";		
		}else{
		echo "ไม่มีข้อมูลการนัด";
	}
}
	
if(isset($_POST['ok2'])){
	$dateadd = (date("Y")+543).date("-m-d H:i:s");
	//$_POST['datenew']=($_POST['datenew']+0);
	//if($_POST['datenew']<10) $_POST['datenew']= "0".$_POST['datenew'];
	//echo $_POST['datenew'];
	//$newdate = $_POST['datenew']." ".$_POST['monnew']." ".$_POST['yrnew'];
	$newdate = $_POST['datenew'];
	for($a=0;$a<=$count;$a++){
		 if(isset($_POST['ch'.$a])){
			 $sql1 = "select * from appoint where row_id ='".$_POST['ch'.$a]."' ";
			 $row1 = mysql_query($sql1);
			 $result1 = mysql_fetch_array($row1);
			  if($_POST['chdr']=="1"){
			 	$result1['doctor']=$_POST['dr2'];
			 }
			 $insert1 = "insert into appoint(row_id,date,officer,hn,ptname,age,doctor,appdate,apptime,room,detail,detail2,advice	,patho,xray,other,depcode,came,diag,remark) values('','".$dateadd."','".$sOfficer."','".$result1['hn']."','".$result1['ptname']."','".$result1['age']."','".$result1['doctor']."','".$newdate."','".$_POST['capptime']."','".$result1['room']."','".$result1['detail']."','".$result1['detail2']."','".$result1['advice']."','".$result1['patho']."','".$result1['xray']."','".$result1['other']."','".$result1['depcode']."','".$result1['came']."','".$result1['diag']."','".$result1['remark']."')";

			if(mysql_query($insert1)){
				$idno=mysql_insert_id();
				$cHn = $result1['hn'];
				
				$sql2 = "select * from appoint_lab where id ='".$_POST['ch'.$a]."' ";
				$row2 = mysql_query($sql2);
				while($result2 = mysql_fetch_array($row2)){
					$sql = "INSERT INTO `appoint_lab` ( `id` , `code` )  VALUES ('".$idno."','".$result2['code']."')  ";
					$result = Mysql_Query($sql) or die("Error appoint_lab ".Mysql_Error());
				}
				$update1 = "update appoint SET apptime='ยกเลิกการนัด' where row_id='".$_POST['ch'.$a]."'";

			  	$re = mysql_query($update1);
				include("ap_putoffprint.php");
				?>
                <div style="page-break-after:always;"></div>
                <?
			 }
		 }
	}
	if($re){
		?>
			<script>
                  alert("บันทึกข้อมูลเรียบร้อยแล้ว");
            </script>
            <!--<a href="ap_putoffprint.php" target="_blank" style="font-family:AngsanaUPC; font-size:24px;">พิมพ์ใบนัด</a><br /><br />

			<a href="ap_putoffprint2.php" target="_blank" style="font-family:AngsanaUPC; font-size:24px;">พิมพ์ไปรษณียบัตร</a>-->
		<?
	}
}
?>
<div id = "tooltip" style="position:absolute;display:none;background-color:#FFFFFF;" >
</div>
</body>
</html>