<?php

include 'bootstrap.php';
// $shs_configs = array(
//     'host' => '192.168.1.13',
//     'port' => '3306',
//     'dbname' => 'smdb',
//     'user' => 'dottow',
//     'pass' => ''
// );
$db = Mysql::load($shs_configs);

$camp = input_get('camp');
if( empty($camp) ){
    echo "ไม่พบข้อมูล";
    exit;
}

$sql = "SELECT b.*,c.`cxr`,c.`res_cbc`,c.`res_ua`,c.`res_glu`,c.`res_crea`,c.`res_chol`,c.`res_hdl`,c.`res_hbsag`, 
c.`conclution`,c.`normal_suggest`,c.`normal_suggest_date`,c.`abnormal_suggest`,c.`abnormal_suggest_date`,c.`diag`, 
c.`yearchk` 
FROM ( 
    SELECT * FROM `opcardchk` WHERE `part` = '$camp'
) AS a 
LEFT JOIN `dxofyear_out` AS b ON b.`hn` = a.`HN` 
LEFT JOIN `chk_doctor` AS c ON c.`hn` = a.`HN` 
WHERE b.row_id IS NOT NULL 
AND b.`yearchk` = c.`yearchk` 
ORDER BY a.`row`";

$db->select($sql);
$items = $db->get_items();

$user_rows = $db->get_rows();

if( $user_rows == 0 ){
    echo "ไม่มีข้อมูลการลงข้อมูลซักประวัติ และสรุปผลจากแพทย์";
    exit;
}


$sql = "SELECT * FROM `chk_company_list` WHERE `code` = '$camp' ";
$db->select($sql);
$company = $db->get_item();

?>
<style>
*{
    font-family: TH SarabunPSK;
    font-size: 16px;
}
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
<div style="text-align: center;">
    <p><b>ผลการตรวจสุขภาพเจ้าหน้าที่ <?=$company['name'];?> บริการตรวจสุขภาพ ณ โรงพยาบาลค่ายสุรศักดิ์มนตรี</b></p>
    <p><b>ระหว่างวันที่ <?=$company['date_checkup'];?> จำนวน <?=$user_rows;?> ราย</b></p>
</div>
<table class="chk_table" width="100%">
    <thead>
        <tr>
            <th width="3%" rowspan="2" align="center">ลำดับ</th>
            <th width="5%" rowspan="2" align="center">HN</th>
            <th width="15%" rowspan="2" align="center">ชื่อ - สกุล</th>
            <th width="3%" rowspan="2" align="center">อายุ</th>
            <th width="3%" rowspan="2" align="center">น้ำหนัก</th>
            <th width="3%" rowspan="2" align="center">ส่วนสูง</th>
            <th width="5%" rowspan="2" align="center">BP</th>
            <th colspan="9" align="center">รายการตรวจ</th>
            <th width="8%" rowspan="2" align="center">สรุปผลการตรวจ</th>
            <th rowspan="2" align="center">คำแนะนำ</th>
        </tr>
        <tr>

            <th width="3%" align="center">X-RAY</th>
            <th width="3%" align="center">CBC</th>
            <th width="3%" align="center">UA</th>
            <th width="3%" align="center">BS</th>
            <th width="3%" align="center">CR</th>
            <th width="3%" align="center">CHOL</th>
            <th width="3%" align="center">HDL</th>
            <th width="5%" align="center">HBsAg</th>
            <th width="6%" align="center">FOBT</th>

        </tr>
    </thead>
    <tbody>
    
    <?php 
    $i = 0;
    foreach ($items as $key => $item) {

        ++$i;

        $age = substr($item['age'], 0, 2);
        $bp1 = $item['bp1'];
        $bp2 = $item['bp2'];

        if( !empty($item['bp21']) && $item['bp21'] != '-' ){
            $bp1 = $item['bp21'];
        } 
        if( !empty($item['bp22']) && $item['bp22'] != '-' ){
            $bp2 = $item['bp22'];
        }

        $yearchk = $item['yearchk'];
        $hn = $item['hn'];

        // ตรวจ สตูล <-- ไม่ใช่จังหวัดนะเห้ย
        $occult = false;
        $sql = "SELECT b.* 
        FROM `resulthead` AS a 
        LEFT JOIN `resultdetail` AS b ON b.`autonumber` = a.`autonumber` 
        WHERE a.`hn` = '$hn' 
        AND a.`clinicalinfo` = 'ตรวจสุขภาพประจำปี$yearchk' 
        AND a.`profilecode` = 'OCCULT' ";

        $db->select($sql);
        $occu_row = $db->get_rows();
        if( $occu_row > 0 ){
            $lab = $db->get_item();
            $occult = $lab['flag'];
        }

        // สรุปผลจาก conclution ที่แพทย์ลง
        $conclution = $item['conclution'];
        if( $conclution == 1 ){
            $suggest_list = array(
                1 => 'ไม่ได้ให้คำแนะนำ', 
                'แนะนำให้รับการตรวจต่อเนื่อง ครั้งต่อไป'
            );

            $suggest = $item['normal_suggest'];
            $suggest_date = ( $item['normal_suggest_date'] != '0000-00-00' ) ? 'ในวันที่ '.$item['normal_suggest_date'] : '' ;
            
        }else{
            $suggest_list = array(
                1 => 'ไม่ได้ให้คำแนะนำ', 
                'ให้คำแนะนำในการตรวจติดตาม/ตรวจซ้ำ ครั้งต่อไป', 
                'ให้คำแนะนำเข้ารับการรักษากรณีเจ็บป่วยโดยนัดเข้ารับบริการ', 
                'ให้คำแนะนำเข้ารักการรักษากรณีภาวะแทรกซ้อนจากโรคเรื้อรัง'
            );

            $suggest = $item['abnormal_suggest'];
            $suggest_date = ( $item['abnormal_suggest_date'] != '0000-00-00' ) ? 'ในวันที่ '.$item['abnormal_suggest_date'] : '' ;
            
        }

        $suggest_detail = $suggest_list[$suggest];
        $conclution_detail = $suggest_detail.$suggest_date;

        // ผลตรวจตัวอื่นๆ
        $sql = "SELECT b.* 
        FROM ( 

            SELECT MAX(`autonumber`) AS `latest_number` 
            FROM `resulthead` 
            WHERE `hn` = '$hn' 
            AND ( `profilecode` != 'CBC' AND `profilecode` != 'UA' )
            AND `clinicalinfo` = 'ตรวจสุขภาพประจำปี$yearchk' 
            GROUP BY `profilecode` 
            ORDER BY `autonumber` ASC 

        ) AS a 
            RIGHT JOIN `resultdetail` AS b ON b.`autonumber` = a.`latest_number` 
        WHERE b.`autonumber` = a.`latest_number` 
        AND ( 
            b.`labcode` = 'GLU' 
            OR b.`labcode` = 'CREA' 
            OR b.`labcode` = 'CHOL' 
            OR b.`labcode` = 'HDL' 
            OR b.`labcode` = 'HBSAG' 
            OR b.`labcode` = 'OCCULT' 
            OR b.`labcode` = '38302' 
            OR b.`labcode` = 'STOCC' 
        ) 
        ORDER BY b.seq ASC ";
        $db->select($sql);
        $etc_items = $db->get_items();
        
        $etc = array();
        foreach ($etc_items as $key => $lab_item) {
            $labcode = strtolower($lab_item['labcode']);
            $etc[$labcode] = array(
                'result' => $lab_item['result'], 
                'normalrange' => $lab_item['normalrange'],
                'flag' => $lab_item['flag']
            );
        }
        
        ?>
        <tr>
            
            <td align="right"><?=$i;?></td>
            <td><?=$hn;?></td>
            <td><?=$item['ptname'];?></td>
            <td align="right"><?=$age;?></td>
            <td align="right"><?=$item['weight'];?></td>
            <td align="right"><?=$item['height'];?></td>
            <td><?=$bp1.'/'.$bp2?></td>


            <td><?=( $item['cxr'] == '1' ? 'ปกติ' : 'ผิดปกติ' );?></td>
            <td>
                <?php
                if( $item['res_cbc'] == '1' ){
                    echo "ปกติ";
                }else if( $item['res_cbc'] == '2' ){
                    echo "ผิดปกติ";
                }
                ?>
            </td>
            <td>
                <?php
                if( $item['res_ua'] == '1' ){
                    echo "ปกติ";
                }else if( $item['res_ua'] == '2' ){
                    echo "ผิดปกติ";
                }
                ?>
            </td>
            <td align="right">
                <?php 
                $style = '';
                if( $etc['glu']['flag'] != 'N' ){
                    $style = 'style="font-weight: bold; color: red;"';
                }
                ?>
                <span <?=$style;?> title="Normal: <?=$etc['glu']['normalrange'];?>"><?=$etc['glu']['result'];?></span>
            </td>
            <td align="right">
                <?php 
                $style = '';
                if( $etc['crea']['flag'] != 'N' ){
                    $style = 'style="font-weight: bold; color: red;"';
                }
                ?>
                <span <?=$style;?> title="Normal: <?=$etc['crea']['normalrange'];?>"><?=$etc['crea']['result'];?></span>
            </td>
            <td align="right">
                <?php 
                $style = '';
                if( $etc['chol']['flag'] != 'N' ){
                    $style = 'style="font-weight: bold; color: red;"';
                }
                ?>
                <span <?=$style;?> title="Normal: <?=$etc['chol']['normalrange'];?>"><?=$etc['chol']['result'];?></span>
            </td>
            <td align="right">
                <?php 
                $style = '';
                if( $etc['hdl']['flag'] != 'N' ){
                    $style = 'style="font-weight: bold; color: red;"';
                }
                ?>
                <span <?=$style;?> title="Normal: <?=$etc['hdl']['normalrange'];?>"><?=$etc['hdl']['result'];?></span> 
            </td>
            <td>
                <?php
                if( $etc['hbsag']['result'] == 'Negative' ){
                    echo 'ไม่พบเชื้อ';
                }elseif ( $etc['hbsag']['result'] == 'Positive' ) {
                    echo 'พบเชื้อ';
                }
                ?>
            </td>
            <td>
                <?php
                if( $etc['occult']['result'] == 'Negative' ){
                    echo 'ไม่พบเลือด';
                }elseif ( $etc['occult']['result'] == 'Positive' ) {
                    echo 'พบเลือด';
                }

                if( $etc['stocc']['result'] == 'Negative' ){
                    echo 'ไม่พบเลือด';
                }elseif ( $etc['stocc']['result'] == 'Positive' ) {
                    echo 'พบเลือด';
                }
                
                ?>
            </td>

            
            <td><?=( $item['conclution'] == '1' ? 'ปกติ' : ( $item['conclution'] == '2' ? 'ผิดปกติ' : '' ) );?></td>
            <td><?=$conclution_detail;?></td>
            <!-- <td>สรุปผลการตรวจ</td> -->

        </tr>
        <?php
    }
    ?>

    </tbody>
</table>
<p align="center">BS = น้ำตาลในเลือด  CHOL, HDL = ไขมันในเลือด CR = การทำงานของไต HBsAg = เชื้อไวรัสตับอักเสบ  FOBT = เลือดในอุจจาระ</p>