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


<form method="POST" action="reportssosumphar1.php">

	<TABLE>
	<TR>
		<TD height="57" colspan="2">ใบสรุปรวมลูกหนี้ประกันสังคมตัดยา ปกส. ออก  || <a href="reportssosum.php"> ใบสรุปรวมลูกหนี้ประกันสังคม</a></TD>
      </TR>
	<TR>
		<TD width="57" height="58" align="right">เดือน </TD>
	  <TD width="500"> <SELECT NAME="start_month">
		<?php
		foreach($month as $value => $index){
			echo "<OPTION VALUE=\"",$value,"\" ";
			 if(date("m") == $value) echo " Selected ";
			echo ">",$index;
			
			}	?>
			
		</SELECT> / 
		<INPUT TYPE="text" NAME="start_year" value="<?php echo date("Y")+543;?>"  size="4" maxlength="4"></TD>
	  </TR>
	<TD>&nbsp;&nbsp;</TD>
    <TD><input type="submit" name="submit" value="ดูรายงาน" />
        &nbsp;</TD>
    </TR>
	</TABLE>
</FORM>
<a href='../nindex.htm'>&lt;&lt; ไปเมนู</A>
