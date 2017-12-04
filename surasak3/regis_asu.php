<?php

	include("connect.inc");
	$rows = 0;

	if(!empty($_GET["dc"])){
		
		$sql = "update druglst set asu='1' where drugcode = '".$_GET["dc"]."' limit 1 ";
		$result = mysql_query($sql);
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=".$_SERVER['PHP_SELF']."\">";
		exit();
	}else if(!empty($_GET["dcasu"])){
		$sql = "update druglst set asu='' where drugcode = '".$_GET["dcasu"]."' limit 1 ";
		$result = mysql_query($sql);
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=".$_SERVER['PHP_SELF']."\">";
		exit();
	}



	if(!empty($_POST["drugcode"])){
		$sql = "select * from druglst where drugcode like '".$_POST["drugcode"]."%'  ";
		$result = mysql_query($sql);
		$rows = mysql_num_rows($result);
	}

		$sqlasu = "select * from druglst where asu='1' Order by drugcode ASC ";
		$resultasu = mysql_query($sqlasu);
		$rowsasu = mysql_num_rows($resultasu);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> ลงทะเบียนยา ASU </TITLE>
<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
<style>
	body, td{
		font-family:  MS Sans Serif;
		font-size: 14 px;
	}
	
	.box{
		border:2px solid;
		border-color: #3366FF;

	}
	
	.box thead{
		background-color: #3366FF;
		color:#FFFFFF;
		text-align: center;
		font-weight: bold;
	}

</style>
</HEAD>

<BODY>

<TABLE>
<TR valign="top">
	<TD>

ลงทะเบียนการใช้ยา ASU | <A HREF="../surasak3/icd10/report_antibiotic.php" target="_blank">รายงานการใช้ยา ASU</A> | <A HREF="../surasak3/icd10/report_antibiotic_m.php" target="_blank">รายงานการใช้ยา ASU ประจำเดือน</A> |<A HREF="../nindex.htm">&lt;&lt; เมนู</A>
<FORM name="form_search" METHOD=POST ACTION="" >
<TABLE   width="400" class="box">
<TR>
	<TD>
<TABLE border="0"    width="100%">
<TR >
<thead>
	<TD colspan="2" align="center">ค้นหายา</TD>
</thead>
</TR>
<TR >
	<TD  width="100" align="right">รหัสยา : </TD>
	<TD ><INPUT TYPE="text" NAME="drugcode" value="<?php echo $_POST["drugcode"];?>"></TD>
</TR>
<TR>
	<TD align="center" colspan="2" ><INPUT TYPE="submit" value="ตกลง" name="submit_search">&nbsp;&nbsp;<INPUT TYPE="reset" value="Clear" Onclick="document.getElementById('box_right').innerHTML=''; "></TD>
</TR>
</TABLE>
</TD>
</TR>
</TABLE>
</FORM>
</TD>
	<TD>
<?php
if($rows > 0){
?>
<div id="box_right">
<TABLE class="box" width="500" style="position: absolute;">
<thead>
<TR>
	<TD>รหัสยา</TD>
	<TD>ชื่อสามัญ</TD>
	<TD>ชื่อการค้า</TD>

</TR>
</thead>
<?php
while($arr = mysql_fetch_assoc($result)){	
?>
<TR>
	<TD><A HREF="regis_asu.php?dc=<?php echo urlencode(trim($arr["drugcode"]));?>"><?php echo $arr["drugcode"];?></A></TD>
	<TD><?php echo $arr["tradname"];?></TD>
	<TD><?php echo $arr["genname"];?></TD>

</TR>
<?php
}	
?>
</TABLE>
</div>

<?php } ?>
</TD>
</TR>
</TABLE>

<?php
if($rowsasu  > 0){
?>
<TABLE class="box" width="500" style="position: absolute;">
<thead>
<TR>
	<TD>รหัสยา</TD>
	<TD>ชื่อสามัญ</TD>
	<TD>ชื่อการค้า</TD>
	<TD>&nbsp;</TD>
</TR>
</thead>
<?php
while($arr = mysql_fetch_assoc($resultasu)){	
?>
<TR>
	<TD><?php echo $arr["drugcode"];?></TD>
	<TD><?php echo $arr["tradname"];?></TD>
	<TD><?php echo $arr["genname"];?></TD>
	<TD align="center"><A HREF="javascript:if(confirm('ท่านต้องการลบรหัสยา ออกจากรายการใช่หรือไม่?')){window.location.href='regis_asu.php?dcasu=<?php echo urlencode(trim($arr["drugcode"]));?>';};" >ลบจากรายการ ASU</A></TD>
</TR>
<?php
}	
?>
</TABLE>
<?php } ?>

<?php
	include("unconnect.inc");
?>
</BODY>
</HTML>
