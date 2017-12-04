
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
	array_push($aSnspec,"");
}

///po97 ใบที่ 1
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
print ".fc1-2 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:BOLD;}";
print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";
print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";
print "</STYLE>";

print "<TITLE>Crystal Report Viewer</TITLE>";
print "</head>";

print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";

print "<DIV style='z-index:0'> &nbsp; </div>";


print "<DIV style='left:54PX;top:107PX;width:306PX;height:30PX;'><span class='fc1-5'>ส่วนราชการ</span><span class='fc1-0'>&nbsp;&nbsp;กองเภสัชกรรม&nbsp;&nbsp;&nbsp;&nbsp;รพ.ค่ายสุรศักดิ์มนตรี</span></DIV>";

print "<DIV style='left:305PX;top:46PX;width:155PX;height:34PX;TEXT-ALIGN:CENTER;'><span class='fc1-1'>บันทึกข้อความ</span></DIV>";

print "<DIV style='left:54PX;top:136PX;width:333PX;height:30PX;'><span class='fc1-5'>ที่ </span><span class='fc1-0'>กห  0483.63.4/$cPono</span></DIV>";

//print "<DIV style='left:378PX;top:136PX;width:32PX;height:30PX;'><span class='fc1-5'>วันที่</span></DIV>";

print "<DIV style='z-index:15;left:54PX;top:24PX;width:73PX;height:80PX;'>";
print "<img  WIDTH=73 HEIGHT=80 SRC='bird.jpg'>";
print "</DIV>";
print "<DIV style='left:378PX;top:107PX;width:272PX;height:30PX;'><span class='fc1-0'>$cPodate</span></DIV>";

print "<DIV style='left:54PX;top:167PX;width:36PX;height:30PX;'><span class='fc1-5'>เรื่อง</span></DIV>";

print "<DIV style='left:54PX;top:194PX;width:36PX;height:30PX;'><span class='fc1-5'>เรียน</span></DIV>";

print "<DIV style='left:105PX;top:193PX;width:283PX;height:30PX;'><span class='fc1-0'>ผอ.รพ.ค่ายสุรศักดิ์มนตรี</span></DIV>";

print "<DIV style='left:105PX;top:248PX;width:661PX;height:30PX;'><span class='fc1-0'>2. คำสั่ง กห (เฉพาะ) ที่ 50/50  16 มี.ค. 2550 เรื่อง การพัสดุ</span></DIV>";

print "<DIV style='left:466PX;top:875PX;width:71PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>$aYot[2]</span></DIV>";

print "<DIV style='left:456PX;top:929PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost[2]</span></DIV>";

print "<DIV style='left:54PX;top:221PX;width:49PX;height:30PX;'><span class='fc1-5'>อ้างถึง</span></DIV>";

//print "<DIV style='left:409PX;top:875PX;width:55PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>(ลงชื่อ)</span></DIV>";

print "<DIV style='left:105PX;top:518PX;width:661PX;height:30PX;'><span class='fc1-0'>5. การซื้อ ครั้งนี้วงเงินไม่เกิน 100,000 บาท เห็นควรซื้อโดยวิธีตกลงราคาตามระเบียบฯ ที่อ้างถึง วงเงินอยู่</span></DIV>";

print "<DIV style='left:61PX;top:545PX;width:705PX;height:30PX;'><span class='fc1-0'> ในอำนาจของ ผอ.รพ.ค่ายฯ อนุมัติได้</span></DIV>";

print "<DIV style='left:456PX;top:902PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>($aFname[2])</span></DIV>";

print "<DIV style='left:257PX;top:788PX;width:150PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$cKumkan</span></DIV>";

print "<DIV style='left:105PX;top:221PX;width:661PX;height:30PX;'><span class='fc1-0'>1. ระเบียบสำนักนายกรัฐมนตรี ว่าด้วย การพัสดุ พ.ศ.2535, ลง 20 ม.ค. 2535, และที่แก้ไขเพิ่มเติม</span></DIV>";

print "<DIV style='left:105PX;top:275PX;width:661PX;height:30PX;'><span class='fc1-0'>3. คำสั่ง ทบ (เฉพาะ) ที่ 476/44 เรื่อง มอบอำนาจอนุมัติการเบิกจ่ายเงินรายรับสถานพยาบาล</span></DIV>";

print "<DIV style='left:54PX;top:302PX;width:106PX;height:30PX;'><span class='fc1-5'>สิ่งที่ส่งมาด้วย</span></DIV>";

print "<DIV style='left:166PX;top:302PX;width:229PX;height:30PX;'><span class='fc1-0'>1. หนังสือกองเภสัชกรรม รพ.ค่ายฯ ที่</span></DIV>";

print "<DIV style='left:394PX;top:302PX;width:110PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'><B>$cPrepono</B></span></DIV>";

print "<DIV style='left:503PX;top:302PX;width:56PX;height:30PX;'><span class='fc1-0'>ลงวันที่</span></DIV>";

print "<DIV style='left:558PX;top:302PX;width:208PX;height:30PX;'><span class='fc1-0'><B>$cPrepodate</B></span></DIV>";

print "<DIV style='left:166PX;top:329PX;width:600PX;height:30PX;'><span class='fc1-0'>2. บัญชีรายละเอียดในการ จัดซื้อ จำนวน 1 ชุด</span></DIV>";

print "<DIV style='left:61PX;top:383PX;width:705PX;height:30PX;'><span class='fc1-0'>ตามสิ่งที่ส่งมาด้วยข้อ 1.</span></DIV>";

print "<DIV style='left:105PX;top:410PX;width:661PX;height:30PX;'><span class='fc1-0'>2. รายละเอียด พัสดุที่จะจัดซื้อ ตามบัญชีรายละเอียดที่แนบตามสิ่งที่ส่งมาด้วย 2.</span></DIV>";

print "<DIV style='left:105PX;top:437PX;width:189PX;height:30PX;'><span class='fc1-0'>3. วงเงิน จัดซื้อ ครั้งนี้เป็นเงิน</span></DIV>";

print "<DIV style='left:293PX;top:437PX;width:99PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'><B>$nPriadvat</B></span></DIV>";

print "<DIV style='left:391PX;top:437PX;width:40PX;height:30PX;'><span class='fc1-0'>บาท</span></DIV>";

print "<DIV style='left:430PX;top:437PX;width:400PX;height:30PX;'><span class='fc1-0'>$cPriadvat</span></DIV>";

print "<DIV style='left:105PX;top:464PX;width:239PX;height:30PX;'><span class='fc1-0'>4. กำหนดเวลาที่ต้องการใช้วัสดุในวันที่</span></DIV>";

print "<DIV style='left:343PX;top:464PX;width:167PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'><B>$cBounddate</B></span></DIV>";

print "<DIV style='left:509PX;top:464PX;width:257PX;height:30PX;'><span class='fc1-0'>ส่งที่หน่วย รพ.ค่ายสุรศักดิ์มนตรี</span></DIV>";

print "<DIV style='left:61PX;top:491PX;width:191PX;height:30PX;'><span class='fc1-0'>(ต้องการให้งานนั้นเสร็จในวันที่</span></DIV>";

print "<DIV style='left:251PX;top:491PX;width:167PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'><B>$cBounddate</B></span></DIV>";

print "<DIV style='left:417PX;top:491PX;width:349PX;height:30PX;'><span class='fc1-0'>)</span></DIV>";

print "<DIV style='left:105PX;top:572PX;width:661PX;height:30PX;'><span class='fc1-0'>6. การซื้อครั้งนี้เห็นควรซื้อ จาก";
  print "<B>$cComname</B> เพราะสืบราคาแล้ว</span></DIV>";

print "<DIV style='left:61PX;top:599PX;width:705PX;height:30PX;'><span class='fc1-0'>เป็นราคาต่ำสุดใกล้เคียงกับราคาท้องตลาดปัจจุบัน ได้ต่อรองราคาต่ำสุดแล้ว และขออนุมัติใช้ใบสั่งซื้อเป็นข้อตกลง</span></DIV>";

print "<DIV style='left:61PX;top:626PX;width:705PX;height:30PX;'><span class='fc1-0'>แทนการทำสัญญาและ ไม่ควร เรียกหลักประกันสัญญา</span></DIV>";

print "<DIV style='left:105PX;top:653PX;width:661PX;height:30PX;'><span class='fc1-0'>7. ข้อเสนอ</span></DIV>";

//print "<DIV style='left:711PX;top:680PX;width:55PX;height:30PX;'><span class='fc1-0'></span></DIV>";

//print "<DIV style='left:645PX;top:680PX;width:57PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'></span></DIV>";

print "<DIV style='left:138PX;top:680PX;width:518PX;height:30PX;'><span class='fc1-0'>7.1 เห็นควรอนุมัติ(จัดซื้อ)ให้กองเภสัชกรรม&nbsp;&nbsp;รพ.ค่ายสุรศักดิ์มนตรีโดยวิธีตกลงราคารวม $nItems รายการ</span></DIV>";

print "<DIV style='left:206PX;top:707PX;width:40PX;height:30PX;'><span class='fc1-0'>บาท</span></DIV>";

print "<DIV style='left:245PX;top:707PX;width:521PX;height:30PX;'><span class='fc1-0'>$cPriadvat</span></DIV>";

print "<DIV style='left:108PX;top:707PX;width:99PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'><B>$nPriadvat</B></span></DIV>";

print "<DIV style='left:61PX;top:707PX;width:48PX;height:30PX;'><span class='fc1-0'>วงเงิน</span></DIV>";

print "<DIV style='left:61PX;top:734PX;width:705PX;height:30PX;'><span class='fc1-0'>จาก";
  print "<B>$cComname</B> และใช้ใบสั่งซื้อ เป็นข้อตกลงแทนการทำสัญญา</span></DIV>";

print "<DIV style='left:61PX;top:761PX;width:705PX;height:30PX;'><span class='fc1-0'> ให้ไม่เรียกหลักประกันสัญญา</span></DIV>";

print "<DIV style='left:138PX;top:788PX;width:120PX;height:30PX;'><span class='fc1-0'>7.2 เห็นควรแต่งตั้ง</span></DIV>";

print "<DIV style='left:406PX;top:788PX;width:48PX;height:30PX;'><span class='fc1-0'>จำนวน</span></DIV>";

print "<DIV style='left:453PX;top:788PX;width:18PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$nKumkan</span></DIV>";

print "<DIV style='left:470PX;top:788PX;width:295PX;height:30PX;'><span class='fc1-0'>นาย ตามระเบียบฯ ด้วยแล้วรายงานผล</span></DIV>";

print "<DIV style='left:61PX;top:815PX;width:705PX;height:30PX;'><span class='fc1-0'> ให้ทราบภายใน 5 วันทำการ</span></DIV>";

print "<DIV style='left:138PX;top:842PX;width:628PX;height:30PX;'><span class='fc1-0'>จึงเรียนมาเพื่อกรุณาทราบ และกรุณาอนุมัติตามข้อเสนอในข้อ 7.</span></DIV>";

print "<DIV style='left:456PX;top:956PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost2[2]</span></DIV>";

print "<DIV style='left:105PX;top:166PX;width:661PX;height:30PX;'><span class='fc1-0'>ขออนุมัติจัดซื้อยา</span></DIV>";

print "<DIV style='left:105PX;top:356PX;width:661PX;height:30PX;'><span class='fc1-0'>1. เนื่องด้วยกองเภสัชกรรม รพ.ค่ายฯ มีความจำเป็นที่จะต้องจัดซื้อยาเพื่อใช้ในราชการ รพ.ค่ายฯ</span></DIV>";
print "<BR>";
print "</BODY></HTML>";

?>