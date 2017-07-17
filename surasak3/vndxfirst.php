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
  <p>ผู้ป่วยนอก  หมายเลข VN (ได้จากแผนกเวชระเบียน)</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;VN&nbsp;&nbsp;<input type="text" name="vn" size="8"></p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="   ตกลง   " name="B1"></p>
</form>

<?php

If (!empty($vn)){
    include("connect.inc");
	
	$today = date("d-m-Y");   
    $d=substr($today,0,2);
    $m=substr($today,3,2);
    $yr=substr($today,6,4) +543;  

$thdatevn=$d.'-'.$m.'-'.$yr.$vn;
 $query = "SELECT hn, ptname , ptright FROM opday WHERE thdatevn = '$thdatevn'  limit 1 ";


 $result = mysql_query($query) or die(Mysql_Error());
 list($xxx,$yyy,$zzz) = Mysql_fetch_row($result);
	
	print "HN :$xxx<br>";
   	print "$yyy<br>";
   	print "สิทธิการรักษา :$zzz";
    print "<br><a href='vndxdiag.php?hn=".$xxx."'>!ชื่อถูกต้อง ทำรายการต่อไป</a>";
   
	
   include("unconnect.inc");
   }
?>

