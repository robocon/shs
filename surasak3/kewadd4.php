<?php
session_start();
$thidate = (date("Y")+543).date("-m-d H:i:s"); 
$Thaidate=date("d-m-").(date("Y")+543)." เวลา  ".date("H:i:s");
$time=date("H:i:s");
global $regisdate,$an,$sex,$married,$idcard,
$warcard,$camp,$goup,$dbirth,$race,$national,$religion,$career,$ptright,$address,
$tambol,$ampur,$changwat,$parent,$couple,$guardian;
include("connect.inc");


// @todo
// @readme
// เอา kew3 มา ++ แล้วอัพเดทให้ kew4 for what???
// $query = "SELECT title,prefix,runno FROM runno WHERE title = 'kew3'";
// $result = mysql_query($query) or die("Query failed runno ask");

// for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
//     if (!mysql_data_seek($result, $i)) {
//         echo "Cannot seek to row $i\n";
//         continue;
//     }

//     if(!($row = mysql_fetch_object($result)))
//         continue;
// }

// $vTitle=$row->title;
// $vPrefix=$row->prefix;
// $nRunno=$row->runno;
// $nRunno++;
// $vkew1=$nRunno;
// $vkew12=$vPrefix.$nRunno;
$vkew0='';

// update kew to table runno
// $query ="UPDATE runno SET runno = $nRunno WHERE title='kew4'";
// $result = mysql_query($query) or die("Query failed runno update");

// ใส่ kew ใน opday table 
$query ="UPDATE opday SET kew = '$vkew0' WHERE thdatehn = '$thdatehn' AND vn = '".$_SESSION["nVn"]."' "; 
$result = mysql_query($query);
   
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
print "<center><b>ยกเลิกเรียบร้อยแล้ว</b></center>";

// $cy='A';

// //update kew in opday
// $query ="UPDATE opday SET phaok='$cy' WHERE thdatehn = '$thdatehn'  AND vn = '".$_SESSION["nVn"]."' ";
// $result = mysql_query($query) or die("Query failed,update opday");

// If (!$result){
//     echo "insert into opday fail";
// }

$_SESSION['sTdatehn'] = NULL;