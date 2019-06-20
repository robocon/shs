<?php 

include 'bootstrap.php';

$db = Mysql::load();

$action = input('action');
if ($action == 'insert') {
    
    $part = input_get('part');


    $db->select("SELECT SUBSTRING(`yearchk`,3,2) AS `yearchk` FROM `chk_company_list` WHERE `code` = '$part'");
    $company = $db->get_item();
    $year = $company['yearchk'];

    $sql = "SELECT * 
    FROM `chk_lab_items` 
    WHERE `part` = '$part' 
    AND `status` = 'N' 
    ORDER BY `id` ASC ";
    $db->select($sql);
    if( $db->get_rows() > 0 ){
        $items = $db->get_items();

        foreach ($items as $key => $item) {
            $hn = $item['hn'];
            $ptname = $item['ptname'];
            $labnumber = $item['labnumber'];
            $dob = $item['dob'];
            $sex = $item['sex'];

            if( $item['item_sso'] == 'bs' ){
                $lab_sso_items = array($item['item_sso']);
            }else{
                $lab_sso_items = explode(',',  $item['item_sso']);
            }

            $clinicalinfo = "ตรวจสุขภาพประจำปี$year";

            ////////////////////////
            // ORDER HEAD
            ////////////////////////
            $orderhead_sql = "INSERT INTO `orderhead` ( 
                `autonumber`, `orderdate`, `labnumber`, `hn`, `patienttype`, 
                `patientname`, `sex`, `dob`, `sourcecode`, `sourcename`, 
                `room`, `cliniciancode`, `clinicianname`, `priority`, `clinicalinfo` 
            ) VALUES ( 
                '', NOW(), '$labnumber', '$hn', 'OPD', 
                '$ptname', '$sex', '$dob', '', '', 
                '','', 'MD022 (ไม่ทราบแพทย์)', 'R', '$clinicalinfo'
            );";
            $insert = $db->insert($orderhead_sql);
            if( $insert !== true ){
                $msg = errorMsg(NULL, $insert['id']);
            }

            // if( $find_bs === true ){
            //     $orderhead_sql = "INSERT INTO `orderhead` ( 
            //         `autonumber`, `orderdate`, `labnumber`, `hn`, `patienttype`, 
            //         `patientname`, `sex`, `dob`, `sourcecode`, `sourcename`, 
            //         `room`, `cliniciancode`, `clinicianname`, `priority`, `clinicalinfo` 
            //     ) VALUES ( 
            //         '', NOW(), '$lab_bs_number', '$hn', 'OPD', 
            //         '$ptname', '$sex', '$dob', '', '', 
            //         '','', 'MD022 (ไม่ทราบแพทย์)', 'R', '$clinicalinfo'
            //     );";
            //     $insert = $db->insert($orderhead_sql);
            //     if( $insert !== true ){
            //         $msg = errorMsg(NULL, $insert['id']);
            //     }
            // }
            ////////////////////////
            // ORDER HEAD
            ////////////////////////


            ////////////////////////
            // ORDER DETAIL
            ////////////////////////
            foreach( $lab_sso_items as $lab_key => $lab_item ){
                
                $find_suit = strstr($lab_item,'@');
                if( $find_suit != false ){

                    // ถ้าในรายการปกติไม่มีให้ไปหาใน labsuit
                    $sql_at = "SELECT `code` FROM `labsuit` WHERE `suitcode` LIKE '$lab_item'";
                    $db->select($sql_at);
                    $suit_list = $db->get_items();

                    if( count($suit_list) > 0 ){

                        foreach ($suit_list as $key => $suit_item) {
                            
                            $suit_code = $suit_item['code'];
                            $sql_detail = "SELECT `code`,`oldcode`,`detail` 
                            FROM `labcare` 
                            WHERE `code` = '$suit_code' 
                            LIMIT 1 ";
                            $q = mysql_query($sql_detail) or die( " select labcare : ".mysql_error() ) ;
                            $test_row = mysql_num_rows($q);
                            if ( $test_row > 0 ) {
                                
                                list($code, $oldcode, $detail) = mysql_fetch_row($q);   
                            
                                $orderdetail_sql = "INSERT INTO `orderdetail` ( 
                                    `labnumber` , `labcode`, `labcode1` , `labname` 
                                ) VALUES ( 
                                    '$labnumber', '$code', '$oldcode', '$detail'
                                );";
                                $insert_detail = $db->insert($orderdetail_sql);

                                if( $insert_detail !== true ){
                                    $msg .= errorMsg(NULL, $insert_detail['id']);
                                }

                            }
                            
                        }

                    }

                }else{

                    // กรณีรายการ lab ปกติ
                    $sql_detail = "SELECT `code`,`oldcode`,`detail` 
                    FROM `labcare` 
                    WHERE `code` = '$lab_item' 
                    LIMIT 1 ";
                    $q = mysql_query($sql_detail) or die( " select labcare : ".mysql_error() ) ;
                    $num = mysql_num_rows($q);
                    if( $num > 0 ){
                        list($code, $oldcode, $detail) = mysql_fetch_row($q);   
                    
                        $orderdetail_sql = "INSERT INTO `orderdetail` ( 
                            `labnumber` , `labcode`, `labcode1` , `labname` 
                        ) VALUES ( 
                            '$labnumber', '$code', '$oldcode', '$detail'
                        );";
                        $insert = $db->insert($orderdetail_sql);
                        if( $insert !== true ){
                            $msg .= errorMsg(NULL, $insert['id']);
                        }

                    }

                }
                
            }

            // if( $find_bs === true ){

            //     $sql_detail = "SELECT `code`,`oldcode`,`detail` FROM `labcare` WHERE `code` = 'bs' LIMIT 1 ";
            //     $q = mysql_query($sql_detail) or die( " select labcare : ".mysql_error() ) ;
            //     $num = mysql_num_rows($q);
            //     if( $num > 0 ){
            //         list($code, $oldcode, $detail) = mysql_fetch_row($q);   
                
            //         $orderdetail_sql = "INSERT INTO `orderdetail` ( 
            //             `labnumber` , `labcode`, `labcode1` , `labname` 
            //         ) VALUES ( 
            //             '$lab_bs_number', '$code', '$oldcode', '$detail'
            //         );";
            //         $insert = $db->insert($orderdetail_sql);
            //         if( $insert !== true ){
            //             $msg .= errorMsg(NULL, $insert['id']);
            //         }

            //     }
                
            // }
            ////////////////////////
            // ORDER DETAIL
            ////////////////////////
            



        }

    }
    
    exit;
}
?>

<!DOCTYPE html>
<html>
<head></head>
<body>
<?php

include 'chk_menu.php';

?>
<div>
<h3>สั่ง Lab เข้าเครื่อง LIS</h3>
</div>
<fieldset>
    <legend>ค้นหาตามปีงบประมาณ</legend>
    <form action="chk_lab_lis.php" method="post">
        <div> เลือกปี : 
            <?php 
            $year_selected = input_post('year_selected', date('Y') );
            $year_range = range('2018',get_year_checkup(true, true));
            getYearList('year_selected', true, $year_selected, $year_range);
            ?>
        </div>
        <div>
            <button type="submit">แสดงผล</button>
            <input type="hidden" name="views" value="search">
        </div>
    </form>
</fieldset>

<?php 

$view = input_post('views');
if( $view == 'search' ){

    $year_selected = input_post('year_selected');
    $year_selected += 543;

    $sql = "SELECT * FROM `chk_company_list` 
    WHERE `yearchk` = '$year_selected' AND `status` = '1' 
    ORDER BY `id` DESC";
    $db->select($sql);

    $items = $db->get_items();
    ?>
    <div>
        <h3>ปี <?=$year_selected;?></h3>
    </div>
    <div>
        <table class="chk_table">
            <tr>
                <th>#</th>
                <th>ชื่อบริษัท</th>
                <th>ส่งข้อมูลเข้า LIS</th>
                <th>สถานะ</th>
            </tr>
        <?php
        $i = 0;
        foreach ($items as $key => $item) {
            ++$i;

            $code = $item['code'];

            // N คือยังไม่ได้ดีดเข้า LIS
            // Y คือดีดเข้า LIS เรียบร้อยแล้ว
            $sql = "SELECT COUNT(a.`hn`) AS `rows` 
            FROM ( 
                SELECT `hn`,`part` FROM `chk_lab_items` WHERE `part` = '$code'  AND `status` = 'N' GROUP BY `hn` 
            ) AS a";
            $db->select($sql);
            $test_rows = $db->get_item();
            $rows_n = (int) $test_rows['rows'];

            $sql = "SELECT COUNT(a.`hn`) AS `rows` 
            FROM ( 
                SELECT `hn`,`part` FROM `chk_lab_items` WHERE `part` = '$code'  AND `status` = 'Y' GROUP BY `hn` 
            ) AS a";
            $db->select($sql);
            $test_rows = $db->get_item();
            $rows_y = (int) $test_rows['rows'];

            ?>
            <tr>
                <td><?=$i;?></td>
                <td><?=$item['name'];?></td>
                <td align="center">
                    <a href="chk_lab_lis.php?part=<?=$code;?>&action=insert" onclick="return chk_confirm()">บันทึกข้อมูล</a>
                </td>
                <td align="center">
                    <?php 

                    

                    if( $rows_n > 0 ){
                        echo "รอบันทึกเข้า LIS";
                    }elseif ($row_y > 0) {
                        echo "บันทึกข้อมูลเข้า LIS เรียบร้อย";
                    }else{
                        echo "ไม่มีข้อมูล";
                    }

                    // dump();
                    ?>
                </td>
            </tr>
            <?php
        }
        ?>
        </table>
    </div>
    <?php

}
?>
<script>
    function chk_confirm(){
        var c=confirm("ยืนยันที่จะส่งข้อมูลเข้า LIS");
        return c;
    }
</script>
</body>
</html>