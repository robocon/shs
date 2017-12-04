<?php
session_start();
include("connect.inc");  

if(isset($_GET["action"]) && $_GET["action"]=="del"){

	$sql = "Delete From `doctor_off` where row_id = '".$_GET["id"]."' ";
	$result = Mysql_Query($sql);

echo "<META HTTP-EQUIV='Refresh' CONTENT='0;URL=opdcoff.php'>";
exit();
}


if(isset($_POST["Submit"])){
	

	for($i=0;$i<6;$i++){
		
		if($_POST["day"][$i] != "-" && $_POST["month"][$i] != "-"){
			$sql = "INSERT INTO `doctor_off` (  `date` , `part` , `date_off` , `doctor` , `office` ) VALUES ( '".(date("Y")+543).date("-m-d H:i:s")."', '".$_POST["path"]."', '".$_POST["year"][$i]."-".$_POST["month"][$i]."-".$_POST["day"][$i]."', '', '".$_SESSION["sOfficer"]."');";
			Mysql_Query($sql);
		}
	}
echo "<META HTTP-EQUIV='Refresh' CONTENT='0;URL=opdcoff.php'>";
exit();
}

if(isset($_POST["submit2"])){
	
	$list_day = explode(",",$_POST["day"]);
	
	$count = count($list_day);
	
	for($i=0;$i<$count;$i++){

		$list_day[$i] = trim($list_day[$i]);
		

		if(eregi('-', $list_day[$i])){
			
			$ar = explode("-",$list_day[$i]);
			
			for($j = $ar[0];$j<=$ar[1];$j++){
				
				$j = sprintf ("%02d",$j);

				if(checkdate($_POST["month"],$j,$_POST["year"])){
					$sql = "INSERT INTO `doctor_off` (  `date` , `part` , `date_off` , `doctor` , `office` ) VALUES ( '".(date("Y")+543).date("-m-d H:i:s")."', '', '".$_POST["year"]."-".$_POST["month"]."-".$j."', '".$_POST["doctor"]."', '".$_SESSION["sOfficer"]."');";
					Mysql_Query($sql);
				}

			}

		}else{
			
			$list_day[$i] = sprintf ("%02d",$list_day[$i]);

			if(checkdate($_POST["month"],$list_day[$i],$_POST["year"])){
				$sql = "INSERT INTO `doctor_off` (  `date` , `part` , `date_off` , `doctor` , `office` ) VALUES ( '".(date("Y")+543).date("-m-d H:i:s")."', '', '".$_POST["year"]."-".$_POST["month"]."-".$list_day[$i]."', '".$_POST["doctor"]."', '".$_SESSION["sOfficer"]."');";
				Mysql_Query($sql);
			}
		}
		
	}
		
	
echo "<META HTTP-EQUIV='Refresh' CONTENT='0;URL=opdcoff.php'>";
exit();
}


$list_paht["EX07"] = "EX07&nbsp;ทันตกรรม"; 
$list_paht["EX08"] = "EX08&nbsp;สูติ";
$list_paht["EX09"] = "EX09&nbsp;ผ่าตัด";
$list_paht["EX10"] = "EX10&nbsp;ไตเทียม";
$list_paht["EX14"] = "EX14&nbsp;อัลตร้าซาวด์";
$list_paht["EX16"] = "EX16&nbsp;ตรวจสุขภาพ";
$list_paht["EX17"] = "EX17&nbsp;กายภาพบำบัด";
$list_paht["EX20"] = "EX20&nbsp;นวดแผนไทย";

?>
<a   href='../nindex.htm'>&lt;&lt;ไปเมนู</a>

<SCRIPT LANGUAGE="JavaScript">
	function check_number() {
		
		e_k=event.keyCode;
		if (((e_k >= 48) && (e_k <= 57)) || e_k ==44 || e_k ==45 ) {
			return true;
		}else{
			event.returnValue = false;
			alert("ไม่อนุญาตให้พิมพ์ครับ");
			return false;
		}
	}
</SCRIPT>

<TABLE width="100%" border='0'>
<TR valign="top">
	<TD width="50%">
<FORM METHOD=POST ACTION="">
<table  border="0">
  <tr>
    <td width="63" align="right"><font face='Angsana New'>แผนก&nbsp;:&nbsp;</td>
    <td >
      <select name="path" id="path">
	  <?php
		foreach($list_paht as $key => $value)
			echo "<Option value ='",$key,"'>",$value,"</Option>\n";
	  ?>
      </select>
    </td>
  </tr>
  <?php 
		for($j=0;$j<6;$j++){
	  ?>
  <tr>
    <td align="right"><font face='Angsana New'>วัน&nbsp;:&nbsp;</td>
    <td><font face='Angsana New'>
      <select name="day[]" >
		<option value="-" selected>--วันที่--</option>
		<option value="01">01</option>
		<option value="02">02</option>
		<option value="03">03</option>
		<option value="04">04</option>
		<option value="05">05</option>
		<option value="06">06</option>
		<option value="07">07</option>
		<option value="08">08</option>
		<option value="09">09</option>
		<option value="10">10</option>
		<option value="11">11</option>
		<option value="12">12</option>
		<option value="13">13</option>
		<option value="14">14</option>
		<option value="15">15</option>
		<option value="16">16</option>
		<option value="17">17</option>
		<option value="18">18</option>
		<option value="19">19</option>
		<option value="20">20</option>
		<option value="21">21</option>
		<option value="22">22</option>
		<option value="23">23</option>
		<option value="24">24</option>
		<option value="25">25</option>
		<option value="26">26</option>
		<option value="27">27</option>
		<option value="28">28</option>
		<option value="29">29</option>
		<option value="30">30</option>
		<option value="31">31</option>
      </select>
      เดือน 
      <select name="month[]" >
		<option value="-" selected>--เดือน--</option>
		<option value="01">มกราคม</option>
		<option value="02">กุมภาพันธ์</option>
		<option value="03">มีนาคม</option>
		<option value="04">เมษายน</option>
		<option value="05">พฤษภาคม</option>
		<option value="06">มิถุนายน</option>
		<option value="07">กรกฏาคม</option>
		<option value="08">สิงหาคม</option>
		<option value="09">กันยายน</option>
		<option value="10">ตุลาคม</option>
		<option value="11">พฤศจิกายน</option>
		<option value="12">ธันวาคม</option>
      </select>
      ปี
      <select name="year[]" >
		<?php for($i=date("Y")+542;$i<date("Y")+545;$i++){?>
	   <option value="<?php echo $i;?>" <?php if($i == date("Y")+543) echo "Selected"; ?> ><?php echo $i;?></option>
	   <?php }?>
      </select>
    </td>
  </tr>
    <?php }?>
  <tr>
    <td colspan="2">
      <input type="submit" name="Submit" value="ตกลง">
    </td>
  </tr>
</table>
</FORM>

<br>
<br>
<table  border="0">
  <tr align="center" bgcolor="#6495ED">
    <td width="154"><font face='Angsana New'><strong>แผนก</strong></td>
    <td width="194"><font face='Angsana New'><strong>วันที่ไม่ออกตรวจ</strong></td>
	<td width="50"><font face='Angsana New'><strong>ลบ</strong></td>
  </tr>
<?php
	$sql = "Select row_id, part , date_format(date_off,'%d/%m/%Y') as date_off From doctor_off where doctor ='' Order by row_id DESC";
	$result = Mysql_Query($sql);
	while(list($row_id, $path, $date_off) = Mysql_fetch_row($result)){

  echo "<tr bgcolor='#FFCC99'>
    <td>",$list_paht[$path],"</td>
    <td align='center'>",$date_off,"</td>
	<td align='center'><A HREF=\"?action=del&id=",$row_id,"\">ลบ</A></td>
  </tr>";
 }?>
</table>
</TD>
	<TD width="50%">
	<SCRIPT LANGUAGE="JavaScript">

	function checkForm2(){
	
		if(document.f2.doctor.value == ""){
			alert("กรุณาเลือกแพทย์");
			return false;
		}else if(document.f2.month.value == "-"){
			alert("กรุณาเลือกเดือน");
			return false;
		}else if(document.f2.day.value == ""){
			alert("กรุณาพิมพ์วัน");
			return false;
		}else{
			return true;
		}

	}

	</SCRIPT>
	<FORM name="f2" METHOD=POST ACTION="" Onsubmit="return checkForm2();">
	<TABLE style='font-family: Angsana New'>
	<TR>
		<TD>แพทย์ : </TD>
		<TD>
<select size="1" name="doctor">
<option value="" selected>-----------------------</option>
<?php

	$sql = "Select name From doctor where status = 'y' AND row_id != '0' Order by name ASC ";
	$result = Mysql_Query($sql);
	
	while(list($name) = Mysql_fetch_row($result)){
		echo "<option value=\"".$name."\" ";
			if($arr["doctor"] == $name) echo " Selected ";
		echo ">".$name."</option>";
	}
?></select>
</TD>
	</TR>
	<TR>
		<TD colspan='2'>
		วันที่ <INPUT TYPE="text" NAME="day" size="2" Onkeypress="check_number();">
		เดือน <select name="month" >
		<option value="-" selected>--เดือน--</option>
		<option value="01">มกราคม</option>
		<option value="02">กุมภาพันธ์</option>
		<option value="03">มีนาคม</option>
		<option value="04">เมษายน</option>
		<option value="05">พฤษภาคม</option>
		<option value="06">มิถุนายน</option>
		<option value="07">กรกฏาคม</option>
		<option value="08">สิงหาคม</option>
		<option value="09">กันยายน</option>
		<option value="10">ตุลาคม</option>
		<option value="11">พฤศจิกายน</option>
		<option value="12">ธันวาคม</option>
      </select>
		ปี <select name="year" >
		<?php for($i=date("Y")+542;$i<date("Y")+545;$i++){?>
	   <option value="<?php echo $i;?>" <?php if($i == date("Y")+543) echo "Selected"; ?> ><?php echo $i;?></option>
	   <?php }?>
      </select>
		</TD>
		<TR>
		<TD colspan='2'>
		<INPUT TYPE="submit" name="submit2" value="ตกลง">
		</TD>
	</TR>
	</TABLE>
	</FORM>

	<br>
<br>
<table  border="0">
  <tr align="center" bgcolor="#6495ED">
    <td width="154"><font face='Angsana New'><strong>แพทย์</strong></td>
    <td width="194"><font face='Angsana New'><strong>วันที่ไม่ออกตรวจ</strong></td>
	<td width="50"><font face='Angsana New'><strong>ลบ</strong></td>
  </tr>
<?php
	$sql = "Select row_id, doctor , date_format(date_off,'%d/%m/%Y') as date_off From doctor_off where part ='' Order by row_id DESC";
	$result = Mysql_Query($sql);
	while(list($row_id, $doctor, $date_off) = Mysql_fetch_row($result)){

  echo "<tr bgcolor='#FFCC99'>
    <td>",$doctor,"</td>
    <td align='center'>",$date_off,"</td>
	<td align='center'><A HREF=\"?action=del&id=",$row_id,"\">ลบ</A></td>
  </tr>";
 }?>
</table>
	
	</TD>
</TR>
</TABLE>
<?php
include("unconnect.inc");
?>