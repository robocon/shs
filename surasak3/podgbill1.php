<?php
/*เดิม
    //////podgbill.php
    session_start();
    $today = date("d-m-Y");   
    $d=substr($today,0,2);
    $m=substr($today,3,2);
    $yr=substr($today,6,4) +543;  

    print "<font face='Angsana New'>วันที่  $d/$m/$yr<br>";
    print "<font face='Angsana New'>รายการสั่งซื้อ  จาก ( $cComcode)  $cComname";

    print"<table>";
    print" <tr>";
    print"  <th><font face='Angsana New'>#</th>";
    print"  <th><font face='Angsana New'>รหัส</th>";
    print"  <th><font face='Angsana New'>รายการ</th>";
    print"  <th><font face='Angsana New'>หน่วยนับ</th>";
    print"  <th><font face='Angsana New'>ขนาดบรรจุ</th>";
    print"  <th><font face='Angsana New'>จำนวนวางระดับ</th>";
    print"  <th><font face='Angsana New'>จำนวนคงคลัง</th>";
    print"  <th><font face='Angsana New'>จำนวนสั่งซื้อ</th>";
    print"  <th><font face='Angsana New'>หน่วยละรวมVAT</th>";
    print"  <th><font face='Angsana New'>เป็นเงินรวมVAT</th>";
    print" </tr>";
    $x--;
    $nTotalprice=0;    
    for ($n=1; $n<=$x; $n++){
          $nTotalprice=$nTotalprice+$aPrice[$n];
          print("<tr>\n".
                "<td><font face='Angsana New'>$n</td>\n".
                "<td><font face='Angsana New'>$aDgcode[$n]</td>\n".
                "<td><font face='Angsana New'>$aTrade[$n]</td>\n".
                "<td><font face='Angsana New'>$aPacking[$n]</td>\n".
                "<td><font face='Angsana New'>$aPack[$n]</td>\n".
                "<td><font face='Angsana New'>$aMinimum[$n]</td>\n".
                "<td><font face='Angsana New'>$aTotalstk[$n]</td>\n".  
                "<td><font face='Angsana New'>$aAmount[$n]</td>\n".  
                "<td><font face='Angsana New'>$aPackpri[$n]</td>\n".
                "<td><font face='Angsana New'>$aPrice[$n]</td>\n".  
                 " </tr>\n");
            }
    $x++;
    print "<table>";
    print " <tr>";
    print "  <th>ราคารวมทั้งสิ้น $nTotalprice บาท</th>";
    print " </tr>";
	*/

//พิมพ์ใบสั่งซื้อชั่วคราว
    session_start();
    $today = date("d-m-Y");   
    $d=substr($today,0,2);
    $m=substr($today,3,2);
    $yr=substr($today,6,4) +543;  

  //  print "<font face='Angsana New'>วันที่  $d/$m/$yr<br>";
    //print "<font face='Angsana New'>รายการสั่งซื้อ  จาก ( $cComcode)  $cComname";
		$x--;
    	$nItems=$x;
		$aX   = array("x");
//		    $aSpecno   = array(" specno");
//		    array_push($aSpecno,$row->specno);
    $nTotalprice=0;    
    for ($n=1; $n<=$x; $n++){
          $nTotalprice=$nTotalprice+$aPrice[$n];
          array_push($aX,"$n");
            }
    $x++;
	$oldx=$x;
//    print "  ราคารวมทั้งสิ้น $nTotalprice บาท";
$nNetprice=$nTotalprice;

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
//คำนวนค่าต่างๆ
  $nVat=$nNetprice*.07;
 $nVat=vat($nVat);//use function vat
  $nPriadvat=$nVat+$nNetprice;
//format 2 decimal
$nVat=number_format($nVat,2,'.',',');
$nPriadvat=number_format($nPriadvat,2,'.',',');
$nNetprice=number_format($nNetprice,2,'.',',');
  
   ///$x,$nTotalprice,$aDgcode[$n],$aTrade[$n], $aPacking[$n], $aPack[$n], $aMinimum[$n],$aTotalstk[$n],  $aAmount[$n], $aPackpri[$n],$aPrice[$n],
 $nEnd=$nItems+1;
   $aTrade[$nEnd]="------- หมดรายการ -------"; 
$x=$oldx;

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
print".fc1-0 { COLOR:000000;FONT-SIZE:13PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";
print".fc1-1 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print".fc1-2 { COLOR:000000;FONT-SIZE:23PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print".fc1-3 { COLOR:000000;FONT-SIZE:19PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print".fc1-4 { COLOR:000000;FONT-SIZE:14PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";
print".fc1-5 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";
print".ad1-0 {border:0PX none 000000; }";
print".ad1-1 {border-left:0PX none 000000; border-right:0PX none 000000; border-top:1PX solid 000000; border-bottom:0PX none 000000; }";
print".ad1-2 {border-left:1PX solid 000000; border-right:0PX none 000000; border-top:0PX none 000000; border-bottom:0PX none 000000; }";
print".ad1-3 {border:1PX solid 000000; }";
print"</STYLE>";
print"<TITLE>Crystal Report Viewer</TITLE>";
print "</head>";

print"<BODY BGCOLOR='FFFFFF'LEFTMARGIN=0 TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0>";
print"<DIV style='z-index:0'> &nbsp; </div>";
print"<div style='left:310PX;top:216PX;border-color:000000;border-style:solid;border-width:0px;border-top-width:1PX;width:156PX;'></div>";
print"<divstyle='left:515PX;top:216PX;border-color:000000;border-style:solid;border-width:0px;border-top-width:1PX;width:156PX;'></div>";
print"<div style='left:8PX;top:280PX;border-color:000000;border-style:solid;border-width:0px;border-top-width:1PX;width:743PX;'></div>";
print"<div style='left:44PX;top:251PX;border-color:000000;border-style:solid;border-width:0px;border-left-width:1PX;height:560PX;'><table width='0px' height='554PX'><td>&nbsp;</td></table></div>";
print"<div style='left:311PX;top:251PX;border-color:000000;border-style:solid;border-width:0px;border-left-width:1PX;height:560PX;'><table width='0px' height='554PX'><td>&nbsp;</td></table></div>";
print"<div style='left:380PX;top:251PX;border-color:000000;border-style:solid;border-width:0px;border-left-width:1PX;height:560PX;'><table width='0px' height='554PX'><td>&nbsp;</td></table></div>";
print"<div style='left:461PX;top:251PX;border-color:000000;border-style:solid;border-width:0px;border-left-width:1PX;height:560PX;'><table width='0px' height='554PX'><td>&nbsp;</td></table></div>";
print"<div style='left:515PX;top:251PX;border-color:000000;border-style:solid;border-width:0px;border-left-width:1PX;height:559PX;'><table width='0px' height='553PX'><td>&nbsp;</td></table></div>";
print"<div style='left:585PX;top:251PX;border-color:000000;border-style:solid;border-width:0px;border-left-width:1PX;height:560PX;'><table width='0px' height='554PX'><td>&nbsp;</td></table></div>";
print"<div style='left:678PX;top:251PX;border-color:000000;border-style:solid;border-width:0px;border-left-width:1PX;height:559PX;'><table width='0px' height='553PX'><td>&nbsp;</td></table></div>";
print"<div style='left:187PX;top:243PX;border-color:000000;border-style:solid;border-width:0px;border-top-width:1PX;width:399PX;'></div>";
print"<div style='left:8PX;top:758PX;border-color:000000;border-style:solid;border-width:0px;border-top-width:1PX;width:743PX;'></div>";
print"<div style='left:124PX;top:783PX;border-color:000000;border-style:solid;border-width:0px;border-top-width:1PX;width:102PX;'></div>";
print"<div style='left:362PX;top:924PX;border-color:000000;border-style:solid;border-width:0px;border-top-width:1PX;width:234PX;'></div>";
print"<DIV class='box' style='z-index:10; border-color:000000;border-style:solid;border-bottom-style:solid;border-bottom-width:1PX;border-left-style:solid;border-left-width:1PX;border-top-style:solid;border-top-width:1PX;border-right-style:solid;border-right-width:1PX;left:7PX;top:251PX;width:100PX;height:559PX;'>
<table border=0 cellpadding=0 cellspacing=0 width=723px height=552px><TD>&nbsp;</TD></TABLE>
</DIV>";
//print"<DIV class='box' style='z-index:10; border-color:000000;border-style:solid;border-bottom-style:solid;border-bottom-width:1PX;border-left-style:solid;border-left-width:1PX;border-top-style:solid;border-top-width:1PX;border-right-style:solid;border-right-width:1PX;left:44PX;top:819PX;width:181PX;height:45PX;'>
print "<table border=0 cellpadding=0 cellspacing=0 width=174px height=38px><TD>&nbsp;</TD></TABLE></DIV>";
print"<DIV style='left:518PX;top:195PX;width:105PX;height:26PX;'><span class='fc1-0'>$cPrepodate</span></DIV>";
print"<DIV style='left:310PX;top:195PX;width:159PX;height:26PX;'><span class='fc1-0'>$cPrepono</span></DIV>";
print"<DIV style='left:194PX;top:090PX;width:364PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-1'>ใบสั่งซื้อชั่วคราว (ยาและเวชภัณฑ์สิ้นเปลือง) </span></DIV>";
print"<DIV style='left:281PX;top:195PX;width:30PX;height:26PX;'><span class='fc1-0'>เลขที่</span></DIV>";
print"<DIV style='left:490PX;top:195PX;width:100PX;height:26PX;'><span class='fc1-0'>วันที่ $d/$m/$yr </span></DIV>";
print"<DIV style='left:7PX;top:253PX;width:38PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>ลำดับ</span></DIV>";
print"<DIV style='left:49PX;top:253PX;width:258PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>รายการ</span></DIV>";
print"<DIV style='left:313PX;top:253PX;width:51PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>หน่วยนับ</span></DIV>";
print"<DIV style='left:371PX;top:253PX;width:85PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>ขนาดบรรจุ</span></DIV>";
print"<DIV style='left:467PX;top:253PX;width:43PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>จำนวน</span></DIV>";
print"<DIV style='left:520PX;top:248PX;width:61PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>หน่วยละ</span></DIV>";
print"<DIV style='left:590PX;top:248PX;width:85PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>เป็นเงิน</span></DIV>";
print"<DIV style='left:684PX;top:253PX;width:61PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>spec.</span></DIV>";
print"<DIV style='left:194PX;top:120PX;width:364PX;height:41PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>โรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง</span></DIV>";
print"<DIV style='left:194PX;top:163PX;width:364PX;height:34PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>มทบ.32</span></DIV>";
print"<DIV style='left:187PX;top:222PX;width:397PX;height:26PX;'><span class='fc1-0'>
	($cComcode)$cComname</span></DIV>";
print"<DIV style='left:97PX;top:222PX;width:91PX;height:26PX;'><span class='fc1-0'>ขอสั่งซื้อของจาก </span></DIV>
";
print"<DIV style='left:586PX;top:222PX;width:104PX;height:26PX;'><span class='fc1-0'>ดังมีรายการต่อไปนี้</span></DIV>";
print"<DIV style='left:590PX;top:167PX;width:61PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>งบรายรับ</span></DIV>";
print"<DIV style='left:518PX;top:262PX;width:64PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>รวม VAT</span></DIV>";
print"<DIV style='left:600PX;top:262PX;width:64PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>รวม VAT</span></DIV>";

///แถวที่1
print"<DIV style='left:11PX;top:289PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[1]</span></DIV>";
print"<DIV style='left:49PX;top:289PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTrade[1]</span></DIV>";
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
print"<DIV style='left:11PX;top:319PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[2]</span></DIV>";
print"<DIV style='left:49PX;top:319PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTrade[2]</span></DIV>";
print"<DIV style='left:306PX;top:319PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[2]</span></DIV>";
print"<DIV style='left:362PX;top:319PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[2]</span></DIV>";
print"<DIV style='left:462PX;top:319PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[2]</span></DIV>";
print"<DIV style='left:597PX;top:319PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[2]</span></DIV>";
print"<DIV style='left:679PX;top:319PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[2]</span></DIV>";
print"<DIV style='left:519PX;top:319PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[2]</span></DIV>";
///แถวที่3
print"<DIV style='left:11PX;top:349PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[3]</span></DIV>";
print"<DIV style='left:49PX;top:349PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTrade[3]</span></DIV>";
print"<DIV style='left:306PX;top:349PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[3]</span></DIV>";
print"<DIV style='left:362PX;top:349PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[3]</span></DIV>";
print"<DIV style='left:462PX;top:349PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[3]</span></DIV>";
print"<DIV style='left:597PX;top:349PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[3]</span></DIV>";
print"<DIV style='left:679PX;top:349PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[3]</span></DIV>";
print"<DIV style='left:519PX;top:349PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[3]</span></DIV>";
///แถวที่4
print"<DIV style='left:11PX;top:379PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[4]</span></DIV>";
print"<DIV style='left:49PX;top:379PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTrade[4]</span></DIV>";
print"<DIV style='left:306PX;top:379PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[4]</span></DIV>";
print"<DIV style='left:362PX;top:379PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[4]</span></DIV>";
print"<DIV style='left:462PX;top:379PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[4]</span></DIV>";
print"<DIV style='left:597PX;top:379PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[4]</span></DIV>";
print"<DIV style='left:679PX;top:379PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[4]</span></DIV>";
print"<DIV style='left:519PX;top:379PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[4]</span></DIV>";
///แถวที่5
print"<DIV style='left:11PX;top:409PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[5]</span></DIV>";
print"<DIV style='left:49PX;top:409PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTrade[5]</span></DIV>";
print"<DIV style='left:306PX;top:409PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[5]</span></DIV>";
print"<DIV style='left:362PX;top:409PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[5]</span></DIV>";
print"<DIV style='left:462PX;top:409PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[5]</span></DIV>";
print"<DIV style='left:597PX;top:409PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[5]</span></DIV>";
print"<DIV style='left:679PX;top:409PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[5]</span></DIV>";
print"<DIV style='left:519PX;top:409PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[5]</span></DIV>";
///แถวที่6
print"<DIV style='left:11PX;top:439PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[6]</span></DIV>";
print"<DIV style='left:49PX;top:439PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTrade[6]</span></DIV>";
print"<DIV style='left:306PX;top:439PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[6]</span></DIV>";
print"<DIV style='left:362PX;top:439PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[6]</span></DIV>";
print"<DIV style='left:462PX;top:439PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[6]</span></DIV>";
print"<DIV style='left:597PX;top:439PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[6]</span></DIV>";
print"<DIV style='left:679PX;top:439PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[6]</span></DIV>";
print"<DIV style='left:519PX;top:439PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[6]</span></DIV>";
///แถวที่7
print"<DIV style='left:11PX;top:469PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[7]</span></DIV>";
print"<DIV style='left:49PX;top:469PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTrade[7]</span></DIV>";
print"<DIV style='left:306PX;top:469PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[7]</span></DIV>";
print"<DIV style='left:362PX;top:469PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[7]</span></DIV>";
print"<DIV style='left:462PX;top:469PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[7]</span></DIV>";
print"<DIV style='left:597PX;top:469PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[7]</span></DIV>";
print"<DIV style='left:679PX;top:469PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[7]</span></DIV>";
print"<DIV style='left:519PX;top:469PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[7]</span></DIV>";
///แถวที่8
print"<DIV style='left:11PX;top:499PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[8]</span></DIV>";
print"<DIV style='left:49PX;top:499PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTrade[8]</span></DIV>";
print"<DIV style='left:306PX;top:499PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[8]</span></DIV>";
print"<DIV style='left:362PX;top:499PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[8]</span></DIV>";
print"<DIV style='left:462PX;top:499PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[8]</span></DIV>";
print"<DIV style='left:597PX;top:499PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[8]</span></DIV>";
print"<DIV style='left:679PX;top:499PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[8]</span></DIV>";
print"<DIV style='left:519PX;top:499PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[8]</span></DIV>";
///แถวที่9
print"<DIV style='left:11PX;top:529PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[9]</span></DIV>";
print"<DIV style='left:49PX;top:529PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTrade[9]</span></DIV>";
print"<DIV style='left:306PX;top:529PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[9]</span></DIV>";
print"<DIV style='left:362PX;top:529PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[9]</span></DIV>";
print"<DIV style='left:462PX;top:529PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[9]</span></DIV>";
print"<DIV style='left:597PX;top:529PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[9]</span></DIV>";
print"<DIV style='left:679PX;top:529PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[9]</span></DIV>";
print"<DIV style='left:519PX;top:529PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[9]</span></DIV>";
///แถวที่10
print"<DIV style='left:11PX;top:559PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[10]</span></DIV>";
print"<DIV style='left:49PX;top:559PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTrade[10]</span></DIV>";
print"<DIV style='left:306PX;top:559PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[10]</span></DIV>";
print"<DIV style='left:362PX;top:559PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[10]</span></DIV>";
print"<DIV style='left:462PX;top:559PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[10]</span></DIV>";
print"<DIV style='left:597PX;top:559PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[10]</span></DIV>";
print"<DIV style='left:679PX;top:559PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[10]</span></DIV>";
print"<DIV style='left:519PX;top:559PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[10]</span></DIV>";
///แถวที่11
print"<DIV style='left:11PX;top:589PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[11]</span></DIV>";
print"<DIV style='left:49PX;top:589PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTrade[11]</span></DIV>";
print"<DIV style='left:306PX;top:589PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[11]</span></DIV>";
print"<DIV style='left:362PX;top:589PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[11]</span></DIV>";
print"<DIV style='left:462PX;top:589PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[11]</span></DIV>";
print"<DIV style='left:597PX;top:589PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[11]</span></DIV>";
print"<DIV style='left:679PX;top:589PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[11]</span></DIV>";
print"<DIV style='left:519PX;top:589PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[11]</span></DIV>";
///แถวที่12
print"<DIV style='left:11PX;top:619PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[12]</span></DIV>";
print"<DIV style='left:49PX;top:619PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTrade[12]</span></DIV>";
print"<DIV style='left:306PX;top:619PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[12]</span></DIV>";
print"<DIV style='left:362PX;top:619PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[12]</span></DIV>";
print"<DIV style='left:462PX;top:619PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[12]</span></DIV>";
print"<DIV style='left:597PX;top:619PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[12]</span></DIV>";
print"<DIV style='left:679PX;top:619PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[12]</span></DIV>";
print"<DIV style='left:519PX;top:619PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[12]</span></DIV>";
///แถวที่13
print"<DIV style='left:11PX;top:649PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[13]</span></DIV>";
print"<DIV style='left:49PX;top:649PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTrade[13]</span></DIV>";
print"<DIV style='left:306PX;top:649PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[13]</span></DIV>";
print"<DIV style='left:362PX;top:649PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[13]</span></DIV>";
print"<DIV style='left:462PX;top:649PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aAmount[13]</span></DIV>";
print"<DIV style='left:597PX;top:649PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPrice[13]</span></DIV>";
print"<DIV style='left:679PX;top:649PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpecno[13]</span></DIV>";
print"<DIV style='left:519PX;top:649PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPackpri[13]</span></DIV>";
/////////
print"<DIV style='left:128PX;top:761PX;width:93PX;height:26PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-0'>$nItems</span></DIV>";
print"<DIV style='left:99PX;top:761PX;width:25PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>รวม</span></DIV>";
print"<DIV style='left:225PX;top:761PX;width:44PX;height:27PX;'><span class='fc1-0'>รายการ</span></DIV>";
print"<DIV style='left:105PX;top:993PX;width:542PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>(แผนกส่งกำลังและบริการ เอกสารหมายเลข FR-LGT-007/5&nbsp;&nbsp;แก้ไขครั้งที่ 00 วันที่มีผลบังคับใช้ 9 มี.ค. 43)</span></DIV>";
print"<DIV style='left:269PX;top:899PX;width:87PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-5'>พ.อ. หญิง</span></DIV>";
print"<DIV style='left:344PX;top:922PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>(พรทิพา&nbsp;&nbsp;จันทร์ณรงค์)</span></DIV>";
print"<DIV style='left:496PX;top:730PX;width:86PX;height:26PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'> </span></DIV>";
print"<DIV style='left:538PX;top:763PX;width:44PX;height:27PX;'><span class='fc1-0'>รวมสุทธิ</span></DIV>";
print"<DIV style='left:496PX;top:702PX;width:86PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'> </span></DIV>";
print"<DIV style='left:360PX;top:816PX;width:263PX;height:27PX;'><span class='fc1-0'>ส่งของภายใน 15 วัน นับจากวันที่ที่ลงในใบสั่งซื้อ</span></DIV>";
print"<DIV style='left:360PX;top:842PX;width:319PX;height:27PX;'><span class='fc1-0'>ถ้าไม่สามารถส่งของได้ตามกำหนด ให้ติดต่อกลับภายใน 5 วัน</span></DIV>";
print"<DIV style='left:360PX;top:868PX;width:263PX;height:27PX;'><span class='fc1-0'>โทรศัพท์ 0-5422-1874 ต่อ 1163    FAX. 054-223071</span></DIV>";
print"<DIV style='left:10PX;top:951PX;width:209PX;height:27PX;'><span class='fc1-0'>บริษัท&nbsp;&nbsp;.....................................................</span></DIV>";
print"<DIV style='left:10PX;top:925PX;width:209PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>(…………………………………….)</span></DIV>";
print"<DIV style='left:10PX;top:889PX;width:209PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>……………………………………...........</span></DIV>";
print"<DIV style='left:10PX;top:873PX;width:209PX;height:27PX;'><span class='fc1-0'>ได้รับใบสั่งซื้อไปแล้ว</span></DIV>";
print"<DIV style='left:76PX;top:819PX;width:128PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>ขอแนบใบส่งของ 7 ชุด</span></DIV>";
print"<DIV style='left:76PX;top:840PX;width:128PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>ใบกำกับภาษี 1 ชุด</span></DIV>";
print"<DIV style='left:597PX;top:703PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-0'> </span></DIV>";
print"<DIV style='left:597PX;top:730PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-0'></span></DIV>";
print"<DIV style='left:597PX;top:763PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-0'>$nNetprice</span></DIV>";
print"<DIV style='left:10PX;top:1019PX;width:459PX;height:27PX;'><span class='fc1-0'>หมายเหตุ : กรุณาลงวันที่ส่งของในใบส่งของทุกใบ</span></DIV>";
print"<DIV style='left:344PX;top:942PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>หัวหน้าเจ้าหน้าที่พัสดุ</span></DIV>";
print"<DIV style='left:344PX;top:961PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>รพ.ค่ายสุรศักดิ์มนตรี</span></DIV>";
print"<BR>";
print"</BODY>";
print"</HTML>";
?>

