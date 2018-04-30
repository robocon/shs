<?php

include 'bootstrap.php';

$page = input('page');
$action = input_post('action');
$db = Mysql::load();

$date = input_post('date_search', date('Y-m-d'));
$hn_search = input_post('hn_search');

if( empty($page) ){

    include 'chk_menu.php';
    ?>
    <div style="content: ''; display: table; clear: both; width: 100%;">
        <fieldset style="width: 30%; float: left;">
            <legend>���ҵ���ѹ���</legend>
            <form action="chk_sso.php" method="post">
                <div>
                    ���� <input type="text" name="date_search" id="" value="<?=$date;?>">
                    <div>�ٻẺ��ä��� ��-��͹-�ѹ �� 2017-01-25</div>
                </div>

                <div>
                    <button type="submit">�ӡ�ä���</button>
                    <input type="hidden" name="action" value="search">
                    <input type="hidden" name="by" value="date">
                </div>
            </form>
        </fieldset>
        <fieldset style="width: 30%; float: left;">
            <legend>���ҵ�� HN</legend>
            <form action="chk_sso.php" method="post">
                <div>
                    ���� <input type="text" name="hn_search" id="" value="<?=$hn_search;?>">
                </div>
                <div>
                    <button type="submit">�ӡ�ä���</button>
                    <input type="hidden" name="action" value="search">
                    <input type="hidden" name="by" value="hn">
                </div>
            </form>
        </fieldset>
    </div>
    <?php
    if( $action == "search" ){

        $by = input_post('by');
        
        if( $by === 'date' ){
            $where = "`date_chk` LIKE '$date%'";
        }else if( $by === 'hn' ){

            $where = "`hn` = '$hn_search'";

        }
        
        $sql = "SELECT *, CONCAT(`prefix`,`name`,' ',`surname`) AS `ptname` 
        FROM `chk_doctor` 
        WHERE $where 
        ORDER BY `id` ASC ";
        $db->select($sql);

        $items = $db->get_items();
        if( count($items) > 0 ){

        
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
        }else{
            ?>��辺�����ŷ�����<?php
        }
    }
    


}