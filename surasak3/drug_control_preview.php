<?php
session_start();
include("connect.inc");

// �硡�͹�����¡���˹������Ţ�Ҩ�ԧ� ���Ǻ�ҧ
// ͹حҵ����� 0
$cont = $_POST['sump'];
$test_real_item = 0;
for ($i=1; $i <= $cont; $i++) { 
	$drug_import =  $_POST['import'.$i];
	if( $drug_import !== '' ){
		++$test_real_item;
	}
}

if( $test_real_item === 0 ){
	echo '��س����͡�����ҧ���� 1��¡��<br><a href="javascript:window.close()">��Ѻ</a>';
	exit;
}

?>
<style type="text/css">
<!--
.font2 {
	font-family: AngsanaUPC;
	font-size:20px;
}
-->
</style>
<span class="font2">
<strong>��¡���ҷ���ԡ <br>
*��ͧ���������Դ˹�ҵ�ҧ���*</strong>
</span>
<form action="drugimport.php" method="post" name="form1" id="form1" >
  <table width="100%" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse" class="font2">
    <tr>
      <td width="4%" rowspan="2" align="center">�ӴѺ</td>
      <td width="13%" rowspan="2" align="center">Drugcode</td>
      <td width="32%" rowspan="2" align="center">Tradname</td>
      <td width="6%" rowspan="2" align="center">Min</td>
      <td width="5%" rowspan="2" align="center">Max</td>
      <td width="6%" rowspan="2" align="center">��ͧ����</td>
      <td width="5%" rowspan="2" align="center">��ѧ</td>
      <td width="6%" rowspan="2" align="center">������</td>
      <td colspan="2" align="center">�ӹǹ</td>
      <td width="7%" rowspan="2" align="center">�����˵�</td>
    </tr>
    <tr>
      <td width="8%" align="center">���ԡ</td>
      <td width="8%" align="center">���¨�ԧ</td>
    </tr>
	<?php
	for($p=1; $p<=$cont; $p++){
		if( $_POST['import'.$p] != "" OR $_POST['import'.$p] != 0 ){
			
			$sel2 = "SELECT a.*, b.`min` AS `new_min`, b.`max` AS `new_max`
			FROM `druglst` AS a 
			RIGHT JOIN `drug_control_user` AS b ON b.`drugcode` = a.`drugcode` 
			WHERE a.`drugcode` = '".$_POST['drx'.$p]."' 
			AND b.`username` = '".$_SESSION['sOfficer']."' ";

			$row2 = mysql_query($sel2);
			$result2 = mysql_fetch_array($row2);
			$r++;
			?>
			<tr>
				<td align="center"><?=$r?></td>
				<td>
					<input type="hidden" name="drx<?=$r?>" value="<?=$_POST['drx'.$p]?>" /><?=$_POST['drx'.$p]?>
				</td>
				<td>
					<?=$result2['tradname']?>
					<input type="hidden" name="tname<?=$r;?>" value="<?=$result2['tradname']?>">
				</td>
				<td align="center"><?=$result2['new_min']?></td>
				<td align="center"><?=$result2['new_max']?></td>
				<td align="center"><?=$result2['stock']?></td>
				<td align="center"><?=$result2['mainstk']?></td>
				<td align="center">
					<input name="rxdrug<?=$r?>" type="hidden" id='rxdrug<?=$r?>' value="<?=$_POST['rxdrug'.$p]?>"; />
					<?=$_POST['rxdrug'.$p]?>
				</td>
				<td align="center">
					<input name="import<?=$r?>" type="hidden" id='import<?=$r?>' value="<?=$_POST['import'.$p]?>" />
					<?=$_POST['import'.$p]?>
				</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<?php
		}
	}
	?>
    <tr>
      <td colspan="11" align="center">
      <input type="hidden" name="sump" value="<?=$r?>" />
		<?php
		// ੾����ͧ�Ҩ������ԡ����������
		$smenucode = trim($_SESSION['smenucode']);
		if( $smenucode === 'ADMPHA' 
			OR $smenucode === 'ADMPHARX' 
			OR $smenucode === 'ADMPHA'
			OR $smenucode === 'ADM' 
		){
			?>
			<input type="submit" name="save" id="save" value="��ԡ���" />
			<?php
		}
		?>
		<button id="shsBtn">�ѹ�֡��о������ԡ����</button>
    </td>
    </tr>
  </table>
</form>
<script type="text/javascript" src="js/vendor/jquery-1.11.2.min.js"></script>
<script type="text/javascript">
	$(function(){

		// ��ԡ����
		if( $('#shsBtn').length > 0 ){
			$(document).on('click', '#shsBtn', function(e){
				e.preventDefault();
				$('#form1').attr({
					action:'drug_bill_lading.php', 
					target: '_blank'
				}).submit();
				return false;
			});
		}

		// ��ԡ���
		if( $('#save').length > 0 ){
			$(document).on('click', '#save', function(e){
				e.preventDefault();
				$('#form1').attr({
					action:'drugimport.php', 
					target: '_blank'
				}).submit();
				return false;
			});
		}
	});
</script>