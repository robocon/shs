<?php
     session_start();
    $cHn="$vHn";
     $cAn="$vAn";
	 $tvn ="$cAn";
    $cPtname="$vPtname";
    $cPtright="$vPtright"; 
     $cDoctor="$vDoctor";
     $cDiag="$vDiag";
    $cWard="ËÍ¼Ùé»èÇÂ.............";
	$cBed="$vBed";
	$cBedcode="$vBedcode";
	$cAge="$vAge";
	$cAccno="$vAccno";
	$nDay=1;

    session_register("cHn");  
     session_register("cAn");
     session_register("tvn");
    session_register("cPtname");    
   session_register("cPtright");
   session_register("cDoctor");    
    session_register("cDiag");    
   session_register("cWard");    
   session_register("cBed");    
   session_register("cBedcode");    
   session_register("cAge");    
   session_register("cAccno");    
   session_register("nDay");    

     print"<frameset rows='13%,87%'>";
     print" <frame name='top' src='dprofiban1.php' noresize scrolling='no'>";
	 print"<frameset cols='40%,60%'>";
		 print"<frame name='left' src='statdrug.php' scrolling='auto'>";
		print" <frame name='right' src='contdrug.php' scrolling='auto'>";
	print"</frameset>";
     print"</frameset>";
?>