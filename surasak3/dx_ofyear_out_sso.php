<?php

include 'bootstrap.php';

$def_date = input('date', date('Y-m-d'));
$action = input('action');
?>
<style type="text/css">
*{
    font-family: 'TH SarabunPSK';
}
@media print{
    .no-print{
        display: none;
    }
}

</style>

<div class="no-print">
    <a href="../nindex.htm">&lt;&lt;&nbsp;��Ѻ�˹������� þ.</a>
</div>
<br>
<form action="dx_ofyear_out_sso.php" method="post" class="no-print">

    <div>
        ���͡�ѹ��� <input type="text" name="date" id="" value="<?=$def_date;?>">
    </div>

    <div>
        <button type="submit">�ʴ�������</button>
        <input type="hidden" name="action" value="show">
    </div>

</form>

<?php
if( $action === 'show' ){

    $match = preg_match('/\d{4,4}\-\d{2,2}\-\d{2,2}/', $def_date);
    if( $match == 0 ){
        echo "��س����͡�ٻẺ�ѹ����� ��-��͹-�ѹ �� 2017-12-25 �繵�";
        exit;
    }

    $db = Mysql::load();

    $sql = "SELECT * FROM `dxofyear_out` WHERE `thidate` LIKE '$def_date%' ";
    $db->select($sql);
    $items = $db->get_items();
    if( count($items) > 0 ){
        
        ?>
        <h3>��ª��ͼ���Ǩ�آ�Ҿ Walk-in �ѹ��� <?=$def_date;?></h3>
        <table border="1" cellpadding="3" cellspacing="0" bordercolor="#393939" bgcolor="#ffffff">
            <tr>
                <th>#</th>
                <th>�ѹ���</th>
                <th>HN</th>
                <th>����-ʡ��</th>
                <th>�٧(cm.)</th>
                <th>��.(kg.)</th>
                <th>T(C.)</th>
                <th>pause</th>
                <th>rate</th>
                <th>bmi</th>
                <th>bp1</th>
                <th>bp2</th>
                <th>CBC</th>
                <th>UA</th>

            </tr>
        <?php
        $i = 1;
        foreach ($items as $key => $item) {

            $sql = "SELECT `res_cbc`,`res_ua` 
            FROM `chk_doctor` 
            WHERE `hn` = '".$item['hn']."' 
            AND `vn` = '".$item['vn']."' ";

            $db->select($sql);
            $user = $db->get_item();

            $final_cbc = '';
            $final_ua = '';

            if( !empty($user['res_cbc']) ){
                $final_cbc = ( $user['res_cbc'] == '1' ) ? '����' : '�Դ����' ;
            }

            if( !empty($user['res_ua']) ){
                $final_ua = ( $user['res_ua'] == '1' ) ? '����' : '�Դ����' ;
            }
            ?>
            <tr>
                <td><?=$i;?></td>
                <td><?=$item['thidate'];?></td>
                <td><?=$item['hn'];?></td>
                <td><?=$item['ptname'];?></td>
                <td align="right"><?=$item['height'];?></td>
                <td align="right"><?=$item['weight'];?></td>
                <td align="right"><?=$item['temperature'];?></td>
                <td align="right"><?=$item['pause'];?></td>
                <td align="right"><?=$item['rate'];?></td>
                <td align="right"><?=$item['bmi'];?></td>
                <td align="right"><?=$item['bp1'];?></td>
                <td align="right"><?=$item['bp2'];?></td>
                <td><?=$final_cbc;?></td>
                <td><?=$final_ua;?></td>
            </tr>
            <?php
            $i++;
        }
        ?>
        </table>
        <?php
    }else{
        ?>
        <p>��辺������</p>
        <?php
    }
}