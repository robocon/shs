<?php 

include 'bootstrap.php';
include 'includes/JSON.php';

$db = Mysql::load();

$limit = '100';

$sql = "SELECT a.*,b.`thidate`,b.`age`,b.`ptname` 
FROM `policy` AS a 
LEFT JOIN `opday` AS b ON b.`row_id` = a.`opday_id` 
LIMIT $limit";
$db->select($sql);

$items = $db->get_items();

$json = new Services_JSON();


?>
<div>
    <a href="../nindex.htm">˹����ѡ�.�.</a> | <a href="policy.php">˹��ŧ������ policy</a>
</div>
<style>
*{
    font-family: TH Sarabun New, TH SarabunPSK;
    font-size: 16pt;
}
h1{
    font-size: 28pt;
}
.chk_table{
    border-collapse: collapse;
}

.chk_table th,
.chk_table td{
    border: 1px solid black;
    font-size: 16pt;
    padding: 3px;
}
</style>
<div>
    <h1>�٢�������� policy</h1>
</div>
<table class="chk_table">
    <tr>
        <th>�ѹ������Ѻ��ԡ��</th>
        <th>����-ʡ��</th>
        <th>�/�/� �Դ</th>
        <th>����</th>
        <th>�ͺ�������(��.)</th>
    </tr>
    <?php
    foreach ($items as $key => $item) {
        
        $data = $json->decode($item['policy_data']);

        $birthday = $data->BDATE;

        $y = substr($birthday,0,4);
        $m = substr($birthday,4,2);
        $d = substr($birthday,6,2);

        $hc = $data->HC;
        
        ?>
        <tr>
            <td><?=$item['thidate'];?></td>
            <td><?=$item['ptname'];?></td>
            <td><?=$d.'-'.$m.'-'.($y + 543);?></td>
            <td><?=$item['age'];?></td>
            <td><?=$hc;?></td>
        </tr>
        <?php
    }
    ?>
</table>



