<?php
//************************* AJAX ******************************************************/
session_start();
if(isset($_GET["action"]) && ($_GET["action"] == "view_hn" || $_GET["action"] == "view_an" ) ){
	header("content-type: application/x-javascript; charset=TIS-620");
}

include("connect.inc");

if(isset($_GET["action"]) && $_GET["action"] == "view_hn"){

$sql = "Select yot, name, surname From opcard where hn = '".$_GET["hn"]."' limit 1";

$result  = Mysql_Query($sql);
list($yot, $name, $sname) = Mysql_fetch_row($result);

$sql = "Select vn From opday where hn = '".$_GET["hn"]."' Order by row_id DESC limit 1";
$result  = Mysql_Query($sql);
list($vn) = Mysql_fetch_row($result);


$sql = "Select an From ipcard where hn = '".$_GET["hn"]."' Order by row_id DESC limit 1";
$result  = Mysql_Query($sql);
list($an) = Mysql_fetch_row($result);

echo $yot,"][", $name,"][", $sname,"][", $an,"][", $vn;
exit();
}

if(isset($_GET["action"]) && $_GET["action"] == "view_an"){

$sql = "Select hn From ipcard where an = '".$_GET["an"]."' Order by row_id DESC limit 1";
$result  = Mysql_Query($sql);
list($hn) = Mysql_fetch_row($result);

$sql = "Select vn From opday where hn = '".$hn."' Order by row_id DESC limit 1";
$result  = Mysql_Query($sql);
list($vn) = Mysql_fetch_row($result);

$sql = "Select yot, name, surname From opcard where hn = '".$hn."' limit 1";

$result  = Mysql_Query($sql);
list($yot, $name, $sname) = Mysql_fetch_row($result);
echo $yot,"][", $name,"][", $sname,"][", $hn,"][", $vn;
exit();
}

// END AJAX *******************************************************************************/


//******************************* ADD EDIT DEL ******************************************/
//******************************* ADD ******************************************/
if(isset($_REQUEST["action"]) && $_REQUEST["action"] == "add"){

$_POST["time_in"] = substr($_POST["time_in"],0,-2).":".substr($_POST["time_in"],-2);
$_POST["time_out"] = substr($_POST["time_out"],0,-2).":".substr($_POST["time_out"],-2);
$_POST["time_knife"] = substr($_POST["time_knife"],0,-2).":".substr($_POST["time_knife"],-2);

$sql = "INSERT INTO `memo_sur` (`date_time` ,`thaidate` ,`hn` ,`an` ,`vn` ,`ptname` ,`timein` ,`timeout` ,`urgency` ,`diag` ,`opertion` ,`ward` ,`room` ,`type_wounded` ,`type_scar` ,`ptright` ,`doctor` ,`surgery`,`type_case`,`timeknife`,`asa` )VALUES ( '".(date("Y")+543).date("-m-d H:i:s")."', '".$_POST["year"]."-".$_POST["month"]."-".$_POST["date"]."', '".$_POST["hn"]."', '".$_POST["an"]."', '".$_POST["vn"]."', '".$_POST["yot"]." ".$_POST["name"]." ".$_POST["lastname"]."', '".$_POST["time_in"]."', '".$_POST["time_out"]."', '".$_POST["urgency"]."', '".$_POST["diag"]."', '".$_POST["operation"]."', '".$_POST["ward"]."', '".$_POST["room"]."', '".$_POST["type_wounded"]."', '".$_POST["type_scar"]."', '".$_POST["ptright"]."', '".$_POST["doctor"]."', '".$_POST["surgery"]."', '".$_POST["type_case"]."', '".$_POST["time_knife"]."', '".$_POST["asa"]."');";

$result1 = Mysql_Query($sql) or die(Mysql_error());
$id= Mysql_insert_id();

if($result1){
	$list = array();
	$count = count($_POST["drug"]);

	$sql = "INSERT INTO `memo_sur_drug` (`fk_row_id` ,`drug` )VALUES ";
	$j=0;
	for($i=0;$i<$count;$i++){
		if(trim($_POST["drug"][$i]) != ""){
			array_push($list," ('".$id."', '".$_POST["drug"][$i]."')");
			$j++;
			
		}
	}

	if($j > 0){
		$list2 = implode(",",$list);
		$sql .= $list2;

		$result2 = Mysql_Query($sql) or die(Mysql_error()."2");
		$list = array();
	}

	$count = count($_POST["patho"]);
	$sql = "INSERT INTO `memo_sur_patho` (`fk_row_id` ,`patho` )VALUES ";
	$j=0;
	for($i=0;$i<$count;$i++){
		if(trim($_POST["patho"][$i]) != ""){

			array_push($list," ('".$id."', '".$_POST["patho"][$i]."')");
			$j++;
		}
	}

	if($j > 0){
		$list2 = implode(",",$list);
		$sql .= $list2;
		$result3 = Mysql_Query($sql) or die(Mysql_error()."3");

	}
}

if($result1){

	echo "<CENTER><B>บันทึกข้อมูลเรียบร้อยแล้ว</B><BR><A HREF=\"#\" Onclick=\"window.location.href='memo_sur.php';\">&lt;&lt; กลับ</A></CENTER>";

}else{
	
	echo "<CENTER><B>ไม่สามารถบันทึกข้อมูลได้อาจเกิดจากความผิดพลาดบางอย่าง</B><BR><A HREF=\"#\" Onclick=\"window.location.href='memo_sur.php';\">&lt;&lt; กลับ</A></CENTER>";

}
//echo "<META HTTP-EQUIV=\"Refresh\"  CONTENT=\"4;URL=memo_sur.php\">";
exit();

//******************************* EDIT ******************************************/
}else if(isset($_REQUEST["action"]) && $_REQUEST["action"] == "edit"){


$_POST["time_in"] = substr($_POST["time_in"],0,-2).":".substr($_POST["time_in"],-2);
$_POST["time_out"] = substr($_POST["time_out"],0,-2).":".substr($_POST["time_out"],-2);
$_POST["time_knife"] = substr($_POST["time_knife"],0,-2).":".substr($_POST["time_knife"],-2);

$sql = "Update `memo_sur` set `date_time` = '".(date("Y")+543).date("-m-d")."' ,`thaidate` = '".$_POST["year"]."-".$_POST["month"]."-".$_POST["date"]."' ,`hn` = '".$_POST["hn"]."' ,`an` = '".$_POST["an"]."' ,`vn` = '".$_POST["vn"]."' ,`ptname` = '".$_POST["yot"]." ".$_POST["name"]." ".$_POST["lastname"]."' ,`timein` = '".$_POST["time_in"]."' ,`timeout` = '".$_POST["time_out"]."' ,`urgency` = '".$_POST["urgency"]."' ,`diag` = '".$_POST["diag"]."' ,`opertion` = '".$_POST["operation"]."' ,`ward` = '".$_POST["ward"]."' ,`room` = '".$_POST["room"]."' ,`type_wounded` = '".$_POST["type_wounded"]."' ,`type_scar` = '".$_POST["type_scar"]."' ,`ptright` = '".$_POST["ptright"]."' ,`doctor` = '".$_POST["doctor"]."' ,`surgery` = '".$_POST["surgery"]."',`type_case` = '".$_POST["type_case"]."',`timeknife` = '".$_POST["time_knife"]."',`asa` = '".$_POST["asa"]."'  where row_id = '".$_POST["row_id"]."' ";


$result1 = Mysql_Query($sql) or die(Mysql_error());


if($result1){

$sql = "Delete From `memo_sur_drug` where `fk_row_id` = '".$_POST["row_id"]."' ";
Mysql_Query($sql);
$sql = "Delete From `memo_sur_patho` where `fk_row_id` = '".$_POST["row_id"]."' ";
Mysql_Query($sql);

	$list = array();
	$count = count($_POST["drug"]);

	$sql = "INSERT INTO `memo_sur_drug` (`fk_row_id` ,`drug` )VALUES ";
	$j=0;
	for($i=0;$i<$count;$i++){
		if(trim($_POST["drug"][$i]) != ""){
			array_push($list," ('".$_POST["row_id"]."', '".$_POST["drug"][$i]."')");
			$j++;
		}
	}

	if($j > 0){
		$list2 = implode(",",$list);
		$sql .= $list2;
		$result2 = Mysql_Query($sql) or die(Mysql_error()."2");
		$list = array();
	}

	$count = count($_POST["patho"]);
	$sql = "INSERT INTO `memo_sur_patho` (`fk_row_id` ,`patho` )VALUES ";
	$j=0;
	for($i=0;$i<$count;$i++){
		if(trim($_POST["patho"][$i]) != ""){

			array_push($list," ('".$_POST["row_id"]."', '".$_POST["patho"][$i]."')");
			$j++;
		}
	}

	if($j > 0){
		$list2 = implode(",",$list);
		$sql .= $list2;
		$result3 = Mysql_Query($sql) or die(Mysql_error()."3");

	}
}

if($result1){

	echo "<CENTER><B>แก้ไขมูลเรียบร้อยแล้ว</B><BR><A HREF=\"#\" Onclick=\"window.location.href='memo_sur.php';\">&lt;&lt; กลับ</A></CENTER>";

}else{
	
	echo "<CENTER><B>ไม่สามารถบันทึกข้อมูลได้อาจเกิดจากความผิดพลาดบางอย่าง</B><BR><A HREF=\"#\" Onclick=\"window.location.href='memo_sur.php';\">&lt;&lt; กลับ</A></CENTER>";

}
echo "<META HTTP-EQUIV=\"Refresh\"  CONTENT=\"4;URL=memo_sur.php\">";
exit();

//******************************* DEL ******************************************/
}else if(isset($_REQUEST["action"]) && $_REQUEST["action"] == "del"){

$sql = "Delete From `memo_sur` where `row_id` = '".$_GET["id"]."' ";
Mysql_Query($sql);
$sql = "Delete From `memo_sur_drug` where `fk_row_id` = '".$_GET["id"]."' ";
Mysql_Query($sql);
$sql = "Delete From `memo_sur_patho` where `fk_row_id` = '".$_GET["id"]."' ";
Mysql_Query($sql);

	echo "<CENTER><B>ลบมูลเรียบร้อยแล้ว</B><BR><A HREF=\"#\" Onclick=\"window.location.href='memo_sur.php';\">&lt;&lt; กลับ</A></CENTER>";
	echo "<META HTTP-EQUIV=\"Refresh\"  CONTENT=\"4;URL=memo_sur.php\">";


exit();
}


//END  ADD EDIT DEL *************************************************************************/
include("memo_sur_in.php");

if(isset($_GET["action"]) && $_GET["action"] == "edt"){
	
	$sql = "Select * From memo_sur where row_id = '".$_GET["id"]."' limit 1 ";
	$result = Mysql_Query($sql);
	$arr = Mysql_fetch_array($result);
	$status = "edit";
	$hidden = "<INPUT TYPE=\"hidden\" value=\"".$_GET["id"]."\" name=\"row_id\">";
	list($yot,$name,$lastname) = explode(" ",$arr["ptname"]);
	$timein = substr(str_replace(":","",$arr["timein"]),0,-2);
	$timeout = substr(str_replace(":","",$arr["timeout"]),0,-2);
	$timeknife = substr(str_replace(":","",$arr["timeknife"]),0,-2);
	if($timeknife == "0000")
		$timeknife = "";
	list($arr["year"],$arr["month"],$arr["day"]) = explode("-",$arr["thaidate"]);

	$button_cancle = "<INPUT TYPE=\"button\" value=\"ยกเลิก\" Onclick=\"window.location.href='memo_sur.php' \">";

}else{
	$status = "add";
	$hidden = "";
	$arr["day"] = date("d");
	$arr["month"] = date("m");
	$arr["year"] = date("Y")+543;
	$button_cancle = "<INPUT TYPE=\"reset\" value=\"ยกเลิก\" >";
}

?>
<HTML>
<HEAD>
<TITLE> สมุดทะเบียนห้องผ่าตัด </TITLE>
<META NAME="Generator" CONTENT="EditPlus">
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
<SCRIPT LANGUAGE="JavaScript">
	function newXmlHttp(){
	var xmlhttp = false;

		try{
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		}catch(e){
		try{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}catch(e){
				xmlhttp = false;
			}
		}

		if(!xmlhttp && document.createElement){
			xmlhttp = new XMLHttpRequest();
		}
	return xmlhttp;
}

function viewdetail_hn(hn) { // *************************************** Java Ajax viewdetail ********************************************
	var txt = "";
	var txt2;

		if(document.getElementById("hn").value != ""){
			url = 'memo_sur.php?action=view_hn&hn=' + hn;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			txt = xmlhttp.responseText;
			txt2 = txt.split("][");
			
			document.getElementById('yot').value = txt2[0];
			document.getElementById('name').value = txt2[1];
			document.getElementById('lastname').value = txt2[2];
			document.getElementById('an').value = txt2[3];
			document.getElementById('vn').value = txt2[4];
			
		}
}

function viewdetail_an(an) { 
	var txt = "";
	var txt2;

		if(document.getElementById("an").value != ""){
			url = 'memo_sur.php?action=view_an&an=' + an;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			txt = xmlhttp.responseText;
			txt2 = txt.split("][");
			
			document.getElementById('yot').value = txt2[0];
			document.getElementById('name').value = txt2[1];
			document.getElementById('lastname').value = txt2[2];
			document.getElementById('hn').value = txt2[3];
			document.getElementById('vn').value = txt2[4];
			
		}
}

function create_lable(idname,textname){

	document.getElementById(idname).innerHTML += "<BR>อื่นๆ : <INPUT TYPE=\"text\" NAME=\""+textname+"[]\">";
			
}

function check_number() {
	e_k=event.keyCode
		if ((e_k < 48) || (e_k > 57)) {
			event.returnValue = false;
			alert("กรุณากรอกเป็นตัวเลขเท่านั้นครับ");
			return false;
		}else{
			return true;
		}
	}

function show_tooltip(detail,al,l,r){

	tooltip.style.left=document.body.scrollLeft+event.clientX+l;
	tooltip.style.top=document.body.scrollTop+event.clientY+r;
	tooltip.innerHTML="";
	tooltip.innerHTML = tooltip.innerHTML+"<TABLE border=\"1\" bordercolor=\"blue\"><TR><TD align=\""+al+"\">"+detail+"</TD></TR></TABLE>";
	tooltip.style.display="";
}
	
	function hid_tooltip(){
		tooltip.style.display="none";
		tooltip.innerHTML = "";
	}

</SCRIPT>
</HEAD>

<BODY>
<div id = "tooltip" onmouseover="tooltip.style.display=''; " onmouseout="hid_tooltip();" style="position:absolute;display:none;background-color:#FFFFFF;" >
</div>
<TABLE width="100%">
<TR>
	<TD width="50%">
	<?php
echo "<A HREF=\"../nindex.htm\" style=\"font-size: 14px;\">&lt; &lt; เมนู</A>";
echo "&nbsp;|&nbsp;";
//echo "<A HREF=\"memo_confirnout.php\" style=\"font-size: 14px;\">ยืนยันเครสนอกเวลารายการ</A>";
echo "&nbsp;|&nbsp;";
?>
</TD>
	<TD width="50%">
<?php


echo "<A HREF=\"javascript:void(0);\" Onclick=\"if(document.getElementById('menu').style.display=='') document.getElementById('menu').style.display='none'; else document.getElementById('menu').style.display=''; \">รายงานต่างๆ</A>";
echo "";
echo "<Div id=\"menu\" style=\"background: #FFFFFF; position: absolute; display:none; \"><BR><A HREF=\"report_sur01.php\" style=\"font-size: 14px;\" target=\"_blank\">ผ่าตัดนอกเวลาราชการ</A>";
echo "<BR>";
echo "<A HREF=\"report_sur00.php\" style=\"font-size: 14px;\" target=\"_blank\">รายงานสรุป</A>";
echo "<BR>";
echo "<A HREF=\"report_sur02.php\" style=\"font-size: 14px;\" target=\"_blank\">สรุปยอดผู้ป่วยแบ่งตามศัลยกรรมห้องผ่าตัดใหญ่</A>";
echo "<BR>";
echo "<A HREF=\"report_sur03.php\" style=\"font-size: 14px;\" target=\"_blank\">สรุปยอดผู้ป่วยแบ่งตามประเภทบาดแผลผ่าตัด(ผ่าตัดใหญ่)</A>";
echo "<BR>";
echo "<A HREF=\"report_sur07.php\" style=\"font-size: 14px;\" target=\"_blank\">สรุปยอดผู้ป่วยแบ่งตามประเภทบาดแผลผ่าตัด(ผ่าตัดเล็ก)</A>";
echo "<BR>";
echo "<A HREF=\"report_sur04.php\" style=\"font-size: 14px;\" target=\"_blank\">สรุปยอดผู้ป่วยแบ่งตามสิทธิการรักษา</A>";
echo "<BR>";
echo "<A HREF=\"report_sur05.php\" style=\"font-size: 14px;\" target=\"_blank\">สรปุยอดผู้ป่วยแบ่งตามประเภทผู้ป่วยห้องผ่าตัดใหญ่</A>";
echo "<BR>";
echo "<A HREF=\"report_sur06.php\" style=\"font-size: 14px;\" target=\"_blank\">สรปุยอดผู้ป่วยแบ่งตามประเภทผู้ป่วยห้องผ่าตัดเล็ก</A>";
echo "<BR></Div>";
?>
</TD>
</TR>
</TABLE>


<TABLE width="100%" border="0">
<TR valign="top">
	<TD width="450">
<FORM METHOD=POST ACTION="">
<TABLE    border="1" bordercolor="#3366FF">
<TR>
	<TD>
<table>
<TR colspan="2">
	<TD align="center"  bgcolor="#3366FF" class="font_title" colspan ="8">เพิ่มข้อมูลคนไข้ผ่าตัด</TD>
</TR>
  <tr align="center">
    <td colspan="2">วันที่ : 

        <input name="date" type="text" id="date" size="3" maxlength="2" value="<?php echo $arr["day"];?>"/>
    เดือน :
    <select size="1" name="month">
    <option selected>--เลือก--</option>
    <option value="01" <?if($arr["month"]=="01"){ echo" Selected "; }?> >มกราคม</option>
    <option value="02" <?if($arr["month"]=="02"){ echo" Selected "; }?> >กุมภาพันธ์</option>
    <option value="03" <?if($arr["month"]=="03"){ echo" Selected "; }?> >มีนาคม</option>
    <option value="04" <?if($arr["month"]=="04"){ echo" Selected "; }?> >เมษายน</option>
    <option value="05" <?if($arr["month"]=="05"){ echo" Selected "; }?> >พฤษภาคม</option>
    <option value="06" <?if($arr["month"]=="06"){ echo" Selected "; }?> >มิถุนายน</option>
    <option value="07" <?if($arr["month"]=="07"){ echo" Selected "; }?> >กรกฎาคม</option>
    <option value="08" <?if($arr["month"]=="08"){ echo" Selected "; }?> >สิงหาคม</option>
    <option value="09" <?if($arr["month"]=="09"){ echo" Selected "; }?> >กันยายน</option>
    <option value="10" <?if($arr["month"]=="10"){ echo" Selected "; }?> >ตุลาคม</option>
    <option value="11" <?if($arr["month"]=="11"){ echo" Selected "; }?> >พฤษจิกายน</option>
    <option value="12" <?if($arr["month"]=="12"){ echo" Selected "; }?> >ธันวาคม</option>
  </select>
    ปี :
    <select size="1" name="year">
    <?php for($i=date("Y")+542;$i<date("Y")+545;$i++){?>
   <option value="<?php echo $i;?>" <?php if($i == $arr["year"]) echo "Selected"; ?> ><?php echo $i;?></option>
   <?php }?>
  </select>
    &nbsp;</td>
  </tr>
  <tr align="center">
    <td colspan="2">Hn : <INPUT TYPE="text" ID="hn" NAME="hn" size="9" value="<?php echo $arr["hn"];?>"><INPUT TYPE="button" value="view" Onclick="if(document.getElementById('hn').value != '' ){viewdetail_hn(document.getElementById('hn').value);}"> An : <INPUT TYPE="text" NAME="an" ID="an" size="9" value="<?php echo $arr["an"];?>"><INPUT TYPE="button" value="view" Onclick="if(document.getElementById('an').value != '' ){viewdetail_an(document.getElementById('an').value);}"> Vn : <INPUT TYPE="text" ID="vn" NAME="vn" size="9" value="<?php echo $arr["vn"];?>"> </td>
  </tr>
  <tr align="center">
    <td colspan="2">ยศ : <INPUT TYPE="text" ID="yot" NAME="yot" size="7"  value="<?php echo $yot;?>"> ชื่อ-สกุล : <INPUT TYPE="text" ID="name" NAME="name"  size="15"   value="<?php echo $name;?>"> - <INPUT TYPE="text" ID="lastname" NAME="lastname"  size="15"   value="<?php echo $lastname;?>"> </td>
  </tr>
  <tr>
    <td width="152" align="right">เวลารับผู้ป่วย : &nbsp;</td>
    <td width="237"><input name="time_in" type="text" id="time_in" size="4" maxlength="4" value="<?php echo $timein;?>" onkeypress="check_number();" /></td>
  </tr>
  <tr>
    <td align="right">เวลาส่งผู้ป่วย : &nbsp;</td>
    <td><input name="time_out" type="text" id="time_out" size="4" maxlength="4" value="<?php echo $timeout;?>" onkeypress="check_number();" /></td>
  </tr>
  <tr>
    <td align="right">เวลาลงมีผ่าตัด : &nbsp;</td>
    <td><input name="time_knife" type="text" id="time_knife" size="4" maxlength="4" value="<?php echo $timeknife;?>" onkeypress="check_number();" /></td>
  </tr>
  <tr>
    <td align="right">ASA : &nbsp;</td>
    <td><select name="asa" id="asa">
      <option>--ASA--</option>
	 <?php
	 foreach( $cfg_asa as  $key => $value){
		echo "<option value='".$key."' ";
			if($key == $arr["asa"]) echo " Selected ";
		echo ">".$value."</option>";
	}
	 ?>

    </select></td>
  </tr>
  <tr>
    <td align="right">ความเร่งด่วน : &nbsp;</td>
    <td><select name="urgency" id="urgency">
      <option>--ความเร่งด่วน--</option>
	 <?php
	 foreach( $cfg_urgency as  $key => $value){
		echo "<option value='".$key."' ";
			if($key == $arr["urgency"]) echo " Selected ";
		echo ">".$value."</option>";
	}
	 ?>

    </select>    </td>
  </tr>
  <tr>
    <td align="right">Diag : &nbsp;</td>
    <td><input name="diag" type="text" id="diag" value="<?php echo $arr["diag"];?>" /></td>
  </tr>
  <tr>
    <td align="right">Operation : &nbsp;</td>
    <td><input name="operation" type="text" id="operation" value="<?php echo $arr["opertion"];?>" /></td>
  </tr>
  <tr>
    <td align="right">Ward : &nbsp;</td>
    <td><select name="ward" id="ward">
	   <option>--Ward--</option>
      <?php
	 foreach( $cfg_ward as  $key => $value){
		echo "<option value='".$key."' ";
			if($key == $arr["ward"]) echo " Selected ";
		echo ">".$value."</option>";
	}
	 ?>
    </select>    </td>
  </tr>
  <tr>
    <td align="right">ห้อง : &nbsp;</td>
    <td><select name="room" id="room">
      <option>--ห้อง--</option>
      <?php
	 foreach( $cfg_room as  $key => $value){
		echo "<option value='".$key."' ";
			if($key == $arr["room"]) echo " Selected ";
		echo ">".$value."</option>";
	}
	 ?>
    </select>    </td>
  </tr>
  <tr>
    <td align="right">ประเภท ผป.เข้าห้องผ่าตัด : &nbsp;</td>
    <td><select name="type_case" id="type_case">
      <option>--ประเภท ผป.เข้าห้องผ่าตัด--</option>
      <?php
	 foreach( $cfg_type_case as  $key => $value){
		echo "<option value='".$key."' ";
			if($key == $arr["type_case"]) echo " Selected ";
		echo ">".$value."</option>";
	}
	 ?>
    </select>    </td>
  </tr>
  <tr>
    <td align="right">ประเภทผู้ป่วย : &nbsp;</td>
    <td><select name="type_wounded" id="type_wounded">
      <option>--ประเภทผู้ป่วย--</option>
	  <?php
	 foreach( $cfg_type_wounded as  $key => $value){
		echo "<option value='".$key."' ";
			if($key == $arr["type_wounded"]) echo " Selected ";
		echo ">".$value."</option>";
	}
	 ?>
    </select>    </td>
  </tr>
  <tr>
    <td align="right">ประเภทแผลผ่าตัด : &nbsp;</td>
    <td><select name="type_scar" id="type_scar">
      <option>--ประเภทแผลผ่าตัด--</option>
	  <?php
	 foreach( $cfg_type_scar as  $key => $value){
		echo "<option value='".$key."' ";
			if($key == $arr["type_scar"]) echo " Selected ";
		echo ">".$value."</option>";
	}
	 ?>
    </select>    </td>
  </tr>
  <tr>
    <td align="right">สิทธิ์ผู้ป่วย : &nbsp;</td>
    <td><select name="ptright">
	<option>--สิทธิ์ผู้ป่วย--</option>
	<?php
	 foreach( $cfg_ptright as  $key => $value){
		echo "<option value='".$key."' ";
			if($key == $arr["ptright"]) echo " Selected ";
		echo ">".$value."</option>";
	}
	 ?>
    </select>    </td>
  </tr>
  <tr>
    <td align="right">แพทย์ : &nbsp;</td>
    <td><select name="doctor">
	<option>--แพทย์--</option>
<?php
	 $sql = "Select name From doctor where row_id > 0 AND status = 'y' Order by name ASC " ;
	 $result = Mysql_Query($sql); 
	 while($arr2 = Mysql_fetch_assoc($result)){
		echo "<option value='".$arr2["name"]."' ";
			if(substr($arr2["name"],0,5) == substr($arr["doctor"],0,5)) echo " Selected ";
		echo ">".$arr2["name"]."</option>";
	 }
	 ?>
    </select></td>
  </tr>
  <tr>
    <td align="right">สายศัลยกรรม : &nbsp;</td>
    <td><select name="surgery">
	<option>--สายศัลยกรรม--</option>
	<?php
	 foreach( $cfg_surgery as  $key => $value){
		echo "<option value='".$key."' ";
			if($key == $arr["surgery"]) echo " Selected ";
		echo ">".$value."</option>";
	}
	 ?>
    </select>    </td>
  </tr>
  <tr>
    <td align="right">Patho : &nbsp;</td>
    <td bgcolor="#FFFFAA">
	<?php

		 foreach( $cfg_patho as  $key => $value){
			echo "<INPUT TYPE=\"checkbox\" NAME=\"patho[]\" value=\"".$value."\"";
				if($_GET["action"] == "edt"){
					$sql = "Select count(fk_row_id) From memo_sur_patho where patho = '".$value."' AND fk_row_id = '".$_GET["id"]."' limit 1";
					list($c) = Mysql_fetch_row(Mysql_Query($sql));
					if($c > 0) echo " Checked ";
				}
			echo "> ".$value."&nbsp;&nbsp;&nbsp;";

		}

	 ?><BR><INPUT TYPE="button" value="++" Onclick="create_lable('lable_patho','patho');">
	<div id="lable_patho"><?php if($_GET["action"] == "edt"){
					$sql = "Select patho From memo_sur_patho where patho not in ('".implode("','",$cfg_patho)."') AND fk_row_id = '".$_GET["id"]."' ";
					$result = Mysql_Query($sql);
					while(list($patho) = Mysql_fetch_row($result)){
						echo " อื่นๆ : <INPUT TYPE=\"text\" NAME=\"patho[]\" value=\"".$patho."\"><BR>";
					}
					
				}?> อื่นๆ : <INPUT TYPE="text" NAME="patho[]"></div>
    </td>
  </tr>
  <tr>
    <td align="right">ประเภทการให้ยา :</td>
    <td bgcolor="#B0FFFF">
	<?php
	$i=0;
	 foreach( $cfg_drug as  $key => $value){
		 $i++;
		echo "<INPUT TYPE=\"checkbox\" NAME=\"drug[]\" value=\"".$value."\"";
				if($_GET["action"] == "edt"){
					$sql = "Select count(fk_row_id) From memo_sur_drug where drug = '".$value."' AND fk_row_id = '".$_GET["id"]."' limit 1";
					list($c) = Mysql_fetch_row(Mysql_Query($sql));
					if($c > 0) echo " Checked ";
				}
			echo "> ".$value."&nbsp;&nbsp;&nbsp;";
		if($i==4) echo "<BR>";
	}
	 ?><BR><INPUT TYPE="button" value="++" Onclick="create_lable('lable_drug','drug');">
	 <div id="lable_drug"> <?php if($_GET["action"] == "edt"){
					$sql = "Select drug From memo_sur_drug where drug not in ('".implode("','",$cfg_drug)."') AND fk_row_id = '".$_GET["id"]."' ";
					$result = Mysql_Query($sql);
					while(list($patho) = Mysql_fetch_row($result)){
						echo " อื่นๆ : <INPUT TYPE=\"text\" NAME=\"drug[]\" value=\"".$patho."\"><BR>";
					}
					
				}?>อื่นๆ : <INPUT TYPE="text" NAME="drug[]"></div>
    </td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="submit" name="Submit" value="บันทึก" />&nbsp;&nbsp;<?php echo $button_cancle; ?></td>
  </tr>
</table>
</TD>
</TR>
</TABLE>
<INPUT TYPE="hidden" name="action" value="<?php echo $status;?>">
<?php echo $hidden;?>
</FORM>
</TD>
	<TD>
<FORM METHOD=POST ACTION="">
ค้นหา HN : <INPUT TYPE="text" NAME="search_hn" size="8">&nbsp;<INPUT TYPE="submit" value="ตกลง">
</FORM>

<TABLE    border="1" bordercolor="#3366FF" width="100%">
<TR>
	<TD>
	
	<table width="100%">
	<tr align="center"  bgcolor="#3366FF" class="font_title" >
		<td colspan="8" align="center">ข้อมูลที่บันทึก</td>
	  </tr>
	  <tr align="center"  bgcolor="#3366FF" class="font_title" >
		<td>ว/ด/ป</td>
		<td>HN</td>
		<td>Diag</td>
		<td>Opertion</td>
		<td>เวลาเข้า</td>
		<td>เวลาออก</td>
		<td>แก้ไข</td>
		<td>ลบ</td>
	  </tr>
<?php

if(isset($_POST["search_hn"]) && $_POST["search_hn"] !=""){
	$where = "where hn = '".$_POST["search_hn"]."' ";
}

$sql = "Select row_id, date_format(thaidate,'%d/%m/%Y'), hn , diag, opertion, left(timein,5), left(timeout,5),ptname From memo_sur ".$where." Order by row_id DESC limit 20 ";
$result = Mysql_Query($sql);
while(list($row_id, $thaidate, $hn , $daig, $opertion, $timein, $timeout,$ptname) = Mysql_fetch_row($result)){

 echo "<tr>";
	 echo "<td align='center'>".$thaidate."</td>";
	 echo "<td><span onmouseover= \"show_tooltip('".$ptname."','center',0,0);\" onmouseout=\"hid_tooltip();\" >".$hn."</span></td>";
	 echo "<td>".$daig."</td>";
	 echo "<td>".$opertion."</td>";
	 echo "<td align='center'>".$timein."</td>";
	 echo "<td align='center'>".$timeout."</td>";
	 echo "<td align='center'><A HREF=\"memo_sur.php?action=edt&id=".$row_id."\">แก้ไข</A></td>";
	 echo "<td align='center'><A HREF=\"#\" Onclick=\"if(confirm('ต้องการลบข้อมูลใช่หรือไม่?')){ window.location.href='memo_sur.php?action=del&id=".$row_id."';}\">ลบ</A></td>";
echo "</tr>";

 } ?>
	</table>
</TD>
</TR>
</TABLE>


	</TD>
</TR>
</TABLE>


</BODY>
</HTML>
<?php include("unconnect.inc");?>