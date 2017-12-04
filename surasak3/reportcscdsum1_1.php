


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
$sql = "Select a.txdate, a.hn, CONCAT(b.yot,' ',b.name,' ',b.surname) as full_name, a.depart, sum(a.paidcscd) From opacc as a, opcard as b where a.hn=b.hn AND ( a.date between '".($start_year)."-".$start_month."-".$start_day." 00:00:00' AND '".($end_year)."-".$end_month."-".$end_day." 23:59:00' )  AND a.credit ='จ่ายตรง' group by a.hn, a.depart   ORDER by a.txdate";
$result = mysql_Query($sql) or die(mysql_error());
 $count =mysql_num_rows($result);
$list = array();
$list2 = array();


while(list($date, $hn, $full_name, $depart, $paidcscd) = Mysql_fetch_row($result)){
 
 $date=substr($date,0,10);
 $d=substr($date,8,2);
  $m=substr($date,4,4);
   $y=substr($date,0,4);

	$list2[$hn] = $d."".$m."".$y."/".$full_name;
switch($depart){

	case "PHAR" : $list[$hn]["PHAR"] = $list[$hn]["PHAR"] + $paidcscd; break;
	case "PATHO" : $list[$hn]["PATHO"] = $list[$hn]["PATHO"] + $paidcscd; break;
	case "XRAY" : $list[$hn]["XRAY"] = $list[$hn]["XRAY"] + $paidcscd; break;
	case "DENTA" : $list[$hn]["DENTA"] = $list[$hn]["DENTA"] + $paidcscd; break;
	case "PHYSI" : $list[$hn]["PHYSI"] = $list[$hn]["PHYSI"] + $paidcscd; break;
	case "EMER" : $list[$hn]["EMER"] = $list[$hn]["EMER"] + $paidcscd; break;
	case "SURG" : $list[$hn]["SURG"] = $list[$hn]["SURG"] + $paidcscd; break;
	case "NID" : $list[$hn]["NID"] = $list[$hn]["NID"] + $paidcscd; break;
	case "HEMO" : $list[$hn]["HEMO"] = $list[$hn]["HEMO"] + $paidcscd; break;
		case "OTHER" : $list[$hn]["OTHER"] = $list[$hn]["OTHER"] + $paidcscd; break;
	default:  $list[$hn]["OTHER2"] = $list[$hn]["OTHER2"] + $paidcscd; break;

}

}
$num='0';
$i='0';
$p='1';

//echo"$_POST["start_year"]";
//echo"".$start_year."";
/*
echo "<font face='Angsana New' size ='4'><center> <b>ลูกหนี้โครงการจ่ายตรงประจำวันที่ ".$start_day."-".$start_month."-".($start_year)." 00:00:00 ถึง  ".$end_day."-".$end_month."-".($end_year)." 23:59:00<br></b> ";
echo "<font face='Angsana New' size ='3'> โรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;แผ่นที่&nbsp;$p</center>";
echo "<table  border ='1' bordercolor='#000000' cellspacing='0' cellpadding='0'>";
echo "<tr><td>&nbsp;&nbsp;#&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;วันที่&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;ชื่อ - สกุล&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;hn&nbsp;&nbsp;</td><td><center> <b>&nbsp;&nbsp;ยา&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;พยาธิ&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;เอกเรย์&nbsp;&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;ทันตกรรม&nbsp;&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;กายภาพ&nbsp;&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;บริการ&nbsp;&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;ผ่าตัด&nbsp;&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;ฝังเข็ม&nbsp;&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b><center> <b>&nbsp;&nbsp;ตรวจอื่นๆ&nbsp;&nbsp;</td><td>&nbsp;&nbsp;***&nbsp;&nbsp;</td><td><center> <b>&nbsp;&nbsp;รวม&nbsp;&nbsp;</td></tr>";
*/
foreach ($list2 as $key => $value) {

	$xx = explode("/",$value);
	$num++;
$i++;


/*
if ($list[$key]["PHAR"] > 0 ){$list[$key]["PHAR1"]=number_format( $list[$key]["PHAR"],2);} else {
	};
if ($list[$key]["PATHO"] > 0 ){$list[$key]["PATHO1"]=number_format( $list[$key]["PATHO"],2);} else {
	};
if ($list[$key]["XRAY"] > 0 ){$list[$key]["XRAY1"]=number_format( $list[$key]["XRAY"],2);} else {
	};
if ($list[$key]["DENTA"] > 0 ){$list[$key]["DENTA1"]=number_format( $list[$key]["DENTA"],2);} else {
	};
if ($list[$key]["PHYSI"] > 0 ){$list[$key]["PHYSI1"]=number_format( $list[$key]["PHYSI"],2);} else {
	};
if ($list[$key]["EMER"] > 0 ){$list[$key]["EMER1"]=number_format( $list[$key]["EMER"],2);} else {
	};
if ($list[$key]["SURG"] > 0 ){$list[$key]["SURG1"]=number_format( $list[$key]["SURG"],2);} else {
	};
if ($list[$key]["NID"] > 0 ){$list[$key]["NID1"]=number_format( $list[$key]["NID"],2);} else {
	};
	if ($list[$key]["HEMO"] > 0 ){$list[$key]["HEMO1"]=number_format( $list[$key]["HEMO"],2);} else {
	};
if ($list[$key]["OTHER"] > 0 ){$list[$key]["OTHER1"]=number_format( $list[$key]["OTHER"],2);} else {
	};
if ($list[$key]["OTHER2"] > 0 ){$list[$key]["OTHER21"]=number_format( $list[$key]["OTHER2"],2);} else 
	{
	};

*/

/*
$total=$list[$key]["PHAR"]+$list[$key]["PATHO"]+$list[$key]["XRAY"]+$list[$key]["DENTA"]+$list[$key]["PHYSI"]+$list[$key]["EMER"]+$list[$key]["SURG"]+$list[$key]["NID"]+$list[$key]["HEMO"]+$list[$key]["OTHER"]+$list[$key]["OTHER2"];
$total=number_format($total,2);
*/
/*

    echo "<tr  ><td><font face='Angsana New' size ='2'>&nbsp;&nbsp;".$num."&nbsp;</td><td><font face='Angsana New' size ='2'>&nbsp;&nbsp;".$xx[0]."&nbsp;</td><td><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$xx[1]."&nbsp;</b></td><td><font face='Angsana New' size ='2'>&nbsp;&nbsp;".$key."&nbsp;</td><td align='right'><font face='Angsana New' size ='2'>&nbsp;&nbsp;".$list[$key]["PHAR1"]."&nbsp;</td><td align='right'><font face='Angsana New' size ='2'>&nbsp;&nbsp;".$list[$key]["PATHO1"]."&nbsp;</td><td align='right'><font face='Angsana New' size ='2'>&nbsp;&nbsp;".$list[$key]["XRAY1"]."&nbsp;</td><td align='right'><font face='Angsana New' size ='2'>&nbsp;&nbsp;".$list[$key]["DENTA1"]."&nbsp;</td><td align='right'><font face='Angsana New' size ='2'>&nbsp;&nbsp;".$list[$key]["PHYSI1"]."&nbsp;</td><td align='right'><font face='Angsana New' size ='2'>&nbsp;&nbsp;".$list[$key]["EMER1"]."&nbsp;</td><td align='right'><font face='Angsana New' size ='2'>&nbsp;&nbsp;".$list[$key]["SURG1"]."&nbsp;</td><td align='right'><font face='Angsana New' size ='2'>&nbsp;&nbsp;".$list[$key]["NID1"]."&nbsp;</td><td align='right'><font face='Angsana New' size ='2'>&nbsp;&nbsp;".$list[$key]["OTHER1"]."&nbsp;</td><td align='right'><font face='Angsana New' size ='2'>&nbsp;&nbsp;".$list[$key]["OTHER21"]."&nbsp;</td><td align='right'><font face='Angsana New' size ='2'>&nbsp;&nbsp;".$total."&nbsp;</td></tr>";



	if($i == '22'){
		$p++;
			echo "</table>";
			print ("<tr><td><div style=\"page-break-before: always;\"></div></td></tr>");

echo "<font face='Angsana New' size ='4'><center> <b>ลูกหนี้โครงการจ่ายตรงประจำวันที่ ".$start_day."-".$start_month."-".($start_year)." 00:00:00 ถึง  ".$end_day."-".$end_month."-".($end_year)." 23:59:00<br></b> ";
echo "<font face='Angsana New' size ='3'> โรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;แผ่นที่&nbsp;$p</center>";

echo "<table  border ='1' bordercolor='#000000' cellspacing='0' cellpadding='0'>";



echo "<tr><td>&nbsp;&nbsp;#&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;วันที่&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;ชื่อ - สกุล&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;hn&nbsp;&nbsp;</td><td><center> <b>&nbsp;&nbsp;ยา&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;พยาธิ&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;เอกเรย์&nbsp;&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;ทันตกรรม&nbsp;&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;กายภาพ&nbsp;&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;บริการ&nbsp;&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;ผ่าตัด&nbsp;&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;ฝังเข็ม&nbsp;&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b><center> <b>&nbsp;&nbsp;ตรวจอื่นๆ&nbsp;&nbsp;</td><td>&nbsp;&nbsp;***&nbsp;&nbsp;</td><td><center> <b>&nbsp;&nbsp;รวม&nbsp;&nbsp;</td></tr>";

$i='0';


		}

*/
	$PHAR = $PHAR+$list[$key]["PHAR"];
	$PATHO = $PATHO+$list[$key]["PATHO"];
	$XRAY = $XRAY+$list[$key]["XRAY"];
	$DENTA = $DENTA+$list[$key]["DENTA"];
	$PHYSI = $PHYSI+$list[$key]["PHYSI"];
	$EMER = $EMER+$list[$key]["EMER"];
	$SURG = $SURG+$list[$key]["SURG"];
		$NID = $NID+$list[$key]["NID"];
			$HEMO = $HEMO+$list[$key]["HEMO"];
	$OTHER = $OTHER+$list[$key]["OTHER"];
	$OTHER1 = $OTHER1+$list[$key]["OTHER2"];
	$sum = $sum+($list[$key]["PHAR"]+$list[$key]["PATHO"]+$list[$key]["XRAY"]+$list[$key]["DENTA"]+$list[$key]["PHYSI"]+$list[$key]["EMER"]+$list[$key]["SURG"]+$list[$key]["NID"]+$list[$key]["HEMO"]+$list[$key]["OTHER"]+$list[$key]["OTHER2"]);
}


function baht($nArabic){
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
   $cRead  = "**";

include("connect.inc");
 
 IF ($cLtnum <> "0"){
  $count=0;
  For ($i = 0;$i<=$nNum;$i++){
    $cNo   = Substr($cLtnum,$count,1);
     $count++;
//อ่านหลัก
    IF ($cNo <>0 and $cNo != "-"){
      If ($nUnit <> 1){  

          $query = "SELECT * FROM thaibaht WHERE fld1 = '$nUnit' ";
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
          $query = "SELECT * FROM thaibaht WHERE fld1 = '$cNo' ";
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

          $query = "SELECT * FROM thaibaht WHERE fld1 = '$cNo' ";
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
    $cRead = $cRead."สตางค์**"  ;
	}    
    else{
           $cRead = $cRead."ถ้วน**" ;
           }  
    include("connect.inc");

   return $cRead;
}
///end function baht

$cbaht=baht($sum);

/*
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

$sum=number_format($sum,2);
*/
/*
echo "<tr><b><td>&nbsp;</td><td>&nbsp;</td><td><b><font face='Angsana New' size ='2'><center>รวมทั้งหมด</td><td>&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$PHAR."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$PATHO."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$XRAY."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$DENTA."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$PHYSI."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$EMER."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$SURG."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>".$NID."</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$OTHER."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$OTHER2."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$sum."&nbsp;&nbsp;</td></b></tr></FONT>";

echo "</table>";


			print ("<tr><td><div style=\"page-break-before: always;\"></div></td></tr>");
			*/
echo "<font face='Angsana New' size ='5'><br><br><center> <b>สรุปลูกหนี้โครงการจ่ายตรงประจำวันที่ ".$start_day."-".$start_month."-".($start_year)." 00:00:00 ถึง  ".$end_day."-".$end_month."-".($end_year)." 23:59:00 <br></b> ";
echo "<font face='Angsana New' size ='5'> โรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง <br>";
$Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
echo "<font face='Angsana New' size ='4'> รายงานเมื่อวันที่  $Thaidate </center>";
echo "<font face='Angsana New' size ='4'>จำนวน &nbsp;$count &nbsp;แถว </center>";

echo "<table  border ='1' bordercolor='#000000' cellspacing='0' cellpadding='0' style='BORDER-COLLAPSE: collapse'>";
echo "<tr><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;วันที่&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;&nbsp;&nbsp;</td><td><center> <b>&nbsp;&nbsp;ยา&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;พยาธิ&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;เอกเรย์&nbsp;&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;ทันตกรรม&nbsp;&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;กายภาพ&nbsp;&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;บริการ&nbsp;&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;ผ่าตัด&nbsp;&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;ฝังเข็ม&nbsp;&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;ไตเทียม&nbsp;&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b><center> <b>&nbsp;&nbsp;ตรวจอื่นๆ&nbsp;&nbsp;</td><td>&nbsp;&nbsp;***&nbsp;&nbsp;</td><td><center> <b>&nbsp;&nbsp;รวม&nbsp;&nbsp;</td></tr>";
echo "<tr><td><b><font face='Angsana New' size ='3'>&nbsp;&nbsp;".$start_day."-".$start_month."-".($start_year)." &nbsp; ถึง &nbsp; ".$end_day."-".$end_month."-".($end_year)." &nbsp;&nbsp;</td><td><b><font face='Angsana New' size ='2'><center>รวมทั้งหมด</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$PHAR."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$PATHO."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$XRAY."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$DENTA."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$PHYSI."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$EMER."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$SURG."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$NID."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$HEMO."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$OTHER."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$OTHER2."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='3'><b>&nbsp;&nbsp;".$sum."&nbsp;&nbsp;</td></b></tr></FONT>";
echo "</table>";

print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='30%'> </td>";
print "      <td width='70%'><center><font face='Angsana New'>($cbaht)</font></td>";
print "    </tr>";
print "  </table>";


print "<br>";
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='60%'></td>";
print "      <td width='40%'><font face='Angsana New'>ร.ต.หญิง</font></td>";
print "    </tr>";
print "  </table>";
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='50%'></td>";
print "      <td width='50%'><center><font face='Angsana New'>(&nbsp;สุภาภรณ์ คำแก้ว&nbsp;)</font></td>";
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

/*
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
print "      <td width='50%'><center><font face='Angsana New'>(......................................................)</font></td>";
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
//print "  </table> <div style=\"page-break-before: always;\"></div>";


