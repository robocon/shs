<?php
include("connect.inc");
?><head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<style type="text/css">


a:link {color:#FF0000; text-decoration:underline;}
a:visited {color:#FF0000; text-decoration:underline;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}

body,td,th {
	font-family:  'Angsana New';
	font-size: 24 px;
}

.font_title{
	font-family:  'Angsana New';
	font-size: 24 px;
	color:#FFFFFF;
	font-weight: bold;

}
</style>
</head>
<body>

<B>ใบสั่งตรวจ X-Ray จากแพทย์<BR>โรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง</B>
<TABLE >
<TR>
	<TD>
VN: <?php echo $_GET["vn"];?>&nbsp;&nbsp;&nbsp;HN : <?php echo $_GET["hn"];?>&nbsp;&nbsp;&nbsp;ชื่อ-สกุล : <B><?php echo $_GET["name"];?></B><BR>
แพทย์ : <?php echo $_GET["doctor"];?><BR>
<B>รายละเอียด : </B><BR>
	<?php echo nl2br($_GET["detail_all"]);?>
	<FONT SIZE='7' COLOR='#FF0000'><B>XRAYNO : </B>
	<?php  echo nl2br($_GET["xrayno"]);?></FONT>
</TD>
</TR>
</TABLE>

</body>
</html>
<?php include("unconnect.inc");?>