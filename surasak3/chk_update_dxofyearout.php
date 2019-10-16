<?php 

include 'bootstrap.php';

$db = Mysql::load();

$sql = "select b.* from ( 
    select * from opcardchk where part = 'แขวงทางหลวง1' 
) as a 
left join ( 
    select * from dxofyear_out where thidate like '2019-10%' 
) as b on b.hn = a.HN 
where b.row_id is not null 
order by b.hn 
limit 1000";

$db->select($sql);

$items = $db->get_items();

foreach ($items as $key => $item) {

    $row_id = $item['row_id'];
    $sql_update = "UPDATE dxofyear_out SET camp = 'ตรวจสุขภาพประกันสังคม', 
    yearchk = '62' 
    WHERE `row_id` = '$row_id' ";
    $db->update($sql_update);

}