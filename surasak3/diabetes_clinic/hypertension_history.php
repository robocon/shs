<?php 	
session_start();

error_reporting(1);
ini_set('display_errors', 1);

require "../connect.php";
require "../includes/functions.php";
	
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

<?php $hn = isset($_POST['p_hn']) ? trim($_POST['p_hn']) : ( isset($_GET['hn']) ? trim($_GET['hn']) : null ) ; ?>

<h1 class="forntsarabun1">ค้นหาประวัติผู้ป่วย Hypertension</h1>
<form action="" method="post">
	<table border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#FFFFCE" >
		<tr>
			<td>
				<table border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td align="center" bgcolor="#572d6f" class="forntsarabun">กรอกหมายเลข HN</td>
					</tr>
					<tr>
						<td class="tb_font">
							<input name="p_hn" type="text" class="forntsarabun1" id="p_hn"  value="<?php echo $hn;?>"/>&nbsp;<input name="Submit" type="submit" class="forntsarabun1" value="ตกลง" />
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</form>
<?php $sql = "SELECT `ptname` FROM `opday` WHERE `hn` = '$hn';";
$q = mysql_query($sql);
$item = mysql_fetch_assoc($q);

if($hn !== null){
	$sql = sprintf("SELECT * FROM `hypertension_history` WHERE `hn` = '%s' ORDER BY `id` DESC;", $hn);
	$query = mysql_query($sql);
	$row = mysql_num_rows($query);
	
	if($row === false OR $row === 0){
		echo "ยังไม่มีประวัติของผู้ป่วย HN $hn <br>";
		exit;
	}
	?>
	<br>
	<p><?php echo $item['ptname'];?></p>
	<table border="1" cellspacing="0" cellpadding="0"  bordercolor="#000000" class="tb-lite">
		<tr>
			<th>วันที่ลงทะเบียน</th>
			<th>วันที่บันทึกข้อมูล</th>
			<th>SBP</th>
			<th>DBP</th>
			<th>ดูรายละเอียด</th>
			<th>แก้ไขข้อมูล</th>
		</tr>
	<?php 	while($item = mysql_fetch_assoc($query)){
		
		list($y, $m, $d) = explode('-', $item['thidate']);
		$th_date = ($y+543)."-$m-$d";
		
		list($yn, $mn, $dn) = explode('-', $item['dateN']);
		$th_daten = ($yn+543)."-$mn-$dn";
		?>
		<tr>
			<td><?php echo $th_date ;?></td>
			<td><?php echo $th_daten;?></td>
			<td><?php echo ( $item['bp1'] != '' ) ? $item['bp1'] : '-' ; ?></td>
			<td><?php echo ( $item['bp2'] != '' ) ? $item['bp2'] : '-' ; ?></td>
			<td class="text_center"><a href="hypertension_detail.php?id=<?php echo $item['id'];?>" target="_blank">ดู</a></td>
			<td class="text_center"><a href="hypertension_edithistory.php?id=<?php echo $item['id'];?>">แก้ไข</a></td>
		</tr>
		<?php 	}
	?>
	</table>
	<?php }
	
include 'footer.php';	
?>