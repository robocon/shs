<?php 
include 'bootstrap.php';
$shs_configs = array(
    'host' => '192.168.1.13',
    'port' => '3306',
    'dbname' => 'smdb',
    'user' => 'dottow',
    'pass' => ''
);
$db = Mysql::load($shs_configs);

$def_start = (date('Y')+542).date('-m-d');
$def_end = (date('Y')+543).date('-m-d');

$start_date = input_post('start_date', $def_start);
$end_date = input_post('end_date', $def_end);

?>
<style>
*{
    font-family: "TH Sarabun New","TH SarabunPSK";
    font-size: 16px;
}
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
@media print{
    .no_display{
        display: none;
    }
}

</style>
<div class="no_display">
    <a href="../nindex.htm">&lt;&lt;&nbsp;��Ѻ˹����ѡ �.�.</a>
</div>
<fieldset class="no_display">
    <legend>���͡������</legend>
    <form action="report_heart_failure.php" method="post">
        <div>
            �ѹ���������� <input type="text" name="start_date" value="<?=$start_date;?>">
        </div>

        <div>
            �ѹ�������ش <input type="text" name="end_date" value="<?=$end_date;?>">
        </div>

        <div>
            <button type="submit">�ʴ���</button>
            <input type="hidden" name="action" value="report">
        </div>
    </form>
    <div>
        <div>���͹�㹡�ô֧������</div>
        <ol style="margin: 0;">
            <li>ICD10 I213, I214, I509</li>
            <li>�����բ�ͤ������仹�� "NSTEMI", "myocardial infarction", "heart failure"</li>
        </ol>
    </div>
</fieldset>

<?php 

$action = input_post('action');
if( $action == 'report' ){

    $sql = "SELECT a.*, CONCAT(b.`yot`,b.`name`,' ',b.`surname`) AS `ptname`,b.`phone`,b.`ptffone`,b.`hphone`  
    FROM `diag` AS a 
    LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
    WHERE ( a.`regisdate` >= '$start_date 00:00:00' AND a.`regisdate` <= '$end_date 00:00:00' ) 
    AND ( 
        a.`icd10` IN ('I213','I214','I509') 
        OR 
        ( 
            a.`diag` LIKE '%NSTEMI%' 
            OR a.`diag` LIKE '%myocardial infarction%' 
            OR a.`diag` LIKE '%heart failure%' 
        ) 
    ) ";
    $db->select($sql);
    $items = $db->get_items();

    ?>
    <h3>��ª��ͼ������ä���㨵��ICD10</h3>
    <table class="chk_table">
        <thead>
            <tr>
                <th>�ѹ���</th>
                <th>HN</th>
                <th>����-ʡ��</th>
                <th>������</th>
                <th>�����íҵ�</th>
                <th>Diag</th>
                <th>ICD10</th>
                <th>TYPE</th>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach ($items as $key => $item) {
            ?>
            <tr>
                <td><?=$item['regisdate'];?></td>
                <td><?=$item['hn'];?></td>
                <td><?=$item['ptname'];?></td>
                <td><?=$item['phone'].' '.$item['hphone'];?></td>
                <td><?=$item['ptffone'];?></td>
                <td><?=$item['diag'];?></td>
                <td><?=$item['icd10'];?></td>
                <td><?=$item['type'];?></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <?php

}