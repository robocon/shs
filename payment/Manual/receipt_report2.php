<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>สำเนาใบเสร็จรับเงิน</title>
</head>
<?
//function baht///
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

include("../../Connections/connect.inc.php");
 
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
  include("../../Connections/connect.inc.php");

   return $cRead;
}
///end function baht


print "<script>"; print "ie4up=nav4up=false;"; print "var agt = navigator.userAgent.toLowerCase();"; print "var major = parseInt(navigator.appVersion);"; print "if ((agt.indexOf('msie') != -1) && (major >= 4))";   print "ie4up = true;"; print "if ((agt.indexOf('mozilla') != -1)  && (agt.indexOf('spoofer') == -1) && (agt.indexOf('compatible') == -1) && ( major>= 4))";   print "nav4up = true;";print "</script>";print "<head>";print "<STYLE>"; print "A {text-decoration:none}"; print "A IMG {border-style:none; border-width:0;}"; print "DIV {position:absolute; z-index:25;}";print ".fc1-0 { COLOR:000000;FONT-SIZE:23PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";print ".fc1-1 { COLOR:000000;FONT-SIZE:16PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";print ".fc1-2 { COLOR:000000;FONT-SIZE:19PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print ".fc1-3 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";
print ".fc1-9 { COLOR:000000;FONT-SIZE:12PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";print "</STYLE>";print "<TITLE>Crystal Report Viewer</TITLE>";print "</head>";print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";
?>
<style type="text/css">
<!--
.hd {
	font-family: "TH SarabunPSK";
	font-size: 26px;
}
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 20px;
	border-radius: 15px;
}
</style>
<body onload="JavaScript:window.print();">
<?
include("../../Connections/connect.inc.php");

	$sql="select * from  receipt where row_receipt='".$_GET['receipt_id']."' ";
	$query=mysql_query($sql);
	$arr=mysql_fetch_array($query);
	
if($arr['type_receipt']==1)	{
	$type="เงินสด";
}else if($arr['type_receipt']==2){
	$type="เช็ค";	
	$textcheque="เลขที่&nbsp;&nbsp;".$arr['no_cheque']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ธนาคาร  ".$arr['bank'];
}else if($arr['type_receipt']==3){
	$type="เงินโอน";	
	$textcheque="ธนาคาร&nbsp;&nbsp;".$arr['bank'];
}

$exdate=explode(" ",$arr['thidate']);
$thdate1=$exdate[0];
$thdate2=$exdate[1];

//ดึงรายการ
    $sql1="select * from  detail_receipt2  where row_receipt='".$_GET['receipt_id']."' ";
	$query1=mysql_query($sql1);
	$arr1=mysql_fetch_array($query1);
	
	$y1=$arr1['1y'];
	$n1=$arr1['1n'];
	$sy1=$arr1['1sy'];
	$sn1=$arr1['1sn'];
	$y2=$arr1['2y'];
	$n2=$arr1['2n'];
	$y3=$arr1['3y'];
	$n3=$arr1['3n'];
	$y4=$arr1['4y'];
	$n4=$arr1['4n'];
	$y5=$arr1['5y'];
	$n5=$arr1['5n'];
	$y6=$arr1['6y'];
	$n6=$arr1['6n'];
	$y7=$arr1['7y'];
	$n7=$arr1['7n'];
	$y8=$arr1['8y'];
	$n8=$arr1['8n'];
	$y9=$arr1['9y'];
	$n9=$arr1['9n'];
	$y10=$arr1['10y'];
	$n10=$arr1['10n'];
	$y11=$arr1['11y'];
	$n11=$arr1['11n'];
	$y12=$arr1['12y'];
	$n12=$arr1['12n'];
	$y13=$arr1['13y'];
	$n13=$arr1['13n'];
	$y14=$arr1['14y'];
	$n14=$arr1['14n'];
	$y15=$arr1['15y'];
	$n15=$arr1['15n'];
	$y16=$arr1['16y'];
	$n16=$arr1['16n'];
	
	//$s1=$y1+$sy1+$y2+$y3+$y4+$y5+$y6+$y7+$y8+$y9+$y10+$y11+$y12+$y13+$y14+$y15+$y16;
$dpy=number_format($y1+$sy1+$y2+$y3+$y4+$y5+$y6+$y7+$y8+$y9+$y10+$y11+$y12+$y13+$y14+$y15+$y16,2,".","");
$dpn=number_format($n1+$sn1+$n2+$n3+$n4+$n5+$n6+$n7+$n8+$n9+$n10+$n11+$n12+$n13+$n14+$n15+$n16,2,".","");

$total=number_format($dpn+$dpy,2,".","");
$totaltext=baht($total);

//บรรทัด  1
print "<DIV style='left:35PX;top:170PX;width:500PX;height:30PX;'><span class='forntsarabun'><b>วันที่ </b>$thdate1</DIV>";
print "<DIV style='left:300PX;top:170PX;width:500PX;height:30PX;'><span class='forntsarabun'> <b>เวลา</b> $thdate2</DIV>";
// 2
print "<DIV style='left:35PX;top:200PX;width:500PX;height:30PX;'><span class='forntsarabun'><b>ได้รับ</b> $type</DIV>";
print "<DIV style='left:200PX;top:200PX;width:500PX;height:30PX;'><span class='forntsarabun'>$textcheque</DIV>";
print"<DIV style='left:35PX;top:230PX;width:500PX;height:30PX;'><span class='forntsarabun'><b>จาก </b> $arr[from_name]</span></DIV>";
print"<DIV style='left:300PX;top:230PX;width:500PX;height:30PX;'><span class='forntsarabun'><b>โรค </b> $arr[diag]</span></DIV>";
// 5
print "<DIV style='left:35PX;top:250PX;width:500PX;height:30PX;'><span class='forntsarabun'></DIV>";
print "<DIV style='left:35PX;top:300PX;width:500PX;height:30PX;'><span class='forntsarabun'></DIV>";


print"<DIV style='left:35PX;top:415PX;width:700PX;height:30PX;'><span class='fc1-1'>";

?>
<table width="80%" border="0" class="forntsarabun">
<tr>
<td width="50%">1.ค่าห้อง/ค่าอาหาร</td>
<td align="right" width="15%"><?=$n1?></td>
<td align="right" width="15%"><?=$y1?></td>
</tr>
<tr>
  <td width="50%">......ค่าห้อง/ค่าอาหาร(ส่วนเกิน)</td>
  <td align="right" width="15%"><?=$sn1?></td>
  <td align="right" width="15%"><?=$sy1?></td>
</tr>
<tr>
  <td width="50%">2. อวัยวะเทียม/อุปกรณ์ในการบำบัดรักษา</td>
  <td align="right" width="15%"><?=$n2?></td>
  <td align="right" width="15%"><?=$y2?></td>
</tr>
<tr>
  <td width="50%">3. ยาและสารอาหารทางเส้นเลือดที่ใช้ในโรงพยาบาล</td>
  <td align="right" width="15%"><?=$n3?></td>
  <td align="right" width="15%"><?=$y3?></td>
</tr>
<tr>
  <td width="50%">4. ยาที่นำไปใช้ต่อที่บ้าน</td>
  <td align="right" width="15%"><?=$n4?></td>
  <td align="right" width="15%"><?=$y4?></td>
</tr>
<tr>
  <td width="50%">5. เวชภัณฑ์ที่ไม่ใช่ยา</td>
  <td align="right" width="15%"><?=$n5?></td>
  <td align="right" width="15%"><?=$y5?></td>
</tr>
<tr>
  <td width="50%">6. ค่าบริการโลหิตและส่วนประกอบของโลหิต</td>
  <td align="right" width="15%"><?=$n6?></td>
  <td align="right" width="15%"><?=$y6?></td>
</tr>
<tr>
  <td width="50%">7. ค่าตรวจวินิจฉัยทางเทคนิคการแพทย์และพยาธิวิทยา</td>
  <td align="right" width="15%"><?=$n7?></td>
  <td align="right" width="15%"><?=$y7?></td>
</tr>
<tr>
  <td width="50%">8. ค่าตรวจวินิจฉัยและรักษาทางรังสีวิทยา</td>
  <td align="right" width="15%"><?=$n8?></td>
  <td align="right" width="15%"><?=$y8?></td>
</tr>
<tr>
  <td width="50%">9.  ค่าตรวจวินิจฉัยโดยวิธีพิเศษอื่นๆ</td>
  <td align="right" width="15%"><?=$n9?></td>
  <td align="right" width="15%"><?=$y9?></td>
</tr>
<tr>
  <td width="50%">10. ค่าอุปกรณ์ของใช้และเครื่องมือทางการแพทย์</td>
  <td align="right" width="15%"><?=$n10?></td>
  <td align="right" width="15%"><?=$y10?></td>
</tr>
<tr>
  <td width="50%">11. ค่าผ่าตัด  ทำคลอด  ทำหัตถการและบริการวิสัญญี</td>
  <td align="right" width="15%"><?=$n11?></td>
  <td align="right" width="15%"><?=$y11?></td>
</tr>
<tr>
  <td width="50%">12. ค่าบริการทางการพยาบาลทั่วไป</td>
  <td align="right" width="15%"><?=$n12?></td>
  <td align="right" width="15%"><?=$y12?></td>
</tr>
<tr>
  <td width="50%">13. ค่าบริการทางทันตกรรม</td>
  <td align="right" width="15%"><?=$n13?></td>
  <td align="right" width="15%"><?=$y13?></td>
</tr>
<tr>
  <td width="50%">14. ค่าบริการทางกายภาพบำบัดและเวชกรรมฟื้นฟู</td>
  <td align="right" width="15%"><?=$n14?></td>
  <td align="right" width="15%"><?=$y14?></td>
</tr>
<tr>
  <td width="50%">15. ค่าบริการฝังเข็ม/การบำบัดของผู้ประกอบโรคศิลปะอื่นๆ</td>
  <td align="right" width="15%"><?=$n15?></td>
  <td align="right" width="15%"><?=$y15?></td>
</tr>
<tr>
  <td width="50%">16. ค่าบริการอื่นที่ไม่เกี่ยวข้องกับการรักษา</td>
  <td align="right" width="15%"><?=$n16?></td>
  <td align="right" width="15%"><?=$y16?></td>
</tr>
<tr>
  <td width="50%">&nbsp;</td>
  <td align="right" width="15%">&nbsp;</td>
  <td align="right" width="15%">&nbsp;</td>
</tr>
<tr>
  <td width="50%">&nbsp;</td>
  <td align="right" width="15%"><?=$dpn;?></td>
  <td align="right" width="15%"><?=$dpy;?></td>
</tr>
<tr>
  <td align="center"><?=$totaltext;?></td>
  <td colspan="2" align="center"><?=$total;?></td>
  </tr>
</table>

<?
/*///// ค่าห้อง/ค่าอาหาร //
print "<DIV style='left:35PX;top:395PX;width:700PX;height:30PX;'><span class='fc1-1'>1.ค่าห้อง/ค่าอาหาร</DIV>";
print "<DIV style='right:-30PX;top:395PX;width:500PX;height:30PX;'><span class='fc1-1'>$n1</DIV>";
print"<DIV style='right:-170PX;top:395PX;width:500PX;height:50PX;'><span class='fc1-1'>$y1</DIV>";


///// ค่าห้อง/อาหาร ส่วนเกิน //
print "<DIV style='left:35PX;top:420PX;width:500PX;height:30PX;'><span class='fc1-1'>......ค่าห้อง/ค่าอาหาร(ส่วนเกิน)</DIV>";
print "<DIV style='right:-30PX;top:420PX;width:500PX;height:30PX;'><span class='fc1-1'>$sn1</DIV>";
print"<DIV style='right:-170PX;top:420PX;width:500PX;height:50PX;'><span class='fc1-1'>$sy1</DIV>";

///// รายการค่าใช้จ่าย //
print "<DIV style='left:35PX;top:445PX;width:500PX;height:30PX;'><span class='fc1-1'>2. อวัยวะเทียม/อุปกรณ์ในการบำบัดรักษา</DIV>";
print "<DIV style='left:550PX;top:445PX;width:500PX;height:30PX;'><span class='fc1-1'>$n2</DIV>";
print"<DIV style='left:650PX;top:445PX;width:500PX;height:50PX;'><span class='fc1-1'>$y2</DIV>";

// 3. ยาและสารอาหารทางเส้นเลือดที่ใช้ในโรงพยาบาล //
print "<DIV style='left:35PX;top:470PX;width:500PX;height:30PX;'><span class='fc1-1'>3. ยาและสารอาหารทางเส้นเลือดที่ใช้ในโรงพยาบาล</DIV>";
print "<DIV style='left:550PX;top:470PX;width:500PX;height:30PX;'><span class='fc1-1'>$n3</DIV>";
print"<DIV style='left:650PX;top:470PX;width:500PX;height:50PX;'><span class='fc1-1'>$y3</DIV>";

//4. ยาที่นำไปใช้ต่อที่บ้าน
print "<DIV style='left:35PX;top:495PX;width:500PX;height:30PX;'><span class='fc1-1'>4. ยาที่นำไปใช้ต่อที่บ้าน</DIV>";
print "<DIV style='left:550PX;top:495PX;width:500PX;height:30PX;'><span class='fc1-1'>$n4</DIV>";
print"<DIV style='left:650PX;top:495PX;width:500PX;height:50PX;'><span class='fc1-1'>$y4</DIV>";

// 5. เวชภัณฑ์ที่ไม่ใช่ยา
print "<DIV style='left:35PX;top:520PX;width:500PX;height:30PX;'><span class='fc1-1'>5. เวชภัณฑ์ที่ไม่ใช่ยา</DIV>";
print "<DIV style='left:550PX;top:520PX;width:500PX;height:30PX;'><span class='fc1-1'>$n5</DIV>";
print"<DIV style='left:650PX;top:520PX;width:500PX;height:50PX;'><span class='fc1-1'>$y5</DIV>";

// 6. ค่าบริการโลหิตและส่วนประกอบของโลหิต
print "<DIV style='left:35PX;top:545PX;width:500PX;height:30PX;'><span class='fc1-1'>6. ค่าบริการโลหิตและส่วนประกอบของโลหิต</DIV>";
print "<DIV style='left:550PX;top:545PX;width:500PX;height:30PX;'><span class='fc1-1'>$n6</DIV>";
print"<DIV style='left:650PX;top:545PX;width:500PX;height:50PX;'><span class='fc1-1'>$y6</DIV>";

// 7. ค่าตรวจวินิจฉัยทางเทคนิคการแพทย์และพยาธิวิทยา
print "<DIV style='left:35PX;top:570PX;width:500PX;height:30PX;'><span class='fc1-1'>7. ค่าตรวจวินิจฉัยทางเทคนิคการแพทย์และพยาธิวิทยา</DIV>";
print "<DIV style='left:550PX;top:570PX;width:500PX;height:30PX;'><span class='fc1-1'>$n7</DIV>";
print"<DIV style='left:650PX;top:570PX;width:500PX;height:50PX;'><span class='fc1-1'>$y7</DIV>";

// 8. ค่าตรวจวินิจฉัยและรักษาทางรังสีวิทยา
print "<DIV style='left:35PX;top:595PX;width:500PX;height:30PX;'><span class='fc1-1'>8. ค่าตรวจวินิจฉัยและรักษาทางรังสีวิทยา</DIV>";
print "<DIV style='left:550PX;top:595PX;width:500PX;height:30PX;'><span class='fc1-1'>$n8</DIV>";
print"<DIV style='left:650PX;top:595PX;width:500PX;height:50PX;'><span class='fc1-1'>$y8</DIV>";

// 9.  ค่าตรวจวินิจฉัยโดยวิธีพิเศษอื่นๆ
print "<DIV style='left:35PX;top:620PX;width:500PX;height:30PX;'><span class='fc1-1'>9.  ค่าตรวจวินิจฉัยโดยวิธีพิเศษอื่นๆ</DIV>";
print "<DIV style='left:550PX;top:620PX;width:500PX;height:30PX;'><span class='fc1-1'>$n9</DIV>";
print"<DIV style='left:650PX;top:620PX;width:500PX;height:50PX;'><span class='fc1-1'>$y9</DIV>";

//  10. ค่าอุปกรณ์ของใช้และเครื่องมือทางการแพทย์
print "<DIV style='left:35PX;top:645PX;width:500PX;height:30PX;'><span class='fc1-1'>10. ค่าอุปกรณ์ของใช้และเครื่องมือทางการแพทย์</DIV>";
print "<DIV style='left:550PX;top:645PX;width:500PX;height:30PX;'><span class='fc1-1'>$n10</DIV>";
print"<DIV style='left:650PX;top:645PX;width:500PX;height:50PX;'><span class='fc1-1'>$y10</DIV>";

//  11. ค่าผ่าตัด  ทำคลอด  ทำหัตถการและบริการวิสัญญี
print "<DIV style='left:35PX;top:670PX;width:500PX;height:30PX;'><span class='fc1-1'>11. ค่าผ่าตัด  ทำคลอด  ทำหัตถการและบริการวิสัญญี</DIV>";
print "<DIV style='left:550PX;top:670PX;width:500PX;height:30PX;'><span class='fc1-1'>$n11</DIV>";
print"<DIV style='left:650PX;top:670PX;width:500PX;height:50PX;'><span class='fc1-1'>$y11</DIV>";

// 12. ค่าบริการทางการพยาบาลทั่วไป
print "<DIV style='left:35PX;top:695PX;width:500PX;height:30PX;'><span class='fc1-1'>12. ค่าบริการทางการพยาบาลทั่วไป</DIV>";
print "<DIV style='left:550PX;top:695PX;width:500PX;height:30PX;'><span class='fc1-1'>$n12</DIV>";
print"<DIV style='left:650PX;top:695PX;width:500PX;height:50PX;'><span class='fc1-1'>$y12</DIV>";

// 13. ค่าบริการทางทันตกรรม
print "<DIV style='left:35PX;top:720PX;width:500PX;height:30PX;'><span class='fc1-1'>13. ค่าบริการทางทันตกรรม</DIV>";
print "<DIV style='left:550PX;top:720PX;width:500PX;height:30PX;'><span class='fc1-1'>$n13</DIV>";
print"<DIV style='left:650PX;top:720PX;width:500PX;height:50PX;'><span class='fc1-1'>$y13</DIV>";

// 14. ค่าบริการทางกายภาพบำบัดและเวชกรรมฟื้นฟู
print "<DIV style='left:35PX;top:745PX;width:500PX;height:30PX;'><span class='fc1-1'>14. ค่าบริการทางกายภาพบำบัดและเวชกรรมฟื้นฟู</DIV>";
print "<DIV style='left:550PX;top:745PX;width:500PX;height:30PX;'><span class='fc1-1'>$n14</DIV>";
print"<DIV style='left:650PX;top:745PX;width:500PX;height:50PX;'><span class='fc1-1'>$y14</DIV>";

// 15. ค่าบริการฝังเข็ม/การบำบัดของผู้ประกอบโรคศิลปะอื่นๆ
print "<DIV style='left:35PX;top:770PX;width:500PX;height:30PX;'><span class='fc1-1'>15. ค่าบริการฝังเข็ม/การบำบัดของผู้ประกอบโรคศิลปะอื่นๆ</DIV>";
print "<DIV style='left:550PX;top:770PX;width:500PX;height:30PX;'><span class='fc1-1'>$n15</DIV>";
print"<DIV style='left:650PX;top:770PX;width:500PX;height:50PX;'><span class='fc1-1'>$y15</DIV>";

// 16. ค่าบริการอื่นที่ไม่เกี่ยวข้องกับการรักษา
print "<DIV style='left:35PX;top:795PX;width:500PX;height:30PX;'><span class='fc1-1'>16. ค่าบริการอื่นที่ไม่เกี่ยวข้องกับการรักษา</DIV>";
print "<DIV style='left:550PX;top:795PX;width:500PX;height:30PX;'><span class='fc1-1'>$n16</DIV>";
print"<DIV style='left:650PX;top:795PX;width:500PX;height:50PX;'><span class='fc1-1'>$y16</DIV>";

//รวมเงิน
print "<DIV style='left:550PX;top:890PX;width:500PX;height:30PX;'><span class='fc1-1'>$dpn</DIV>";
print"<DIV style='left:650PX;top:890PX;width:500PX;height:50PX;'><span class='fc1-1'>$dpy</DIV>";
//รวมทั้งสิ้น
print"<DIV style='left:150PX;top:915PX;width:500PX;height:50PX;'><span class='fc1-1'>$totaltext</DIV>";
print"<DIV style='left:600PX;top:915PX;width:500PX;height:50PX;'><span class='fc1-1'>$total</DIV>";*/

?>

<?
print "</span></DIV>";

// ลงชื่อ
print"<DIV style='left:450PX;top:1050PX;width:500PX;height:50PX;' ><span class='forntsarabun'>$arr[sing_name]</DIV>";
print"<DIV style='left:480PX;top:1085PX;width:500PX;height:50PX;' ><span class='forntsarabun'>เจ้าหน้าที่เก็บเงิน</DIV>";
?>
</body>
</html>