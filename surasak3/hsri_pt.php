<?php 
include 'bootstrap.php';

$db = Mysql::load();

?>
<link type="text/css" href="epoch_styles.css" rel="stylesheet" />
<script type="text/javascript" src="epoch_classes.js"></script>
<style>
@media print{
    form{
        display: none;
    }
}
*{
    font-family:"TH Sarabun New","TH SarabunPSK";
    font-size: 12pt;
}
.chk_table{
    border-collapse: collapse;
}

.chk_table th,
.chk_table td{
    border: 1px solid black;
    padding: 1px;
}
/* Overdrive */
table.calendar td, 
table.calendar th,
table.calendar input, 
table.calendar select{ 
    font-size: 14px;
}
</style>
<form action="hsri_pt.php" method="post">
    <fieldset>
        <legend>���������¡�÷ҧ���ᾷ��</legend>
        <div>
            HN : <input type="text" name="hn" id="">
        </div>
        <div>
            ���͡�ѹ��� ������ѹ��� <input type="text" name="dateStart" id="dateStart"> �֧�ѹ��� <input type="text" name="dateEnd" id="dateEnd">
        </div>
        <div>
            <button type="submit">�ʴ�������</button>
            <input type="hidden" name="action" value="show">
        </div>
    </fieldset>
</form>
<script type="text/javascript">
    var popup1,popup2;
    window.onload = function() {
        popup1 = new Epoch('popup1','popup',document.getElementById('dateStart'),false);
        popup2 = new Epoch('popup2','popup',document.getElementById('dateEnd'),false);
    };
</script>
<?php
$action = input_post('action');
if ($action == 'show') { 

    $hn = input_post('hn');
    $dateStart = input_post('dateStart');
    $dateEnd = input_post('dateEnd');

    $dateStart = ad_to_bc($dateStart);
    $dateEnd = ad_to_bc($dateEnd);

    $sql = "SELECT a.`hn`,a.`txdate`,a.`depart`,CONCAT(b.`yot`,b.`name`,' ',b.`surname`) AS `ptname` 
    FROM `opacc` AS a 
    LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
    WHERE a.`hn` = '$hn' 
    AND a.`an` = '' 
    AND a.`date` >= '$dateStart 00:00:00' AND a.`date` <= '$dateEnd 23:59:59' 
    ORDER BY a.`date` DESC";
    $db->select($sql);

    if( $db->get_rows() == 0 ){
        echo "��辺������ ��سҵ�Ǩ�ͺ HN, �ѹ���������� ����ѹ�������ش 㹡�ô֧������";
        exit;
    }

    $items = $db->get_items();
    
    ?>
    <table class="chk_table">
        <thead>
            <tr>
                <th>HN</th>
                <th>����-ʡ�� ������</th>
                <th>�ѹ���</th>
                <th>��¡�ä�������</th>
                <th>�ӹǹ</th>
                <th>�Ҥ�</th>
                <th>����Թ</th>
                <th>�ԡ�����</th>
            </tr>
        </thead>
        <tbody>
    <?php

    foreach ($items as $key => $item) {

        $date = $item['txdate'];
        
        if( $item['depart'] == 'PHAR' ){ 

            $drug_sql = "SELECT a.`tradname` AS `detail`, a.`amount`,(a.`price`/a.`amount`) AS `item_price` ,
            CASE 
                WHEN a.`part` = 'DDN' OR a.`part` = 'DPN' OR a.`part` = 'DSN' THEN a.`price` 
                ELSE '' 
            END AS `nprice`,
            
            CASE 
                WHEN a.`part` = 'DDL' OR a.`part` = 'DDY' OR a.`part` = 'DPY' OR a.`part` = 'DSY' THEN a.`price` 
                ELSE '' 
            END AS `yprice` 

            FROM `drugrx` AS a 
            WHERE a.`date` = '$date' 
            AND a.`hn` = '$hn'";
            $db->select($drug_sql);

            $sub_items = $db->get_items();

        }else{

            $etc_sql = "SELECT `detail`,`yprice`,`nprice`,`amount`,(`price`/`amount`) AS `item_price`
            FROM `patdata` 
            WHERE `date` = '$date' 
            AND `hn` = '$hn' ";
            $db->select($etc_sql);

            $sub_items = $db->get_items();

        }

        foreach ($sub_items as $key => $value) {
            ?>
            <tr>
                <td><?=$hn;?></td>
                <td><?=$item['ptname'];?></td>
                <td><?=$item['txdate'];?></td>
                <td><?=$value['detail'];?></td>
                <td align="right"><?=$value['amount'];?></td>
                <td align="right"><?=number_format($value['item_price'],2);?></td>
                <td align="right"><?=number_format($value['yprice'],2);?></td>
                <td align="right"><?=number_format($value['nprice'],2);?></td>
            </tr>
            <?php
        }
    }
    ?>
        </tbody>
    </table>
    <?php

}