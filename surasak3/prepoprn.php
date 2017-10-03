<style>
.f1{
	font-family: "TH SarabunPSK";
	font-size:18px;
	text-decoration:underline;
	font-weight:bold;
}
</style>
<?php
//function baht///
function baht($nArabic){
	
    $nArabic = number_format($nArabic, 2, '.', ''); 
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
   $cRead  = "(";

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
    $cRead = $cRead."สตางค์)"  ;
	}    
    else{
           $cRead = $cRead."ถ้วน)" ;
           }  
    include("connect.inc");

   return $cRead;
}
///end function baht

///function convert to float number ทศนิยม 2ตำแหน่ง
function vat($nVArabic){
    $nVArabic = number_format($nVArabic, 2, '.', ''); 
    $cTarget = Ltrim($nVArabic);
    $cLtnum="";
    $x=0;
    while (substr($cTarget,$x,1) <> "."){
            $cLtnum=$cLtnum.substr($cTarget,$x,1);
            $x++;
	}
   $cRtnum=substr($cTarget,$x+1);

$cRtnum=$cRtnum/100;
$cRtnum=intval($cRtnum);
$vat=$nVArabic+$cRtnum;
return $vat;
	}
///end of function convert to float number ทศนิยม 2ตำแหน่ง

    include("connect.inc");

	///Load offisers
    $aMancode=array("aMancode"); 
	$aMancode[1]='director';
	$aMancode[2]='pharmacy';
	$aMancode[3]='logis';
	$aMancode[4]='logis2';
	$aMancode[5]='budget';
	$aMancode[6]='reciever';
	$aMancode[7]='reciever2';
	$aMancode[8]='reciever3';
	$aMancode[9]='witness';
	$aMancode[10]='witness2';

	for ($n=1; $n<=10; $n++){

		$query = "SELECT * FROM officers WHERE mancode = '$aMancode[$n]'";
		$result = mysql_query($query)
			or die("Query failed");

		for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
			if (!mysql_data_seek($result, $i)) {
				echo "Cannot seek to row $i\n";
				continue;
				 }

			if(!($row = mysql_fetch_object($result)))
				continue;
				 }
		$aYot[$n]	=$row->yot; 
		$aFname[$n] =$row->fullname; 
		$aPost[$n]  =$row->position; 
		$aPost2[$n] =$row->position2; 
							}
///////End Load offisers

    $query = "SELECT * FROM pocompany WHERE row_id = '$nRow_id' ";
    $result = mysql_query($query) or die("Query pocompany fail");
	    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }
        if(!($row = mysql_fetch_object($result)))
            continue;
         }

//31
	$cDepart=$row->depart;
    $cDepartno=$row->departno;
    $cDepartdate=$row->departdate;
	$cPrepono=$row->prepono;
	$cPrepodate=$row->prepodate;
	$cComcode=$row->comcode;
	$cComname=$row->comname;
	$nItems=$row->items;
	$nNetprice=$row->netprice;
	$cPono=$row->pono;
	$cPodate=$row->podate;
	
	
		$query1 = "SELECT * FROM company WHERE comcode = '$cComcode'";
		$result1 = mysql_query($query1)or die("Query failed");
		$row1 = mysql_fetch_array($result1);
		if($row1){
		$fax="(  ".$row1['fax']."  )";
		}

//คำนวนค่าต่างๆ
  $nVat=$nNetprice*.07;
///  $nVat=number_format($nVat,2,'.',''); //convert to string ทศนิยม 2 ตำแหน่ง ปัดเศษ
///  $nVat=floatval ($nVat);// convert to float-number

 $nVat=vat($nVat);//use function vat

  $nPriadvat=$nVat+$nNetprice;
  $cPriadvat=baht($nPriadvat);//ตัวอักษร

//format 2 decimal
$nVat=number_format($nVat,2,'.',',');
$nPriadvat=number_format($nPriadvat,2,'.',',');
$nNetprice=number_format($nNetprice,2,'.',',');

          
///// po31.php///
print "<HTML>";
print "<script>";
 print "ie4up=nav4up=false;";
 print "var agt = navigator.userAgent.toLowerCase();";
 print "var major = parseInt(navigator.appVersion);";
 print "if ((agt.indexOf('msie') != -1) && (major >= 4))";
   print "ie4up = true;";
 print "if ((agt.indexOf('mozilla') != -1)  && (agt.indexOf('spoofer') == -1) && (agt.indexOf('compatible') == -1) && ( major>= 4))";
   print "nav4up = true;";
print "</script>";

print "<STYLE>";
 print "A {text-decoration:none}";
 print "A IMG {border-style:none; border-width:0;}";
 print "DIV {position:absolute; z-index:25;}";
print "</STYLE>";
print "<TITLE>Crystal Report Viewer</TITLE>";
print "<BODY BGCOLOR='FFFFFF'LEFTMARGIN=0 TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0>";
print "<DIV style='z-index:0'> &nbsp; </div>";
print "<DIV style='left:88PX;top:110PX;width:697PX;height:30PX;'><span class='fc1-5'>ส่วนราชการ&nbsp;&nbsp;กองเภสัชกรรม&nbsp;&nbsp;&nbsp;&nbsp;รพ.ค่ายสุรศักดิ์มนตรี</span></DIV>";
print "<DIV style='left:329PX;top:49PX;width:155PX;height:34PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>บันทึกข้อความ</span></DIV>";
print "<DIV style='left:88PX;top:139PX;width:333PX;height:30PX;'><span class='fc1-5'>ที่ กห 0483.63.4/$cPrepono</span></DIV>";
//print "<DIV style='left:402PX;top:139PX;width:32PX;height:30PX;'><span class='fc1-5'>วันที่</span></DIV>";
print "<DIV style='left:402PX;top:110PX;width:257PX;height:30PX;'><span class='fc1-5'>$cPrepodate</span></DIV>";
print "<DIV style='z-index:15;left:88PX;top:27PX;width:73PX;height:80PX;'><img  WIDTH=73 HEIGHT=80 SRC='bird.jpg'></DIV>";
print "<DIV style='left:88PX;top:169PX;width:36PX;height:30PX;'><span class='fc1-5'>เรื่อง</span></DIV>";
print "<DIV style='left:88PX;top:198PX;width:36PX;height:30PX;'><span class='fc1-5'>เรียน</span></DIV>";
print "<DIV style='left:138PX;top:198PX;width:283PX;height:30PX;'><span class='fc1-5'>ผอ.รพ.ค่ายสุรศักดิ์มนตรี</span></DIV>";

/*print "<DIV style='left:88PX;top:227PX;width:36PX;height:30PX;'><span class='fc1-5'>อ้างถึง</span></DIV>";
print "<DIV style='left:138PX;top:227PX;width:617PX;height:30PX;'><span class='fc1-5'>รายงานเสนอความต้องการ  $cDepart  ที่  $cDepartno  ลงวันที่  $cDepartdate </span></DIV>";*/

print "<DIV style='left:138PX;top:169PX;width:647PX;height:30PX;'><span class='fc1-5'>ขออนุมัติจัดหายา</span></DIV>";

print "<DIV style='left:167PX;top:263PX;width:617PX;height:30PX;'><span class='fc1-5'>กองเภสัชกรรม รพ.ค่ายฯ ขออนุมัติจัดหายา เพื่อใช้ในการรักษาพยาบาลผู้ป่วยเจ็บที่เข้ามา</span></DIV>";
print "<DIV style='left:88PX;top:292PX;width:696PX;height:30PX;'><span class='fc1-5'>รับการรักษาพยาบาลใน รพ.ค่ายสุรศักดิ์มนตรี จำนวน $nItems รายการ การจัดหาครั้งนี้เป็นไปตามที่ประชุมคณะ</span></DIV>";
print "<DIV style='left:88PX;top:321PX;width:696PX;height:30PX;'><span class='fc1-5'>กรรมการเภสัชกรรมและการบำบัด ดังมีรายการตามสิ่งที่ส่งมาด้วยแล้ว</span></DIV>";
/// ส่วนเนื้อเรื่อง ////


print "<DIV style='left:167PX;top:350PX;width:317PX;height:30PX;'><span class='fc1-5'>จึงเรียนมาเพื่อกรุณาพิจารณา</span></DIV>";
print "<DIV style='left:398PX;top:393PX;width:87PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-5'>$aYot[2]</span></DIV>";
print "<DIV style='left:413PX;top:422PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>($aFname[2])</span></DIV>";
print "<DIV style='left:413PX;top:451PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>$aPost[2] $aPost2[2]</span></DIV>";
//print "<DIV style='left:88PX;top:492PX;width:228PX;height:30PX;'><span class='fc1-5'>เรียน ผอ.รพ.ค่ายสุรศักดิ์มนตรี</span></DIV>";
//print "<DIV style='left:459PX;top:492PX;width:228PX;height:30PX;'><span class='fc1-5'>เรียน ผอ.รพ.ค่ายสุรศักดิ์มนตรี</span></DIV>";
//print "<DIV style='left:97PX;top:563PX;width:43PX;height:30PX;'><span class='fc1-5'>มูลค่า</span></DIV>";
//print "<DIV style='left:88PX;top:592PX;width:313PX;height:30PX;'><span class='fc1-5'>- เห็นควรพิจารณาอนุมัติและจัดหาจากเงินงบรายรับฯ</span></DIV>";
//print "<DIV style='left:470PX;top:592PX;width:238PX;height:30PX;'><span class='fc1-5'>โดยใช้เงินงบรายรับสถานพยาบาล</span></DIV>";
//print "<DIV style='left:459PX;top:534PX;width:324PX;height:30PX;'><span class='fc1-5'>- จนท.งป. รพ.ค่ายฯ ตรวจสอบแล้วมีเงินสนับสนุนได้</span></DIV>";
//print "<DIV style='left:108PX;top:623PX;width:87PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-5'>$aYot[3]</span></DIV>";
//print "<DIV style='left:118PX;top:803PX;width:87PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-5'>$aYot[1]</span></DIV>";
//print "<DIV style='left:450PX;top:623PX;width:87PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-5'>$aYot[5]</span></DIV>";
//print "<DIV style='left:143PX;top:563PX;width:237PX;height:30PX;'><span class='fc1-5'><B>$nPriadvat</B> บาท</span></DIV>";
//print "<DIV style='left:110PX;top:652PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>($aFname[3])</span></DIV>";
//print "<DIV style='left:480PX;top:652PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>($aFname[5])</span></DIV>";
//print "<DIV style='left:110PX;top:681PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>$aPost[3] $aPost2[3]</span></DIV>";
//print "<DIV style='left:109PX;top:832PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>($aFname[1])</span></DIV>";
//print "<DIV style='left:474PX;top:681PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>$aPost[5]</span></DIV>";
//print "<DIV style='left:103PX;top:731PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>............/............/............</span></DIV>";
//print "<DIV style='left:474PX;top:731PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>............../.............../..............</span></DIV>";

/*print "<DIV style='left:88PX;top:534PX;width:292PX;height:30PX;'><span class='fc1-5'>- กองเภสัชกรรมฯ ขออนุมัติจัดหายา</span></DIV>";
print "<DIV style='left:459PX;top:563PX;width:324PX;height:30PX;'><span class='fc1-5'>- เห็นควรอนุมัติจัดหายาตามเสนอ</span></DIV>";*/

/*print "<DIV style='left:138PX;top:769PX;width:55PX;height:30PX;'><span class='fc1-5'>อนุมัติ</span></DIV>";
print "<DIV style='left:109PX;top:890PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>............/............/............</span></DIV>";
print "<DIV style='left:413PX;top:422PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>$aPost[2] $aPost2[2]</span></DIV>";
print "<DIV style='left:109PX;top:861PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>$aPost[1] </span></DIV>";
//print "<DIV style='left:474PX;top:710PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>$aPost2[5]</span></DIV>";
print "<DIV style='left:118PX;top:803PX;width:87PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-5'>$aYot[1]</span></DIV>";
print "<DIV style='left:109PX;top:832PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>($aFname[1])</span></DIV>";*/

print "<DIV style='left:138PX;top:811PX;width:55PX;height:30PX;'><span class='fc1-5'>อนุมัติ</span></DIV>";
print "<DIV style='left:118PX;top:840PX;width:87PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-5'>$aYot[1]</span></DIV>";
print "<DIV style='left:109PX;top:869PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>($aFname[1])</span></DIV>";
print "<DIV style='left:109PX;top:898PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>$aPost[1] </span></DIV>";
print "<DIV style='left:109PX;top:927PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>............/............/............</span></DIV>";



print "<DIV style='left:435PX;top:550PX;width:269PX;height:30PX;'><span class='fc1-5'>เรียน ผอ.รพ.ค่ายสุรศักดิ์มนตรี</span></DIV>";
print "<DIV style='left:472PX;top:579PX;width:269PX;height:30PX;'><span class='fc1-5'>ได้ตรวจสอบงบรายรับสถานพยาบาลแล้วมีเพียงพอ</span></DIV>";
print "<DIV style='left:435PX;top:608PX;width:269PX;height:30PX;'><span class='fc1-5'>ให้การสนับสนุน จำนวนเงิน $nPriadvat บาท</span></DIV>";
print "<DIV style='left:435PX;top:637PX;width:269PX;height:30PX;'><span class='fc1-5'>$cPriadvat</span></DIV>";
print "<DIV style='left:450PX;top:666PX;width:269PX;height:30PX;'><span class='fc1-5'>ร.อ.</span></DIV>";
print "<DIV style='left:435PX;top:695PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>(มนตรีศักดิ์   วงศ์สุวรรณ)</span></DIV>";
print "<DIV style='left:435PX;top:724PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>ปฏิบัติหน้าที่งบประมาณ รพ.ค่ายสุรศักดิ์มนตรี</span></DIV>";
print "<DIV style='left:435PX;top:753PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>............/............/............</span></DIV>";


print "<BR>";
print "</BODY></HTML>";


//////////////////////////////////////////////
///po32.php

print"<HTML>";
print"<script>";
 print"ie4up=nav4up=false;";
 print"var agt = navigator.userAgent.toLowerCase();";
 print"var major = parseInt(navigator.appVersion);";
 print"if ((agt.indexOf('msie') != -1) && (major >= 4))";
 print"ie4up = true;";
 print"if ((agt.indexOf('mozilla') != -1)  && (agt.indexOf('spoofer') == -1) && (agt.indexOf('compatible') == -1) && ( major>= 4))";
 print"nav4up = true;";
print"</script>";
print"<head>";
print"<STYLE>";
 print"A {text-decoration:none}";
 print"A IMG {border-style:none; border-width:0;}";
 print"DIV {position:absolute; z-index:25;}";
print".fc1-0 { COLOR:000000;FONT-SIZE:13PT;FONT-FAMILY:TH SarabunPSK;FONT-WEIGHT:NORMAL;}";
print".fc1-1 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:TH SarabunPSK;FONT-WEIGHT:BOLD;}";
print".fc1-2 { COLOR:000000;FONT-SIZE:11PT;FONT-FAMILY:TH SarabunPSK;FONT-WEIGHT:NORMAL;}";
print".fc1-3 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:TH SarabunPSK;FONT-WEIGHT:NORMAL;}";
print".fc1-4 { COLOR:000000;FONT-SIZE:13PT;FONT-FAMILY:TH SarabunPSK;FONT-WEIGHT:NORMAL;}";
print".ad1-0 {border:0PX none 000000; }";
print".ad1-1 {border-left:0PX none 000000; border-right:0PX none 000000; border-top:1PX dashed 000000; border-bottom:0PX none 000000; }";
print".ad1-2 {border-left:1PX dashed 000000; border-right:0PX none 000000; border-top:0PX none 000000; border-bottom:0PX none 000000; }";
print".ad1-3 {border:1PX dashed 000000; }";
print"</STYLE>";
print"<TITLE>Crystal Report Viewer</TITLE>";
print"</head>";
print"<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";
print"<DIV style='z-index:0'> &nbsp; </div>";

print"<div style='left:310PX;top:1161PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:156PX;'></div>";
print"<div style='left:515PX;top:1161PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:156PX;'></div>";
// ขีด-ด้านล่างหัวข้อ
print"<div style='left:8PX;top:1280PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:804PX;'></div>";
// ขีด-ขวา
print"<div style='left:44PX;top:1210PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:561PX;'><table width='0px' height='555PX'><td>&nbsp;</td></table></div>";
// ขีด-รายการ
print"<div style='left:311PX;top:1210PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:561PX;'><table width='0px' height='555PX'><td>&nbsp;</td></table></div>";
// ขีด-หน่วยนับ
print"<div style='left:365PX;top:1210PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:561PX;'><table width='0px' height='555PX'><td>&nbsp;</td></table></div>";
// ขีด-ขนาดบรรจุ
print"<div style='left:461PX;top:1210PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:561PX;'><table width='0px' height='555PX'><td>&nbsp;</td></table></div>";
// ขีด-จำนวน
print"<div style='left:515PX;top:1210PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:560PX;'><table width='0px' height='554PX'><td>&nbsp;</td></table></div>";
// ขีด-ราคากลาง
print"<div style='left:570PX;top:1210PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:560PX;'><table width='0px' height='554PX'><td>&nbsp;</td></table></div>";
// ขีด-แหล่งที่มาราคากลาง
print"<div style='left:625PX;top:1210PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:560PX;'><table width='0px' height='554PX'><td>&nbsp;</td></table></div>";
// หน่วยละไม่รวม vat
print"<div style='left:689PX;top:1210PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:560PX;'><table width='0px' height='554PX'><td>&nbsp;</td></table></div>";
// เป็นเงินไม่รวม vat
print"<div style='left:750PX;top:1210PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:560PX;'><table width='0px' height='554PX'><td>&nbsp;</td></table></div>";


// print"<div style='left:585PX;top:1210PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:561PX;'><table width='0px' height='555PX'><td>&nbsp;</td></table></div>";
// print"<div style='left:679PX;top:1210PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:560PX;'><table width='0px' height='554PX'><td>&nbsp;</td></table></div>";
// print"<div style='left:8PX;top:1718PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:743PX;'></div>";
// print"<div style='left:124PX;top:1743PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:102PX;'></div>";

// กรอบใหญ่
print"<DIV class='box' style='z-index:10; border-color:000000;border-style:dashed;border-bottom-style:dashed;border-bottom-width:1PX;border-left-style:dashed;border-left-width:1PX;border-top-style:dashed;border-top-width:1PX;border-right-style:dashed;border-right-width:1PX;left:7PX;top:1210PX;width:804PX;height:560PX;'><table border=0 cellpadding=0 cellspacing=0 width=736px height=553px><TD>&nbsp;</TD></TABLE></DIV>";


print"<DIV style='left:518PX;top:1140PX;width:105PX;height:26PX;'><span class='fc1-0'>$cPrepodate</span></DIV>";
print"<DIV style='left:310PX;top:1140PX;width:159PX;height:26PX;'><span class='fc1-0'>$cPrepono</span></DIV>";
print"<DIV style='left:194PX;top:1100PX;width:364PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-1'>บัญชีรายการยาที่ขออนุมัติจัดหา </span></DIV>";
print"<DIV style='left:136PX;top:1140PX;width:175PX;height:26PX;'><span class='fc1-0'>ประกอบรายงานที่ กห 0483.63.4/</span></DIV>";
print"<DIV style='left:474PX;top:1140PX;width:45PX;height:26PX;'><span class='fc1-0'>ลง วันที่</span></DIV>";

// หัวข้อในตาราง
print"<DIV style='left:4PX;top:1233PX;width:38PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>ลำดับ</span></DIV>";
print"<DIV style='left:44PX;top:1233PX;width:258PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>รายการ</span></DIV>";
print"<DIV style='left:313PX;top:1233PX;width:51PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>หน่วยนับ</span></DIV>";
print"<DIV style='left:371PX;top:1233PX;width:85PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>ขนาดบรรจุ</span></DIV>";
print"<DIV style='left:467PX;top:1233PX;width:43PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>จำนวน</span></DIV>";
// ราคากลาง
print"<DIV style='left:515PX;top:1233PX;width:55px;height:27PX;TEXT-ALIGN:CENTER;'>
<span class='fc1-0'>ราคากลาง</span></DIV>";
// แหล่งที่มาของราคากลาง
print"<DIV style='left:570PX;top:1213PX;width:55px;height:27PX;TEXT-ALIGN:CENTER;'>
<span class='fc1-0'>แหล่งที่มาของราคากลาง ***</span></DIV>";

print"<DIV style='left:625PX;top:1223PX;width:61PX;height:23PX;TEXT-ALIGN:CENTER;'>
<span class='fc1-0'>หน่วยละ</span></DIV>";
print"<DIV style='left:625PX;top:1243PX;width:61PX;height:23PX;TEXT-ALIGN:CENTER;'>
<span class='fc1-0'>ไม่รวม VAT</span></DIV>";

print"<DIV style='left:686PX;top:1223PX;width:64PX;height:23PX;TEXT-ALIGN:CENTER;'>
<span class='fc1-0'>เป็นเงิน</span></DIV>";
print"<DIV style='left:686PX;top:1243PX;width:64PX;height:23PX;TEXT-ALIGN:CENTER;'>
<span class='fc1-0'>ไม่รวม VAT</span></DIV>";

print"<DIV style='left:750PX;top:1223PX;width:61PX;height:23PX;TEXT-ALIGN:CENTER;'>
<span class='fc1-0'>spec<br>พบ.ที่</span></DIV>";


///list รายการ
   $x=0;
    $aX   = array("x");
    $aTradname  = array("tradname ");
	$aPacking  = array(" packing");
	$aPack  = array("pack");
	$aAmount  = array(" amount");
    $aPrice   = array(" price");
    $aPackpri  = array(" packpri");
	$aSpecno   = array(" specno");

	$aEdpri = array("edpri");
	$aEdpriFrom = array("edpri_from");

	//$x  $tradname $packing  $pack  $amount  $price  $packpri  $specno 
    $query = "SELECT drugcode,tradname,packing,pack,minimum,totalstk,packpri,amount,price,free,specno FROM poitems WHERE idno = '$nRow_id' ";
    $result = mysql_query($query) or die("Query poitems failed");
    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }
        if(!($row = mysql_fetch_object($result)))
			continue;
		
		$x++;
		$specnum = $row->specno;
		$drugc = $row->drugcode;
		if($specnum==""){
			$query2 = "SELECT spec  from druglst WHERE drugcode = '$drugc' ";
			$result2 = mysql_query($query2);
			list($specnum) = mysql_fetch_array($result2);
		}
		array_push($aX,"$x");
		array_push($aTradname,$row->tradname);
		array_push($aPacking,$row->packing);
		array_push($aPack,$row->pack);
		array_push($aAmount ,$row->amount);
		$price=$row->price;
		$price=number_format($price,2,'.',',');
		array_push($aPrice,$price);
		$packpri=$row->packpri;
		$packpri=number_format($packpri,2,'.',',');
		array_push($aPackpri,$packpri);
		array_push($aSpecno,$specnum);
		
		$sql = "SELECT * FROM druglst WHERE drugcode = '$drugc'";
		$q = mysql_query($sql) or die( mysql_error() );
		$item = mysql_fetch_assoc($q);

		array_push($aEdpri,$item['edpri']);
		array_push($aEdpriFrom,$item['edpri_from']);

	}
	
	$x++;
    array_push($aX,"");
	array_push($aTradname,"------- หมดรายการ -------"); 
    array_push($aPacking,"");
    array_push($aPack,"");
    array_push($aAmount ,"");
    array_push($aPrice,"");
    array_push($aPackpri,"");
    array_push($aSpecno,"");
//มีได้ 12 รายการ+หมดรายการ(13แถว) ใส่ NULL ให้array ที่เหลือดังนี้
for ($n=$x+1; $n<=13; $n++){
    array_push($aX,"");
	array_push($aTradname,""); 
    array_push($aPacking,"");
    array_push($aPack,"");
    array_push($aAmount ,"");
    array_push($aPrice,"");
    array_push($aPackpri,"");
    array_push($aSpecno,"");
}

///แถวที่1
print"<DIV style='left:11PX;top:1289PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[1]</span></DIV>";
print"<DIV style='left:49PX;top:1289PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[1]</span></DIV>";
print"<DIV style='left:306PX;top:1289PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[1]</span></DIV>";
print"<DIV style='left:362PX;top:1289PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
<span class='fc1-4'>$aPack[1]</span></DIV>";
print"<DIV style='left:462PX;top:1289PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
<span class='fc1-4'>$aAmount[1]</span></DIV>";
// ราคากลาง
print"<DIV style='left:515PX;top:1289PX;width:55PX;height:22PX;TEXT-ALIGN:RIGHT;'>
<span class='fc1-4' style='margin-right: 2px;'>$aEdpri[1]</span></DIV>";
// แหล่งที่มาของราคากลาง
$from = ( isset($aEdpri[1]) ) ? ( empty($aEdpri[1]) ? 5 : 3 ) : '' ;
print"<DIV style='left:570PX;top:1289PX;width:55PX;height:22PX;TEXT-ALIGN:RIGHT;'>
<span class='fc1-4' style='margin-right: 2px;'>$from</span></DIV>";

print"<DIV style='left:625PX;top:1289PX;width:61PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[1]</span></DIV>";
print"<DIV style='left:686PX;top:1289PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[1]</span></DIV>";
print"<DIV style='left:750PX;top:1289PX;width:61PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[1]</span></DIV>";

///แถวที่2
print"<DIV style='left:11PX;top:1319PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[2]</span></DIV>";
print"<DIV style='left:49PX;top:1319PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[2]</span></DIV>";
print"<DIV style='left:306PX;top:1319PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[2]</span></DIV>";
print"<DIV style='left:362PX;top:1319PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[2]</span></DIV>";
print"<DIV style='left:462PX;top:1319PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[2]</span></DIV>";
// ราคากลาง
print"<DIV style='left:515PX;top:1319PX;width:55PX;height:22PX;TEXT-ALIGN:RIGHT;'>
<span class='fc1-4' style='margin-right: 2px;'>$aEdpri[2]</span></DIV>";
// แหล่งที่มาของราคากลาง
$from = ( isset($aEdpri[2]) ) ? ( empty($aEdpri[2]) ? 5 : 3 ) : '' ;
print"<DIV style='left:570PX;top:1319PX;width:55PX;height:22PX;TEXT-ALIGN:RIGHT;'>
<span class='fc1-4' style='margin-right: 2px;'>$from</span></DIV>";
print"<DIV style='left:625PX;top:1319PX;width:61PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[2]</span></DIV>";
print"<DIV style='left:686PX;top:1319PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[2]</span></DIV>";
print"<DIV style='left:750PX;top:1319PX;width:61PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[2]</span></DIV>";

///แถวที่3
print"<DIV style='left:11PX;top:1349PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[3]</span></DIV>";
print"<DIV style='left:49PX;top:1349PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[3]</span></DIV>";
print"<DIV style='left:306PX;top:1349PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[3]</span></DIV>";
print"<DIV style='left:362PX;top:1349PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[3]</span></DIV>";
print"<DIV style='left:462PX;top:1349PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[3]</span></DIV>";

// ราคากลาง
print"<DIV style='left:515PX;top:1349PX;width:55PX;height:22PX;TEXT-ALIGN:RIGHT;'>
<span class='fc1-4' style='margin-right: 2px;'>$aEdpri[3]</span></DIV>";
// แหล่งที่มาของราคากลาง
$from = ( isset($aEdpri[3]) ) ? ( empty($aEdpri[3]) ? 5 : 3 ) : '' ;
print"<DIV style='left:570PX;top:1349PX;width:55PX;height:22PX;TEXT-ALIGN:RIGHT;'>
<span class='fc1-4' style='margin-right: 2px;'>$from</span></DIV>";

print"<DIV style='left:625PX;top:1349PX;width:61PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[3]</span></DIV>";
print"<DIV style='left:686PX;top:1349PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[3]</span></DIV>";
print"<DIV style='left:750PX;top:1349PX;width:61PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[3]</span></DIV>";

///แถวที่4
print"<DIV style='left:11PX;top:1379PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[4]</span></DIV>";
print"<DIV style='left:49PX;top:1379PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[4]</span></DIV>";
print"<DIV style='left:306PX;top:1379PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[4]</span></DIV>";
print"<DIV style='left:362PX;top:1379PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[4]</span></DIV>";
print"<DIV style='left:462PX;top:1379PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[4]</span></DIV>";

// ราคากลาง
print"<DIV style='left:515PX;top:1379PX;width:55PX;height:22PX;TEXT-ALIGN:RIGHT;'>
<span class='fc1-4' style='margin-right: 2px;'>$aEdpri[4]</span></DIV>";
// แหล่งที่มาของราคากลาง
$from = ( isset($aEdpri[4]) ) ? ( empty($aEdpri[4]) ? 5 : 3 ) : '' ;
print"<DIV style='left:570PX;top:1379PX;width:55PX;height:22PX;TEXT-ALIGN:RIGHT;'>
<span class='fc1-4' style='margin-right: 2px;'>$from</span></DIV>";

print"<DIV style='left:625PX;top:1379PX;width:61PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[4]</span></DIV>";
print"<DIV style='left:686PX;top:1379PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[4]</span></DIV>";
print"<DIV style='left:750PX;top:1379PX;width:61PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[4]</span></DIV>";

///แถวที่5
print"<DIV style='left:11PX;top:1409PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[5]</span></DIV>";
print"<DIV style='left:76PX;top:1409PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[5]</span></DIV>";
print"<DIV style='left:306PX;top:1409PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[5]</span></DIV>";
print"<DIV style='left:362PX;top:1409PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[5]</span></DIV>";
print"<DIV style='left:462PX;top:1409PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[5]</span></DIV>";

// ราคากลาง
print"<DIV style='left:515PX;top:1409PX;width:55PX;height:22PX;TEXT-ALIGN:RIGHT;'>
<span class='fc1-4' style='margin-right: 2px;'>$aEdpri[5]</span></DIV>";
// แหล่งที่มาของราคากลาง
$from = ( isset($aEdpri[5]) ) ? ( empty($aEdpri[5]) ? 5 : 3 ) : '' ;
print"<DIV style='left:570PX;top:1409PX;width:55PX;height:22PX;TEXT-ALIGN:RIGHT;'>
<span class='fc1-4' style='margin-right: 2px;'>$from</span></DIV>";

print"<DIV style='left:625PX;top:1409PX;width:61PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[5]</span></DIV>";
print"<DIV style='left:686PX;top:1409PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[5]</span></DIV>";
print"<DIV style='left:750PX;top:1409PX;width:61PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[5]</span></DIV>";

///แถวที่6
print"<DIV style='left:11PX;top:1439PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[6]</span></DIV>";
print"<DIV style='left:76PX;top:1439PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[6]</span></DIV>";
print"<DIV style='left:306PX;top:1439PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[6]</span></DIV>";
print"<DIV style='left:362PX;top:1439PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[6]</span></DIV>";
print"<DIV style='left:462PX;top:1439PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[6]</span></DIV>";

// ราคากลาง
print"<DIV style='left:515PX;top:1409PX;width:55PX;height:22PX;TEXT-ALIGN:RIGHT;'>
<span class='fc1-4' style='margin-right: 2px;'>$aEdpri[6]</span></DIV>";
// แหล่งที่มาของราคากลาง
$from = ( isset($aEdpri[6]) ) ? ( empty($aEdpri[6]) ? 5 : 3 ) : '' ;
print"<DIV style='left:570PX;top:1409PX;width:55PX;height:22PX;TEXT-ALIGN:RIGHT;'>
<span class='fc1-4' style='margin-right: 2px;'>$from</span></DIV>";

print"<DIV style='left:625PX;top:1439PX;width:61PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[6]</span></DIV>";
print"<DIV style='left:686PX;top:1439PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[6]</span></DIV>";
print"<DIV style='left:750PX;top:1439PX;width:61PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[6]</span></DIV>";

///แถวที่7
print"<DIV style='left:11PX;top:1469PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[7]</span></DIV>";
print"<DIV style='left:49PX;top:1469PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[7]</span></DIV>";
print"<DIV style='left:306PX;top:1469PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[7]</span></DIV>";
print"<DIV style='left:362PX;top:1469PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[7]</span></DIV>";
print"<DIV style='left:462PX;top:1469PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[7]</span></DIV>";

// ราคากลาง
print"<DIV style='left:515PX;top:1469PX;width:55PX;height:22PX;TEXT-ALIGN:RIGHT;'>
<span class='fc1-4' style='margin-right: 2px;'>$aEdpri[6]</span></DIV>";
// แหล่งที่มาของราคากลาง
$from = ( isset($aEdpri[6]) ) ? ( empty($aEdpri[7]) ? 5 : 3 ) : '' ;
print"<DIV style='left:570PX;top:1469PX;width:55PX;height:22PX;TEXT-ALIGN:RIGHT;'>
<span class='fc1-4' style='margin-right: 2px;'>$from</span></DIV>";

print"<DIV style='left:625PX;top:1469PX;width:61PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[7]</span></DIV>";
print"<DIV style='left:686PX;top:1469PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[7]</span></DIV>";
print"<DIV style='left:750PX;top:1469PX;width:61PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[7]</span></DIV>";

///แถวที่8
print"<DIV style='left:11PX;top:1499PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[8]</span></DIV>";
print"<DIV style='left:49PX;top:1499PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[8]</span></DIV>";
print"<DIV style='left:306PX;top:1499PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[8]</span></DIV>";
print"<DIV style='left:362PX;top:1499PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[8]</span></DIV>";
print"<DIV style='left:462PX;top:1499PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[8]</span></DIV>";

// ราคากลาง
print"<DIV style='left:515PX;top:1499PX;width:55PX;height:22PX;TEXT-ALIGN:RIGHT;'>
<span class='fc1-4' style='margin-right: 2px;'>$aEdpri[7]</span></DIV>";
// แหล่งที่มาของราคากลาง
$from = ( isset($aEdpri[7]) ) ? ( empty($aEdpri[8]) ? 5 : 3 ) : '' ;
print"<DIV style='left:570PX;top:1499PX;width:55PX;height:22PX;TEXT-ALIGN:RIGHT;'>
<span class='fc1-4' style='margin-right: 2px;'>$from</span></DIV>";

print"<DIV style='left:625PX;top:1499PX;width:61PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[8]</span></DIV>";
print"<DIV style='left:686PX;top:1499PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[8]</span></DIV>";
print"<DIV style='left:750PX;top:1499PX;width:61PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[8]</span></DIV>";
	
///แถวที่9
print"<DIV style='left:11PX;top:1529PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[9]</span></DIV>";
print"<DIV style='left:49PX;top:1529PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[9]</span></DIV>";
print"<DIV style='left:306PX;top:1529PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[9]</span></DIV>";
print"<DIV style='left:362PX;top:1529PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[9]</span></DIV>";
print"<DIV style='left:462PX;top:1529PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[9]</span></DIV>";

// ราคากลาง
print"<DIV style='left:515PX;top:1529PX;width:55PX;height:22PX;TEXT-ALIGN:RIGHT;'>
<span class='fc1-4' style='margin-right: 2px;'>$aEdpri[9]</span></DIV>";
// แหล่งที่มาของราคากลาง
$from = ( isset($aEdpri[9]) ) ? ( empty($aEdpri[9]) ? 5 : 3 ) : '' ;
print"<DIV style='left:570PX;top:1529PX;width:55PX;height:22PX;TEXT-ALIGN:RIGHT;'>
<span class='fc1-4' style='margin-right: 2px;'>$from</span></DIV>";

print"<DIV style='left:625PX;top:1529PX;width:61PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[9]</span></DIV>";
print"<DIV style='left:686PX;top:1529PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[9]</span></DIV>";
print"<DIV style='left:750PX;top:1529PX;width:61PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[9]</span></DIV>";
	
///แถวที่10
print"<DIV style='left:11PX;top:1559PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[10]</span></DIV>";
print"<DIV style='left:49PX;top:1559PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[10]</span></DIV>";
print"<DIV style='left:306PX;top:1559PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[10]</span></DIV>";
print"<DIV style='left:362PX;top:1559PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[10]</span></DIV>";
print"<DIV style='left:462PX;top:1559PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[10]</span></DIV>";

// ราคากลาง
print"<DIV style='left:515PX;top:1559PX;width:55PX;height:22PX;TEXT-ALIGN:RIGHT;'>
<span class='fc1-4' style='margin-right: 2px;'>$aEdpri[10]</span></DIV>";
// แหล่งที่มาของราคากลาง
$from = ( isset($aEdpri[10]) ) ? ( empty($aEdpri[10]) ? 5 : 3 ) : '' ;
print"<DIV style='left:570PX;top:1559PX;width:55PX;height:22PX;TEXT-ALIGN:RIGHT;'>
<span class='fc1-4' style='margin-right: 2px;'>$from</span></DIV>";

print"<DIV style='left:625PX;top:1559PX;width:61PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[10]</span></DIV>";
print"<DIV style='left:686PX;top:1559PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[10]</span></DIV>";
print"<DIV style='left:750PX;top:1559PX;width:61PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[10]</span></DIV>";

///แถวที่11
print"<DIV style='left:11PX;top:1589PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[11]</span></DIV>";
print"<DIV style='left:49PX;top:1589PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[11]</span></DIV>";
print"<DIV style='left:306PX;top:1589PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[11]</span></DIV>";
print"<DIV style='left:362PX;top:1589PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[11]</span></DIV>";
print"<DIV style='left:462PX;top:1589PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[11]</span></DIV>";

// ราคากลาง
print"<DIV style='left:515PX;top:1589PX;width:55PX;height:22PX;TEXT-ALIGN:RIGHT;'>
<span class='fc1-4' style='margin-right: 2px;'>$aEdpri[11]</span></DIV>";
// แหล่งที่มาของราคากลาง
$from = ( isset($aEdpri[11]) ) ? ( empty($aEdpri[11]) ? 5 : 3 ) : '' ;
print"<DIV style='left:570PX;top:1589PX;width:55PX;height:22PX;TEXT-ALIGN:RIGHT;'>
<span class='fc1-4' style='margin-right: 2px;'>$from</span></DIV>";

print"<DIV style='left:625PX;top:1589PX;width:61PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[11]</span></DIV>";
print"<DIV style='left:686PX;top:1589PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[11]</span></DIV>";
print"<DIV style='left:750PX;top:1589PX;width:61PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[11]</span></DIV>";

///แถวที่12
print"<DIV style='left:11PX;top:1619PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[12]</span></DIV>";
print"<DIV style='left:49PX;top:1619PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[12]</span></DIV>";
print"<DIV style='left:306PX;top:1619PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[12]</span></DIV>";
print"<DIV style='left:362PX;top:1619PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[12]</span></DIV>";
print"<DIV style='left:462PX;top:1619PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[12]</span></DIV>";

// ราคากลาง
print"<DIV style='left:515PX;top:1619PX;width:55PX;height:22PX;TEXT-ALIGN:RIGHT;'>
<span class='fc1-4' style='margin-right: 2px;'>$aEdpri[12]</span></DIV>";
// แหล่งที่มาของราคากลาง
$from = ( isset($aEdpri[12]) ) ? ( empty($aEdpri[12]) ? 5 : 3 ) : '' ;
print"<DIV style='left:570PX;top:1619PX;width:55PX;height:22PX;TEXT-ALIGN:RIGHT;'>
<span class='fc1-4' style='margin-right: 2px;'>$from</span></DIV>";

print"<DIV style='left:625PX;top:1619PX;width:61PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[12]</span></DIV>";
print"<DIV style='left:686PX;top:1619PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[12]</span></DIV>";
print"<DIV style='left:750PX;top:1619PX;width:61PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[12]</span></DIV>";

// ///แถวที่13
print"<DIV style='left:11PX;top:1649PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[13]</span></DIV>";
print"<DIV style='left:49PX;top:1649PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[13]</span></DIV>";
print"<DIV style='left:306PX;top:1649PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[13]</span></DIV>";
print"<DIV style='left:362PX;top:1649PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[13]</span></DIV>";
print"<DIV style='left:462PX;top:1649PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[13]</span></DIV>";

// ราคากลาง
print"<DIV style='left:515PX;top:1649PX;width:55PX;height:22PX;TEXT-ALIGN:RIGHT;'>
<span class='fc1-4' style='margin-right: 2px;'>$aEdpri[13]</span></DIV>";
// แหล่งที่มาของราคากลาง
$from = ( isset($aEdpri[13]) ) ? ( empty($aEdpri[13]) ? 5 : 3 ) : '' ;
print"<DIV style='left:570PX;top:1649PX;width:55PX;height:22PX;TEXT-ALIGN:RIGHT;'>
<span class='fc1-4' style='margin-right: 2px;'>$from</span></DIV>";

print"<DIV style='left:625PX;top:1649PX;width:61PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[13]</span></DIV>";
print"<DIV style='left:686PX;top:1649PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[13]</span></DIV>";
print"<DIV style='left:750PX;top:1649PX;width:61PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[13]</span></DIV>";
/////////

// รวมเงิน-ซ้าย
print"<DIV style='left:45PX;top:1741PX;width:25PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>รวม</span></DIV>";
print"<DIV style='left:50PX;top:1741PX;width:93PX;height:26PX;TEXT-ALIGN:CENTER;'>";
print"<span class='fc1-0'>$nItems</span></DIV>";
print"<DIV style='left:140PX;top:1741PX;width:44PX;height:27PX;'><span class='fc1-0'>รายการ</span></DIV>";

print"<DIV style='left:417PX;top:1798PX;width:81PX;height:27PX;'><span class='fc1-0'>ตรวจถูกต้อง</span></DIV>";
print"<DIV style='left:441PX;top:1824PX;width:87PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>$aYot[2]</span></DIV>";
print"<DIV style='left:446PX;top:1853PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>($aFname[2])</span></DIV>";

//print"<DIV style='left:486PX;top:1830PX;width:249PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>..........................................................................</span></DIV>";

// รวมเงิน
print"<DIV style='left:625PX;top:1703PX;width:64PX;height:19px;TEXT-ALIGN:left;border-bottom:1px solid black;'><span class='fc1-0'>รวมเงิน</span></DIV>";
print"<DIV style='left:690PX;top:1703PX;width:61PX;height:19px;TEXT-ALIGN:RIGHT;border-bottom:1px solid black;'><span  class='fc1-0'>$nNetprice</span></DIV>";

print"<DIV style='left:625PX;top:1723PX;width:64PX;height:19px;TEXT-ALIGN:left;border-bottom:1px solid black;'><span class='fc1-0'>ภาษี 7.00 %</span></DIV>";
print"<DIV style='left:690PX;top:1723PX;width:61PX;height:19px;TEXT-ALIGN:RIGHT;border-bottom:1px solid black;'>
<span class='fc1-0'>$nVat</span></DIV>";

// สุทธิ
print"<DIV style='left:625PX;top:1743PX;width:64PX;height:19px;border-bottom:1px solid black;'><span class='fc1-0'>รวมสุทธิ</span></DIV>";
print"<DIV style='left:690PX;top:1743PX;width:61PX;height:19px;TEXT-ALIGN:RIGHT;border-bottom:1px solid black;'>
	<span class='fc1-0'><B>$nPriadvat</B></span></DIV>";

print"<DIV style='left:446PX;top:1882PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost[2] $aPost2[2]</span></DIV>";
print"<BR>";

$edpri_from_list = array(
    1 => '(๑) ราคาที่ได้มาจากการคำนวณตามหลักเกณฑ์ที่คณะกรรมการราคากลางกำหนด',
    2 => '(๒) ราคาที่ได้มาจากฐานข้อมูลราคาอ้างอิงของพัสดุที่กรมบัญชีกลางจัดทำ',
    3 => '(๓) ราคามาตรฐานที่สำนักงบประมาณหรือหน่วยงานกลางอื่นกำหนด<br>(ราคามาตรฐานเวชภัณฑ์ที่มิใช่ยา ที่ สธ 0228.07.2/ว688 ลง วันที่ 6 สิงหาคม พ.ศ.2556)<br>(ประเภทและอัตราค่าอวัยวะเทียมและอุปกรณ์ในการบำบัดรักษาโรค ที่ กค 0422.2/พิเศษ ว 1 ลงวันที่ 4 ธันวาคม 2556)',
    4 => '(๔) ราคาที่ได้มาจากการสืบราคาจากท้องตลาด',
    5 => '(๕) ราคาที่เคขซื้อหรือจ้างครั้งหลังสุดภายในระยะเวลาสองปีงบประมาณ',
    6 => '(๖) ราคาอื่นใดตามหลักเกณฑ์ วิธีการ หรือแนวทางปฏิบัติของหน่วยงานของรัฐนั้นๆ',
);

?>
<style>
div{
	font-family:TH SarabunPSK;
	font-size: 18px;
}
</style>
<div style="top:1800px;">รวมราคาประมาณการอนุมัติ เพื่อดำเนินการจัดซื้อในคราวนี้ <?=$nItems;?> รายการ</div>
<div style="top:1819px;">จำนวนเงิน <?=$nPriadvat;?> บาท (สี่หมื่น000000 บาทถ้วน)</div>
<div style="top:1838px;">*** หมายเหตุ</div>

<div style="top:1857px;">
	<div>แหล่งที่มาของราคากลาง</div><br>
	<?php
	foreach ($edpri_from_list as $key => $value) {
		echo $value."<br>";
	}
	?>
</div>
<?php
print"</BODY>";
print"</HTML>";

////po33.php

print"<HTML>";
print"<script>";
 print"ie4up=nav4up=false;";
print" var agt = navigator.userAgent.toLowerCase();";
 print"var major = parseInt(navigator.appVersion);";
print" if ((agt.indexOf('msie') != -1) && (major >= 4))";
 print"  ie4up = true;";
print" if ((agt.indexOf('mozilla') != -1)  && (agt.indexOf('spoofer') == -1) && (agt.indexOf('compatible') == -1) && ( major>= 4))";
  print" nav4up = true;";
print"</script>";

print "<head>";
print"<STYLE>";
 print"A {text-decoration:none}";
 print"A IMG {border-style:none; border-width:0;}";
 print"DIV {position:absolute; z-index:25;}";
print".fc1-0 { COLOR:000000;FONT-SIZE:13PT;FONT-FAMILY:TH SarabunPSK;FONT-WEIGHT:NORMAL;}";
print".fc1-1 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:TH SarabunPSK;FONT-WEIGHT:BOLD;}";
print".fc1-2 { COLOR:000000;FONT-SIZE:23PT;FONT-FAMILY:TH SarabunPSK;FONT-WEIGHT:BOLD;}";
print".fc1-3 { COLOR:000000;FONT-SIZE:19PT;FONT-FAMILY:TH SarabunPSK;FONT-WEIGHT:BOLD;}";
print".fc1-4 { COLOR:000000;FONT-SIZE:14PT;FONT-FAMILY:TH SarabunPSK;FONT-WEIGHT:NORMAL;}";
print".fc1-5 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:TH SarabunPSK;FONT-WEIGHT:NORMAL;}";
print".ad1-0 {border:0PX none 000000; }";
print".ad1-1 {border-left:0PX none 000000; border-right:0PX none 000000; border-top:1PX dashed 000000; border-bottom:0PX none 000000; }";
print".ad1-2 {border-left:1PX dashed 000000; border-right:0PX none 000000; border-top:0PX none 000000; border-bottom:0PX none 000000; }";
print".ad1-3 {border:1PX dashed 000000; }";
print"</STYLE>";
print"<TITLE>Crystal Report Viewer</TITLE>";
print "</head>";

print"<BODY BGCOLOR='FFFFFF'LEFTMARGIN=0 TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0>";
print"<DIV style='z-index:0'> &nbsp; </div>";
print"<div style='left:310PX;top:2216PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:156PX;'></div>";
print"<divstyle='left:515PX;top:2216PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:156PX;'></div>";
print"<div style='left:8PX;top:2280PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:743PX;'></div>";
print"<div style='left:44PX;top:2251PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:560PX;'><table width='0px' height='554PX'><td>&nbsp;</td></table></div>";
print"<div style='left:311PX;top:2251PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:560PX;'><table width='0px' height='554PX'><td>&nbsp;</td></table></div>";
print"<div style='left:365PX;top:2251PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:560PX;'><table width='0px' height='554PX'><td>&nbsp;</td></table></div>";
print"<div style='left:461PX;top:2251PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:560PX;'><table width='0px' height='554PX'><td>&nbsp;</td></table></div>";
print"<div style='left:515PX;top:2251PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:559PX;'><table width='0px' height='553PX'><td>&nbsp;</td></table></div>";
print"<div style='left:585PX;top:2251PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:560PX;'><table width='0px' height='554PX'><td>&nbsp;</td></table></div>";
print"<div style='left:679PX;top:2251PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:559PX;'><table width='0px' height='553PX'><td>&nbsp;</td></table></div>";

print"<div style='left:187PX;top:2243PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:399PX;'></div>";
print"<div style='left:8PX;top:2758PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:743PX;'></div>";
print"<div style='left:124PX;top:2783PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:102PX;'></div>";
//print"<div style='left:362PX;top:2924PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:234PX;'></div>";

print"<DIV class='box' style='z-index:10; border-color:000000;border-style:dashed;border-bottom-style:dashed;border-bottom-width:1PX;border-left-style:dashed;border-left-width:1PX;border-top-style:dashed;border-top-width:1PX;border-right-style:dashed;border-right-width:1PX;left:7PX;top:2251PX;width:743PX;height:559PX;'>
<table border=0 cellpadding=0 cellspacing=0 width=736px height=552px><TD>&nbsp;</TD></TABLE>
</DIV>";
print"<DIV class='box' style='z-index:10; border-color:000000;border-style:dashed;border-bottom-style:dashed;border-bottom-width:1PX;border-left-style:dashed;border-left-width:1PX;border-top-style:dashed;border-top-width:1PX;border-right-style:dashed;border-right-width:1PX;left:44PX;top:2819PX;width:181PX;height:45PX;'>
<table border=0 cellpadding=0 cellspacing=0 width=174px height=38px><TD>&nbsp;</TD></TABLE>
</DIV>";
print"<DIV style='left:518PX;top:2195PX;width:105PX;height:26PX;'><span class='fc1-0'>$cPrepodate</span></DIV>";
//print"<DIV style='left:310PX;top:2195PX;width:159PX;height:26PX;'><span class='fc1-0'>$cPrepono</span></DIV>";  //เก่า
print"<DIV style='left:310PX;top:2195PX;width:159PX;height:26PX;'><span class='fc1-0'>กห 0483.63.4/$cPrepono</span></DIV>";
print"<DIV style='left:194PX;top:2090PX;width:364PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-1'>ใบสั่งซื้อยาและเวชภัณฑ์สิ้นเปลือง</span></DIV>";
print"<DIV style='left:281PX;top:2195PX;width:30PX;height:26PX;'><span class='fc1-0'>เลขที่</span></DIV>";
print"<DIV style='left:490PX;top:2195PX;width:29PX;height:26PX;'><span class='fc1-0'>วันที่</span></DIV>";
print"<DIV style='left:7PX;top:2253PX;width:38PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>ลำดับ</span></DIV>";
print"<DIV style='left:49PX;top:2253PX;width:258PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>รายการ</span></DIV>";
print"<DIV style='left:313PX;top:2253PX;width:51PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>หน่วยนับ</span></DIV>";
print"<DIV style='left:371PX;top:2253PX;width:85PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>ขนาดบรรจุ</span></DIV>";
print"<DIV style='left:467PX;top:2253PX;width:43PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>จำนวน</span></DIV>";
print"<DIV style='left:520PX;top:2248PX;width:61PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>หน่วยละ</span></DIV>";
print"<DIV style='left:590PX;top:2248PX;width:85PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>เป็นเงิน</span></DIV>";
print"<DIV style='left:684PX;top:2253PX;width:61PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>spec.</span></DIV>";
print"<DIV style='left:194PX;top:2120PX;width:364PX;height:41PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>โรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง</span></DIV>";
print"<DIV style='left:194PX;top:2163PX;width:364PX;height:34PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>มทบ.32</span></DIV>";
print"<DIV style='left:187PX;top:2222PX;width:397PX;height:26PX;'><span class='fc1-0'>
	($cComcode)$cComname&nbsp;&nbsp;&nbsp;$fax</span></DIV>";
print"<DIV style='left:97PX;top:2222PX;width:91PX;height:26PX;'><span class='fc1-0'>ขอสั่งซื้อของจาก</span></DIV>
";
print"<DIV style='left:586PX;top:2222PX;width:104PX;height:26PX;'><span class='fc1-0'>ดังมีรายการต่อไปนี้</span></DIV>";
print"<DIV style='left:684PX;top:2167PX;width:61PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>งบรายรับ</span></DIV>";
print"<DIV style='left:518PX;top:2262PX;width:64PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>ไม่รวม VAT</span></DIV>";
print"<DIV style='left:600PX;top:2262PX;width:64PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>ไม่รวม VAT</span></DIV>";


///แถวที่1
print"<DIV style='left:11PX;top:2289PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[1]</span></DIV>";
print"<DIV style='left:49PX;top:2289PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[1]</span></DIV>";
print"<DIV style='left:306PX;top:2289PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[1]</span></DIV>";
print"<DIV style='left:362PX;top:2289PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[1]</span></DIV>";
print"<DIV style='left:462PX;top:2289PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[1]</span></DIV>";
print"<DIV style='left:597PX;top:2289PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[1]</span></DIV>";
print"<DIV style='left:679PX;top:2289PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[1]</span></DIV>";
print"<DIV style='left:519PX;top:2289PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[1]</span></DIV>";
///แถวที่2
print"<DIV style='left:11PX;top:2319PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[2]</span></DIV>";
print"<DIV style='left:49PX;top:2319PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[2]</span></DIV>";
print"<DIV style='left:306PX;top:2319PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[2]</span></DIV>";
print"<DIV style='left:362PX;top:2319PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[2]</span></DIV>";
print"<DIV style='left:462PX;top:2319PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[2]</span></DIV>";
print"<DIV style='left:597PX;top:2319PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[2]</span></DIV>";
print"<DIV style='left:679PX;top:2319PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[2]</span></DIV>";
print"<DIV style='left:519PX;top:2319PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[2]</span></DIV>";
///แถวที่3
print"<DIV style='left:11PX;top:2349PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[3]</span></DIV>";
print"<DIV style='left:49PX;top:2349PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[3]</span></DIV>";
print"<DIV style='left:306PX;top:2349PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[3]</span></DIV>";
print"<DIV style='left:362PX;top:2349PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[3]</span></DIV>";
print"<DIV style='left:462PX;top:2349PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[3]</span></DIV>";
print"<DIV style='left:597PX;top:2349PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[3]</span></DIV>";
print"<DIV style='left:679PX;top:2349PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[3]</span></DIV>";
print"<DIV style='left:519PX;top:2349PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[3]</span></DIV>";
///แถวที่4
print"<DIV style='left:11PX;top:2379PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[4]</span></DIV>";
print"<DIV style='left:49PX;top:2379PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[4]</span></DIV>";
print"<DIV style='left:306PX;top:2379PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[4]</span></DIV>";
print"<DIV style='left:362PX;top:2379PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[4]</span></DIV>";
print"<DIV style='left:462PX;top:2379PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[4]</span></DIV>";
print"<DIV style='left:597PX;top:2379PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[4]</span></DIV>";
print"<DIV style='left:679PX;top:2379PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[4]</span></DIV>";
print"<DIV style='left:519PX;top:2379PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[4]</span></DIV>";
///แถวที่5
print"<DIV style='left:11PX;top:2409PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[5]</span></DIV>";
print"<DIV style='left:49PX;top:2409PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[5]</span></DIV>";
print"<DIV style='left:306PX;top:2409PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[5]</span></DIV>";
print"<DIV style='left:362PX;top:2409PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[5]</span></DIV>";
print"<DIV style='left:462PX;top:2409PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[5]</span></DIV>";
print"<DIV style='left:597PX;top:2409PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[5]</span></DIV>";
print"<DIV style='left:679PX;top:2409PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[5]</span></DIV>";
print"<DIV style='left:519PX;top:2409PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[5]</span></DIV>";
///แถวที่6
print"<DIV style='left:11PX;top:2439PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[6]</span></DIV>";
print"<DIV style='left:49PX;top:2439PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[6]</span></DIV>";
print"<DIV style='left:306PX;top:2439PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[6]</span></DIV>";
print"<DIV style='left:362PX;top:2439PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[6]</span></DIV>";
print"<DIV style='left:462PX;top:2439PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[6]</span></DIV>";
print"<DIV style='left:597PX;top:2439PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[6]</span></DIV>";
print"<DIV style='left:679PX;top:2439PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[6]</span></DIV>";
print"<DIV style='left:519PX;top:2439PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[6]</span></DIV>";
///แถวที่7
print"<DIV style='left:11PX;top:2469PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[7]</span></DIV>";
print"<DIV style='left:49PX;top:2469PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[7]</span></DIV>";
print"<DIV style='left:306PX;top:2469PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[7]</span></DIV>";
print"<DIV style='left:362PX;top:2469PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[7]</span></DIV>";
print"<DIV style='left:462PX;top:2469PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[7]</span></DIV>";
print"<DIV style='left:597PX;top:2469PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[7]</span></DIV>";
print"<DIV style='left:679PX;top:2469PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[7]</span></DIV>";
print"<DIV style='left:519PX;top:2469PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[7]</span></DIV>";
	
///แถวที่8
print"<DIV style='left:11PX;top:2499PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[8]</span></DIV>";
print"<DIV style='left:49PX;top:2499PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[8]</span></DIV>";
print"<DIV style='left:306PX;top:2499PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[8]</span></DIV>";
print"<DIV style='left:362PX;top:2499PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[8]</span></DIV>";
print"<DIV style='left:462PX;top:2499PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[8]</span></DIV>";
print"<DIV style='left:597PX;top:2499PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[8]</span></DIV>";
print"<DIV style='left:679PX;top:2499PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[8]</span></DIV>";
print"<DIV style='left:519PX;top:2499PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[8]</span></DIV>";
	
///แถวที่9
print"<DIV style='left:11PX;top:2529PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[9]</span></DIV>";
print"<DIV style='left:49PX;top:2529PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[9]</span></DIV>";
print"<DIV style='left:306PX;top:2529PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[9]</span></DIV>";
print"<DIV style='left:362PX;top:2529PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[9]</span></DIV>";
print"<DIV style='left:462PX;top:2529PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[9]</span></DIV>";
print"<DIV style='left:597PX;top:2529PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[9]</span></DIV>";
print"<DIV style='left:679PX;top:2529PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[9]</span></DIV>";
print"<DIV style='left:519PX;top:2529PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[9]</span></DIV>";
	
///แถวที่10
print"<DIV style='left:11PX;top:2559PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[10]</span></DIV>";
print"<DIV style='left:49PX;top:2559PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[10]</span></DIV>";
print"<DIV style='left:306PX;top:2559PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[10]</span></DIV>";
print"<DIV style='left:362PX;top:2559PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[10]</span></DIV>";
print"<DIV style='left:462PX;top:2559PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[10]</span></DIV>";
print"<DIV style='left:597PX;top:2559PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[10]</span></DIV>";
print"<DIV style='left:679PX;top:2559PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[10]</span></DIV>";
print"<DIV style='left:519PX;top:2559PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[10]</span></DIV>";
	
///แถวที่11
print"<DIV style='left:11PX;top:2589PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[11]</span></DIV>";
print"<DIV style='left:49PX;top:2589PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[11]</span></DIV>";
print"<DIV style='left:306PX;top:2589PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[11]</span></DIV>";
print"<DIV style='left:362PX;top:2589PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[11]</span></DIV>";
print"<DIV style='left:462PX;top:2589PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[11]</span></DIV>";
print"<DIV style='left:597PX;top:2589PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[11]</span></DIV>";
print"<DIV style='left:679PX;top:2589PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[11]</span></DIV>";
print"<DIV style='left:519PX;top:2589PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[11]</span></DIV>";
	
///แถวที่12
print"<DIV style='left:11PX;top:2619PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[12]</span></DIV>";
print"<DIV style='left:49PX;top:2619PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[12]</span></DIV>";
print"<DIV style='left:306PX;top:2619PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[12]</span></DIV>";
print"<DIV style='left:362PX;top:2619PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[12]</span></DIV>";
print"<DIV style='left:462PX;top:2619PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[12]</span></DIV>";
print"<DIV style='left:597PX;top:2619PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[12]</span></DIV>";
print"<DIV style='left:679PX;top:2619PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[12]</span></DIV>";
print"<DIV style='left:519PX;top:2619PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[12]</span></DIV>";
	
///แถวที่13
print"<DIV style='left:11PX;top:2649PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[13]</span></DIV>";
print"<DIV style='left:49PX;top:2649PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[13]</span></DIV>";
print"<DIV style='left:306PX;top:2649PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[13]</span></DIV>";
print"<DIV style='left:362PX;top:2649PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[13]</span></DIV>";
print"<DIV style='left:462PX;top:2649PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[13]</span></DIV>";
print"<DIV style='left:597PX;top:2649PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[13]</span></DIV>";
print"<DIV style='left:679PX;top:2649PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[13]</span></DIV>";
print"<DIV style='left:519PX;top:2649PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[13]</span></DIV>";
/////////
//print"<DIV style='left:79PX;top:278PX;width:159PX;height:22PX;'><span class='fc1-4'>----------&nbsp;&nbsp;หมดรายการ&nbsp;&nbsp;----------</span></DIV>";
print"<DIV style='left:128PX;top:2761PX;width:93PX;height:26PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-0'>$nItems</span></DIV>";
print"<DIV style='left:99PX;top:2761PX;width:25PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>รวม</span></DIV>";
print"<DIV style='left:225PX;top:2761PX;width:44PX;height:27PX;'><span class='fc1-0'>รายการ</span></DIV>";
//print"<DIV style='left:105PX;top:2993PX;width:542PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>(แผนกส่งกำลังและบริการ เอกสารหมายเลข FR-LGT-007/5&nbsp;&nbsp;แก้ไขครั้งที่ 00 วันที่มีผลบังคับใช้ 9 มี.ค. 43)</span></DIV>";
print"<DIV style='left:330PX;top:2899PX;width:87PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-5'>$aYot[2]</span></DIV>";
print"<DIV style='left:344PX;top:2922PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>($aFname[2])</span></DIV>";
print"<DIV style='left:496PX;top:2730PX;width:86PX;height:26PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>ภาษี 7.00 %</span></DIV>";
print"<DIV style='left:538PX;top:2763PX;width:44PX;height:27PX;'><span class='fc1-0'>รวมสุทธิ</span></DIV>";
print"<DIV style='left:496PX;top:2702PX;width:86PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>รวมเงิน</span></DIV>";
print"<DIV style='left:360PX;top:2816PX;width:263PX;height:27PX;'><span class='fc1-0'>ส่งของภายใน 5 วัน นับจากวันที่ที่ลงในใบสั่งซื้อ</span></DIV>";
print"<DIV style='left:360PX;top:2842PX;width:319PX;height:27PX;'><span class='fc1-0'>ถ้าไม่สามารถส่งของได้ตามกำหนด ให้ติดต่อกลับภายใน 5 วัน</span></DIV>";
print"<DIV style='left:360PX;top:2868PX;width:263PX;height:27PX;'><span class='fc1-0'>โทรศัพท์ 054-839305 ต่อ 1163    FAX. 054-839314</span></DIV>";
print"<DIV style='left:10PX;top:2951PX;width:209PX;height:27PX;'><span class='fc1-0'>บริษัท&nbsp;&nbsp;.....................................................</span></DIV>";
print"<DIV style='left:10PX;top:2925PX;width:209PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>(…………………………………….)</span></DIV>";
print"<DIV style='left:10PX;top:2889PX;width:209PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>……………………………………...........</span></DIV>";
print"<DIV style='left:10PX;top:2873PX;width:209PX;height:27PX;'><span class='fc1-0'>ได้รับใบสั่งซื้อไปแล้ว</span></DIV>";
print"<DIV style='left:76PX;top:2819PX;width:128PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>ขอเอกสารใบส่งของ 7 ชุด</span></DIV>";
print"<DIV style='left:76PX;top:2840PX;width:128PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>ใบกำกับภาษี 1 ชุด</span></DIV>";
print"<DIV style='left:597PX;top:2703PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-0'>$nNetprice</span></DIV>";
print"<DIV style='left:597PX;top:2730PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-0'>$nVat</span></DIV>";
print"<DIV style='left:597PX;top:2763PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-0'><B>$nPriadvat</B></span></DIV>";
print"<DIV style='left:10PX;top:3019PX;width:479PX;height:27PX;'><span class='f1'><u>หมายเหตุ : ให้ลงวันที่ในใบส่งของและใบเสร็จรับเงิน หลังวันที่ใน PO ยกเว้นวันเสาร์ - อาทิตย์</u></span></DIV>";
print"<DIV style='left:344PX;top:2942PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>$aPost[2]</span></DIV>";
print"<DIV style='left:344PX;top:2961PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>$aPost2[2]</span></DIV>";
print"<BR>";
print"</BODY>";
print"</HTML>";

?>