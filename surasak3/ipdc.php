<?php
session_start();
?>
<style type="text/css">
body,td,th {
	font-family: "TH SarabunPSK";
}
</style>

<?
//echo '<FONT SIZE="5" COLOR="red"> ��س��ͫѡ���� ����˹�ҷ�������������ѧ��Ѻ��ا�����</FONT>';

//exit();
include("connect.inc");
 $query = "SELECT doctor FROM bed WHERE bedcode = '$cBedcode'";
 $result = mysql_query($query);
 list($doctor) = Mysql_fetch_row($result);
session_register("clastcal");

 $query = "SELECT * FROM bed WHERE bedcode = '$cBedcode'";
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

   If ($result){
      $oBedcode=$row->bedcode;
      $oAn=$row->an;
      $oHn=$row->hn;
      $oPtname=$row->ptname;
      $oPtright=$row->ptright;
      $oDoctor=$row->doctor;
      $oAge=$row->age;
      $oAddress=$row->address;
      $oMuang=$row->muang;
      $oDate=$row->date;
      $oDiagnos=$row->diagnos;
      
      $idcard=$row->idcard;
      $food=$row->food;
      
      $cChgdate=$row->chgdate;
	     $cChgwdate=$row->chgwdate;
      $cBedname=$row->bedname;
      $cBedpri=$row->bedpri;

      $price=$row->price;
      $paid=$row->paid;
      $debt=$row->debt;
      $accno=$row->accno;
	  $cbedcode=$row->bedcode;
	  $clastcal=$row->lastcalroom;
                     }  
   else {
      echo "��辺 bedcode : $oBedcode";
           }
	
  $chgdate=(substr($oDate,0,4)-543).substr($oDate,4); //admit date or changdate

  echo "<font face='Angsana New' size ='5'>��˹��¼������͡�ҡ�ç��Һ��<BR>";
  echo "<font face='Angsana New' size ='3'>�ѹ�͹  $chgdate&nbsp;&nbsp;"; 
  $date2=date("Y-m-d H:i:s");  //discharge date 
  echo "�ѹ��˹���  $date2<br>"; 
  //$date1=("2003-08-30 08:30:20");//admit
  //$date2=("2003-09-10 08:30:20");//discharge
   $s = strtotime($date2)-strtotime($chgdate);
 //  echo "�ӹǹ�Թҷ� $s<br>";  //seconds
   $d = intval($s/86400);   //day
   $s -= $d*86400;
   $h  = intval($s/3600);    //hour
   echo "�ӹǹ�ѹ  $d �ѹ $h ������� &nbsp;&nbsp;";
   $days= $d;
   
   if ($h>6){
         $days=$d+1;
                        } 

    echo "<B>�ӹǹ�ѹ�͹������  $days �ѹ</B><br>";

/* $chgdate1=(substr($cChgwdate,0,4)-543).substr($cChgwdate,4); //admit date or changdate
  $date2=date("Y-m-d H:i:s");  //discharge date 
  echo "<font face='Angsana New' size ='3'>�ѹ�Դ��Һ�ԡ�ä����ش����  $chgdate1&nbsp;&nbsp;"; 
  $date2=date("Y-m-d H:i:s");  //discharge date 
  echo "�ѹ��˹���  $date2<br>"; 
  //$date1=("2003-08-30 08:30:20");//admit
  //$date2=("2003-09-10 08:30:20");//discharge
   $s1 = strtotime($date2)-strtotime($chgdate1);
 //  echo "�ӹǹ�Թҷ� $s<br>";  //seconds
   $d1 = intval($s1/86400);   //day
   $s1 -= $d1*86400;
   $h1  = intval($s1/3600);    //hour
   echo "�ӹǹ�ѹ  $d1 �ѹ $h1 ������� &nbsp;&nbsp;";
   $days1= $d1;
   
   if ($h1>6){
         $days1=$d1+1;
                        } 
*/
    //echo "&nbsp;<B>�ӹǹ�ѹ�͹������Դ��Һ�ԡ�÷ҧ��þ�Һ��  $days1 �ѹ</B><br>";


 $query = "SELECT date,depart,detail,sum(amount),sum(price),paid,part,idname,code,price FROM ipacc WHERE an = '$oAn' and detail like '%��Һ�ԡ�þ�Һ��%'  group by code  ";
 
  $result = mysql_query($query)
        or die("Query failed ipacc");
    $num=0;
    while (list ($date,$depart,$detail,$amount,$price,$paid,$part,$idname,$code,$price1) = mysql_fetch_row ($result)) {
	    $num++;
		$amount1=$amount1+$amount;
		$day=substr($date,0,10);
		print("<tr>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$num</td>\n".
             //   "<td bgcolor=F5DEB3><font face='Angsana New'>$day</td>\n".
			
                "<td bgcolor=F5DEB3><font face='Angsana New'>$depart</td>\n".
					  "<td bgcolor=F5DEB3><font face='Angsana New'>$code</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$detail</td>\n".  
					   "<td bgcolor=F5DEB3 align='center'><font face='Angsana New'><B>$dpycode</B></td>\n".  
                "<td bgcolor=F5DEB3 align='right'><font face='Angsana New'>$amount</td>\n".  
                "<td bgcolor=F5DEB3 align='right'><font face='Angsana New'>&nbsp;$price</td>\n".  
             //   "<td bgcolor=F5DEB3><font face='Angsana New'>$paid</td>\n".  
          //      "<td bgcolor=F5DEB3><font face='Angsana New'>$part</td>\n".  
          //      "<td bgcolor=F5DEB3><font face='Angsana New'>$idname</td>\n".  
                " </tr>\n<BR>");
				
		      }

  echo "<br><font face='Angsana New' size ='3'><B>��Һ�ԡ�÷ҧ��þ�Һ�ŤԴ���Ƿ����� &nbsp; <B>$amount1</B> �ѹ</B> <br>";


$amount2=$days-$amount1;
$amount1 =$amount1+$days1;

/* if($amount1!= $days){
 echo "<font face='Angsana New' size ='5'   color='#FF0066'>����͹!��سҵ�Ǩ�ͺ��Һ�ԡ�÷ҧ��þ�Һ�����ç�Ѻ�ѹ�͹ <BR><B><U>�ӹǹ�ѹ�͹������  $days �ѹ&nbsp;&nbsp;��Һ�ԡ�÷ҧ��þ�Һ�ŷ����� &nbsp; $amount1 �ѹ</B></U> <BR>����ͼ����·ӡ�� ��������¡��ԡ��Һ�ԡ�÷ҧ��þ�Һ�ŷ��Ҵ�����Թ��͹��è�˹���<BR>�ջѭ�����͢��ʧ��µԴ��ͷ����ǹ���Թ����� <BR><CENTER>��è�˹����ѧ�������ó�</CENTER></font> <br>";
  
  }
  else{  */

	  
  print "<form method='POST' name='f1' action='ipdcok.php' Onsubmit=\"return checkForm();\">";
  print "<p><b><font face='Angsana New' size ='4'   color='#FF0066'>��è�˹��¼�����  �ô�����ءἹ��ѹ�֡��¡�ä����������������鹡�͹��˹��¼����·ء���� <BR>
            ��������ͨ�˹������ǨлԴ�ѭ�� �������ö�ѹ�֡��¡���������ա��</b></font></p>";





  //print "<p><font face='Angsana New' size ='3'  >�ӹǹ�ѹ���������Թ�����ͧ��������&nbsp;&nbsp;";
  //print "<input type='text' name='absent' size='4' value='0'>&nbsp; &#3623;&#3633;&#3609;</p>";

  print "<p>
 <TABLE>
<TR>
	<TD valign=\"top\" >ʶҹ�Ҿ����ͨ�˹���</TD>
	<TD>
		<INPUT TYPE=\"radio\" NAME=\"txresult\" value=\"1 Complete Recovery\" >&nbsp;Complete Recovery<BR>
		<INPUT TYPE=\"radio\" NAME=\"txresult\" value=\"2 Improved\" >&nbsp;Improved<BR>
		<INPUT TYPE=\"radio\" NAME=\"txresult\" value=\"3 Not Improved\" >&nbsp;Not Improved<BR>
		<INPUT TYPE=\"radio\" NAME=\"txresult\" value=\"4 Normal Delivery \"  >&nbsp;Normal Delivery <BR>
		<INPUT TYPE=\"radio\" NAME=\"txresult\" value=\"5 Un-delivery\" >&nbsp;Un-delivery<BR>
		<INPUT TYPE=\"radio\" NAME=\"txresult\" value=\"6 Normal Child D/C w mother\" >&nbsp;Normal Child D/C w mother<BR>
		<INPUT TYPE=\"radio\" NAME=\"txresult\" value=\"7 Normal Child D/C w separately\" >&nbsp;Normal Child D/C w separately<BR>
		<INPUT TYPE=\"radio\" NAME=\"txresult\" value=\"8 Dead stillbrith\" >&nbsp;Dead stillbrith<BR>
		<INPUT TYPE=\"radio\" NAME=\"txresult\" value=\"9 Dead\" >&nbsp;Dead
	</TD>
</TR>
</TABLE>
 </p>";
print "<p>
<TABLE>
<TR>
	<TD valign=\"top\" >��������è�˹���</TD>
	<TD>
		<INPUT TYPE=\"radio\" NAME=\"dctype\" value=\"1 With Approval\" onclick=\"document.getElementById('tb_refer').style.display='none';\">&nbsp;With Approval<BR>
		<INPUT TYPE=\"radio\" NAME=\"dctype\" value=\"2 Against Advice\" onclick=\"document.getElementById('tb_refer').style.display='none';\">&nbsp;Against Advice<BR>
		<INPUT TYPE=\"radio\" NAME=\"dctype\" value=\"3 By escape\" onclick=\"document.getElementById('tb_refer').style.display='none';\">&nbsp;By escape<BR>
		<INPUT TYPE=\"radio\" NAME=\"dctype\" value=\"4 By transfer\" onclick=\"document.getElementById('tb_refer').style.display='';\" onclick=\"document.getElementById('tb_refer').style.display='none';\">&nbsp;By transfer<BR>
		<INPUT TYPE=\"radio\" NAME=\"dctype\" value=\"5 Other\" onclick=\"document.getElementById('tb_refer').style.display='none';\">&nbsp;Other<BR>
		<INPUT TYPE=\"radio\" NAME=\"dctype\" value=\"8 Dead Autopsy\" onclick=\"document.getElementById('tb_refer').style.display='none';\">&nbsp;Dead Autopsy<BR>
		<INPUT TYPE=\"radio\" NAME=\"dctype\" value=\"9 Dead Non autopsy\" onclick=\"document.getElementById('tb_refer').style.display='none';\">&nbsp;Dead Non autopsy
	</TD>
</TR>
</TABLE></p>
";


echo "	
<TABLE id='tb_refer' style='display:none' width =\"600\" border=\"1\" bordercolor=\"#3366FF\" style=\"font-family:  TH SarabunPSK; font-size: 16 px;\" >
<TR>
	<TD>
	<TABLE width=\"100%\" border=\"0\" align=\"center\" style=\"font-family:  TH SarabunPSK; font-size: 16 px;\" >
	<TR bgcolor=\"#3366FF\">
		<TD colspan=\"2\" align=\"center\"><FONT COLOR=\"#FFFFFF\"><B>�����š�� Refer �������</B></FONT></TD>
	</TR>
	<TR>
		<TD align=\"right\">���ҷ�� Refer : </TD>
		<TD>";
		
		echo "<Select name=\"time_refer\">";
		for($i=8;$i<24;$i++){
			echo "<Option value=\"".sprintf("%02d",$i).":00:00\">".sprintf("%02d",$i).":00</Option>";
			echo "<Option value=\"".sprintf("%02d",$i).":30:00\">".sprintf("%02d",$i).":30</Option>";

		}
		for($i=0;$i<8;$i++){
			echo "<Option value=\"".sprintf("%02d",$i).":00:00\">".sprintf("%02d",$i).":00</Option>";
			echo "<Option value=\"".sprintf("%02d",$i).":30:00\">".sprintf("%02d",$i).":30</Option>";

		}
		echo "</Select>";

		echo "</TD>
	</TR>
	<TR>
		<TD align=\"right\" valign=\"top\">�ҡ�� : </TD>
		<TD><TEXTAREA NAME=\"organ\" ROWS=\"4\" COLS=\"40\"></TEXTAREA></TD>
	</TR>
	<TR>
		<TD align=\"right\"  valign=\"top\">����ѡ�� : </TD>
		<TD><TEXTAREA NAME=\" maintenance\" ROWS=\"4\" COLS=\"40\"></TEXTAREA></TD>
	</TR>
	<TR>
		<TD align=\"right\">�Է�������� : </TD>
		<TD><SELECT NAME=\"list_ptright\">
		<Option value='P01' >-------</Option>
		<Option value='P02' >���� (�)</Option>
		<Option value='P03' >���� (��)</Option>
		<Option value='P04' >���� (���)</Option>
		<Option value='P05' >��ͺ����</Option>
		<Option value='P06' >�.��</Option>
		<Option value='P07' >�.</Option>
		<Option value='P08' >��Сѹ�ѧ��</Option>
		<Option value='P09' >30�ҷ</Option>
		<Option value='P10' >30�ҷ�ء�Թ</Option>
		<Option value='P11' >�ú.</Option>
		<Option value='P12' >��.44</Option>
		</TD>
	</TR>
	<TR>
		<TD align='right'>���������� : </TD>
		<TD><SELECT NAME='list_type_patient' >
										<Option value=''>--------</Option>
										<Option value='Med' >Med</Option>
										<Option value='Sx' >Sx</Option>
										<Option value='Ortho'>Ortho</Option>
										<Option value='OB. Gyne'>OB. Gyne</Option>
										<Option value='Ped'>Ped</Option>
										<Option value='Eye'>Eye</Option>
										<Option value='Ent'>Ent</Option>
										<Option value='Psycho'>Psycho</Option>
										</SELECT></TD>
	</TR>
	<TR>
		<TD align=\"right\">���˵ء�� Refer : </TD>
		<TD><SELECT NAME=\"exrefer\" >
										<Option value=\"\">-----------------</Option>
										<Option value=\"��§���\" >��§���</Option>
										<Option value=\"ICU ���\" >ICU ���</Option>
										<Option value=\"Propermangement\" >Propermangement</Option>
										<Option value=\"�Է����ѡ�� þ. �ӻҧ\">�Է����ѡ�� þ. �ӻҧ</Option>
										<Option value=\"��ᾷ��੾�зҧ\">��ᾷ��੾�зҧ</Option>
										<Option value=\"���������ͧ���\">���������ͧ���</Option>
										<Option value=\"��������ʹ\">��������ʹ</Option>
										<Option value=\"������/�ҵԵ�ͧ���\">������/�ҵԵ�ͧ���</Option>
										<Option value=\"����\">����</Option>
										</SELECT> ���˵����� <INPUT TYPE=\"text\" NAME=\"exrefer2\"></TD>
	</TR>
	<TR>
		<TD align=\"right\">ᾷ�����ѡ�� : </TD>
		<TD><INPUT TYPE=\"text\" NAME=\"doctor\" value=\"".$doctor."\" readonly></TD>
	</TR>
	<TR>
		<TD align=\"right\">�ѵػ��ʧ��/���� : </TD>
		<TD><INPUT TYPE='radio' NAME='targe' VALUE='1'>��֡��/�ԹԨ���&nbsp;&nbsp;&nbsp;<INPUT TYPE='radio' NAME='targe' VALUE='2'>�ѡ����������觡�Ѻ&nbsp;&nbsp;&nbsp;<INPUT TYPE='radio' NAME='targe' VALUE='3'>�͹����</TD>
	</TR>
	<TR>
		<TD align=\"right\">������������ : </TD>
		<TD><INPUT TYPE='radio' NAME='pttype' VALUE='1'>Emergency&nbsp;&nbsp;&nbsp;<INPUT TYPE='radio' NAME='pttype' VALUE='2'>Urgent&nbsp;&nbsp;&nbsp;<INPUT TYPE='radio' NAME='pttype' VALUE='3'>Non-Urgent</TD>
	</TR>
	<TR>
		<TD align=\"right\">����Թ�ҧ : </TD>
		<TD><INPUT TYPE='radio' NAME='refercar' VALUE='01 ö��Һ����Ѻ/��'>ö��Һ����Ѻ/��&nbsp;&nbsp;<INPUT TYPE='radio' NAME='refercar' VALUE='02 �������Թ�ҧ�ͧ'>�������Թ�ҧ�ͧ</TD>
	</TR>
	<TR>
		<TD align=\"right\">Refer 价���ç��Һ�� : </TD>
		<TD><select  name='hospital'>
 <option value='00' >-------------------</option>
 <option value='10672 �ӻҧ'>�ç��Һ���ӻҧ</option>
 <option value='11146 �������'>�ç��Һ���������</option>
 <option value='11147 ��Ф�'>�ç��Һ����Ф�</option>
 <option value='11148 ��������'>�ç��Һ����������</option>
 <option value='11149 ���'>�ç��Һ�ŧ��</option>
 <option value='11150 �����'>�ç��Һ�������</option>
 <option value='11152 �Թ'>�ç��Һ���Թ</option>
 <option value='11153 ����ԡ'>�ç��Һ������ԡ</option>
 <option value='11154 ����'>�ç��Һ������</option>
 <option value='11155 ʺ��Һ'>�ç��Һ��ʺ��Һ</option>
 <option value='11156 ��ҧ�ѵ�'>�ç��Һ����ҧ�ѵ�</option>
 <option value='11157 ���ͧ�ҹ'>�ç��Һ�����ͧ�ҹ</option>
 <option value='12005 �ǹ᫹�ٴ'>�ç��Һ���ǹ᫹�ٴ</option>
 <option value='����'>����</option>
  </select>&nbsp;&nbsp;ʶҹ��Һ�����&nbsp; <input type='text' name='hospital1' size='15'></TD>
	</TR>
	<TR>
		<TD align=\"right\">�ѭ�ҡ�� Refer : </TD>
		<TD><INPUT TYPE=\"text\" NAME=\"problem_refer\"></TD>
	</TR>
	<TR>
		<TD align=\"right\">��觷����仴��� : </TD>
		<TD>
			<INPUT TYPE=\"checkbox\" NAME=\"doc_refer\" value=\"1\" > � Refer&nbsp;&nbsp;
			<INPUT TYPE=\"checkbox\" NAME=\"nurse\" value=\"1\" > ��Һ��&nbsp;&nbsp;
			<INPUT TYPE=\"checkbox\" NAME=\"assistant_nurse\" value=\"1\" > ������&nbsp;&nbsp;
			<INPUT TYPE=\"checkbox\" NAME=\"suggestion\" value=\"1\" > �����й�<BR>
			<INPUT TYPE=\"checkbox\" NAME=\"estimate\" value=\"1\" > Ẻ�����Թ þ.�ӻҧ �����Ţ <INPUT TYPE=\"text\" NAME=\"no_estimate\" value=\"\" size=\"5\"><BR>
			<INPUT TYPE=\"checkbox\" NAME=\"cradle\" value=\"1\" >��
			<INPUT TYPE=\"checkbox\" NAME=\"doc_txt\" value=\"1\" >㺺ѹ�֡��ͤ���
		</TD>
	</TR>
	</TABLE>
	</TD>
</TR>
</TABLE>";

  print "<p>����ԹԨ���&nbsp;&nbsp;&nbsp; <input type='text' name='diag' size='56' value='$cDiag'></p>";

  print "  <div align='left'>";
  print "    <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
  print "      <tr>";
//  print "        <td width='6%'></td>";
  print "        <td width='31%' valign='top'><b>ICD10 (diagnosis)&nbsp;</b><br>";
  print "          <br>";
  print "          principle&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='icd10' size='15'><br>";
 // print "          <br>";
  print "          comorbidity&nbsp;&nbsp;&nbsp;<input type='text' name='comorbid' size='15'><br>";
  print "          complication&nbsp; <input type='text' name='complica' size='15'><br>";
 
  print "          other&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='other' size='15'><br>";
  print "          external cause&nbsp; <input type='text' name='extcause' size='15'></td>";


 print "        <td width='33%' valign='top'><a target=_BLANK href='ipicd9cm.php'><b>ICD9CM (procedure)</b></a><br>";
  print "          <br>";
  print "          principle&nbsp;:&nbsp; <input type='text' name='icd9cm' size='15'><br>";
  print "          <br>";
  print "          secondary&nbsp; <input type='text' name='second' size='15'><br>";
  print "          <br>";
  print "        </td>";
  print "      </tr>";
  print "    </table>";
  print "  </div>";

  print "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ";
  ?>
  <input type="hidden" name="cAn" value="<?=$oAn;?>">
  <input type="hidden" name="cHn" value="<?=$oHn;?>">
  <?php
  print "<input type='submit' value='    ��ŧ    ' name='B1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
  print "<input type='reset' value='  ź���  ' name='B2'></p>";
  print "</form>";

  //};
  include("unconnect.inc");
?>
<SCRIPT LANGUAGE="JavaScript">
	
	function checkForm(){
		
		if(document.f1.txresult[0].checked == false && document.f1.txresult[1].checked == false && document.f1.txresult[2].checked == false && document.f1.txresult[3].checked == false && document.f1.txresult[4].checked == false && document.f1.txresult[5].checked == false && document.f1.txresult[6].checked == false && document.f1.txresult[7].checked == false && document.f1.txresult[8].checked == false){
			alert('��س����͡ ʶҹ�Ҿ����ͨ�˹���');
			return false;
		}else if(document.f1.dctype[0].checked == false && document.f1.dctype[1].checked == false && document.f1.dctype[2].checked == false && document.f1.dctype[3].checked == false && document.f1.dctype[4].checked == false && document.f1.dctype[5].checked == false && document.f1.dctype[6].checked == false){
			alert('��س����͡��������è�˹���');
			return false;
		}else	if(document.f1.dctype[3].checked == true){
			if(document.f1.list_ptright.value=='P01'){
				alert('��س����͡�Է��������');
				return false;
			}else if(document.f1.list_type_patient.value == ''){
				alert('��س����͡ ����������');
				return false;
				
			}else	if(document.f1.exrefer.value==''){
				alert('��س����͡���˵ء�� refer');
				return false;
			}else if(document.f1.exrefer.value=='����' && document.f1.exrefer2.value == ''){
				alert('��سҡ�͡ ���˵����� �ͧ��� refer');
				return false;
			}else if(document.f1.pttype[0].checked==false && document.f1.pttype[1].checked==false && document.f1.pttype[2].checked==false ){
				alert('��س����͡ ������������');
				return false;
			}else if(document.f1.refercar[0].checked==false && document.f1.refercar[1].checked==false){
				alert('��س����͡ ����Թ�ҧ');
				return false;
			}else if(document.f1.hospital.value=="00" ){
				alert('��س����͡ Refer 价���ç��Һ��');
				return false;
			}else if(document.f1.hospital.value=="����" && document.f1.hospital1.value == ''){
				alert('��سҡ�͡ �ç��Һ�������� Refer');
				return false;
			}else if(document.f1.doc_refer.checked == false && document.f1.nurse.checked == false && document.f1.assistant_nurse.checked == false && document.f1.estimate.checked == false && document.f1.cradle.checked == false && document.f1.doc_txt.checked == false && document.f1.suggestion.checked == false){
				alert('��觷����仴���㹡�� Refer ��������ҧ���� 1 ���ҧ ��س�������ͧ���¶١���¤�Ѻ');
				return false;
			}

		}else{
			
			return true;

		}


	}

</SCRIPT>

