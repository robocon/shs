<?php

include 'bootstrap.php';
$db = Mysql::load();

$exam_no = 301;
$checkup_date_code = '170503';

$action = input('action');

if ( $action === 'update' ) {

	$test_depart = "SELECT b.* 
	FROM ( 
		SELECT * 
		FROM `opcardchk`
		WHERE ( `part` = 'ͺ�60' AND `branch` = '��Сѹ�ѧ��' ) 
	 ) AS a 
	LEFT JOIN ( 
		SELECT * FROM `depart` WHERE `date` LIKE '2560-05-04%' 
		#AND `cashok` = '��Сѹ�ѧ��' 
	) AS b ON b.`hn` = a.`HN` 
	WHERE b.`row_id` IS NOT NULL 
    #GROUP BY b.`tvn` 
    ORDER BY b.`hn`";
	$db->select($test_depart);
	$items = $db->get_items();

	foreach ($items as $key => $item) {
		$row_id = $item['row_id'];
		$cashok = $item['cashok'];
		
		if ( $cashok === '��Сѹ�ѧ��' ) {
			
			dump($cashok);

			$update = "UPDATE `depart` 
			SET `cashok` = 'SSOCHECKUP60' 
			WHERE `row_id` = '$row_id';";
			
			dump($update);

			$update_cashok = $db->update($update);
			dump($update_cashok);

		}
			

		echo "<hr>";

	}

	exit;

}

$page = input('page');
if ( empty($page) ) {
	
	?>
	<form action="aorborjor_update_depart.php" method="post">
		<div>
			<p>�Ѿഷ������ ��� ���</p>
		</div>
		<div>
			<button type="submit">����.....�Ѿ�ٴ... �����Ѿഷ</button>
			<input type="hidden" name="action" value="update">
		</div>
	</form>
	<?php
}