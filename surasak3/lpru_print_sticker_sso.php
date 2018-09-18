<?php 
include 'bootstrap.php';

$db = Mysql::load();
$sql = "SELECT * FROM `opcardchk` 
WHERE `part` = 'ÃÒªÀÑ®61' 
ORDER BY `row` ASC";

$db->select($sql);
$items = $db->get_items();

$start_latest_id = 154;
$lab_header = "610919";


$test_count = 1;

$iii = 0;
?>
<style>
table{
    border-collapse: collapse;
    width: 50mm;
    height: 25mm;
    /* border: 1px solid #000000; */
}

table tr,
table th,
table td{
    padding: 0;
}
table td{
    line-height: 16px;
}
</style>
<?php

foreach( $items as $key => $arr ){ 
    
    $row = $arr['pid'];

    if( $row != '036' && $row != '038' && $row != '039' && $row != '084' && $row != '090' ){
        continue;
    }

    $test_count++;

    $hn = $arr["HN"];
    $name = $arr["yot"].' '.$arr["name"].' '.$arr["surname"];

    $exam_no = $arr['exam_no'];
    $stk_number = $lab_header.$exam_no."01";

    $course_list = explode('|', $arr['course']);
    $course_list2 = explode('|', $arr['branch']);
    $all_course = array_merge_recursive($course_list, $course_list2);

    

    ++$iii;
    ?>
    <table style="font-family: Angsana New; text-align: center;" width="100%" valign="top">
        <tr>
            <td colspan="2"><?=$name;?></td>
        </tr>
        <tr>
            <td><?=$hn;?><br><font size="5"><?=$exam_no;?></font><br><font size="2">(CBC)</font></td>
            <td><img src = "barcode/labstk.php?cLabno=<?=$stk_number;?>"></td>
        </tr>
    </table>
    <?php

    ++$iii;
    $stk_number = $lab_header.$exam_no."02";

    for ($i=0; $i < 2; $i++) { 
    ?>
    <table style="font-family: Angsana New; text-align: center;" width="100%" valign="top">
        <tr>
            <td colspan="2"><?=$name;?></td>
        </tr>
        <tr>
            <td><?=$hn;?><br><font size="5"><?=$exam_no;?></font><br><font size="2">(Chem)</font></td>
            <td><img src = "barcode/labstk.php?cLabno=<?=$stk_number;?>"></td>
        </tr>
    </table>
    <?php 
    }

    if (in_array('UA', $all_course)) {

        for ($i=0; $i < 2; $i++) { 

            ++$iii;

            ?>
            <table style="font-family: Angsana New; text-align: center;" width="100%" valign="top">
                <tr>
                    <td colspan="2"><?=$name;?><br><?=$hn;?></td>
                </tr>
                <tr>
                    <td><font size="5"><?=$exam_no;?></font> - <font size="5">UA</font></td>
                    <td>&nbsp;<br>&nbsp;</td>
                </tr>
            </table>
            <?php
        }

    }

    if (in_array('@STOOL', $all_course)) {

        for ($i=0; $i < 2; $i++) { 

            ++$iii;

            ?>
            <table style="font-family: Angsana New; text-align: center;" width="100%" valign="top">
                <tr>
                    <td colspan="2"><?=$name;?><br><?=$hn;?></td>
                </tr>
                <tr>
                    <td><font size="5"><?=$exam_no;?></font> - <font size="5">ST</font></td>
                    <td>&nbsp;<br>&nbsp;</td>
                </tr>
            </table>
            <?php
        }

    }

    if (in_array('STOCB', $all_course)) { 

        ++$iii;

        ?>
        <table style="font-family: Angsana New; text-align: center;" width="100%" valign="top">
            <tr>
                <td colspan="2"><?=$name;?><br><?=$hn;?></td>
            </tr>
            <tr>
                <td><font size="5"><?=$exam_no;?></font> - <font size="5">STOCB</font></td>
                <td>&nbsp;<br>&nbsp;</td>
            </tr>
        </table>
        <?php

    }

    /*
    if (in_array('BS', $all_course)) {
        ++$start_latest_id;

        $bs_exam_id = sprintf('%03d', $start_latest_id);
        $stk_number = $lab_header.$bs_exam_id."02"; 

        ++$iii;

        ?>
        <table style="font-family: Angsana New; text-align: center;" width="100%">
            <tr>
                <td colspan="2"><?=$name;?><br><?=$hn;?></td>
            </tr>
            <tr>
                <td><font size="5"><?=$bs_exam_id;?></font><br><font size="2">(BS)</font></td>
                <td><img src = "barcode/labstk.php?cLabno=<?=$stk_number;?>"></td>
            </tr>
        </table>
        <?php
    }
    */
    
}
?>