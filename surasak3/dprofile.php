<?php
     session_start();
    
	
	session_unregister("cHn");  
     session_unregister("cAn");
     session_unregister("tvn");
    session_unregister("cPtname");    
   session_unregister("cPtright");
   session_unregister("cDoctor");    
    session_unregister("cDiag");    
   session_unregister("cWard");    
   session_unregister("cBed");    
   session_unregister("cBedcode");    
   session_unregister("cAge");    
   session_unregister("cAccno");    
   session_unregister("nDay");   

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

	$_SESSION["cHn"]="$vHn";
	$_SESSION["cAn"]="$vAn";
	$_SESSION["tvn"] ="$cAn";
	$_SESSION["cPtname"]="$vPtname";
	$_SESSION["cPtright"]="$vPtright"; 
	$_SESSION["cDoctor"]="$vDoctor";
	$_SESSION["cDiag"]="$vDiag";
	$_SESSION["cBed"]="$vBed";
	$_SESSION["cBedcode"]="$vBedcode";
	$_SESSION["cAge"]="$vAge";
	$_SESSION["cAccno"]="$vAccno";
	$_SESSION["nDay"]=1;

     print"<frameset rows='13%,87%'>";
     print" <frame name='top' src='dprofiban.php' noresize scrolling='no'>";
	 print"<frameset cols='40%,60%'>";
		 print"<frame name='left' src='statdrug.php' scrolling='auto'>";
		print" <frame name='right' src='contdrug.php' scrolling='auto'>";
	print"</frameset>";
     print"</frameset>";
?>