<?php

include '../bootstrap.php';

/*
SELECT * 
FROM `drugrx`
WHERE `drugcode` IN('1COUM-C3','1COUM-C5','1COUM-C1','1COUM-C2') 
AND `date` LIKE '2559-05%' 
AND `amount` > 0
GROUP BY `hn`
*/

$action = input_post('action');

if( $action === false ){
	?>
	<form action="#" method="post">
		<div>
			<input type="text">
		</div>
		<div>
			
		</div>
		<div>
			<button></button>
		</div>	
	</form>
	<?php
}else{
	
	
	
	
	
	
}

$sql = "
SELECT c.*,b.`orderdate`,a.`labcode`,a.`result` FROM (
	SELECT `date`,`drugcode`, `hn`, CONCAT((SUBSTRING(`date`, 1, 4) - 543), SUBSTRING(`date`, 5, 6)) AS `date2` 
	FROM `drugrx`
	WHERE `drugcode` IN('1COUM-C3','1COUM-C5','1COUM-C1','1COUM-C2') 
	AND `date` LIKE '2559-05%' 
	AND `amount` > 0 
	GROUP BY `date2`, `hn` 
) AS c 
LEFT JOIN `resulthead` AS b 
	ON b.`hn` = c.`hn`
LEFT JOIN `resultdetail` AS a
	ON a.`autonumber` = b.`autonumber`
WHERE b.`orderdate` LIKE CONCAT(`date2`, '%') 
AND b.`profilecode` = 'PT' 
AND a.`labcode` = 'INR' 
AND ( a.`result` < 1.5 OR a.`result` > 6 )
";









