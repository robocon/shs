<?php

include 'bootstrap.php';

$db = Mysql::load();

$sql = "SELECT a.`row_id`,a.`hn`,a.`registerdate`,a.`camp`,a.`yot`,a.`ptname`,a.`idcard`,a.`birthday`,a.`age`,a.`gender`,
a.`cigarette`,a.`alcohol`,a.`exercise`,a.`weight`,a.`height`,a.`waist`,a.`bp1`,
a.`bp2`,a.`chol_result`,a.`chunyot`,a.`hdl_result`,a.`ldl_result`,a.`glu_result`,a.`trig_result`,
a.`position`,a.`ratchakarn`, 
(
    CASE 
        WHEN a.`camp` LIKE 'D01%' THEN '303001' 
        WHEN a.`camp` regexp 'D0[2-3]' 
            OR a.`camp` regexp 'D0[5-9]' 
            OR a.`camp` regexp 'D1[0-9]' 
            OR a.`camp` regexp 'D2[0-8]' 
            THEN '303002' 
        WHEN a.`camp` LIKE '%Ƚ.�ȷ.���.32' THEN '303003' 
        WHEN a.`camp` LIKE '%ʧ.ʴ.��.�.�.' THEN '303004' 
        WHEN a.`camp` LIKE '%�.17 �ѹ.2' THEN '303005' 
        WHEN a.`camp` LIKE '%�.�ѹ.4 ����4' THEN '303006' 
        WHEN a.`camp` LIKE '%����.�þ.3' THEN '303007' 
        WHEN a.`camp` LIKE '%��.33' THEN '303008' 
        WHEN a.`camp` LIKE '%��.���.��.�.�' THEN '303801' 
        WHEN a.`camp` LIKE '%ʻ�.ࢵ��鹷�� ���.32' THEN '303802' 
    END
) AS `camp_code` 
FROM `armychkup` AS a 
WHERE a.`yearchkup` = '61' 
AND a.`camp` != '' 
GROUP BY a.`hn`
ORDER BY `camp_code` ASC, a.`camp` ASC, a.`row_id` DESC";
$db->select($sql);
$items = $db->get_items();

$new_itmes = array();

?>
<style>
*{
    font-family: TH SarabunPSK;
    font-size: 16pt;
}
/* ���ҧ */
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
</style>
<table class="chk_table">
    <thead>
        <tr>
            <th>�ӴѺ</th>
            <th>�Ţ��Шӵ�ǻ�ЪҪ�<br>(13 ��ѡ�Դ�ѹ����ͧ��������� -)</th>
            <th>�Ţ��Шӵ�ǡ��ѧ��<br>(10 ��ѡ)</th>
            <th>��</th>
            <th>����</th>
            <th>���ʡ��</th>
            <th>�ѹ��͹���Դ<br>(��/��/����)</th>
            <th>˹��·��ӧҹ/�á.</th>
            <th>ʶҹ��軯Ժѵԧҹ<br>(Ἱ�/�ͧ)</th>
            <th>˹��·���Ѻ�Թ��͹</th>
        </tr>
    </thead>
    
    <tbody>

    <?php
    $i = 1;
    foreach ($items as $key => $item) {

        $ptname = preg_replace('/\s+/', ' ', $item['ptname']);
        list($fname, $lname) = explode(' ', $ptname);

        list($yyyy, $mm, $dd) = explode('-', $item['birthday']); 

        $camp_name = preg_replace('/D\d+\s/', '', $item['camp']);
        ?>
        <tr>
            <td><?=$i;?></td>
            <td><?=$item['idcard'];?></td>
            <td>&nbsp;</td>
            <td><?=$item['yot'];?></td>
            <td><?=$fname;?></td>
            <td><?=$lname;?></td>
            <td><?=($dd.'/'.$mm.'/'.( $yyyy + 543 ) );?></td>
            <td><?=$camp_name;?></td>
            <td><?=$item['position'];?></td>
            <td>&nbsp;</td>
        </tr>
        <?php
        $i++;
    }
    ?>
    </tbody>
</table>