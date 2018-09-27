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
        WHEN a.`camp` LIKE '%ศฝ.นศท.มทบ.32' THEN '303003' 
        WHEN a.`camp` LIKE '%สง.สด.จว.ล.ป.' THEN '303004' 
        WHEN a.`camp` LIKE '%ร.17 พัน.2' THEN '303005' 
        WHEN a.`camp` LIKE '%ช.พัน.4 ร้อย4' THEN '303006' 
        WHEN a.`camp` LIKE '%ร้อย.ฝรพ.3' THEN '303007' 
        WHEN a.`camp` LIKE '%ทพ.33' THEN '303008' 
        WHEN a.`camp` LIKE '%กอ.รมน.จว.ล.ป' THEN '303801' 
        WHEN a.`camp` LIKE '%สปร.เขตพื้นที่ มทบ.32' THEN '303802' 
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
body{
    width: 100%;
}
/* ตาราง */
.chk_table{
    border-collapse: collapse;
    width: 100%;
}

.chk_table, th, td{
    border: 1px solid black;
}

.chk_table th,
.chk_table td{
    padding: 3px;
}
</style>
<div width="100%">

    <table class="chk_table">
        <thead>
            <tr style="text-align: center;">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="2">BP</td>
                <td></td>
                <td colspan="2">Chest x-ray</td>
                <td colspan="4">ผลการตรวจปัสสาวะ</td>
                <td colspan="12">ผลการตรวจเลือด</td>
            </tr>
            <tr style="text-align: center;">
                <td rowspan="2">ลำดับ</td>
                <td rowspan="2">เลขประจำตัวประชาชน<br>(13 หลักติดกันไม่ต้องเว้นหรือมี -)</td>
                <td rowspan="2">เลขประจำตัวกำลังพล<br>(10 หลัก)</td>
                <td rowspan="2">คำนำหน้าชื่อ</td>
                <td rowspan="2">ชื่อ</td>
                <td rowspan="2">นามสกุล</td>
                <td rowspan="2">วันเดือนปีเกิด<br>(วว/ดด/ปปปป)</td>
                <td rowspan="2">หน่วยที่ทำงาน/ขรก.</td>
                <td rowspan="2">สถานที่ปฏิบัติงาน<br>(แผนก/กอง)</td>
                <td rowspan="2">หน่วยที่รับเงินเดือน</td>
                <td rowspan="2">เพศ</td>
                <td rowspan="2">ระดับชั้นยศ</td>
                <td rowspan="2">อายุ(ปี)</td>
                <td rowspan="2">วันที่ตรวจ<br>(วว/ดด/ปปปป)</td>
                <td rowspan="2">นน.(กก.)</td>
                <td rowspan="2">ส่วนสูง(ซม.)</td>
                <td rowspan="2">BMI</td>
                <td rowspan="2">รอบเอว(ซม.)</td>

                <td>Systolic<br>mmHg</td>
                <td>Diastolic<br>mmHg</td>

                <td rowspan="2">ชีพจร(ครั้ง/นาที)</td>

                <td>ผล</td>
                <td>ผิดปกติ</td>

                <td>Glucose</td>
                <td>Protein</td>
                <td>Blood</td>
                <td>RBC</td>

                <td>Hb</td>
                <td>Glu</td>
                <td>Chol</td>
                <td>TG</td>
                <td>HDL-C</td>
                <td>LDL-C</td>
                <td>BUN</td>
                <td>Cr</td>
                <td>Uric</td>
                <td>AST</td>
                <td>ALT</td>
                <td>ALP</td>
                


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
</div>