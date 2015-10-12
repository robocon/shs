<?php
include 'bootstrap.php';

$hn = isset($_REQUEST['hn']) ? trim($_REQUEST['hn']) : false ;

$title = '���ҡ�ùѴ�մ�ҵ�� HN';
include 'templates/classic/header.php';
include 'templates/classic/nav.php';

?>
<div class="site-center">
	<form class="col" action="show_user_appoint_drug.php" method="post">
		<div><h3>����ѵԡ�ùѴ�մ��</h3></div>
		<div class="col">
			<div class="width-2of5">
				���ҵ���Ţ HN: 
			</div>
			<div>
				<input type="text" name="hn" value="<?php echo $hn;?>">
			</div>
		</div>
		<div class="col">
			<div class="width-2of5"></div>
			<div>
				<button type="submit">����</button>
			</div>
		</div>
	</form>
	<?php
	DB::load();
	$sql = "SELECT `hn`,`yot`,`name`,`surname`,`ptright` FROM `opcard` WHERE `hn` = :hn LIMIT 1;";
	$user = DB::select($sql, array(':hn' => $hn), true);
	if( !empty($user) ){
		?>
		<div class="col">
			<div class="cell">
				<h3>��������´������</h3>
				<p><b>HN: </b><?php echo $user['hn'];?></p>
				<p><b>����: </b><?php echo $user['yot'].' '.$user['name'].' '.$user['surname'];?></p>
				<p><b>�Է���: </b><?php echo $user['ptright'];?></p>
			</div>
		</div>
		<div class="col">
			<div class="cell">
				<table>
					<thead>
						<tr>
							<th>#</th>
							<th>�ѹ���</th>
							<th>VN</th>
							<th>������</th>
							<th>�����Ѻ��(�Ѵ Stock)</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$sql = "
					SELECT a.`date`,a.`tvn`,a.`stkcutdate`,b.`tradname`,b.`drugcode`
					FROM `dphardep` AS a
					LEFT JOIN `ddrugrx` AS b ON b.`hn`=a.`hn`
					WHERE a.`hn` = :hn
					AND a.`date` LIKE '2558%'
					GROUP BY a.`date`
					ORDER BY a.`date` DESC;
					";
					$items = DB::select($sql, array(':hn' => $hn) );
					
					$i = 1;
					foreach($items as $key => $item){ 
					?>
						<tr>
							<td align="center"><?php echo $i;?></td>
							<td><?php echo $item['date']; ?></td>
							<td align="center"><?php echo $item['tvn']; ?></td>
							<td align="center"><?php echo $item['drugcode'].' ('.$item['tradname'].')'; ?></td>
							<td><?php echo is_null($item['stkcutdate']) ? '-' : $item['stkcutdate'] ; ?></td>
						</tr>
					<?php
						$i++;
					}
					?>
					</tbody>
				</table>
			</div>
		</div>
	<?php } ?>			
</div>
<?php
include 'templates/classic/footer.php';