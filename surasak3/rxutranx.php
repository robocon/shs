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

//insert data into stkbill
         $query = "INSERT INTO stkbill(chktranx,date,depcode,billno,item,price,idname)
                                            VALUES('$nRunno','$Thidate','$cDepcode','$cBillno','$item','$Netprice','$sOfficer');";
                 
   $result = mysql_query($query) or
	die(" ��͹ ! ����;�˹�ҵ�ҧ����ʴ����<br>
	1. ��õѴ stock �������<br>
	����<br>
	2. ��Ѵ stock 仡�͹����<br><br>
	�ô��Ǩ�ͺ<br><br>
                -------- ��¡�è��� ---------<br> 
           $Thaidate<br>
           ˹����ԡ:$cDepcode<br>
           �Ţ�����ԡ:$cBillno<br>
           �ӹǹ $item ��¡��<br>
           ����Թ $Netprice �ҷ<br>
          <br>���. $sOfficer<br>");

//insert data into stkdata
for ($n=1; $n<=$x; $n++){
   If (!empty($aDgcode[$n])){
         $query = "INSERT INTO stkdata(date,billno,depcode,drugcode,tradname,
             amount,price,part)VALUES('$Thidate','$cBillno','$cDepcode','$aDgcode[$n]','$aTrade[$n]',
             '$aAmount[$n]','$aMoney[$n]','$aPart[$n]');";

        $result = mysql_query($query)
        or die("Query failed,insert into drugrx");
	}
        };


//update data in druglst 
 for ($n=1; $n<=$x; $n++){
   If (!empty($aDgcode[$n])){
        $query ="UPDATE druglst SET stock = stock - $aAmount[$n],
              			  rxaccum = rxaccum + $aAmount[$n],
             			  rx1day   = rx1day +$aAmount[$n],
        			  totalstk = stock + mainstk
                       WHERE drugcode= '$aDgcode[$n]' ";
        $result = mysql_query($query)
                       or die("Query failed,update druglst");
		}
        };

 include("unconnect.inc");

//report
   print "$Thaidate<br>";
   print "˹����ԡ:$cDepcode<br>";
   print "�Ţ�����ԡ:$cBillno<br>";
   $no=0;
   for ($n=1; $n<=$x; $n++){
        If (!empty($aDgcode[$n])){
              $no++;
              print "$no - $aTrade[$n],
              �ӹǹ $aAmount[$n],����Թ $aMoney[$n] �ҷ<br> ";
	}
                } ;
   print "����Թ $Netprice �ҷ<br>";
   print "<br>���. $sOfficer<br>";
//end report
?>
 
