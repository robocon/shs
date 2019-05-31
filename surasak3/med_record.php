<?php

include 'bootstrap.php';
$db = Mysql::load();

// dump($db);
// $db->exec("SET NAMES TIS620");

$ward_lists = array(
    42 => '�ͼ���������á���', 43 => '�ͼ������ٵ�', 44 => '�ͼ�����ICU', 45 => '�ͼ����¾����'
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
/* ���ҧ */
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
    <a href="../nindex.htm">&lt;&lt;˹����ѡ ����� þ.�</a>
</div>

<div>
    <h3 style="margin: 0; font-size: 24pt;">�к������� Medication record �ҡ Drug profile</h3>
</div>

<table class="chk_table">
    <tr>
        <th>#</th>
        <th>Bedcode</th>
        <th>��§</th>
        <th>HN</th>
        <th>AN</th>
        <th>����-ʡ��</th>
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
        
        // ������繪��3 ���������繪��2
        $wardR3Test = preg_match('/R3\d+|B\d+/', $item['bedcode']);
        $wardBxTest = preg_match('/B[0-9]+/', $item['bedcode']);
        $exName = ( $wardR3Test > 0 OR $wardBxTest > 0 ) ? '���3' : '���2' ;
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
            <a href="med_record_detail.php?an=<?=urlencode($item['an']);?>" target="_blank">�����</a>
        </td>
    </tr>
    <?php
    $i++;

}
?>
</table>