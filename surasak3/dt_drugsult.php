<?php
session_start();
include("connect.inc");

$sql = "Select idname From inputm where name = '".$_SESSION["dt_doctor"]."' limit 1 ";
list($sld) = mysql_fetch_row(mysql_query($sql));

if(isset($_POST["mysql"]) && $_POST["mysql"] == "Add"){

 
$sql = "INSERT INTO `dr_drugsuit` (  `date_formula` , `name_formula` , `code_dr` ) VALUES ( '".date("Y-m-d H:i:s")."', '".$_POST["name_formula"]."', '".$sld."');";
;
$result = Mysql_Query($sql);
$idno=mysql_insert_id();

echo "<META HTTP-EQUIV=\"Refresh\"  CONTENT=\"0;URL=dt_drugsult_detail.php?for_id=".$idno."\">";
exit();
}else if(isset($_POST["mysql"]) && $_POST["mysql"] == "Edit"){

$sql = "UPDATE `dr_drugsuit` SET `name_formula` = '".$_POST["name_formula"]."' WHERE `row_id` = '".$_POST["edit_row_id"]."' AND   `code_dr` = '".$sld."' LIMIT 1 ;
";
$result = Mysql_Query($sql);


echo "<META HTTP-EQUIV=\"Refresh\"  CONTENT=\"0;URL=dt_drugsult_detail.php?for_id=".$_POST["edit_row_id"]."\">";
exit();
}else if(isset($_GET["action"]) && $_GET["action"] == "del"){

$sql = "Delete From `dr_drugsuit` where `row_id` = '".$_GET["row_id"]."' AND   `code_dr` = '".$sld."'";
$result = Mysql_Query($sql);

$sql = "Delete From `dr_drugsuit_detail` where `for_id` = '".$_GET["row_id"]."' ";
$result = Mysql_Query($sql);

echo "<META HTTP-EQUIV=\"Refresh\"  CONTENT=\"0;URL=dt_drugsult.php\">";
exit();
}



?>
<html>
<head>
<style type="text/css">
<!--
body,td,th {
	font-family: Angsana New;
	font-size: 24px;
}

.tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_detail {background-color: #FFFFC1;  }
.tb_menu {background-color: #FFFFC1;  }
-->
</style>

</head>
<body>
<?php include("dt_menu.php");?>
<BR>
<TABLE align="center" width="80%">
<TR class="tb_head">
	<TD width="30">No.</TD>
	<TD>ชื่อสูตร</TD>
	<TD width="30">แก้ไข</TD>
	<TD width="30">ลบ</TD>
</TR>
<?php
$sql = "Select row_id, name_formula From dr_drugsuit where code_dr = '".$sld."' ORDER BY row_id ASC ";
$result = Mysql_Query($sql);

$i=1;
while(list($row_id,$name_formula) = Mysql_fetch_row($result)){
	if($i%2 == 0)
		$class = "";
	else
		$class = "class='tb_detail'";

echo "<TR ".$class." >";
	echo "<TD  width='30'>".$i.".</TD>";
	echo "<TD><A HREF=\"dt_drugsult_detail.php?for_id=".$row_id."\">".$name_formula."</A></TD>";
	echo "<TD  width='30' align='center'><A HREF=\"dt_drugsult.php?action=edit&row_id=".$row_id."\">แก้ไข</A></TD>";
	echo "<TD  width='30' align='center'><A HREF=\"dt_drugsult.php?action=del&row_id=".$row_id."\">ลบ</A></TD>";
echo "</TR>";
$i++;
}	
?>
</TABLE>

<BR>

<?php

if(isset($_GET["action"]) && $_GET["action"] =="edit"){

	$sql = "Select row_id, name_formula From dr_drugsuit where  code_dr = '".$sld."' AND row_id = '".$_GET["row_id"]."' limit 1";
	$result = Mysql_Query($sql);
	list($row_id,$name_formalu) = Mysql_fetch_row($result);

	$hidden = "<INPUT TYPE=\"hidden\" name=\"edit_row_id\" value=\"".$row_id."\"><INPUT TYPE=\"hidden\" name=\"mysql\" value=\"Edit\">";
	$button="แก้ไข";


}else{
	$hidden = "<INPUT TYPE=\"hidden\" name=\"mysql\" value=\"Add\">";
	$button="เพิ่ม";
}

?>
<FORM METHOD=POST ACTION="">
<TABLE border="1" bordercolor="#0046D7" align="center" >
<TR>
	<TD>
<TABLE cellpadding="0" cellspacing="0">
<TR>
	<TD colspan="2" class="tb_head"><?php echo $button;?>สูตรยา</TD>
</TR>
<TR class="tb_detail">
	<TD>&nbsp;&nbsp;ชื่อสูตรยา : </TD>
	<TD><INPUT TYPE="text" NAME="name_formula"value="<?php echo $name_formalu;?>">&nbsp;&nbsp;</TD>
</TR>
<TR class="tb_detail">
	<TD colspan="2" align="center"><INPUT TYPE="submit" name="submit" value="<?php echo $button;?>">&nbsp;&nbsp;<INPUT TYPE="reset" value="ยกเลิก"></TD>
</TR>
</TABLE>
</TD>
</TR>
</TABLE>
<?php echo $hidden;?>
</FORM>

</body>
<?php include("unconnect.inc");?>
</html>