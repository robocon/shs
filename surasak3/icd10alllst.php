<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 18px;
}
@media print{
#no_print{
	display:none;
	}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 
-->
</style>
<body onload="window.print();">
<?php
    
set_time_limit(30);
$yrmonth="$thiyr-$rptmo";

   function goup($xx){
		switch($xx){
			case "G1": $yy = "ก"; break;
			case "G2": $yy = "ข"; break;
			case "G3": $yy = "ค"; break;
			case "G4": $yy = "ง"; break;

case "G11": $yy = "ก.1 นายทหารประจำการ"; break;
case "G12": $yy = "ก.2 นายสิบ  พลทหารประจำการ"; break;
case "G13": $yy = "ก.3 ข้าราชการกลาโหมพลเรือน"; break;
case "G14": $yy = "ก.4 ลูกจ้างประจำ"; break;
case "G15 ": $yy = "ก.5 ลูกจ้างชั่วคราว"; break;
case "G21": $yy = "ข.1 สิบตรี พลทหารกองประจำการ"; break;
case "G22": $yy = "ข.2 นักเรียนทหาร"; break;
case "G23 ": $yy = "ข.3 อาสาสมัครทหารพราน"; break;
case "G24 ": $yy = "ข.4 นักโทษทหาร"; break;
case "G31": $yy = "ค.1 ครอบครัวทหาร"; break;
case "G32": $yy = "ค.2 ทหารนอกประจำการ"; break;
case "G33": $yy = "ค.3 นักศึกษาวิชาทหาร(รด)"; break;
case "G34": $yy = "ค.4 วิวัฒน์พลเมือง"; break;
case "G35": $yy = "ค.5 บัตรประกันสังคม"; break;
case "G36": $yy = "ค.6 บัตรทอง30บาท"; break;
case "G37": $yy = "ค.7 ข้าราชการพลเรือน(เบิกต้นสังกัด)"; break;
case "G38": $yy = "ค.8 พลเรือน(ไม่เบิกต้นสังกัด)"; break;
case "G39": $yy = "ค.9 อื่นๆไม่ระบุ"; break;

		}
		return $yy;
   }

print "<font face='TH SarabunPSK'><b>รายชื่อผู้ป่วยตาม ICD10 </b>";
  
print "<b>ประจำเดือน</b> $yrmonth <BR>";
 echo "<div id='no_print'>";  
 print "<br>.........<input type=button onclick='history.back()' value=' << กลับไป '>";
  print "จำนวนผู้ป่วยแต่ละ ICD 10  <a target=_self  href='../nindex.htm'><<ไปเมนู</a><br> ";
 echo "</div>";
?>
<?php
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE opday_2 SELECT *, left(goup,3) as goup_2 FROM opday  WHERE thidate LIKE '$yrmonth%' ";
    $result = mysql_query($query) or die(mysql_error());

	$query="CREATE TEMPORARY TABLE opday_3 SELECT icd10, goup_2, count(icd10) as c_icd10 FROM opday_2  group by icd10, goup_2 HAVING count(icd10) > 0";
    $result = mysql_query($query) or die(mysql_error());


 
   $query="SELECT  icd10,COUNT(*) AS duplicate FROM opday_2 GROUP BY icd10 HAVING duplicate > 0 ORDER BY duplicate DESC limit 30 ";
   $result = mysql_query($query);
     $n=0;
 while (list ($icd10,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
$num= $duplicate+$num;
            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='TH SarabunPSK'>$n .&nbsp;&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA><font face='TH SarabunPSK'>$icd10&nbsp;&nbsp;</a></td>\n".
 
//    "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"checkidchk.php? idcard=$idcard\">$idcard&nbsp;&nbsp;</a></td>\n".
             //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail&nbsp;&nbsp;</td>\n".
        "  <td BGCOLOR=66CDAA><font face='TH SarabunPSK'>จำนวน&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;คน</td>\n".
               " </tr>\n<BR>");
				$sql2 = "Select goup_2, c_icd10 From opday_3 where icd10 = '".$icd10."' ";
				$result2 = mysql_query($sql2);
				print "<TR><TD colspan='3'>";
					while(list($goup_2, $c_icd10) = mysql_fetch_row($result2)){
						print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".goup($goup_2)." = ".$c_icd10." <BR>";
					}
				print "</TD></TR><HR>";
               }
echo "<div id='no_print'>";
print "จำนวนผู้ป่วยทั้งหมด.... $num..คน</a><br> ";

echo "</div>";
include("unconnect.inc");
?>