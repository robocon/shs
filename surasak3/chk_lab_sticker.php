<?php 

include 'bootstrap.php';

$part = input('part');
if( empty($part) ){ die('EEEEERRRRRRRRRRRRROOORR Company Name'); }

$db = Mysql::load();



$action = input_post('action');
if ( $action == 'print' ) {

    $count_cbc = input_post('count_cbc');
    $count_chem = input_post('count_chem');
    $count_ua = input_post('count_ua');
    $count_stool = input_post('count_stool');
    $count_cs = input_post('count_cs');
    $urine_cs = input_post('urine_cs');
    $count_etc = input_post('count_etc');
    $row_print = input_post('row_print');

    if ( !empty($row_print) ) {
        list($min,$max) = explode('-', $row_print);

        $min = $min - 1;
        $range = $max - $min;

        $limit_txt = " LIMIT $min, $range";
    }

    $sql = "SELECT `exam_no`,`HN` AS `hn`,`pid`,`name`,`surname` 
    FROM `opcardchk` 
    WHERE `part` = '$part' 
    ORDER BY `row` ".$limit_txt;
    $db->select($sql);

    $items = $db->get_items();
    foreach ($items as $key => $item) {
        
        $hn = $item['hn'];
        $ptname = trim($item['name']).' '.trim($item['surname']);

        $code_exam = $item['exam_no'];
        if( empty($code_exam) ){
            $code_exam = (date('y') + 43).date('md').sprintf('%03d', $item['pid']);
        }

        $user_number = (int) substr($code_exam,6);

        $normal_code = $code_exam.'01';
        $chem_code = $code_exam.'02';
        $ua_code = $code_exam.'03';

        if( $count_cbc > 0 ){
            for ($i=0; $i < $count_cbc; $i++) { 
                ?>
                <!-- CBC -->
                <font style='line-height:20px;' face='Angsana New' size='4'><center><b><?=$ptname;?></b></center></font>
                <font  style='line-height:18px;' face='Angsana New' size='4'><center><b><?=$hn;?> (<span style="font-size:18pt;">01</span>)</b></center></font>
                <div style='text-align:center;'>
                    <font size='5'><?=$user_number;?></font><span class='fc1-0'><img src = "barcode/labstk.php?cLabno=<?=$normal_code;?>"></span>
                </div>
                <div style="page-break-before: always;"></div>
                <?php 
            }
        }

        if( $count_chem > 0 ){
            for ($i=0; $i < $count_chem; $i++) { 
                ?>
                <!-- CHEM -->
                <font style='line-height:20px;' face='Angsana New' size='4'><center><b><?=$ptname;?></b></center></font>
                <font  style='line-height:18px;' face='Angsana New' size='4'><center><b><?=$hn;?> (<span style="font-size:18pt;">02</span>)</b></center></font>
                <div style='text-align:center;'>
                    <font size='5'><?=$user_number;?></font><span class='fc1-0'><img src = "barcode/labstk.php?cLabno=<?=$chem_code;?>"></span>
                </div>
                <div style="page-break-before: always;"></div>
                <?php 
            }
        }

        if( $count_ua > 0 ){ 
            for ($i=0; $i < $count_ua; $i++) { 
                ?>
                <!-- UA -->
                <font style='line-height:20px;' face='Angsana New' size='4'><center><b><?=$ptname;?></b></center></font>
                <font  style='line-height:18px;' face='Angsana New' size='4'><center><b><?=$hn;?> (<span style="font-size:18pt;">03</span>)</b></center></font>
                <div style='text-align:center;'>
                    <font size='5'><?=$user_number;?></font><span class='fc1-0'><img src = "barcode/labstk.php?cLabno=<?=$ua_code;?>"></span>
                </div>
                <div style="page-break-before: always;"></div>
                <?php 
            }
        }

        if( $count_stool > 0 ){ 
            for ($i=0; $i < $count_stool; $i++) { 
                ?>
                <font  style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$ptname;?></b></center></font>
                <font  style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$hn;?></b></center></font>
                <font  style='line-height:23px;' face='Angsana New' size='5'><center><b><span style="font-size:28pt;"><?=$user_number;?></span> STOOL</b></center></font>
                <div style="page-break-before: always;"></div>
                <?php 
            }
        }

        if( $count_cs > 0 ){ 
            for ($i=0; $i < $count_cs; $i++) { 
                ?>
                <font  style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$ptname;?></b></center></font>
                <font  style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$hn;?></b></center></font>
                <font  style='line-height:23px;' face='Angsana New' size='5'><center><b>STOOL C/S</b></center></font>
                <div style="page-break-before: always;"></div>
                <?php 
            }
        }

        if( $urine_cs > 0 ){
            for ($i=0; $i < $urine_cs; $i++) { 
                ?>
                <font  style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$ptname;?></b></center></font>
                <font  style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$hn;?></b></center></font>
                <font  style='line-height:23px;' face='Angsana New' size='5'><center><b>Urine C/S</b></center></font>
                <div style="page-break-before: always;"></div>
                <?php 
            }
        }

        if( $count_etc > 0 ){ 
            for ($i=0; $i < $count_etc; $i++) { 
                ?>
                <font  style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$ptname;?></b></center></font>
                <font  style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$hn;?></b></center></font>
                <div style="page-break-before: always;"></div>
                <?php 
            }
        }

        $sql = "SELECT * FROM `chk_lab_items` WHERE `hn` = '$hn' AND `part` = '$part' AND `item_sso` = 'bs' ";
        $db->select($sql);
        $test_bs_row = $db->get_rows();
        if( $test_bs_row > 0 ){
            $bs = $db->get_item();

            $bs_user_number = (int) substr($bs['labnumber'],6);

            $bs_code = $bs['labnumber'].'02';
            ?>
            <!-- BS -->
            <font style='line-height:20px;' face='Angsana New' size='4'><center><b><?=$ptname;?></b></center></font>
            <font  style='line-height:18px;' face='Angsana New' size='4'><center><b><?=$hn;?> (BS)</b></center></font>
            <div style='text-align:center;'>
                <font size='5'><?=$bs_user_number;?></font><span class='fc1-0'><img src = "barcode/labstk.php?cLabno=<?=$bs_code;?>"></span>
            </div>
            <div style="page-break-before: always;"></div>
            <?php
        }
        
    }

    exit;

}



include 'chk_menu.php';
?>
<form action="chk_lab_sticker.php" method="post">
    <div>
        <h3>พิมพ์สติกเกอร์LAB บริษัท <u><?=$part;?></u></h3>
    </div>
    <div>
        CBC: <input type="text" name="count_cbc" size="3" value="1">
    </div>
    <div>
        CHEM: <input type="text" name="count_chem" size="3" value="1">
    </div>
    <div>
        UA: <input type="text" name="count_ua" size="3" value="1">
    </div>
    <div>
        STOOL: <input type="text" name="count_stool" size="3" value="">
    </div>
    <div>
        STOOL C/S: <input type="text" name="count_cs" size="3" value="">
    </div>
    <div>
        Urine C/S: <input type="text" name="urine_cs" size="3" value="">
    </div>
    <div>
        อื่นๆ: <input type="text" name="count_etc" size="3" value="">
    </div>
    <div>
        ลำดับที่ <input type="text" name="row_print" > <span>ตัวอย่างเช่น 6-29 หรือเป็นค่าว่างเพื่อพิมพ์ทั้งหมด</span> 
    </div>
    <div>
        <button type="submit">พิมพ์</button>
        <input type="hidden" name="part" value="<?=$part;?>">
        <input type="hidden" name="action" value="print">
    </div>
</form>
<?php 

