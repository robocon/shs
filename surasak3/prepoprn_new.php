<?php
include 'bootstrap.php';

$vat_type = $_GET['vat'];
$type = $_GET['type'];
if( $type === 'drug' ){
	$type_txt = 'ยา';
}else if( $type === 'supply' ){
	$type_txt = 'เวชภัณฑ์';
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PO 3 ใบ - <?=$type_txt;?>รวมVAT<?=( $vat_type == 'after' ? 'หลัง' : 'ก่อน' );?></title>
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

.page1 div{
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
$nVat = vat($nVat); //use function vat

if ( $vat_type === 'after' ) {
	$nPriadvat = $nNetprice;
	$nPriadvat = $nVat + $nNetprice;

}else if( $vat_type === 'before' ){
	$nNetprice1 = $nNetprice-$nVat;
	$nPriadvat = $nNetprice;
	$nNetprice -= $nVat;

}

$cPriadvat = baht($nPriadvat);//ตัวอักษร

//format 2 decimal
$nVat=number_format($nVat,2,'.',',');
$nPriadvat=number_format($nPriadvat,2,'.',',');
$nNetprice=number_format($nNetprice,2,'.',',');

          
///// po31.php///
?>
<div class="clearfix">
<!-- default width 22cm -->
<!-- default height 28cm -->

<!--[if IE]>
		<div class="page1 ie7" style="">
<![endif]-->
<!--[if !IE]><!-->
		<div class="page1" style="position: relative; width: 20.8cm; height: 27cm;">
<!--<![endif]-->

<?php

print "<DIV style='left:88PX;top:110PX;width:697PX;height:30PX;'><span class='fc1-5'>ส่วนราชการ&nbsp;&nbsp;กองเภสัชกรรม&nbsp;&nbsp;&nbsp;&nbsp;รพ.ค่ายสุรศักดิ์มนตรี</span></DIV>";
print "<DIV style='left:329PX;top:49PX;width:155PX;height:34PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>บันทึกข้อความ</span></DIV>";
print "<DIV style='left:88PX;top:139PX;width:333PX;height:30PX;'><span class='fc1-5'>ที่ กห 0483.63.4/$cPrepono</span></DIV>";
print "<DIV style='left:402PX;top:110PX;width:257PX;height:30PX;'><span class='fc1-5'>$cPrepodate</span></DIV>";
print "<DIV style='z-index:15;left:88PX;top:27PX;width:73PX;height:80PX;'>
	<img  WIDTH=73 HEIGHT=80 SRC='bird.jpg'>
</DIV>";
print "<DIV style='left:88PX;top:169PX;width:36PX;height:30PX;'><span class='fc1-5'>เรื่อง</span></DIV>";
print "<DIV style='left:88PX;top:198PX;width:36PX;height:30PX;'><span class='fc1-5'>เรียน</span></DIV>";
print "<DIV style='left:138PX;top:198PX;width:283PX;height:30PX;'><span class='fc1-5'>ผอ.รพ.ค่ายสุรศักดิ์มนตรี</span></DIV>";

print "<DIV style='left:138PX;top:169PX;width:647PX;height:30PX;'><span class='fc1-5'>ขออนุมัติจัดหา".$type_txt."</span></DIV>";

print "<DIV style='left:167PX;top:263PX;width:617PX;height:30PX;'><span class='fc1-5'>กองเภสัชกรรม รพ.ค่ายฯ ขออนุมัติจัดหา".$type_txt." เพื่อใช้ในการรักษาพยาบาลผู้ป่วยเจ็บที่เข้ามา</span></DIV>";
print "<DIV style='left:88PX;top:292PX;width:696PX;height:30PX;'><span class='fc1-5'>รับการรักษาพยาบาลใน รพ.ค่ายสุรศักดิ์มนตรี จำนวน $nItems รายการ การจัดหาครั้งนี้เป็นการจัดหาทดแทน</span></DIV>";
print "<DIV style='left:88PX;top:321PX;width:696PX;height:30PX;'><span class='fc1-5'>ของในสต๊อกที่ใกล้จะหมดลง ดังมีรายการตามสิ่งที่ส่งมาด้วยแล้ว</span></DIV>";
/// ส่วนเนื้อเรื่อง ////


print "<DIV style='left:167PX;top:350PX;width:317PX;height:30PX;'><span class='fc1-5'>จึงเรียนมาเพื่อกรุณาพิจารณา</span></DIV>";
print "<DIV style='left:398PX;top:393PX;width:87PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-5'>$aYot[2]</span></DIV>";
print "<DIV style='left:413PX;top:422PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>($aFname[2])</span></DIV>";
print "<DIV style='left:413PX;top:451PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>$aPost[2] $aPost2[2]</span></DIV>";

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




<!-- เริ่มหน้าสอง -->
<div class="clearfix">
	<!--[if IE]>
		<div class="page2 ie7" style="">
	<![endif]-->
	<!--[if !IE]><!-->
		<div class="page2" style="position: relative; width: 20.8cm; height: 27cm;">
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

	// จำนวนบรรทัดปกติที่แสดงต่อ1หน้ากระดาษ
	$line_in_page = 30;
	$set_new_page = false;

	// จำนวนบรรทัดที่จะตัดขึ้นหน้าใหม่
	$line_cutoff = 24;

	// ถ้าข้อมูลเยอะกว่าจำนวนที่กำหนด
	if( $po_page2_rows >= $line_cutoff ){
		$set_new_page = true;
	}

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

	<div style="position: relative;">
		<div style='height:30PX;' align="center"><span class='fc1-1'>บัญชีรายการ<?=$type_txt;?>ที่ขออนุมัติจัดซื้อ </span></div>
		<div style='height:26PX;' class='fc1-0' align="center">
			<span>ตามรายงานกองเภสัชกรรม รพ.ค่ายสุรศักดิ์มนตรี ที่ กห 0483.63.4/</span>
			<span style="padding: 0 10px; border-bottom: 1px dashed #000000;"><?=$cPrepono;?></span>
			ลง วันที่
			<span style="padding: 0 10px; border-bottom: 1px dashed #000000;"><?=$cPrepodate;?></span>
		</div>
	</div>

	<div style="position: relative; font-family: TH SarabunPSK; font-size: 13pt;">

		<table class="dx_tb" style="width: 745px;">
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

			// ถ้ารายการมีน้อยให้เพิ่มช่องว่าง
			if( $po_page2_rows < 18 ){
				
				// สร้างช่องว่าง
				$empty_line = 18 - $po_page2_rows;
				for($s = 1; $s < $empty_line; $s++ ){
				?>
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
				}
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
				<td>รวม <span style="padding: 0 20px; border-bottom: 1px dashed #000000;"><?=$nItems;?></span> รายการ</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td style="border-bottom: 1px solid #000;">รวมสุทธิ</td>
				<td style="border-bottom: 1px solid #000;" align="right"><b><?=$nPriadvat;?></b></td>
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
		
		</table>

	</div>
	<?php
	if ( $set_new_page === true ) {
		?>
		</div>
		</div>
		<div class="clearfix">
		<!--[if IE]>
			<div class="page2 ie7" style="">
		<![endif]-->
		<!--[if !IE]><!-->
			<div class="page2" style="position: relative; width: 20.8cm; height: 27cm;">
		<!--<![endif]-->
		<?php
	}
	?>
	<div style="position: relative;">
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
		<?php
		//  ช่องเซ็น 740
		print"<DIV style='height:27PX; padding-right: 300px;' align='right'><span class='fc1-0'>ตรวจถูกต้อง</span></DIV>";
		print"<DIV style='height:30PX; padding-right: 250px;' align='right'><span class='fc1-0'>$aYot[2]</span></DIV>";
		print"<DIV style='height:30PX; padding-right: 150px;' align='right'><span class='fc1-0'>($aFname[2])</span></DIV>";

		//ตำแหน่ง
		print"<DIV style='height:30PX; padding-right: 100px;' align='right'><span class='fc1-0'>$aPost[2] $aPost2[2]</span></DIV>";

		?>
	</div>

</div> <!-- Close class page2 -->
</div> <!-- Close Clearfix -->


<div class="clearfix">
	<!--[if IE]>
		<div class="page3 ie7" style="">
	<![endif]-->
	<!--[if !IE]><!-->
		<div class="page3" style="position: relative; width: 20.8cm; height: 27cm;">
	<!--<![endif]-->
<?php
////po33.php

?>
<div style="position: relative;">
	<div class="fc1-1" style="width: 100%; text-align: center;">ใบสั่งซื้อยาและเวชภัณฑ์สิ้นเปลือง</div>
	<div class="fc1-2" style="width: 100%; text-align: center;">โรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง</div>
	<div class="fc1-3" style="width: 100%; text-align: center;">มทบ.32 <span class="fc1-0" style="float: right; padding-right: 47px;">งบรายรับ</span></div>
	<div class="fc1-0" style="width: 100%; text-align: center; margin-bottom: 10px;">เลขที่ <span style="padding: 0 20px; border-bottom: 1px dashed #000000;">กห 0483.63.4/<?=$cPrepono;?></span> วันที่ <span style="padding: 0 20px; border-bottom: 1px dashed #000000;"><?=$cPrepodate;?></span></div>
	<div class="fc1-0" style="width: 100%; text-align: center; margin-bottom: 10px;">ขอสั่งซื้อของจาก <span style="padding: 0 20px; border-bottom: 1px dashed #000000;"><?='('.$cComcode.')'.$cComname.'&nbsp;&nbsp;&nbsp;'.$fax;?></span> ดังมีรายการต่อไปนี้</div>
</div>
<div style="position: relative; font-family: TH SarabunPSK; font-size: 13pt;">
	<table class="dx_tb" style="width: 745px;">
		<tr>
			<th style="width:38px;">ลำดับ</th>
			<th style="width:258px;">รายการ</th>
			<th style="width:51px;">หน่วยนับ</th>
			<th style="width:75px;">ขนาดบรรจุ</th>
			<th style="width:43px;">จำนวน</th>
			<th style="width:75px;">หน่วยละ<br>รวม VAT</th>
			<th style="width:75px;">ราคา<br>รวม VAT</th>
			<th style="width:75px;" class="last_child">spec.</th>
		</tr>
		<?php
		$p3_top += 43;
		$line_count = 1;
		for ($iz=1; $iz <= $po_page2_rows; $iz++) { 
			?>
			<tr>
				<td align="center"><?=$aX[$iz];?></td>
				<td><?=$aTradname[$iz];?></td>
				<td><?=$aPacking[$iz];?></td>
				<td align="center"><?=$aPack[$iz];?></td>
				<td align="right"><?=$aAmount[$iz];?></td>
				<td align="right"><?=$aPackpri[$iz];?></td>
				<td align="right"><?=$aPrice[$iz];?></td>
				<td class="last_child" align="center"><?=$aSpecno[$iz];?></td>
			</tr>
			<?php
			$line_count++;
			$p3_top += 22;
		}

		// ถ้ารายการมีน้อยให้เพิ่มช่องว่าง
		if( $po_page2_rows < 22 ){

			// สร้างช่องว่าง
			$empty_line = 22 - $po_page2_rows;
			for($s = 1; $s < $empty_line; $s++ ){
			?>
			<tr>
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
			}
		}

		?>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td style="border-bottom: 1px solid #000;">รวมเงิน</td>
			<td align="right" style="border-bottom: 1px solid #000;"><?=$nNetprice;?></td>
			<td class="last_child">&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td style="border-bottom: 1px solid #000;">ภาษี 7.00 %</td>
			<td align="right" style="border-bottom: 1px solid #000;"><?=$nVat;?></td>
			<td class="last_child">&nbsp;</td>
		</tr>
		<tr style="border-top: 1px solid #000000;">
			<td>&nbsp;</td>
			<td>รวม <span style="padding: 0 20px; border-bottom: 1px dashed #000000;"><?=$nItems;?></span> รายการ</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td style="border-bottom: 1px solid #000;">รวมสุทธิ</td>
			<td align="right" style="border-bottom: 1px solid #000;"><b><?=$nPriadvat;?></b></td>
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
			<td class="last_child">&nbsp;</td>
		</tr>
	</table>
</div>
<?php
if ( $set_new_page === true ) {
	?>
	</div>
	</div>
	<div class="clearfix">
	<!--[if IE]>
		<div class="page3 ie7" style="">
	<![endif]-->
	<!--[if !IE]><!-->
		<div class="page3" style="position: relative; width: 20.8cm; height: 27cm;">
	<!--<![endif]-->
	<?php
}

?>
<div style="position: relative; margin-top: 1em;" class="clearfix">
	<div style="float: left; width: 49.5%; position:relative;">
		<div class="fc1-0" style="text-align: right; border: 1px dashed #000000; width: 50%; padding: 5px; margin-left: 20px;">
			ขอเอกสารใบส่งของ 7 ชุด<br>
			ใบกำกับภาษี 1 ชุด
		</div>
		<div class="fc1-0" style="text-align: center; width: 50%;">
			ได้รับใบสั่งซื้อไปแล้ว<br>
			................................................<br>
			(................................................)<br>
			บริษัท&nbsp;.....................................................
		</div>
	</div>
	<div style="float: right; width: 49.5%; position:relative;">
		<div class="fc1-0" style="margin-bottom: 20px;">
			ส่งของภายใน 15 วัน นับจากวันที่ที่ลงในใบสั่งซื้อ<br>
			ถ้าไม่สามารถส่งของได้ตามกำหนด ให้ติดต่อกลับภายใน 5 วัน<br>
			โทรศัพท์ 054-839305 ต่อ 1163    FAX. 054-839314<br>
		</div>
		<div class="fc1-5" style="width: 80%; text-align: center;">
			<?=$aYot[2];?>&nbsp;................................................<br>
			(<?=$aFname[2];?>)<br>
			<?=$aPost[2];?><br>
			<?=$aPost2[2];?>
		</div>
	</div>
	<div class="f1" style="float: left; width: 100%; margin-top: 1em;"><u>หมายเหตุ : ให้ลงวันที่ในใบส่งของและใบเสร็จรับเงิน หลังวันที่ใน PO ยกเว้นวันเสาร์ - อาทิตย์</u></div>
</div>
<!-- End page3 -->

</div>
</div>

</body>
</html>