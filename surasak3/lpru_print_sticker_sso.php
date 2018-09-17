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


$iii = 0;

foreach( $items as $key => $arr ){ 
    

    $hn = $arr["HN"];
    $name = $arr["yot"].' '.$arr["name"].' '.$arr["surname"];

    $exam_no = $arr['exam_no'];
    $stk_number = $lab_header.$exam_no."01";

    $course_list = explode('|', $arr['course']);
    $course_list2 = explode('|', $arr['branch']);
    $all_course = array_merge_recursive($course_list, $course_list2);

    $row = $arr['pid'];

    ++$iii;
    ?>
    <table style="font-family: Angsana New; text-align: center;" width="100%">
        <tr>
            <td colspan="2"><?=$name.' ('.$hn.')<br>('.$row.')';?></td>
        </tr>
        <tr>
            <td><font size="5"><?=$exam_no;?></font><br><font size="2">(CBC)</font></td>
            <td><img src = "barcode/labstk.php?cLabno=<?=$stk_number;?>"></td>
        </tr>
    </table>
    <?php

    ++$iii;
    $stk_number = $lab_header.$exam_no."02";
    ?>
    <table style="font-family: Angsana New; text-align: center;" width="100%">
        <tr>
            <td colspan="2"><?=$name.' ('.$hn.')<br>('.$row.')';?></td>
        </tr>
        <tr>
            <td><font size="5"><?=$exam_no;?></font><br><font size="2">(Chem)</font></td>
            <td><img src = "barcode/labstk.php?cLabno=<?=$stk_number;?>"></td>
        </tr>
    </table>
    <?php 

    if (in_array('UA', $all_course)) {

        for ($i=0; $i < 2; $i++) { 

            ++$iii;

            ?>
            <table style="font-family: Angsana New; text-align: center;" width="100%">
                <tr>
                    <td colspan="2"><?=$name.' ('.$hn.')<br>('.$row.')';?></td>
                </tr>
                <tr>
                    <td><font size="5"><?=$exam_no;?></font> <font size="5">UA</font></td>
                    <td>&nbsp;<br>&nbsp;</td>
                </tr>
            </table>
            <?php
        }

    }

    if (in_array('@stool', $all_course)) {

        for ($i=0; $i < 2; $i++) { 

            ++$iii;

            ?>
            <table style="font-family: Angsana New; text-align: center;" width="100%">
                <tr>
                    <td colspan="2"><?=$name.' ('.$hn.')<br>('.$row.')';?></td>
                </tr>
                <tr>
                    <td><font size="5"><?=$exam_no;?></font> <font size="5">ST</font></td>
                    <td>&nbsp;<br>&nbsp;</td>
                </tr>
            </table>
            <?php
        }

    }

    if (in_array('@stool', $all_course)) { 

        ++$iii;

        ?>
        <table style="font-family: Angsana New; text-align: center;" width="100%">
            <tr>
                <td colspan="2"><?=$name.' ('.$hn.')<br>('.$row.')';?></td>
            </tr>
            <tr>
                <td><font size="5"><?=$exam_no;?></font> <font size="5">STOCB</font></td>
                <td>&nbsp;<br>&nbsp;</td>
            </tr>
        </table>
        <?php

    }


    if (in_array('BS', $all_course)) {
        ++$start_latest_id;

        $bs_exam_id = sprintf('%03d', $start_latest_id);
        $stk_number = $lab_header.$bs_exam_id."02"; 

        ++$iii;

        ?>
        <table style="font-family: Angsana New; text-align: center;" width="100%">
            <tr>
                <td colspan="2"><?=$name.' ('.$hn.')<br>('.$row.')';?></td>
            </tr>
            <tr>
                <td><font size="5"><?=$bs_exam_id;?></font><br><font size="2">(BS)</font></td>
                <td><img src = "barcode/labstk.php?cLabno=<?=$stk_number;?>"></td>
            </tr>
        </table>
        <?php
    }
        
    
}
?>