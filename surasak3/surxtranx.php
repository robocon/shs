<?php
    session_start();
    if (isset($sIdname)){} else {die;} //for security
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 

    $Essd    =array_sum($aEssd);   //����Թ�����㹺ѭ������ѡ��觪ҵ�
    $Nessdy=array_sum($aNessdy);     //����Թ����ҹ͡�ѭ������ѡ��觪ҵ� �ԡ��
    $Nessdn=array_sum($aNessdn);     //����Թ����ҹ͡�ѭ������ѡ��觪ҵ� �ԡ�����
    $DSY     =array_sum($aDSY);   //����Թ����Ǫ�ѳ�� ��ǹ����ԡ��
    $DSN     =array_sum($aDSN);   //����Թ����Ǫ�ѳ�� ��ǹ����ԡ�����  
    $DPY     =array_sum($aDPY);   //����Թ����ػ�ó� ��ǹ����ԡ��
    $DPN     =array_sum($aDPN);   //����Թ����ػ�ó� ��ǹ����ԡ�����  

$netfree=$Essd+$Nessdy+$DSY+$DPY;
$netpay=$Nessdn+ $DSN+$DPN;
$total=$Essd+$Nessdy+$DSY+$DPY+$Nessdn+$DSN+$DPN;

//item count
$item=0;
for ($n=1; $n<=$x; $n++){
   If (!empty($aDgcode[$n])){
             $item++;
	}
        };

 include("connect.inc");

//insert data into labsuit
    for ($n=1; $n<=$x; $n++){
         If (!empty($aDgcode[$n])){
                $query = "INSERT INTO labsuit(suitcode,drugcode,depart,detail,amount,price,part,slipcode,idname)
                                 VALUES('$cSuitcode','$aDgcode[$n]','$cDepart','$aTrade[$n]','$aAmount[$n]',
                                 '$aMoney[$n]','$aPart[$n]','$aSlipcode[$n]','$sOfficer');";
           $result = mysql_query($query) or 
                die("**��͹ ! ����;�˹�ҵ�ҧ����ʴ������ѹ�֡������仡�͹���� ���͡�úѹ�֡�������<br>
	*�ô��Ǩ�ͺ<br>
                -------- ��¡�� ---------<br> 
	�����ٵ� :$cSuitname<br>
                �����ٵ� :$cSuitcode<br>
               �ӹǹ $item ��¡��<br>
               �Ҥ���� $Netprice �ҷ<br>
               ����Թ�����  $total  �ҷ<br>
               ���. $sOfficer<br>");
        }
        }

     $sql = "INSERT INTO druglst(drugcode,tradname,salepri,part)
                  VALUES('$cSuitcode','$cSuitname','$Netprice','');";
      $result = mysql_query($sql);

   include("unconnect.inc");

//������
      print "�����ٵ� :$cSuitname<br>";
      print "�����ٵ� :$cSuitcode<br>";
      $no=0;
      for ($n=1; $n<=$x; $n++){
   If (!empty($aDgcode[$n])){
              $no++;
              print "$no - $aTrade[$n],$aSlipcode[$n],
                        �ӹǹ$aAmount[$n],�Ҥ�$aMoney[$n] �ҷ<br>";
			}
                                              };
      print "����Թ  $total  �ҷ<br>";
      print "���. $sOfficer<br><br>";
//
?>
 
