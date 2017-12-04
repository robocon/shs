<?php
session_start();
include("class_file/class_variable.php");
include("class_file/class_borrowAN.php");
$class = new class_borrowAN();
include("connect.inc");
if(isset($_POST["form_action"])){



$class->borrowAN_year = $_POST["edit_year"];
$class->borrowAN_id = $_POST["edit_id"];
$class->HN = $_POST["HN"];
$class->AN = $_POST["AN"];
$class->borrower = $_POST["borrower"];
$class->receiver = "Null";
$class->borrowAN_startdate = $_POST["DATE_SERV_YY"]."-".$_POST["DATE_SERV_MM"]."-".$_POST["DATE_SERV_DD"];
$class->borrowAN_enddate = "Null";

switch($_POST["form_action"]){
	
 	case "form_add":
	$stat = $class->add_borrowAN();
	if($stat){
	$title = "ได้ทำาการเพิ่มข้อมูลเรียบร้อยแล้ว";
	}else{
	$title = "<FONT  COLOR=\"#FF0000\">ไม่สามารถยืมเวชระเบียนนี้ได้เนื่องจากยังไม่ได้รับคืน</FONT>";
	}
	break;

	case "form_edit":
		$class->edit_borrowAN();
	$title = "ได้ทำาการแก้ไขข้อมูลเรียบร้อยแล้ว";
	break;

	case "form_receiver":
		$class->receiver = $_POST["receiver"];
		$class->receiver_borrowAN();
	$title = "ได้ทำาการยืมเวชระเบียนผู้ป่วยในเรียบร้อยแล้ว";
	break;


}

echo "
			<SCRIPT LANGUAGE=\"JavaScript\">
				window.onload = function(){
					
					window.parent.right.location.href='editor_borrowAN_right.php';
				}
			</SCRIPT>";

echo "<BR><BR><BR>
<TABLE  cellspacing=\"0\" border=\"1\" bordercolor=\"#3300FF\" align=\"center\">
<TR>
	<TD>
<TABLE bgcolor=\"#FFFFCC\">
	<TR>
		<TD align=\"center\"><BR><FONT style=\"font-family: 'MS Sans Serif'; font-size:16px\"><B>".$title."</B></FONT><BR><BR></TD>
	</TR>
	</TABLE>	
</TD>
</TR>
</TABLE>
";

echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"3;URL=".$_SERVER['PHP_SELF']."\">";
exit();

}

if(isset($_GET["edit"])){
	
$sql = "Select * From borrowan where borrowAN_year = '".$_GET["year"]."' AND borrowAN_id = '".$_GET["id"]."' limit 0,1 ";

$arr = Mysql_fetch_assoc(Mysql_Query($sql));

$class->borrowAN_year = $arr["borrowAN_year"];
$class->borrowAN_id = $arr["borrowAN_id"];
$class->HN = $arr["HN"];
$class->AN = $arr["AN"];
$class->borrower = $arr["borrower"];
$class->receiver = $arr["receiver"];
$class->borrowAN_startdate = $arr["borrowAN_startdate"];
$class->borrowAN_enddate = $arr["borrowAN_enddate"];

$class->form_borrowAN_edit();

}else if(isset($_GET["receiver"])){
	
	$class->borrowAN_year = $_GET["year"];
	$class->borrowAN_id = $_GET["id"];
	$sql = "Select name  From inputm where idname = '".$_SESSION["sIdname"]."' limit 0,1 ";
	$result = Mysql_Query($sql);
	$arr = Mysql_fetch_assoc($result);
	$class->receiver = $arr["name"];
	
	$class->form_borrowAN_receiver();
}else{
	$class->form_borrowAN_add();
}

   include("unconnect.inc");
?>