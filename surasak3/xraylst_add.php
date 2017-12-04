
<?php
 include("connect.inc");   
	$month["01"] = "มกราคม";
    $month["02"] = "กุมภาพันธ์";
    $month["03"] = "มีนาคม";
    $month["04"] = "เมษายน";
    $month["05"] = "พฤษภาคม";
    $month["06"] = "มิถุนายน";
    $month["07"] = "กรกฏาคม";
    $month["08"] = "สิงหาคม";
    $month["09"] = "กันยายน";
    $month["10"] = "ตุลาคม";
    $month["11"] = "พฤศจิกายน";
    $month["12"] = "ธันวาคม";
	
	
	$sql = "SELECT * FROM doctor WHERE status<>'n' ";
	$rs = mysql_query($sql) or die(mysql_error());
	$row_rs = mysql_fetch_assoc($rs);
	$totalrows_rs = mysql_num_rows($rs);
	
	$doctor = array();
	for($i=0;$i<$totalrows_rs;$i++){
		
		$doctors[$i] = $row_rs['name'];
		$row_rs = mysql_fetch_assoc($rs);
	}
	//print_r($doctors);
	
	
?>
<SCRIPT LANGUAGE="JavaScript">

	function checkForm(){
		if(document.xraylst_add.hn.value==""){
			alert("กรุณาใส่ข้อมูล 'HN' ด้วยครับ ");
			return false;
		}else	if(document.xraylst_add.detail_edit.value==""){
			alert("กรุณาใส่ข้อมูล 'ตรวจ' ด้วยครับ ");
			return false;
		}else if((document.xraylst_add.digital.value=="" || document.xraylst_add.digital.value=="0") && (document.xraylst_add.add10_12.value=="" || document.xraylst_add.add10_12.value=="0") && (document.xraylst_add.add14_14.value=="" || document.xraylst_add.add14_14.value=="0") && (document.xraylst_add.addnone.value=="" || document.xraylst_add.addnone.value=="0")){
			alert("กรุณาใส่จำนวนของฟิล์ม  ด้วยครับ ");
			return false;
		}

	}

</SCRIPT>
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>


<TABLE border='1' align="center" cellpadding="0" cellspacing="0" bordercolor="#003F7D" class="tb_search">
<TR>
	<TD>
<form name="xraylst_add" action="xraylst.php" method="post"  onsubmit="return checkForm();">
<table border="0" cellpadding="0" cellspacing="0" align="center" >
<tr>
  <td colspan="2" align="center" bgcolor="#003F7D"><span class="style1">เพิ่มข้อมูล สถิติฟิล์ม</span></td>
  </tr>
<tr>
<td align="right">ว/ด/ป&nbsp;:&nbsp;</td>
<td><TABLE id="f_search" >
<TR>
	<TD align="right"></TD>
	<TD>
		<INPUT style="width:30px;" TYPE="text" NAME="start_day" value="<?php echo date("d");?>" size="2" maxlength="2"> / 
		<SELECT  NAME="start_month" style="width:100px;">
		<?php
		foreach($month as $value => $index){
			echo "<OPTION VALUE=\"",$value,"\" ";
			 if(date("m") == $value) echo " Selected ";
			echo ">",$index;
			
			}	?>
		</SELECT> / 
		<INPUT TYPE="text" NAME="start_year" style="width:50px;" value="<?php echo date("Y")+543;?>"  size="4" maxlength="4">	</TD>
</TR>
</TABLE></td>
</tr>

<tr>
<td align="right">HN&nbsp;:&nbsp;</td>
<td><input name="hn" id="hn" type="text"/></td>
</tr>


<tr>
<td align="right">ตรวจ&nbsp;:&nbsp;</td>
<td>

  <textarea name="detail" cols="50" rows="8" id="detail"></textarea><BR>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  ตัวช่วย : <select name="detail_h" Onchange="document.getElementById('detail').value=this.value;">
  <option value="">-- ตัวช่วย --</option>
  <?php
	$sql = "Select * From xraylist  where xraytype ='0' ";
	$result = mysql_query($sql);
	while($arr = mysql_fetch_assoc($result)){
		echo "<option value='".$arr["xraycode"]."'>".$arr["xraycode"]."</Ooptin>";
	}
  ?>
  </select>  </td>
</tr>
<tr>
<td align="right">แพทย์ผู้สั่ง&nbsp;:&nbsp;</td>
<td>
<select name="doctor">
<?php
foreach($doctors as $doctor){
?>
<option value="<?php echo $doctor;?>">
<?php echo $doctor;?></option>
<?php } ?>
</select></td>
</tr>
<tr>
<td align="right">Digital&nbsp;:&nbsp;</td>
<td><input name="digital" type="text" id="digital" size="3" maxlength="3" value="0"/></td>
</tr>
<tr>
<td align="right">10X12&nbsp;:&nbsp;</td>
<td><input name="add10_12" type="text" id="add10_12" size="3" maxlength="3" value="0"/></td>
</tr>
<tr>
<td align="right">14X14&nbsp;:&nbsp;</td>
<td><input name="add14_14" type="text" id="add14_14" size="3" maxlength="3" value="0"/></td>
</tr>
<tr>
<td align="right">NONE&nbsp;:&nbsp;</td>
<td><input name="addnone" type="text" id="none" size="3" maxlength="3" value="0"/></td>
</tr>
<tr>
  <td align="right">ฟิล์มเสีย</td>
  <td><input name="filmbk" type="text" id="none2" size="3" maxlength="3" value="0"/></td>
</tr>
<tr>
<td align="right">หมายเหตุ</td>
<td><input name="remark" id="remark" type="text"/></td>
</tr>
<tr>
<td align="center" colspan="2"><INPUT TYPE="submit" value="เพิ่มข้อมูล"></td>
</tr>
</table>
<INPUT TYPE="hidden" name="Submit_add" value="1">
<input name="patien_from" id="patien_from" type="hidden" value="OPD"/>
</form>
</TD>
</TR>
</TABLE>