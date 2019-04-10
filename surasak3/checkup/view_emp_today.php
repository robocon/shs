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
SELECT b.`thidate`, b.`hn`, b.`ptname`, b.`vn`, b.`date_hn`,b.`toborow` 
FROM ( 
    SELECT `hn` 
    FROM `opcard` 
    WHERE `employee` = 'y'
) AS a 
LEFT JOIN ( 
    SELECT `row_id`,`thidate`,`hn`,`ptname`,`vn`,`age`,`toborow`,CONCAT(SUBSTRING(`thidate`,1,10),`hn`) AS `date_hn`
    FROM `opday` 
    WHERE `thidate` >= '2562-04-01 00:00:00' AND `thidate` <= '2562-04-12 23:23:59' 
    #AND ( `toborow` LIKE 'EX16%' OR `toborow` LIKE 'E46%' ) 

) AS b ON b.`hn` = a.`hn` 
WHERE b.`row_id` IS NOT NULL 
ORDER BY b.`thidate` ASC;";
// dump($sql);
$db->exec($sql);


// $sql = "SELECT * FROM `tmp_regis`"; 

$sql = "SELECT a.*,b.`thidate` AS `opd_date`,b.`hn` AS `opd_hn` 
FROM `tmp_regis` AS a 
LEFT JOIN ( 
    SELECT `thidate`,`hn`,`ptname`,`vn`,CONCAT(( SUBSTRING(`thidate`,1,4) + 543 ),SUBSTRING(`thidate`,5,6),`hn`) AS `date_hn` 
    FROM `dxofyear_out` 
    WHERE `yearchk` = '62' 
    ORDER BY `thidate` ASC 
) AS b ON b.`date_hn` = a.`date_hn` 
ORDER BY a.`hn`,a.`thidate` ASC ";

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
            <th>vn</th>
            <th>ออกเพื่อ</th>
            <th>opd date</th>
            <th>opd hn</th>
            <th>Doctor</th>
        </tr>
        <?php 
        $i = 1;
        foreach ($items as $key => $item) { 

            $hn = $item['hn'];
            $date_hn = $item['date_hn'];

            $sql = "SELECT `hn`,`date_chk` 
            FROM `chk_doctor` 
            WHERE CONCAT(( SUBSTRING(`date_chk`,1,4) + 543 ),SUBSTRING(`date_chk`,5,6),`hn`) = '$date_hn' ";
            $db->select($sql);
            $rows = $db->get_rows();
            $date_chk = '';
            $chk_dt = '';
            if( $rows > 0 ){
                $chk_dt = $db->get_item();
                $date_chk = $chk_dt['date_chk'];
            }
            

            $style = '';
            // $test_chk = false;
            $match = preg_match('/(EX16|EX46)/', $item['toborow'], $matchs);
            if( $match > 0 ){
                // $style = 'style="background-color: #a7ffa7;"';
                // $test_chk = true;

                if( !empty($item['opd_date']) ){
                    $style = 'style="background-color: #a7ffa7;"';
                }else{
                    $style = 'style="background-color: #ffafaf;"';
                }


            }








            ?>
            <tr <?=$style;?>>
                <td><?=$i;?></td>
                <td><?=$item['thidate'];?></td>
                <td><?=$item['hn'];?></td>
                <td><?=$item['ptname'];?></td>
                <td><?=$item['vn'];?></td>
                <td><?=$item['toborow'];?></td>
                <td><?=$item['opd_date'];?></td>
                <td><?=$item['opd_hn'];?></td>
                <td><?=$date_chk;?></td>
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


