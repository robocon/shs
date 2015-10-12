<?php
/**
 * รอบปีงบประมาณคือ ต.ค. - ก.ย.
 */
include 'bootstrap.php';

DB::load();

$camp_lists = array('312600' => 'รพ.ค่ายสุรศักดิ์มนตรี',
'312601' => '.มทบ.32',
'312602' => 'ร้อย.ฝรพ.3',
'312603' => 'ร.17 พัน.2',
'312604' => 'ช.พัน.4 ร้อย4');

echo "<pre>";
$sql = "
CREATE TEMPORARY TABLE condxofyear_so_temp 
SELECT a.`row_id`,a.`hn`,a.`thidate`,a.`camp1`,b.`yot`,b.`name`,b.`surname`,b.`idcard`,b.`dbirth`,a.`age`,b.`sex`,
a.`cigarette`,a.`alcohol`,a.`exercise`,a.`weight`,a.`height`,a.`round_`,a.`bp1`,
a.`bp2`,a.`bs`,a.`chol`,a.`tg`,a.`chunyot1`
FROM `opcard` AS b
LEFT JOIN `condxofyear_so` AS a ON a.`hn`=b.`hn`
WHERE a.`yearcheck` = '2558' 
#AND b.`name` != ''
ORDER BY a.`row_id` DESC
";
DB::select($sql, null);

$new_itmes = array();
foreach($camp_lists as $key => $camp){
	
	$sql = "SELECT * FROM condxofyear_so_temp WHERE `camp1` LIKE '%$camp' ORDER BY `row_id` ASC ";
	$items = DB::select($sql, null);
	
	
	$yot1 = array('จอมพล','พล.อ.','พล.ท.','พล.ต.','พล.จ.','พ.อ.','พ.ท.','พ.ต.','ร.อ.','ร.ท.','ร.ต.','พลตรี');
	$yot2 = array('จ.ส.อ.','จ.ส.อ .','จ.ส.ท.','จ.ส.ต.','ส.อ.','ส.อ','ส.ท.','ส.ต.');
	$yot3 = array('นาย','นางสาว','น.ส.','นาง');
	$yot4 = array('พลอาสา','พลอาสาสมัคร');
	
	foreach ($items as $camp_key => $value) {
		$value['camp_code'] = $key;
		
		$test_yot = trim(str_replace(array('หญิง','(พ)'), '', $value['yot']));
		
		if( in_array($test_yot, $yot1) ){
			$value['rankgroup'] = 1;
		}else if(in_array($test_yot, $yot2)){
			$value['rankgroup'] = 2;
		}else if(in_array($test_yot, $yot3)){
			$value['rankgroup'] = 3;
		}else{
			$value['rankgroup'] = 4;
		}
		
		
		$new_itmes[] = $value;
		
	}
}
?>
<table border="1" cellpadding="0" cellspacing="0">
	<tr>
		<th>No.</th>
		<th>rank</th>
		<th>name</th>
		<th>ID</th>
		<th>unit</th>
		<th>rankgroup</th>
		<th>DOB</th>
		<th>age</th>
		<th>gender</th>
		<th>Smoke</th>
		<th>Alcohol</th>
		<th>Exercise</th>
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
<?php
$i = 1;
foreach ($new_itmes as $key => $item) {
	
	if( is_null($item['hn']) OR $item['hn'] == '47-1' ){
		continue;
	}
	
	?>
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo $item['yot']; ?></td>
		<td><?php echo $item['name'].' '.$item['surname']; ?></td>
		<td><?php echo $item['idcard']; ?></td>
		<td><?php echo $item['camp_code'];?></td>
		<td><?php echo $item['rankgroup'];?></td>
		<td>
			<?php 
			list($y, $m, $d) = explode('-', $item['dbirth']); 
			echo "$d/$m/$y";
			?>
		</td>
		<td>
			<?php echo substr($item['age'], 0, 2);?>
		</td>
		<td><?php echo ( $item['sex'] == 'ช' ) ? 1 : 2 ; ?></td>
		<td><?php echo $item['cigarette']; ?></td>
		<td><?php echo $item['alcohol']; ?></td>
		<td><?php echo !empty($item['exercise']) ? $item['exercise'] : '' ; ?></td>
		<td><?php echo (float) $item['weight']; ?></td>
		<td><?php echo $item['height']; ?></td>
		<td><?php echo (float) $item['round_'];?></td>
		<td><?php echo $item['bp1']; ?></td>
		<td><?php echo $item['bp2']; ?></td>
		<td><?php echo !empty($item['bs']) ? $item['bs'] : '' ; ?></td>
		<td><?php echo !empty($item['chol']) ? $item['chol'] : '' ; ?></td>
		<td><?php echo !empty($item['tg']) ? $item['tg'] : '' ; ?></td>
		<td></td>
		<td></td>
	</tr>
	<?php
	$i++;
}
?>
</table>