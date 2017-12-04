<?php
	session_start(); 
	include("opd/class_printvn.php");
	
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
	

include("connect.inc");
if(isset($_GET['nat'])){
	if(isset($_GET['doctor'])){
		$tell = "and doctor like '".$_GET['detail']."%'";
	}
	else{
		$tell = "and detail = '".$_GET['detail']."'";
	}
	$query = "SELECT hn FROM appoint WHERE appdate = '".$_GET['nat']."' ".$tell." AND apptime <> 'ยกเลิกการนัด' order by hn ";
	//echo $query;
    $result = mysql_query($query) or die("Query failed");
	while(list($Thn) = mysql_fetch_array($result)){ 
		
		
		$classopd = new printvn();
		$_SESSION["cHn"] = $Thn;
		
?>
<HTML>
<HEAD>
<TITLE> Print VN </TITLE>
<script>
 ie4up=nav4up=false;
 var agt = navigator.userAgent.toLowerCase();
 var major = parseInt(navigator.appVersion);
 if ((agt.indexOf('msie') != -1) && (major >= 4))
   ie4up = true;
 if ((agt.indexOf('mozilla') != -1)  && (agt.indexOf('spoofer') == -1) && (agt.indexOf('compatible') == -1) && ( major>= 4))
   nav4up = true;
</script>

	<SCRIPT LANGUAGE="JavaScript">
		
		window.onload = function(){
			window.print();
			var t;
			t = 1*1000;
			setTimeout("window.close()",t);

		}
	</SCRIPT>

</HEAD>

<BODY  BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>
<DIV style='z-index:0'> &nbsp; </div>
	<?php
	$classopd->input_hn($_SESSION["cHn"]);

	if(isset($_GET["clinin"]))
		$classopd->set_clinic($_GET["clinin"]);
	if(isset($_GET["doctor"]))
		$classopd->set_doctor($_GET["doctor"]);
	if(isset($_GET['detail']))
		$classopd->set_toborow($_GET['detail']);
	$classopd->outputprint();
	?>
</BODY>

<?
	
	echo "<br>- - - - - ตัดตามรอยปรุ - - - - -<br><br>";
	echo "<div style='page-break-after: always'></div>";
	}
}
?>
</HTML>

