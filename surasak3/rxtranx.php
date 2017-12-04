<?php
    session_start();
echo "doctor=$cDoctor,idname=$cIdname,diag=$cDiag<br>";
//echo " AN=$cAn,doctor=$cDoctor,idname=$cIdname,diag=$cDiag<br>";
echo " essd=$cEssd,nessdy=$cNessdy,nessdn=$cNessdn <br>";
echo "now(),$cHn, ,$Netprice<br>";
echo "test for<br>";

  for ($n=1; $n<=$x; $n++){
  echo "(now(),$cHn,  ,$cYot  $cName  $cSurname,$aDgcode[$n],$aTrade[$n],
                $aAmount[$n],$aMoney[$n],  ,$x ,n=$n<br> ";
                } ;

 include("connect.inc");

//insert data into phardep
         $query = "INSERT INTO phardep(date,ptname,hn,an,price,doctor,item,
                    idname,diag,essd,nessdy,nessdn)VALUES(now(),'$cYot  $cName  $cSurname','$cHn','$cAn',
                    '$Netprice','$cDoctor','$x','$cIdname','$cDiag','','','');";
/*
         $query = "INSERT INTO phardep(date,ptname,hn,an,price,doctor,item,
                    idname,diag,essd,nessdy,nessdn)VALUES(now(),'$cYot  $cName  $cSurname','$cHn','$cAn',
                    '$Netprice','$cDoctor','$x','$cIdname','$cDiag','','','');";
*/
   $result = mysql_query($query)
        or die("Query failed,insert into phardep");
   echo mysql_errno() . ": " . mysql_error(). "\n";
   echo "<br>";

//insert data into drugrx
for ($n=1; $n<=$x; $n++){
         echo "(now(),$cHn,$cAn,$cYot  $cName  $cSurname,$aDgcode[$n],$aTrade[$n],
                $aAmount[$n],$aMoney[$n],  ,$x ,n=$n<br> ";
         $query = "INSERT INTO drugrx(date,hn,an,drugcode,tradname,
             amount,price,item)VALUES(now(),'$cHn','$cAn','$aDgcode[$n]','$aTrade[$n]',
             '$aAmount[$n]','$aMoney[$n]','$x');";
        $result = mysql_query($query)
        or die("Query failed,insert into drugrx");
        echo mysql_errno() . ": " . mysql_error(). "\n";
        echo "<br>";
        };
echo mysql_errno() . ": " . mysql_error(). "\n";
echo "<br>";

/*
    for ($n=1; $n<=$x; $n++){
         echo "(now(),$cHn,$cAn,$cYot  $cName  $cSurname,$aDgcode[$n],$aTrade[$n],
                $aAmount[$n],$aMoney[$n],  ,$x ,n=$n<br> ";
         $query = "INSERT INTO drugrx(date,hn,an,drugcode,tradname,
             amount,price,item)VALUES(now(),'$cHn','$cAn','$aDgcode[$n]','$aTrade[$n]',
             '$aAmount[$n]','$aMoney[$n]','$x');";
        $result = mysql_query($query)
        or die("Query failed,insert into drugrx");
        echo mysql_errno() . ": " . mysql_error(). "\n";
        echo "<br>";
        };
echo mysql_errno() . ": " . mysql_error(). "\n";
echo "<br>";
*/

//update data in druglst 
 for ($n=1; $n<=$x; $n++){
        $query ="UPDATE druglst SET stock = stock-$aAmount[$n],
              			  rxaccum = rxaccum + $aAmount[$n],
             			  rx1day   = rx1day +$aAmount[$n],
        			  totalstk = stock + mainstk
                       WHERE drugcode= '$aDgcode[$n]' ";
        $result = mysql_query($query)
                       or die("Query failed,update druglst");
        };
echo mysql_errno() . ": " . mysql_error(). "\n";
echo "<br>";
/*
// in case of inpatient insert data into ipacc
IF (!empty($cAn)) {
 //    $cDepart = 'PHAR';
     for ($n=1; $n<=$x; $n++){
 	   echo " 'insert into ipacc',now(),$cHn,$cAn,$cYot  $cName  $cSurname,$aDgcode[$n],$cDepart,$aTrade[$n],
                             $aAmount[$n],$aMoney[$n],  ,$x ,n=$n<br> ";
                   $query = "INSERT INTO ipacc(date,an,code,depart,detail,price
                                   )VALUES(now(),'$cAn','$aDgcode[$n]','$cDepart','$aTrade[$n]',
                                    '$aMoney[$n]');";
                   $result = mysql_query($query) or die("insert into ipacc failed");
 	   echo mysql_errno() . ": " . mysql_error(). "\n";
	   echo "<br>";
        }
   }
*/
//mysql_free_result($result);
 include("unconnect.inc");
?>
 
