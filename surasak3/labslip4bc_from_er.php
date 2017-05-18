<?php
/**
 * ไฟล์ต้นฉบับ labslip4bc.php
 */

session_start();
$Thaidate = date("d-m-").(date("Y")+543)."  ".date("H:i:s");
$Thaidate1 = substr(date("Y"),2,2).date("md");

include("connect.inc");

// $query = "SELECT * FROM runno WHERE title = 'lab'";
// $result = mysql_query($query) or die("Query failed");

// for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
// 	if (!mysql_data_seek($result, $i)) {
// 		echo "Cannot seek to row $i\n";
// 		continue;
// 	}
// 	if(!($row = mysql_fetch_object($result)))
// 		continue;
// }

// ดักค่า 
$cHn = $_GET['cHn'];
$sDate = $_GET['sDate'];

$query2 = "SELECT * FROM `depart` WHERE `hn` = '$cHn' AND `date` = '$sDate' ORDER BY row_id desc";
$result2 = mysql_query($query2);
$row2 = mysql_fetch_array($result2);
// var_dump($row2);
// exit;
$nLab2 = $row2['lab'];

$labhn = $row2['hn'];
$labptname = $row2['ptname'];
$labtvn = $row2['tvn'];

?>
<html>
<head>
	<script type="text/javascript">
	function CloseWindowsInTime(t){
		t = t*1000;
		setTimeout(function(){
			// window.close()
		},t);
	}
	/*ใส่เวลาเป็นวินาทีนะครับตรงเลข 5 */
	CloseWindowsInTime(2); 
	
	window.onload=function(){
		// window.print();
	};
	
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
		div {position:absolute; z-index:25;}
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
	<title>Print sticker lab from ER</title>
</head>
<body BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>
<div style='z-index:0'> &nbsp; </div>
<!-- แสดง HN -->
<div style='left:0PX;top:0PX;width:200PX;height:30PX;'><span class='fc1-6'><b>HN:</b><?=$labhn;?>&nbsp;<b></b>(<?=$labtvn;?>)&nbsp;<?=$row2['date']?></span></div>
<!-- แสดงชื่อผู้ป่วย -->
<div style='left:0PX;top:15PX;width:500PX;height:30PX;'><span class='fc1-0'><?=$labptname;?></span></div>
<?php
// สร้าง Lab number
$nLab21 = sprintf("%03d",$nLab2);
// $labno = substr(date("Y"),2,2).date("md").$nLab21;
list($date_item, $time_item) = explode(' ', $row2['date']);
list($sub_year, $sub_month, $sub_day) = explode('-', $date_item);
$labno = substr(($sub_year-543),2,2).$sub_month.$sub_day.$nLab21."02";
?>
<div style="left:65PX;top:55PX;width:180PX;height:14PX;">
	<span class="fc1-0"><img src = "barcode/labstk.php?cLabno=<?=$labno;?>"></span>
</div>

<!-- แสดง -->
<div style='left:10PX;top:70PX;width:500PX;height:30PX;'><span class='fc1-7'><?=$nLab2;?></span></div>
<?php
$sql = "SELECT `code` FROM `patdata` WHERE `hn` = '$cHn' AND `date` = '$sDate'";
$q = mysql_query($sql);
$code_lists = array();
while ($item = mysql_fetch_assoc($q)) {
	$code_lists[] = $item['code'];
}
$code_line = implode(',',$code_lists);
?>
<!-- แสดง Labcode -->
<div style='left:0PX;top:36PX;width:200PX;'><span class='fc1-5'>รหัส <?=$code_line;?></span></div>
</body>
</html>