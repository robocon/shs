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

$query2 = "SELECT * FROM depart WHERE hn = '$cHn' order by row_id desc";
$result2 = mysql_query($query2);
$row2 = mysql_fetch_array($result2);
$nLab2 = $row2['lab'];

$labhn=$row2['hn'];
$labptname=$row2['ptname'];
$labtvn=$row2['tvn'];

$sql=mysql_query("select dbirth from opcard where hn='$cHn'");
list($dbirth)=mysql_fetch_array($sql);
$showage=calcage($dbirth);
/*if(($labno+0)==$nLab2)
	$nLab2=$nLab2;
else{
	$nLab2=($labno+0);
}*/
	
print "<HTML>";

print "<script>";

 print "ie4up=nav4up=false;";

 print "var agt = navigator.userAgent.toLowerCase();";

 print "var major = parseInt(navigator.appVersion);";

 print "if ((agt.indexOf('msie') != -1) && (major >= 4))";

   print "ie4up = true;";

 print "if ((agt.indexOf('mozilla') != -1)  && (agt.indexOf('spoofer') == -1) && (agt.indexOf('compatible') == -1) && ( major>= 4))";

   print "nav4up = true;";

print "</script>";



print "<head>";

print "<STYLE>";

 print "A {text-decoration:none}";

 print "A IMG {border-style:none; border-width:0;}";

 print "DIV {position:absolute; z-index:25;}";

print ".fc1-0 { COLOR:000000;FONT-SIZE:17PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";

print ".fc1-1 { COLOR:000000;FONT-SIZE:16PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";

print ".fc1-2 { COLOR:000000;FONT-SIZE:16PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print ".fc1-3 { COLOR:000000;FONT-SIZE:14PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";
print ".fc1-4 { COLOR:000000;FONT-SIZE:30PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print ".fc1-5 { COLOR:000000;FONT-SIZE:12PT;FONT-FAMILY:Cordia New;}";
print ".fc1-6 { COLOR:000000;FONT-SIZE:12PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";

print ".fc1-7 { COLOR:000000;FONT-SIZE:20PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";

print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";

print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";

print "</STYLE>";



print "<TITLE>Crystal Report Viewer</TITLE>";

print "</head>";

print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";

print "<DIV style='z-index:0'> &nbsp; </div>";
//print "<DIV style='left:0PX;top:0PX;width:200PX;height:30PX;'><span class='fc1-3'><b>&nbsp;&nbsp;โรงพยาบาลค่ายสุรศักดิ์มนตรี </b></span></DIV>";
//print "<DIV style='left:150PX;top:6PX;width:200PX;height:30PX;'><span class='fc1-4'><u>LAB</u></span></DIV>";
print "<DIV style='left:0PX;top:230PX;width:200PX;height:30PX;'><span class='fc1-6'><b>HN:</b>$labhn&nbsp;<b></b>($labtvn)&nbsp;$Thaidate</span></DIV>";
//print "<DIV style='left:0PX;top:25PX;width:200PX;height:30PX;'><span class='fc1-6'>$Thaidate</span></DIV>";
print "<DIV style='left:0PX;top:250PX;width:500PX;height:30PX;'><span class='fc1-0'>$labptname</span></DIV>";
$nLab21=sprintf("%03d",$nLab2);
$labno=substr(date("Y"),2,2).date("md").$nLab21."02";
print "<DIV style='left:0PX;top:270PX;width:500PX;height:30PX;'><span class='fc1-3'>ตรวจสุขภาพทหารปี$nPrefix อายุ $showage</span></DIV>";
print "<DIV style='left:65PX;top:290PX;width:180PX;height:14PX;'><span class='fc1-0'><img src = \"barcode/labstk.php?cLabno=$labno\"></span></DIV>";
print "<DIV style='left:0PX;top:290PX;width:500PX;height:30PX;'><span class='fc1-0'>CHEM</span></DIV>";

//print "<DIV style='left:70PX;top:75PX;width:500PX;height:30PX;'><span class='fc1-1'>$labno</span></DIV>";

$i=0;
$indexx = 0;
$dglist=array();
for ($n=0; $n<=$x; $n++){
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
print "<DIV style='left:10PX;top:300PX;width:500PX;height:30PX;'><span class='fc1-7'>$nLab2$not</span></DIV>";
	}

} ;

$strdclist1 = implode(",",$dglist[0]);

if(isset($dglist[1]) && count($dglist[1])>0)
	$strdclist2 = implode(" ",$dglist[1]);
else
	$strdclist2 = "";

/*print "<DIV style='left:0PX;top:320PX;width:200PX;'><span class='fc1-5'>".$strdclist1."</span></DIV>";
*/
if(trim($strdclist2) !=""){
	$strdclist2 = implode(",",$dglist[1]);
/*	print "<DIV style='left:0PX;top:320PX;width:200PX;'><span class='fc1-5'>".$strdclist2."</span></DIV>";
*/}



print "</BODY></HTML>";



?>


