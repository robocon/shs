<?php
session_start();
include("connect.inc");
$_POST["start_year"]="$start_year";
$_POST["start_month"]="$start_month";
$_POST["start_day"]="$start_day";
$_POST["end_year"]="$end_year";
$_POST["end_month"]="$end_month";
$_POST["end_day"]="$end_day";
//  $yrmonth="$thiyr-$rptmo-$date";
//$date1 ="$thiyr-$rptmo-$date";
//$date2 ="$date-$rptmo-$thiyr";
$date1 ="$start_year-$start_month";
$date3 ="$start_month-$start_year";
$sql = "Select  a.depart, sum(a.paidcscd),sum(a.price) From opacc as a where a.date LIKE '$date1%'  AND a.credit ='30บาท' group by  a.depart   ORDER by a.date";

$result = mysql_Query($sql) or die(mysql_error());
 //$count =mysql_num_rows($result);
$list = array();
$list2 = array();


while(list( $depart, $paidcscd,$price) = Mysql_fetch_row($result)){
 

switch($depart){

	case "PHAR" : $list["PHAR"] = $list["PHAR"] + $price; break;
	case "PATHO" : $list["PATHO"] = $list["PATHO"] + $price; break;
	case "XRAY" : $list["XRAY"] = $list["XRAY"] + $price; break;
	case "DENTA" : $list["DENTA"] = $list["DENTA"] + $price; break;
	case "PHYSI" : $list["PHYSI"] = $list["PHYSI"] + $price; break;
	case "EMER" : $list["EMER"] = $list["EMER"] + $price; break;
	case "SURG" : $list["SURG"] = $list["SURG"] + $price; break;
	case "NID" : $list["NID"] = $list["NID"] + $paidcscd; break;
	case "HEMO" : $list["HEMO"] = $list["HEMO"] + $price; break;
		case "OTHER" : $list["OTHER"] = $list["OTHER"] + $price; break;
	default:  $list["OTHER2"] = $list["OTHER2"] + $price; break;

}

}
$num='0';
$i='0';
$p='1';


		$PHAR = $PHAR+$list["PHAR"];
		$PATHO = $PATHO+$list["PATHO"];
		$XRAY = $XRAY+$list["XRAY"];
		$DENTA = $DENTA+$list["DENTA"];
		$PHYSI = $PHYSI+$list["PHYSI"];
		$EMER = $EMER+$list["EMER"];
		$SURG = $SURG+$list["SURG"];
		$NID = $NID+$list["NID"];
		$HEMO = $HEMO+$list["HEMO"];
		$OTHER = $OTHER+$list["OTHER"];
		$OTHER1 = $OTHER1+$list["OTHER2"];

	$sum = $sum+($list["PHAR"]+$list["PATHO"]+$list["XRAY"]+$list["DENTA"]+$list["PHYSI"]+$list["EMER"]+$list["SURG"]+$list["NID"]+$list["HEMO"]+$list["OTHER"]+$list["OTHER2"]);



function baht($nArabic,$until){
    $cTarget = Ltrim($nArabic);
    $cLtnum="";
    $x=0;
    while (substr($cTarget,$x,1) <> "."){
            $cLtnum=$cLtnum.substr($cTarget,$x,1);
            $x++;
	}
   $cRtnum=substr($cTarget,$x+1,2);
   $nUnit=$x;
   $nNum=$nUnit;
   $cRead  = "";

include("connect.inc");
 
 IF ($cLtnum <> "0"){
  $count=0;
  For ($i = 0;$i<=$nNum;$i++){
    $cNo   = Substr($cLtnum,$count,1);
     $count++;
//อ่านหลัก
    IF ($cNo <>0 and $cNo != "-"){
      If ($nUnit <> 1){  

          $query = "SELECT * FROM thaibaht WHERE fld1 = '$nUnit' limit 1";
          $result = mysql_query($query) or die("Query 1 failed");

          for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
          if (!mysql_data_seek($result, $i)) {
              echo "Cannot seek to row $i\n";
              continue;
          }

           if(!($row = mysql_fetch_object($result)))
               continue;
         }

        $cVarU = $row->fld4;  //อ่านหลัก
                }
      Else {
        $cVarU = "";
              }

//อ่านเลข
          $query = "SELECT * FROM thaibaht WHERE fld1 = '$cNo' limit 1 ";
          $result = mysql_query($query) or die("Query 2 failed");

          for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
          if (!mysql_data_seek($result, $i)) {
              echo "Cannot seek to row $i\n";
              continue;
          }

           if(!($row = mysql_fetch_object($result)))
               continue;
         }

      $cVar1 = $row->fld2; //อ่านตัวเลข
///           
if ($nUnit =='2' && $cNo =='2'):
   $cVar1 = "ยี่";
elseif ($nUnit == '2' && $cNo=='1'):
    $cVar1 =  "";
elseif ($nUnit =='1' && $cNo =='1' && $nNum <> 1 ):
    $cVar1 = "เอ็ด";
else:
   echo "";
endif; 

      $cRead  = $cRead.$cVar1.$cVarU;
        }
      $nUnit--;
            }
if($until =="T")
	$cRead = $cRead."บาท";
	}
////Stang////  
  IF ($cRtnum <> "00"){
    $nUnit = 2;
    $count=0;
    For ($i = 0;$i<=2;$i++){  
      $cNo = Substr($cRtnum,$count,1);
      $count++;
      If ($cNo != "0"){

          $query = "SELECT * FROM thaibaht WHERE fld1 = '$cNo' limit 1 ";
          $result = mysql_query($query) or die("Query failed");

          for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
          if (!mysql_data_seek($result, $i)) {
              echo "Cannot seek to row $i\n";
              continue;
          }

           if(!($row = mysql_fetch_object($result)))
               continue;
         }

         $cVar1 = $row->fld2 ;
         /////
         If ($nUnit == '2' && $cNo == '2'){
            $cVar1 = "ยี่";
            }
         if ($nUnit == '2' && $cNo == '1'){
            $cVar1 = "" ;
             }   
         if ($nUnit == '1' && $cNo =='1'){
              $cVar1 = "เอ็ด";
            }            
         If (Substr($cRtnum,0,1) == '0' && $cNo == '1'){
            $cVar1 = "หนึ่ง";
            }
         ///////
         If ($nUnit != '1'){ 
           $cRead = $cRead.$cVar1."สิบ";
                 }
         Else{
           $cRead = $cRead.$cVar1;
                }
      }   
         $nUnit--;
             }
	if($until =="T")
    $cRead = $cRead."สตางค์**"  ;
	}    
    else{
		if($until =="T")
           $cRead = $cRead."ถ้วน**" ;
           }  
    include("connect.inc");

   return $cRead;
}
///end function baht

$PHAR=number_format( $PHAR,2);
$PATHO=number_format( $PATHO,2);
$XRAY=number_format($XRAY,2);
$DENTA=number_format( $DENTA,2);
$PHYSI=number_format( $PHYSI,2);
$EMER=number_format( $EMER,2);
$SURG=number_format( $SURG,2);
$NID=number_format($NID,2);
$HEMO=number_format($HEMO,2);
$OTHER=number_format($OTHER,2);
$OTHER2=number_format($OTHER2,2);
$sum=number_format($sum,2,".","");

if(strlen($sum) > 10){

	$cbaht="**สิบ".baht(substr($sum,-10),"T");
}else{
	$cbaht="**".baht($sum,"T");
}
$sum=number_format($sum,2);


//$cbaht=$sum;



/*
echo "<tr><b><td>&nbsp;</td><td>&nbsp;</td><td><b><font face='Angsana New' size ='2'><center>รวมทั้งหมด</td><td>&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$PHAR."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$PATHO."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$XRAY."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$DENTA."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$PHYSI."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$EMER."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$SURG."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>".$NID."</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$OTHER."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$OTHER2."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$sum."&nbsp;&nbsp;</td></b></tr></FONT>";

echo "</table>";


			print ("<tr><td><div style=\"page-break-before: always;\"></div></td></tr>");
			*/
echo "<font face='Angsana New' size ='5'><br><br><center> <b>สรุปลูกหนี้หลักประกันสุขภาพประจำเดือน &nbsp;$date3 <br></b> ";
echo "<font face='Angsana New' size ='5'> โรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง <br>";
$Thaidate=date("d-m-").(date("Y")+543)."  ".date("G:i:s");
echo "<font face='Angsana New' size ='4'> รายงานเมื่อวันที่  $Thaidate </center>";
//echo "<font face='Angsana New' size ='4'>จำนวน &nbsp;$count &nbsp;แถว </center>";

echo "<table  border ='1'  align='center' bordercolor='#000000' cellspacing='0' cellpadding='0' style='BORDER-COLLAPSE: collapse'>";
echo "<tr><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;เดือน&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;&nbsp;&nbsp;</td><td><center> <b>&nbsp;&nbsp;ยา&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;พยาธิ&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;เอกเรย์&nbsp;&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;ทันตกรรม&nbsp;&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;กายภาพ&nbsp;&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;บริการ&nbsp;&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;ผ่าตัด&nbsp;&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;ฝังเข็ม&nbsp;&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;ไตเทียม&nbsp;&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b><center> <b>&nbsp;&nbsp;ตรวจอื่นๆ&nbsp;&nbsp;</td><td>&nbsp;&nbsp;***&nbsp;&nbsp;</td><td><center> <b>&nbsp;&nbsp;รวม&nbsp;&nbsp;</td></tr>";

echo "<tr><td><b><font face='Angsana New' size ='3'>&nbsp;&nbsp;$date3&nbsp; </td><td><b><font face='Angsana New' size ='2'><center>รวมทั้งหมด</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$PHAR."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$PATHO."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$XRAY."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$DENTA."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$PHYSI."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$EMER."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$SURG."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$NID."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$HEMO."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$OTHER."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$OTHER2."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='3'><b>&nbsp;&nbsp;".$sum."&nbsp;&nbsp;</td></b></tr></FONT>";
echo "</table>";

print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='30%'> </td>";
print "      <td width='70%'><center><font face='Angsana New'>($cbaht)</font></td>";
print "    </tr>";
print "  </table>";
$sql = "Select yot,fullname,position,position2 From officers where mancode = 'headmonysub' limit 1";
$result2 = Mysql_Query($sql);
list($yot,$fullname,$position,$position2) = Mysql_fetch_row($result2);

print "<br>";
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='60%'></td>";
print "      <td width='40%'><font face='Angsana New'></font></td>";
print "    </tr>";
print "  </table>";
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='50%'></td>";
print "      <td width='50%'><center><font face='Angsana New'>(.........................................)</font></td>";
print "    </tr>";
print "  </table>";
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='50%'></td>";
print "      <td width='50%'><center><font face='Angsana New'>ผู้ตรวจสอบ</font></td>";
print "    </tr>";
print "  </table>";
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='50%'></td>";
print "      <td width='50%'><center><font face='Angsana New'>............./...................../................</font></td>";
print "    </tr>";
print "  </table>";
print "<br>";
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='50%'></td>";
print "      <td width='50%'><center><font face='Angsana New'>..............................................</font></td>";
print "    </tr>";
print "  </table>";
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='50%'></td>";
print "      <td width='50%'><center><font face='Angsana New'>(...........................................)</font></td>";
print "    </tr>";
print "  </table>";
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='50%'></td>";
print "      <td width='50%'><center><font face='Angsana New'>ผู้บันทึก</font></td>";
print "    </tr>";
print "  </table>";
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='50%'></td>";
print "      <td width='50%'><center><font face='Angsana New'>............./...................../................</font></td>";
print "    </tr>";
print "  </table> <div style=\"page-break-before: always;\"></div>";


$list = array();
$title_date = $start_day."-".$start_month."-".$start_year;
$date1 ="$start_year-$start_month";

$sql = "Select date_format( a.date, '%d-%m-%Y' ) AS date2, a.depart, sum(a.paidcscd), sum(a.price) From opacc as a where  a.date LIKE '$date1%'   AND a.credit ='30บาท' group by date2, a.depart   ORDER by date";
$result = Mysql_Query($sql) or die(Mysql_Error());

while(list($date, $depart, $paidcscd,$price) = Mysql_fetch_row($result)){
//echo $depart,"<BR>";
$row='0';
	switch($depart){
		case "PHAR" : $list[$date]['PHAR'] = $list[$date]['PHAR'] + $price; break;
		case "PATHO" : $list[$date]['PATHO'] = $list[$date]['PATHO'] + $price; break;
		case "XRAY" : $list[$date]['XRAY']  = $list[$date]['XRAY'] +$price; break;
		case "DENTA" : $list[$date]['DENTA'] = $list[$date]['DENTA'] + $price; break;
		case "PHYSI" : $list[$date]['PHYSI'] = $list[$date]['PHYSI'] + $price; break;
		case "EMER" : $list[$date]['EMER'] = $list[$date]['EMER'] + $price; break;
		case "SURG" : $list[$date]['SURG'] = $list[$date]['SURG'] + $price; break;
		case "NID" : $list[$date]['NID'] = $list[$date]['NID'] + $paidcscd; break;
		case "HEMO" : $list[$date]['HEMO'] = $list[$date]['HEMO'] + $price; break;
		case "OTHER" : $list[$date]['OTHER'] = $list[$date]['OTHER'] + $price; break;
		default:  $list[$date]['OTHER2'] = $list[$date]['OTHER2'] + $price; break;
	}
	
}

echo "<BR><CENTER>รายละเอียดลูกหนี้ประจำวัน<BR>";
$Thaidate=date("d-m-").(date("Y")+543)."  ".date("G:i:s");
echo "<font face='Angsana New' size ='2'> รายงานเมื่อวันที่  $Thaidate </center></font>";
echo "<table width='90%' align='center' border ='1' bordercolor='#000000' cellspacing='0' cellpadding='0' style='BORDER-COLLAPSE: collapse'>
				<tr align='center'>
				<td>วันที่</td>
				<td>&nbsp;</td>
				<td>ยา</td>
				<td>พยาธิ</td>
				<td>เอกเรย์</td>
				<td>ทันตกรรม</td>
				<td>กายภาพ</td>
				<td>บริการ</td>
				<td>ผ่าตัด</td>
				<td>ฝังเข็ม</td>
				<td>ไตเทียม</td>
				<td>ตรวจอื่นๆ</td>
				<td>***</td>
				<td>รวม</td>
				</tr>
					";
$sum = 0;

foreach($list as $key => $value){
$row++;
	echo "<tr align=\"right\">
					<td>".$key."</td>
					<td>รวมต่อวัน</td>
					<td>".number_format($list[$key]['PHAR'],2)."</td>
					<td>".number_format($list[$key]['PATHO'],2)."</td>
					<td>".number_format($list[$key]['XRAY'],2)."</td>
					<td>".number_format($list[$key]['DENTA'],2)."</td>
					<td>".number_format($list[$key]['PHYSI'],2)."</td>
					<td>".number_format($list[$key]['EMER'],2)."</td>
					<td>".number_format($list[$key]['SURG'],2)."</td>
					<td>".number_format($list[$key]['NID'],2)."</td>
					<td>".number_format($list[$key]['HEMO'],2)."</td>
					<td>".number_format($list[$key]['OTHER'],2)."</td>
					<td>".number_format($list[$key]['OTHER2'],2)."</td>
					<td><B>".(number_format($list[$key]['PHAR']+$list[$key]['PATHO']+$list[$key]['XRAY']+$list[$key]['DENTA']+$list[$key]['PHYSI']+$list[$key]['EMER']+$list[$key]['SURG']+$list[$key]['NID']+$list[$key]['HEMO']+$list[$key]['OTHER']+$list[$key]['OTHER2'],2))."</B></td>
				</tr>";


if($row == '15'){
		echo "</table>";
			print ("<tr><td><div style=\"page-break-before: always;\"></div></td></tr>");
echo "<BR><CENTER>รายละเอียดลูกหนี้ประจำวัน<BR></font>";
$Thaidate=date("d-m-").(date("Y")+543)."  ".date("G:i:s");
echo "<font face='Angsana New' size ='2'> รายงานเมื่อวันที่  $Thaidate </center>";
echo "<table width='90%' align='center' border ='1' bordercolor='#000000' cellspacing='0' cellpadding='0' style='BORDER-COLLAPSE: collapse'>
				<tr align='center'>
				<td>วันที่</td>
				<td>&nbsp;</td>
				<td>ยา</td>
				<td>พยาธิ</td>
				<td>เอกเรย์</td>
				<td>ทันตกรรม</td>
				<td>กายภาพ</td>
				<td>บริการ</td>
				<td>ผ่าตัด</td>
				<td>ฝังเข็ม</td>
				<td>ไตเทียม</td>
				<td>ตรวจอื่นๆ</td>
				<td>***</td>
				<td>รวม</td>
				</tr>
					";

			



}

$sum = $sum + ($list[$key]['PHAR']+$list[$key]['PATHO']+$list[$key]['XRAY']+$list[$key]['DENTA']+$list[$key]['PHYSI']+$list[$key]['EMER']+$list[$key]['SURG']+$list[$key]['NID']+$list[$key]['HEMO']+$list[$key]['OTHER']+$list[$key]['OTHER2']);
}

echo "<tr align=\"right\">
					<td colspan=\"13\" align='center'>รวม</td>
					<td><B>".(number_format($sum,2))."</B></td>
				</tr>";

echo "</table>";

