<?php
// session_start();
// include("connect.inc");
include 'bootstrap.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PO 3 ใบ</title>
</head>
<body>
<script>
	ie4up=nav4up=false;
	var agt = navigator.userAgent.toLowerCase();
	var major = parseInt(navigator.appVersion);
	if ((agt.indexOf('msie') != -1) && (major >= 4))
		ie4up = true;

	if ((agt.indexOf('mozilla') != -1)  && (agt.indexOf('spoofer') == -1) && (agt.indexOf('compatible') == -1) && ( major>= 4))
		nav4up = true;
</script>
<style type="text/css">
*{
	font-family: TH SarabunPSK;
}
.clearfix:after{
    content: "";
    display: table;
    clear: both;
}
body{
	margin: 0;
	padding: 0;
}

.f1{
	font-size:18px;
	text-decoration:underline;
	font-weight:bold;
}

.ie7{
	position: relative; 
	width: 21cm; 
	height: 27cm; 
}

A {text-decoration:none}
A IMG {border-style:none; border-width:0;}
/* DIV {position:absolute; z-index:25;} */
.fc1-0 { COLOR:000000;FONT-SIZE:13PT;FONT-FAMILY:TH SarabunPSK;FONT-WEIGHT:NORMAL;}
.fc1-1 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:TH SarabunPSK;FONT-WEIGHT:BOLD;}
.fc1-2 { COLOR:000000;FONT-SIZE:23PT;FONT-FAMILY:TH SarabunPSK;FONT-WEIGHT:BOLD;}
.fc1-3 { COLOR:000000;FONT-SIZE:19PT;FONT-FAMILY:TH SarabunPSK;FONT-WEIGHT:BOLD;}
.fc1-4 { COLOR:000000;FONT-SIZE:14PT;FONT-FAMILY:TH SarabunPSK;FONT-WEIGHT:NORMAL;}
.fc1-5 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:TH SarabunPSK;FONT-WEIGHT:NORMAL;}
.ad1-0 {border:0PX none 000000; }
.ad1-1 {border-left:0PX none 000000; border-right:0PX none 000000; border-top:1PX dashed 000000; border-bottom:0PX none 000000; }
.ad1-2 {border-left:1PX dashed 000000; border-right:0PX none 000000; border-top:0PX none 000000; border-bottom:0PX none 000000; }
.ad1-3 {border:1PX dashed 000000; }

.page1 div,
.page3 div{
	position: absolute;
	z-index:25;
}
.page1,
.page2{
	page-break-after: always;
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
$nVat = $nNetprice * .07;

// รวมสุทธิ
// $nPriadvat

// รวมเงิน
// $nNetprice

///  $nVat=number_format($nVat,2,'.',''); //convert to string ทศนิยม 2 ตำแหน่ง ปัดเศษ
///  $nVat=floatval ($nVat);// convert to float-number

$nVat = vat($nVat); //use function vat
$nPriadvat = $nNetprice;

$nPriadvat=$nVat+$nNetprice;
$cPriadvat = baht($nPriadvat);//ตัวอักษร

//format 2 decimal
$nVat=number_format($nVat,2,'.',',');
$nPriadvat=number_format($nPriadvat,2,'.',',');
$nNetprice=number_format($nNetprice,2,'.',',');

          
///// po31.php///
?>
<div class="clearfix" style="display: none;">
<!-- default width 22cm -->
<!-- default height 28cm -->

<!--[if IE]>
		<div class="page1 ie7" style="">
<![endif]-->
<!--[if !IE]><!-->
		<div class="page1" style="position: relative; height: auto;">
<!--<![endif]-->


<?php
// print "<HTML>";
// print "<script>";
//  print "ie4up=nav4up=false;";
//  print "var agt = navigator.userAgent.toLowerCase();";
//  print "var major = parseInt(navigator.appVersion);";
//  print "if ((agt.indexOf('msie') != -1) && (major >= 4))";
//    print "ie4up = true;";
//  print "if ((agt.indexOf('mozilla') != -1)  && (agt.indexOf('spoofer') == -1) && (agt.indexOf('compatible') == -1) && ( major>= 4))";
//    print "nav4up = true;";
// print "</script>";

// print "<STYLE>";
//  print "A {text-decoration:none}";
//  print "A IMG {border-style:none; border-width:0;}";
//  print "DIV {position:absolute; z-index:25;}";
// print "</STYLE>";
// print "<TITLE>Crystal Report Viewer</TITLE>";
// print "<BODY BGCOLOR='FFFFFF'LEFTMARGIN=0 TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0>";
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
print "<DIV style='left:88PX;top:292PX;width:696PX;height:30PX;'><span class='fc1-5'>รับการรักษาพยาบาลใน รพ.ค่ายสุรศักดิ์มนตรี จำนวน $nItems รายการ การจัดหาครั้งนี้เป็นการจัดหาทดแทน</span></DIV>";
print "<DIV style='left:88PX;top:321PX;width:696PX;height:30PX;'><span class='fc1-5'>ของในสต๊อกที่ใกล้จะหมดลง ดังมีรายการตามสิ่งที่ส่งมาด้วยแล้ว</span></DIV>";
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
print "<DIV style='left:435PX;top:637PX;width:320PX;height:30PX;'><span class='fc1-5'>$cPriadvat</span></DIV>";
print "<DIV style='left:450PX;top:666PX;width:269PX;height:30PX;'><span class='fc1-5'>$aYot[5]</span></DIV>";
print "<DIV style='left:435PX;top:695PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>($aFname[5])</span></DIV>";
print "<DIV style='left:435PX;top:724PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>$aPost[5]</span></DIV>";
print "<DIV style='left:435PX;top:753PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>$aPost2[5]</span></DIV>";
print "<DIV style='left:435PX;top:782PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>............/............/............</span></DIV>";


print "<BR>";
?>
</div>
</div>





<div class="clearfix">
<!--[if IE]>
		<div class="page2 ie7" style="">
<![endif]-->
<!--[if !IE]><!-->
<div class="page2" style="position: relative; height: auto;">
<!--<![endif]-->

<?php

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
	$aUnitpri = array("unitpri");
	$aPart = array("part");
	$aFreelimit = array("freelimit");

	//$x  $tradname $packing  $pack  $amount  $price  $packpri  $specno 
    $query = "SELECT drugcode,tradname,packing,pack,minimum,totalstk,packpri,amount,price,free,specno FROM poitems WHERE idno = '$nRow_id' ";
	$result = mysql_query($query) or die("Query poitems failed");
	
	$po_page2_rows = 0;
	
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
		array_push($aUnitpri,$item['unitpri']);
		array_push($aPart,$item['part']);
		array_push($aFreelimit,$item['freelimit']);

		$po_page2_rows++;
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

	// จำนวนบรรทัดปกติ 
	$line_in_page = 14;
	if( $po_page2_rows > 14 ){
		$line_in_page = 20;
	}

	// หาจำนวนหน้า
	$page_ceil = (int) ceil( $po_page2_rows / $line_in_page );

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

	$edpri_from_list = array(
		1 => '(๑) ราคาที่ได้มาจากการคำนวณตามหลักเกณฑ์ที่คณะกรรมการราคากลางกำหนด',
		2 => '(๒) ราคาที่ได้มาจากฐานข้อมูลราคาอ้างอิงของพัสดุที่กรมบัญชีกลางจัดทำ',
		3 => '(๓) ราคามาตรฐานที่สำนักงบประมาณหรือหน่วยงานกลางอื่นกำหนด<br>(ราคามาตรฐานเวชภัณฑ์ที่มิใช่ยา ที่ สธ 0228.07.2/ว688 ลง วันที่ 6 สิงหาคม พ.ศ.2556)<br>(ประเภทและอัตราค่าอวัยวะเทียมและอุปกรณ์ในการบำบัดรักษาโรค ที่ กค 0422.2/พิเศษ ว 1 ลงวันที่ 4 ธันวาคม 2556)',
		4 => '(๔) ราคาที่ได้มาจากการสืบราคาจากท้องตลาด',
		5 => '(๕) ราคาที่เคขซื้อหรือจ้างครั้งหลังสุดภายในระยะเวลาสองปีงบประมาณ',
		6 => '(๖) ราคาอื่นใดตามหลักเกณฑ์ วิธีการ หรือแนวทางปฏิบัติของหน่วยงานของรัฐนั้นๆ',
	);

	function page2_header(){
		global $cPrepono, $cPrepodate;
		?>
		
			<table class="dx_tb" width="95%">
				<tr>
					<th style="width:38px;">ลำดับ</th>
					<th style="width:258px;">รายการ</th>
					<th style="width:51px;">หน่วยนับ</th>
					<th style="width:75px;">ขนาดบรรจุ</th>
					<th style="width:43px;">จำนวน</th>
					<th style="width:55px;">ราคากลาง</th>
					<th style="width:55px;">แหล่งที่มาของราคากลาง ***</th>
					<th style="width:75px;">หน่วยละ<br>รวม VAT</th>
					<th style="width:75px;">ราคา<br>รวม VAT</th>
					<th  style="width:75px;" class="last_child">Spec พบ.ที่</th>
				</tr>
		<?php
	}

	function page2_footer(){
		?></table><?php
	}

	function page2_topnote(){
		global $cPrepono, $cPrepodate;
		?>
		<div style="position: relative;">
			<DIV style='height:30PX;' align="center"><span class='fc1-1'>บัญชีรายการยาที่ขออนุมัติจัดซื้อ </span></DIV>
			<DIV style='height:26PX;' class='fc1-0' align="center">
				<span>ตามรายงานกองเภสัชกรรม รพ.ค่ายสุรศักดิ์มนตรี ที่ กห 0483.63.4/</span>
				<span style="padding: 0 10px; border-bottom: 1px dashed #000000;"><?=$cPrepono;?></span>
				ลง วันที่
				<span style="padding: 0 10px; border-bottom: 1px dashed #000000;"><?=$cPrepodate;?></span>
			</DIV>
		</div>
		<?php
	}

	function page2_footnote(){
		global $nItems, $nPriadvat, $cPriadvat, $edpri_from_list, $aYot, $aFname, $aPost, $aPost2;
		?>
		<div class="dx_detail" style="position: relative;">
		<div>รวมราคาประมาณการอนุมัติ เพื่อดำเนินการจัดซื้อในคราวนี้ <?=$nItems;?> รายการ</div>
		<div>จำนวนเงิน <?=$nPriadvat;?> บาท <?=$cPriadvat;?></div>
		<div>*** หมายเหตุ</div>
		<div>
			<div>แหล่งที่มาของราคากลาง</div>
			<div style="padding-left: 20px;">
				<?php
				foreach ($edpri_from_list as $key => $value) {
					echo $value."<br>";
				}
				?>
			</div>
		</div>
	</div>
	<div style="position: relative;">
		<?php
		//  ช่องเซ็น 740
		print"<DIV style='height:27PX; padding-right: 300px;' align='right'><span class='fc1-0'>ตรวจถูกต้อง</span></DIV>";
		print"<DIV style='height:30PX; padding-right: 250px;' align='right'><span class='fc1-0'>$aYot[2]</span></DIV>";
		print"<DIV style='height:30PX; padding-right: 150px;' align='right'><span class='fc1-0'>($aFname[2])</span></DIV>";

		//ตำแหน่ง
		print"<DIV style='height:30PX; padding-right: 100px;' align='right'><span class='fc1-0'>$aPost[2] $aPost2[2]</span></DIV>";

		?>
	</div>
		<?php
	}

	?>
	<style type="text/css">
	.dx_tb{
		border: 1px dashed #000;
		font-size: 13pt;
	}
	.dx_tb th{
		border-bottom: 1px dashed #000;
	}
	.dx_tb th, .dx_tb td{
		border-right: 1px dashed #000;
		padding: 0 2 0 0;
		margin: 0;
	}
	.dx_tb .last_child{
		border-right: none;
	}
	.dx_detail{
		margin-top: 5px;
	}
	.dx_detail div{
		position: relative;
		padding-left: 10px;
		line-height: 13pt;
	}
	</style>

	<?php 
	// page2_topnote();
	?>
	<div style="position: relative; font-family: TH SarabunPSK; font-size: 13pt;">
		<?php

		$i_inpage = 0;

		for ($ii=1; $ii <= $po_page2_rows; $ii++) { 



			// cost ยังไม่เป็น &nbsp; เพราะต้องเช็กตามเงื่อนไขต่างๆก่อน
			$cost = false;
			$from = '&nbsp;';

			//  ถ้าเป็นอุปกรณ์ เทียบจาก อุปกรเบิกได้ไม่เกิน
			if( $part == 'DPY' OR $part == 'DPN' ){

				// ราคาอุปกรณ์เบิกได้ไม่เกิน
				if( $aFreelimit[$ii] > 0 ){
					$cost = $aFreelimit[$ii];
					$from = 3;
				}

			}else{

				// ราคากลาง
				if( $aEdpri[$ii] > 0 ){
					$cost = $aEdpri[$ii];
					$from = 3;
				}

			}

			// ถ้าไม่มีราคากลาง หรือ ราคาอุปกรณ์ให้ใช้ราคาทุน
			if( empty($cost) ){
				if( !empty($aUnitpri[$ii]) ){
					$cost = $aUnitpri[$ii];
					$from = 5;
				}
			}

			if( $cost == false ){
				$cost = '&nbsp;';
			}

			// เซ็ตเพจใหม่
			if( $ii % $line_in_page == 0 ){
				
				$i_inpage = 0;

				page2_footer();

				page2_footnote();
				?>
				
				</div>
				</div>
				
				<div class="clearfix">
				<!--[if IE]>
						<div class="page2 ie7" style="">
				<![endif]-->
				<!--[if !IE]><!-->
				<div class="page2" style="position: relative; height: auto;">
				<!--<![endif]-->
				<?php

			}

			// ขึ้นตารางใหม่
			if( $i_inpage == 0 ){
				page2_topnote();
				page2_header();
			}
			
			
			
			?>
			<tr>
				<td align="center"><?=( !empty($aX[$ii]) ? $aX[$ii] : '&nbsp;' );?></td>
				<td><?=( !empty($aTradname[$ii]) ? $aTradname[$ii] : '&nbsp;' );?></td>
				<td><?=( !empty($aPacking[$ii]) ? $aPacking[$ii] : '&nbsp;' );?></td>
				<td align="center"><?=( !empty($aPack[$ii]) ? $aPack[$ii] : '&nbsp;' );?></td>
				<td align="right"><?=( !empty($aAmount[$ii]) ? $aAmount[$ii] : '&nbsp;' );?></td>
				<td align="right"><?=$cost;?></td>
				<td align="center"><?=$from;?></td>
				<td align="right"><?=( !empty($aPackpri[$ii]) ? $aPackpri[$ii] : '&nbsp;' );?></td>
				<td align="right"><?=( !empty($aPrice[$ii]) ? $aPrice[$ii] : '&nbsp;' );?></td>
				<td class="last_child" align="center"><?=( !empty($aSpecno[$ii]) ? $aSpecno[$ii] : '&nbsp;' );?></td>
			</tr>
			<?php

			$i_inpage++;
		}


		?>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td style="border-bottom: 1px solid #000;">รวมเงิน</td>
			<td style="border-bottom: 1px solid #000;" align="right"><?=$nNetprice;?></td>
			<td class="last_child">&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td style="border-bottom: 1px solid #000;">ภาษี 7.00 %</td>
			<td style="border-bottom: 1px solid #000;" align="right"><?=$nVat;?></td>
			<td class="last_child">&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>รวม <?=$nItems;?> รายการ</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td style="border-bottom: 1px solid #000;">รวมสุทธิ</td>
			<td style="border-bottom: 1px solid #000;" align="right"><?=$nPriadvat;?></td>
			<td class="last_child">&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td class="last_child">&nbsp;</td>
		</tr>
		
	

	<?php 
	page2_footer();

	page2_footnote();

	?>
	
	
</div>

<?php
// print"<BR>";
// print"</BODY>";
// print"</HTML>";
// echo "</div>";
?>
</div>
</div>
<?php
exit;
?>
<div class="clearfix">
<!--[if IE]>
		<div class="page3 ie7" style="">
<![endif]-->
<!--[if !IE]><!-->
<div class="page3" style="position: relative; height: auto;">
<!--<![endif]-->
<?php
////po33.php

// print"<HTML>";
// print"<script>";
//  print"ie4up=nav4up=false;";
// print" var agt = navigator.userAgent.toLowerCase();";
//  print"var major = parseInt(navigator.appVersion);";
// print" if ((agt.indexOf('msie') != -1) && (major >= 4))";
//  print"  ie4up = true;";
// print" if ((agt.indexOf('mozilla') != -1)  && (agt.indexOf('spoofer') == -1) && (agt.indexOf('compatible') == -1) && ( major>= 4))";
//   print" nav4up = true;";
// print"</script>";

// print "<head>";

// print"<TITLE>Crystal Report Viewer</TITLE>";
// print "</head>";

// print"<BODY BGCOLOR='FFFFFF'LEFTMARGIN=0 TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0>";

// 2090
print"<DIV style='left:194PX;top:90PX;width:364PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-1'>ใบสั่งซื้อยาและเวชภัณฑ์สิ้นเปลือง</span></DIV>";


print"<DIV style='z-index:0'> &nbsp; </div>";
print"<div style='left:310PX;top:216PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:156PX;'></div>";
print"<div style='left:515PX;top:216PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:156PX;'></div>";
print"<div style='left:8PX;top:280PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:743PX;'></div>";
print"<div style='left:44PX;top:251PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:560PX;'><table width='0px' height='554PX'><td>&nbsp;</td></table></div>";
print"<div style='left:311PX;top:251PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:560PX;'><table width='0px' height='554PX'><td>&nbsp;</td></table></div>";
print"<div style='left:365PX;top:251PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:560PX;'><table width='0px' height='554PX'><td>&nbsp;</td></table></div>";
print"<div style='left:461PX;top:251PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:560PX;'><table width='0px' height='554PX'><td>&nbsp;</td></table></div>";
print"<div style='left:515PX;top:251PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:559PX;'><table width='0px' height='553PX'><td>&nbsp;</td></table></div>";
print"<div style='left:585PX;top:251PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:560PX;'><table width='0px' height='554PX'><td>&nbsp;</td></table></div>";
print"<div style='left:679PX;top:251PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:559PX;'><table width='0px' height='553PX'><td>&nbsp;</td></table></div>";

print"<div style='left:187PX;top:243PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:399PX;'></div>";
print"<div style='left:8PX;top:758PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:743PX;'></div>";
print"<div style='left:124PX;top:783PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:102PX;'></div>";
//print"<div style='left:362PX;top:2924PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:234PX;'></div>";

print"<DIV class='box' style='z-index:10; border-color:000000;border-style:dashed;border-bottom-style:dashed;border-bottom-width:1PX;border-left-style:dashed;border-left-width:1PX;border-top-style:dashed;border-top-width:1PX;border-right-style:dashed;border-right-width:1PX;left:7PX;top:251PX;width:743PX;height:559PX;'>
<table border=0 cellpadding=0 cellspacing=0 width=736px height=552px><TD>&nbsp;</TD></TABLE>
</DIV>";
print"<DIV class='box' style='z-index:10; border-color:000000;border-style:dashed;border-bottom-style:dashed;border-bottom-width:1PX;border-left-style:dashed;border-left-width:1PX;border-top-style:dashed;border-top-width:1PX;border-right-style:dashed;border-right-width:1PX;left:44PX;top:819PX;width:181PX;height:45PX;'>
<table border=0 cellpadding=0 cellspacing=0 width=174px height=38px><TD>&nbsp;</TD></TABLE>
</DIV>";
print"<DIV style='left:518PX;top:195PX;width:105PX;height:26PX;'><span class='fc1-0'>$cPrepodate</span></DIV>";
//print"<DIV style='left:310PX;top:2195PX;width:159PX;height:26PX;'><span class='fc1-0'>$cPrepono</span></DIV>";  //เก่า
print"<DIV style='left:310PX;top:195PX;width:159PX;height:26PX;'><span class='fc1-0'>กห 0483.63.4/$cPrepono</span></DIV>";
print"<DIV style='left:281PX;top:195PX;width:30PX;height:26PX;'><span class='fc1-0'>เลขที่</span></DIV>";
print"<DIV style='left:490PX;top:195PX;width:29PX;height:26PX;'><span class='fc1-0'>วันที่</span></DIV>";

print"<DIV style='left:7PX;top:253PX;width:38PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>ลำดับ</span></DIV>";
print"<DIV style='left:49PX;top:253PX;width:258PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>รายการ</span></DIV>";
print"<DIV style='left:313PX;top:253PX;width:51PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>หน่วยนับ</span></DIV>";
print"<DIV style='left:371PX;top:253PX;width:85PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>ขนาดบรรจุ</span></DIV>";
print"<DIV style='left:467PX;top:253PX;width:43PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>จำนวน</span></DIV>";
print"<DIV style='left:520PX;top:248PX;width:61PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>หน่วยละ</span></DIV>";
print"<DIV style='left:590PX;top:248PX;width:85PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>ราคา</span></DIV>";
print"<DIV style='left:684PX;top:253PX;width:61PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>spec.</span></DIV>";
print"<DIV style='left:194PX;top:120PX;width:364PX;height:41PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>โรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง</span></DIV>";
print"<DIV style='left:194PX;top:163PX;width:364PX;height:34PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>มทบ.32</span></DIV>";
print"<DIV style='left:187PX;top:222PX;width:397PX;height:26PX;'><span class='fc1-0'>
	($cComcode)$cComname&nbsp;&nbsp;&nbsp;$fax</span></DIV>";

print"<DIV style='left:97PX;top:222PX;width:91PX;height:26PX;'><span class='fc1-0'>ขอสั่งซื้อของจาก</span></DIV>
";
print"<DIV style='left:586PX;top:222PX;width:104PX;height:26PX;'><span class='fc1-0'>ดังมีรายการต่อไปนี้</span></DIV>";
print"<DIV style='left:684PX;top:167PX;width:61PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>งบรายรับ</span></DIV>";
print"<DIV style='left:518PX;top:262PX;width:64PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>รวม VAT</span></DIV>";
print"<DIV style='left:600PX;top:262PX;width:64PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>รวม VAT</span></DIV>";

$start_line = 289;
for ($iz=1; $iz <= $po_page2_rows; $iz++) { 
	print"<DIV style='left:11PX;top:".$start_line."PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[$iz]</span></DIV>";
	print"<DIV style='left:49PX;top:".$start_line."PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[$iz]</span></DIV>";
	print"<DIV style='left:306PX;top:".$start_line."PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
		<span class='fc1-4'>$aPacking[$iz]</span></DIV>";
	print"<DIV style='left:362PX;top:".$start_line."PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
		<span class='fc1-4'>$aPack[$iz]</span></DIV>";
	print"<DIV style='left:462PX;top:".$start_line."PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
		<span class='fc1-4'>$aAmount[$iz]</span></DIV>";
	print"<DIV style='left:597PX;top:".$start_line."PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
		<span class='fc1-4'>$aPrice[$iz]</span></DIV>";
	print"<DIV style='left:679PX;top:".$start_line."PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
		<span class='fc1-4'>$aSpecno[$iz]</span></DIV>";
	print"<DIV style='left:519PX;top:".$start_line."PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
		<span class='fc1-4'>$aPackpri[$iz]</span></DIV>";

	$start_line += 30;
}
/*
///แถวที่1
print"<DIV style='left:11PX;top:289PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[1]</span></DIV>";
print"<DIV style='left:49PX;top:289PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[1]</span></DIV>";
print"<DIV style='left:306PX;top:289PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[1]</span></DIV>";
print"<DIV style='left:362PX;top:289PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[1]</span></DIV>";
print"<DIV style='left:462PX;top:289PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[1]</span></DIV>";
print"<DIV style='left:597PX;top:289PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[1]</span></DIV>";
print"<DIV style='left:679PX;top:289PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[1]</span></DIV>";
print"<DIV style='left:519PX;top:289PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
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
*/

/////////
//print"<DIV style='left:79PX;top:278PX;width:159PX;height:22PX;'><span class='fc1-4'>----------&nbsp;&nbsp;หมดรายการ&nbsp;&nbsp;----------</span></DIV>";
print"<DIV style='left:128PX;top:761PX;width:93PX;height:26PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-0'>$nItems</span></DIV>";
print"<DIV style='left:99PX;top:761PX;width:25PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>รวม</span></DIV>";
print"<DIV style='left:225PX;top:761PX;width:44PX;height:27PX;'><span class='fc1-0'>รายการ</span></DIV>";
//print"<DIV style='left:105PX;top:2993PX;width:542PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>(แผนกส่งกำลังและบริการ เอกสารหมายเลข FR-LGT-007/5&nbsp;&nbsp;แก้ไขครั้งที่ 00 วันที่มีผลบังคับใช้ 9 มี.ค. 43)</span></DIV>";
print"<DIV style='left:330PX;top:899PX;width:87PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-5'>$aYot[2]</span></DIV>";
print"<DIV style='left:344PX;top:922PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>($aFname[2])</span></DIV>";
print"<DIV style='left:496PX;top:730PX;width:86PX;height:26PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>ภาษี 7.00 %</span></DIV>";
print"<DIV style='left:538PX;top:763PX;width:44PX;height:27PX;'><span class='fc1-0'>รวมสุทธิ</span></DIV>";
print"<DIV style='left:496PX;top:702PX;width:86PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>รวมเงิน</span></DIV>";
print"<DIV style='left:360PX;top:816PX;width:263PX;height:27PX;'><span class='fc1-0'>ส่งของภายใน 15 วัน นับจากวันที่ที่ลงในใบสั่งซื้อ</span></DIV>";
print"<DIV style='left:360PX;top:842PX;width:319PX;height:27PX;'><span class='fc1-0'>ถ้าไม่สามารถส่งของได้ตามกำหนด ให้ติดต่อกลับภายใน 5 วัน</span></DIV>";
print"<DIV style='left:360PX;top:868PX;width:263PX;height:27PX;'><span class='fc1-0'>โทรศัพท์ 054-839305 ต่อ 1163    FAX. 054-839314</span></DIV>";
print"<DIV style='left:10PX;top:951PX;width:209PX;height:27PX;'><span class='fc1-0'>บริษัท&nbsp;&nbsp;.....................................................</span></DIV>";
print"<DIV style='left:10PX;top:925PX;width:209PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>(…………………………………….)</span></DIV>";
print"<DIV style='left:10PX;top:889PX;width:209PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>……………………………………...........</span></DIV>";
print"<DIV style='left:10PX;top:873PX;width:209PX;height:27PX;'><span class='fc1-0'>ได้รับใบสั่งซื้อไปแล้ว</span></DIV>";
print"<DIV style='left:76PX;top:819PX;width:128PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>ขอเอกสารใบส่งของ 7 ชุด</span></DIV>";
print"<DIV style='left:76PX;top:840PX;width:128PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>ใบกำกับภาษี 1 ชุด</span></DIV>";
print"<DIV style='left:597PX;top:703PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-0'>$nNetprice</span></DIV>";
print"<DIV style='left:597PX;top:730PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-0'>$nVat</span></DIV>";
print"<DIV style='left:597PX;top:763PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-0'><B>$nPriadvat</B></span></DIV>";
print"<DIV style='left:10PX;top:981PX;width:479PX;height:27PX;'><span class='f1'><u>หมายเหตุ : ให้ลงวันที่ในใบส่งของและใบเสร็จรับเงิน หลังวันที่ใน PO ยกเว้นวันเสาร์ - อาทิตย์</u></span></DIV>";
print"<DIV style='left:344PX;top:942PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>$aPost[2]</span></DIV>";
print"<DIV style='left:344PX;top:961PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>$aPost2[2]</span></DIV>";
print"<BR>";
// print"</BODY>";
// print"</HTML>";
?>
</div>
</div>
</body>
</html>