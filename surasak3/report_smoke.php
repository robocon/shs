<?php
if( !function_exists('session_start') ){ session_start(); }

if( !function_exists('dump') ){
	function dump($str){
		echo "<pre>";
		var_dump($str);
		echo "</pre>";
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
<!--
body,td,th,button{
	font-family: TH SarabunPSK;
	font-size: 18px;
}
.show_user{
	cursor: pointer;
	text-decoration: none;
}
.show_user:hover{
	text-decoration: underline;
}
@media print{
	.not-show{
		display: none;
	}
}
table{
	margin: 10px 0;
}
h3{
	margin: 0;
}
-->
</style></head>
<body>
<?php
include("connect.inc");
?>
<a href ="../nindex.htm" class="not-show">&lt;&lt; ˹����ѡ������ç��Һ�Ť���</a></p>
<?php
$def_year = (date('Y') + 543);
$year_select = ( isset($_POST['year_select']) ) ? trim($_POST['year_select']) : $def_year ;
?>
<div class="not-show" style="padding: 10px 0;">
	<div>
		<h3>���͡����ʴ��ŵ����</h3>
	</div>
	<form action="report_smoke.php" method="post">
		<div>
			<label for="year_select">���͡��: </label>
			<input type="text" id="year_select" name="year_select" value="<?=$year_select;?>">
		</div>
		<div>
			<button type="submit">�ʴ���</button>
			<input type="hidden" name="show" value="item">
		</div>
	</form>
</div>
<?php
$show = ( isset($_POST['show']) ) ? trim($_POST['show']) : false ;
if( $show === 'item' ){
	?>
	<h3>��§ҹ�����ԡ��������ä������ѧ�觵�� ICD10 ��<?=$year_select;?></h3>
	<table width="90%" border="0" align="left" cellpadding="0" cellspacing="0">
	<tr>
		<td>
			<?php
			// �����ŷ���������ѹ������͡ ���Ǥ������� reduce ����ѧ
			$sql = "DROP TEMPORARY TABLE IF EXISTS `opd_tmp`;";
			mysql_query($sql) or die ( mysql_error() );

			$sql = "CREATE TEMPORARY TABLE `opd_tmp`
			SELECT MAX(`row_id`) AS `id` 
			FROM `opd` 
			WHERE `thidate` LIKE '$year_select%' 
			GROUP BY `hn` 
			ORDER BY `hn`";
			mysql_query($sql) or die ( mysql_error() );
			// End pre reduce
			
			$sql = "SELECT a.`thidate`, a.`hn` , a.`cigarette` , a.`cigok` , c.`icd10` 
			FROM `opd` AS a 
			RIGHT JOIN opd_tmp AS b ON b.`id` = a.`row_id`
			INNER JOIN `opday` AS c ON c.`thdatehn` = a.`thdatehn`
			WHERE c.`icd10` LIKE  'J44%' 
			ORDER BY a.`row_id` ASC";
			$query1 = mysql_query($sql) or die ( mysql_error() );
			$num1 = mysql_num_rows($query1);
			
			$cigarette0 = 0;
			$cigarette1 = 0;
			$cigarette2 = 0;
			$cigok0 = 0;
			$cigok1 = 0;
			
			while($rows1=mysql_fetch_array($query1)){
				if($rows1["cigarette"]=="" || $rows1["cigarette"]=="0"){  //����ٺ
					$cigarette0++;
				}else if($rows1["cigarette"]=="1"){  //�ٺ
					$cigarette1++;
					if( $rows1["cigok"]=="0" OR empty($rows1["cigok"]) ){  //�����ҡ��ԡ
						$cigok0++;
					}else if($rows1["cigok"]=="1"){  //��ҡ��ԡ
						$cigok1++;
					}
				}else if($rows1["cigarette"]=="2"){  //���ٺ
					$cigarette2++;
				}
			}
			?>
			<table width="40%" border="1" align="left" cellpadding="3" cellspacing="0" bordercolor="#000000">
				<tr>
					<td colspan="2" align="center" bgcolor="#CCCCCC"><strong>COPD (J44)</strong></td>
				</tr>
				<tr>
					<td><strong>������</strong></td>
					<td align="right"><?=$num1;?></td>
				</tr>
				<tr>
					<td width="38%"><strong>1. ����ٺ������</strong></td>
					<td width="62%" align="right"><?=$cigarette0;?></td>
				</tr>
				<tr>
					<td><strong>2. ���ٺ������</strong></td>
					<td align="right"><?=$cigarette2;?></td>
				</tr>
				<tr>
					<td><strong>3. �ٺ������</strong></td>
					<td align="right">
						<div>
							<?=$cigarette1;?>
						</div>
					</td>
				</tr>
				<tr>
					<td><strong>&nbsp;&nbsp;3.1 ��ҡ��ԡ</strong></td>
					<td align="right"><?=$cigok1;?></td>
				</tr>
				<tr>
					<td><strong>&nbsp;&nbsp;3.2 �����ҡ��ԡ</strong></td>
					<td align="right"><?=$cigok0;?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<?php
			$sql = "SELECT a.`thidate`, a.`hn`, a.`ptname` , a.`cigarette` , a.`cigok` , c.`icd10`, d.`phone`
			FROM `opd` AS a 
			RIGHT JOIN opd_tmp AS b ON b.`id` = a.`row_id`
			INNER JOIN `opday` AS c ON c.`thdatehn` = a.`thdatehn` 
			INNER JOIN `opcard` AS d ON d.`hn` = a.`hn`
			WHERE a.`cigarette` = 1 
			AND c.`icd10` LIKE  'J44%'
			ORDER BY a.`row_id` ASC";
			
			$query = mysql_query($sql);
			$rows = mysql_num_rows($query);
			if( $rows > 0 ){
				?>
				<br>
				<h3 style="margin: 0;">��ª��� COPD ����ٺ������</h3>
				<table width="40%" border="1" align="left" cellpadding="3" cellspacing="0" bordercolor="#000000">
					<thead>
						<tr>
							<th>#</th>
							<th>HN</th>
							<th>����ʡ��</th>
							<th>������</th>
							<th>ICD10</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$i = 1;
					while ( $item = mysql_fetch_assoc($query) ) {
					?>
						<tr>
							<td><?=$i;?></td>
							<td><?=$item['hn'];?></td>
							<td><?=$item['ptname'];?></td>
							<td><?=$item['phone'];?></td>
							<td><?=$item['icd10'];?></td>
						</tr>
					<?php
						$i++;
					}
					?>
					</tbody>
				</table>
				<?php
			}
			?>
		</td>
	</tr>
	<tr>
		<td>
			<?php
			$sql = "SELECT a.`thidate`, a.`hn` , a.`cigarette` , a.`cigok` , c.`icd10` 
			FROM `opd` AS a 
			RIGHT JOIN opd_tmp AS b ON b.`id` = a.`row_id`
			INNER JOIN `opday` AS c ON c.`thdatehn` = a.`thdatehn`
			WHERE ( c.`icd10` LIKE 'A15%' OR c.`icd10` LIKE 'A16%' ) 
			ORDER BY a.`row_id` ASC";
			$query2=mysql_query($sql) or die ("Query Error");
			$num2=mysql_num_rows($query2);
			$cigarette0=0;
			$cigarette1=0;
			$cigarette2=0;
			$cigok0=0;
			$cigok1=0;
			
			while($rows2=mysql_fetch_array($query2)){
				if($rows2["cigarette"]=="" || $rows2["cigarette"]=="0"){  //����ٺ
					$cigarette0++;
				}else if($rows2["cigarette"]=="1"){  //�ٺ
					$cigarette1++;
					if( $rows2["cigok"]=="0" OR empty($rows2["cigok"]) ){  //�����ҡ��ԡ
						$cigok0++;
					}else if($rows2["cigok"]=="1"){  //��ҡ��ԡ
						$cigok1++;
					}
				}else if($rows2["cigarette"]=="2"){  //���ٺ
					$cigarette2++;
				}
			}
			?>
			<table width="40%" border="1" align="left" cellpadding="3" cellspacing="0" bordercolor="#000000">
				<tr>
					<td colspan="2" align="center" bgcolor="#CCCCCC"><strong>TB (A15, A16)</strong></td>
				</tr>
				<tr>
					<td><strong>������</strong></td>
					<td align="right"><?=$num2;?></td>
				</tr>
				<tr>
					<td width="38%"><strong>1. ����ٺ������</strong></td>
					<td width="62%" align="right"><?=$cigarette0;?></td>
				</tr>
				<tr>
					<td><strong>2. ���ٺ������</strong></td>
					<td align="right"><?=$cigarette2;?></td>
				</tr>
				<tr>
					<td><strong>3. �ٺ������</strong></td>
					<td align="right"><?=$cigarette1;?></td>
				</tr>
				<tr>
					<td><strong>&nbsp;&nbsp;3.1 ��ҡ��ԡ</strong></td>
					<td align="right"><?=$cigok1;?></td>
				</tr>
				<tr>
					<td><strong>&nbsp;&nbsp;3.2 �����ҡ��ԡ</strong></td>
					<td align="right"><?=$cigok0;?></td>
				</tr>
			</table>
		</td>
	</tr>
	</tr>
		<td>
			<?php
			$sql = "SELECT a.`thidate`, a.`hn` , a.`cigarette` , a.`cigok` , c.`icd10` 
			FROM `opd` AS a 
			RIGHT JOIN opd_tmp AS b ON b.`id` = a.`row_id`
			INNER JOIN `opday` AS c ON c.`thdatehn` = a.`thdatehn`
			WHERE ( c.`icd10` LIKE 'I10%' OR c.`icd10` LIKE 'I251%' ) 
			ORDER BY a.`row_id` ASC";
			$query3=mysql_query($sql) or die ( mysql_error() );
			$num3=mysql_num_rows($query3);
			$cigarette0=0;
			$cigarette1=0;
			$cigarette2=0;
			$cigok0=0;
			$cigok1=0;
			
			while($rows3=mysql_fetch_array($query3)){
				if($rows3["cigarette"]=="" || $rows3["cigarette"]=="0"){  //����ٺ
					$cigarette0++;
				}else if($rows3["cigarette"]=="1"){  //�ٺ
					$cigarette1++;
					if($rows3["cigok"]=="0" OR empty($rows3["cigok"]) ){  //�����ҡ��ԡ
						$cigok0++;
					}else if($rows3["cigok"]=="1"){  //��ҡ��ԡ
						$cigok1++;
					}
				}else if($rows3["cigarette"]=="2"){  //���ٺ
					$cigarette2++;
				}
			}
			?>
			<table width="40%" border="1" align="left" cellpadding="3" cellspacing="0" bordercolor="#000000">
				<tr>
					<td colspan="2" align="center" bgcolor="#CCCCCC"><strong>����, HT, CAD (I10, I251)</strong></td>
				</tr>
				<tr>
					<td><strong>������</strong></td>
					<td align="right"><?=$num3;?></td>
				</tr>
				<tr>
					<td width="38%"><strong>1. ����ٺ������</strong></td>
					<td width="62%" align="right"><?=$cigarette0;?></td>
				</tr>
				<tr>
					<td><strong>2. ���ٺ������</strong></td>
					<td align="right"><?=$cigarette2;?></td>
				</tr>
				<tr>
					<td><strong>3. �ٺ������</strong></td>
					<td align="right"><?=$cigarette1;?></td>
				</tr>
				<tr>
					<td><strong>&nbsp;&nbsp;3.1 ��ҡ��ԡ</strong></td>
					<td align="right">
						<div>
							<?=$cigok1;?>
						</div>
					</td>
				</tr>
				<tr>
					<td><strong>&nbsp;&nbsp;3.2 �����ҡ��ԡ</strong></td>
					<td align="right"><?=$cigok0;?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<?php
			$sql = "SELECT a.`thidate`, a.`hn`, a.`ptname` , a.`cigarette` , a.`cigok` , c.`icd10`, d.`phone`
			FROM `opd` AS a 
			RIGHT JOIN opd_tmp AS b ON b.`id` = a.`row_id`
			INNER JOIN `opday` AS c ON c.`thdatehn` = a.`thdatehn` 
			INNER JOIN `opcard` AS d ON d.`hn` = a.`hn`
			WHERE a.`cigok` = 1 
			AND ( c.`icd10` LIKE 'I10%' OR c.`icd10` LIKE 'I251%' ) 
			ORDER BY a.`row_id` ASC";
			
			$query = mysql_query($sql);
			$rows = mysql_num_rows($query);
			if( $rows > 0 ){
				?>
				<br>
				<h3 style="margin: 0;">��ª��� ����, HT, CAD �����ҡ��ԡ������</h3>
				<table width="40%" border="1" align="left" cellpadding="3" cellspacing="0" bordercolor="#000000">
					<thead>
						<tr>
							<th>#</th>
							<th>HN</th>
							<th>����ʡ��</th>
							<th>������</th>
							<th>ICD10</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$i = 1;
					while ( $item = mysql_fetch_assoc($query) ) {
					?>
						<tr>
							<td><?=$i;?></td>
							<td><?=$item['hn'];?></td>
							<td><?=$item['ptname'];?></td>
							<td><?=$item['phone'];?></td>
							<td><?=$item['icd10'];?></td>
						</tr>
					<?php
						$i++;
					}
					?>
					</tbody>
				</table>
				<?php
			}
			?>
		</td>
	</tr>
	<tr>
		<td>
			<?php
			$sql = "SELECT a.`thidate`, a.`hn` , a.`cigarette` , a.`cigok` , c.`icd10` 
			FROM `opd` AS a 
			RIGHT JOIN opd_tmp AS b ON b.`id` = a.`row_id`
			INNER JOIN `opday` AS c ON c.`thdatehn` = a.`thdatehn`
			WHERE (c.`icd10` LIKE 'I61%' OR c.`icd10` LIKE 'I63%' OR c.`icd10` LIKE 'I64%' OR c.`icd10` LIKE 'I69%') 
			ORDER BY a.`row_id` ASC";
			$query4=mysql_query($sql) or die ( mysql_error() );
			$num4=mysql_num_rows($query4);
			$cigarette0=0;
			$cigarette1=0;
			$cigarette2=0;
			$cigok0=0;
			$cigok1=0;
			
			while($rows4=mysql_fetch_array($query4)){
				if($rows4["cigarette"]=="" || $rows4["cigarette"]=="0"){  //����ٺ
					$cigarette0++;
				}else if($rows4["cigarette"]=="1"){  //�ٺ
					$cigarette1++;
					if($rows4["cigok"]=="0" OR empty($rows4["cigok"]) ){  //�����ҡ��ԡ
						$cigok0++;
					}else if($rows4["cigok"]=="1"){  //��ҡ��ԡ
						$cigok1++;
					}
				}else if($rows4["cigarette"]=="2"){  //���ٺ
					$cigarette2++;
				}
			}
			?>
			<table width="40%" border="1" align="left" cellpadding="3" cellspacing="0" bordercolor="#000000">
				<tr>
					<td colspan="2" align="center" bgcolor="#CCCCCC"><strong>��ͧ Stroke (I61, I63, I64, I69)</strong></td>
				</tr>
				<tr>
					<td><strong>������</strong></td>
					<td align="right"><?=$num4;?></td>
				</tr>
				<tr>
					<td width="38%"><strong>1. ����ٺ������</strong></td>
					<td width="62%" align="right"><?=$cigarette0;?></td>
				</tr>
				<tr>
					<td><strong>2. ���ٺ������</strong></td>
					<td align="right"><?=$cigarette2;?></td>
				</tr>
				<tr>
					<td><strong>3. �ٺ������</strong></td>
					<td align="right"><?=$cigarette1;?></td>
				</tr>
				<tr>
					<td><strong>&nbsp;&nbsp;3.1 ��ҡ��ԡ</strong></td>
					<td align="right">
						<div>
							<?=$cigok1;?>
						</div>
					</td>
				</tr>
				<tr>
					<td><strong>&nbsp;&nbsp;3.2 �����ҡ��ԡ</strong></td>
					<td align="right"><?=$cigok0;?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<?php
			$sql = "SELECT a.`thidate`, a.`hn`, a.`ptname` , a.`cigarette` , a.`cigok` , c.`icd10`, d.`phone`
			FROM `opd` AS a 
			RIGHT JOIN opd_tmp AS b ON b.`id` = a.`row_id`
			INNER JOIN `opday` AS c ON c.`thdatehn` = a.`thdatehn` 
			INNER JOIN `opcard` AS d ON d.`hn` = a.`hn`
			WHERE a.`cigok` = 1 
			AND (c.`icd10` LIKE 'I61%' OR c.`icd10` LIKE 'I63%' OR c.`icd10` LIKE 'I64%' OR c.`icd10` LIKE 'I69%') 
			ORDER BY a.`row_id` ASC";
			
			$query = mysql_query($sql);
			$rows = mysql_num_rows($query);
			if( $rows > 0 ){
				?>
				<br>
				<h3 style="margin: 0;">��ª��� ��ͧ Stroke �����ҡ��ԡ������</h3>
				<table width="40%" border="1" align="left" cellpadding="3" cellspacing="0" bordercolor="#000000">
					<thead>
						<tr>
							<th>#</th>
							<th>HN</th>
							<th>����ʡ��</th>
							<th>������</th>
							<th>ICD10</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$i = 1;
					while ( $item = mysql_fetch_assoc($query) ) {
					?>
						<tr>
							<td><?=$i;?></td>
							<td><?=$item['hn'];?></td>
							<td><?=$item['ptname'];?></td>
							<td><?=$item['phone'];?></td>
							<td><?=$item['icd10'];?></td>
						</tr>
					<?php
						$i++;
					}
					?>
					</tbody>
				</table>
				<?php
			}
			?>
		</td>
	</tr>
	<tr>
		<td>
			<?php
			$sql = "SELECT a.`thidate`, a.`hn` , a.`cigarette` , a.`cigok` , c.`icd10` 
			FROM `opd` AS a 
			RIGHT JOIN opd_tmp AS b ON b.`id` = a.`row_id`
			INNER JOIN `opday` AS c ON c.`thdatehn` = a.`thdatehn`
			WHERE (c.`icd10` LIKE 'E10%' OR c.`icd10` LIKE 'E11%' OR c.`icd10` LIKE 'E14%') 
			ORDER BY a.`row_id` ASC";
			$query5=mysql_query($sql) or die ( mysql_error() );
			$num5=mysql_num_rows($query5);
			$cigarette0=0;
			$cigarette1=0;
			$cigarette2=0;
			$cigok0=0;
			$cigok1=0;
			
			while($rows5=mysql_fetch_array($query5)){
				if($rows5["cigarette"]=="" || $rows5["cigarette"]=="0"){  //����ٺ
					$cigarette0++;
				}else if($rows5["cigarette"]=="1"){  //�ٺ
					$cigarette1++;
					if($rows5["cigok"]=="0" OR empty($rows5["cigok"]) ){  //�����ҡ��ԡ
						$cigok0++;
					}else if($rows5["cigok"]=="1"){  //��ҡ��ԡ
						$cigok1++;
					}
				}else if($rows5["cigarette"]=="2"){  //���ٺ
					$cigarette2++;
				}
			}
			?>
			<table width="40%" border="1" align="left" cellpadding="3" cellspacing="0" bordercolor="#000000">
				<tr>
					<td colspan="2" align="center" bgcolor="#CCCCCC"><strong>����ҹ (E10, E11, E14)</strong></td>
				</tr>
				<tr>
					<td><strong>������</strong></td>
					<td align="right"><?=$num5;?></td>
				</tr>
				<tr>
					<td width="38%"><strong>1. ����ٺ������</strong></td>
					<td width="62%" align="right"><?=$cigarette0;?></td>
				</tr>
				<tr>
					<td><strong>2. ���ٺ������</strong></td>
					<td align="right"><?=$cigarette2;?></td>
				</tr>
				<tr>
					<td><strong>3. �ٺ������</strong></td>
					<td align="right"><?=$cigarette1;?></td>
				</tr>
				<tr>
					<td><strong>&nbsp;&nbsp;3.1 ��ҡ��ԡ</strong></td>
					<td align="right">
						<div>
							<?=$cigok1;?>
						</div>
					</td>
				</tr>
				<tr>
					<td><strong>&nbsp;&nbsp;3.2 �����ҡ��ԡ</strong></td>
					<td align="right"><?=$cigok0;?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<?php
			$sql = "SELECT a.`thidate`, a.`hn`, a.`ptname` , a.`cigarette` , a.`cigok` , c.`icd10`, d.`phone`
			FROM `opd` AS a 
			RIGHT JOIN opd_tmp AS b ON b.`id` = a.`row_id`
			INNER JOIN `opday` AS c ON c.`thdatehn` = a.`thdatehn` 
			INNER JOIN `opcard` AS d ON d.`hn` = a.`hn`
			WHERE a.`cigok` = 1 
			AND (c.`icd10` LIKE 'E10%' OR c.`icd10` LIKE 'E11%' OR c.`icd10` LIKE 'E14%') 
			ORDER BY a.`row_id` ASC";
			
			$query = mysql_query($sql);
			$rows = mysql_num_rows($query);
			if( $rows > 0 ){
				?>
				<br>
				<h3 style="margin: 0;">��ª��� ����ҹ �����ҡ��ԡ������</h3>
				<table width="40%" border="1" align="left" cellpadding="3" cellspacing="0" bordercolor="#000000">
					<thead>
						<tr>
							<th>#</th>
							<th>HN</th>
							<th>����ʡ��</th>
							<th>������</th>
							<th>ICD10</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$i = 1;
					while ( $item = mysql_fetch_assoc($query) ) {
					?>
						<tr>
							<td><?=$i;?></td>
							<td><?=$item['hn'];?></td>
							<td><?=$item['ptname'];?></td>
							<td><?=$item['phone'];?></td>
							<td><?=$item['icd10'];?></td>
						</tr>
					<?php
						$i++;
					}
					?>
					</tbody>
				</table>
				<?php
			}
			?>
		</td>
	</tr>
	<tr>
		<td>
			<?php
			$sql = "SELECT a.`thidate`, a.`hn` , a.`cigarette` , a.`cigok` , c.`icd10` 
			FROM `opd` AS a 
			RIGHT JOIN opd_tmp AS b ON b.`id` = a.`row_id`
			INNER JOIN `opday` AS c ON c.`thdatehn` = a.`thdatehn`
			WHERE (c.`icd10` LIKE 'F10%' OR c.`icd10` LIKE 'F20%' OR c.`icd10` LIKE 'F32%' OR c.`icd10` LIKE 'F41%') 
			ORDER BY a.`row_id` ASC";
			$query6=mysql_query($sql)or die ( mysql_error() );
			$num6=mysql_num_rows($query6);
			$cigarette0=0;
			$cigarette1=0;
			$cigarette2=0;
			$cigok0=0;
			$cigok1=0;
			
			while($rows6=mysql_fetch_array($query6)){
				if($rows6["cigarette"]=="" || $rows6["cigarette"]=="0"){  //����ٺ
					$cigarette0++;
				}else if($rows6["cigarette"]=="1"){  //�ٺ
					$cigarette1++;
					if($rows6["cigok"]=="0" OR empty($rows6["cigok"]) ){  //�����ҡ��ԡ
						$cigok0++;
					}else if($rows6["cigok"]=="1"){  //��ҡ��ԡ
						$cigok1++;
					}
				}else if($rows6["cigarette"]=="2"){  //���ٺ
					$cigarette2++;
				}
			}
			?>
			<table width="40%" border="1" align="left" cellpadding="3" cellspacing="0" bordercolor="#000000">
				<tr>
					<td colspan="2" align="center" bgcolor="#CCCCCC"><strong>�Ե�Ǫ (F10, F20, F32, F41)</strong></td>
				</tr>
				<tr>
					<td><strong>������</strong></td>
					<td align="right"><?=$num6;?></td>
				</tr>
				<tr>
					<td width="38%"><strong>1. ����ٺ������</strong></td>
					<td width="62%" align="right"><?=$cigarette0;?></td>
				</tr>
				<tr>
					<td><strong>2. ���ٺ������</strong></td>
					<td align="right"><?=$cigarette2;?></td>
				</tr>
				<tr>
					<td><strong>3. �ٺ������</strong></td>
					<td align="right"><?=$cigarette1;?></td>
				</tr>
				<tr>
					<td><strong>&nbsp;&nbsp;3.1 ��ҡ��ԡ</strong></td>
					<td align="right">
						<div>
							<?=$cigok1;?>
						</div>
					</td>
				</tr>
				<tr>
					<td><strong>&nbsp;&nbsp;3.2 �����ҡ��ԡ</strong></td>
					<td align="right"><?=$cigok0;?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<?php
			$sql = "SELECT a.`thidate`, a.`hn`, a.`ptname` , a.`cigarette` , a.`cigok` , c.`icd10`, d.`phone`
			FROM `opd` AS a 
			RIGHT JOIN opd_tmp AS b ON b.`id` = a.`row_id`
			INNER JOIN `opday` AS c ON c.`thdatehn` = a.`thdatehn` 
			INNER JOIN `opcard` AS d ON d.`hn` = a.`hn`
			WHERE a.`cigok` = 1 
			AND (c.`icd10` LIKE 'F10%' OR c.`icd10` LIKE 'F20%' OR c.`icd10` LIKE 'F32%' OR c.`icd10` LIKE 'F41%') 
			ORDER BY a.`row_id` ASC";
			
			$query = mysql_query($sql);
			$rows = mysql_num_rows($query);
			if( $rows > 0 ){
				?>
				<br>
				<h3 style="margin: 0;">��ª��� �Ե�Ǫ �����ҡ��ԡ������</h3>
				<table width="40%" border="1" align="left" cellpadding="3" cellspacing="0" bordercolor="#000000">
					<thead>
						<tr>
							<th>#</th>
							<th>HN</th>
							<th>����ʡ��</th>
							<th>������</th>
							<th>ICD10</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$i = 1;
					while ( $item = mysql_fetch_assoc($query) ) {
					?>
						<tr>
							<td><?=$i;?></td>
							<td><?=$item['hn'];?></td>
							<td><?=$item['ptname'];?></td>
							<td><?=$item['phone'];?></td>
							<td><?=$item['icd10'];?></td>
						</tr>
					<?php
						$i++;
					}
					?>
					</tbody>
				</table>
				<?php
			}
			?>
		</td>
	</tr>
	</table>
	<?php
}
?>
</body>
</html>
