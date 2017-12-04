<?php
    session_start();
    if (isset($sIdname)){} else {die;} //for security
//oprxitem.php
    session_unregister("dDate");  
    session_unregister("sHn");   
    session_unregister("sAn");
	session_unregister("sVn");
    session_unregister("sPtright");
    session_unregister("sPtname");
    session_unregister("sDoctor");
    session_unregister("sEssd");
    session_unregister("sNessdy");
    session_unregister("sNessdn");
    session_unregister("sDPY");
    session_unregister("sDPN");
    session_unregister("sDSY");
    session_unregister("sDSN");
    session_unregister("sNetprice");
    session_unregister("sDiag"); 
    session_unregister("sAccno"); 
    session_unregister("sRow_id"); 
    session_unregister("sRow"); 
    session_unregister("x");
    session_unregister("aDgcode");
    session_unregister("aTrade");
    session_unregister("aPrice");
    session_unregister("aPart");
    session_unregister("aAmount");
    session_unregister("aSlipcode");
    session_unregister("aMoney"); 
//   
    $dDate=$sDate;
    $sHn="";
    $sAn="";
    $sPtright="";
    $sPtname="";
    $sDoctor="";
    $sEssd="";
    $sNessdy="";
    $sNessdn="";
    $sNetprice="";
    $sDPY="";
    $sDPN="";  
  
    $sDSY="";
    $sDSN="";    

    $sDiag="";
    $sRow_id=$nRow_id;
    $sAccno=$nAccno;

    $x=0;
    $aDgcode = array("รหัสยา");
    $aTrade  = array("      ชื่อการค้า");
    $aPrice  = array("                          ราคาขาย  ");
    $aPart = array("part");
    $aAmount = array("        จำนวน   ");
    $aSlipcode = array("        วิธีใช้   ");
    $aMoney= array("       รวมเงิน   ");
    $sRow=array("row_id of ipacc");

    session_register("dDate");  
    session_register("sHn");   
    session_register("sAn");
	session_register("sVn");
    session_register("sPtright");
    session_register("sPtname");
    session_register("sDoctor");
    session_register("sEssd");
    session_register("sNessdy");
    session_register("sNessdn");
    session_register("sDPY");
    session_register("sDPN");
    session_register("sDSY");
    session_register("sDSN");
    session_register("sNetprice");
    session_register("sDiag"); 
    session_register("sAccno"); 
    session_register("sRow_id"); 
    session_register("sRow"); 

    session_register("x");
    session_register("aDgcode");
    session_register("aTrade");
    session_register("aPrice");
    session_register("aPart");
    session_register("aAmount");
    session_register("aSlipcode");
    session_register("aMoney");
   
    include("connect.inc");
  
 $query = "SELECT * FROM dphardep_pt WHERE row_id = '$nRow_id'  "; 
 // $query = "SELECT * FROM phardep WHERE row_id = '$nRow_id'  "; 
// echo $query."<br>";
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
    $sHn=$row->hn;
    $sAn=$row->an;
    $sPtright=$row->ptright;
    $sPtname=$row->ptname;
    $sDoctor=$row->doctor;
    $sEssd=$row->essd;
    $sNessdy=$row->nessdy;
    $sNessdn=$row->nessdn;
    $sDPY=$row->dpy;
    $sDPN=$row->dpn;     
    $sDSY=$row->dsy;
    $sDSN=$row->dsn;     
    $sNetprice=$row->price;
	 $sPaid=$row->paid;
    $sDiag=$row->diag;
	$_SESSION["sVn"]=$row->tvn;


	 if($sPaid > 0){ print "บัญชีนี้ได้ทำการบันทึกแล้ว กรุณาตรวจสอบบัญชีก่อนการบันทึก<br>";};

?>
<SCRIPT LANGUAGE="JavaScript">
	
	function checkptring(opt){
		
		var pt = '<?php echo substr($sPtright,0,3);?>';
		var pt2 = '<?php echo substr($sPtright,3);?>';

			if( (pt == "R01" || pt == "R02" || pt == "R04" || pt == "R05" || pt == "R06" || pt == "R16" || pt == "R20" || pt == "R021" || pt == "R15" ) && opt != "เงินสด"){
				
				alert("สิทธิ์ของผู้ป่วยคือ "+pt2);

			}else if( pt == "R03"  && opt != 'จ่ายตรง' ){

				alert("สิทธิ์ของผู้ป่วยคือ "+pt2);

			}else if(  pt == "R07" && opt != 'ประกันสังคม' ){

				alert("สิทธิ์ของผู้ป่วยคือ "+pt2);

			}else if(  (pt == "R09" || pt == "R13" || pt == "R11" || pt == "R10" || pt == "R17") && opt != '30บาท' ){

				alert("สิทธิ์ของผู้ป่วยคือ "+pt2);

			}

	}

	function checkformf1(){
		
		if(document.f1.credit[0].checked == false && document.f1.credit[1].checked == false && document.f1.credit[2].checked == false && document.f1.credit[3].checked == false && document.f1.credit[4].checked == false && document.f1.credit[5].checked == false && document.f1.credit[6].checked == false && document.f1.credit[7].checked == false && document.f1.credit[8].checked == false){
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
		
		if(document.f2.credit[0].checked == false && document.f2.credit[1].checked == false && document.f2.credit[2].checked == false && document.f2.credit[3].checked == false && document.f2.credit[4].checked == false && document.f2.credit[5].checked == false && document.f2.credit[6].checked == false && document.f2.credit[7].checked == false && document.f2.credit[8].checked == false){
			alert("กรุณาเลือกวิธี ชำระเงินด้วยครับ");
			return false;
		}else if((document.f2.credit[1].checked == true || document.f2.credit[2].checked == true) && document.f2.detail_1.value == ''){
			alert("กรณี ที่ชำระเงินด้วย บัตรเครดิต ให้กรอกข้อมูล หมายเลขเลขบัตรเครดิต ด้วยครับ");
			document.f2.detail_1.focus();
			return false;
		}else if(document.f2.credit[7].checked == true && document.f2.detail_1.value == ''){
			alert("กรณีที่เลือก อื่นๆ ให้กรอกข้อมูล เพิ่มเติม ด้วยครับ");
			document.f2.detail_1.focus();
			return false;
		}
		else if(document.f2.credit[8].checked == true && document.f2.detail_1.value == ''){
			alert("กรณีที่เลือก อื่นๆ ให้กรอกข้อมูล เพิ่มเติม ด้วยครับ");
			document.f2.detail_1.focus();
			return false;
		}

	}


</SCRIPT>
<table>
 <tr>
  <th bgcolor=CD853F><font face='Angsana New'>รายการ</th>
  <th bgcolor=CD853F><font face='Angsana New'>จำนวน</th>
  <th bgcolor=CD853F><font face='Angsana New'>ราคา</th>
  <th bgcolor=CD853F><font face='Angsana New'>เบิกได้?</th>
 </tr>
<?php
    $query = "SELECT drugcode,tradname,amount,price,part FROM ddrugrx_pt WHERE idno = '$nRow_id' AND date = '".$_GET["sDate"]."' ";
	 // $query = "SELECT drugcode,tradname,amount,price,part FROM drugrx WHERE idno = '$nRow_id' AND date = '".$_GET["sDate"]."' ";
	//echo $query;
    $result = mysql_query($query)
        or die("Query failed");

    print "<font face='Angsana New'>$sPtname<br> ";
    $ptright=substr($sPtright,4);
    $doctor=substr($sDoctor,5);
    print "HN: $sHn, สิทธิ์:$ptright<br>";
    print "โรค: $sDiag, แพทย์ :$doctor<br>";

	$dpyaa=array();
	session_register("dpyaa");
    while (list ($drugcode,$tradname,$amount, $price,$part) = mysql_fetch_row ($result)) {
//        array_push($aPrice,$price);
//        $x++;
			$sql="select dpy_code from druglst where drugcode like '%$drugcode%'";
			$qresult = mysql_query($sql);
			$numrow=mysql_num_rows($qresult);
			
			
			list ($dpy_code) = mysql_fetch_row ($qresult);
			if($numrow){
				
				array_push($dpyaa,$dpy_code);

			}

        print (" <tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$tradname  $dpy_code</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$amount</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$part</td>\n".
           " </tr>\n");
      }

    /*if (empty($sAn) && $sNetprice > 0){
        print (" <tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>(55020/55021)ค่าบริการผู้ป่วยนอก</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>1</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>50.00</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>เบิกได้</td>\n".
           " </tr>\n");
                           }
//กรณีคืนยา จะติดลบ
    if (empty($sAn) && $sNetprice < 0){
        print (" <tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>(55020/55021)ค่าบริการผู้ป่วยนอก</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>-1</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>-50.00</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>เบิกได้</td>\n".
           " </tr>\n");
                           }*/
    include("unconnect.inc");
?>
</table>
<?php
    $pay=$sNessdn+$sDPN+$sDSN;

//  OPD CASE
    if (empty($sAn) && $sNetprice > 0){
           $xNetpri=$sNetprice;
           $cPaid=$sNetprice; //opd case เก็บ 50 บาท
           $free=$sEssd+$sNessdy+$sDPY+$sDSY;
                            }

    if (empty($sAn) && $sNetprice < 0){
           $xNetpri=$sNetprice;
           $cPaid=$sNetprice; //opd case คืนยา,  คืนเงิน 50 บาท
           $free=$sEssd+$sNessdy+$sDPY+$sDSY;
                            }
//  IPD CASE
    if (!empty($sAn) && $sNetprice > 0){
           $xNetpri=$sNetprice;
           $cPaid=$sNetprice;
           $free=$sEssd+$sNessdy+$sDPY+$sDSY+$sDSN;
      $pay=$sNessdn+$sDPN;
                            }
//ipd case คืนยา
    if (!empty($sAn) && $sNetprice < 0){
           $xNetpri=$sNetprice;
           $cPaid=$sNetprice;
           $free=$sEssd+$sNessdy+$sDPY+$sDSY+$sDSN;
      $pay=$sNessdn+$sDPN;
                            }

    $cPaid=number_format($cPaid,2,'.','');
    print "รวมงิน  $xNetpri บาท (<font face='Angsana New' size='5'><b>เบิกไม่ได้ $pay บาท</b>, เบิกได้ $free บาท)<br>";
	
	 if (substr($sPtright,0,3)=='R03 ' OR 'R09' OR 'R07' OR 'R10' OR 'R11' OR 'R13'){
		$cPaid= $pay;
          $cPaid=number_format($cPaid,2,'.','');
          print "<font face='Angsana New' size='5'><b>ผู้ป่วยสิทธิ: $ptright</b>";

          print "<form name='f1' method='POST' action='oprxcscd.php' Onsubmit='return checkformf1()'>";

		  print "เก็บเงินส่วนที่เบิกไม่ได้&nbsp;&nbsp;&nbsp;";
		  $submit = "เก็บเงินออกใบเสร็จ ส่วนที่เบิกไม่ได้";
	 }else{
		 print "<form  name='f1'  method='POST' action='oprxbill.php' Onsubmit='return checkformf1()'>";
          print "เก็บเงิน&nbsp;&nbsp;&nbsp; ";
		  $submit = "เก็บเงิน  ออกใบเสร็จ";

	 }
	
		print "<input type='text' name='xpaid' size='10' value=$cPaid>&nbsp;&nbsp;บาท<br>";
		   ///////ใช้บัตรเครดิด
		  print "<INPUT TYPE=\"hidden\" name=\"free_Paid\" value=\"".$free."\">";

         print "<font face='Angsana New' size='3'>วิธีชำระเงิน ? &nbsp;&nbsp;&nbsp;";
		 print "<TABLE>
		 <TR>
			<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='เงินสด' onclick=\"document.getElementById('detail1').innerHTML=''; detailhead1.style.display='none';document.f1.detail_1.value='';checkptring(this.value);\"></TD>
		 	<TD>เงินสด</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='เช็ค' onclick=\"document.getElementById('detail1').innerHTML='หมายเลขเช็ค'; detailhead1.style.display='';document.f1.detail_1.focus();checkptring(this.value);\"></TD>
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
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='HD' onclick=\"document.getElementById('detail1').innerHTML=''; detailhead1.style.display='none';document.f1.detail_1.value='';checkptring(this.value);\"></TD>
		 	<TD>HD</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='อื่นๆ' onclick=\"document.getElementById('detail1').innerHTML='ข้อมูลเพิ่มเติม'; detailhead1.style.display='';document.f1.detail_1.focus();checkptring(this.value);\"></TD>
		 	<TD>อื่นๆ</TD>
			<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='ยกเว้น' onclick=\"document.getElementById('detail1').innerHTML='ข้อมูลเพิ่มเติม'; detailhead1.style.display='';document.f1.detail_1.focus();checkptring(this.value);\"></TD>
		 	<TD>ยกเว้น</TD>
		 </TR>
		 </TABLE>";
		 print "<span id='detailhead1' style='display:none'><span id='detail1'></span><INPUT TYPE='text' NAME='detail_1'></span>";
  		 print"&nbsp;&nbsp;&nbsp;<br>";
////////
 include("connect.inc");
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


include("unconnect.inc");
          print "<input type='submit' value='$submit' name='B1'>";
          print "</form>";

   
?>
<?php
    $pay=$sNessdn+$sDPN+$sDSN;

//  OPD CASE
    if (empty($sAn) && $sNetprice > 0){
           $xNetpri=$sNetprice;
           $cPaid=$sNetprice; //opd case เก็บ 50 บาท
           $free=$sEssd+$sNessdy+$sDPY+$sDSY;
                            }

    if (empty($sAn) && $sNetprice < 0){
           $xNetpri=$sNetprice;
           $cPaid=$sNetprice; //opd case คืนยา,  คืนเงิน 50 บาท
           $free=$sEssd+$sNessdy+$sDSY+$sDPY;
                            }
//  IPD CASE
    if (!empty($sAn) && $sNetprice > 0){
           $xNetpri=$sNetprice;
           $cPaid=$sNetprice;
           $free=$sEssd+$sNessdy+$sDPY+$sDSY+$sDSN;
      $pay=$sNessdn+$sDPN;
                            }
//ipd case คืนยา
    if (!empty($sAn) && $sNetprice < 0){
           $xNetpri=$sNetprice;
           $cPaid=$sNetprice;
           $free=$sEssd+$sNessdy+$sDPY+$sDSY+$sDSN;
      $pay=$sNessdn+$sDPN;
                            }

    $cPaid=number_format($cPaid,2,'.','');
    print "รวมงิน  $xNetpri บาท (<font face='Angsana New' size='5'><b>เบิกไม่ได้ $pay บาท</b>, เบิกได้ $free บาท)<br>";


          print "<form name='f2' method='POST' action='oprxbill.php'>";
          print "เก็บเงิน&nbsp;&nbsp;&nbsp; <input type='text' name='xpaid' size='10' value=$cPaid>&nbsp;&nbsp;บาท<br>";
		   ///////ใช้บัตรเครดิด
		   print "<INPUT TYPE=\"hidden\" name=\"free_Paid\" value=\"".$free."\">";
         print "<font face='Angsana New' size='3'>ใช้บัตรเครดิด ? &nbsp;&nbsp;&nbsp;";
		  print "<TABLE>
		 <TR>
			<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='เงินสด' onclick=\"document.getElementById('detail2').innerHTML=''; detailhead2.style.display='none';document.f2.detail_1.value='';checkptring(this.value);\"></TD>
		 	<TD>เงินสด</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='เช็ค' onclick=\"document.getElementById('detail2').innerHTML='หมายเลขเช็ค'; detailhead2.style.display='';document.f2.detail_1.focus();checkptring(this.value);\"></TD>
		 	<TD>เช็ค</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='ทหารไทย' onclick=\"document.getElementById('detail2').innerHTML='หมายเลขบัตรเครดิต'; detailhead2.style.display='';document.f2.detail_1.focus();checkptring(this.value);\"></TD>
		 	<TD>บัตรเครดิด ธ.ทหารไทย</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='จ่ายตรง' onclick=\"document.getElementById('detail2').innerHTML=''; detailhead2.style.display='none';document.f2.detail_1.value='';checkptring(this.value);\"></TD>
		 	<TD>จ่ายตรง</TD>
		 	
		 </TR>
		 <TR>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='ประกันสังคม' onclick=\"document.getElementById('detail2').innerHTML=''; detailhead2.style.display='none';document.f2.detail_1.value='';checkptring(this.value);\"></TD>
		 	<TD>ประกันสังคม</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='30บาท' onclick=\"document.getElementById('detail2').innerHTML=''; detailhead2.style.display='none';document.f2.detail_1.value='';checkptring(this.value);\"></TD>
		 	<TD>30บาท</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='HD' onclick=\"document.getElementById('detail2').innerHTML=''; detailhead2.style.display='none';document.f2.detail_1.value='';checkptring(this.value);\"></TD>
		 	<TD>HD</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='อื่นๆ' onclick=\"document.getElementById('detail2').innerHTML='ข้อมูลเพิ่มเติม'; detailhead2.style.display='';document.f2.detail_1.focus();checkptring(this.value);\"></TD>
		 	<TD>อื่นๆ</TD>
			<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='ค้างจ่าย'\"></TD>
		 	<TD>ค้างจ่าย</TD>
		 </TR>
		 </TABLE>";
		 print "<span id='detailhead2' style='display:none'><span id='detail2'></span><INPUT TYPE='text' NAME='detail_1'><BR></span>";
 include("connect.inc");
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


include("unconnect.inc");

////////
	 if($sPaid > 0){ print "<FONT SIZE='5' COLOR='#FF0033'>บัญชีนี้ได้ทำการบันทึกแล้ว กรุณาตรวจสอบบัญชีก่อนการบันทึก</FONT><br>";};

          //print "<input type='submit' value='เก็บเงิน  ออกใบเสร็จ กรณีเก็บเต็มจำนวน' name='B1'>";
          print "</form>";


    print "<font face='Angsana New' size='1'>DDL =  ยาในบัญชียาหลักแห่งชาติ เบิกได้<br>";
    print "DDY =  ยานอกบัญชียาหลักแห่งชาติ เบิกได้<br>";
    print "DDN =  ยานอกบัญชียาหลักแห่งชาติ เบิกไม่ได้<br>";
    print "DPY =  อุปกรณ์ ที่เบิกได้(เบิกได้ทั้งหมดหรือบางส่วน)<br>";
    print "DPN =  อุปกรณ์ ที่เบิกไม่ได้ <br>";
    print "DSY =  เวชภัณฑ์ เบิกไม่ได้<br>";
    print "DSN =  เวชภัณฑ์ เบิกไม่ได้";

?>

