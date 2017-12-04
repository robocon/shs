<?php
session_start();

include("connect.inc");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE>โรงพยาบาลค่ายสุรศักดิ์มนตรี</TITLE>
<META NAME="Generator" CONTENT="">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
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
</HEAD>

<BODY>
<?php
	
	if(isset($_POST["list"]) && count($_POST["list"]) > 0){
		
		$sql = "Update file_dcorder set drugok = '1' where row_id in (".implode(",",$_POST["list"]).") ;";
		mysql_query($sql);
		
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=".$_SERVER['PHP_SELF']."?an=".urlencode($_GET["an"])."\">";
		exit();
	}

?>
<FORM name="f1" METHOD=POST ACTION="" >
<TABLE   width="600" border="1" bordercolor="#3366FF">
<TR>
	<TD>
<TABLE border="0"  width="100%">
<TR  bgcolor="#3366FF" class="font_title">
	<TD align="center" >วันที่-เวลา</TD>
	<TD align="center" >AN</TD>
	<TD align="center" >View</TD>
	<TD align="center" >จ่ายยา</TD>
</TR>
<?php
	$date = (date("Y")+543).date("-m-d");
	$sql = "Select row_id, an, fname, drugok, date_format(thidate,'%d/%m/%Y %H:%i:%s') as thidate2 From file_dcorder where an='".$_GET["an"]."' Order by thidate DESC limit 30 ";

	$result = mysql_query($sql);
	$i=0;
	while($arr = mysql_fetch_assoc($result)){

		if($arr["drugok"]=="0")
			$i++;

		echo "<TR>";
		echo "<TD align=\"center\" >",$arr["thidate2"],"</TD>";
		echo "<TD align=\"center\" >",$arr["an"],"</TD>";
		echo "<TD align=\"center\" ><A HREF=\"",$arr["fname"],"\" target=\"_blank\">view</A></TD>";
		echo "<TD align=\"center\" >".($arr["drugok"]=="1"?"<FONT COLOR=\"red\">จ่ายยาแล้ว":"<INPUT TYPE=\"checkbox\" NAME=\"list[]\" value=\"".$arr["row_id"]."\"><FONT COLOR=\"#000066\"><B> : ยืนยันการจ่ายยา</B>")."</FONT></TD>";
		echo "</TR>";
	}
	
	if($i>0){
		echo "<TR>";
		echo "<TD align=\"right\" colspan=\"3\">&nbsp;</TD>";
		echo "<TD align=\"center\" colspan=\"1\"><INPUT TYPE=\"submit\" value=\"ยืนยัน\"></TD>";
		echo "</TR>";
	}
?>

</TABLE>
</TD>
</TR>
</TABLE>
<INPUT TYPE="hidden" value="confirm" value="<?php echo $i;?>">
</FORM>
</BODY>
</HTML>
<?php
include("unconnect.inc");
?>
