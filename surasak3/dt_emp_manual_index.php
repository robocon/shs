<?php
session_start();
error_reporting(0);
ini_set('display_errors', 0);
header('Content-Type: text/html; charset=tis-620');

include 'connect.php';

?>
<html>
<head>
<title>โปรแกรมตรวจสุขภาพลูกจ้าง</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<style type="text/css">
	body,td,th {
		font-family: TH SarabunPSK;
		font-size: 18px;
	}
	.tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
	.tb_detail {background-color: #FFFFC1;  }
	.tb_detail2 {background-color: #FFFFFF;  }
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
		<FORM name="form_vn" METHOD="POST" ACTION="dt_emp_manual_index.php?hn=<?php echo $_GET['hn']?>">
			<TABLE width="800">
				<TR>
					<TD>
						<TABLE>
						<TR>
							<TD width="100"><strong>HN : </strong></TD>
							<TD width="160"><INPUT TYPE="text" NAME="hn_now" value="<?php echo $_GET['hn'];?>"></TD>
							<TD width="100">&nbsp;</TD>
						</TR>
						<!-- ถ้าเป็นแพทย์คีย์ HN ผ่านไปได้เลย -->
						<?php
						if( $_SESSION['smenucode'] == 'ADMDR1' OR $_SESSION['smenucode'] == 'ADMDR' ){

							$sql  = "SELECT CONCAT(b.`yot`,a.`name`) AS `doctor_name` 
							FROM `inputm` AS a 
							LEFT JOIN `doctor` AS b ON b.`doctorcode` = a.`codedoctor` 
							WHERE a.`row_id` = '".$_SESSION['sRowid']."' ";
							$q = mysql_query($sql) or die( mysql_error() );
							$dt = mysql_fetch_assoc($q);

						?>
						<input type="hidden" name="doctor" value="<?=$dt['doctor_name'];?>">
						<?php

						}else{
						?>
						<TR>
							<TD><strong>เลือกแพทย์ : </strong></TD>
							<TD>
								<?php 
								
								// หาว่าเป็น DR
								$strSQL = "SELECT CONCAT(a.`yot`,b.`name`) AS `doctor_name`,a.`doctorcode`, b.`name` 
								FROM `doctor` AS a 
								LEFT JOIN `inputm` AS b ON b.`codedoctor` = a.`doctorcode`
								WHERE a.`status` = 'y' 
								AND a.`menucode` = 'ADM' 
								AND ( 
									a.`doctorcode` IS NOT NULL 
									AND a.`doctorcode` != '00000' 
									AND a.`doctorcode` != '0000' 
								) 
								AND ( b.`name` NOT REGEXP '^HD' AND b.`name` NOT REGEXP '^NID' ) 
								ORDER BY a.`row_id` ";

								// แสดงรายการ doctor
								$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
								?>
								<select name="doctor" id="doctor"> 
								<?php
								while($objResult = mysql_fetch_array($objQuery)){
									$selected = ( $objResult['doctorcode'] == $codedoctor ) ? 'selected="selected"' : '' ;
									?>
									<option value="<?=$objResult["doctor_name"]?>" <?=$selected;?> ><?=$objResult["name"]?></option>
									<?php
								}
								?>
								</select>
							</TD>
							<TD>&nbsp;</TD>
						</TR>
						<?php
						}
						?>
						
						<TR>
							<TD>&nbsp;</TD>
							<TD>
								<INPUT TYPE="submit" value="ตกลง">
								<input name="act" type="hidden" value="show">
							</TD>
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
if( $_POST["act"] == "show" ){
	
	$hn_now = trim($_POST['hn_now']);
	$_SESSION['doctor'] = $_POST['doctor'];

	// ตัวเดิมเป็น dxofyear_emp
	$query = mysql_query("SELECT * FROM `dxofyear_out` WHERE `hn`='$hn_now' ORDER BY `row_id` DESC ");

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
			echo "<tr><td colspan='5' align='center'>---------- ไม่มีข้อมูลซักประวัติ ----------</td></tr>";
		}

		$i=0;
		while($rows = mysql_fetch_array($query)){

			$i++;
			$href = 'doctor_pre_chk.php?thidate='.$rows['thidate'].'&hn='.$rows['hn'].'&vn='.$rows['vn'];
			?>  
			<tr>
				<td align="center"><?=$i;?></td>
				<td align="center"><?=$rows["thidate"];?></td>
				<td align="center">
					<a href="<?=$href;?>" ><?=$rows["hn"];?></a>
				</td>
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
