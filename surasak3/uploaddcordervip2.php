<?php
session_start();
if(!$_SESSION["send_order"]){
	header('Location: uploaddcordervip.php');
	exit();
}

include("connect.inc");
include("class_file/class_upload.php");

$obj = new class_upload();
$obj->set_limit_type("pdf");
$obj->set_limit_size(1,"mb");

//$count = count($_FILES["upload_file"]);
$list = "";
$j=0;
$k=0;

for($i=0;$i<$_POST["count"];$i++){

	if($_FILES["upload_file".$i]["name"] != ""){
		echo $_FILES["upload_file".$i]["error"];
		$fname = $_POST["an".$i]."-".time();
		$obj->set_file($_FILES["upload_file".$i]);
		$obj->set_path("./dcorder/");
		$result = $obj->upload($fname);
		
		if(!$result){
			$list .= "เอกสาร AN : ".$_POST["an".$i]." มีปัญหา เนื่องจาก ".$obj->txt_error."<BR>";
			$j++;
		}else{
		$k++;
		$datetime = (date("Y")+543).date("-m-d H:i:s");
		
		$sql = "INSERT INTO `file_dcorder` (`row_id` ,`thidate` ,`an` ,`fname` )VALUES (NULL , '".$datetime."', '".$_POST["an".$i]."', '".$obj->fname."');";
		$result = mysql_query($sql);
		}
	}

}

if($j==0){
	$txt= "<BR><BR><CENTER>ส่งเอกสาร doctor order เรียบร้อยแล้ว<BR>ปิดหน้านี้</CENTER>";
}else{
	$txt= "<BR><BR><CENTER><FONT COLOR=\"#FF0000\">เอกสาร มีปัญหา ".$j." รายการ คือ<BR>".$list."</FONT><BR>ปิดหน้านี้</CENTER>";
}


$_SESSION["send_order"] = false;
include("unconnect.inc");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE>โรงพยาบาลค่ายสุรศักดิ์มนตรี</TITLE>
<META NAME="Generator" CONTENT="">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
</HEAD>

<BODY>
<SCRIPT LANGUAGE="JavaScript">
<!--
window.onload = function(){
	opener.location.reload();
}
//-->
</SCRIPT>
<?php
	echo $txt;
?>
</BODY>
</HTML>
