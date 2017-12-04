<?php
session_start();
include("connect.inc");

	function jschars($str)
{
    $str = str_replace("\\\\", "\\\\", $str);
    $str = str_replace("\"", "\\\"", $str);
    $str = str_replace("'", "\\'", $str);
    $str = str_replace("\r\n", "\\n", $str);
    $str = str_replace("\r", "\\n", $str);
    $str = str_replace("\n", "\\n", $str);
    $str = str_replace("\t", "\\t", $str);
    $str = str_replace("<", "\\x3C", $str); // for inclusion in HTML
    $str = str_replace(">", "\\x3E", $str);
    return $str;
}

?>
<html>
<head>
<title>แก้ไขข้อมูล</title>
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
</head>
<body>
<?php

if(isset($_GET["action"]) && $_GET["action"] == "muti"){
	
	$count = count($_POST["row_id"]);
	
	$num = 0;
	for($i=0;$i<$count;$i++){
		if($_POST["billno"][$i] != $_POST["billno2"][$i]){
		$sql = "Update opacc set billno = '".$_POST["billno"][$i]."' where row_id = '".$_POST["row_id"][$i]."' limit 1 ";
		//echo "<!-- ",$sql," -->";
		$result = Mysql_Query($sql);
		if($result)
			$num++;
		}
	}

	if($num > 0){
		echo "แก้ไขข้อมูลเรียบร้อยแล้วจำนวนทั้งหมด ".$num." รายการ<BR>";
		echo "ให้ทำการปิดหน้านี้ แล้ว refresh หน้าเดิม";
	}else{
		echo "ไม่มีรายการที่ท่านได้แก้ไข";
	}

exit();
}
echo "fesfes";
exit();
if(isset($_POST["Submit"]) && $_POST["Submit"] == "แก้ไขข้อมูล"){
	
	$sql = "Update opacc set ".$_POST["name_field"]." = '".jschars($_POST["detail"])."' where row_id = '".$_POST["row_id"]."' limit 1 ";
	$result = Mysql_Query($sql);

	if($result){
		echo "แก้ไขข้อมูลเรียบร้อยแล้ว";
	}else{
		echo "ไม่สามารถแก้ไขข้อมูลได้";
	}

exit();
}

$sql = "Select ".$_GET["fn"]." From opacc where row_id = '".$_GET["row_id"]."' limit 1 ";

list($detail_testarea) = Mysql_fetch_row(Mysql_Query($sql));
?>
<FORM METHOD=POST ACTION="">
<table width="450" border="1" cellpadding="2" cellspacing="0" bordercolor="#3366FF">
  <tr>
    <td>
	<table width="100%" border="0" cellpadding="0" cellspacing="2">
  <tr align="center" bgcolor="#3366FF" class="font_title">
    <td colspan="2">แก้ไขข้อมูล</td>
    </tr>
  <tr>
    <td  align="right" valign="top"><?php echo $_GET["title_name"];?> : </td>
    <td ><label>

	<INPUT TYPE="text" NAME="detail" value="<?php echo $detail_testarea;?>">

    </label></td>
  </tr>
  <tr align="center">
    <td colspan="2"><label>
      <input type="submit" name="Submit" value="แก้ไขข้อมูล">
    </label></td>
    </tr>
</table>
<INPUT TYPE="hidden" name="name_field" value="<?php echo $_GET["fn"];?>">
<INPUT TYPE="hidden" name="row_id" value="<?php echo $_GET["row_id"];?>">
	</td>
  </tr>
</table>
</FORM>

</body>
</html>
<?php include("unconnect.inc");?>