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

       $result = mysql_query($query) or die("**��͹ ! ����;�˹�ҵ�ҧ����ʴ������ѹ�֡������仡�͹���� ���͡�úѹ�֡�������<br>*�ô��Ǩ�ͺ�������¡������� [�١�è����Թ] �������<br>*������ʴ���� ��ѹ�֡仡�͹����<br>*���������ʴ����  ��úѹ�֡�������<br><br>
                -------- ��¡�� ---------<br> $Thaidate<br>$cPtname HN:$cHn AN:$cAn VN:$tvn<br> �Է��: $cPtright<br>
                �ä:$cDiag<br>
                ᾷ��:$cDoctor<br>
                $aDetail<br>
               �ӹǹ $item ��¡��<br>
               �Ҥ���� $Netprice �ҷ<br>
               ���. $sOfficer<br>");

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



	$_SESSION["list_bill"] .= "���˹��<br>";
	$_SESSION["list_bill"] .="$cPtname HN:$cHn VN:$tvn  �Է��: $cPtright<br>";
	//    print "�Է��: $cPtright<br>";
	$_SESSION["list_bill"] .= "�ä:$cDiag ᾷ��:$cDoctor<br>";
	//    print "ᾷ��:$cDoctor<br>";

	$no=0;
	for ($n=1; $n<=$x; $n++){
	If (!empty($aDgcode[$n])){
	$no++;

	$_SESSION["list_bill"] .= "   $no.";
	$_SESSION["list_bill"] .= "   $aTrade[$n]";
	$_SESSION["list_bill"] .= "   �ӹǹ : $aAmount[$n]";
	$_SESSION["list_bill"] .= "   �Ҥ� : $aMoney[$n]";
	$_SESSION["list_bill"] .= "   �ԡ����� : $aNprice[$n]<br>";

	}
	} ;
	//$_SESSION["list_bill"] .=  "</table>";
	$_SESSION["list_bill"] .=  "�Ҥ���� $Netprice �ҷ <br>";
	if ($aSumNprice>0){
	$_SESSION["list_bill"] .= "(�ԡ����� $aSumNprice �ҷ )<br>";
	}
	$_SESSION["list_bill"] .=  "���. $sOfficer";  
	$_SESSION["list_bill"] .=  "  $Thaidate<br>";
	$_SESSION["list_bill"] .=  "***************************************************<br>";  
	$_SESSION["list_bill"] .=  "�����˹��仪����Թ�����ͧ���Թ";  

?> 
<A HREF="labtranxlab2.php">�������˹��</A>