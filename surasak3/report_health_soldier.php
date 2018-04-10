<?php
/**
 * รอบปีงบประมาณคือ ต.ค. - ก.ย.
 */
include 'bootstrap.php';

$db = Mysql::load();

/*
$camp_lists = array(
	'312600' => 'รพ.ค่ายสุรศักดิ์มนตรี',
	'312601' => 'มทบ.32',
	'312602' => 'ร้อย.ฝรพ.3',
	'312603' => 'ร.17 พัน.2',
	'312604' => 'ช.พัน.4 ร้อย4',
	'312605' => 'สง.สด.จว.ล.ป.',
	// '312606' => 'กทพ.33',
	// '312607' => 'หน่วยทหารอื่นๆ'
);
*/

#a.`bs`, --> glu_result
#a.`tg`, --> trig_result
#
$sql = "SELECT a.`row_id`,a.`hn`,a.`registerdate`,a.`camp`,a.`yot`,a.`ptname`,a.`idcard`,a.`birthday`,a.`age`,a.`gender`,
a.`cigarette`,a.`alcohol`,a.`exercise`,a.`weight`,a.`height`,a.`waist`,a.`bp1`,
a.`bp2`,a.`chol_result`,a.`chunyot`,a.`hdl_result`,a.`ldl_result`,a.`glu_result`,a.`trig_result`,
(
    CASE 
        WHEN a.`camp` LIKE '%รพ.ค่ายสุรศักดิ์มนตรี' THEN '312600' 
        WHEN a.`camp` LIKE '%มทบ.32' THEN '312601' 
        WHEN a.`camp` LIKE '%ร้อย.ฝรพ.3' THEN '312602' 
        WHEN a.`camp` LIKE '%ร.17 พัน.2' THEN '312603' 
        WHEN a.`camp` LIKE '%ช.พัน.4 ร้อย4' THEN '312604' 
        WHEN a.`camp` LIKE '%สง.สด.จว.ล.ป.' THEN '312605' 
        WHEN a.`camp` LIKE '%กทพ.33' THEN '312606' 
    END
) AS `camp_code`
FROM `armychkup` AS a 
WHERE a.`yearchkup` = '61' 
AND a.`camp` != '' 
GROUP BY a.`hn`
ORDER BY `camp_code` ASC, a.`row_id` DESC";
$db->select($sql);
$items = $db->get_items();
$new_itmes = array();
foreach($items as $key => $item){
	
	// $sql = "SELECT * FROM condxofyear_so_temp WHERE `camp` LIKE '%$camp' ORDER BY `row_id` ASC ";
	// $db->select($sql);
	// $items = $db->get_items();

	// dump(count($items));

	$yot1 = array('จอมพล','พล.อ.','พล.ท.','พล.ต.','พล.จ.','พ.อ.','พ.ท.','พ.ต.','ร.อ.','ร.ท.','ร.ต.','พลตรี');
	$yot2 = array('จ.ส.อ.','จ.ส.อ .','จ.ส.ท.','จ.ส.ต.','ส.อ.','ส.อ','ส.ท.','ส.ต.');
	$yot3 = array('นาย','นางสาว','น.ส.','นาง');
	$yot4 = array('พลอาสา','พลอาสาสมัคร');
	
	// foreach ($items as $camp_key => $value) {
		// $item['camp_code'] = $key;
		
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
		
	// }
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
			<th>smoke</th>
			<th>alcohol</th>
			<th>exercise</th>
			<th>weight</th>
			<th>height</th>
			<th>WC</th>
			<th>SBP</th>
			<th>DBP</th>
			<th>FBS</th>
			<th>CHOL</th>
			<th>TG</th>
			<th>HDL-C</th>
			<th>LDL-C</th>
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
				echo intval($d)."/".intval($m)."/".($y+543);
				?>
			</td>
			<td>
				<?php echo substr($item['age'], 0, 2);?>
			</td>
			<td><?php echo ( $item['gender'] == '1' ) ? 1 : 2 ; ?></td>
			<td><?php echo $item['cigarette']; ?></td>
			<td><?php echo $item['alcohol']; ?></td>
			<td><?php echo !empty($item['exercise']) ? $item['exercise'] : '' ; ?></td>
			<td><?php echo number_format($item['weight'], 1); ?></td>
			<td><?php echo number_format($item['height'], 1); ?></td>
			<td><?php echo number_format(($item['waist'] / 0.39370), 1);?></td>
			<td><?php echo $item['bp1']; ?></td>
			<td><?php echo $item['bp2']; ?></td>
			<td><?php echo !empty($item['glu_result']) ? $item['glu_result'] : '' ; ?></td>
			<td><?php echo !empty($item['chol_result']) ? $item['chol_result'] : '' ; ?></td>
			<td><?php echo !empty($item['trig_result']) ? $item['trig_result'] : '' ; ?></td>
			<td><?php echo !empty($item['hdl_result']) ? $item['hdl_result'] : '' ; ?></td>
			<td><?php echo !empty($item['ldl_result']) ? $item['ldl_result'] : '' ; ?></td>
		</tr>
		<?php
		$i++;
	}
	?>
	</tbody>
</table>