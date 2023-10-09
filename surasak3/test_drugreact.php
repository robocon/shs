<?php 
include 'bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$test_hn=array(
    array('hn'=>'66-3373'),
    array('hn'=>'66-3795'),
    array('hn'=>'48-12970'),
);

$sql = "SELECT hn,drugcode FROM drugreact WHERE hn NOT IN(
    SELECT hn FROM drugreact WHERE drugcode != '' GROUP BY hn
) GROUP BY hn ORDER BY row_id DESC ";
$q = $dbi->query($sql);
$test_drugreact_user = array();
while ( $a = $q->fetch_assoc()) {
    $test_drugreact_user[] = $a;
}
// dump($test_drugreact_user);

$test_drugcode_from_druglst = '1BRU400-NN';

$test_all_users = array_merge($test_hn, $test_drugreact_user);
// dump($test_all_users);
foreach ($test_all_users as $key => $value) {
    $drugreact_group_list = array();

    $my_hn = $value['hn'];
    // dump($my_hn);
    $sql_react_group="SELECT b.* FROM ( 
        SELECT `groupname` FROM `drugreact` WHERE `hn` = '$my_hn' AND `groupname` != '' GROUP BY `groupname`
    ) AS a 
    LEFT JOIN `drugreact_group` AS c ON c.`name` = a.`groupname`
    LEFT JOIN `drugreact_group_list` AS b ON c.`id` = b.`drugreact_group` 
    WHERE b.drugcode NOT IN (SELECT `drugcode` FROM `drugreact` WHERE `hn` = '$my_hn' AND drugcode != '' GROUP BY drugcode)";
    // dump($sql_react_group);
    $q_group = $dbi->query($sql_react_group);
    // $q_group = mysql_query($sql_react_group);
    // $group_rows = mysql_num_rows($q_group);
    $drugreact_group_list = array();
    if($q_group->num_rows>0){ 
        while ($a = $q_group->fetch_assoc()) {
            $drugreact_group_list[] = trim($a['drugcode']);
        }
    }


    dump($drugreact_group_list);

    if(in_array(trim($test_drugcode_from_druglst), $drugreact_group_list)===true){
        echo '<span style="font-weight:bold; background-color:orange; font-size:16px;">&nbsp;มีโอกาสแพ้ยา&nbsp;</span>';
    }

    // if(count($drugreact_group_list)>0){
    //     // dump($my_hn);
    //     // dump($value['drugcode']);
    //     dump($drugreact_group_list);
    // }
    
}



