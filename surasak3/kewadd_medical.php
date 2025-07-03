<!--<body Onload="window.print();">-->
<body>
<Script Language="JavaScript">
window.print();
function CloseWindowsInTime(t){
t = t*1000;
setTimeout("window.close()",t);
}
CloseWindowsInTime(2/*ใส่เวลาเป็นวินาทีนะครับตรงเลข 5 */); 
</Script>

<?php
session_start();
$thidate = (date("Y")+543).date("-m-d H:i:s"); 
$Thaidate=date("d-m-").(date("Y")+543)." เวลา  ".date("H:i:s");
$time=date("H:i:s");
global $regisdate,$an,$sex,$married,$idcard,
           $warcard,$camp,$goup,$dbirth,$race,$national,$religion,$career,$ptright,$address,
            $tambol,$ampur,$changwat,$parent,$couple,$guardian;
 include("connect.inc");


$getprefix=$_GET["prefix"];	

$getdetail=$_GET["detail"];	

 $query = "SELECT title,prefix,runno,startdate FROM queue_runno WHERE title = 'MEDICAL' and prefix='$getprefix'";
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
	$nStartdate=$row->startdate;
    

	if(isset($getdetail) && !empty($getdetail)){
		$sql1="select code,detail from queue_type where code='$getprefix' and detail='$getdetail'";
	}else{
		$sql1="select code,detail from queue_type where code='$getprefix'";
	}	
	$query1=mysql_query($sql1);
	list($typecode,$typename)=mysql_fetch_array($query1);


	$today=date("Y-m-d");
// update kew to table runno
	if($nStartdate==$today){  //วันเดียวกัน

		$nRunno++;  //ดึงข้อมูลคิวล่าสุด
		$no=sprintf("%'03d",$nRunno);
		$queue_no=$vPrefix.$no;	
		
		$query ="UPDATE queue_runno SET runno = '$nRunno' WHERE title = 'MEDICAL' and prefix='$getprefix'";
		$result = mysql_query($query);
		
		// ใส่ kew ใน opday table 
		$query1 ="UPDATE opday SET kew = '$queue_no' WHERE thdatehn = '$thdatehn' AND vn = '".$_SESSION["nVn"]."' "; 
		$result1 = mysql_query($query1);
		
		$add="insert into queue_opd set register_date='".date("Y-m-d")."',
												 hn='".$cHn."',
												 vn='".$nVn."',
												 ptname='".$cPtname."',
												 ptright='".$cPtright."',
												 typename='".$typename."',
												 queue_type='".$typecode."',
												 queue_no='".$queue_no."',
												 staff_medical='".$_SESSION["sOfficer"]."',
												 staff_date='".date("Y-m-d H:i:s")."';";		
		mysql_query($add);		
   
	}else{  //เริ่มวันใหม่

		$nRunno="1";  //ตั้งเป็นคิวแรก
		$no=sprintf("%'03d",$nRunno);
		$queue_no=$vPrefix.$no;

		$query ="UPDATE queue_runno SET runno = '$nRunno', startdate='$today' WHERE title = 'MEDICAL' and prefix='$getprefix'";
		$result = mysql_query($query);	

		
		// ใส่ kew ใน opday table 
		$query1 ="UPDATE opday SET kew = '$queue_no' WHERE thdatehn = '$thdatehn' AND vn = '".$_SESSION["nVn"]."' "; 
		$result1 = mysql_query($query1);
		
	
		$add="insert into queue_opd set register_date='".date("Y-m-d")."',
												 hn='".$cHn."',
												 vn='".$nVn."',
												 ptname='".$cPtname."',
												 ptright='".$cPtright."',
												 typename='".$typename."',
												 queue_type='".$typecode."',
												 queue_no='".$queue_no."',
												 staff_medical='".$_SESSION["sOfficer"]."',
												 staff_date='".date("Y-m-d H:i:s")."';";		
		mysql_query($add);
		
	}	
//        or die("Query failed runno update");

//echo mysql_errno() . ": " . mysql_error(). "\n";
//echo "<br>";
print "<div align='center'><font size=5><b> ลำดับที่: $queue_no </b></font><br> ";
print "<font size=3><b>$typename</b></font><br> ";
print "<font size=2><b>วันที่ $Thaidate</b></font><br> ";
print "<font size=2>$cPtname</font><br>"; 
print "<font size=2>HN:$cHn.....VN:$nVn</font><br>";
print "<img src='printQrCode.php?hn=$cHn&level=QR_ECLEVEL_M&size=5&margin=1'></div>";

include("unconnect.inc");
/*
    session_unregister("cHn");  
    session_unregister("cPtname");
    session_unregister("cPtright");
    session_unregister("nVn");  
  session_unregister("vkew1");  
*/
//session_destroy();
?>

