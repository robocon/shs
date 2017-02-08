<?php

include 'bootstrap.php';

// include 'templates/classic/header.php';


if($_SESSION['sIdname'] !== '�صԡҭ���' AND $_SESSION['smenucode'] !== 'ADM'){
    echo "�������ö�����ҹ��<br>��سҵԴ��� �س ��صԡҭ���(���Ѫ��)";
    exit;
}

$year_range = range('2004', date('Y'));

$select_day = input_post('select_day', date('d'));
$select_month = input_post('select_month', date('m'));
$select_year = input_post('select_year', date('Y'));
?>
<div class="col no-print">
    <div class="cell">
        <a href="../nindex.htm">˹����ѡþ.</a>
    </div>
</div>
<div class="col no-print">
    <div class="cell">
        <h3>Addict</h3>
        <div>
            <form action="dx_addict.php" method="post">
                <div class="col">
                    <div class="cell">
                        �ѹ <input type="text" name="select_day" value="<?=$select_day;?>" style="width: 50px;">
                        ��͹ <?php getMonthList('select_month', $select_month); ?> 
                        �� <?php getYearList('select_year', true, $select_year, $year_range); ?> 
                        <span style="color: red; display: block; font-size: 12px;">* ������ҧ�ѹ��� 01</span>
                        <span style="color: red; display: block; font-size: 12px;">** ��ͧ����ʴ�����͹���ź�ѹ����͡</span>
                    </div>
                </div>
                <div class="col">
                    <div class="cell">
                        <button type="submit">�ʴ���</button>
                        <input type="hidden" name="show" value="table">
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>

<?php
$show = input_post('show');
if ( $show === 'table' ) {

    $db = Mysql::load();
    $select_year = ad_to_bc($select_year);

    $date_selected = "$select_year-$select_month";
    if( !empty($select_day) ){
        $date_selected .= "-$select_day";
    }

    /*
    $sql = "SELECT a.`row_id`, a.`date`, a.`drugcode`, a.`tradname`, `drug_inject_amount`, SUM(a.`amount`) AS `amount`, 
    b.`hn`, b.`an`, b.`ptname`, b.`bedcode`, SUBSTRING(b.`bedcode`, 1, 2) AS `ward_code` 
    FROM `drugrx` AS a 
    LEFT JOIN `ipcard` AS b ON b.`an` = a.`an` 
    WHERE a.`date` LIKE '$date_selected%' 
    AND ( a.`an` IS NOT NULL AND a.`an` != '' ) 
    AND a.`drugcode` IN('2MO','2PET50','2EPHE','2FENT-N') 
    GROUP BY a.`an` 
    ORDER BY b.`bedcode` ASC, a.`date` ASC ";
    */

    $sql = "SELECT a.`row_id`, a.`date`, a.`drugcode`, a.`tradname`, `drug_inject_amount`, `amount`, 
    b.`hn`, b.`an`, b.`ptname`, b.`bedcode`, SUBSTRING(b.`bedcode`, 1, 2) AS `ward_code` 
    FROM `drugrx` AS a 
    LEFT JOIN `ipcard` AS b ON b.`an` = a.`an` 
    WHERE a.`date` LIKE '$date_selected%' 
    AND ( a.`an` IS NOT NULL AND a.`an` != '' ) 
    AND a.`drugcode` IN('2MO','2PET50','2EPHE','2FENT-N') ";
    
    $db->select($sql);
    $items = $db->get_items();

    $item_lists = array();
    $code_lists = array(
        42 => '�ͼ��������', 43 => '�ͼ������ٵ�', 44 => '�ͼ�����ICU', 45 => '�ͼ����¾����'
    );

    foreach ($items as $key => $item) {

        if( $item['amount'] <= 0 ){
            continue;
        }

        $ward_code = $item['ward_code'];
        $item['ward_name'] = $code_lists[$ward_code];

        $wardExTest = preg_match('/45.+/', $item['bedcode']);
        if( $wardExTest > 0 ){
            
            // ������繪��3 ���������繪��2
            $wardR3Test = preg_match('/R3\d+|B\d+/', $item['bedcode']);
            $wardBxTest = preg_match('/B[0-9]+/', $item['bedcode']);
            $exName = ( $wardR3Test > 0 OR $wardBxTest > 0 ) ? '���3' : '���2' ;
            $item['ward_name'] = $item['ward_name'].' '.$exName;
        }

        $item_lists[$ward_code][] = $item;

    }

    if( !empty($select_day) ){
        $date_selected .= "-$select_day";
    }


    ?>
    <div class="col">
        <div class="cell">
            <h3>Addict <?=( !empty($select_day) ? '�ѹ��� '.$select_day.' ' : '' )?><?=$def_fullm_th[$select_month].' '.$select_year;?>
        </div>
    </div>
    <div class="col">
        <div class="cell">
            <?php
            foreach ($item_lists as $key => $items) {
                
                $ward_name = $code_lists[$key];
                ?>
                <h3><?=$ward_name;?></h3>
                <table border="1" cellpadding="0" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="3%">#</th>
                            <th width="15%">�ѹ���</th>
                            <th width="8%">HN</th>
                            <th width="25%">����-ʡ��</th>
                            <th width="25%">������</th>
                            <th width="8%">�ӹǹ�����</th>
                            <th width="8%">�纫ҡ</th>
                            <th width="8%">�������</th>
                            <th>amp</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    foreach ($items as $key => $item) {
                    ?>
                        <tr>
                            <td align="right"><?=$i;?></td>
                            <td><?=$item['date'];?></td>
                            <td><?=$item['hn'];?></td>
                            <td><?=$item['ptname'];?></td>
                            <td><?=$item['tradname'];?></td>
                            <td align="right"><?=$item['amount'];?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    <?php
                        $i++;
                    }
                    ?>
                    </tbody>
                </table>
                <?php
            }
            ?>
        </div>
    </div>
    <?php
}

// include 'templates/classic/footer.php';