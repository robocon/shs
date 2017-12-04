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


if(isset($_POST["Submit"]) && $_POST["Submit"] == "แก้ไขข้อมูล"){
	
	$sql = "UPDATE `trauma_ds` SET `thidate` = '".$_POST["date"]." ".$_POST["time"]."',
					`size` = '".$_POST["size"]."',
					`location` = '".$_POST["detail"]."' WHERE `row_id` = '".$_POST["row_id"]."' LIMIT 1 ;
	";

	$result = Mysql_Query($sql);

	if($result){
		echo "<CENTER>แก้ไขข้อมูลเรียบร้อยแล้ว<BR>ปิดหน้านี้</CENTER>";
	}else{
		echo "<CENTER>ไม่สามารถแก้ไขข้อมูลได้<BR>ปิดหน้านี้</CENTER>";
	}

exit();
}

$sql = "Select date_format(thidate,'%Y-%m-%d') as thidate, date_format(thidate, '%H:%i:%s') as thitime, hn, ptname, size, location From trauma_ds where row_id = '".$_GET["rowid"]."' limit 1 ";

list($thidate, $thitime, $hn, $ptname, $size, $location) = Mysql_fetch_row(Mysql_Query($sql));
?>
<FORM METHOD=POST ACTION="">
<table width="450" border="1" cellpadding="2" cellspacing="0" bordercolor="#3366FF">
  <tr>
    <td>
	<table width="100%" border="0" cellpadding="0" cellspacing="2">
  <tr align="center" bgcolor="#3366FF" class="font_title">
    <td colspan="2">แก้ไขข้อมูลยืนยันการทำแผล</td>
  </tr>
  <tr>
    <td width="15%"  align="right" >HN: </td>
    <td width="85%" ><label>
      <?php echo $hn;?>
    </label></td>
  </tr>
  <tr>
    <td width="15%"  align="right" >ชื่อ-สกุล: </td>
    <td width="85%" ><label>
      <?php echo $ptname;?>
    </label></td>
  </tr>
  <tr>
    <td width="15%"  align="right" >วันที่: </td>
    <td width="85%" ><label>
      <input name="date" type="text" id="date" size="12" value="<?php echo $thidate;?>"/>
    </label></td>
  </tr>
  <tr>
    <td width="15%"  align="right">เวลา: </td>
    <td width="85%" ><label>
    <input name="time" type="text" id="time" size="10"  value="<?php echo $thitime;?>" />
    </label></td>
  </tr>
  <tr>
    <td width="15%"  align="right" >ขนาดแผล: </td>
    <td width="85%" ><label>
    <select name="size" id="size">
      <option Value="S" <?php if($size=="S") echo "Selected";?>>S</option>
      <option Value="M" <?php if($size=="M") echo "Selected";?>>M</option>
      <option Value="L" <?php if($size=="L") echo "Selected";?>>L</option>
    </select>
    </label></td>
  </tr>
  <tr>
    <td width="15%"  align="right">บริเวณ: </td>
    <td width="85%" ><label>
    <input name="detail" type="text" id="detail"   value="<?php echo $location;?>"  />
    </label></td>
  </tr>
  <tr align="center">
    <td colspan="2"><label>
      <input type="submit" name="Submit" value="แก้ไขข้อมูล">
    </label></td>
    </tr>
</table>
    <INPUT TYPE="hidden" name="row_id" value="<?php echo $_GET["rowid"];?>">
	</td>
  </tr>
</table>
</FORM>

</body>
</html>
<?php include("unconnect.inc");?>