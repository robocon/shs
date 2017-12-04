<?php
  session_start();
//  $Thidate = (date("Y")+543).date("-m-d G:i:s"); 
  include("connect.inc");

    $aIcd9cm = array("icd9cm");

    $aIcd9cm[1]  = $icd9cm1;
    $aIcd9cm[2]  = $icd9cm2;
    $aIcd9cm[3]  = $icd9cm3;
    $aIcd9cm[4]  = $icd9cm4;
    $aIcd9cm[5]  = $icd9cm5;
    $aIcd9cm[6]  = $icd9cm6;
    $aIcd9cm[7]  = $icd9cm7;
    $aIcd9cm[8]  = $icd9cm8;
    $aIcd9cm[9]  = $icd9cm9;
    $aIcd9cm[10]  = $icd9cm10;

    $aIcddate = array("icddate");
    $aIcddate[1]  = $icddate1;
    $aIcddate[2]  = $icddate2;
    $aIcddate[3]  = $icddate3;
    $aIcddate[4]  = $icddate4;
    $aIcddate[5]  = $icddate5;
    $aIcddate[6]  = $icddate6;
    $aIcddate[7]  = $icddate7;
    $aIcddate[8]  = $icddate8;
    $aIcddate[9]  = $icddate9;
    $aIcddate[10]  = $icddate10;

    FOR ($no=1; $no<=10; $no++){
         IF (!empty($aIcd9cm[$no]) ){
            echo "ICD9CM $aIcd9cm[$no]; date $aIcddate[$no]; AN $cAn,admitdate $cDate<br>";

print "sAn $sAn,sDate $sDate<br>";

            //insert data into ipicd9cm
           $query = "INSERT INTO ipicd9cm(admdate,an,icd9cm,icddate,officer)
	 	                 VALUES('$cDate','$cAn','$aIcd9cm[$no]','$aIcddate[$no]','$sOfficer');";
           $result = mysql_query($query) or die("Query failed,cannot insert into ipicd9cm");
	    	}
			}
           print "<br>บันทึกข้อมูลเรียบร้อย <br>";
    include("unconnect.inc");
?>