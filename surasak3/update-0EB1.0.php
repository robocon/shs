<?php
include 'includes/connect.php';

/* Get information from hn */
$query = mysql_query("SELECT * FROM `opcard` WHERE `hn` LIKE '48-3493'");
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
INSERT INTO `dphardep` VALUES (NULL, '$runno', '2559-02-27 00:00:00', '$full_name', '$hn', NULL, 294.00, 0.00, 'เชาวรินทร์ อุ่นเครือ (ว.37533)', 0, 'เชาวรินทร์ อุ่นเครือ (ว.37533)', '', 0.00, 0.00, 294.00, 0.00, 0.00, NULL, 0.00, 0.00, NULL, '', '$ptright', 'DR', NULL, NULL, '', NULL, NULL, '', '');
";
mysql_query($sql);
$last_id = mysql_insert_id();
var_dump($last_id);


$sql = "
INSERT INTO `ddrugrx` VALUES (NULL, '2559-02-27 00:00:00', '$hn', NULL, '0EB1.0', 'Euvax  B 20 mcg./1 ml.', 294.00, 0.00, 1, 294.00, 2, '', 'DDN', $last_id, '1', '', '', '', '', 'IM', '(1 DOSE)', '', NULL, '', '0', '', '', 0, '', 'เข็มที่ 3', '');
";
var_dump($sql);
mysql_query($sql);
