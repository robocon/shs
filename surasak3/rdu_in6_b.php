<?php 
include dirname(__FILE__).'/bootstrap.php';
define('RDU_TEST', '1');
$db = Mysql::load();

$dateStartTh = $_GET['date_start'];
$dateEndTh = $_GET['date_end'];

$date_start = bc_to_ad($dateStartTh);
$date_end = bc_to_ad($dateEndTh);

include dirname(__FILE__).'/rdu_core.php';
include dirname(__FILE__).'/rdu_in6.php';

// $year = input_get('year');
// $quarter = input_get('quarter');

// $db = Mysql::load();
// $db->exec("SET NAMES UTF8");
// $date = input_get('date');


// $sql = "CREATE TEMPORARY TABLE `tmp_diag_in6_a` 
// SELECT `diag_id` AS `row_id` ,`svdate` AS `date`,`hn`,`icd10`,`diag`,`doctor`,`date_hn`,`ptname`,`age` 
// FROM `rdu_diag` 
// WHERE `date_en` LIKE '$date%' 
// AND ( 
//     `icd10` IN ( 'J00', 'J010', 'J011', 'J012', 'J013', 'J014', 'J018', 'J019' ) 
//     OR `icd10` IN ( 'J020', 'J029' ) 
//     OR `icd10` IN ( 'J030', 'J038', 'J039' ) 
//     OR `icd10` IN ( 'J040', 'J041', 'J042' ) 
//     OR `icd10` IN ( 'J050', 'J051' ) 
//     OR `icd10` IN ( 'J060', 'J068', 'J069' ) 
//     OR `icd10` IN ( 'J101', 'J111' ) 
//     OR `icd10` LIKE 'J20%' 
//     OR `icd10` IN ( 'J210', 'J218', 'J219' ) 
//     OR `icd10` IN ( 'H650','H651','H659','H660','H664','H669','H670','H671','H678','H720','H721','H722','H728','H729' )
// ) 
// GROUP BY `date_hn`";
// $db->exec($sql);

// $sql = "SELECT * FROM `tmp_diag_in6_a`";
// $db->select($sql);
// $items = $db->get_items();

$items = $items_b;


?> 

<style>
/* ตาราง */
body, button{
    font-family: "TH Sarabun New","TH SarabunPSK";
    font-size: 16pt;
}
.chk_table{
    border-collapse: collapse;
}

.chk_table, th, td{
    border: 1px solid black;
    font-size: 16pt;
}

.chk_table th,
.chk_table td{
    padding: 3px;
}
</style>

<h3><u>ตัวชี้วัดที่ 6</u> ตัวหาร จำนวนครั้งที่มารับบริการของผู้ป่วยนอกโรคติดเชื้อที่ระบบการหายใจช่วงบนและหลอดลมอักเสบเฉียบพลันทั้งหมด</h3> 

<table class="chk_table">
    <tr>
        <th>#</th>
        <th>Date</th>
        <th>HN</th>
        <th>ชื่อผู้ป่วย</th>
        <th>อายุ</th>
        <th>Diag1</th>
        <th>ICD-10</th>
        <th>แพทย์</th>
    </tr>
    <?php 
    $i = 1;
    $doctorList = array();
    foreach ($items as $key => $item) {
        $doctorKey = $item['doctor'];
        if(!$doctorList[$doctorKey]){
            $doctorList[$doctorKey] = 1;
        }else{
            $doctorList[$doctorKey]++;
        }
        ?>
        <tr>
            <td><?=$i;?></td>
            <td><?=$item['svdate'];?></td>
            <td><?=$item['hn'];?></td>
            <td><?=$item['ptname'];?></td>
            <td><?=$item['age'];?></td>
            <td><?=$item['diag'];?></td>
            <td><?=$item['icd10'];?></td>
            <td><?=$item['doctor'];?></td>
        </tr>
        <?php 
        $i++;
    }
    ?>
</table>

<?php 
arsort($doctorList);
// exit;

// $sql = "SELECT `doctor`,COUNT(`doctor`) AS `count_dr` FROM `tmp_diag_in6_a` GROUP BY `doctor` ORDER BY COUNT(`doctor`) DESC";
// $db->select($sql);
// $items = $db->get_items();
?>
<table class="chk_table" style="margin-top:8px;">
    <tr>
        <th>ชื่อแพทย์</th>
        <th>จำนวน</th>
    </tr>
    <?php 
    foreach ($doctorList as $key => $value) {
        ?>
        <tr>
            <td><?=$key;?></td>
            <td><?=$value;?></td>
        </tr>
        <?php
    }
    ?>
</table>
<?php 
$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_diag_in6_a`");