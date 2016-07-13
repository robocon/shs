<?php
 session_start();
    $cHn="";
    $cPtname="";
    $cPtright="";
    $nRunno="";
    session_register("nRunno");
    session_register("cHn");
    session_register("cPtname");
    session_register("cPtright");

	function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}

	if ($ageM==0){
		$pAge="$ageY ปี";
	}else{
		$pAge="$ageY ปี $ageM เดือน";
	}

return $pAge;
}

?>
<form method="POST" action="<?php echo $PHP_SELF ?>">
  <p>ผู้ป่วยนอก  หมายเลข HN (ได้จากแผนกเวชระเบียน)</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;HN&nbsp;&nbsp;<input type="text" name="hn" size="8"></p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="   ตกลง   " name="B1"></p>
</form>

<?php

If (!empty($hn)){
    include("connect.inc");
	
	$today = date("d-m-Y");   
    $d=substr($today,0,2);
    $m=substr($today,3,2);
    $yr=substr($today,6,4) +543;  

$thdatehn=$d.'-'.$m.'-'.$yr.$hn;
 $query = "SELECT hn, concat(yot,' ',name,' ',surname) as ptname, ptright FROM opcard WHERE hn = '$hn'  limit 1 ";

 $result = mysql_query($query) or die(Mysql_Error());
 list($xxx,$yyy,$zzz) = Mysql_fetch_row($result);
	
	print "HN :$xxx<br>";
   	print "$yyy<br>";
   	print "สิทธิการรักษา :$zzz";
    print "<br><a href='clinic100diag.php?hn=".$xxx."'>!ชื่อถูกต้อง ทำรายการต่อไป</a>";
   
	
   include("unconnect.inc");
   }
?>

