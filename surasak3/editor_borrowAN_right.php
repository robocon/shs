<style type="text/css">
<!--
.title {font-family: "MS Sans Serif"; font-size:14px;color: "#FFFFFF";}
.detail {font-family: "MS Sans Serif"; font-size:14px}
-->
</style>
<?php
include("class_file/class_variable.php");
include("class_file/class_borrowAN.php");
$class = new class_borrowAN();
include("connect.inc");

if(isset($_POST["delete"])){
	
	$count = count($_POST["list"]);
	
	for($i=0;$i<$count;$i++)
		$class->delete_borrowAN($_POST["list"][$i]);

echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"3;URL=".$_SERVER['PHP_SELF']."\">";
}

if($_GET["action"] == "an"){
	$class->view_an();
}else if($_GET["action"] == "old"){
	$class->view_borrowANold();
}else{
	$class->view_borrowAN();
}


 include("unconnect.inc");
?>