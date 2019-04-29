<?php
/**
 * รอบปีงบประมาณคือ ต.ค. - ก.ย.
 */
include 'bootstrap.php';
$shs_configs = array(
    'host' => '192.168.1.13',
    'port' => '3306',
    'dbname' => 'smdb',
    'user' => 'dottow',
    'pass' => ''
);

$db = Mysql::load($shs_configs);

$sql = "SELECT a.`row_id`,a.`hn`,a.`thidate`,a.`camp`,a.`ptname`,a.`age`,
a.`cigarette`,a.`alcohol`,a.`exercise`,a.`weight`,a.`height`,a.`bp1`,
a.`bp2`,a.`chol`,a.`chunyot1`,a.`hdl`,a.`ldl`,a.`bs`,a.`cr`,a.`bmi`,
b.`idcard`,b.`dbirth`,a.`gender`,a.`round_`,a.`tg`,
(
    CASE 
        WHEN a.`camp` LIKE 'M04%' THEN '312600' 
        WHEN a.`camp` LIKE 'M03%' THEN '312601' 
        WHEN a.`camp` LIKE 'M06%' THEN '312602' 
        WHEN a.`camp` LIKE 'M02%' THEN '312603' 
        WHEN a.`camp` LIKE 'M05%' THEN '312604' 
        WHEN a.`camp` LIKE 'M08%' THEN '312605' 
        WHEN a.`camp` LIKE 'M010%' THEN '312606' 
    END
) AS `camp_code`
FROM `condxofyear_so` AS a 
LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn`
WHERE a.`yearcheck` = '2562' 
AND a.`camp` != '' 
GROUP BY a.`hn` 
ORDER BY `camp_code` ASC, a.`row_id` DESC";
$db->select($sql);
$items = $db->get_items();
$new_itmes = array();
foreach($items as $key => $item){

	list($preYot,$preName,$preSurname) = explode(' ', $item['ptname']);
	$item['yot'] = $preYot;
	$item['ptname'] = "$preName $preSurname";

	$item['birthday'] = $item['dbirth'];

	$yot1 = array('จอมพล','พล.อ.','พล.ท.','พล.ต.','พล.จ.','พ.อ.','พ.ท.','พ.ต.','ร.อ.','ร.ท.','ร.ต.','พลตรี');
	$yot2 = array('จ.ส.อ.','จ.ส.อ .','จ.ส.ท.','จ.ส.ต.','ส.อ.','ส.อ','ส.ท.','ส.ต.');
	$yot3 = array('นาย','นางสาว','น.ส.','นาง');
	$yot4 = array('พลอาสา','พลอาสาสมัคร');
	
	$test_yot = trim(str_replace(array('หญิง','(พ)'), '', $item['yot']));
	
	if( in_array($test_yot, $yot1) ){
		$item['rankgroup'] = 1;
	}else if(in_array($test_yot, $yot2)){
		$item['rankgroup'] = 2;
	}else if(in_array($test_yot, $yot3)){
		$item['rankgroup'] = 3;
	}else{
		$item['rankgroup'] = 4;
	}
	
	$new_itmes[] = $item;
	
}

// dump($new_itmes);
// exit;

?>
<style>
*{
    font-family: TH SarabunPSK;
    font-size: 16pt;
}
/* ตาราง */
.chk_table{
    border-collapse: collapse;
}

.chk_table, th, td{
    border: 1px solid black;
}

.chk_table th,
.chk_table td{
    padding: 3px;
}
</style>
<table class="chk_table">
	<thead>
		<tr>
			<th>No.</th>
			<th>rank</th>
			<th>HN</th>
			<th>name</th>
			<th>ID</th>
			<th>unit</th>
			<th>rankgroup</th>
			<th>DOB</th>
			<th>age</th>
			<th>gender</th>

			<th>SBP</th>
			<th>DBP</th>

			<th>กลุ่มป่วย ระดับ</th>

		</tr>
	</thead>
	<tbody>
	<?php
	$i = 1;
	foreach ($new_itmes as $key => $item) {
		
		if( is_null($item['hn']) OR $item['hn'] == '47-1' ){
			continue;
		}
		
		// ต้องแยกชื่อเพื่อทำการเว้นวรรคตามรูปแบบการบันทึกข้อมูลสำหรับ AHDAP
		$ptname = preg_replace('/\s+/', ' ', $item['ptname']);
		list($firstname, $lastname) = explode(' ', $ptname);

		?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $item['yot']; ?></td>
			<td><?=$item['hn'];?></td>
			<td><?php echo $firstname.'&nbsp;&nbsp;'.$lastname; ?></td>
			<td>
				<?php 
				echo preg_replace('/^(\d{1})(\d{4})(\d{5})(\d{2})(\d{1})$/', '$1-$2-$3-$4-$5', $item['idcard']);
				?>
			</td>
			<td><?php echo $item['camp_code'];?></td>
			<td><?php echo $item['rankgroup'];?></td>
			<td>
				<?php 
				list($y, $m, $d) = explode('-', $item['birthday']); 
				echo intval($d)."/".intval($m)."/".($y);
				?>
			</td>
			<td>
				<?php echo substr($item['age'], 0, 2);?>
			</td>
			<td><?php echo ( $item['gender'] == '1' ) ? 1 : 2 ; ?></td>

			<td><?php echo $item['bp1']; ?></td>
			<td><?php echo $item['bp2']; ?></td>

			<td>
			<?php 
			if( !empty($item['bp1']) && !empty($item['bp2']) ){

				if( $item['bp1'] <= 120 && $item['bp2'] <= 80 ){
					echo "ปกติ";

				}elseif( ( $item['bp1'] > 120 && $item['bp1'] <= 139 ) && ( $item['bp2'] > 80 && $item['bp2'] <= 89 ) ){
					echo "กลุ่มเสี่ยง";

				}elseif( ( $item['bp1'] >= 140 && $item['bp1'] <= 159 ) && ( $item['bp2'] >= 90 && $item['bp2'] <= 99 ) ){
					echo "ป่วยระดับ1";

				}elseif( ( $item['bp1'] >= 160 && $item['bp1'] <= 179 ) && ( $item['bp2'] >= 100 && $item['bp2'] <= 109 ) ){
					echo "ป่วยระดับ2";

				}elseif( $item['bp1'] >= 180 && $item['bp2'] >= 110 ){
					echo "ป่วยระดับ3";

				}

			}
			?>
			</td>
		</tr>
		<?php
		$i++;
	}
	?>
	</tbody>
</table>