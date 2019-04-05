<?php 
include '../bootstrap.php';

/**
 * @todo
 * - ทะเบียน
 * - lab 
 * - ซักประวัติ
 * - แพทย์
 */

$configs = array(
    'host' => '192.168.1.2',
    'port' => '3306',
    'dbname' => 'smdb',
    'user' => 'remoteuser',
    'pass' => ''
);

$db = Mysql::load($configs);
// $db->exec("SET NAMES UTF8");


$sql = "CREATE TEMPORARY TABLE IF NOT EXISTS `tmp_regis`
SELECT b.*
FROM ( 
    SELECT `hn` 
    FROM `opcard` 
    WHERE `employee` = 'y'
) AS a 
LEFT JOIN ( 
    SELECT `row_id`,`thidate`,`hn`,`ptname`,`vn` FROM `opday` WHERE `thidate` >= '2562-04-01 00:00:00' AND `thidate` <= '2562-04-05 23:23:59'
) AS b ON b.`hn` = a.`hn` 
WHERE b.`row_id` IS NOT NULL 
ORDER BY b.`thidate` ASC";
$db->exec($sql);

$sql = "SELECT * FROM `tmp_regis`";
$db->select($sql);
$items = $db->get_items();

?>
<div>
    <h3>รายชื่อออก vn</h3>
    <table>
        <tr>
            <th>#</th>
            <th>วันที่</th>
            <th>HN</th>
            <th>ชื่อ-สกุล</th>
            <th>vn</th>
        </tr>
        <?php 
        $i = 1;
        foreach ($items as $key => $item) {
            ?>
            <tr>
                <td><?=$i;?></td>
                <td><?=$item['thidate'];?></td>
                <td><?=$item['hn'];?></td>
                <td><?=$item['ptname'];?></td>
                <td><?=$item['vn'];?></td>
            </tr>
            <?php 
            $i++;
        }
        ?>
    </table>
</div>
<?php 

// dxofyear_out