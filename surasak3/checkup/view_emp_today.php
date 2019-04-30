<?php 
include '../bootstrap.php';

/**
 * @todo
 * - ทะเบียน
 * - lab 
 * - ซักประวัติ
 * - แพทย์
 */

$shs_configs = array(
    'host' => '192.168.1.13',
    'port' => '3306',
    'dbname' => 'smdb',
    'user' => 'dottow',
    'pass' => ''
);

$db = Mysql::load($shs_configs);
// $db->exec("SET NAMES UTF8");

$sql = "SELECT b.`row_id`,b.`thidate`,b.`hn`,b.`ptname`,b.`vn`,b.`age`,b.`toborow`,
CONCAT(SUBSTRING(b.`thidate`,1,10),b.`hn`) AS `date_hn_bc`,
CONCAT((SUBSTRING(b.`thidate`,1,4) - 543),SUBSTRING(b.`thidate`,5,6),b.`hn`) AS `date_hn_ad`,
d.`employee`,
c.`camp`,c.`yearchk`,c.`bp1`,c.`bp2`,
e.`date_chk`,e.`doctor` 
FROM( 
	SELECT MAX(`row_id`) AS `row_id` 
	FROM `opday` 
	WHERE `thidate` >= '2562-04-01 00:00:00' AND `thidate` <= '2562-04-24 23:23:59' 
	AND ( `toborow` LIKE 'EX16%' OR `toborow` LIKE 'E46%' ) 
	GROUP BY `hn` 
) AS a 
LEFT JOIN `opday` AS b ON a.`row_id` = b.`row_id` 
LEFT JOIN `opcard` AS d ON d.`hn` = b.`hn` 
LEFT JOIN `dxofyear_out` AS c ON c.`thdatehn` = CONCAT((SUBSTRING(b.`thidate`,1,4) - 543),SUBSTRING(b.`thidate`,5,6),b.`hn`) 
LEFT JOIN ( 
	SELECT * FROM `chk_doctor` WHERE `date_chk` LIKE '2019-04%'
) AS e ON e.`hn` = c.`hn` ";

$db->select($sql);
$items = $db->get_items();

?>

<style>
*{
    font-family:"TH Sarabun New","TH SarabunPSK";
    font-size: 16pt;
}

.chk_table{
    border-collapse: collapse;
}

.chk_table, th, td{
    border: 1px solid black;
    font-size: 16pt;
    padding: 3px;
}
</style>

<div>
    <h3>รายชื่อออก vn</h3>
    <table class="chk_table">
        <tr>
            <th>#</th>
            <th>วันที่</th>
            <th>HN</th>
            <th>ชื่อ-สกุล</th>
            <th>VN</th>
            <th>ออก VN เพื่อ</th>
            <th>สถานะลูกจ้าง</th>
            <th>CAMP</th>
            <th>แพทย์สรุปผล</th>
        </tr>
        <?php 
        $i = 1;
        foreach ($items as $key => $item) { 

            $style = '';
            // $test_chk = false;
            // $match = preg_match('/(EX16|EX46)/', $item['toborow'], $matchs);

            $test_camp = preg_match('/(ลูกจ้าง|ตรวจสุขภาพ)/', $item['camp'], $matchs);

            // if( $match > 0 ){
                // $style = 'style="background-color: #a7ffa7;"';
                // $test_chk = true;

            $regis_warn = '';
                // ถ้าสถานะไม่ใช่ลูกจ้างแต่มีการตรวจ
                if( $item['employee'] == 'n' && $test_camp > 0 ){
                    $regis_warn = 'style="background-color: #fffea7;"';

                }
                
                if( $item['employee'] == 'y' && is_null($item['doctor']) ){
                    $style = 'style="background-color: red;"';
                }


            // }

            ?>
            <tr <?=$style;?>>
                <td><?=$i;?></td>
                <td><?=$item['thidate'];?></td>
                <td><?=$item['hn'];?></td>
                <td><?=$item['ptname'];?></td>
                <td><?=$item['vn'];?></td>
                <td><?=$item['toborow'];?></td>
                <td <?=$regis_warn;?>><?=$item['employee'];?></td>
                <td><?=$item['camp'];?></td>
                <td><?=$item['doctor'];?></td>
            </tr>
            <?php 
            $i++;
        }
        ?>
    </table>
</div>
<?php 

// dxofyear_out

$sql = "SELECT a.*,b.`thidate` AS `opd_date`,b.`hn` AS `opd_hn` 
FROM `tmp_regis` AS a 
LEFT JOIN ( 
    SELECT `thidate`,`hn`,`ptname`,`vn`,CONCAT(( SUBSTRING(`thidate`,1,4) + 543 ),SUBSTRING(`thidate`,5,6),`hn`) AS `date_hn` 
    FROM `dxofyear_out` 
    WHERE `yearchk` = '62' 
    ORDER BY `thidate` ASC 
) AS b ON b.`date_hn` = a.`date_hn` 
ORDER BY a.`hn`,a.`thidate` ASC ";
// dump($sql);
// $db->select($sql);
// $items = $db->get_items();

// dump($items);


