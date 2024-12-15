<body Onload="window.print();">

	<Script Language="JavaScript">
		function CloseWindowsInTime(t) {
			t = t * 1000;
			setTimeout("window.close()", t);
		}
		CloseWindowsInTime(2/*ใส่เวลาเป็นวินาทีนะครับตรงเลข 5 */); 
	</Script>
	<?php
	session_start();
	$Thaidate = date("d-m-") . (date("Y") + 543) . "  " . date("H:i:s");
	$Thaidate1 = substr(date("Y"), 2, 2) . date("md");

	include("connect.inc");
	$query = "SELECT * FROM runno WHERE title = 'lab'";
	$result = mysql_query($query) or die("Query failed");

	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}
		if (!($row = mysql_fetch_object($result)))
			continue;
	}
	
	if($_GET['hn']){
		$cHn = sprintf("%s", $_GET['hn']);
	}
	
	$query2 = "SELECT * FROM depart WHERE hn = '$cHn' order by row_id desc limit 1";
	$result2 = mysql_query($query2);
	$row2 = mysql_fetch_array($result2);
	$nLab2 = $row2['lab'];
	/*if(($labno+0)==$nLab2)
		$nLab2=$nLab2;
	else{
		$nLab2=($labno+0);
	}*/

	$thdatehn = date('d-m-').(date('Y')+543).$cHn;
	$dateTh = (date('Y')+543).date('-m-d');

	$info = '';
	
	// ถ้ามีข้อมูลใน ER
	$sql = "SELECT `row_id` FROM `trauma` WHERE `date` LIKE '$dateTh%' AND `hn` = '$cHn' LIMIT 1 ";
	$q = mysql_query($sql);
	if(mysql_num_rows($q) > 0){
		$info = 'แผนกฉุกเฉิน';
	}

	$sql = "SELECT SUBSTRING(`bedcode`,1,2) AS `bedcode` FROM `bed` WHERE `hn` = '$cHn' LIMIT 1 ";
	$q = mysql_query($sql);
	if(mysql_num_rows($q)>0){
		$a = mysql_fetch_assoc($q);

		if($a['bedcode']=='42'){
			$info = "หอผู้ป่วยรวม";

		}elseif($a['bedcode']=='43'){
			$info = "หอผู้ป่วยสูติ";

		}elseif($a['bedcode']=='44'){
			$info = "หอผู้ป่วยICU";

		}elseif($a['bedcode']=='45'){
			$info = "หอผู้ป่วยพิเศษ";	

		}

		// เช็กว่าเป็นWardพิเศษรึป่าว
		$wardExTest = preg_match('/^(45)+/', $a['bedcode']);
		if( $wardExTest > 0 ){
			//
			// เช็กว่าเป็นชั้น3 ถ้าไม่ใช่เป็นชั้น2
			$wardBxTest = preg_match('/45(F[1-3]|M[1-6])/', $a['bedcode']); // B1-B9
			$wardR3Test = preg_match('/45R3[0-9]{2}/', $a['bedcode']); // R301-R310
			$exName = ($wardBxTest > 0 || $wardR3Test > 0) ? 'ชั้น3' : 'ชั้น2' ;

			$info .= $exName;
			
		}


	}

	$sql = sprintf("SELECT TIMESTAMPDIFF(YEAR,CONCAT((SUBSTRING(`dbirth`,1,4)-543),SUBSTRING(`dbirth`,5,6)), NOW()) AS age FROM `opcard` WHERE `hn` = '%s' LIMIT 1", $hn);
	$q = mysql_query($sql);
	$rowAge = mysql_num_rows($q);
	$age = '';
	if($rowAge>0){
		$a = mysql_fetch_assoc($q);
		$age = $a['age'];
	}
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
	print "<DIV style='left:0PX;top:0PX;width:200PX;height:30PX;'><span class='fc1-3'><b>&nbsp;&nbsp;โรงพยาบาลค่ายสุรศักดิ์มนตรี </b></span></DIV>";
	//print "<DIV style='left:150PX;top:6PX;width:200PX;height:30PX;'><span class='fc1-4'><u>LAB</u></span></DIV>";
	print "<DIV style='left:0PX;top:15PX;width:200PX;height:30PX;'><span class='fc1-6'><b>HN:</b>$cHn&nbsp;<b></b>($tvn)&nbsp;$Thaidate</span></DIV>";
	//print "<DIV style='left:0PX;top:25PX;width:200PX;height:30PX;'><span class='fc1-6'>$Thaidate</span></DIV>";
	print "<DIV style='left:0PX;top:30PX;width:500PX;height:30PX;'><span class='fc1-3'>$cPtname</span></DIV>";
	print "<DIV style='left:0PX;top:47PX;width:500PX;height:30PX;'><span class='fc1-5'>$cPtright".(!empty($age) ? ' อายุ:'.$age.'ปี' : '' )."</span></DIV>";
	$nLab21 = sprintf("%03d", $nLab2);
	$labno = substr(date("Y"), 2, 2) . date("md") . $nLab21 . "02";
	//print "<DIV style='left:65PX;top:55PX;width:200PX;height:10PX;'><span class='fc1-0'><img src = \"barcode/labstk.php?cLabno=$labno\"></span></DIV>";
	print "<DIV style='left:70PX;top:75PX;width:500PX;height:30PX;'><span class='fc1-1'>$labno</span></DIV>";
	print "<DIV style='left:5PX;top:75PX;width:500PX;height:30PX;'><span class='fc1-1'><b>OUTLAB</b></span></DIV>";
	//print "<DIV style='left:10PX;top:70PX;width:500PX;height:30PX;'><span class='fc1-7'>$nLab2</span></DIV>";
	if(!empty($info)){
		print '<div style="left: 4px;top: 97px;width: auto;height: auto;line-height: 10px; font-size:14px;">'.$info.'</div>';
	}
	

	$i = 0;
	$indexx = 0;
	$dglist = array();
	for ($n = 1; $n <= $x; $n++) {
		if (!empty($aDgcode[$n])) {
			$sql1 = "select codelab from labcare where code='" . $aDgcode[$n] . "' and labtype ='OUT' ";
			$rows1 = mysql_query($sql1);
			list($codelab) = mysql_fetch_array($rows1);
			$numlab = mysql_num_rows($rows1);
			if ($numlab > 0) {
				if ($codelab != "") {
					$dglist[$indexx][$i] = $codelab;
				} elseif ($codelab == "") {
					$dglist[$indexx][$i] = $aDgcode[$n];
				}
			} else {
				//$dglist[$indexx][$i] = $aDgcode[$n];
			}
			//$dglist[$indexx][$i] = $aDgcode[$n];
			$i++;
			if ($i == 8)
				$indexx = 1;
		}
	}

	$strdclist1 = implode(",", $dglist[0]);

	if (isset($dglist[1]) && count($dglist[1]) > 0)
		$strdclist2 = implode(" ", $dglist[1]);
	else
		$strdclist2 = "";

	print "<DIV style='left:0PX;top:60PX;width:200PX;'><span class='fc1-5'>" . $strdclist1 . "</span></DIV>";

	if (trim($strdclist2) != "") {
		$strdclist2 = implode(",", $dglist[1]);
		print "<DIV style='left:0PX;top:55PX;width:200PX;'><span class='fc1-5'>" . $strdclist2 . "</span></DIV>";
	}
	print "</BODY></HTML>";

	?>