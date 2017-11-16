<?php

include 'bootstrap.php';

$page = input('page');
$db = Mysql::load();

if( $page == false ){
    include 'chk_menu.php';

    $part = input_get('part');

    $sql = "SELECT * FROM `chk_company_list` WHERE `code` = '$part'";
    $db->select($sql);
    $company = $db->get_item();

    $sql = "SELECT *, `HN` AS `hn`  
    FROM `opcardchk` 
    WHERE `part` = '$part' ";
    $db->select($sql);
    $items = $db->get_items();
    $rows = $db->get_rows();
    if( $rows > 0 ){

        ?>
        <h3>��ª��ͼ���Ǩ�آ�Ҿ - <?=$company['name'];?></h3>
        <table class="chk_table">
            <tr>
                <th>#</th>
                <th>HN</th>
                <th>����ʡ��</th>
                <th>�Ţ�ѵû�ЪҪ�</th>
                <th>����</th>
                <th></th>
                <th></th>
            </tr>
            <?php
            $i = 1;
            foreach ($items as $key => $item) {
                ?>
                <tr>
                    <td><?=$i;?></td>
                    <td><?=$item['hn'];?></td>
                    <td><?=$item['name'];?> <?=$item['surname'];?></td>
                    <td><?=$item['idcard'];?></td>
                    <td><?=$item['agey'];?></td>
                    <td><a href="chk_user.php?page=form&id=<?=$item['row'];?>">���</a></td>
                    <td><a href="chk_lab.php?page=form&id=<?=$item['row'];?>">��Ѻ���Ż</a></td>
                </tr>
                <?php
                $i++;
            }
            ?>
        </table>
        <?php

    }else{
        ?>
        <p>��辺�����Ź����</p>
        <?php
    }

}