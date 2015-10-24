<?php
session_start();
$thidate = (date("Y")+543).date("-m-d H:i:s"); 
$Thaidate=date("d-m-").(date("Y")+543)." เวลา  ".date("H:i:s");
$Thaidate1=date("d-m-").(date("Y")+543);
$time=date("H:i:s");
global $regisdate,$an,$sex,$married,$idcard,
           $warcard,$camp,$goup,$dbirth,$race,$national,$religion,$career,$ptright,$address,
            $tambol,$ampur,$changwat,$parent,$couple,$guardian;
 include("connect.inc");

 $query = "SELECT title,prefix,runno FROM runno WHERE title = 'vn'";
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
	$vkew12=$nRunno;

$thdatevn=$Thaidate1.$vkew12;


// update kew to table runno
    $query ="UPDATE runno SET runno = $nRunno WHERE title='vn'";
    $result = mysql_query($query);
//        or die("Query failed runno update");

// ใส่ kew ใน opday table 

    $query ="UPDATE opday SET vn = '$vkew12', thdatevn = '$thdatevn' WHERE thdatehn = '$thdatehn' AND vn = '".$_SESSION["nVn"]."' "; 
   $result = mysql_query($query);


//echo mysql_errno() . ": " . mysql_error(). "\n";
//echo "<br>";
print "<center><font size=5><b> แก้ไขข้อมูล VN เรียบร้อยแล้ว </b><br> ";
print "<center><font size=5><b>เป็น VN  $vkew12 </b><br> ";
print "<center><font size=5><b>วันที่$Thaidate</b><br> ";
print "<center><font size=5>$cPtname<br>"; 
print "<center><font size=5>HN:$cHn<br>";
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

