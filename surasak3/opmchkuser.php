<?php
    session_start();
    
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
    $Thdate=date("d-m-").(date("Y")+543);

    $Netprice=array_sum($aPrice);
    $Netpaid=array_sum($aPaid);

    $Phar      =array_sum($aPhar);
    $Pharpaid=array_sum($aPharpaid); 
    $Essd    =array_sum($aEssd);   //����Թ�����㹺ѭ������ѡ��觪ҵ�
    $Nessdy=array_sum($aNessdy);     //����Թ����ҹ͡�ѭ������ѡ��觪ҵ� �ԡ��
    $Nessdn=array_sum($aNessdn);     //����Թ����ҹ͡�ѭ������ѡ��觪ҵ� �ԡ�����
    $DSY     =array_sum($aDSY);   //����Թ����Ǫ�ѳ�� ��ǹ����ԡ��
    $DSN     =array_sum($aDSN);   //����Թ����Ǫ�ѳ�� ��ǹ����ԡ�����  
    $DPY     =array_sum($aDPY);   //����Թ����ػ�ó� ��ǹ����ԡ��
    $DPN     =array_sum($aDPN);   //����Թ����ػ�ó� ��ǹ����ԡ�����  

    $Labo         =array_sum($aLabo);
    $Labopaid  =array_sum($aLabopaid);
    $Xray         =array_sum($aXray);
    $Xraypaid  =array_sum($aXraypaid);
    $Surg         =array_sum($aSurg);
    $Surgpaid  =array_sum($aSurgpaid);
    $Emer         =array_sum($aEmer);
    $Emerpaid  =array_sum($aEmerpaid);
    $Dent          =array_sum($aDent);
    $Dentpaid   =array_sum($aDentpaid);
    $Physi        =array_sum($aPhysi);
    $Physipd   =array_sum($aPhysipd);
    $Hemo       =array_sum($aHemo);
    $Hemopd    =array_sum($aHemopd);
    $Other        =array_sum($aOther);
    $Otherpd   =array_sum($aOtherpd);
    $Ward        =array_sum($aWard);
    $Wardpd   =array_sum($aWardpd);
	$Nid        =array_sum($aNid);
    $Nidpd   =array_sum($aNidpd);
	$Eye        =array_sum($aEye);
    $Eyepd   =array_sum($aEyepd);
	$Creditpaid      =array_sum($aCreditpaid);
	$aPaidcscd      =array_sum($aPaidcscd);
	$credit1   =array_sum($aCredit_1pd);
	$credit2   =array_sum($aCredit_2pd);
	$credit3   =array_sum($aCredit_3pd);
	$credit4   =array_sum($aCredit_4pd);
	$credit5   =array_sum($aCredit_5pd);
	$credit6   =array_sum($aCredit_6pd);
	$credit7   =array_sum($aCredit_7pd);
	$credit8   =array_sum($aCredit_8pd);
    
    $sum_med_service = array_sum($_SESSION['medical_service']);
/* 
���Ѫ����
�����㹺ѭ������ѡ��觪ҵ�
����ҹ͡�ѭ������ѡ��觪ҵ� �ԡ��
����ҹ͡�ѭ������ѡ��觪ҵ� �ԡ�����
����Ǫ�ѳ�� ��ǹ����ԡ��
����Ǫ�ѳ�� ��ǹ����ԡ�����  
����ػ�ó� ��ǹ����ԡ��
����ػ�ó� ��ǹ����ԡ�����  

��Ҹ�
�͡�����
��ͧ��ҵѴ
��ͧ�ء�Թ
�ѹ�����
����Ҿ�ӺѴ
�����
�ͼ�����
����

���������
ŧ����
���.        �ѹ���
*/
print "��ǹ���Թ�����¹͡:<br>";
print "��§ҹ�Թ����Ѻ�ͧ�ѹ��� $repdate";
print "&nbsp;&nbsp;&nbsp;�Ѻ������ $doctor<br><br>";
print "<table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "  <tr valign=\"top\">";
print "    <td width='5%'>&nbsp;</td>";
print "    <td width='50%'><font face='Angsana New'>1. ���Ѫ����<br>";
print "      .......1.1 �����㹺ѭ������ѡ��觪ҵ�<br>";
print "      .......1.2 ����ҹ͡�ѭ������ѡ��觪ҵ� �ԡ��<br>";
print "      .......1.3 ����ҹ͡�ѭ������ѡ��觪ҵ� �ԡ�����<br>";
print "      .......1.4 ����Ǫ�ѳ�� ��ǹ����ԡ��<br>";
print "      .......1.5 ����Ǫ�ѳ�� ��ǹ����ԡ�����&nbsp;<br>";
print "      .......1.6 ����ػ�ó� ��ǹ����ԡ��<br>";
print "      .......1.7 ����ػ�ó� ��ǹ����ԡ�����&nbsp;<br>";
print "      <br>";
print "      2. ��Ҹ�<br>";
print "      3. �͡�����<br>";
print "      4. ��ͧ��ҵѴ<br>";
print "      5. ��ͧ�ء�Թ<br>";
print "      6. �ѹ�����<br>";
print "      7. ����Ҿ�ӺѴ<br>";
print "      8. �����<br>";
print "      9. �ͼ�����<br>";
print "    10. ����<br>";
print "    11. �ѧ���<br>";
print "    12. ��չԡ��<br>";
print "    13. ��Һ�ԡ�÷ҧ���ᾷ��<br>";
print "      <br>";
print "      <b>���������</b></font></td>";
print "    <td width='15%'><font face='Angsana New'>$Pharpaid<br>";
print "      .......<br>";
print "      .......<br>";
print "      .......<br>";
print "      .......<br>";
print "      .......<br>";
print "      .......<br>";
print "      .......<br>";
print "      <br>";
print "      $Labopaid<br>";
print "      $Xraypaid<br>";
print "      $Surgpaid<br>";
print "      $Emerpaid<br>";
print "      $Dentpaid<br>";
print "      $Physipd<br>";
print "      $Hemopd<br>";
print "      $Wardpd<br>";
print "      $Otherpd<br>";
print "      $Nidpd<br>";
print "      $Eyepd<br>";
print "      $sum_med_service<br>";
print "      <br>";
print "      $Netpaid</font></td>";
print "    <td width='30%'><font face='Angsana New'>....<br>";
print "      $Essd<br>";
print "      $Nessdy<br>";
print "      $Nessdn<br>";
print "      $DSY<br>";
print "      $DSN<br>";
print "      $DPY<br>";
print "      $DPN<br>";
print "      <br>";
print "      ....<br>";
print "      ....<br>";
print "      ....<br>";
print "      ....<br>";
print "      ....<br>";
print "      ....<br>";
print "      ....<br>";
print "      ....<br>";
print "      ....<br>";
print "      <br>";
print "      ....</font></td>";
print "  </tr>";
print "</table>";
print "<table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "  <tr>";
print "    <td width='100%'><font face='Angsana New'>";
//print "<CENTER>�ԡ��&nbsp;&nbsp; $aPaidcscd &nbsp;�ҷ </CENTER>  ";
print "    </td>";
print "  </tr>";
print "</table>";
//if (!empty($Creditpaid)){
//	print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font face='Angsana New'>(�����˵�: ���´��ºѵ��ôԵ��Ҥ��  �ӹǹ $Creditpaid �ҷ)<br>";
//								}

//print "<BR><table style='font-family: Angsana New;' border='0' cellpadding='0' cellspacing='0' width='60%'>";
//print "<tr><td colspan='2' align='center' font size='4'><b>��ػ�����š���Ѻ�����Թ</b></font></td></tr>";
//print "<tr><td width='5%'>&nbsp;</td><td width='50%'>�Թʴ</td><td width='5%'>$credit1</td></tr>";
//print "<tr><td width='5%'>&nbsp;</td><td width='50%'>��ا෾</td><td width='5%'>$credit2</td></tr>";
//print "<tr><td width='5%'>&nbsp;</td><td width='50%'>������</td><td width='5%'>$credit3</td></tr>";
//print "<tr><td width='5%'>&nbsp;</td><td width='50%'>���µç</td><td width='5%'>$credit4</td></tr>";
//print "<tr><td width='5%'>&nbsp;</td><td width='50%'>��Сѹ�ѧ��</td><td width='5%'>$credit5</td></tr>";
//print "<tr><td width='5%'>&nbsp;</td><td width='50%'>30�ҷ</td><td width='5%'>$credit6</td></tr>";
//print "<tr><td width='5%'>&nbsp;</td><td width='50%'>�Թ����</td><td width='5%'>$credit7</td></tr>";
//print "<tr><td width='5%'>&nbsp;</td><td width='50%'>����</td><td width='5%'>$credit8</td></tr>";
//print "</table>";



/*
//////�ʴ����ҧ
print "<font face='Angsana New'><br>�ӹǹ������ $x ��¡�� �ѧ���<br>";
print "<table>";
print " <tr>";
print "  <th>#</th>";
print "  <th>����</th>";
print "  <th>HN</th>";
print "  <th>AN</th>";
print "  <th>Ἱ�</th>";
print "  <th>��¡��</th>";
print "  <th>�����Թ</th>";
print "  <th>�ѵ��ôԵ</th>";
print "  <th>�Է��</th>";
print "  <th>���.���Թ</th>";
print "  </tr>";

   $num=1;
   for ($n=$x; $n>=1; $n--){
        $time=substr($aDate[$n],11,5);
        print("<tr>\n".
                "<td>$num</td>\n".
                "<td>$time</td>\n".
                "<td>$aHn[$n]</td>\n".
                "<td>$aAn[$n]</td>\n".    
                "<td>$aDepart[$n]</td>\n".
                "<td>$aDetail[$n]</td>\n".  
                "<td>$aPaid[$n]</td>\n".  
                "<td>$aCredit[$n]</td>\n".  
                "<td>$aPtright[$n]</td>\n".  
                "<td>$aIdname[$n]</td>\n".  
                " </tr>\n");
       $num++;
        }

print "</table>";
////end table
print "<br>ŧ����<br>";
print "<br>( $sOfficer )<br>";
print "$Thaidate"; 

// session_destroy();
    session_unregister("x");
    session_unregister("aDate");
    session_unregister("aHn");
    session_unregister("aAn");
    session_unregister("aIdname");
    session_unregister("aDepart");
    session_unregister("aDetail");
    session_unregister("aPrice");
    session_unregister("aPaid");
    session_unregister("aPhar");  
    session_unregister("aPharpaid");    
    session_unregister("aEssd");
    session_unregister("aNessdy");
    session_unregister("aNessdn");
    session_unregister("aDDL");
    session_unregister("aDDY");
    session_unregister("aDDN");
    session_unregister("aDPY");
    session_unregister("aDPN");
    session_unregister("aDSY");
    session_unregister("aDSN");
    session_unregister("aPtright");
    session_unregister("aCredit");
    session_unregister("aLabo");
    session_unregister("aLabopaid");
    session_unregister("aXray");
    session_unregister("aXraypaid");  
    session_unregister("aSurg");    
    session_unregister("aSurgpaid");
    session_unregister("aEmer");
    session_unregister("aEmerpaid");
    session_unregister("aDent");
    session_unregister("aDentpaid");
    session_unregister("aPhysi");
    session_unregister("aPhysipd");
    session_unregister("aHemo");
    session_unregister("aHemopd");
    session_unregister("aOther");
    session_unregister("aOtherpd");
    session_unregister("aWard");
    session_unregister("aWardpd");
	*/
?>
 
