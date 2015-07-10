<?php
   session_start();
  include("connect.inc");
    $no=0;

    $aDrugcode = array("รหัส");
    $aTradname  = array("รายการ");
    $aAdvreact = array("อาการแพ้"); 
    $aAsses  = array("ประเมิน");
    $aReporter  = array("ผู้รายงาน");
    $aRepdate= array("วันที่รายงาน");

    $aDrugcode[1] = "$drugcode1";
    $aTradname[1]  = "$tradname1";
    $aAdvreact[1] = "$advreact1"; 
    $aAsses[1]  = "$asses1";
    $aReporter[1]  = "$reporter1";
    $aRepdate[1] = "$repdate1";

    $aDrugcode[2] = "$drugcode2";
    $aTradname[2]  = "$tradname2";
    $aAdvreact[2] = "$advreact2"; 
    $aAsses[2]  = "$asses2";
    $aReporter[2]  = "$reporter2";
    $aRepdate[2] = "$repdate2";

    $aDrugcode[3] = "$drugcode3";
    $aTradname[3]  = "$tradname3";
    $aAdvreact[3] = "$advreact3"; 
    $aAsses[3]  = "$asses3";
    $aReporter[3]  = "$reporter3";
    $aRepdate[3] = "$repdate3";

    $aDrugcode[4] = "$drugcode4";
    $aTradname[4]  = "$tradname4";
    $aAdvreact[4] = "$advreact4"; 
    $aAsses[4]  = "$asses4";
    $aReporter[4]  = "$reporter4";
    $aRepdate[4] = "$repdate4";

    $aDrugcode[5] = "$drugcode5";
    $aTradname[5]  = "$tradname5";
    $aAdvreact[5] = "$advreact5"; 
    $aAsses[5]  = "$asses5";
    $aReporter[5]  = "$reporter5";
    $aRepdate[5] = "$repdate5";

    $aDrugcode[6] = "$drugcode6";
    $aTradname[6]  = "$tradname6";
    $aAdvreact[6] = "$advreact6"; 
    $aAsses[6]  = "$asses6";
    $aReporter[6]  = "$reporter6";
    $aRepdate[6] = "$repdate6";

    $aDrugcode[7] = "$drugcode7";
    $aTradname[7]  = "$tradname7";
    $aAdvreact[7] = "$advreact7"; 
    $aAsses[7]  = "$asses7";
    $aReporter[7]  = "$reporter7";
    $aRepdate[7] = "$repdate7";
     
    echo"<font face='Angsana New'>ชื่อ: $sPtname,HN: $sHn, ";  
    echo "สิทธิการรักษา: $sPtright<br>";
FOR ($no=1; $no<=7; $no++){
   IF (!empty($aTradname[$no])) {        echo"$aDrugcode[$no],$aTradname[$no],$aAdvreact[$no],$aAsses[$no],$aReporter[$no],$aRepdate[$no]<br>";
       //insert data into drugreact
     $sql = "INSERT INTO drugreact(hn,drugcode,tradname,advreact,asses,reporter,date,officer)                 VALUES('$sHn','$aDrugcode[$no]','$aTradname[$no]','$aAdvreact[$no]','$aAsses[$no]','$aReporter[$no]','$aRepdate[$no]','".$_SESSION['sOfficer']."')";
	 //echo $sql;
      $result = mysql_query($sql);
	 
		       }
	    	}
////////////////
          print "<br>บันทึกข้อมูลเรียบร้อย <br>";
  include("unconnect.inc");
    session_unregister("sHn");
    session_unregister("sPtname");
    session_unregister("sPtright");
?>