<body Onload="window.print();"><?php
    session_start();
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");

    $sticker=2;
    for($i=1; $i<=$sticker; $i++){
       print "<font face='Angsana New' size='1'>$Thaidate<br></font>";
       IF (!empty($cAn)) {
                  print "<font face='Angsana New' size='2'>IPD,AN:$cAn,HN:$cHn<br></font>";
		   }
       ELSE {
                  print "<font face='Angsana New' size='2'>OPD,HN:$cHn<br></font>";
                 };
       print "<font face='Angsana New' size='2'>$cPtname<br></font>";

       for ($n=1; $n<=$x; $n++){
         If (!empty($aDgcode[$n])){
             print "<font face='Angsana New' size='1'>$aDgcode[$n],</font>";
			}
                                              } ;
        print "<br><br><br>";
       };

?>


