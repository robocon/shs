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


<form method="POST" action="reportcashsum1.php">

	<TABLE>
	<TR>
		<TD colspan="2">ใบสรุปรวมลูกหนี้เงินสดประจำเดิอน</TD>
	</TR>
	<TR>
		<TD align="right">เดือน </TD>
		<TD> <SELECT NAME="start_month">
		<?php
		foreach($month as $value => $index){
			echo "<OPTION VALUE=\"",$value,"\" ";
			 if(date("m") == $value) echo " Selected ";
			echo ">",$index;
			
			}	?>
			
		</SELECT> / 
		<INPUT TYPE="text" NAME="start_year" value="<?php echo date("Y")+543;?>"  size="4" maxlength="4"></TD><TD>&nbsp;</TD>
	</TR>
	<TD>&nbsp;&nbsp;<INPUT TYPE="submit" name="submit" value="ตกลง"></TD>
	</TR>
	
	</TABLE>
</FORM>
<a href='../nindex.htm'>&lt;&lt; ไปเมนู</A>
