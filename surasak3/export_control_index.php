<?php

include 'bootstrap.php';

$db = Mysql::load();

$test_trun = $db->update("TRUNCATE `drug_control_user`");
dump($test_trun);
echo "<hr>";

$sql = "SELECT `row_id`,`usercontrol`,`min`,`max`,`drugcode` 
FROM `druglst` 
WHERE ( `usercontrol` != '' AND `usercontrol` IS NOT NULL ) 
AND `drugcode` != '' 
ORDER BY `usercontrol` ASC ";
$db->select($sql);
$items = $db->get_items();

foreach ($items as $key => $item) {
    $sql = "INSERT INTO `drug_control_user`
    (`id`,
    `username`,
    `min`,
    `max`,
    `drugcode`,
    `druglst_id`)
    VALUES(
    NULL,
    :username,
    :min,
    :max,
    :drugcode,
    :druglst_id);";
    $data = array(
        ':username' => $item['usercontrol'],
        ':min' => $item['min'],
        ':max' => $item['max'],
        ':drugcode' => $item['drugcode'],
        ':druglst_id' => $item['row_id']
    );
    $insert = $db->insert($sql, $data);
    dump($insert);
}