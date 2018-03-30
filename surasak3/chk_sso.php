<?php

include 'bootstrap.php';

$page = input('page');
$action = input_post('action');
$db = Mysql::load();

$date = input_post('date_search', date('Y-m-d'));

if( empty($page) ){

    include 'chk_menu.php';
    ?>
    <form action="chk_sso.php" method="post">
        <div>
            ���� <input type="text" name="date_search" id="" value="<?=$date;?>">
            <div>�ٻẺ��ä��� ��-��͹-�ѹ �� 2017-01-25</div>
        </div>

        <div>
            <button type="submit">�ӡ�ä���</button>
            <input type="hidden" name="action" value="search">
        </div>
    </form>
    <?php
    if( $action == "search" ){
        
        $sql = "SELECT *, CONCAT(`prefix`,`name`,' ',`surname`) AS `ptname` 
        FROM `chk_doctor` 
        WHERE `date_chk` LIKE '$date%' ";
        $db->select($sql);

        $items = $db->get_items();

        ?>
        <table class="chk_table">
            <tr>
                <th>#</th>
                <th>HN</th>
                <th>����-ʡ��</th>
                <th>�ѹ����Ǩ</th>
                <th colspan="2">�����</th>
            </tr>
        <?php 
        $i = 1;
        foreach ($items as $key => $item) {

            $vn = $item['vn'];
            list($date, $time) = explode(' ', $item['date_chk']);
            $hn = $item['hn'];
            ?>
            <tr>
                <td><?=$i;?></td>
                <td><?=$item['hn'];?></td>
                <td><?=$item['ptname'];?></td>
                <td><?=$item['date_chk'];?></td>
                <td><a href="chk_doctor_sticker.php?hn=<?=$hn;?>&vn=<?=$vn;?>&date=<?=$date;?>" target="_blank">Sticker</a></td>
                <td><a href="chk_doctor_print.php?hn=<?=$hn;?>&vn=<?=$vn;?>&date=<?=$date;?>" target="_blank">���§ҹ��</a></td>
            </tr>
            <?php
            $i++;
        }
        ?>
        </table>
        <?php
    }
    


}