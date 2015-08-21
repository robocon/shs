<?php 

require 'bootstrap.php';
DB::load();

$sql = "
SELECT YEAR(MIN(`thidate`)) as min_year
FROM `opday` 
WHERE `toborow` LIKE 'EX25%' 
AND `thidate` != '0000-00-00 00:00:00'
";
$prev_year = DB::select($sql, null, true);
$min_year = (int) $prev_year['min_year'];

// Default variable
$this_th_year = (int) ( date('Y') + 543 );
$month_lists = array(
	'01' => '���Ҥ�', '02' => '����Ҿѹ��', '03' => '�չҤ�', '04' => '����¹', '05' => '����Ҥ�', '06' => '�Զع�¹', 
	'07' => '�á�Ҥ�', '08' => '�ԧ�Ҥ�', '09' => '�ѹ��¹', '10' => '���Ҥ�', '11' => '��Ȩԡ�¹', '12' => '�ѹ�Ҥ�'
);


include 'templates/default/header.php';

$year = isset($_REQUEST['year']) ? trim($_REQUEST['year']) : false ;
$month = isset($_REQUEST['month']) ? trim($_REQUEST['month']) : false ;
?>

<div class="site-center">
    <div class="site-body panel">
        <div class="body">
            <div class="cell">
				
                <div class="col">
                    <div class="cell">
                        <div class="page-header">
                            <h1>�����µ�Ǩ�ѡ��</h1>
                        </div>
                    </div>
                </div>
<div class="col">
	<div class="cell">
		<p>���͡�ѹ���㹡���ʴ���</p>
		<form action="report_eye.php" method="post">
			<div class="col">
				<div class="cell">
					���͡��
				<select name="year" id="">
					<?php
						for( $this_th_year; $this_th_year >= $min_year; $this_th_year--){
							?><option value="<?php echo $this_th_year ?>"><?php echo $this_th_year ?></option><?php
						}
					?>
				</select>
				���͡��͹
				<select name="month" id="">
					<?php
						foreach($month_lists as $key => $month_item){
							?><option value="<?php echo $key; ?>"><?php echo $month_item ?></option><?php
						}
					?>
				</select>
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<button type="submit">��ŧ</button>
				</div>
			</div>
		</form>
	</div>
</div>

<div class="col">
	<div class="cell">
		<?php 
		// Default request
		
		$action = isset($_REQUEST['action']) ? trim($_REQUEST['action']) : false ;
		
		
		
		if ( $year !== false && $month !== false && $action !== 'fulldetail' ) {
			// 29268 �Ţ �. �ͧ���
			$sql = "
			SELECT DATE_FORMAT(`thidate`, '%Y-%m-%d') AS `date`, COUNT(`hn`) AS `count`
			FROM `opday`
			WHERE `thidate` LIKE :date_select  
			AND ( `toborow` LIKE 'EX25%' OR `clinic` LIKE '07%' ) 
			AND (
				`diag` NOT LIKE '����͹�Ѵ' 
				AND `diag` NOT LIKE '����ҵ���Ѵ' 
				AND `diag` NOT LIKE '�Ѵ%' 
				AND `diag` NOT LIKE '�Ѵ��%' 
			) AND `doctor` LIKE '%29268%'
			GROUP BY DATE(`thidate`)
			";
			// dump($sql);
			$items = DB::select( $sql, array(':date_select' => $year.'-'.$month.'%') );
			
			if ( count($items) == 0 ) {
				echo '��͹������͡�������¡�ü����� ��س����͡�ѹ�������';
				continue;
			}
			?>
			<table class="outline-header horizontal-border">
				<thead>
					<tr>
						<th width="5%">�ӴѺ</th>
						<th>�ѹ���</th>
						<th>�ӹǹ������</th>
					</tr>
				</thead>
				<tbody>
					<?php $i = 1; ?>
					<?php foreach($items as $item): ?>
					<tr>
						<td><?php echo $i; ?></td>
						<td>
							<a href="report_eye.php?action=fulldetail&date=<?php echo $item['date'];?>">
							<?php 
								list($y, $m, $d) = explode('-', $item['date']);
								echo $d.' '.$month_lists[$m].' '.$y; 
							?>
							</a>
						</td>
						<td><?php echo $item['count']; ?></td>
					</tr>
					<?php $i++; ?>
					<?php endforeach; ?>
				</tbody>
			<?php
			
			
			
		} else if( $year === false && $month === false && $action === 'fulldetail' ) {
			$date = isset($_REQUEST['date']) ? trim($_REQUEST['date']) : false ;
			
			$sql = "
			SELECT `hn`,`ptname`,`diag`,`ptright`
			FROM `opday` 
			WHERE `thidate` LIKE :date_select  
			AND ( `toborow` LIKE 'EX25%' OR `clinic` LIKE '07%' ) 
			AND (
				`diag` NOT LIKE '����͹�Ѵ' 
				AND `diag` NOT LIKE '����ҵ���Ѵ' 
				AND `diag` NOT LIKE '�Ѵ%' 
				AND `diag` NOT LIKE '�Ѵ��%' 
			)  AND `doctor` LIKE '%29268%'
			ORDER BY `row_id` ASC 
			";
			// dump($sql);
			// dump($date);
			$items = DB::select( $sql, array(':date_select' => $date.'%') );
			
			if ( count($items) == 0 ) {
				echo '�ѹ������͡ �������¡�ü����� ��س����͡�ѹ�������';
				continue;
			}
			
			list($y, $m, $d) = explode('-', $date);
			?>
			<h3>��¡�ü����µ�Ǩ�ѡ�� �ѹ��� <?php echo $d.' '.$month_lists[$m].' '.$y;?></h3>
			<table class="outline-header horizontal-border">
				<thead>
					<tr>
						<th>�ӴѺ</th>
						<th>HN</th>
						<th>���ͼ�����</th>
						<th>�Է���</th>
						<th>Diagnosis</th>
					</tr>
				</thead>
				<tbody>
					<?php $i = 1; ?>
					<?php foreach($items as $key => $item): ?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $item['hn']; ?></td>
						<td><?php echo $item['ptname']; ?></td>
						<td>
						<?php 
							echo !empty($item['ptright']) ? $item['ptright'] : '-' ; 
						?>
						</td>
						<td>
						<?php 
							echo !empty($item['diag']) ? $item['diag'] : '-' ; 
						?>
						</td>
					</tr>
					<?php $i++; ?>
					<?php endforeach;?>
				</tbody>
			</table>
			<?php
		}
		?>
	</div>
</div>
<?php
include 'templates/default/footer.php';
?>