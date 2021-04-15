<?php 
include 'bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES tis620");

$user_list = array('58-2733', '58-2734','58-2735','58-2736','58-2737','58-2738');

$thai_date = (date('Y')+543).date('-m-d H:i:s');
$i = 1;
foreach ($user_list as $key => $hn) {

    $test_time = (10+$i);

    $pre_countdown_c19 = strtotime("+$test_time minutes");
    $countdown_c19 = date('Y-m-d H:i:s', $pre_countdown_c19);

    $sql = "SELECT CONCAT(`yot`,`name`,' ',`surname`) AS `ptname`,`ptright1` FROM `opcard` WHERE `hn` = '$hn' ";
    $opcard_q = $dbi->query($sql);
    $item = $opcard_q->fetch_assoc();

    $ptname = $item['ptname'];
    $ptright = $item['ptright1'];

    $sql = "INSERT INTO `trauma_inject` (
        `row_id`, `thidate`, `thidate_regis`, `hn`, `ptname`, `age`, 
        `ptright`, `TYPE`, `drugcode`, `tradname`, `number`, `opd`, 
        `toborow`, `status_c19`, `countdown_c19`
    ) 
    VALUES 
    (
        NULL, '$thai_date', '$thai_date', '$hn', '$ptname', '30 »Õ 3 à´×Í¹', 
        '$ptright', 'V', 'C19', '·´ÊÍºÇÑ¤«Õ¹', '', '0', 
        'EX52 ©Õ´ÇÑ¤«Õ¹â¤ÇÔ´ 19', 'N', '$countdown_c19'
    );";
    $test = $dbi->query($sql);
    dump($test);
    $i++;

}

