<?php 

include 'bootstrap.php';
$hn = input_get('hn');

if( empty($hn) ){
    ?><p>Invalid parameters</p><?php
    exit;
}

$strtime = strtotime("-2 YEAR");
$thDate = (date('Y', $strtime)+543).date('-m-d', $strtime).' 23:59:59';

$db = Mysql::load();
$sql = "SELECT a.`row_id`,a.`thidate`,a.`hn`,a.`ptname`,a.`vn`,a.`age`,a.`ptright`,a.`toborow` 
FROM `opday` AS a 
WHERE a.`hn` = '$hn' 
AND a.`thidate` >= '$thDate' 
ORDER BY a.`row_id` DESC";


$db->select($sql);
$items = $db->get_items();

/**
 * @todo
 * [x] select from opday 
 * [x] join opd 
 * [x] join diag 
 * [x] join drug 
 * [] link to resulthead + resultdetail 
 */

?>
<style>
*{
    font-family: "TH SarabunPSK","TH Sarabun New";
    font-size: 16pt;
}
h3{
    font-size: 26pt;
}
</style>
<div>
    <h3>ข้อมูลผู้ป่วยย้อนหลัง 1ปี</h3>
</div>
<?php

foreach ($items as $key => $item) { 

    $hn = $item['hn'];
    
    ?>
    <div style="border:1px solid black; padding: 4px;">
        <div style="padding-bottom: 8px;">
            <div><u>ข้อมูลเบื้องต้น</u></div>
            <b>วันที่มารับบริการ : </b><?=$item['thidate'];?> 
            <b>ชื่อ-สกุล : </b><?=$item['ptname'];?> 
            <b>HN : </b><?=$item['hn'];?> 
            <b>VN : </b><?=$item['vn'];?> 
            <b>อายุ : </b><?=$item['age'];?> 
            <b>สิทธิการรักษา : </b><?=$item['ptright'];?> 
            <b>มาเพื่อ : </b><?=$item['toborow'];?>
        </div>
        <?php 
        
        list($testDate, $testTime) = explode(' ', $item['thidate']);
        list($Y, $M, $D) = explode('-', $testDate);
        $thDateHn = "$D-$M-$Y".$item['hn'];

        $sqlOpday = "SELECT * FROM `opd` WHERE `thdatehn` = '$thDateHn' ";
        $db->select($sqlOpday);
        if( $db->get_rows() > 0 ){
        
            $opday = $db->get_item();
            ?>
            <div style="padding-bottom: 8px;">
                <div><u>ข้อมูลซักประวัติ</u></div> 
                <b>T : </b><?=$opday['temperature'];?> 
                <b>P : </b><?=$opday['pause'];?> 
                <b>R : </b><?=$opday['rate'];?> 
                <b>BP : </b><?=$opday['bp1'].'/'.$opday['bp2'];?> 
                <b>นน : </b><?=$opday['weight'];?> 
                <b>ส่วนสูง : </b><?=$opday['height'];?> 
                <b>BMI : </b><?=$opday['temperature'];?> 
                <b>อาการ : </b><?=$opday['organ'];?> 
                <b>โรคประจำตัว : </b><?=$opday['congenital_disease'];?> 
            </div>
            <?php 
        }

        $sqlDiag = "SELECT `diag`,`icd10`,`type`,`diag_thai` FROM `diag` WHERE `svdate` LIKE '$testDate%' AND `hn` = '$hn' ORDER BY `row_id` ASC";
        $db->select($sqlDiag);
        $diag_items = $db->get_items();
        ?>
        <div style="padding-bottom: 8px;">
            <div><u>Diag</u></div> 
            <?php 
            foreach ($diag_items as $key => $diag) {
                ?>
                <div>
                    <b><?=$diag['type'];?> : </b>(<?=$diag['icd10'];?>) <?=$diag['diag'];?>
                    <?php 
                    if( !empty($diag['diag_thai']) ){
                        echo ' - '.$diag['diag_thai'];
                    }
                    ?>
                </div>
                <?php
            }
            ?>
        </div>

        <?php 
        $sqlDrug = "SELECT a.*,CONCAT(b.`detail1`,' ',b.`detail2`,' ',b.`detail3`) AS `drug_detail` 
        FROM `drugrx` AS a 
        LEFT JOIN `drugslip` AS b ON b.`slcode` = a.`slcode` 
        WHERE a.`date` LIKE '$testDate%' 
        AND a.`hn` = '$hn' 
        ORDER BY a.`row_id` ASC";
        $db->select($sqlDrug);
        if( $db->get_rows() > 0 ){
            $drug_items = $db->get_items();
            ?>
            <div style="padding-bottom: 8px;">
                <div><u>ยา</u></div> 
                <table>
                    <tr>
                        <th>ชื่อยา</th>
                        <th>จำนวน</th>
                        <th>วิธีใช้</th>
                    </tr>
                    <?php 
                    foreach ($drug_items as $key => $drug) { 
                        ?>
                        <tr>
                            <td><?=$drug['tradname'];?></td>
                            <td><?=$drug['amount'];?></td>
                            <td><?=$drug['slcode'];?> (<?=$drug['drug_detail'];?>)</td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>
            <?php 
        } 
        ?>

        <?php 
        
        ?>
        // resulthead 
        lab_lst_print_opd1new.php?
        hn=<?=$hn;?>&
        lab_date=<?php echo urlencode($arr["dateresult"]);?>&       --> orderdate
        labnumber=<?=$arr['labnumber'];?>&                          --> labnumber
        listlab=<?php echo implode(", ",$list_lab);?>&              --> ชื่อแลป CBC, UA
        depart=<?php echo $sourcename;?>&                           --> sourcename
        doctor=<?php echo $clinicianname;?>                         --> clinicianname
        
        <div style="padding-bottom: 8px;">
            <div><u>ดูผลแลป</u></div> 
            <b>XXX : </b> 
        </div>
    </div>
    <?php

}

