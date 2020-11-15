<?php
//พิมพ์ใบสั่งซื้อชั่วคราว
session_start();

//echo $sOfficer;

if(isset($_GET["save"]) && $_GET["save"] == true){

	if (isset($sIdname)){} else {die;} 
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
    $nNetprice =array_sum($aPrice_vat);   

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

print"<DIV style='left:194PX;top:090PX;width:364PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-1'>ใบสั่งซื้อยาและเวชภัณฑ์สิ้นเปลือง</span></DIV>";
print"<DIV style='left:194PX;top:120PX;width:364PX;height:41PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>โรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง</span></DIV>";
print"<DIV style='left:194PX;top:163PX;width:364PX;height:34PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>มทบ.32</span></DIV>";
print"<DIV style='left:684PX;top:167PX;width:61PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>งบรายรับ</span></DIV>";
print"<DIV style='left:518PX;top:195PX;width:105PX;height:26PX;'><span class='fc1-0'>$cPrepodate</span></DIV>";
print"<DIV style='left:310PX;top:195PX;width:159PX;height:26PX;'><span class='fc1-0'>$cPrepono</span></DIV>";
print"<DIV style='left:281PX;top:195PX;width:30PX;height:26PX;'><span class='fc1-0'>เลขที่ </span></DIV>";
print"<DIV style='left:490PX;top:195PX;width:100PX;height:26PX;'><span class='fc1-0'>วันที่ $d/$m/$yr </span></DIV>";
print"<DIV style='left:315PX;top:195PX;width:150PX;height:26PX;'><span class='fc1-0'>กห 0483.63.4 /
	".$_SESSION['ponumber']."</span></DIV>";
print"<DIV style='left:187PX;top:222PX;width:397PX;height:26PX;'><span class='fc1-0'>
	($cComcode)$cComname&nbsp;&nbsp;&nbsp;$fax</span></DIV>";
print"<DIV style='left:97PX;top:222PX;width:91PX;height:26PX;'><span class='fc1-0'>ขอสั่งซื้อของจาก </span></DIV>";
	
print"<DIV style='left:586PX;top:222PX;width:104PX;height:26PX;'><span class='fc1-0'>ดังมีรายการต่อไปนี้</span></DIV>";
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
<div style="position: absolute; top: 253px; font-family: TH SarabunPSK; font-size: 13pt;">
	<table class="dx_tb">
		<thead>
			<tr>
				<th style="width:38px;">ลำดับ</th>
				<th style="width:258px;">รายการ</th>
				<th style="width:51px;">หน่วยนับ</th>
				<th style="width:75px;">ขนาดบรรจุ</th>
				<th style="width:43px;">จำนวน</th>
				<th style="width:75px;">หน่วยละ<br />
			    รวม VAT</th>
			  <th style="width:75px;">ราคา<br />
		      รวม VAT</th>
			  <th  style="width:75px;" class="last_child">คุณลักษณะเฉพาะ สป.<br />
สาย พ. ที่</th>
			</tr>
		</thead>
		<tbody>
			
			<?php
			//$sumtotal=0;
			for ($ii=1; $ii <= 19; $ii++) { 
				 include("connect.inc");
				$sql1="select unitpri,part,freelimit,edpri,edpri_from,snspec from druglst where drugcode='$aDgcode[$ii]'";
				//echo $sql;
				$chkquery=mysql_query($sql1);
				list($unitpri,$part,$freelimit,$edpri,$edprifrom,$snspec)=mysql_fetch_array($chkquery);				
				// ราคากลาง
				//echo "==>".$edpri;
				
				$cost = false;

				//  ถ้าเป็นอุปกรณ์ เทียบจาก อุปกรเบิกได้ไม่เกิน
				if( $part == 'DPY' OR $part == 'DPN' ){

					// ราคาอุปกรณ์เบิกได้ไม่เกิน
					if( $freelimit > 0 ){
						$cost = $freelimit;  //
						if(empty($edprifrom)){  //ถ้าแหล่งที่มาราคากลางเป็นค่าว่าง
							$from = 3;
						}else{  //ถ้าแหล่งที่มาไม่ใช่ค่าว่าง
							$from = $edprifrom;
						}
					}
				}else{
					// ราคากลางต้องมากกว่า 0
					if( $edpri > 0 ){
						$cost = $edpri;
						if(empty($edprifrom)){  //ถ้าแหล่งที่มาราคากลางเป็นค่าว่าง
							$from = 3;
						}else{  //ถ้าแหล่งที่มาไม่ใช่ค่าว่าง
							$from = $edprifrom;
						}
					}
				}

				//ถ้าไม่มีราคากลาง หรือ ราคาอุปกรณ์ให้ใช้ราคากลาง เริ่มตั้งแต่ 12/6/2561 โดยน้องเนม
				if( empty($cost) ){
					if( !empty($unitpri) ){
						$cost = $edpri;
						if(empty($edprifrom)){  //ถ้าแหล่งที่มาราคากลางเป็นค่าว่าง
							$from = 5;
						}else{  //ถ้าแหล่งที่มาไม่ใช่ค่าว่าง
							$from = $edprifrom;
						}
					}
				}
				
				$aTotalpackprice=$aAmount[$ii]*$aPackpri[$ii];
				$aTotalprice=$aAmount[$ii]*$aPackpri_vat[$ii];
				
/*				if(!empty($snspec)){
					$snspec="<br>(หมายเลขสิ่งอุปกรณ์".$snspec.")";
				}else{
					$snspec="&nbsp;";
				}	*/			
				?>
				<tr>
					<td align="center"><?=( !empty($aX[$ii]) ? $aX[$ii] : '&nbsp;' );?></td>
                    <td><? if(!empty($aTrade[$ii])){ echo $aTrade[$ii]; }else{ echo "&nbsp;";}?></td>
					<td><?=( !empty($aPacking[$ii]) ? $aPacking[$ii] : '&nbsp;' );?></td>
					<td align="center"><?=( !empty($aPack[$ii]) ? $aPack[$ii] : '&nbsp;' );?></td>
					<td align="right"><?=( !empty($aAmount[$ii]) ? $aAmount[$ii] : '&nbsp;' );?></td>
					<td align="right"><?=( !empty($aPackpri_vat[$ii]) ? $aPackpri_vat[$ii] : '&nbsp;' );?></td><!--หน่วยละรวม VAT-->
					<td align="right"><?=( !empty($aTotalprice) ? number_format($aTotalprice,2) : '&nbsp;' );?></td><!--ราคารวม VAT-->
					<td class="last_child" align="center"><?=( !empty($aSpec[$ii]) ? $aSpec[$ii] : '&nbsp;' );?></td>
				</tr>
				<?php		  
			  //$sumtotal=$sumtotal+$aTotalpackprice;	  //รวมเงิน
			}	
			//คำนวนค่าต่างๆ		
			
			  $vat1=$nTotalprice*7;		
			  //echo "$vat1=$nTotalprice*7";	 
			  $vat=	$vat1/107;	  //ภาษี
			  //echo "==>".$vat1;
			  $sumtotal=$nTotalprice-$vat;   //รวมเงิน
			  
			  
			?>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td style="border-bottom: 1px solid #000;">รวมเงิน</td>
				<td style="border-bottom: 1px solid #000;" align="right"><?=number_format($sumtotal,2);?></td>
				<td class="last_child">&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td style="border-bottom: 1px solid #000;">ภาษี 7.00 %</td>
				<td style="border-bottom: 1px solid #000;" align="right"><?=number_format($vat,2);?></td>
				<td class="last_child">&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>รวม <?=$nItems;?> รายการ</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td style="border-bottom: 1px solid #000;">รวมสุทธิ</td>
				<td style="border-bottom: 1px solid #000;" align="right"><?=$nNetprice_vat;?></td>
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
		</tbody>
	</table>
</div>    
<?
print"<DIV style='left:496PX;top:702PX;width:86PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'> </span></DIV>";
print"<DIV style='left:597PX;top:703PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'>
<span class='fc1-0'> </span></DIV>";
print"<DIV style='left:597PX;top:730PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-0'></span></DIV>";
print"<DIV style='left:496PX;top:730PX;width:86PX;height:26PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'> </span></DIV>";
print"<DIV style='left:360PX;top:816PX;width:263PX;height:27PX;'><span class='fc1-0'>ส่งของภายใน 30 วัน นับจากวันที่ที่ลงในใบสั่งซื้อ</span></DIV>";
print"<DIV style='left:76PX;top:819PX;width:128PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>ขอเอกสารใบส่งของ 7 ชุด</span></DIV>";
print"<DIV style='left:76PX;top:840PX;width:128PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>ใบกำกับภาษี 1 ชุด</span></DIV>";
print"<DIV style='left:360PX;top:836PX;width:319PX;height:27PX;'><span class='fc1-0'>ถ้าไม่สามารถส่งของได้ตามกำหนด ให้ติดต่อกลับภายใน 5 วัน</span></DIV>";
print"<DIV style='left:360PX;top:856PX;width:319PX;height:27PX;'><span class='fc1-0'>รพ.ค่ายฯ รับเฉพาะยาและเวชภัณฑ์ที่มีอายุเกิน 1 ปีเท่านั้น</span></DIV>";
print"<DIV style='left:360PX;top:876PX;width:263PX;height:27PX;'><span class='fc1-0'>โทรศัพท์ 054-839305 ต่อ 1163    FAX. 054-839314</span></DIV>";
print"<DIV style='left:10PX;top:873PX;width:209PX;height:27PX;'><span class='fc1-0'>ได้รับใบสั่งซื้อไปแล้ว</span></DIV>";
print"<DIV style='left:10PX;top:889PX;width:209PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>……………………………………...........</span></DIV>";
if($sIdname=="ภูมิพัฒน์"){
print"<DIV style='left:269PX;top:899PX;width:87PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-5'>พ.ต.</span></DIV>";
print"<DIV style='left:344PX;top:922PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>(ภูมิพัฒน์&nbsp;&nbsp;สมิทธนโชติ)</span></DIV>";
}else{
print"<DIV style='left:269PX;top:899PX;width:87PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-5'>พ.ท. หญิง</span></DIV>";
print"<DIV style='left:344PX;top:922PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>(วนิดา&nbsp;&nbsp;โล่ห์สุวรรณ)</span></DIV>";
}
print"<DIV style='left:10PX;top:925PX;width:209PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>(…………………………………….)</span></DIV>";
print"<DIV style='left:344PX;top:942PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>หัวหน้าเจ้าหน้าที่</span></DIV>";
print"<DIV style='left:10PX;top:951PX;width:209PX;height:27PX;'><span class='fc1-0'>บริษัท&nbsp;&nbsp;.....................................................</span></DIV>";
print"<DIV style='left:344PX;top:961PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>รพ.ค่ายสุรศักดิ์มนตรี</span></DIV>";
print"<DIV style='left:10PX;top:1019PX;width:479PX;height:27PX;'><span class='fc1-0'><u><b>หมายเหตุ : ให้ลงวันที่ในใบส่งของและใบเสร็จรับเงิน หลังวันที่ใน PO ยกเว้นวันเสาร์ - อาทิตย์</b></u></span></DIV>";
print"<BR>";
print"</BODY>";
print"</HTML>";


//ใบที่ 2
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

print"<DIV style='left:194PX;top:1180PX;width:364PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-1'>ใบสั่งซื้อยาและเวชภัณฑ์สิ้นเปลือง</span></DIV>";
print"<DIV style='left:194PX;top:1210PX;width:364PX;height:41PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>โรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง</span></DIV>";
print"<DIV style='left:194PX;top:1253PX;width:364PX;height:34PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>มทบ.32</span></DIV>";
print"<DIV style='left:684PX;top:1257PX;width:61PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>งบรายรับ</span></DIV>";
print"<DIV style='left:518PX;top:1285PX;width:105PX;height:26PX;'><span class='fc1-0'>$cPrepodate</span></DIV>";
print"<DIV style='left:310PX;top:1285PX;width:159PX;height:26PX;'><span class='fc1-0'>$cPrepono</span></DIV>";
print"<DIV style='left:281PX;top:1285PX;width:30PX;height:26PX;'><span class='fc1-0'>เลขที่ </span></DIV>";
print"<DIV style='left:490PX;top:1285PX;width:100PX;height:26PX;'><span class='fc1-0'>วันที่ $d/$m/$yr </span></DIV>";
print"<DIV style='left:315PX;top:1285PX;width:150PX;height:26PX;'><span class='fc1-0'>กห 0483.63.4 /
	".$_SESSION['ponumber']."</span></DIV>";
	
print"<DIV style='left:187PX;top:1312PX;width:397PX;height:26PX;'><span class='fc1-0'>
	($cComcode)$cComname&nbsp;&nbsp;&nbsp;$fax</span></DIV>";
print"<DIV style='left:97PX;top:1312PX;width:91PX;height:26PX;'><span class='fc1-0'>ขอสั่งซื้อของจาก </span></DIV>";
print"<DIV style='left:586PX;top:1312PX;width:104PX;height:26PX;'><span class='fc1-0'>ดังมีรายการต่อไปนี้</span></DIV>";
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
<div style="position: absolute; top: 1343px; font-family: TH SarabunPSK; font-size: 13pt;">
	<table class="dx_tb">
		<thead>
			<tr>
				<th style="width:38px;">ลำดับ</th>
				<th style="width:258px;">รายการ</th>
				<th style="width:51px;">หน่วยนับ</th>
				<th style="width:43px;">จำนวน</th>
				<th style="width:55px;">ราคากลาง</th>
				<th style="width:55px;">แหล่งที่มาของราคากลาง ***</th>
				<th style="width:75px;">หน่วยละ<br />
			    รวม VAT</th>
			  <th style="width:75px;">ราคา<br />
		      รวม VAT</th>
			  <th  style="width:75px;" class="last_child">คุณลักษณะเฉพาะ สป.<br />
สาย พ. ที่</th>
			</tr>
		</thead>
		<tbody>
			
			<?php
			//$sumtotal=0;
			for ($ii=1; $ii <= 19; $ii++) { 
				 include("connect.inc");
				$sql1="select unitpri,part,freelimit,edpri,edpri_from,snspec from druglst where drugcode='$aDgcode[$ii]'";
				//echo $sql;
				$chkquery=mysql_query($sql1);
				list($unitpri,$part,$freelimit,$edpri,$edprifrom,$snspec)=mysql_fetch_array($chkquery);				
				// ราคากลาง
				//echo "==>".$edpri;
				
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
						//echo "==>".$edprifrom;
						if($edprifrom==0 && $edprifrom !=""){  //ถ้าแหล่งที่มาราคากลางยังไม่มีการกำหนดค่า
							$from = 5;
						}else{  //ถ้าแหล่งที่มามีข้อมูลแล้ว
							$from = $edprifrom;
						}					
					}
				}
				
				$aTotalpackprice=$aAmount[$ii]*$aPackpri[$ii];
				$aTotalprice=$aAmount[$ii]*$aPackpri_vat[$ii];
				
/*				if(!empty($snspec)){
					$snspec="<br>(หมายเลขสิ่งอุปกรณ์".$snspec.")";
				}else{
					$snspec="&nbsp;";
				}	*/			
				?>
				<tr>
					<td align="center"><?=( !empty($aX[$ii]) ? $aX[$ii] : '&nbsp;' );?></td>
                    <td><? if(!empty($aTrade[$ii])){ echo $aTrade[$ii]; }else{ echo "&nbsp;";}?></td>
					<td><?=( !empty($aPacking[$ii]) ? $aPacking[$ii] : '&nbsp;' );?></td>
					<td align="right"><?=( !empty($aAmount[$ii]) ? $aAmount[$ii] : '&nbsp;' );?></td>
					<td align="right"><?=$cost;?></td>
					<td align="center"><?=$from;?></td>
					<td align="right"><?=( !empty($aPackpri_vat[$ii]) ? $aPackpri_vat[$ii] : '&nbsp;' );?></td><!--หน่วยละรวม VAT-->
					<td align="right"><?=( !empty($aTotalprice) ? number_format($aTotalprice,2) : '&nbsp;' );?></td><!--ราคารวม VAT-->
					<td class="last_child" align="center"><?=( !empty($aSpec[$ii]) ? $aSpec[$ii] : '&nbsp;' );?></td>
				</tr>
				<?php		  
			 // $sumtotal=$sumtotal+$aTotalpackprice;	  //รวมเงิน
			}	
			//คำนวนค่าต่างๆ				
			  $vat1=$nTotalprice*7;		
			  //echo "$vat1=$nTotalprice*7";	 
			  $vat=	$vat1/107;	  //ภาษี
			  //echo "==>".$vat1;
			  $sumtotal=$nTotalprice-$vat;   //รวมเงิน
			?>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td style="border-bottom: 1px solid #000;">รวมเงิน</td>
				<td style="border-bottom: 1px solid #000;" align="right"><?=number_format($sumtotal,2);?></td>
				<td class="last_child">&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td style="border-bottom: 1px solid #000;">ภาษี 7.00 %</td>
				<td style="border-bottom: 1px solid #000;" align="right"><?=number_format($vat,2);?></td>
				<td class="last_child">&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>รวม <?=$nItems;?> รายการ</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td style="border-bottom: 1px solid #000;">รวมสุทธิ</td>
				<td style="border-bottom: 1px solid #000;" align="right"><?=$nNetprice_vat;?></td>
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
				<td class="last_child">&nbsp;</td>
			</tr>
		</tbody>
	</table>
</div>    
<?
print"<DIV style='left:496PX;top:1792PX;width:86PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'> </span></DIV>";
print"<DIV style='left:597PX;top:1793PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'>
<span class='fc1-0'> </span></DIV>";
print"<DIV style='left:597PX;top:1820PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'>
	<span class='fc1-0'></span></DIV>";
print"<DIV style='left:496PX;top:1820PX;width:86PX;height:26PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'> </span></DIV>";
print"<DIV style='left:360PX;top:1933PX;width:263PX;height:27PX;'><span class='fc1-0'>ส่งของภายใน 15 วัน นับจากวันที่ที่ลงในใบสั่งซื้อ</span></DIV>";
print"<DIV style='left:76PX;top:1936PX;width:128PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>ขอเอกสารใบส่งของ 7 ชุด</span></DIV>";
print"<DIV style='left:76PX;top:1957PX;width:128PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>ใบกำกับภาษี 1 ชุด</span></DIV>";
print"<DIV style='left:360PX;top:1953PX;width:319PX;height:27PX;'><span class='fc1-0'>ถ้าไม่สามารถส่งของได้ตามกำหนด ให้ติดต่อกลับภายใน 5 วัน</span></DIV>";

print"<DIV style='left:360PX;top:1973PX;width:319PX;height:27PX;'><span class='fc1-0'>รพ.ค่ายฯ รับเฉพาะยาและเวชภัณฑ์ที่มีอายุเกิน 1 ปีเท่านั้น</span></DIV>";

print"<DIV style='left:360PX;top:1993PX;width:263PX;height:27PX;'><span class='fc1-0'>โทรศัพท์ 054-839305 ต่อ 1163    FAX. 054-839314</span></DIV>";
print"<DIV style='left:10PX;top:1985PX;width:209PX;height:27PX;'><span class='fc1-0'>ได้รับใบสั่งซื้อไปแล้ว</span></DIV>";
print"<DIV style='left:10PX;top:2006PX;width:209PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>……………………………………...........</span></DIV>";
if($sIdname=="ภูมิพัฒน์"){
print"<DIV style='left:269PX;top:2016PX;width:87PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-5'>พ.ต.</span></DIV>";
print"<DIV style='left:344PX;top:2039PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>(ภูมิพัฒน์&nbsp;&nbsp;สมิทธนโชติ)</span></DIV>";
}else{
print"<DIV style='left:269PX;top:2016PX;width:87PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-5'>พ.ท. หญิง</span></DIV>";
print"<DIV style='left:344PX;top:2039PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>(วนิดา&nbsp;&nbsp;โล่ห์สุวรรณ)</span></DIV>";
}
print"<DIV style='left:10PX;top:2042PX;width:209PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>(…………………………………….)</span></DIV>";
print"<DIV style='left:344PX;top:2059PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>หัวหน้าเจ้าหน้าที่</span></DIV>";
print"<DIV style='left:10PX;top:2068PX;width:209PX;height:27PX;'><span class='fc1-0'>บริษัท&nbsp;&nbsp;.....................................................</span></DIV>";
print"<DIV style='left:344PX;top:2078PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>รพ.ค่ายสุรศักดิ์มนตรี</span></DIV>";
print"<DIV style='left:10PX;top:2136PX;width:479PX;height:27PX;'><span class='fc1-0'><u><b>หมายเหตุ : ให้ลงวันที่ในใบส่งของและใบเสร็จรับเงิน หลังวันที่ใน PO ยกเว้นวันเสาร์ - อาทิตย์</b></u></span></DIV>";
print"<BR>";
print"</BODY>";
print"</HTML>";
array_pop($aTrade);
?>

