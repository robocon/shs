<?php 

include 'bootstrap.php';

$db = Mysql::load();

$sql = "select b.* from ( 
    select * from opcardchk where part = 'á¢Ç§·Ò§ËÅÇ§1' 
) as a 
left join ( 
    select * from resulthead where orderdate like '2019-09-30%' and clinicalinfo like 'µÃÇ¨ÊØ¢ÀÒ¾»ÃĞ¨Ó»Õ%' 
) as b on b.hn = a.HN 
where b.autonumber is not null 
limit 1000";

$db->select($sql);

$items = $db->get_items();

foreach ($items as $key => $item) {

    $autonumber = $item['autonumber'];
    $sql_update = "UPDATE resulthead SET 
    clinicalinfo = 'µÃÇ¨ÊØ¢ÀÒ¾»ÃĞ¨Ó»Õ62' 
    WHERE `autonumber` = '$autonumber' ";
    $db->update($sql_update);

}