<?php 
include 'bootstrap.php';

$db = Mysql::load();
$db->exec('SET NAMES UTF-8');

$end = date('Y');
$year_range = range(2016, $end);

function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}

	if ($ageM==0){
		$pAge="$ageY ปี";
	}else{
		$pAge="$ageY ปี $ageM เดือน";
	}

    return $pAge;
}
?>
<style>
/* ตาราง */
body, button{
    font-family: TH SarabunPSK, TH Sarabun NEW;
    font-size: 13pt;
}
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
label{
    cursor: pointer;
}
</style>
<div>
    <a href="../nindex.htm">หน้าหลัก ร.พ.</a>
</div>
<form action="den_diabetes.php" method="post">
    <h3>ระบบแสดงรายชื่อผู้ป่วยเบาหวาน สำหรับกองทันตกรรม</h3>

    <?php 
    $year = input_post('year_selected');
    $type = input_post('type', 1);
    ?>
    <div> 
        เลือกปี : 
        <?php 
        getYearList('year_selected', true, $year, $year_range);
        ?>
        <span>*ปีงบประมาณ</span>
    </div>

    <div>
        <div>วิธีการเลือกข้อมูล</div>
        <div>
            <?php 
            $type1_selected = ( $type == 1 ) ? 'checked="checked"' : '' ;
            ?>
            <input type="radio" name="type" id="type1" value="1" <?=$type1_selected;?>> 
            <label for="type1">แบบไม่รวม HN (ข้อมูลทุกครั้งที่มาใช้บริการ)</label>
        </div>
        <div>
            <?php 
            $type2_selected = ( $type == 2 ) ? 'checked="checked"' : '' ;
            ?>
            <input type="radio" name="type" id="type2" value="2" <?=$type2_selected;?>> 
            <label for="type2">แบบรวม HN (ข้อมูลครั้งล่าสุดของผู้ป่วย)</label>
        </div>
    </div>

    <div>
        <button type="submit">แสดงรายงาน</button>
        <input type="hidden" name="action" value="show_data">
    </div>

</form>

<?php

$action = input_post('action');
if ( $action == 'show_data' ) {
    
    $year = input_post('year_selected');
    $type = input_post('type');

    $yearStart = ($year-1).'-10-01';
    $yearEnd = $year.'-09-30';

    if( $type == 1 ){
        $sql = "SELECT * 
        FROM `diabetes_clinic_history` 
        WHERE ( `dateN` >= '$yearStart' AND `dateN` <= '$yearEnd' ) 
        AND `hn` <> '' 
        AND ( `bp1` <> '' AND `bp2` <> '' ) 
        AND `l_hbalc` > 0 ";

    }else if( $type == 2 ){

        $sql = "SELECT b.* 
        FROM ( 
            SELECT MAX(`row_id`) AS `max_id`, `hn` 
            FROM `diabetes_clinic_history` 
            WHERE ( `dateN` >= '$yearStart' AND `dateN` <= '$yearEnd' ) 
            GROUP BY `hn` 
        ) AS a 
        LEFT JOIN  `diabetes_clinic_history` AS b ON b.`row_id` = a.`max_id` 
        WHERE b.`hn` <> '' 
        AND ( b.`bp1` <> '' AND b.`bp2` <> '' ) 
        AND b.`l_hbalc` > 0 ";
        $db->select($sql);

    }
    $db->select($sql);
    $items = $db->get_items();

    $cigarette_list = array(
        0 => 'ไม่สูบบุหรี่',
        1 => 'สูบบุหรี่',
        2 => 'NA',
    );

    $count_other = 0;
    $count_smoke = 0;
    $count_non_smoke = 0;

    $age_list = array();

    // แยกกลุ่มคนที่เข้าเกณฑ์ hba1c กับ bp
    $criteria_pass = array();
    $criteria_not_pass = array();

    // 
    $i = 0;
    $male_rows = $female_rows = $a1c_more7 = $hba1c_rows = $bp_more_count = $bp_count = $toots_count = 0;

    foreach ($items as $key => $item) { 

        // เก็บข้อมูล
        $test_criteria = 0;

        if( $item['l_hbalc'] > 0 && $item['l_hbalc'] <= 7 ){
            $test_criteria++;
        }

        if ( $item['bp1'] < 130 && $item['bp2'] < 80 ) {
            $test_criteria++;
        }

        if ( $test_criteria >= 2 ) {
            $criteria_pass[] = $item;
        }else{
            $criteria_not_pass[] = $item;
        }
        // เก็บข้อมูล

        ++$i;

        $age = calcage($item['dbbirt']);

        $test_age = substr($age, 0, 2);
        $age_list[$test_age][] = $item['hn'];

        $cig = $item['smork'];
        if( $cig === '0' ){
            $count_non_smoke++;
        }else if( $cig === '1' ){
            $count_smoke++;
        }

        $other = '';
        if( $item['ht'] != '' ){
            $other .= 'HT, ';
        }

        if ( $item['ht_etc'] != '' ) {
            $other .= $item['ht_etc'];
        }

        if ( $other != '' ) {
            $count_other++;
        }

        if( $item['sex'] == 1 ){
            $female_rows++;
        }elseif ( $item['sex'] == 0 ) {
            $male_rows++;
        }

        if( $item['l_hbalc'] > 0 && $item['l_hbalc'] <= 7 ){
            $hba1c_rows++;
        }elseif ( $item['l_hbalc'] > 0 && $item['l_hbalc'] > 7 ) {
            $a1c_more7++;
        }

        if ( $item['bp1'] <= 130 && $item['bp2'] <= 80 ) {
            $bp_count++;
        }elseif ( $item['bp1'] > 130 && $item['bp2'] > 80 ) {
            $bp_more_count++;
        }

        if( $item['tooth'] == 1 ){
            $toots_count++;
        }

    }



    ?>

    <div width="100%" style="clear: both;">
    
        <div style="float: left; width: 50%;">

            <h3>รายชื่อผู้ป่วยเบาหวาน ปี<?=($year+543);?> ที่ผ่านเกณฑ์ HBA1C < 7 และ BP 130/80</h3>
            <table class="chk_table">
                <tr>
                    <th>#</th>
                    <th>HN</th>
                    <th>ชื่อ-สกุล</th>
                    <th>เพศ</th>
                    <th>อายุ</th>
                    <th>HBA1C</th>
                    <th>BP</th>
                    <th>บุหรี่</th>
                    <th>โรคร่วม</th>
                </tr>
                <?php 
                $i1 = 0;
                foreach ($criteria_pass as $key => $item) { 

                    $age = calcage($item['dbbirt']);
                    $cig = $item['smork'];

                    $other = '';
                    if( $item['ht'] != '' ){
                        $other .= 'HT, ';
                    }

                    if ( $item['ht_etc'] != '' ) {
                        $other .= $item['ht_etc'];
                    }

                    ++$i1;

                    ?>
                    <tr>
                        <td><?=$i1;?></td>
                        <td><?=$item['hn'];?></td>
                        <td><?=$item['ptname'];?></td>
                        <td><?=( $item['sex'] == '1' ? 'หญิง' : 'ชาย' );?></td>
                        <td><?=$age;?></td>
                        <td><?=$item['l_hbalc'];?></td>
                        <td><?=$item['bp1'].'/'.$item['bp2'];?></td>
                        <td><?=$cigarette_list[$cig];?></td>
                        <td><?=$other;?></td>
                    </tr>
                    <?php 

                }
                ?>
            </table>

        </div>
    
        <div style="float: left; width: 50%;">
                
            <h3>รายชื่อผู้ป่วยเบาหวาน ปี<?=($year+543);?> ที่ไม่ผ่านเกณฑ์</h3>
                
            <table class="chk_table">
                <tr>
                    <th>#</th>
                    <th>HN</th>
                    <th>ชื่อ-สกุล</th>
                    <th>เพศ</th>
                    <th>อายุ</th>
                    <th>HBA1C</th>
                    <th>BP</th>
                    <th>บุหรี่</th>
                    <th>โรคร่วม</th>
                </tr>
                <?php 
                $i2 = 0;
                foreach ($criteria_not_pass as $key => $item) { 

                    ++$i2;

                    $age = calcage($item['dbbirt']);

                    $test_age = substr($age, 0, 2);
                    $cig = $item['smork'];

                    $other = '';
                    if( $item['ht'] != '' ){
                        $other .= 'HT, ';
                    }

                    if ( $item['ht_etc'] != '' ) {
                        $other .= $item['ht_etc'];
                    }


                    ?>
                    <tr>
                        <td><?=$i2;?></td>
                        <td><?=$item['hn'];?></td>
                        <td><?=$item['ptname'];?></td>
                        <td><?=( $item['sex'] == '1' ? 'หญิง' : 'ชาย' );?></td>
                        <td><?=$age;?></td>
                        <td><?=$item['l_hbalc'];?></td>
                        <td><?=$item['bp1'].'/'.$item['bp2'];?></td>
                        <td><?=$cigarette_list[$cig];?></td>
                        <td><?=$other;?></td>
                    </tr>
                    <?php 

                }

                $count_dm = $i - $count_other;
                ?>
            </table>


        </div>

    </div>

    <div style="clear: both;"></div>

    <br>
    <div style="clear: both;">
    
        <table class="chk_table">
            
            <tr>
                <th>จำแนกตามรายการ</th>
                <th>จำนวนราย</th>
            </tr>

            <tr>
                <td>จำนวนผู้ป่วย ทั้งหมด </td>
                <td align="right"><?=$i;?></td>
            </tr>
            <tr>
                <td>จำนวนที่ผ่านเกณฑ์ HBA1C < 7 และ BP 130/80</td>
                <td align="right"><?=$i1;?></td>
            </tr>
            <tr>
                <td>จำนวนผู้ป่วย DM อย่างเดียว</td>
                <td align="right"><?=$count_dm;?></td>
            </tr>
            <tr>
                <td>จำนวนผู้ป่วย DM และมีโรคร่วม</td>
                <td align="right"><?=$count_other;?></td>
            </tr>
            <tr>
                <td>จำนวนผู้ป่วย ที่สูบบุหรี่</td>
                <td align="right"><?=$count_smoke;?></td>
            </tr>
            <tr>
                <td>จำนวนผู้ป่วย ที่ไม่สูบบุหรี่</td>
                <td align="right"><?=$count_non_smoke;?></td>
            </tr>
            
            <tr>
                <td>จำนวนผู้ป่วย ที่ไม่มีข้อมูลสูบบุหรี่</td>
                <td align="right"><?=( $i - ( $count_smoke + $count_non_smoke ) );?></td>
            </tr>

            <tr>
                <td>เพศ ชาย</td>
                <td align="right"><?=$male_rows;?></td>
            </tr>
            <tr>
                <td>เพศ หญิง</td>
                <td align="right"><?=$female_rows;?></td>
            </tr>
            <tr>
                <td>จำนวนผู้ป่วย HBA1C ที่น้อยกว่าหรือเท่ากับ 7</td>
                <td align="right"><?=$hba1c_rows;?></td>
            </tr>
            <tr>
                <td>จำนวนผู้ป่วย HBA1C มากกว่า 7</td>
                <td align="right"><?=$a1c_more7;?></td>
            </tr>
            <tr>
                <td>จำนวนผู้ป่วยที่ BP น้อยกว่าหรือเท่ากับ 130/80</td>
                <td align="right"><?=$bp_count;?></td>
            </tr>
            <tr>
                <td>จำนวนผู้ป่วยที่ BP มากกว่า 130/80</td>
                <td align="right"><?=$bp_more_count;?></td>
            </tr>
            <tr>
                <td>จำนวนผู้ป่วยที่ตรวจฟัน</td>
                <td align="right"><?=$toots_count;?></td>
            </tr>

        </table>
    </div>
    <br>
    <table class="chk_table">
        <tr>
            <th>จำแนกตามอายุ</th>
            <th>จำนวนราย</th>
        </tr>
        <?php 
        ksort($age_list);
        foreach ($age_list as $key => $age) {
            ?>
            <tr>
                <td>จำนวนผู้ป่วยอายุ <?=$key;?>ปี</td>
                <td align="center"><?=count($age);?></td>
            </tr>
            <?php
        }
        ?>
    </table>

    <?php
    

}

