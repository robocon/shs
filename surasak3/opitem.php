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
    $aDgcode = array("������");
    $aTrade  = array("      ���͡�ä��");
    $aPrice  = array("                          �ҤҢ��  ");

    $sSumYprice = "";
    $sSumNprice = "";
    session_register("sSumYprice");
    session_register("sSumNprice");

    $aPart = array("part");
    $aAmount = array("        �ӹǹ   ");
//    $aSlipcode = array("        �Ը���   ");
    $aMoney= array("       ����Թ   ");
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

			if( (pt == "R01" || pt == "R02" || pt == "R04" || pt == "R05" || pt == "R06" || pt == "R16" || pt == "R20" || pt == "R021" || pt == "R15" ) && opt != "�Թʴ"){
				
				alert("�Է���ͧ�����¤�� "+pt2);

			}else if( pt == "R03"  && opt != '���µç' ){

				alert("�Է���ͧ�����¤�� "+pt2);

			}else if(  pt == "R07" && opt != '��Сѹ�ѧ��' ){

				alert("�Է���ͧ�����¤�� "+pt2);

			}else if(  (pt == "R09" || pt == "R13" || pt == "R11" || pt == "R10" || pt == "R17") && opt != '30�ҷ' ){

				alert("�Է���ͧ�����¤�� "+pt2);

			}

	}

	function checkformf1(){
		
		if(document.f1.credit[0].checked == false && document.f1.credit[1].checked == false && document.f1.credit[2].checked == false && document.f1.credit[3].checked == false && document.f1.credit[4].checked == false && document.f1.credit[5].checked == false && document.f1.credit[6].checked == false && document.f1.credit[7].checked == false){
			alert("��س����͡�Ը� �����Թ���¤�Ѻ");
			return false;
		}else if((document.f1.credit[1].checked == true || document.f1.credit[2].checked == true) && document.f1.detail_1.value == ''){
			alert("�ó� �������Թ���� �ѵ��ôԵ ����͡������ �����Ţ�Ţ�ѵ��ôԵ ���¤�Ѻ");
			document.f1.detail_1.focus();
			return false;
		}else if(document.f1.credit[7].checked == true && document.f1.detail_1.value == ''){
			alert("�óշ�����͡ ���� ����͡������ ������� ���¤�Ѻ");
			document.f1.detail_1.focus();
			return false;
		}

	}

	function checkformf2(){
		
		if(document.f2.credit[0].checked == false && document.f2.credit[1].checked == false && document.f2.credit[2].checked == false && document.f2.credit[3].checked == false && document.f2.credit[4].checked == false && document.f2.credit[5].checked == false && document.f2.credit[6].checked == false && document.f2.credit[7].checked == false && document.f2.credit[8].checked == false && document.f2.credit[9].checked == false){
			alert("��س����͡�Ը� �����Թ���¤�Ѻ");
			return false;
		}else if((document.f2.credit[1].checked == true || document.f2.credit[2].checked == true) && document.f2.detail_1.value == ''){
			alert("�ó� �������Թ���� �ѵ��ôԵ ����͡������ �����Ţ�Ţ�ѵ��ôԵ ���¤�Ѻ");
			document.f2.detail_1.focus();
			return false;
		}else if(document.f2.credit[7].checked == true && document.f2.detail_1.value == ''){
			alert("�óշ�����͡ ���� ����͡������ ������� ���¤�Ѻ");
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
				alert("�óշ�����͡ ���ʴԡ�÷ѹ����� ���������ͧ���¶١˹�һ�������õ�Ǩ ������� ���¤�Ѻ");
				return false;
			}else if(j >=3){
				alert("�������ö���͡��������õ�Ǩ�ѹ 3 ��¡�����Ѻ ��س����͡��§ 2 ��¡�����ͧ�ҡ  �к��ѧ����ͧ�Ѻ ");
				return false;
			}

		}

	}


</SCRIPT>
<table>
 <tr>
  <th bgcolor=CD853F>��¡��</th>
  <th bgcolor=CD853F>�ӹǹ</th>
  <th bgcolor=CD853F>�Ҥ�</th>
  <th bgcolor=9999CC>�ԡ��</th>
  <th bgcolor=9999CC>�ԡ�����</th>
 </tr>

<?php
    $query = "SELECT code,detail,amount,price,yprice,nprice FROM patdata WHERE idno = '$nRow_id' ";
    $result = mysql_query($query)
        or die("Query failed");

    print "$sPtname, HN: $sHn<br> ";
    print "�ä: $sDiag, ᾷ�� :$sDoctor<br>";
//    print "ᾷ�� :$sDoctor<br><br>";

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
    print "����Թ  $sNetprice �ҷ<br>";

    print "<font face='Angsana New' size='5'><b>(�ԡ����� $sSumNprice �ҷ</b>, �ԡ��$sSumYprice �ҷ)<br>";

    if (substr($sPtright,0,3)=='R03 ' OR 'R09' OR 'R07' OR 'R10' OR 'R11' OR 'R13' ){/********************************************************R03*/
          $cPaid=$sSumNprice;
          $cPaid=number_format($cPaid,2,'.','');
          print "<font face='Angsana New' size='5'><b>�������Է��: $sPtright</b>";
          print "<form name='f1' method='POST' action='opcscd.php' Onsubmit='return checkformf1()'>";

		  print "<INPUT TYPE=\"hidden\" name=\"free_Paid\" value=\"".$sSumYprice."\">";

          print "���Թ��ǹ����ԡ�����&nbsp;&nbsp;&nbsp; <input type='text' name='paid' size='10' 	                                		value=$cPaid>&nbsp;&nbsp;�ҷ<br>";
 ///////��ѵ��ôԴ
         print "<font face='Angsana New' size='3'>�Ըժ����Թ ? &nbsp;&nbsp;&nbsp;";
		 print "<TABLE>
		 <TR>
			<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='�Թʴ' onclick=\"document.getElementById('detail1').innerHTML=''; detailhead1.style.display='none';document.f1.detail_1.value='';checkptring(this.value);\"></TD>
		 	<TD>�Թʴ</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='��' onclick=\"document.getElementById('detail1').innerHTML='�����Ţ�ѵ��ôԵ'; detailhead1.style.display='';document.f1.detail_1.focus();checkptring(this.value);\"></TD>
		 	<TD>��</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='������' onclick=\"document.getElementById('detail1').innerHTML='�����Ţ�ѵ��ôԵ'; detailhead1.style.display='';document.f1.detail_1.focus();checkptring(this.value);\"></TD>
		 	<TD>�ѵ��ôԴ �.������</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='���µç' onclick=\"document.getElementById('detail1').innerHTML=''; detailhead1.style.display='none';document.f1.detail_1.value='';checkptring(this.value);\"></TD>
		 	<TD>���µç</TD>
		 	
		 </TR>
		 <TR>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='��Сѹ�ѧ��' onclick=\"document.getElementById('detail1').innerHTML=''; detailhead1.style.display='none';document.f1.detail_1.value='';checkptring(this.value);\"></TD>
		 	<TD>��Сѹ�ѧ��</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='30�ҷ' onclick=\"document.getElementById('detail1').innerHTML=''; detailhead1.style.display='none';document.f1.detail_1.value='';checkptring(this.value);\"></TD>
		 	<TD>30�ҷ</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='HD' onclick=\" detailhead1.style.display='none';document.f1.detail_1.value='';checkptring(this.value);\"></TD>
		 	<TD>HD</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='����' onclick=\"document.getElementById('detail1').innerHTML='�������������'; detailhead1.style.display='';document.f1.detail_1.focus();checkptring(this.value);\"></TD>
		 	<TD>����</TD>
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
print "<FONT SIZE='3' COLOR='#FF0033'>����纴�������� �����Ţ��� <b>&nbsp;$title$billno &nbsp;</b> ������١��ͧ���ӡ������¹���١��ͧ</FONT><br>";


include("unconnect.inc");
////////
		  print "<input type='submit' value='���Թ�͡����� ��ǹ����ԡ�����' name='B1'>";
          print "</form>";

//////////////��ͧ������Թ������, �͡�����
          $cPaid=$sNetprice;
          $cPaid=number_format($cPaid,2,'.','');
		print "<b>---------------------------�ó��͡����稷�����-------------------------------</b>";
		print "<form name='f2' method='POST' action='opbill.php' Onsubmit='return checkformf2()'>";
		
		print "<INPUT TYPE=\"hidden\" name=\"free_Paid\" value=\"".$sSumYprice."\">";

		print "���Թ������&nbsp;&nbsp;&nbsp; <input type='text' name='paid' size='10'		  value=$cPaid>&nbsp;&nbsp;�ҷ<br>";
		///////��ѵ��ôԴ
        print "<font face='Angsana New' size='3'>��ѵ��ôԴ ? &nbsp;&nbsp;&nbsp;";
		  print "<TABLE>
		 <TR>
			<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='�Թʴ' onclick=\"document.getElementById('detail2').innerHTML=''; detailhead2.style.display='none';document.f2.detail_1.value='';checkptring(this.value);\"></TD>
		 	<TD>�Թʴ</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='��' onclick=\"document.getElementById('detail2').innerHTML='�����Ţ�ѵ��ôԵ'; detailhead2.style.display='';document.f2.detail_1.focus();checkptring(this.value);\"></TD>
		 	<TD>��</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='������' onclick=\"document.getElementById('detail2').innerHTML='�����Ţ�ѵ��ôԵ'; detailhead2.style.display='';document.f2.detail_1.focus();checkptring(this.value);\"></TD>
		 	<TD>�ѵ��ôԴ �.������</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='���µç' onclick=\"document.getElementById('detail2').innerHTML=''; detailhead2.style.display='none';document.f2.detail_1.value='';checkptring(this.value);\"></TD>
		 	<TD>���µç</TD>
		 	
		 </TR>
		 <TR>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='��Сѹ�ѧ��' onclick=\"document.getElementById('detail2').innerHTML=''; detailhead2.style.display='none';document.f2.detail_1.value='';checkptring(this.value);\"></TD>
		 	<TD>��Сѹ�ѧ��</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='30�ҷ' onclick=\"document.getElementById('detail2').innerHTML=''; detailhead2.style.display='none';document.f2.detail_1.value='';checkptring(this.value);\"></TD>
		 	<TD>30�ҷ</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='HD' onclick=\"document.getElementById('detail2').innerHTML=''; detailhead2.style.display='none';document.f2.detail_1.value='';checkptring(this.value);\"></TD>
		 	<TD>HD</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='����' onclick=\"document.getElementById('detail2').innerHTML='�������������'; detailhead2.style.display='';document.f2.detail_1.focus();checkptring(this.value);\"></TD>
		 	<TD>����</TD>
		 </TR>
		<TR>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='���ʴԡ�÷ѹ�����' onclick=\"document.getElementById('detail3').innerHTML='��������õ�Ǩ'; detailhead3.style.display='';\"></TD>
		 	<TD>���ʴԡ�÷ѹ�����</TD>
			<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='��ҧ����'\"></TD>
		 	<TD>��ҧ����</TD>
		 </TR>
		 </TABLE>";
		 print "<span id='detailhead2' style='display:none'><span id='detail2'></span><INPUT TYPE='text' NAME='detail_1'><BR></span>";
		 print "<span id='detailhead3' style='display:none'><span id='detail3'></span>";

		 print "<BR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<INPUT TYPE=\"checkbox\" NAME=\"detail_2[]\" value=\"(67201) �ش�ѹ\" ".$detail2_0." >&nbsp;(67201) �ش�ѹ";
		 print "<BR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<INPUT TYPE=\"checkbox\" NAME=\"detail_2[]\" value=\"(62101) �͹�ѹ\" ".$detail2_1." >&nbsp;(62101) �͹�ѹ";
		 print "<BR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<INPUT TYPE=\"checkbox\" NAME=\"detail_2[]\" value=\"(64101) �ٴ�Թ�ٹ\" ".$detail2_2." >&nbsp;(64101) �ٴ�Թ�ٹ";

		 /*print "<SELECT NAME=\"detail_2\">";
		 print "<option value='(67201) �ش�ѹ'>(67201) �ش�ѹ</option>";
		 print "<option value='(62101) �͹�ѹ'>(62101) �͹�ѹ</option>";
		 print "<option value='(64101) �ٴ�Թ�ٹ'>(64101) �ٴ�Թ�ٹ</option>";
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
print "<FONT SIZE='3' COLOR='#FF0033'>����纴�������� �����Ţ��� <b>&nbsp;$title$billno &nbsp;</b> ������١��ͧ���ӡ������¹���١��ͧ</FONT><br>";


include("unconnect.inc");
		  if($sPaid > 0){ print "<FONT SIZE='5' COLOR='#FF0033'>�ѭ�չ����ӡ�úѹ�֡���� ��سҵ�Ǩ�ͺ�ѭ�ա�͹��úѹ�֡</FONT><br>";};
		////////
		print "<input type='submit' value='���Թ������  �͡�����' name='B1'>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;";
		print "</form>";
			}			
    else {/********************************************************else*/
		print "<form name='f2' method='POST' action='opbill.php' Onsubmit='return checkformf2()'>";
		print "<INPUT TYPE=\"hidden\" name=\"free_Paid\" value=\"".$sSumYprice."\">";
		print "���Թ&nbsp;&nbsp;&nbsp; <input type='text' name='paid' size='10'		  value=$cPaid>&nbsp;&nbsp;�ҷ<br>";
		///////��ѵ��ôԴ
         print "<font face='Angsana New' size='3'>��ѵ��ôԴ ? &nbsp;&nbsp;&nbsp;";
		  print "<TABLE>
		 <TR>
			<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='�Թʴ' onclick=\"document.getElementById('detail2').innerHTML=''; detailhead2.style.display='none';document.f2.detail_1.value='';checkptring(this.value);\"></TD>
		 	<TD>�Թʴ</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='��ا෾' onclick=\"document.getElementById('detail2').innerHTML='�����Ţ�ѵ��ôԵ'; detailhead2.style.display='';document.f2.detail_1.focus();checkptring(this.value);\"></TD>
		 	<TD>�ѵ��ôԴ �.��ا෾</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='������' onclick=\"document.getElementById('detail2').innerHTML='�����Ţ�ѵ��ôԵ'; detailhead2.style.display='';document.f2.detail_1.focus();checkptring(this.value);\"></TD>
		 	<TD>�ѵ��ôԴ �.������</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='���µç' onclick=\"document.getElementById('detail2').innerHTML=''; detailhead2.style.display='none';document.f2.detail_1.value='';checkptring(this.value);\"></TD>
		 	<TD>���µç</TD>
		 	
		 </TR>
		 <TR>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='��Сѹ�ѧ��' onclick=\"document.getElementById('detail2').innerHTML=''; detailhead2.style.display='none';document.f2.detail_1.value='';checkptring(this.value);\"></TD>
		 	<TD>��Сѹ�ѧ��</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='30�ҷ' onclick=\"document.getElementById('detail2').innerHTML=''; detailhead2.style.display='none';document.f2.detail_1.value='';checkptring(this.value);\"></TD>
		 	<TD>30�ҷ</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='�Թ����' onclick=\"document.getElementById('detail2').innerHTML='�������������'; detailhead2.style.display='';document.f2.detail_1.focus();checkptring(this.value);\"></TD>
		 	<TD>�Թ����</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='����' onclick=\"document.getElementById('detail2').innerHTML='�������������'; detailhead2.style.display='';document.f2.detail_1.focus();checkptring(this.value);\"></TD>
		 	<TD>����</TD>
		 </TR>
		<TR>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='���ʴԡ�÷ѹ�����' onclick=\"document.getElementById('detail3').innerHTML='��������õ�Ǩ'; detailhead3.style.display='';\"></TD>
		 	<TD>���ʴԡ�÷ѹ�����</TD>
			<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='��ҧ����'\"></TD>
		 	<TD>��ҧ����</TD>
		 </TR>
		 </TABLE>";
		 print "<span id='detailhead2' style='display:none'><span id='detail2'></span><INPUT TYPE='text' NAME='detail_1'><BR></span>";
		 print "<span id='detailhead3' style='display:none'><span id='detail3'></span>";

		 print "<INPUT TYPE=\"checkbox\" NAME=\"detail_2[]\" value=\"(67201) �ش�ѹ\" ".$detail2_0." >&nbsp;(67201) �ش�ѹ";
		 print "<INPUT TYPE=\"checkbox\" NAME=\"detail_2[]\" value=\"(62101) �͹�ѹ\" ".$detail2_1." >&nbsp;(62101) �͹�ѹ";
		 print "<INPUT TYPE=\"checkbox\" NAME=\"detail_2[]\" value=\"(64101) �ٴ�Թ�ٹ\" ".$detail2_2." >&nbsp;(64101) �ٴ�Թ�ٹ";

		 //print "<SELECT NAME=\"detail_2\"><option value='�ش�ѹ'>�ش�ѹ</option><option value='�͹�ѹ'>�͹�ѹ</option><option value='�ٴ�Թ�ٹ'>�ٴ�Թ�ٹ</option></SELECT>";
		 
		 print "<BR></span>";
		 	 if($sPaid > 0){ print "<FONT SIZE='5' COLOR='#FF0033'>�ѭ�չ����ӡ�úѹ�֡���� ��سҵ�Ǩ�ͺ�ѭ�ա�͹��úѹ�֡</FONT><br>";};

		////////
		print "<input type='submit' value='���Թ  �͡�����' name='B1'>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;";
		print "</form>";
		
		}
		 
?>


