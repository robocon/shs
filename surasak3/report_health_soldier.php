<?php
/**
 * �ͺ�է�����ҳ��� �.�. - �.�.
 */
include 'bootstrap.php';
$db = Mysql::load();

// $db->select("SET NAMES UTF-8");
/*
$camp_lists = array(
	'312600' => 'þ.��������ѡ��������',
	'312601' => '���.32',
	'312602' => '����.�þ.3',
	'312603' => '�.17 �ѹ.2',
	'312604' => '�.�ѹ.4 ����4',
	'312605' => 'ʧ.ʴ.��.�.�.',
	// '312606' => '���.33',
	// '312607' => '˹��·�������'
);
*/

#a.`bs`, --> glu_result
#a.`tg`, --> trig_result
#

/*
�Ҵ
yot
idcard
birthday
gender
waist
 */


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

	$yot1 = array('�����','��.�.','��.�.','��.�.','��.�.','�.�.','�.�.','�.�.','�.�.','�.�.','�.�.','�ŵ��');
	$yot2 = array('�.�.�.','�.�.� .','�.�.�.','�.�.�.','�.�.','�.�','�.�.','�.�.');
	$yot3 = array('���','�ҧ���','�.�.','�ҧ');
	$yot4 = array('������','��������Ѥ�');
	
	$test_yot = trim(str_replace(array('˭ԧ','(�)'), '', $item['yot']));
	
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
/* ���ҧ */
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
			<th>BMI</th>
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
		
		// ��ͧ�¡�������ͷӡ�������ä����ٻẺ��úѹ�֡����������Ѻ AHDAP
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
			<td><?php echo $item['cigarette']; ?></td>
			<td><?php echo $item['alcohol']; ?></td>
			<td><?php echo !empty($item['exercise']) ? $item['exercise'] : '' ; ?></td>
			<td><?php echo number_format($item['weight'], 1); ?></td>
			<td><?php echo number_format($item['height'], 1); ?></td>
			<td>
				<?php echo $item['bmi'];?>
			</td>
			<?php 
			// number_format(($item['round_'] / 0.39370), 1);
			?>
			<td><?php echo $item['round_'];?></td>
			<td><?php echo $item['bp1']; ?></td>
			<td><?php echo $item['bp2']; ?></td>
			<td><?php echo !empty($item['bs']) ? $item['bs'] : '' ; ?></td>
			<td><?php echo !empty($item['chol']) ? $item['chol'] : '' ; ?></td>
			<td><?php echo !empty($item['tg']) ? $item['tg'] : '' ; ?></td>
			<td><?php echo !empty($item['hdl']) ? $item['hdl'] : '' ; ?></td>
			<td><?php echo !empty($item['ldl']) ? $item['ldl'] : '' ; ?></td>
		</tr>
		<?php
		$i++;
	}
	?>
	</tbody>
</table>