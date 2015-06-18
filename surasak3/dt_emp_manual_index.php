<?php 
error_reporting(0);
ini_set('display_errors', 0);
header('Content-Type: text/html; charset=tis-620');
session_start();
include 'connect.inc';
mysql_query("SET NAMES TIS620");
// mysql_query("SET NAMES UTF8");
?>
<html>
<head>
<title>โปรแกรมตรวจสุขภาพลูกจ้าง</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}

.tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_detail {background-color: #FFFFC1;  }
.tb_detail2 {background-color: #FFFFFF;  }

-->
</style>
<SCRIPT LANGUAGE="JavaScript">

window.onload = function(){
	
	document.form_vn.vn_now.focus();

}

</SCRIPT>
</head>
</body>
<a href='../nindex.htm'>&lt;&lt;ไปเมนู</a>
<BR>
<table width="100%" border="0">
  <tr>
    <td>
<FORM name="form_vn" METHOD=POST ACTION="dt_emp_manual_index.php?hn=<?php echo $_GET['hn']?>">
<input name="act" type="hidden" value="show">
<TABLE width="319">
<TR>
	<TD>
		<TABLE>
		<TR>
			<TD width="65"><strong>HN : </strong></TD>
			<TD width="160"><INPUT TYPE="text" NAME="hn_now" value="<?php echo $_GET['hn'];?>"></TD>
			<TD width="70">&nbsp;</TD>
		</TR>
		<TR>
			<TD><strong>แพทย์ : </strong></TD>
			<TD>
	<?php
	
	// ค้นหา doctor จาก hn
	$sql = sprintf("SELECT `doctor` FROM `dxofyear_emp` WHERE `hn` = '%s'", $_GET['hn']);
	// var_dump($sql);
	$query = mysql_query($sql);
	$user_doctor = mysql_fetch_assoc($query);
	
	// แสดงรายการ doctor
	$strSQL = "SELECT name FROM doctor  where status='y' order by name "; 
	$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
	// var_dump($objQuery);
	// var_dump($user_doctor);
	// exit;
	?>
	<select name="doctor" id="doctor"> 
	<?php
	while($objResult = mysql_fetch_assoc($objQuery)) {
		
		$selected = $user_doctor['doctor']==$objResult['name'] ? 'selected="selected"' : '' ;
		?>
		<option value="<?=$objResult["name"]?>" <?php echo $selected;?> ><?=$objResult["name"]?></option>
		<?php
	}
	?>
	</select>
</TD>
			<TD>&nbsp;</TD>
		</TR>
		<TR>
		  <TD>&nbsp;</TD>
		  <TD><INPUT TYPE="submit" value="ตกลง"></TD>
		  <TD>&nbsp;</TD>
		  </TR>
		</TABLE>
	</TD>
</TR>
</TABLE>
</FORM>
</td>
    <td align="right">&nbsp;</td>
  </tr>
</table>
<?php
if($_POST["act"]=="show"){
	
	// Check employee
	$sql = sprintf("SELECT `employee` FROM `opcard` WHERE `hn`='%s'", $_POST['hn_now']);
	$q = mysql_query($sql);
	$item = mysql_fetch_assoc($q);
	if($item['employee'] !== 'y'){
		echo 'ไม่ใช่ลูกจ้างโรงพยาบาล';
		exit;
	}
	
$sql = sprintf("SELECT * FROM `dxofyear_emp` WHERE `hn`='%s'", $_POST['hn_now']);
$query = mysql_query($sql);
	?>
	<table width="60%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
	  <tr>
		<td width="6%" align="center" bgcolor="#66CC99"><strong>#</strong></td>
		<td width="19%" align="center" bgcolor="#66CC99"><strong>วัน/เดือน/ปี</strong></td>
		<td width="14%" align="center" bgcolor="#66CC99"><strong>HN</strong></td>
		<td width="29%" align="center" bgcolor="#66CC99"><strong>ชื่อสกุล</strong></td>
		<td width="32%" align="center" bgcolor="#66CC99"><strong>ชื่อหน่วยงาน</strong></td>
	  </tr>
	<?php
	if(mysql_num_rows($query) < 1){
		echo "<tr><td colspan='5' align='center'>----------------------------- ไม่มีข้อมูล -----------------------------</td></tr>";
	}
	
	$i=0;
	while($rows = mysql_fetch_array($query)){
		
		$i++;
		?>  
	  <tr>
		<td align="center"><?=$i;?></td>
		<td align="center"><?=$rows["thidate"];?></td>
		<td align="center"><a href="dxdr_ofyear_empsoldier.php?hn_now=<?=$rows["hn"];?>&doctor=<?=$_POST["doctor"];?>&thidate=<?=$rows["thidate"];?>"><?=$rows["hn"];?></a></td>
		<td><?=$rows["ptname"];?></td>
		<td><?=$rows["camp"];?></td>
	  </tr>
		<?php
	}
	?>
</table>

<?php
}
?>
</body>

<?php include("unconnect.inc");?>
</html>
