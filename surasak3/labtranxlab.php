<?php
session_start();
session_unregister("list_bill");
session_register("list_bill");
$_SESSION["list_bill"] = "";;
//require('thaipdfclass.php');
//$pdf=new ThaiPDF();

	if (isset($sIdname)){} else {die;} //for security
		$Thidate = (date("Y")+543).date("-m-d H:i:s"); 
		$Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
		$item=0;
	
	for ($n=1; $n<=$x; $n++){
		If (!empty($aDgcode[$n])){
			$item++;
		}
	}

 include("connect.inc");

$query = "INSERT INTO depart(chktranx,date,ptname,hn,an,doctor,depart,item,detail,price,sumyprice,sumnprice,paid, idname,diag,accno,tvn,ptright)VALUES('$nRunno','$Thidate','$cPtname','$cHn','$cAn','$cDoctor','$cDepart','$item','$aDetail',
                    '$Netprice','$aSumYprice','$aSumNprice','','$sOfficer','$cDiag','$cAccno','$tvn','$cPtright');";

       $result = mysql_query($query) or die("**เตือน ! เมื่อพบหน้าต่างนี้แสดงว่าได้บันทึกข้อมูลไปก่อนแล้ว หรือการบันทึกล้มเหลว<br>*โปรดตรวจสอบว่ามีรายการในเมนู [ดูการจ่ายเงิน] หรือไม่<br>*ถ้ามีแสดงว่า ได้บันทึกไปก่อนแล้ว<br>*ถ้าไม่มีแสดงว่า  การบันทึกล้มเหลว<br><br>
                -------- รายการ ---------<br> $Thaidate<br>$cPtname HN:$cHn AN:$cAn VN:$tvn<br> สิทธิ: $cPtright<br>
                โรค:$cDiag<br>
                แพทย์:$cDoctor<br>
                $aDetail<br>
               จำนวน $item รายการ<br>
               ราคารวม $Netprice บาท<br>
               จนท. $sOfficer<br>");

//test 9/4/47 to find the last row
//printf ("Last inserted record has id %d\n",mysql_insert_id());
  $idno=mysql_insert_id();
//print "<br>$idno <br>";
//test 9/4/47 to find the last row

//insert data into patdata
    for ($n=1; $n<=$x; $n++){
         If (!empty($aDgcode[$n])){
                $query = "INSERT INTO patdata(date,hn,an,ptname,doctor,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright)
                                 VALUES('$Thidate','$cHn','$cAn','$cPtname','$cDoctor','$item','$aDgcode[$n]','$aTrade[$n]','$aAmount[$n]',
                                 '$aMoney[$n]','$aYprice[$n]','$aNprice[$n]','$cDepart','$aPart[$n]','$idno','$cPtright');";
                $result = mysql_query($query) or die("Query failed,cannot insert into patdata");
        }
        }

// in case of inpatient insert data into ipacc
IF (!empty($cAn)) {
     for ($n=1; $n<=$x; $n++){
          If (!empty($aDgcode[$n])){
                   $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,
                                    idname,part,accno,idno)VALUES('$Thidate','$cAn','$aDgcode[$n]','$cDepart','$aTrade[$n]',
                                    '$aAmount[$n]','$aMoney[$n]','$sOfficer','$aPart[$n]','$cAccno','$idno');";
                   $result = mysql_query($query) or die("Query failed,cannot insert into ipacc");
        }
   }
}
//update data in opday 
	if ($cDepart == 'XRAY'){
			    $xraypri=$Netprice;
	            }
	else {
					    $xraypri=0;
	         }
	if ($cDepart =='PATHO'){
			    $pathopri=$Netprice;
	            }
	else {
					    $pathopri=0;
	         }
	if ($cDepart =='EMER'){
			    $emerpri=$Netprice;
	            }
	else {
					    $emerpri=0;
	         }
	if ($cDepart =='SURG'){
			    $surgpri=$Netprice;
	            }
	else {
					    $surgpri=0;
	         }
	if ($cDepart =='PHYSI'){
			    $physipri=$Netprice;
	            }
	else {
					    $physipri=0;
	         }
	if ($cDepart =='DENTA'){
			    $dentapri=$Netprice;
	            }
	else {
					    $dentapri=0;
	         }
	if ($cDepart =='OTHER'){
			    $otherpri=$Netprice;
	            }
	else {
					    $otherpri=0;
	         }

		$Thdhn=date("d-m-").(date("Y")+543).$cHn;
        $query ="UPDATE opday SET   xray= xray+$xraypri,
																patho=patho+$pathopri,
																emer=emer+$emerpri,
																surg=surg+$surgpri,
																physi=physi+$physipri,
																denta=denta+$dentapri,
																other=other+$otherpri
					   WHERE thdatehn= '$Thdhn' AND  vn = '".$tvn."' ";
$result = mysql_query($query) or die("Query failed,update opday");
include("unconnect.inc");



	$_SESSION["list_bill"] .= "ใบแจ้งหนี้<br>";
	$_SESSION["list_bill"] .="$cPtname HN:$cHn VN:$tvn  สิทธิ: $cPtright<br>";
	//    print "สิทธิ: $cPtright<br>";
	$_SESSION["list_bill"] .= "โรค:$cDiag แพทย์:$cDoctor<br>";
	//    print "แพทย์:$cDoctor<br>";

	$no=0;
	for ($n=1; $n<=$x; $n++){
	If (!empty($aDgcode[$n])){
	$no++;

	$_SESSION["list_bill"] .= "   $no.";
	$_SESSION["list_bill"] .= "   $aTrade[$n]";
	$_SESSION["list_bill"] .= "   จำนวน : $aAmount[$n]";
	$_SESSION["list_bill"] .= "   ราคา : $aMoney[$n]";
	$_SESSION["list_bill"] .= "   เบิกไม่ได้ : $aNprice[$n]<br>";

	}
	} ;
	//$_SESSION["list_bill"] .=  "</table>";
	$_SESSION["list_bill"] .=  "ราคารวม $Netprice บาท <br>";
	if ($aSumNprice>0){
	$_SESSION["list_bill"] .= "(เบิกไม่ได้ $aSumNprice บาท )<br>";
	}
	$_SESSION["list_bill"] .=  "จนท. $sOfficer";  
	$_SESSION["list_bill"] .=  "  $Thaidate<br>";
	$_SESSION["list_bill"] .=  "***************************************************<br>";  
	$_SESSION["list_bill"] .=  "นำใบแจ้งหนี้ไปชำระเงินที่ห้องเก็บเงิน";  

?> 
<A HREF="labtranxlab2.php">พิมพ์แจ้งหนี้</A>