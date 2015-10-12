<?php
include 'includes/connect.php';

/* Get information from hn */
$query = mysql_query("SELECT * FROM `opcard` WHERE `hn` LIKE '56-9756'");
$user = mysql_fetch_assoc($query);

/* Get runno and update */
$runno_query = mysql_query("SELECT `runno` FROM `runno` WHERE `title` = 'phardep' LIMIT 1") or die( mysql_error() );
$fitem = mysql_fetch_assoc($runno_query);
$runno = $fitem['runno'];
$runno++;

$update_runno = mysql_query("UPDATE `runno` SET `runno` = '$runno' WHERE `title` = 'phardep' LIMIT 1") or die( mysql_error() );
/* Get runno and update */


$full_name = $user['yot'].' '.$user['name'].' '.$user['surname'];
$hn = $user['hn'];
$ptright = $user['ptright'];

$sql = "
INSERT INTO `dphardep` VALUES (NULL, '$runno', '2559-03-31 00:00:00', '$full_name', '$hn', NULL, 61.00, 0.00, 'ขชล รวมทรัพย์ (ว.38212)', 0, 'ขชล รวมทรัพย์ (ว.38212)', '', 0.00, 0.00, 61.00, 0.00, 0.00, NULL, 0.00, 0.00, NULL, '', '$ptright', 'DR', NULL, NULL, '', NULL, NULL, '', '');
";
var_dump($last_id);
mysql_query($sql);
$last_id = mysql_insert_id();
var_dump($last_id);


$sql = "
INSERT INTO `ddrugrx` VALUES (NULL, '2559-03-31 00:00:00', '$hn', NULL, '0DT', 'Diphtheria and Tetanus vaccine 0.5 ml.', 61.00, 0.00, 1, 61.00, 0, '', 'DDL', $last_id, '1', '', '', '', '', 'IM', '(1 COURSE)', '', NULL, '', '0', '', '', 0, '', 'เข็มที่ 3', '');
";
var_dump($sql);
mysql_query($sql);
