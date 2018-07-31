<?php

include 'bootstrap.php';

if( $_SESSION['smenucode'] != 'ADM' 
AND $_SESSION['smenucode'] != 'ADMCOM' 
AND $_SESSION['smenucode'] != 'ADMNHSO' ){
    echo 'Invalid ';
    exit;
}

$configs = array(
    'host' => '192.168.1.13',
    'port' => '3306',
    'dbname' => 'smdb',
    'user' => 'dottwo',
    'pass' => '12345678'
);

$db = Mysql::load($configs);

$def_date = ( date('Y') + 543 ).date('-m-d');

$date_selected = input_post('date_selected', $def_date);
?>
<style>
@media print{
    .no-print{
        display: none;
    }
}
/* ���ҧ */
body, button{
    font-family: TH SarabunPSK, TH Sarabun NEW;
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
<div class="no-print">
    <div>
        <a href="../nindex.htm">&lt;&lt;&nbsp;˹����ѡ �.�.</a>
    </div>
    <div>
        <form action="ipcard_pt30.php" method="post">
            <div>
                ���͡�ѹ��� : <input type="text" name="date_selected" id="" value="<?=$date_selected;?>">
            </div>
            <div>
                <button type="submit">�ʴ�������</button>
                <input type="hidden" name="task" value="print">
            </div>
        </form>
    </div>
    
</div>

<?php
$task = input_post('task');

if ( $task === 'print' ) {
    
    ?>
    <h3>��ª��ͼ�������Է���30�ҷ</h3>
    <?php

    /**
     * @notice
     * ��������Ҩ��ջѭ�� ����ͧ�ѹ��� 29 ��͹ ��. �ֻ��� ������͡���� condition Ẻ�� �.�.
     */

    $date_for_select = $date_selected.' 23:59:59';

    $sql = "SELECT * 
    FROM `ipcard` 
    WHERE `dcdate` != '0000-00-00 00:00:00' 
    AND `date` LIKE '$date_selected%' 
    AND `ptright` LIKE '%��Сѹ�آ�Ҿ��ǹ˹��%' ";
    $db->select($sql);
    $items = $db->get_items();
    ?>
    <div>
        <h3>�����·�� Admit �ѹ��� <?=$date_selected;?></h3>
        <table class="chk_table">
            <tr>
                <th>�ӴѺ</th>
                <th>�ѹ����Ѻ</th>
                <th>AN</th>
                <th>HN</th>
                <th>����-ʡ��</th>
                <th>D/C</th>
                <th>�ͼ�����</th>
            </tr>
            <?php 
            $i = 1;
            foreach ($items as $key => $item) {
                ?>
                <tr>
                    <td><?=$i;?></td>
                    <td><?=$item['date'];?></td>
                    <td><?=$item['an'];?></td>
                    <td><?=$item['hn'];?></td>
                    <td><?=$item['ptname'];?></td>
                    <td><?=$item['dcdate'];?></td>
                    <td><?=$item['my_ward'];?></td>
                </tr>
                <?php
                $i++;
            }
            ?>
        </table>
    </div>
    <?php


    // �����·���ѧ����� D/C 
    $sql = "SELECT a.*, b.`my_ward` 
    FROM `bed` AS a 
    LEFT JOIN `ipcard` AS b ON b.`an` = a.`an` 
    WHERE a.`an` != ''  
    AND a.`ptright` LIKE '%��Сѹ�آ�Ҿ��ǹ˹��%'";
    $db->select($sql);
    $items = $db->get_items();

    ?>
    <div>
        <h3>�����·���ѧ�͹����</h3>
        <table class="chk_table">
            <tr>
                <th>�ӴѺ</th>
                <th>�ѹ����Ѻ</th>
                <th>AN</th>
                <th>HN</th>
                <th>����-ʡ��</th>
                <th>�ͼ�����</th>
            </tr>
        <?php 
        $i = 1;
        foreach ($items as $key => $item) {
            ?>
            <tr>
                <td><?=$i;?></td>
                <td><?=$item['date'];?></td>
                <td><?=$item['an'];?></td>
                <td><?=$item['hn'];?></td>
                <td><?=$item['ptname'];?></td>
                <td><?=$item['my_ward'];?></td>
            </tr>
            <?php
            $i++;
        }
        ?>
        </table>
    </div>
    <?php
}