<?php

include '../bootstrap.php';

$db = Mysql::load();


$sql = "SELECT * FROM smdb.diabetes_clinic 
where dateN < '2014-10-01' 
order by dateN asc;";
$db->select($sql);
$items = $db->get_items();
foreach ($items as $key => $item) {
    $id = $item['row_id'];
    $sql = "DELETE FROM `smdb`.`diabetes_clinic` WHERE row_id = '$id';";
    $delete = $db->delete($sql);
    dump($delete);
}

// mysqldump -u root -p1234 --extended-insert=FALSE --no-create-info --where="dateN < '2014-10-01'" smdb diabetes_clinic > diabetes_clinic.sql


$input_file = fopen('update_user.sql', 'r');
while( $l = fgets($input_file) ){

    $update = mysql_query($l);
    // $update = $db->update($l);
    dump($update);
}
