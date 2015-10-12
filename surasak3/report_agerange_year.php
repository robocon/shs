<?php
include 'bootstrap.php';
$db = Mysql::load();

$months = array( '01' => '�.�.', '02' => '�.�.', '03' => '��.�', '04' => '��.�.', '05' => '�.�.', '06' => '��.�.', '07' => '�.�.', '08' => '�.�.', '09' => '�.�.', '10' => '�.�.', '11' => '�.�.', '12' => '�.�.' );			
?>
<html>
	<head>
		<title>��§ҹ�����¹͡�觵���Է�����Ъ�ǧ����</title>
	</head>
	<body>
		<link type="text/css" href="templates/classic/default.css" rel="stylesheet" />
		<style>
			@media print{
				body{
					padding-left: 10px;
				}
			}
			body{
				font-size:12px;
			}
		</style>
		<div class="col width-fill mobile-width-fill no-print">
            <div class="cell">
                <ul class="col nav">
                    <li class="active"><a href="../nindex.htm">˹����ѡ����� SHS</a></li>
					<li class="active"><a href="report_agerange.php">��Ẻ�����͹</a></li>
					<li class="active"><a href="report_agerange_year.php">��Ẻ��»�</a></li>
                </ul>
            </div>
        </div>
		<h3>��§ҹ�����¹͡�觵���Է�����Ъ�ǧ����</h3>
		<div class="no-print">
			<form action="report_agerange_year.php" method="post">
				<span>���͡��</span>
				<select name="year">
					<option value="2555">2555</option>
					<option value="2556">2556</option>
					<option value="2557">2557</option>
					<option value="2558">2558</option>
					<option value="2559">2559</option>
				</select>
				
				<button type="submit">�ʴ�����§ҹ</button>
			</form>
		</div>
		<div>
			<?php
			$select_year = isset($_POST['year']) ? $_POST['year'] : false ;
			if( $select_year !== false ){
					
				$sql = "CREATE TEMPORARY TABLE opday_temp 
				SELECT a.`hn`,a.`thidate`,a.`ptright`, LEFT(b.`ptright`,3) AS `code`, TIMESTAMPDIFF(YEAR, b.`dbirth`, CONCAT( ( YEAR( NOW() ) + 543 ), DATE_FORMAT( NOW(), '-%m-%d %H:%i:%s' ) ) ) AS age 
				FROM `opday` AS a LEFT JOIN `opcard` AS b ON b.`hn`=a.`hn`
				WHERE a.`thidate` LIKE '$select_year%';
				";
				$db->select($sql);
			?>
			<table>
				<thead>
					<tr>
						<th rowspan="2" width="15%">��Ǫ���Ѵ</th>
						<th colspan="<?php echo count($months);?>">��Шӻ� <?php echo $select_year;?></th>
					</tr>
					<tr>
					<?php
						foreach($months as $month){
							?><th><?php echo $month;?></th><?php
						}
					?>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>�Է����Թʴ</td>
						<?php
						$sql = "
						SELECT COUNT(`hn`) AS `rows`,DATE_FORMAT( `thidate`, '%Y-%m' ) AS `month` FROM opday_temp 
						WHERE `age` > 0 AND `code` = 'R01'
						GROUP BY MONTH(`thidate`);
						";
						$db->select($sql);
						$items = $db->get_items();
						
						$new_list = array();
						foreach($items as $key => $item){
							$new_list[$item['month']] = $item['rows'];
						}
						
						foreach($months as $key => $month){
							$find_key = "$select_year-$key";
							$val = $new_list[$find_key];
							?><td align="right"><?php echo $val;?></td><?php
						}
						?>
					</tr>
					<tr>
						<td>�Է�Ԩ��µç</td>
						<?php
						$sql = "
						SELECT COUNT(`hn`) AS `rows`,DATE_FORMAT( `thidate`, '%Y-%m' ) AS `month` FROM opday_temp 
						WHERE `age` > 0 AND `code` = 'R03'
						GROUP BY MONTH(`thidate`);
						";
						$db->select($sql);
						$items = $db->get_items();
						
						$new_list = array();
						foreach($items as $key => $item){
							$new_list[$item['month']] = $item['rows'];
						}
						
						foreach($months as $key => $month){
							$find_key = "$select_year-$key";
							$val = $new_list[$find_key];
							?><td align="right"><?php echo $val;?></td><?php
						}
						?>
					</tr>
					<tr>
						<td>�Է�Ի�Сѹ�ѧ��</td>
						<?php
						$sql = "
						SELECT COUNT(`hn`) AS `rows`,DATE_FORMAT( `thidate`, '%Y-%m' ) AS `month` FROM opday_temp 
						WHERE `age` > 0 AND `code` = 'R07'
						GROUP BY MONTH(`thidate`);
						";
						$db->select($sql);
						$items = $db->get_items();
						
						$new_list = array();
						foreach($items as $key => $item){
							$new_list[$item['month']] = $item['rows'];
						}
						
						foreach($months as $key => $month){
							$find_key = "$select_year-$key";
							$val = $new_list[$find_key];
							?><td align="right"><?php echo $val;?></td><?php
						}
						?>
					</tr>
					<tr>
						<td>�Է�� 30 �ҷ</td>
						<?php
						$sql = "
						SELECT COUNT(`hn`) AS `rows`,DATE_FORMAT( `thidate`, '%Y-%m' ) AS `month` FROM opday_temp 
						WHERE `age` > 0 AND ( `code` = 'R09' OR `code` = 'R10' OR `code` = 'R11' OR `code` = 'R12' OR `code` = 'R13' OR `code` = 'R14' OR `code` = 'R15' OR `code` = 'R35' )
						GROUP BY MONTH(`thidate`);
						";
						$db->select($sql);
						$items = $db->get_items();
						
						$new_list = array();
						foreach($items as $key => $item){
							$new_list[$item['month']] = $item['rows'];
						}
						
						foreach($months as $key => $month){
							$find_key = "$select_year-$key";
							$val = $new_list[$find_key];
							?><td align="right"><?php echo $val;?></td><?php
						}
						?>
					</tr>
					<tr>
						<td>�Է��ͻ�.</td>
						<?php
						$sql = "
						SELECT COUNT(`hn`) AS `rows`,DATE_FORMAT( `thidate`, '%Y-%m' ) AS `month` FROM opday_temp 
						WHERE `age` > 0 AND `code` = 'R33'
						GROUP BY MONTH(`thidate`);
						";
						$db->select($sql);
						$items = $db->get_items();
						
						$new_list = array();
						foreach($items as $key => $item){
							$new_list[$item['month']] = $item['rows'];
						}
						
						foreach($months as $key => $month){
							$find_key = "$select_year-$key";
							$val = $new_list[$find_key];
							?><td align="right"><?php echo $val;?></td><?php
						}
						?>
					</tr>
					<tr>
						<td>��ǧ���ع��¡��� 10��</td>
						<?php
						$sql = "
						SELECT COUNT(`hn`) AS `rows`,DATE_FORMAT( `thidate`, '%Y-%m' ) AS `month` FROM opday_temp 
						WHERE `code` IN ('R01','R03','R07','R09','R10','R11','R12','R13','R14','R15','R35','R33')
						AND `age` > 0 AND `age` < 10
						GROUP BY MONTH(`thidate`);
						";
						
						$db->select($sql);
						$items = $db->get_items();
						
						$new_list = array();
						foreach($items as $key => $item){
							$new_list[$item['month']] = $item['rows'];
						}
						
						foreach($months as $key => $month){
							$find_key = "$select_year-$key";
							$val = $new_list[$find_key];
							?><td align="right"><?php echo $val;?></td><?php
						}
						?>
					</tr>
					
					<tr>
						<td>��ǧ���������ҧ 10�� �֧ 20��</td>
						<?php
						$sql = "
						SELECT COUNT(`hn`) AS `rows`,DATE_FORMAT( `thidate`, '%Y-%m' ) AS `month` FROM opday_temp 
						WHERE `code` IN ('R01','R03','R07','R09','R10','R11','R12','R13','R14','R15','R35','R33')
						AND `age` >= 10 AND `age` <= 19
						GROUP BY MONTH(`thidate`);
						";
						
						$db->select($sql);
						$items = $db->get_items();
						
						$new_list = array();
						foreach($items as $key => $item){
							$new_list[$item['month']] = $item['rows'];
						}
						
						foreach($months as $key => $month){
							$find_key = "$select_year-$key";
							$val = $new_list[$find_key];
							?><td align="right"><?php echo $val;?></td><?php
						}
						?>
					</tr>
					<tr>
						<td>��ǧ���������ҧ 20�� �֧ 60��</td>
						<?php
						$sql = "
						SELECT COUNT(`hn`) AS `rows`,DATE_FORMAT( `thidate`, '%Y-%m' ) AS `month` FROM opday_temp 
						WHERE `code` IN ('R01','R03','R07','R09','R10','R11','R12','R13','R14','R15','R35','R33')
						AND `age` >= 20 AND `age` <= 60
						GROUP BY MONTH(`thidate`);
						";
						
						$db->select($sql);
						$items = $db->get_items();
						
						$new_list = array();
						foreach($items as $key => $item){
							$new_list[$item['month']] = $item['rows'];
						}
						
						foreach($months as $key => $month){
							$find_key = "$select_year-$key";
							$val = $new_list[$find_key];
							?><td align="right"><?php echo $val;?></td><?php
						}
						?>
					</tr>
					<tr>
						<td>��ǧ�����ҡ���� 60��</td>
						<?php
						$sql = "
						SELECT COUNT(`hn`) AS `rows`,DATE_FORMAT( `thidate`, '%Y-%m' ) AS `month` FROM opday_temp 
						WHERE `code` IN ('R01','R03','R07','R09','R10','R11','R12','R13','R14','R15','R35','R33')
						AND `age` > 60
						GROUP BY MONTH(`thidate`);
						";
						
						$db->select($sql);
						$items = $db->get_items();
						
						$new_list = array();
						foreach($items as $key => $item){
							$new_list[$item['month']] = $item['rows'];
						}
						
						foreach($months as $key => $month){
							$find_key = "$select_year-$key";
							$val = $new_list[$find_key];
							?><td align="right"><?php echo $val;?></td><?php
						}
						?>
					</tr>
				</tbody>
			</table>
			<button onclick="force_print()" class="no-print">��� Print</button>
			<script type="text/javascript">
			function force_print(){ window.print(); }
			</script>
			<?php } ?>
		</div>
	</body>
</html>