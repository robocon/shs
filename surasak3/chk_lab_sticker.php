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
    $count_ua_barcode = input_post('count_ua_barcode');
    $count_stool = input_post('count_stool');
    $count_cs = input_post('count_cs');
    $urine_cs = input_post('urine_cs');
    $afp = input_post('afp');
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

        if($part==='สวนดุสิต63'){
            $user_number = $item['pid'];
        }

        $normal_code = $code_exam.'01';
        $chem_code = $code_exam.'02';
        $ua_code = $code_exam.'03';

        if( $count_cbc > 0 ){
            for ($i=0; $i < $count_cbc; $i++) { 
                ?>
                <!-- CBC -->
                <font style='line-height:20px;' face='Angsana New' size='4'><center><b><?=$ptname;?></b></center></font>
                <font  style='line-height:18px;' face='Angsana New' size='4'><center><b><?=$hn;?></b></center></font>
                <div style='text-align:center;'>
                    <font size='5'><?=$user_number;?></font><span class='fc1-0'><img src = "barcode/labstk.php?cLabno=<?=$normal_code;?>"></span><font size='5'>01</font>
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
                <font  style='line-height:18px;' face='Angsana New' size='4'><center><b><?=$hn;?></b></center></font>
                <div style='text-align:center;'>
                    <font size='5'><?=$user_number;?></font><span class='fc1-0'><img src = "barcode/labstk.php?cLabno=<?=$chem_code;?>"></span></span><font size='5'>02</font>
                </div>
                <div style="page-break-before: always;"></div>
                <?php 
            }
        }


        if( $count_ua_barcode==0 && $count_ua > 0 ){ 
            for ($i=0; $i < $count_ua; $i++) { 
                ?>
                <!-- UA -->
                <font style='line-height:20px;' face='Angsana New' size='4'><center><b><?=$ptname;?></b></center></font>
                <font  style='line-height:18px;' face='Angsana New' size='4'><center><b><?=$hn;?></b></center></font>
                <div style='text-align:center;'>
                    <font size='5'><?=$user_number;?></font><span class='fc1-0'><img src = "barcode/labstk.php?cLabno=<?=$ua_code;?>"></span></span><font size='5'>03</font>
                </div>
                <div style="page-break-before: always;"></div>
                <?php 
            }
        }

        if( $count_ua_barcode > 0 ){ 
            for ($i=0; $i < $count_ua; $i++) { 
                ?>
                <!-- UA แบบไม่มี Barcode -->
                <font  style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$ptname;?></b></center></font>
                <font  style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$hn;?></b></center></font>
                <div style='text-align:center;'>
                    <font size="5"><?=$user_number;?></font><span class="fc1-0" style="border: 1px solid #ffffff; display: inline-block; padding:0 30px;">ปัสสาวะ</span><font size='5'>03</font>
                </div>
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

        if( $afp > 0 ){
            for ($i=0; $i < $afp; $i++) { 
                ?>
                <font  style='line-height:23px;' face='Angsana New' size='4'><center><b>โรงพยาบาลค่ายสุรศักดิ์มนตรี</b></center></font>
                <font  style='line-height:23px;' face='Angsana New' size='4'><center><b><?=$ptname;?></b></center></font>
                <font  style='line-height:23px;' face='Angsana New' size='4'><center><b><?=$hn;?> (ตรวจสุขภาพ AFP)</b></center></font>
                <font  style='line-height:23px;' face='Angsana New' size='4'><center><b>OUTLAB <?=$chem_code;?></b></center></font>
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
            if($part==='สวนดุสิต63'){
                $bs_user_number = $bs_user_number+147;
            }

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

        if( $count_stool > 0 ){ 

            $stool_txt = 'STOOL';
            $stool_thai = sprintf("%d", $_POST['stool_thai']);
            if ($stool_thai==1) {
                $stool_txt = 'อุจจาระ';
            }

            for ($i=0; $i < $count_stool; $i++) { 
                ?>
                <font  style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$ptname;?></b></center></font>
                <font  style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$hn;?></b></center></font>
                <font  style='line-height:23px;' face='Angsana New' size='5'><center><b><span style="font-size:28pt;"><?=$user_number;?></span>&nbsp;&nbsp;&nbsp;<?=$stool_txt;?></b></center></font>
                <div style="page-break-before: always;"></div>
                <?php 
            }
        }
        
    } // end foreach

    ?>
    <script>
        window.onload = function(){
            window.print();
        }
    </script>
    <?php
    exit;
}



include 'chk_menu.php';
?>
<form action="#" method="post" id="printForm">
    <table>
        <tr>
            <td colspan="2">
                <h3>พิมพ์สติกเกอร์LAB บริษัท <u><?=$part;?></u></h3>
            </td>
        </tr>
        <tr>
            <td>CBC</td>
            <td><input type="text" name="count_cbc" size="3" value="1"></td>
        </tr>
        <tr>
            <td>CHEM</td>
            <td><input type="text" name="count_chem" size="3" value="1"></td>
        </tr>
        <tr valign="top">
            <td>UA</td>
            <td>
                <input type="text" name="count_ua" size="3" value="1"><br>
                <input type="checkbox" name="count_ua_barcode" id="count_ua_barcode" value="1"> <label for="count_ua_barcode">แสดงสติกเกอร์แบบไม่มีบาร์โค้ด</label>
            </td>
        </tr>
        <tr valign="top">
            <td>STOOL</td>
            <td>
                <input type="text" name="count_stool" size="3" value=""><br>
                <input type="checkbox" name="stool_thai" id="stool_thai" value="1"> <label for="stool_thai">แสดงข้อความเป็น "อุจจาระ"</label>
            </td>
        </tr>
        <tr>
            <td>STOOL C/S</td>
            <td><input type="text" name="count_cs" size="3" value=""></td>
        </tr>
        <tr>
            <td>Urine C/S</td>
            <td><input type="text" name="urine_cs" size="3" value=""></td>
        </tr>
        <tr>
            <td>Outlab AFP</td>
            <td><input type="text" name="afp" size="3" value=""></td>
        </tr>
        <tr>
            <td>อื่นๆ</td>
            <td><input type="text" name="count_etc" size="3" value=""></td>
        </tr>
        <tr>
            <td>ลำดับที่</td>
            <td><input type="text" name="row_print" > <span>ตัวอย่างเช่น 6-29 หรือเป็นค่าว่างเพื่อพิมพ์ทั้งหมด</span> </td>
        </tr>
        <tr>
            <td colspan="2">
                <button type="button" onclick="printNormal()">พิมพ์</button>
                <button type="button" onclick="printPdf()">พิมพ์แบบ PDF</button>

                <input type="hidden" name="part" value="<?=$part;?>">
                <input type="hidden" name="action" value="print">
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <br>
                <a href="chk_sticker_police.php" target="_blank">พิมพ์สติกเกอร์ ศูนย์ฝึกอบรมตำรวจภูธรภาค5 วันที่ 10 กรกฎาคม 2566</a><img src="images/icons/new-icon.gif" alt="">
                <br>
                <a href="chk_sticker_police2.php" target="_blank">พิมพ์สติกเกอร์ ศูนย์ฝึกอบรมตำรวจภูธรภาค5 วันที่ 11 กรกฎาคม 2566</a><img src="images/icons/new-icon.gif" alt="">
            </td>
        </tr>
    </table>
</form>
<script>
    function printNormal(){
        document.getElementById('printForm').setAttribute('action', 'chk_lab_sticker.php');
        // document.getElementById('printForm').action = 'chk_lab_sticker.php';
        document.getElementById('printForm').submit();
    }
    function printPdf(){
        document.getElementById('printForm').setAttribute('action', 'chk_lab_stickerv2.php');
        // document.getElementById('printForm').action = 'chk_lab_stickerv2.php';
        document.getElementById('printForm').submit();
    }
</script>