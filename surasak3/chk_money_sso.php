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

$part = input('part');

$item_price = array(
    'cbc' => 80,
    'ua' => 50,
    'bs' => 40,
    'cr' => 40,
    'chol' => 200,
    'hdl' => 200,
    'hbsag' => 130,
    'stocb' => 30,
    'x-ray' => 200
);

$sql = "SELECT * FROM `chk_lab_items` WHERE `part` = 'ราชภัฎ61' ORDER BY `id` ASC ";
$db->select($sql);
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
 * หรือ HEADER ฟิกไปเลย
 */
$new_header = array(
    'cbc' => 'cbc',
    'ua' => 'ua',
    'bs' => 'bs',
    'cr' => 'cr',
    'chol/hdl' => 'chol',
    'hbsag' => 'hbsag',
    'stocb' => 'stocb',
    'x-ray' => 'x-ray'
);



$test_count = count($new_header);
?>
<table border="1">
    <thead>
        <tr>
            <th rowspan="2">#</th>
            <th rowspan="2">HN</th>
            <th rowspan="2">ชื่อ-สกุล</th>
            <th colspan="<?=$test_count;?>">รายการตรวจ</th>
            <th rowspan="2">รวม</th>
        </tr>
        <tr>
            <?php 
            foreach ($new_header as $key => $head) {
                ?>
                <th><?=$head;?></th>
                <?php
            }
            ?>
        </tr>
    </thead>
    <tbody>
        <?php 
        $i = 1;
        foreach ($items as $key => $item) {
            $item_sso = strtolower($item['item_sso']);
            $item_sso = str_replace('-sso','', $item_sso);

            $sso_array = explode(',', $item_sso);
        ?>
        <tr>
            <td><?=$i;?></td>
            <td><?=$item['hn'];?></td>
            <td><?=$item['ptname'];?></td>
            <!-- for -->
            <?php 

            // เอาของแต่ละ user มาเทียบอีกที แล้วตีเป็นราคา
            foreach ($new_header as $key_head => $head) {

                $test = '';
                if( in_array($head, $sso_array) ){
                    $test = $head;
                }

                ?>
                <td><?=$item_price[$test];?></td>
                <?php
            }
            ?>
            <!-- for -->
            <td></td>
        </tr>
        <?php 
        $i++;
        }
        ?>
    </tbody>
</table>