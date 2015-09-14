<?php
/**
 * ไฟล์ต้นฉบับ labslip4bc_from_er.php
 */

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

// ดักค่า 
$cHn = $_GET['cHn'];
$sDate = $_GET['sDate'];

$query2 = "SELECT * FROM depart WHERE hn = '$cHn' order by row_id desc";
$result2 = mysql_query($query2);
$row2 = mysql_fetch_array($result2);
$nLab2 = $row2['lab'];

$labhn=$row2['hn'];
$labptname=$row2['ptname'];
$labtvn=$row2['tvn'];

?>
<HTML>
<head>
	<script type="text/javascript">
	function CloseWindowsInTime(t){
		t = t*1000;
		setTimeout(function(){
			window.close()
		},t);
	}
	/*ใส่เวลาเป็นวินาทีนะครับตรงเลข 5 */
	CloseWindowsInTime(2); 
	
	ie4up = nav4up = false;
	var agt = navigator.userAgent.toLowerCase();
	var major = parseInt(navigator.appVersion);
	if ((agt.indexOf('msie') != -1) && (major >= 4))
		ie4up = true;
	if ((agt.indexOf('mozilla') != -1)  && (agt.indexOf('spoofer') == -1) && (agt.indexOf('compatible') == -1) && ( major>= 4))
		nav4up = true;
	</script>
	<style>
		A {text-decoration:none}
		A IMG {border-style:none; border-width:0;}
		DIV {position:absolute; z-index:25;}
		.fc1-0 { COLOR:000000;FONT-SIZE:17PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}
		.fc1-1 { COLOR:000000;FONT-SIZE:16PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}
		.fc1-2 { COLOR:000000;FONT-SIZE:16PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}
		.fc1-3 { COLOR:000000;FONT-SIZE:14PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}
		.fc1-4 { COLOR:000000;FONT-SIZE:30PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}
		.fc1-5 { COLOR:000000;FONT-SIZE:12PT;FONT-FAMILY:Cordia New;}
		.fc1-6 { COLOR:000000;FONT-SIZE:12PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}
		.fc1-7 { COLOR:000000;FONT-SIZE:20PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}
		.ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}
		.ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}
	</style>
	
	<TITLE>Print sticker lab from ER</TITLE>
</head>

<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0' Onload="window.print();">
<DIV style='z-index:0'> &nbsp; </div>
<DIV style='left:0PX;top:0PX;width:200PX;height:30PX;'><span class='fc1-6'><b>HN:</b><?=$labhn;?>&nbsp;<b></b>(<?=$labtvn;?>)&nbsp;<?=$Thaidate?></span></DIV>
<DIV style='left:0PX;top:15PX;width:500PX;height:30PX;'><span class='fc1-0'><?=$labptname;?></span></DIV>
<?php
$nLab21=sprintf("%03d",$n);
$labno=substr(date("Y"),2,2).date("md").$nLab21."02";
print "<DIV style='left:65PX;top:55PX;width:180PX;height:14PX;'><span class='fc1-0'><img src = \"barcode/labstk.php?cLabno=$labno\"></span></DIV>";

?>
<DIV style='left:10PX;top:70PX;width:500PX;height:30PX;'><span class='fc1-7'><?=$nLab2;?></span></DIV>
<?php
$sql = "SELECT `code` FROM `patdata` WHERE `hn` = '$cHn' AND `date` = '$sDate'";
$q = mysql_query($sql);
$code_lists = array();
while ($item = mysql_fetch_assoc($q)) {
	$code_lists[] = $item['code'];
}
$code_line = implode(', ',$code_lists);
?>
<DIV style='left:0PX;top:36PX;width:200PX;'><span class='fc1-5'>รหัส <?=$code_line;?></span></DIV>
</BODY>
</HTML>