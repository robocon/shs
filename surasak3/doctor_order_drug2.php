<?php 
include 'bootstrap.php';

$db = Mysql::load();
if( $_SESSION["smenucode"] != 'ADM' && ( $_SESSION["smenucode"] != 'ADMSSO' && $_SESSION['sIdname'] != 'สุมนา1' ) ){
    echo "ไม่สามารถเข้าใช้งานได้";
    exit;
}

?>
<style>
/* ตาราง */
body, button{
    font-family: "TH SarabunPSK", "TH Sarabun New";
    font-size: 16pt;
}
.chk_table{
    border-collapse: collapse;
}
.chk_table th{
    background-color: #b5b5b5;
}
.chk_table th,
.chk_table td{
    padding: 3px;
    border: 1px solid black;
    font-size: 16pt;
}
</style>
<div>
    <a href="../nindex.htm">&lt;&lt;&nbsp;กลับหน้าหลัก ร.พ.</a> | <a href="doctor_order_drug.php">ข้อมูลยา</a> | <a href="doctor_order_drug2.php">ข้อมูลยาที่มีมูลค่าการใช้สูง</a> | <a href="doctor_order_drug3.php">ข้อมูลการจ่ายยาเฉลี่ย 3 เดือนย้อนหลัง</a>
</div>
<div>
    <h3>ข้อมูลยาที่มีมูลค่าการใช้สูง</h3>
</div>
<fieldset>
    <legend>เลือกข้อมูลดูยาที่มีมูลค่าสูง</legend>

    <form action="doctor_order_drug2.php" method="post">
        <div>
            เดือน-ปี ที่เริ่ม 
            <?php 

            $start_month = input_post('start_month', date('m'));
            $start_year = input_post('start_year', (date('Y')+543));

            $end_month = input_post('end_month', date('m'));
            $end_year = input_post('end_year', (date('Y')+543));

            getMonthList('start_month',$start_month);

            getYearList('start_year', false, $start_year, range('2555', (date('Y')+543) ));
            ?>
        </div>
        <div>
            เดือน-ปี ที่สิ้นสุด
            <?php 
            getMonthList('end_month',$end_month);

            getYearList('end_year', false, $end_year, range('2555', (date('Y')+543) ));
            ?>
        </div>
        <div>
            แพทย์ 
            <?php 
            $sql = "SELECT CONCAT(a.`yot`,b.`name`) AS `doctor_name`,a.`doctorcode`, b.`name` 
            FROM `doctor` AS a 
            LEFT JOIN `inputm` AS b ON b.`codedoctor` = a.`doctorcode`
            WHERE a.`status` = 'y' 
            AND ( a.`menucode` = 'ADM' OR a.`menucode` = 'ADMNID' ) 
            AND ( 
                a.`doctorcode` IS NOT NULL 
                AND a.`doctorcode` != '00000' 
                AND a.`doctorcode` != '0000' 
            ) 
            AND ( b.`name` NOT REGEXP '^HD' AND b.`name` NOT REGEXP '^NID' ) 
            ORDER BY a.`row_id` ";
            $db->select($sql);
            $items = $db->get_items();
            ?>

                <select name="doctor_code" id="">
                    <option value="">เลือกแพทย์</option>
                    <?php 
                    foreach ($items as $key => $item) {
                        ?>
                        <option value="<?=$item['doctorcode'];?>"><?=$item['name'];?></option>
                        <?php
                    }
                    ?>
                </select>

        </div>
        <div>
            <button>แสดงข้อมูล</button>
            <input type="hidden" name="action" value="show">
        </div>
    </form>

</fieldset>
<?php

$action = input_post('action');
if ( $action == 'show' ) {
    

    $start_month = input_post('start_month');
    $start_year = input_post('start_year');

    $end_month = input_post('end_month');
    $end_year = input_post('end_year');

    $end_day_ofmonth = date('t', "$end_year-$end_month-01");

    $doctor_code = input_post('doctor_code');

    if ( empty($doctor_code) ) {
        echo "กรุณาเลือกแพทย์";
        exit;
    }

    $sql = "SELECT CONCAT(a.`yot`,b.`name`) AS `doctor_name`,a.`doctorcode`, b.`name` 
    FROM `doctor` AS a 
    LEFT JOIN `inputm` AS b ON b.`codedoctor` = a.`doctorcode`
    WHERE a.`status` = 'y' 
    AND ( a.`menucode` = 'ADM' OR a.`menucode` = 'ADMNID' ) 
    AND ( 
        a.`doctorcode` IS NOT NULL 
        AND a.`doctorcode` != '00000' 
        AND a.`doctorcode` != '0000' 
    ) 
    AND ( b.`name` NOT REGEXP '^HD' AND b.`name` NOT REGEXP '^NID' ) 
    AND a.`doctorcode` = '$doctor_code' 
    ORDER BY a.`row_id` ";
    $db->select($sql);
    $dt = $db->get_item();

    $sql = "SELECT a.`ptname`,a.`date`, 
    b.`hn`, b.`drugcode`, b.`tradname`, c.`salepri`,b.`amount`, b.`price`, b.`part`,
    c.`row_id`, c.`unit`,a.`cashok`,a.`year_month`,a.`super_id` 
    FROM ( 
        SELECT *, 
        CONCAT(SUBSTRING(`date`,1,7)) AS `year_month`, 
        CONCAT(SUBSTRING(`date`,1,10),`hn`,`tvn`) AS `super_id` 
        FROM `phardep` 
        WHERE `ptright` LIKE 'R07%' 
        AND `date` >= '$start_year-$start_month-01 00:00:00' AND `date` <= '$end_year-$end_month-$end_day_ofmonth 23:59:59' 
        AND `doctor` LIKE '%$doctor_code%' 
        AND ( `chktranx` IS NOT NULL AND `borrow` IS NULL )
        AND ( `an` IS NULL )
        ORDER BY `row_id` ASC 
    ) AS a 
    LEFT JOIN `drugrx` AS b ON b.`idno` = a.`row_id` 
    LEFT JOIN ( 
    
        SELECT * 
        FROM `druglst` 
        WHERE `part` LIKE 'DD%' 
        AND `salepri` >= 5 
        AND `drugcode` NOT IN ('1KALE*  ','20KALE    ','30LP200_RT','1TEEV','20STEEV','30TEEV','1GPO30*  ','20SGPO30','20SGPO40','20GPOZ250','30GPOZ250','1EPIV-C*  ','20S3TC','30LAM_150','30LAM_300','20VIRE','20SZIL','20KALE    ','20STOC  ') AND (`drugcode` NOT LIKE  '20%' AND  `drugcode` NOT LIKE  '30%')
    ) AS c ON c.`drugcode` = b.`drugcode`
    WHERE c.`row_id` IS NOT NULL ";
	
    $db->select($sql);

    $drug_list = $db->get_items();
    ?>
    <div>
        <h3>รายการยาที่มีมูลค่าสูงของแพทย์ <?=$dt['name'];?> ตั้งแต่ <?=$def_fullm_th[$start_month].' '.$start_year;?> ถึง <?=$def_fullm_th[$end_month].' '.$end_year;?></h3>
    </div>
    <table class="chk_table">
        <tr>
            <th>#</th>
            <th>วันที่</th>
            <th>HN</th>
            <th>ชื่อ-สกุล</th>
            <th>รหัสยา</th>
            <th>Trade name</th>
            <th>ราคาต่อหน่วย</th>
            <th>หน่วยนับ</th>
            <th>จำนวนที่สั่ง</th>
            <th>รวมราคา</th>
            <th>ในบัญชี/นอกบัญชี</th>
            <th>การจ่าย</th>
        </tr>
        <?php 
        $i = 1; 
        $late_user_id = '';

        $hn_i = 1;

        $all_items = array();
        foreach ($drug_list as $key => $d) {

            $c = '';
            if( $i % 2 == 0 ){
                $c = 'style="background-color: #dddddd;"';
            }

            $hn = $d['super_id'];
            $ptname = $d['ptname'];

            $test_ym = $d['year_month'];
            if( $test_ym == $late_month ){
                if ($hn != $late_user_id) {
                    $hn_i++;
                }
                
                $ym_price += $d['price'];
            }else{
                $hn_i = 1;
                $ym_price = $d['price'];
            }

            ?>
            <tr <?=$c;?> >
                <td align="right"><?=$i;?></td>
                <td><?=$d['date'];?></td>
                <td><?=$d['hn'];?></td>
                <td><?=$ptname;?></td>
                <td><?=$d['drugcode'];?></td>
                <td><?=$d['tradname'];?></td>
                <td align="right"><?=number_format($d['salepri'],2);?></td>
                <td><?=$d['unit'];?></td>
                <td align="right"><?=$d['amount'];?></td>
                <td align="right"><?=number_format($d['price'],2);?></td>
                <td>
                <?php 
                if( $d['part'] == 'DDL' ){
                    echo 'ในบัญชียาหลัก';
                }elseif( $d['part'] == 'DDY' OR $d['part'] == 'DDN' ){

                    $dd = '';
                    if ( $d['part'] == 'DDY' ) {
                        $dd = '(เบิกได้)';
                    }elseif( $d['part'] == 'DDN' ) {
                        $dd = '(เบิกไม่ได้)';
                    }

                    echo '<span style="color: #b5b500;">นอกบัญชียาหลัก '.$dd.'</span>';
                }
                ?>
                </td>
                <td><?=$d['cashok'];?></td>
            </tr>
            <?php 
            $i++;
            // $hn_i++;

            $all_items[$test_ym] = array(
                'vn' => $hn_i,
                'sum' => $ym_price
            );

            $late_user_id = $d['super_id'];
            $late_month = $d['year_month'];
        }
        ?>

    </table>
    <br>
    <br>
    <?php 
    dump($all_items);
/*
$sql = "SELECT a.`ptname`,a.`date`, 
b.`hn`, b.`drugcode`, b.`tradname`, c.`salepri`,b.`amount`, b.`price`, b.`part`,
c.`row_id`, c.`unit`,a.`cashok`
FROM ( 
    SELECT * 
    FROM `phardep` 
    WHERE `ptright` LIKE 'R07%' 
    AND `date` >= '$start_year-$start_month-01 00:00:00' AND `date` <= '$end_year-$end_month-$end_day_ofmonth 23:59:59' 
    AND `doctor` LIKE '%$doctor_code%' 
    AND (`an` IS NULL || `an`='') 
    ORDER BY `row_id` ASC 
) AS a 
LEFT JOIN ( 
    SELECT *,(`price`/`amount`) AS `saleprice`
    FROM `drugrx` 
    WHERE `date` >= '$start_year-$start_month-01 00:00:00' AND `date` <= '$end_year-$end_month-$end_day_ofmonth 23:59:59' 
    AND `part` LIKE 'DD%' 
    AND ( 
        `drugcode` NOT IN ('1KALE*  ','20KALE    ','30LP200_RT','1TEEV','20STEEV','30TEEV','1GPO30*  ','20SGPO30','20SGPO40','20GPOZ250','30GPOZ250','1EPIV-C*  ','20S3TC','30LAM_150','30LAM_300','20VIRE','20SZIL','20KALE    ','20STOC  ') 
        AND `drugcode` NOT LIKE '20%' 
        AND `drugcode` NOT LIKE '30%' 
    )

 ) AS b ON b.`idno` = a.`row_id` 
WHERE b.`row_id` IS NOT NULL 
AND b.`saleprice` > 5 ";
dump($sql);
    $db->select($sql);
    $items = $db->get_items();
    */
    $items = array();
    ?>
    <table class="chk_table">
        <tr>
            <th>เดือน/ปี</th>
            <th>จำนวนผู้ป่วยนอกต่อเดือน(vn)</th>
            <th>รวมราคายา(บาท)</th>
        </tr>
        <?php 
        foreach ($items as $key => $item) {
            list($year,$m) = explode('-',$item['year_month']);
            ?>
            <tr>
                <td><?=$def_fullm_th[$m];?> / <?=$year;?></td>
                <td align="right"><?=$item['all_pt'];?></td>
                <td align="right"><?=number_format($item['total'],2);?></td>
            </tr>
            <?php
        }
        ?>
        
    </table>
    <?php

}

