<?php 

include 'bootstrap.php';

// $shs_configs = array(
//     'host' => '192.168.1.13',
//     'port' => '3306',
//     'dbname' => 'smdb',
//     'user' => 'remoteuser',
//     'pass' => ''
// );

$db = Mysql::load();

include 'chk_menu.php'; 

$part = input('part');

$sql = "SELECT b.`hn`,b.`ptname`,CONCAT(b.`item_sso`,',',a.`item_sso`) AS `new_sso` 
FROM ( 
	SELECT * FROM `chk_lab_items` WHERE `part` = '$part' AND `item_sso` = 'bs' 
) AS a 
LEFT JOIN ( 
	SELECT * FROM `chk_lab_items` WHERE `part` = '$part' AND `item_sso` != 'bs' 
) AS b ON b.`hn` = a.`hn`";
$db->select($sql);
$row = $db->get_rows();

if( $row > 0 ){

    ?>
    <h3>���ͺ �ʴ���������´�������·���ͧ�ԡ�Ѻ��Сѹ�ѧ�� <?=$part;?></h3>
    <?php

    $items = $db->get_items();

    $test_count = 0;
    $new_header = array(); // header
    $new_item = array();

    foreach ($items as $key => $item) {
        
        $lists = explode(',', $item['item_sso']);

        foreach($lists as $key_list => $item_list){
            $item_list = strtolower($item_list);
            $item_list = str_replace('-sso','', $item_list);

            if( !in_array($item_list, $new_header) ){
                $new_header[] = $item_list;
            }
            
        }

        $item['item_sso'] = strtolower($item['item_sso']);

    }

    /**
     * ���� HEADER �ԡ����
     */
    $new_header = array(
        'CBC' => 'cbc',
        'UA' => 'ua',
        'GLU' => 'bs',
        'CREA' => 'cr',
        'CHOL' => 'chol',
        'HDL' => 'hdl',
        'HBsAg' => 'hbsag',
        // 'pap' => 'pap',
        // 'via' => 'via',
        'OCCULT' => 'stocb',
        'X-Ray' => 'cxr'
    );

    $item_price = array(
        'cbc' => 80,
        'ua' => 50,
        'bs' => 40,
        'cr' => 45,
        'chol' => 100,
        'hdl' => 100,
        'hbsag' => 130,
        'stocb' => 30,
        'cxr' => 200
    );

    $test_count = count($new_header);
    ?>
    <style>
    .chk_table{
        font-family: "TH Sarabun New","TH SarabunPSK";
        font-size: 16pt;
        border-collapse: collapse;
    }

    .chk_table th,
    .chk_table td{
        border: 1px solid black;
        padding: 3px;
    }

    </style>
    <table border="1" class="chk_table">
        <thead>
            <tr>
                <th rowspan="2">#</th>
                <th rowspan="2">HN</th>
                <th rowspan="2">����-ʡ��</th>
                <th colspan="<?=$test_count;?>">��¡�õ�Ǩ</th>
                <th rowspan="2">���</th>
            </tr>
            <tr>
                <?php 
                foreach ($new_header as $key => $head) {
                    ?>
                    <th><?=$key;?></th>
                    <?php
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php 
            $i = 1;
            $over_all = 0;
            foreach ($items as $key => $item) {
                $item_sso = strtolower($item['new_sso']);
                $item_sso = str_replace('-sso','', $item_sso);

                $sso_array = explode(',', $item_sso);
            ?>
            <tr>
                <td><?=$i;?></td>
                <td><?=$item['hn'];?></td>
                <td><?=$item['ptname'];?></td>
                
                <?php 
                $total = 0;
                // ��Ңͧ���� user ����º�ա�� ���ǵ����Ҥ�
                foreach ($new_header as $key_head => $head) {

                    $test = '';

                    if( in_array($head, $sso_array) ){
                        
                        $test = $head;
                        $total += (int) $item_price[$test];
                    }

                    ?>
                    <td style="text-align:right;"><?=number_format($item_price[$test],2);?></td>
                    
                    <?php
                }

                $over_all += $total;
                ?>
                
                <td style="text-align:right;"><?=number_format($total, 2);?></td>
            </tr>
            <?php 
            $i++;
            }
            ?>
            <tr>
                <td style="text-align: center;" colspan="12"><b>���������</b></td>
                <td><?=number_format($over_all, 2);?></td>
            </tr>
        </tbody>
    </table>

    <?php 

}else{
    ?>
    <p>��辺������</p>
    <?php
}