<?php 
include '../bootstrap.php';
include 'head.php';

$db = Mysql::load();

$sql = "SELECT * FROM `43women` ORDER BY `id` DESC ";
$db->select($sql);
if ( $db->get_rows() > 0 ) {

    $items = $db->get_items();
    ?>
    <div class="clearfix">
        <h1 style="margin:0;">��§ҹ WOMEN</h1> <span>������˭ԧ�����ԭ�ѹ���������Թ�Ѻ����</span>
    </div>
    <table class="chk_table">
        <tr>
            <th>HOSPCODE</th>
            <th>PID</th>
            <th>FPTYPE</th>
            <th>NOFPCAUSE</th>
            <th>TOTALSON</th>
            <th>NUMBERSON</th>
            <th>ABORTION</th>
            <th>STILLBIRTH</th>
            <th>D_UPDATE</th>
            <th>CID</th>
            <td>��Ѻ��ا</td>
        </tr>
    <?php 
    foreach ($items as $key => $item) {
        ?>
        <tr>
            <td><?=$item['HOSPCODE'];?></td>
            <td><?=$item['PID'];?></td>
            <td><?=$item['FPTYPE'];?></td>
            <td><?=$item['NOFPCAUSE'];?></td>
            <td><?=$item['TOTALSON'];?></td>
            <td><?=$item['NUMBERSON'];?></td>
            <td><?=$item['ABORTION'];?></td>
            <td><?=$item['STILLBIRTH'];?></td>
            <td><?=$item['D_UPDATE'];?></td>
            <td><?=$item['CID'];?></td>
            <td><a href="women.php?page=search&hn=<?=$item['PID'];?>">���</a></td>
        </tr>
        <?php
    }
}else{
    ?>
    <p>��辺������</p>
    <?php
}