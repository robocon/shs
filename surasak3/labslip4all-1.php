<body Onload="window.print();">

<Script Language="JavaScript">
function CloseWindowsInTime(t){
t = t*1000;
setTimeout("window.close()",t);
}
CloseWindowsInTime(2/*ใส่เวลาเป็นวินาทีนะครับตรงเลข 5 */); 
</Script>
<?php
    session_start();
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
	  $Thaidate1=substr(date("Y"),2,2).date("md");

   include("connect.inc");
$query = "SELECT * FROM runno WHERE title = 'lab'";
$result = mysql_query($query) or die("Query failed");

for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	if (!mysql_data_seek($result, $i)) {
		echo "Cannot seek to row $i\n";
		continue;
	}
		if(!($row = mysql_fetch_object($result)))
		continue;
}

//  	    $cTitle=$row->title;  //=VN
/*$nLab2=$row->runno;
$nLab2--;*/

$query2 = "SELECT * FROM depart WHERE hn = '$cHn' order by row_id desc limit 1";
$result2 = mysql_query($query2);
$row2 = mysql_fetch_array($result2);
$nLab2 = $row2['lab'];

$labhn=$row2['hn'];
$labptname=$row2['ptname'];
$labptright=substr($row2['ptright'],0,3);
if($labptright=="R03"){
	$ptright="(R03)";
}
$labtvn=$row2['tvn'];

print "<DIV style='left:0PX;top:0PX;width:500PX;height:30PX;'><span class='fc1-6'><b>HN:</b>$labhn&nbsp;<b></b>($labtvn)&nbsp;$Thaidate</span></DIV>";
//print "<DIV style='left:0PX;top:25PX;width:200PX;height:30PX;'><span class='fc1-6'>$Thaidate</span></DIV>";
print "<DIV style='left:0PX;top:15PX;width:500PX;height:30PX;'><span class='fc1-0'>$labptname $ptright</span></DIV>";
$nLab21=sprintf("%03d",$nLab2);
$labno=substr(date("Y"),2,2).date("md").$nLab21."01";
print "<DIV style='left:48PX;top:55PX;width:200PX;height:10PX;'><span class='fc1-0'><img src = \"barcode/labstk.php?cLabno=$labno\"><font size='+3' style='margin-left:3px;'>1</font></span></DIV>";
//print "<DIV style='left:70PX;top:75PX;width:500PX;height:30PX;'><span class='fc1-1'>$labno</span></DIV>";

$i=0;
$indexx = 0;
$dglist=array();
$x=$x+1;
for ($n=1; $n<=$x; $n++){
	If (!empty($aDgcode[$n])){
		$sql1 = "select codelab from labcare where code='".$aDgcode[$n]."' ";
		$rows1 = mysql_query($sql1);
		list($codelab) = mysql_fetch_array($rows1);
		if($codelab!=""){
			$dglist[$indexx][$i] = $codelab;
		}else{
			$dglist[$indexx][$i] = $aDgcode[$n];
		}
		//$dglist[$indexx][$i] = $aDgcode[$n];
		$i++;
		if($i==8)
			$indexx=1;

		if($aDgcode[$n]=="E"){$not="*";}
print "<DIV style='left:10PX;top:70PX;width:500PX;height:30PX;'><span class='fc1-7'>$nLab2$not</span></DIV>";
	}

} 

$strdclist1 = implode(",",$dglist[0]);

if(isset($dglist[1]) && count($dglist[1])>0)
	$strdclist2 = implode(" ",$dglist[1]);
else
	$strdclist2 = "";

print "<DIV style='left:0PX;top:35PX;width:200PX;'><span class='fc1-5'>".$strdclist1."</span></DIV>";

if(trim($strdclist2) !=""){
	$strdclist2 = implode(",",$dglist[1]);
	print "<DIV style='left:0PX;top:50PX;width:200PX;'><span class='fc1-5'>".$strdclist2."</span></DIV>";
}
?>
<div style="page-break-after: always"></div>
