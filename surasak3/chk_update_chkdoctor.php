<?php 

include 'bootstrap.php';

$db = Mysql::load();

$sql = "select b.* from ( 
    select * from opcardchk where part = 'แขวงทางหลวง1' 
) as a 
left join ( 
    select * from chk_doctor where date_chk like '2019-10%' 
) as b on b.hn = a.HN 
where b.id is not null
order by b.hn 
limit 1000";

$db->select($sql);

$items = $db->get_items();

foreach ($items as $key => $item) {

    $id = $item['id'];
    $sql_update = "UPDATE chk_doctor SET yearchk = '62' 
    WHERE `id` = '$id' ";
    $db->update($sql_update);

}