<?php
    session_start();
//    session_destroy();
    //xxxpage.php
    session_unregister("cDepart"); 
    session_unregister("aDetail");
    session_unregister("cTitle");
    //vnxxx.php
    session_unregister("cHn");    
    session_unregister("cPtname");
    session_unregister("cPtright");
    //prelab.php
    session_unregister("x");       
    session_unregister("aDgcode");
    session_unregister("aTrade");
    session_unregister("aPrice");
    session_unregister("aPart");
    session_unregister("aAmount");
    session_unregister("aMoney");
    session_unregister("Netprice");
    session_unregister("cPart");
    session_unregister("cDiag");
    session_unregister("cAn"); 
    session_unregister("cDoctor"); 
    session_unregister("cAccno"); 
    session_unregister("nRunno");

    session_unregister("aYprice");
    session_unregister("aNprice");
    session_unregister("aSumYprice");
    session_unregister("aSumNprice");

///

if($smenucode=='ADMNID'){
$cDepart = 'NID';
 $aDetail='��ҵ�Ǩ���������ä';
 $cTitle="������¡�õ�Ǩ��ͧ�ѧ���";
 $depart="nidmenu.php";
	}; 
 
 session_register("cDepart");
 session_register("aDetail");
 session_register("cTitle");
// echo $smenucode;
//  echo $depart; 
?>
<frameset rows="13%,87%">
  <frame name="top" src="<?php echo $depart;  ?>" noresize scrolling="no">
<frameset cols="40%,60%">
  <frame name="left" src="vndiag.php" scrolling="auto">
  <frame name="right" src="UntitledFrame-3" scrolling="auto">
</frameset>
</frameset><noframes></noframes>


