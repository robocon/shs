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
	$Creditpaid      =array_sum($aCreditpaid);
 include("connect.inc");

//insert data into opmonrep
/*
CREATE TABLE opmonrep (
  row_id int(11) NOT NULL auto_increment,
  date datetime default NULL,
  price double(12,2) default NULL,
  paid double(12,2) default NULL,
  idname char(32) default NULL,
  phar double(12,2) default NULL,
  pharpaid double(12,2) default NULL,
  essd double(12,2) default NULL,
  nessdy double(12,2) default NULL,
  nessdn double(12,2) default NULL,
  dsy double(12,2) default NULL,
  dsn double(12,2) default NULL,
  dpy double(12,2) default NULL,
  dpn double(12,2) default NULL,
  labo double(12,2) default NULL,
  labopaid double(12,2) default NULL,
  xray double(12,2) default NULL,
  xraypaid double(12,2) default NULL,
  surg double(12,2) default NULL,
  surgpaid double(12,2) default NULL,
  emer double(12,2) default NULL,
  emerpaid double(12,2) default NULL,
  dent double(12,2) default NULL,
  dentpaid double(12,2) default NULL,
  physi double(12,2) default NULL,
  physipd double(12,2) default NULL,
  hemo double(12,2) default NULL,
  hemopd double(12,2) default NULL,
  other double(12,2) default NULL,
  otherpd double(12,2) default NULL,
  ward double(12,2) default NULL,
  wardpd double(12,2) default NULL,
  PRIMARY KEY  (row_id),
  KEY date (date)
) TYPE=MyISAM;
  date,price,paid,idname,phar,pharpaid,essd,nessdy,nessdn,dsy,dsn, 
  dpy,dpn,labo,labopaid,xray,xraypaid,surg,surgpaid,emer,emerpaid,
  dent,dentpaid,physi,physipd,hemo,hemopd,other,otherpd,ward,wardpd
*/
       $query = "INSERT INTO opmonrep(date,price,paid,idname,phar,pharpaid,essd,nessdy,nessdn,
                 dsy,dsn,dpy,dpn,labo,labopaid,xray,xraypaid,surg,surgpaid,emer,emerpaid,
                 dent,dentpaid,physi,physipd,hemo,hemopd,other,otherpd,ward,wardpd)VALUES('$chkdate','$Netprice',
                 '$Netpaid','$sOfficer','$Phar','$Pharpaid','$Essd','$Nessdy','$Nessdn','$DSY','$DSN',
                '$DPY','$DPN','$Labo','$Labopaid','$Xray','$Xraypaid','$Surg','$Surgpaid',
                '$Emer','$Emerpaid','$Dent','$Dentpaid','$Physi','$Physipd','$Hemo',
	'$Hemopd','$Other','$Otherpd','$Ward','$Wardpd');";
 
       $result = mysql_query($query) or die("Query failed,insert into phardep");
//       echo mysql_errno() . ": " . mysql_error(). "\n";
//       echo "<br>";
 include("unconnect.inc");
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

���.        �ѹ���
*/
print "��ǹ���Թ�����¹͡:<br>";
print "��§ҹ�Թ����Ѻ�ͧ�ѹ��� $repdate<br><br>";
print "<table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "  <tr>";
print "    <td width='5%'></td>";
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
if (!empty($Creditpaid)){
	print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font face='Angsana New'>(�����˵�: ���´��ºѵ��ôԵ��Ҥ��  �ӹǹ $Creditpaid �ҷ)<br>";
								}
print "<font face='Angsana New'><br>�ӹǹ������ $x ��¡�� �ѧ���<br>";
print "<table>";
print " <tr>";
print "  <th>#</th>";
print "  <th>����</th>";
print "  <th>HN</th>";
print "  <th>AN</th>";
print "  <th>Ἱ�</th>";
print "  <th>��¡��</th>";
print "  <th>�Ҥ�</th>";
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
                "<td>$aPrice[$n]</td>\n".  
                "<td>$aPaid[$n]</td>\n".  
                "<td>$aCredit[$n]</td>\n".  
                "<td>$aPtright[$n]</td>\n".  
                "<td>$aIdname[$n]</td>\n".  
                " </tr>\n");
       $num++;
        }

print "</table>";

//�ʴ���¡�ä׹�Թ
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'><br>�ʴ���¡�ä׹�Թ<br></th>";
    print "</table>";
print "<table>";
print " <tr>";
  print "<th bgcolor=9999CC>#</th>";
 print " <th bgcolor=9999C>����</th>";
  print "<th bgcolor=9999C>HN</th>";
  print "<th bgcolor=9999C>AN</th>";
  print "<th bgcolor=9999C>Ἱ�</th>";
  print "<th bgcolor=9999C>��¡��</th>";
  print "<th bgcolor=9999C>�Ҥ�</th>";
  print "<th bgcolor=9999C>�����Թ</th>";
   print "<th bgcolor=9999C>�ѵ��ôԵ</th>";
  print "<th bgcolor=9999C>�Է��</th>";
  print "<th bgcolor=9999C>���.���Թ</th>";
  print "</tr>";

   $num=1;
   for ($n=$x; $n>=1; $n--){
        $time=substr($aDate[$n],11,5);
        if ($aPaid[$n]<0){
           print("<tr>\n".
                   "<td bgcolor=99CCCC><font face='Angsana New'>$num</td>\n".
                   "<td bgcolor=99CCCC><font face='Angsana New'>$time</td>\n".
                   "<td bgcolor=99CCCC><font face='Angsana New'>$aHn[$n]</td>\n".
                   "<td bgcolor=99CCCC><font face='Angsana New'>$aAn[$n]</td>\n".    
                   "<td bgcolor=99CCCC><font face='Angsana New'>$aDepart[$n]</td>\n".
                   "<td bgcolor=99CCCC><font face='Angsana New'>$aDetail[$n]</td>\n".  
                   "<td bgcolor=99CCCC><font face='Angsana New'>$aPrice[$n]</td>\n".  
                   "<td bgcolor=99CCCC><font face='Angsana New'>$aPaid[$n]</td>\n".  
	              "<td bgcolor=99CCCC><font face='Angsana New'>$aCredit[$n]</td>\n".  
                   "<td bgcolor=99CCCC><font face='Angsana New'>$aPtright[$n]</td>\n".  
                   "<td bgcolor=99CCCC><font face='Angsana New'>$aIdname[$n]</td>\n".  
                   " </tr>\n");
          $num++;
		     }    
   }
print "</table>";

print "<br>ŧ����<br>";
print "<br>( $sOfficer )<br>";
print "$Thaidate"; 
// session_destroy();
    session_unregister("x");
    session_unregister("aDate");
    session_unregister("chkdate");
    session_unregister("repdate");
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
    session_unregister("aCredit");
    session_unregister("aCreditpaid");

?>
 
