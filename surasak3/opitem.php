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

//////  
    $dDate=$sDate;
    $sHn="";
    $sAn="";
    $sPtname="";
    $sPtright="";
    $sDoctor="";
/*
    $sEssd="";
    $sNessdy="";
    $sNessdn="";
    $sNetprice="";
    $sDPY="";
    $sDPN="";     
*/
    $sDepart="";
    $sDetail="";
    $sDiag="";
    $sRow_id=$nRow_id;
    $sAccno=$nAccno;
  
    $x=0;
    $aDgcode = array("รหัสยา");
    $aTrade  = array("      ชื่อการค้า");
    $aPrice  = array("                          ราคาขาย  ");

    $sSumYprice = "";
    $sSumNprice = "";
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
    session_register("sRow_id"); 
    session_register("sRow"); 
    session_register("sAccno");  

    session_register("x");
    session_register("aDgcode");
    session_register("aTrade");
    session_register("aPrice");
    session_register("aPart");
    session_register("aAmount");
//    session_register("aSlipcode");
    session_register("aMoney");
   
    include("connect.inc");
  
 $query = "SELECT * FROM depart WHERE row_id = '$nRow_id' ";
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
    $sPtname=$row->ptname;
    $sPtright=$row->ptright;
    $sDoctor=$row->doctor;
    $sDepart=$row->depart;
    $sDetail=$row->detail;  
    $sNetprice=$row->price;
    $sPaid=$row->paid;
    $sSumYprice=$row->sumyprice;
    $sSumNprice=$row->sumnprice;

    $sDiag=$row->diag;
	$_SESSION["sVn"]=$row->tvn;

    $cPaid=$sNetprice;
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
		
		if(document.f2.credit[0].checked == false && document.f2.credit[1].checked == false && document.f2.credit[2].checked == false && document.f2.credit[3].checked == false && document.f2.credit[4].checked == false && document.f2.credit[5].checked == false && document.f2.credit[6].checked == false && document.f2.credit[7].checked == false && document.f2.credit[8].checked == false && document.f2.credit[9].checked == false){
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
		}else if(document.f2.credit[8].checked == true){
			
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
			}else if(j >=3){
				alert("ไม่สามารถเลือกประเภทการตรวจฟัน 3 รายการได้ครับ กรุณาเลือกเพียง 2 รายการเนื่องจาก  ระบบยังไม่รองรับ ");
				return false;
			}

		}

	}


</SCRIPT>
<table>
 <tr>
  <th bgcolor=CD853F>รายการ</th>
  <th bgcolor=CD853F>จำนวน</th>
  <th bgcolor=CD853F>ราคา</th>
  <th bgcolor=9999CC>เบิกได้</th>
  <th bgcolor=9999CC>เบิกไม่ได้</th>
 </tr>

<?php
    $query = "SELECT code,detail,amount,price,yprice,nprice FROM patdata WHERE idno = '$nRow_id' ";
    $result = mysql_query($query)
        or die("Query failed");

    print "$sPtname, HN: $sHn<br> ";
    print "โรค: $sDiag, แพทย์ :$sDoctor<br>";
//    print "แพทย์ :$sDoctor<br><br>";

    while (list ($code, $detail,$amount, $price,$yprice,$nprice) = mysql_fetch_row ($result)) {
        print (" <tr>\n".

           "  <td BGCOLOR=F5DEB3>$detail</td>\n".
           "  <td BGCOLOR=F5DEB3>$amount</td>\n".
           "  <td BGCOLOR=F5DEB3>$price</td>\n".
           "  <td BGCOLOR=99CCCC>$yprice</td>\n".
           "  <td BGCOLOR=99CCCC>$nprice</td>\n".
		   " </tr>\n");

		   switch($code){
				case '67201':  $detail2_0 = " Checked "; break;
				case '62101':  $detail2_1 = " Checked "; break;
				case '64101':  $detail2_2 = " Checked "; break;
		   }

      }
    include("unconnect.inc");
?>
</table>

<?php
    print "รวมงิน  $sNetprice บาท<br>";

    print "<font face='Angsana New' size='5'><b>(เบิกไม่ได้ $sSumNprice บาท</b>, เบิกได้$sSumYprice บาท)<br>";

    if (substr($sPtright,0,3)=='R03 ' OR 'R09' OR 'R07' OR 'R10' OR 'R11' OR 'R13' ){/********************************************************R03*/
          $cPaid=$sSumNprice;
          $cPaid=number_format($cPaid,2,'.','');
          print "<font face='Angsana New' size='5'><b>ผู้ป่วยสิทธิ: $sPtright</b>";
          print "<form name='f1' method='POST' action='opcscd.php' Onsubmit='return checkformf1()'>";

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
		  print "<input type='submit' value='เก็บเงินออกใบเสร็จ ส่วนที่เบิกไม่ได้' name='B1'>";
          print "</form>";

//////////////ต้องการเก็บเงินทั้งหมด, ออกใบเสร็จ
          $cPaid=$sNetprice;
          $cPaid=number_format($cPaid,2,'.','');
		print "<b>---------------------------กรณีออกใบเสร็จทั้งหมด-------------------------------</b>";
		print "<form name='f2' method='POST' action='opbill.php' Onsubmit='return checkformf2()'>";
		
		print "<INPUT TYPE=\"hidden\" name=\"free_Paid\" value=\"".$sSumYprice."\">";

		print "เก็บเงินทั้งหมด&nbsp;&nbsp;&nbsp; <input type='text' name='paid' size='10'		  value=$cPaid>&nbsp;&nbsp;บาท<br>";
		///////ใช้บัตรเครดิด
        print "<font face='Angsana New' size='3'>ใช้บัตรเครดิด ? &nbsp;&nbsp;&nbsp;";
		  print "<TABLE>
		 <TR>
			<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='เงินสด' onclick=\"document.getElementById('detail2').innerHTML=''; detailhead2.style.display='none';document.f2.detail_1.value='';checkptring(this.value);\"></TD>
		 	<TD>เงินสด</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='เช็ค' onclick=\"document.getElementById('detail2').innerHTML='หมายเลขบัตรเครดิต'; detailhead2.style.display='';document.f2.detail_1.focus();checkptring(this.value);\"></TD>
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
		 </TR>
		<TR>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='สวัสดิการทันตกรรม' onclick=\"document.getElementById('detail3').innerHTML='ประเภทการตรวจ'; detailhead3.style.display='';\"></TD>
		 	<TD>สวัสดิการทันตกรรม</TD>
			<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='ค้างจ่าย'\"></TD>
		 	<TD>ค้างจ่าย</TD>
		 </TR>
		 </TABLE>";
		 print "<span id='detailhead2' style='display:none'><span id='detail2'></span><INPUT TYPE='text' NAME='detail_1'><BR></span>";
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
		  if($sPaid > 0){ print "<FONT SIZE='5' COLOR='#FF0033'>บัญชีนี้ได้ทำการบันทึกแล้ว กรุณาตรวจสอบบัญชีก่อนการบันทึก</FONT><br>";};
		////////
		print "<input type='submit' value='เก็บเงินทั้งหมด  ออกใบเสร็จ' name='B1'>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;";
		print "</form>";
			}			
    else {/********************************************************else*/
		print "<form name='f2' method='POST' action='opbill.php' Onsubmit='return checkformf2()'>";
		print "<INPUT TYPE=\"hidden\" name=\"free_Paid\" value=\"".$sSumYprice."\">";
		print "เก็บเงิน&nbsp;&nbsp;&nbsp; <input type='text' name='paid' size='10'		  value=$cPaid>&nbsp;&nbsp;บาท<br>";
		///////ใช้บัตรเครดิด
         print "<font face='Angsana New' size='3'>ใช้บัตรเครดิด ? &nbsp;&nbsp;&nbsp;";
		  print "<TABLE>
		 <TR>
			<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='เงินสด' onclick=\"document.getElementById('detail2').innerHTML=''; detailhead2.style.display='none';document.f2.detail_1.value='';checkptring(this.value);\"></TD>
		 	<TD>เงินสด</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='กรุงเทพ' onclick=\"document.getElementById('detail2').innerHTML='หมายเลขบัตรเครดิต'; detailhead2.style.display='';document.f2.detail_1.focus();checkptring(this.value);\"></TD>
		 	<TD>บัตรเครดิด ธ.กรุงเทพ</TD>
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
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='เงินเชื่อ' onclick=\"document.getElementById('detail2').innerHTML='ข้อมูลเพิ่มเติม'; detailhead2.style.display='';document.f2.detail_1.focus();checkptring(this.value);\"></TD>
		 	<TD>เงินเชื่อ</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='อื่นๆ' onclick=\"document.getElementById('detail2').innerHTML='ข้อมูลเพิ่มเติม'; detailhead2.style.display='';document.f2.detail_1.focus();checkptring(this.value);\"></TD>
		 	<TD>อื่นๆ</TD>
		 </TR>
		<TR>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='สวัสดิการทันตกรรม' onclick=\"document.getElementById('detail3').innerHTML='ประเภทการตรวจ'; detailhead3.style.display='';\"></TD>
		 	<TD>สวัสดิการทันตกรรม</TD>
			<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='ค้างจ่าย'\"></TD>
		 	<TD>ค้างจ่าย</TD>
		 </TR>
		 </TABLE>";
		 print "<span id='detailhead2' style='display:none'><span id='detail2'></span><INPUT TYPE='text' NAME='detail_1'><BR></span>";
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
		 
?>


