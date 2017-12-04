<?php
set_time_limit(30);
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
ผู้ป่วยที่ไม่มี บัตรประชาชน

<TABLE width="100%">
<TR>
	<TD width="50%">
	<FORM METHOD=POST ACTION="">
	<TABLE>
	<TR>
		<TD colspan="2">ค้นหาจากวันที่ผู้ป่วยทำ OPD Card</TD>
	</TR>
	<TR>
		<TD align="right">ตั้งแต่วันที่: </TD>
		<TD><INPUT TYPE="text" NAME="start_day" value="<?php echo date("d");?>" size="2" maxlength="2"> / 
		<SELECT NAME="start_month">
		<?php
		foreach($month as $value => $index){
			echo "<OPTION VALUE=\"",$value,"\" ";
			 if(date("m") == $value) echo " Selected ";
			echo ">",$index;
			
			}	?>
			
		</SELECT> / 
		<INPUT TYPE="text" NAME="start_year" value="<?php echo date("Y")+543;?>"  size="4" maxlength="4"></TD><TD>&nbsp;</TD>
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
	</TD>
	<TD width="50%">
	<FORM METHOD=POST ACTION="">
	<TABLE>
	<TR>
		<TD colspan="2">ค้นหาจากวันที่ผู้ป่วยมารักษา <BR>
		<FONT COLOR="#FF0000">*กรุณาค้นหาที่ละ7วันเป็นอย่างมาก</FONT>
		</TD>
	</TR>
	<TR>
		<TD align="right">ตั้งแต่วันที่: </TD>
		<TD><INPUT TYPE="text" NAME="start_day" value="<?php echo date("d");?>" size="2" maxlength="2"> / 
		<SELECT NAME="start_month">
		<?php
		foreach($month as $value => $index){
			echo "<OPTION VALUE=\"",$value,"\" ";
			 if(date("m") == $value) echo " Selected ";
			echo ">",$index;
			
			}	?>
			
		</SELECT> / 
		<INPUT TYPE="text" NAME="start_year" value="<?php echo date("Y")+543;?>"  size="4" maxlength="4"></TD><TD>&nbsp;</TD>
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
		<INPUT TYPE="text" NAME="end_year" value="<?php echo date("Y")+543;?>"  size="4" maxlength="4"></TD><TD>&nbsp;&nbsp;<INPUT TYPE="submit" name="submit2" value="ตกลง"></TD>
	</TR>
	</TABLE>
</FORM>
	</TD>
</TR>
</TABLE>
<a href='../nindex.htm'>&lt;&lt; ไปเมนู</A>


<?
if(isset($_POST["submit"])){

$sql = "SELECT regisdate, hn, name, surname , yot, address, tambol, ampur, changwat, date_format( dbirth, '%d-%m-%Y' ) AS dbirth2
				FROM `opcard` 
				WHERE ( regisdate between '".($_POST["start_year"]-543)."-".$_POST["start_month"]."-".$_POST["start_day"]." 00:00:00' AND '".($_POST["end_year"]-543)."-".$_POST["end_month"]."-".$_POST["end_day"]." 23:59:00' ) AND (idcard = '' OR idcard = '-')
				ORDER BY regisdate ASC   
				";
$result = Mysql_Query($sql);

echo "
<TABLE width='750' border='1' bordercolor='#000000' cellspacing='0' cellpadding='0' >
<TR align=\"center\">
	<TD>วันที่สมัคร</TD>
	<TD>hn</TD>
	<TD>ชื่อ - สกุล</TD>
	<TD>ที่อยู่</TD>
	<TD>วันเกิด</TD>
</TR>
";
while($arr = Mysql_fetch_assoc($result)){

echo "
<TR height=\"30\">
	<TD>",$arr["regisdate"],"</TD>
	<TD><a target=_BLANK  href=\"opdedit.php? cHn=".$arr["hn"]." & cName=".$arr["name"]." &cSurname=".$arr["surname"]."\">",$arr["hn"],"</A></TD>
	<TD>",$arr["yot"]," ",$arr["name"]," ",$arr["surname"],"</TD>
	<TD>",$arr["address"]," ต.",$arr["tambol"]," อ.",$arr["ampur"]," จ.",$arr["changwat"],"</TD>
	<TD>",$arr["dbirth2"],"</TD>
</TR>
";

}

echo "
</TABLE>
";

}else if(isset($_POST["submit2"])){

$s_date = $_POST["start_day"]."/".$_POST["start_month"]."/".$_POST["start_year"];
$e_date = $_POST["end_day"]."/".$_POST["end_month"]."/".$_POST["end_year"];

$sql = " Select distinct hn From opday as a where a.thidate between '".($_POST["start_year"])."-".$_POST["start_month"]."-".$_POST["start_day"]." 00:00:00' AND '".($_POST["end_year"])."-".$_POST["end_month"]."-".$_POST["end_day"]." 23:59:00' ";
$result = mysql_query($sql) or die("Error opday_2");

	
	
	
	echo "<table>";
	echo "<tr align='center'>";
			echo "<td colspan='6' align='center'>รายชื่อผู้ป่วยที่ไม่มีเลข13หลัก มารักษาวันที่ ".$s_date." - ".$e_date." </td>";
		echo "</tr>";
	echo "<tr align='center'>";
			echo "<td>hn</td>";
			echo "<td>คำนำหน้า</td>";
			echo "<td>ชื่อ</td>";
			echo "<td>สกุล</td>";
			echo "<td>วันที่ทำประวัติ</td>";
			echo "<td>วันเกิด</td>";
		echo "</tr>";
	$result = mysql_query($sql) or die(mysql_error());
	while($arr2 = mysql_fetch_assoc($result)){

		$sql = "Select a.hn, a.yot, a.name, a.surname , date_format(a.regisdate,'%d-%m-%Y') as regisdate2, a.idcard, date_format(a.dbirth,'%d-%m-%Y') as dbirth2  From opcard as a where a.hn = '".$arr2["hn"]."' AND (idcard = '' OR idcard = '-' OR idcard is null) limit 0,1";
		$result2 = mysql_query($sql) or die(mysql_error());
		if(mysql_num_rows($result2) > 0){
		$arr = mysql_fetch_assoc($result2);

		echo "<tr>";
			echo "<td><a target=_BLANK  href=\"opdedit.php? cHn=".$arr["hn"]." & cName=".$arr["name"]." &cSurname=".$arr["surname"]."\" target=\"_blank\">".$arr["hn"]."</A></td>";
			echo "<td>".$arr["yot"]."</td>";
			echo "<td>".$arr["name"]."</td>";
			echo "<td>".$arr["surname"]."</td>";
			echo "<td>".$arr["regisdate2"]."</td>";
			echo "<td align='center'>".$arr["dbirth2"]."</td>";
		echo "</tr>";
		}
	}
	echo "</table>";

}

include("unconnect.inc");

?>