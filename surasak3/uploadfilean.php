<?php
session_start();

include("connect.inc");
include("class_file/class_upload.php");

$obj = new class_upload();
$obj->set_limit_type("pdf");
$obj->set_limit_size(1,"mb");

//$count = count($_FILES["upload_file"]);
$list = "";
$j=0;
$k=0;



	if($_FILES["upload_file"]["name"] != ""){

		$fname = "dc-".$_POST["an"]."-".time();
		$obj->set_file($_FILES["upload_file"]);
		$obj->set_path("./dcorder/");
		$result = $obj->upload($fname);
		
		if(!$result){
			$list .= "เอกสาร AN : ".$_POST["an"]." มีปัญหา เนื่องจาก ".$obj->txt_error."<BR>";
			$j++;
		}else{
		$k++;
		
		$sql = "update ipcard set `fname` = '".$obj->fname."' where an = '".$_POST["an"]."' limit 1 ";
		$result = mysql_query($sql);
		}
	}



if($j==0 && $k > 0){
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

<?php
	echo $txt;
?>
<META HTTP-EQUIV="Refresh" CONTENT="3;URL=anchk.php">
<INPUT TYPE="button" value="&lt;&lt; Back" Onclick="window.location.href='anchk.php';">
</BODY>
</HTML>
