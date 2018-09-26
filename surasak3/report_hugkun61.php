<?php 

$db2 = mysql_connect('192.168.1.13', 'dottwo', '') or die( mysql_error() );
mysql_select_db('smdb', $db2) or die( mysql_error() );

$sql = "SELECT b.* 
FROM ( 
    SELECT MAX(`row_id`) AS `latest_id`  
    FROM `condxofyear_out` 
    WHERE `thidate` LIKE '2018-09%' 
    AND `camp` = 'ฮักกันยามเฒ่า 61' 
    GROUP BY `hn`
) AS a 
LEFT JOIN `condxofyear_out` AS b ON b.`row_id` = a.`latest_id` ";
$q = mysql_query($sql);

?>
<style>
*{
    font-family: TH SarabunPSK;
    font-size: 14pt;
}
/* ตาราง */
.chk_table{
    border-collapse: collapse;
}

.chk_table, th, td{
    border: 1px solid black;
}

.chk_table th,
.chk_table td{
    padding: 3px;
}
@media print{
    .hide_stat{
        display: none;
    }
}
</style>
<div class="hide_stat">
    <a href="../nindex.htm">&lt;&lt;&nbsp;หน้าหลักโปรแกรม ร.พ.</a>
</div>
<h3 style="font-size: 18pt;">สรุปผลตรวจสุขภาพประจำปี 2561 โครงการฮักกันยามเฒ่า </h3>
<table class="chk_table">
    <thead>
        <tr>
            <th>ลำดับ</th>
            <th>HN</th>
            <th>ยศ ชื่อ-สกุล</th>
            <th>อายุ</th>
            <th>น้ำหนัก(กก.)</th>
            <th>ส่วนสูง(ซม.)</th>
            <th>BMI</th>
            <th>รอบเอว(ซม.)</th>
            <th>BP1</th>
            <th>BP2</th>
            <th>UA</th>
            <th>CBC</th>
            <th>BS</th>
            <th>BUN</th>
            <th>CREA</th>
            <th>URIC</th>
            <th>CHOL</th>
            <th>CXR</th>
        </tr>
    </thead>
    
    <tbody>

    <?php
    $i = 1;
    while ( $item = mysql_fetch_assoc($q) ) {
        ?>
        <tr>
            <td><?=$i;?></td>
            <td><?=$item['hn'];?></td>
            <td><?=$item['ptname'];?></td>
            <td><?=$item['age'];?></td>
            <td><?=$item['weight'];?></td>
            <td><?=$item['height'];?></td>
            <td><?=$item['bmi'];?></td>
            <td><?=$item['round_'];?></td>
            <td><?=$item['bp1'];?></td>
            <td><?=$item['bp2'];?></td>
            <td><?=$item['stat_ua'];?></td>
            <td><?=$item['stat_cbc'];?></td>
            <td><?=$item['stat_bs'];?></td>
            <td><?=$item['stat_bun'];?></td>
            <td><?=$item['stat_cr'];?></td>
            <td><?=$item['stat_uric'];?></td>
            <td><?=$item['stat_chol'];?></td>
            <td><?=$item['cxr'];?></td>
        </tr>
        <?php
        $i++;
    }
    ?>
    </tbody>
</table>