<body Onload="window.print();">


<?php
    session_start();
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
	
	return $ageY;
	}

    if (isset($sIdname)){} else {die;} //for security
    $Thidate = (date("Y")+543).date("-m-d H:i:s");
	$ldate = (date("Y")+543).date("-m-d"); 
	$Thidate2 = date("Y").date("-m-d H:i:s"); 
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");

    include("connect.inc");
	$query = "SELECT * FROM opday WHERE hn = '".$_SESSION['hn']."' and thidate like '".$ldate."%' ";
	$result = mysql_query($query) or die("Query failed");

	    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	        if (!mysql_data_seek($result, $i)) {
	            echo "Cannot seek to row $i\n";
	            continue;
			}
	        if(!($row = mysql_fetch_object($result)))
	            continue;
		}
        if(mysql_num_rows($result)){
		  $tvn=$row->vn;
	      $cHn=$row->hn;
          $cPtname=$row->ptname;
		}
		
	$query = "SELECT qlab,idno FROM chkup_solider WHERE hn = '".$_SESSION['hn']."'";
	$result = mysql_query($query) or die("Query failed");
	list($qlab,$idno) = mysql_fetch_array($result);
	$idno = substr($idno,0,2);
   ///stricker
   echo "<font style='font-family:AngsanaUPC; font-size:16px;'>ตรวจสุขภาพประจำปี$idno &nbsp;Lab:$qlab<br>";
   echo "<b>HN:$cHn</b>&nbsp;VN:$tvn&nbsp;".date("d-m-").(date("Y")+543)." ".date("H:i:s")."<br>";
   echo " ชื่อ:$cPtname <br>";
   echo "กรุณายื่นที่ห้องทะเบียนก่อนเวลา 13.00 น.</font>";
   //stricker
?>
<Script Language="JavaScript">
function CloseWindowsInTime(t){
t = t*1000;
setTimeout("window.close()",t);
}
CloseWindowsInTime(2/*ใส่เวลาเป็นวินาทีนะครับตรงเลข 5 */); 
</Script>
