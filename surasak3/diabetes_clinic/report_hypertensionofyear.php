<?php
session_start();
require "../connect.php";
require "../includes/functions.php";

// Verify user before load content
if(!authen()) die('����������ҡ����ҹ <a href="login.php">��ԡ�����</a> �����������к��ա����');

require "header.php";

$sql="
CREATE TEMPORARY TABLE `hypertension_history_temp` 
SELECT `thidate`, `hn`, `bp1`, `bp2`, `organ`
FROM `hypertension_history` 
WHERE `thidate` LIKE '2015%'
AND (`bp1` !='' OR `bp2` !='')
";
mysql_query($sql);

$sql="
CREATE TEMPORARY TABLE `opd_temp` 
SELECT `thidate`, `hn`, `bp1`, `bp2`, `organ`
FROM `opd` 
WHERE `thidate` LIKE '2558%'
AND (`bp1` !='' OR `bp2` !='')
";
mysql_query($sql);

$tbsql="
SELECT * FROM `hypertension_clinic` 
WHERE `thidate` BETWEEN '2015-07-01' AND '2015-09-31'
ORDER BY `joint_disease` DESC, `thidate` ASC
";
$tbquery=mysql_query($tbsql);
$tbnum=mysql_num_rows($tbquery);
?> 
<p align="center"><strong>��§ҹ������ HT ��Шӻէ�����ҳ 2558</strong></p>
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
			<div>�����ѹ���Ե 3 �����ش���µԴ��͡ѹ &lt; 130/80 mmHg.</div>
			</strong>
		</td>
		<td width="14%" align="center" bgcolor="#66CC99">
			<strong>
			<div>������ä����</div>
			<div>�����ѹ���Ե 3 �����ش���µԴ��͡ѹ &lt; 140/90 mmHg.</div>
			</strong>
		</td>
		<td width="10%" align="center" bgcolor="#66CC99"><strong>��.�ҵ�Ǩ����Ѵ</strong></td>
	</tr>
<?php
if($tbnum < 1){
	echo "<tr><td colspan='8' align='center' style='color:red;'>------------------------ ����բ����� ------------------------</td></tr>";
}else{
	$i=0;
	while($tbrows=mysql_fetch_array($tbquery)){
		
	$i++;
	$sql=mysql_query("select idguard, camp from opcard where hn='".$tbrows["hn"]."'");
	list($idguard, $camp)=mysql_fetch_array($sql);
	/*		if($camp=="M01 �����͹" && $idguard !="MX01 ����/��ͺ����"){
	$idguard="MX00 �ؤ�ŷ����";
	}*/
	
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
			if($tbrows["joint_disease_dm"]=="Y" || $tbrows["joint_disease_nephritic"]=="Y" || $tbrows["joint_disease_myocardial"]=="Y" || $tbrows["joint_disease_paralysis"]=="Y"){
				
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
			if($tbrows["joint_disease_dm"]=="Y" || $tbrows["joint_disease_nephritic"]=="Y" || $tbrows["joint_disease_myocardial"]=="Y" || $tbrows["joint_disease_paralysis"]=="Y"){
				
				$sql = "
				SELECT thidate, bp1, bp2
				FROM hypertension_history_temp
				WHERE hn = '".$tbrows['hn']."' 
				ORDER  BY thidate DESC LIMIT 3
				";
				$query = mysql_query($sql);
				$rownum = mysql_num_rows($query);
				if( !$rownum ){
					$sql="SELECT thidate, bp1, bp2 
					FROM opd_temp 
					WHERE hn = '".$tbrows["hn"]."' 
					ORDER  BY thidate DESC LIMIT 3";
					
					$query=mysql_query($sql);
					$rownum=mysql_num_rows($query);
				}
				
				if($rownum < 3){
					if($rownum < 1){
						echo "������Ǩ";
					}else{
						echo "��Ǩ���֧ 3 ����";
					}
				}else{ // ����ҵ�Ǩ�Թ >= 3 ����
					$num=0;
					while($rows=mysql_fetch_array($query)){
						if($rows["bp1"] < 130 && $rows["bp2"] < 80){
							$code="y";
							$num++;
						}else{
							$code="n";
						}	
					}  //close while
					
					// �����������ش���¤����ѹ�Թ 130/80
					if($num==3){
						echo "1";
					}else{
						echo "0";
					}
				}
			}
			?>
		</td>
		<td align="center" bgcolor="#CCFFCC">
		<?php
		if($tbrows["joint_disease_dm"]=="" && $tbrows["joint_disease_nephritic"]=="" && $tbrows["joint_disease_myocardial"]=="" && $tbrows["joint_disease_paralysis"]==""){
			
			$sql = "
			SELECT thidate, bp1, bp2
			FROM hypertension_history_temp
			WHERE hn = '".$tbrows['hn']."' 
			ORDER  BY thidate DESC LIMIT 3
			";
			$query = mysql_query($sql);
			$rownum = mysql_num_rows($query);
			if( !$rownum ){
				$sql="SELECT thidate, bp1, bp2 
				FROM opd_temp 
				WHERE hn = '".$tbrows["hn"]."' 
				ORDER  BY thidate DESC LIMIT 3";
				
				$query=mysql_query($sql);
				$rownum=mysql_num_rows($query);
			}
				
			if($rownum < 3){
				if($rownum < 1){
					echo "������Ǩ";
				}else{
					echo "��Ǩ���֧ 3 ����";
				}
			}else{
				$num=0;
				while($rows=mysql_fetch_array($query)){
					if($rows["bp1"] < 140 && $rows["bp2"] < 90){
						$code="y";
						$num++;
					}else{
						$code="n";
					}
				}  //close while
				if($num==3){
					echo "1";
				}else{
					echo "0";
				}
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
			$query=mysql_query($sql);
			$recode=mysql_num_rows($query);
			if(!empty($recode)){
				echo "1";
			}else{
				echo "0";
			}
			?>
		</td>
	</tr>
	<?php
	} // End While
}
?>
<?php
require "footer.php";
?>