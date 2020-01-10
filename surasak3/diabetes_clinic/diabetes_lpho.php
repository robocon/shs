<?php 
include '../bootstrap.php';

?>
<h3>ระบบปิดปรับปรุงชั่วคราว ขออภัยในความไม่สะดวก</h3>
<?php
exit;

$db = Mysql::load();
$year_range = range(2016, date('Y'));

?>
<style>
/* ตาราง */
body, button{
    font-family: "TH Sarabun New","TH SarabunPSK";
    font-size: 12pt;
}
.chk_table{
    border-collapse: collapse;
}

.chk_table th,
.chk_table td{
    padding: 3px;
    border: 1px solid black;
}
label{
    cursor: pointer;
}

@media print{
    .div-hide{
        display: none;
    }
}
</style>

<form action="diabetes_lpho.php" method="post" class="div-hide">
    <fieldset>
        <legend>ฟอร์มเลือกข้อมูล</legend>
        <?php 
        $year = input_post('year_selected');
        $type = input_post('type', 1);
        ?>
        <div> 
            เลือกปี : <?=getYearList('year_selected', true, $year, $year_range);?>
            <span>*ปีงบประมาณ</span>
        </div>
    </fieldset>
    <div>
        <button type="submit">แสดงผล</button>
        <input type="hidden" name="view" value="show">
    </div>
</form>

<?php 
$view = input_post('view');
if ( $view === 'show' ) {
    
    $year = input_post('year_selected');

    $yearStart = ($year-1).'-10-01';
    $yearEnd = $year.'-09-30';





    $sql = "SELECT b.`dateN`,b.`hn`,b.`ptname`,b.`dbbirt`,b.`retinal`,b.`retinal_date`,b.`foot`,b.`foot_date`,b.`height`,b.`weight`,b.`round`, 
    b.`bp1`,b.`bp2`,b.`l_bs`,b.`l_creatinine`, 
    CONCAT(SUBSTRING(b.`thidate`,1,4)+543, SUBSTRING(b.`thidate`,5,6)) AS `thidate`,
    CONCAT(SUBSTRING(b.`dateN`,1,4)+543, SUBSTRING(b.`dateN`,5,6)) AS `dateOpd`,
    SUBSTRING(b.`retinal_date`,1,10) AS `retinal_date`, 
    SUBSTRING(b.`foot_date`,1,10) AS `foot_date` 
    FROM ( 
        SELECT MAX(`row_id`) AS `max_id`, `hn` 
        FROM `diabetes_clinic_history` 
        WHERE ( `dateN` >= '$yearStart' AND `dateN` <= '$yearEnd' ) 
        GROUP BY `hn` 
    ) AS a 
    LEFT JOIN  `diabetes_clinic_history` AS b ON b.`row_id` = a.`max_id` 
    WHERE b.`hn` <> '' 
    AND ( b.`bp1` <> '' AND b.`bp2` <> '' ) 
    AND b.`l_hbalc` > 0 
    ORDER BY b.`dateN` ASC"; 
    $db->select($sql);
    $items = $db->get_items();




?>
<div style="text-align:center;">
    <h3>ข้อมูลตั้งแต่ <?=ad_to_bc($yearStart);?> ถึง<?=ad_to_bc($yearEnd);?></h3>
</div>
<table class="chk_table">
    <thead>
        <tr>
            <th colspan="17">แบบเก็บข้อมูลผู้ป่วยโรคเรื้อรัง</th>
        </tr>
        <tr>
            <th>คำนำหน้า</th>
            <th>ชื่อ</th>
            <th>สกุล</th>
            <th>วันเดือนปีเกิด</th>
            <th>อายุ</th>
            <th>ที่อยู่</th>
            <th>เลขที่ID</th>
            <th>รหัสโรค</th>
            <th>วันที่เริ่มรักษา</th>
            <th>น้ำหนัก</th>
            <th>ส่วนสูง</th>
            <th>รอบเอว</th>
            <th>BP</th>
            <th>FBS</th>
            <th>ตรวจตา</th>
            <th>ตรวจเท้า</th>
            <th>eGFR</th>
        </tr>
    </thead>
    <tbody>
        <?php 

        // https://gist.github.com/ishahid/8429640
        function diff($date1, $date2) {
            $diff = abs(strtotime($date2) - strtotime($date1));
            $years = floor($diff / (365*60*60*24));
            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24) / (60*60*24));
            return $years.'ปี '.$months.'เดือน ';
        }

        foreach ($items as $key => $item) {

            $hn = $item['hn'];
            $age = '';
            if (!empty($item['dbbirt'])) {
                
                list($uY, $uM, $uD) = explode('-', $item['dbbirt']);
                $dateBirth = ($uY-543)."-$uM-$uD";

                $age = diff($dateBirth, $item['dateN']);

            }

            $shortAge = substr($age,0,2);
            
            list($prefix,$name,$surname) = explode(' ', $item['ptname']);

            $sql = "SELECT CONCAT(`address`,' ต.',`tambol`,' อ.',`ampur`,' จ.',`changwat`) AS `contact`, 
            `idcard`,`sex` 
            FROM `opcard` 
            WHERE `hn`= '$hn' ";
            $db->select($sql);
            $op = $db->get_item();

            $bp = '';
            if( !empty($item['bp1']) && !empty($item['bp2']) ){
                $bp = $item['bp1'].'/'.$item['bp2'];
            }

            if( $op['sex'] == 'ญ' ){
                $egSex = 'F';
            }elseif ( $op['sex'] == 'ช' ) {
                $egSex = 'M';
            }

            $egfr = 0;
            if( !empty($item['l_creatinine']) ){
                $cr = $item['l_creatinine'];
                $db->select("SELECT eGFR('$shortAge','$egSex','$cr') AS egfr");
                $egfrCall = $db->get_item();
                $egfr = $egfrCall['egfr'];
            }

            $dateOpd = $item['dateOpd'];
            $sql = "SELECT GROUP_CONCAT(DISTINCT icd10 SEPARATOR ', ') AS `icd10`
            FROM `diag`
            WHERE `hn` LIKE '$hn' 
            AND `svdate`LIKE '$dateOpd%' 
            AND `icd10` <> '' 
            GROUP BY `hn` ";
            $db->select($sql);
            $diag = $db->get_item();
            $icd10 = $diag['icd10'];
            

            $ratinal = '';
            if (!empty($item['retinal'])) {
                $ratinal .= $item['retinal'];
            }
            if (!empty($item['retinal_date']) && $item['retinal_date'] != '0000-00-00') {
                $ratinal .= '('.$item['retinal_date'].')';
            }

            $foot = '';
            if (!empty($item['foot'])) {
                $foot .= $item['foot'];
            }
            if (!empty($item['foot_date']) && $item['foot_date'] != '0000-00-00') {
                $foot .= '('.$item['foot_date'].')';
            }
            


            ?>
            <tr>
                <td><?=$prefix?></td>
                <td><?=$name?></td>
                <td><?=$surname?></td>
                <td><?=$item['dbbirt'];?></td>
                <td><?=$age;?></td>
                <td><?=$op['contact'];?></td>
                <td><?=$op['idcard'];?></td>
                <td><?=$icd10;?></td>
                <td><?=$item['thidate'];?></td>
                <td><?=$item['weight'];?></td>
                <td><?=$item['height'];?></td>
                <td><?=$item['round'];?></td>
                <td><?=$bp;?></td>
                <td><?=$item['l_bs'];?></td>
                <td><?=$ratinal;?></td>
                <td><?=$foot;?></td>
                <td><?=number_format($egfr,2);?></td>
            </tr>
            
            <?php
        }
        ?>
        
    </tbody>
</table>
<?php


}
?>

