<?
session_start();
 include("connect.inc");  

if(isset($_POST["submit_id"]) && $_POST["submit_id"] != ""){

	$sql = "Update opd set dx_mc_soldier = '".$_POST["dx_mc_soldier"]."' , dr1_mc_soldier  = '".$_POST["dr1_mc_soldier"]."', dr2_mc_soldier  = '".$_POST["dr2_mc_soldier"]."', dr3_mc_soldier  = '".$_POST["dr3_mc_soldier"]."', address  = '".$_POST["address"]."', rule  = '".$_POST["rule"]."' where row_id = '".$_POST["submit_id"]."' limit 1";
	$result = mysql_query($sql);

	if($result){
		echo "<BR><CENTER>บันทึกข้อมูลเรียบร้อยแล้ว</CENTER>";
	}else{
		echo "<BR><CENTER>ไม่สามารถบันทึกข้อมูลได้</CENTER>";
	}
	echo "<BR><CENTER>กรุณาปิดหน้านี้</CENTER>";
exit();
}

$sql = "Select dx_mc_soldier, dr1_mc_soldier, dr2_mc_soldier, dr3_mc_soldier,address,rule From opd  where row_id = '".$_GET["id"]."' limit 0,1 ";
list($dx_mc_soldier, $dr1_mc_soldier, $dr2_mc_soldier, $dr3_mc_soldier,$address,$rule) = mysql_fetch_row(mysql_query($sql));


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> โรงพยาบาลค่ายสุรศักดิ์มนตรี </TITLE>
<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
<style>
	
	body,td,th {
	font-family: Angsana New;
	font-size: 22px;
	}

	.tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
	.tb_detail {background-color: #FFFFC1; text-align: right; }
	.tb_detail2 {background-color: #FFFFC1; color:#0000FF; }
	.tb_menu {background-color: #FFFFC1;  }

</style>
</HEAD>

<BODY>

<FORM METHOD=POST ACTION="">
<TABLE border="1" bordercolor="#0046D7">
<TR>
	<TD>
<TABLE>
<TR colspan="2">
	<TD align="center" class="tb_head" colspan="2"> เพิ่ม/แก้ไข้ข้มูล</TD>
</TR>
<TR>
	<TD class="tb_detail">ที่อยู่ภูมิลำเนา&nbsp;:&nbsp;</TD>
	<TD><TEXTAREA NAME="address" ROWS="4" COLS="50"><?php echo $address;?></TEXTAREA></TD>
</TR>
<TR>
	<TD class="tb_detail">อาการโรคที่ตรวจพบ&nbsp;:&nbsp;</TD>
	<TD><TEXTAREA NAME="dx_mc_soldier" ROWS="4" COLS="50"><?php echo $dx_mc_soldier;?></TEXTAREA></TD>
</TR>
<TR>
  <TD align="center" class="tb_detail">ตามกฏทรวงฉบับที่ ๗๔ พ.ศ. ๒๕๔๐<BR>
    และฉบับแก้ไขที่ ๗๖ พ.ศ. ๒๕๕๕</TD>
  <TD><TEXTAREA NAME="rule" ROWS="4" COLS="50"><?php echo $rule;?></TEXTAREA></TD>
</TR>
<TR>
	<TD class="tb_detail">แพทย์&nbsp;:&nbsp;</TD>
	<TD>
	<select size="1" name="dr1_mc_soldier" Onchange="function_doctor(this.value)">

<option value="" selected>-----------------------</option>

<?php

	$sql = "Select name From doctor where status = 'y' AND row_id != '0' Order by name ASC ";
	$result = Mysql_Query($sql);
	
	while(list($name) = Mysql_fetch_row($result)){
		echo "<option value=\"".$name."\" ";
		if($dr1_mc_soldier == $name) echo " Selected ";
		echo ">".$name."</option>";
	}
?>
		</select>
	</TD>
</TR>
<TR>
	<TD class="tb_detail">แพทย์&nbsp;:&nbsp;</TD>
	<TD>
	<select size="1" name="dr2_mc_soldier" Onchange="function_doctor(this.value)">

<option value="" selected>-----------------------</option>

<?php

	mysql_data_seek($result,0);
	
	while(list($name) = Mysql_fetch_row($result)){
		echo "<option value=\"".$name."\" ";
		if($dr2_mc_soldier == $name) echo " Selected ";
		echo ">".$name."</option>";
	}
?>
		</select>
		</TD>
</TR>
<TR>
	<TD class="tb_detail">แพทย์&nbsp;:&nbsp;</TD>
	<TD>
	<select size="1" name="dr3_mc_soldier" Onchange="function_doctor(this.value)">
		<option value="" selected>-----------------------</option>

<?php

	mysql_data_seek($result,0);
	
	while(list($name) = Mysql_fetch_row($result)){
		echo "<option value=\"".$name."\" ";
		if($dr3_mc_soldier == $name) echo " Selected ";
		echo ">".$name."</option>";
	}
?>
		</select>
		</TD>
</TR>
<TR>
	<TD colspan="2" align="center"><INPUT TYPE="submit" value="ตกลง"></TD>
</TR>
</TABLE>
</TD>
</TR>
</TABLE>
<INPUT TYPE="hidden" name="submit_id" value="<?php echo $_GET["id"];?>" >
</FORM>

</BODY>
</HTML>
<?php
 include("unconnect.inc"); 
?>