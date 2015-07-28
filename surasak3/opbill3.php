<body Onload="window.print();">
<style>
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
}
</style>
<?php
session_start();
if(isset($sIdname)){} else {die;} //for security

if($paid<>$sNetprice){
	die("จ่ายเงินไม่เท่ากับราคารวม ไม่สามารถออกใบเสร็จรับเงินได้");
}

$Thidate = (date("Y")+543).date("-m-d H:i:s"); 
$billtime=substr($Thidate,11,5);
$Thdate=date("d-m-").(date("Y")+543);
$Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
$hn_now=$_POST['aHn'];
//function baht///
function baht($nArabic){
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
   $cRead  = "**";

	include("connect.inc");
 
 	if($cLtnum <> "0"){
  		$count=0;
		for($i = 0;$i<=$nNum;$i++){
			$cNo   = Substr($cLtnum,$count,1);
			$count++;
			//อ่านหลัก
			if($cNo <>0 and $cNo != "-"){
			if($nUnit <> 1){  
	
				$query = "SELECT * FROM thaibaht WHERE fld1 = '$nUnit' ";
				$result = mysql_query($query) or die("Query 1 failed");
	
				for($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
					if(!mysql_data_seek($result, $i)) {
						echo "Cannot seek to row $i\n";
						continue;
				}
	
				if(!($row = mysql_fetch_object($result)))
					continue;
				}
	
				$cVarU = $row->fld4;  //อ่านหลัก
			}
			else{
				$cVarU = "";
			}
	
			//อ่านเลข
			$query = "SELECT * FROM thaibaht WHERE fld1 = '$cNo' ";
			$result = mysql_query($query) or die("Query 2 failed");
	
			for($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
				if(!mysql_data_seek($result, $i)) {
					echo "Cannot seek to row $i\n";
					continue;
				}
	
				if(!($row = mysql_fetch_object($result)))
					continue;
			}
	
			$cVar1 = $row->fld2; //อ่านตัวเลข
	///           
			if($nUnit =='2' && $cNo =='2'):
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
    $cRead = $cRead."สตางค์**"  ;
	}    
    else{
           $cRead = $cRead."ถ้วน**" ;
           }  
    include("connect.inc");

   return $cRead;
}
///end function baht

include("connect.inc");
	$sqlname = "select ptname from opday where hn = '".$hn_now."' and thidate like '%".substr($_SESSION['dDate'][0],0,10)."%' ";
	$rowname = mysql_query($sqlname);
	list($sPtname) = mysql_fetch_array($rowname);
	
for($r=0;$r<count($_SESSION['idnumber']);$r++){
	//insert into depart table
	$query ="UPDATE depart SET paid = price,cashok = '$credit' WHERE row_id= '".$_SESSION['idnumber'][$r]."' and hn='".$hn_now."' and tvn='".$_SESSION["sVn"]."' ";
	$result = mysql_query($query) or die("Query failed,update depart");
	
	$query ="UPDATE phardep SET paid = price,cashok = '$credit' WHERE row_id= '".$_SESSION['idnumber'][$r]."' and hn='".$hn_now."' and tvn='".$_SESSION["sVn"]."'";
    $result = mysql_query($query) or die("Query failed,update phardep");
	// in case of inpatient insert data into ipacc

	if(!empty($sAn) && $paid==$sNetprice){
		$query = "SELECT row_id,price FROM ipacc WHERE  idno= '".$_SESSION['idnumber'][$r]."' and accno ='".$_SESSION['sAccno'][$r]."' ";
		$result = mysql_query($query) or die("ipacc Query failed");
	
		while (list ($row_id,$price) = mysql_fetch_row ($result)) {
			$x++;
			array_push($sRow,$row_id);
			array_push($aPrice,$price);
		}
	
		for ($n=1; $n<=$x; $n++){
			$query ="UPDATE ipacc SET paid = $aPrice[$n] WHERE row_id='$sRow[$n]' ";
			$result = mysql_query($query) or die("Query failed,update ipacc");
		}
	}
	
	if(!empty($sAn) && $paid <> $sNetprice) {
		$query = "INSERT INTO ipacc(date,an,depart,detail,paid,idname,accno)VALUES('".$_SESSION['dDate'][$r]."','$sAn','$sDepart','$sDetail','$paid','$sOfficer','".$_SESSION['sAccno'][$r]."');";
		$result = mysql_query($query) or die("Query failed,cannot insert into ipacc");
	}
	
}
//
if(empty($credit) ){
	$credit="";
}

if($sNetprice >=0 && ($_POST["credit"] == "เงินสด" || $_POST["credit"] == "กรุงเทพ" || $_POST["credit"] == "เช็ค" || $_POST["credit"] == "ทหารไทย" || $_POST["credit"] == "ประกันสังคม" || $_POST["credit"] == "จ่ายตรง" || $_POST["credit"] == "สวัสดิการทันตกรรม" || $_POST["credit"] == "จ่ายตรง อปท.")){

	if($_POST["credit"] == "จ่ายตรง" ){
		$name_f = "billcscd";
	}
	else
		if($_POST["credit"] == "จ่ายตรง อปท." ){
		$name_f = "billcscd";
	}
	else if($_POST["credit"] == "ประกันสังคม" ){
		$name_f = "billcscd";
	}
	else{
		$name_f = "billno";
	}


	$query = "SELECT title,prefix,runno, left(startday,10) as startday2 FROM runno WHERE title = '".$name_f."'";
    $result = mysql_query($query) or die("Query failed");

    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
	}

	if($name_f == "billcscd" && date("Y-m-d") != $row->startday2){
		$billno= 0;
		$title = $row->prefix;
	}else{
		$billno=$row->runno;
		$title = $row->prefix;
	}
    $billno++;

    $query ="UPDATE runno SET runno = $billno, startday = '".date("Y-m-d H:i:s")."'  WHERE title='".$name_f."' ";
    $result = mysql_query($query) or die("Query failed runno");
	$billno = $title.$billno;
	$field_plus = ", billno, vn, paidcscd";
	$values_plus = " ,'$billno','".$_SESSION["sVn"]."','". $sSumYprice."' ";
}
else{
	$field_plus = ",paidcscd";
	$values_plus = ",'". $sSumYprice."' ";
}

for($r=0;$r<count($_SESSION['idnumber']);$r++){
	$query = "SELECT * FROM depart WHERE row_id = '".$_SESSION['idnumber'][$r]."' and hn='".$hn_now."' and tvn='".$_SESSION["sVn"]."'";
    $result = mysql_query($query) or die(mysql_error());
	$num1 = mysql_num_rows($result);
    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
	}
	if($num1>0){
		$sHn=$row->hn;
		$sAn=$row->an;
		//$sPtname=$row->ptname;
		$sPtright=$row->ptright;
		$sDoctor=$row->doctor;
		$sDepart=$row->depart;
		$sDetail=$row->detail;  
		$sNetprice=$row->price;
		$sPaid=$row->paid;
		$sSumYprice=$row->sumyprice;
		$sSumNprice=$row->sumnprice;
		 
		$aSumy+=$sSumYprice;
		$aSumn+=$sSumNprice;
		$aTotal+=$sNetprice;
		$diag =$row->diag;
		
					
		$_SESSION["sVn"]=$row->tvn;
	}
	
	if($field_plus!=",paidcscd"){
		$field_plus = ", billno, vn, paidcscd";
		$values_plus = " ,'$billno','".$_SESSION["sVn"]."','".$sSumYprice."' ";
	}
	else{
		$field_plus = ",paidcscd";
		$values_plus = ",'". $sSumYprice."' ";
	}
	
	if($_POST["credit"] == "สวัสดิการทันตกรรม"){

		if(count($_POST["detail_2"]) > 1)
			$bill_den = 300;
		else
			$bill_den = 300;
	
		$field_plus = ", billno, vn, paidcscd";
		$values_plus = " ,'$billno','".$_SESSION["sVn"]."','".$bill_den."' ";

		$sql = "INSERT INTO opacc (date,txdate,hn,an,depart,detail,price,paid,idname,ptright,credit,credit_detail ".$field_plus." ) VALUES('$Thidate','".$_SESSION['dDate'][$r]."','$sHn','$sAn','$sDepart','$sDetail','".$bill_den."','".$bill_den."','$sOfficer','$sPtright','เงินสด','' ".$values_plus.");";
	$result = mysql_query($sql) or die("Query failed 279");
		
		
		$sql1 = "INSERT INTO opacc2 (date,txdate,hn,an,depart,detail,price,paid,idname,ptright,credit,credit_detail ".$field_plus." ) VALUES('$Thidate','".$_SESSION['dDate'][$r]."','$sHn','$sAn','$sDepart','$sDetail','".$bill_den."','".$bill_den."','$sOfficer','$sPtright','เงินสด','' ".$values_plus.");";
	$result = mysql_query($sql1) or die("Query failed 279a");
	
		$field_plus = "";
		$values_plus = "";
		$detail_1 = implode(", ",$_POST["detail_2"]);
	}
	
	if($num1>0){
		$sql = "INSERT INTO opacc (date,txdate,hn,an,depart,detail,price,paid,idname,ptright,credit,credit_detail ".$field_plus." ) VALUES('$Thidate','".$_SESSION['dDate'][$r]."','$sHn','$sAn','$sDepart','$sDetail','$sNetprice','$sNetprice','$sOfficer','$sPtright','$credit','$detail_1' ".$values_plus.");";
		$result = mysql_query($sql) or die("Query failed 296");
		
		
		$sql1 = "INSERT INTO opacc2 (date,txdate,hn,an,depart,detail,price,paid,idname,ptright,credit,credit_detail ".$field_plus." ) VALUES('$Thidate','".$_SESSION['dDate'][$r]."','$sHn','$sAn','$sDepart','$sDetail','$sNetprice','$sNetprice','$sOfficer','$sPtright','$credit','$detail_1' ".$values_plus.");";
		$result = mysql_query($sql1) or die("Query failed 296a");
	}	
}
/////ยา////
/*if($sNetprice >= 0 && ($_POST["credit"] == "เงินสด" || $_POST["credit"] == "กรุงเทพ" || $_POST["credit"] == "ทหารไทย" || $_POST["credit"] == "ประกันสังคม" || $_POST["credit"] == "จ่ายตรง" || $_POST["credit"] == "เช็ค")){

if($_POST["credit"] == "จ่ายตรง" ){
	$name_f = "billcscd";
}else
if($_POST["credit"] == "ประกันสังคม" ){
	$name_f = "billcscd";
}else	
{
	$name_f = "billno";
}

/*$query = "SELECT title,prefix,runno, left(startday,10) as startday2 FROM runno WHERE title = '".$name_f."'";
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
	
	if($name_f == "billcscd" && date("Y-m-d") != $row->startday2){
		$billno= 0;
		$title = $row->prefix;
	}else{
		$billno=$row->runno;
		$title = $row->prefix;
	}
    $billno++;

    $query ="UPDATE runno SET runno = $billno, startday = '".date("Y-m-d H:i:s")."'  WHERE title='".$name_f."' ";
    $result = mysql_query($query);
	$billno = $title.$billno;
	$netfree1=$sEssd+$sNessdy+$sDPY+$sDSY; //เบิกได้
	 $netfree1=number_format( $netfree1, 2, '.', '');
//	 $english_format_number = number_format($number, 2, '.', '');

$field_plus = ", billno, vn, paidcscd";
$values_plus = " ,'$billno','".$_SESSION["sVn"]."','".$netfree1."' ";
$values_plus_2 = " ,'$billno','".$_SESSION["sVn"]."','50.00' ";
$values_plus_3 = " ,'$billno','".$_SESSION["sVn"]."','-50.00' ";



}else{
$field_plus = ", paidcscd";
$values_plus = ",'".$netfree1."'";
$values_plus_2 = " ,'50.00' ";
$values_plus_3 = ",'-50.00' ";
}*/

$sDepart='PHAR';
$sDetail='ค่ายา';
for($r=0;$r<count($_SESSION['idnumber']);$r++){
		$query = "SELECT * FROM phardep WHERE row_id = '".$_SESSION['idnumber'][$r]."' and hn='".$hn_now."' and tvn='".$_SESSION["sVn"]."'";
		$result = mysql_query($query) or die(mysql_error());
		$num1 = mysql_num_rows($result);
		for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
			if (!mysql_data_seek($result, $i)) {
				echo "Cannot seek to row $i\n";
				continue;
			}
	
			if(!($row = mysql_fetch_object($result)))
				continue;
		}
		if($num1>0){
			$num2 = mysql_num_rows($result);
			$sHn=$row->hn;
			$sAn=$row->an;
			$sPtright=$row->ptright;
			//$sPtname=$row->ptname;
			$sDoctor=$row->doctor;
			$sEssd=$row->essd;
			$DsEssd+=$sEssd; 
			$sNessdy=$row->nessdy;
			$DsNessdy+=$sNessdy; 
			$sNessdn=$row->nessdn;
			$DsNessdn+=$sNessdn; 
			$sDPY=$row->dpy;
			$DsDPY+=$sDPY; 
			$sDPN=$row->dpn;     
			$DsDPN+=$sDPN; 
			$sDSY=$row->dsy;
			$DsDSY+=$sDSY; 
			$sDSN=$row->dsn;  
			$DsDSN+=$sDSN;  
			$sNetprice=$row->price;
			$sPaid=$row->paid;
			$sDiag=$row->diag;
			
			$_SESSION["sVn"]=$row->tvn;
			
			
			$aSumy = $aSumy+$sEssd+$sNessdy+$sDPY+$sDSY;
			$aSumn = $aSumn+$sNessdn+$sDPN+$sDSN;
			
			if($sNetprice >= 0 && ($_POST["credit"] == "เงินสด" || $_POST["credit"] == "กรุงเทพ" || $_POST["credit"] == "ทหารไทย" || $_POST["credit"] == "ประกันสังคม" || $_POST["credit"] == "จ่ายตรง" || $_POST["credit"] == "เช็ค" || $_POST["credit"] == "อื่นๆ"|| $_POST["credit"] == "จ่ายตรง อปท.")){

	/*	if($_POST["credit"] == "จ่ายตรง" ){
			$name_f = "billcscd";
		}else
		if($_POST["credit"] == "ประกันสังคม" ){
			$name_f = "billcscd";
		}else	
		{
			$name_f = "billno";
		}
*/
if($_POST["credit"] == "จ่ายตรง" ){
		$name_f = "billcscd";
	}
	else
		if($_POST["credit"] == "จ่ายตรง อปท." ){
		$name_f = "billcscd";
	}
	else if($_POST["credit"] == "ประกันสังคม" ){
		$name_f = "billcscd";
	}
	else{
		$name_f = "billno";
	}

		$netfree1=$sEssd+$sNessdy+$sDPY+$sDSY; //เบิกได้
	 	$netfree1=number_format( $netfree1, 2, '.', '');


		$field_plus = ", billno, vn, paidcscd";
		$values_plus = " ,'$billno','".$_SESSION["sVn"]."','".$netfree1."' ";

		}else{
			$field_plus = ", paidcscd";
			$values_plus = ",'".$netfree1."'";
		}
			
			$sql = "INSERT INTO opacc (date,txdate,hn,an,depart,detail,price,paid,idname,essd,nessdy,nessdn,dpy,dpn,dsy,dsn,ptright,credit,credit_detail ".$field_plus.") VALUES('$Thidate','".$_SESSION['dDate'][$r]."','$sHn','$sAn','$sDepart','$sDetail','$sNetprice','$sNetprice','$sOfficer','$sEssd','$sNessdy','$sNessdn','$sDPY','$sDPN','$sDSY','$sDSN','$sPtright','$credit','$detail_1' ".$values_plus.");";     
			$result = mysql_query($sql) or die("Query failed4001");
			
			$sql1 = "INSERT INTO opacc2 (date,txdate,hn,an,depart,detail,price,paid,idname,essd,nessdy,nessdn,dpy,dpn,dsy,dsn,ptright,credit,credit_detail ".$field_plus.") VALUES('$Thidate','".$_SESSION['dDate'][$r]."','$sHn','$sAn','$sDepart','$sDetail','$sNetprice','$sNetprice','$sOfficer','$sEssd','$sNessdy','$sNessdn','$sDPY','$sDPN','$sDSY','$sDSN','$sPtright','$credit','$detail_1' ".$values_plus.");";     
			$result = mysql_query($sql1) or die("Query failed400a");
			
			
			
				////ให้คิวจ่ายยา
				
				
    $cTdatehn1 =$sHn;
	$today1=(date("Y")+543).date("-m-d");	
	
   $sql = "Select kewphar,hn From dphardep WHERE hn ='$sHn'  AND  date LIKE '$today1%'  and pharin != '' and (kewphar is null or kewphar = '') ";

//echo $sql ;
	$result = Mysql_Query($sql);

	if(Mysql_num_rows($result) > 0){
		list($kewphar,$hn1) = Mysql_fetch_row($result);
		
	$query3 = "select idguard  from opcard where hn= '$hn1'  ";
	$row3 = mysql_query($query3);
	list($idguard) = mysql_fetch_array($row3);
		
$idguard=substr($idguard,0,4);


if($idguard =='MX01' or $idguard =='MX03' or $idguard =='MX03' ){$pharinx="pharin_m";}else{$pharinx="pharin_l";};

$sql = "Select prefix,runno From runno WHERE title ='$pharinx' ";
	$result = Mysql_Query($sql);
		list($prefix,$runno) = Mysql_fetch_row($result);
		
$runno=sprintf('%03d',$runno);
		$kew=$prefix.$runno;
		
		

		$query ="update dphardep SET  kewphar='$kew' WHERE hn = '$hn1' AND  date LIKE '$today1%'  and (kewphar is  null or kewphar = '')  ";
		$result = mysql_query($query) or die("Query failed,update thaywin");
		//echo $query;

	
	  $sql ="update runno SET runno = runno+1 WHERE title='$pharinx'";
					 $result = Mysql_Query($sql);

///จบการให้คิวยา

		}
	}

};


if(!$result){
	echo "insert opacc query fail";
}
else{

	$cbaht=baht($paid);
	if($credit=='ทหารไทย'){
		$credit1='บัตรเครดิต';
	}
	else{
		$credit1=$credit;
	}
/////////////////////////////////เงินทอน/////////////////////////////////////////
?>
<div id="no_print" > 
<?
if($_POST["detail_3"]!=""){
$current = $_POST["detail_3"]-$_POST['paid'];
print "<font face='Angsana New' size='5'>รับเงิน ".$_POST["detail_3"]." บาท&nbsp;&nbsp;&nbsp;&nbsp;";
print "ค่าใช้จ่าย ".$_POST["paid"]." บาท</font><br>";
print "<font face='Angsana New' size='8' COLOR='#FF0033'>เงินทอน ".$current." บาท</font>";
print "<font face='Angsana New' size='6' COLOR='#FF0033'>&nbsp;&nbsp;&nbsp;&nbsp;(".$_POST['billcur'].")</font><br>";
}
?>
</div>
<?
/////////////////////////////////เงินทอน/////////////////////////////////////////
//print recieve
	print "<div align='left'>";
	print "<table border='0' cellpadding='0' cellspacing='0' width='100%'>";
	print "<br><br><br><br>";
	print "<tr>";
	//print "<td width='100%'><font face='Angsana New' size='4'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$credit1&nbsp;&nbsp;จาก&nbsp;<b>$sPtname</b>&nbsp;&nbsp;&nbsp;&nbsp;HN:$sHn&nbsp;VN:&nbsp;(".$_SESSION["sVn"].")&nbsp;&nbsp;วันที่&nbsp;<b>$Thdate</b> &nbsp;&nbsp;เวลา&nbsp;$billtime</td>";
	
	print "<td width='100%'><font face='Angsana New' size='4'><b>ชื่อ:&nbsp;$sPtname</b>&nbsp;&nbsp;&nbsp;&nbsp;HN:$sHn&nbsp;VN:&nbsp;(".$_SESSION["sVn"].")&nbsp;&nbsp;วันที่&nbsp;<b>$Thdate</b> &nbsp;&nbsp;เวลา&nbsp;$billtime<br></td>";
	print "</tr>";
		print "<tr>";
//	print "<td width='100%'><font face='Angsana New' size='4'></td>";
echo "<td width='45%'><font face='Angsana New'  size ='3'><b>โรค:</b></> ";
if(count($_SESSION['tDiag'])==1){
	echo $_SESSION['tDiag'][0];
}
elseif(count($_SESSION['tDiag'])>1){
	/*if(in_array("ตรวจวิเคราะห์เพื่อการรักษา",$_SESSION['tDiag'])){
		echo "<td width='45%'><font face='Angsana New'  size ='3'>โรค: ตรวจวิเคราะห์เพื่อการรักษา</font></td>";
	}
	else{*/
		//$str ="<td width='45%'><font face='Angsana New'  size ='3'><b>โรค:</b> ";
		for($p=0;$p<count($_SESSION['tDiag']);$p++){
			if($p!=0){ $str .=",";}
			$str.=$_SESSION['tDiag'][$p];
		}
		//$str.="</font></td>";
		echo $str ;
	//}
} echo '&nbsp;&nbsp;คิวรับยาที่ ' ; echo $kew;
echo "</font></td>";
	print "</tr>";
	print "</table>";
	print "</div>";
	print "<br><br>";
	if($num2>0){//ถ้ามีรายการยา
		$DsEssd = number_format($DsEssd,2);
		$DsNessdy = number_format($DsNessdy,2);
		$DsNessdn = number_format($DsNessdn,2);
		$DsDSY = number_format($DsDSY,2);
		$DsDSN = number_format($DsDSN,2);
		$DsDPY = number_format($DsDPY,2);
		$DsDPN = number_format($DsDPN,2);
		//รายการยา
		print "<div align='left'>";
		print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
		print "    <tr>";
		//print "      <td width='9%'></td>";
		print "      <td width='30%'><font face='Angsana New' style='line-height:20px; size ='3'>ยาในบัญชียาหลักแห่งชาติ</td>";
		print "      <td width='15%' align='right'><font face='Angsana New' style='line-height:20px; size ='3'>$DsEssd</td>";
		print "      <td width='10%' align='right'><font face='Angsana New' style='line-height:20px; size ='3'></td>";
		print "      <td width='30%'><font face='Angsana New'></td>";
		print "    </tr>";
		print "    <tr>";
		//print "      <td width='9%'></td>";
		print "      <td width='30%'><font face='Angsana New' style='line-height:20px; size ='3'>ยานอกบัญชียาหลักแห่งชาติ</td>";
		print "      <td width='15%' align='right' ><font face='Angsana New'  style='line-height:20px; size ='3'>$DsNessdy</td>";
		print "      <td width='10%' align='right' ><font face='Angsana New' style='line-height:20px; size ='3' >$DsNessdn</td>";
		print "      <td width='30%'><font face='Angsana New'></td>";
		print "    </tr>";
		print "    <tr>";
		//print "      <td width='9%'></td>";
		print "      <td width='30%'><font face='Angsana New' style='line-height:20px; size ='3'>ค่าเวชภัณฑ์ที่ไม่ใช่ยา</td>";
		print "      <td width='15%' align='right'><font face='Angsana New' style='line-height:20px; size ='3' >$DsDSY</td>";
		print "      <td width='10%' align='right'><font face='Angsana New'  style='line-height:20px; size ='3'>$DsDSN</td>";
		print "      <td width='30%'><font face='Angsana New'></td>";
		print "    </tr>";
		print "    <tr>";
		//print "      <td width='9%'></td>";
		print "      <td width='30%'><font face='Angsana New' style='line-height:20px; size ='3'>ค่าอุปกรณ์ทางการแพทย์ ";
		
		for($i=0;$i<count($_SESSION['dpyaa']);$i++){
			
			//echo count($_SESSION['dpyaa']);
			echo "".$_SESSION['dpyaa'][$i]." ,";
		}
		print "</td>";
		print "      <td width='15%' align='right'><font face='Angsana New' style='line-height:20px; size ='3'>$DsDPY</td>";
		print "      <td width='10%' align='right'><font face='Angsana New' style='line-height:20px; size ='3'>$DsDPN</td>";
		print "      <td width='30%'><font face='Angsana New'></td>";
		print "    </tr>";
		print "  </table>";
		print "</div>";
		$Items+=4;
	}

	if($_POST["credit"] == "สวัสดิการทันตกรรม"){
	
		$Items++;
		print "<div align='left'>";
		print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";

		$count_detail_2 = count($_POST["detail_2"]);
		for($xx=0;$xx<$count_detail_2;$xx++){
			print "    <tr>";
			print "      <td width='30%'><font face='Angsana New' size ='3'>".$_POST["detail_2"][$xx]."</td>"; //เดิม 63
			print "      <td width='15%' align='right'><font face='Angsana New' size ='3'>300</td>";  //เดิม 28
			print "      <td width='10%' align='right'><font face='Angsana New' size ='3'>0</td>";  //เดิม 28
			print "      <td width='30%'><font face='Angsana New' size ='3'></td>";
			print "    </tr>";
		}
		print "  </table>";
		print "</div>";

		if($count_detail_2 > 1)
			$yy = 600;
		else 
			$yy = 300;
	
		$cbaht=baht(number_format($yy,2));
		$Ppaid = $yy;
		$PsNetprice = $yy;
		$PsSumYprice = $yy;
		$PsSumNprice = 0;
	}else if($sDepart<>'PATHO'){  
		//begin แจงรายการถ้าไม่ใช่ค่าพยาธิ
		//$Items=0;
		for($r=0;$r<count($_SESSION['idnumber']);$r++){
			$query = "SELECT a.code,a.detail,a.amount,a.price,a.yprice,a.nprice FROM patdata as a,depart as b WHERE  a.idno = '".$_SESSION['idnumber'][$r]."' and a.hn='".$hn_now."' and b.tvn='".$_SESSION["sVn"]."' AND a.idno = b.row_id"; 
			
			$result = mysql_query($query) or die("patdata2 Query failed");
			$count = mysql_num_rows($result);
			if($count <= 16){
				
				while (list ($code,$detail,$amount, $price,$yprice,$nprice) = mysql_fetch_row ($result)) {
					$Items++;
					if($code=="58002"){
					$detail1=substr($detail,0,13);
					$detail2=substr($detail,18,25);
					$detail = $detail1.$detail2;			
					}else{
					$detail = substr($detail,0,40);
					}
					print "<div align='left'>";
					print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
					print "    <tr>";
					print "      <td width='30%' ><font face='Angsana New'  style='line-height:20px; size ='3'>$detail</td>"; //เดิม 63
					print "      <td width='15%' align='right'><font face='Angsana New' style='line-height:20px; size ='3'>$yprice</td>";  //เดิม 28
					print "      <td width='10%' align='right'><font face='Angsana New' style='line-height:20px; size ='3'>$nprice</td>";  //เดิม 28
					print "      <td width='30%'><font face='Angsana New' style='line-height:20px; size ='3'></td>";
					print "    </tr>";
					print "  </table>";
					print "</div>";
				 //end แจงรายการถ้าไม่ใช่ค่าพยาธิ
				}
			}
			else{
				$Items++;
				print "<div align='left'>";
				print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
				print "    <tr>";
				print "      <td width='30%'><font face='Angsana New'style='line-height:20px; size ='3'>ค่าตรวจทางห้องปฏิบัติการ(มีรายการแนบเบิก)</td>"; //เดิม 63
				print "      <td width='15%' align='right'><font face='Angsana New' style='line-height:20px; size ='3'>$sSumYprice</td>";  //เดิม 28
				print "      <td width='10%' align='right'><font face='Angsana New' style='line-height:20px; size ='3'>$sSumNprice</td>";  //เดิม 28
				print "      <td width='30%'><font face='Angsana New' style='line-height:20px; size ='3'></td>";
				print "    </tr>";
				print "  </table>";
				print "</div>";
			}
		}
	}
	else{
     //begin ไม่แจงรายการกรณีค่าพยาธิ
	 	//$Items=0;
		for($r=0;$r<count($_SESSION['idnumber']);$r++){
			//$query = "SELECT detail,amount,price,yprice,nprice FROM patdata WHERE  idno = '".$_SESSION['idnumber'][$r]."' and hn='".$hn_now."'  "; 
			$query = "SELECT a.code,a.detail,a.amount,a.price,a.yprice,a.nprice FROM patdata as a,depart as b WHERE  a.idno = '".$_SESSION['idnumber'][$r]."' and a.hn='".$hn_now."' and b.tvn='".$_SESSION["sVn"]."' AND a.idno = b.row_id"; 
			
			$result = mysql_query($query) or die("patdata2 Query failed");
			$count = mysql_num_rows($result);
			if($count <= 16){
				while (list ($code,$detail,$amount, $price,$yprice,$nprice) = mysql_fetch_row ($result)) {
					$Items++;
					if($code=="58002"){
					$detail1=substr($detail,0,13);
					$detail2=substr($detail,18,25);
					$detail = $detail1.$detail2;
					}else{
					$detail = substr($detail,0,40);
					}
					print "<div align='left'>";
					print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
					print "    <tr>";
					print "      <td width='30%'><font face='Angsana New'style='line-height:20px; size ='3'>$detail</td>"; //เดิม 63
					print "      <td width='15%' align='right'><font face='Angsana New'style='line-height:20px; size ='3'>$yprice</td>";  //เดิม 28
					print "      <td width='10%' align='right'><font face='Angsana New' style='line-height:20px; size ='3'>$nprice</td>";  //เดิม 28
					print "      <td width='30%'><font face='Angsana New'style='line-height:20px; size ='3'></td>";
					print "    </tr>";
					print "  </table>";
					print "</div>";
				 //end แจงรายการถ้าไม่ใช่ค่าพยาธิ
				}
			}
			else{
				$Items++;
				print "<div align='left'>";
				print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
				print "    <tr>";
				print "      <td width='30%'><font face='Angsana New'style='line-height:20px; size ='3'>ค่าตรวจทางห้องปฏิบัติการ(มีรายการแนบเบิก)</td>"; //เดิม 63
				print "      <td width='15%' align='right'><font face='Angsana New' style='line-height:20px; size ='3'>$sSumYprice</td>";  //เดิม 28
				print "      <td width='10%' align='right'><font face='Angsana New' style='line-height:20px; size ='3'>$sSumNprice</td>";  //เดิม 28
				print "      <td width='30%'><font face='Angsana New' style='line-height:20px; size ='3'></td>";
				print "    </tr>";
				print "  </table>";
				print "</div>";
			}
		}
    //end ไม่แจงรายการ
}



//เพิ่มบรรทัดว่าง
if($Items <='3'){
	$Lineskip=28-$Items;//พิมพ์ได้ n+1 บรรทัด
	for($repeat=1;$repeat<=$Lineskip;$repeat++){
		print "<font face='Angsana New'style='line-height:15px; size ='3'><br>";
	}
}
else if($Items <='5'){
	$Lineskip=27-$Items;//พิมพ์ได้ n+1 บรรทัด
	for($repeat=1;$repeat<=$Lineskip;$repeat++){
		print "<font face='Angsana New'style='line-height:15px; size ='3'><br>";	  
	}
}
else if($Items <='8'){
	$Lineskip=26-$Items;//พิมพ์ได้ n+1 บรรทัด
	for($repeat=1;$repeat<=$Lineskip;$repeat++){
		print "<font face='Angsana New'style='line-height:15px; size ='3'><br>";	  
	}
}

else if($Items <='17'){
	$Lineskip=25-$Items;//พิมพ์ได้ n+1 บรรทัด
	for($repeat=1;$repeat<=$Lineskip;$repeat++){
		print "<font face='Angsana New'style='line-height:15px; size ='3'><br>";	  
	}
}

else{
	$Lineskip=24-$Items;//พิมพ์ได้ n+1 บรรทัด
	for($repeat=1;$repeat<=$Lineskip;$repeat++){
		print "<font face='Angsana New'style='line-height:15px; size ='3'><br>";  
	}
}
//จบเพิ่มบรรทัดว่าง


if($_POST["credit"] == "ค้างจ่าย"){
	for($r=0;$r<count($_SESSION['idnumber']);$r++){
		$query = "SELECT * FROM depart WHERE row_id = '".$_SESSION['idnumber'][$r]."' and hn= '".$hn_now."' and tvn='".$_SESSION["sVn"]."'";
		$result = mysql_query($query) or die(mysql_error());
		$numtest = mysql_num_rows($result);
		for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
			if (!mysql_data_seek($result, $i)) {
				echo "Cannot seek to row $i\n";
				continue;
			}
		
			if(!($row = mysql_fetch_object($result)))
				continue;
		}
		if($numtest>0){
			$sHn=$row->hn;
			$sAn=$row->an;
			//$sPtname=$row->ptname;
			$sPtright=$row->ptright;
			$sDoctor=$row->doctor;
			$sDepart=$row->depart;
			$sDetail=$row->detail;  
			$sNetprice=$row->price;
			$sPaid=$row->paid;
			$sSumYprice=$row->sumyprice;
			$sSumNprice=$row->sumnprice;
			
			$_SESSION["sVn"]=$row->tvn;
			
			$sql = "INSERT INTO accrued (date,txdate,hn,depart,detail,price,ptright,vn,status_pay) VALUES('$Thidate','".$_SESSION['dDate'][$r]."','$sHn','$sDepart','$sDetail', '$sNetprice','$sPtright','".$_SESSION["sVn"]."','n');";
			$result = mysql_query($sql) or die("Query failed 662");
		}
		else{
			$sDepart='PHAR';
			$sDetail='ค่ายา';
			$query = "SELECT * FROM phardep WHERE row_id = '".$_SESSION['idnumber'][$r]."' and hn='".$hn_now."' and tvn='".$_SESSION["sVn"]."'";
			$result = mysql_query($query) or die(mysql_error());
			$numtest2 = mysql_num_rows($result);
			
			for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
				if (!mysql_data_seek($result, $i)) {
					echo "Cannot seek to row $i\n";
					continue;
				}
		
				if(!($row = mysql_fetch_object($result)))
					continue;
			}
			if($numtest2>0){
				$asHn=$row->hn;
				$asPtright=$row->ptright;
				$asNetprice=$row->price;
				$_SESSION["sVn"]=$row->tvn;

				$sql = "INSERT INTO accrued (date,txdate,hn,depart,detail,price,ptright,vn,status_pay) VALUES('$Thidate','".$_SESSION['dDate'][$r]."','$asHn','$sDepart','$sDetail', '$asNetprice','$asPtright','".$_SESSION["sVn"]."','n');";
				$result = mysql_query($sql) or die("Query failed 662");
			}
		}
	}
}
///// จบค้างจ่าย
print "<div align='left'>";
print "<table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "<tr>";

if($_POST["credit"] == "สวัสดิการทันตกรรม"){
	$aTotal = $Ppaid;
	$aSumy = number_format($PsSumYprice,2);
	$aSumn = number_format($PsSumNprice,2);
	$aTotal = number_format($aTotal,2);
}else{
	$aTotal = $aSumy+$aSumn;
	$aSumy = number_format($aSumy,2);
	$aSumn = number_format($aSumn,2);
	$aTotal = number_format($aTotal,2);
}
//print "      <td width='45%'><font face='Angsana New'  size ='3'><b>โรค: $tDiag</b></font></td>";
print "<td width='30%'><font face='Angsana New' ; size ='3'></td>";
print "<td width='15%' align='right'><font face='Angsana New'  size ='3'><B>$aSumy</B></td>";
print "<td width='10%' align='right'><font face='Angsana New'  size ='3'><B>$aSumn</B></td>";
print "<td width='30%'><font face='Angsana New' ; size ='3'></td>";
print "</tr>";
print "</table>";
print "</div>";

print "<div align='left'>";
print "<table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "<tr>";
print "<td width='5%'><font face='Angsana New'  size ='3'></td>";
print "<td width='40%' ><font face='Angsana New'  size ='4'><B>$cbaht</B></td>";
print "<td width='10%' ><font face='Angsana New'  size ='4'><B>$aTotal</B></td>";
print "<td width='30%'><font face='Angsana New'  size ='3'></td>";
print "</tr>";
print "  </table>";
print "</div>";

/*if ($paid<>$aTotal){
	print "จ่ายเงินไม่เท่ากับราคารวม*************************<br>";
                                    }*/
//print "<br>";
//print "<br>";
print "<div align='left'>";
print "<table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "<br>";
print "<tr>";
print "<td width='20%'></td>";
print "<td width='20%' align=center><font face='Angsana New'style='line-height:15px; size='2'>ลงชื่อ.............................................ผู้รับเงิน</font></td>";
print "<td width='20%'></td>";
print "</tr>";
print "<tr>";
print "<td width='20%'><font face='Angsana New'style='line-height:15px; size='2'>ได้รับ $credit (".$_POST["detail_3"].",".$current.")</td>";
$sql = "Select name From inputm where idname = '".$_SESSION["sIdname"]."' limit 1 ";
$result = Mysql_Query($sql) or die("Query failed 721");
list($name) = Mysql_fetch_row($result);
print "<td width='20%' align=center><font face='Angsana New' style='line-height:15px; size='2'>(".$name.")</font></td>";
print "<td width='20%'></td>";
print "</tr>";
print "<tr>";
print "<td width='20%'></td>";
print "<td width='20%' align=center><font face='Angsana New'style='line-height:15px; size='2'>เจ้าหน้าที่เก็บเงิน</font></td>";
print "<td width='20%'></td>";
print "</tr>";
print "</table>";
print "</div>";

}
//print ("<tr><td><div style=\"page-break-before: always;\"></div></td></tr>");
include("unconnect.inc");
//session_destroy();
    //opitem.php
    session_unregister("dDate");  
    session_unregister("sHn");   
    session_unregister("sAn");
    session_unregister("sPtname");
    session_unregister("sPtright");
    session_unregister("sDoctor");
    session_unregister("sDepart");
    session_unregister("sDetail");
    session_unregister("sNetprice");
    session_unregister("sDiag");
	session_unregister("tDiag");
    session_unregister("sRow_id"); 
    session_unregister("sRow"); 
    session_unregister("sAccno");  
    session_unregister("x");
    session_unregister("aDgcode");
    session_unregister("aTrade");
    session_unregister("aPrice");
    session_unregister("aPart");
    session_unregister("aAmount");
    session_unregister("aMoney");  
//////  
?>


