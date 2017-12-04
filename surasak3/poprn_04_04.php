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
		$aMancode[11]='headmony';


	for ($n=1; $n<=11; $n++){

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

    $query = "SELECT date,prepono,prepodate,comcode,comname,items,netprice,pono,podate,bounddate,row_id FROM pocompany WHERE row_id = '$nRow_id' ";
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
	$cPrepono=$row->prepono;
	$cPrepodate=$row->prepodate;
	$cComcode=$row->comcode;
	$cComname=$row->comname;
	$nItems=$row->items;
	$nNetprice=$row->netprice;
	$cPono=$row->pono;
	$cPodate=$row->podate;
	$cBounddate=$row->bounddate;
//คำนวนค่าต่างๆ
  $nVat=$nNetprice - ($nNetprice /1.07);
 /// $nVat=number_format($nVat,2,'.',''); //convert to string ทศนิยม 2 ตำแหน่ง ปัดเศษ
 ///$nVat=floatval ($nVat);// convert to float-number

$nVat=vat($nVat);//use function vat
$nNetprice=$nNetprice-$nVat;
  $nPriadvat=$nVat+$nNetprice;
  $cPriadvat=baht($nPriadvat);//ตัวอักษร

  $nTax=.01*$nNetprice;
  $nNetpaid=$nPriadvat-$nTax;

  $cNetpaid=baht($nNetpaid);//ตัวอักษร
////กรรมการ3คน, 1คน
	$cKumkan="กรรมการตรวจรับพัสดุ";
	$nKumkan=3;
	$cBe="เป็น";
if ($nPriadvat < '10000'){
	$cKumkan="ผู้ตรวจรับพัสดุ";
	$nKumkan=1;
	$aPost[6]="ผู้ตรวจรับพัสดุ";
	$aYot[7]="";
	$aFname[7]="";   
	$aPost[7]="";
	$aYot[8]="";
	$aFname[8]="";   
	$aPost[8]="";
	$cBe="";
};
//print"$nPriadvat $cKumkan $nKumkan<br>";

//ทำเป็นสองจุดทศนิยม 
	$nNetprice=number_format($nNetprice,2,'.',',');
	//$nVat=number_format($nVat,2);
               $nVat=number_format($nVat,2,'.',',');
	$nPriadvat=number_format($nPriadvat,2,'.',',');
	$nTax=number_format($nTax,2,'.',',');
	$nNetpaid=number_format($nNetpaid,2,'.',',');

/////List รายการ
   $x=0;
    $aX   = array("x");
  $aDrugcode=array("drugcode");
    $aTradname  = array("tradname ");
  $aPacking  = array(" packing");
  $aPack  = array("pack");
  $aAmount  = array(" amount");
    $aPrice   = array(" price");
    $aPackpri  = array(" packpri");
  $aFree = array("free");
    $aSpecno   = array(" specno");
//$x  $drugcode $tradname $packing  $pack  $amount  $price  $packpri  $specno 

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
    array_push($aX,"$x");
    array_push($aDrugcode,$row->drugcode);
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
    array_push($aFree,$row->free);
    array_push($aSpecno,$row->specno);
       }
	$x++;
    array_push($aX,"");
    array_push($aDrugcode,"");
  array_push($aTradname,"------- หมดรายการ -------"); 
    array_push($aPacking,"");
    array_push($aPack,"");
    array_push($aAmount ,"");
    array_push($aPrice,"");
    array_push($aPackpri,"");
    array_push($aFree,"");
    array_push($aSpecno,"");
//มีได้ 12 รายการ+หมดรายการ(13แถว) ใส่ NULL ให้array ที่เหลือดังนี้
for ($n=$x+1; $n<=13; $n++){
    array_push($aX,"");
    array_push($aDrugcode,"");
  array_push($aTradname,""); 
    array_push($aPacking,"");
    array_push($aPack,"");
    array_push($aAmount ,"");
    array_push($aPrice,"");
    array_push($aPackpri,"");
    array_push($aFree,"");
    array_push($aSpecno,"");
}
//po95 ใบ 4
///*
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

print "<head>";
print "<STYLE>";
 print "A {text-decoration:none}";
 print "A IMG {border-style:none; border-width:0;}";
 print "DIV {position:absolute; z-index:25;}";
print ".fc1-0 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:NORMAL;}";
print ".fc1-1 { COLOR:000000;FONT-SIZE:19PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:BOLD;}";
print ".fc1-2 { COLOR:000000;FONT-SIZE:13PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:NORMAL;}";
print ".fc1-3 { COLOR:000000;FONT-SIZE:11PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:NORMAL;}";
print ".fc1-4{ COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:BOLD;TEXT-DECORATION:UNDERLINE;}";
print ".fc1-5 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:BOLD;}";


print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";
print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-style:dashed;border-top-width:1PX;border-right-width:0PX;}";
print ".ad1-2 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-style:dashed;border-left-width:1PX;border-top-width:0PX;border-right-width:0PX;}";
print ".ad1-3 {border-color:000000;border-style:none;border-bottom-style:dashed;border-bottom-width:1PX;border-left-style:dashed;border-left-width:1PX;border-top-style:dashed;border-top-width:1PX;border-right-style:dashed;border-right-width:1PX;}";
print "</STYLE>";
print "<TITLE>Crystal Report Viewer</TITLE>";
print "</head>";
print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";
print "<DIV style='z-index:0'> &nbsp; </div>";
print "<div style='left:8PX;top:226PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:743PX;'>";
print "</div>";
print "<div style='left:44PX;top:196PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:690PX;'>";
print "<table width='0px' height='555PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:424PX;top:196PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:690PX;'>";
print "<table width='0px' height='555PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:478PX;top:196PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:690PX;'>";
print "<table width='0px' height='555PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:531PX;top:196PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:690PX;'>";
print "<table width='0px' height='555PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:585PX;top:196PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:690PX;'>";
print "<table width='0px' height='554PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:655PX;top:196PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:690PX;'>";
print "<table width='0px' height='555PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:8PX;top:834PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:743PX;'>";
print "</div>";
//print "<div style='left:174PX;top:3813PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:102PX;'>";
//print "</div>";
print "<DIV class='box' style='z-index:10; border-color:000000;border-style:dashed;border-bottom-style:dashed;border-bottom-width:1PX;border-left-style:dashed;border-left-width:1PX;border-top-style:dashed;border-top-width:1PX;border-right-style:dashed;border-right-width:1PX;left:7PX;top:196PX;width:743PX;height:690PX;'>";
print "<table border=0 cellpadding=0 cellspacing=0 width=736px height=553px><TD>&nbsp;</TD></TABLE>";
print "</DIV>";
print "<DIV style='left:504PX;top:115PX;width:194PX;height:26PX;'><span class='fc1-2'>$cPodate</span></DIV>";
print "<DIV style='left:71PX;top:91PX;width:159PX;height:26PX;'><span class='fc1-2'>$cPono</span></DIV>";
print "<DIV style='left:130PX;top:45PX;width:364PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>ใบสั่งซื้อเป็นข้อตกลงแทนการทำสัญญา</span></DIV>";
print "<DIV style='left:6PX;top:91PX;width:66PX;height:26PX;'><span class='fc1-2'> ใบสั่งซื้อที่</span></DIV>";
print "<DIV style='left:474PX;top:115PX;width:31PX;height:26PX;'><span class='fc1-2'>วันที่</span></DIV>";
print "<DIV style='left:7PX;top:199PX;width:38PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>ลำดับ</span></DIV>";
print "<DIV style='left:8PX;top:199PX;width:373PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>รายการ</span></DIV>";
print "<DIV style='left:426PX;top:199PX;width:51PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>หน่วยนับ</span></DIV>";
print "<DIV style='left:537PX;top:199PX;width:43PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>แถม</span></DIV>";
print "<DIV style='left:590PX;top:196PX;width:61PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>หน่วยละ</span></DIV>";
print "<DIV style='left:660PX;top:196PX;width:85PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>เป็นเงิน</span></DIV>";
print "<DIV style='left:670PX;top:208PX;width:64PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>ไม่รวม VAT</span></DIV>";
print "<DIV style='left:588PX;top:208PX;width:64PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>ไม่รวม VAT</span></DIV>";
print "<DIV style='left:668PX;top:26PX;width:82PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>(ย.37)</span></DIV>";
print "<DIV style='left:668PX;top:10PX;width:82PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>ทบ.101-048</span></DIV>";
print "<DIV style='left:7PX;top:165PX;width:761PX;height:26PX;'><span class='fc1-2'>ร.พ. ค่ายสุรศักดิ์มนตรี  และปฏิบัติตามข้อตกลงระหว่างผู้ซื้อและผู้ขาย แนบท้ายใบสั่งซื้อ เป็นข้อตกลงแทนการทำสัญญาใบสั่งซื้อที่ $cPono ลง $cPodate </span></DIV>";
print "<DIV style='left:516PX;top:91PX;width:234PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>......................................................................</span></DIV>";
print "<DIV style='left:483PX;top:199PX;width:43PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>จำนวน</span></DIV>";
print "<DIV style='left:7PX;top:140PX;width:761PX;height:26PX;'><span class='fc1-2'>ถึง
  <B>$cComname</B> ตามที่ท่านตกลงส่งยาตามใบสั่งซื้อ ขอให้ท่านทราบและจัดการส่งของไปยัง คลังส่งกำลัง  </span></DIV>";

///Line1
 print "<DIV style='left:589PX;top:235PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[1]</span></DIV>";
 print "<DIV style='left:419PX;top:235PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[1]</span></DIV>";
 print "<DIV style='left:11PX;top:235PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[1]</span></DIV>";
 print "<DIV style='left:48PX;top:235PX;width:373PX;height:22PX;'><span class='fc1-3'>$aTradname[1]</span></DIV>";
 print "<DIV style='left:475PX;top:235PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[1]</span></DIV>";
 print "<DIV style='left:529PX;top:235PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aFree[1]</span></DIV>";
 print "<DIV style='left:667PX;top:235PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[1]</span></DIV>";
///Line2
 print "<DIV style='left:589PX;top:255PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[2]</span></DIV>";
 print "<DIV style='left:419PX;top:255PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[2]</span></DIV>";
 print "<DIV style='left:11PX;top:255PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[2]</span></DIV>";
 print "<DIV style='left:48PX;top:255PX;width:373PX;height:22PX;'><span class='fc1-3'>$aTradname[2]</span></DIV>";
 print "<DIV style='left:475PX;top:255PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[2]</span></DIV>";
 print "<DIV style='left:529PX;top:255PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aFree[2]</span></DIV>";
 print "<DIV style='left:667PX;top:255PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[2]</span></DIV>";

///Line3
 print "<DIV style='left:589PX;top:275PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[3]</span></DIV>";
 print "<DIV style='left:419PX;top:275PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[3]</span></DIV>";
 print "<DIV style='left:11PX;top:275PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[3]</span></DIV>";
 print "<DIV style='left:48PX;top:275PX;width:373PX;height:22PX;'><span class='fc1-3'>$aTradname[3]</span></DIV>";
 print "<DIV style='left:475PX;top:275PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[3]</span></DIV>";
 print "<DIV style='left:529PX;top:275PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aFree[3]</span></DIV>";
 print "<DIV style='left:667PX;top:275PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[3]</span></DIV>";
///Line4
 print "<DIV style='left:589PX;top:295PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[4]</span></DIV>";
 print "<DIV style='left:419PX;top:295PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[4]</span></DIV>";
 print "<DIV style='left:11PX;top:295PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[4]</span></DIV>";
 print "<DIV style='left:48PX;top:295PX;width:373PX;height:22PX;'><span class='fc1-3'>$aTradname[4]</span></DIV>";
 print "<DIV style='left:475PX;top:295PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[4]</span></DIV>";
 print "<DIV style='left:529PX;top:295PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aFree[4]</span></DIV>";
 print "<DIV style='left:667PX;top:295PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[4]</span></DIV>";

///Line5
 print "<DIV style='left:589PX;top:315PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[5]</span></DIV>";
 print "<DIV style='left:419PX;top:315PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[5]</span></DIV>";
 print "<DIV style='left:11PX;top:315PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[5]</span></DIV>";
 print "<DIV style='left:48PX;top:315PX;width:373PX;height:22PX;'><span class='fc1-3'>$aTradname[5]</span></DIV>";
 print "<DIV style='left:475PX;top:315PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[5]</span></DIV>";
 print "<DIV style='left:529PX;top:315PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aFree[5]</span></DIV>";
 print "<DIV style='left:667PX;top:315PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[5]</span></DIV>";

///Line6
 print "<DIV style='left:589PX;top:335PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[6]</span></DIV>";
 print "<DIV style='left:419PX;top:335PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[6]</span></DIV>";
 print "<DIV style='left:11PX;top:335PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[6]</span></DIV>";
 print "<DIV style='left:48PX;top:335PX;width:373PX;height:22PX;'><span class='fc1-3'>$aTradname[6]</span></DIV>";
 print "<DIV style='left:475PX;top:335PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[6]</span></DIV>";
 print "<DIV style='left:529PX;top:335PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aFree[6]</span></DIV>";
 print "<DIV style='left:667PX;top:335PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[6]</span></DIV>";

///Line7
 print "<DIV style='left:589PX;top:355PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[7]</span></DIV>";
 print "<DIV style='left:419PX;top:355PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[7]</span></DIV>";
 print "<DIV style='left:11PX;top:355PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[7]</span></DIV>";
 print "<DIV style='left:48PX;top:355PX;width:373PX;height:22PX;'><span class='fc1-3'>$aTradname[7]</span></DIV>";
 print "<DIV style='left:475PX;top:355PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[7]</span></DIV>";
 print "<DIV style='left:529PX;top:355PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aFree[7]</span></DIV>";
 print "<DIV style='left:667PX;top:355PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[7]</span></DIV>";

///Line8
 print "<DIV style='left:589PX;top:375PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[8]</span></DIV>";
 print "<DIV style='left:419PX;top:375PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[8]</span></DIV>";
 print "<DIV style='left:11PX;top:375PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[8]</span></DIV>";
 print "<DIV style='left:48PX;top:375PX;width:373PX;height:22PX;'><span class='fc1-3'>$aTradname[8]</span></DIV>";
 print "<DIV style='left:475PX;top:375PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[8]</span></DIV>";
 print "<DIV style='left:529PX;top:375PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aFree[8]</span></DIV>";
 print "<DIV style='left:667PX;top:375PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[8]</span></DIV>";

///Line9
 print "<DIV style='left:589PX;top:395PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[9]</span></DIV>";
 print "<DIV style='left:419PX;top:395PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[9]</span></DIV>";
 print "<DIV style='left:11PX;top:395PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[9]</span></DIV>";
 print "<DIV style='left:48PX;top:395PX;width:373PX;height:22PX;'><span class='fc1-3'>$aTradname[9]</span></DIV>";
 print "<DIV style='left:475PX;top:395PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[9]</span></DIV>";
 print "<DIV style='left:529PX;top:395PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aFree[9]</span></DIV>";
 print "<DIV style='left:667PX;top:395PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[9]</span></DIV>";

///Line10
 print "<DIV style='left:589PX;top:415PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[10]</span></DIV>";
 print "<DIV style='left:419PX;top:415PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[10]</span></DIV>";
 print "<DIV style='left:11PX;top:415PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[10]</span></DIV>";
 print "<DIV style='left:48PX;top:415PX;width:373PX;height:22PX;'><span class='fc1-3'>$aTradname[10]</span></DIV>";
 print "<DIV style='left:475PX;top:415PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[10]</span></DIV>";
 print "<DIV style='left:529PX;top:415PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aFree[10]</span></DIV>";
 print "<DIV style='left:667PX;top:415PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[10]</span></DIV>";

///Line11
 print "<DIV style='left:589PX;top:435PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[11]</span></DIV>";
 print "<DIV style='left:419PX;top:435PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[11]</span></DIV>";
 print "<DIV style='left:11PX;top:435PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[11]</span></DIV>";
 print "<DIV style='left:48PX;top:435PX;width:373PX;height:22PX;'><span class='fc1-3'>$aTradname[11]</span></DIV>";
 print "<DIV style='left:475PX;top:435PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[11]</span></DIV>";
 print "<DIV style='left:529PX;top:435PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aFree[11]</span></DIV>";
 print "<DIV style='left:667PX;top:435PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[11]</span></DIV>";

///Line12
 print "<DIV style='left:589PX;top:455PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[12]</span></DIV>";
 print "<DIV style='left:419PX;top:455PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[12]</span></DIV>";
 print "<DIV style='left:11PX;top:455PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[12]</span></DIV>";
 print "<DIV style='left:48PX;top:455PX;width:373PX;height:22PX;'><span class='fc1-3'>$aTradname[12]</span></DIV>";
 print "<DIV style='left:475PX;top:455PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[12]</span></DIV>";
 print "<DIV style='left:529PX;top:455PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aFree[12]</span></DIV>";
 print "<DIV style='left:667PX;top:455PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[12]</span></DIV>";

///Line13
 print "<DIV style='left:589PX;top:475PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[13]</span></DIV>";
 print "<DIV style='left:419PX;top:475PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[13]</span></DIV>";
 print "<DIV style='left:11PX;top:475PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[13]</span></DIV>";
 print "<DIV style='left:48PX;top:475PX;width:373PX;height:22PX;'><span class='fc1-3'>$aTradname[13]</span></DIV>";
 print "<DIV style='left:475PX;top:475PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[13]</span></DIV>";
 print "<DIV style='left:529PX;top:475PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aFree[13]</span></DIV>";
 print "<DIV style='left:667PX;top:475PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[13]</span></DIV>";


///Line14
 print "<DIV style='left:589PX;top:495PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[14]</span></DIV>";
 print "<DIV style='left:419PX;top:495PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[14]</span></DIV>";
 print "<DIV style='left:11PX;top:495PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[14]</span></DIV>";
 print "<DIV style='left:48PX;top:495PX;width:373PX;height:22PX;'><span class='fc1-3'>$aTradname[14]</span></DIV>";
 print "<DIV style='left:475PX;top:495PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[14]</span></DIV>";
 print "<DIV style='left:529PX;top:495PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aFree[14]</span></DIV>";
 print "<DIV style='left:667PX;top:495PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[14]</span></DIV>";

///Line15
 print "<DIV style='left:589PX;top:515PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[15]</span></DIV>";
 print "<DIV style='left:419PX;top:515PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[15]</span></DIV>";
 print "<DIV style='left:11PX;top:515PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[15]</span></DIV>";
 print "<DIV style='left:48PX;top:515PX;width:373PX;height:22PX;'><span class='fc1-3'>$aTradname[15]</span></DIV>";
 print "<DIV style='left:475PX;top:515PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[15]</span></DIV>";
 print "<DIV style='left:529PX;top:515PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aFree[15]</span></DIV>";
 print "<DIV style='left:667PX;top:515PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[15]</span></DIV>";

///Line16
 print "<DIV style='left:589PX;top:535PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[16]</span></DIV>";
 print "<DIV style='left:419PX;top:535PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[16]</span></DIV>";
 print "<DIV style='left:11PX;top:535PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[16]</span></DIV>";
 print "<DIV style='left:48PX;top:535PX;width:373PX;height:22PX;'><span class='fc1-3'>$aTradname[16]</span></DIV>";
 print "<DIV style='left:475PX;top:535PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[16]</span></DIV>";
 print "<DIV style='left:529PX;top:535PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aFree[16]</span></DIV>";
 print "<DIV style='left:667PX;top:535PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[16]</span></DIV>";

///Line17
 print "<DIV style='left:589PX;top:555PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[17]</span></DIV>";
 print "<DIV style='left:419PX;top:555PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[17]</span></DIV>";
 print "<DIV style='left:11PX;top:555PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[17]</span></DIV>";
 print "<DIV style='left:48PX;top:555PX;width:373PX;height:22PX;'><span class='fc1-3'>$aTradname[17]</span></DIV>";
 print "<DIV style='left:475PX;top:555PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[17]</span></DIV>";
 print "<DIV style='left:529PX;top:555PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aFree[17]</span></DIV>";
 print "<DIV style='left:667PX;top:555PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[17]</span></DIV>";

///Line18
 print "<DIV style='left:589PX;top:575PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[18]</span></DIV>";
 print "<DIV style='left:419PX;top:575PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[18]</span></DIV>";
 print "<DIV style='left:11PX;top:575PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[18]</span></DIV>";
 print "<DIV style='left:48PX;top:575PX;width:373PX;height:22PX;'><span class='fc1-3'>$aTradname[18]</span></DIV>";
 print "<DIV style='left:475PX;top:575PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[18]</span></DIV>";
 print "<DIV style='left:529PX;top:575PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aFree[18]</span></DIV>";
 print "<DIV style='left:667PX;top:575PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[18]</span></DIV>";

///Line19
 print "<DIV style='left:589PX;top:595PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[19]</span></DIV>";
 print "<DIV style='left:419PX;top:595PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[19]</span></DIV>";
 print "<DIV style='left:11PX;top:595PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[19]</span></DIV>";
 print "<DIV style='left:48PX;top:595PX;width:373PX;height:22PX;'><span class='fc1-3'>$aTradname[19]</span></DIV>";
 print "<DIV style='left:475PX;top:595PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[19]</span></DIV>";
 print "<DIV style='left:529PX;top:595PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aFree[19]</span></DIV>";
 print "<DIV style='left:667PX;top:595PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[19]</span></DIV>";

///Line20
 print "<DIV style='left:589PX;top:615PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[20]</span></DIV>";
 print "<DIV style='left:419PX;top:615PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[20]</span></DIV>";
 print "<DIV style='left:11PX;top:615PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[20]</span></DIV>";
 print "<DIV style='left:48PX;top:615PX;width:373PX;height:22PX;'><span class='fc1-3'>$aTradname[20]</span></DIV>";
 print "<DIV style='left:475PX;top:615PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[20]</span></DIV>";
 print "<DIV style='left:529PX;top:615PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aFree[20]</span></DIV>";
 print "<DIV style='left:667PX;top:615PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[20]</span></DIV>";
 
 ///Line21
 print "<DIV style='left:589PX;top:635PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[21]</span></DIV>";
 print "<DIV style='left:419PX;top:635PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[21]</span></DIV>";
 print "<DIV style='left:11PX;top:635PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[21]</span></DIV>";
 print "<DIV style='left:48PX;top:635PX;width:373PX;height:22PX;'><span class='fc1-3'>$aTradname[21]</span></DIV>";
 print "<DIV style='left:475PX;top:635PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[21]</span></DIV>";
 print "<DIV style='left:529PX;top:635PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aFree[21]</span></DIV>";
 print "<DIV style='left:667PX;top:635PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[21]</span></DIV>";
 
 ///Line22
 print "<DIV style='left:589PX;top:655PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[22]</span></DIV>";
 print "<DIV style='left:419PX;top:655PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[22]</span></DIV>";
 print "<DIV style='left:11PX;top:655PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[22]</span></DIV>";
 print "<DIV style='left:48PX;top:655PX;width:373PX;height:22PX;'><span class='fc1-3'>$aTradname[22]</span></DIV>";
 print "<DIV style='left:475PX;top:655PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[22]</span></DIV>";
 print "<DIV style='left:529PX;top:655PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aFree[22]</span></DIV>";
 print "<DIV style='left:667PX;top:655PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[22]</span></DIV>";
 
 ///Line23
 print "<DIV style='left:589PX;top:675PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[23]</span></DIV>";
 print "<DIV style='left:419PX;top:675PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[23]</span></DIV>";
 print "<DIV style='left:11PX;top:675PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[23]</span></DIV>";
 print "<DIV style='left:48PX;top:675PX;width:373PX;height:22PX;'><span class='fc1-3'>$aTradname[23]</span></DIV>";
 print "<DIV style='left:475PX;top:675PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[23]</span></DIV>";
 print "<DIV style='left:529PX;top:675PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aFree[23]</span></DIV>";
 print "<DIV style='left:667PX;top:675PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[23]</span></DIV>";
 ///Line24
 print "<DIV style='left:589PX;top:695PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[24]</span></DIV>";
 print "<DIV style='left:419PX;top:695PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[24]</span></DIV>";
 print "<DIV style='left:11PX;top:695PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[24]</span></DIV>";
 print "<DIV style='left:48PX;top:695PX;width:373PX;height:22PX;'><span class='fc1-3'>$aTradname[24]</span></DIV>";
 print "<DIV style='left:475PX;top:695PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[24]</span></DIV>";
 print "<DIV style='left:529PX;top:695PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aFree[24]</span></DIV>";
 print "<DIV style='left:667PX;top:695PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[24]</span></DIV>";
 ///Line25
 print "<DIV style='left:589PX;top:715PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[25]</span></DIV>";
 print "<DIV style='left:419PX;top:715PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[25]</span></DIV>";
 print "<DIV style='left:11PX;top:715PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[25]</span></DIV>";
 print "<DIV style='left:48PX;top:715PX;width:373PX;height:22PX;'><span class='fc1-3'>$aTradname[25]</span></DIV>";
 print "<DIV style='left:475PX;top:715PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[25]</span></DIV>";
 print "<DIV style='left:529PX;top:715PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aFree[25]</span></DIV>";
 print "<DIV style='left:667PX;top:715PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[25]</span></DIV>";

//////
print "<DIV style='left:168PX;top:839PX;width:93PX;height:26PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$nItems</span></DIV>";
print "<DIV style='left:139PX;top:839PX;width:25PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>รวม</span></DIV>";
print "<DIV style='left:265PX;top:839PX;width:44PX;height:27PX;'><span class='fc1-2'>รายการ</span></DIV>";
//print "<DIV style='left:361PX;top:3896PX;width:77PX;height:30PX;'><span class='fc1-0'>(ลายมือชื่อ)</span></DIV>";
print "<DIV style='left:435PX;top:919PX;width:72PX;height:30PX;'><span class='fc1-0'>$aYot[2]</span></DIV>"; // ยศ
//print "<DIV style='left:486PX;top:3900PX;width:249PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>..........................................................................</span></DIV>";
print "<DIV style='left:566PX;top:806PX;width:86PX;height:26PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>ภาษี 7.00 %</span></DIV>";
print "<DIV style='left:566PX;top:839PX;width:86PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>รวมสุทธิ</span></DIV>";
print "<DIV style='left:566PX;top:778PX;width:86PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>รวมเงิน</span></DIV>";
print "<DIV style='left:667PX;top:778PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$nNetprice</span></DIV>";
print "<DIV style='left:667PX;top:806PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$nVat</span></DIV>";
print "<DIV style='left:667PX;top:839PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'><B>$nPriadvat</B></span></DIV>";
print "<DIV style='left:71PX;top:891PX;width:611PX;height:27PX;'><span class='fc1-0'>(ตัวอักษร)&nbsp;&nbsp;$cPriadvat</span></DIV>"; 

print "<DIV style='left:62PX;top:971PX;width:71PX;height:22PX;'><span class='fc1-3'>$aYot[2]</span></DIV>";
print "<div style='left:60PX;top:971PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>.........................................</span></div>";
print "<div style='left:60PX;top:1004PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>.........................................</span></div>";
print "<DIV style='left:182PX;top:971PX;height:23PX;'><span class='fc1-3'>ผู้ซื้อ ทำการโดยได้รับมอบหมายจากผู้บัญชาการทหารบก</span></DIV>";
print "<DIV style='left:182PX;top:1003PX;width:51PX;height:23PX;'><span class='fc1-3'>ผู้ขาย</span></DIV>";

print "<DIV style='left:416PX;top:970PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost[2]</span></DIV>"; //ตำแหน่ง
print "<DIV style='left:416PX;top:950PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>($aFname[2])</span></DIV>"; // ชื่อ
print "<DIV style='left:361PX;top:1004PX;width:77PX;height:30PX;'><span class='fc1-0'></span></DIV>";
print "<DIV style='left:416PX;top:990PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost2[2]</span></DIV>";// ชื่อโรงบาล
print "<BR>";
print "</BODY></HTML>";


?>