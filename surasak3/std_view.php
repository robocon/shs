<?php
 include("connect.inc");   
	$month["01"] = "มกราคม";
    $month["02"] = "กุมภาพันธ์";
    $month["03"] = "มีนาคม";
    $month["04"] = "เมษายน";
    $month["05"] = "พฤษภาคม";
    $month["06"] = "มิถุนายน";
    $month["07"] = "กรกฏาคม";
    $month["08"] = "สิงหาคม";
    $month["09"] = "กันยายน";
    $month["10"] = "ตุลาคม";
    $month["11"] = "พฤศจิกายน";
    $month["12"] = "ธันวาคม";


?>

<FORM METHOD=POST ACTION="">
	<TABLE>

	<TR>
		<TD align="right">HN: </TD>
		<TD><INPUT TYPE="text" NAME="hn" value="" ></TD>
	</TR>
	<TR>
		<TD>&nbsp;&nbsp;<INPUT TYPE="submit" name="submit" value="ตกลง"></TD>
	</TR>
	</TABLE>
</FORM>
<a href='../nindex.htm'>&lt;&lt; ไปเมนู</A>


<?
if(isset($_POST["submit"])){

$sql = "SELECT hn,  yot,  name,  surname, date_format( dbirth, '%d/%m/%Y' ) AS dbirth2, idcard , phone, ptright 
				FROM `opcard` 
				WHERE hn = '".$_POST["hn"]."' 
				ORDER BY regisdate ASC   
				";
$result = Mysql_Query($sql);

echo "
<TABLE width='850' border='1' bordercolor='#000000' cellspacing='0' cellpadding='0' >
<TR align=\"center\" bgcolor='#6495ED'>
	<TD>hn</TD>
	<TD>ชื่อ - สกุล</TD>
	<TD>วันเกิด</TD>
	<TD>เลขบัตรประชาชน</TD>
	<TD>สิทธิ์</TD>
	<TD>เบอร์โทรศัพท์</TD>
</TR>
";
while($arr = Mysql_fetch_assoc($result)){

echo "
<TR height=\"30\" bgcolor='#FFEEDD'>
	<TD>&nbsp;",$arr["hn"],"</TD>
	<TD>&nbsp;",$arr["yot"]," ",$arr["name"]," ",$arr["surname"],"</TD>
	<TD align='center'>",$arr["dbirth2"],"</TD>
	<TD align='center'>",$arr["idcard"],"</TD>
	<TD align='center'>",$arr["ptright"],"</TD>
	<TD>&nbsp;",$arr["phone"],"</TD>
	
</TR>
";

}

echo "
</TABLE>
";

}

include("unconnect.inc");

?>