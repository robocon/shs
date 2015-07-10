<?php 
session_start();

if(!isset($web_title)){
	$web_title = 'Clinic diabetes';
}
?>
<html><!-- InstanceBegin template="/Templates/all_menu.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
    <!-- InstanceBeginEditable name="doctitle" -->
    <title><?php echo $web_title;?></title>
    <!-- InstanceEndEditable -->
    <link type="text/css" href="menu.css" rel="stylesheet" />
	<link type="text/css" href="epoch_styles.css" rel="stylesheet" />
	<script type="text/javascript" src="epoch_classes.js"></script>
	
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="menu.js"></script> 
    <!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->
</head>
<style type="text/css">
* { 
	margin:0;
    padding:0;
}
.font1 { 
	font-family:"TH SarabunPSK";
	font-size:20pt;
}
.table_font1 { 
	font-family:"TH SarabunPSK";
	font-size:18pt;
	font-weight:bold;
	color:#600;	
}
.table_font2 { 
	font-family:"TH SarabunPSK";
	font-size:18pt;
}
legend { 
	font-family:"TH SarabunPSK";
	font-size: 18pt;
	font-weight: bold;
	color:#600;	
	padding:0px 3px;
}
fieldset { 
	display:inline;
	background-color:#FEFDDE;
	border-color:#000;
}

/* DIV FOR TABLE */
div#menu { 
	margin:5px auto;
}
div#copyright {
    font:11px 'Trebuchet MS';
    color:#fff;
    text-indent:30px;
    padding:40px 0 0 0;
}
td,th {
	font-family:"TH SarabunPSK";
	font-size: 20 px;
}
.fontsara {
	font-family:"TH SarabunPSK";
	font-size: 18 px;
}
@media print { 
	#no_print{ display:none; }
}

label{
	cursor: pointer;
}
</style>
<body>
<div id="no_print">
<div id="menu">
	<ul class="menu">
		<li><a href="http://192.168.1.2/sm3/nindex.htm" class="parent"><span>โปรแกรมโรงพยาบาล</span></a></li>
		<li>
			<a href="#"><span>ลงทะเบียน</span></a>
			<ul>
				<li class="last"><a href="diabetes.php"><span>ลงทะเบียน DM</span></a></li>
				<li class="last"><a href="hypertension.php"><span>ลงทะเบียน HT</span></a></li>
			</ul>
		</li>
		<li>
			<a href="diabetes_edit.php"><span>แก้ไขข้อมูล</span></a>
			<ul>
				<li class="last"><a href="diabetes_edit.php"><span>แก้ไขข้อมูล DM</span></a></li>
				<li class="last"><a href="hypertension_edit.php"><span>แก้ไขข้อมูล HT</span></a></li>
			</ul>
		</li>
		<li>
			<a href="#"><span>รายชื่อผู้ป่วย DM</span></a>
			<ul>
				<li class="last"><a href="diabetes_list.php"><span>รายชื่อทั้งหมด</span></a></li>
				<li class="last"><a href="diabetes_list_so.php"><span>รายชื่อ ทหาร/ครอบครัว</span></a></li>
			</ul>
		</li>
		<li>
			<a href="#"><span>รายชื่อผู้ป่วย HT</span></a>
			<ul>
				<li class="last"><a href="hypertension_list.php"><span>รายชื่อทั้งหมด</span></a></li>
				<li class="last"><a href="hypertension_list_so.php"><span>รายชื่อ ทหาร/ครอบครัว</span></a></li>
			</ul>
		</li>
		<li>
			<a href="report_diabetes.php"><span>สถิติ</span></a>
			<ul>
				<li class="last"><a href="report_diabetes.php"><span>สถิติ DM</span></a></li>
				<li class="last"><a href="report_hypertension.php"><span>สถิติ HT</span></a></li>
			</ul>
		</li>
		<li>
			<a href="#"><span>รายงาน</span></a>
			<ul>
				<li class="last"><a href="report_diabetesofyear.php"><span>รายงาน DM</span></a></li>
				<li class="last"><a href="report_hypertensionofyear.php"><span>รายงาน HT</span></a></li>
			</ul> 
		</li>
		<li><a href="history.php"><span>ค้นหาประวัติ</span></a></li>
	</ul>
</div>
<div style="visibility: hidden"><a href="http://apycom.com/">a</a></div>
</div>
<div><!-- InstanceBeginEditable name="detail" -->
