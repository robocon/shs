<?php
session_start();
include("../connect.inc");

require "header.php";
?>
<style>
.font_title{
	font-family:"TH SarabunPSK"; 
	font-size:25px;
}
.tb_font{
	font-family:"TH SarabunPSK";
	font-size:24px;
	color: #09F;
}
.tb_font_1{
	font-family:"TH SarabunPSK"; 
	font-size:24px; 
	color:#FFFFFF;
	font-weight:bold;
}
.tb_col{
	font-family:"TH SarabunPSK"; 
	font-size:24px;
	background-color:#9FFF9F;
}
.tb_font_2 {
	font-family: "TH SarabunPSK";
	color: #B00000;
	font-size: 22px;
	font-weight: bold;
}

.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
	color: #FFF;
}
.forntsarabun1 {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}


.tb-lite td,th{
	padding: 4px 6px;
	text-align: right;
}
.tb-lite th{
	background-color: #572d6f;
	color: #ffffff;
}
.tb-lite a{
	text-decoration: none;
}
.tb-lite a:hover{
	text-decoration: underline;
}
.tb-lite .text_center{
	text-align: center;
}
</style>
<form action="" method="post">
	<TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#FFFFCE" >
		<TR>
			<TD>
				<TABLE border="0" cellpadding="0" cellspacing="0">
					<TR>
						<TD align="center" bgcolor="#572d6f" class="forntsarabun">กรอกหมายเลข HN</TD>
					</TR>
					<TR>
						<TD class="tb_font">
							<input name="p_hn" type="text" class="forntsarabun1" id="p_hn"  value="<?php echo $_POST["p_hn"];?>"/>&nbsp;<input name="Submit" type="submit" class="forntsarabun1" value="ตกลง" />
						</TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
	</TABLE>
</form>
<?php

// $hn = filter_input(INPUT_POST, 'p_hn');
$hn = (string) $_POST['p_hn'];
if($hn != null){
	require "../connect.inc";
	
	$sql = sprintf("SELECT * FROM `diabetes_clinic_history` WHERE `hn` = '%s'", $hn);
	$query = mysql_query($sql);
	$row = mysql_num_rows($query);
	
	if($row === false OR $row === 0){
		echo "ยังไม่มีประวัติของผู้ป่วย HN $hn";
		exit;
	}
	?>
	<br>
	<table border="1" cellspacing="0" cellpadding="0"  bordercolor="#000000" class="tb-lite">
		<tr>
			<th>วันที่ลงทะเบียน</th>
			<th>วันที่บันทึกข้อมูล</th>
			<th>BS</th>
			<th>HbA1c</th>
			<th>LDL</th>
			<th>SBP</th>
			<th>DBP</th>
			<th>ดูรายละเอียด</th>
			<th>แก้ไขข้อมูล</th>
		</tr>
	<?php
	while($item = mysql_fetch_assoc($query)){
		
		list($y, $m, $d) = explode('-', $item['thidate']);
		$th_date = ($y+543)."-$m-$d";
		
		list($yn, $mn, $dn) = explode('-', $item['dateN']);
		$th_daten = ($yn+543)."-$mn-$dn";
		?>
		<tr>
			<td><?php echo $th_date ;?></td>
			<td><?php echo $th_daten;?></td>
			<td><?php echo ( $item['l_bs'] != '' ) ? $item['l_bs'] : '-' ; ?></td>
			<td><?php echo ( $item['l_hbalc'] != '' ) ? $item['l_hbalc'] : '-' ; ?></td>
			<td><?php echo ( $item['l_ldl'] != '' ) ? $item['l_ldl'] : '-' ; ?></td>
			<td><?php echo ( $item['bp1'] != '' ) ? $item['bp1'] : '-' ; ?></td>
			<td><?php echo ( $item['bp2'] != '' ) ? $item['bp2'] : '-' ; ?></td>
			<td class="text_center"><a href="full_detail.php?id=<?php echo $item['row_id'];?>" target="_blank">ดู</a></td>
			<td class="text_center"><a href="edit_detail.php?id=<?php echo $item['row_id'];?>">แก้ไข</a></td>
		</tr>
		<?php
	}
	?>
	</table>
	<?php
}
require "footer.php";
?>