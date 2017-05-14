<script type="text/javascript"> 
function timedMsg() 
{ 
setTimeout("count();",1000) ;
} 

function count(){
	
	if(eval(document.all['mysdiv'].innerHTML) == 1){
		window.close();
		 window.opener.location.reload();
	}else{
		document.all['mysdiv'].innerHTML = eval(document.all['mysdiv'].innerHTML)-1;
		timedMsg();
	}

}

window.onload = function(){
timedMsg();
}
</script>

<?php
session_start();
 include("connect.inc");
 
   function jschars($str)
{
    $str = str_replace("\\\\", "\\\\", $str);
    $str = str_replace("\"", "\\\"", $str);
    $str = str_replace("'", "\'", $str);
    $str = str_replace("\r\n", "\\n", $str);
    $str = str_replace("\r", "\\n", $str);
    $str = str_replace("\n", "\\n", $str);
    $str = str_replace("\t", "\\t", $str);
    //$str = str_replace("<", "\\x3C", $str); // for inclusion in HTML
    //$str = str_replace(">", "\\x3E", $str);
    return $str;
}

$addfood=jschars($_POST['addfood']);
 
  $regisdate=(date("Y")+543).date("-m-d H:i:s");
  $sOfficer=$_SESSION["sOfficer"];
  $chgcode="Food";
  
  
  $foodin=$food.' '.$addfood;
  
  $query ="UPDATE bed SET food='$foodin' WHERE bedcode='$cBedcode' ";
  $result = mysql_query($query)or die("Query failed bed");

  
  $sql_food="INSERT INTO `ward_log` ( `regisdate` , `an` , `hn` , `ward` , `bedcode` , `chgcode` , `old` , `new` ,  `lastcall` , `office` ) VALUES ( '".$regisdate."', '".$_POST['an']."', '".$_POST['hn']."', '".$_POST['ward']."', '".$_POST['bedcode']."','".$chgcode."', '".$_POST['food_old']."', '".$foodin.' '.$addfood."', '".$_POST['lastcall']."',  '".$sOfficer."')";
$result_food = mysql_query($sql_food)or die(mysql_error());

If (!$result){
         echo "new food fail <br>";
         echo mysql_errno() . ": " . mysql_error(). "\n";
         }
else {
         print " แก้ไขอาหารใหม่เป็น : $food $addfood <br>";
        // print "  ปิดหน้าต่างนี้   แล้ว Refresh หน้าต่างหอผู้ป่วยเพื่อทำข้อมูลให้เป็นปัจจุบัน";
         }
		 
		 ?>
	    <br />
        <br />	 
         ระบบปิดหน้าต่างใน <span id="mysdiv">5</span> วินาที
         <?
		 
 include("unconnect.inc");
/*
//session_destroy();
    //ipdata.php
    session_unregister("x");
    session_unregister("aDgcode");
    session_unregister("aTrade");
    session_unregister("aPrice");
    session_unregister("aPart");
    session_unregister("aAmount");
    session_unregister("aMoney");
    session_unregister("Netprice");
    session_unregister('cDate');
    session_unregister('cBedcode');
    session_unregister('cBed');
    session_unregister('cPtname');
    session_unregister('cAge');
    session_unregister('cPtright');
    session_unregister('cDoctor');
    session_unregister('cHn');
    session_unregister('cAn');
    session_unregister('cDiag');
    session_unregister('cBedpri');
    session_unregister('cChgdate');
    session_unregister('cBedname');
    session_unregister('cAccno');
*/
    session_unregister('cBedcode');
    session_register("Bedcode");
////
?>
 