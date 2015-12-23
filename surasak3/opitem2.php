<?php
    session_start();
    if (isset($sIdname)){} else {die;} //for security
    //opitem.php

    session_unregister("dDate");  
    session_unregister("sHn");   
    session_unregister("sAn");
	session_register("sVn");
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

    session_unregister("sSumYprice");
    session_unregister("sSumNprice");
	$items=0;
//////  
    //$dDate=$sDate;
    $sHn="";
    $sAn="";
    $sPtname="";
    $sPtright="";
    $sDoctor="";

    $sEssd="";
    $sNessdy="";
    $sNessdn="";
    $sNetprice="";
    $sDPY="";
    $sDPN="";     

    $sDepart="";
    $sDetail="";
    $sDiag="";
    $sRow_id=$nRow_id;
    $sAccno=$nAccno;
  
    $x=0;
    $aDgcode = array("รหัสยา");
    $aTrade  = array("      ชื่อการค้า");
    $aPrice  = array("                          ราคาขาย  ");

    $sSumYprice = 0;
    $sSumNprice = 0;
	$sNetprice=0;
    session_register("sSumYprice");
    session_register("sSumNprice");

    $aPart = array("part");
    $aAmount = array("        จำนวน   ");
//    $aSlipcode = array("        วิธีใช้   ");
    $aMoney= array("       รวมเงิน   ");
    $sRow=array("row_id of ipacc");

    session_register("dDate");  
    session_register("sHn");   
    session_register("sAn");
    session_register("sPtname");
    session_register("sPtright");
    session_register("sDoctor");
/*
    session_register("sEssd");
    session_register("sNessdy");
    session_register("sNessdn");
    session_register("sDPY");
    session_register("sDPN");
*/
    session_register("sDepart");
    session_register("sDetail");
    session_register("sNetprice");
    session_register("sDiag");
	session_register("tDiag");
    session_register("sRow_id"); 
    session_register("sRow"); 
    session_register("sAccno");  

    session_register("x");
    session_register("aDgcode");
    session_register("aTrade");
    session_register("aPrice");
    session_register("aPart");
    session_register("aAmount");
//  session_register("aSlipcode");
    session_register("aMoney");
  	session_register("idnumber");
	$_SESSION['idnumber'] = array(); 
	$_SESSION['dDate'] = array();
	$_SESSION['sAccno'] = array();
	$_SESSION['tDiag'] = array();
    
	include("connect.inc");
		$query = "SELECT runno, prefix  FROM runno WHERE title = 's_chekup'";
		$result = mysql_query($query) or die("Query failed");
		
		for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
			if (!mysql_data_seek($result, $i)) {
				echo "Cannot seek to row $i\n";
				continue;
			}
				if(!($row = mysql_fetch_object($result)))
				continue;
		}
		$nPrefix=$row->prefix;	
?>
<table>
 <tr>

  <th bgcolor=CD853F>รายการ</th>
  <th bgcolor=CD853F>จำนวน</th>
  <th bgcolor=CD853F>ราคา</th>
  <th bgcolor=9999CC>เบิกได้</th>
  <th bgcolor=9999CC>เบิกไม่ได้</th>
 </tr>
<?

$sVn=$_POST['vnnow'];
	for($r=0;$r<=$_POST['sumch'];$r++){
		if(isset($_POST['ch'.$r])){
			$idno = $_POST['ch'.$r];
			array_push($idnumber,$idno);
			array_push($dDate,$_POST['sDate'.$r]);
			array_push($sAccno,$_POST['nAccno'.$r]);
		}	
	}
	$sqlname = "select ptname from opday where hn = '$nhn' and thidate like '%".substr($_SESSION['dDate'][0],0,10)."%' ";
	//echo $sqlname;
	$rowname = mysql_query($sqlname);
	list($sPtname) = mysql_fetch_array($rowname);
	
	if($idno==""){
		echo "ไม่สามารถทำรายการได้ กรุณาเลือกรายการก่อน";
	}
	else{
		//$nhn มาจากopcashvn hidden มา
		for($r=0;$r<count($_SESSION['idnumber']);$r++){
			$query = "SELECT * FROM depart WHERE row_id = '".$_SESSION['idnumber'][$r]."' and hn='$nhn' and tvn = '$sVn' ";			
			//echo $query."<br>";
			$result = mysql_query($query) or die(mysql_error());
			$nrow = mysql_num_rows($result);
			for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
				if (!mysql_data_seek($result, $i)) {
					echo "Cannot seek to row $i\n";
					continue;
				}
		
				if(!($row = mysql_fetch_object($result)))
					continue;
			}
			if($nrow>0){
				$sHn=$row->hn;
				$sAn=$row->an;
				//$sPtname=$row->ptname;
				$sPtright=$row->ptright;
				$sDoctor=$row->doctor;
				$sDepart=$row->depart;
				$sDetail=$row->detail;  
				//$sNetprice=$row->price;
				$sPaid=$row->paid;
				//$sSumYprice=$row->sumyprice;
				//$sSumNprice=$row->sumnprice;
			
				$sDiag=$row->diag;

				if(!empty($sDiag)){
					if(!in_array($sDiag,$_SESSION['tDiag'])){
						array_push($_SESSION['tDiag'],$sDiag);
					}
				}
				
				$_SESSION["sVn"]=$row->tvn;
			}else{
				$query = "SELECT * FROM phardep WHERE row_id = '".$_SESSION['idnumber'][$r]."' and hn='$nhn' and tvn = '$sVn' ";

				$result = mysql_query($query) or die(mysql_error());
			
				for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
					if (!mysql_data_seek($result, $i)) {
						echo "Cannot seek to row $i\n";
						continue;
					}
			
					if(!($row = mysql_fetch_object($result)))
						continue;
					
						$sHn=$row->hn;
						$sAn=$row->an;
						$sPtright=$row->ptright;
						//$sPtname=$row->ptname;
						$sDoctor=$row->doctor;
						/*$sEssd=$row->essd;
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
						$sPaid=$row->paid;*/
						$sDiag=$row->diag;

						if(!empty($sDiag)){
							if(!in_array($sDiag,$_SESSION['tDiag'])){
								array_push($_SESSION['tDiag'],$sDiag);
							}
						}
						$_SESSION["sVn"]=$row->tvn;
					
				}
			}
		}
		
		print "$sPtname, HN: $sHn<br> ";
		print "โรค: ";
		if(count($_SESSION['tDiag'])==1){
			echo $_SESSION['tDiag'][0];
		}
		elseif(count($_SESSION['tDiag'])>1){
			/*if(in_array("ตรวจวิเคราะห์เพื่อการรักษา",$_SESSION['tDiag'])){
				echo "ตรวจวิเคราะห์เพื่อการรักษา";
			}
			else{*/
				for($p=0;$p<count($_SESSION['tDiag']);$p++){
					if($p!=0){ $str .=",";}
					$str.=$_SESSION['tDiag'][$p];
				}
				echo $str;
			//}
		}
		print ", แพทย์ :$sDoctor<br>";
	
		for($r=0;$r<count($_SESSION['idnumber']);$r++){
				$query = "SELECT a.code,a.detail,a.amount,a.price,a.yprice,a.nprice FROM patdata as a,depart as b WHERE a.idno = '".$_SESSION['idnumber'][$r]."' and a.hn='$sHn' and b.tvn='".$_SESSION["sVn"]."' AND a.idno = b.row_id ";
				//echo $query;

				$result = mysql_query($query) or die("Query failed");
			
				while (list ($code, $detail,$amount, $price,$yprice,$nprice) = mysql_fetch_row ($result)) {
					$items++;	
								
					print (" <tr>\n".
			
					   "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$items.($code)$detail</td>\n".
					   "  <td BGCOLOR=F5DEB3>$amount</td>\n".
					   "  <td BGCOLOR=F5DEB3>$price</td>\n".
					   "  <td BGCOLOR=99CCCC>$yprice</td>\n".
					   "  <td BGCOLOR=99CCCC>$nprice</td>\n".
					   " </tr>\n");
			$sumprice+=$price;
			$sumyprice+=$yprice;
			$sumnprice+=$nprice;
					   switch($code){
							case '67201':  $detail2_0 = " Checked "; break;
							case '62101':  $detail2_1 = " Checked "; break;
							case '64101':  $detail2_2 = " Checked "; break;
					   }
				}
		}
		$item2 = $items;
for($r=0;$r<count($_SESSION['idnumber']);$r++){

		$query = "SELECT * FROM phardep WHERE row_id = '".$_SESSION['idnumber'][$r]."' and hn='$sHn' and tvn = '".$_SESSION["sVn"]."'  ";
		$result = mysql_query($query) or die(mysql_error());
		$n1 = mysql_num_rows($result);
		for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
			if (!mysql_data_seek($result, $i)) {
				echo "Cannot seek to row $i\n";
				continue;
			}
	
			if(!($row = mysql_fetch_object($result)))
				continue;
		}
		if($n1>0){
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
			$DsNetprice+=$sNetprice; 
			$sPaid=$row->paid;
			$sDiag=$row->diag;
			$_SESSION["sVn"]=$row->tvn;
			
		}
}
	
	for($r=0;$r<count($_SESSION['idnumber']);$r++){

			$query = "SELECT a.drugcode,a.tradname,a.amount,a.price,a.part FROM drugrx as a,phardep as b WHERE a.idno = '".$_SESSION['idnumber'][$r]."' and a.hn = '$sHn' and b.tvn='".$_SESSION["sVn"]."' AND a.idno = b.row_id ";

			$result = mysql_query($query) or die("Query failed");
		
			$dpyaa=array();
			session_register("dpyaa");
			$drugs = 0;
			while (list ($drugcode,$tradname,$amount, $price,$part) = mysql_fetch_row ($result)) {
	//        array_push($aPrice,$price);
	//        $x++;
				$items++;
				$drugs = 4;
				$sql="select dpy_code from druglst where drugcode like '%$drugcode%'";
				$qresult = mysql_query($sql);
				$numrow=mysql_num_rows($qresult);
				
				
				list ($dpy_code) = mysql_fetch_row ($qresult);
				if($numrow){
					
					array_push($dpyaa,$dpy_code);
	
				}
	
					if($drugcode=="4MET25"){
						$bgcolor="FF6699";
					}else{
						$bgcolor="F5DEB3";
					}		
				print (" <tr>\n".
				   "  <td BGCOLOR=$bgcolor><font face='Angsana New'>$items.($drugcode)$tradname  $dpy_code</td>\n".
				   "  <td BGCOLOR=$bgcolor>$amount</td>\n".
				   "  <td BGCOLOR=$bgcolor>$price</td>\n".
				   "  <td BGCOLOR=$bgcolor>$part</td>\n".
				   " </tr>\n");
			}

	}
	$item2+=$drugs;
?>
</table>

<?php
//$sumpeice,$sumnprice,$sumyprice รวมเงินของหัตถการ
//$DsNetprice,$DsDPN,$DsDPY,$DsDSN,$DsDSY,$DsNessdn,$DsNessdy,$DsEssd รวมเงินของยา

$sNetprice =$sumprice+$DsNetprice; 
$sSumNprice=$sumnprice+$DsDPN+$DsDSN+$DsNessdn;
$sSumYprice=$sumyprice+$DsDPY+$DsDSY+$DsNessdy+$DsEssd;
?>
<SCRIPT LANGUAGE="JavaScript">
	
	function checkptring(opt){
		var pt = '<?php echo substr($sPtright,0,3);?>';
		var pt2 = '<?php echo substr($sPtright,3);?>';

		if( (pt == "R01" || pt == "R02" || pt == "R04" || pt == "R05" || pt == "R06" || pt == "R16" || pt == "R20" || pt == "R021" || pt == "R15") && opt != "เงินสด"){
			alert("สิทธิ์ของผู้ป่วยคือ "+pt2);
		}else if( pt == "R03"  && opt != 'จ่ายตรง' ){
			alert("สิทธิ์ของผู้ป่วยคือ "+pt2);
		}else if( pt == "R33"  && opt != 'จ่ายตรง อปท.' ){
				alert("สิทธิ์ของผู้ป่วยคือ "+pt2);
			}else if(  pt == "R07" && opt != 'ประกันสังคม' ){
				alert("สิทธิ์ของผู้ป่วยคือ "+pt2);
			}else if(  (pt == "R09" || pt == "R13" || pt == "R11" || pt == "R10" || pt == "R17") && opt != '30บาท' ){
				alert("สิทธิ์ของผู้ป่วยคือ "+pt2);
			}

	}

	function checkformf1(){
		
		if(document.f1.credit[0].checked == false && document.f1.credit[1].checked == false && document.f1.credit[2].checked == false && document.f1.credit[3].checked == false && document.f1.credit[4].checked == false && document.f1.credit[5].checked == false && document.f1.credit[6].checked == false && document.f1.credit[7].checked == false){
			alert("กรุณาเลือกวิธี ชำระเงินด้วยครับ");
			return false;
		}else if((document.f1.credit[1].checked == true || document.f1.credit[2].checked == true) && document.f1.detail_1.value == ''){
			alert("กรณี ที่ชำระเงินด้วย บัตรเครดิต ให้กรอกข้อมูล หมายเลขเลขบัตรเครดิต ด้วยครับ");
			document.f1.detail_1.focus();
			return false;
		}else if(document.f1.credit[7].checked == true && document.f1.detail_1.value == ''){
			alert("กรณีที่เลือก อื่นๆ ให้กรอกข้อมูล เพิ่มเติม ด้วยครับ");
			document.f1.detail_1.focus();
			return false;
		}

	}

	function checkformf2(){
		
		if(document.f2.credit[0].checked == false && document.f2.credit[1].checked == false && document.f2.credit[2].checked == false && document.f2.credit[3].checked == false && document.f2.credit[4].checked == false && document.f2.credit[5].checked == false && document.f2.credit[6].checked == false && document.f2.credit[7].checked == false && document.f2.credit[8].checked == false && document.f2.credit[9].checked == false && document.f2.credit[10].checked == false && document.f2.credit[11].checked == false && document.f2.credit[12].checked == false && document.f2.credit[13].checked == false && document.f2.credit[14].checked == false && document.f2.credit[15].checked == false && document.f2.credit[16].checked == false && document.f2.credit[17].checked == false && document.f2.credit[18].checked == false && document.f2.credit[19].checked == false){
			alert("กรุณาเลือกวิธี ชำระเงินด้วยครับ");
			return false;
		}else if((document.f2.credit[1].checked == true || document.f2.credit[2].checked == true) && document.f2.detail_1.value == ''){
			alert("กรณี ที่ชำระเงินด้วย บัตรเครดิต ให้กรอกข้อมูล หมายเลขเลขบัตรเครดิต ด้วยครับ");
			document.f2.detail_1.focus();
			return false;
		}else if(document.f2.credit[7].checked == true && document.f2.detail_1.value == ''){
			alert("กรณีที่เลือก อื่นๆ ให้กรอกข้อมูล เพิ่มเติม ด้วยครับ");
			document.f2.detail_1.focus();
				}else if(document.f2.credit[6].checked == true && document.f2.detail_1.value == ''){
			alert("กรณีที่เลือก อื่นHD ให้กรอกสิทธิ์ด้วยครับ");
			document.f2.detail_1.focus();
			return false;
			return false;
		}else if(document.f2.credit[0].checked == true && document.f2.detail_3.value == ''){
			alert("กรณีที่เลือก เงินสด ให้กรอกจำนวนเงินที่รับด้วยครับ");
			document.f2.detail_3.focus();
			return false;
		}
		else if(document.f2.credit[8].checked == true){
			
			var checkvar = document.f2.elements['detail_2[]'];
			var r_check = false;
			var j=0;
			for(var i=0;i<checkvar.length;i++){
				if(checkvar[i].checked==true){
					r_check = true;
					j++
				}
			}
			
			if(r_check == false){
				alert("กรณีที่เลือก สวัสดิการทันตกรรม ให้เช็คเครื่องหมายถูกหน้าประเภทการตรวจ เพิ่มเติม ด้วยครับ");
				return false;
			}else if(j >=2){
				alert("ไม่สามารถเลือกประเภทการตรวจฟัน 2 รายการได้ครับ กรุณาออกที่ล่ะใบเสร็จครับ ");
				return false;
			}

		}

	}


</SCRIPT>
<?
    print "รวมเงิน  $sNetprice บาท<br>";

    print "<font face='Angsana New' size='5'><b>(เบิกไม่ได้ $sSumNprice บาท</b>, เบิกได้ $sSumYprice บาท)</font><br>";

    if (substr($sPtright,0,3)=='R03 ' OR 'R09' OR 'R07' OR 'R10' OR 'R11' OR 'R13' OR 'R33'){/********************************************************R03*/
          //$cPaid=$sSumNprice;
          //$cPaid=number_format($cPaid,2,'.','');
          print "<font face='Angsana New' size='5'><b>ผู้ป่วยสิทธิ: $sPtright</b></font><br />";
         /* print "<form name='f1' method='POST' action='opcscd.php' Onsubmit='return checkformf1()'>";

		  print "<INPUT TYPE=\"hidden\" name=\"free_Paid\" value=\"".$sSumYprice."\">";

          print "เก็บเงินส่วนที่เบิกไม่ได้&nbsp;&nbsp;&nbsp; <input type='text' name='paid' size='10' 	                                		value=$cPaid>&nbsp;&nbsp;บาท<br>";
 ///////ใช้บัตรเครดิด
         print "<font face='Angsana New' size='3'>วิธีชำระเงิน ? &nbsp;&nbsp;&nbsp;";
		 print "<TABLE>
		 <TR>
			<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='เงินสด' onclick=\"document.getElementById('detail1').innerHTML=''; detailhead1.style.display='none';document.f1.detail_1.value='';checkptring(this.value);\"></TD>
		 	<TD>เงินสด</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='เช็ค' onclick=\"document.getElementById('detail1').innerHTML='หมายเลขบัตรเครดิต'; detailhead1.style.display='';document.f1.detail_1.focus();checkptring(this.value);\"></TD>
		 	<TD>เช็ค</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='ทหารไทย' onclick=\"document.getElementById('detail1').innerHTML='หมายเลขบัตรเครดิต'; detailhead1.style.display='';document.f1.detail_1.focus();checkptring(this.value);\"></TD>
		 	<TD>บัตรเครดิด ธ.ทหารไทย</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='จ่ายตรง' onclick=\"document.getElementById('detail1').innerHTML=''; detailhead1.style.display='none';document.f1.detail_1.value='';checkptring(this.value);\"></TD>
		 	<TD>จ่ายตรง</TD>
		 	
		 </TR>
		 <TR>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='ประกันสังคม' onclick=\"document.getElementById('detail1').innerHTML=''; detailhead1.style.display='none';document.f1.detail_1.value='';checkptring(this.value);\"></TD>
		 	<TD>ประกันสังคม</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='30บาท' onclick=\"document.getElementById('detail1').innerHTML=''; detailhead1.style.display='none';document.f1.detail_1.value='';checkptring(this.value);\"></TD>
		 	<TD>30บาท</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='HD' onclick=\" detailhead1.style.display='none';document.f1.detail_1.value='';checkptring(this.value);\"></TD>
		 	<TD>HD</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='อื่นๆ' onclick=\"document.getElementById('detail1').innerHTML='ข้อมูลเพิ่มเติม'; detailhead1.style.display='';document.f1.detail_1.focus();checkptring(this.value);\"></TD>
		 	<TD>อื่นๆ</TD>
		 </TR>
		 </TABLE>";
		 print "<span id='detailhead1' style='display:none'><span id='detail1'></span><INPUT TYPE='text' NAME='detail_1'></span>";
  		 print"&nbsp;&nbsp;&nbsp;<br>";
	
$billno='billno';
 $query = "SELECT title,prefix,runno, left(startday,10) as startday2 FROM runno WHERE title = '".$billno."'";
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

		 $billno=$row->runno;
		$title = $row->prefix;
 $billno= $billno+1;
print "<FONT SIZE='3' COLOR='#FF0033'>ถ้าเก็บด้วยใบเสร็จ จะใช้เลขที่ <b>&nbsp;$title$billno &nbsp;</b> ถ้าไม่ถูกต้องให้ทำการเปลี่ยนให้ถูกต้อง</FONT><br>";



////////
		  print "<input type='submit' value='เก็บเงินออกใบเสร็จ ส่วนที่เบิกไม่ได้' name='B1'>";
          print "</form>";*/

//////////////ต้องการเก็บเงินทั้งหมด, ออกใบเสร็จ
          $cPaid=$sNetprice;
          $cPaid=number_format($cPaid,2,'.','');
		print "<b>---------------------------กรณีออกใบเสร็จทั้งหมด-------------------------------</b>";
print "<form name='f2' method='POST' action='opbill3.php' Onsubmit='return checkformf2()'>";
		
		print "<INPUT TYPE=\"hidden\" name=\"free_Paid\" value=\"".$sSumYprice."\">";
		print "<INPUT TYPE=\"hidden\" name=\"aHn\" value=\"".$sHn."\">";
		print "เก็บเงินทั้งหมด&nbsp;&nbsp;&nbsp; <input type='text' name='paid' size='10'		  value=$cPaid>&nbsp;&nbsp;บาท<br>";   //ช่องระบุจำนวนเงินที่เก็บทั้งหมด
		///////ใช้บัตรเครดิด
        print "<font face='Angsana New' size='3'>ใช้บัตรเครดิด ? &nbsp;&nbsp;&nbsp;";
		  print "<TABLE>
		 <TR>
			<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='เงินสด' onclick=\"document.getElementById('detail2').innerHTML='';detailhead2.style.display='none';document.getElementById('detail4').innerHTML='ระบุจำนวนเงินที่รับ';detailhead4.style.display='';document.f2.detail_3.focus();\"></TD>
		 	<TD>เงินสด</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='เช็ค' onclick=\"document.getElementById('detail2').innerHTML='หมายเลขบัตรเครดิต'; detailhead2.style.display='';document.f2.detail_1.focus();checkptring(this.value);detailhead4.style.display='none';\"></TD>
		 	<TD>เช็ค</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='ทหารไทย' onclick=\"document.getElementById('detail2').innerHTML='หมายเลขบัตรเครดิต'; detailhead2.style.display='';document.f2.detail_1.focus();checkptring(this.value);detailhead4.style.display='none';\"></TD>
		 	<TD>บัตรเครดิด ธ.ทหารไทย</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='จ่ายตรง' onclick=\"document.getElementById('detail2').innerHTML=''; detailhead2.style.display='none';document.f2.detail_1.value='';checkptring(this.value);detailhead4.style.display='none';\"></TD>
		 	<TD>จ่ายตรง</TD>
		 	
		 </TR>
		 <TR>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='ประกันสังคม' onclick=\"document.getElementById('detail2').innerHTML=''; detailhead2.style.display='none';document.f2.detail_1.value='';checkptring(this.value);detailhead4.style.display='none';\"></TD>
		 	<TD>ประกันสังคม</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='30บาท' onclick=\"document.getElementById('detail2').innerHTML=''; detailhead2.style.display='none';document.f2.detail_1.value='';checkptring(this.value);detailhead4.style.display='none';\"></TD>
		 	<TD>30บาท</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='HD' onclick=\"document.getElementById('detail2').innerHTML='สิทธิ์'; detailhead2.style.display='';document.f2.detail_1.focus();checkptring(this.value);detailhead4.style.display='none';\"></TD>
		 	<TD>HD</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='อื่นๆ' onclick=\"document.getElementById('detail2').innerHTML='ข้อมูลเพิ่มเติม'; detailhead2.style.display='';document.f2.detail_1.focus();checkptring(this.value);detailhead4.style.display='none';\"></TD>
		 	<TD>อื่นๆ</TD>
		 </TR>
		<TR>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='สวัสดิการทันตกรรม' onclick=\"document.getElementById('detail3').innerHTML='ประเภทการตรวจ'; detailhead3.style.display='';detailhead4.style.display='none';\"></TD>
		 	<TD>สวัสดิการทันตกรรม</TD>
			<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='กท44' onclick=\"document.getElementById('detail2').innerHTML=''; detailhead2.style.display='none';document.f2.detail_1.value='';checkptring(this.value);detailhead4.style.display='none';\"></TD>
		 	<TD>กท.44</TD>
			<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='ค้างจ่าย' onclick=\"detailhead4.style.display='none';\"></TD>
		 	<TD>ค้างจ่าย</TD>
			<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='จ่ายตรง อปท.' onclick=\"document.getElementById('detail2').innerHTML=''; detailhead2.style.display='none';document.f2.detail_1.value='';checkptring(this.value);detailhead4.style.display='none';\"></TD>
		 	<TD>จ่ายตรง อปท.</TD>			
		</TR>
		<TR>
			<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='ตรวจสุขภาพ' onclick=\"detailhead4.style.display='none';\"></TD>
		 	<TD>ตรวจสุขภาพ</TD>		
			<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='CHKUP$nPrefix' onclick=\"detailhead4.style.display='none';\"></TD>
		 	<TD>ตรวจสุขภาพทหารประจำปี$nPrefix</TD>			
			<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='พรบ.' onclick=\"detailhead4.style.display='none';\"></TD>
		 	<TD>พรบ.</TD>	
			<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='ยกเว้น' onclick=\"detailhead4.style.display='none';\"></TD>
		 	<TD>ยกเว้น</TD>	
			<TD>&nbsp;</TD>
			<TD>&nbsp;</TD>		
		 </TR>
		 <TR>
			<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='ทันตสาธารณสุข' onclick=\"detailhead4.style.display='none';\"></TD>
		 	<TD>ทันตสาธารณสุข</TD>		
			<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='โครงการนภา' onclick=\"detailhead4.style.display='none';\"></TD>
		 	<TD>โครงการนภา</TD>		
			<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='นอนโรงพยาบาล' onclick=\"detailhead4.style.display='none';\"></TD>
		 	<TD>นอนโรงพยาบาล</TD>			
			<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='HDLCHKUP$nPrefix' onclick=\"detailhead4.style.display='none';\"></TD>
		 	<TD>HDLCHKUP$nPrefix</TD>	
			<TD>&nbsp;</TD>
			<TD>&nbsp;</TD>												 
		 </TR>
		 </TABLE>";
		 print "<span id='detailhead2' style='display:none'><span id='detail2'></span><INPUT TYPE='text' NAME='detail_1'><BR></span>";
		 print "<span id='detailhead4' style='display:none'><span id='detail4'></span><INPUT TYPE='text' NAME='detail_3'><BR></span>";
		 print "<span id='detailhead3' style='display:none'><span id='detail3'></span>";
		 

		 print "<BR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<INPUT TYPE=\"checkbox\" NAME=\"detail_2[]\" value=\"(67201) อุดฟัน\" ".$detail2_0." >&nbsp;(67201) อุดฟัน";
		 print "<BR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<INPUT TYPE=\"checkbox\" NAME=\"detail_2[]\" value=\"(62101) ถอนฟัน\" ".$detail2_1." >&nbsp;(62101) ถอนฟัน";
		 print "<BR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<INPUT TYPE=\"checkbox\" NAME=\"detail_2[]\" value=\"(64101) ขูดหินปูน\" ".$detail2_2." >&nbsp;(64101) ขูดหินปูน";

		 /*print "<SELECT NAME=\"detail_2\">";
		 print "<option value='(67201) อุดฟัน'>(67201) อุดฟัน</option>";
		 print "<option value='(62101) ถอนฟัน'>(62101) ถอนฟัน</option>";
		 print "<option value='(64101) ขูดหินปูน'>(64101) ขูดหินปูน</option>";
		 print "</SELECT>";*/
		 print "<BR></span>";

$billno='billno';
 $query = "SELECT title,prefix,runno, left(startday,10) as startday2 FROM runno WHERE title = '".$billno."'";
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

		 $billno=$row->runno;
		$title = $row->prefix;
 $billno= $billno+1;
print "<FONT SIZE='3' COLOR='#FF0033'>ถ้าเก็บด้วยใบเสร็จ จะใช้เลขที่ <b>&nbsp;$title$billno &nbsp;</b> ถ้าไม่ถูกต้องให้ทำการเปลี่ยนให้ถูกต้อง</FONT><br>";

print "<FONT SIZE='3' >แสดงจำนวน row ที่จะพิมพ์ใบเสร็จรวมทั้งหมด <FONT SIZE='8'>$item2</FONT> แถว</FONT><br>";

print "<input name='billcur' type='hidden' value='$title$billno'> ";
include("unconnect.inc");
		  if($sPaid > 0){ print "<FONT SIZE='5' COLOR='#FF0033'>บัญชีนี้ได้ทำการบันทึกแล้ว กรุณาตรวจสอบบัญชีก่อนการบันทึก</FONT><br>";};
		////////
		print "<input type='submit' value='เก็บเงินทั้งหมด  ออกใบเสร็จ' name='B1'>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;";
		print "</form>";
			}else {/********************************************************else*/
print "<form name='f2' method='POST' action='opbill3.php' Onsubmit='return checkformf2()'>";
		print "<INPUT TYPE=\"hidden\" name=\"free_Paid\" value=\"".$sSumYprice."\">";
		print "เก็บเงิน&nbsp;&nbsp;&nbsp; <input type='text' name='paid' size='10'		  value=$cPaid>&nbsp;&nbsp;บาท<br>";
		///////ใช้บัตรเครดิด
         print "<font face='Angsana New' size='3'>ใช้บัตรเครดิด ? &nbsp;&nbsp;&nbsp;";
		  print "<TABLE>
		 <TR>
			<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='เงินสด' onclick=\"document.getElementById('detail2').innerHTML='';detailhead2.style.display='none';document.getElementById('detail4').innerHTML='ระบุจำนวนเงินที่รับ';detailhead4.style.display='';document.f2.detail_3.focus();\"></TD>
		 	<TD>เงินสด</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='กรุงเทพ' onclick=\"document.getElementById('detail2').innerHTML='หมายเลขบัตรเครดิต'; detailhead2.style.display='';document.f2.detail_1.focus();checkptring(this.value);detailhead4.style.display='none';\"></TD>
		 	<TD>บัตรเครดิด ธ.กรุงเทพ</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='ทหารไทย' onclick=\"document.getElementById('detail2').innerHTML='หมายเลขบัตรเครดิต'; detailhead2.style.display='';document.f2.detail_1.focus();checkptring(this.value);detailhead4.style.display='none';\"></TD>
		 	<TD>บัตรเครดิด ธ.ทหารไทย</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='จ่ายตรง' onclick=\"document.getElementById('detail2').innerHTML=''; detailhead2.style.display='none';document.f2.detail_1.value='';checkptring(this.value);detailhead4.style.display='none';\"></TD>
		 	<TD>จ่ายตรง</TD>
		 	
		 </TR>
		 <TR>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='ประกันสังคม' onclick=\"document.getElementById('detail2').innerHTML=''; detailhead2.style.display='none';document.f2.detail_1.value='';checkptring(this.value);detailhead4.style.display='none';\"></TD>
		 	<TD>ประกันสังคม</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='30บาท' onclick=\"document.getElementById('detail2').innerHTML=''; detailhead2.style.display='none';document.f2.detail_1.value='';checkptring(this.value);detailhead4.style.display='none';\"></TD>
		 	<TD>30บาท</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='เงินเชื่อ' onclick=\"document.getElementById('detail2').innerHTML='ข้อมูลเพิ่มเติม'; detailhead2.style.display='';document.f2.detail_1.focus();checkptring(this.value);detailhead4.style.display='none';\"></TD>
		 	<TD>เงินเชื่อ</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='อื่นๆ' onclick=\"document.getElementById('detail2').innerHTML='ข้อมูลเพิ่มเติม'; detailhead2.style.display='';document.f2.detail_1.focus();checkptring(this.value);detailhead4.style.display='none';\"></TD>
		 	<TD>อื่นๆ</TD>
		 </TR>
		<TR>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='สวัสดิการทันตกรรม' onclick=\"document.getElementById('detail3').innerHTML='ประเภทการตรวจ'; detailhead3.style.display='';detailhead4.style.display='none';\"></TD>
		 	<TD>สวัสดิการทันตกรรม</TD>
			<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='ค้างจ่าย' onclick=\"detailhead4.style.display='none';\"></TD>
		 	<TD>ค้างจ่าย</TD>
		 </TR>
		 </TABLE>";
		 print "<span id='detailhead2' style='display:none'><span id='detail2'></span><INPUT TYPE='text' NAME='detail_1'><BR></span>";
		 print "<span id='detailhead4' style='display:none'><span id='detail4'></span><INPUT TYPE='text' NAME='detail_3'><BR></span>";
		 print "<span id='detailhead3' style='display:none'><span id='detail3'></span>";

		 print "<INPUT TYPE=\"checkbox\" NAME=\"detail_2[]\" value=\"(67201) อุดฟัน\" ".$detail2_0." >&nbsp;(67201) อุดฟัน";
		 print "<INPUT TYPE=\"checkbox\" NAME=\"detail_2[]\" value=\"(62101) ถอนฟัน\" ".$detail2_1." >&nbsp;(62101) ถอนฟัน";
		 print "<INPUT TYPE=\"checkbox\" NAME=\"detail_2[]\" value=\"(64101) ขูดหินปูน\" ".$detail2_2." >&nbsp;(64101) ขูดหินปูน";

		 //print "<SELECT NAME=\"detail_2\"><option value='อุดฟัน'>อุดฟัน</option><option value='ถอนฟัน'>ถอนฟัน</option><option value='ขูดหินปูน'>ขูดหินปูน</option></SELECT>";
		 
		 print "<BR></span>";
		 
		 
		 	 if($sPaid > 0){ print "<FONT SIZE='5' COLOR='#FF0033'>บัญชีนี้ได้ทำการบันทึกแล้ว กรุณาตรวจสอบบัญชีก่อนการบันทึก</FONT><br>";};
		
		////////
		print "<input type='submit' value='เก็บเงิน  ออกใบเสร็จ' name='B1'>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;";
		print "</form>";
		
		}
	}
?>


