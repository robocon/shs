<?php
	
	include("connect.inc");
    echo "&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";

if(empty($_POST["B1"])){
		$today = date("d-m-Y"); 
		$d=substr($today,0,2);
		$m=substr($today,3,2);
		$yr=substr($today,6,4) +543; 

	}else{
		 $today="$d-$m-$yr";
		 $d=substr($today,0,2);
		 $m=substr($today,3,2);
		$yr=substr($today,6,4); 
	}
$today="$yr-$m-$d";
?>

<FORM METHOD=POST ACTION="">
	<TABLE>
<TR>
	<TD colspan="2">
	วันที่&nbsp;&nbsp;<input type='text' name='d' size='4' value=<?php echo $_POST["d"];?> >&nbsp;&nbsp;
	เดือน&nbsp; <input type='text' name='m' size='4' value=<?php echo $_POST["m"];?>>&nbsp;&nbsp;&nbsp;
	พ.ศ. <input type='text' name='yr' size='8' value=<?php echo $_POST["yr"];?>>
	
	</TD>
</TR>
<TR>
	<TD>กรอกหมายเลข AN : </TD>
	<TD><input type='text' name='an' size='4' value='<?php echo $_GET["an"]?>'></TD>
</TR>
<TR>
	<TD colspan="2"><input type='submit' value='ตกลง' name='B1'>&nbsp;&nbsp;<input type='reset' value='ลบทิ้ง' name='B2'></TD>
</TR>
</TABLE>
</FORM>


<TABLE width="99%" cellspacing="0" cellpadding="0">
<TR align="center">
	<TD>วันที่</TD>
	<TD>AN</TD>
	<TD>ชื่อ - สกุล</TD>

</TR>
<?php
$sql = "Select distinct date, an From ipacc where date LIKE '$today%' AND an = '".$_POST["an"]."'  and depart='SURG' Order by date DESC ";

$result = Mysql_Query($sql);
if(Mysql_num_rows($result) > 0 && isset($_POST["an"]) && $today != "--")
while($arr = Mysql_fetch_assoc($result)){

$sql2 = "Select ptname From ipcard where an = '".$arr["an"]."' ";
$result2 = Mysql_Query($sql2);
$arr2 = Mysql_fetch_assoc($result2);
$ptname = $arr2["ptname"];
Mysql_free_result($result2);

$xx = explode(" ",$arr["date"]);
	$date = explode("-",$xx[0]);
	$time = explode(":",$xx[1]);
		$dd = $date[2];
		$mm = $date[1];
		$yy = $date[0];

		$mi = $time[0];
		$se = $time[1];



echo "
<TR bgcolor=\"#FFFF99\">
	<TD align=\"center\">".$dd."/".$mm."/".$yy." ".$mi.":".$se."</TD>
	<TD align=\"center\">",$arr["an"],"</TD>
	<TD>&nbsp;&nbsp;",$ptname,"</TD>
	<TD rowspan=\"2\"></TD>

</TR>
<TR>
	<TD colspan=\"3\"  bgcolor=\"#FFFF99\">";
	
	echo "<TABLE  bgcolor=\"#33CCFF\" >";

	$sql2 = "Select row_id, code, detail, startdatetime, enddatetime From ipacc where an = '".$arr["an"]."' AND date = '".$arr["date"]."' ";

	$result2 = Mysql_query($sql2);
	$j=0;
	while($arr2 = Mysql_fetch_assoc($result2)){
		
if($arr2["startdatetime"] == Null){
		
  $in_surg = "";
}else{
$xx = explode(" ",$arr2["startdatetime"]);
	$date = explode("-",$xx[0]);
	$time = explode(":",$xx[1]);
		$sdd = $date[2];
		$smm = $date[1];
		$syy = $date[0]+543;

		$smi = $time[0];
		$sse = $time[1];
	$in_surg	= "เข้า : <B><FONT  COLOR=\"red\">".$sdd."/".$smm."/".$syy." ".$smi.":".$sse."</FONT></B>";
}

if($arr2["enddatetime"]  == Null){
		$edd = "";
		$emm = "";
		$eyy = "";

		$emi = "";
		$ese = "";
		$out_surg = "";
}else{
		$xx = explode(" ",$arr2["enddatetime"]);
		$date = explode("-",$xx[0]);
		$time = explode(":",$xx[1]);
		$edd = $date[2];
		$emm = $date[1];
		$eyy = $date[0]+543;

		$emi = $time[0];
		$ese = $time[1];
		$out_surg = "ออก : <B><FONT  COLOR=\"red\">".$edd."/".$emm."/".$eyy." ".$emi.":".$ese."</FONT></B>";
}

			echo "
			<TR>
				<TD>",$arr2["code"],"</TD>
				<TD>",$arr2["detail"],"</TD>
				<TD><A HREF=\"labaddtime.php?row_id=".$arr2["row_id"]."\" target=\"_blank\">บันทึกเวลาเข้าออกห้องผ่าตัด</A></TD>
				<TD align=\"center\">".$in_surg."</TD>
				<TD align=\"center\">".$out_surg."</TD>
			</TR>
			";
		$list[$j] = $arr2["row_id"];
		$j++;
	}
	$rowsid = implode("_",$list);
	echo "</TABLE>";
	
	echo "

	</TD>
</TR>
<TR  bgcolor=\"#FFFF99\">
	<TD colspan=\"5\" height=\"3\"></TD><TD>&nbsp;</TD>
</TR>
<TR>
	<TD colspan=\"6\">&nbsp;</TD>
</TR>
";
unset($rowsid);
 }?>
</TABLE>

<?php include("unconnect.inc");?>
</table>





