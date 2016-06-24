<?php
    session_start();
    if (isset($sIdname)){} else {die;} //for security

    session_unregister("cAdmit");
    session_unregister("cDcdate");
    session_unregister("cDays");
    session_unregister("cAn");
    session_unregister("cHn");
    session_unregister("cPtname");
    session_unregister("cPtright");
    session_unregister("cDiag");
 	session_unregister("cBed");
    session_unregister("x");
    session_unregister("aIdname");
    session_unregister("aDep");
    session_unregister("aDtail");
    session_unregister("aAmt");
    session_unregister("aPri");
    session_unregister("aPaid");
    session_unregister("aPart");
    session_unregister("aDay");
    session_unregister("aBFY");
    session_unregister("aBFN");
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
    session_unregister("aBlood");
    session_unregister("aLabo");
    session_unregister("aXray");
    session_unregister("aSinv");
    session_unregister("aTool");
    session_unregister("aSurg");    
    session_unregister("aNcare");    
    session_unregister("aDent");
    session_unregister("aPhysi");
    session_unregister("aStx");
    session_unregister("aMc");
	
	session_unregister("aBloody");
    session_unregister("aLaboy");
    session_unregister("aXrayy");
    session_unregister("aSinvy");
    session_unregister("aTooly");
    session_unregister("aSurgy");    
    session_unregister("aNcarey");    
    session_unregister("aDenty");
    session_unregister("aPhysiy");
    session_unregister("aStxy");
    session_unregister("aMcy");
	
	session_unregister("aBloodn");
    session_unregister("aLabon");
    session_unregister("aXrayn");
    session_unregister("aSinvn");
    session_unregister("aTooln");
    session_unregister("aSurgn");    
    session_unregister("aNcaren");    
    session_unregister("aDentn");
    session_unregister("aPhysin");
    session_unregister("aStxn");
    session_unregister("aMcn");

//  session_unregister("sDiscdate");
    session_unregister("aDEssd");
    session_unregister("aDNessdy");
    session_unregister("aDNessdn");

    session_unregister("aBDEssd");
    session_unregister("aBDNessdy");
    session_unregister("aBDNessdn");

    session_unregister("aBEssd");
    session_unregister("aBNessdy");
    session_unregister("aBNessdn");
    session_unregister("aBDDL");
    session_unregister("aBDDY");
    session_unregister("aBDDN");
    session_unregister("aBDPY");
    session_unregister("aBDPN");
    session_unregister("aBDSY");
    session_unregister("aBDSN");
    session_unregister("aBBlood");
    session_unregister("aBLabo");
    session_unregister("aBXray");
    session_unregister("aBSinv");
    session_unregister("aBTool");
    session_unregister("aBSurg");    
    session_unregister("aBNcare");    
    session_unregister("aBDent");
    session_unregister("aBPhysi");
    session_unregister("aBStx");
    session_unregister("aBMc");
	
	session_unregister("aBBloody");
    session_unregister("aBLaboy");
    session_unregister("aBXrayy");
    session_unregister("aBSinvy");
    session_unregister("aBTooly");
    session_unregister("aBSurgy");    
    session_unregister("aBNcarey");    
    session_unregister("aBDenty");
    session_unregister("aBPhysiy");
    session_unregister("aBStxy");
    session_unregister("aBMcy");
	
	session_unregister("aBBloodn");
    session_unregister("aBLabon");
    session_unregister("aBXrayn");
    session_unregister("aBSinvn");
    session_unregister("aBTooln");
    session_unregister("aBSurgn");    
    session_unregister("aBNcaren");    
    session_unregister("aBDentn");
    session_unregister("aBPhysin");
    session_unregister("aBStxn");
    session_unregister("aBMcn");

    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
    $Thdate=date("d-m-").(date("Y")+543);

    $item            =0;
    $aIdname     =array("idname");
//    $Netpri         ="";   
//    $Netpaid      ="";
    $aDep        =array("depart");
    $aDtail       = array("detail");
    $aPri          =array("price");
    $aAmt        =array("amount");
    $aPaid       = array("paid");
    $aPart        = array("part");
    $aDay        =array("date");
	    $abillno       =array("billno");

    $aBFY       = array("BFY");
    $aBFN       = array("BFN");
    $aEssd      =array("DDL");
    $aNessdy  =array("DDY");
    $aNessdn  =array("DDN");
    $aDPY       =array("DPY");
    $aDPN       =array("DPN");   
    $aDSY       =array("DSY");
    $aDSN       =array("DSN");   
    $aBlood     = array("BLOOD");
    $aLabo      =array("LABO");
    $aXray       =array("XRAY");
    $aSinv       = array("SINV");
    $aTool       = array("TOOL");
    $aSurg       =array("SURG");
    $aNcare     = array("NCARE");
    $aDent       =array("DENTA");
    $aPhysi     =array("PT");
    $aStx         = array("STX");
    $aMc         = array("MC");
	
	$aBloody     = array("BLOODY");
    $aLaboy         =array("LABOY");
    $aXrayy         =array("XRAYY");
    $aSinvy        = array("SINVY");
    $aTooly        = array("TOOLY");
    $aSurgy        =array("SURGY");
    $aNcarey       = array("NCAREY");
    $aDenty          =array("DENTAY");
    $aPhysiy       =array("PTY");
    $aStxy            = array("STXY");
    $aMcy           = array("MCY");
	
	$aBloodn     = array("BLOODN");
    $aLabon         =array("LABON");
    $aXrayn         =array("XRAYN");
    $aSinvn        = array("SINVN");
    $aTooln        = array("TOOLN");
    $aSurgn        =array("SURGN");
    $aNcaren       = array("NCAREN");
    $aDentn          =array("DENTAN");
    $aPhysin       =array("PTN");
    $aStxn            = array("STXN");
    $aMcn            = array("MCN");

    include("connect.inc");

    $query = "SELECT * FROM ipacc WHERE an = '$cAn'  ";
    $result = mysql_query($query)
        or die("Query failed bed");
//    echo mysql_errno() . ": " . mysql_error(). "\n";
//    echo "<br>";
    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;      
//date_format(date,'%d- %m- %Y')
    array_push($aDay,$row->date);
    array_push($aDep,$row->depart);
    array_push($aDtail,$row->detail);
    array_push($aPri,$row->price);
    array_push($aAmt,$row->amount);
    array_push($aPaid,$row->paid);
    array_push($aPart,$row->part);
    array_push($aIdname,$row->idname);
	    array_push($abillno,$row->billno);

if ($row->part=="BFY"){
            array_push($aBFY,$row->price);
            } 
if ($row->part=="BFN"){
            array_push($aBFN,$row->price);
            } 
if ($row->part=="DDL"){
            array_push($aEssd,$row->price);
            } 
if ($row->part=="DDY"){
            array_push($aNessdy,$row->price);
            } 
if ($row->part=="DDN"){
            array_push($aNessdn,$row->price);
            } 
if ($row->part=="DPY"){
            array_push($aDPY,$row->price);
            } 
if ($row->part=="DPN"){
            array_push($aDPN,$row->price); 
            } 
if ($row->part=="DSY"){
            array_push($aDSY,$row->price);  
            } 
if ($row->part=="DSN"){
            array_push($aDSN,$row->price);
            }   
if ($row->part=="BLOOD"){
            array_push($aBlood,$row->price);
            }   
if ($row->part=="BLOODY"){
            array_push($aBloody,$row->price);
            }   
if ($row->part=="BLOODN"){
            array_push($aBloodn,$row->price);
            }   
if ($row->part=="LAB"){
            array_push($aLabo,$row->price);  
            } 
if ($row->part=="LABY"){
            array_push($aLaboy,$row->price);  
            }
if ($row->part=="LABN"){
            array_push($aLabon,$row->price);  
            }
if ($row->part=="XRAY"){
            array_push($aXray,$row->price);  
            } 
if ($row->part=="XRAYY"){
            array_push($aXrayy,$row->price);  
            } 
if ($row->part=="XRAYN"){
            array_push($aXrayn,$row->price);  
            } 
if ($row->part=="SINV"){
            array_push($aSinv,$row->price);
            }   
if ($row->part=="SINVY"){
            array_push($aSinvy,$row->price);
            }   
if ($row->part=="SINVN"){
            array_push($aSinvn,$row->price);
            }   
if ($row->part=="TOOL"){
            array_push($aTool,$row->price);
            }   
if ($row->part=="TOOLY"){
            array_push($aTooly,$row->price);
            }   
if ($row->part=="TOOLN"){
            array_push($aTooln,$row->price);
            }   
if ($row->part=="SURG"){
            array_push($aSurg,$row->price);  
            } 
if ($row->part=="SURGY"){
            array_push($aSurgy,$row->price);  
            } 
if ($row->part=="SURGN"){
            array_push($aSurgn,$row->price);  
            } 
if ($row->part=="NCARE"){
            array_push($aNcare,$row->price);
            }   
if ($row->part=="NCAREY"){
            array_push($aNcarey,$row->price);
            } 
if ($row->part=="NCAREN"){
            array_push($aNcaren,$row->price);
            } 
if ($row->part=="DENTA"){
            array_push($aDent,$row->price);  
            } 
if ($row->part=="DENTAY"){
            array_push($aDenty,$row->price);  
            } 
if ($row->part=="DENTAN"){
            array_push($aDentn,$row->price);  
            } 
if ($row->part=="PT"){
            array_push($aPhysi,$row->price);  
            } 
if ($row->part=="PTY"){
            array_push($aPhysiy,$row->price);  
            } 
if ($row->part=="PTN"){
            array_push($aPhysin,$row->price);  
            } 
if ($row->part=="STX"){
            array_push($aStx,$row->price);
            }   
if ($row->part=="STXY"){
            array_push($aStxy,$row->price);
            }  
if ($row->part=="STXN"){
            array_push($aStxn,$row->price);
            }  
if ($row->part=="MC"){
            array_push($aMc,$row->price);
            }   
if ($row->part=="MCY"){
            array_push($aMcy,$row->price);
            }
if ($row->part=="MCN"){
            array_push($aMcn,$row->price);
            }

$item++;
       }

    $Netpri=array_sum($aPri);
    $Netpaid=array_sum($aPaid);
    $debt=$Netpri-$Netpaid;
    $BFY       = array_sum($aBFY);
    $BFN       = array_sum($aBFN);
//    $Phar      =array_sum($aPhar);
//    $Pharpaid=array_sum($aPharpaid); 
    $Essd    =array_sum($aEssd);   //����Թ�����㹺ѭ������ѡ��觪ҵ�
    $Nessdy=array_sum($aNessdy);     //����Թ����ҹ͡�ѭ������ѡ��觪ҵ� �ԡ��
    $Nessdn=array_sum($aNessdn);     //����Թ����ҹ͡�ѭ������ѡ��觪ҵ� �ԡ�����
    $DSY     =array_sum($aDSY);   //����Թ����Ǫ�ѳ�� ��ǹ����ԡ��
    $DSN     =array_sum($aDSN);   //����Թ����Ǫ�ѳ�� ��ǹ����ԡ�����  
    $DPY     =array_sum($aDPY);   //����Թ����ػ�ó� ��ǹ����ԡ��
    $DPN     =array_sum($aDPN);   //����Թ����ػ�ó� ��ǹ����ԡ�����  
    $DDLDDY =$Essd+$Nessdy; //3.������������÷ҧ������ʹ(�ԡ��)
    $Blood     = array_sum($aBlood);
	$Bloody     = array_sum($aBloody);
	$Bloodn     = array_sum($aBloodn);
    $Labo         =array_sum($aLabo);
	$Laboy         =array_sum($aLaboy);
	$Labon         =array_sum($aLabon);
    $Xray         =array_sum($aXray);
	$Xrayy         =array_sum($aXrayy);
	$Xrayn         =array_sum($aXrayn);
    $Sinv        = array_sum($aSinv);
	$Sinvy        = array_sum($aSinvy);
	$Sinvn        = array_sum($aSinvn);
    $Tool        = array_sum($aTool);  //���������ͧ��ͷҧ���ᾷ�� �� respirator
	$Tooly        = array_sum($aTooly);
	$Tooln        = array_sum($aTooln);
    $Surg         =array_sum($aSurg);
	$Surgy         =array_sum($aSurgy);
	$Surgn         =array_sum($aSurgn);
    $Ncare       = array_sum($aNcare);
	$Ncarey       = array_sum($aNcarey);
	$Ncaren       = array_sum($aNcaren);
    $Dent          =array_sum($aDent);
	$Denty          =array_sum($aDenty);
	$Dentn          =array_sum($aDentn);
    $Physi        =array_sum($aPhysi);
	$Physiy       =array_sum($aPhysiy);
	$Physin        =array_sum($aPhysin);
    $Stx            = array_sum($aStx);
	$Stxy            = array_sum($aStxy);
	$Stxn           = array_sum($aStxn);
    $Mc            = array_sum($aMc); //��Һ�ԡ����蹷���������Ǣ�ͧ�Ѻ����ѡ��
	$Mcy            = array_sum($aMcy);
	$Mcn            = array_sum($aMcn);
//
  $query ="UPDATE bed SET price='$Netpri',
                	paid='$Netpaid',
	                debt='$debt',
		caldate='$Thidate' WHERE an='$cAn' ";
  $result = mysql_query($query) or die("Query failed bed");     
//  echo mysql_errno() . ": " . mysql_error(). "\n";
//  echo "<br>";


print "<table>";
print " <tr valign='top'>";
   print "<td><font face='Angsana New'><b>������ $cPtname</b><br>";
   print "HN: $cHn  AN: $cAn ��§ $cBed<br>";
   print "�Է�ԡ���ѡ�� :$cPtright<br>";
   print "��ػ����ѡ�Ҿ�Һ�� � �ѹ��� $Thaidate<br>";
   print "<font face='Angsana New'>�ӹǹ������ $item ��¡�� �ѧ���<br></td>";
  print " <td><font color = '#FF0000' face='Angsana New'>";
	
$sql = "Select my_confirmbk, my_earnest, my_office  From ipcard where an = '".$_GET["cAn"]."' AND hn = '".$_GET["cHn"]."' limit 1 ";
$result = Mysql_Query($sql);
list($my_confirmbk, $my_earnest, $my_office ) = Mysql_fetch_row($result);
if($my_confirmbk != ""){
	
	print "˹ѧ����Ѻ�ͧ�Է��� : ".$my_confirmbk."<BR>";
	print "�Թ�Ѵ�� : ".$my_earnest." �ҷ <BR>";
	print "���ѹ�֡ : ".$my_office." ";

}

  print " </font></td>";
print " </tr>";
print " </table>";

include("unconnect.inc");
// 

$num=1;
print "<table>";
print " <tr>";
print "  <th bgcolor=#669999><font face='Angsana New'><b>#</b></th>";
print "  <th bgcolor=#669999><font face='Angsana New'><b>�ѹ���</b></th>";
print "  <th bgcolor=#669999><font face='Angsana New'><b>Ἱ�</b></th>";
print "  <th bgcolor=#669999><font face='Angsana New'><b>��¡��</b></th>";
print "  <th bgcolor=#669999><font face='Angsana New'><b>�ӹǹ</b></th>";
print "  <th bgcolor=#669999><font face='Angsana New'><b>�Ҥ�</b></th>";
print "  <th bgcolor=#669999><font face='Angsana New'><b>�����Թ</b></th>";
print "  <th bgcolor=#669999><font face='Angsana New'><b>�Ţ���</b></th>";
print "  <th bgcolor=#669999><font face='Angsana New'><b>������</b></th>";
print "  <th bgcolor=#669999><font face='Angsana New'><b>���.</b></th>";
print " </tr>";

   for ($n=$item; $n>=1; $n--){
//        $time=substr($aDay[$n],0,8);
        print("<tr>\n".
                "<td bgcolor=#C0C0C0><font face='Angsana New'>$num</td>\n".
                "<td bgcolor=#C0C0C0><font face='Angsana New'>$aDay[$n]</td>\n".
                "<td bgcolor=#C0C0C0><font face='Angsana New'>$aDep[$n]</td>\n".
                "<td bgcolor=#C0C0C0><font face='Angsana New'>$aDtail[$n]</td>\n".  
                "<td bgcolor=#C0C0C0><font face='Angsana New'>$aAmt[$n]</td>\n".  
                "<td bgcolor=#C0C0C0><font face='Angsana New'>$aPri[$n]</td>\n".  
                "<td bgcolor=#C0C0C0><font face='Angsana New'>$aPaid[$n]</td>\n". 
			  "<td bgcolor=#C0C0C0><font face='Angsana New'>$abillno[$n]</td>\n".  
                "<td bgcolor=#C0C0C0><font face='Angsana New'>$aPart[$n]</td>\n".  
                "<td bgcolor=#C0C0C0><font face='Angsana New'>$aIdname[$n]</td>\n".  
                " </tr>\n");
       $num++;
        }

//$nNprice=$BFN+$DPN+$Nessdn+$DSN+$Mc;
$nNprice=$BFN+$DPN+$Nessdn+$DSN+$Mc+$Bloodn+$Labon+$Xrayn+$Sinvn+$Tooln+$Surgn+$Ncaren+$Dentn+$Physin+$Stxn+$Mcn;
$nYprice=$Netpri -$nNprice;
print "</table>";
//
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='5%'></td>";
print "      <td width='55%'><font face='Angsana New'><b>��ػ����ѡ�Ҿ�Һ��:</b><br>";
print "<b>��¡��</b><br>";
print "1. �����ͧ/��������<br>";	
print "   .......�����ͧ/��������(��ǹ�Թ)<br>";	
print "2. ����������/�ػ�ó�㹡�úӺѴ�ѡ��<br>";	
print "3. ������������÷ҧ������ʹ�������ç��Һ��<br>";
print "4. �ҷ�������ͷ���ҹ<br>	";
print "5. �Ǫ�ѳ�����������<br>";	
print "6. ��Һ�ԡ�����Ե�����ǹ��Сͺ�ͧ���Ե<br>";
print "7. ��ҵ�Ǩ�ԹԨ��·ҧ෤�Ԥ���ᾷ����о�Ҹ��Է��<br>";
print "8. ��ҵ�Ǩ�ԹԨ�������ѡ�ҷҧ�ѧ���Է��<br>";
print "9.  ��ҵ�Ǩ�ԹԨ������Ըվ��������<br>";
print "10. ����ػ�ó�ͧ���������ͧ��ͷҧ���ᾷ��<br>"; 
print "11. ��Ҽ�ҵѴ  �Ӥ�ʹ  ���ѵ������к�ԡ�����ѭ��<br>";	
print "12. ��Һ�ԡ�÷ҧ��þ�Һ�ŷ����<br>";
print "13. ��Һ�ԡ�÷ҧ�ѹ�����<br>";
print "14. ��Һ�ԡ�÷ҧ����Ҿ�ӺѴ����Ǫ������鹿�<br>";
print "15. ��Һ�ԡ�ýѧ���/��úӺѴ�ͧ����Сͺ�ä��Ż�����<br>";
print "16. ��Һ�ԡ����蹷���������Ǣ�ͧ�Ѻ����ѡ��<br>";

print "<b> ...........................����Թ����.........(�ԡ��  -  �ԡ�����)...........</b></font></td>";//add

print "      <td width='16%' valign='middle'><font face='Angsana New'><b>��¡��</b><br>";
print "        <b>�ԡ��</b><br>";
print "        $BFY<br>";
print "        ...<br>";
print "        $DPY<br>";
print "        $DDLDDY<br>";
print "        ...<br>";
print "        $DSY<br>";
$Blood+=$Bloody;
print "        $Blood<br>";
$Labo+=$Laboy;
print "        $Labo<br>";
$Xray+=$Xrayy;
print "        $Xray<br>";
$Sinv+=$Sinvy;
print "        $Sinv<br>"; // 9.��ҵ�Ǩ�ԹԨ������Ըվ��������
$Tool+=$Tooly;
print "        $Tool<br>"; //10.���������ͧ��ͷҧ���ᾷ��
$Surg+=$Surgy;
print "        $Surg<br>";
$Ncare+=$Ncarey;
print "        $Ncare<br>";
$Dent+=$Denty;
print "        $Dent<br>";
$Physi+=$Physiy;
print "        $Physi<br>";
$Stx+=$Stxy;
print "        $Stx<br>";
print "        ...<br>";


print "       <b> $nYprice</b></font></td>"; //add

print "      <td width='24%'><font face='Angsana New'><b>��¡��</b><br>";
print "        <b>�ԡ�����</b><br>";
print "        ...<br>";
print "        $BFN<br>";
print "        $DPN<br>";
print "        $Nessdn<br>";
print "        ...<br>";
print "        $DSN<br>";
print "        $Bloodn<br>";
print "        $Labon<br>";
print "        $Xrayn<br>";
print "        $Sinvn<br>";
print "        $Tooln<br>";
print "        $Surgn<br>";
print "        $Ncaren<br>";
print "        $Dentn<br>";
print "        $Physin<br>";
print "        $Stxn<br>";
$Mc=$Mcy+$Mcn+$Mc;
print "        $Mc<br>";

print "        <b>$nNprice</b></font></td>";

print "    </tr>";
print "  </table>";
print "</div>";

print "<b>����Թ������ $Netpri �ҷ</b><br>";
print "�������� $Netpaid �ҷ<br>";
print "��ҧ���� $debt �ҷ<br>";
print "���. $sOfficer �ѹ��� $Thaidate<br>";
?>


