<?php
//ขออนุมัติจัดซื้อยา  2.รวมVATก่อน
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
	$aMancode[12]='headmonysub';
	$aMancode[13]='headmony2';
	$aMancode[14]='headtor';
	$aMancode[15]='bordtor1';
	$aMancode[16]='bordtor2';
	$aMancode[17]='bordtor3';		

	for ($n=1; $n<=17; $n++){

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

    $query = "SELECT date,prepono,prepodate,comcode,comname,items,netprice,pono,podate,bounddate,row_id ,ponoyear,chkindate,senddate,borrowdate,pobillno,pobilldate,fixdate FROM pocompany WHERE row_id = '$nRow_id' ";
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
	$chkpono=substr($cPono,0,2);  //ถ้าเป็น อ. จะใช้งบอุดหนุน	
	$cPodate=$row->podate;
	$cBounddate=$row->bounddate;
	$cChkindate=$row->chkindate;  //วันที่รับมอบ
	$cSenddate=$row->senddate;  //วันที่ใหม่
	$cBorrowdate=$row->borrowdate;  //วันที่เบิกเงิน
	$cPonoyear=$row->ponoyear;
	$cBillno=$row->pobillno;  //ใบเสนอราคาเลขที่
	$cBilldate=$row->pobilldate;	//ใบเสนอราคาลงวันที่
	$cFixdate=$row->fixdate;	//วันที่กำหนดส่งมอบ
	//echo "-->".$cFixdate;
	if(empty($cFixdate)){ 
		$cFixdate=$cBorrowdate;
	}
	
	if(empty($cBillno) || empty($cBilldate)){
		$chksqlcom="select pobillno, pobilldate, pobillno2, pobilldate2, pobillno3, pobilldate3 from company where comcode='$cComcode'";
		$chkquerycom=mysql_query($chksqlcom);
		list($cBillno,$cBilldate,$cBillno2,$cBilldate2,$cBillno3,$cBilldate3)=mysql_fetch_array($chkquerycom);
	}
	
	
	//echo $cComcode;
	if($cComcode=='GPO/S' || $cComcode=='GPO_NAP' || $cComcode=='G003.1' || $cComcode=='G003.2' || $cComcode=='M001' || $cComcode=='F007' || $cComcode=='A040'){
		$vitee="วิธีกรณีพิเศษ";
	}else{
		$vitee="วิธีการตกลงราคา";
	}
	
//คำนวนค่าต่างๆ
  $nVat=$nNetprice - ($nNetprice /1.07);
 /// $nVat=number_format($nVat,2,'.',''); //convert to string ทศนิยม 2 ตำแหน่ง ปัดเศษ
 ///$nVat=floatval ($nVat);// convert to float-number

$nVat=vat($nVat);//use function vat
$nNetprice=$nNetprice-$nVat;
  $nPriadvat=$nVat+$nNetprice;
  $chkprice= $nPriadvat;
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
$aUnitpri  = array(" unitpri");
$aPart  = array(" part");	
//$x  $drugcode $tradname $packing  $pack  $amount  $price  $packpri  $specno 

	$query = "SELECT drugcode FROM poitems WHERE idno = '$nRow_id' ";
	//echo $query;
	$result = Mysql_Query($query);
	$i=0;
	while(list($drugcode) = Mysql_fetch_row($result)){
		
		$listdrugcode[$i] = "'".$drugcode."'"; 
		
		$i++;
	}
	
	$query="CREATE TEMPORARY TABLE druglst01 SELECT drugcode ,snspec,part,unitpri,product_drugtype FROM druglst WHERE drugcode in (".implode(",",$listdrugcode).")  ";
	$result = Mysql_Query($query);

    $query = "SELECT a.drugcode,a.tradname,a.packing,a.pack,a.minimum,a.totalstk,a.packpri,a.amount,a.price,a.free,a.specno,b.snspec,b.part,b.unitpri,b.product_drugtype 
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
	array_push($aPart,$row->part);
	array_push($aUnitpri,$row->unitpri);		
	$prodrugtype=$row->product_drugtype;  //พัสดุส่งเสริมสุขภาพและสาธารณสุข

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
	array_push($aPart,$row->part);
	array_push($aUnitpri,$row->unitpri);			
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
	array_push($aPart,$row->part);
	array_push($aUnitpri,$row->unitpri);			
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
//print ".fc1-0 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:NORMAL;}";
//print ".fc1-1 { COLOR:000000;FONT-SIZE:19PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:BOLD;}";
//print ".fc1-2 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:BOLD;}";
//print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";
//print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";
print "</STYLE>";

print "<TITLE>จัดซื้อยา (รวมVATก่อน)</TITLE>";
print "</head>";

print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";

print "<DIV style='z-index:0'> &nbsp; </div>";

//เริ่มต้นเนื้อหา PO ใบที่1 page1

print "<DIV style='left:305PX;top:46PX;width:155PX;height:34PX;TEXT-ALIGN:CENTER;'><span class='fc1-1'>บันทึกข้อความ</span></DIV>";

print "<DIV style='z-index:15;left:54PX;top:24PX;width:73PX;height:80PX;'>";
print "<img  WIDTH=73 HEIGHT=80 SRC='bird.jpg'>";
print "</DIV>";

print "<DIV style='left:54PX;top:107PX;width:306PX;height:30PX;'><span class='fc1-5'>ส่วนราชการ</span><span class='fc1-0'>&nbsp;&nbsp;กองเภสัชกรรม&nbsp;&nbsp;&nbsp;&nbsp;รพ.ค่ายสุรศักดิ์มนตรี</span></DIV>";

print "<DIV style='left:54PX;top:136PX;width:333PX;height:30PX;'><span class='fc1-5'>ที่ </span><span class='fc1-0'>กห  0483.63.4/$cPono$cPonoyear</span></DIV>";
print "<DIV style='left:378PX;top:136PX;width:32PX;height:30PX;'><span class='fc1-5'>วันที่</span></DIV>";
print "<DIV style='left:410PX;top:136PX;width:272PX;height:30PX;'><span class='fc1-0'>$cPodate</span></DIV>";

print "<DIV style='left:54PX;top:167PX;width:36PX;height:30PX;'><span class='fc1-5'>เรื่อง</span></DIV>";

print "<DIV style='left:105PX;top:166PX;width:661PX;height:30PX;'><span class='fc1-0'>ขออนุมัติจัดซื้อยา</span></DIV>";

print "<DIV style='left:54PX;top:194PX;width:36PX;height:30PX;'><span class='fc1-5'>เรียน</span></DIV>";

print "<DIV style='left:105PX;top:193PX;width:283PX;height:30PX;'><span class='fc1-0'>ผอ.รพ.ค่ายสุรศักดิ์มนตรี</span></DIV>";

//ตั้งแต่บรรทัดนี้ ระยะห่างบรรทัด คือ 25 px
print "<DIV style='left:54PX;top:215PX;width:49PX;height:30PX;'><span class='fc1-5'>อ้างถึง</span></DIV>";

//print "<DIV style='left:409PX;top:875PX;width:55PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>(ลงชื่อ)</span></DIV>";

print "<DIV style='left:105PX;top:215PX;width:661PX;height:30PX;'><span class='fc1-0'>1. พระราชบัญญัติการจัดซื้อจัดจ้างและการบริหารพัสดุภาครัฐ พ.ศ.2560 ลง 24 ก.พ. 60</span></DIV>";

print "<DIV style='left:105PX;top:240PX;width:661PX;height:30PX;'><span class='fc1-0'>2. กฎกระทรวง กำหนดวงเงินการจัดซื้อจัดจ้างโดยวิธีเฉพาะเจาะจง วงเงินการจัดซื้อจัดจ้างที่ไม่ทำข้อตกลงเป็นหนังสือ และ</span></DIV>";

print "<DIV style='left:105PX;top:265PX;width:661PX;height:30PX;'><span class='fc1-0'>วงเงินการจัดซื้อจัดจ้างในการแต่งตั้งผู้ตรวจรับพัสดุ พ.ศ.2560 ลง 23 ส.ค. 60</span></DIV>";

print "<DIV style='left:105PX;top:290PX;width:661PX;height:30PX;'><span class='fc1-0'>3. กฎกระทรวง พัสดุที่รัฐต้องส่งเสริมหรือสนับสนุน หมวด 6 พัสดุส่งเสริมสุขภาพและสาธารณสุข พ.ศ.2560 ลง 23 ส.ค. 60</span></DIV>";

print "<DIV style='left:105PX;top:315PX;width:661PX;height:30PX;'><span class='fc1-0'>4. ระเบียบกระทรวงการคลังว่าด้วยการจัดซื้อจัดจ้างและการบริหารพัสดุภาครัฐ พ.ศ.2560 ลง 23 ส.ค. 60</span></DIV>";

print "<DIV style='left:105PX;top:340PX;width:661PX;height:30PX;'><span class='fc1-0'>5. คำสั่งกระทรวงกลาโหม (เฉพาะ) ที่ 400/60 เรื่องการจัดซื้อจัดจ้างและการบริหารพัสดุของกระทรวงกลาโหม ลง 26 ส.ค. 60</span></DIV>";

print "<DIV style='left:105PX;top:365PX;width:661PX;height:30PX;'><span class='fc1-0'>6. คำสั่งกองทัพบก (เฉพาะ) ที่ 1248/60 เรื่องการกำหนดเจ้าหน้าที่และหัวหน้าเจ้าหน้าที่ที่ปฏิบัติงานเกี่ยวกับการจัดซื้อจัดจ้าง</span></DIV>";

print "<DIV style='left:105PX;top:390PX;width:661PX;height:30PX;'><span class='fc1-0'>และการบริหารพัสดุของหน่วย และการจัดทำแผนการจัดซื้อจัดจ้างประจำปี ลง 22 ก.ย. 60</span></DIV>";

print "<DIV style='left:105PX;top:415PX;width:661PX;height:30PX;'><span class='fc1-0'>7. คำสั่งรพ.ค่ายสุรศักดิ์มนตรี ที่ 151/60 ลง 23 ส.ค. 60, 237/60 ลง 15 ธ.ค. 60 เรื่องแต่งตั้งคณะกรรมการผู้รับผิดชอบ</span></DIV>";

print "<DIV style='left:105PX;top:440PX;width:661PX;height:30PX;'><span class='fc1-0'>ในการจัดทำร่างขอบเขตงานหรือรายละเอียดคุณลักษณะเฉพาะเจาะจงของพัสดุที่จะซื้อหรือจ้าง</span></DIV>";
	
	$query55 = "SELECT drugcode FROM poitems WHERE idno = '$nRow_id' AND (drugcode ='2RECO' || drugcode ='2EPOS' || drugcode ='2EPOS_3000' || drugcode ='2EPOS_4000' || drugcode ='2EPOS_5000' || drugcode ='2ESPOVI')";
	//echo $query55;
	$result55 = mysql_query($query55);
	if(mysql_num_rows($result55) > 0){  //ถ้าเป็นยาชีววัตถุคล้ายคลึง
		print "<DIV style='left:105PX;top:465PX;width:661PX;height:30PX;'><span class='fc1-0'>8. หนังสือคณะกรรมการวินิจฉัยปัญหาการจัดซื้อจัดจ้างและการบริหารพัสดุภาครัฐกรมบัญชีกลาง ที่ กค (กวจ) 0405.2/050764 </span></DIV>";	
		
		print "<DIV style='left:105PX;top:490PX;width:661PX;height:30PX;'><span class='fc1-0'>ลง 24 พ.ย. 60</span></DIV>";			
		
		print "<DIV style='left:54PX;top:515PX;width:106PX;height:30PX;'><span class='fc1-5'>สิ่งที่ส่งมาด้วย</span></DIV>";
		
		print "<DIV style='left:166PX;top:515PX;width:229PX;height:30PX;'><span class='fc1-0'>1. หนังสือกองเภสัชกรรม รพ.ค่ายฯ ที่</span></DIV>";
		
		print "<DIV style='left:394PX;top:515PX;width:110PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'><B>$cPrepono</B></span></DIV>";
		
		print "<DIV style='left:503PX;top:515PX;width:56PX;height:30PX;'><span class='fc1-0'>ลงวันที่</span></DIV>";
		
		print "<DIV style='left:558PX;top:515PX;width:208PX;height:30PX;'><span class='fc1-0'><B>$cPrepodate</B></span></DIV>";
		
		print "<DIV style='left:166PX;top:540PX;width:600PX;height:30PX;'><span class='fc1-0'>2. บัญชีรายละเอียดในการ จัดซื้อ จำนวน 1 ชุด</span></DIV>";
		
		print "<DIV style='left:166PX;top:565PX;width:600PX;height:30PX;'><span class='fc1-0'>3. ร่างขอบเขตของงานและรายละเอียดคุณลักษณะของพัสดุที่จะซื้อหรือจ้าง จำนวน 1 ชุด</span></DIV>";
		
		print "<DIV style='left:105PX;top:590PX;width:661PX;height:30PX;'><span class='fc1-0'>1. เนื่องด้วยกองเภสัชกรรม รพ.ค่ายฯ มีความจำเป็นที่จะต้องจัดซื้อยาเพื่อใช้ในราชการ รพ.ค่ายฯ</span></DIV>";
		
		print "<DIV style='left:61PX;top:615PX;width:705PX;height:30PX;'><span class='fc1-0'>ตามสิ่งที่ส่งมาด้วย 1.</span></DIV>";
		
		print "<DIV style='left:105PX;top:640PX;width:661PX;height:30PX;'><span class='fc1-0'>2. รายละเอียด พัสดุที่จะจัดซื้อ ตามบัญชีรายละเอียดที่แนบ ตามสิ่งที่ส่งมาด้วย 2.</span></DIV>";
		
		print "<DIV style='left:105PX;top:665PX;width:661PX;height:30PX;'><span class='fc1-0'>3. ขอบเขตของงานหรือรายละเอียดคุณลักษณะเฉพาะของพัสดุ ตามสิ่งที่ส่งมาด้วย 3.</span></DIV>";
		
		print "<DIV style='left:105PX;top:690PX;width:661PX;height:30PX;'><span class='fc1-0'>4. ราคากลางของพัสดุที่จะซื้อ ตามสิ่งที่ส่งมาด้วย 2.</span></DIV>";
		
		print "<DIV style='left:105PX;top:715PX;width:189PX;height:30PX;'><span class='fc1-0'>5. วงเงิน จัดซื้อ ครั้งนี้เป็นเงิน</span></DIV>";
		
		print "<DIV style='left:293PX;top:715PX;width:99PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'><B>$nPriadvat</B></span></DIV>";
		
		print "<DIV style='left:391PX;top:715PX;width:40PX;height:30PX;'><span class='fc1-0'>บาท</span></DIV>";
		
		print "<DIV style='left:430PX;top:715PX;width:400PX;height:30PX;'><span class='fc1-0'>$cPriadvat</span></DIV>";  //จำนวนเงินตัวอักษร  ----->
		
		print "<DIV style='left:61PX;top:740PX;width:661PX;height:30PX;'><span class='fc1-0'>ต้องการให้งานนั้นเสร็จภายใน 30 วัน อยู่ในอำนาจการสั่งซื้อสั่งจ้างของ ผอ.รพ.ค่ายฯ ตามอ้างถึง 5.</span></DIV>";
		
		print "<DIV style='left:105PX;top:765PX;width:239PX;height:30PX;'><span class='fc1-0'>6. กำหนดเวลาที่ต้องการใช้วัสดุในวันที่</span></DIV>";
		
		print "<DIV style='left:333PX;top:765PX;width:167PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'><B>$cFixdate</B></span></DIV>";  //วันที่ ข้อ 4
		
		print "<DIV style='left:509PX;top:765PX;width:257PX;height:30PX;'><span class='fc1-0'>ส่งที่หน่วย รพ.ค่ายสุรศักดิ์มนตรี</span></DIV>";
		
		print "<DIV style='left:105PX;top:790PX;width:661PX;height:30PX;'><span class='fc1-0'>7. การซื้อครั้งนี้เป็นการจัดซื้อโดยวิธีเฉพาะเจาะจง เนื่องจากเป็นการจัดซื้อยาชีววัตถุที่ไม่ใช่ยาชีววัตถุคล้ายคลึง</span></DIV>";
		
		print "<DIV style='left:61PX;top:815PX;width:705PX;height:30PX;'><span class='fc1-0'>ตามอ้างถึง 8. ข้อ 1.5 และมีวงเงินในการจัดซื้อจัดจ้างครั้งหนึ่งไม่เกินวงเงินตามที่กำหนดในกฎกระทรวง ตามอ้างถึง1 มาตรา56 (2)</span></DIV>";
		
		print "<DIV style='left:61PX;top:840PX;width:705PX;height:30PX;'><span class='fc1-0'>(ข) และตามอ้างถึง2 ข้อ1</span></DIV>";
		
		print "<DIV style='left:105PX;top:865PX;width:661PX;height:30PX;'><span class='fc1-0'>8. การซื้อครั้งนี้เห็นควรซื้อ จาก";
		print " <B>$cComname</B> ซึ่งเป็นยากลุ่มชีววัตถุโครงสร้างซับซ้อน</span></DIV>";
		print "<DIV style='left:61PX;top:890PX;width:710PX;height:30PX;'><span class='fc1-0'>ที่มีรายงานผู้ป่วยเกิดอาการไม่พึงประสงค์จากการใช้ยารุนแรงเนื่องจากเปลี่ยนยี่ห้อของผลิตภัณฑ์ ผลิตภัณฑ์จากต่างบริษัทจะทำให้</span></DIV>";
		print "<DIV style='left:61PX;top:915PX;width:705PX;height:30PX;'><span class='fc1-0'>เกิดความแตกต่างของการตอบสนองทางภูมิคุ้มกันในผู้ป่วยแต่ละราย ตามอ้างถึง 8.  โดยใช้เกณฑ์ราคาในการพิจารณาคัดเลือก </span></DIV>";		
		print "<DIV style='left:61PX;top:940PX;width:705PX;height:30PX;'><span class='fc1-0'> และขออนุมัติใช้ใบสั่งซื้อเป็นข้อตกลงแทนการทำสัญญา และไม่ควรเรียกหลักประกันสัญญา</span></DIV>";
		//สิ้นสุดเนื้อหา PO ใบที่1 page1
		
		
		
		//เริ่มต้นเนื้อหา PO ใบที่1 page12
		print "<DIV style='left:105PX;top:11365PX;width:661PX;height:30PX;'><span class='fc1-0'>9. ข้อเสนอ</span></DIV>";
		
		print "<DIV style='left:138PX;top:11390PX;width:600PX;height:30PX;'><span class='fc1-0'>9.1 เห็นควรอนุมัติให้กองเภสัชกรรม รพ.ค่ายสุรศักดิ์มนตรี ดำเนินการจัดซื้อโดยวิธีการเฉพาะเจาะจง</span></DIV>";
		
		print "<DIV style='left:61PX;top:11415PX;width:705PX;height:30PX;'><span class='fc1-0'>ตามรายละเอียดในรายงานข้างต้น</span></DIV>";
		
		print "<DIV style='left:138PX;top:11440PX;width:120PX;height:30PX;'><span class='fc1-0'>9.2 เห็นควรแต่งตั้ง</span></DIV>";
		
		print "<DIV style='left:257PX;top:11440PX;width:150PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$cKumkan</span></DIV>";
		
		print "<DIV style='left:406PX;top:11440PX;width:48PX;height:30PX;'><span class='fc1-0'>จำนวน</span></DIV>";
		
		print "<DIV style='left:453PX;top:11440PX;width:18PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$nKumkan</span></DIV>";
		
		print "<DIV style='left:470PX;top:11440PX;width:295PX;height:30PX;'><span class='fc1-0'>นาย ตามระเบียบฯ ด้วยแล้วรายงานผล</span></DIV>";
		
		print "<DIV style='left:61PX;top:11465PX;width:705PX;height:30PX;'><span class='fc1-0'> ให้ทราบภายใน 5 วันทำการ</span></DIV>";
		
		print "<DIV style='left:138PX;top:11490PX;width:628PX;height:30PX;'><span class='fc1-0'>จึงเรียนมาเพื่อกรุณาทราบ และกรุณาอนุมัติตามข้อเสนอในข้อ 9.</span></DIV>";
		
		//ระยะบรรทัด 25
		print "<DIV style='left:466PX;top:11540PX;width:71PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>$aYot[2]</span></DIV>";  //ยศ
		
		print "<DIV style='left:456PX;top:11540PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost2[2]</span></DIV>"; //ลงชื่อ
		
		print "<DIV style='left:456PX;top:11565PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>($aFname[2])</span></DIV>";  //ชื่อสกุล
		
		print "<DIV style='left:456PX;top:11590PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost[2]</span></DIV>";  //ตำแหน่ง
		//สิ้นสุดเนื้อหา PO ใบที่1 page12		
	}else{
print "<DIV style='left:54PX;top:465PX;width:106PX;height:30PX;'><span class='fc1-5'>สิ่งที่ส่งมาด้วย</span></DIV>";

print "<DIV style='left:166PX;top:465PX;width:229PX;height:30PX;'><span class='fc1-0'>1. หนังสือกองเภสัชกรรม รพ.ค่ายฯ ที่</span></DIV>";

print "<DIV style='left:394PX;top:465PX;width:110PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'><B>$cPrepono</B></span></DIV>";

print "<DIV style='left:503PX;top:465PX;width:56PX;height:30PX;'><span class='fc1-0'>ลงวันที่</span></DIV>";

print "<DIV style='left:558PX;top:465PX;width:208PX;height:30PX;'><span class='fc1-0'><B>$cPrepodate</B></span></DIV>";

print "<DIV style='left:166PX;top:490PX;width:600PX;height:30PX;'><span class='fc1-0'>2. บัญชีรายละเอียดในการ จัดซื้อ จำนวน 1 ชุด</span></DIV>";

print "<DIV style='left:166PX;top:515PX;width:600PX;height:30PX;'><span class='fc1-0'>3. ร่างขอบเขตของงานและรายละเอียดคุณลักษณะของพัสดุที่จะซื้อหรือจ้าง จำนวน 1 ชุด</span></DIV>";

print "<DIV style='left:105PX;top:540PX;width:661PX;height:30PX;'><span class='fc1-0'>1. เนื่องด้วยกองเภสัชกรรม รพ.ค่ายฯ มีความจำเป็นที่จะต้องจัดซื้อยาเพื่อใช้ในราชการ รพ.ค่ายฯ</span></DIV>";

print "<DIV style='left:61PX;top:565PX;width:705PX;height:30PX;'><span class='fc1-0'>ตามสิ่งที่ส่งมาด้วย 1.</span></DIV>";

print "<DIV style='left:105PX;top:590PX;width:661PX;height:30PX;'><span class='fc1-0'>2. รายละเอียด พัสดุที่จะจัดซื้อ ตามบัญชีรายละเอียดที่แนบ ตามสิ่งที่ส่งมาด้วย 2.</span></DIV>";

print "<DIV style='left:105PX;top:615PX;width:661PX;height:30PX;'><span class='fc1-0'>3. ขอบเขตของงานหรือรายละเอียดคุณลักษณะเฉพาะของพัสดุ ตามสิ่งที่ส่งมาด้วย 3.</span></DIV>";

print "<DIV style='left:105PX;top:640PX;width:661PX;height:30PX;'><span class='fc1-0'>4. ราคากลางของพัสดุที่จะซื้อ ตามสิ่งที่ส่งมาด้วย 2.</span></DIV>";

print "<DIV style='left:105PX;top:665PX;width:189PX;height:30PX;'><span class='fc1-0'>5. วงเงิน จัดซื้อ ครั้งนี้เป็นเงิน</span></DIV>";

print "<DIV style='left:293PX;top:665PX;width:99PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'><B>$nPriadvat</B></span></DIV>";

print "<DIV style='left:391PX;top:665PX;width:40PX;height:30PX;'><span class='fc1-0'>บาท</span></DIV>";

print "<DIV style='left:430PX;top:665PX;width:400PX;height:30PX;'><span class='fc1-0'>$cPriadvat</span></DIV>";  //จำนวนเงินตัวอักษร

print "<DIV style='left:61PX;top:690PX;width:661PX;height:30PX;'><span class='fc1-0'>ต้องการให้งานนั้นเสร็จภายใน 30 วัน อยู่ในอำนาจการสั่งซื้อสั่งจ้างของ ผอ.รพ.ค่ายฯ ตามอ้างถึง 5.</span></DIV>";

print "<DIV style='left:105PX;top:715PX;width:239PX;height:30PX;'><span class='fc1-0'>6. กำหนดเวลาที่ต้องการใช้วัสดุในวันที่</span></DIV>";

print "<DIV style='left:333PX;top:715PX;width:167PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'><B>$cFixdate</B></span></DIV>";  //วันที่ ข้อ 4

print "<DIV style='left:509PX;top:715PX;width:257PX;height:30PX;'><span class='fc1-0'>ส่งที่หน่วย รพ.ค่ายสุรศักดิ์มนตรี</span></DIV>";

print "<DIV style='left:105PX;top:740PX;width:661PX;height:30PX;'><span class='fc1-0'>7. การซื้อครั้งนี้เป็นการจัดซื้อโดยวิธีเฉพาะเจาะจง เนื่องจากเป็นการจัดซื้อจัดจ้างพัสดุที่มีการผลิต จำหน่าย ก่อสร้าง หรือ</span></DIV>";

print "<DIV style='left:61PX;top:765PX;width:705PX;height:30PX;'><span class='fc1-0'>ให้บริการทั่วไป และมีวงเงินในการจัดซื้อจัดจ้างครั้งหนึ่งไม่เกินวงเงินตามที่กำหนดในกฎกระทรวง ตามอ้างถึง1 มาตรา56 (2)</span></DIV>";

print "<DIV style='left:61PX;top:790PX;width:705PX;height:30PX;'><span class='fc1-0'>(ข) และตามอ้างถึง2 ข้อ1</span></DIV>";

//print "===>$prodrugtype";
if($prodrugtype=="" || $prodrugtype=="1"){
//print "===>".strlen($cComname);
	if(strlen($cComname) <= 30){
		print "<DIV style='left:105PX;top:815PX;width:661PX;height:30PX;'><span class='fc1-0'>8. การซื้อครั้งนี้เห็นควรซื้อ จาก";
		print " <B>$cComname</B> ซึ่งเป็นผู้ประกอบการที่มีอาชีพขายยาและเวชภัณฑ์</span></DIV>";
		print "<DIV style='left:61PX;top:840PX;width:710PX;height:30PX;'><span class='fc1-0'>ที่เสนอความต้องการจัดซื้อในครั้งนี้โดยตรง โดยใช้เกณฑ์ราคาในการพิจารณาคัดเลือก และขออนุมัติใช้ใบสั่งซื้อเป็นข้อตกลง</span></DIV>";	
		print "<DIV style='left:61PX;top:865PX;width:705PX;height:30PX;'><span class='fc1-0'>แทนการทำสัญญา และไม่ควรเรียกหลักประกันสัญญา</span></DIV>";	
	}else if(strlen($cComname) > 30 && strlen($cComname) <= 40){ 
		print "<DIV style='left:105PX;top:815PX;width:661PX;height:30PX;'><span class='fc1-0'>8. การซื้อครั้งนี้เห็นควรซื้อ จาก";
		print " <B>$cComname</B> ซึ่งเป็นผู้ประกอบการที่มีอาชีพขายยา</span></DIV>";
		print "<DIV style='left:61PX;top:840PX;width:710PX;height:30PX;'><span class='fc1-0'>และเวชภัณฑ์ที่เสนอความต้องการจัดซื้อในครั้งนี้โดยตรง โดยใช้เกณฑ์ราคาในการพิจารณาคัดเลือกและขออนุมัติใช้ใบสั่งซื้อเป็นข้อตกลง</span></DIV>";
print "<DIV style='left:61PX;top:865PX;width:705PX;height:30PX;'><span class='fc1-0'>แทนการทำสัญญา และ ไม่ควรเรียกหลักประกันสัญญา</span></DIV>";		
	}else{
		print "<DIV style='left:105PX;top:815PX;width:661PX;height:30PX;'><span class='fc1-0'>8. การซื้อครั้งนี้เห็นควรซื้อ จาก";
		print " <B>$cComname</B> ซึ่งเป็นผู้ประกอบการ</span></DIV>";
		print "<DIV style='left:61PX;top:840PX;width:710PX;height:30PX;'><span class='fc1-0'>ที่มีอาชีพขายยาและเวชภัณฑ์ที่เสนอความต้องการจัดซื้อในครั้งนี้โดยตรง โดยใช้เกณฑ์ราคาในการพิจารณาคัดเลือก</span></DIV>";
print "<DIV style='left:61PX;top:865PX;width:705PX;height:30PX;'><span class='fc1-0'>และขออนุมัติใช้ใบสั่งซื้อเป็นข้อตกลงแทนการทำสัญญา และ ไม่ควรเรียกหลักประกันสัญญา</span></DIV>";				
	}
}else if($prodrugtype=="2"){
print "<DIV style='left:105PX;top:815PX;width:661PX;height:30PX;'><span class='fc1-0'>8. การซื้อครั้งนี้เห็นควรซื้อ จาก";
print " <B>$cComname</B> ซึ่งเป็นการสั่งซื้อระหว่างหน่วยงานราชการกับหน่วยงานราชการ</span></DIV>";
print "<DIV style='left:61PX;top:840PX;width:710PX;height:30PX;'><span class='fc1-0'>ตามอ้างถึง 3. โดยใช้เกณฑ์ราคาในการพิจารณาคัดเลือก และขออนุมัติใช้ใบสั่งซื้อเป็นข้อตกลงแทนการทำสัญญา</span></DIV>";
print "<DIV style='left:61PX;top:865PX;width:705PX;height:30PX;'><span class='fc1-0'>และไม่ควรเรียกหลักประกันสัญญา</span></DIV>";
}else if($prodrugtype=="3"){
print "<DIV style='left:105PX;top:815PX;width:661PX;height:30PX;'><span class='fc1-0'>8. การซื้อครั้งนี้เห็นควรซื้อ จาก";
print " <B>$cComname</B> ซึ่งเป็นการสั่งซื้อระหว่างหน่วยงานราชการกับหน่วยงานราชการ</span></DIV>";
print "<DIV style='left:61PX;top:840PX;width:710PX;height:30PX;'><span class='fc1-0'>ตามอ้างถึง 3. โดยใช้เกณฑ์ราคาในการพิจารณาคัดเลือก และขออนุมัติใช้ใบสั่งซื้อเป็นข้อตกลงแทนการทำสัญญา </span></DIV>";
print "<DIV style='left:61PX;top:865PX;width:705PX;height:30PX;'><span class='fc1-0'>และไม่ควรเรียกหลักประกันสัญญา</span></DIV>";
}else if($prodrugtype=="4"){
print "<DIV style='left:105PX;top:815PX;width:661PX;height:30PX;'><span class='fc1-0'>8. การซื้อครั้งนี้เห็นควรซื้อ จาก";
print " <B>$cComname</B> ซึ่งเป็นยาและเวชภัณฑ์</span></DIV>";
print "<DIV style='left:61PX;top:840PX;width:710PX;height:30PX;'><span class='fc1-0'>ที่ได้ขึ้นบัญชีนวัตกรรมไทย ตามอ้างถึง 3. โดยใช้เกณฑ์ราคาในการพิจารณาคัดเลือกและขออนุมัติใช้ใบสั่งซื้อ</span></DIV>";
print "<DIV style='left:61PX;top:865PX;width:705PX;height:30PX;'><span class='fc1-0'>เป็นข้อตกลงแทนการทำสัญญา และไม่ควรเรียกหลักประกันสัญญา</span></DIV>";
}else if($prodrugtype=="5"){
print "<DIV style='left:105PX;top:815PX;width:661PX;height:30PX;'><span class='fc1-0'>8. การซื้อครั้งนี้เห็นควรซื้อ จาก";
print " <B>$cComname</B> ซึ่งเป็นวัคซีนโรคตับอักเสบบี</span></DIV>";
print "<DIV style='left:61PX;top:840PX;width:710PX;height:30PX;'><span class='fc1-0'>และผลิตภัณฑ์อื่นๆ ที่สภากาชาดไทยผลิตเอง และไม่อยู่ในบัญชี ตามอ้างถึง 3. โดยใช้เกณฑ์ราคาในการพิจารณาคัดเลือก</span></DIV>";
print "<DIV style='left:61PX;top:865PX;width:705PX;height:30PX;'><span class='fc1-0'>และขออนุมัติใช้ใบสั่งซื้อเป็นข้อตกลงแทนการทำสัญญา และไม่ควรเรียกหลักประกันสัญญา</span></DIV>";
}
//สิ้นสุดเนื้อหา PO ใบที่1 page1



//เริ่มต้นเนื้อหา PO ใบที่1 page12
print "<DIV style='left:105PX;top:11365PX;width:661PX;height:30PX;'><span class='fc1-0'>9. ข้อเสนอ</span></DIV>";

print "<DIV style='left:138PX;top:11390PX;width:600PX;height:30PX;'><span class='fc1-0'>9.1 เห็นควรอนุมัติให้กองเภสัชกรรม รพ.ค่ายสุรศักดิ์มนตรี ดำเนินการจัดซื้อโดยวิธีการเฉพาะเจาะจง</span></DIV>";

print "<DIV style='left:61PX;top:11415PX;width:705PX;height:30PX;'><span class='fc1-0'>ตามรายละเอียดในรายงานข้างต้น</span></DIV>";

print "<DIV style='left:138PX;top:11440PX;width:120PX;height:30PX;'><span class='fc1-0'>9.2 เห็นควรแต่งตั้ง</span></DIV>";

print "<DIV style='left:257PX;top:11440PX;width:150PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$cKumkan</span></DIV>";

print "<DIV style='left:406PX;top:11440PX;width:48PX;height:30PX;'><span class='fc1-0'>จำนวน</span></DIV>";

print "<DIV style='left:453PX;top:11440PX;width:18PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$nKumkan</span></DIV>";

print "<DIV style='left:470PX;top:11440PX;width:295PX;height:30PX;'><span class='fc1-0'>นาย ตามระเบียบฯ ด้วยแล้วรายงานผล</span></DIV>";

print "<DIV style='left:61PX;top:11465PX;width:705PX;height:30PX;'><span class='fc1-0'> ให้ทราบภายใน 5 วันทำการ</span></DIV>";

print "<DIV style='left:138PX;top:11490PX;width:628PX;height:30PX;'><span class='fc1-0'>จึงเรียนมาเพื่อกรุณาทราบ และกรุณาอนุมัติตามข้อเสนอในข้อ 9.</span></DIV>";

//ระยะบรรทัด 25
print "<DIV style='left:466PX;top:11540PX;width:71PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>$aYot[2]</span></DIV>";  //ยศ

print "<DIV style='left:456PX;top:11540PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost2[2]</span></DIV>"; //ลงชื่อ

print "<DIV style='left:456PX;top:11565PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>($aFname[2])</span></DIV>";  //ชื่อสกุล

print "<DIV style='left:456PX;top:11590PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost[2]</span></DIV>";  //ตำแหน่ง
//สิ้นสุดเนื้อหา PO ใบที่1 page12
	}
print "<BR>";
print "</BODY></HTML>";

///po98 ใบที่2 page 2

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
print "</STYLE>";
print "<TITLE>จัดซื้อยา (รวมVATก่อน)</TITLE>";
print "</head>";
print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";
print "<DIV style='z-index:0'> &nbsp; </div>";

print "<DIV style='left:155PX;top:1065PX;width:403PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>บัญชีรายละเอียดพัสดุในการจัดหา (ซื้อ) โดย วิธีเฉพาะเจาะจง</span></DIV>";
print "<DIV style='left:103PX;top:1090PX;width:506PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>ประกอบรายงาน ที่ กห   0483.63.4/$cPono$cPonoyear ลง </span><span class='fc1-0'>$cPodate</span></DIV>";
?>
<style type="text/css">
.dx_tb{
	border: 1px dashed #000;
	font-size: 13pt;
}
.dx_tb thead tr th{
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
.dx_detail div{
	position: relative;
	padding-left: 10px;
}
.div_main{
	width: 9in;
	height: 11in;
	margin: auto;
}
</style>
<div style="position: absolute; left:10px; top: 1115px; font-family: TH SarabunPSK; font-size: 13pt;">
	<table class="dx_tb">
		<thead>
			<tr>
				<th style="width:38px;">ลำดับ</th>
				<th style="width:258px;">รายการ</th>
				<th style="width:51px;">หน่วยนับ</th>
				<th style="width:75px;">ขนาดบรรจุ</th>
				<th style="width:43px;">จำนวน</th>
				<th style="width:55px;">ราคากลาง</th>
				<th style="width:55px;">แหล่งที่มาของราคากลาง ***</th>
				<th style="width:75px;">หน่วยละ<br />
				  รวม VAT</th>
				<th style="width:75px;">ราคา<br />
				  รวม VAT</th>
				<th  style="width:75px;" class="last_child">Spec พบ.ที่</th>
			</tr>
		</thead>
		<tbody>
			
			<?php
			$sumtotal=0;
			for ($ii=1; $ii <= 19; $ii++) { 
				 include("connect.inc");
				$sql1="select unitpri,part,freelimit,edpri,edpri_from from druglst where drugcode='$aDrugcode[$ii]'";
				//print $sql1;
				$chkquery=mysql_query($sql1);
				$chkrows=mysql_num_rows($chkquery);
				//echo "==>".$chkrows;
					list($unitpri,$part,$freelimit,$edpri,$edprifrom)=mysql_fetch_array($chkquery);				
					// ราคากลาง
					//echo "==>".$edprifrom;
					
					$cost = false;
					
					//  ถ้าเป็นอุปกรณ์ เทียบจาก อุปกรณ์เบิกได้ไม่เกิน
					if( $part == 'DPY' OR $part == 'DPN' ){
	
						// ราคาอุปกรณ์เบิกได้ไม่เกิน
						if( $freelimit > 0 ){
							$cost = $freelimit;  //
							if($edprifrom==0 && $edprifrom !=""){  //ถ้าแหล่งที่มาราคากลางเป็นค่าว่าง
								$from = 3;
							}else{  //ถ้าแหล่งที่มาไม่ใช่ค่าว่าง
								$from = $edprifrom;
							}
						}
					}else{  //ถ้าเป็นยา/เวชภัณฑ์
						// ราคากลางต้องมากกว่า 0
						if( $edpri > 0 ){  //ถ้าราคากลางมากกว่า 0
							$cost = $edpri;
							if($edprifrom==0 && $edprifrom !=""){  //ถ้าแหล่งที่มาราคากลางยังไม่มีการกำหนดค่า
								$from = 3;
							}else{  //ถ้าแหล่งที่มามีข้อมูลแล้ว
								$from = $edprifrom;
							}
						}else{
							$cost = $edpri;
							if($edprifrom==0 && $edprifrom !=""){  //ถ้าแหล่งที่มาราคากลางยังไม่มีการกำหนดค่า
								$from = 5;
							}else{  //ถ้าแหล่งที่มามีข้อมูลแล้ว
								$from = $edprifrom;
							}					
						}
					}

				$aTotalpackprice=$aAmount[$ii]*$aPackpri[$ii];
				$aTotalprice=$aAmount[$ii]*$aPackpri_vat[$ii];
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
		</tbody>
	</table>
</div>    
<?   

print "<DIV style='left:46PX;top:1773PX;width:77PX;height:30PX;'><span class='fc1-0'>หมายเหตุ</span></DIV>";
print "<DIV style='left:122PX;top:1773PX;width:245PX;height:30PX;'><span class='fc1-0'>- สป. ตามบัญชีต้องการของภายในวันที่</span></DIV>";
print "<DIV style='left:122PX;top:1802PX;width:245PX;height:30PX;'><span class='fc1-0'>- บริษัทที่จะซื้อตามที่ได้สืบราคาแล้ว</span></DIV>";
print "<DIV style='left:366PX;top:1773PX;width:384PX;height:30PX;'><span class='fc1-0'><B>$cBounddate</B></span></DIV>";
print "<DIV style='left:366PX;top:1802PX;width:384PX;height:30PX;'><span class='fc1-0'><B>$cComname</B></span></DIV>";

print "<DIV style='left:367PX;top:1863PX;width:77PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>ตรวจถูกต้อง</span></DIV>";
print "<DIV style='left:418PX;top:1968PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost[2]</span></DIV>";
print "<DIV style='left:430PX;top:1926PX;width:269PX;height:30PX;'><span class='fc1-0'>$aYot[2]</span></DIV>";

print "<DIV style='left:418PX;top:1947PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>($aFname[2])</span></DIV>";
print "<DIV style='left:418PX;top:1990PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost2[2]</span></DIV>";
print "<BR>";
print "</BODY></HTML>";

//po92  ใบที่3 page3
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
 //print ".fc1-0 { COLOR:000000;FONT-SIZE:13PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:BOLD;TEXT-DECORATION:UNDERLINE;}";
//print ".fc1-1 { COLOR:000000;FONT-SIZE:11PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:NORMAL;}";

print ".fc1-2 { COLOR:000000;FONT-SIZE:16PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:NORMAL;}";
print ".fc1-3 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:NORMAL;}";
print ".fc1-9 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:NORMAL;TEXT-DECORATION:UNDERLINE;}";

//print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";
//print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-style:dotted;border-top-width:0PX;border-right-width:0PX;}";
print "</STYLE>";
print "<TITLE>จัดซื้อยา (รวมVATหลัง)</TITLE>";
print "</head>";
print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";
print "<DIV style='z-index:0'> &nbsp; </div>";
/*
print "<div style='left:365PX;top:2615PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:259PX;'></div>";
print "<div style='left:365PX;top:2638PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:259PX;'></div>";
print "<div style='left:365PX;top:2660PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:259PX;'></div>";
print "<div style='left:365PX;top:2682PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:259PX;'></div>";
print "<div style='left:373PX;top:2886PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:259PX;'></div>";
*/
print "<div style='left:365PX;top:2618PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>.................................................................</span></div>";
print "<div style='left:365PX;top:2640PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>.................................................................</span></div>";  //ผู้ขาย
print "<div style='left:365PX;top:2662PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>.................................................................</span></div>";  //พยาน
print "<div style='left:365PX;top:2684PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>.................................................................</span></div>";  //พยาน



print "<div style='left:373PX;top:2870PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>.................................................................</span></div>";

print "<DIV style='left:78PX;top:2066PX;width:695PX;height:25PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'><b>ข้อตกลงระหว่างผู้ซื้อและผู้ขายแนบท้ายใบสั่งซื้อเป็นข้อตกลงแทนการทำสัญญา ที่ $cPono$cPonoyear ลง $cSenddate</b></span></DIV>";

print "<DIV style='left:138PX;top:2094PX;width:645PX;height:21PX;'><span class='fc1-3'>ข้อ 1. ผู้ขายรับรองว่าสิ่งของที่ขายให้ตามใบสั่งซื้อนี้มี รูปร่าง ลักษณะ ขนาด และคุณภาพไม่ต่ำกว่าที่กำหนดไว้ ตามที่ทางราชการกำหนด </span></DIV>";
print "<DIV style='left:88PX;top:2114PX;width:695PX;height:21PX;'><span class='fc1-3'>โดยจะต้องเป็นของใหม่ไม่เคยถูกใช้มาก่อน ซึ่งผู้ซื้อได้สั่งซื้อตามจำนวนและราคาดังปรากฏในใบสั่งซื้อฉบับนี้</span></DIV>";  

print "<DIV style='left:309PX;top:2618PX;width:55PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>&nbsp;</span></DIV>";
print "<DIV style='left:372PX;top:2618PX;width:71PX;height:22PX;'><span class='fc1-3'>$aYot[2]</span></DIV>";


print "<DIV style='left:309PX;top:2640PX;width:55PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>&nbsp;</span></DIV>";
print "<DIV style='left:547PX;top:2640PX;width:51PX;height:23PX;'><span class='fc1-3'>ผู้ขาย</span></DIV>";


print "<DIV style='left:309PX;top:2662PX;width:55PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>&nbsp;</span></DIV>";
print "<DIV style='left:372PX;top:2662PX;width:55PX;height:23PX;'><span class='fc1-3'>$aYot[9]</span></DIV>";
print "<DIV style='left:547PX;top:2662PX;width:51PX;height:23PX;'><span class='fc1-3'>พยาน</span></DIV>";

print "<DIV style='left:372PX;top:2684PX;width:71PX;height:23PX;'><span class='fc1-3'>$aYot[10]</span></DIV>";
print "<DIV style='left:547PX;top:2684PX;width:51PX;height:23PX;'><span class='fc1-3'>พยาน</span></DIV>";

print "<DIV style='left:88PX;top:2154PX;width:695PX;height:21PX;'><span class='fc1-3'>ให้ถูกต้องและครบถ้วนตามที่กำหนดไว้ในข้อ 1. แห่งใบสั่งซื้อนี้ พร้อมทั้งหีบห่อ หรือเครื่องรัดพันผูกโดยเรียบร้อย</span></DIV>";
print "<DIV style='left:138PX;top:2136PX;width:645PX;height:21PX;'><span class='fc1-3'>ข้อ 2. ผู้ขายรับรองว่าจะส่งมอบสิ่งของที่ซื้อขายตามใบสั่งซื้อนี้ให้แก่ผู้ซื้อ ณ รพ.ค่ายสุรศักดิ์มนตรี  ภายในวันที่ ";
print "</span><span class='fc1-3'>$cFixdate</span></DIV>";
print "<DIV style='left:138PX;top:2174PX;width:645PX;height:21PX;'><span class='fc1-3'>ข้อ 3. ก่อนหรือในวันลงลายมือชื่อใบสั่งซื้อนี้ ผู้ขายได้นำหลักประกันเป็น....... -.........เป็นจำนวนร้อยละ.............ของราคาสิ่งของทั้งหมด</span></DIV>";
print "<DIV style='left:88PX;top:2194PX;width:695PX;height:23PX;'><span class='fc1-3'>คิดเป็นเงิน.....-...... บาท .(.....-......) มามอบไว้แก่ผู้ซื้อเพื่อเป็นการประกันการปฏิบัติตามข้อตกลงนี้หลักประกันดังกล่าวผู้ซื้อจะคืนให้เมื่อผู้ขายพ้นจากข้อ</span></DIV>";
print "<DIV style='left:88PX;top:2216PX;width:695PX;height:23PX;'><span class='fc1-3'>ผูกพันตามข้อตกลงนี้แล้ว</span></DIV>";
print "<DIV style='left:138PX;top:2238PX;width:645PX;height:23PX;'><span class='fc1-3'>ข้อ 4. ถ้าปรากฏว่าสิ่งของที่ผู้ขายส่งมอบไม่ตรงตามข้อตกลงข้อ 1. ผู้ซื้อทรงไว้ซึ่งสิทธิที่จะไม่รับของนั้น ในกรณีเช่นว่านี้ ผู้ขายต้องรีบนำสิ่งของนั้น</span></DIV>";
print "<DIV style='left:88PX;top:2260PX;width:695PX;height:23PX;'><span class='fc1-3'>กลับคืนโดยเร็วที่สุดที่จะทำได้ และนำสิ่งของมามอบให้ใหม่หรือต้องทำการแก้ไขให้ถูกต้องตามข้อตกลงโดยผู้ซื้อไม่ต้องใช้ค่าเสียหาย หรือค่าใช้จ่ายให้แต่ประการใด </span></DIV>";  
print "<DIV style='left:88PX;top:2282PX;width:645PX;height:23PX;'><span class='fc1-3'>ทั้งนี้ระยะเวลาที่เสียไปเพราะเหตุดังกล่าว ผู้ขายจะนำมาเป็นเหตุในการขอขยายเวลาทำการตามข้อตกลง หรืองดลดค่าปรับไม่ได้</span></DIV>";

print "<DIV style='left:138PX;top:2304PX;width:645PX;height:23PX;'><span class='fc1-3'>ข้อ 5. เมื่อครบกำหนดส่งมอบสิ่งของตามข้อตกลงนี้แล้ว&nbsp;&nbsp;&nbsp;ถ้าผู้ขายไม่ส่งมอบสิ่งของซึ่งตกลงขายให้แก่ผู้ซื้อ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;หรือส่งมอบสิ่งของทั้งหมดไม่ถูกต้อง</span></DIV>";
print "<DIV style='left:88PX;top:2326PX;width:695PX;height:23PX;'><span class='fc1-3'>หรือส่งมอบสิ่งของไม่ครบจำนวน ผู้ซื้อมีสิทธิบอกเลิกข้อตกลงทั้งหมดหรือบางส่วนได้ ในกรณีเช่นนี้ ผู้ขายยอมให้ผู้ซื้อริบหลักประกัน หรือเรียกร้องจากธนาคารผู้ออก</span></DIV>";
print "<DIV style='left:88PX;top:2348PX;width:695PX;height:23PX;'><span class='fc1-3'>หนังสือรับรองตามข้อ 3. เป็นจำนวนเงินทั้งหมด หรือแต่บางส่วนก็ได้แล้วแต่ผู้ซื้อจะเห็นสมควร และถ้าผู้ซื้อจัดสิ่งของจากบุคคลอื่นเต็มจำนวน หรือเฉพาะ</span></DIV>";
print "<DIV style='left:88PX;top:2370PX;width:695PX;height:23PX;'><span class='fc1-3'>จำนวนที่ขาดส่งแล้วแต่กรณีภายในกำหนด....1....เดือนนับแต่วันที่บอกเลิกข้อตกลง ผู้ขายต้องยอมรับผิดชอบชดใช้ราคาที่เพิ่มขึ้นจากราคาที่กำหนดไว้ในใบสั่งซื้อด้วย</span></DIV>";
print "<DIV style='left:138PX;top:2392PX;width:645PX;height:23PX;'><span class='fc1-3'>ข้อ 6. ในกรณีที่ผู้ซื้อไม่ใช้สิทธิบอกเลิกข้อตกลงตามข้อ 5. ผู้ขายยอมให้ผู้ซื้อปรับเป็นรายวัน ในอัตราร้อยละศูนย์จุดสอง(0.2) ของราคาสิ่งของ</span></DIV>";
print "<DIV style='left:88PX;top:2414PX;width:695PX;height:23PX;'><span class='fc1-3'>ที่ยังไม่ได้รับมอบ นับถัดจากวันครบกำหนดตามข้อ 2. จนถึงวันที่ผู้ขายได้นำสิ่งของมาส่งให้แก่ผู้ซื้อจนถูกต้องครบถ้วน และในระหว่างที่มีการปรับนั้นถ้าผู้ซื้อ</span></DIV>";
print "<DIV style='left:88PX;top:2436PX;width:695PX;height:23PX;'><span class='fc1-3'>เห็นว่าผู้ขายไม่อาจปฏิบัติตามข้อตกลงต่อไปได้ ผู้ซื้อจะใช้สิทธิบอกเลิกข้อตกลงและริบหลักประกันกับเรียกร้องให้ชดใช้ราคาที่เพิ่มขึ้นตามข้อ 5. นอกเหนือ</span></DIV>";
print "<DIV style='left:88PX;top:2458PX;width:695PX;height:23PX;'><span class='fc1-3'>จากการปรับจนถึงวันบอกเลิกข้อตกลงด้วยก็ได้ การคิดค่าปรับกรณีสิ่งของที่ตกลงซื้อขายประกอบกันเป็นชุด ขาดส่วนประกอบส่วนหนึ่งส่วนใดไปทำให้ไม่สามารถ</span></DIV>";
print "<DIV style='left:88PX;top:2480PX;width:695PX;height:23PX;'><span class='fc1-3'>ใช้การได้โดยสมบูรณ์ให้ถือว่ายังมิได้ส่งมอบสิ่งของนั้นเลย และให้คิดค่าปรับจากราคาสิ่งของเต็มทั้งชุด</span></DIV>";
print "<DIV style='left:138PX;top:2502PX;width:645PX;height:23PX;'><span class='fc1-3'>ข้อ 7. ผู้ขายยอมรับประกันความชำรุดบกพร่องหรือขัดข้องของสิ่งของตามข้อตกลงนี้เนื่องจากการใช้งานตามปกติเป็นเวลา....1.....ปี</span></DIV>";
print "<DIV style='left:88PX;top:2524PX;width:695PX;height:23PX;'><span class='fc1-3'>นับถัดจากวันที่ผู้ซื้อได้รับมอบสิ่งของ โดยภายในกำหนดเวลาดังกล่าว หากสิ่งของเกิดชำรุดผู้ขายต้องจัดการซ่อมแซม หรือแก้ไขให้ใช้การได้ดีดังเดิมภายใน 7 วัน </span></DIV>";
print "<DIV style='left:88PX;top:2546PX;width:695PX;height:23PX;'><span class='fc1-3'>นับแต่ที่ได้รับแจ้งจากผู้ซื้อและไม่คิดค่าใช้จ่ายใดๆ ทั้งสิ้นกับผู้ซื้อ</span></DIV>";
print "<DIV style='left:138PX;top:2568PX;width:645PX;height:23PX;'><span class='fc1-3'>ข้อ 8. ถ้าผู้ขายไม่ปฏิบัติตาม ข้อตกลงข้อหนึ่งข้อใด ด้วยเหตุใดๆ ก็ตาม จนเป็นเหตุให้เกิดความเสียหายแก่ผู้ซื้อ แล้วผู้ขายยอมรับผิดและยินยอม</span></DIV>";
print "<DIV style='left:88PX;top:2590PX;width:695PX;height:23PX;'><span class='fc1-3'>ชดใช้ค่าเสียหาย&nbsp;&nbsp;อันเกิดจากการที่ผู้ขายไม่ปฏิบัติตามข้อตกลงนั้น ให้แก่ผู้ซื้อ โดยสิ้นเชิง ภายในกำหนด 30 วันนับแต่วันที่ได้รับแจ้งจากผู้ซื้อ</span></DIV>";
print "<DIV style='left:547PX;top:2618PX;height:23PX;'><span class='fc1-3'>ผู้ซื้อ ทำการโดยได้รับมอบหมายจากผู้บัญชาการทหารบก</span></DIV>";
print "<DIV style='left:372PX;top:2643PX;width:71PX;height:23PX;'><span class='fc1-3'> </span></DIV>";

print "<DIV style='left:138PX;top:2710PX;width:645PX;height:22PX;'><span class='fc1-3'>ผู้ตรวจรับ/คณะกรรมการตรวจรับได้พร้อมกันตรวจรับสิ่งของตามใบสั่งซื้อนี้รวม ";
print "$nItems&nbsp;&nbsp;รายการ เป็นการถูกต้องและมอบให้เจ้าหน้าที่รับของไว้ใช้ราชการ โดย</span></DIV>";
print "<DIV style='left:88PX;top:2732PX;width:695PX;height:23PX;'><span class='fc1-3'>ถูกต้องแล้ว</span></DIV>";

print "<DIV style='left:138PX;top:2847PX;width:291PX;height:23PX;'><span class='fc1-3'>ข้าพเจ้าได้รับสิ่งของตามจำนวนในใบสั่งซื้อฉบับนี้แล้วเมื่อวันที่</span></DIV>";
print "<DIV style='left:430PX;top:2847PX;width:269PX;height:23PX;'><span class='fc1-3'>$cBounddate</span></DIV>";

//ผู้รับของ
print "<DIV style='left:317PX;top:2869PX;width:55PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>&nbsp;</span></DIV>";
print "<DIV style='left:378PX;top:2869PX;width:42PX;height:23PX;'><span class='fc1-3'>$aYot[4]</span></DIV>";  
print "<DIV style='left:547PX;top:2869PX;width:51PX;height:23PX;'><span class='fc1-3'>ผู้รับของ</span></DIV>";
print "<DIV style='left:371PX;top:2891PX;width:263PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$cBounddate</span></DIV>";

//ผู้ตรวจรับ/ประธานกรรมการ
print "<DIV style='left:315PX;top:2754PX;width:55PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>&nbsp;</span></DIV>";
print "<DIV style='left:378PX;top:2754PX;width:65PX;height:23PX;'><span class='fc1-3'>$aYot[6]</span></DIV>";
print "<DIV style='left:547PX;top:2754PX;width:150PX;height:23PX;'><span class='fc1-3'>$aPost[6]</span></DIV>";

//กรรมการ 1
print "<DIV style='left:315PX;top:276PX;width:55PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>&nbsp;</span></DIV>";
print "<DIV style='left:378PX;top:2776PX;width:65PX;height:23PX;'><span class='fc1-3'>$aYot[7]</span></DIV>";
print "<DIV style='left:547PX;top:2776PX;width:73PX;height:23PX;'><span class='fc1-3'>$aPost[7]</span></DIV>";

//กรรมการ 2
print "<DIV style='left:315PX;top:2798PX;width:55PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>&nbsp;</span></DIV>";
print "<DIV style='left:378PX;top:2798PX;width:65PX;height:23PX;'><span class='fc1-3'>$aYot[8]</span></DIV>";
print "<DIV style='left:547PX;top:2798PX;width:73PX;height:23PX;'><span class='fc1-3'>$aPost[8]</span></DIV>";

print "<BR>";
print "</BODY></HTML>";

//po95 ใบที่4 page4
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
//print ".fc1-0 { COLOR:000000;FONT-SIZE:13PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:NORMAL;}";
//print ".fc1-1 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:BOLD;}";
//print ".fc1-2 { COLOR:000000;FONT-SIZE:11PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:NORMAL;}";
//print ".fc1-3 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:NORMAL;}";
//print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";
//print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-style:dashed;border-top-width:1PX;border-right-width:0PX;}";
//print ".ad1-2 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-style:dashed;border-left-width:1PX;border-top-width:0PX;border-right-width:0PX;}";
//print ".ad1-3 {border-color:000000;border-style:none;border-bottom-style:dashed;border-bottom-width:1PX;border-left-style:dashed;border-left-width:1PX;border-top-style:dashed;border-top-width:1PX;border-right-style:dashed;border-right-width:1PX;}";
print "</STYLE>";
print "<TITLE>จัดซื้อยา (รวมVATก่อน)</TITLE>";
print "</head>";
print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";
print "<DIV style='z-index:0'> &nbsp; </div>";

print "<DIV style='left:170PX;top:3129PX;width:364PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>ใบสั่งซื้อเป็นข้อตกลงแทนการทำสัญญา</span></DIV>";
print "<DIV style='left:688PX;top:3110PX;width:82PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>(ย.37)</span></DIV>";
print "<DIV style='left:688PX;top:3094PX;width:82PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>ทบ.101-048</span></DIV>";
print "<DIV style='left:6PX;top:3175PX;width:266PX;height:26PX;'><span class='fc1-2'> ใบสั่งซื้อที่......................................</span></DIV>";
print "<DIV style='left:60PX;top:3173PX;width:266PX;height:26PX;'><span class='fc1-2'>$cPono$cPonoyear</span></DIV>";

print "<DIV style='left:474PX;top:3199PX;width:31PX;height:26PX;'><span class='fc1-2'>วันที่</span></DIV>";
print "<DIV style='left:504PX;top:3199PX;width:194PX;height:26PX;'><span class='fc1-2'>$cSenddate</span></DIV>";  //แก้ไขวันที่ 21/04/60
print "<DIV style='left:7PX;top:3224PX;width:61PX;height:26PX;'><span class='fc1-2'>ถึง................................................................................................................................</span></DIV>";
print "<DIV style='left:28PX;top:3222PX;width:761PX;height:26PX;'><span class='fc1-2'><B>$cComname</B></span></DIV>";  
print "<DIV style='left:88PX;top:3249PX;width:761PX;height:26PX;'><span class='fc1-2'>กองทัพบกโดย ..................................................................................  ต้องการซื้อ.......................................................................................................................</span></DIV>";   
print "<DIV style='left:170PX;top:3247PX;width:100PX;height:26PX;'><span class='fc1-2'>ร.พ.ค่ายสุรศักดิ์มนตรี</span></DIV>";
print "<DIV style='left:460PX;top:3247PX;width:100PX;height:26PX;'><span class='fc1-2'>ยา/เวชภัณฑ์</span></DIV>";
print "<DIV style='left:7PX;top:3274PX;width:900PX;height:26PX;'><span class='fc1-2'>ตามที่ท่านได้เสนอขายใบเสนอราคาเลขที่..................................................................................................................................ลงวันที่...................................................................</span></DIV>";   

if(( !empty($cBillno) && !empty($cBilldate) ) && ( empty($cBillno2) && empty($cBilldate2) )  && ( empty($cBillno3) && empty($cBilldate3) )){
print "<DIV style='left:210PX;top:3272PX;width:200PX;height:26PX;'><span class='fc1-2'>$cBillno</span></DIV>"; 
print "<DIV style='left:620PX;top:3272PX;width:200PX;height:26PX;'><span class='fc1-2'>$cBilldate</span></DIV>"; 
}else if(( !empty($cBillno) && !empty($cBilldate) ) && ( !empty($cBillno2) && !empty($cBilldate2) )  && ( empty($cBillno3) && empty($cBilldate3) )){
print "<DIV style='left:210PX;top:3272PX;width:200PX;height:26PX;'><span class='fc1-2'>$cBillno2</span></DIV>"; 
print "<DIV style='left:620PX;top:3272PX;width:200PX;height:26PX;'><span class='fc1-2'>$cBilldate2</span></DIV>"; 
}else if(( !empty($cBillno) && !empty($cBilldate) ) && ( !empty($cBillno2) && !empty($cBilldate2) )  && ( !empty($cBillno3) && !empty($cBilldate3) )){
print "<DIV style='left:210PX;top:3272PX;width:200PX;height:26PX;'><span class='fc1-2'>$cBillno3</span></DIV>"; 
print "<DIV style='left:620PX;top:3272PX;width:200PX;height:26PX;'><span class='fc1-2'>$cBilldate3</span></DIV>"; 
}

print "<DIV style='left:7PX;top:3299PX;width:900PX;height:26PX;'><span class='fc1-2'>ขอให้ท่านทราบ และจัดการส่งสิ่งของดังต่อไปนี้ไปยัง...............................................................................................................................................................................................</span></DIV>";   
print "<DIV style='left:260PX;top:3297PX;width:200PX;height:26PX;'><span class='fc1-2'>คลังยาและเวชภัณฑ์</span></DIV>";         

print "<DIV style='left:7PX;top:3324PX;width:900PX;height:26PX;'><span class='fc1-2'>และปฏิบัติตามข้อตกลงระหว่างผู้ซื้อกับผู้ขายแนบท้ายใบสั่งซื้อฉบับนี้</span></DIV>";   

?>
<style type="text/css">
.dx_tb{
	border: 1px dashed #000;
	font-size: 13pt;
}
.dx_tb thead tr th{
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
.dx_detail div{
	position: relative;
	padding-left: 10px;
}
</style>
<div style="position: absolute; left:10px; top: 3349px; font-family: TH SarabunPSK; font-size: 13pt;">
	<table class="dx_tb">
		<thead>
			<tr>
				<th style="width:45px;">ลำดับ</th>
				<th style="width:398px;">รายการ</th>
				<th style="width:61px;">หน่วยนับ</th>
				<th style="width:53px;">จำนวน</th>
				<th style="width:85px;">หน่วยละ<br />
</th>
				<th style="width:85px;" class="last_child">จำนวนเงิน<br />
</th>
			</tr>
		</thead>
		<tbody>
			
			<?php
			$sumtotal=0;
			for ($ii=1; $ii <= 18; $ii++) { 
				 include("connect.inc");
				$sql1="select unitpri,part,freelimit,edpri,edpri_from from druglst where drugcode='$aDrugcode[$ii]'";
				//print $sql;
				$chkquery=mysql_query($sql1);
				list($unitpri,$part,$freelimit,$edpri,$edprifrom)=mysql_fetch_array($chkquery);				
				// ราคากลาง
				//echo "==>".$edpri;
				
				$cost = false;
				$from = '&nbsp;';

				//  ถ้าเป็นอุปกรณ์ เทียบจาก อุปกรเบิกได้ไม่เกิน
				if( $part == 'DPY' OR $part == 'DPN' ){

					// ราคาอุปกรณ์เบิกได้ไม่เกิน
					if( $freelimit > 0 ){
						$cost = $freelimit;
						$from = 3;
					}

				}else{

					// ราคากลาง
					if( $edpri > 0 ){
						$cost = $edpri;
						$from = 3;
					}

				}

				// ถ้าไม่มีราคากลาง หรือ ราคาอุปกรณ์ให้ใช้ราคาทุน
				if( empty($cost) ){
					if( !empty($unitpri) ){
						$cost = $unitpri;
						$from = 5;
					}
				}
				
				$aTotalpackprice=$aAmount[$ii]*$aPackpri[$ii];
				$aTotalprice=$aAmount[$ii]*$aPackpri_vat[$ii];
				?>
				<tr>
					<td align="center"><?=( !empty($aX[$ii]) ? $aX[$ii] : '&nbsp;' );?></td>
					<td><?=( !empty($aTradname[$ii]) ? $aTradname[$ii] : '&nbsp;' );?></td>
					<td><?=( !empty($aPacking[$ii]) ? $aPacking[$ii] : '&nbsp;' );?></td>
					<td align="right"><?=( !empty($aAmount[$ii]) ? $aAmount[$ii] : '&nbsp;' );?></td>
					<td align="right"><?=( !empty($aPackpri[$ii]) ? $aPackpri[$ii] : '&nbsp;' );?></td>
					<td align="right" class="last_child"><?=( !empty($aPrice[$ii]) ? $aPrice[$ii] : '&nbsp;' );?></td>
				</tr>
				<?php
			}
			?>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td style="border-bottom: 1px solid #000;">รวมเงิน</td>
				<td style="border-bottom: 1px solid #000;" align="right" class="last_child"><?=$nNetprice;?></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td style="border-bottom: 1px solid #000;">ภาษี 7.00 %</td>
				<td style="border-bottom: 1px solid #000;" align="right" class="last_child"><?=$nVat;?></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>รวม <?=$nItems;?> รายการ</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td style="border-bottom: 1px solid #000;">รวมสุทธิ</td>
				<td style="border-bottom: 1px solid #000;" align="right" class="last_child"><?=$nPriadvat;?></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td class="last_child">&nbsp;</td>
			</tr>
		</tbody>
	</table>
</div>    
<? 
print "<DIV style='left:71PX;top:3843PX;width:611PX;height:27PX;'><span class='fc1-0'>(ตัวอักษร)&nbsp;&nbsp;$cPriadvat</span></DIV>"; 

print "<DIV style='left:435PX;top:3896PX;width:72PX;height:30PX;'><span class='fc1-0'>$aYot[2]</span></DIV>";
print "<DIV style='left:62PX;top:3923PX;width:71PX;height:22PX;'><span class='fc1-3'>$aYot[2]</span></DIV>";
print "<div style='left:60PX;top:3923PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>.........................................</span></div>";
print "<div style='left:60PX;top:3956PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>.........................................</span></div>";
print "<DIV style='left:182PX;top:3923PX;height:23PX;'><span class='fc1-3'>ผู้ซื้อ ทำการโดยได้รับมอบหมายจากผู้บัญชาการทหารบก</span></DIV>";
print "<DIV style='left:182PX;top:3955PX;width:51PX;height:23PX;'><span class='fc1-3'>ผู้ขาย</span></DIV>";

print "<DIV style='left:416PX;top:3952PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost[2]</span></DIV>";
print "<DIV style='left:416PX;top:3923PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>($aFname[2])</span></DIV>";
print "<DIV style='left:361PX;top:3952PX;width:77PX;height:30PX;'><span class='fc1-0'></span></DIV>";
print "<DIV style='left:416PX;top:3981PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost2[2]</span></DIV>";
print "<BR>";
print "</BODY></HTML>";

//po93 ใบที่5 page5
print "<HTML>";
print "<script>";
 print "ie4up=nav4up=false;";
 print "var agt = navigator.userAgent.toLowerCase();";
 print "var major = parseInt(navigator.appVersion);";
 print "if ((agt.indexOf('msie') != -1) && (major >= 4))";
  print " ie4up = true;";
 print "if ((agt.indexOf('mozilla') != -1)  && (agt.indexOf('spoofer') == -1) && (agt.indexOf('compatible') == -1) && ( major>= 4))";
print "nav4up = true;";
print "</script>";
print "<head>";
print "<STYLE>";
 print "A {text-decoration:none}";
 print "A IMG {border-style:none; border-width:0;}";
 print "DIV {position:absolute; z-index:25;}";
//print ".fc1-0 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:NORMAL;}";
//print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";
print "</STYLE>";
print "<TITLE>จัดซื้อยา (รวมVATก่อน)</TITLE>";
print "</head>";
print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";
print "<DIV style='z-index:0'> &nbsp; </div>";
//////////////////////////
/*print "<DIV style='left:88PX;top:4136PX;width:245PX;height:30PX;'><span class='fc1-0'>ได้ตรวจสอบแล้วดังนี้:-</span></DIV>";
print "<DIV style='left:152PX;top:4165PX;width:492PX;height:30PX;'><span class='fc1-0'>1. เหตุผลในการขออนุมัติ มีความเหมาะสม</span></DIV>";
print "<DIV style='left:152PX;top:4194PX;width:492PX;height:30PX;'><span class='fc1-0'>2. วงเงินอยู่ในอำนาจอนุมัติของ ผอ.รพ.ค่ายสุรศักดิ์มนตรี</span></DIV>";
print "<DIV style='left:152PX;top:4223PX;width:1000PX;height:30PX;'><span class='fc1-0'>3. เห็นควรซื้อโดยวิธีตกลงราคาจาก <B>$cComname</B></span></DIV>";
print "<DIV style='left:152PX;top:4254PX;width:492PX;height:30PX;'><span class='fc1-0'>4. เห็นควรกระทำข้อตกลงโดยใช้ใบสั่งซื้อแทนการทำสัญญา และไม่ควรเรียกหลักประกัน</span></DIV>";
print "<DIV style='left:170PX;top:4281PX;width:492PX;height:30PX;'><span class='fc1-0'>สัญญา และควรกำหนดอัตราปรับเป็นเงิน  -  บาท/วันด้วย</span></DIV>";
print "<DIV style='left:152PX;top:4310PX;width:492PX;height:30PX;'><span class='fc1-0'>5. เห็นควรใช้งบรายรับสถานพยาบาล</span></DIV>";
print "<DIV style='left:152PX;top:4339PX;width:492PX;height:30PX;'><span class='fc1-0'>6. ภายในวงเงิน  <B>$nPriadvat</B>&nbsp;บาท</span></DIV>";
print "<DIV style='left:268PX;top:4378PX;><span class='fc1-0'>
<TABLE class='fc1-0' cellpadding='0' cellspacing='0' border='0' width='240'>
<TR>
	<TD align='right' width='50'>$aYot[3]</TD>
	<TD width='190'>&nbsp;</TD>
</TR>
<TR>
	<TD  align='right' width='50'>(</TD>
	<TD width='190'>$aFname[3])</TD>
</TR>
<TR>
	<TD colspan=\"2\">$aPost[3]</TD>
</TR>
<TR>
	<TD align='right' width='50'></TD>
	<TD width='190'>$cPodate</TD>
</TR>
</TABLE>


</span></DIV>";*/
//print "<DIV style='left:218PX;top:4397PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'></span></DIV>";
//print "<DIV style='left:180PX;top:4426PX;width:500PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost[3] $aPost2[3]</span></DIV>";
//print "<DIV style='left:213PX;top:4455PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$cPodate</span></DIV>";
///////////////
print "<DIV style='left:88PX;top:4136PX;width:245PX;height:30PX;'><span class='fc1-0'>เรียน ผอ.รพ.ค่ายสุรศักดิ์มนตรี</span></DIV>";
if($chkpono=="อ."){
print "<DIV style='left:152PX;top:4165PX;width:520PX;height:30PX;'><span class='fc1-0'>-ได้ตรวจสอบงบอุดหนุนแล้วมีเพียงพอให้การสนับสนุนได้  จำนวนเงิน $nPriadvat บาท  $cPriadvat</span></DIV>";
}else{
print "<DIV style='left:152PX;top:4165PX;width:520PX;height:30PX;'><span class='fc1-0'>-ได้ตรวจสอบงบรายรับสถานพยาบาลแล้วมีเพียงพอให้การสนับสนุนได้  จำนวนเงิน $nPriadvat บาท  $cPriadvat</span></DIV>";
}
// 4552PX;
print "<DIV style='left:208PX;top:4220PX;width:87PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>$aYot[5]</span></DIV>";
print "<DIV style='left:213PX;top:4244PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>($aFname[5])</span></DIV>";
print "<DIV style='left:213PX;top:4263PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost[5]</span></DIV>";
print "<DIV style='left:213PX;top:4282PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost2[5]</span></DIV>";
print "<DIV style='left:213PX;top:4301PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$cPodate</span></DIV>";
/*//print "<DIV style='left:213PX;top:4571PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>($aFname[5])</span></DIV>";
//print "<DIV style='left:213PX;top:4600PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost[5]</span></DIV>";
print "<DIV style='left:213PX;top:4295PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost2[5]</span></DIV>";
print "<DIV style='left:213PX;top:4324PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$cPodate</span></DIV>";*/
/////
//print "<DIV style='left:88PX;top:4330PX;width:245PX;height:30PX;'><span class='fc1-0'>อนุมัติในข้อ 7.</span></DIV>";
print "<DIV style='left:111PX;top:4359PX;width:45PX;height:30PX;'><span class='fc1-0'>-&nbsp;&nbsp;&nbsp;&nbsp;ให้</span></DIV>";
print "<DIV style='left:158PX;top:4359PX;width:17PX;height:30PX;'><span class='fc1-0'>1.</span></DIV>";
print "<DIV style='left:158PX;top:4388PX;width:17PX;height:30PX;'><span class='fc1-0'>2.</span></DIV>";
print "<DIV style='left:158PX;top:4417PX;width:17PX;height:30PX;'><span class='fc1-0'>3.</span></DIV>";

print "<DIV style='left:178PX;top:4359PX;width:354PX;height:30PX;'><span class='fc1-0'>$aYot[6] $aFname[6]</span></DIV>";
print "<DIV style='left:178PX;top:4388PX;width:354PX;height:30PX;'><span class='fc1-0'>$aYot[7] $aFname[7]</span></DIV>";
print "<DIV style='left:178PX;top:4417PX;width:354PX;height:30PX;'><span class='fc1-0'>$aYot[8] $aFname[8]</span></DIV>";

print "<DIV style='left:535PX;top:4359PX;width:150PX;height:30PX;'><span class='fc1-0'>$aPost[6]</span></DIV>";
print "<DIV style='left:535PX;top:4388PX;width:73PX;height:30PX;'><span class='fc1-0'>$aPost[7]</span></DIV>";
print "<DIV style='left:535PX;top:4417PX;width:73PX;height:30PX;'><span class='fc1-0'>$aPost[8]</span></DIV>";

print "<DIV style='left:158PX;top:4446PX;width:226PX;height:30PX;'><span class='fc1-0'>ตรวจรับพัสดุแล้วรายงานผลให้ทราบ</span></DIV>";
print "<DIV style='left:480PX;top:4505PX;width:56PX;height:30PX;'><span class='fc1-0'>$aYot[1]</span></DIV>";
print "<DIV style='left:417PX;top:4534PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>($aFname[1])</span></DIV>";
print "<DIV style='left:417PX;top:4563PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost[1]</span></DIV>";

//print "<DIV style='left:417PX;top:4592PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$cPodate</span></DIV>";  //เดิม
print "<DIV style='left:417PX;top:4592PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$cChkindate</span></DIV>";  //แก้ไขวันที่ 16/02/60

print "<DIV style='left:180PX;top:4535PX;width:55PX;height:30PX;'><span class='fc1-0'>ทราบ</span></DIV>";
print "<DIV style='left:180PX;top:4564PX;width:17PX;height:30PX;'><span class='fc1-0'>1.</span></DIV>";
print "<DIV style='left:180PX;top:4593PX;width:17PX;height:30PX;'><span class='fc1-0'>2.</span></DIV>";
print "<DIV style='left:180PX;top:4622PX;width:17PX;height:30PX;'><span class='fc1-0'>3.</span></DIV>";

print "<DIV style='left:199PX;top:4564PX;width:84PX;height:30PX;'><span class='fc1-0'>$aYot[6]</span></DIV>";
print "<DIV style='left:199PX;top:4593PX;width:84PX;height:30PX;'><span class='fc1-0'>$aYot[7]</span></DIV>"; //
print "<DIV style='left:199PX;top:4622PX;width:84PX;height:30PX;'><span class='fc1-0'>$aYot[8]</span></DIV>";// 

//print "<DIV style='left:218PX;top:4651PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$cPodate</span></DIV>";  //เดิม
print "<DIV style='left:218PX;top:4651PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$cChkindate</span></DIV>";  //แก้ไขวันที่ 16/02/60

print "<BR>";
print "</BODY></HTML>";

//po91 ใบที่6 page6

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
print "</STYLE>";
print "<TITLE>จัดซื้อยา (รวมVATก่อน)</TITLE>";
print "</head>";
print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";
print "<DIV style='z-index:0'> &nbsp; </div>";

print "<DIV style='left:305PX;top:5150PX;width:155PX;height:34PX;TEXT-ALIGN:CENTER;'><span class='fc1-1'>บันทึกข้อความ</span></DIV>";
print "<DIV style='z-index:15;left:54PX;top:5128PX;width:73PX;height:80PX;'>";
print "<img  WIDTH=73 HEIGHT=80 SRC='bird.jpg'>";
print "</DIV>";
print "<DIV style='left:54PX;top:5207PX;width:697PX;height:30PX;'><span class='fc1-5'>ส่วนราชการ</span><span class='fc1-0'>&nbsp;&nbsp;กองเภสัชกรรม&nbsp;&nbsp;&nbsp;&nbsp;รพ.ค่ายสุรศักดิ์มนตรี</span></DIV>";

print "<DIV style='left:54PX;top:5236PX;width:333PX;height:30PX;'><span class='fc1-5'>ที่ </span><span class='fc1-0'>กห  0483.63.4/$cPono$cPonoyear</span></DIV>";

print "<DIV style='left:378PX;top:5236PX;width:257PX;height:30PX;'><span class='fc1-5'>วันที่</span></DIV>";
print "<DIV style='left:410PX;top:5236PX;width:257PX;height:30PX;'><span class='fc1-0'>$cBounddate</span></DIV>";

//print "<DIV style='left:404PX;top:5236PX;width:257PX;height:30PX;'><span class='fc1-0'>$cBounddate</span></DIV>";
print "<DIV style='left:54PX;top:5267PX;width:36PX;height:30PX;'><span class='fc1-5'>เรื่อง</span></DIV>";
print "<DIV style='left:54PX;top:5296PX;width:36PX;height:30PX;'><span class='fc1-5'>เรียน</span></DIV>";
print "<DIV style='left:104PX;top:5266PX;width:283PX;height:30PX;'><span class='fc1-0'>รายงานผลการตรวจรับพัสดุ</span></DIV>";
print "<DIV style='left:104PX;top:5295PX;width:283PX;height:30PX;'><span class='fc1-0'>$aPost[1]</span></DIV>";
print "<DIV style='left:105PX;top:5354PX;width:643PX;height:30PX;'><span class='fc1-0'>เรื่อง ขออนุมัติ จัดหายา</span></DIV>";
print "<DIV style='left:105PX;top:5383PX;width:103PX;height:30PX;'><span class='fc1-0'>ตามคำสั่งให้</span></DIV>";
print "<DIV style='left:207PX;top:5818PX;width:95PX;height:30PX;'><span class='fc1-0'>พ.อ.หญิง</span></DIV>";
print "<DIV style='left:80PX;top:5847PX;width:523PX;height:30PX;'><span class='fc1-0'>ได้รับของตามเรื่องนี้ไว้ถูกต้องทุกรายการและนำขึ้นบัญชีคุมไว้เรียบร้อยแล้ว</span></DIV>";
print "<DIV style='left:54PX;top:5499PX;width:47PX;height:30PX;'><span class='fc1-0'>โดยมี</span></DIV>";
print "<DIV style='left:54PX;top:5470PX;width:412PX;height:30PX;'><span class='fc1-0'>ได้ตรวจรับพัสดุ ณ รพ.ค่ายสุรศักดิ์มนตรี</span></DIV>";
print "<DIV style='left:149PX;top:5528PX;width:292PX;height:30PX;'><span class='fc1-0'>1. ชนิด,ขนาด,คุณลักษณะ&nbsp;&nbsp;ถูกต้อง</span></DIV>";
print"<DIV style='left:183PX;top:5644PX;width:97PX;height:30PX;'><span class='fc1-0'>4.1 ส่งของเมื่อ</span></DIV>";

print "<DIV style='left:279PX;top:5644PX;width:167PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'><B>$cBounddate</B></span></DIV>";

print "<DIV style='left:149PX;top:5586PX;width:292PX;height:30PX;'><span class='fc1-0'>3. คุณภาพ ดี</span></DIV>";
print "<DIV style='left:149PX;top:5615PX;width:292PX;height:30PX;'><span class='fc1-0'>4. การปรับ -</span></DIV>";
print "<DIV style='left:149PX;top:5557PX;width:65PX;height:30PX;'><span class='fc1-0'>2. จำนวน</span></DIV>";
print "<DIV style='left:216PX;top:5557PX;width:57PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$nItems</span></DIV>";
print "<DIV style='left:275PX;top:5557PX;width:55PX;height:30PX;'><span class='fc1-0'>รายการ</span></DIV>";

print "<DIV style='left:450PX;top:5876PX;width:42PX;height:30PX;'><span class='fc1-0'>
<TABLE class='fc1-0' cellpadding='0' cellspacing='0' border='0' width='340'>
<TR>
	<TD align='right' width='50'>$aYot[4]</TD>
	<TD width='290'>&nbsp;</TD>
</TR>
<TR>
	<TD  align='right' width='50'>(</TD>
	<TD width='290'>$aFname[4])</TD>
</TR>
<TR>
	<TD colspan=\"2\" width='270' align='center'>$aPost[4] $aPost2[4]</TD>
</TR>
</TABLE>
</span></DIV>";
//print "<DIV style='left:410PX;top:5905PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>p2(</span></DIV>";
//print "<DIV style='left:430PX;top:5934PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>p3$aPost[4] $aPost2[4]</span></DIV>";

print "<DIV style='left:84PX;top:5934PX;width:87PX;height:30PX;'><span class='fc1-0'>
<TABLE class='fc1-0' cellpadding='0' cellspacing='0' border='0' width='240'>
<TR>
	<TD align='right' width='50'>$aYot[1]</TD>
	<TD width='190'>&nbsp;</TD>
</TR>
<TR>
	<TD  align='right' width='50'>(</TD>
	<TD width='190'>$aFname[1])</TD>
</TR
<TR>
	<TD colspan=\"2\" width='180' align='center'>ผอ.รพ.ค่ายสุรศักดิ์มนตรี</TD>
</TR>
<TR>
	<TD colspan=\"2\" width='180' align='center'>$cBounddate</TD>
</TR>
</TABLE>
</span></DIV>";
//print "<DIV style='left:49PX;top:5963PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'></span></DIV>";
//print "<DIV style='left:49PX;top:5992PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>pp3</span></DIV>";
//print "<DIV style='left:49PX;top:6021PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>pp4$cBounddate</span></DIV>";

print "<DIV style='left:54PX;top:5900PX;width:55PX;height:30PX;'><span class='fc1-0'>ทราบ</span></DIV>";
print "<DIV style='left:54PX;top:5325PX;width:49PX;height:30PX;'><span class='fc1-5'>อ้างถึง</span></DIV>";
print "<DIV style='left:105PX;top:5325PX;width:674PX;height:30PX;'><span class='fc1-0'>คำสั่ง ผอ.รพ.ค่ายฯ ท้ายหนังสือ กองเภสัชกรรม รพ.ค่ายฯ ที่ กห
0483.63.4/$cPono$cPonoyear ลงวันที่ $cPodate</span></DIV>";
print "<DIV style='left:231PX;top:5383PX;width:354PX;height:30PX;'><span class='fc1-0'>$aYot[6] $aFname[6]</span></DIV>";
print "<DIV style='left:231PX;top:5412PX;width:354PX;height:30PX;'><span class='fc1-0'>$aYot[7] $aFname[7]</span></DIV>";
print "<DIV style='left: 231PX; top:5441PX; width: 354; height: 30'><span class='fc1-0'>$aYot[8] $aFname[8]</span></DIV>";
print "<DIV style='left:593PX;top:5412PX;width:155PX;height:30PX;'><span class='fc1-0'>$cBe$aPost[7]</span></DIV>";
print "<DIV style='left:593PX;top:5441PX;width:155PX;height:30PX;'><span class='fc1-0'>$cBe$aPost[8]</span></DIV>";
print "<DIV style='left:211PX;top:5383PX;width:17PX;height:30PX;'><span class='fc1-0'>1.</span></DIV>";
print "<DIV style='left:211PX;top:5412PX;width:17PX;height:30PX;'><span class='fc1-0'>2.</span></DIV>";
print "<DIV style='left:211PX;top:5441PX;width:17PX;height:30PX;'><span class='fc1-0'>3.</span></DIV>";
print "<DIV style='left:104PX;top:5499PX;width:199PX;height:30PX;'><span class='fc1-0'>$aYot[2] $aFname[2]</span></DIV>";
print "<DIV style='left:312PX;top:5499PX;width:273PX;height:30PX;'><span class='fc1-0'>เป็นผู้นำชี้ และขอรายงานผลให้ทราบดังนี้</span></DIV>";
print "<DIV style='left:393PX;top:5876PX;width:55PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>&nbsp;</span></DIV>";
print "<DIV style='left:151PX;top:5818PX;width:55PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>&nbsp;</span></DIV>";
print "<DIV style='left:149PX;top:5673PX;width:593PX;height:30PX;'><span class='fc1-0'>คณะกรรมการพิจารณาแล้ว เห็นควรรับพัสดุ ไว้ใช้ในราชการต่อไป และได้มอบพัสดุตามรายการ ให้แก่</span></DIV>";
print "<DIV style='left:445PX;top:5644PX;width:104PX;height:30PX;'><span class='fc1-0'>ทันเวลากำหนด</span></DIV>";
print "<DIV style='left:223PX;top:5702PX;width:308PX;height:30PX;'><span class='fc1-0'>เจ้าหน้าที่เก็บรักษา/รับไปใช้ในราชการต่อไปแล้วเมื่อ</span></DIV>";

print "<DIV style='left:530PX;top:5702PX;width:167PX;height:30PX;'><span class='fc1-0'>$cBounddate</span></DIV>";
print "<DIV style='left:575PX;top:5818PX;width:73PX;height:30PX;'><span class='fc1-0'>ผู้นำชี้</span></DIV>";
print "<DIV style='left:151PX;top:5731PX;width:55PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>&nbsp;</span></DIV>";
print "<DIV style='left:575PX;top:5789PX;width:73PX;height:30PX;'><span class='fc1-0'>$aPost[7]</span></DIV>";
print "<DIV style='left:575PX;top:5760PX;width:73PX;height:30PX;'><span class='fc1-0'>$aPost[8]</span></DIV>";
print "<DIV style='left:151PX;top:5789PX;width:55PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>&nbsp;</span></DIV>";
print "<DIV style='left:151PX;top:5760PX;width:55PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>&nbsp;</span></DIV>";
print "<DIV style='left:54PX;top:5702PX;width:170PX;height:30PX;'><span class='fc1-0'>$aYot[4] $aFname[4]</span></DIV>";

print "<DIV style='left:593PX;top:5383PX;width:200PX;height:30PX;'><span class='fc1-0'>เป็น$aPost[6]</span></DIV>";
print "<DIV style='left:207PX;top:5731PX;width:95PX;height:30PX;'><span class='fc1-0'>$aYot[6]</span></DIV>";
print "<DIV style='left:207PX;top:5789PX;width:95PX;height:30PX;'><span class='fc1-0'>$aYot[8]</span></DIV>";
print "<DIV style='left:207PX;top:5760PX;width:95PX;height:30PX;'><span class='fc1-0'>$aYot[7]</span></DIV>";
print "<DIV style='left:575PX;top:5731PX;width:155PX;height:30PX;'><span class='fc1-0'>$aPost[6]</span></DIV>";


print "<BR>";
print "</BODY></HTML>";

//po99 ใบที่7 page7

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
//print ".fc1-0 { COLOR:000000;FONT-SIZE:13PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:NORMAL;}";
//print ".fc1-1 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:BOLD;}";
//print ".fc1-2 { COLOR:000000;FONT-SIZE:11PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:NORMAL;}";
//print ".fc1-3 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:NORMAL;}";
//print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";
//print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-style:dashed;border-top-width:1PX;border-right-width:0PX;}";
//print ".ad1-2 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-style:dashed;border-left-width:1PX;border-top-width:0PX;border-right-width:0PX;}";
//print ".ad1-3 {border-color:000000;border-style:none;border-bottom-style:dashed;border-bottom-width:1PX;border-left-style:dashed;border-left-width:1PX;border-top-style:dashed;border-top-width:1PX;border-right-style:dashed;border-right-width:1PX;}";
print "</STYLE>";

print "<TITLE>จัดซื้อยา (รวมVATก่อน)</TITLE>";
print "</head>";

print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";

print "<DIV style='z-index:0'> &nbsp; </div>";

print "<div style='left:8PX;top:6340PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:743PX;'>";
print "</div>";
print "<div style='left:44PX;top:6185PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:588PX;'>";
print "<table width='0px' height='582PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:469PX;top:6154PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:619PX;'>";
print "<table width='0px' height='613PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:417PX;top:6237PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:536PX;'>";
print "<table width='0px' height='530PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:523PX;top:6292PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:481PX;'>";
print "<table width='0px' height='475PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:693PX;top:6292PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:480PX;'>";
print "<table width='0px' height='474PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:602PX;top:6291PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:481PX;'>";
print "<table width='0px' height='475PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:8PX;top:6291PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:743PX;'>";
print "</div>";
print "<div style='left:300PX;top:6265PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:450PX;'>";
print "</div>";
print "<div style='left:8PX;top:6237PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:743PX;'>";
print "</div>";
print "<div style='left:8PX;top:6185PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:743PX;'>";
print "</div>";
print "<div style='left:114PX;top:6292PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:480PX;'>";
print "<table width='0px' height='474PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:356PX;top:6237PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:536PX;'>";
print "<table width='0px' height='530PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:300PX;top:6185PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:587PX;'><table width='0px' height='581PX'><td>&nbsp;</td></table></div>";
print "<div style='left:300PX;top:6210PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:450PX;'></div>";
print "<div style='left:8PX;top:6720PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:743PX;'></div>";
print "<div style='left:8PX;top:6801PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:743PX;'></div>";
print "<div style='left:8PX;top:6925PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:743PX;'></div>";
print "<div style='left:8PX;top:7015PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:743PX;'></div>";



print "<DIV class='box' style='z-index:10; border-color:000000;border-style:dashed;border-bottom-style:dashed;border-bottom-width:1PX;border-left-style:dashed;border-left-width:1PX;border-top-style:dashed;border-top-width:1PX;border-right-style:dashed;border-right-width:1PX;left:7PX;top:6160PX;width:743PX;height:619PX;'>
<table border=0 cellpadding=0 cellspacing=0 width=736px height=612px><TD>&nbsp;</TD></TABLE></DIV>";  //กรอบสี่เหลี่ยม

print "<DIV style='left:332PX;top:6190PX;width:96PX;height:26PX;'><span class='fc1-0'>$cPono$cPonoyear</span></DIV>";
print "<DIV style='left:54PX;top:6160PX;width:163PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>ใบเบิก</span></DIV>";
print "<DIV style='left:9PX;top:6189PX;width:34PX;height:26PX;'><span class='fc1-2'>จาก</span></DIV>";
print "<DIV style='left:306PX;top:6187PX;width:24PX;height:26PX;'><span class='fc1-2'>ที่</span></DIV>";
print "<DIV style='left:7PX;top:6303PX;width:38PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>ลำดับ</span></DIV>";
print "<DIV style='left:120PX;top:6303PX;width:159PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>รายการ</span></DIV>";
print "<DIV style='left:523PX;top:6293PX;width:80PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>ราคาหน่วยละ</span></DIV>";
print "<DIV style='left:606PX;top:6293PX;width:85PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>ราคารวม</span></DIV>";
print "<DIV style='left:616PX;top:6316PX;width:64PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>ไม่รวม VAT</span></DIV>";
print "<DIV style='left:531PX;top:6316PX;width:64PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>ไม่รวม VAT</span></DIV>";
print "<DIV style='left:667PX;top:6155PX;width:82PX;height:23PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>ทบ.๔๐๐-๐๐๖</span></DIV>";
print "<DIV style='left:486PX;top:6163PX;width:262PX;height:26PX;'><span class='fc1-0'>แผ่นที่&nbsp;&nbsp;&nbsp;1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ในจำนวน&nbsp;&nbsp;&nbsp;1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;แผ่น</span></DIV>";
print "<DIV style='left:9PX;top:6240PX;width:34PX;height:26PX;'><span class='fc1-2'>ถึง</span></DIV>";
print "<DIV style='left:48PX;top:6189PX;width:246PX;height:26PX;'><span class='fc1-2'>หน่วยจ่าย แผนกส่งกำลัง รพ. ค่ายฯ</span></DIV>";
print "<DIV style='left:48PX;top:6240PX;width:246PX;height:26PX;'><span class='fc1-2'>หน่วยเบิก กองเภสัชกรรม รพ. ค่ายฯ</span></DIV>";
print "<DIV style='left:47PX;top:6265PX;width:246PX;height:26PX;'><span class='fc1-2'>เบิกให้</span></DIV>";
print "<DIV style='left:305PX;top:6213PX;width:108PX;height:26PX;'><span class='fc1-2'>เบิกในกรณี</span></DIV>";
print "<DIV style='left:476PX;top:6187PX;width:145PX;height:26PX;'><span class='fc1-2'>สายบริการเทคนิคที่ควมคุม</span></DIV>";
print "<DIV style='left:476PX;top:6213PX;width:145PX;height:26PX;'><span class='fc1-2'>ประเภทสิ่งอุปกรณ์</span></DIV>";
print "<DIV style='left:305PX;top:6240PX;width:51PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>ชั้นต้น</span></DIV>";
print "<DIV style='left:361PX;top:6240PX;width:51PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>ทดแทน</span></DIV>";
print "<DIV style='left:419PX;top:6240PX;width:51PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>ยืม</span></DIV>";
print "<DIV style='left:476PX;top:6240PX;width:119PX;height:26PX;'><span class='fc1-2'>ประเภทการเงิน</span></DIV>";
print "<DIV style='left:476PX;top:6265PX;width:119PX;height:26PX;'><span class='fc1-2'>เลขงานที่</span></DIV>";
print "<DIV

style='left:46PX;top:6294PX;width:65PX;height:24PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>หมายเลข</span></DIV>";
print "<DIV style='left:46PX;top:6315PX;width:65PX;height:24PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>สิ่งอุปกรณ์</span></DIV>";
print "<DIV style='left:695PX;top:6303PX;width:53PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>จ่ายจริง</span></DIV>";
print "<DIV style='left:474PX;top:6315PX;width:52PX;height:24PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>เบิก</span></DIV>";
print "<DIV style='left:474PX;top:6294PX;width:52PX;height:24PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>จำนวน</span></DIV>";
print "<DIV style='left:415PX;top:6303PX;width:57PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>หน่วยนับ</span></DIV>";
print "<DIV style='left:363PX;top:6306PX;width:52PX;height:24PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>ค้างรับ</span></DIV>";
print "<DIV style='left:363PX;top:6290PX;width:52PX;height:24PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>คงคลัง</span></DIV>";
print "<DIV style='left:363PX;top:6322PX;width:52PX;height:24PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>ค้างจ่าย</span></DIV>";
print "<DIV style='left:303PX;top:6315PX;width:52PX;height:24PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>อนุมัติ</span></DIV>";
print "<DIV style='left:303PX;top:6294PX;width:52PX;height:24PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>จำนวน</span></DIV>";
if($chkpono=="อ."){
print "<DIV style='left:586PX;top:6240PX;width:135PX;height:27PX;'><span class='fc1-5'>งบอุดหนุน</span></DIV>";
}else{
print "<DIV style='left:586PX;top:6240PX;width:135PX;height:27PX;'><span class='fc1-5'>รายรับสถานพยาบาล</span></DIV>";
}
print "<DIV style='left:617PX;top:6214PX;width:115PX;height:27PX;'><span class='fc1-5'>4</span></DIV>";
print "<DIV style='left:638PX;top:6186PX;width:115PX;height:27PX;'><span class='fc1-5'>พ</span></DIV>";

///Line1
print "<DIV style='left:529PX;top:6349PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[1]</span></DIV>";
print "<DIV style='left:410PX;top:6349PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[1]</span></DIV>";
print"<DIV style='left:11PX;top:6349PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[1]</span></DIV>";
print"<DIV style='left:120PX;top:6349PX;width:159PX;height:22PX;'><span class='fc1-3'>$aTradname[1]</span></DIV>";
print"<DIV style='left:290PX;top:6349PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[1]</span></DIV>";
print"<DIV style='left:607PX;top:6349PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[1]</span></DIV>";
print "<DIV style='left:47PX;top:6349PX;width:66PX;height:22PX;'><span class='fc1-3'>$aDrugcode[1]</span></DIV>";
print"<DIV style='left:683PX;top:6349PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[1]</span></DIV>";
print"<DIV style='left:456PX;top:6349PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[1]</span></DIV>";
///Line2
print "<DIV style='left:529PX;top:6379PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[2]</span></DIV>";
print "<DIV style='left:410PX;top:6379PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[2]</span></DIV>";
print"<DIV style='left:11PX;top:6379PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[2]</span></DIV>";
print"<DIV style='left:120PX;top:6379PX;width:159PX;height:22PX;'><span class='fc1-3'>$aTradname[2]</span></DIV>";
print"<DIV style='left:290PX;top:6379PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[2]</span></DIV>";
print"<DIV style='left:607PX;top:6379PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[2]</span></DIV>";
print "<DIV style='left:47PX;top:6379PX;width:66PX;height:22PX;'><span class='fc1-3'>$aDrugcode[2]</span></DIV>";
print"<DIV style='left:683PX;top:6379PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[2]</span></DIV>";
print"<DIV style='left:456PX;top:6379PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[2]</span></DIV>";

///Line3
print "<DIV style='left:529PX;top:6409PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[3]</span></DIV>";
print "<DIV style='left:410PX;top:6409PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[3]</span></DIV>";
print"<DIV style='left:11PX;top:6409PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[3]</span></DIV>";
print"<DIV style='left:120PX;top:6409PX;width:159PX;height:22PX;'><span class='fc1-3'>$aTradname[3]</span></DIV>";
print"<DIV style='left:290PX;top:6409PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[3]</span></DIV>";
print"<DIV style='left:607PX;top:6409PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[3]</span></DIV>";
print "<DIV style='left:47PX;top:6409PX;width:66PX;height:22PX;'><span class='fc1-3'>$aDrugcode[3]</span></DIV>";
print"<DIV style='left:683PX;top:6409PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[3]</span></DIV>";
print"<DIV style='left:456PX;top:6409PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[3]</span></DIV>";

///Line4
print "<DIV style='left:529PX;top:6439PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[4]</span></DIV>";
print "<DIV style='left:410PX;top:6439PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[4]</span></DIV>";
print"<DIV style='left:11PX;top:6439PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[4]</span></DIV>";
print"<DIV style='left:120PX;top:6439PX;width:159PX;height:22PX;'><span class='fc1-3'>$aTradname[4]</span></DIV>";
print"<DIV style='left:290PX;top:6439PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[4]</span></DIV>";
print"<DIV style='left:607PX;top:6439PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[4]</span></DIV>";
print "<DIV style='left:47PX;top:6439PX;width:66PX;height:22PX;'><span class='fc1-3'>$aDrugcode[4]</span></DIV>";
print"<DIV style='left:683PX;top:6439PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[4]</span></DIV>";
print"<DIV style='left:456PX;top:6439PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[4]</span></DIV>";

///Line5
print "<DIV style='left:529PX;top:6469PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[5]</span></DIV>";
print "<DIV style='left:410PX;top:6469PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[5]</span></DIV>";
print"<DIV style='left:11PX;top:6469PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[5]</span></DIV>";
print"<DIV style='left:120PX;top:6469PX;width:159PX;height:22PX;'><span class='fc1-3'>$aTradname[5]</span></DIV>";
print"<DIV style='left:290PX;top:6469PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[5]</span></DIV>";
print"<DIV style='left:607PX;top:6469PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[5]</span></DIV>";
print "<DIV style='left:47PX;top:6469PX;width:66PX;height:22PX;'><span class='fc1-3'>$aDrugcode[5]</span></DIV>";
print"<DIV style='left:683PX;top:6469PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[5]</span></DIV>";
print"<DIV style='left:456PX;top:6469PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[5]</span></DIV>";

///Line6
print "<DIV style='left:529PX;top:6499PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[6]</span></DIV>";
print "<DIV style='left:410PX;top:6499PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[6]</span></DIV>";
print"<DIV style='left:11PX;top:6499PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[6]</span></DIV>";
print"<DIV style='left:120PX;top:6499PX;width:159PX;height:22PX;'><span class='fc1-3'>$aTradname[6]</span></DIV>";
print"<DIV style='left:290PX;top:6499PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[6]</span></DIV>";
print"<DIV style='left:607PX;top:6499PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[6]</span></DIV>";
print "<DIV style='left:47PX;top:6499PX;width:66PX;height:22PX;'><span class='fc1-3'>$aDrugcode[6]</span></DIV>";
print"<DIV style='left:683PX;top:6499PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[6]</span></DIV>";
print"<DIV style='left:456PX;top:6499PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[6]</span></DIV>";

///Line7
print "<DIV style='left:529PX;top:6529PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[7]</span></DIV>";
print "<DIV style='left:410PX;top:6529PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[7]</span></DIV>";
print"<DIV style='left:11PX;top:6529PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[7]</span></DIV>";
print"<DIV style='left:120PX;top:6529PX;width:159PX;height:22PX;'><span class='fc1-3'>$aTradname[7]</span></DIV>";
print"<DIV style='left:290PX;top:6529PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[7]</span></DIV>";
print"<DIV style='left:607PX;top:6529PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[7]</span></DIV>";
print "<DIV style='left:47PX;top:6529PX;width:66PX;height:22PX;'><span class='fc1-3'>$aDrugcode[7]</span></DIV>";
print"<DIV style='left:683PX;top:6529PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[7]</span></DIV>";
print"<DIV style='left:456PX;top:6529PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[7]</span></DIV>";

///Line8
print "<DIV style='left:529PX;top:6559PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[8]</span></DIV>";
print "<DIV style='left:410PX;top:6559PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[8]</span></DIV>";
print"<DIV style='left:11PX;top:6559PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[8]</span></DIV>";
print"<DIV style='left:120PX;top:6559PX;width:159PX;height:22PX;'><span class='fc1-3'>$aTradname[8]</span></DIV>";
print"<DIV style='left:290PX;top:6559PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[8]</span></DIV>";
print"<DIV style='left:607PX;top:6559PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[8]</span></DIV>";
print "<DIV style='left:47PX;top:6559PX;width:66PX;height:22PX;'><span class='fc1-3'>$aDrugcode[8]</span></DIV>";
print"<DIV style='left:683PX;top:6559PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[8]</span></DIV>";
print"<DIV style='left:456PX;top:6559PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[8]</span></DIV>";

///Line9
print "<DIV style='left:529PX;top:6589PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[9]</span></DIV>";
print "<DIV style='left:410PX;top:6589PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[9]</span></DIV>";
print"<DIV style='left:11PX;top:6589PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[9]</span></DIV>";
print"<DIV style='left:120PX;top:6589PX;width:159PX;height:22PX;'><span class='fc1-3'>$aTradname[9]</span></DIV>";
print"<DIV style='left:290PX;top:6589PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[9]</span></DIV>";
print"<DIV style='left:607PX;top:6589PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[9]</span></DIV>";
print "<DIV style='left:47PX;top:6589PX;width:66PX;height:22PX;'><span class='fc1-3'>$aDrugcode[9]</span></DIV>";
print"<DIV style='left:683PX;top:6589PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[9]</span></DIV>";
print"<DIV style='left:456PX;top:6589PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[9]</span></DIV>";

///Line10
print "<DIV style='left:529PX;top:6619PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[10]</span></DIV>";
print "<DIV style='left:410PX;top:6619PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[10]</span></DIV>";
print"<DIV style='left:11PX;top:6619PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[10]</span></DIV>";
print"<DIV style='left:120PX;top:6619PX;width:159PX;height:22PX;'><span class='fc1-3'>$aTradname[10]</span></DIV>";
print"<DIV style='left:290PX;top:6619PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[10]</span></DIV>";
print"<DIV style='left:607PX;top:6619PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[10]</span></DIV>";
print "<DIV style='left:47PX;top:6619PX;width:66PX;height:22PX;'><span class='fc1-3'>$aDrugcode[10]</span></DIV>";
print"<DIV style='left:683PX;top:6619PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[10]</span></DIV>";
print"<DIV style='left:456PX;top:6619PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[10]</span></DIV>";

///Line11
print "<DIV style='left:529PX;top:6649PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[11]</span></DIV>";
print "<DIV style='left:410PX;top:6649PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[11]</span></DIV>";
print"<DIV style='left:11PX;top:6649PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[11]</span></DIV>";
print"<DIV style='left:120PX;top:6649PX;width:159PX;height:22PX;'><span class='fc1-3'>$aTradname[11]</span></DIV>";
print"<DIV style='left:290PX;top:6649PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[11]</span></DIV>";
print"<DIV style='left:607PX;top:6649PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[11]</span></DIV>";
print "<DIV style='left:47PX;top:6649PX;width:66PX;height:22PX;'><span class='fc1-3'>$aDrugcode[11]</span></DIV>";
print"<DIV style='left:683PX;top:6649PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[11]</span></DIV>";
print"<DIV style='left:456PX;top:6649PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[11]</span></DIV>";

///Line12
print "<DIV style='left:529PX;top:6679PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[12]</span></DIV>";
print "<DIV style='left:410PX;top:6679PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[12]</span></DIV>";
print"<DIV style='left:11PX;top:6679PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[12]</span></DIV>";
print"<DIV style='left:120PX;top:6679PX;width:159PX;height:22PX;'><span class='fc1-3'>$aTradname[12]</span></DIV>";
print"<DIV style='left:290PX;top:6679PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[12]</span></DIV>";
print"<DIV style='left:607PX;top:6679PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[12]</span></DIV>";
print "<DIV style='left:47PX;top:6679PX;width:66PX;height:22PX;'><span class='fc1-3'>$aDrugcode[12]</span></DIV>";
print"<DIV style='left:683PX;top:6679PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[12]</span></DIV>";
print"<DIV style='left:456PX;top:6679PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[12]</span></DIV>";

///Line13
print "<DIV style='left:529PX;top:6709PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPackpri[13]</span></DIV>";
print "<DIV style='left:410PX;top:6709PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aPacking[13]</span></DIV>";
print"<DIV style='left:11PX;top:6709PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>$aX[13]</span></DIV>";
print"<DIV style='left:120PX;top:6709PX;width:159PX;height:22PX;'><span class='fc1-3'>$aTradname[13]</span></DIV>";
print"<DIV style='left:290PX;top:6709PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[13]</span></DIV>";
print"<DIV style='left:607PX;top:6709PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aPrice[13]</span></DIV>";
print "<DIV style='left:47PX;top:6709PX;width:66PX;height:22PX;'><span class='fc1-3'>$aDrugcode[13]</span></DIV>";
print"<DIV style='left:683PX;top:6709PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[13]</span></DIV>";
print"<DIV style='left:456PX;top:6709PX;width:53PX;height:22PX;TEXT-ALIGN:RIGHT;'><span class='fc1-3'>$aAmount[13]</span></DIV>";


////
print "<DIV style='left:426PX;top:6894PX;width:197PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>(ลงนาม) ผู้เบิก</span></DIV>";
print "<DIV style='left:516PX;top:6692PX;width:86PX;height:26PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>ภาษี 7.00 %</span></DIV>";
print "<DIV style='left:516PX;top:6725PX;width:86PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>รวมสุทธิ</span></DIV>";
print "<DIV style='left:516PX;top:6664PX;width:86PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>รวมเงิน</span></DIV>";
print "<DIV style='left:615PX;top:6665PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$nNetprice</span></DIV>";
print "<DIV style='left:615PX;top:6692PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'>$nVat</span></DIV>";
print "<DIV style='left:615PX;top:6725PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'><span class='fc1-2'><B>$nPriadvat</B></span></DIV>";
print "<DIV style='left:485PX;top:7049PX;width:168PX;height:30PX;'><span class='fc1-0'>ทะเบียนหน่วยจ่าย</span></DIV>";
print "<DIV style='left:36PX;top:6777PX;width:141PX;height:30PX;'><span class='fc1-0'>หลักฐานที่ใช้ในการเบิก</span></DIV>";
if($chkpono=="อ."){
print "<DIV style='left:36PX;top:6809PX;width:312PX;height:30PX;'><span class='fc1-0'>ตรวจสอบแล้วเห็นว่า........เป็นสป.จัดหาจากงบอุดหนุน</span></DIV>";
}else{
print "<DIV style='left:36PX;top:6809PX;width:312PX;height:30PX;'><span class='fc1-0'>ตรวจสอบแล้วเห็นว่า........เป็นสป.จัดหาจากงบรายรับ</span></DIV>";
}
print "<DIV style='left:355PX;top:6808PX;width:393PX;height:30PX;'><span class='fc1-0'>ขอเบิกสิ่งอุปกรณ์ตามที่ระบุไว้ในช่อง 'จำนวนเบิก' </span></DIV>";

print "<DIV style='left:651PX;top:6839PX;width:97PX;height:30PX;'><span class='fc1-0'>&nbsp;</span></DIV>";
print "<DIV style='left:354PX;top:6866PX;width:72PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>พ.อ. หญิง</span></DIV>";
print "<DIV style='left:423PX;top:6873PX;width:203PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>...............................................................</span></DIV>";
print "<DIV style='left:632PX;top:6868PX;width:116PX;height:26PX;'><span class='fc1-2'>$cBounddate</span></DIV>";
print "<DIV style='left:9PX;top:6838PX;width:312PX;height:30PX;'><span class='fc1-0'>เห็นควรพิจารณาอนุมัติ</span></DIV>";
print "<DIV style='left:215PX;top:6869PX;width:116PX;height:26PX;'><span class='fc1-2'>$cBounddate</span></DIV>";
print "<DIV style='left:632PX;top:6894PX;width:104PX;height:30PX;'><span class='fc1-0'>วัน เดือน ปี</span></DIV>";
print "<DIV style='left:215PX;top:6894PX;width:104PX;height:30PX;'><span class='fc1-0'>วัน เดือน ปี</span></DIV>";
print "<DIV style='left:61PX;top:6894PX;width:147PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>(ลงนาม) ผู้ตรวจสอบ</span></DIV>";
print "<DIV style='left:10PX;top:6928PX;width:322PX;height:30PX;'><span class='fc1-2'>อนุมัติให้จ่ายได้เฉพาะในรายการและจำนวนที่ผู้ตรวจสอบเสนอ</span></DIV>";
print "<DIV style='left:216PX;top:6959PX;width:116PX;height:26PX;'><span class='fc1-2'>$cBounddate</span></DIV>";
print "<DIV style='left:216PX;top:6984PX;width:104PX;height:30PX;'><span class='fc1-0'>วัน เดือน ปี</span></DIV>";
print "<DIV style='left:62PX;top:6984PX;width:147PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>(ลงนาม) ผู้สั่งจ่าย</span></DIV>";
print "<DIV style='left:11PX;top:7020PX;width:350PX;height:30PX;'><span class='fc1-2'>ได้จ่ายตามรายการและจำนวนที่แจ้งไว้ในช่อง 'จ่ายจริงค้างจ่าย' แล้ว</span></DIV>";
print "<DIV style='left:217PX;top:7051PX;width:116PX;height:26PX;'><span class='fc1-2'>$cBounddate</span></DIV>";
print "<DIV style='left:217PX;top:7076PX;width:104PX;height:30PX;'><span class='fc1-0'>วัน เดือน ปี</span></DIV>";
print "<DIV style='left:63PX;top:7076PX;width:147PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>(ลงนาม) ผู้จ่าย</span></DIV>";
print "<DIV style='left:355PX;top:6928PX;width:400PX;height:30PX;'><span class='fc1-0'>ได้รับสิ่งอุปกรณ์ตามรายการและจำนวนที่แจ้งไว้ใน 'จำนวนเบิก' แล้ว</span></DIV>";
print "<DIV style='left:632PX;top:6985PX;width:104PX;height:30PX;'><span class='fc1-0'>วัน เดือน ปี</span></DIV>";
print "<DIV style='left:426PX;top:6985PX;width:197PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>(ลงนาม) ผู้รับ</span></DIV>";
print "<DIV style='left:632PX;top:6959PX;width:116PX;height:26PX;'><span class='fc1-2'>$cBounddate</span></DIV>";
print "<DIV style='left:423PX;top:6964PX;width:203PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>...............................................................</span></DIV>";
print "<DIV style='left:355PX;top:6837PX;width:72PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>&nbsp;</span></DIV>";
print "<DIV style='left:433PX;top:6837PX;width:169PX;height:30PX;' align='center'><span class='fc1-0'>-&nbsp;-</span></DIV>";
print "<DIV style='left:2PX;top:6866PX;width:72PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>$aYot[4]</span></DIV>";
print "<DIV style='left:2PX;top:6957PX;width:72PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>พ.อ.</span></DIV>";
print "<DIV style='left:2PX;top:7049PX;width:72PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>จ.ส.อ.</span></DIV>";
print "<DIV style='left:62PX;top:6959PX;width:158PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>............................................</span></DIV>";
print "<DIV style='left:62PX;top:6869PX;width:158PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>............................................</span></DIV>";
print "<DIV style='left:62PX;top:7051PX;width:158PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>............................................</span></DIV>";
print "<DIV style='left:355PX;top:6957PX;width:72PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>พ.อ. หญิง</span></DIV>";
print "<BR>";
print "</BODY></HTML>";

//po94 ใบที่8 page8

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
//print ".fc1-0 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:NORMAL;}";
//print ".fc1-1 { COLOR:000000;FONT-SIZE:19PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:BOLD;}";
//print ".fc1-2 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:BOLD;}";
//print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";
//print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";
//ใบที่ 8
print "</STYLE>";
print "<TITLE>จัดซื้อยา (รวมVATก่อน)</TITLE>";
print "</head>";
print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";
print "<DIV style='z-index:0'> &nbsp; </div>";
print "<DIV style='left:88PX;top:7307PX;width:306PX;height:30PX;'><span class='fc1-5'>ส่วนราชการ</span><span class='fc1-0'>&nbsp;&nbsp;กองเภสัชกรรม&nbsp;&nbsp;&nbsp;&nbsp;รพ.ค่ายสุรศักดิ์มนตรี</span></DIV>";
print "<DIV style='left:329PX;top:7246PX;width:155PX;height:34PX;TEXT-ALIGN:CENTER;'><span class='fc1-1'>บันทึกข้อความ</span></DIV>";
print "<DIV style='left:88PX;top:7336PX;width:333PX;height:30PX;'><span class='fc1-5'>ที่</span><span class='fc1-0'> กห  0483.63.4/$cPono$cPonoyear</span></DIV>";
print "<DIV style='left:378PX;top:7336PX;width:257PX;height:30PX;'><span class='fc1-5'>วันที่</span></DIV>";
print "<DIV style='left:410PX;top:7336PX;width:257PX;height:30PX;'><span class='fc1-0'>$cBounddate</span></DIV>";
print "<DIV style='z-index:15;left:78PX;top:7224PX;width:73PX;height:80PX;'>
<img  WIDTH=73 HEIGHT=80 SRC='bird.jpg'></DIV>";
//print "<DIV style='left:445PX;top:7336PX;width:257PX;height:30PX;'><span class='fc1-0'></span></DIV>";
print "<DIV style='left:88PX;top:7367PX;width:36PX;height:30PX;'><span class='fc1-5'>เรื่อง</span></DIV>";
print "<DIV style='left:88PX;top:7396PX;width:36PX;height:30PX;'><span class='fc1-5'>เรียน</span></DIV>";
print "<DIV style='left:138PX;top:7367PX;width:283PX;height:30PX;'><span class='fc1-0'>รายงานผลการจัดหาและเบิกเงิน</span></DIV>";

print "<DIV style='left:138PX;top:7396PX;width:283PX;height:30PX;'><span class='fc1-0'>ผอ.รพ.ค่ายสุรศักดิ์มนตรี</span></DIV>";

print "<DIV style='left:163PX;top:7425PX;width:619PX;height:30PX;'><span class='fc1-0'>1. ตามคำสั่ง ผอ.รพ.ค่ายฯ ให้ กองเภสัชกรรม ดำเนินการจัดหาพัสดุโดยวิธีการเฉพาะเจาะจง รวม $nItems รายการ</span></DIV>";

print "<DIV style='left:88PX;top:7454PX;width:693PX;height:30PX;'><span class='fc1-0'>ภายในวงเงิน";
print "$nPriadvat บาท&nbsp;$cPriadvat</span></DIV>";

print "<DIV style='left:191PX;top:7483PX;width:590PX;height:30PX;'><span class='fc1-0'>1.1 กองเภสัชกรรม รพ.ค่ายฯ ได้ดำเนินการเรียบร้อยแล้ว</span></DIV>";

print "<DIV style='left:191PX;top:7512PX;width:448PX;height:30PX;'><span class='fc1-0'>1.2 กรรมการตรวจรับพัสดุ ได้ทำการตรวจรับพัสดุไว้เป็นที่เรียบร้อยแล้ว เมื่อ</span></DIV>";

print "<DIV style='left:638PX;top:7512PX;width:143PX;height:30PX;'><span class='fc1-0'><B>$cBounddate</B></span></DIV>";

print "<DIV style='left:191PX;top:7541PX;width:216PX;height:30PX;'><span class='fc1-0'>1.3 กองเภสัชกรรม รพ.ค่ายฯ ได้ให้</span></DIV>";

print "<DIV style='left:406PX;top:7541PX;width:170PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aYot[4] $aFname[4]</span></DIV>";

print "<DIV style='left:575PX;top:7541PX;width:206PX;height:30PX;'><span class='fc1-0'>เป็นผู้รับมอบพัสดุ ตามรายการ</span></DIV>";

print "<DIV style='left:191PX;top:7570PX;width:104PX;height:30PX;'><span class='fc1-0'>นั้นเรียบร้อยเมื่อ</span></DIV>";

print "<DIV style='left:294PX;top:7570PX;width:167PX;height:30PX;'><span class='fc1-0'><B>$cBounddate</B></span></DIV>";

print "<DIV style='left:191PX;top:7599PX;width:407PX;height:30PX;'><span class='fc1-0'>1.4 กองเภสัชกรรม รพ.ค่ายฯ จึงขอเบิกเงินในการจัดหาพัสดุ เป็นเงิน</span></DIV>";

print "<DIV style='left:597PX;top:7599PX;width:184PX;height:30PX;'><span class='fc1-0'><B>$nPriadvat</B> บาท </span></DIV>";

print "<DIV style='left:88PX;top:7628PX;width:693PX;height:30PX;'><span class='fc1-0'>$cPriadvat เงินจำนวนนี้ ข้าพเจ้า แจ้งให้ผู้ขาย มารับเงินจำนวนนี้แล้ว</span></DIV>";

print "<DIV style='left:88PX;top:7657PX;width:693PX;height:30PX;'><span class='fc1-0'>และ พร้อมนี้ได้แนบหน้างบใบสำคัญคู่จ่ายเงิน&nbsp;&nbsp;รพ.1 มาด้วยแล้ว</span></DIV>";

print "<DIV style='left:191PX;top:7686PX;width:590PX;height:30PX;'><span class='fc1-0'>1.5 พัสดุที่จัดหามานี้ จะได้ให้ กองเภสัชกรรม รพ. ค่ายฯ เบิกรับไปใช้ในราชการต่อไป</span></DIV>";

print "<DIV style='left:191PX;top:7715PX;width:52PX;height:30PX;'><span class='fc1-0'>ภายใน</span></DIV>";

print "<DIV style='left:242PX;top:7715PX;width:220PX;height:30PX;'><span class='fc1-0'><B>$cBounddate</B></span></DIV>";

print "<DIV style='left:163PX;top:7744PX;width:619PX;height:30PX;'><span class='fc1-0'>2. ข้อเสนอ</span></DIV>";

print "<DIV style='left:191PX;top:7773PX;width:591PX;height:30PX;'><span class='fc1-0'>2.1 เพื่อกรุณาทราบผลการปฎิบัติการจัดหาพัสดุ</span></DIV>";

print "<DIV style='left:191PX;top:7802PX;width:187PX;height:30PX;'><span class='fc1-0'>2.2 ขออนุมัติเบิกเงินจำนวน</span></DIV>";

print "<DIV style='left:377PX;top:7802PX;width:500PX;height:30PX;'><span class='fc1-0'><B>$nPriadvat</B>
  บาท</span>&nbsp;&nbsp;<span class='fc1-0'>$cPriadvat&nbsp;</span></DIV>";
  
print "<DIV style='left:88PX;top:7831PX;width:693PX;height:30PX;'><span class='fc1-0'>&nbsp;ให้";
print "<B>$cComname</B> เป็นผู้รับต่อไป</span></DIV>";

print "<DIV style='left:163PX;top:7860PX;width:618PX;height:30PX;'><span class='fc1-0'>จึงเรียนมาเพื่อกรุณาทราบ และอนุมัติสั่งจ่ายให้ต่อไปด้วย</span></DIV>";  

print "<DIV style='left:148PX;top:8034PX;width:87PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>$aYot[1]</span></DIV>";
print "<DIV style='left:143PX;top:8063PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>($aFname[1])</span></DIV>";
print "<DIV style='left:168PX;top:8000PX;width:55PX;height:30PX;'><span class='fc1-0'>อนุมัติ</span></DIV>";

//print "<DIV style='left:420PX;top:7976PX;width:55PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>(ลงชื่อ)</span></DIV>";



print "<DIV style='left:143PX;top:8121PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$cBounddate</span></DIV>";


print "<DIV style='left:485PX;top:8034PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost[2]</span></DIV>";
print "<DIV style='left:484PX;top:7976PX;width:101PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aYot[2]</span></DIV>";
print "<DIV style='left:485PX;top:8005PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>($aFname[2])</span></DIV>";
print "<DIV style='left:143PX;top:8092PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost[1]</span></DIV>";
print "<DIV style='left:485PX;top:8063PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost2[2]</span></DIV>";

print "<BR>";
print "</BODY></HTML>";



//po96 ใบที่9 page9
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
print "<TITLE>จัดซื้อยา (รวมVATก่อน)</TITLE>";
print "</head>";
print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";
print "<DIV style='z-index:0'> &nbsp; </div>";
print "<div style='left:23PX;top:8439PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:729PX;'>";
print "</div>";
print "<div style='left:23PX;top:8468PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:729PX;'></div>";
print "<div style='left:23PX;top:8584PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:729PX;'></div>";
print "<div style='left:107PX;top:8440PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:146PX;'>";
print "<table width='0px' height='140PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:210PX;top:8439PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:146PX;'>";
print "<table width='0px' height='140PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:486PX;top:8439PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:146PX;'>";
print "<table width='0px' height='140PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:617PX;top:8440PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:233PX;'>";
print "<table width='0px' height='227PX'><td>&nbsp;</td></table>";
print "</div>";
print "<div style='left:23PX;top:8671PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:729PX;'>";
print "</div>";
//print "<div style='left:618PX;top:8613PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:134PX;'>";
//print "</div>";
//print "<div style='left:618PX;top:8642PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:134PX;'>";
//print "</div>";
//print "<div style='left:23PX;top:8700PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:729PX;'>";
//print "</div>";
//print "<div style='left:23PX;top:8729PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:729PX;'>";
//print "</div>";
//print "<div style='left:23PX;top:8758PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:729PX;'>";
//print "</div>";
print "<div style='left:23PX;top:8816PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:729PX;'>";
print "</div>";
print "<div style='left:23PX;top:8845PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:729PX;'>";
print "</div>";
//print "<div style='left:23PX;top:8874PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:378PX;'>";
//print "</div>";
//print "<div style='left:23PX;top:8903PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:729PX;'>";
//print "</div>";
print "<div style='left:400PX;top:8817PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:416PX;'>";
print "<table width='0px' height='390PX'><td>&nbsp;</td></table>";
print "</div>";
//print "<div style='left:22PX;top:8932PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:729PX;'>";
//print "</div>";
print "<div style='left:22PX;top:8961PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:729PX;'>";
print "</div>";
print "<div style='left:22PX;top:9087PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:729PX;'>";
print "</div>";
print "<DIV class='box' style='z-index:10; border-color:000000;border-style:dashed;border-bottom-style:dashed;border-bottom-width:1PX;border-left-style:dashed;border-left-width:1PX;border-top-style:dashed;border-top-width:1PX;border-right-style:dashed;border-right-width:1PX;left:22PX;top:8224PX;width:730PX;height:1000PX;'>";
print "<table border=0 cellpadding=0 cellspacing=0 width=723px height=1001px><TD>&nbsp;</TD></TABLE>";
print "</DIV>";
print "<DIV style='left:433PX;top:8308PX;width:316PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>ราชการสถานพยาบาล &nbsp;&nbsp;รพ.ค่ายสุรศักดิ์มนตรี</span></DIV>";
print "<DIV style='left:22PX;top:8233PX;width:730PX;height:34PX;TEXT-ALIGN:CENTER;'><span class='fc1-1'>ใบขอเบิกเงินรายรับสถานพยาบาล</span></DIV>";
print "<DIV style='left:632PX;top:8258PX;width:117PX;height:30PX;'><span class='fc1-0'>$cPono$cPonoyear</span></DIV>";
print "<DIV style='left:353PX;top:8358PX;width:32PX;height:30PX;'><span class='fc1-0'>&nbsp;</span></DIV>";

print "<DIV style='left:389PX;top:8358PX;width:360PX;height:30PX;'><span class='fc1-0'>$cBorrowdate</span></DIV>";  //แก้ไขวันที่ 21/04/60

print "<DIV style='left:674PX;top:8233PX;width:75PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>ร.พ.1</span></DIV>";
print "<DIV style='left:547PX;top:8258PX;width:75PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>เลขที่ผู้เบิก</span></DIV>";
print "<DIV style='left:547PX;top:8283PX;width:75PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>เลขที่ผู้จ่าย</span></DIV>";
print "<DIV style='left:433PX;top:8333PX;width:316PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>ที่ทำการ กองเภสัชกรรม รพ.ค่ายสุรศักดิ์มนตรี</span></DIV>";
print "<DIV style='left:74PX;top:8383PX;width:675PX;height:30PX;'><span class='fc1-0'>ข้าพเจ้ า $aYot[2] $aFname[2] ตำแหน่ง$aPost[2] $aPost2[2] ขอเบิกเงินจาก</span></DIV>";
print "<DIV style='left:24PX;top:8408PX;width:725PX;height:30PX;'><span class='fc1-0'>ฝกง. ร.พ.ค่ายสุรศักดิ์มนตรี เพื่อนำมาจ่าย ตามรายการต่อไปนี้</span></DIV>";
print "<DIV style='left:24PX;top:8439PX;width:82PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>ลำดับ</span></DIV>";
print "<DIV style='left:355PX;top:8981PX;width:310PX;height:30PX;'><span class='fc1-0'>ผู้ตรวจ</span></DIV>";
print "<DIV style='left:105PX;top:8981PX;width:310PX;height:30PX;'><span class='fc1-0'>$aYot[13]</span></DIV>";
print "<DIV style='left:24PX;top:8671PX;width:97PX;height:30PX;'><span class='fc1-0'>(ตัวอักษร)</span></DIV>";
print "<DIV style='left:518PX;top:9058PX;width:310PX;height:30PX;'><span class='fc1-0'>............/............/............</span></DIV>";

print "<DIV style='left:493PX;top:8787PX;width:167PX;height:30PX;'><span class='fc1-0'>$cBorrowdate</span></DIV>";  //แก้ไขวันที่ 21/04/60

print "<DIV style='left:109PX;top:8439PX;width:100PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>ประเภท</span></DIV>";
print "<DIV style='left:212PX;top:8439PX;width:273PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>รายการ</span></DIV>";
print "<DIV style='left:490PX;top:8439PX;width:124PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>จำนวนเงิน</span></DIV>";
print "<DIV style='left:621PX;top:8439PX;width:126PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>รวมเงิน</span></DIV>";
print "<DIV style='left:24PX;top:8468PX;width:82PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>1</span></DIV>";
print "<DIV style='left:212PX;top:8497PX;width:92PX;height:30PX;'><span class='fc1-0'>ตามใบสั่งซื้อที่</span></DIV>";
print "<DIV style='left:303PX;top:8498PX;width:117PX;height:30PX;'><span class='fc1-0'>$cPono$cPonoyear</span></DIV>";
print "<DIV style='left:212PX;top:8526PX;width:26PX;height:30PX;'><span class='fc1-0'>ลง</span></DIV>";

print "<DIV style='left:237PX;top:8526PX;width:183PX;height:30PX;'><span class='fc1-0'>$cSenddate</span></DIV>";  //แก้ไขวันที่ 21/04/60

print "<DIV style='left:212PX;top:8555PX;width:111PX;height:30PX;'><span class='fc1-0'>ค่าภาษีมูลค่าเพิ่ม</span></DIV>";
//print "<DIV style='left:442PX;top:8526PX;width:43PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>เงิน</span></DIV>";
//print "<DIV style='left:442PX;top:8555PX;width:43PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>เงิน</span></DIV>";
print "<DIV style='left:464PX;top:8584PX;width:150PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>จำนวนเงินที่ขอเบิก</span></DIV>";
print "<DIV style='left:464PX;top:8613PX;width:150PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>ภาษีหัก ณ ที่จ่าย</span></DIV>";
print "<DIV style='left:464PX;top:8642PX;width:150PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>จำนวนเงินที่ขอเบิกสุทธิ</span></DIV>";
print "<DIV style='left:120PX;top:8671PX;width:512PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$cNetpaid</span></DIV>";
print "<DIV style='left:24PX;top:8700PX;width:334PX;height:30PX;'><span class='fc1-0'>เงินที่ขอเบิกนี้โปรดสั่งจ่าย&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; เช็คในนาม</span></DIV>";
print "<DIV style='left:357PX;top:8700PX;width:333PX;height:30PX;'><span class='fc1-0'><B>$cComname</B></span></DIV>";
print "<DIV style='left:24PX;top:8729PX;width:284PX;height:30PX;'><span class='fc1-0'>เงินตามใบขอเบิกเงินฉบับนี้ ข้าพเจ้าขอมอบให้</span></DIV>";
print "<DIV style='left:656PX;top:8729PX;width:93PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>เป็นผู้รับแทน</span></DIV>";
print "<DIV style='left:324PX;top:8758PX;width:105PX;height:30PX;'><span class='fc1-0'>ผู้เบิก</span></DIV>";
print "<DIV style='left:115PX;top:8787PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>($aFname[2])</span></DIV>";
print "<DIV style='left:128PX;top:8758PX;width:110PX;height:30PX;'><span class='fc1-0'>$aYot[2]</span></DIV>";
print "<DIV style='left:424PX;top:8758PX;width:63PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>ตำแหน่ง</span></DIV>";
print "<DIV style='left:493PX;top:8758PX;width:256PX;height:30PX;'><span class='fc1-0'>$aPost[2]</span></DIV>";
//print "<DIV style='left:423PX;top:8787PX;width:64PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>วันที่</span></DIV>";
print "<DIV style='left:24PX;top:8816PX;width:375PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>การตรวจการจ่าย</span></DIV>";
print "<DIV style='left:402PX;top:8816PX;width:347PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>การรับเงิน</span></DIV>";
print "<DIV style='left:24PX;top:8850PX;width:375PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>ตรวจรายการขอเบิกเงินถูกต้องแล้วให้จ่ายเงินได้</span></DIV>";
print "<DIV style='left:24PX;top:8903PX;width:79PX;height:30PX;'><span class='fc1-0'>จำนวนเงิน</span></DIV>";
print "<DIV style='left:437PX;top:8874PX;width:284PX;height:30PX;'><span class='fc1-0'> ( ) เงินสด&nbsp;&nbsp;&nbsp;&nbsp;( ) เช็คเลขที่..................................</span></DIV>";
print "<DIV style='left:437PX;top:8850PX;width:284PX;height:30PX;'><span class='fc1-0'> ได้รับเงินตามใบเบิกเงินฉบับนี้ไว้ถูกต้องแล้ว</span></DIV>";
print "<DIV style='left:125PX;top:9010PX;width:107PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>($aFname[13])</span></DIV>";
print "<DIV style='left:100PX;top:9039PX;width:310PX;height:30PX;'><span class='fc1-0'>$aPost[13]</span></DIV>";
print "<DIV style='left:659PX;top:8555PX;width:88PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>$nPriadvat</span></DIV>";
print "<DIV style='left:526PX;top:8555PX;width:88PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>$nVat</span></DIV>";
print "<DIV style='left:526PX;top:8526PX;width:88PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>$nNetprice</span></DIV>";
print "<DIV style='left:659PX;top:8584PX;width:88PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>$nPriadvat</span></DIV>";
print "<DIV style='left:659PX;top:8642PX;width:88PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'><B>$nNetpaid</B></span></DIV>";
print "<DIV style='left:136PX;top:8903PX;width:183PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$nNetpaid</span></DIV>";
print "<DIV style='left:292PX;top:8903PX;width:43PX;height:30PX;'><span class='fc1-0'>บาท</span></DIV>";
print "<DIV style='left:672PX;top:8903PX;width:43PX;height:30PX;'><span class='fc1-0'>บาท</span></DIV>";
print "<DIV style='left:486PX;top:8903PX;width:183PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$nNetpaid</span></DIV>";
print "<DIV style='left:404PX;top:8903PX;width:79PX;height:30PX;'><span class='fc1-0'>จำนวนเงิน</span></DIV>";
print "<DIV style='left:501PX;top:9010PX;width:310PX;height:30PX;'TEXT-ALIGN:CENTER;' ><span class='fc1-0'>(..............................................)</span></DIV>";
print "<DIV style='left:501PX;top:9039PX;width:310PX;height:30PX;'TEXT-ALIGN:CENTER;'><span class='fc1-0'>..............................................</span></DIV>";
print "<DIV style='left:444PX;top:8981PX;width:310PX;height:30PX;'><span class='fc1-0'>ชื่อผู้รับเงิน...............................................</span></DIV>";
print "<DIV style='left:78PX;top:9058PX;width:310PX;height:30PX;'><span class='fc1-0'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;............/............/............</span></DIV>";
print "<DIV style='left:280PX;top:9117PX;width:374PX;height:30PX;'><span class='fc1-0'>ผู้มีอำนาจสั่งจ่ายเงิน</span></DIV>";
print "<DIV style='left:105PX;top:9117PX;width:310PX;height:30PX;'><span class='fc1-0'>$aYot[1]</span></DIV>";
print "<DIV style='left:35PX;top:9146PX;width:274PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>($aFname[1])</span></DIV>";
print "<DIV style='left:35PX;top:9175PX;width:274PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost[1]</span></DIV>";
print "<DIV style='left:470PX;top:9146PX;width:227PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>($aFname[11])</span></DIV>";
print "<DIV style='left:450PX;top:9175PX;width:310PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>$aPost[11] </span></DIV>";
print "<DIV style='left:440PX;top:9117PX;width:310PX;height:30PX;'><span class='fc1-0'>ชื่อผู้จ่ายเงิน&nbsp;&nbsp;$aYot[11]</span></DIV>";
print "<DIV style='left:34PX;top:9202PX;width:274PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>............/............/............</span></DIV>";
print "<DIV style='left:470PX;top:9202PX;width:227PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>............/............/............</span></DIV>";
print "<DIV style='left:659PX;top:8613PX;width:88PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>$nTax</span></DIV>";
print "<DIV style='left:322PX;top:8555PX;width:86PX;height:30PX;'><span class='fc1-0'>7.00 %</span></DIV>";
print "<DIV style='left:24PX;top:8934PX;width:377PX;height:26PX;'><span class='fc1-2'>ตัวอักษร&nbsp;";
print "$cNetpaid</span></DIV>";
print "<DIV style='left:404PX;top:8934PX;width:348PX;height:26PX;'><span class='fc1-2'>ตัวอักษร&nbsp;";
print "$cNetpaid</span></DIV>";
print "<DIV style='left:212PX;top:8468PX;width:273PX;height:30PX;'><span class='fc1-0'>ค่ายา</span></DIV>";
print "<DIV style='left:109PX;top:8468PX;width:100PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>ยา</span></DIV>";
print "<BR>";
print "</BODY></HTML>";


//PO9/10  ใบที่10 page10
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
print "</STYLE>";
print "<TITLE>จัดซื้อยา (รวมVATหลัง)</TITLE>";
print "</head>";
print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";
print "<DIV style='z-index:0'> &nbsp; </div>";
?>
<div style="position: absolute; font-family:'TH SarabunPSK'; font-size: 20px; left:54px; top:9280px;">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="41%"><img  WIDTH=73 HEIGHT=80 SRC='bird.jpg'></td>
    <td colspan="3" align="left"><strong><span class='fc1-1'>บันทึกข้อความ</span></strong></td>
    </tr>
  <tr>
    <td height="30" colspan="4"><span class='fc1-5'>ส่วนราชการ</span><span class='fc1-0'>&nbsp;&nbsp;กองเภสัชกรรม&nbsp;&nbsp;&nbsp;&nbsp;รพ.ค่ายสุรศักดิ์มนตรี</span></td>
    </tr>
  <tr>
    <td height="30" colspan="4"><span class='fc1-5'>ที่ </span><span class='fc1-0'><? print "<div style='width:180PX;height:30PX;'><span class='fc1-0'>กห  0483.63.4/$cPono$cPonoyear</span></div>";?></span><? print "<div style='left:342PX;width:150PX;height:30PX;'><span class='fc1-0'><b>วันที่</b> $cPodate</span></div>";?></td>
    </tr>
  <tr>
    <td height="30" colspan="4"><span class='fc1-5'>เรื่อง&nbsp;&nbsp;</span><span class='fc1-0'>รายงานผลการดำเนินการร่างขอบเขตของงาน</span></td>
    </tr>
  <tr>
    <td height="30" colspan="4"><span class='fc1-5'>เรียน&nbsp;&nbsp;</span><span class='fc1-0'>ผอ.รพ.ค่ายสุรศักดิ์มนตรี</span></td>
    </tr>
<? if($chkprice < 100000){ ?>    
  <tr>
    <td height="30" colspan="4"><span class='fc1-5'>อ้างถึง&nbsp;&nbsp;</span><span class='fc1-0'>1. คำสั่ง รพ.ค่ายสุรศักดิ์มนตรี ที่ 237/60 ลง 15 ธ.ค. 2560</span></td>
    </tr>
<? }else{ ?>
  <tr>
    <td height="30" colspan="4"><span class='fc1-5'>อ้างถึง&nbsp;&nbsp;</span><span class='fc1-0'>1. คำสั่ง รพ.ค่ายสุรศักดิ์มนตรี ที่ 151/60 ลง 23 ส.ค. 2560</span></td>
    </tr>
<? } ?>
  <tr>
    <td height="30" colspan="2"><span class='fc1-5'>สิ่งที่ส่งมาด้วย&nbsp;&nbsp;</span><span class='fc1-0'>ร่างขอบเขตของงาน</span></td>
    <td height="30" colspan="2" align="center"><span class='fc1-0'>จำนวน&nbsp;  1&nbsp;ชุด</span></td>
    </tr>
<? 
$sql="select * from officers where mancode = 'headtor'";
$query=mysql_query($sql);
$rows=mysql_fetch_array($query);
$ptname=$rows["yot"]." ".$rows["fullname"];
//$chkprice=(int)$nPriadvat;
if($chkprice < 100000){
?>    
  <tr>
    <td height="30" colspan="4"><div style="left:100px;"><span class='fc1-0'>ตามอ้างถึง ให้ ดิฉัน <?=$ptname;?> เป็นผู้รับผิดชอบในการดำเนินการร่างขอบเขตของงาน</span></div></td>
    </tr>
<? }else{ ?>
  <tr>
    <td height="30" colspan="4"><div style="left:100px;"><span class='fc1-0'>ตามอ้างถึง ให้ คณะกรรมการ เป็นผู้รับผิดชอบในดำเนินการการจัดทำร่างขอบเขตของงาน </span></div></td>
    </tr>
<? } ?>    
  <tr>
    <td height="40" colspan="4"><span class='fc1-0'>และรายละเอียดคุณลักษณะเฉพาะของพัสดุที่จะจัดซื้อหรือจ้าง รายละเอียดตามส่งที่ส่งมาด้วย</span></td>
    </tr>
  <tr>
    <td height="30" colspan="4" valign="top"><div style="left:100px;"><span class='fc1-0'>จึงเรียนมาเพื่อกรุณาพิจารณา</span></div></td>
    </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td width="14%" height="30">&nbsp;</td>
    <td width="31%" height="30">&nbsp;</td>
    <td width="14%" height="30">&nbsp;</td>
  </tr>
<? 
//$chkprice=(int)$nPriadvat;
if($chkprice < 100000){
?>
  <tr>
    <td height="30" align="center">&nbsp;</td>
    <td height="30" align="right"><span class="fc1-0"><?=$rows["yot"];?></span></td>
    <td height="30" align="center">&nbsp;</td>
    <td height="30" align="center">&nbsp;</td>
  </tr>
  <tr align="center">
    <td height="30">&nbsp;</td>
    <td height="30" colspan="2"><span class="fc1-0">( <?=$rows["fullname"];?> )</span></td>
    <td height="30">&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" colspan="2" align="center"><span class="fc1-0"><?=$rows["position"];?></span></td>
    <td height="30">&nbsp;</td>
  </tr>

  <? }else if($chkprice >= 100000){ 
$sql1="select * from officers where mancode like 'bordtor%'";
$query1=mysql_query($sql1);
while($rows1=mysql_fetch_array($query1)){
$ptname1=$rows1["yot"]." ".$rows1["fullname"];
  ?>
  <tr>
    <td height="30" align="center">&nbsp;</td>
    <td height="30" align="right"><span class="fc1-0"><?=$rows1["yot"];?></span></td>
    <td height="30"><span style="margin-left:140px; font-family:'TH SarabunPSK'; font-size: 20px;"><?=$rows1["position"];?></span></td>
    <td height="30" align="center">&nbsp;</td>
  </tr>
  <tr align="left">
    <td height="30">&nbsp;</td>
    <td height="30" colspan="2"><span style="margin-left:150px;" class="fc1-0">( <?=$rows1["fullname"];?> )</span></td>
    <td height="30">&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" colspan="2" align="center">&nbsp;</td>
    <td height="30">&nbsp;</td>
  </tr>   
	<?
   		}  //CLOSE WHILE
   }
	?>  
</table>

</div>
<?
print "<BR>";
print "</BODY></HTML>";
?>



<?
// ร่างขอบเขตงาน  ใบที่ 11 page11
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
print "</STYLE>";
print "<TITLE>จัดซื้อยา (รวมVATหลัง)</TITLE>";
print"</head>";
print"<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";
print"<DIV style='z-index:0'> &nbsp; </div>";


print"<DIV style='left:134PX;top:10315PX;width:600PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-1'>ขอบเขตของงานและรายละเอียดคุณลักษณะเฉพาะของพัสดุที่จะจัดซื้อยา/เวชภัณฑ์</span></DIV>";

print"<DIV style='left:136PX;top:10355PX;width:800PX;height:26PX;' class='fc1-0'>
<span>กองเภสัชกรรม รพ.ค่ายสุรศักดิ์มนตรี ที่ กห 0483.63.4/</span>
&nbsp;&nbsp;&nbsp;&nbsp;$cPrepono&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
ลง วันที่
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$cPrepodate&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</DIV>";

print"<div style='left:442PX;top:10376PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:100PX;'></div>";
print"<div style='left:588PX;top:10376PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:100PX;'></div>";
?>
<style>
.dx_tb{
	border: 1px dashed #000;
	font-size: 13pt;
}
.dx_tb thead tr th{
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
.dx_detail div{
	position: relative;
	padding-left: 10px;
}
</style>
<div style="position: absolute; left:10px; top: 10396px; font-family: TH SarabunPSK; font-size: 13pt;">
	<table class="dx_tb">
		<thead>
			<tr>
				<th style="width:38px;">ลำดับ</th>
				<th style="width:258px;">รายการ</th>
				<th style="width:51px;">หน่วยนับ</th>
				<th style="width:75px;">ขนาดบรรจุ</th>
				<th style="width:43px;">จำนวน</th>
				<th style="width:55px;">ราคากลาง</th>
				<th style="width:55px;">แหล่งที่มาของราคากลาง ***</th>
				<th style="width:75px;">หน่วยละ<br />
			    รวม VAT</th>
				<th style="width:75px;">ราคา<br />
			    รวม VAT</th>
				<th  style="width:75px;" class="last_child">Spec พบ.ที่</th>
			</tr>
		</thead>
		<tbody>
			
			<?php
			$sumtotal=0;
			for ($ii=1; $ii <= 19; $ii++) { 
				 include("connect.inc");
				$sql1="select unitpri,part,freelimit,edpri,edpri_from from druglst where drugcode='$aDrugcode[$ii]'";
				//print $sql;
				$chkquery=mysql_query($sql1);
				list($unitpri,$part,$freelimit,$edpri,$edprifrom)=mysql_fetch_array($chkquery);				
				// ราคากลาง
				//echo "==>".$edpri;
				
				$cost = false;
				$from = '&nbsp;';

				//  ถ้าเป็นอุปกรณ์ เทียบจาก อุปกรเบิกได้ไม่เกิน
				if( $part == 'DPY' OR $part == 'DPN' ){

					// ราคาอุปกรณ์เบิกได้ไม่เกิน
					if( $freelimit > 0 ){
						$cost = $freelimit;
						$from = 3;
					}

				}else{

					// ราคากลาง
					if( $edpri > 0 ){
						$cost = $edpri;
						$from = 3;
					}

				}

				// ถ้าไม่มีราคากลาง หรือ ราคาอุปกรณ์ให้ใช้ราคาทุน
				if( empty($cost) ){
					if( !empty($unitpri) ){
						$cost = $unitpri;
						$from = 5;
					}
				}
				
				$aTotalpackprice=$aAmount[$ii]*$aPackpri[$ii];
				$aTotalprice=$aAmount[$ii]*$aPackpri_vat[$ii];
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
		</tbody>
	</table>
<?php
	$edpri_from_list = array(
    1 => '(๑) ราคาที่ได้มาจากการคำนวณตามหลักเกณฑ์ที่คณะกรรมการราคากลางกำหนด',
    2 => '(๒) ราคาที่ได้มาจากฐานข้อมูลราคาอ้างอิงของพัสดุที่กรมบัญชีกลางจัดทำ',
    3 => '(๓) ราคามาตรฐานที่สำนักงบประมาณหรือหน่วยงานกลางอื่นกำหนด<br>(ราคามาตรฐานเวชภัณฑ์ที่มิใช่ยา ที่ สธ 0228.07.2/ว688 ลง วันที่ 6 สิงหาคม พ.ศ.2556)<br>(ประเภทและอัตราค่าอวัยวะเทียมและอุปกรณ์ในการบำบัดรักษาโรค ที่ กค 0422.2/พิเศษ ว 1 ลงวันที่ 4 ธันวาคม 2556)',
    4 => '(๔) ราคาที่ได้มาจากการสืบราคาจากท้องตลาด',
    5 => '(๕) ราคาที่เคขซื้อหรือจ้างครั้งหลังสุดภายในระยะเวลาสองปีงบประมาณ',
    6 => '(๖) ราคาอื่นใดตามหลักเกณฑ์ วิธีการ หรือแนวทางปฏิบัติของหน่วยงานของรัฐนั้นๆ',
);

?>
	<div class="dx_detail" style="margin-top:10px;">
		<div><strong>ระยะเวลาการส่งมอบ</strong>
			<div style="padding-left: 20px;">กำหนดเวลาส่งมอบยา/เวชภัณฑ์ ภายใน 30 วัน นับจากวันลงนามในสัญญา</div>
        </div>
		<div><strong>งบประมาณ</strong>
			<div style="padding-left: 20px;">งบประมาณในการจัดซื้อ จำนวนเงิน <?=$nPriadvat;?> บาท <?=$cPriadvat;?></div>
        </div>
        <div><strong>หลักเกณฑ์การพิจารณาคัดเลือกข้อเสนอ</strong> 
			<div style="padding-left: 20px;">การพิจารณาคัดเลือกข้อเสนอ โดยใช้เกณฑ์ราคา</div>
        </div>                
		<div style="margin-top: 10px;">*** หมายเหตุ</div>
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
</div>    
<?php

print"<BR>";
print"</BODY>";
print"</HTML>";
?>