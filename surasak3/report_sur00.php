<?php

set_time_limit(3);
include("connect.inc");
include("memo_sur_in.php");

$month_now =sprintf("%02d",$_POST["month"]);
$year_now = $_POST["year"];
?>

<form method='POST' action='report_sur00.php'>
	<TABLE id="form_01" style="font-size: 14px; font-family: 'MS Sans Serif'; " border='0'>
	<TR>
		<TD colspan="2">
	
	เดือน&nbsp; <input type='text' name='month' size='4' value='<?php echo $month_now;?>'>&nbsp;&nbsp;&nbsp;
	พ.ศ. <input type='text' name='year' size='8' value='<?php echo $year_now;?>'>
		</TD>
	</TR>
	<tr>
    <td align="right">ประเภท ผป.เข้าห้องผ่าตัด : &nbsp;</td>
    <td><select name="type_case" id="type_case">
      <option value="">--ดูทั้งหมด--</option>
      <?php
	 foreach( $cfg_type_case as  $key => $value){
		echo "<option value='".$key."' ";
			if($key == $_POST["type_case"]) echo " Selected ";
		echo ">".$value."</option>";
	}
	 ?>
    </select>   </td>
  </tr>
  <tr>
    <td align="right">ประเภทผู้ป่วย : &nbsp;</td>
    <td><select name="type_wounded" id="type_wounded">
      <option value="">--ดูทั้งหมด--</option>
	  <?php
	 foreach( $cfg_type_wounded as  $key => $value){
		echo "<option value='".$key."' ";
			if($key == $_POST["type_wounded"]) echo " Selected ";
		echo ">".$value."</option>";
	}
	 ?>
    </select>    </td>
  </tr>
  <tr>
    <td align="right">ประเภทแผลผ่าตัด : &nbsp;</td>
    <td><select name="type_scar" id="type_scar">
      <option value="">--ดูทั้งหมด--</option>
	  <?php
	 foreach( $cfg_type_scar as  $key => $value){
		echo "<option value='".$key."' ";
			if($key == $_POST["type_scar"]) echo " Selected ";
		echo ">".$value."</option>";
	}
	 ?>
    </select>    </td>
  </tr>
  <tr>
    <td align="right">สิทธิ์ผู้ป่วย : &nbsp;</td>
    <td><select name="ptright">
	<option value="">--ดูทั้งหมด--</option>
	<?php
	 foreach( $cfg_ptright as  $key => $value){
		echo "<option value='".$key."' ";
			if($key == $_POST["ptright"]) echo " Selected ";
		echo ">".$value."</option>";
	}
	 ?>
    </select>    </td>
  </tr>
  <tr>
    <td align="right">แพทย์ : &nbsp;</td>
    <td><select name="doctor">
	<option value="">--ดูทั้งหมด--</option>
<?php
	 $sql = "Select name From doctor where row_id > 0 AND status = 'y' Order by name ASC " ;
	 $result = Mysql_Query($sql); 
	 while($arr2 = Mysql_fetch_assoc($result)){
		echo "<option value='".$arr2["name"]."' ";
			if(substr($arr2["name"],0,5) == substr($_POST["doctor"],0,5)) echo " Selected ";
		echo ">".$arr2["name"]."</option>";
	 }
	 ?>
    </select></td>
  </tr>
  <tr>
    <td align="right">สายศัลยกรรม : &nbsp;</td>
    <td><select name="surgery">
	<option value="">--ดูทั้งหมด--</option>
	<?php
	 foreach( $cfg_surgery as  $key => $value){
		echo "<option value='".$key."' ";
			if($key == $_POST["surgery"]) echo " Selected ";
		echo ">".$value."</option>";
	}
	 ?>
    </select>    </td>
  </tr>
	<TR>
		<TD><input type='submit' name="submit" value='     ตกลง     ' ></TD>
	</TR>
	</TABLE>
	</form>


<?php
if(isset($_POST["month"]) && isset($_POST["year"])){


$sql = "Select hn,date_format(thaidate,'%d/%m/%Y') as dt2, ptname, doctor, diag, opertion, timein, timeout, type_case, type_wounded, type_scar, ptright, doctor, surgery, room  From memo_sur where thaidate like '".($_POST["year"])."-".sprintf("%02d",$_POST["month"])."%' AND   type_case like '%".$_POST["type_case"]."%' AND type_wounded like '%".$_POST["type_wounded"]."%' AND type_scar like '%".$_POST["type_scar"]."%' AND ptright like '%".$_POST["ptright"]."%' AND doctor like '%".$_POST["doctor"]."%' AND surgery like '%".$_POST["surgery"]."%' ";

$result = mysql_query($sql);
echo "<TABLE border='1' width=\"1200\" bordercolor=\"#000000\" style=\"font-size: 14px; font-family: 'MS Sans Serif'; BORDER-COLLAPSE: collapse;\" cellpadding=\"2\">";
echo "<TR align=\"center\">
<TD>No.</TD>
<TD>ว/ด/ป</TD>
<TD>HN</TD>
<TD>ชื่อ-สกุล</TD>
<TD>แพทย์</TD>
<TD>Dx</TD>
<TD>Opertion</TD>
	<TD>ประเภท ผป.เข้าห้องผ่าตัด</TD>
	<TD>ประเภทผู้ป่วย</TD>
	<TD>ประเภทแผลผ่าตัด</TD>
	<TD>สิทธิ์ผู้ป่วย</TD>
	<TD>ห้อง</TD>
	<TD>สายศัลยกรรม</TD>
<TD>เวลาเข้า</TD>
<TD>เวลาออก</TD>
</TR>";
$i=1;
while($arr = mysql_fetch_assoc($result)){


echo "<TR>
				<TD>".$i.".</TD>
				<TD>".$arr["dt2"]."</TD>
				<TD>".$arr["hn"]."</TD>
				<TD>".$arr["ptname"]."</TD>
				<TD>".substr($arr["doctor"],5)."</TD>
				<TD>".$arr["diag"]."</TD>
				<TD>".$arr["opertion"]."</TD>
				<TD>".$cfg_type_case[$arr["type_case"]]."</TD>
				<TD>".$cfg_type_wounded[$arr["type_wounded"]]."</TD>
				<TD>".$cfg_type_scar[$arr["type_scar"]]."</TD>
				<TD>".$cfg_ptright[$arr["ptright"]]."</TD>
				<TD>".$cfg_room[$arr["room"]]."</TD>
				<TD>".$cfg_surgery[$arr["surgery"]]."</TD>
				<TD>".substr($arr["timein"],0,-3)."</TD>
				<TD>".substr($arr["timeout"],0,-3)."</TD>
			</TR>";
$i++;

}
}

include("unconnect.inc");
?>


