<?php 
include '../bootstrap.php';
include 'head.php';

$db = Mysql::load();

$sql = "SELECT * FROM `43policy` ORDER BY `id` DESC ";
$db->select($sql);
if ( $db->get_rows() > 0 ) {

    $items = $db->get_items();
    ?>
    <div class="clearfix">
        <h1 style="margin:0;">��§ҹ POLICY</h1> <span>�����ŨѴ�纵����º��(����ͺ��������á�Դ)</span>
    </div>
    <table class="chk_table">
        <tr>
            <th class="warning">HOSPCODE</th>
            <th class="warning">POLICY_ID</th>
            <th class="warning">POLICY_YEAR</th>
            <th class="warning">POLICY_DATA</th>
            <th class="warning">D_UPDATE</th>
            <td>��Ѻ��ا</td>
        </tr>
    <?php 
    foreach ($items as $key => $item) {
        ?>
        <tr>
            <td class="warning"><?=$item['hospcode'];?></td>
            <td class="warning"><?=$item['policy_id'];?></td>
            <td class="warning"><?=$item['policy_year'];?></td>
            <td class="warning"><?=$item['policy_data'];?></td>
            <td class="warning"><?=$item['d_update'];?></td>
            <td><a href="javascript:void(0);">���</a></td>
        </tr>
        <?php
    }
}else{
    ?>
    <p>��辺������</p>
    <?php
}