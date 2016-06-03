<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
	<title>พิมพ์ใบจองเตียง</title>
	<style type="text/css">
	/* CSS Rest */
	/* http://meyerweb.com/eric/tools/css/reset/
	v2.0 | 20110126
	License: none (public domain)
	*/

	html, body, div, span, applet, object, iframe,
	h1, h2, h3, h4, h5, h6, p, blockquote, pre,
	a, abbr, acronym, address, big, cite, code,
	del, dfn, em, img, ins, kbd, q, s, samp,
	small, strike, strong, sub, sup, tt, var,
	b, u, i, center,
	dl, dt, dd, ol, ul, li,
	fieldset, form, label, legend,
	table, caption, tbody, tfoot, thead, tr, th, td,
	article, aside, canvas, details, embed,
	figure, figcaption, footer, header, hgroup,
	menu, nav, output, ruby, section, summary,
	time, mark, audio, video {
		margin: 0;
		padding: 0;
		border: 0;
		font-size: 100%;
		font: inherit;
		vertical-align: baseline;
	}
	/* HTML5 display-role reset for older browsers */
	article, aside, details, figcaption, figure,
	footer, header, hgroup, menu, nav, section {
		display: block;
	}
	body {
		line-height: 1;
	}
	ol, ul {
		list-style: none;
	}
	blockquote, q {
		quotes: none;
	}
	blockquote:before, blockquote:after,
	q:before, q:after {
		content: '';
		content: none;
	}
	table {
		border-collapse: collapse;
		border-spacing: 0;
	}
	/*TH SarabunPSK*/
	/* Your Style */
	
	
	@font-face{
		font-family: "THSarabunNew";
		src: url("fonts/webfont/THSarabunNew.eot");
		src: url("fonts/webfont/THSarabunNew.eot#iefix"),
		url("fonts/webfont/THSarabunNew.woff") format('embedded-opentype'),
		url("fonts/webfont/THSarabunNew.ttf") format('truetype'),
		url("fonts/webfont/THSarabunNew.svg#ludger_duvernayregular") format('svg');
		font-weight: normal;
		font-style: normal;
	}
	
	
	body{
		/*font-family: 'THSarabunNew';*/
		font-family: "THSarabunNew";
		/*TH SarabunPSK*/
	}
	b{
		font-weight: bold;
	}
	
	
	
	.fc1-0 { color: #000000; font-size: 30px; font-weight: normal;}
	.fc1-1 { color: #000000; font-size: 23px; font-weight: normal;}
	.fc1-3 { color: #000000; font-size: 17px; font-weight: normal;}
	div {position:absolute; z-index:25;}
	</style>
</head>

<body>
<?php

function calcage($birth){

	$today = getdate();   
	$nY = $today['year']; 
	$nM = $today['mon'] ;
	$bY = substr($birth,0,4)-543;
	$bM = substr($birth,5,2);
	$ageY = $nY-$bY;
	$ageM = $nM-$bM;

	if ($ageM<0) {
		$ageY = $ageY-1;
		$ageM = 12+$ageM;
	}

	if ($ageM == 0){
		$pAge = "$ageY ปี";
	}else{
		$pAge = "$ageY ปี $ageM เดือน";
	}

	return $pAge;
}

include("../includes/connect.php"); 

$row_id = trim($_GET['row_id']);
$sql = "SELECT * FROM  booking  WHERE  row_id ='".$row_id."' ";
$query = mysql_query($sql); 
$dbarr = mysql_fetch_array($query);
$age = calcage($dbarr['bdate']);
	
///1
print "<div style='left:80px;top:15px;width:500px;height:30px;'><span class='fc1-3'>กอง/แผนก/ส่วน ศูนย์ผู้ป่วยใน  เอกสารหมายเลข FR-IPC-001/3  แก้ไขครั้งที่ 00  วันที่มีผลบังคับใช้ 28 ก.พ.44</span></div>";
print "<div style='left:300px;top:30px;width:500px;height:30px;'><span class='fc1-0'>ใบจองเตียง</span></div>";	

//2
print "<div style='left:190px;top:60px;width:800px;height:30px;'><span class='fc1-1'>โรงพยาบาลค่ายสุรศักดิ์มนตรี อ.เมือง จ.ลำปาง</span></div>";	


//3
print "<div style='left:80px;top:85px;width:500px;height:30px;'><span class='fc1-1'>ชื่อ-สกุล</span></div>";	
print "<div style='left:150px;top:85px;width:500px;height:30px;'><span class='fc1-1'>$dbarr[ptname]</span></div>";	
print "<div style='left:330px;top:85px;width:500px;height:30px;'><span class='fc1-1'>อายุ</span></div>";	
print "<div style='left:400px;top:85px;width:500px;height:30px;'><span class='fc1-1'>$age</span></div>";

/////2
print "<div style='left:80px;top:110px;width:500px;height:30px;'><span class='fc1-1'>HN</span></div>";	
print "<div style='left:150px;top:110px;width:500px;height:30px;'><span class='fc1-1'>$dbarr[hn]</span></div>";	
print "<div style='left:330px;top:110px;width:500px;height:30px;'><span class='fc1-1'>รับป่วยเมื่อ</span></div>";	
print "<div style='left:430px;top:110px;width:500px;height:30px;'><span class='fc1-1'>$dbarr[date_in]</span></div>";
	
//3
print "<div style='left:80px;top:135px;width:500px;height:30px;'><span class='fc1-1'>DX</span></div>";	
print "<div style='left:150px;top:135px;width:500px;height:30px;'><span class='fc1-1'>$dbarr[diag]</span></div>";	
print "<div style='left:330px;top:135px;width:500px;height:30px;'><span class='fc1-1'>แพทย์</span></div>";	
print "<div style='left:400px;top:135px;width:500px;height:30px;'><span class='fc1-1'>$dbarr[doctor]</span></div>";	


//4
print "<div style='left:80px;top:160px;width:500px;height:30px;'><span class='fc1-1'>หอผู้ป่วย</span></div>";
print "<div style='left:150px;top:160px;width:500px;height:30px;'><span class='fc1-1'>$dbarr[ward]</span></div>";
print "<div style='left:330px;top:160px;width:500px;height:30px;'><span class='fc1-1'>เตียง/ห้อง</span></div>";
print "<div style='left:400px;top:160px;width:500px;height:30px;'><span class='fc1-1'>$dbarr[bed]</span></div>";


//5
print "<div style='left:80px;top:185px;width:500px;height:30px;'><span class='fc1-1'>สิทธิการรักษา $dbarr[ptright]</span></div>";

//5
print "<div style='left:80px;top:210px;width:500px;height:30px;'><span class='fc1-1'>ผู้จอง.........................</span></div>";	
print "<div style='left:250px;top:210px;width:500px;height:30px;'><span class='fc1-1'>ผู้รับจอง.....................</span></div>";	

print "<div style='left:400px;top:210px;width:500px;height:30px;'><span class='fc1-1'>วันที่จอง</span></div>";
print "<div style='left:470px;top:210px;width:500px;height:30px;'><span class='fc1-1'>$dbarr[date_regis]</span></div>";

//6
print "<div style='left:80px;top:235px;width:500px;height:30px;'><span class='fc1-3'><b>คำแนะนำเมื่อมีการจองเตียงเพื่อรับนอนโรงพยาบาล</b></span></div>";	

//7
print "<div style='left:80px;top:255px;width:500px;height:30px;'><span class='fc1-3'>1.ให้มาติดต่อแผนกทะเบียนตามวัน-เวลาที่ระบุในใบนัดเพื่อทำเอกสารการรับป่วย</span></div>";	

//8
print "<div style='left:80px;top:275px;width:500px;height:30px;'><span class='fc1-3'>2.ให้นำบัตรประจำตัวประชาชนของผู้ป่วยมาด้วยในวันที่จะเข้านอนโรงพยาบาล</span></div>";

//9
print "<div style='left:80px;top:295px;width:800px;height:30px;'><span class='fc1-3'><b>3.กรณีจองห้องพิเศษไว้ โรงพยาบาลจะสำรวจเตียงก่อนวันนอน 1 วัน  หากห้องพิเศษไม่ว่างจะต้องนอนห้องรวมก่อน</b></span></div>";

//10
print "<div style='left:90px;top:315px;width:800px;height:30px;'><span class='fc1-3'><b>จนกว่าห้องพิเศษจะว่างจึงจะย้ายเข้าแทนได้ และต้องมีคนนอนเฝ้าตลอด 24 ชม.</b></span></div>";
//11
print "<div style='left:80px;top:335px;width:500px;height:30px;'><span class='fc1-3'>4.สอบถามข้อมูลการจองเตียงล่วงหน้าได้ 1 วัน ก่อนการมานอนโรงพยาบาล</span></div>";

//12
print "<div style='left:90px;top:355px;width:500px;height:30px;'><span class='fc1-3'><b>ที่เบอร์โทร <u>054-839305 ต่อ 1120-1121</u></b></span></div>";

//13
print "<div style='left:80px;top:375px;width:500px;height:30px;'><span class='fc1-3'>5.หากท่านไม่มาตามนัด <b>เกินเวลา 14.00 น.</b> ทางโรงพยาบาลขอสงวนสิทธิ์ยกเลิกการจองเตียง/ห้อง</span></div>";

//14
print "<div style='left:90px;top:395px;width:500px;height:30px;'><span class='fc1-3'>เพื่อบริหารเตียงสำหรับผู้ป่วยรายอื่นต่อไป</span></div>";

//15
print "<div style='left:80px;top:415px;width:500px;height:30px;'><span class='fc1-3'>.................................. ผู้ทบทวน</span></div>";
//16
print "<div style='left:230px;top:415px;width:500px;height:30px;'><span class='fc1-3'>.................................. ผู้ป่วย/ญาติ</span></div>";
//17
print "<div style='left:400px;top:415px;width:500px;height:30px;'><span class='fc1-3'>......../........../.........</span></div>";
?>

</body>
</html>