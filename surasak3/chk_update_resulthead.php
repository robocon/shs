<?php 

include 'bootstrap.php';

$db = Mysql::load();

$sql = "select b.* from ( 
    select * from opcardchk where part = '�ǧ�ҧ��ǧ1' 
) as a 
left join ( 
    select * from resulthead where orderdate like '2019-09-30%' and clinicalinfo like '��Ǩ�آ�Ҿ��Шӻ�%' 
) as b on b.hn = a.HN 
where b.autonumber is not null 
limit 1000";

$db->select($sql);

$items = $db->get_items();

foreach ($items as $key => $item) {

    $autonumber = $item['autonumber'];
    $sql_update = "UPDATE resulthead SET 
    clinicalinfo = '��Ǩ�آ�Ҿ��Шӻ�62' 
    WHERE `autonumber` = '$autonumber' ";
    $db->update($sql_update);

}