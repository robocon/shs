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
	font-family:  MS Sans Serif;
	font-size: 14 px;
}

.font_title{
	font-family:  MS Sans Serif;
	font-size: 14 px;
	color:#FFFFFF;
	font-weight: bold;

}
</style>
</head>
<body>

<TABLE>
<TABLE width="350" border="1" bordercolor="#3366FF">
<TR>
	<TD>
<TABLE border="3" bordercolor="#FFFFFF" style='BORDER-COLLAPSE: collapse' width="100%" >
<TR  bgcolor="#3366FF" class="font_title">
	<TD align="center" >No.</TD>
	<TD align="center" >เวลา</TD>
	<TD align="center" >ชื่อ - สกุล</TD>
	<TD align="center" >แพทย์ผู้สั่ง</TD>
</TR>
<?php
	$i=1;
	$Thidate = (date("Y")+543).date("-m-d");
	$sql = "Select distinct xrayno, date_format(date,'%H:%i') as time2, hn, vn, yot, name, sname, doctor, xrayno, detail_all, orderby From xray_doctor where date like '".$Thidate."%' AND ( orderby = 'DR' OR orderby = 'ER')";
	$result = mysql_query($sql);
	while($arr = mysql_fetch_assoc($result)){

		if($i % 2 == 0){
			$bgcolor="#FFFFFF";
		}else{
			$bgcolor="#BFFFBF";
		}
		
		echo "<TR bgcolor=\"",$bgcolor,"\">";
			echo "<TD align=\"center\" >",$i,"</TD>";
			echo "<TD align=\"center\" >",$arr["time2"],"</TD>";
			echo "<TD align=\"center\" ><A HREF=\"xraydoctordetail.php?xrayno=",$arr["xrayno"],"&xraydetail=",urlencode($arr["detail_all"]),"\">",$arr["name"]," ",$arr["sname"],"</A></TD>";
			echo "<TD align=\"center\" ><A HREF=\"xraydoctor_print.php?vn=",urlencode($arr["vn"]),"&hn=",urlencode($arr["hn"]),"&name=",urlencode($arr["yot"]." ".$arr["name"]." ".$arr["sname"]),"&detail_all=",urlencode($arr["detail_all"]),"&doctor=",urlencode($arr["doctor"]),"&xrayno=",urlencode($arr["xrayno"]),"\" target=\"_blank\">",$arr["doctor"],"</A>",($arr["orderby"]=="ER"?"<BR><BR>(จากห้องฉุกเฉิน)":""),"</TD>";
		echo "</TR>";
		echo "<TR bgcolor=\"",$bgcolor,"\">";
			echo "<TD colspan=\"1\" >&nbsp;</TD>";
			echo "<TD colspan=\"3\" >",nl2br($arr["detail_all"]),"</TD>";
		echo "</TR>";
		echo "<TR bgcolor=\"#FFFF06\">";
			echo "<TD colspan=\"4\" height=\"5\"></TD>";
		echo "</TR>";
		$i++;

	}
?>
</TABLE>

</body>
</html>
<?php include("unconnect.inc");?>