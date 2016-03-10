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
<form method="POST" action="reportlgosum1.php" target="_blank">

	<TABLE>
	<TR>
		<TD colspan="2"><a href="reportcscddsum.php">ใบสรุปรวมลูกหนี้จ่ายตรง</a> || ใบสรุปรวมลูกหนี้จ่ายตรง อปท.</TD>
	</TR>
	<TR>
		<TD width="161" align="right">ตั้งแต่วันที่: </TD>
	  <TD width="212"><INPUT TYPE="text" NAME="start_day" value="<?php echo date("d");?>" size="2" maxlength="2"> / 
		<SELECT NAME="start_month">
		<?php
		foreach($month as $value => $index){
			echo "<OPTION VALUE=\"",$value,"\" ";
			 if(date("m") == $value) echo " Selected ";
			echo ">",$index;
			
			}	?>
			
		</SELECT> / 
		<INPUT TYPE="text" NAME="start_year" value="<?php echo date("Y")+543;?>"  size="4" maxlength="4"></TD><TD width="62">&nbsp;</TD>
	</TR>
	<TR>
		<TD align="right">ถึงวันที่: </TD>
		<TD><INPUT TYPE="text" NAME="end_day" value="<?php echo date("d");?>" size="2" maxlength="2"> / 
		<SELECT NAME="end_month">
		<?php
		foreach($month as $value => $index){
			echo "<OPTION VALUE=\"",$value,"\" ";
			 if(date("m") == $value) echo " Selected ";
			echo ">",$index;
			
			}	?>
			
		</SELECT> / 
		<INPUT TYPE="text" NAME="end_year" value="<?php echo date("Y")+543;?>"  size="4" maxlength="4"></TD><TD>&nbsp;&nbsp;<INPUT TYPE="submit" name="submit" value="ตกลง"></TD>
	</TR>
	</TABLE>
</FORM>


<a href='../nindex.htm'>&lt;&lt; ไปเมนู</A>
