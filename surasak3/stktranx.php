<?php
    session_start();
  //  $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
    $Thidate = (date("Y")+543).date("-m-d");
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    $cGetdate=date("Y-m-d");

    include("connect.inc");

//insert data into stktranx table
/*
$aDgcode[$n]
$aTrade[$n]
$aExpdate[$n]
$aLotno[$n]
$aAmount[$n]
$aStkcut[$n]
$aNetlot[$n]
$aUnit[$n]

$cBillno
$cDepcode
$aUnitpri[$n]
$nChktran;
*/

// print "$Thidate<br>";
//insert data into billtranx ���ͻ�ͧ�ѹ��õѴʵ�͡���
   $query = "INSERT INTO billtranx(chktranx,date,officer)
                    VALUES('$nRunno','$Thidate','$sOfficer');";
       $result = mysql_query($query) or 
                die("**��͹ ! ����;�˹�ҵ�ҧ����ʴ������ѹ�֡������仡�͹���� ���͡�úѹ�֡�������<br>");

//insert data into stktranx ���ͺѹ�֡��¡���ԡ�ҡ��ѧ���˹����ԡ
 for ($n=1; $n<=$x; $n++){
   If (!empty($aDgcode[$n])){
 $nNetlot=$aAmount[$n]-$aStkcut[$n];
   $query = "INSERT INTO stktranx(date,drugcode,tradname,expdate,lotno,stkcut,unit,officer,billno,department,unitpri,netlotno,getdate,
	mainstk,stock,totalstk)
                    VALUES('$cGetdate','$aDgcode[$n]','$aTrade[$n]','$aExpdate[$n]','$aLotno[$n]',
                    	'$aStkcut[$n]','$aUnit[$n]','$sOfficer','$cBillno','$cDepcode','$aUnitpri[$n]','$nNetlot','$cGetdate',
	                '$aMainstk[$n]','$aStock[$n]','$aTotalstk[$n]');";
   $result = mysql_query($query) or die("��ҹ��Ѵʵ�͡仡�͹����");
//   echo mysql_errno() . ": " . mysql_error(). "\n";
//   echo "<br>";
		   }
   };
//update data in combill
 for ($n=1; $n<=$x; $n++){
   If (!empty($aDgcode[$n])){
        $query ="UPDATE combill SET amount = amount- $aStkcut[$n]
                       WHERE dgexplot= '$aDglotno[$n]' ";
        $result = mysql_query($query)
                       or die("Query failed,update combill");
//       echo mysql_errno() . ": " . mysql_error(). "\n";
//        echo "<br>";
		}
        };

//update data in druglst 
 for ($n=1; $n<=$x; $n++){
   If ($cDepcode=='��ͧ������'){
        $query ="UPDATE druglst SET stock = stock+$aStkcut[$n],
			          mainstk=mainstk-$aStkcut[$n],
            			          totalstk = stock + mainstk,
								  datetranx = '".(date("Y")+543)."".date("-m-d H:i:s")."'

                       WHERE drugcode= '$aDgcode[$n]' ";
        $result = mysql_query($query)
                       or die("1Query failed,update druglst");
		}
   else{
        $query ="UPDATE druglst SET mainstk=mainstk-$aStkcut[$n],
              			          rxaccum = rxaccum + $aStkcut[$n],
             			          rx1day   = rx1day + $aStkcut[$n],
            			          totalstk = stock + mainstk,
								  datetranx = '".(date("Y")+543)."".date("-m-d H:i:s")."'
                       WHERE drugcode= '$aDgcode[$n]' ";
        $result = mysql_query($query)
                       or die("2Query failed,update druglst");
         }
        };

///////�ԡ�ҡ˹����ԡ��� �������ͧ����������
 $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
 $Netprice=0;
     If ($cDepcode!='��ͧ������'){
            for ($n=1; $n<=$x; $n++){
                 $nPrice = $aStkcut[$n]*$aUnitpri[$n];
                 $Netprice=$Netprice + $nPrice;
         
                 $query = "INSERT INTO stkdata(date,billno,depcode,drugcode,tradname,
                         amount,price,part)VALUES('$Thidate','$cBillno','$cDepcode','$aDgcode[$n]','$aTrade[$n]',
                         '$aStkcut[$n]','$nPrice','$aPart[$n]');";
                 $result = mysql_query($query) or die("Query failed,insert into stkdata");
          			       };

	//insert data into stkbill
                $query = "INSERT INTO stkbill(chktranx,date,depcode,billno,item,price,idname)
                                            VALUES('$nChktran','$Thidate','$cDepcode','$cBillno','$x','$Netprice','$sOfficer');";               
                $result = mysql_query($query) or
	        die(" ��͹ ! ����;�˹�ҵ�ҧ����ʴ����<br>
	       1. ��õѴ stock in stkbill �������<br>
	           ����<br>
	       2. ��Ѵ stock 仡�͹����<br><br>
	          �ô��Ǩ�ͺ<br>");
			}

 include("unconnect.inc");
//report
   print "<font face='Angsana New'>�ѹ��� $Thaidate<br>";
   print "<font face='Angsana New'>��¡���ԡ���Ǫ�ѳ��ҡ��ѧ���˭��$cDepcode<br>";
   print "<table>";
   print " <tr>";
   print "  <th>#</th>";
   print "  <th>��¡��</th>";
   print "  <th>�������</th>";
   print "  <th>Lot.No.</th>";
   print "  <th>�ӹǹ</th>";
   print "  <th>�ԡ</th>";
   print "  <th>˹���</th>";
   print "  <th>�����</th>";

   print " </tr>";
      $no=0;
   for ($n=1; $n<=$x; $n++){
   If (!empty($aDgcode[$n])){
         $no++;
   $nNetlot=$aAmount[$n]-$aStkcut[$n];
         print (" <tr>\n".
           "  <td>$no</td>\n".
           "  <td>$aTrade[$n]</td>\n".
           "  <td>$aExpdate[$n]</td>\n".
           "  <td>$aLotno[$n]</td>\n".
           "  <td>$aAmount[$n]</td>\n".
           "  <td>$aStkcut[$n]</td>\n".
           "  <td>$aUnit[$n]</td>\n".
           "  <td>$nNetlot</td>\n".
           " </tr>\n");
			}
                                              };
   print "</table>";
   print "<br><font face='Angsana New'>���. $sOfficer<br>";
//end report
?>
