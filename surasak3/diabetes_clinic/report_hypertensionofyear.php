<?php 
session_start();
require "../connect.php";
require "../includes/functions.php";

// Verify user before load content
if(authen() === false ){ die('Session ������� <a href="../login_page.php">��ԡ�����</a> ���ͷӡ���������к��ա����'); }

require "header.php";

$this_year = ( date('Y') + 543 );
$year_chk = get_year_checkup(true, 'th');

if( $this_year === $year_chk ){
	$default_start = ($year_chk - 1).'-10-01';
	$default_end = $year_chk.'-09-30';
}else{
	$default_start = $year_chk.'-10-01';
	$default_end = ( $year_chk + 1 ).'-09-30';
}

list($y, $m, $d) = explode('-', $default_start);

?>
<form action="report_hypertensionofyear.php" method="post" style="font-family: 'TH SarabunPSK'; font-size: 18pt;">
	<p><b>���͡����ʴ��ŵ����ǧ����</b></p>
	<div>
		�ѹ���������� <input type="text" name="date_start" value="<?=$default_start;?>">
	</div>
	<div>
		�ѹ����ش <input type="text" name="date_end" value="<?=$default_end;?>">
	</div>
	<div>
		<button type"submit">�ʴ���</button>
		<input type="hidden" name="action" value="">
	</div>
</form>
<?php

$start = bc_to_ad(input('date_start', $default_start));
$end = bc_to_ad(input('date_end', $default_end));
$yAd = bc_to_ad($y);

$sql = "CREATE TEMPORARY TABLE `hypertension_history_temp` 
SELECT `thidate`, `hn`, `bp1`, `bp2`, `organ`
FROM `hypertension_history` 
WHERE `thidate` LIKE '$yAd%'
AND (`bp1` !='' OR `bp2` !='')";
mysql_query($sql);

$sql = "CREATE TEMPORARY TABLE `opd_temp` 
SELECT `thidate`, `hn`, `bp1`, `bp2`, `organ`
FROM `opd` 
WHERE `thidate` LIKE '$y%'
AND (`bp1` !='' OR `bp2` !='')";
mysql_query($sql);

$tbsql = "SELECT * FROM `hypertension_clinic` 
WHERE `thidate` BETWEEN '$start' AND '$end'
ORDER BY `joint_disease` DESC, `thidate` ASC";
$tbquery = mysql_query($tbsql);
$tbnum = mysql_num_rows($tbquery);

?>
<p align="center"><strong>��§ҹ������ HT ��Шӻէ�����ҳ <?=$y;?></strong></p>
<table width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
	<tr>
		<td width="3%" align="center" bgcolor="#66CC99"><strong>�ӴѺ</strong></td>
		<td width="5%" align="center" bgcolor="#66CC99"><strong>HN</strong></td>
		<td width="13%" align="center" bgcolor="#66CC99"><strong>����-���ʡ��</strong></td>
		<td width="15%" align="center" bgcolor="#66CC99"><strong>�Է�ԡ���ѡ��</strong></td>
		<td width="13%" align="center" bgcolor="#66CC99"><strong>������</strong></td>
		<td width="15%" align="center" bgcolor="#66CC99"><strong>�ä���� HT </strong></td>
		<td width="14%" align="center" bgcolor="#66CC99">
			<strong>
			<div>���ä����</div>
			<div>�����ѹ���Ե 2 �����ش���µԴ��͡ѹ &lt; 140/80 mmHg.</div>
			</strong>
		</td>
		<td width="14%" align="center" bgcolor="#66CC99">
			<strong>
			<div>������ä����</div>
			<div>�����ѹ���Ե 2 �����ش���µԴ��͡ѹ &lt; 140/90 mmHg.</div>
			</strong>
		</td>
		<td width="10%" align="center" bgcolor="#66CC99"><strong>��.�ҵ�Ǩ����Ѵ</strong></td>
	</tr>
<?php 
if($tbnum < 1){
	echo "<tr><td colspan='8' align='center' style='color:red;'>------------------------ ����բ����� ------------------------</td></tr>";
}else{
	$i = 0;
	while($tbrows = mysql_fetch_array($tbquery)){
		
	$i++;
	$sql=mysql_query("select idguard, camp from opcard where hn='".$tbrows["hn"]."'");
	list($idguard, $camp)=mysql_fetch_array($sql);
	$test_guard = preg_match('/MX.+/', $idguard);
	?>
	<tr>
		<td align="center" bgcolor="#CCFFCC"><?=$i;?></td>
		<td align="left" bgcolor="#CCFFCC"><?=$tbrows["hn"];?></td>
		<td align="left" bgcolor="#CCFFCC"><?=$tbrows["ptname"];?></td>
		<td align="left" bgcolor="#CCFFCC"><?=$tbrows["ptright"];?></td>  
		<td align="left" bgcolor="#CCFFCC"><?php if( $test_guard > 0 ) echo $idguard;?></td>
		<td align="left" bgcolor="#CCFFCC">
			<?php 			
			/* �ä���� HT */
			if($tbrows["joint_disease_dm"]=="Y" 
			|| $tbrows["joint_disease_nephritic"]=="Y" 
			|| $tbrows["joint_disease_myocardial"]=="Y" 
			|| $tbrows["joint_disease_paralysis"]=="Y"){
				
				$joint_disease_list = array();
				if($tbrows["joint_disease_dm"]=="Y"){
					$joint_disease_list[] = "����ҹ";
				}
				if($tbrows["joint_disease_nephritic"]=="Y"){
					$joint_disease_list[] = "�������ѧ";
				}
				if($tbrows["joint_disease_myocardial"]=="Y"){
					$joint_disease_list[] = "������������㨵��";
				}
				if($tbrows["joint_disease_paralysis"]=="Y"){
					$joint_disease_list[] = "����ġ������ҵ";
				}	
				
				echo '���ä���� ('.implode(',', $joint_disease_list).')';
				
			}else{
				echo '������ä����';
			}
			?>
		</td>
		<td align="center" bgcolor="#CCFFCC">
			<?php 
			// �����ѹ���Ե 2 �����ش���µԴ��͡ѹ < 140/80 mmHg.
			// ���ä����
			if($tbrows["joint_disease_dm"]=="Y" 
			|| $tbrows["joint_disease_nephritic"]=="Y" 
			|| $tbrows["joint_disease_myocardial"]=="Y" 
			|| $tbrows["joint_disease_paralysis"]=="Y"){
				
				$sql = "SELECT thidate, bp1, bp2
				FROM hypertension_history_temp
				WHERE hn = '".$tbrows['hn']."' 
				ORDER  BY thidate DESC LIMIT 2";
				$query = mysql_query($sql);
				$rownum = mysql_num_rows($query);
				
				if( !$rownum ){ // �������դ��� ht ���Ҥ�Ҩҡ opd
					$sql="SELECT thidate, bp1, bp2 
					FROM opd_temp 
					WHERE hn = '".$tbrows["hn"]."' 
					ORDER  BY thidate DESC LIMIT 2";
					$query = mysql_query($sql);
					$rownum = mysql_num_rows($query);
				}
				
				if($rownum < 2){
					echo ( $rownum < 1 ) ? '������Ǩ' : '��Ǩ���֧ 2 ����' ;
					
				}else{ // ����ҵ�Ǩ�Թ >= 2 ����
					$num = 0;
					while($rows = mysql_fetch_array($query)){
						if($rows["bp1"] < 140 && $rows["bp2"] < 80){
							$code = "y";
							$num++;
						}else{
							$code = "n";
						}	
					}  //close while
					
					// ��� 2 �����ش���¤����ѹ�Թ 140/80
					echo ( $num == 2 ) ? '1' : '0' ;
				}
			}
			?>
		</td>
		<td align="center" bgcolor="#CCFFCC">
		<?php 
		// �����ѹ���Ե 2 �����ش���µԴ��͡ѹ &lt; 140/90 mmHg.
		// ������ä����
		if($tbrows["joint_disease_dm"]=="" 
		&& $tbrows["joint_disease_nephritic"]=="" 
		&& $tbrows["joint_disease_myocardial"]=="" 
		&& $tbrows["joint_disease_paralysis"]==""){
			
			$sql = "SELECT thidate, bp1, bp2
			FROM hypertension_history_temp
			WHERE hn = '".$tbrows['hn']."' 
			ORDER  BY thidate DESC LIMIT 2";
			$query = mysql_query($sql);
			$rownum = mysql_num_rows($query);
			
			if( !$rownum ){
				$sql="SELECT thidate, bp1, bp2 
				FROM opd_temp 
				WHERE hn = '".$tbrows["hn"]."' 
				ORDER  BY thidate DESC LIMIT 2";
				$query = mysql_query($sql);
				$rownum = mysql_num_rows($query);
			}
				
			if($rownum < 2){
				echo ( $rownum < 1 ) ? '������Ǩ' : '��Ǩ���֧ 2 ����' ;
			}else{
				$num = 0;
				while($rows = mysql_fetch_array($query)){
					if($rows["bp1"] < 140 && $rows["bp2"] < 90){
						$code = "y";
						$num++;
					}else{
						$code = "n";
					}
				}  //close while
				
				echo ( $num == 2 ) ? '1' : '0' ;
			}
		}
		?>
		</td>
		<td align="center" bgcolor="#CCFFCC">
			<?php 
			$sql="
			SELECT thidate, bp1, bp2, organ 
			FROM opd_temp 
			WHERE hn = '".$tbrows["hn"]."' 
			AND organ like '%��Ǩ����Ѵ%' 
			ORDER  BY thidate DESC LIMIT 1";
			$query = mysql_query($sql);
			$recode = mysql_num_rows($query);
			if(!empty($recode)){
				echo "1";
			}else{
				echo "0";
			}
			?>
		</td>
	</tr>
	<?php 	} // End While
}
require "footer.php";