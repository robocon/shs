<?php
session_start();

include("connect.inc");

$thidate = (date("Y")+543).date("-m-d H:i:s"); 
$Thaidate=date("d-m-").(date("Y")+543)." เวลา  ".date("H:i:s");
$time=date("H:i:s");
global $regisdate,$an,$sex,$married,$idcard,
$warcard,$camp,$goup,$dbirth,$race,$national,$religion,$career,$ptright,$address,
$tambol,$ampur,$changwat,$parent,$couple,$guardian;

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
		$pAge="$ageY";
	}else{
		$pAge="$ageY";
	}

	return $pAge;
}


?>

<!--<body Onload="window.print();">-->
<body>
<Script Language="JavaScript">
function CloseWindowsInTime(t){
t = t*1000;
setTimeout("window.close()",t);
}
CloseWindowsInTime(2/*ใส่เวลาเป็นวินาทีนะครับตรงเลข 5 */); 
</Script>


<?php

if(substr($cIdguard,0,4)=='MX01'){
	$sql = "select * from opcard where hn = '$cHn' ";
	$row = mysql_query($sql);
	$result = mysql_fetch_array($row);
	$ages = calcage($result["dbirth"]);
	
	$query = "SELECT title,prefix,runno FROM runno WHERE title = 'kew1'";
	$result = mysql_query($query) or die("Query failed runno ask");

	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}

		if(!($row = mysql_fetch_object($result)))
			continue;
	}

	$vTitle=$row->title;
	$vPrefix=$row->prefix;
	$nRunno=$row->runno;
	$nRunno++;
	$vkew1=$nRunno;
	$vkew12=$vPrefix.$nRunno;

	// update kew to table runno
	$query ="UPDATE runno SET runno = $nRunno WHERE title='kew1'";
	$result = mysql_query($query);
	//        or die("Query failed runno update");

	// ใส่ kew ใน opday table 
	$query ="UPDATE opday SET kew = '$vkew12' WHERE thdatehn = '$thdatehn' AND vn = '".$_SESSION["nVn"]."' "; 
	$result = mysql_query($query);

	//echo mysql_errno() . ": " . mysql_error(). "\n";
	//echo "<br>";
	print "<center><font style='font-size: 24px;'><b> ลำดับที่:$vkew1 </b><br> ";
	print "<center><font style='font-size: 18px;'><b>ทหารและครอบครัว  </b><br> ";
	print "<center><font style='font-size: 13px;'><b>วันที่$Thaidate</b><br> ";
	print "<center>$cPtname<br>"; 
	print "<center>HN:$cHn.....VN:$nVn<br>";
	print "<center><b>รอรับบริการที่จุดคัดแยก</b><br>";

}else{
	
	$sql = "select * from opcard where hn = '$cHn' ";
	$row = mysql_query($sql);
	$result = mysql_fetch_array($row);
	$ages = calcage($result["dbirth"]);
	
	if($ages>=75){
		$query = "SELECT title,prefix,runno FROM runno WHERE title = 'kewolder'";
		$result = mysql_query($query)
			or die("Query failed runno ask");
	
		for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
			if (!mysql_data_seek($result, $i)) {
				echo "Cannot seek to row $i\n";
				continue;
			}
	
			if(!($row = mysql_fetch_object($result)))
				continue;
			 }
	
		 	$vTitle=$row->title;
			$vPrefix=$row->prefix;
			$nRunno=$row->runno;
			$nRunno++;
			$vkew1=$nRunno;
			$vkew12=$vPrefix.$nRunno;
		
		
		
			// update kew to table runno
			$query ="UPDATE runno SET runno = $nRunno WHERE title='kewolder'";
			$result = mysql_query($query);
			//        or die("Query failed runno update");
		
			// ใส่ kew ใน opday table 
			$query ="UPDATE opday SET kew = '$vkew12' WHERE thdatehn = '$thdatehn' AND vn = '".$_SESSION["nVn"]."' "; 
			$result = mysql_query($query);
		
			//echo mysql_errno() . ": " . mysql_error(). "\n";
			//echo "<br>";
			print "<center><font style='font-size: 24px;'><b> ลำดับที่:$vkew12 </b><br> ";
			print "<center><font style='font-size: 18px;'><b>ผู้สูงอายุ  </b><br> ";
			print "<center><font style='font-size: 13px;'><b>วันที่ $Thaidate</b><br> ";
			print "<center>$cPtname<br>"; 
			print "<center>HN:$cHn.....VN:$nVn<br>";
			print "<center><b>รอรับบริการที่จุดคัดแยก</b><br>";
	}else{
		$query = "SELECT title,prefix,runno FROM runno WHERE title = 'kew'";
		$result = mysql_query($query)
			or die("Query failed runno ask");
	
		for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
			if (!mysql_data_seek($result, $i)) {
				echo "Cannot seek to row $i\n";
				continue;
			}
	
			if(!($row = mysql_fetch_object($result)))
				continue;
		}
	
		$vTitle=$row->title;
		$vPrefix=$row->prefix;
		$nRunno=$row->runno;
		$nRunno++;
		$vkew1=$nRunno;
		$vkew12=$vPrefix.$nRunno;
		
		// update kew to table runno
		$query ="UPDATE runno SET runno = $nRunno WHERE title='kew'";
		$result = mysql_query($query);
		//        or die("Query failed runno update");
		
		// ใส่ kew ใน opday table 
			$query ="UPDATE opday SET kew = '$vkew12' WHERE thdatehn = '$thdatehn' AND vn = '".$_SESSION["nVn"]."' "; 
			$result = mysql_query($query);
		
		//echo mysql_errno() . ": " . mysql_error(). "\n";
		//echo "<br>";
		print "<center><font style='font-size: 24px;'><b> ลำดับที่:$vkew12 </b><br> ";
		print "<center><font style='font-size: 18px;'><b>ตรวจโรคทั่วไป  </b><br> ";
		print "<center><font style='font-size: 13px;'><b>วันที่ $Thaidate</b><br> ";
		print "<center>$cPtname<br>"; 
		print "<center>HN:$cHn.....VN:$nVn<br>";
		print "<center><b>รอรับบริการที่จุดคัดแยก</b><br>";
	}
	
}

$cy = 'A';

//update kew in opday
$query ="UPDATE opday SET phaok='$cy' WHERE thdatehn = '$thdatehn'  AND vn = '".$_SESSION["nVn"]."' ";
$result = mysql_query($query) or die("Query failed,update opday");

If (!$result){
	echo "insert into opday fail";
}

include("unconnect.inc");
$_SESSION['sTdatehn'] = NULL;