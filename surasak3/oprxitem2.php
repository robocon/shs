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
    $aDgcode = array("������");
    $aTrade  = array("      ���͡�ä��");
    $aPrice  = array("                          �ҤҢ��  ");
    $aPart = array("part");
    $aAmount = array("        �ӹǹ   ");
    $aSlipcode = array("        �Ը���   ");
    $aMoney= array("       ����Թ   ");
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


	 if($sPaid > 0){ print "�ѭ�չ����ӡ�úѹ�֡���� ��سҵ�Ǩ�ͺ�ѭ�ա�͹��úѹ�֡<br>";};

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
		
		if(document.f1.credit[0].checked == false && document.f1.credit[1].checked == false && document.f1.credit[2].checked == false && document.f1.credit[3].checked == false && document.f1.credit[4].checked == false && document.f1.credit[5].checked == false && document.f1.credit[6].checked == false && document.f1.credit[7].checked == false && document.f1.credit[8].checked == false){
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
		
		if(document.f2.credit[0].checked == false && document.f2.credit[1].checked == false && document.f2.credit[2].checked == false && document.f2.credit[3].checked == false && document.f2.credit[4].checked == false && document.f2.credit[5].checked == false && document.f2.credit[6].checked == false && document.f2.credit[7].checked == false && document.f2.credit[8].checked == false){
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
		}
		else if(document.f2.credit[8].checked == true && document.f2.detail_1.value == ''){
			alert("�óշ�����͡ ���� ����͡������ ������� ���¤�Ѻ");
			document.f2.detail_1.focus();
			return false;
		}

	}


</SCRIPT>
<table>
 <tr>
  <th bgcolor=CD853F><font face='Angsana New'>��¡��</th>
  <th bgcolor=CD853F><font face='Angsana New'>�ӹǹ</th>
  <th bgcolor=CD853F><font face='Angsana New'>�Ҥ�</th>
  <th bgcolor=CD853F><font face='Angsana New'>�ԡ��?</th>
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
    print "HN: $sHn, �Է���:$ptright<br>";
    print "�ä: $sDiag, ᾷ�� :$doctor<br>";

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
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>(55020/55021)��Һ�ԡ�ü����¹͡</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>1</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>50.00</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>�ԡ��</td>\n".
           " </tr>\n");
                           }
//�óդ׹�� �еԴź
    if (empty($sAn) && $sNetprice < 0){
        print (" <tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>(55020/55021)��Һ�ԡ�ü����¹͡</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>-1</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>-50.00</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>�ԡ��</td>\n".
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
           $cPaid=$sNetprice; //opd case �� 50 �ҷ
           $free=$sEssd+$sNessdy+$sDPY+$sDSY;
                            }

    if (empty($sAn) && $sNetprice < 0){
           $xNetpri=$sNetprice;
           $cPaid=$sNetprice; //opd case �׹��,  �׹�Թ 50 �ҷ
           $free=$sEssd+$sNessdy+$sDPY+$sDSY;
                            }
//  IPD CASE
    if (!empty($sAn) && $sNetprice > 0){
           $xNetpri=$sNetprice;
           $cPaid=$sNetprice;
           $free=$sEssd+$sNessdy+$sDPY+$sDSY+$sDSN;
      $pay=$sNessdn+$sDPN;
                            }
//ipd case �׹��
    if (!empty($sAn) && $sNetprice < 0){
           $xNetpri=$sNetprice;
           $cPaid=$sNetprice;
           $free=$sEssd+$sNessdy+$sDPY+$sDSY+$sDSN;
      $pay=$sNessdn+$sDPN;
                            }

    $cPaid=number_format($cPaid,2,'.','');
    print "����Թ  $xNetpri �ҷ (<font face='Angsana New' size='5'><b>�ԡ����� $pay �ҷ</b>, �ԡ�� $free �ҷ)<br>";
	
	 if (substr($sPtright,0,3)=='R03 ' OR 'R09' OR 'R07' OR 'R10' OR 'R11' OR 'R13'){
		$cPaid= $pay;
          $cPaid=number_format($cPaid,2,'.','');
          print "<font face='Angsana New' size='5'><b>�������Է��: $ptright</b>";

          print "<form name='f1' method='POST' action='oprxcscd.php' Onsubmit='return checkformf1()'>";

		  print "���Թ��ǹ����ԡ�����&nbsp;&nbsp;&nbsp;";
		  $submit = "���Թ�͡����� ��ǹ����ԡ�����";
	 }else{
		 print "<form  name='f1'  method='POST' action='oprxbill.php' Onsubmit='return checkformf1()'>";
          print "���Թ&nbsp;&nbsp;&nbsp; ";
		  $submit = "���Թ  �͡�����";

	 }
	
		print "<input type='text' name='xpaid' size='10' value=$cPaid>&nbsp;&nbsp;�ҷ<br>";
		   ///////��ѵ��ôԴ
		  print "<INPUT TYPE=\"hidden\" name=\"free_Paid\" value=\"".$free."\">";

         print "<font face='Angsana New' size='3'>�Ըժ����Թ ? &nbsp;&nbsp;&nbsp;";
		 print "<TABLE>
		 <TR>
			<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='�Թʴ' onclick=\"document.getElementById('detail1').innerHTML=''; detailhead1.style.display='none';document.f1.detail_1.value='';checkptring(this.value);\"></TD>
		 	<TD>�Թʴ</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='��' onclick=\"document.getElementById('detail1').innerHTML='�����Ţ��'; detailhead1.style.display='';document.f1.detail_1.focus();checkptring(this.value);\"></TD>
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
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='HD' onclick=\"document.getElementById('detail1').innerHTML=''; detailhead1.style.display='none';document.f1.detail_1.value='';checkptring(this.value);\"></TD>
		 	<TD>HD</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='����' onclick=\"document.getElementById('detail1').innerHTML='�������������'; detailhead1.style.display='';document.f1.detail_1.focus();checkptring(this.value);\"></TD>
		 	<TD>����</TD>
			<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='¡���' onclick=\"document.getElementById('detail1').innerHTML='�������������'; detailhead1.style.display='';document.f1.detail_1.focus();checkptring(this.value);\"></TD>
		 	<TD>¡���</TD>
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
print "<FONT SIZE='3' COLOR='#FF0033'>����纴�������� �����Ţ��� <b>&nbsp;$title$billno &nbsp;</b> ������١��ͧ���ӡ������¹���١��ͧ</FONT><br>";


include("unconnect.inc");
          print "<input type='submit' value='$submit' name='B1'>";
          print "</form>";

   
?>
<?php
    $pay=$sNessdn+$sDPN+$sDSN;

//  OPD CASE
    if (empty($sAn) && $sNetprice > 0){
           $xNetpri=$sNetprice;
           $cPaid=$sNetprice; //opd case �� 50 �ҷ
           $free=$sEssd+$sNessdy+$sDPY+$sDSY;
                            }

    if (empty($sAn) && $sNetprice < 0){
           $xNetpri=$sNetprice;
           $cPaid=$sNetprice; //opd case �׹��,  �׹�Թ 50 �ҷ
           $free=$sEssd+$sNessdy+$sDSY+$sDPY;
                            }
//  IPD CASE
    if (!empty($sAn) && $sNetprice > 0){
           $xNetpri=$sNetprice;
           $cPaid=$sNetprice;
           $free=$sEssd+$sNessdy+$sDPY+$sDSY+$sDSN;
      $pay=$sNessdn+$sDPN;
                            }
//ipd case �׹��
    if (!empty($sAn) && $sNetprice < 0){
           $xNetpri=$sNetprice;
           $cPaid=$sNetprice;
           $free=$sEssd+$sNessdy+$sDPY+$sDSY+$sDSN;
      $pay=$sNessdn+$sDPN;
                            }

    $cPaid=number_format($cPaid,2,'.','');
    print "����Թ  $xNetpri �ҷ (<font face='Angsana New' size='5'><b>�ԡ����� $pay �ҷ</b>, �ԡ�� $free �ҷ)<br>";


          print "<form name='f2' method='POST' action='oprxbill.php'>";
          print "���Թ&nbsp;&nbsp;&nbsp; <input type='text' name='xpaid' size='10' value=$cPaid>&nbsp;&nbsp;�ҷ<br>";
		   ///////��ѵ��ôԴ
		   print "<INPUT TYPE=\"hidden\" name=\"free_Paid\" value=\"".$free."\">";
         print "<font face='Angsana New' size='3'>��ѵ��ôԴ ? &nbsp;&nbsp;&nbsp;";
		  print "<TABLE>
		 <TR>
			<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='�Թʴ' onclick=\"document.getElementById('detail2').innerHTML=''; detailhead2.style.display='none';document.f2.detail_1.value='';checkptring(this.value);\"></TD>
		 	<TD>�Թʴ</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='��' onclick=\"document.getElementById('detail2').innerHTML='�����Ţ��'; detailhead2.style.display='';document.f2.detail_1.focus();checkptring(this.value);\"></TD>
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
			<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='��ҧ����'\"></TD>
		 	<TD>��ҧ����</TD>
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
print "<FONT SIZE='3' COLOR='#FF0033'>����纴�������� �����Ţ��� <b>&nbsp;$title$billno &nbsp;</b> ������١��ͧ���ӡ������¹���١��ͧ</FONT><br>";


include("unconnect.inc");

////////
	 if($sPaid > 0){ print "<FONT SIZE='5' COLOR='#FF0033'>�ѭ�չ����ӡ�úѹ�֡���� ��سҵ�Ǩ�ͺ�ѭ�ա�͹��úѹ�֡</FONT><br>";};

          //print "<input type='submit' value='���Թ  �͡����� �ó�������ӹǹ' name='B1'>";
          print "</form>";


    print "<font face='Angsana New' size='1'>DDL =  ��㹺ѭ������ѡ��觪ҵ� �ԡ��<br>";
    print "DDY =  �ҹ͡�ѭ������ѡ��觪ҵ� �ԡ��<br>";
    print "DDN =  �ҹ͡�ѭ������ѡ��觪ҵ� �ԡ�����<br>";
    print "DPY =  �ػ�ó� ����ԡ��(�ԡ����������ͺҧ��ǹ)<br>";
    print "DPN =  �ػ�ó� ����ԡ����� <br>";
    print "DSY =  �Ǫ�ѳ�� �ԡ�����<br>";
    print "DSN =  �Ǫ�ѳ�� �ԡ�����";

?>

