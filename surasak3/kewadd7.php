<?php
session_start();
$thidate = (date("Y")+543).date("-m-d H:i:s"); 
$Thaidate=date("d-m-").(date("Y")+543)." เวลา  ".date("H:i:s");
$time=date("H:i:s");
global $regisdate,$an,$sex,$married,$idcard,
$warcard,$camp,$goup,$dbirth,$race,$national,$religion,$career,$ptright,$address,
$tambol,$ampur,$changwat,$parent,$couple,$guardian;
include("connect.inc");
		
$query = "SELECT title,prefix,runno FROM runno WHERE title = 'kew7'";
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
$query ="UPDATE runno SET runno = $nRunno WHERE title='kew7'";
$result = mysql_query($query);
//        or die("Query failed runno update");

// ใส่ kew ใน opday table 
$query ="UPDATE opday SET kew = '$vkew12' WHERE thdatehn = '$thdatehn' AND vn = '".$_SESSION["nVn"]."' "; 
$result = mysql_query($query);

?>
<!--<body Onload="window.print();">-->
<body>
<Script Language="JavaScript">
function CloseWindowsInTime(t){
    window.print();
    t = t*1000;
    setTimeout("window.close()",t);
}
CloseWindowsInTime(2/*ใส่เวลาเป็นวินาทีนะครับตรงเลข 5 */); 
</Script>
<?php
print "<center><font style='font-size: 24px;'><b> ลำดับที่:$vkew1 </b><br> ";
print "<font style='font-size: 18px;'><b>คลีนิกตา</b><br> ";
print "<font style='font-size: 13px;'><b>วันที่$Thaidate</b><br> ";
print "$cPtname<br>"; 
print "HN:$cHn.....VN:$nVn<br>";
print "<b>รอรับบัตรที่หน้าห้องทะเบียน</b></center>";

//จัดเก็บข้อมูลในตาราง cliniceye
$today = date("Y-m-d H:i:s");
$subtoday=substr($today,0,10);
$sql="select * from cliniceye where date_time like '$subtoday%' && hn='$cHn' && vn='$nVn'";
$result=mysql_query($sql);
$num=mysql_num_rows($result);
if($num < 1){
    $add="insert into cliniceye set date_time='$today', hn='$cHn', vn='$nVn'";
    $query=mysql_query($add);
}