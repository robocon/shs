<?php

include 'bootstrap.php';
$db = Mysql::load();

// dump($db);
// $db->exec("SET NAMES TIS620");

$ward_lists = array(
    42 => 'หอผู้ป่วยอายุรกรรม', 43 => 'หอผู้ป่วยสูติ', 44 => 'หอผู้ป่วยICU', 45 => 'หอผู้ป่วยพิเศษ'
);

$code = input_get('code');
$where_code = "";
if( !empty($code) ){
    $where_code = "AND `bedcode` LIKE '$code%' ";
}

$sql = "SELECT * 
FROM `bed` 
WHERE `ptname` != '' 
$where_code 
AND `hn` != '' 
ORDER BY `row_id` ASC ";
$db->select($sql);

$items = $db->get_items();

?>

<style>
*{
    font-family: TH Sarabun New, TH SarabunPSK;
    font-size: 16pt;
}
/* ตาราง */
.chk_table{
    border-collapse: collapse;
}

.chk_table, th, td{
    border: 1px solid black;
}

.chk_table th,
.chk_table td{
    padding: 3px;
}
</style>

<div>
    <a href="../nindex.htm">&lt;&lt;หน้าหลัก โปรแกรม รพ.ฯ</a>
</div>

<div>
    <h3 style="margin: 0; font-size: 24pt;">ระบบพิมพ์ใบ Medication record จาก Drug profile</h3>
</div>

<table class="chk_table">
    <tr>
        <th>#</th>
        <th>Bedcode</th>
        <th>เตียง</th>
        <th>HN</th>
        <th>AN</th>
        <th>ชื่อ-สกุล</th>
        <th></th>
    </tr>
<?php 
$i = 1;
// dump($items);
foreach ($items as $key => $item) { 

    $ward_code = substr($item['bedcode'], 0, 2);
    $ward_name = $ward_lists[$ward_code];

    $wardExTest = preg_match('/45.+/', $item['bedcode']);
    if( $wardExTest > 0 ){
        
        // เช็กว่าเป็นชั้น3 ถ้าไม่ใช่เป็นชั้น2
        $wardR3Test = preg_match('/R3\d+|B\d+/', $item['bedcode']);
        $wardBxTest = preg_match('/B[0-9]+/', $item['bedcode']);
        $exName = ( $wardR3Test > 0 OR $wardBxTest > 0 ) ? 'ชั้น3' : 'ชั้น2' ;
        $ward_name = $ward_name.' '.$exName;
    }


    ?>
    <tr>
        <td><?=$i;?></td>
        <td><?=$ward_name;?></td>
        <td><?=$item['bed'];?></td>
        <td><?=$item['hn'];?></td>
        <td><?=$item['an'];?></td>
        <td><?=$item['ptname'];?></td>
        <td>
            <a href="med_record_detail.php?an=<?=urlencode($item['an']);?>" target="_blank">พิมพ์</a>
        </td>
    </tr>
    <?php
    $i++;

}
?>
</table>