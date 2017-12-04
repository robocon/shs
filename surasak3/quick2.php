<?php

include 'bootstrap.php';

$db = Mysql::load();
$sql = "DROP TEMPORARY TABLE IF EXISTS `tmp_opacc`;";
$db->select($sql);

$sql = "CREATE TEMPORARY TABLE `tmp_opacc` 
SELECT 
MAX(`row_id`) AS `last_id`,`hn`,`date`,`depart`,`paid`, 
SUM(`paid`) AS `sum_paid`, 
SUBSTRING(`date`, 1, 10) AS `short_date`, 
SUBSTRING(`date`, 1, 7) AS `short_month`,
SUBSTRING(`date`, 6, 2) AS `month`,
IF(`hn`,1,false) AS `onehn`, 
COUNT(`hn`) AS `hn_alias` 
FROM `opacc` 
WHERE `date` LIKE '2559%' 
AND `depart` != '' 
AND `depart` IN('PHAR','PATHO','XRAY','OTHER') 
AND `credit` NOT IN('ยกเลิก','ยกเว้น','ค้างจ่าย','อื่นๆ') 
GROUP BY `short_date`,`depart`,`hn` 
ORDER BY `date`,`depart`;";
$db->select($sql);


$sql = "SELECT `short_month`,`depart`,SUM(`sum_paid`) AS `total`, SUM(`onehn`) as `count_hn`,`month`
FROM `tmp_opacc` 
GROUP BY `short_month`,`depart`";
$db->select($sql);
$items = $db->get_items();
$list_year = array();
foreach ($items as $key => $item) {
    $depart = $item['depart'];
    $month = $item['month'];

    $list_year[$depart][$month] = $item;
}

$main_depart = array(
    'PHAR' => 'ห้องยา',
    'PATHO' => 'พยาธิ',
    'XRAY' => 'X-Ray',
    'OTHER' => 'ค่าบริการต่างๆ'
);

?>
<table border="1">
    <tr>
        <td>แผนก</td>
        <?php
        foreach( $def_month_th as $month_key => $month_name ){
            ?>
            <td colspan="2"><?=$month_name;?></td>
            <?php
        }
        ?>
    </tr>
    
<?php
foreach ($main_depart as $dep_key => $depart) {
    ?>
    <tr>
        <td><?=$depart;?></td>
        <?php
        foreach( $def_month_th as $month_key => $month_name ){
            $total = $list_year[$dep_key][$month_key]['total'];
            $count_hn = $list_year[$dep_key][$month_key]['count_hn'];
            ?>
            <td align="right">
                <?php
                echo $total;
                ?>
            </td>
            <td align="right">
                <?php
                echo $count_hn;
                ?>
            </td>
            <?php
        }
        ?>
    </tr>
    <?php
}
?>
</table>

<?php

$sql = "DROP TEMPORARY TABLE IF EXISTS `tmp_ipacc`;";
$db->select($sql);

$sql = "CREATE TEMPORARY TABLE `tmp_ipacc` 
SELECT 
MAX(`row_id`) AS `last_id`,`an`,`date`,`depart`,`paid`, 
SUM(`paid`) AS `sum_paid`, 
SUBSTRING(`date`, 1, 10) AS `short_date`, 
SUBSTRING(`date`, 1, 7) AS `short_month`, 
SUBSTRING(`date`, 6, 2) AS `month`, 
IF(`an`,1,false) AS `onehn`, 
COUNT(`an`) AS `hn_alias` 
FROM `ipacc` 
WHERE `date` LIKE '2559%' 
AND `depart` != '' 
AND `depart` IN('PHAR','PATHO','XRAY','OTHER') 
GROUP BY `short_date`,`depart`,`an` 
ORDER BY `date`,`depart`;";
$db->select($sql);


$sql = "SELECT `short_month`,`depart`,SUM(`sum_paid`) AS `total`, SUM(`onehn`) as `count_hn`,`month`
FROM `tmp_ipacc` 
GROUP BY `short_month`,`depart`";
$db->select($sql);
$items = $db->get_items();
$list_year = array();
foreach ($items as $key => $item) {
    $depart = $item['depart'];
    $month = $item['month'];

    $list_year[$depart][$month] = $item;
}

?>
<table border="1">
    <tr>
        <td>แผนก</td>
        <?php
        foreach( $def_month_th as $month_key => $month_name ){
            ?>
            <td colspan="2"><?=$month_name;?></td>
            <?php
        }
        ?>
    </tr>
    
<?php
foreach ($main_depart as $dep_key => $depart) {
    ?>
    <tr>
        <td><?=$depart;?></td>
        <?php
        foreach( $def_month_th as $month_key => $month_name ){
            $total = $list_year[$dep_key][$month_key]['total'];
            $count_hn = $list_year[$dep_key][$month_key]['count_hn'];
            ?>
            <td align="right">
                <?php
                echo $total;
                ?>
            </td>
            <td align="right">
                <?php
                echo $count_hn;
                ?>
            </td>
            <?php
        }
        ?>
    </tr>
    <?php
}
?>
</table>