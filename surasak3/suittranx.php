<?php
    session_start();
    if (isset($sIdname)){} else {die;} //for security
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");

   //item count
   $item=0;
   for ($n=1; $n<=$x; $n++){
        If (!empty($aDgcode[$n])){
             $item++;
	}
            };

    include("connect.inc");

//insert data into labsuit
     $sql = "INSERT INTO labcare(code,depart,detail,price,part)
                  VALUES('$cSuitcode','$cDepart','$cSuitname','$Netprice','');";
      $result = mysql_query($sql) or 
                die("**��͹ ! ����;�˹�ҵ�ҧ����ʴ������ѹ�֡������仡�͹���� ���͡�úѹ�֡�������<br>
	*�ô��Ǩ�ͺ�������¡������� [�١�è����Թ] �������<br>
	*������ʴ���� ��ѹ�֡仡�͹����<br>
	*���������ʴ����  ��úѹ�֡�������<br><br>
                -------- ��¡�� ---------<br> 
	�����ٵ� :$cSuitname<br>
                �����ٵ� :$cSuitcode<br>
                $cSuitname<br>
               �ӹǹ $item ��¡��<br>
               �Ҥ���� $Netprice �ҷ<br>
               ���. $sOfficer<br>");

    for ($n=1; $n<=$x; $n++){
         If (!empty($aDgcode[$n])){
                $query = "INSERT INTO labsuit(suitcode,code,depart,detail,amount,price,part,idname)
                                 VALUES('$cSuitcode','$aDgcode[$n]','$cDepart','$aTrade[$n]','$aAmount[$n]',
                                 '$aMoney[$n]','$aPart[$n]','$sOfficer');";
           $result = mysql_query($query) or  die("Query failed,update opday");
		        }
		        };

   include("unconnect.inc");

//���˹��
    print "�����ٵ� :$cSuitname<br>";
    print "�����ٵ� :$cSuitcode<br>";
    $no=0;
    for ($n=1; $n<=$x; $n++){
          If (!empty($aDgcode[$n])){
              $no++;
              print "$no - $aTrade[$n],�ӹǹ$aAmount[$n],�Ҥ�$aMoney[$n] �ҷ<br>";
                         }
                         } ;
   print "�Ҥ���� $Netprice �ҷ<br>";
   print "���. $sOfficer<br>";  
//�����˹��
?>
 
