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
  $nVat=$nNetprice*.07;
 /// $nVat=number_format($nVat,2,'.',''); //convert to string ทศนิยม 2 ตำแหน่ง ปัดเศษ
 ///$nVat=floatval ($nVat);// convert to float-number

$nVat=vat($nVat);//use function vat

  $nPriadvat=$nVat+$nNetprice;
  $cPriadvat=baht($nPriadvat);//ตัวอักษร

  $nTax=.01*$nNetprice;
  $nNetpaid=$nPriadvat-$nTax;

  $cNetpaid=baht($nNetpaid);//ตัวอักษร
  
////กรรมการ3คน, 1คน
	$cKumkan="กรรมการตรวจรับพัสดุ";
	$nKumkan=3;
	$cBe="เป็น";
if ($nPriadvat < 10000){
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
	$aSnspec   = array(" snspec");
//$x  $drugcode $tradname $packing  $pack  $amount  $price  $packpri  $specno 
	
	$query = "SELECT drugcode FROM poitems WHERE idno = '$nRow_id' ";
	$result = Mysql_Query($query);
	$i=0;
	while(list($drugcode) = Mysql_fetch_row($result)){
		
		$listdrugcode[$i] = "'".$drugcode."'"; 
		
		$i++;
	}
	
	$query="CREATE TEMPORARY TABLE druglst01 SELECT drugcode ,snspec FROM druglst WHERE drugcode in (".implode(",",$listdrugcode).")  ";
	$result = Mysql_Query($query);

    $query = "SELECT a.drugcode,a.tradname,a.packing,a.pack,a.minimum,a.totalstk,a.packpri,a.amount,a.price,a.free,a.specno,b.snspec 
	FROM poitems as a 
	INNER JOIN druglst01 as b ON b.drugcode = a.drugcode
	WHERE idno = '$nRow_id' ";

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
	if($row->snspec != "")
		$row->snspec = "(".$row->snspec.")";
	array_push($aSnspec,$row->snspec);
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
	array_push($aSnspec,"");
//มีได้ 12 รายการ+หมดรายการ(13แถว) ใส่ NULL ให้array ที่เหลือดังนี้
for ($n=$x+1; $n<=25; $n++){
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
	array_push($aSnspec,"");
}


///po98 ใบที่ 2

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
// เส้นที่ 2
print "<div style='left:8PX;top:133PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:743PX;'>";
print "</div>";
print "<div style='left:44PX;top:68PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:742PX;'>";
print "<table width='0px' height='640PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:408PX;top:68PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:742PX;'>";
print "<table width='0px' height='640PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:472PX;top:68PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:742PX;'>";
print "<table width='0px' height='640PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:515PX;top:68PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:742PX;'>";
print "<table width='0px' height='640PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:585PX;top:68PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:742PX;'>";
print "<table width='0px' height='639PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:655PX;top:68PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:742PX;'>";
print "<table width='0px' height='640PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:334PX;top:68PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:742PX;'>";
print "<table width='0px' height='640PX'><td>&nbsp;</td></table>";
print "</div>";
// เส้น ที่ 3
print "<div style='left:8PX;top:759PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:743PX;'>";
print "</div>";

//print "<div style='left:164PX;top:1743PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:102PX;'></div>";
// กรอบ
print "<DIV class='box' style='z-index:10; border-color:000000;border-style:dashed;border-bottom-style:dashed;border-bottom-width:1PX;border-left-style:dashed;border-left-width:1PX;border-top-style:dashed;border-top-width:1PX;border-right-style:dashed;border-right-width:1PX;left:7PX;top:68PX;width:743PX;height:742PX;'>";
print "<table border=0 cellpadding=0 cellspacing=0 width=736px height=638px><TD>&nbsp;</TD></TABLE>";
print "</DIV>";
print "<DIV style='left:520PX;top:100PX;width:61PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>หน่วยละ</span></DIV>";
print "<DIV style='left:103PX;top:32PX;width:506PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>ประกอบรายงาน ที่ กห   0483.63.4/$cPono ลง </span><span class='fc1-0'>$cPodate</span></DIV>";
print "<DIV style='left:155PX;top:10PX;width:403PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>บัญชีรายละเอียดพัสดุในการจัดหา (ซื้อ) โดยวิธีตกลงราคา</span></DIV>";
print "<DIV style='left:7PX;top:85PX;width:38PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>ลำดับ</span></DIV>";
print "<DIV style='left:48PX;top:85PX;width:303PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>รายการและรายละเอียดของพัสดุที่ซื้อ</span></DIV>";
print "<DIV style='left:590PX;top:100PX;width:61PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>หน่วยละ</span></DIV>";
print "<DIV style='left:660PX;top:85PX;width:85PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>เป็นเงิน</span></DIV>";
print "<DIV style='left:670PX;top:100PX;width:64PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>ไม่รวม VAT</span></DIV>";
print "<DIV style='left:588PX;top:115PX;width:64PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>ไม่รวม VAT</span></DIV>";
print "<DIV style='left:356PX;top:85PX;width:51PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>หน่วยนับ</span></DIV>";
print "<DIV style='left:414PX;top:85PX;width:43PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>จำนวน</span></DIV>";
print "<DIV style='left:475PX;top:85PX;width:43PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>แถม</span></DIV>";
print "<DIV style='left:518PX;top:115PX;width:64PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>ไม่รวม VAT</span></DIV>";
print "<DIV style='left:520PX;top:70PX;width:61PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>ราคา</span></DIV>";
print "<DIV style='left:520PX;top:83PX;width:61PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>ครั้งหลังสุด</span></DIV>";
print "<DIV style='left:590PX;top:83PX;width:61PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>ปัจจุบัน</span></DIV>";
print "<DIV style='left:590PX;top:70PX;width:61PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>ราคา</span></DIV>";
///ใส่ array ตรงนี้
///แถวที่1
print"<DIV style='left:589PX;top:141PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[1]</span></DIV>";
print"<DIV style='left:349PX;top:141PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aPacking[1]</span></DIV>";
print"<DIV style='left:11PX;top:141PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aX[1]</span></DIV>";
print"<DIV style='left:48PX;top:141PX;width:303PX;height:22PX;'><span class='fc1-2'>$aTradname[1]</span></DIV>";
print"<DIV style='left:406PX;top:141PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aAmount[1]</span></DIV>";
print"<DIV style='left:459PX;top:141PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aFree[1]</span></DIV>";
print"<DIV style='left:667PX;top:141PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPrice[1]</span></DIV>";
//print"<DIV style='left:697PX;top:141PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$nNetprice</span></DIV>";
print"<DIV style='left:519PX;top:141PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[1]</span></DIV>";
///แถวที่2
print"<DIV style='left:589PX;top:161PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[2]</span></DIV>";
print"<DIV style='left:349PX;top:161PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aPacking[2]</span></DIV>";
print"<DIV style='left:11PX;top:161PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aX[2]</span></DIV>";
print"<DIV style='left:48PX;top:161PX;width:303PX;height:22PX;'><span class='fc1-2'>$aTradname[2]</span></DIV>";
print"<DIV style='left:406PX;top:161PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aAmount[2]</span></DIV>";
print"<DIV style='left:459PX;top:161PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aFree[2]</span></DIV>";
print"<DIV style='left:667PX;top:161PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPrice[2]</span></DIV>";
print"<DIV style='left:519PX;top:161PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[2]</span></DIV>";
///แถวที่3
print"<DIV style='left:589PX;top:181PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[3]</span></DIV>";
print"<DIV style='left:349PX;top:181PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aPacking[3]</span></DIV>";
print"<DIV style='left:11PX;top:181PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aX[3]</span></DIV>";
print"<DIV style='left:48PX;top:181PX;width:303PX;height:22PX;'><span class='fc1-2'>$aTradname[3]</span></DIV>";
print"<DIV style='left:406PX;top:181PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aAmount[3]</span></DIV>";
print"<DIV style='left:459PX;top:181PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aFree[3]</span></DIV>";
print"<DIV style='left:667PX;top:181PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPrice[3]</span></DIV>";
print"<DIV style='left:519PX;top:181PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[3]</span></DIV>";

///แถวที่4
print"<DIV style='left:589PX;top:201PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[4]</span></DIV>";
print"<DIV style='left:349PX;top:201PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aPacking[4]</span></DIV>";
print"<DIV style='left:11PX;top:201PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aX[4]</span></DIV>";
print"<DIV style='left:48PX;top:201PX;width:303PX;height:22PX;'><span class='fc1-2'>$aTradname[4]</span></DIV>";
print"<DIV style='left:406PX;top:201PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aAmount[4]</span></DIV>";
print"<DIV style='left:459PX;top:201PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aFree[4]</span></DIV>";
print"<DIV style='left:667PX;top:201PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPrice[4]</span></DIV>";
print"<DIV style='left:519PX;top:201PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[4]</span></DIV>";

///แถวที่5
print"<DIV style='left:589PX;top:221PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[5]</span></DIV>";
print"<DIV style='left:349PX;top:221PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aPacking[5]</span></DIV>";
print"<DIV style='left:11PX;top:221PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aX[5]</span></DIV>";
print"<DIV style='left:48PX;top:221PX;width:303PX;height:22PX;'><span class='fc1-2'>$aTradname[5]</span></DIV>";
print"<DIV style='left:406PX;top:221PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aAmount[5]</span></DIV>";
print"<DIV style='left:459PX;top:221PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aFree[5]</span></DIV>";
print"<DIV style='left:667PX;top:221PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPrice[5]</span></DIV>";
print"<DIV style='left:519PX;top:221PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[5]</span></DIV>";

///แถวที่6
print"<DIV style='left:589PX;top:241PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[6]</span></DIV>";
print"<DIV style='left:349PX;top:241PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aPacking[6]</span></DIV>";
print"<DIV style='left:11PX;top:241PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aX[6]</span></DIV>";
print"<DIV style='left:48PX;top:241PX;width:303PX;height:22PX;'><span class='fc1-2'>$aTradname[6]</span></DIV>";
print"<DIV style='left:406PX;top:241PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aAmount[6]</span></DIV>";
print"<DIV style='left:459PX;top:241PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aFree[6]</span></DIV>";
print"<DIV style='left:667PX;top:241PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPrice[6]</span></DIV>";
print"<DIV style='left:519PX;top:241PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[6]</span></DIV>";

///แถวที่7
print"<DIV style='left:589PX;top:261PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[7]</span></DIV>";
print"<DIV style='left:349PX;top:261PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aPacking[7]</span></DIV>";
print"<DIV style='left:11PX;top:261PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aX[7]</span></DIV>";
print"<DIV style='left:48PX;top:261PX;width:303PX;height:22PX;'><span class='fc1-2'>$aTradname[7]</span></DIV>";
print"<DIV style='left:406PX;top:261PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aAmount[7]</span></DIV>";
print"<DIV style='left:459PX;top:261PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aFree[7]</span></DIV>";
print"<DIV style='left:667PX;top:261PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPrice[7]</span></DIV>";
print"<DIV style='left:519PX;top:261PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[7]</span></DIV>";

///แถวที่8
print"<DIV style='left:589PX;top:281PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[8]</span></DIV>";
print"<DIV style='left:349PX;top:281PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aPacking[8]</span></DIV>";
print"<DIV style='left:11PX;top:281PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aX[8]</span></DIV>";
print"<DIV style='left:48PX;top:281PX;width:303PX;height:22PX;'><span class='fc1-2'>$aTradname[8]</span></DIV>";
print"<DIV style='left:406PX;top:281PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aAmount[8]</span></DIV>";
print"<DIV style='left:459PX;top:281PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aFree[8]</span></DIV>";
print"<DIV style='left:667PX;top:281PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPrice[8]</span></DIV>";
print"<DIV style='left:519PX;top:281PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[8]</span></DIV>";

///แถวที่9
print"<DIV style='left:589PX;top:301PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[9]</span></DIV>";
print"<DIV style='left:349PX;top:301PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aPacking[9]</span></DIV>";
print"<DIV style='left:11PX;top:301PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aX[9]</span></DIV>";
print"<DIV style='left:48PX;top:301PX;width:303PX;height:22PX;'><span class='fc1-2'>$aTradname[9]</span></DIV>";
print"<DIV style='left:406PX;top:301PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aAmount[9]</span></DIV>";
print"<DIV style='left:459PX;top:301PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aFree[9]</span></DIV>";
print"<DIV style='left:667PX;top:301PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPrice[9]</span></DIV>";
print"<DIV style='left:519PX;top:301PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[9]</span></DIV>";

///แถวที่10
print"<DIV style='left:589PX;top:321PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[10]</span></DIV>";
print"<DIV style='left:349PX;top:321PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aPacking[10]</span></DIV>";
print"<DIV style='left:11PX;top:321PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aX[10]</span></DIV>";
print"<DIV style='left:48PX;top:321PX;width:303PX;height:22PX;'><span class='fc1-2'>$aTradname[10]</span></DIV>";
print"<DIV style='left:406PX;top:321PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aAmount[10]</span></DIV>";
print"<DIV style='left:459PX;top:321PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aFree[10]</span></DIV>";
print"<DIV style='left:667PX;top:321PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPrice[10]</span></DIV>";
print"<DIV style='left:519PX;top:321PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[10]</span></DIV>";

///แถวที่11
print"<DIV style='left:589PX;top:341PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[11]</span></DIV>";
print"<DIV style='left:349PX;top:341PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aPacking[11]</span></DIV>";
print"<DIV style='left:11PX;top:341PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aX[11]</span></DIV>";
print"<DIV style='left:48PX;top:341PX;width:303PX;height:22PX;'><span class='fc1-2'>$aTradname[11]</span></DIV>";
print"<DIV style='left:406PX;top:341PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aAmount[11]</span></DIV>";
print"<DIV style='left:459PX;top:341PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aFree[11]</span></DIV>";
print"<DIV style='left:667PX;top:341PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPrice[11]</span></DIV>";
print"<DIV style='left:519PX;top:341PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[11]</span></DIV>";

///แถวที่12
print"<DIV style='left:589PX;top:361PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[12]</span></DIV>";
print"<DIV style='left:349PX;top:361PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aPacking[12]</span></DIV>";
print"<DIV style='left:11PX;top:361PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aX[12]</span></DIV>";
print"<DIV style='left:48PX;top:361PX;width:303PX;height:22PX;'><span class='fc1-2'>$aTradname[12]</span></DIV>";
print"<DIV style='left:406PX;top:361PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aAmount[12]</span></DIV>";
print"<DIV style='left:459PX;top:361PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aFree[12]</span></DIV>";
print"<DIV style='left:667PX;top:361PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPrice[12]</span></DIV>";
print"<DIV style='left:519PX;top:361PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[12]</span></DIV>";

///แถวที่13
print"<DIV style='left:589PX;top:381PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[13]</span></DIV>";
print"<DIV style='left:349PX;top:381PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aPacking[13]</span></DIV>";
print"<DIV style='left:11PX;top:381PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aX[13]</span></DIV>";
print"<DIV style='left:48PX;top:381PX;width:303PX;height:22PX;'><span class='fc1-2'>$aTradname[13]</span></DIV>";
print"<DIV style='left:406PX;top:381PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aAmount[13]</span></DIV>";
print"<DIV style='left:459PX;top:381PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aFree[13]</span></DIV>";
print"<DIV style='left:667PX;top:381PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPrice[13]</span></DIV>";
print"<DIV style='left:519PX;top:381PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[13]</span></DIV>";

///แถวที่14
print"<DIV style='left:589PX;top:401PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[14]</span></DIV>";
print"<DIV style='left:349PX;top:401PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aPacking[14]</span></DIV>";
print"<DIV style='left:11PX;top:401PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aX[14]</span></DIV>";
print"<DIV style='left:48PX;top:401PX;width:303PX;height:22PX;'><span class='fc1-2'>$aTradname[14]</span></DIV>";
print"<DIV style='left:406PX;top:401PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aAmount[14]</span></DIV>";
print"<DIV style='left:459PX;top:401PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aFree[14]</span></DIV>";
print"<DIV style='left:667PX;top:401PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPrice[14]</span></DIV>";
print"<DIV style='left:519PX;top:401PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[14]</span></DIV>";

///แถวที่15
print"<DIV style='left:589PX;top:421PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[15]</span></DIV>";
print"<DIV style='left:349PX;top:421PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aPacking[15]</span></DIV>";
print"<DIV style='left:11PX;top:421PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aX[15]</span></DIV>";
print"<DIV style='left:48PX;top:421PX;width:303PX;height:22PX;'><span class='fc1-2'>$aTradname[15]</span></DIV>";
print"<DIV style='left:406PX;top:421PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aAmount[15]</span></DIV>";
print"<DIV style='left:459PX;top:421PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aFree[15]</span></DIV>";
print"<DIV style='left:667PX;top:421PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPrice[15]</span></DIV>";
print"<DIV style='left:519PX;top:421PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[15]</span></DIV>";

///แถวที่16
print"<DIV style='left:589PX;top:441PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[16]</span></DIV>";
print"<DIV style='left:349PX;top:441PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aPacking[16]</span></DIV>";
print"<DIV style='left:11PX;top:441PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aX[16]</span></DIV>";
print"<DIV style='left:48PX;top:441PX;width:303PX;height:22PX;'><span class='fc1-2'>$aTradname[16]</span></DIV>";
print"<DIV style='left:406PX;top:441PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aAmount[16]</span></DIV>";
print"<DIV style='left:459PX;top:441PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aFree[16]</span></DIV>";
print"<DIV style='left:667PX;top:441PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPrice[16]</span></DIV>";
print"<DIV style='left:519PX;top:441PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[16]</span></DIV>";

///แถวที่17
print"<DIV style='left:589PX;top:461PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[17]</span></DIV>";
print"<DIV style='left:349PX;top:461PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aPacking[17]</span></DIV>";
print"<DIV style='left:11PX;top:461PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aX[17]</span></DIV>";
print"<DIV style='left:48PX;top:461PX;width:303PX;height:22PX;'><span class='fc1-2'>$aTradname[17]</span></DIV>";
print"<DIV style='left:406PX;top:461PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aAmount[17]</span></DIV>";
print"<DIV style='left:459PX;top:461PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aFree[17]</span></DIV>";
print"<DIV style='left:667PX;top:461PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPrice[17]</span></DIV>";
print"<DIV style='left:519PX;top:461PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[17]</span></DIV>";

///แถวที่18
print"<DIV style='left:589PX;top:481PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[18]</span></DIV>";
print"<DIV style='left:349PX;top:481PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aPacking[18]</span></DIV>";
print"<DIV style='left:11PX;top:481PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aX[18]</span></DIV>";
print"<DIV style='left:48PX;top:481PX;width:303PX;height:22PX;'><span class='fc1-2'>$aTradname[18]</span></DIV>";
print"<DIV style='left:406PX;top:481PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aAmount[18]</span></DIV>";
print"<DIV style='left:459PX;top:481PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aFree[18]</span></DIV>";
print"<DIV style='left:667PX;top:481PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPrice[18]</span></DIV>";
print"<DIV style='left:519PX;top:481PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[18]</span></DIV>";


///แถวที่19
print"<DIV style='left:589PX;top:501PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[19]</span></DIV>";
print"<DIV style='left:349PX;top:501PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aPacking[19]</span></DIV>";
print"<DIV style='left:11PX;top:501PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aX[19]</span></DIV>";
print"<DIV style='left:48PX;top:501PX;width:303PX;height:22PX;'><span class='fc1-2'>$aTradname[19]</span></DIV>";
print"<DIV style='left:406PX;top:501PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aAmount[19]</span></DIV>";
print"<DIV style='left:459PX;top:501PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aFree[19]</span></DIV>";
print"<DIV style='left:667PX;top:501PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPrice[19]</span></DIV>";
print"<DIV style='left:519PX;top:501PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[19]</span></DIV>";

///แถวที่20
print"<DIV style='left:589PX;top:521PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[20]</span></DIV>";
print"<DIV style='left:349PX;top:521PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aPacking[20]</span></DIV>";
print"<DIV style='left:11PX;top:521PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aX[20]</span></DIV>";
print"<DIV style='left:48PX;top:521PX;width:303PX;height:22PX;'><span class='fc1-2'>$aTradname[20]</span></DIV>";
print"<DIV style='left:406PX;top:521PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aAmount[20]</span></DIV>";
print"<DIV style='left:459PX;top:521PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aFree[20]</span></DIV>";
print"<DIV style='left:667PX;top:521PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPrice[20]</span></DIV>";
print"<DIV style='left:519PX;top:521PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[20]</span></DIV>";

/// แถวที่ 21 
print"<DIV style='left:589PX;top:541PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[21]</span></DIV>";
print"<DIV style='left:349PX;top:541PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aPacking[21]</span></DIV>";
print"<DIV style='left:11PX;top:541PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aX[21]</span></DIV>";
print"<DIV style='left:48PX;top:541PX;width:303PX;height:22PX;'><span class='fc1-2'>$aTradname[21]</span></DIV>";
print"<DIV style='left:406PX;top:541PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aAmount[21]</span></DIV>";
print"<DIV style='left:459PX;top:541PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aFree[21]</span></DIV>";
print"<DIV style='left:667PX;top:541PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPrice[21]</span></DIV>";
print"<DIV style='left:519PX;top:541PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[21]</span></DIV>";

/// แถวที่ 22
print"<DIV style='left:589PX;top:561PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[22]</span></DIV>";
print"<DIV style='left:349PX;top:561PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aPacking[22]</span></DIV>";
print"<DIV style='left:11PX;top:561PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aX[22]</span></DIV>";
print"<DIV style='left:48PX;top:561PX;width:303PX;height:22PX;'><span class='fc1-2'>$aTradname[22]</span></DIV>";
print"<DIV style='left:406PX;top:561PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aAmount[22]</span></DIV>";
print"<DIV style='left:459PX;top:561PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aFree[22]</span></DIV>";
print"<DIV style='left:667PX;top:561PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPrice[22]</span></DIV>";
print"<DIV style='left:519PX;top:561PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[22]</span></DIV>";

/// แถวที่ 23 
print"<DIV style='left:589PX;top:581PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[23]</span></DIV>";
print"<DIV style='left:349PX;top:581PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aPacking[23]</span></DIV>";
print"<DIV style='left:11PX;top:581PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aX[23]</span></DIV>";
print"<DIV style='left:48PX;top:581PX;width:303PX;height:22PX;'><span class='fc1-2'>$aTradname[23]</span></DIV>";
print"<DIV style='left:406PX;top:581PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aAmount[23]</span></DIV>";
print"<DIV style='left:459PX;top:581PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aFree[23]</span></DIV>";
print"<DIV style='left:667PX;top:581PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPrice[23]</span></DIV>";
print"<DIV style='left:519PX;top:581PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[23]</span></DIV>";

/// แถวที่ 24 
print"<DIV style='left:589PX;top:601PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[24]</span></DIV>";
print"<DIV style='left:349PX;top:601PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aPacking[24]</span></DIV>";
print"<DIV style='left:11PX;top:601PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aX[24]</span></DIV>";
print"<DIV style='left:48PX;top:601PX;width:303PX;height:22PX;'><span class='fc1-2'>$aTradname[24]</span></DIV>";
print"<DIV style='left:406PX;top:601PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aAmount[24]</span></DIV>";
print"<DIV style='left:459PX;top:601PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aFree[24]</span></DIV>";
print"<DIV style='left:667PX;top:601PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPrice[24]</span></DIV>";
print"<DIV style='left:519PX;top:601PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[24]</span></DIV>";

/// แถวที่ 25
print"<DIV style='left:589PX;top:621PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[25]</span></DIV>";
print"<DIV style='left:349PX;top:621PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aPacking[25]</span></DIV>";
print"<DIV style='left:11PX;top:621PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$aX[25]</span></DIV>";
print"<DIV style='left:48PX;top:621PX;width:303PX;height:22PX;'><span class='fc1-2'>$aTradname[25]</span></DIV>";
print"<DIV style='left:406PX;top:621PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aAmount[25]</span></DIV>";
print"<DIV style='left:459PX;top:621PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aFree[25]</span></DIV>";
print"<DIV style='left:667PX;top:621PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPrice[25]</span></DIV>";
print"<DIV style='left:519PX;top:621PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$aPackpri[25]</span></DIV>";

///////////

print "<DIV style='left:168PX;top:764PX;width:93PX;height:26PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>$nItems</span></DIV>";
print "<DIV style='left:139PX;top:764PX;width:25PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>รวม</span></DIV>";
print "<DIV style='left:265PX;top:764PX;width:44PX;height:27PX;'><span class='fc1-2'>รายการ</span></DIV>";
//print "<DIV style='left:367PX;top:1892PX;width:77PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>(ลงชื่อ)</span></DIV>";
print "<DIV style='left:439PX;top:908PX;width:82PX;height:30PX;'><span class='fc1-0'>$aYot[2]</span></DIV>";  //ยศ
//print "<DIV style='left:488PX;top:1924PX;width:249PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>..........................................................................</span></DIV>";
print "<DIV style='left:566PX;top:731PX;width:86PX;height:26PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>ภาษี 7.00 %</span></DIV>";
print "<DIV style='left:566PX;top:764PX;width:86PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>รวมสุทธิ</span></DIV>";
print "<DIV style='left:566PX;top:711PX;width:86PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>รวมเงิน</span></DIV>";
print "<DIV style='left:667PX;top:711PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$nNetprice</span></DIV>";
print "<DIV style='left:667PX;top:731PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$nVat</span></DIV>";
print "<DIV style='left:667PX;top:764PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'><B>$nPriadvat</B></span></DIV>";
print "<DIV style='left:418PX;top:955PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost[2]</span></DIV>"; // ชื่อ 
print "<DIV style='left:418PX;top:934PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>($aFname[2])</span></DIV>"; // ตำแหน่ง
print "<DIV style='left:367PX;top:881PX;width:77PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>ตรวจถูกต้อง</span></DIV>";
print "<DIV style='left:46PX;top:814PX;width:77PX;height:30PX;'><span class='fc1-0'>หมายเหตุ</span></DIV>";
print "<DIV style='left:122PX;top:814PX;width:245PX;height:30PX;'><span class='fc1-0'>- สป. ตามบัญชีต้องการของภายในวันที่</span></DIV>";
print "<DIV style='left:122PX;top:843PX;width:245PX;height:30PX;'><span class='fc1-0'>- บริษัทที่จะซื้อตามที่ได้สืบราคาแล้ว</span></DIV>";
print "<DIV style='left:366PX;top:814PX;width:384PX;height:30PX;'><span class='fc1-0'><B>$cBounddate</B></span></DIV>";
print "<DIV style='left:366PX;top:843PX;width:384PX;height:30PX;'><span class='fc1-0'><B>$cComname</B></span></DIV>";
print "<DIV style='left:418PX;top:975PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost2[2]</span></DIV>"; //ชื่อ โรงพยาบาลค่าย
print "<BR>";
print "</BODY></HTML>";

?>