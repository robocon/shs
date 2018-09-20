<?php

include 'bootstrap.php';

$configs = array(
    'host' => '192.168.1.13',
    'port' => '3306',
    'dbname' => 'smdb',
    'user' => 'dottwo',
    'pass' => ''
);

$db = Mysql::load($configs);

// รายการตรวจ รพ.
$lab_keys = array('ALK','BS','BUN','CBC','UA','CHOL','CR','HDL','LDL','SGOT','SGPT','TRI');

// รายการตรวจ ประกันสังคม
// ในแลปที่คีย์จะเป็น STOCB แต่ในตอนที่แสดงจะเป็น FOBT
$lab_sso = array('CBC','UA','BS','CR','HDL','CHOL','HBSAG','STOCB');

?>

<div>
    <a href="../nindex.htm">&lt;&lt;&nbsp;หน้าหลัก รพ.</a>
</div>

<style>
body{
    font-family: TH Sarabun New;
    font-size: 16pt;
}
table{
    width: 100%;
}
    /* ตาราง */
.chk_table{
    border-collapse: collapse;
}

.chk_table, th, td{
    border: 1px solid black;

    font-size: 13pt;
}

.chk_table th,
.chk_table td{
    padding: 3px;
}

@media print{
    .hide{ display: none; }
}

</style>


<?php
$sql = "SELECT `branch` FROM `opcardchk` WHERE `part` = 'ลูกจ้าง61' GROUP BY `branch` ";
$db->select($sql);
$branchs = $db->get_items();
$op = input_post('branch');
?>
<form action="lpru_report_money_sso.php" method="post" class="hide">
    <div>
        <button type="submit">แสดงรายงาน</button>
        <input type="hidden" name="action" value="show">
    </div>
</form>

<?php

$action = input_post('action');

if ( $action == 'show' ) {
    

    // กลุ่มลูกจ้างตามแผนก
    $sql = "SELECT * 
    FROM `opcardchk` 
    WHERE `part` = 'ราชภัฎ61'";
    $db->select($sql);
    $users = $db->get_items();



?>

<div style="text-align: center; font-weight: bold;">ตรวจสุขภาพประกันสังคม มหาวิทยาลัยราชภัฏลำปาง 2561</div>

<table class="chk_table">
    <tr>
        <th rowspan="2">#</th>
        <th rowspan="2">HN</th>
        <th rowspan="2">ชื่อ-สกุล</th>
        <th rowspan="2">แผนก</th>
        <th rowspan="2">อายุ</th>
        <th rowspan="2">สิทธิ</th>
        <th colspan="10">ประกันสังคม</th>
        <th colspan="14">เก็บกับ รพ.</th>
        <th rowspan="2">รวมสุทธิ</th>
    </tr>
    <tr>

        <?php 

        foreach ($lab_sso as $key => $sso) {
            ?>
            <th><?=$sso;?></th>
            <?php
        }
        ?>
        <th>X-RAY</th>
        <th>รวมทั้งสิ้น</th>
        <?php

        foreach ($lab_keys as $key => $lab) {
            ?>
            <th><?=$lab;?></th>
            <?php
        }
        ?>
        <th>X-RAY</th>
        <th>รวมทั้งสิ้น</th>
    </tr>
<?php 

$i = 1;

$all_shs = 0.00; 
$all_sso = 0.00; 


$late_branch = false; 




// sum ของแต่ละรายการฝั่ง ประกันสังคม
$sCbc = $sUa = $sBs = $sCr = $sHdl = $sChol = $sHbsag = $sFobt = $sXray = 0.00;

// sum ของแต่ละรายการฝั่ง รพ.
$tAlk = $tBs = $tBun = $tCbc = $tChol = $tCr = $tHdl = $tLdl = $tSgot = $tSgpt = $tTri = $tUa = $tXray = 0.00;

foreach ($users as $key => $user) {

    // ราคาต่อคน
    $user_sso = 0;
    

    $all_per_user = 0.00;
    
    $hn = $user['HN'];
    $ptname = $user['name'].' '.$user['surname'];
    $branch = $user['branch'];
    $age = $user['agey'];

    // สิทธิที่ใช้ในวันนั้น
    $sql = "SELECT `thidate`,`hn`,`vn`,`ptright` 
    FROM `opday` 
    WHERE `hn` = '$hn' 
    AND ( `thidate` >= '2561-04-23 00:00:00' AND `thidate` <= '2561-04-30 23:59:59' ) ";
    $db->select($sql);
    $opday = $db->get_item();
    
    $pre_ptright = $opday['ptright'];
    $ptright = substr($pre_ptright,4);

    ?>
    <tr>
        <td align="center"><?=$i;?></td>
        <td><?=$hn;?></td>
        <td><?=$ptname;?></td>
        <td><?=$branch;?></td>
        <td align="center"><?=$age;?></td>
        <td><?=$ptright;?></td>
    <?php

    /////////////////////
    // 
    // เบิกกับประกันสังคม
    // 
    /////////////////////

    // ประกันสังคม
    $sql_sso = "SELECT d.* 
    FROM ( 
        SELECT MAX(`row_id`) AS `latest_id` 
        FROM `depart` 
        WHERE `hn` = '$hn' 
        AND ( `date` >= '2561-04-23 00:00:00' AND `date` <= '2561-04-30 23:59:59' ) 
        AND `cashok` LIKE 'SSOCHECKUP61%' 
        AND `depart` = 'PATHO' 
        GROUP BY `hn`,`depart` 
        
    ) AS c 
    LEFT JOIN `depart` AS d ON d.`row_id` = c.`latest_id` ";
    $db->select($sql_sso);
    $sso_items = $db->get_items();
    
    $sso_price_list = array();
    $extra_nPrice = array();
    foreach ($sso_items as $key => $item) { 

        $idno = $item['row_id'];
        $sql = "SELECT `code`,`price` AS `pat_price` ,`yprice`,`nprice`
        FROM `patdata` 
        WHERE `idno` = '$idno' 
        ORDER BY `code` ASC";
        $db->select($sql);
        $patdata_lab = $db->get_items();

        foreach ($patdata_lab as $key => $pat) {
            $key = str_replace('-sso', '', $pat['code']);
            
            $sso_price_list[$key] = $pat['yprice'];

            if( $pat['nprice'] > 0 ){
                $extra_nPrice[$key] = $pat['nprice'];
            }
            
            // รวมราคาต่อคน
            $user_sso += $pat['yprice'];

            if( $key == 'CBC' ){ $sCbc += $pat['yprice']; }
            if( $key == 'UA' ){ $sUa += $pat['yprice']; }
            if( $key == 'BS' ){ $sBs += $pat['yprice']; }
            if( $key == 'CR' ){ $sCr += $pat['yprice']; }
            if( $key == 'HDL' ){ $sHdl += $pat['yprice']; }
            if( $key == 'CHOL' ){ $sChol += $pat['yprice']; }
            if( $key == 'HBSAG' ){ $sHbsag += $pat['yprice']; }
            if( $key == 'STOCB' ){ $sFobt += $pat['yprice']; }
        }

    }

    // แสดงราคา ประกันสังคม
    foreach ($lab_sso as $key => $sso) {

        $sso_price = ( isset($sso_price_list[$sso]) ) ? $sso_price_list[$sso] : 0.00 ;
        ?>
        <td align="right"><?=number_format($sso_price, 2);?></td>
        <?php
    }

    // Xray ประกันสังคม
    $sql_sso = "SELECT e.`price` 
    FROM ( 
        SELECT MAX(`row_id`) AS `latest_id` 
        FROM `depart` 
        WHERE `hn` = '$hn' 
        AND ( `date` >= '2561-04-23 00:00:00' AND `date` <= '2561-04-30 23:59:59' ) 
        AND `cashok` LIKE 'SSOCHECKUP61%' 
        AND `depart` = 'XRAY' 
        GROUP BY `hn`,`depart` 
        
    ) AS c 
    LEFT JOIN `depart` AS d ON d.`row_id` = c.`latest_id` 
    LEFT JOIN `patdata` AS e ON e.`idno` = d.`row_id`";
    $db->select($sql_sso);
    $xray_sso = $db->get_item();
    $xray_price = ( isset($xray_sso['price']) ) ? $xray_sso['price'] : 0.00 ;

    if( $xray_price > 0 ){
        $user_sso += $xray_price;

        $sXray += $xray_price;
    }
    ?>
        <td align="right"><?=number_format($xray_price, 2);?></td>
        <td align="right"><b><?=number_format($user_sso, 2);?></b></td>
        <?php

    $all_sso += $user_sso;

    $all_per_user += $user_sso;

    /////////////////////
    // 
    // เบิกกับโรงพยาบาล
    // 
    ///////////////////// 
    // dump($extra_nPrice);
    
    $user_shs = 0;
    
    // ตรวจสุขภาพลูกจ้าง61
    $sql_shs = "SELECT d.* 
    FROM ( 
        SELECT MAX(`row_id`) AS `latest_id` 
        FROM `depart` 
        WHERE `hn` = '$hn' 
        AND ( `date` >= '2561-04-23 00:00:00' AND `date` <= '2561-04-30 23:59:59' ) 
        AND `cashok` LIKE 'SSOCHKUP61%'
        AND `depart` = 'PATHO' 
        GROUP BY `hn`,`depart` 
        
    ) AS c 
    LEFT JOIN `depart` AS d ON d.`row_id` = c.`latest_id` ";
    $db->select($sql_shs);
    $depart_items = $db->get_items();
        
    
    $new_labs = array();
    if ( count($depart_items) > 0) {

        // รายการของ depart ที่เป็น phato
        foreach ($depart_items as $key => $item) {

            $idno = $item['row_id'];
            $sql = "SELECT `code`,`price` AS `pat_price` 
            FROM `patdata` 
            WHERE `idno` = '$idno' 
            ORDER BY `code` ASC";
            $db->select($sql);
            $patdata_lab = $db->get_items();
            
            // ค่าใช้จ่าย แลป
            foreach ($patdata_lab as $key => $pat) { 
                $key = $pat['code'];
                $new_labs[$key] = $pat['pat_price'];

                $user_shs += $pat['pat_price'];

            }

        } // จบ foreach depart

        $late_branch = $user['branch'];

        $i++;
    }
    
    // เอารายการที่ได้จาก patdata มาแสดง
    foreach ($lab_keys as $labkey) {
        $pat_price = ( isset($new_labs[$labkey]) ) ? $new_labs[$labkey] : 0.00 ;

        // แสดงค่าใช้จ่ายส่วนเกินที่มาจากประกันสังคม
        if( $pat_price == 0 && $extra_nPrice[$labkey] > 0 ){
            $pat_price = $extra_nPrice[$labkey]; 

            $user_shs += (int) $pat_price;
        }

        ?>
        <td align="right"><?=number_format($pat_price, 2);?></td>
        <?php
    }
    


    $sql_shs = "SELECT e.`price` 
    FROM ( 
        SELECT MAX(`row_id`) AS `latest_id` 
        FROM `depart` 
        WHERE `hn` = '$hn' 
        AND ( `date` >= '2561-04-23 00:00:00' AND `date` <= '2561-04-30 23:59:59' ) 
        AND `cashok` LIKE 'SSOCHKUP61%'
        AND `depart` = 'XRAY' 
        GROUP BY `hn`,`depart` 
    ) AS c 
    LEFT JOIN `depart` AS d ON d.`row_id` = c.`latest_id` 
    LEFT JOIN `patdata` AS e ON e.`idno` = d.`row_id`";
    $db->select($sql_shs);
    $xray_shs = $db->get_item();


    $xray = ( isset($xray_shs['price']) ) ? $xray_shs['price'] : 0.00 ;

    if( $xray > 0 ){
        $user_shs += $xray; 

        $tXray += $xray; 
    }

    $all_shs += $user_shs;

    $all_per_user += $user_shs;

        ?>
        <td align="right"><?=number_format($xray, 2);?></td>
        <td align="right"><b><?=number_format($user_shs, 2);?></b></td>
        
        <td align="right"><b><?=number_format($all_per_user, 2);?></b></td>
    </tr>
    <?php


}

/*
?>
    <tr style="font-weight: bold;" align="right">
        <td colspan="6" align="center">รวมทั้งสิ้น</td>

        <td><?=number_format($sCbc, 2);?></td>
        <td><?=number_format($sUa, 2);?></td>
        <td><?=number_format($sBs, 2);?></td>
        <td><?=number_format($sCr, 2);?></td>
        <td><?=number_format($sHdl, 2);?></td>
        <td><?=number_format($sChol, 2);?></td>
        <td><?=number_format($sHbsag, 2);?></td>
        <td><?=number_format($sFobt, 2);?></td>
        <td><?=number_format($sXray, 2);?></td>
        <td><?=number_format($all_sso, 2);?></td>


        <td><?=number_format($tAlk, 2);?></td>
        <td><?=number_format($tBs, 2);?></td>
        <td><?=number_format($tBun, 2);?></td>
        <td><?=number_format($tCbc, 2);?></td>
        <td><?=number_format($tChol, 2);?></td>
        <td><?=number_format($tCr, 2);?></td>
        <td><?=number_format($tHdl, 2);?></td>
        <td><?=number_format($tLdl, 2);?></td>
        <td><?=number_format($tSgot, 2);?></td>
        <td><?=number_format($tSgpt, 2);?></td>
        <td><?=number_format($tTri, 2);?></td>
        <td><?=number_format($tUa, 2);?></td>
        <td><?=number_format($tXray, 2);?></td>
        <td><?=number_format($all_shs, 2);?></td>
    </tr>
<?php
*/
?>

</table>

<?php


    

}