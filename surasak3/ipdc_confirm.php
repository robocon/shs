<?php
  session_start();
  include("connect.inc");


$sql = 'Select an, ptname, substr(bedcode,3) From ipcard where an = "'.$_SESSION["cAn"].'" limit 0,1 ';
$result = mysql_query($sql);
list($pan, $pptname, $pbedcode) = mysql_fetch_row($result);

echo "
<TABLE align='center' bordercolor='#D20000' border='1'>
<TR>
	<TD>
	<TABLE>
	<TR>
		<TD align='center' bgcolor='#D20000' style='color:#FFFFFF;'>จำหน่ายคนไข้</TD>
	</TR>
	<TR>
		<TD align='center'>
		AN : ".$pan."<BR>
		ชื่อ-นามสกุล : ".$pptname."<BR><BR>
<BR>
		<A HREF=\"confirman.php\">ยืนยันจำหน่วยคนไข้ คลิ๊กที่นี้</A>
<BR><BR>
		* กรณีที่จำหน่ายคนไข้แล้วจะไม่สามารถจำหน่ายคนไข้อีกครั้งได้<BR>

		หากเลือกคนไข้ผิดให้ปิดหน้านี้ทิ้งไป
		</TD>
	</TR>
	</TABLE>
	</TD>
</TR>
</TABLE>";
//<A HREF=\"ipdc.php\">ยืนยันจำหน่วยคนไข้ คลิ๊กที่นี้</A>
include("unconnect.inc");
  ?>