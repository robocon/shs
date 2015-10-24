<?php
session_start();

global $regisdate,$an,$sex,$married,$idcard,
$warcard,$camp,$goup,$dbirth,$race,$national,$religion,$career,$ptright,$address,
$tambol,$ampur,$changwat,$parent,$couple,$guardian, $thdatehn;

$thidate = (date("Y")+543).date("-m-d H:i:s"); 
$Thaidate=date("d-m-").(date("Y")+543)." เวลา  ".date("H:i:s");
$time=date("H:i:s");

include("connect.inc");
 
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

$thidate_check = ( date('Y') + 543 ).date('-m-d');

// Recusive function ตรวจสอบคิวและออกคิวเลขใหม่
function opday_update_queue($title, $thidate, $datehn, $vn){
	$sql = "SELECT `title`, `prefix`, `runno` FROM `runno` WHERE `title` = '$title';";
	$query = mysql_query($sql) or die( mysql_error() );
	$item = mysql_fetch_assoc($query);
	
	$next_runno = intval($item['runno']) + 1;
	$sql ="UPDATE `runno` SET `runno` = '$next_runno' WHERE `title` = '$title';";
	mysql_query($sql) or die( mysql_error() );
	
	$queue_title = $item['prefix'].$next_runno;
	
	// ก่อนจะอัพเดท ตรวจสอบคิวก่อนอีกครั้งว่าในวันนี้มีคิวนี้ออกไปแล้วรึยัง
	$sql = "SELECT `kew` FROM `opday` 
	WHERE `thidate` LIKE '$thidate%' 
	AND `kew` = '$queue_title';";
	$query = mysql_query($sql) or die( mysql_error() );
	$row = mysql_num_rows($query);
	if( $row === 0 ){
		$sql ="UPDATE opday SET kew = '$queue_title' WHERE `thdatehn` = '$datehn' AND vn = '$vn' LIMIT 1;"; 
		mysql_query($sql) or die( mysql_error() );
		
		$data = array(
			'title' => $queue_title,
		);
		return $data;
		
	}else{
		$item = opday_update_queue($title, $thidate, $datehn, $vn);
		return $item;
	}
}

$skip_check = isset($_GET['skip_check_queue']) ? 1 : 0 ;
if( $skip_check === 0 ){
	// ตรวจสอบการออกคิวว่าเคยออกคิวไปแล้วรึยัง
	$sql = "SELECT `ptname`,`hn`,`kew` FROM `opday` WHERE `thdatehn` = '$thdatehn' AND `vn` = '".$_SESSION["nVn"]."'";
	$query = mysql_query($sql) or die( mysql_error() );
	$queue_item = mysql_fetch_assoc($query);
	if( !empty($queue_item['kew']) ){
		echo "<p>{$queue_item['ptname']} HN: {$queue_item['hn']}</p>";
		echo "<p>ได้คิว {$queue_item['kew']} เรียบร้อยแล้ว</p>";
		echo '<p><a href="kewadd.php?skip_check_queue=1">คลิกที่นี่</a> หากต้องการออกคิวใหม่ หรือ <a href="javascript:void(0);" onclick="window.close();">ปิดหน้าต่าง<a/>';
		exit;
	}
}

if(substr($cIdguard,0,4)=='MX01'){ // ทหารและครอบครัว
	$sql = "select * from opcard where hn = '$cHn' ";
	$row = mysql_query($sql);
	$result = mysql_fetch_array($row);
	// $ages = calcage($result["dbirth"]);
	
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
	print "<center><font size=5><b> ลำดับที่:$vkew1 </b><br> ";
	print "<center><font size=4><b>ทหารและครอบครัว  </b><br> ";
	print "<center><font size=2><b>วันที่$Thaidate</b><br> ";
	print "<center>$cPtname<br>"; 
	print "<center>HN:$cHn.....VN:$nVn<br>";
	print "<center><b>รอรับบริการที่จุดคัดแยก</b><br>";
	
	include("unconnect.inc");
	/*
	session_unregister("cHn");  
	session_unregister("cPtname");
	session_unregister("cPtright");
	session_unregister("nVn");  
	session_unregister("vkew1");  
	*/
	//session_destroy();

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
			print "<center><font size=5><b> ลำดับที่:$vkew12 </b><br> ";
			print "<center><font size=4><b>ผู้สูงอายุ  </b><br> ";
			print "<center><font size=2><b>วันที่ $Thaidate</b><br> ";
			print "<center>$cPtname<br>"; 
			print "<center>HN:$cHn.....VN:$nVn<br>";
			print "<center><b>รอรับบริการที่จุดคัดแยก</b><br>";
	}else{
		
		/*
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
			print "<center><font size=5><b> ลำดับที่:$vkew12 </b><br> ";
		*/
		
		
		$update = opday_update_queue('kew', $thidate_check, $thdatehn, $_SESSION["nVn"]);
		
		$queue = $update['title'];
			print "<center><font size=5><b> ลำดับที่:$queue </b><br> ";
			print "<center><font size=4><b>ตรวจโรคทั่วไป  </b><br> ";
			print "<center><font size=2><b>วันที่ $Thaidate</b><br> ";
			print "<center>$cPtname<br>"; 
			print "<center>HN:$cHn.....VN:$nVn<br>";
			print "<center><b>รอรับบริการที่จุดคัดแยก</b><br>";
	}
// include("unconnect.inc");
/*
    session_unregister("cHn");  
    session_unregister("cPtname");
    session_unregister("cPtright");
    session_unregister("nVn");  
  session_unregister("vkew");  
*/
//session_destroy(); 
       

}

    // session_start();
    // include("connect.inc");
$cy='A';

//update kew in opday
$query ="UPDATE opday SET phaok='$cy' WHERE thdatehn = '$thdatehn'  AND vn = '".$_SESSION["nVn"]."' ";
$result = mysql_query($query) or die("Query failed,update opday");
//echo mysql_errno() . ": " . mysql_error(). "\n";
//echo "<br>";
If (!$result){
	echo "insert into opday fail";
}

include("unconnect.inc");
session_unregister("sTdatehn");
?>
<script type="text/javascript">
function CloseWindowsInTime(t){
	t = t*1000;
	setTimeout(function(){
		window.close();
	},t);
}
CloseWindowsInTime(2); 
</script>