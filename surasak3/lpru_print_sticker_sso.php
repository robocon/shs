<?php 
include 'bootstrap.php';

$db = Mysql::load();
$sql = "SELECT * FROM `opcardchk` 
WHERE `part` = 'lpru61' 
ORDER BY `row` ASC";

$db->select($sql);
$items = $db->get_items();

$start_latest_id = 017;
$lab_header = "610919";

foreach( $items as $key => $arr ){ 
    

    $hn = $arr["HN"];
    $name = $arr["yot"].' '.$arr["name"].' '.$arr["surname"];

    $exam_no = $arr['exam_no'];
    $stk_number = $lab_header.$exam_no."01";

    ?>
    <table style="font-family: Angsana New; text-align: center;" width="100%">
        <tr>
            <td colspan="2"><?=$name.' ('.$hn.')';?></td>
        </tr>
        <tr>
            <td><font size="5"><?=$exam_no;?></font><br><font size="2">(CBC)</font></td>
            <td><img src = "barcode/labstk.php?cLabno=<?=$stk_number;?>"></td>
        </tr>
    </table>
    <?php

    $stk_number = $lab_header.$exam_no."02";
    ?>
    <table style="font-family: Angsana New; text-align: center;" width="100%">
        <tr>
            <td colspan="2"><?=$name.' ('.$hn.')';?></td>
        </tr>
        <tr>
            <td><font size="5"><?=$exam_no;?></font><br><font size="2">(Chem)</font></td>
            <td><img src = "barcode/labstk.php?cLabno=<?=$stk_number;?>"></td>
        </tr>
    </table>
    <?php

    /*
    ++$start_latest_id;
    $stk_number = $lab_header.$start_latest_id."02";
    ?>
    <table style="font-family: Angsana New; text-align: center;" width="100%">
        <tr>
            <td colspan="2"><?=$name.' ('.$hn.')';?></td>
        </tr>
        <tr>
            <td><font size="5"><?=$start_latest_id;?></font><br><font size="2">(BS)</font></td>
            <td><img src = "barcode/labstk.php?cLabno=<?=$stk_number;?>"></td>
        </tr>
    </table>
    <?php
    */
}
?>