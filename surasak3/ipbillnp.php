<?php
session_start();
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
    $Thdate=date("d-m-").(date("Y")+543);
	$time=date("H:i:s");
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
 
 IF ($cLtnum <> "0"){
  $count=0;
  For ($i = 0;$i<=$nNum;$i++){
    $cNo   = Substr($cLtnum,$count,1);
     $count++;
//��ҹ��ѡ
    IF ($cNo <>0 and $cNo != "-"){
      If ($nUnit <> 1){  

          $query = "SELECT * FROM thaibaht WHERE fld1 = '$nUnit' ";
          $result = mysql_query($query) or die("Query 1 failed");

          for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
          if (!mysql_data_seek($result, $i)) {
              echo "Cannot seek to row $i\n";
              continue;
          }

           if(!($row = mysql_fetch_object($result)))
               continue;
         }

        $cVarU = $row->fld4;  //��ҹ��ѡ
                }
      Else {
        $cVarU = "";
              }

//��ҹ�Ţ
          $query = "SELECT * FROM thaibaht WHERE fld1 = '$cNo' ";
          $result = mysql_query($query) or die("Query 2 failed");

          for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
          if (!mysql_data_seek($result, $i)) {
              echo "Cannot seek to row $i\n";
              continue;
          }

           if(!($row = mysql_fetch_object($result)))
               continue;
         }

      $cVar1 = $row->fld2; //��ҹ����Ţ
///           
if ($nUnit =='2' && $cNo =='2'):
   $cVar1 = "���";
elseif ($nUnit == '2' && $cNo=='1'):
         $cVar1 =  "";
elseif ($nUnit =='1' && $cNo =='1' && $nNum <> 1 ):
          $cVar1 = "���";
else:
   echo "";
endif; 

      $cRead  = $cRead.$cVar1.$cVarU;
        }
      $nUnit--;
            }
$cRead = $cRead."�ҷ";
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
            $cVar1 = "���";
            }
         if ($nUnit == '2' && $cNo == '1'){
            $cVar1 = "" ;
             }   
         if ($nUnit == '1' && $cNo =='1'){
              $cVar1 = "���";
            }            
         If (Substr($cRtnum,0,1) == '0' && $cNo == '1'){
            $cVar1 = "˹��";
            }
         ///////
         If ($nUnit != '1'){ 
           $cRead = $cRead.$cVar1."�Ժ";
                 }
         Else{
           $cRead = $cRead.$cVar1;
                }
      }   
         $nUnit--;
             }
    $cRead = $cRead."ʵҧ��**"  ;
	}    
    else{
           $cRead = $cRead."��ǹ**" ;
           }  
    include("connect.inc");

   return $cRead;
}
///end function baht


    $Netpri=array_sum($aPri);
    $Netpaid=array_sum($aPaid);
    $BFY       = array_sum($aBFY);
    $BFN       = array_sum($aBFN);
//����ѡ�Ҿ�Һ�ŷ�����  ���ͺѹ�֡� ipmonrep table
//�ҷ����� þ.

	//�ҷ����� þ.�׹�ѹ��Ѻ��ҹ
    $Essd1    =array_sum($aEssd1);   //����Թ�����㹺ѭ������ѡ��觪ҵ�
    $Nessdy1=array_sum($aNessdy1);     //����Թ����ҹ͡�ѭ������ѡ��觪ҵ� �ԡ��
    $DDLDDY1 =$Essd1+$Nessdy1; //3.������������÷ҧ������ʹ(�ԡ��)
    $Nessdn1=array_sum($aNessdn1);     //����Թ����ҹ͡�ѭ������ѡ��觪ҵ� �ԡ����


    $Essd    =array_sum($aEssd);   //����Թ�����㹺ѭ������ѡ��觪ҵ�
    $Nessdy=array_sum($aNessdy);     //����Թ����ҹ͡�ѭ������ѡ��觪ҵ� �ԡ��
    $DDLDDY =$Essd+$Nessdy+ $DDLDDY1; //3.������������÷ҧ������ʹ(�ԡ��)
    $Nessdn=array_sum($aNessdn);     //����Թ����ҹ͡�ѭ������ѡ��觪ҵ� �ԡ�����
//�ҷ�������ͷ���ҹ
    $DEssd    =array_sum($aDEssd);   //����Թ�����㹺ѭ������ѡ��觪ҵ�
    $DNessdy=array_sum($aDNessdy);     //����Թ����ҹ͡�ѭ������ѡ��觪ҵ� �ԡ��
    $DDgy= $DEssd+$DNessdy; //�ҷ�������ͷ���ҹ����ԡ��
    $DNessdn=array_sum($aDNessdn);     //����Թ����ҹ͡�ѭ������ѡ��觪ҵ� �ԡ�����

    $DSY     =array_sum($aDSY);   //����Թ����Ǫ�ѳ�� ��ǹ����ԡ��
    $DSN     =array_sum($aDSN);   //����Թ����Ǫ�ѳ�� ��ǹ����ԡ�����  

    $DPY     =array_sum($aDPY);   //����Թ����ػ�ó� ��ǹ����ԡ��
    $DPN     =array_sum($aDPN);   //����Թ����ػ�ó� ��ǹ����ԡ�����  
 
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

    $debt=$Netpri-$Netpaid-$paid;
/*
CREATE TABLE ipmonrep (
date,admit,dcdate,days,an,hn,ptname,ptright,price,paid,debt,
cash,idname,bfy,bfn,dpy,dpn,ddl,ddy,ddn,dsy,dsn,blood,
lab,xray,sinv,surg,ncare,denta,pt,stx,mc 

'$Thidate','$cAdmit','$cDcdate','$cDays','$cAn','$cHn','$cPtname','$cPtright',price,paid,debt,
cash,'$sOfficer','$BFY','$BFN','$DPY','$DPN','$Essd','$Nessdy','$Nessdn','$DSY','$DSN','$Blood',
'$Labo','$Xray','$Sinv','$Surg','$Ncare','$Dent','$Physi','$Stx','$Mc' 

Netpaid=���������¨��·�����
cash =���¤��駹��($paid)
debt= Netpri-Netpaid-$paid
*/
    if ($billno == '' ){print "������Ţ��������";}
	else{
		include("connect.inc");
       $query = "INSERT INTO ipmonrep(date,admit,dcdate,days,an,hn,ptname,ptright,price, paid,debt,cash,idname,bfy,bfn,dpy,dpn,ddl,ddy,ddn,dsy,dsn,blood,
lab,xray,sinv,surg,ncare,denta,pt,stx,mc,billno,credit,credit_detail,tool)VALUES('$Thidate','$cAdmit',
	'$cDcdate','$cDays','$cAn','$cHn','$cPtname','$cPtright','$Netpri','$Netpaid','$debt',
	'$paid','$sOfficer','0','$BFN','0','$DPN','0',
	'0','$Nessdn','0','$DSN','".$Bloodn."',
	'".$Labon."','".$Xrayn."','".$Sinvn."','".$Surgn."','".$Ncaren."','".$Dentn."','".$Physin."','".$Stxn."','".$Mcn."','$billno','$credit','$detail_1','".$Tooln."');";
 

     $result = mysql_query($query) or die("Query failed,insert into ipmonrep");
//       echo mysql_errno() . ": " . mysql_error(). "\n";
//       echo "<br>";

       $sql = "UPDATE ipcard SET price='$Netpri', paid= $Netpaid+$paid, calc='$Thidate' ,ipmonrep='Y' WHERE an='$cAn' ";
 $result = mysql_query($sql) or die("Query failed ipcard");
//       echo mysql_errno() . ": " . mysql_error(). "\n";
//       echo "<br>";

/* ���������ǹ������ ipdibill.php��ͷ������  �������������Ţ�ѭ��
       $cAccno++;
       $query ="UPDATE bed SET price='$Netpri',
                	paid='$Netpaid',
	                debt='$debt',
		caldate='$Thidate',
                                accno='$cAccno'
                       WHERE an='$cAn' ";
       $result = mysql_query($query) or die("Query failed bed");     
       echo mysql_errno() . ": " . mysql_error(). "\n";
       echo "<br>";
*/

$sql = "Select sum(price),status FROM ipacc WHERE an = '$cAn' and status='��˹���' group by status ";
$result2 = Mysql_Query($sql) or die(mysql_error());
list($pricedc,$status) = Mysql_fetch_row($result2);

   include("unconnect.inc");
//����ѡ�Ҿ�Һ�� �ѡ����������  �����͡�������ǹ����ҧ����
    $BFY       = array_sum($aBBFY);
    $BFN       = array_sum($aBBFN);
//�ҷ����� þ.   ��¡�������� �ѡ�Թ�����������͡
	//�ҷ����� þ.�׹�ѹ��Ѻ��ҹ
    $Essd1    =array_sum($aBEssd1);   //����Թ�����㹺ѭ������ѡ��觪ҵ�
    $Nessdy1=array_sum($aBNessdy1);     //����Թ����ҹ͡�ѭ������ѡ��觪ҵ� �ԡ��
    $DDLDDY1 =$Essd1+$Nessdy1; //3.������������÷ҧ������ʹ(�ԡ��)
    $Nessdn1=array_sum($aBNessdn1);     //����Թ����ҹ͡�ѭ������ѡ��觪ҵ� �ԡ����

    $Essd    =array_sum($aBEssd);   //����Թ�����㹺ѭ������ѡ��觪ҵ�
    $Nessdy=array_sum($aBNessdy);     //����Թ����ҹ͡�ѭ������ѡ��觪ҵ� �ԡ��
    $DDLDDY =$Essd+$Nessdy+$DDLDDY1; //3.������������÷ҧ������ʹ(�ԡ��)
    $Nessdn=array_sum($aBNessdn);     //����Թ����ҹ͡�ѭ������ѡ��觪ҵ� �ԡ�����
//���Ǫ�ѳ���������ͷ���ҹ
    $DEssd    =array_sum($aBDEssd);   //����Թ�����㹺ѭ������ѡ��觪ҵ�
    $DNessdy=array_sum($aBDNessdy);     //����Թ����ҹ͡�ѭ������ѡ��觪ҵ� �ԡ��
    $DDgy= $DEssd+$DNessdy; //�ҷ�������ͷ���ҹ����ԡ��
    $DNessdn=array_sum($aBDNessdn);     //����Թ����ҹ͡�ѭ������ѡ��觪ҵ� �ԡ�����
//
    $DSY     =array_sum($aBDSY);   //����Թ����Ǫ�ѳ�� ��ǹ����ԡ��
    $DSN     =array_sum($aBDSN);   //����Թ����Ǫ�ѳ�� ��ǹ����ԡ�����  

    $DPY     =array_sum($aBDPY);   //����Թ��ҫ����ػ�ó� ��ǹ����ԡ��
    $DPN     =array_sum($aBDPN);   //����Թ��ҫ����ػ�ó� ��ǹ����ԡ�����  

    $Blood     = array_sum($aBBlood);
	$Bloody     = array_sum($aBBloody);
	$Bloodn     = array_sum($aBBloodn);
    $Labo         =array_sum($aBLabo);
	$Laboy         =array_sum($aBLaboy);
	$Labon       =array_sum($aBLabon);
    $Xray         =array_sum($aBXray);
	$Xrayy         =array_sum($aBXrayy);
	$Xrayn         =array_sum($aBXrayn);
    $Sinv        = array_sum($aBSinv);
	$Sinvy        = array_sum($aBSinvy);
	$Sinvn        = array_sum($aBSinvn);
    $Tool        = array_sum($aBTool);  //���������ͧ��ͷҧ���ᾷ�� �� respirator
	$Tooly        = array_sum($aBTooly); 
	$Tooln        = array_sum($aBTooln); 
    $Surg         =array_sum($aBSurg);
	$Surgy         =array_sum($aBSurgy);
	$Surgn         =array_sum($aBSurgn);
    $Ncare       = array_sum($aBNcare);
	$Ncarey       = array_sum($aBNcarey);
	$Ncaren       = array_sum($aBNcaren);
    $Dent          =array_sum($aBDent);
	$Denty          =array_sum($aBDenty);
	$Dentn          =array_sum($aBDentn);
    $Physi        =array_sum($aBPhysi);
	$Physiy        =array_sum($aBPhysiy);
	$Physin        =array_sum($aBPhysin);
    $Stx            = array_sum($aBStx);
	$Stxy            = array_sum($aBStxy);
	$Stxn            = array_sum($aBStxn);
    $Mc            = array_sum($aBMc); //��Һ�ԡ����蹷���������Ǣ�ͧ�Ѻ����ѡ��
	$Mcy            = array_sum($aBMcy);
	$Mcn            = array_sum($aBMcn);

    $debt=$Netpri-$Netpaid-$paid;
/*
//�����������Ѻ�Թ
   print "��ػ����ѡ�Ҿ�Һ��(��ҧ����) � �ѹ����˹��� $sDiscdate<br>";
   print "������ $cPtname<br>";
   print "HN: $cHn  AN: $cAn<br>";
   print "�Է�ԡ���ѡ�� :$cPtright<br>";
   print "�����ä  $cDiag<br>";
   print "���Ѻ����ѡ��� þ. �ѹ��� $cAdmit �֧ $cDcdate ��� $cDays �ѹ<br>";
//   print "<font face='Angsana New'>�ӹǹ������ $item ��¡�� �ѧ���<br>";

print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='5%'></td>";
print "      <td width='55%'><font face='Angsana New'>��ػ����ѡ�Ҿ�Һ��:<br>";
print "��¡��<br>";
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
print "16. ��Һ�ԡ����蹷���������Ǣ�ͧ�Ѻ����ѡ��</font></td>";
print "      <td width='16%' valign='middle'><font face='Angsana New'>��¡��<br>";
print "        �ԡ��<br>";
print "        $BFY<br>";
print "        ...<br>";
print "        $DPY<br>";
print "        $DDLDDY<br>";
print "        $DDgy<br>";//4. �ҷ�������ͷ���ҹ�ԡ��
print "        $DSY<br>";
print "        $Blood<br>";
print "        $Labo<br>";
print "        $Xray<br>";
print "        $Sinv<br>"; // 9.��ҵ�Ǩ�ԹԨ������Ըվ��������
print "        $Tool<br>"; //10.���������ͧ��ͷҧ���ᾷ��
print "        $Surg<br>";
print "        $Ncare<br>";
print "        $Dent<br>";
print "        $Physi<br>";
print "        $Stx<br>";
print "        ...</font></td>";
print "      <td width='24%'><font face='Angsana New'>��¡��<br>";
print "        �ԡ�����<br>";
print "        ...<br>";
print "        $BFN<br>";
print "        $DPN<br>";
print "        $Nessdn<br>";
print "        $DNessdn<br>"; //4. �ҷ�������ͷ���ҹ �ԡ�����
print "        $DSN<br>";
print "       ...<br>";
print "        ....<br>";
print "        ...<br>";
print "        ...<br>";
print "        ...<br>";
print "        ...<br>";
print "        ...<br>";
print "        ...<br>";
print "        ...<br>";
print "        ...<br>";
print "        $Mc</font></td>";
print "    </tr>";
print "  </table>";
print "</div>";
print "</table>";
*/
//$bedfood=$BFY+$BFN;
$invlab=$Blood+$Bloody+$Labo+$Laboy+$Xray+$Xrayy+$Sinv+$Sinvy;

$BEssd1=$Essd1+$DEssd1;
$BNessdy1=$Nessdy1+$DNessdy1;
$BNessdn1=$Nessdn1+$DNessdn1;

$BEssd=$Essd+$DEssd+$BNessdy1+$BEssd1;
$BNessdy=$Nessdy+$DNessdy;
$BNessdn=$Nessdn+$DNessdn;


$equip=$DPY+$Tool+$Tooly;  //TOOL-���������ͧ��ͷҧ���ᾷ��, DPY-��ҫ��͵���ػ�ó�ҧ���ᾷ��
$medcare=$Surg+$Surgy+$Ncare+$Ncarey+$Dent+$Denty+$Physi+$Physiy+$Stx+$Stxy;

$Ysubtotal=$BFY+$invlab+$BEssd+$BNessdy+$DSY+$equip+$medcare;
$Nsubtotal=$BFN+$BNessdn+$DSN+$DPN+$Mc+$Mcy+$Mcn+$Bloodn+$Labon+$Xrayn+$Sinvn+$Surgn+$Ncaren+$Dentn+$Physin+$Stxn+$Tooln;

$billsum=$BFY+$BFN+$invlab+$Essd+$Nessdy+$Nessdn+$Essd1+$Nessdy1+$Nessdn1+$DSY+ $DSN+$DEssd+$DNessdy+$DNessdn+$equip+$DPN+$medcare+$Mc+$Mcy+$Mcn+$Bloodn+$Labon+$Xrayn+$Sinvn+$Surgn+$Ncaren+$Dentn+$Physin+$Stxn+$Tooln;

$debt=$billsum-$paid;
$cbaht=baht($paid);
/*
echo "$billsum<br>";

print "��ػ�����ŧ�����<br>";
print "1. �����ͧ��Ф���������� $cDays �ѹ...�ԡ��.. $BFY ........�ԡ�����... $BFN<br>";
print "2. ��ҵ�Ǩ ������������ä.....................�ԡ��.. $invlab <br>";
print "3. �����(㹺ѭ������ѡ��觪ҵ�)............�ԡ��.. $BEssd <br>";
print "4. �����(�͡�ѭ������ѡ��觪ҵ�).........�ԡ��.. $BNessdy ...�ԡ�����... $BNessdn<br>";
print "5. ����Ǫ�ѳ�����������........................�ԡ��... $DSY.........�ԡ�����...  $DSN <br>";
print "6. ����ػ�ó�/����ͧ��ͷҧ���ᾷ��....�ԡ��... $equip .......�ԡ�����... $DPN <br>";
print "7. ��Һ�ԡ�÷ҧ���ᾷ��....................�ԡ��.. $medcare <br>";
print "8. ��Һ�ԡ����蹷���������Ǣ�ͧ�Ѻ����ѡ��............................... �ԡ�����... $Mc<br>";
print "����Թ $billsum <br>";
//print " ".baht($billsum)."<br>";//���˹ѧ���

print "<br>����Թ������ $billsum �ҷ<br>";
//print "����¨������� $Netpaid �ҷ<br>";
//$debt=$Netpri-$Netpaid-$paid;

print "���¤��駹�� $paid<br>";
print " ".baht($paid)."<br>";//���˹ѧ���
print "��ҧ���� $debt �ҷ<br>";
print "���. $sOfficer �ѹ��� $Thaidate<br>";
*/
//����������





for($i=1;$i<=count($rowN);$i++){

  $sql = "UPDATE ipacc SET paid=price,billno='$billno' WHERE row_id='".$rowN[$i]."' and (paid is null or paid = 0.00) and billno is null  ";
      $result = mysql_query($sql) or die("Query failed ipacc1");
	  
	  
	 // echo $sql;

}
//if ($paid==$billsum){

print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='80%'></td>";
print "      <td width='20%'></td>";
print "    </tr>";
print "   <BR>";
print "  </table>";
print "</div>";
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='32%'></td>";
print "      <td width='68%'><font face='Angsana New' size='3'><BR><BR><BR><BR><font face='Angsana New'></font></td>";
print "    </tr>";
print "  </table>";
print "</div>";
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='10%'></td>";
print "      <td width='20%'><font face='Angsana New'>$Thdate</td>";
print "      <td width='45%'><font face='Angsana New'>$time";
print "      <td width='25%'><font face='Angsana New'>";
print "       </font></td>";
print "    </tr>";
print "  </table>";
print "</div>";
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='10%'></td>";
print "      <td width='23%'><font face='Angsana New'>$credit</td>";
print "      <td width='36%'><font face='Angsana New'><B>$cPtname</B>";
print "      <td width='18%'><font face='Angsana New'>$cHn";
print "      <td width='20%'><font face='Angsana New'>$cAn";

print "       </font></td>";
print "    </tr>";
print "  </table>";
print "</div>";
print " </table>";
print "</div>";
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='5%'></td>";
$cAdmitD=substr($cAdmit,8,2);
$cAdmitM=substr($cAdmit,5,2);
$cAdmitY=substr($cAdmit,0,4);
$cAdmitT=substr($cAdmit,11,8);
$cAdmitALL=$cAdmitD."-".$cAdmitM."-".$cAdmitY."&nbsp;".$cAdmitT;
print "      <td width='15%'><font face='Angsana New'>$cAdmitALL</td>";
$dcdateD=substr($cDcdate,8,2);
$dcdateM=substr($cDcdate,5,2);
$dcdateY=substr($cDcdate,0,4);
$dcdateT=substr($cDcdate,11,8);
$dcdateALL=$dcdateD."-".$dcdateM."-".$dcdateY."&nbsp;".$dcdateT;
print "      <td width='30%'><font face='Angsana New'>$dcdateALL";
print "      <td width='40%'><font face='Angsana New'>$cDays";
print "       </font></td>";
print "    </tr>";
print "    <tr>";
print "      <td width='10%'></td>";
print "      <td width='30%'><font face='Angsana New'>$cDiag</td>";
print "      <td width='10%'><font face='Angsana New'>";
print "      <td width='20%'><font face='Angsana New'>";
print "      <td width='20%'><font face='Angsana New'>";
print "       </font></td>";
print "    </tr>";
/*
print "    <tr>";
print "      <td width='9%'></td>";
print "      <td width='91%'><font face='Angsana New'>&#3619;&#3633;&#3610;&#3611;&#3656;&#3623;&#3618;";
print "        $cAdmit &#3606;&#3638;&#3591; $cDcdate &#3619;&#3623;&#3617; $cDays &#3623;&#3633;&#3609;</font></td>";
print "    </tr>";
*/
print "  </table>";
print "</div>";
//print "<br>";

print "   <BR><BR><BR><BR>";
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='5%'></td>";
//print "      <td width='55%'><font face='Angsana New'>��ػ����ѡ�Ҿ�Һ��:<br>";
//print "��¡��<br>";
print "<td width='60%'><font face='Angsana New' size='3'>1. �����ͧ/��������<br>";	
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
print "16. ��Һ�ԡ����蹷���������Ǣ�ͧ�Ѻ����ѡ��</font></td>";

//print "      <td width='24%'><font face='Angsana New'>��¡��<br>";
//print "        �ԡ�����<br>";
print "       <td width='15%' align='right'> <font face='Angsana New' size='3'>...<br>";
print "        $BFN<br>";
print "        $DPN<br>";
print "        $Nessdn<br>";
print "        $DNessdn<br>"; //4. �ҷ�������ͷ���ҹ �ԡ�����
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
print "			$Mc</font></td>";
//print "      <td width='16%' valign='middle'><font face='Angsana New'>��¡��<br>";
//print "        �ԡ��<br>";
print "       <td width='20%' align='right'> <font face='Angsana New' size='3'><br>";
print "        <br>";
print "        <br>";
print "       <br>";
print "       <br>"; //4. �ҷ�������ͷ���ҹ �ԡ�����
print "       <br>";
print "       <br>";
print "       <br>";
print "        <br>";
print "        <br>";
print "        <br>";
print "        <br>";
print "       <br>";
print "        <br>";
print "        <br>";
print "        <br>";

print "        </font></td>";
print "</tr>";
print "</table>";
print "</div>";
print "</table>";



print "<div align='right'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='5%'></td>";
print "      <td width='60%'></td>";
print "      <td width='15%' align='right'><font face='Angsana New' size='3'>$Nsubtotal</font></td>";
print "      <td width='20%' align='right'></td>";


print "    </tr>";
print "    <tr>";
print "      <td width='5%'></td>";
print "      <td width='60%'><font face='Angsana New' size='3'><B>$cbaht</B></font></td>";
print "      <td width='15%'><font face='Angsana New' size='4'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<B>$paid</B></font></td>";
print "      <td width='20%'></td>";
print "    </tr>";
print "  </table>";
print "</div>";
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='71%'></td>";
print "      <td width='29%'>&nbsp;";
//print "        <p><font face='Angsana New'>&#3648;&#3592;&#3657;&#3634;&#3627;&#3609;&#3657;&#3634;&#3607;&#3637;&#3656;&#3648;&#3585;&#3655;&#3610;&#3648;&#3591;&#3636;&#3609;</font></td>";
print "    </tr>";
print "  </table>";
print "</div>";

	//}
//else {
//print "�Ҥ���� $billsum �ҷ<br>";
//print "�Ѻ�Թ $paid �ҷ �����ҡѺ�Ҥ����";
//}
        
	}
/////
    session_unregister("cAdmit");
    session_unregister("cDcdate");
    session_unregister("cDays");
    session_unregister("cAn");
    session_unregister("cHn");
    session_unregister("cPtname");
    session_unregister("cPtright");
    session_unregister("cDiag");

    session_unregister("x");
    session_unregister("aIdname");
    session_unregister("aDep");
    session_unregister("aDtail");
    session_unregister("aPri");
    session_unregister("aPaid");
    session_unregister("aPart");
    session_unregister("aDay");
    session_unregister("aBFY");
    session_unregister("aBFN");
    session_unregister("aBBFY");
    session_unregister("aBBFN");
    session_unregister("aEssd");
    session_unregister("aNessdy");
    session_unregister("aNessdn");
	  session_unregister("aEssd1");
    session_unregister("aNessdy1");
    session_unregister("aNessdn1");
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

//  session_unregister("sDiscdate");
    session_unregister("aDEssd");
    session_unregister("aDNessdy");
    session_unregister("aDNessdn");

  	session_unregister("aDEssd1");
    session_unregister("aDNessdy1");
    session_unregister("aDNessdn1");

    session_unregister("aBDEssd");
    session_unregister("aBDNessdy");
    session_unregister("aBDNessdn");

    session_unregister("aBEssd");
    session_unregister("aBNessdy");
    session_unregister("aBNessdn");
	 session_unregister("aBEssd1");
    session_unregister("aBNessdy1");
    session_unregister("aBNessdn1");
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
?>
<script language="javascript">
window.opener.location.href ('dcdate.php');
</script>
