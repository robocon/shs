<?php
session_start();

error_reporting(1);
ini_set('display_errors', 1);

require "../connect.php";
require "../includes/functions.php";
	
// require 'header.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : null ;
if($id == null){
	echo "�������ö���Ң�������";
	exit;
}

$sql = sprintf("SELECT * FROM `hypertension_history` WHERE `id` = '%s';", $id);
$query = mysql_query($sql);
$row = mysql_num_rows($query);
if($row > 0){
	$item = mysql_fetch_assoc($query);
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
		 font-weight:bold;}
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
</style>

	<TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#FFFFCE" >
		<TR>
			<TD>
				<TABLE border="0" cellpadding="0" cellspacing="0">
					<TR>
						<TD align="left" bgcolor="#0000CC" class="tb_font_1">&nbsp;<span class="forntsarabun">&nbsp;&nbsp;�����ż�����</span></TD>
					</TR>
					<TR>
						<TD>
							<table border="0">
								<tr>
									<td align="right" class="tb_font_2">�ѹ���ŧ����¹: </td>
									<td><span class="forntsarabun1"><?php echo $item['thidate'];?></span></td>
									<td colspan="2" class="tb_font_2"></td>
								</tr>
								<tr>
									<td align="right" class="tb_font_2">HT number:</td>
									<td><span class="forntsarabun1"><?php echo $item['ht_no'];?></span></td>
									<td align="right"><span class="tb_font_2">HN :</span></td>
									<td align="left" class="forntsarabun1"><?php echo $item["hn"];?></td>
								</tr>
								<tr>
									<td  align="right"><span class="tb_font_2">����-ʡ��: </span></td>
									<td class="forntsarabun1"><?php echo $item["ptname"];?></td>
									<td  align="right" class="tb_font_2">���� :</td>
									<td align="left" class="forntsarabun1"><?php echo $item["age_str"];?></td>
								</tr>
								<tr class="forntsarabun1">
									<td  align="right" class="tb_font_2">�� :</td>
									<td >
									<?php
									if($item['sex']=='0'){ 
										$sex="���"; 
									}elseif($item['sex']=='1'){ 
										$sex="˭ԧ"; 
									}
									echo $sex;
									?>
									</td>
									<td  align="right" class="tb_font_2">&nbsp;</td>
									<td align="left"></td>
								</tr>
								<tr>
									<td align="right" class="tb_font_2">ᾷ�� :</td>
									<td class="forntsarabun1"><?php echo $item['doctor']; ?></td>
									<td align="right" class="tb_font_2">�Է�� :</td>
									<td align="left" class="forntsarabun1"><?php echo $item["ptright"];?></td>
								</tr>
							</table>
	<?php 
	$ht = $item['height']/100;
	$bmi=number_format($item['weight'] /($ht*$ht),2);
	?>
	<table border="0" class="forntsarabun1">
		<TR>
			<TD align="left" bgcolor="#0000CC" class="tb_font_1" colspan="12">&nbsp;<span class="forntsarabun">&nbsp;&nbsp;��õ�Ǩ��ҧ���</span></TD>
		</TR>
		<tr>
			<td width="70" align="right" class="tb_font_2">��ǹ�٧ : </td>
			<td><?php echo $item['height'];?> ��.</td>
			<td width="70" align="right" class="tb_font_2">���˹ѡ : </td>
			<td ><?php echo $item['weight'];?>��. </td>
			<td width="70" align="right" class="tb_font_2">BMI :</td>
			<td><?php echo $bmi;?></td>
			<td width="70" align="right" class="tb_font_2">&nbsp;</td>
			<td><span class="tb_font_2">�ͺ��� : </span></td>
			<td><?php echo !empty($item["round"]) ? $item["round"] : '-' ;?> ��.</td>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td align="right" class="tb_font_2">T : </td>
			<td><?php echo !empty($item["temperature"]) ? $item["temperature"] : '-' ; ?> C&deg;</td>
			<td align="right" class="tb_font_2">P : </td>
			<td ><?php echo $item["pause"]; ?> ����/�ҷ�</td>
			<td align="right" class="tb_font_2">R :</td>
			<td class="forntsarabun1"><?php echo $item["rate"]; ?></td>
			<td>����/�ҷ�</td>
			<td><span class="tb_font_2">BP :</span></td>
			<td align="right"><?php echo $item["bp1"]; ?> / <?php echo $item["bp2"]; ?> mmHg</td>
			<td>&nbsp;</td>
			<td align="right" class="tb_font_2">&nbsp;</td>
			<td></td>
		</tr>
	</table>
	<TABLE class="forntsarabun1">
	<tr>
	<td align="right" class="tb_font_2">����ԹԨ��� : </td>
	<td colspan="5" align="left" class="forntsarabun1">
		<?php
		if($item['ht'] == '1'){
			echo 'Essential HT';
		}else if($item['ht'] == '2'){
			echo 'Uncertain type';
		}else if($item['ht'] == '3'){
			echo 'Secondary HT';
		}else{
			echo 'No';
		}
		?>
	</td>
	</tr>
	<tr>
		<td align="right" class="tb_font_2">&nbsp;</td>
		<td colspan="5" align="left" class="forntsarabun1">&nbsp;</td>
	</tr>
	<tr>
		<td align="right" class="tb_font_2">�ä���� HT :</td>
		<td colspan="5" align="left" class="forntsarabun1">
			<?php
			$disease = array();
			if($item['joint_disease_dm'] == 'Y'){
				$disease[] = '����ҹ';
			}
			if($item['joint_disease_nephritic'] == 'Y'){
				$disease[] = '�������ѧ';
			}
			if($item['joint_disease_myocardial'] == 'Y'){
				$disease[] = '������������㨵��';
			}
			if($item['joint_disease_paralysis'] == 'Y'){
				$disease[] = '����ġ������ҵ';
			}
			
			if(!empty($disease)){
				echo implode(', ', $disease);
			}else{
				echo ' - ';
			}
			?>
		</td>
	</tr>
	<tr>
		<td align="right" class="tb_font_2">&nbsp;</td>
		<td colspan="5" align="left" class="forntsarabun1">&nbsp;</td>
	</tr>
	<tr>
		<td align="right"  class="tb_font_2"> ����ѵԺ����� : </td>
		<td colspan="5">
			<?php
			if($item['smork'] == '1'){
				echo '�ٺ������';
			}else if($item['smork'] == '0'){
				echo '����ٺ������';
			}else{
				echo 'NA';
			}
			?>
		</td>
	</tr>
	</TABLE>
	</td>
	</tr>
	</table></td>
	</tr>
	</table>

	</TD>
	</TR>
	</TABLE>
	</TD>
	</TR>
	</TABLE>

<?php
}else{
	echo "�������ö���Ң�������";
}

// require 'footer.php';