<?php

include 'bootstrap.php';
define('RDU_TEST', '1');


$db = Mysql::load($rdu_configs);
$quarter = input_post('quarter');
if( $quarter == 1 ){
    $month_range['min'] = '10';
    $month_range['max'] = '12'; //คม
    
}else if( $quarter == 2 ){
    $month_range['min'] = '01';
    $month_range['max'] = '03'; //คม
    
}else if( $quarter == 3 ){
    $month_range['min'] = '04';
    $month_range['max'] = '06';
    
}else if( $quarter == 4 ){
    $month_range['min'] = '07';
    $month_range['max'] = '09';
    
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

.chk_table, th, td{
    border: 1px solid black;
    font-size: 16pt;
}

.chk_table th,
.chk_table td{
    padding: 3px;
}
</style>

<div>
    <a href="../nindex.htm">กลับหน้าหลัก ร.พ.</a>
</div>

<?php
$default_year = date('Y');
$year = input_post('year', $default_year);
$year_range = array(2017,2018,2019);

$quarter_range = array(
    1 => 'ไตรมาสที่ 1(ต.ค. - ธ.ค.)',
    'ไตรมาสที่ 2(ม.ค. - มี.ค.)',
    'ไตรมาสที่ 3(เม.ย. - มิ.ย.)',
    'ไตรมาสที่ 4(ก.ค. - ก.ย.)'
);
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

            เลือกช่วงไตรมาส 
            <select name="quarter" id="">
                <?php
                foreach ($quarter_range as $key => $quarter_item) {

                    $selected = ( $key == $quarter ) ? 'selected="selected"' : '' ;
                    
                    ?>
                    <option value="<?=$key;?>" <?=$selected;?> ><?=$quarter_item;?></option>
                    <?php
                }
                ?>
            </select>
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
    
    // ถ้าไตรมาสแรกหักไป1ปี
    if( $quarter == 1 ){
        // $year = $year - 1;
    }

    $last_day = date('t', $year.'-'.$month_range['max'].'-01');

    $year = $year + 543;

    // $sql = "CREATE TEMPORARY TABLE IF NOT EXISTS `tmp_diag_main` SELECT * FROM `diag` WHERE `year` = '$year' AND `quarter` = '$quarter' ";
    // $db->exec($sql);

    // $sql = "CREATE TEMPORARY TABLE `tmp_drugrx_main` SELECT * FROM `drugrx` WHERE `year` = '$year' AND `quarter` = '$quarter' ";
    // $db->exec($sql);

    // $sql = "CREATE TEMPORARY TABLE `tmp_trauma_main` SELECT * FROM `trauma` WHERE `year` = '$year' AND `quarter` = '$quarter' ";
    // $db->exec($sql);

    // $sql = "CREATE TEMPORARY TABLE `tmp_opday_main` SELECT * FROM `opday` WHERE `year` = '$year' AND `quarter` = '$quarter' ";
    // $db->exec($sql);

    // $sql = "CREATE TEMPORARY TABLE `tmp_lab_main` SELECT * FROM `lab` WHERE `year` = '$year' AND `quarter` = '$quarter' ";
    // $db->exec($sql);

    ?>
    <h3>รายงานผลการดำเนินงานตามตัวชี้วัด RDU ปีงบประมาณ <?=$year_for_title + 543;?> ขั้นที่2 (ไตรมาส <?=$quarter;?>) </h3>
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
            <?php
            include 'rdu_in1.php';
            ?>
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
            include 'rdu_in6.php';
            $url_in6 = "year=$year&quarter=$quarter";
            ?>
            <td>&le; ร้อยละ 20</td>
            <td align="right">
                <a href="rdu_in6_a.php?<?=$url_in6;?>" target="_blank"><?=number_format($in6a);?></a>
            </td>
            <td align="right">
                <a href="rdu_in6_b.php?<?=$url_in6;?>" target="_blank"><?=number_format($in6b);?></a>
            </td>
            <td align="right"><?=number_format($in6_result, 2);?></td>
        </tr>
        <tr>
            <td align="center">7</td>
            <td>ร้อยละการใช้ยาปฏิชีวนะในโรคอุจจาระร่วงเฉียบพลัน</td>
            <?php 
            include 'rdu_in7.php';
            $url_in7 = "year=$year&quarter=$quarter";
            ?>
            <td>&le; ร้อยละ 20</td>
            <td align="right">
                <a href="rdu_in7_a.php?<?=$url_in7;?>" target="_blank"><?=number_format($in7a);?></a>
            </td>
            <td align="right">
                <a href="rdu_in7_b.php?<?=$url_in7;?>" target="_blank"><?=number_format($in7b);?></a>
            </td>
            <td align="right"><?=number_format($in7_result, 2);?></td>
        </tr>
        <tr>
            <td align="center">8</td>
            <td>ร้อยละการใช้ยาปฏิชีวนะในบาดแผลสดจากอุบัติเหตุ</td>
            <?php
            include 'rdu_in8.php';
            $url_in8 = "year=$year&quarter=$quarter";
            ?>
            <td>&le; ร้อยละ 40</td>
            <td align="right">
                <a href="rdu_in8_a.php?<?=$url_in8;?>" target="_blank"><?=number_format($in8a);?></a>
            </td>
            <td align="right">
                <a href="rdu_in8_b.php?<?=$url_in8;?>" target="_blank"><?=number_format($in8b);?></a>
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
            <?php 
            include 'rdu_in10.php';
            ?>
            <td>ร้อยละ 0</td>
            <td align="right" title="จำนวน visit ผู้ป่วยความดันเลือดสูงที่ได้รับการสั่งใช้ยากลุ่ม RAS Blockage &ge;2ชนิด">
                <a href="rdu_in10_detail.php?year=<?=$year;?>&quarter=<?=$quarter;?>&table=a" target="_blank"><?=number_format($in10a);?></a>
            </td>
            <td align="right" title="จำนวน visit ผู้ป่วยความดันเลือดสูงที่ได้รับการสั่งใช้ยากลุ่ม RAS Blockage อย่างน้อย1ชนิด">
                <a href="rdu_in10_detail.php?year=<?=$year;?>&quarter=<?=$quarter;?>&table=b" target="_blank"><?=number_format($in10b);?></a>
            </td>
            <td align="right"><?=number_format($in10_result, 2);?></td>
        </tr>
        <tr>
            <td align="center">11</td>
            <td>ร้อยละของผู้ป่วยที่การใช้ glibenclamide ในผู้ป่วยที่มีอายุมากกว่า 65 ปี<br>
            หรือมี eGFR น้อยกว่า 60 มล./นาที/1.73 ตารางเมตร</td>
            <?php
            include 'rdu_in11.php';

            $link_11 = "rdu_in11_detail.php?year=$year&quarter=$quarter";
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

            $link_12 = "rdu_in12_detail.php?year=$year&quarter=$quarter";
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

            $link_13 = "rdu_in13_detail.php?year=$year&quarter=$quarter";
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

            $link_14 = "rdu_in14_detail.php?year=$year&quarter=$quarter";
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

            $link_15 = "rdu_in15_detail.php?year=$year&quarter=$quarter";
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

            $link_16 = "rdu_in16_detail.php?year=$year&quarter=$quarter";
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
            <td>ร้อยละของผู้ป่วยเด็ก ที่ได้รับการวินิจแัยเป็นโรคติดเชื้อของทางเดินหายใจ (ครอบคลุมดรคตามรหัส ICD10 ตาม RUA-URI) และได้รับยาฮิสตามีนชนิด non-sedating</td>
            <?php
            include 'rdu_in18.php';

            $link_18 = "rdu_in18_detail.php?year=$year&quarter=$quarter";
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

    $db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_diag_main`");
    $db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_drugrx_main`");
    $db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_trauma_main`");
    $db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_opday_main`");
    $db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_lab_main`");

}