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
session_start();
$thidate = (date("Y")+543).date("-m-d H:i:s"); 
$Thaidate=date("d-m-").(date("Y")+543)." เวลา  ".date("H:i:s");
$time=date("H:i:s");
global $regisdate,$an,$sex,$married,$idcard,
           $warcard,$camp,$goup,$dbirth,$race,$national,$religion,$career,$ptright,$address,
            $tambol,$ampur,$changwat,$parent,$couple,$guardian;
 include("connect.inc");

 $query = "SELECT title,prefix,runno FROM runno WHERE title = 'keweye'";
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
    $query ="UPDATE runno SET runno = $nRunno WHERE title='keweye'";
    $result = mysql_query($query);
//        or die("Query failed runno update");

// ใส่ kew ใน opday table 
    $query ="UPDATE opday SET kew = '$vkew12' WHERE thdatehn = '$thdatehn' AND vn = '".$_SESSION["nVn"]."' "; 
   $result = mysql_query($query);

//echo mysql_errno() . ": " . mysql_error(). "\n";
//echo "<br>";
print "<center><font size=5><b> ลำดับที่:$vkew1 </b><br> ";
print "<center><font size=4><b>คลีนิกพิเศษตา</b><br> ";
print "<center><font size=2><b>วันที่$Thaidate</b><br> ";
print "<center>$cPtname<br>"; 
print "<center>HN:$cHn.....VN:$nVn<br>";
print "<center><b>รอรับบริการที่ห้องตรวจ</b><br>";

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

