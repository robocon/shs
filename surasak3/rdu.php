<?php
/**
 * ใช้ไฟล์ rdu_convert.php, rdu_convert_diag.php, rdu_convert_drug.php, rdu_convert_lab.php, rdu_convert_trauma.php 
 * ดึงข้อมูลมาไว้ใน folder rdu แล้วเอาไฟล์Dumpใส่ Database rdu ใน 192.168.1.13 อีกที
 */
include dirname(__FILE__).'/bootstrap.php';
define('RDU_TEST', '1');

$db = Mysql::load();
// $db->exec("SET NAMES UTF8");

// $quarter = input_post('quarter');
// if( $quarter == 1 ){
//     $month_range['min'] = '10';
//     $month_range['max'] = '12'; //คม
    
// }else if( $quarter == 2 ){
//     $month_range['min'] = '01';
//     $month_range['max'] = '03'; //คม
    
// }else if( $quarter == 3 ){
//     $month_range['min'] = '04';
//     $month_range['max'] = '06';
    
// }else if( $quarter == 4 ){
//     $month_range['min'] = '07';
//     $month_range['max'] = '09';
    
// }
?>

<style>
/* ตาราง */
*{
    font-family: "TH SarabunPSK", "TH Sarabun New";
    font-size: 20px;
}
.chk_table{
    border-collapse: collapse;
}
.chk_table th,
.chk_table td{
    padding: 3px;
    border: 1px solid black;
}
</style>

<div>
    <a href="../nindex.htm">กลับหน้าหลัก ร.พ.</a>
</div>

<?php
$default_year = date('Y');
$year = input_post('year', $default_year);

// $yChk = get_year_checkup(true,true);

$year_range = range(2020,$default_year);

// $quarter_range = array(
//     1 => 'ไตรมาสที่ 1(ต.ค. - ธ.ค.)',
//     'ไตรมาสที่ 2(ม.ค. - มี.ค.)',
//     'ไตรมาสที่ 3(เม.ย. - มิ.ย.)',
//     'ไตรมาสที่ 4(ก.ค. - ก.ย.)'
// );
?>
<form action="rdu.php" method="post">
    <fieldset>
        <legend>RDU Indicator</legend>
        <div>
            เลือกปีงบประมาณ 
            <select name="year" id="">
            <?php
            foreach ($year_range as $year_en) {
                $selected = ( $year_en == $year ) ? 'selected="selected"' : '' ;
                ?>
                <option value="<?=$year_en;?>" <?=$selected;?>><?=($year_en + 543);?></option>
                <?php
            }
            ?>
            </select>
            <?php 
            $get_month = input_post('month', date('m'));
            getMonthList('month', $get_month);
            ?>
        </div>
        <div>
            <button type="submit">แสดงผล</button>
            <input type="hidden" name="action" value="load">
        </div>
    </fieldset>
</form>
<?php 
// special char
// w3schools.com/charsets/ref_utf_math.asp
// &le; <=
// &ge; >=
$action = input_post('action');

if ( $action == 'load' ) {
    
    $year_for_title = $year;

    $yearSelectedTH = $yearSelected = input_post('year');
    $monthSelected = input_post('month');

    if($monthSelected===false){
        echo "กรุณาเลือกเดือน";
        exit;
    }

    // EN
    $whereMonth = $yearSelected.'-'.$monthSelected;

    $date_start = $whereMonth.'-01';
    $date_end = $whereMonth.'-'.date("t", strtotime($date_start));

    $dateStartTh = ($yearSelectedTH + 543).'-'.$monthSelected.'-01';
    $dateEndTh = ($yearSelectedTH + 543).'-'.$monthSelected.'-'.date('t', strtotime($dateStartTh));

    // TH
    $whereMonthTH = ($yearSelectedTH + 543).'-'.$monthSelected;

    // หาวันสุดท้ายของเดือน
    $lastOfMonth = date('t', strtotime($whereMonth.'-01'));

    // mktime format : H i s m d Y
    // 6เดือนล่าสุด
    $last6MonthMK = strtotime("-6 months");
    $last6Month = date('Y-m-d', $last6MonthMK);
    $last6MonthTH = (date('Y', $last6MonthMK)+543).date('-m-d', $last6MonthMK);

    $last1YearMK = strtotime("-1 year");
    $last1Year = date('Y-m-d', $last1YearMK);
    $last1YearTH = (date('Y', $last1YearMK)+543).date('-m-d', $last1YearMK);

    $year = $year + 543;

    include 'rdu_tb_diag.php';
    include 'rdu_tb_drugrx.php';
    include 'rdu_tb_opday.php';
    include 'rdu_tb_trauma.php';
    // include 'rdu_in1.php';
    // include 'rdu_in6.php';
    // include 'rdu_in7.php';
    // include 'rdu_in8.php';
    include 'rdu_in10.php';
    // exit;

    ?>
    <h3>รายงานผลการดำเนินงานตามตัวชี้วัด RDU ปีงบประมาณ <?=$year_for_title + 543;?> ขั้นที่2 (เดือน <?=$def_fullm_th[$monthSelected];?>) </h3>
    <table class="chk_table">
        <tr>
            <th>ตัวชี้วัดที่</th>
            <th>ชื่อตัวชี้วัด</th>
            <th>เป้าหมาย</th>
            <th>A</th>
            <th>B</th>
            <th>ร.พ.ค่ายฯ</th>
        </tr>
        <tr>
            <td align="center">1</td>
            <td>ร้อยละของรายการยาที่สั่งใช้ยาในบัญชียาหลักแห่งชาติ</td>
            <td>รพ.ระดับ A &ge; 75%<br>S &ge; 80%<br>M1-M2 &ge; 85%<br>F1-F3 &ge; 90%</td>
            <td align="right"><?=number_format($in1a);?></td>
            <td align="right"><?=number_format($in1b);?></td>
            <td align="right"><?=number_format($in1_result, 2);?></td>
        </tr>
        <tr>
            <td align="center">2</td>
            <td>ประสิทธิผลการดำเนินงานของคณะกรรมการ PTC ในการชี้นำสื่อสาร<br>และส่งเสริมเพื่อนำไปสู่การเป็นโรงพยาบาลส่งเสริมการใช้ยาอย่างสมเหตุผล</td>
            <td>ระดับ 3</td>
            <td align="right">-</td>
            <td align="right">-</td>
            <td align="right">-</td>
        </tr>
        <tr>
            <td align="center">3</td>
            <td>การดำเนินงานในการจัดทำฉลากยามาตรฐาน ฉลากยาเสริม และเอกสารข้อมูลยาใน 13กลุ่ม ที่มีรายละเอียดครบถ้วน</td>
            <td>รายการยา 13กลุ่ม</td>
            <td align="right">-</td>
            <td align="right">-</td>
            <td align="right">-</td>
        </tr>
        <tr>
            <td align="center">4</td>
            <td>รายการยาที่ควรพิจารณาตัดออก 8รายการ ซึ่งยังคงมีอยู่ในบัญชีรายการยาของโรงพยาบาล</td>
            <td>&le; 1รายการ</td>
            <td align="right">-</td>
            <td align="right">-</td>
            <td align="right">-</td>
        </tr>
        <tr>
            <td align="center">5</td>
            <td>การดำเนินงานเพื่อส่งเสริมจริยธรรมในการจัดซื้อและส่งเสริมการขายยา</td>
            <td>ระดับ 3</td>
            <td align="right">-</td>
            <td align="right">-</td>
            <td align="right">-</td>
        </tr>
        <tr>
            <td align="center">6</td>
            <td>ร้อยละการใช้ยาปฏิชีวนะในโรคติดเชื้อที่ระบบการหายใจช่วงบนและหลอดลมอักเสบเฉียบพลันในผู้ป่วยนอก</td>
            <?php 
            $url = "date_start=$dateStartTh&date_end=$dateEndTh";
            ?>
            <td>&le; ร้อยละ 20</td>
            <td align="right">
                <a href="rdu_in6_show.php?<?=$url;?>" target="_blank"><?=number_format($in6a);?></a>
            </td>
            <td align="right">
                <a href="rdu_in6_show.php?<?=$url;?>" target="_blank"><?=number_format($in6b);?></a>
            </td>
            <td align="right"><?=number_format($in6_result, 2);?></td>
        </tr>
        <tr>
            <td align="center">7</td>
            <td>ร้อยละการใช้ยาปฏิชีวนะในโรคอุจจาระร่วงเฉียบพลัน</td>
            <td>&le; ร้อยละ 20</td>
            <td align="right">
                <a href="rdu_in7_show.php?<?=$url;?>" target="_blank"><?=number_format($in7a);?></a>
            </td>
            <td align="right">
                <a href="rdu_in7_show.php?<?=$url;?>" target="_blank"><?=number_format($in7b);?></a>
            </td>
            <td align="right"><?=number_format($in7_result, 2);?></td>
        </tr>
        <tr>
            <td align="center">8</td>
            <td>ร้อยละการใช้ยาปฏิชีวนะในบาดแผลสดจากอุบัติเหตุ</td>
            <td>&le; ร้อยละ 40</td>
            <td align="right">
                <a href="rdu_in8_show.php?<?=$url;?>" target="_blank"><?=number_format($in8a);?></a>
            </td>
            <td align="right">
                <a href="rdu_in8_show.php?<?=$url;?>" target="_blank"><?=number_format($in8b);?></a>
            </td>
            <td align="right"><?=number_format($in8_result, 2);?></td>
        </tr>
        <tr>
            <td align="center">9</td>
            <td>ร้อยละการใช้ยาปฏิชีวนะในหญิงคลอดปกติครบกำหนดทางช่องคลอด</td>
            <td>&le; ร้อยละ 10</td>
            <td align="right">-</td>
            <td align="right">-</td>
            <td align="right">-</td>
        </tr>
        <tr>
            <td align="center">10</td>
            <td>ร้อยละของผู้ป่วยความดันเลือดสูงทั่วไป ที่มีการใช้ RAS blockage (ACEIs/ARBs/Renin inhibitor) <br>
            2ชนิดร่วมกัน ในการรักษาภาวะความดันเลือดสูง</td>
            <td>ร้อยละ 0</td>
            <td align="right" title="จำนวน visit ผู้ป่วยความดันเลือดสูงที่ได้รับการสั่งใช้ยากลุ่ม RAS Blockage &ge;2ชนิด">
                <a href="rdu_in10_show.php?<?=$url;?>" target="_blank"><?=number_format($in10a);?></a>
            </td>
            <td align="right" title="จำนวน visit ผู้ป่วยความดันเลือดสูงที่ได้รับการสั่งใช้ยากลุ่ม RAS Blockage อย่างน้อย1ชนิด">
                <a href="rdu_in10_show.php?<?=$url;?>" target="_blank"><?=number_format($in10b);?></a>
            </td>
            <td align="right"><?=number_format($in10_result, 2);?></td>
        </tr>

        <?php
        exit;
        ?>

        <tr>
            <td align="center">11</td>
            <td>ร้อยละของผู้ป่วยที่การใช้ glibenclamide ในผู้ป่วยที่มีอายุมากกว่า 65 ปี<br>หรือมี eGFR น้อยกว่า 60 มล./นาที/1.73 ตารางเมตร<br>
            ยาในเงื่อนไขข้อนี้คือ <b>Code:</b>1EUGL-C <b>Tradname:</b>Diabenol 5 mg. (Z) <b>Genname:</b>Glibenclamide 5 mg. 
            </td>
            <?php
            include 'rdu_in11.php';
            $link_11 = "rdu_in11_detail.php?date=$whereMonthTH&minDate=$last6Month&maxDate=$whereMonth-$lastOfMonth";
            ?>
            <td>&le; ร้อยละ 5</td>
            <td align="right">
                <a href="<?=$link_11;?>&table=a" target="_blank"><?=number_format($in11a);?></a>
            </td>
            <td align="right">
                <a href="<?=$link_11;?>&table=b" target="_blank"><?=number_format($in11b);?></a>
            </td>
            <td align="right"><?=number_format($in11_result, 2);?></td>
        </tr>
        <tr>
            <td align="center">12</td>
            <td>ร้อยละของผู้ป่วยเบาหวานที่ใช้ยา metformin เป็นยาชนิดเดียวหรือร่วมกับยาอื่นเพื่อควบคุมระดับน้ำตาล โดยไม่มีข้อห้ามใช้</td>
            <?php
            include 'rdu_in12.php';
            $link_12 = "rdu_in12_detail.php?date=$whereMonthTH&maxDate=$whereMonth&minDate=$last6Month";
            ?>
            <td>&ge; ร้อยละ 80</td>
            <td align="right">
                <a href="<?=$link_12;?>&table=a" target="_blank"><?=number_format($in12a);?></a>
            </td>
            <td align="right">
                <a href="<?=$link_12;?>&table=b" target="_blank"><?=number_format($in12b);?></a>
            </td>
            <td align="right"><?=number_format($in12_result, 2);?></td>
        </tr>
        <tr>
            <td align="center">13</td>
            <td>ร้อยละของผู้ป่วยนอกที่มีการใช้ยากลุ่ม NSAIDs ซ้ำซ้อน</td>
            <?php
            include 'rdu_in13.php';
            $link_13 = "rdu_in13_detail.php?date=$whereMonth";
            ?>
            <td>&le; ร้อยละ 5</td>
            <td align="right">
                <a href="<?=$link_13;?>&table=a" target="_blank"><?=number_format($in13a);?></a>
            </td>
            <td align="right">
                <a href="<?=$link_13;?>&table=b" target="_blank"><?=number_format($in13b);?></a>
            </td>
            <td align="right"><?=number_format($in13_result, 2);?></td>
        </tr>
        <tr>
            <td align="center">14</td>
            <td>ร้อยละของผู้ป่วยโรคไตเรื้อรังระดับ 3 ขึ้นไปที่ได้รับยา NSAIDs</td>
            <?php
            include 'rdu_in14.php';

            $link_14 = "rdu_in14_detail.php?date=$whereMonthTH";
            ?>
            <td>&le; ร้อยละ 10</td>
            <td align="right">
                <a href="<?=$link_14;?>&table=a" target="_blank"><?=number_format($in14a);?></a>
            </td>
            <td align="right">
                <a href="<?=$link_14;?>&table=b" target="_blank"><?=number_format($in14b);?></a>
            </td>
            <td align="right"><?=number_format($in14_result, 2);?></td>
        </tr>
        <tr>
            <td align="center">15</td>
            <td>ร้อยละผู้ป่วยโรคหืดเรื้อรังที่ได้รับยา inhaled corticosteroid</td>
            <?php
            include 'rdu_in15.php';

            $link_15 = "rdu_in15_detail.php?date=$whereMonth&minDate=$last1YearTH&maxDate=$whereMonthTH-$lastOfMonth";
            ?>
            <td>&ge; ร้อยละ 80</td>
            <td align="right">
                <a href="<?=$link_15;?>&table=a" target="_blank"><?=number_format($in15a);?></a>
            </td>
            <td align="right">
                <a href="<?=$link_15;?>&table=b" target="_blank"><?=number_format($in15b);?></a>
            </td>
            <td align="right"><?=number_format($in15_result, 2);?></td>
        </tr>
        <tr>
            <td align="center">16</td>
            <td>ร้อยละผู้ป่วยนอกสูงอายุ ที่ใช้ยากลุ่ม long-acting benzodiazepine ได้แก่ chlordiazepoxide, diazepam, dipotassium chlorazepate</td>
            <?php
            include 'rdu_in16.php';

            $link_16 = "rdu_in16_detail.php?date=$whereMonth";
            ?>
            <td>&le; ร้อยละ 5</td>
            <td align="right">
                <a href="<?=$link_16;?>&table=a" target="_blank"><?=number_format($in16a);?></a>
            </td>
            <td align="right">
                <a href="<?=$link_16;?>&table=b" target="_blank"><?=number_format($in16b);?></a>
            </td>
            <td align="right"><?=number_format($in16_result, 2);?></td>
        </tr>
        <tr>
            <td align="center">17</td>
            <td>จำนวนสตรีตั้งครรภ์ที่ได้รับยาที่ห้ามใช้ ได้แก่ ยา Warfarin/Statins/Ergot เมื่อรู้ว่าตั้งครรภ์แล้ว</td>
            <?php
            include 'rdu_in17.php';
            ?>
            <td>0 คน</td>
            <td align="right">-</td>
            <td align="right">-</td>
            <td align="right"><?=$in17_result;?></td>
        </tr>
        <tr>
            <td align="center">18</td>
            <td>ร้อยละของผู้ป่วยเด็ก ที่ได้รับการวินิจฉัยเป็นโรคติดเชื้อของทางเดินหายใจ (ครอบคลุมดรคตามรหัส ICD10 ตาม RUA-URI) และได้รับยาฮิสตามีนชนิด non-sedating</td>
            <?php
            include 'rdu_in18.php';

            $link_18 = "rdu_in18_detail.php?date=$whereMonth";
            ?>
            <td>&le; ร้อยละ 20</td>
            <td align="right">
                <a href="<?=$link_18;?>&table=a" target="_blank"><?=number_format($in18a);?></a>
            </td>
            <td align="right">
                <a href="<?=$link_18;?>&table=b" target="_blank"><?=number_format($in18b);?></a>
            </td>
            <td align="right"><?=number_format($in18_result, 2);?></td>
        </tr>
    </table>
    <?php 

    // $db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_diag_main`");
    // $db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_drugrx_main`");
    // $db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_trauma_main`");
    // $db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_opday_main`");
    // $db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_lab_main`");

}