<?php 
include '../bootstrap.php';
include 'connect2.php';

?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
    <title>ระบบรายงานการค้นหา</title>
    <link type="text/css" href="menu.css" rel="stylesheet" />
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="menu.js"></script>
</head>
<body>
	<?php
	include 'menu.php';
	?>
	<div class="main-container">
		<div class="col">
			<div class="cell">
				<?php
				$def_date = get_date_bc('Y');
				$date_format = input_post('date_format', $def_date);
				?>
				<form action="report_from.php" method="post" id="userForm" class="no_print">
					<div class="col">
						<div class="cell">
							<label for="">
								<span>ค้นหาตามปี: </span>
								<input type="text" name="date_format" value="<?=$date_format;?>">
								<div><span style="color: red; font-size: 12px;">* ตัวอย่าง 2559</span></div>
							</label>
						</div>
					</div>
					<div class="col">
						<div class="cell">
							<button type="submit">ตกลง</button>
							<button type="button" class="print_web">พิมพ์รายงาน</button>
							<input type="hidden" name="action" id="submit" value="showtable">
						</div>
					</div>
				</form>
			</div>
		</div>
		<script>
		$(function(){
			$('.print_web').click(function(){
				window.print();
			});
		});
		</script>
		<br>
		<?php
		$action = input('action');
		if( $action === 'showtable' ){

			$groups = array(
				1 => 'ENV ROUND',
				2 => 'IC ROUND',
				3 => 'RM ROUND',
				4 => '12 กิจกรรมทบทวน',
				5 => 'หน่วยรายงานเอง',
				6 => 'อื่นๆ',
				7 => 'เวรตรวจการพยาบาล',
				8 => 'นายทหารเวรประจำวัน'
			);

			$date = input_post('date_format');
			
			$conf = array(
				'host' => $SVNAME,
				'port' => 3306,
				'dbname' => $DBNAME,
				'user' => $USER,
				'pass' => $PASS,
			);
			$db = Mysql::load($conf);
			
			$sql = "SELECT (SUBSTRING(`nonconf_date`, 1, 4) - 543) AS `year`, 
DATE_FORMAT( `nonconf_date`, '%m' ) AS `month`, 
CONCAT((SUBSTRING(`nonconf_date`, 1, 4) - 543), '-', DATE_FORMAT( `nonconf_date`, '%m' )) AS `ad_date`, 
COUNT(`nonconf_id`) AS `rows`, 
`come_from_id` 
			FROM `ncr2556` 
			WHERE `nonconf_date` LIKE :date_select 
            AND `come_from_id` != ''
            GROUP BY `ad_date`, `come_from_id`";

			$data = array(
				':date_select' => "$date%"
			);
			$db->select($sql, $data);
			$items = $db->get_items();

			$ykey = bc_to_ad($date);
			$new_item = array();
			foreach ($items as $key => $item) {
				$set_key = $item['year'].$item['month'].$item['come_from_id'];
				$new_item[$set_key] = $item;
			}
			?>
			<style type="text/css">
			#report{
				font-size: 22px;
			}
			td, th{
				padding: 2px;
			}
			h3{
				font-family: 'TH SarabunPSK';
				font-size: 28px;
			}
			@media print{ 
				.no_print{
					display: none;
				} 
				#report{
					font-size: 16px;
				}
				a{
					text-decoration: none;
				}
			}
			</style>
			<div class="col">
				<div class="cell">
					<h3>ระบบรายงานที่มาแยกตามเดือน</h3>
				</div>
			</div>
			<table border="1" cellspacing="1" cellpadding="3" bordercolor="#000000" style="border-collapse:collapse" id="report">
				<tr style="background-color: #dddddd;">
					<th rowspan="2">ที่มา</th>
					<th colspan="13">ปี <?=$date;?></th>
				</tr>
				<tr style="background-color: #dddddd;">
					<?php
					foreach ($def_month_th as $key => $value) {
						?>
						<th align="center"><?=$value;?></th>
						<?php
					}
					?>
				</tr>
			<?php
			foreach( $groups as $gkey => $group ){
				?>
				<tr>
					<td><?=$group;?></td>
				<?php
				foreach ($def_month_th as $mkey => $month) {

					// ดึงการแสดงผลตามคีย์
					$find_key = $ykey.$mkey.$gkey;
					if( isset($new_item[$find_key]) ){
						$item = $new_item[$find_key];

						$href = 'date='.$ykey.'-'.$mkey.'&group='.$gkey;
						?>
						<td align="right">
							<a href="report_from_detail.php?<?=$href;?>" target="_blank"><?=$item['rows'];?></a>
						</td>
						<?php
					}else{
						?>
						<td align="right">0</td>
						<?php
					}
				}
				?>
				</tr>
				<?php
			}
			?>
			</table>
			<?php
		}
		?>
	</div>
</body>
</html>