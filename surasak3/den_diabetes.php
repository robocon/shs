<?php 
include 'bootstrap.php';

$configs = array(
    'host' => '192.168.1.2',
    'port' => '3306',
    'dbname' => 'smdb',
    'user' => 'remoteuser',
    'pass' => ''
);

$db = Mysql::load($configs);
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
    font-size: 14pt;
}
.chk_table{
    border-collapse: collapse;
}

.chk_table, th, td{
    border: 1px solid black;
    font-size: 14pt;
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

    if( $type == 1 ){
        $sql = "SELECT * 
        FROM `diabetes_clinic_history` 
        WHERE `dateN` LIKE '$year%' 
        AND `hn` <> '' 
        AND ( `bp1` <> '' AND `bp2` <> '' ) 
        AND `l_hbalc` > 0 
        -- AND ( `l_hbalc` > 0  AND `l_hbalc` < 7  ) 
        -- AND `bp1` <> '' 
        -- AND ( `bp1` < 140 AND `bp2` < 90 )";
    }else if( $type == 2 ){

        $sql = "SELECT b.* 
        FROM ( 
            SELECT MAX(`row_id`) AS `max_id`, `hn` 
            FROM `diabetes_clinic_history` 
            WHERE `dateN` LIKE '$year%' 
            GROUP BY `hn` 
        ) AS a 
        LEFT JOIN  `diabetes_clinic_history` AS b ON b.`row_id` = a.`max_id` 
        WHERE b.`hn` <> '' 
        AND ( b.`bp1` <> '' AND b.`bp2` <> '' ) 
        AND b.`l_hbalc` > 0 ";
        $db->select($sql);
        // $count_all = $db->get_rows();

        // $sql = "SELECT b.* 
        // FROM ( 
        //     SELECT MAX(`row_id`) AS `max_id`, `hn` 
        //     FROM `diabetes_clinic_history` 
        //     WHERE `dateN` LIKE '$year%' 
        //     GROUP BY `hn` 
        // ) AS a 
        // LEFT JOIN  `diabetes_clinic_history` AS b ON b.`row_id` = a.`max_id`
        // WHERE ( `l_hbalc` > 0  AND `l_hbalc` < 7  ) 
        // AND b.`bp1` <> '' 
        // AND ( b.`bp1` < 140 AND b.`bp2` < 90 ) ";

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
    ?>
    <h3>รายชื่อผู้ป่วยเบาหวาน ปี<?=($year+543);?></h3>
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
        $i = 0;
        $male_rows = $female_rows = 0;
        $a1c_more7 = $hba1c_rows = 0;
        $bp_more_count = $bp_count = 0;
        $toots_count = 0;
        
        foreach ($items as $key => $item) { 

            $standard = 0;

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

            if( $item['l_hbalc'] > 0 && $item['l_hbalc'] < 7 ){
                $standard++;
                $hba1c_rows++;
            }elseif ( $item['l_hbalc'] > 0 && $item['l_hbalc'] >= 7 ) {
                $a1c_more7++;
            }

            if ( $item['bp1'] < 140 && $item['bp2'] < 90 ) {
                $standard++;
                $bp_count++;
            }elseif ( $item['bp1'] >= 140 && $item['bp2'] >= 90 ) {
                $bp_more_count++;
            }

            if( $item['tooth'] == 1 ){
                $toots_count++;
            }

            $bg_color = '';
            if( $standard == 2 ){
                $bg_color = 'style="background-color: #caffc9;"';
            }

            ?>
            <tr <?=$bg_color;?>>
                <td><?=$i;?></td>
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
    <br>
    <table class="chk_table">
        
        <tr>
            <th>จำแนกตามรายการ</th>
            <th>จำนวนราย</th>
        </tr>

        <?php 
        if ( $count_all > 0 ) {
            ?>
            <tr>
                <td>จำนวนผู้ป่วย ทั้งหมด แบบไม่กรอง HbA1c, bp</td>
                <td align="right"><?=$count_all;?></td>
            </tr>
            <?php
        }
        ?>

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
            <td>จำนวนผู้ป่วย HBA1C ที่น้อยกว่า 7</td>
            <td align="right"><?=$hba1c_rows;?></td>
        </tr>
        <tr>
            <td>จำนวนผู้ป่วย HBA1C มากกว่าหรือเท่ากับ 7</td>
            <td align="right"><?=$a1c_more7;?></td>
        </tr>
        <tr>
            <td>จำนวนผู้ป่วยที่ BP น้อยกว่า 140/90</td>
            <td align="right"><?=$bp_count;?></td>
        </tr>
        <tr>
            <td>จำนวนผู้ป่วยที่ BP มากกว่าหรือเท่ากับ 140/90</td>
            <td align="right"><?=$bp_more_count;?></td>
        </tr>
        <tr>
            <td>จำนวนผู้ป่วยที่ตรวจฟัน</td>
            <td align="right"><?=$toots_count;?></td>
        </tr>

    </table>
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

