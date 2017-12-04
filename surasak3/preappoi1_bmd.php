<?php
session_start();
if(isset($_GET["action"])){
	header("content-type: application/x-javascript; charset=TIS-620");
}
	session_register("cAge");
    session_register("cHn");  
    session_register("cPtname");
 	session_register("cptright");
 	session_register("cnote");
	session_register("cidguard");

//    $cHn="";

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
             }
      else{
            $pAge="$ageY ปี $ageM เดือน";
                        }
      return $pAge;
          }

//$dbirth="$y-$m-$d"; เก็บวันเกิดใน opcard= "$y-$m-$d" ซึ่ง=$birth in function

// print "<p><b><font face='Angsana New'>โรงพยาบาลค่ายสุรศักดิ์มนตรี</font></b></p>";
if(isset($idguard)){
	$cPtname=$cYot.' '.$cName.' '.$cSurname;
    $cAge=$Age;
   	$cptright=$ptright;
 	$cnote=$note;
	$cidguard=$idguard;
	$cAge=calcage($cAge);
print "<p><font face='Angsana New' size = '5'>ชื่อ $cPtname  HN: $cHn อายุ $cAge &nbsp;<B>สิทธิ:$cptright:$idguard</font></B></p>";
	$query5 = "select * from orderbmd where hn='$cHn' and date like '".(date("Y")+543)."-".date("m-d")."%' order by row_id desc";
	$rows5 = mysql_query($query5);
	$rep= mysql_fetch_array($rows5);
	$dt_doctor=$rep['doctor'];
	print "<font face='Angsana New' size = '5'>แพทย์ : $dt_doctor</font>";
	if($dt_doctor==""){
		print "<p><font face='Angsana New' size='6' color='#FF0000' >ไม่พบข้อมูลการสั่งตรวจ BMD วันนี้ กรุณาให้แพทย์สั่งใหม่อีกครั้ง</font></B></p>";
	}
	print "<br><font face='Angsana New' size = '4'><strong>เหตุผลการสั่งตรวจ :</strong><br>";
	for($i=1;$i<=8;$i++){
		if($rep['sub'.$i]!=""){
			$s=0;
			$l=50;
			echo "-".$rep['sub'.$i]."<br>";
			if($rep['detail_sub'.$i]!=""){
				echo "&nbsp;๐".$rep['detail_sub'.$i];
				if($rep['detail_sub'.$i.'1']!=""){
					echo "&nbsp;<u>".$rep['detail_sub'.$i.'1']."<u>";
				}
				echo "<br>";
			}
		}	
	}
	print "</font>";
}

function LastDay($m, $y) {
   for ($i=29; $i<=32; $i++) {
      if (checkdate($m, $i, $y) == 0) {
         return $i - 1;
      }
   }
}

if($_GET["action"] == "carlendar"){
/*	if($_GET['id']==""){
	}
	else{
	//$dt_doctor = $_GET['id'];
	//echo $dt_doctor ;
	}*/
	
	
//$sql = "Select mdcode From inputm where name = '".$_GET['id']."' limit 1";
//list($mdcode) = Mysql_fetch_row(Mysql_Query($sql));

/*$sql = "Select name From doctor where name like '".$dt_doctor."%' limit 1 ";
list($appoint_doctor) = Mysql_fetch_row(Mysql_Query($sql));*/


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

$sql = "Select appdate, apptime, count(distinct hn) as total_app From appoint  where appdate like '%".$thmonthname[$month - 1]." ".($year+543)."' AND detail = 'FU32 นัดตรวจBMD' AND apptime <> 'ยกเลิกการนัด' GROUP BY appdate, apptime  ";

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
         echo "<td width=\"50\" valign=\"top\" align=\"center\" class=\"sunday\"><A class=\"sunday\" href=\"javascript:void(0);\" Onclick=\"document.getElementById('date_appoint').value='".sprintf("%02d",$iday)." ".$thmonthname[$month - 1]." ".($year+543)."';\">$iday</A>";
		 if(!empty($list_app["A".sprintf("%02d",$iday)]["sum"]))
			 echo "<BR>(<A HREF=\"javascript:void(0);\" OnmouseOver = \"show_tooltip('ผู้ป่วยนัด','".$list_app["A".sprintf("%02d",$iday)]["detail"]."','left',-250,-210);\" OnmouseOut = \"hid_tooltip();\" class=\"total_appointsunday\">".$list_app["A".sprintf("%02d",$iday)]["sum"]."</A>)";
		 else
			 echo "<BR>&nbsp;";
		 echo "</td>\n";
      }else  if ($i == 6 ) {
      //กรณีที่เป็นวันอาทิตย์ และไม่ใช่วันปัจจุบัน
         echo "<td width=\"50\" align=\"center\" class=\"saturday\"><A class=\"saturday\" href=\"javascript:void(0);\" Onclick=\"document.getElementById('date_appoint').value='".sprintf("%02d",$iday)." ".$thmonthname[$month - 1]." ".($year+543)."';\">$iday</A>";
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



         echo "<td width=\"50\" align=\"center\" class=\"".$class."\"><A class=\"".$class."\" href=\"javascript:void(0);\" Onclick=\"document.getElementById('date_appoint').value='".sprintf("%02d",$iday)." ".$thmonthname[$month - 1]." ".($year+543)."';\"  ".$holiday_detail.">$iday</A>";
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
				echo "<td width=\"50\" align=\"center\" class=\"sunday\"><A class=\"sunday\" href=\"javascript:void(0);\" Onclick=\"document.getElementById('date_appoint').value='".sprintf("%02d",$iday)." ".$thmonthname[$month - 1]." ".($year+543)."';\" ".$holiday_detail.">$iday</A>";
					if(!empty($list_app["A".sprintf("%02d",$iday)]["sum"]))
						echo "<BR>(<A HREF=\"javascript:void(0);\" OnmouseOver = \"show_tooltip('ผู้ป่วยนัด','".$list_app["A".sprintf("%02d",$iday)]["detail"]."','left',-80,-150);\" OnmouseOut = \"hid_tooltip();\" class=\"total_appointsunday\">".$list_app["A".sprintf("%02d",$iday)]["sum"]."</A>)";
						echo "</td>\n";
			}else  if ($i == 6 ) {
				if($holiday["A".sprintf("%02d",$iday)]["date"]){
					$class = "sunday";
					$holiday_detail = " OnmouseOver = \"show_tooltip('วันหยุด','".$holiday["A".sprintf("%02d",$iday)]["detail"]."','left',-200,-210);\" OnmouseOut = \"hid_tooltip();\" ";
				  }else{
					$class = "norm";
				  }
				echo "<td width=\"50\" align=\"center\" class=\"saturday\"><A class=\"saturday\" href=\"javascript:void(0);\" Onclick=\"document.getElementById('date_appoint').value='".sprintf("%02d",$iday)." ".$thmonthname[$month - 1]." ".($year+543)."';\" ".$holiday_detail." >$iday</A>";
					if(!empty($list_app["A".sprintf("%02d",$iday)]["sum"]))
						echo "<BR>(<A HREF=\"javascript:void(0);\" OnmouseOver = \"show_tooltip('ผู้ป่วยนัด','".$list_app["A".sprintf("%02d",$iday)]["detail"]."','left',-80,-150);\" OnmouseOut = \"hid_tooltip();\" class=\"total_appointsaturday\">".$list_app["A".sprintf("%02d",$iday)]["sum"]."</A>)";
				echo "</td>\n";
			}else {
				if($holiday["A".sprintf("%02d",$iday)]["date"]){
					$class = "sunday";
					$holiday_detail = " OnmouseOver = \"show_tooltip('วันหยุด','".$holiday["A".sprintf("%02d",$iday)]["detail"]."','left',-200,-210);\" OnmouseOut = \"hid_tooltip();\" ";
				  }else{
					$class = "norm";
				  }
				echo "<td width=\"50\" align=\"center\" class=\"".$class."\"><A class=\"".$class."\" href=\"javascript:void(0);\" Onclick=\"document.getElementById('date_appoint').value='".sprintf("%02d",$iday)." ".$thmonthname[$month - 1]." ".($year+543)."';\" ".$holiday_detail." >$iday</A>";
					if(!empty($list_app["A".sprintf("%02d",$iday)]["sum"]))
						echo "<BR>(<A HREF=\"javascript:void(0);\" OnmouseOver = \"show_tooltip('ผู้ป่วยนัด','".$list_app["A".sprintf("%02d",$iday)]["detail"]."','left',-80,-150);\" OnmouseOut = \"hid_tooltip();\" class=\"total_appoint".$class."\">".$list_app["A".sprintf("%02d",$iday)]["sum"]."</A>)";
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
</TR>";
echo "<tr><td colspan=\"2\"><br><font face=\"Angsana New\">นัดมาวันที่ : </font><INPUT TYPE=\"text\" ID=\"date_appoint\" NAME=\"date_appoint\" size=\"15\" readonly>";
echo "</td></tr></TABLE>";

exit();

}

?>

<SCRIPT LANGUAGE="JavaScript">
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
	//alert(xxx);
	xmlhttp = newXmlHttp();
	
	url = 'preappoi1.php?action=carlendar&id=' + xxx;
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	document.getElementById("div_right_list").innerHTML = xmlhttp.responseText;

}
function checkForm(){
	
	if(document.f1.doctor.value == ""){
		alert("กรุณาเลือกเพทย์ครับ\n*หากไม่มีในรายชื่อให้เลือกรายการ 'MD022 (ไม่ทราบแพทย์)' ");
		return false;
	}else{
		return true;
	}

}
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
</SCRIPT>
<style type="text/css">
<!--
.t {
	color: #C69;
}
-->
</style>
  <style type="text/css">
<!--
body,td,th {
	font-family: Angsana New;
	font-size: 24px;
}

.tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_detail {background-color: #FFFFC1;  }
.tb_menu {background-color: #FFFFC1;  }

#slidemenubar, #slidemenubar2{
	position:absolute;
	left:-155px;
	width:300px;
	top:260px;

	

	layer-background-color:#000000;
	font:bold 16px ms sans serif;
	line-height:20px;

}

-->

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
</style>

<form name="f1" method="POST" action="preappoi2_bmd.php" onsubmit="return checkForm();">
  <!--<p><font face="Angsana New">แพทย์ผู้นัด&nbsp;&nbsp;&nbsp;&nbsp;-->
   <?php
   include("connect.inc");
/*  $sql = "Select menucode From inputm where idname = '".$_SESSION["sIdname"]."' ";
list($menucode) = Mysql_fetch_row(Mysql_Query($sql));

  if($menucode == "ADMMAINOPD"){
  ?>
  
  <? 

$strSQL = "SELECT name FROM doctor  where status='y'  and menucode !='ADMPT'  order by name "; 
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
?>
<select name="doctor"  onChange="show_carlendar(this.value)"> 
<? 
while($objResult = mysql_fetch_array($objQuery)) 
{ 
?> 
<option value="<?=$objResult["name"];?>"><?=$objResult["name"];?></option> 
<? 
} 
?> 
</select>


  <?php }else  if($menucode == "ADMDEN"){

$strSQL = "SELECT name FROM doctor  where status='y'  and menucode ='ADMDEN'  order by name "; 
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
?>
<select name="doctor"  onChange="show_carlendar(this.value)">
<option value="0">กรุณาเลือกแพทย์</option>  
<? 
while($objResult = mysql_fetch_array($objQuery)) 
{ 
?> 
<option value="<?=$objResult["name"];?>"><?=$objResult["name"];?></option> 
<? 
} 
?> 
</select>


  <?php }else  if($menucode == "ADMNID"){

$strSQL = "SELECT name FROM doctor  where status='y'  and menucode ='ADMNID'  order by name "; 
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
?>
  <select name="doctor2"  onChange="show_carlendar(this.value)">
  <option value="0">กรุณาเลือกแพทย์</option> 
    <? 
while($objResult = mysql_fetch_array($objQuery)) 
{ 
?>
    <option value="<?=$objResult["name"];?>"><?=$objResult["name"];?></option>
    <? 
} 
?>
<option value="MD072 บุริน เลาหะวัฒนะ">MD072 บุริน เลาหะวัฒนะ</option> 
  </select>
  <?php }else{?>
	  <? 
	 $strSQL = "SELECT name FROM doctor where status='y'  order by name"; 
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
?>
<select name="doctor" onChange="show_carlendar(this.value)"> 
<? 
while($objResult = mysql_fetch_array($objQuery)) 
{ 
?> 
<option value="<?=$objResult["name"];?>"><?=$objResult["name"];?></option> 
<? 
} 
?> 
</select>
  </font> </p>
	  <?php }*/
	  ?>
  <div id="div_right_list" ></div>
  <input type="hidden" name="dr" value="<?=$dt_doctor?>" />

  &nbsp;&nbsp;<input type="submit" value="    ต่อไป     " name="B1">
  &nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm"><< &#3648;&#3617;&#3609;<span class="t">&#3641;</span></a>&nbsp&nbsp;<<&nbsp<a target=_self  href='hnappoi1.php'>ออกใบนัดใหม่</a></p>
</form>
<?php include("unconnect.inc");?>
<script>
	window.onload=show_carlendar();
</script>
<div id = "tooltip" style="position:absolute;display:none;background-color:#FFFFFF;" >
</div>