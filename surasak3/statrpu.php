<?php

include 'bootstrap.php';

$action = input_post('action');

if( empty($action) ){
    
    $default_year = ( date('Y') + 543 ).date('-m-d');
    $year_select = input_post('yearSelect');
    ?>
    <div>
        <h3>สถิติรายรับ นวด-ฝังเข็ม</h3>
    </div>
    <form action="statrpu.php" method="post">
        <div>
            เลือกปี: <input type="text" name="yearSelect" value="<?=$year_select;?>">
        </div>
        <div>
            <button type="submit">แสดงผล</button>
            <input type="hidden" name="action" value="show">
        </div>
    </form>
    <?php
}elseif ($action === 'show') {
    
    $year_select = input_post('yearSelect');
    
    $sql = "SELECT SUM(a.`price`) AS `aPrice`, SUM(c.`paid`) AS `cPaid` 
    FROM `patdata` AS a 
    LEFT JOIN `depart` AS b ON a.`idno` = b.`row_id` 
	RIGHT JOIN `opacc` AS c ON c.`txdate` = b.`date` 
    WHERE a.`date` LIKE '2559-05%'
	AND b.`cashok` IS NOT NULL 
    AND ( a.`code` LIKE '580%' AND a.`code` LIKE '581%' AND a.`code` LIKE '583%' )
    
    GROUP BY MONTH(c.`date`)
    
    
    
    ";
    
}