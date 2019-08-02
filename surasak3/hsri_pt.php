<?php 
include 'bootstrap.php';

$db = Mysql::load($shs_configs);

// $db->exec("SET NAMES TIS620");

?>
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
</style>
<form action="hsri_pt.php" method="post">
    <fieldset>
        <legend>ค้นหารายรายการทางการแพทย์</legend>
        <div>
            HN : <input type="text" name="hn" id="">
        </div>
        <div>
            <button type="submit">แสดงข้อมูล</button>
            <input type="hidden" name="action" value="show">
        </div>
        <div>
            ข้อมูลตั้งแต่ 01 สิงหาคม 2561 ถึง 31 กรกฎาคม 2562
        </div>
    </fieldset>
</form>

<?php
$action = input_post('action');
if ($action == 'show') { 

    $hn = input_post('hn');

    $sql = "SELECT a.`hn`,a.`txdate`,a.`depart`,CONCAT(b.`yot`,b.`name`,' ',b.`surname`) AS `ptname` 
    FROM `opacc` AS a 
    LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
    WHERE a.`hn` = '$hn' 
    AND a.`an` = '' 
    AND a.`date` >= '2561-08-01 00:00:00' AND a.`date` <= '2562-07-31 23:59:59' ";
    $db->select($sql);
    $items = $db->get_items();
    
    ?>
    <table class="chk_table">
        <thead>
            <tr>
                <th>HN</th>
                <th>ชื่อ-สกุล ผู้ป่วย</th>
                <th>วันที่</th>
                <th>รายการค่าใช้จ่าย</th>
                <th>จำนวน</th>
                <th>ราคา</th>
                <th>รวมเงิน</th>
                <th>เบิกไม่ได้</th>
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