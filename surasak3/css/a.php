
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<link href="document.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.fonth {
	font-size: 29pt;
	font-weight:bold;
}
.font20b {
	font-size: 20pt;
	font-weight:bold;
}
.font16 {
	font-size: 16pt;
	text-align:justify;
	text-justify :newspaper;
}
.font14 {
	font-size: 14pt;
}
.font162 {
	font-size: 16pt;
}
.font18 {
	font-size: 18pt;
}
.font15 {
	font-size: 15pt;
}
.font12 {
	font-size: 12pt;
}
.font10 {
	font-size: 10pt;
}
.font7 {
	font-size:7pt;
}
td.buy{
/*border-top-style:dashed;*/
border-right-style:dashed;
border-bottom-style:dashed;
border-left-style:none;
/*border-left-style:dashed;*/
}

td.buy2{
/*border-top-style:dashed;*/
border-right-style:dashed;
border-bottom-style:dashed;
/*border-left-style:dashed;*/
}
td.buy3{
/*border-top-style:dashed;*/
/*border-right-style:dashed;*/
border-bottom-style:dashed;

/*border-left-style:dashed;*/
}
td.buy4{
/*border-top-style:dashed;*/
border-right-style:dashed;
/*border-bottom-style:dashed;*/
/*border-left-style:dashed;*/
}
/*	text-align:justify;*/
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 
.font2-2 {text-indent:250px;
}
.sarabun1 {	font-family:"TH SarabunPSK";
	font-size:20px;
}
</style>
</head>

<body>
<p>
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

include("../connect.inc");
 
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
    include("../connect.inc");

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

    include("../connect.inc");

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


?>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="2%">&nbsp;</td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2"><img src="original_Tra-Khrut.gif" width="56" height="56" /></td>
    <td width="64%" align="left" valign="bottom" class="fonth">บันทึกข้อความ</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><font class="font20b">ส่วนราชการ</font><font class="font16">............กองเภสัชกรรม    รพ.ค่ายสุรศักดิ์มนตรี.............................................................................</font></td>
  </tr>
  <tr>
    <td colspan="2"><font class="font20b">ที่</font><font class="font16">....กห 0483.63.4/<?=$cPono;?>...........</font></td>
    <td id="text-indent12" ><font class="font20b">วันที่</font><font class="font16">....<?=$cPodate;?>....................................................................</font></td>
  </tr>
  <tr>
    <td colspan="3"><font class="font20b">เรื่อง</font><font class="font16">....ขออนุมัติจัดซื้อยา.....................................................................................................................................</font></td>
  </tr>
  <tr>
    <td colspan="3" ><font class="font16">เรียน&nbsp;&nbsp; ผอ.รพ.ค่ายสุรศักดิ์มนตรี</font></td>
  </tr>
  <tr>
    <td colspan="3" ><font class="font16">อ้างถึง  &nbsp;&nbsp; </font><font class="font16" id="text-indent15">1.ระเบียบสำนักนายกรัฐมนตรี ว่าด้วยการพัสดุ พ.ศ.2535, ลง 20 ม.ค.2535,และที่แก้ไขเพิ่มเติม</font></td>
  </tr>
  <tr>
    <td colspan="3" id="text-indent15" ><font class="font16">2.คำสั่ง กห (เฉพาะ) ที่ 50/50 16 มี.ค. 2550 เรื่อง   การพัสดุ </font></td>
  </tr>
  <tr>
    <td colspan="3" id="text-indent15" ><font class="font16">3.คำสั่ง ทบ (เฉพาะ) ที่ 476/44 เรื่อง   มอบอำนาจอนุมัติการเบิกจ่ายเงินรายรับสถานพยาบาล</font></td>
  </tr>
  <tr>
    <td colspan="3"><font class="font16">สิ่งที่ส่งมาด้วย &nbsp;&nbsp; 1. หนังสือกองเภสัชกรรม รพ.ค่ายฯ ที่ <strong><?=$cPrepono;?></strong> ลงวันที่ <strong><?=$cPrepodate;?></strong></font></td>
  </tr>
  <tr>
    <td colspan="3" id="text-indent27"><font class="font16"> 2. บัญชีรายละเอียดในการ จัดซื้อ จำนวน 1 ชุด</font></td>
  </tr>
  <tr>
    <td colspan="3" id="text-indent14">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" id="text-indent25" class="font16">1. เนื่องด้วยกองเภสัชกรรม รพ.ค่ายฯ มีความจำเป็นที่จะต้องจัดซื้อยาเพื่อใช้ในราชการ รพ.ค่ายฯ ตามสิ่งที่ส่งมาด้วยข้อ 1.
</td>
  </tr>
  <tr>
    <td colspan="3" id="text-indent25" class="font16">2. รายละเอียด พัสดุที่จะจัดซื้อ ตามบัญชีรายละเอียดที่แนบตามสิ่งที่ส่งมาด้วย 2.</td>
  </tr>
  <tr>
    <td colspan="3" id="text-indent25" class="font16">3. วงเงินจัดซื้อ ครั้งนี้เป็นเงิน <strong><?=$nPriadvat;?></strong> บาท <?=$cPriadvat;?></td>
  </tr>
  <tr>
    <td colspan="3" id="text-indent25" class="font16">4. กำหนดเวลาที่ต้องการใช้วัสดุในวันที่  <?=$cBounddate;?> ส่งที่หน่วย รพ.ค่ายสุรศักดิ์มนตรี(ต้องการให้งานนั้นเสร็จในวันที่ <?=$cBounddate;?>)</td>
  </tr>
  <tr>
    <td colspan="3" id="text-indent25" class="font16">5. การซื้อ ครั้งนี้วงเงินไม่เกิน 100,000 บาท เห็นควรซื้อโดยวิธีตกลงราคาตามระเบียบฯ ที่อ้างถึง วงเงินอยู่ในอำนาจของ ผอ.รพ.ค่ายฯ อนุมัติได้</td>
  </tr>
  <tr>
    <td colspan="3" id="text-indent25" class="font16">6. การซื้อครั้งนี้เห็นควรซื้อจาก<B><?=$cComname;?></B> เพราะสืบราคาแล้วเป็นราคาต่ำสุด ใกล้เคียงกับราคาท้องตลาดปัจจุบัน ได้ต่อรองราคาต่ำสุดแล้ว และขออนุมัติใช้ใบสั่งซื้อเป็นข้อตกลงแทนการทำสัญญาและ ไม่ควร เรียกหลักประกันสัญญา</td>
  </tr>
  <tr>
    <td colspan="3" id="text-indent25" class="font16">7. ข้อเสนอ</td>
  </tr>
  <tr>
    <td colspan="3" id="text-indent4" class="font16">7.1 เห็นควรอนุมัติ(จัดซื้อ)ให้กองเภสัชกรรม  รพ.ค่ายสุรศักดิ์มนตรีโดยวิธีตกลงราคารวม <?=$nItems;?> รายการ วงเงิน <strong><?=$nPriadvat;?></strong> บาท <?=$cPriadvat;?>   จาก <B><?=$cComname;?></B> และใช้ใบสั่งซื้อ เป็นข้อตกลงแทนการทำสัญญาและเห็นควรงดเรียกหลักประกันสัญญา  เนื่องจากผู้ขายติดต่อค้าขายกับทางราชการเป็นประจำมีความมั่นคง เป็นที่น่าเชื่อถือของทางราชการ</td>
  </tr>
  <tr>
    <td colspan="3" id="text-indent4" class="font16">7.2 เห็นควรแต่งตั้งจำนวน3นาย ตามระเบียบฯ ด้วยแล้วรายงานผลให้ทราบภายใน 5 วันทำการ</td>
  </tr>
  <tr>
    <td colspan="3" id="text-indent25" class="font16">จึงเรียนมาเพื่อกรุณาทราบ และกรุณาอนุมัติตามข้อเสนอในข้อ 7.</td>
  </tr>
  <tr>
    <td colspan="3" id="text-indent5" class="font16">&nbsp;</td>
  </tr>
  <tr>
    <td width="18%" class="font16" id="text-indent6">&nbsp;</td>
    <td width="18%" class="font16" id="text-indent12">&nbsp;</td>
    <td class="font16" id="text-indent12"><?=$aYot[2];?></td>
  </tr>
  <tr>
    <td id="text-indent7" class="font16">&nbsp;</td>
    <td class="font16" id="text-indent25">&nbsp;</td>
    <td class="font16" id="text-indent25">(<?=$aFname[2];?>)</td>
  </tr>
  <tr>
    <td id="text-indent9" class="font16">&nbsp;</td>
    <td class="font16" id="text-indent25">&nbsp;</td>
    <td class="font16" id="text-indent15"><?=$aPost[2];?></td>
  </tr>
  <tr>
    <td id="text-indent2" class="font16">&nbsp;</td>
    <td class="font16" id="text-indent25">&nbsp;</td>
    <td class="font16" id="text-indent25"><?=$aPost2[2];?></td>
  </tr>
</table></td>
  </tr>
</table>



<div style="page-break-after:always;" ></div>


<table width="100%" border="0">
  <tr>
    <td  align="center" class="font162">บัญชีรายละเอียดการจัดหา (ซื้อ) โดยวิธีตกลงราคา</td>
  </tr>
  <tr>
    <td align="center" class="font162">ประกอบรายงาน ที่ กห 0483.63.4/<?=$cPono;?> ลง <?=$cPodate;?></td>
  </tr>
  <tr>
    <td>
    
    <table width="100%" border="1" style="border-color:#000;border-style:dashed;" cellpadding="0" cellspacing="0" class="buy" align="center">
      <tr class="font14">
        <td  width="5%" align="center" class="buy" style="border-top-style:none;">ลำดับ</td>
        <td width="40%" align="center" class="buy" style="border-top-style:none;">รายการและรายละเอียดพัสดุที่จัดซื้อ</td>
        <td width="7%" align="center" class="buy" style="border-top-style:none;">หน่วยนับ</td>
        <td width="7%" align="center" class="buy" style="border-top-style:none;">จำนวน</td>
        <td width="7%" align="center" class="buy" style="border-top-style:none;">แถม</td>
        <td  width="10%" align="center" class="buy" style="border-top-style:none;">ราคาครั้ง<br style="height:10px;">
          หลังสุด<br />
          หน่วยละ<br />
          ไม่รวม VAT</td>
        <td width="10%" align="center" class="buy" style="border-top-style:none;">ราคา<br />
          ปัจจุบัน<br />
          หน่วยละ<br />
          <span class="buy" style="border-top-style:none;">ไม่รวม VAT</span></td>
        <td width="14%" align="center" class="buy3" style="border-top-style:none;border-left-style:none; border-right-style:none;">เป็นเงิน<br /> รวม VAT</td>
      </tr>
      <tr>
        <td align="center" valign="top" class="buy" style="border-top-style:none;"><?
	for($i=1;$i<=20;$i++){
		
		
	echo $aX[$i]."<br>";	
	}
	?></td>
        <td valign="top" class="buy" style="border-top-style:none;"><?
	for($i=1;$i<=20;$i++){
	echo $aTradname[$i]."<br>";	
	}
	?></td>
        <td align="center" valign="top" class="buy" style="border-top-style:none;"><?
	for($i=1;$i<=20;$i++){
	echo $aPacking[$i]."<br>";	
	}
	?></td>
        <td align="center" valign="top" class="buy" style="border-top-style:none;"><?
	for($i=1;$i<=20;$i++){
	echo $aAmount[$i]."<br>";	
	}
	?></td>
        <td align="center" valign="top" class="buy" style="border-top-style:none;"><?
	for($i=1;$i<=20;$i++){
	echo $aFree[$i]."<br>";	
	}
	?></td>
        <td align="right" valign="top" class="buy" style="border-top-style:none;"><? 
		
	for($i=1;$i<=20;$i++){
		
		echo $aPackpri[$i]."<br>";


	}
	?></td>
        <td align="right" valign="top" class="buy" style="border-top-style:none;"><? 
		
	for($i=1;$i<=20;$i++){
		
		echo $aPackpri[$i]."<br>";


	}
	
	echo "<div align='right'>รวมเงิน</div>";
	echo "<div align='right'>ภาษี 7 %</div>";
	?></td>
        <td align="right" class="buy3" style="border-top-style:none;border-left-style:none; border-right-style:none;"><?
	for($i=1;$i<=20;$i++){
	echo $aPrice[$i]."<br>";	
	}

	echo $nNetprice."<br>";
	echo $nVat;
	?></td>
      </tr>
      <tr>
        <td class="buy4" style="border-top-style:none; border-left-style:none; border-bottom-style:none;">&nbsp;</td>
        <td align="center" class="buy4" style="border-top-style:none;border-left-style:none; border-bottom-style:none;">รวม <span class="font1">
          <?=$nItems;?>
        </span> รายการ</td>
        <td class="buy4" style="border-top-style:none; border-left-style:none; border-bottom-style:none;">&nbsp;</td>
        <td class="buy4" style="border-top-style:none; border-left-style:none; border-bottom-style:none;">&nbsp;</td>
        <td class="buy4" style="border-top-style:none; border-left-style:none; border-bottom-style:none;">&nbsp;</td>
        <td align="center" class="buy4" style="border-top-style:none;border-left-style:none; border-bottom-style:none;">&nbsp;</td>
        <td align="right" class="buy4" style="border-top-style:none;border-left-style:none; border-bottom-style:none;">รวมสุทธิ</td>
        <td align="right" style="border-top-style:none;border-left-style:none; border-right-style:none; border-bottom-style:none"><span class="buy4">
          <?=$nPriadvat;?>
        </span></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td class="font2"><strong>หมายเหตุ  -&nbsp;</strong>สป.ตามบัญชีนี้ต้องการภายใน<strong> <span class="font21">
      <?=$cBounddate;?>
    </span></strong></td>
  </tr>
  <tr>
    <td class="font2-1">- บริษัทที่จะซื้อตามที่ได้สืบราคา  <strong>
      <?=$cComname;?>
    </strong></td>
  </tr>
  <tr>
    <td class="font2-1">&nbsp;</td>
  </tr>
  <tr>
    <td><table border="0" align="center" class="sarabun21">
      <tr>
        <td colspan="2" >ตรวจถูกต้อง</td>
        </tr>
      <tr>
        <td width="98" align="right" ><?=$aYot[2];?></td>
        <td width="170" >&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2" align="center"><?=$aFname[2]?></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><?=$aPost[2];?></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><?=$aPost2[2];?></td>
      </tr>
    </table></td>
  </tr>
</table>

<div style="page-break-after:always;" ></div>

<table width="100%" border="0" class="font12">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><strong>ข้อตกลงระหว่างผู้ซื้อและผู้ขายแนบท้ายใบสั่งซื้อเป็นข้อตกลงแทนการทำสัญญาใบสั่งซื้อที่   <?=$cPono;?> ลง <?=$cPodate;?></strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td id="text-indent25">ข้อ 1. ผู้ขายรับรองว่าสิ่งของที่ขายให้ตามใบสั่งซื้อนี้มี รูปร่าง   ลักษณะ ขนาด และคุณภาพไม่ต่ำกว่าที่กำหนดไว้ ตามคุณลักษณะเฉพาะ ตามใบสั่งซื้อที่5555 ลง 01/12/2555 โดยจะต้องเป็นของใหม่ไม่เคยถูกใช้มาก่อน   ซึ่งผู้ซื้อได้สั่งซื้อตามจำนวนและราคาดังปรากฏในใบสั่งซื้อฉบับนี้</td>
  </tr>
  <tr>
    <td  id="text-indent25">ข้อ 2.  ผู้ขายรับรองว่าจะส่งมอบสิ่งของที่ซื้อขายตามใบสั่งซื้อนี้ให้แก่ผู้ซื้อ  ณ รพ.ค่ายสุรศักดิ์มนตรี วันที่ 05/12/2555 ให้ถูกต้องและครบถ้วนตามที่กำหนดไว้ในข้อ  1. แห่งใบสั่งซื้อนี้ พร้อมทั้งหีบห่อ  หรือเครื่องรัดพันผูกโดยเรียบร้อย</td>
  </tr>
  <tr>
    <td  id="text-indent25">ข้อ 3.  ในวันลงลายมือชื่อใบสั่งซื้อนี้ ผู้ขายได้นำหลักประกันเป็น.......  -.........เป็นจำนวนร้อยละสิบของราคาสิ่งของทั้งหมดคิดเป็นเงิน.....-...... บาท .(...-........) มามอบไว้แก่ผู้ซื้อเพื่อเป็นการประกันการปฏิบัติตามข้อตกลงนี้หลักประกันดังกล่าวผู้ซื้อจะคืนให้เมื่อผู้ขายพ้นจากข้อผูกพันตามข้อตกลงนี้แล้ว</td>
  </tr>
  <tr>
    <td  id="text-indent25">ข้อ 4.  ถ้าปรากฏว่าสิ่งของที่ผู้ขายส่งมอบไม่ตรงตามข้อตกลงข้อ 1. ผู้ซื้อทรงไว้ซึ่งสิทธิที่จะไม่รับของนั้น ในกรณีเช่นว่านี้ ผู้ขายต้องรีบนำสิ่งของนั้นกลับคืนโดยเร็วที่สุดที่จะทำได้  หรือต้องทำการแก้ไขให้ถูกต้องตามข้อตกลงโดยผู้ซื้อไม่ต้องใช้ค่าเสียหาย หรือค่าใช้จ่ายให้แต่ประการใด</td>
  </tr>
  <tr>
    <td  id="text-indent25">ข้อ 5.  เมื่อครบกำหนดส่งมอบสิ่งของตามข้อตกลงนี้แล้ว&nbsp;&nbsp;&nbsp;ถ้าผู้ขายไม่ส่งมอบสิ่งของซึ่งตกลงขายให้แก่ผู้ซื้อ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;หรือส่งมอบสิ่งของทั้งหมดไม่ถูกต้องหรือส่งมอบสิ่งของไม่ครบจำนวน  ผู้ซื้อมีสิทธิบอกเลิกสัญญาได้ ในกรณีเช่นนี้ ผู้ขายยอมให้ผู้ซื้อริบหลักประกัน หรือเรียกร้องจากธนาคารผู้ออก หนังสือรับรองตามข้อ 3. เป็นจำนวนเงินทั้งหมด หรือแต่บางส่วนก็ได้แล้วแต่ผู้ซื้อจะเห็นสมควร  และถ้าผู้ซื้อจัดสิ่งของจากบุคคลอื่นเต็มจำนวน หรือเฉพาะจำนวนที่ขาดส่งแล้วแต่กรณีภายในกำหนด....1....เดือนนับแต่วันที่บอกเลิกสัญญา ผู้ขายต้องยอมรับผิดชอบชดใช้ราคาที่เพิ่มขึ้นจากราคาที่กำหนด</td>
  </tr>
  <tr>
    <td  id="text-indent25">ข้อ 6. ในกรณีที่ผู้ซื้อไม่ใช้สิทธิบอกเลิกสัญญาตามข้อ 5. ผู้ขายยอมให้ผู้ซื้อปรับเป็นรายวัน ในอัตราร้อยละศูนย์จุดสอง(0.2) ของราคาสิ่งของที่ยังไม่ได้รับมอบ  นับแต่วันครบกำหนดตามข้อ 2. จนถึงวันที่ผู้ขายได้นำสิ่งของมาส่งให้แก่ผู้ซื้อจนถูกต้องครบถ้วน  และในระหว่างที่มีการปรับนั้นถ้าผู้ซื้อเห็นว่าผู้ขายไม่อาจปฏิบัติตามข้อตกลงต่อไปได้ ผู้ซื้อจะใช้สิทธิบอกเลิกสัญญาและริบหลักประกันกับเรียกร้องให้ชดใช้ราคาที่เพิ่มขึ้นตามข้อ 5. นอกเหนือ
จากการปรับจนถึงวันบอกเลิกสัญญาด้วยก็ได้
</td>
  </tr>
  <tr>
    <td  id="text-indent25">ข้อ 7. ผู้ขายยอมรับประกันความชำรุดบกพร่องหรือขัดข้องของสิ่งของตามสัญญานี้เนื่องจากการใช้งานตามปกติเป็นเวลา...1.....ปี   โดยต้องจัดการซ่อมแซม หรือแก้ไขให้ใช้การได้ดีดังเดิม และไม่คิดค่าใช้จ่ายใดๆ   ทั้งสิ้นกับผู้ซื้อ</td>
  </tr>
  <tr>
    <td  id="text-indent25">ข้อ 8. ถ้าผู้ขายไม่ปฏิบัติตาม ข้อตกลงข้อหนึ่งข้อใด ด้วยเหตุใดๆ ก็ตาม จนเป็นเหตุให้เกิดความเสียหายแก่ผู้ซื้อ แล้วผู้ขายยอมรับผิดและยินยอมชดใช้ค่าเสียหาย  อันเกิดจากการที่ผู้ขายไม่ปฏิบัติตามข้อตกลงนั้น ให้แก่ผู้ซื้อ โดยสิ้นเชิง ภายในกำหนด 30 วันนับแต่วันที่ได้รับแจ้งจากผู้ซื้อ</td>
  </tr>
  <tr>
    <td  id="text-indent"><table  border="0" align="center">
      <tr>
        <td><span class="font2">
          <?=$aYot[2];?>
        </span> ..........................................................................................</td>
        <td align="left">ผู้ซื้อโดยได้รับมอบหมายจากผู้บัญชาการทหารบก</td>
      </tr>
      <tr>
        <td align="right">..........................................................................................</td>
        <td align="left">ผู้ขาย</td>
      </tr>
      <tr>
        <td><span class="font2">
          <?=$aYot[9];?>
          ..........................................................................................</span></td>
        <td align="left">พยาน</td>
      </tr>
      <tr>
        <td><span class="font2">
          <?=$aYot[10];?>
          ..........................................................................................</span></td>
        <td align="left">พยาน</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td  id="text-indent3">คณะกรรมการตรวจรับได้พร้อมกันตรวจรับสิ่งของตามใบสั่งซื้อนี้รวม &nbsp;
<?=$nItems;?>
&nbsp;รายการ เป็นการถูกต้องและมอบให้เจ้าหน้าที่รับของไว้ใช้ราชการ โดยถูกต้องแล้ว</td>
  </tr>
  <tr>
    <td align="center"  id="text-indent8"><table  border="0">
      <tr>
        <td><span class="font2">
          <?=$aYot[6];?>
        </span> ..........................................................................................</td>
        <td><span class="font2">
          <?=$aPost[6]?>
        </span></td>
      </tr>
      <tr>
        <td><span class="font2">
          <?=$aYot[7];?>
          ..........................................................................................</span></td>
        <td><span class="font2">
          <?=$aPost[7]?>
        </span></td>
      </tr>
      <tr>
        <td><span class="font2">
          <?=$aYot[8];?>
          ..........................................................................................</span></td>
        <td><span class="font2">
          <?=$aPost[8]?>
        </span></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center"  id="text-indent10">ข้าพเจ้าได้รับสิ่งของหรืองานตามจำนวนใบสั่งซื้อฉบับนี้แล้ว เมื่อวันที่
    <?=$cBounddate;?></td>
  </tr>
  <tr>
    <td align="center"  id="text-indent11"><table  border="0">
      <tr>
        <td><span class="font2">
          <?=$aYot[6];?>
        </span> ..........................................................................................</td>
        <td><span class="font2"> ผู้รับของ </span></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><span class="font2">
          <?=$cBounddate;?>
        </span></td>
      </tr>
    </table></td>
  </tr>
</table>

<div style="page-break-after:always;" ></div>

<table width="100%" border="0" class="font162">
  <tr>
    <td colspan="2" align="right">ทบ.๑๐๑-๐๔๘</td>
  </tr>
  <tr>
    <td colspan="2" align="right" >(ย.๓๗ )</td>
  </tr>
  <tr>
    <td colspan="2" align="center" ><strong>ใบสั่งซื้อเป็นข้อตกลงแทนการทำสัญญา</strong></td>
  </tr>
  <tr>
    <td  width="53%" class="font">ใบสั่งที่ <?=$cPono;?></td>
    <td width="47%">แผนก พธ.รพ.ค่ายสุรศักดิ์มนตรี</td>
  </tr>
  <tr>
    <td class="font2-1">วันที่  <?=$cPodate;?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" class="font">ถึง <strong>
      <?=$cComname;?>
    </strong> ตามที่ท่านตกลงส่งของ ขอให้ท่านทราบและจัดการส่งของไปยัง กองคลัง พธ.รพ.ค่ายสุรศักดิ์มนตรีและปฏิบัติตามข้อตกลงด้านหลังใบสั่งฉบับนี้</td>
  </tr>
  <tr>
    <td colspan="2">
    
    <table width="100%" border="1" style="border-color:#000;border-style:dashed;" cellpadding="0" cellspacing="0" class="font14" align="center">
      <tr>
        <td  width="6%" rowspan="2" align="center" class="buy" style=";border-top-style:none">ลำดับ</td>
        <td width="34%" rowspan="2" align="center" class="buy" style=";border-top-style:none">รายการ</td>
        <td width="10%" rowspan="2" align="center" class="buy" style=";border-top-style:none">หน่วยนับ</td>
        <td width="8%" rowspan="2" align="center" class="buy" style=";border-top-style:none">จำนวน</td>
        <td width="8%" rowspan="2" align="center" class="buy" style=";border-top-style:none">แถม</td>
        <td align="center" class="buy"  width="17%" style="border-bottom-style:none;border-left-style:none;border-top-style:none;">หน่วยละ</td>
        <td align="center" class="buy3" width="17%" style="border-bottom-style:none;border-left-style:none;border-top-style:none;border-right-style:none;">เป็นเงิน</td>
        
      </tr>
      <tr>
        <td align="center" class="buy2" style="border-top-style:none;border-left-style:none;">รวม VAT</td>
        <td align="center" class="buy2" style="border-top-style:none;border-left-style:none;none;border-right-style:none;">รวม VAT</td>
        </tr>
    
      <tr>
        <td align="center" valign="top" class="buy" style="border-top-style:none;"><?
	for($i=1;$i<=20;$i++){
		
		
	echo $aX[$i]."<br>";	
	}
	?></td>
        <td valign="top" class="buy" style="border-top-style:none;"><?
	for($i=1;$i<=20;$i++){
	echo $aTradname[$i]."<br>";	
	}
	?></td>
        <td align="center" valign="top" class="buy" style="border-top-style:none;"><?
	for($i=1;$i<=20;$i++){
	echo $aPacking[$i]."<br>";	
	}
	?></td>
        <td align="center" valign="top" class="buy" style="border-top-style:none;">
        <?
	for($i=1;$i<=20;$i++){
	echo $aAmount[$i]."<br>";	
	}
	?>
        </td>
        <td align="center" valign="top" class="buy" style="border-top-style:none;"><?
	for($i=1;$i<=20;$i++){
	echo $aFree[$i]."<br>";	
	}
	?></td>
        <td align="right" valign="top" class="buy" style="border-top-style:none;">
          <? 
		
	for($i=1;$i<=20;$i++){
		
		echo $aPackpri[$i]."<br>";


	}
	
	echo "<div align='right'>รวมเงิน</div>";
	echo "<div align='right'>ภาษี 7 %</div>";
	?></td>
        <td align="right" valign="top" class="buy" style="border-top-style:none;none;border-right-style:none;">
          <?
	for($i=1;$i<=20;$i++){
	echo $aPrice[$i]."<br>";	
	}

	echo $nNetprice."<br>";
	echo $nVat;
	?>
          
        </td>
        </tr>
      
      <tr>
        <td class="buy4" style="border-top-style:none;border-left-style:none;border-bottom-style:none;">&nbsp;</td>
        <td align="center" class="buy4" style="border-top-style:none;border-bottom-style:none;border-left-style:none;">รวม  <span class="font1">
          <?=$nItems;?>
        </span> รายการ</td>
        <td class="buy4" style="border-top-style:none;border-bottom-style:none;border-left-style:none;">&nbsp;</td>
        <td class="buy4" style="border-top-style:none;border-bottom-style:none;border-left-style:none;">&nbsp;</td>
        <td class="buy4" style="border-top-style:none;border-bottom-style:none;border-left-style:none;">&nbsp;</td>
        <td align="right" class="buy4" style="border-top-style:none;border-bottom-style:none;border-left-style:none;">รวมสุทธิ
          
          
        </td>
        <td align="right" class="buy4" style="border-top-style:none;border-bottom-style:none;border-left-style:none;none;border-right-style:none;"><?=$nPriadvat;?>
          
        </td>
        </tr>
    </table>
    
    </td>
  </tr>
  <tr class="font14">
    <td colspan="2" id="text-indent15">(ตัวอักษร) <?=$cPriadvat;?></td>
  </tr>
  <tr>
    <td align="center" ><table width="100%"   border="0" cellpadding="0" cellspacing="0" class="font12">
      <tr>
        <td align="left"> <?=$aYot[2];?>
          ...................................ผู้ซื้อ ทำการโดยได้รับมอบหมายจากผู้บัญชาการทหารบก</td>
      </tr>
      <tr>
        <td align="left">....................................................ผู้ขาย&nbsp;</td>
      </tr>
    </table></td>
    <td align="center"><table border="0" align="center" class="font14">
      <tr>
        <td width="98" align="right" ><?=$aYot[2];?></td>
        <td width="170" >&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2" align="center"><?=$aFname[2]?></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><?=$aPost[2];?></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><?=$aPost2[2];?></td>
      </tr>
    </table></td>
  </tr>
</table>

<div style="page-break-after:always;" ></div>

<table width="100%" border="0" class="font15">
  <tr>
    <td colspan="3" class="font" >เรียน ผอ.รพ.ค่ายสุรศักดิ์มนตรี</td>
  </tr>
  <tr>
    <td colspan="3"  id="text-indent15">- ได้ตรวจสอบงบรายรับสถานพยาบาลแล้วมีเพียงพอให้การสนับสนุนได้ จำนวนเงิน <strong>
      <?=$nPriadvat; ?>
    </strong></td>
  </tr>
  <tr>
    <td colspan="3"  id="text-indent15"><?=$cPriadvat;?></td>
  </tr>
  <tr>
    <td colspan="3" ><table border="0" align="center" class="sarabun2">
      <tr>
        <td >
          <?=$aYot[5];?>
       </td>
        <td >&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <?=$aFname[5]?>
        </td>
      </tr>
      <tr>
        <td colspan="2" align="center">
          <?=$aPost[5];?>
        </td>
      </tr>
      <tr>
        <td colspan="2" align="center"><?=$aPost2[5];?></td>
      </tr>
      <tr>
        <td colspan="2" align="center">
          <?=$cPodate;?>
          </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" >- ให้</td>
  </tr>
  <tr>
    <td width="4%" >&nbsp;</td>
    <td width="36%" >1.<?=$aYot[6];?> 
      <?=$aFname[6]?>
</td>
    <td width="60%">
      <?=$cBe.$aPost[6]?>
</td>
  </tr>
  <tr>
    <td >&nbsp;</td>
    <td >2.<?=$aYot[7];?>
    <?=$aFname[7]?></td>
    <td>
      <?=$cBe.$aPost[7]?>
    </td>
  </tr>
  <tr>
    <td >&nbsp;</td>
    <td >3.<?=$aYot[8];?>
    <?=$aFname[8]?></td>
    <td>
      <?=$cBe.$aPost[8]." และรายงานผลให้ ทราบภายใน 5 วันทำการ";?>
    </td>
  </tr>
  <tr>
    <td >&nbsp;</td>
    <td colspan="2" >ตรวจรับพัสดุแล้วรายงานผลให้ทราบ</td>
  </tr>
  <tr>
    <td height="110" colspan="3" align="center" >
      <table border="0" align="center" class="sarabun21">
      <tr>
        <td width="20" ><?=$aYot[1];?></td>
        <td width="85" >&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;&nbsp;          <?=$aFname[1]?></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><?=$aPost[1];?></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><?=$cPrepodate;?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" class="font" >ทราบ</td>
  </tr>
  <tr>
    <td height="128" colspan="3" ><table width="70%"  border="0" align="center">
      <tr>
        <td colspan="2"><?=$aYot[6];?>........................................................................<!--<?//=$aPost[6];?>--></td>
      </tr>
      <tr>
        <td colspan="2"><?=$aYot[7];?>........................................................................<!--<?//=$aPost[7];?>--></td>
        </tr>
      <tr>
        <td colspan="2"><?=$aYot[8];?>........................................................................<!--<?//=$aPost[8];?>--></td>
        </tr>
      <tr>
        <td width="18%">&nbsp;</td>
        <td width="82%"><?=$cPrepodate;?></td>
        </tr>
    </table></td>
  </tr>
</table>

<div style="page-break-after:always;" ></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="2%">&nbsp;</td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="38%"><img src="original_Tra-Khrut.gif" width="56" height="56" /></td>
    <td width="62%" align="left" valign="bottom" class="fonth">บันทึกข้อความ</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><font class="font20b">ส่วนราชการ</font><font class="font16">............กองเภสัชกรรม    รพ.ค่ายสุรศักดิ์มนตรี.............................................................</font></td>
  </tr>
  <tr>
    <td><font class="font20b">ที่&nbsp;&nbsp;</font><font class="font16">กห 0483.63.4/<?=$cPono;?></font></td>
    <td id="text-indent12" class="font20b">วันที่ <font class="font16"><strong><?=$cBounddate;?></strong></font></td>
  </tr>
  <tr>
    <td colspan="2"><font class="font20b">เรื่อง&nbsp;&nbsp;</font><font class="font16">รายงานผลการตรวจรับพัสดุ</font></td>
  </tr>
  <tr>
    <td colspan="2" ><font class="font16">เรียน&nbsp;&nbsp; ผอ.รพ.ค่ายสุรศักดิ์มนตรี</font></td>
  </tr>
  <tr>
    <td colspan="2" ><font class="font16">อ้างถึง  &nbsp;&nbsp;</font><font class="font16" id="text-indent15">คำสั่ง ผอ.รพ.ค่ายฯ ท้ายหนังสือ กองเภสัชกรรม รพ.ค่ายฯ ที่ กห 0483.63.4/<?=$cPono;?> ลงวันที่ <?=$cPodate;?>  </font></td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent15" class="font16">เรื่อง ขออนุมัติ จัดหายา </td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent25" class="font16">ตามคำสั่งให้ 1.<?=$aYot[6];?><?=$aFname[6]?>&nbsp;&nbsp;&nbsp;&nbsp;<?=$cBe.$aPost[6]?></td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent25" class="font16" >2.<?=$aYot[7];?><?=$aFname[7]?>&nbsp;&nbsp;&nbsp;&nbsp;<?=$cBe.$aPost[7]?></td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent25" class="font16" >3.<?=$aYot[8];?><?=$aFname[8]?>&nbsp;&nbsp;&nbsp;&nbsp;<?=$cBe.$aPost[8]."และรายงานผลให้ทราบภายใน5วันทำการ";?></td>
  </tr>
  <tr>
    <td colspan="2" ><font class="font16">ได้ตรวจรับพัสดุ ณ รพ.ค่ายสุรศักดิ์มนตรี</font></td>
  </tr>
  <tr class="font16">
    <td colspan="2" >โดยมี 
      <?=$aYot[2].$aFname[2];?> 
    เป็นผู้นำชี้ และขอรายงานผลให้ทราบดังนี้</td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent25"><font class="font16">1. ชนิด,ขนาด,คุณลักษณะ  ถูกต้อง</font></td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent25"><font class="font16">2. จำนวน  <span class="font1">
      <?=$nItems;?>
    </span> รายการ</font></td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent25" class="font16">3. คุณภาพ ดี</td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent25" class="font16">4. การปรับ -</td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent35" class="font16">4.1 ส่งของเมื่อ  <font class="font16">
      <?=$cBounddate;?>
    </font>ทันเวลากำหนด</td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent25" class="font16">คณะกรรมการพิจารณาแล้ว เห็นควรรับพัสดุ ไว้ใช้ในราชการต่อไป และได้มอบพัสดุตามรายการ ให้แก่  <?=$aYot[4].$aFname[4];?> เจ้าหน้าที่เก็บรักษา/รับไปใช้ในราชการต่อไปแล้วเมื่อ  <font class="font16"><?=$cBounddate;?></font></td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent25" class="font16"></td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent25" class="font16"></td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent25" class="font16"></td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent4" class="font16"></td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent4" class="font16"></td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent25" class="font16" style="white-space:normal; word-spacing:5cm">(ลงชื่อ)<?=$aYot[6];?>&nbsp;<?=$cBe.$aPost[6]?></td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent35" class="font16" style="white-space:normal; word-spacing:5cm"><?=$aYot[7];?>&nbsp;<?=$cBe.$aPost[7]?>
    </td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent35" class="font16" style="white-space:normal; word-spacing:5cm"><?=$aYot[8];?>&nbsp;<?=$cBe.$aPost[8];?>
    </td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent35" class="font16" style="white-space:normal; word-spacing:5cm"><?=$aYot[2];?>&nbsp;ผู้นำชี้</td>
  </tr>
  <tr>
    <td colspan="2"  class="font16" style="white-space:normal; word-spacing:5cm">ได้รับของตามเรื่องนี้ไว้ถูกต้องทุกรายการและนำขึ้นบัญชีคุมไว้เรียบร้อยแล้ว</td>
  </tr>
  <tr>
    <td colspan="2"  class="font16" style="white-space:normal; word-spacing:5cm">&nbsp;</td>
  </tr>
  <tr class="font16">
    <td >&nbsp;</td>
    <td id="text-indent15"><?=$aYot[4];?></td>
  </tr>
  <tr class="font162">
    <td id="text-indent15">ทราบ</td>
    <td id="text-indent3"><?=$aFname[4];?></td>
  </tr>
  <tr class="font162">
    <td id="text-indent25"><?=$aYot[1];?></td>
    <td id="text-indent25"><?=$aPost[4];?></td>
  </tr>
  <tr class="font162">
    <td id="text-indent3"><?=$aFname[1];?></td>
    <td id="text-indent3"><?=$aPost2[4];?></td>
  </tr>
  <tr class="font162">
    <td id="text-indent23"><?=$aPost[1];?></td>
    <td>&nbsp;</td>
  </tr>
  <tr class="font162">
    <td id="text-indent23"><font class="font16">
      <?=$cBounddate;?>
    </font></td>
    <td>&nbsp;</td>
  </tr>
</table></td>
  </tr>
</table>



<div style="page-break-after:always;" ></div>

<!--<div align="right" class="font1">ทบ.๔๐๐-๐๐๖</div>
<table width="100%"border="1" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border-color:#000;" bordercolor="#000000" class="font2">
  <tr>
    <td colspan="6" align="center" class="font18" ><strong>ใบเบิก</strong></td>
    <td colspan="4">แผ่นที่..............ในจำนวน.................แผ่น</td>
  </tr>
  <tr>
    <td width="4%"  rowspan="3" align="center" valign="top">จาก</td>
    <td colspan="2" rowspan="3" valign="top" >หน่วยจ่าย  แผนกส่งกำลัง รพ. ค่ายฯ</td>
    <td colspan="3" >ที่  <?//=$cPono;?></td>
    <td colspan="4" >สายบริการเทคนิคที่ควบคุม  <span class="font162"><strong>พ</strong></span></td>
  </tr>
  <tr>
    <td colspan="3">เบิกในกรณี</td>
    <td colspan="4" >ประเภทสิ่งอุปกรณ์ <span class="font162"><strong>4</strong></span></td>
  </tr>
  <tr>
    <td width="5%"  rowspan="2" align="center" valign="middle">ชั้นต้น</td>
    <td width="8%"  rowspan="2" align="center" valign="middle">ทดแทน</td>
    <td width="6%"  rowspan="2" align="center" valign="middle">ยืม</td>
    <td colspan="4" rowspan="2" valign="bottom" >ประเภทเงิน <span class="font162"><strong>รายรับสถานพยาบาล</strong></span></td>
  </tr>
  <tr>
    <td rowspan="2" align="center" valign="top" > ถึง</td>
    <td colspan="2" rowspan="2" valign="top">หน่วยเบิก  กองเภสัชกรรม รพ. ค่ายฯ<br>
      เบิกให้
  </td>
  </tr>
  <tr>
    <td align="center" >&nbsp;</td>
    <td align="center" >&nbsp;</td>
    <td align="center" >&nbsp;</td>
    <td colspan="4">เลขที่งาน</td>
  </tr>
  <tr>
    <td align="center" valign="top" >ลำดับ</td>
    <td  align="center" valign="top">หมายเลข<br>
      สิ่งอุปกรณ์</td>
    <td width="31%"  align="center" valign="top">รายการ</td>
    <td align="center"><p>จำนวน<br>
      อนุมัติ
    </p></td>
    <td align="center">คงคลัง<br>
      ค้างรับ<br>
      ค้างจ่าย</td>
    <td align="center">หน่วยนับ</td>
    <td width="7%"  align="center" valign="middle">จำนวน<br>
    เบิก </td>
    <td width="7%"  align="center" valign="middle">ราคา<br>
    หน่วยละ</td>
    <td width="7%"  align="center" valign="middle">ราคารวม</td>
    <td width="7%"  align="center" valign="middle">จ่ายจริง</td>
  </tr>
  <tr>
    <td align="center" valign="top"><span class="buy">
      <?for($i=1;$i<=20;$i++){
		
	echo $aX[$i]."<br>";	
	}
	?>
    </span></td>
    <td  width="7%"align="center" valign="top"><span class="buy">
      <?for($i=1;$i<=20;$i++){
	echo $aDrugcode[$i]."<br>";	
	}
	?>
    </span></td>
    <td  valign="top"><span class="buy">
      <?for($i=1;$i<=20;$i++){
	echo $aTradname[$i]."<br>";	
	}
	?>
    </span></td>
    <td align="center" valign="top"><span class="buy">
      <?for($i=1;$i<=20;$i++){
	echo $aAmount[$i]."<br>";	
	}
	?>
    </span></td>
    <td align="center">&nbsp;</td>
    <td align="center" valign="top"><span class="buy">
      <?for($i=1;$i<=20;$i++){
	echo $aPacking[$i]."<br>";	
	}
	?>
    </span></td>
    <td align="center" valign="top"><span class="buy">
      <?for($i=1;$i<=20;$i++){
	echo $aAmount[$i]."<br>";	
	}
	?>
    </span></td>
    <td align="right" valign="top"><span class="buy">
      <?for($i=1;$i<=20;$i++){
		
		echo $aPackpri[$i]."<br>";
	}
	echo "<div align='right'>รวมเงิน</div>";
	echo "<div align='right'>ภาษี 7 %</div>";
	?>
    </span></td>
    <td align="right" valign="top"><span class="buy3">
      <?for($i=1;$i<=20;$i++){
	echo $aPrice[$i]."<br>";	
	}
	echo $nNetprice."<br>";
	echo $nVat;
	?>
    </span></td>
    <td align="center" valign="top"><span class="buy">
      <?for($i=1;$i<=20;$i++){
	echo $aAmount[$i]."<br>";	
	}
	?>
    </span></td>
  </tr>
  <tr>
    <td align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
    <td  valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="right" valign="top">รวมสุทธิ</td>
    <td align="right" valign="top"><span class="buy4">
      <?//=$nPriadvat;?>
    </span></td>
    <td align="center" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="10" valign="top">หลักฐานที่ใช้ในการเบิก</td>
  </tr>
  <tr>
    <td colspan="10" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="font2">
      <tr>
        <td width="46%">ตรวจสอบแล้วเห็นว่า&hellip;&hellip;เป็นสป.จัดหาจากงบรายรับ</td>
        <td width="54%"> ขอเบิกสิ่งอุปกรณ์ตามที่ระบุไว้ในช่อง  &ldquo;จำนวนเบิก&rdquo; &nbsp;&nbsp;</td>
      </tr>
      <tr>
        <td>เห็นควรพิจารณาอนุมัติ</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><?//=$aYot[4];?>          .................................&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;          <?//=$cBounddate;?></td>
        <td><?//=$aYot[2];?>
........................................................&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?//=$cBounddate;?></td>
        </tr>
      <tr>
        <td align="center">&nbsp;&nbsp;&nbsp;(ลงนาม) ผู้ตรวจสอบ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วันเดือนปี &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td align="center">&nbsp;&nbsp;&nbsp;(ลงนาม) ผู้ตรวจสอบ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วันเดือนปี &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="10" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="font2">
      <tr>
        <td width="46%"><p>อนุมัติให้จ่ายได้เฉพาะในรายการและจำนวนที่ผู้ตรวจสอบเสนอ </p></td>
        <td width="54%">ได้รับสิ่งอุปกรณ์ตามรายการและจำนวนที่แจ้งไว้ในช่อง&ldquo;จำนวนเบิก&rdquo;แล้ว</td>
      </tr>
      <tr>
        <td><?//=$aYot[1];?>
.................................&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?//=$cBounddate;?></td>
        <td><?//=$aYot[2];?>
........................................................&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?//=$cBounddate;?></td>
      </tr>
      <tr>
        <td align="center">&nbsp;&nbsp;&nbsp;(ลงนาม) ผู้ตรวจสอบ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วันเดือนปี &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td align="center">&nbsp;&nbsp;&nbsp;(ลงนาม) ผู้ตรวจสอบ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วันเดือนปี &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="10" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="font2">
      <tr>
        <td width="46%"><p>ได้จ่ายตามรายการและจำนวนที่แจ้งไว้ในช่อง&rdquo;จ่ายจริงค้างจ่าย&rdquo;แล้ว</p></td>
        <td width="54%">&nbsp;</td>
      </tr>
      <tr>
        <td><?//=$aYot[9];?>
.................................&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?//=$cBounddate;?></td>
        <td>ทะเบียนหน่วยจ่าย</td>
      </tr>
      <tr>
        <td align="center">&nbsp;&nbsp;&nbsp;(ลงนาม) ผู้สั่งจ่าย &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วันเดือนปี &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
-->
<!--<div style="page-break-after:always;" ></div>-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="2%">&nbsp;</td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="38%"><img src="original_Tra-Khrut.gif" width="56" height="56" /></td>
    <td width="62%" align="left" valign="bottom" class="fonth">บันทึกข้อความ</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><font class="font20b">ส่วนราชการ</font><font class="font16">............กองเภสัชกรรม    รพ.ค่ายสุรศักดิ์มนตรี.............................................................</font></td>
  </tr>
  <tr>
    <td><font class="font20b">ที่&nbsp;&nbsp;</font><font class="font16">กห 0483.63.4/<?=$cPono;?></font></td>
    <td id="text-indent12" class="font20b">วันที่ <font class="font16"><strong><?=$cBounddate;?></strong></font></td>
  </tr>
  <tr>
    <td colspan="2"><font class="font20b">เรื่อง&nbsp;&nbsp;</font><font class="font16">รายงานผลการจัดหาและเบิกเงิน</font></td>
  </tr>
  <tr>
    <td colspan="2" ><font class="font16">เรียน&nbsp;&nbsp; ผอ.รพ.ค่ายสุรศักดิ์มนตรี</font></td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent25" class="font162">1. ตามคำสั่ง ผอ.รพ.ค่ายฯ ให้ กองเภสัชกรรม ดำเนินการจัดหาพัสดุโดยวิธีการจัดซื้อ โดย วิธีการตกลงราคาให้กับ กองเภสัชกรรม รพ.ค่ายสุรศักดิ์มนตรี รวม  <span class="font1">
      <?=$nItems;?>
    </span> รายการ ภายในวงเงิน
<?=$nPriadvat;?> บาท 
    <?=$cPriadvat;?></td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent3" class="font162">1.1 กองเภสัชกรรม รพ.ค่ายฯ ได้ดำเนินการเรียบร้อยแล้ว</td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent3" class="font162">1.2 กรรมการตรวจรับพัสดุ ได้ทำการตรวจรับพัสดุไว้เป็นที่เรียบร้อยแล้ว เมื่อ <font class="font16"><strong>
      <?=$cBounddate;?>
    </strong></font></td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent3" class="font162">1.3 กองเภสัชกรรม รพ.ค่ายฯ ได้ให้   <span class="font16">
      <?=$aYot[4].$aFname[4];?>
    </span>เป็นผู้รับมอบพัสดุ ตามรายการ นั้นเรียบร้อยเมื่อ <font class="font16"><strong>
      <?=$cBounddate;?>
    </strong></font></td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent3" class="font162">1.4 กองเภสัชกรรม รพ.ค่ายฯ จึงขอเบิกเงินในการจัดหาพัสดุ เป็นเงิน <span class="buy4">
      <?=$nPriadvat;?>
      <?=$cPriadvat;?>
    </span>  เงินจำนวนนี้ ข้าพเจ้า แจ้งให้ผู้ขาย มารับเงินจำนวนนี้แล้ว และ พร้อมนี้ได้แนบหน้างบใบสำคัญคู่จ่ายเงิน  รพ.1 มาด้วยแล้ว</td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent3" class="font162">1.5 พัสดุที่จัดหามานี้ จะได้ให้ กองเภสัชกรรม รพ. ค่ายฯ เบิกรับไปใช้ในราชการต่อไป ภายใน
      <font class="font16"><strong>
      <?=$cBounddate;?>
    </strong></font></td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent25" class="font162">2. ข้อเสนอ</td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent3" class="font162">2.1 เพื่อกรุณาทราบผลการปฎิบัติการจัดหาพัสดุ</td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent3" class="font162">2.2 ขออนุมัติเบิกเงินจำนวน <span class="buy4">
      <?=$nPriadvat;?>
      <?=$cPriadvat;?> ให้ </span>  <strong>
      <?=$cComname;?>
      </strong>เป็นผู้รับต่อไป</td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent25" class="font162">จึงเรียนมาเพื่อกรุณาทราบ และอนุมัติสั่งจ่ายให้ต่อไปด้วย</td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent13" class="font162">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent25" class="font16"></td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent25" class="font16"></td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent25" class="font16"></td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent4" class="font16"></td>
  </tr>
  <tr>
    <td colspan="2" id="text-indent4" class="font16"></td>
  </tr>
  <tr class="font16">
    <td >&nbsp;</td>
    <td id="text-indent15"><?=$aYot[2];?></td>
  </tr>
  <tr class="font162">
    <td id="text-indent15">อนุมัติ</td>
    <td id="text-indent3"><?=$aFname[2];?></td>
  </tr>
  <tr class="font162">
    <td id="text-indent25"><?=$aYot[1];?></td>
    <td id="text-indent25"><?=$aPost[2];?></td>
  </tr>
  <tr class="font162">
    <td id="text-indent3"><?=$aFname[1];?></td>
    <td id="text-indent3"><?=$aPost2[2];?></td>
  </tr>
  <tr class="font162">
    <td id="text-indent23"><?=$aPost[1];?></td>
    <td>&nbsp;</td>
  </tr>
</table></td>
  </tr>
</table>




<div style="page-break-after:always;" ></div>

<table width="100%" border="1"  style="border-color:#000;border-style:dashed;" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="5" align="center" class="font18" style="border-right-style:none; border-bottom-style:none; border-top-style:none;border-left-style:none;">ใบขอเบิกเงินรายรับสถานพยาบาล</td>
    <td width="15%" align="right" class="font18" style="border-left-style:none; border-bottom-style:none; border-right-style:none;border-top-style:none;">ร.พ.1&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6" align="right"  class="font162" style="border-top-style:none;border-bottom-style:none;border-left-style:none; border-right-style:none"">เลขที่ผู้เบิก&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <font class="font16">
      <?=$cPono;?>
    </font></td>
  </tr>
  <tr>
    <td colspan="6" align="right" class="font162" style="border-top-style:none;border-bottom-style:none;border-left-style:none; border-right-style:none"">เลขที่ผู้จ่าย</td>
  </tr>
  <tr>
    <td colspan="6" align="right" class="font162" style="border-top-style:none;border-bottom-style:none;border-left-style:none; border-right-style:none"">ราชการสถานพยาบาล   รพ.ค่ายสุรศักดิ์มนตรี</td>
  </tr>
   <tr>
    <td colspan="6" align="right" class="font162" style="border-top-style:none;border-bottom-style:none;border-left-style:none; border-right-style:none"">ที่ทำการ กองเภสัชกรรม รพ.ค่ายสุรศักดิ์มนตรี</td>
  </tr>
   <tr>
     <td colspan="6" align="center" class="font162" style="border-top-style:none;border-bottom-style:none;border-left-style:none; border-right-style:none""><font class="font162"><strong>
       <?=$cBounddate;?>
     </strong></font></td>
  </tr>
   <tr>
     <td colspan="6" class="font162" id="text-indent25" style="border-top-style:none;border-bottom-style:none;border-left-style:none; border-right-style:none"">ข้าพเจ้า <?=$aYot[2];?><?=$aFname[2];?> ตำแหน่ง<?=$aPost[2];?> 
     ขอเบิกเงินจากฝกง. ร.พ.ค่ายสุรศักดิ์มนตรี เพื่อนำมาจ่าย ตามรายการต่อไปนี้</td>
  </tr>
  <tr>
    <td width="14%" align="center" class="font162" style="border-top-style:dashed; border-right-style:dashed; border-left-style:none; border-bottom-style:none">ลำดับ</td>
    <td width="22%" align="center" class="font162" style="border-top-style:dashed;border-right-style:dashed; border-left-style:none;border-bottom-style:none">ประเภท</td>
    <td colspan="2" align="center" class="font162" style="border-top-style:dashed;border-right-style:dashed; border-left-style:none;border-bottom-style:none">รายการ</td>
    <td width="21%" align="center" class="font162" style="border-top-style:dashed;border-right-style:dashed; border-left-style:none;border-left-style:none;border-bottom-style:none">จำนวนเงิน</td>
    <td align="center" class="font162" style="border-top-style:dashed;border-left-style:none; border-right-style:none;border-bottom-style:none">รวมเงิน</td>
  </tr>
  <tr>
    <td align="center" valign="top" class="font162" style="border-top-style:dashed;border-right-style:dashed; border-left-style:none; border-bottom-style:none"">1</td>
    <td align="center" valign="top" class="font162" style="border-top-style:dashed;border-right-style:dashed;border-bottom-style:none; border-left-style:none; border-bottom-style:none"">ยา</td>
    <td colspan="2" align="left" class="font162" style="border-top-style:dashed;border-right-style:dashed;border-bottom-style:none; border-left-style:none; border-bottom-style:none"">ค่ายา<br />
      ตามใบสั่งซื้อที่ <font class="font16"> <?=$cPono;?></font><br />
      ลง <?=$cPodate;?>
      <br />
    ภาษีมูลค่าเพิ่ม 7.00 %</td>
    <td align="right" valign="top" class="font162" style="border-top-style:dashed;border-right-style:dashed; border-left-style:none; border-bottom-style:none""><br />
      <br />
      <?=$nNetprice;?><br />
    <?=$nVat;?><br /></td>
    <td align="right" valign="top" class="font162" style="border-top-style:dashed;border-right-style:dashed; border-left-style:none; border-bottom-style:none;border-right-style:none;"><br />
    <br />
    <br />
<?=$nPriadvat;?>
<br /></td>
  </tr>
  <tr>
    <td colspan="5" align="right" valign="top" class="font162" style="border-top-style:dashed;border-bottom-style:dashed; border-right-style:none; border-left-style:none">จำนวนเงินที่ขอเบิก<br />ภาษีหัก ณ ที่จ่าย<br />จำนวนเงินที่ขอเบิกสุทธิ</td>
    <td align="right" valign="top" class="font162" style="border-top-style:dashed;border-bottom-style:dashed;border-right-style:none; border-left-style:dashed">
      <?=$nPriadvat;?><br /><?=$nTax;?><br /><?=$nNetpaid;?>
    </td>
  </tr>
  <tr>
    <td colspan="6" valign="top" class="font162" style="border-bottom-style:none; border-top-style:none;border-left-style:none; border-right-style:none">(ตัวอักษร)&nbsp;<?=$cNetpaid;?></td>
  </tr>
  <tr>
    <td colspan="6" valign="top" class="font162" style=" border-bottom-style:none;border-top-style:none;border-left-style:none;border-right-style:none">เงินที่ขอเบิกนี้โปรดสั่งจ่าย  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เช็คในนาม &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>
      <?=$cComname;?>
    </strong></td>
  </tr>
  <tr>
    <td colspan="6" valign="top" class="font162" style=" border-bottom-style:none;border-top-style:none;border-left-style:none;border-right-style:none">เงินตามใบขอเบิกเงินฉบับนี้ ข้าพเจ้าขอมอบให้ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เป็นผู้รับแทน</td>
  </tr>
  <tr>
    <td colspan="3" align="center" valign="top" class="font162" style=" border-bottom-style:none;border-top-style:none;border-left-style:none;border-right-style:none"><span class="font162" style="border-top-style:none;border-bottom-style:none;border-left-style:none; border-right-style:none">
      <?=$aYot[2];?>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ชื่อผู้เบิก</span></td>
    <td colspan="3" valign="top" class="font162" style=" border-bottom-style:none;border-top-style:none;border-left-style:none;border-right-style:none">ตำแหน่ง <span class="font162" style="border-top-style:none;border-bottom-style:none;border-left-style:none; border-right-style:none">
      <?=$aPost[2];?>
    </span></td>
  </tr>
  <tr>
    <td colspan="3" align="center" valign="top" class="font162" style=" border-bottom-style:none;border-top-style:none;border-left-style:none;border-right-style:none"><span class="font162" style="border-top-style:none;border-bottom-style:none;border-left-style:none; border-right-style:none">
      ( <?=$aFname[2];?> )&nbsp;&nbsp;&nbsp;</span></td>
    <td colspan="3" valign="top" class="font162" style=" border-bottom-style:none;border-top-style:none;border-left-style:none;border-right-style:none">วันที่ <font class="font162">
      <?=$cBounddate;?>
   </font></td>
  </tr>
  <tr>
    <td colspan="3" align="center" valign="top" class="font162" style="border-top-style:dashed; border-left-style:none; border-right-style:dashed; border-bottom-style:none">การตรวจการจ่าย</td>
    <td colspan="3" align="center" valign="top" class="font162" style="border-top-style:dashed; border-left-style:none;border-bottom-style:none; border-right-style:none">การรับเงิน</td>
  </tr>
  <tr>
    <td colspan="3" align="center" valign="top" class="font162" style="border-top-style:dashed; border-bottom-style:none; border-left-style:none;border-right-style:dashed">ตรวจรายการขอเบิกเงินถูกต้องแล้วให้จ่ายเงินได้</td>
    <td colspan="3" align="center" valign="top" class="font162" style="border-top-style:dashed;border-bottom-style:none; border-left-style:none;border-right-style:none">ได้รับเงินตามใบเบิกเงินฉบับนี้ไว้ถูกต้องแล้ว</td>
  </tr>
  <tr>
    <td colspan="3" align="center" valign="top" class="font162" style="border-top-style:dashed; border-top-style:none;border-bottom-style:none; border-left-style:none;border-right-style:dashed">&nbsp;</td>
    <td colspan="3" align="center" valign="top" class="font162" style="border-top-style:dashed;border-top-style:none;border-bottom-style:none; border-left-style:none;border-right-style:none">( ) เงินสด    ( ) เช็คเลขที่..................................</td>
  </tr>
  <tr>
    <td colspan="3" valign="top" class="font162" style="border-top-style:dashed;border-top-style:none;border-bottom-style:none; border-left-style:none;border-right-style:dashed">จำนวนเงิน
    <?=$nNetpaid;?> บาท</td>
    <td colspan="3" valign="top" class="font162" style="border-top-style:dashed;border-top-style:none;border-bottom-style:none; border-left-style:none;border-right-style:none">จำนวนเงิน <?=$nNetpaid;?>
 บาท</td>
  </tr>
  <tr>
    <td colspan="3" valign="top" class="font162" style="border-top-style:dashed;border-bottom-style:none;border-top-style:none;border-right-style:dashed;border-left-style:none;"><span class="font14">ตัวอักษร</span><span class="font12">      
      <?=$cNetpaid;?>
    </span></td>
    <td colspan="3" valign="top" class="font162" style="border-top-style:dashed;border-bottom-style:none;border-top-style:none; border-left-style:none;border-right-style:none"><span class="font14">ตัวอักษร</span><span class="font12"> <?=$cNetpaid;?>
    </span></td>
  </tr>
  <tr>
    <td colspan="3" align="center" valign="top" class="font162" style="border-top-style:dashed;border-left-style:none;border-bottom-style:none;border-right-style:dashed">&nbsp;</td>
    <td colspan="3" align="center" valign="top" class="font162" style="border-top-style:dashed;border-right-style:none;border-bottom-style:none; border-left-style:none;">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="center" valign="top" class="font162"  id="text-indent15" style=" white-space:normal; word-spacing:2cm;border-left-style:none;border-bottom-style:none;border-right-style:dashed; border-top-style:none;"><?=$aYot[11];?>&nbsp;&nbsp;ผู้ตรวจ</td>
    <td colspan="3" align="center" valign="top" class="font162" style="border-right-style:none;border-bottom-style:none; border-left-style:none;border-top-style:none">ชื่อผู้รับเงิน...............................................</td>
  </tr>
  <tr>
    <td colspan="3" align="center" valign="top" class="font162" style="border-left-style:none;border-bottom-style:none;border-right-style:dashed; border-top-style:none">(<?=$aFname[11];?>)</td>
    <td colspan="3" align="center" valign="top" class="font162" style="border-left-style:none;border-bottom-style:none;border-right-style:dashed; border-top-style:none;border-right-style:none">(..............................................)</td>
  </tr>
  <tr>
    <td colspan="3" align="center" valign="top" class="font162" style="border-left-style:none;border-bottom-style:none;border-right-style:dashed; border-top-style:none"><?=$aPost[11];?></td>
    <td colspan="3" align="center" valign="top" class="font162" style="border-left-style:none;border-bottom-style:none;border-right-style:dashed; border-top-style:none;border-right-style:none">..............................................</td>
  </tr>
  <tr>
    <td colspan="3" align="center" valign="top" class="font162"style="border-left-style:none;border-bottom-style:none;border-right-style:dashed; border-top-style:none">............/............/............</td>
    <td colspan="3" align="center" valign="top" class="font162" style="border-left-style:none;border-bottom-style:none;border-right-style:dashed; border-top-style:none;border-right-style:none">............/............/............</td>
  </tr>
  <tr>
    <td colspan="3" align="center" valign="top" class="font162" style="border-top-style:dashed; border-bottom-style:none; border-left-style:none;border-right-style:dashed">&nbsp;</td>
    <td colspan="3" align="center" valign="top" class="font162" style="border-top-style:dashed; border-bottom-style:none; border-left-style:none;border-right-style:dashed;border-right-style:none">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="center" valign="top" class="font162" style="border-left-style:none;border-bottom-style:none;border-right-style:dashed; border-top-style:none;">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <?=$aYot[1];?>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ผู้มีอำนาจสั่งจ่ายเงิน</td>
    <td colspan="3" valign="top" class="font162" style="border-left-style:none;border-bottom-style:none;border-right-style:dashed; border-top-style:none;border-right-style:none">ชื่อผู้จ่ายเงิน 
      <?=$aYot[11];?></td>
  </tr>
  <tr>
    <td colspan="3" align="center" valign="top" class="font162" style="border-left-style:none;border-bottom-style:none;border-right-style:dashed; border-top-style:none">(
        <?=$aFname[1];?>
    )</td>
    <td colspan="3" align="center" valign="top" class="font162" style="border-left-style:none;border-bottom-style:none;border-right-style:dashed; border-top-style:none;border-right-style:none">( <?=$aFname[11];?>)</td>
  </tr>
  <tr>
    <td colspan="3" align="center" valign="top" class="font162" style="border-left-style:none;border-bottom-style:none;border-right-style:dashed; border-top-style:none">
      <?=$aPost[1];?>
  </td>
    <td colspan="3" align="center" valign="top" class="font162" style="border-left-style:none;border-bottom-style:none;border-right-style:dashed; border-top-style:none;border-right-style:none"><?=$aPost[11];?>
    </td>
  </tr>
  <tr>
    <td colspan="3" align="center" valign="top" class="font162" style="border-left-style:none;border-bottom-style:none;border-right-style:dashed; border-top-style:none">............/............/............</td>
    <td colspan="3" align="center" valign="top" class="font162" style="border-left-style:none;border-bottom-style:none;border-right-style:dashed; border-top-style:none;border-right-style:none">............/............/............</td>
  </tr>

</table>

</body>
</html>