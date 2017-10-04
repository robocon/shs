<?php


//พิมพ์ใบสั่งซื้อชั่วคราว
    session_start();

if(isset($_GET["save"]) && $_GET["save"] == true){

	if (isset($sIdname)){} else {die;} 
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
    $nNetprice     =array_sum($aPrice);   

   $item=0;
   for ($n=1; $n<=$x; $n++){
          If (!empty($aDgcode[$n])){
             $item++;
		}
    };

 include("connect.inc");

       $query = "INSERT INTO pocompany(chktranx,date,prepono,prepodate,comcode,comname,items,netprice,pono, podate,officer)VALUES('$nRunno','$Thidate','รอข้อมูล!','','$cComcode','$cComname','$item','$nNetprice','','','$sOfficer');";
       $result = mysql_query($query) or die("**เตือน !ได้มีการบันทึกข้อมูลเรียบร้อยแล้ว<br>  -------- รายการจ่าย ---------<br>  $Thidate<br> ($cComcode)$cComname  จำนวนรายการที่สั่ง $x รวมเงินทั้งสิ้น $nNetprice บาท<br>");


  $idno=mysql_insert_id();

    $x--;
	for ($n=1; $n<=$x; $n++){
		if(!empty($aDgcode[$n])){
			if($aSnspec[$n]!=''){$aSnspec1[$n]='('.$aSnspec[$n].')';}
			else{$aSnspec1[$n]=$aSnspec[$n];};

			$query = "INSERT INTO poitems(drugcode,tradname,packing,pack,amount,minimum,totalstk,packpri,price,free,specno,idno) VALUES('$aDgcode[$n]','$aTrade[$n]$aSnspec1[$n]','$aPacking[$n]','$aPack[$n]', '$aAmount[$n]','$aMinimum[$n]','$aTotalstk[$n]','$aPackpri[$n]','$aPrice[$n]','','$aSpec[$n]','$idno');";
			$result = mysql_query($query) or die("Query failed,insert into poitems");
		}
	}
	$x++;

}

    $today = date("d-m-Y");
    $d=substr($today,0,2);
    $m=substr($today,3,2);
    $yr=substr($today,6,4) +543;  

  //  print "<font face='Angsana New'>วันที่  $d/$m/$yr<br>";
    //print "<font face='Angsana New'>รายการสั่งซื้อ  จาก ( $cComcode)  $cComname";
		$x--;
    	$nItems=$x;
		$aX   = array("x");
//		    $aSpec   = array(" specno");
//		    array_push($aSpec,$row->specno);
    $nTotalprice=0;    
    for ($n=1; $n<=$x; $n++){
          $nTotalprice=$nTotalprice+$aPrice_vat[$n];
          array_push($aX,"$n");
            }
    $x++;
	$oldx=$x;
//    print "  ราคารวมทั้งสิ้น $nTotalprice บาท";
$nNetprice_vat=$nTotalprice;

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
/*คำนวนค่าต่างๆ
  $nVat=$nNetprice*.07;
 $nVat=vat($nVat);//use function vat
  $nPriadvat=$nVat+$nNetprice;
//format 2 decimal
$nVat=number_format($nVat,2,'.',',');
$nPriadvat=number_format($nPriadvat,2,'.',',');
$nNetprice=number_format($nNetprice,2,'.',',');
  */
  $nNetprice_vat=number_format($nNetprice_vat,2,'.',',');

   ///$x,$nTotalprice,$aDgcode[$n],$aTrade[$n], $aPacking[$n], $aPack[$n], $aMinimum[$n],$aTotalstk[$n],  $aAmount[$n], $aPackpri[$n],$aPrice[$n],
 $nEnd=$nItems+1;
   $aTrade[$nEnd]="------- หมดรายการ -------"; 
$x=$oldx;

 include("connect.inc");

		$query1 = "SELECT * FROM company WHERE comcode = '$cComcode'";
		$result1 = mysql_query($query1)or
		die("Query failed");
		$row1 = mysql_fetch_array($result1);
		if($row1){
		$fax="(  ".$row1['fax']."  )";
		}
	

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
print".fc1-0 { COLOR:000000;FONT-SIZE:13PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";//13pt
print".fc1-1 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print".fc1-2 { COLOR:000000;FONT-SIZE:23PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print".fc1-3 { COLOR:000000;FONT-SIZE:19PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print".fc1-4 { COLOR:000000;FONT-SIZE:14PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";//14PT,NORMAL
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
print"<div style='left:365PX;top:251PX;border-color:000000;border-style:solid;border-width:0px;border-left-width:1PX;height:560PX;'><table width='0px' height='554PX'><td>&nbsp;</td></table></div>";
print"<div style='left:461PX;top:251PX;border-color:000000;border-style:solid;border-width:0px;border-left-width:1PX;height:560PX;'><table width='0px' height='554PX'><td>&nbsp;</td></table></div>";
print"<div style='left:515PX;top:251PX;border-color:000000;border-style:solid;border-width:0px;border-left-width:1PX;height:559PX;'><table width='0px' height='553PX'><td>&nbsp;</td></table></div>";
print"<div style='left:585PX;top:251PX;border-color:000000;border-style:solid;border-width:0px;border-left-width:1PX;height:560PX;'><table width='0px' height='554PX'><td>&nbsp;</td></table></div>";
print"<div style='left:679PX;top:251PX;border-color:000000;border-style:solid;border-width:0px;border-left-width:1PX;height:559PX;'><table width='0px' height='553PX'><td>&nbsp;</td></table></div>";
print"<div style='left:187PX;top:243PX;border-color:000000;border-style:solid;border-width:0px;border-top-width:1PX;width:399PX;'></div>";
print"<div style='left:8PX;top:758PX;border-color:000000;border-style:solid;border-width:0px;border-top-width:1PX;width:743PX;'></div>";
print"<div style='left:124PX;top:783PX;border-color:000000;border-style:solid;border-width:0px;border-top-width:1PX;width:102PX;'></div>";
print"<div style='left:362PX;top:924PX;border-color:000000;border-style:solid;border-width:0px;border-top-width:1PX;width:234PX;'></div>";
print"<DIV class='box' style='z-index:10; border-color:000000;border-style:solid;border-bottom-style:solid;border-bottom-width:1PX;border-left-style:solid;border-left-width:1PX;border-top-style:solid;border-top-width:1PX;border-right-style:solid;border-right-width:1PX;left:7PX;top:251PX;width:743PX;height:559PX;'>
<table border=0 cellpadding=0 cellspacing=0 width=736px height=552px><TD>&nbsp;</TD></TABLE>
</DIV>";
print"<DIV class='box' style='z-index:10; border-color:000000;border-style:solid;border-bottom-style:solid;border-bottom-width:1PX;border-left-style:solid;border-left-width:1PX;border-top-style:solid;border-top-width:1PX;border-right-style:solid;border-right-width:1PX;left:44PX;top:819PX;width:181PX;height:45PX;'>
<table border=0 cellpadding=0 cellspacing=0 width=174px height=38px><TD>&nbsp;</TD></TABLE>
</DIV>";
print"<DIV style='left:518PX;top:195PX;width:105PX;height:26PX;'><span class='fc1-0'>$cPrepodate</span></DIV>";
print"<DIV style='left:310PX;top:195PX;width:159PX;height:26PX;'><span class='fc1-0'>$cPrepono</span></DIV>";
print"<DIV style='left:194PX;top:090PX;width:364PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-1'>ใบสั่งซื้อยาและเวชภัณฑ์สิ้นเปลือง</span></DIV>";
print"<DIV style='left:281PX;top:195PX;width:30PX;height:26PX;'><span class='fc1-0'>เลขที่ </span></DIV>";
print"<DIV style='left:490PX;top:195PX;width:100PX;height:26PX;'><span class='fc1-0'>วันที่ $d/$m/$yr </span></DIV>";
print"<DIV style='left:7PX;top:253PX;width:38PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>ลำดับ</span></DIV>";
print"<DIV style='left:49PX;top:253PX;width:258PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>รายการ</span></DIV>";
print"<DIV style='left:313PX;top:253PX;width:51PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>หน่วยนับ</span></DIV>";
print"<DIV style='left:371PX;top:253PX;width:85PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>ขนาดบรรจุ</span></DIV>";
print"<DIV style='left:467PX;top:253PX;width:43PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>จำนวน</span></DIV>";
print"<DIV style='left:520PX;top:248PX;width:61PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>หน่วยละ</span></DIV>";
print"<DIV style='left:518PX;top:262PX;width:64PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>รวม VAT</span></DIV>";
print"<DIV style='left:590PX;top:248PX;width:85PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>เป็นเงิน</span></DIV>";
print"<DIV style='left:600PX;top:262PX;width:64PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>รวม VAT</span></DIV>";
print"<DIV style='left:684PX;top:253PX;width:61PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>spec.</span></DIV>";


print"<DIV style='left:194PX;top:120PX;width:364PX;height:41PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>โรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง</span></DIV>";
print"<DIV style='left:194PX;top:163PX;width:364PX;height:34PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>มทบ.32</span></DIV>";
print"<DIV style='left:187PX;top:222PX;width:397PX;height:26PX;'><span class='fc1-0'>
	($cComcode)$cComname&nbsp;&nbsp;&nbsp;$fax</span></DIV>";
print"<DIV style='left:97PX;top:222PX;width:91PX;height:26PX;'><span class='fc1-0'>ขอสั่งซื้อของจาก </span></DIV>";
print"<DIV style='left:315PX;top:195PX;width:150PX;height:26PX;'><span class='fc1-0'>กห 0483.63.4 /
	".$_SESSION['ponumber']."</span></DIV>";
	
print"<DIV style='left:586PX;top:222PX;width:104PX;height:26PX;'><span class='fc1-0'>ดังมีรายการต่อไปนี้</span></DIV>";
print"<DIV style='left:684PX;top:167PX;width:61PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>งบรายรับ</span></DIV>";


///แถวที่1$aSnspec[1]
print"<DIV style='left:11PX;top:289PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[1]</span></DIV>";
print"<DIV style='left:49PX;top:289PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTrade[1]&nbsp;&nbsp;</span></DIV>";
print"<DIV style='left:49PX;top:304PX;width:250PX;height:22PX;'><span class='fc1-4'>$aSnspec[1]</span></DIV>";
print"<DIV style='left:306PX;top:289PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[1]</span></DIV>";
print"<DIV style='left:362PX;top:289PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[1]</span></DIV>";
print"<DIV style='left:462PX;top:289PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-1'>$aAmount[1]</span></DIV>";
print"<DIV style='left:519PX;top:289PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-1'>$aPackpri_vat[1]</span></DIV>";	
print"<DIV style='left:597PX;top:289PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-1'>$aPrice_vat[1]</span></DIV>";
print"<DIV style='left:679PX;top:289PX;width:75PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpec[1]</span></DIV>";
	
///แถวที่2
print"<DIV style='left:11PX;top:319PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[2]</span></DIV>";
print"<DIV style='left:49PX;top:319PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTrade[2]</span></DIV>";
print"<DIV style='left:49PX;top:334PX;width:250PX;height:22PX;'><span class='fc1-4'> $aSnspec[2]</span></DIV>";
print"<DIV style='left:306PX;top:319PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[2]</span></DIV>";
print"<DIV style='left:362PX;top:319PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[2]</span></DIV>";
print"<DIV style='left:462PX;top:319PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-1'>$aAmount[2]</span></DIV>";
print"<DIV style='left:519PX;top:319PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-1'>$aPackpri_vat[2]</span></DIV>";	
print"<DIV style='left:597PX;top:319PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-1'>$aPrice_vat[2]</span></DIV>";
print"<DIV style='left:679PX;top:319PX;width:75PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpec[2]</span></DIV>";
	
///แถวที่3
print"<DIV style='left:11PX;top:349PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[3]</span></DIV>";
print"<DIV style='left:49PX;top:349PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTrade[3]</span></DIV>";
print"<DIV style='left:49PX;top:364PX;width:250PX;height:22PX;'><span class='fc1-4'> $aSnspec[3]</span></DIV>";
print"<DIV style='left:306PX;top:349PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[3]</span></DIV>";
print"<DIV style='left:362PX;top:349PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[3]</span></DIV>";
print"<DIV style='left:462PX;top:349PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-1'>$aAmount[3]</span></DIV>";
print"<DIV style='left:519PX;top:349PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-1'>$aPackpri_vat[3]</span></DIV>";	
print"<DIV style='left:597PX;top:349PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-1'>$aPrice_vat[3]</span></DIV>";
print"<DIV style='left:679PX;top:349PX;width:75PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpec[3]</span></DIV>";
	
///แถวที่4
print"<DIV style='left:11PX;top:379PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[4]</span></DIV>";
print"<DIV style='left:49PX;top:379PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTrade[4]</span></DIV>";
print"<DIV style='left:49PX;top:394PX;width:250PX;height:22PX;'><span class='fc1-4'> $aSnspec[4]</span></DIV>";
print"<DIV style='left:306PX;top:379PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[4]</span></DIV>";
print"<DIV style='left:362PX;top:379PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[4]</span></DIV>";
print"<DIV style='left:462PX;top:379PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-1'>$aAmount[4]</span></DIV>";
print"<DIV style='left:519PX;top:379PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-1'>$aPackpri_vat[4]</span></DIV>";	
print"<DIV style='left:597PX;top:379PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-1'>$aPrice_vat[4]</span></DIV>";
print"<DIV style='left:679PX;top:379PX;width:75PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpec[4]</span></DIV>";
		
///แถวที่5
print"<DIV style='left:11PX;top:409PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[5]</span></DIV>";
print"<DIV style='left:49PX;top:409PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTrade[5]</span></DIV>";
print"<DIV style='left:49PX;top:424PX;width:250PX;height:22PX;'><span class='fc1-4'> $aSnspec[5]</span></DIV>";
print"<DIV style='left:306PX;top:409PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[5]</span></DIV>";
print"<DIV style='left:362PX;top:409PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[5]</span></DIV>";
print"<DIV style='left:462PX;top:409PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-1'>$aAmount[5]</span></DIV>";
print"<DIV style='left:519PX;top:409PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-1'>$aPackpri_vat[5]</span></DIV>";	
print"<DIV style='left:597PX;top:409PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-1'>$aPrice_vat[5]</span></DIV>";
print"<DIV style='left:679PX;top:409PX;width:75PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpec[5]</span></DIV>";

	
///แถวที่6
print"<DIV style='left:11PX;top:439PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[6]</span></DIV>";
print"<DIV style='left:49PX;top:439PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTrade[6]</span></DIV>";
print"<DIV style='left:49PX;top:454PX;width:250PX;height:22PX;'><span class='fc1-4'> $aSnspec[6]</span></DIV>";
print"<DIV style='left:306PX;top:439PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[6]</span></DIV>";
print"<DIV style='left:362PX;top:439PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[6]</span></DIV>";
print"<DIV style='left:462PX;top:439PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-1'>$aAmount[6]</span></DIV>";
print"<DIV style='left:519PX;top:439PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-1'>$aPackpri_vat[6]</span></DIV>";	
print"<DIV style='left:597PX;top:439PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-1'>$aPrice_vat[6]</span></DIV>";
print"<DIV style='left:679PX;top:439PX;width:75PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpec[6]</span></DIV>";

	
///แถวที่7
print"<DIV style='left:11PX;top:469PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[7]</span></DIV>";
print"<DIV style='left:49PX;top:469PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTrade[7]</span></DIV>";
print"<DIV style='left:49PX;top:484PX;width:250PX;height:22PX;'><span class='fc1-4'> $aSnspec[7]</span></DIV>";
print"<DIV style='left:306PX;top:469PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[7]</span></DIV>";
print"<DIV style='left:362PX;top:469PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[7]</span></DIV>";
print"<DIV style='left:462PX;top:469PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-1'>$aAmount[7]</span></DIV>";
print"<DIV style='left:519PX;top:469PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-1'>$aPackpri_vat[7]</span></DIV>";	
print"<DIV style='left:597PX;top:469PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-1'>$aPrice_vat[7]</span></DIV>";
print"<DIV style='left:679PX;top:469PX;width:75PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpec[7]</span></DIV>";

///แถวที่8
print"<DIV style='left:11PX;top:499PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[8]</span></DIV>";
print"<DIV style='left:49PX;top:499PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTrade[8]</span></DIV>";
print"<DIV style='left:49PX;top:514PX;width:250PX;height:22PX;'><span class='fc1-4'> $aSnspec[8]</span></DIV>";
print"<DIV style='left:306PX;top:499PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[8]</span></DIV>";
print"<DIV style='left:362PX;top:499PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[8]</span></DIV>";
print"<DIV style='left:462PX;top:499PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-1'>$aAmount[8]</span></DIV>";
print"<DIV style='left:519PX;top:499PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-1'>$aPackpri_vat[8]</span></DIV>";	
print"<DIV style='left:597PX;top:499PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-1'>$aPrice_vat[8]</span></DIV>";
print"<DIV style='left:679PX;top:499PX;width:75PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpec[8]</span></DIV>";
	
///แถวที่9
print"<DIV style='left:11PX;top:529PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[9]</span></DIV>";
print"<DIV style='left:49PX;top:529PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTrade[9]</span></DIV>";
print"<DIV style='left:49PX;top:544PX;width:250PX;height:22PX;'><span class='fc1-4'> $aSnspec[9]</span></DIV>";
print"<DIV style='left:306PX;top:529PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[9]</span></DIV>";
print"<DIV style='left:362PX;top:529PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[9]</span></DIV>";
print"<DIV style='left:462PX;top:529PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-1'>$aAmount[9]</span></DIV>";
print"<DIV style='left:519PX;top:529PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-1'>$aPackpri_vat[9]</span></DIV>";	
print"<DIV style='left:597PX;top:529PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-1'>$aPrice_vat[9]</span></DIV>";
print"<DIV style='left:679PX;top:529PX;width:75PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpec[9]</span></DIV>";
	
///แถวที่10
print"<DIV style='left:11PX;top:559PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[10]</span></DIV>";
print"<DIV style='left:49PX;top:559PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTrade[10]</span></DIV>";
print"<DIV style='left:49PX;top:574PX;width:250PX;height:22PX;'><span class='fc1-4'> $aSnspec[10]</span></DIV>";
print"<DIV style='left:306PX;top:559PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[10]</span></DIV>";
print"<DIV style='left:362PX;top:559PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[10]</span></DIV>";
print"<DIV style='left:462PX;top:559PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-1'>$aAmount[10]</span></DIV>";
print"<DIV style='left:519PX;top:559PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-1'>$aPackpri_vat[10]</span></DIV>";	
print"<DIV style='left:597PX;top:559PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-1'>$aPrice_vat[10]</span></DIV>";
print"<DIV style='left:679PX;top:559PX;width:75PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpec[10]</span></DIV>";
	
///แถวที่11
print"<DIV style='left:11PX;top:589PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[11]</span></DIV>";
print"<DIV style='left:49PX;top:589PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTrade[11]</span></DIV>";
print"<DIV style='left:49PX;top:604PX;width:250PX;height:22PX;'><span class='fc1-4'> $aSnspec[11]</span></DIV>";
print"<DIV style='left:306PX;top:589PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[11]</span></DIV>";
print"<DIV style='left:362PX;top:589PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[11]</span></DIV>";
print"<DIV style='left:462PX;top:589PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-1'>$aAmount[11]</span></DIV>";
print"<DIV style='left:519PX;top:589PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-1'>$aPackpri_vat[11]</span></DIV>";	
print"<DIV style='left:597PX;top:589PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-1'>$aPrice_vat[11]</span></DIV>";
print"<DIV style='left:679PX;top:589PX;width:75PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpec[11]</span></DIV>";
	
///แถวที่12
print"<DIV style='left:11PX;top:619PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[12]</span></DIV>";
print"<DIV style='left:49PX;top:619PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTrade[12]</span></DIV>";
print"<DIV style='left:49PX;top:634PX;width:250PX;height:22PX;'><span class='fc1-4'> $aSnspec[12]</span></DIV>";
print"<DIV style='left:306PX;top:619PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[12]</span></DIV>";
print"<DIV style='left:362PX;top:619PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[12]</span></DIV>";
print"<DIV style='left:462PX;top:619PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-1'>$aAmount[12]</span></DIV>";
print"<DIV style='left:519PX;top:619PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-1'>$aPackpri_vat[12]</span></DIV>";	
print"<DIV style='left:597PX;top:619PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-1'>$aPrice_vat[12]</span></DIV>";
print"<DIV style='left:679PX;top:619PX;width:75PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpec[12]</span></DIV>";

	
///แถวที่13
print"<DIV style='left:11PX;top:649PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[13]</span></DIV>";
print"<DIV style='left:49PX;top:649PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTrade[13]</span></DIV>";
print"<DIV style='left:49PX;top:664PX;width:250PX;height:22PX;'><span class='fc1-4'> $aSnspec[13]</span></DIV>";
print"<DIV style='left:306PX;top:649PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aPacking[13]</span></DIV>";
print"<DIV style='left:362PX;top:649PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-4'>$aPack[13]</span></DIV>";
print"<DIV style='left:462PX;top:649PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-1'>$aAmount[13]</span></DIV>";
print"<DIV style='left:519PX;top:649PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-1'>$aPackpri_vat[13]</span></DIV>";	
print"<DIV style='left:597PX;top:649PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-1'>$aPrice_vat[13]</span></DIV>";
print"<DIV style='left:679PX;top:649PX;width:75PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aSpec[13]</span></DIV>";
	
/////////สรุปรวม
print"<DIV style='left:128PX;top:761PX;width:93PX;height:26PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-0'>$nItems</span></DIV>";
print"<DIV style='left:99PX;top:761PX;width:25PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>รวม</span></DIV>";
print"<DIV style='left:225PX;top:761PX;width:44PX;height:27PX;'><span class='fc1-0'>รายการ</span></DIV>";
print"<DIV style='left:105PX;top:993PX;width:542PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'></span></DIV>";
print"<DIV style='left:269PX;top:899PX;width:87PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-5'>พ.อ. หญิง</span></DIV>";
print"<DIV style='left:344PX;top:922PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>(พรทิพา&nbsp;&nbsp;จันทร์ณรงค์)</span></DIV>";
print"<DIV style='left:496PX;top:730PX;width:86PX;height:26PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'> </span></DIV>";
print"<DIV style='left:538PX;top:763PX;width:44PX;height:27PX;'><span class='fc1-0'>รวมสุทธิ</span></DIV>";
print"<DIV style='left:496PX;top:702PX;width:86PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'> </span></DIV>";
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
<span class='fc1-0'> </span></DIV>";
print"<DIV style='left:597PX;top:730PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-0'></span></DIV>";
print"<DIV style='left:597PX;top:763PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-1'>$nNetprice_vat</span></DIV>";
print"<DIV style='left:10PX;top:1019PX;width:479PX;height:27PX;'><span class='fc1-0'><u>หมายเหตุ : ให้ลงวันที่ในใบส่งของและใบเสร็จรับเงิน หลังวันที่ใน PO ยกเว้นวันเสาร์ - อาทิตย์</u></span></DIV>";
print"<DIV style='left:344PX;top:942PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>หัวหน้าเจ้าหน้าที่</span></DIV>";
print"<DIV style='left:344PX;top:961PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>รพ.ค่ายสุรศักดิ์มนตรี</span></DIV>";
print"<BR>";
print"</BODY>";
print"</HTML>";
array_pop($aTrade);
?>

